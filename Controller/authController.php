<?php
include_once 'Models/contact_model.php';
include_once 'Models/user_model.php';

class authController {
    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = user_model::getUserByUsername($username);
            // var_dump($user);
            if ($user !== null && $password == $user['password']) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("Location: " . urlpath('dashboard'));
                exit();
            }
            else {
                view('login');
            }

        } else{
            view('login');

        }


    }
    public static function register() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];
            
            $errors = [];
            if ($password != $confirmpassword) {
                $errors[] = "Password does not match with confirm password";
            }
            if (empty($username)) {
                $errors[] = "Username cannot be empty";
            }
            if (!isset($role)) {
                $errors[] = "Role must be selected";
            }

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (empty($email)) {
                    $errors[] = "Email cannot be empty";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Email cannot be invalid";
                } else {
                    $errors[] = "Email has already been taken";
                }
            }

            if (empty($password)) {
                $errors[] = "Password cannot be empty";
            }

            if (empty($confirmpassword)) {
                $errors[] = "Confirm password cannot be empty";
            }

            if (!empty($errors)) {
                session_start();
                $_SESSION['register_errors'] = $errors;
                $_SESSION['post'] = $_POST;                
                header("Location: " . urlpath('register'));
                exit();
            }
            
            $userId = user_model::create($username,$password,intval($role));
                if ($userId) {
                    // Jika pembuatan pengguna berhasil, tambahkan data kontak
                    $success = contact_model::create($userId, null, null, null, null);
                }
                
            $_SESSION['register_success'] = true;
            header("Location: " . urlpath('login'));
            exit();
        } else {
            $roles = contact_model::getRoles();
            view('register',[
            'roles' => $roles
        ]);
        }
    }

    public static function requireLogin() {
        // session_start();
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header("Location: ".urlpath('login'));
            exit();
        }
    }

    public static function logout() {
        // session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: ".urlpath('login'));
        exit();
    }
}
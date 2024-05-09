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
            if ($user !== null && $user['role_id'] == 1 && $password == $user['password']) {
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
        view('register');

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
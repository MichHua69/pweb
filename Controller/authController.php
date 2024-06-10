<?php
include_once 'model/dinas_peternakanModel.php';
include_once 'model/kepala_kelompok_ternakModel.php';
include_once 'model/peternakModel.php';
include_once 'model/authModel.php';
class authController{

    public static function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $isDinas = authModel::isDinas($email, $password);
            $isKepala = authModel::isKepala($email, $password);
            $isPeternak = authModel::isPeternak($email, $password);
            
            if ($isDinas) {
                $_SESSION['role'] = 1;
                $user = dinas_peternakanModel::getUser($email);
                $_SESSION['user'] = $user;
            } elseif ($isKepala) {
                $_SESSION['role'] = 2;
                $user = kepala_kelompok_ternakModel::getUser($email);
                $_SESSION['user'] = $user;
            } elseif ($isPeternak) {
                $_SESSION['role'] = 3;
                $user = peternakModel::getUser($email);
                $_SESSION['user'] = $user;
            }
            if ($isDinas || $isKepala || $isPeternak) {

                header('Location: ' . urlPath('dashboard'));
            } else {
                $_SESSION['error'] = 'Email atau Password salah!';
                header('Location: '. urlPath('login'));
            }

        } else if($_SERVER['REQUEST_METHOD'] == 'GET'){
            
        view('login');
        }
    }
    public static function logout() {
        // session_start();
        $_SESSION['role'] = array();
        session_destroy();
        header("Location: ".urlpath('login'));
        exit();
    }
    
    public static function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // var_dump($_POST);
            $register = $_POST['register'];
            // var_dump($register);
            $_SESSION['register'] = $register;

            $nama = $_POST['name'];
            $email = $_POST['email'];
            $nik = $_POST['nik'];
            $telepon = $_POST['telepon'];
            $password = $_POST['password'];
            $password_confirmation = $_POST['password_confirmation'];
            $_SESSION['name'] = $nama;
            $_SESSION['email'] = $email;
            $_SESSION['nik'] = $nik;
            $_SESSION['telepon'] = $telepon;

            // Validate inputs
            if(empty($nama)){
                $_SESSION['error']['name'] = 'Nama wajib diisi';
            }
            if(empty($email)){
                $_SESSION['error']['email'] = 'Email wajib diisi';
            }
            if(empty($nik)){
                $_SESSION['error']['nik'] = 'NIK wajib diisi';
            }
            if(empty($telepon)){
                $_SESSION['error']['telepon'] = 'Telepon wajib diisi';
            }
            if(empty($password)){
                $_SESSION['error']['password'] = 'Password wajib diisi';
            }
            if(empty($password_confirmation)){
                $_SESSION['error']['password_confirmation'] = 'Konfirmasi Password wajib diisi';
            }
            
            $checkEmailUnique = authModel::checkEmailUnique($email);
            if($checkEmailUnique == false) {
                $_SESSION['error']['email'] = 'Email sudah terdaftar';
            }
            $checkNIKUnique = authModel::checkNIKUnique($nik);
            if($checkNIKUnique == false) {
                $_SESSION['error']['nik'] = 'NIK sudah terdaftar';
            }
            $checkTeleponUnique = authModel::checkTeleponUnique($telepon);
            if($checkTeleponUnique == false) {
                $_SESSION['error']['telepon'] = 'Telepon sudah terdaftar';
            }

            if (strlen($password) < 8 || strlen($password) > 10) {
                $_SESSION['error']['password'] = 'Password harus 8-10 karakter';
                
            } else  if($password != $password_confirmation) {
                    $_SESSION['error']['password_confirmation'] = 'Pastikan password anda sesuai';
            }
            

            if (isset($_SESSION['error'])) {
                // Redirect to register page
                // echo "redirected";
                header("Location: " . urlpath('register'));
                exit();
            }
            // Check if there are any errors
            if(empty($_SESSION['error'])) {
                if (isset($_POST['noSurat']) && isset($_POST['wilayah'])) {
                    $noSurat = $_POST['noSurat'];
                    $wilayah = $_POST['wilayah'];
                    // var_dump($_SESSION);
                    // $data = [
                    //     'nama' => $nama,
                    //     'email' => $email,
                    //     'nik' => $nik,
                    //     'telepon' => $telepon,
                    //     'password' => password_hash($password, PASSWORD_DEFAULT), // Secure password hashing
                    //     'noSurat' => $noSurat,
                    //     'wilayah' => $wilayah,
                    // ];
                    // kepala_kelompok_ternakModel::create($data);
                } else {
                    $data = [
                        'nama' => $nama,
                        'email' => $email,
                        'nik' => $nik,
                        'telepon' => $telepon,
                        'password' => password_hash($password, PASSWORD_DEFAULT), // Secure password hashing
                    ];
                    peternakModel::create($data);
                }
    
                // Redirect to login after successful registration
                // $_SESSION['success'] = 'Akun anda berhasil dibuat! Silahkan login';
                // header("Location: " . urlpath('login'));
                // exit();
            }
        } else if($_SERVER['REQUEST_METHOD'] == 'GET'){
            view('register');
        }
    }
    
}

    

?>
<?php
include_once 'Models/contact_model.php';
include_once 'Models/user_model.php';


class contactController {
    static function index() { 
        authController::requireLogin();

        global $conn;
        $data = contact_model::index();
        $rowsPerPage = $data['rowPerPage'];
        $page = $data['page'];
        $offset = $data['offset'];
        $result = $data['result'];

        $totalQuery = contact_model::totalQuery();
        $totalResult = $conn->query($totalQuery);
        $totalRow = $totalResult->fetch_assoc();
        $totalPages = ceil($totalRow['total'] / $rowsPerPage);
        $roles = contact_model::getRoles();

        $user = user_model::getUserByUsername($_SESSION['username']) ;
        view('contact', [
            'result' => $result,
            'rowsPerPage' => $rowsPerPage,
            'halaman' => $page,
            'totalPages' => $totalPages,
            'offset' => $offset,
            'roles' => $roles,
            'user' => $user,
        ]);
    }

    static function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'create') {
                // Ambil data dari form
                $name = $_POST['name'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $phone_number = $_POST['phone_number'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $userId = user_model::create($username, $password, $role);

                if ($userId) {
                    // Jika pembuatan pengguna berhasil, tambahkan data kontak
                    $success = contact_model::create($userId, $name, $email, $address, $phone_number);
    
                    if ($success) {
                        // Redirect kembali ke halaman utama
                        header('Location: '.BASEURL.'contact');
                        exit();
                    } else {
                        // Handle error jika gagal membuat entri kontak
                        echo "Gagal membuat entri kontak. Silakan coba lagi.";
                    }
                } else {
                    // Handle error jika pembuatan pengguna gagal
                    echo "Gagal membuat pengguna. Silakan coba lagi.";
                }
            }
        }
    }

    static function edit() {
        // var_dump($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'update') {

                $contact_id = $_POST['contact_id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $phone_number = $_POST['phone_number'];
                $success = contact_model::update($contact_id, $name, $email, $address, $phone_number);
                $page = intval($_POST['page']);
                if ($success) {
                    // var_dump($page);
                    header('Location: '.BASEURL.'contact?page='.$page);
                    exit();
                }
            } 
        }
    }

    static function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $contact_id = intval($_POST['contact_id']);
                $page = intval($_POST['page']);
                
                $contact = contact_model::delete($contact_id);
                if ($contact) {
                    $success = user_model::delete($contact_id);
                    header('Location: '.BASEURL.'contact?page='.$page);
                    exit();
                } else {
                    // Handle error jika gagal membuat entri kontak
                    echo "Gagal Menghapus Kontak. Silahkan coba lagi.";
                }
                // var_dump($contact_id);
                
            } else {
                echo "Gagal menghapus akun. Silakan coba lagi.";
            }
        }
    }
}
?>

<?php
include_once 'Models/contact_model.php';
include_once 'Models/user_model.php';

class accountController {
    static function index() { 
        authController::requireLogin(); // Memanggil requireLogin() dari authController

        global $conn;
        $data = user_model::index();
        $rowsPerPage = $data['rowPerPage'];
        $page = $data['page'];
        $offset = $data['offset'];
        $result = $data['result'];
        // Menghitung total baris dari hasil kueri untuk pagination
        $totalQuery = user_model::totalQuery();
        $totalResult = $conn->query($totalQuery);
        $totalRow = $totalResult->fetch_assoc();
        $totalPages = ceil($totalRow['total'] / $rowsPerPage);
        
        $user = user_model::getUserByUsername($_SESSION['username']) ;
        // Mengirimkan data ke tampilan
        view('account', [
            'result' => $result,
            'rowsPerPage' => $rowsPerPage,
            'halaman' => $page,
            'totalPages' => $totalPages,
            'offset' => $offset,
            'user' => $user,
        ]);
    }
}
?>

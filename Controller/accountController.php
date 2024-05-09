<?php
include_once 'Models/contact_model.php';
include_once 'Models/user_model.php';


class accountController {
    static function index() { 
        authController::requireLogin();

        global $conn;
        $data = user_model::index();
        $rowsPerPage = $data['rowPerPage'];
        $page = $data['page'];
        $offset = $data['offset'];
        $result = $data['result'];

        $totalQuery = user_model::totalQuery();
        $totalResult = $conn->query($totalQuery);
        $totalRow = $totalResult->fetch_assoc();
        $totalPages = ceil($totalRow['total'] / $rowsPerPage);

        view('contact', [
            'result' => $result,
            'rowsPerPage' => $rowsPerPage,
            'halaman' => $page,
            'totalPages' => $totalPages,
            'offset' => $offset,
        ]);
    }
    // static function index() { 
    //     authController::requireLogin();

    //     $data = user_model::index();
    //     $result = $data['result'];
    //     $rowsPerPage = $data['rowsPerPage'];
    //     $page = $data['page'];
    //     $totalPages = $data['totalPages'];
    //     $offset = ($page - 1) * $rowsPerPage;
    //     // // var_dump($data);
    //     view('account', [
    //         'result' => $result,
    //         'rowsPerPage' => $rowsPerPage,
    //         'halaman' => $page,
    //         'totalPages' => $totalPages,
    //         'offset' => $offset,
    //     ]);
    // }
    
}
?>

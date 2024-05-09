<?php
include_once 'Models/contact_model.php';
include_once 'Models/user_model.php';


class dashboardController {
    static function index() { 
        authController::requireLogin();

        view('dashboard');
    }

}
?>

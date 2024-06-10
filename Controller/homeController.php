<?php
class homeController {
    public static function index() {
        // // $role = $_SESSION['role'];
        // // $user = $_SESSION['user'];

        // $totalrow = beritaModel::getTotal();
        // $total_pages = ceil($totalrow / 6);

        // $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        // $berita = beritaModel::getBerita($current_page);
        // // var_dump($berita);
        // view('home', [
        //     // 'role' => $role,
        //     // 'user' => $user,
        //     'berita' => $berita,
        //     'total_pages' => $total_pages,
        //     'current_page' => $current_page
        // ]);
        view('home');
    }
}
?>
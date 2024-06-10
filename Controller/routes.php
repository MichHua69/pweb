<?php


route('', 'get', 'homeController::index');
route('login', 'get', 'authController::login');
route('login', 'post', 'authController::login');
route('register', 'get', 'authController::register');
route('register', 'post', 'authController::register');
route('logout', 'get', 'authController::logout');

route('dashboard', 'get', 'dashboardController::showDashboard');
route('tambahberita', 'get', 'dashboardController::showTambahBerita');
route('tambahberita', 'post', 'dashboardController::storeTambahBerita');
route('berita', 'get', 'dashboardController::showBerita');



//pengajuan
route('pengajuan', 'get', 'pengajuanController::showPengajuan');
route('fetchpengajuan', 'get', 'pengajuanController::fetchPengajuan');

route('tambahpengajuan', 'get', 'pengajuanController::showTambahPengajuan');
route('tambahpengajuan', 'post', 'pengajuanController::storeTambahPengajuan');

route('editpengajuan', 'get', 'pengajuanController::showEditPengajuan');
route('editpengajuan', 'post', 'pengajuanController::storeEditPengajuan');

route('detailpengajuan', 'get', 'pengajuanController::showDetailPengajuan');
route('detailpengajuan', 'post', 'pengajuanController::storeDetailPengajuan');

route('validasi', 'get' ,'pengajuanController::unduhValidasi');

route('konfirmasi', 'get', 'pengajuanController::showKonfirmasi');
route('konfirmasi', 'post', 'pengajuanController::storeKonfirmasi');

route('profil', 'get', 'profilController::showProfil');
route('profil', 'post', 'profilController::storeProfil');

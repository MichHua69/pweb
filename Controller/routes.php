<?php


route('/', 'get', function () {
    view('welcome');
});
//auth
route('login', 'get', 'authController::login');
route('login', 'post', 'authController::login');
route('register', 'get', 'authController::register');
route('register', 'post', 'authController::register');


route('contact','get' , 'contactController::index');
route('contact.store','post' , 'contactController::create');
route('contact.edit','post' , 'contactController::edit');
route('contact.delete','post' , 'contactController::delete');

route('account', 'get', 'accountController::index');

route('dashboard', 'get', 'dashboardController::index');

route('logout', 'get', 'authController::logout');

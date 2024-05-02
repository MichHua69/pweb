<?php
include_once 'config/static.php';
include_once 'Controller/main.php';
include_once 'function/main.php';
include_once 'config/env.php';
include_once 'Controller/routes.php';


$url = basename($_SERVER['REQUEST_URI']);
// echo "URL: $url"; // Debugging aja sih ini

$url = implode(
    "/",
    array_filter(
        explode(
            "/",
            str_replace(
                $_ENV['BASEDIR'],
                "",
                parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
            )
        ),
        'strlen'
    )
);

// Ini buat ngepastiin bahwa URL yang di rquest itu ada di daftar Routes di routes.phpEnsure that the requested URL matches a defined route
if (!in_array($url, $urls['routes'])) {
    header('Location: ' . BASEURL);
    exit;
}

$call = $urls[$_SERVER['REQUEST_METHOD']][$url];
$call();
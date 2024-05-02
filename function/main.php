<?php

function view($page, $data=[]) {
    extract($data);
    include 'Views/'.$page.'.php';
}

$urls = [];
function route($url, $method, $callback) {
    global $urls;
    if ($url == '/') { $url = ''; }
    $urls[strtoupper($method)][$url] = $callback;
    $urls['routes'][] = $url;
    $urls['routes'] = array_unique($urls['routes']);
}

function urlpath($path) {
    require_once 'config/static.php';
    return BASEURL.$path;
}
<?php

if (!isset($_COOKIE['user']) && !isset($_COOKIE['id'])) {
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    header("Location: http://$_SERVER[HTTP_HOST]/$uri_segments[1]/login.php");
    die();
} else {
    $user = $_COOKIE['user'];
    $id = $_COOKIE['id'];
    $odjel = $_COOKIE['odjel'];
    $centar = $_COOKIE['centar'];

    setcookie("user", $user, time() + 3600, '/', '', '', TRUE);
    setcookie("id", $id, time() + 3600, '/', '', '', TRUE);
    setcookie("odjel", $odjel, time() + 3600, '/', '', '', TRUE);
    setcookie("centar", $centar, time() + 3600, '/', '', '', TRUE);
}
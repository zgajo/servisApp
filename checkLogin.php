<?php

if (!isset($_COOKIE['user']) && !isset($_COOKIE['id'])) {
    header('Location: login.php');
    exit();
} else {
    $user = $_COOKIE['user'];
    $id = $_COOKIE['id'];
    $odjel = $_COOKIE['odjel'];
    $centar = $_COOKIE['centar'];

    setcookie("user", "$user", time() + 3600, '/', '', '', TRUE);
    setcookie("id", $id, time() + 3600, '/', '', '', TRUE);
    setcookie("odjel", $odjel, time() + 3600, '/', '', '', TRUE);
    setcookie("centar", $centar, time() + 3600, '/', '', '', TRUE);
}
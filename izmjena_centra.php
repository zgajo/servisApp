<?php


include_once './checkLogin.php';
include_once './klase/osoba.php';
$d = new djelatnik();
$d->izmijeniCentar($_POST['centar'], $_POST['id']);
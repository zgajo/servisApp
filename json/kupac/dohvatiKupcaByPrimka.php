<?php


include_once '../../checkLogin.php';
include_once '../../klase/osoba.php';
header('Content-type: application/json');
$stranka = new stranka();
$stranka = $stranka->primkaByKupac($_GET['id']);

echo json_encode($stranka, JSON_UNESCAPED_UNICODE);
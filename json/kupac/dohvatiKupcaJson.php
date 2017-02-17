<?php
include_once '../../klase/checkLogin.php';
include_once '../../klase/osoba.php';
header('Content-type: application/json');
 $stranka = new stranka();
$stranka = $stranka->getById($_POST['id']);

echo json_encode($stranka, JSON_UNESCAPED_UNICODE);


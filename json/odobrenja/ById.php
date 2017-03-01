<?php


include_once '../../klase/checkLogin.php';
include_once '../../klase/radniNalog.php';
header('Content-type: application/json');
$od = new odobrenja();
echo json_encode($od->ById($_POST["id"]), JSON_UNESCAPED_UNICODE);

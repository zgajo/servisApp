<?php

include_once '../../checkLogin.php';
include_once '../../klase/primka.php';
header('Content-type: application/json');
$primka=new primka();
$primka = $primka->getByIdRN($_GET['id']);
echo json_encode($primka, JSON_UNESCAPED_UNICODE);


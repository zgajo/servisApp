<?php

include_once '../../checkLogin.php';
include_once '../../klase/osoba.php';
header('Content-type: application/json');
$osoba=new djelatnik();
$return = $osoba->izmjenaLozinke($_POST['id'], $_POST['l']);

echo json_encode($return, JSON_UNESCAPED_UNICODE);


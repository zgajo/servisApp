<?php

include_once './checkLogin.php';
include_once './klase/primka.php';
header('Content-type: application/json');
$primka=new primka();
$primka = $primka->getByIdRN(4);

print_r($primka);

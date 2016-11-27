<?php

include_once './checkLogin.php';
include_once './klase/primka.php';
header('Content-type: application/json');
$primka=new primka();
$primka->updatePrimka($_POST['status'], $_POST['id']);

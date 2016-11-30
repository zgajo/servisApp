<?php

include_once '../../checkLogin.php';
include_once '../../klase/primka.php';
header('Content-type: application/json');
$primka=new primka();
$primka->updatePrimka($_POST['su'], $_POST['b'], $_POST['t'], $_POST['n'], $_POST['s'], $_POST['ok'], $_POST['pp'], $_POST['r'], $_POST['dk'], $_POST['id']);
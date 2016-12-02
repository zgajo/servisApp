<?php

include_once '../../checkLogin.php';
include_once '../../klase/primka.php';


$primka=new primka();
$primka->azurirajStatus($_POST['status'], $_POST['id']);

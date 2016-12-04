<?php

include_once '../../checkLogin.php';
include_once '../../klase/primka.php';


$primka=new primka();
if($_POST['status'] === "Kupac preuzeo") $primka->zatvori ($_POST['id'], $_COOKIE['id'], $_POST['status']);
else $primka->azurirajStatus($_POST['status'], $_POST['id']);

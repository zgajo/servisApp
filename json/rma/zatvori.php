<?php

include_once '../../klase/checkLogin.php';
include_once '../../klase/radniNalog.php';

$r = new rmaNalog();
$r->zatvori($_POST['id'],  $_POST['status'], $_POST['popravak'], $_POST['napomena'], $_POST['naplata'] , $_POST['nazivOS'], $_POST['rnOS'], $_COOKIE['id']);
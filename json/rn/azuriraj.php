<?php


include_once '../../checkLogin.php';
include_once '../../klase/radniNalog.php';
$rn = new servisRN();
$rn->update( $_POST['id'],  $_POST['status'], $_POST['popravak'], $_POST['napomena'], $_POST['naplata']);
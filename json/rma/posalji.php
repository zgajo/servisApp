<?php

include_once '../../checkLogin.php';
include_once '../../klase/radniNalog.php';

$r = new rmaNalog();
$r->posalji($_POST['id'],  $_POST['status'], $_POST['popravak'], $_POST['napomena'], $_POST['naplata'] , $_POST['rnOS'], $_POST['nazivOS'],  $_COOKIE['id']);
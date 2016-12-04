<?php

include_once '../../checkLogin.php';
include_once '../../klase/radniNalog.php';

$r = new rmaNalog();
$r->update($_POST['id'],  $_POST['status'], $_POST['popravak'], $_POST['napomena'], $_POST['naplata'], $_POST['nazivOS'], $_POST['rnOS']);
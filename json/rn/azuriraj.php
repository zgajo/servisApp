<?php


include_once '../../checkLogin.php';
include_once '../../klase/radniNalog.php';
$rn = new servisRN();
$rn->update($radni[0]['rn_id'],  $_POST['status_rn'], $_POST['popravak'], $_POST['napomena'], $_POST['naplata']);

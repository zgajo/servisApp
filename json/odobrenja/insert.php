<?php

include_once '../../klase/checkLogin.php';
include_once '../../klase/radniNalog.php';

$od = new odobrenja();
$dobavljac = $_POST["dob"];
$zatrazeno = $_POST['od'];
$napomena = $_POST["nap"];
$status = $_POST["st"];
$primka  =  $_POST["pr"];
$od->insert($dobavljac, $zatrazeno,$napomena , $status, $primka);

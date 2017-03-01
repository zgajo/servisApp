<?php

include_once '../../klase/checkLogin.php';
include_once '../../klase/radniNalog.php';

$od = new odobrenja();
$dobavljac = $_GET["dob"];
$zatrazeno = $_GET['od'];
$napomena = $_GET["nap"];
$status = $_GET["st"];
$primka  =  $_GET["pr"];
$rijeseno = $_GET["ri"];
$id = $_GET['id'];
$od->update($dobavljac, $zatrazeno,$napomena , $status, $primka, $rijeseno, $id);

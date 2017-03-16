<?php

include_once '../../klase/checkLogin.php';
include_once '../../klase/radniNalog.php';
header('Content-type: application/json');
$rn=new servisRN();
$rn = $rn->sviRNostaliZavrseni($_COOKIE['centar']);
echo json_encode($rn, JSON_UNESCAPED_UNICODE);


<?php

include_once '../../checkLogin.php';
include_once '../../klase/radniNalog.php';
header('Content-type: application/json');
$rn=new servisRN();
$rn = $rn->RNbyPrimka($_POST['primka']);
echo json_encode($rn, JSON_UNESCAPED_UNICODE);

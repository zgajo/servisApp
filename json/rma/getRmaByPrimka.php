<?php

include_once '../../klase/checkLogin.php';
include_once '../../klase/radniNalog.php';
header('Content-type: application/json');
$rn=new rmaNalog();
$rn = $rn->RMAbyPrimka($_GET['primka']);
echo json_encode($rn, JSON_UNESCAPED_UNICODE);

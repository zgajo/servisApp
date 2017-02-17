<?php

include_once '../../klase/checkLogin.php';
include_once '../../klase/radniNalog.php';
header('Content-type: application/json');
$rn=new rmaNalog();
$rn = $rn->getById($_POST['id']);
echo json_encode($rn, JSON_UNESCAPED_UNICODE);

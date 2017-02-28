<?php


include_once '../../klase/checkLogin.php';
include_once '../../klase/radniNalog.php';
header('Content-type: application/json');
$od = new odobrenja();
if($od->svaOtvorena()) echo json_encode($od->svaOtvorena(), JSON_UNESCAPED_UNICODE);
else echo '{
    "sEcho": 1,
    "iTotalRecords": "0",
    "iTotalDisplayRecords": "0",
    "aaData": []
}';
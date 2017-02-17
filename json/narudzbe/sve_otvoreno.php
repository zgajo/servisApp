<?php

include_once '../../klase/checkLogin.php';
include_once '../../klase/narudzba.php';
header('Content-type: application/json');
$n = new narudzba();

echo json_encode($n->otvoreno(), JSON_UNESCAPED_UNICODE);




<?php

include_once '../../checkLogin.php';
include_once '../../klase/narudzba.php';

$n = new narudzba();

echo json_encode($n->otvoreno(), JSON_UNESCAPED_UNICODE);




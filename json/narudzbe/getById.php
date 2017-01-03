<?php

include_once '../../checkLogin.php';
include_once '../../klase/narudzba.php';

$n = new narudzba();
echo json_encode($n->getById($_POST["id"]), JSON_UNESCAPED_UNICODE);





<?php

include_once '../../checkLogin.php';
include_once '../../klase/narudzba.php';

$n = new narudzba();
$n->zatvori($_POST['id']);

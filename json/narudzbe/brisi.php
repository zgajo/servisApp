<?php

include_once '../../klase/checkLogin.php';
include_once '../../klase/narudzba.php';

$n = new narudzba();
$n->brisi($_POST['id']);
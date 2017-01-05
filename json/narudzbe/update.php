<?php

include_once '../../checkLogin.php';
include_once '../../klase/narudzba.php';

$n = new narudzba();
$n->update($_POST['dio'], $_POST['dob'], $_POST['pn'], $_POST['vpc'], $_POST['skl'],  $_POST['p'], $_POST['id']);




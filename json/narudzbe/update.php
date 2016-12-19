<?php

include_once '../../checkLogin.php';
include_once '../../klase/narudzba.php';

$n = new narudzba();
$n->insert($_POST['dio'], $_POST['dob'], $_POST['pn'], $_POST['vpc'], $_POST['skl'], $_POST['s'], $_POST['p'], $_POST['zavrsi'], $_POST['n']);




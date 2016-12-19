<?php

include_once '../../checkLogin.php';
include_once '../../klase/narudzba.php';
include_once '../../klase/osoba.php';

$n = new narudzba();

if(!empty($_POST['stranka_id'])){

$n->insert($_POST['dio'], $_POST['dob'], $_POST['pn'], $_POST['vpc'], $_POST['skl'], $_POST['stranka_id'], $_POST['p']);


}else{
 //unesi kupca pa primku
     $stranka = new stranka();
     $last_stranka = $stranka->insert($_POST['tvrtka'], $_POST['ime'], $_POST['prezime'], $_POST['adresa'], $_POST['grad'], $_POST['post_broj'], $_POST['kontakt_broj'], $_POST['email']);
     $n->insert($_POST['dio'], $_POST['dob'], $_POST['pn'], $_POST['vpc'], $_POST['skl'], $last_stranka, $_POST['p']);
}
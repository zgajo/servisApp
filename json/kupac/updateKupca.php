<?php
include_once '../../checkLogin.php';
include_once '../../klase/osoba.php';

 $stranka = new stranka();
$stranka->update($_POST['tvrtka'], $_POST['ime'], $_POST['prezime'], $_POST['adresa'], $_POST['grad'], $_POST['pb'], $_POST['kontakt'], $_POST['email'],$_POST['id'] );


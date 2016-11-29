<?php
include_once '../../checkLogin.php';
include_once '../../klase/primka.php';
include_once '../../klase/osoba.php';

$primka=new primka();

if(!empty($_POST['stranka_id'])){
    // Unesi primku
    $last = $primka->insertPrimka($_COOKIE['centar'], $_POST['sifra'], $_POST['brand'], $_POST['tip'], $_POST['naziv'], $_POST['serijski'], $_POST['opis'], $_POST['prilozeno'], $_POST['racun'], "Zaprimljeno", $_POST['dk'], $_COOKIE['id'], $_POST['stranka_id']);
    echo json_encode($last, JSON_UNESCAPED_UNICODE);
    
    
}else{
    //unesi kupca pa primku
     $stranka = new stranka();
     $last_stranka = $stranka->insert($_POST['tvrtka'], $_POST['ime'], $_POST['prezime'], $_POST['adresa'], $_POST['grad'], $_POST['post_broj'], $_POST['kontakt_broj'], $_POST['email']);
     $last = $primka->insertPrimka($_COOKIE['centar'], $_POST['sifra'], $_POST['brand'], $_POST['tip'], $_POST['naziv'], $_POST['serijski'], $_POST['opis'], $_POST['prilozeno'], $_POST['racun'], "Zaprimljeno", $_POST['dk'], $_COOKIE['id'], $last_stranka);
     echo json_encode($last, JSON_UNESCAPED_UNICODE); 
}


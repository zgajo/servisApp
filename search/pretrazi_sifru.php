<?php

include_once '../klase/checkLogin.php';

if (isset($_POST['value'])){ 
$value = (int)$_POST['value'];

require_once '../klase/kon_sifra.php'; 
$db = kon();
$dat = pg_connect("host=".$db["host"]." port=".$db["port"]." dbname=".$db["db"]." user=".$db["name"]." password=".$db["pass"]."");

if($dat){
    $sql = "SELECT a.naziv, ab.naziv as brand, at.naziv as tip "
            . "FROM artikli a "
            . "LEFT JOIN artbrand ab ON ab.sifra = a.brand "
            . "LEFT JOIN arttipovi at ON at.sifra = a.tip "
            . "WHERE a.sifra = $value";
    
    $result = pg_query($dat, $sql);
    $result =  pg_fetch_object($result);
    
    header('Content-type: application/json');
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
   /* 
    var_dump(pg_fetch_object($result));
    die();*/
    
    
}
else{
    echo pg_last_error($dat);
    die();
}


}
?>
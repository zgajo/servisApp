<?php

include_once '../checkLogin.php';
include '../klase/database.php';
$conn = new database();

if (isset($_POST['value'])){ 
$value = $_POST['value'];

$query = $conn->getConnection()->prepare("SELECT p.primka_id, p.serial, p.naziv, p.datumZaprimanja, p.status "
        . "FROM primka p "
        
        . "WHERE p.serial LIKE  CONCAT(?,'%') LIMIT 1");

 if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $conn->getConnection()->errno . " " . $conn->getConnection()->error, E_USER_ERROR);
        }
        
        $query->bind_param("s", $value); 
        
        if($query->execute()) { 
           $query->bind_result($id, $serial, $uredaj, $z, $s);
           while($row = $query->fetch()){
               $result[] = array(
               "primka" => $id,
               "serijski" => $serial,
               "uredaj" => $uredaj,
               "zaprimljeno" => $z,
               "status" => $s
           );
           }
           
           $query->close();
           header('Content-type: application/json');
           echo json_encode($result, JSON_UNESCAPED_UNICODE);
           
       }


}
?>
<?php

include_once '../klase/checkLogin.php';
include '../klase/database.php';
$conn = new database();

if (isset($_POST['value'])){ 
$value = $_POST['value'];

$query = $conn->getConnection()->prepare("SELECT stranka_id, ime, prezime, tvrtka, adresa, grad FROM stranka WHERE ime LIKE  CONCAT(?,'%') OR prezime LIKE  CONCAT(?,'%') OR tvrtka LIKE  CONCAT(?,'%') LIMIT 5");

 if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $conn->getConnection()->errno . " " . $conn->getConnection()->error, E_USER_ERROR);
        }
        
        $query->bind_param("sss", $value,$value,$value); 
        
        if($query->execute()) { 
           $query->bind_result($id, $ime, $prezime, $tvrtka,$adresa, $grad);
           while($row = $query->fetch()){
               $result[] = array(
               "id" => $id,
               "ime" => $ime,
               "prezime" => $prezime,
               "tvrtka" =>$tvrtka,
                "adresa" => $adresa,
                "grad" => $grad
           );
           }
           
           $query->close();
           header('Content-type: application/json');
           echo json_encode($result, JSON_UNESCAPED_UNICODE);
           
       }


}
?>

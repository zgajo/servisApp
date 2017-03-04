<?php

include_once '../klase/checkLogin.php';
include '../klase/database.php';
$conn = new database();

if (isset($_POST['value'])){ 
$value = $_POST['value'];

$query = $conn->getConnection()->prepare("SELECT p.primka_id, s.ime, s.prezime, s.tvrtka "
        . "FROM primka p "
        . "LEFT JOIN stranka s ON  p.stranka_id= s.stranka_id "
        . "WHERE p.primka_id LIKE  CONCAT(?,'%') ORDER BY p.primka_id ASC  LIMIT 5");

 if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $conn->getConnection()->errno . " " . $conn->getConnection()->error, E_USER_ERROR);
        }
        
        $query->bind_param("i", $value); 
        
        if($query->execute()) { 
           $query->bind_result($id, $ime, $prezime, $tvrtka);
           while($row = $query->fetch()){

               $out = ($tvrtka) ? $id. ": $tvrtka: ". $ime. " ".  $prezime : $id. ": " . $ime. " ".  $prezime;

               $result[] = array(
                   "id" => $id,
               "value" => $out,
               "label" => $out
           );
           }
           
           $query->close();
           header('Content-type: application/json');
           echo json_encode($result, JSON_UNESCAPED_UNICODE);
           
       }


}
?>

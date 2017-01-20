<?php


include '../klase/database.php';
$conn = new database();

if (isset($_POST['value'])){ 
$value = $_POST['value'];

$query = $conn->getConnection()->prepare("SELECT p.primka_id, s.ime, s.prezime, s.tvrtka "
        . "FROM primka p "
        . "LEFT JOIN stranka s ON  p.stranka_id= s.stranka_id "
        . "WHERE p.primka_id LIKE  CONCAT(?,'%') ORDER BY p.primka_id ASC");

 if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $conn->getConnection()->errno . " " . $conn->getConnection()->error, E_USER_ERROR);
        }
        
        $query->bind_param("i", $value); 
        
        if($query->execute()) { 
           $query->bind_result($id, $ime, $prezime, $tvrtka);
           while($row = $query->fetch()){
               $result[] = array(
               "primka" => $id,
               "ime" => $ime,
               "prezime" => $prezime,
               "tvrtka" =>$tvrtka
           );
           }
           
           $query->close();
           header('Content-type: application/json');
           echo json_encode($result, JSON_UNESCAPED_UNICODE);
           
       }


}
?>
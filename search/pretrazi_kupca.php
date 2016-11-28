<?php


include '../klase/database.php';
$conn = new database();

if (isset($_POST['value'])){ 
$value = $_POST['value'];

$query = $conn->getConnection()->prepare("SELECT stranka_id, ime, prezime, tvrtka FROM stranka WHERE ime LIKE  CONCAT(?,'%') OR prezime LIKE  CONCAT(?,'%') OR tvrtka LIKE  CONCAT(?,'%')");

 if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $conn->getConnection()->errno . " " . $conn->getConnection()->error, E_USER_ERROR);
        }
        
        $query->bind_param("sss", $value,$value,$value); 
        
        if($query->execute()) { 
           $query->bind_result($id, $ime, $prezime, $tvrtka);
           while($row = $query->fetch()){
               $result[] = array(
               "id" => $id,
               "ime" => $ime,
               "prezime" => $prezime,
               "adresa" =>$tvrtka,
           );
           }
           
           $query->close();
           header('Content-type: application/json');
           echo json_encode($result, JSON_UNESCAPED_UNICODE);
           
       }


}
?>
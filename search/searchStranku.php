<?php

include '../klase/database.php';
$conn = new database();

if (isset($_POST['value'])){  #isset miče sve warninge, prvo provjerava dali je postavljena vrijednost pa ide dalje sa kodom
$value = $_POST['value'];
echo '<ul>';
$query = $conn->getConnection()->query("SELECT stranka_id, ime, prezime, tvrtka FROM stranka WHERE ime LIKE '$value%' OR prezime LIKE '$value%' OR tvrtka LIKE '$value%'");
$result = $query or die($conn->getConnection()->error()); 
while ($run = $result->fetch_array()){
    $id = $run['stranka_id'];
    $ime = $run['ime'];
    $prezime = $run['prezime'];
    $tvrtka = $run['tvrtka'];
    if($tvrtka != NULL) {echo '<li><a class="a" href="../primke.php?action=nova_primka&stranka_id=' .$id. '">'.$tvrtka.', '.$ime.' '.$prezime.' </a></li>';}
    else echo '<li><a class="a" href="../primke.php?action=nova_primka&stranka_id=' .$id. '">'.$ime.' '.$prezime.' </a></li>';
    
}
echo '</ul>';
}
?>
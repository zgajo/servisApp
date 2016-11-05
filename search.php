<?php

include './klase/database.php';
$conn = new database();

if (isset($_POST['value'])){  #isset miče sve warninge, prvo provjerava dali je postavljena vrijednost pa ide dalje sa kodom
$value = $_POST['value'];
echo '<ul>';
$query = $conn->getConnection()->query("SELECT id, ime, prezime FROM stranka WHERE ime LIKE '$value%' OR prezime LIKE '$value%'");
$result = $query or die($conn->getConnection()->error()); 
while ($run = $result->fetch_array()){
    $id = $run['id'];
    $ime = $run['ime'];
    $prezime = $run['prezime'];
    echo '<li><a class="a" href="nalozi_primke.php?action=nova_primka&stranka_id=' .$id. '">'.$ime.' '.$prezime.' </a></li>';
}
echo '</ul>';
}
?>
<?php
header('Content-type: application/json');
$myArray = array("firstName" => "Mikee" );
$json = json_encode($myArray);
echo $json;

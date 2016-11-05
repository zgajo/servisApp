<?php

if(!isset($_COOKIE['user'])&& !isset($_COOKIE['userId'])){
    header('Location: http://eurotrade.esy.es/login.php');
    exit();
}
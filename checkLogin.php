<?php

if(!isset($_COOKIE['user'])&& !isset($_COOKIE['id'])){
    header('Location: login.php');
    exit();
}
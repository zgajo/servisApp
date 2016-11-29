<?php

if(!isset($_COOKIE['user'])&& !isset($_COOKIE['userId'])){
    header('Location: login.php');
    exit();
}
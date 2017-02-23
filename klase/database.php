<?php

class database {

    private $mysqli;

    function __construct() {
        
        require_once 'kon.php'; 
        $db = kon();
        $this->mysqli = new mysqli($db['host'], $db['name'], $db['pass'], $db['db']);
        
        
        
        if (mysqli_connect_errno()) {
            die('DOGODILA SE GREŠKA: ' . mysqli_connect_error());
            exit();
        }
        $this->mysqli->set_charset('utf8');
               
    }

    public function getConnection() {
        return $this->mysqli;
    }

    

    public function logout() {
        
        // POSTAVLJAM COOKIE U PROŠLOST, I STAVLJAM usera KAO praznog
        $expire = time() - 60 * 60 * 24;
         unset($_COOKIE['user']);
        setcookie('user', '', $expire, '/', '', '', TRUE);
         unset($_COOKIE['id']);
        setcookie('id', '', $expire, '/', '', '', TRUE);
         unset($_COOKIE['odjel']);
        setcookie('odjel', '', $expire, '/', '', '', TRUE);
         unset($_COOKIE['centar']);
        setcookie('centar', '', $expire, '/', '', '', TRUE);
                
        header('Location: login.php');
        exit();
    }

}

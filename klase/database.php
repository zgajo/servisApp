<?php

class database {

    private $mysqli;

    function __construct() {
        $this->mysqli = new mysqli("mysql.hostinger.hr", "u273306295_euro", "casino12", "u273306295_euro");

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
        setcookie('user', '', $expire, '/', '', '', TRUE);
        setcookie('userId', '', $expire, '/', '', '', TRUE);
        setcookie('odjel', '', '/', '', '', TRUE);
        setcookie('centar', '', $expire, '/', '', '', TRUE);
                
        header('Location: http://eurotrade.esy.es/login.php');
        exit();
    }

}

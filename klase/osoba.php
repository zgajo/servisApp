<?php

include_once 'database.php';

abstract class osoba{
    private $ime, $prezime, $id ;
    
    
}



class djelatnik extends osoba{
    private $mysqli, $username, $password;
    
    
     function __construct() {
        $con = new database();
        $this->mysqli = $con->getConnection();
    }
    
    public function chkLogin($user, $pass) {

        $query = $this->mysqli->prepare("SELECT djelatnik_id, ime, prezime, odjel, p_centar FROM djelatnici WHERE username = ? AND lozinka = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }

        $query->bind_param('ss', $user, $pass);

        if ($query->execute()) {
            $query->store_result();
            if ($query->num_rows() == 1) {
                
                $query->bind_result($this->id, $this->ime, $this->prezime, $this->odjel ,$this->p_centar );
                $query->fetch();

                $expire = time() + 60 * 60 * 999999;
                setcookie('user', "$this->ime $this->prezime", $expire, '/', '', '', TRUE);
                setcookie('id', $this->id, $expire, '/', '', '', TRUE);
                setcookie('odjel', $this->odjel, $expire, '/', '', '', TRUE);
                setcookie('centar', $this->p_centar, $expire, '/', '', '', TRUE);

                $query->close();

                header('Location: http://eurotrade.esy.es/primke.php');
                exit();
            } else {
                $query->close();
                die('<script>alert("Nije pronađen korisnik")</script>');
            }
        } else {
            trigger_error(", ERROR: " . $conn->errno . " " . $conn->error, E_USER_ERROR);
            $query->close();
            exit();
        }
    }
    
    
    public function getDjelatnikById($id){
        $query = $this->mysqli->prepare("SELECT ime, prezime, odjel, p_centar FROM djelatnici WHERE djelatnik_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("i", $id);
        if($query->execute()){
            $query->bind_result($this->ime, $this->prezime, $odjel, $centar);
            $query->fetch();
            
            $query->close();
            $result = array(
                "ime" => $this->ime,
                "prezime" => $this->prezime,
                "odjel" => $odjel,
                "centar" => $centar
                );
            return $result;
        }
        
        
        
    }
    
    public function izmijeniCentar($centar, $id) {
        
        $query = $this->mysqli->prepare("UPDATE djelatnici SET p_centar = ? WHERE djelatnik_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("si", $centar, $id);
        $query->execute();
        
        $expire = time() - 60 * 60 * 24;
        setcookie('centar', "", $expire, '/', '', '', TRUE);
        
        $expire = time() + 60 * 60 * 99999;
        setcookie('centar', $centar, $expire, '/', '', '', TRUE);
        
        $query->close();
    }
}



class stranka extends osoba{
    private  $mysqli, $grad, $adresa, $post_broj, $kontakt_broj, $email;
            
    function __construct() {
        $con = new database();
        $this->mysqli = $con->getConnection();
    }
    
    public function insert($tvrtka, $ime,$prezime,$adresa=NULL, $grad=NULL,$post_broj=null, $kontakt_broj=NULL, $email=NULL){
        
        $query = $this->mysqli->prepare("INSERT INTO stranka(tvrtka, ime, prezime, adresa, grad, postBroj,kontaktBroj, email) VALUES(?,?,?,?,?,?,?,?)");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('sssssiss',$tvrtka, $ime,$prezime,$adresa, $grad,$post_broj, $kontakt_broj, $email);
        
        if($query->execute()) { $query->close(); return  $this->mysqli->insert_id; }
        
        else {$query->close(); die("NIJE USPJEŠNO UNEŠENO U BAZU: STRANKA");}
       
    }
    
    public function getById($id) {
        $query = $this->mysqli->prepare("SELECT ime, prezime, adresa, grad, postBroj,kontaktBroj, email FROM stranka WHERE stranka_id = ? ");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('i', $id);
        
       if($query->execute()) { 
           $query->bind_result($ime, $prezime, $adresa, $grad, $postanski_broj, $kontakt, $email);
           $query->fetch();
           
           $result = array(
               "id" => $id,
               "ime" => $ime,
               "prezime" => $prezime,
               "adresa" =>$adresa,
               "grad" =>$grad,
               "postanskiBroj" => $postanski_broj,
               "kontakt" => $kontakt,
               "email" => $email
           );
           
           $query->close();
           return $result;
           
       }
        
        else {$query->close(); die("NIJE PRONAĐEN KUPAC");}
        
        
    }
    
    
    
    
}
  
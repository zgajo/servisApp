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
        $pass = hash("sha256", $pass);
        
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

                $expire = time() + 60 * 60;
                setcookie("user", "$this->ime $this->prezime", time()+3600, '/', '', '', TRUE);
                setcookie("id", $this->id, time()+3600, '/', '', '', TRUE);
                setcookie("odjel", $this->odjel, time()+3600, '/', '', '', TRUE);
                
               
                
                // KORISTITI UNUTAR EUROTRADE
                 $host= gethostname();
                $ip = gethostbyname($host);
                $ip = substr($ip, 8,2);
                
                switch ($ip){
                    
                    case 10:
                        setcookie("centar", "Zagreb", time()+3600, '/', '', '', TRUE);
                        break;
                    case 20:
                        setcookie("centar", "Split", time()+3600, '/', '', '', TRUE);
                        break;
                    case 30:
                        setcookie("centar", "Rijeka Andrea", time()+3600, '/', '', '', TRUE);
                        break;
                    case 40:
                        setcookie("centar", "Varaždin", time()+3600, '/', '', '', TRUE);
                        break;
                    case 50:
                        setcookie("centar", "Osijek", time()+3600, '/', '', '', TRUE);
                        break;
                    case 60:
                        setcookie("centar", "Sisak", time()+3600, '/', '', '', TRUE);
                        break;
                    case 70:
                        setcookie("centar", "Pula", time()+3600, '/', '', '', TRUE);
                        break;
                    case 80:
                        setcookie("centar", "Rijeka Korzo", time()+3600, '/', '', '', TRUE);
                        break;
                    case 90:
                        setcookie("centar", "Rovinj", time()+3600, '/', '', '', TRUE);
                        break;
                    
                }
                //  * KRAJ KORISTITI UNUTAR EUROTRADEA
                
                /*  KORISTITI VAN EUROTRADEA
                setcookie("centar", $this->p_centar, time()+3600, '/', '', '', TRUE);
                */
                
                $query->close();
                header('Location: ./primke.php');
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
// -----------  KRAJ DJELATNIKA -------------//



// ----------   STRANKA  ------------//
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
        $query = $this->mysqli->prepare("SELECT tvrtka, ime, prezime, adresa, grad, postBroj,kontaktBroj, email FROM stranka WHERE stranka_id = ? ");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('i', $id);
        
       if($query->execute()) { 
           $query->bind_result($tvrtka, $ime, $prezime, $adresa, $grad, $postanski_broj, $kontakt, $email);
           $query->fetch();
           
           $result = array(
               "id" => $id,
               "tvrtka" => $tvrtka,
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
    
    public function update($tvrtka, $ime,$prezime,$adresa=NULL, $grad=NULL,$post_broj=null, $kontakt_broj=NULL, $email=NULL, $id){
        
        $query = $this->mysqli->prepare("UPDATE stranka SET tvrtka = ?, ime = ?, prezime = ?, adresa = ?, grad = ?, postBroj = ?,kontaktBroj = ?, email = ? "
                . "WHERE stranka_id = ?");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('sssssissi',$tvrtka, $ime,$prezime,$adresa, $grad,$post_broj, $kontakt_broj, $email,$id);
        
        if($query->execute()) { $query->close(); }
        
        else {$query->close(); die("NIJE USPJEŠNO UNEŠENO U BAZU: STRANKA");}
       
    }
    
    
    public function primkaByKupac($id) {
        $query = $this->mysqli->prepare("SELECT s.*, "
                . "p.primka_id, p.naziv, p.datumZaprimanja, p.datumZatvaranja, p.opisKvara,p.status, p.serial  "
                . "FROM stranka s "
                . "LEFT JOIN primka p ON s.stranka_id = p.stranka_id "
                . "WHERE s.stranka_id = ?  ORDER BY p.primka_id DESC");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("i", $id); 
        
        if($query->execute()){
            $meta = $query->result_metadata(); 
            while ($field = $meta->fetch_field()) 
        { 
            $params[] = &$row[$field->name]; 
        } 

        call_user_func_array(array($query, 'bind_result'), $params); 

        while ($query->fetch()) { 
            foreach($row as $key => $val) 
            { 
                $c[$key] = $val; 
            } 
            $result[] = $c; 
        } 
        
        $query->close(); 
        return $result;

        
        } 
        
        
    }
    
    
    
}
  
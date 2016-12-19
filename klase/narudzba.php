<?php
include_once 'database.php';


class narudzba{
    
    private $mysqli;
            function __construct() {
        $con = new database();
        $this->mysqli = $con->getConnection();
    }
    
    public function insert($pro, $dob, $pn, $vpc, $skl, $s, $p = NULL){
        
        date_default_timezone_set('Europe/Zagreb');
        $naruceno = date('Y-m-d H:i:s', time());
        
        $query = $this->mysqli->prepare("INSERT INTO narudzbe (naruceno, dio, dobavljac, pn, vpc, skl, stranka_id, primka_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        $query->bind_param("ssssssii", $naruceno, $pro, $dob, $pn, $vpc, $skl, $s, $p);
        
        if($query->execute()) { $query->close(); return $this->mysqli->insert_id;;}
        
        else {$query->close(); die("NIJE USPJEŠNO UNEŠENO U BAZU: Narudzba");}
        
        
    }
    
    public function update($pro, $dob, $pn, $vpc, $skl, $s = NULL, $p = NULL, $zavrsi = NULL, $n){
        date_default_timezone_set('Europe/Zagreb');
        
        // UKOLIKO JE STIGLA NARUDŽBA
        if($zavrsi == "zavrsi") {
            
            $zavrsi = date('Y-m-d H:i:s', time());
            $query = $this->mysqli->prepare("UPDATE narudzbe SET "
                . "dio = ?, "
                . "dobavljac = ?, "
                . "pn = ?, "
                . "vpc = ?, "
                . "skl = ?, "
                . "stranka_id = ?, "
                . "primka_id = ?, "
                . "stiglo = ? "
                . "WHERE narudzbe_id = ?");
            
            if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        $query->bind_param("sssssiisi", $pro, $dob, $pn, $vpc, $skl, $s, $p, $zavrsi, $n);
        
        } // KRAJ   *    UKOLIKO JE STIGLA NARUDŽBA *   KRAJ
        
        else{
            $query = $this->mysqli->prepare("UPDATE narudzbe SET "
                . "dio = ?, "
                . "dobavljac = ?, "
                . "pn = ?, "
                . "vpc = ?, "
                . "skl = ?, "
                . "stranka_id = ?, "
                . "primka_id = ? "
                . "WHERE narudzbe_id = ?");
            
            if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        $query->bind_param("sssssiii", $pro, $dob, $pn, $vpc, $skl, $s, $p, $n);
        
        }
        
        if($query->execute()) { $query->close(); return;}
        
        else {$query->close(); die("NIJE USPJEŠNO UNEŠENO U BAZU: Narudzba");}
        
    }
    
}
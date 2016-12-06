<?php
include_once 'database.php';


class primka{
    
    private $mysqli;
    
    function __construct() {
        $con = new database();
        $this->mysqli = $con->getConnection();
    }
    
    public function insertPrimka($centar, $sifra=NULL, $brand=NULL, $tip=NULL, $naziv, $serijski=NULL, $opisKvara, $prilozeno_primijeceno=NULL, $racun=NULL, $status, $dk, $djelatnik_otvorio_id, $stranka_id){
        date_default_timezone_set('Europe/Zagreb');
        $zaprimljeno = date('Y-m-d H:i:s', time());
        $datum_kupnje = date('Y-m-d', strtotime($dk));
        
        $query = $this->mysqli->prepare("INSERT INTO primka(centar, sifraUredaja, brand, tip, naziv, serial, datumZaprimanja, opisKvara, prilozeno_primijeceno, racun, status, datumKupnje, djelatnik_otvorio_id, stranka_id)"
                . "VALUES (?, ?, ?,?,?,?,?,?,?,?,?,?,?,?) ");
        
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("sissssssssssii", $centar, $sifra, $brand, $tip, $naziv, $serijski, $zaprimljeno,$opisKvara, $prilozeno_primijeceno, $racun, $status, $datum_kupnje, $djelatnik_otvorio_id, $stranka_id);
        
        if($query->execute()) { $query->close(); return $this->mysqli->insert_id;}
        
        else {$query->close(); die("NIJE USPJEŠNO UNEŠENO U BAZU: Primka");}
    }
    
    
    
    
    
    public function svePrimke() {
        $query = $this->mysqli->query("SELECT p.*, s.ime as s_ime, s.prezime as s_prezime, s.tvrtka FROM primka p 
                                        LEFT JOIN stranka s ON  p.stranka_id = s.stranka_id
                                        WHERE p.status != 'Kupac preuzeo' 
                                        AND p.status != 'Poslano u CS - Rovinj'  
                                        AND p.status != 'Poslano u CS - Rovinj / Započelo servisiranje'  
                                        AND p.status != 'Poslano u CS - Rovinj / Čeka dio' 
                                        and p.centar LIKE '".$_COOKIE['centar']."'
                                        ORDER BY p.primka_id ASC");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        while($row = $query->fetch_object()){
            $result[]  = $row;
        }
        
        return $result;
    }
    
    public function svePrimkeRNServis() {
        $query = $this->mysqli->query("SELECT p.*, s.ime as s_ime, s.prezime as s_prezime, s.tvrtka FROM primka p 
                                        LEFT JOIN stranka s ON  p.stranka_id = s.stranka_id
                                        WHERE p.status != 'Kupac preuzeo' 
                                        
                                        ORDER BY p.primka_id ASC");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        while($row = $query->fetch_object()){
            $result[]  = $row;
        }
        
        return $result;
    }
    
    public function svePrimkeRN() {
        $query = $this->mysqli->query("SELECT p.*, s.ime as s_ime, s.prezime as s_prezime, s.tvrtka FROM primka p 
                                        LEFT JOIN stranka s ON  p.stranka_id = s.stranka_id
                                        WHERE p.status != 'Kupac preuzeo' 
                                        and p.centar LIKE '".$_COOKIE['centar']."'
                                        ORDER BY p.primka_id ASC");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        while($row = $query->fetch_object()){
            $result[]  = $row;
        }
        
        return $result;
    }
    
    
       public function svePoslanePrimke() {
        $query = $this->mysqli->query("SELECT p.*, s.ime as s_ime, s.prezime as s_prezime, s.tvrtka FROM primka p 
                                        LEFT JOIN stranka s ON  p.stranka_id = s.stranka_id
                                        WHERE p.status != 'Kupac preuzeo' AND 
                                       ( p.status = 'Poslano u CS - Rovinj'  
                                        OR p.status = 'Poslano u CS - Rovinj / Započelo servisiranje'  
                                        OR p.status = 'Poslano u CS - Rovinj / Čeka dio') 
                                        ORDER BY p.primka_id ASC");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        while($row = $query->fetch_object()){
            $result[]  = $row;
        }
        
        return $result;
    }
    
    
    
    public function getById($id){
         $query=$this->mysqli->prepare("SELECT p.status as p_status, p.*,  s.*, 
                                           
                                            pdo.ime as pot_ime, pdo.prezime as pot_prezime , 
                                            pdz.ime as pzt_ime, pdz.prezime as pzt_prezime 
                                            FROM primka p
                                            LEFT JOIN djelatnici pdo on p.djelatnik_otvorio_id = pdo.djelatnik_id
                                            LEFT JOIN djelatnici pdz on p.djelatnik_zatvorio_id = pdz.djelatnik_id
                                            left JOIN stranka s ON p.stranka_id = s.stranka_id
                                        WHERE p.primka_id = ?");
        
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
    
    public function getByIdRN($id){
        $query=$this->mysqli->prepare("SELECT p.primka_id as id, p.*, p.status as p_status, rn.status as status_rn, rn.*, s.*, 
                                            rndo.ime as zapoceoRn_ime, rndo.prezime as zapoceoRn_prezime, 
                                            rndz.ime as zavrsioRn_ime, rndz.prezime as zavrsioRn_prezime, 
                                            pdo.ime as pot_ime, pdo.prezime as pot_prezime 
                                            FROM primka p
                                            LEFT JOIN radniNaloziServisa rn on rn.primka_id = p.primka_id
                                            LEFT JOIN djelatnici rndo on rn.djelatnik_zapoceoRn_id = rndo.djelatnik_id
                                            LEFT JOIN djelatnici rndz on rn.djelatnik_zavrsioRn_id = rndz.djelatnik_id
                                            LEFT JOIN djelatnici pdo on p.djelatnik_otvorio_id = pdo.djelatnik_id 
                                            left JOIN stranka s ON p.stranka_id = s.stranka_id
                                        WHERE p.primka_id = ? ORDER BY p.primka_id ASC,  rn.rn_id  ASC");
        
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
    
    
    
    public function updatePrimka($su,$b, $t, $n, $s, $ok, $pp, $r, $dk, $id) {
        $dk=date("Y-m-d" , strtotime($dk));
        $query = $this->mysqli->prepare("UPDATE primka SET sifraUredaja = ?,brand=?,tip=?,naziv=?, "
                . "serial=?,opisKvara=?, prilozeno_primijeceno=?, racun=?, datumKupnje=?   WHERE primka_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        $query->bind_param('issssssssi', $su,$b, $t, $n, $s, $ok, $pp, $r, $dk, $id);
        ($query->execute()) ? $query->close(): die('Neuspješno ažuriranje statusa primke');
        
        
    }
    
    
    public function zatvori($pid, $did, $status){
        
        date_default_timezone_set('Europe/Zagreb');
        $zatvori = date('Y-m-d H:i:s', time());
        
        $query = $this->mysqli->prepare("UPDATE primka SET datumZatvaranja = ?, djelatnik_zatvorio_id = ?, status = ? WHERE primka_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        $query->bind_param('sisi', $zatvori, $did, $status, $pid);
        ($query->execute()) ? $query->close(): die('Neuspješno ažuriranje statusa primke');
        
        
    }
    
    
    public function azurirajStatus($status, $id) {
        $query = $this->mysqli->prepare("UPDATE primka SET status = ? WHERE primka_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        $query->bind_param('si', $status, $id);
        ($query->execute()) ? $query->close(): die('Neuspješno ažuriranje statusa primke');
    }
    
    public function isprintajID(){
        $query = $this->mysqli->query("SELECT primka_id FROM primka");
        while($row  = $query->fetch_object()){
            $result[] = $row;
        }
        return $result;
    }
    
    
    
}
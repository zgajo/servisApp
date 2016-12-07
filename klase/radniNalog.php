<?php
include_once 'database.php';

abstract class RN{
    
    protected $id,$naplata, $danZaprimanja, $danZavrsetka, $opisPopravka, $napomena, $primka_id, $djelatnik_otvorio_id, $djelatnik_zatvorio_id, $mysqli;
   function __construct() {
        $con = new database();
        $this->mysqli = $con->getConnection();
    }
        
}


class rmaNalog extends RN{
    
    
    
    public function insert($p, $d){
        
        date_default_timezone_set('Europe/Zagreb');
        $date = date('Y-m-d H:i:s', time());
        
        $query = $this->mysqli->prepare("INSERT INTO radniNaloziRMA(danZaprimanja, primka_id, djelatnik_zapoceoRma_id, status) VALUES (? , ?, ?, ?) ");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        $s = "Pripremljeno za slanje OS-u";
        $query->bind_param('siis',$date, $p, $d, $s);
        
        if($query->execute()) { $query->close(); return $this->mysqli->insert_id;}
        
        else {$query->close(); die("NIJE USPJEŠNO UNEŠENO U BAZU: Primka");}
        
    }
    
  
    
    
        public function update( $rma,  $status, $opisPopravka, $napomena, $naplata, $os, $r) {
        
        if($status === "Vraćeno is OS-a") {
            date_default_timezone_set('Europe/Zagreb');
            $vraceno = date('Y-m-d H:i:s', time());
            
            $query = $this->mysqli->prepare("UPDATE radniNaloziRMA SET vracenoIzOSa = ?, status = ?, napomena = ?, opisPopravka = ?, naplata = ?, rnOS=?, nazivOS=? WHERE rma_id = ?");
            if($query === false){
                trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
            }

            $query->bind_param('sssssssi',$vraceno, $status, $napomena, $opisPopravka, $naplata, $r, $os, $rma);
            
        }
        else{
            $query = $this->mysqli->prepare("UPDATE radniNaloziRMA SET status = ?, napomena = ?, opisPopravka = ?, naplata = ?, rnOS=?, nazivOS=? WHERE rma_id = ?");
            if($query === false){
                trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
            }

            $query->bind_param('ssssssi',$status, $napomena, $opisPopravka, $naplata, $r, $os, $rma);
        }
        
        
        if($query->execute()){
            $query->close();
        }
        else{
             $query->close();
        die("Neuspješno ažuriranje radnog naloga");
        }
       
    }
    
    
     public function zatvori($rma,  $status, $opisPopravka, $napomena, $naplata, $os, $r, $djelatnik_id) {
        date_default_timezone_set('Europe/Zagreb');
        $zatvori = date('Y-m-d H:i:s', time());
        
        $query = $this->mysqli->prepare("UPDATE radniNaloziRMA SET status = ?, napomena = ?, opisPopravka = ?, naplata = ?, rnOS=?, nazivOS=?, danZavrsetka = ?, djelatnik_zavrsioRma_id = ? WHERE rma_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('sssssssii',$status, $napomena, $opisPopravka, $naplata, $r, $os, $zatvori, $djelatnik_id, $rma);
        
       if($query->execute()){
            $query->close();
        }
        else{
             $query->close();
        die("Neuspješno zatvaranje radnog naloga");
        }
        
    }
    
    
    
    public function posalji( $rma,  $status, $opisPopravka, $napomena, $naplata, $os, $r, $did) {
        
        date_default_timezone_set('Europe/Zagreb');
        $date = date('Y-m-d H:i:s', time());
        
        $query = $this->mysqli->prepare("UPDATE radniNaloziRMA SET status = ?, napomena = ?, opisPopravka = ?, naplata = ?, rnOS=?, nazivOS=?,  poslanoOSu=?, djelatnik_zapoceoRma_id = ? WHERE rma_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('sssssssii',$status, $napomena, $opisPopravka, $naplata, $r, $os, $date, $did, $rma);
        
        if($query->execute()){
            $query->close();
        }
        else{
             $query->close();
        die("Neuspješno ažuriranje radnog naloga");
        }
       
        
    }
    
    public function RMAbyPrimka($p) {
        
        $query=$this->mysqli->prepare("SELECT rma.rma_id, rma.status,  rma.napomena, rma.poslanoOSu, rma.rnOS, "
                . "rma.nazivOS, rma.naplata, rma.danZaprimanja,  rma.opisPopravka, rma.danZavrsetka, "
                . "do.ime as doi, do.prezime as dop, dz.ime as dzi, dz.prezime as dzp "
                . "FROM radniNaloziRMA rma "
                . "LEFT JOIN djelatnici do ON rma.djelatnik_zapoceoRma_id = do.djelatnik_id "
                . "LEFT JOIN djelatnici dz ON rma.djelatnik_zavrsioRma_id = dz.djelatnik_id "
                . "WHERE primka_id=? ORDER BY rma.rma_id");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("i", $p); 
        
        if($query->execute()){
            
            $query->bind_result($this->id, $status,  $napomena, $poslano, $r, $os, $naplata, $prip, $opis, $zavrseno, $oime, $oprezime, $zime, $zprezime);
            while($row = $query->fetch()){
                $rma[] = array(
                    "id" => $this->id,
                    "status" => $status,
                    "napomena" => $napomena,
                    "poslano" => $poslano,
                    "rnOs" => $r,
                    "naplata" => $naplata,
                    "pripremljeno" => $prip,
                    "opis" => $opis,
                    "zavrseno" => $zavrseno,
                    "nazivOS" => $os,
                    "doime" => $oime,
                    "doprezime" => $oprezime,
                    "dzime" => $zime,
                    "dzprezime" => $zprezime
                    );
            }
            $query->close();
            if(isset($rma)) return $rma;
            
        
        }else{
             $query->close();
        die("Neuspješno dohvaćanje rma naloga po primci");
        } 
        
    }
    
    public function getById($id){
        $query=$this->mysqli->prepare("SELECT rma.*,  rnd1.ime as zapoceoRn_ime, rnd1.prezime as zapoceoRn_prezime,  rnd2.ime as zavrsioRn_ime, rnd2.prezime as zavrsioRn_prezime 
                                             FROM radniNaloziRMA rma 
                                            LEFT JOIN djelatnici rnd1 on rma.djelatnik_zapoceoRma_id = rnd1.djelatnik_id 
                                            LEFT JOIN djelatnici rnd2 on rma.djelatnik_zavrsioRma_id = rnd2.djelatnik_id 
                                        WHERE rma.rma_id = ?");
        
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
    
    public function RMAjoinPrimkaOtvorenUredi($id){
        $query=$this->mysqli->prepare("SELECT rma.*, p.*, s.*, rma.status as status_rma, 
                                            rnd1.ime as zapoceoRMA_ime, rnd1.prezime as zapoceoRMA_prezime, rnd2.ime as zavrsioRMA_ime, rnd2.prezime as zavrsioRMA_prezime, 
                                            pdo.ime as pot_ime, pdo.prezime as pot_prezime , pdz.ime as pzt_ime, pdz.prezime as pzt_prezime 
                                            FROM radniNaloziRMA rma
                                            LEFT JOIN primka p on rma.primka_id = p.primka_id
                                            LEFT JOIN djelatnici rnd1 on rma.djelatnik_zapoceoRma_id = rnd1.djelatnik_id
                                            LEFT JOIN djelatnici rnd2 on rma.djelatnik_zavrsioRma_id = rnd2.djelatnik_id
                                            LEFT JOIN djelatnici pdo on p.djelatnik_otvorio_id = pdo.djelatnik_id
                                            LEFT JOIN djelatnici pdz on p.djelatnik_zatvorio_id = pdz.djelatnik_id
                                            left JOIN stranka s ON p.stranka_id = s.stranka_id
                                        WHERE rma.rma_id = ?");
        
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



class servisRN extends RN{
    
    private $pocetakRada; 
    
    
    public function insert($primka_id, $djelatnik_otvorio_id) {
        
        date_default_timezone_set('Europe/Zagreb');
        $date = date('Y-m-d H:i:s', time());
        
        $this->danZaprimanja = $date;
        $this->primka_id = $primka_id;
        $this->djelatnik_otvorio_id  = $djelatnik_otvorio_id;
                
        $query = $this->mysqli->prepare("INSERT INTO radniNaloziServisa(pocetakRada, primka_id, djelatnik_zapoceoRn_id) VALUES (?,?,?)");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('sii', $this->danZaprimanja, $this->primka_id, $this->djelatnik_otvorio_id);
           
        if($query->execute()){
            $query->close();
            return $this->mysqli->insert_id;
        }
        else{
         $query->close();
        die("Neuspješno otvaranje Radnog Naloga");   
        }
        
    }
    
    /**
     * 
     * @param type $napomena
     * @param type $rnID
     * @param type $primkaId
     * 
     * Unos Napomene
     * 
     */
    public function update( $rnID,  $status, $opisPopravka, $napomena, $naplata) {
        
        
        $query = $this->mysqli->prepare("UPDATE radniNaloziServisa SET status = ?, napomena = ?, opisPopravka = ?, naplata = ? WHERE rn_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('ssssi',$status, $napomena, $opisPopravka, $naplata, $rnID);
        
        if($query->execute()){
            $query->close();
        }
        else{
             $query->close();
        die("Neuspješno ažuriranje radnog naloga");
        }
       
        
    }
    
    /**
     * 
     * @param type $rnID
     * @param type $primkaId
     * @param type $opisPopravka
     * @param type $danZavrsetka
     * @param type $naplata
     * @param type $djelatnik_zatvorio_id
     * 
     * Zatvaranje radnog naloga
     * 
     */
    public function zatvoriRN( $rnID,  $status, $opisPopravka, $napomena, $naplata, $djelatnik_id) {
        date_default_timezone_set('Europe/Zagreb');
        $zatvori = date('Y-m-d H:i:s', time());
        
        $query = $this->mysqli->prepare("UPDATE radniNaloziServisa SET status = ?, napomena = ?, opisPopravka = ?, naplata = ?, danZavrsetka = ?, djelatnik_zavrsioRn_id = ? WHERE rn_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('sssssii',$status, $napomena, $opisPopravka, $naplata, $zatvori, $djelatnik_id, $rnID);
        
       if($query->execute()){
            $query->close();
        }
        else{
             $query->close();
        die("Neuspješno zatvaranje radnog naloga");
        }
        
    }
    
    
    
    public function RNbyPrimka($id) {
       
        
        $query=$this->mysqli->prepare("SELECT rn.rn_id, rn.status, rn.pocetakRada, rn.danZavrsetka, rn.opisPopravka, rn.naplata, rn.napomena, rn.promijenjeno, d1.ime, d1.prezime, d2.ime, d2.prezime "
                . "FROM radniNaloziServisa rn "
                . "LEFT JOIN djelatnici d1 ON rn.djelatnik_zapoceoRn_id = d1.djelatnik_id "
                . "LEFT JOIN djelatnici d2 ON rn.djelatnik_zavrsioRn_id = d2.djelatnik_id "
                . "WHERE primka_id=? ORDER BY rn.rn_id");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("i", $id); 
        
        if($query->execute()){
            $query->bind_result($this->id, $status, $pocetak, $dz, $op, $naplata, $napomena, $promijenjeno, $d1ime, $d1prezime,$d2ime, $d2prezime );
            while($row = $query->fetch()){
                $rn[] = array(
                    "id" => $this->id,
                    "status" => $status,
                    "pocetak" => $pocetak,
                    "zavrsetak" => $dz,
                    "opis" => $op,
                    "naplata" => $naplata,
                    "napomena" => $napomena,
                    "promijenjeno" => $promijenjeno,
                    "d1ime" => $d1ime,
                    "d1prezime" => $d1prezime,
                    "d2ime" => $d2ime,
                    "d2prezime" => $d2prezime
                    );
            }
            $query->close();
            if(isset($rn))return $rn;
        
        }else{
             $query->close();
        die("Neuspješno ažuriranje radnog naloga");
        } 
        
    }
    
    
    
    public function RNjoinPrimkaOtvorenUredi($id){
        $query=$this->mysqli->prepare("SELECT rn.*, p.*, s.*, rn.status as status_rn, 
                                            rnd1.ime as zapoceoRn_ime, rnd1.prezime as zapoceoRn_prezime, rnd2.ime as zavrsioRn_ime, rnd2.prezime as zavrsioRn_prezime, 
                                            pdo.ime as pot_ime, pdo.prezime as pot_prezime , pdz.ime as pzt_ime, pdz.prezime as pzt_prezime 
                                            FROM radniNaloziServisa rn
                                            LEFT JOIN primka p on rn.primka_id = p.primka_id
                                            LEFT JOIN djelatnici rnd1 on rn.djelatnik_zapoceoRn_id = rnd1.djelatnik_id
                                            LEFT JOIN djelatnici rnd2 on rn.djelatnik_zavrsioRn_id = rnd2.djelatnik_id
                                            LEFT JOIN djelatnici pdo on p.djelatnik_otvorio_id = pdo.djelatnik_id
                                            LEFT JOIN djelatnici pdz on p.djelatnik_zatvorio_id = pdz.djelatnik_id
                                            left JOIN stranka s ON p.stranka_id = s.stranka_id
                                        WHERE rn.rn_id = ?");
        
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
    
    public function getById($id){
        $query=$this->mysqli->prepare("SELECT rn.*, 
                                            rnd1.ime as zapoceoRn_ime, rnd1.prezime as zapoceoRn_prezime, 
                                            rnd2.ime as zavrsioRn_ime, rnd2.prezime as zavrsioRn_prezime
                                             FROM radniNaloziServisa rn
                                            
                                            LEFT JOIN djelatnici rnd1 on rn.djelatnik_zapoceoRn_id = rnd1.djelatnik_id
                                            LEFT JOIN djelatnici rnd2 on rn.djelatnik_zavrsioRn_id = rnd2.djelatnik_id
                                        WHERE rn.rn_id = ?");
        
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

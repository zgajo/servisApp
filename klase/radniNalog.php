<?php
include_once 'database.php';

abstract class RN{
    
    protected $id,$naplata, $danZaprimanja, $danZavrsetka, $opisPopravka, $napomena, $primka_id, $djelatnik_otvorio_id, $djelatnik_zatvorio_id;
        
}


class rmaNalog{
    private $pocetakRada, $mysqli; 
    
    function __construct() {
        $con = new database();
        $this->mysqli = $con->getConnection();
    }
    
    public function insert($primka, $djelatnik_otvorio){
        
    }
}



class servisRN extends RN{
    
    private $pocetakRada, $mysqli; 
    
    function __construct() {
        $con = new database();
        $this->mysqli = $con->getConnection();
    }
    
    public function insertRN($primka_id, $djelatnik_otvorio_id) {
        
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
     * @param type $pocetakRada
     * @param type $rnID
     * @param type $primkaId
     * 
     * Unosi se prilikom početka radnog naloga
     * 
     */
    public function zapocniRadRN($pocetakRada, $rnID, $primkaId) {
        date_default_timezone_set('Europe/Zagreb');
        $pocetakRada = date('Y-m-d H:i:s', time());
        
        $this->pocetakRada = $pocetakRada;
        $this->id = $rnID;
        $this->primka_id = $primkaId;
        
        $query = $this->mysqli->prepare("UPDATE radniNaloziServisa SET pocetakRada = ? WHERE rn_id = ? AND primka_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('sii', $pocetakRada, $rnID, $primkaId);
        
        if($query->execute()){
            $query->close();
        };
        $query->close();
        die("Neuspješan početak Radnog naloga");
        
        
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
    
    public function sviRN() {
        
        $query = $this->mysqli->query("SELECT rn.*, rn.status as status_rn, d.ime, d.prezime 
                                        FROM radniNaloziServisa rn 
                                        LEFT JOIN primka p ON rn.primka_id = p.primka_id 
                                        LEFT JOIN djelatnici d ON rn.djelatnik_zapoceoRn_id = d.djelatnik_id 
                                        WHERE p.status != 'Kupac preuzeo' AND rn.status != 'Popravak završen u jamstvu' AND rn.status != 'Popravak završen van jamstva'
                                        ORDER BY p.primka_id ASC ");
        
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        while($row = $query->fetch_object()){
            $result[] = $row;
        }
        
        return $result;
        
    }
    
    
    public function RNbyPrimka($id) {
       
        
        $query=$this->mysqli->prepare("SELECT rn.rn_id, rn.status, rn.pocetakRada, rn.napomena,  d.ime, d.prezime "
                . "FROM radniNaloziServisa rn "
                . "LEFT JOIN djelatnici d ON rn.djelatnik_zapoceoRn_id = d.djelatnik_id "
                . "WHERE primka_id=? ORDER BY rn.rn_id");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("i", $id); 
        
        if($query->execute()){
            $query->bind_result($this->id, $status, $pocetak, $napomena, $ime, $prezime);
            while($row = $query->fetch()){
                $rn[] = array(
                    "id" => $this->id,
                    "status" => $status,
                    "pocetak" => $pocetak,
                    "napomena" => $napomena,
                    "ime" => $ime,
                    "prezime" => $prezime
                    );
            }
            $query->close();
            return $rn;
        
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
    
}

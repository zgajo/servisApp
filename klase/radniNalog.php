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
    
    
    
    public function posalji( $rma,  $status, $opisPopravka, $napomena, $naplata, $r, $os, $did) {
        
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
        
        $query=$this->mysqli->prepare("SELECT s.tvrtka, s.ime as s_ime, s.prezime as s_prezime, rma.rma_id, p.primka_id, p.sifraUredaja as sifra, p.serial as serijski, p.naziv as dio, p.brand as brand, p.datumZaprimanja, rma.status,  rma.napomena, rma.poslanoOSu, rma.rnOS, "
                . "rma.nazivOS, rma.naplata, rma.danZaprimanja,  rma.opisPopravka, rma.danZavrsetka, "
                . "do.ime as doi, do.prezime as dop, dz.ime as dzi, dz.prezime as dzp "
                . "FROM radniNaloziRMA rma "
                . "LEFT JOIN primka p ON rma.primka_id = p.primka_id "
                . "LEFT JOIN stranka s ON p.stranka_id = s.stranka_id "
                . "LEFT JOIN djelatnici do ON rma.djelatnik_zapoceoRma_id = do.djelatnik_id "
                . "LEFT JOIN djelatnici dz ON rma.djelatnik_zavrsioRma_id = dz.djelatnik_id "
                . "WHERE rma.primka_id=? ORDER BY rma.rma_id");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("i", $p); 
        
        if($query->execute()){
            
            $query->bind_result( $st, $si, $sp,$this->id, $pr, $sifra, $ser, $dio, $brand, $datumZaprimanja, $status,  $napomena, $poslano, $r, $os, $naplata, $prip, $opis, $zavrseno, $oime, $oprezime, $zime, $zprezime);
            while($row = $query->fetch()){
                $rma[] = array(
                    "tvrtka" => $st,
                    "s_ime" => $si,
                    "s_prezime" => $sp,
                    "id" => $this->id,
                    "pid" => $pr,
                    "sifra" => $sifra,
                    "serijski" => $ser,
                    "naziv" => $dio,
                    "brand" => $brand,
                    "datumZaprimanja" => $datumZaprimanja,
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
    
     public function sviRmaOstali($centar) {
        
        $query=$this->mysqli->prepare("SELECT s.tvrtka, s.ime as s_ime, s.prezime as s_prezime, rma.rma_id, p.primka_id, p.sifraUredaja as sifra, p.serial as serijski, p.naziv as dio, p.brand as brand, p.datumZaprimanja, rma.status,  rma.napomena, rma.poslanoOSu, rma.rnOS, 
                rma.nazivOS, rma.naplata, rma.danZaprimanja,  rma.opisPopravka, rma.danZavrsetka, 
                do.ime as doi, do.prezime as dop, dz.ime as dzi, dz.prezime as dzp 
                FROM radniNaloziRMA rma 
                LEFT JOIN primka p ON rma.primka_id = p.primka_id 
                LEFT JOIN stranka s ON p.stranka_id = s.stranka_id 
                LEFT JOIN djelatnici do ON rma.djelatnik_zapoceoRma_id = do.djelatnik_id 
                LEFT JOIN djelatnici dz ON rma.djelatnik_zavrsioRma_id = dz.djelatnik_id 
                WHERE p.status != 'Kupac preuzeo' AND p.status != 'Ekološki zbrinuto' 
                                        AND p.status !=  'Poslano u CS%' 
                                        and p.centar = ?
                                        ORDER BY p.primka_id ASC");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("s", $centar); 
        
        if($query->execute()){
            
            $query->bind_result( $st, $si, $sp,$this->id, $pr, $sifra, $ser, $dio, $brand, $datumZaprimanja, $status,  $napomena, $poslano, $r, $os, $naplata, $prip, $opis, $zavrseno, $oime, $oprezime, $zime, $zprezime);
            while($row = $query->fetch()){
                $rma[] = array(
                    "tvrtka" => $st,
                    "s_ime" => $si,
                    "s_prezime" => $sp,
                    "id" => $this->id,
                    "pid" => $pr,
                    "sifra" => $sifra,
                    "serijski" => $ser,
                    "naziv" => $dio,
                    "brand" => $brand,
                    "datumZaprimanja" => $datumZaprimanja,
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
    
    public function sviRmaSR() {
        
        $query=$this->mysqli->prepare("SELECT s.tvrtka, s.ime as s_ime, s.prezime as s_prezime, rma.rma_id, p.primka_id, p.sifraUredaja as sifra, p.serial as serijski, p.naziv as dio, p.brand as brand, p.datumZaprimanja, rma.status,  rma.napomena, rma.poslanoOSu, rma.rnOS, 
                rma.nazivOS, rma.naplata, rma.danZaprimanja,  rma.opisPopravka, rma.danZavrsetka, 
                do.ime as doi, do.prezime as dop, dz.ime as dzi, dz.prezime as dzp 
                FROM radniNaloziRMA rma 
                LEFT JOIN primka p ON rma.primka_id = p.primka_id 
                LEFT JOIN stranka s ON p.stranka_id = s.stranka_id 
                LEFT JOIN djelatnici do ON rma.djelatnik_zapoceoRma_id = do.djelatnik_id 
                LEFT JOIN djelatnici dz ON rma.djelatnik_zavrsioRma_id = dz.djelatnik_id 
                WHERE p.status != 'Kupac preuzeo'  AND p.status != 'Ekološki zbrinuto' 
               ORDER BY p.primka_id ASC");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        
        if($query->execute()){
            
            $query->bind_result( $st, $si, $sp,$this->id, $pr, $sifra, $ser, $dio, $brand, $datumZaprimanja, $status,  $napomena, $poslano, $r, $os, $naplata, $prip, $opis, $zavrseno, $oime, $oprezime, $zime, $zprezime);
            while($row = $query->fetch()){
                $rma[] = array(
                    "tvrtka" => $st,
                    "s_ime" => $si,
                    "s_prezime" => $sp,
                    "id" => $this->id,
                    "pid" => $pr,
                    "sifra" => $sifra,
                    "serijski" => $ser,
                    "naziv" => $dio,
                    "brand" => $brand,
                    "datumZaprimanja" => $datumZaprimanja,
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
                
        $query = $this->mysqli->prepare("INSERT INTO radniNaloziServisa(pocetakRada, primka_id, djelatnik_zapoceoRn_id, status) VALUES (?,?,?,'Servisiranje')");
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
    public function update( $rnID,  $status, $opisPopravka, $napomena, $naplata, $ispisano, $promijenjeno) {
        
        
        $query = $this->mysqli->prepare("UPDATE radniNaloziServisa SET status = ?, napomena = ?, opisPopravka = ?, naplata = ?, broj_ispisa = ?, promijenjeno=? WHERE rn_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('ssssssi',$status, $napomena, $opisPopravka, $naplata, $ispisano, $promijenjeno, $rnID);
        
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
    public function zatvoriRN( $rnID,  $status, $opisPopravka, $napomena, $naplata, $ispisano, $promijenjeno, $djelatnik_id) {
        date_default_timezone_set('Europe/Zagreb');
        $zatvori = date('Y-m-d H:i:s', time());
        
        $query = $this->mysqli->prepare("UPDATE radniNaloziServisa SET status = ?, napomena = ?, opisPopravka = ?, naplata = ?, danZavrsetka = ?, djelatnik_zavrsioRn_id = ?, broj_ispisa = ?, promijenjeno=? WHERE rn_id = ?");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param('sssssissi',$status, $napomena, $opisPopravka, $naplata, $zatvori, $djelatnik_id, $ispisano, $promijenjeno, $rnID);
        
       if($query->execute()){
            $query->close();
        }
        else{
             $query->close();
        die("Neuspješno zatvaranje radnog naloga");
        }
        
    }
    
    
    
    public function RNbyPrimka($id) {
       
        
        $query=$this->mysqli->prepare("SELECT rn.rn_id, rn.broj_ispisa, p.primka_id, p.naziv, p.serial, p.datumZaprimanja, s.ime as s_ime, s.prezime as s_prezime, s.tvrtka, rn.status, rn.pocetakRada, rn.danZavrsetka, rn.opisPopravka, rn.naplata, rn.napomena, rn.promijenjeno, rn.broj_ispisa, d1.ime, d1.prezime, d2.ime, d2.prezime "
                . "FROM radniNaloziServisa rn "
                . "LEFT JOIN primka p ON p.primka_id = rn.primka_id "
                . "LEFT JOIN stranka s ON p.stranka_id = s.stranka_id "
                . "LEFT JOIN djelatnici d1 ON rn.djelatnik_zapoceoRn_id = d1.djelatnik_id "
                . "LEFT JOIN djelatnici d2 ON rn.djelatnik_zavrsioRn_id = d2.djelatnik_id "
                . "WHERE rn.primka_id=? ORDER BY rn.primka_id");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("i", $id); 
        
        if($query->execute()){
            $query->bind_result($this->id, $ispisano, $pid, $pn, $ps, $datZa, $si, $sp, $st, $status, $pocetak, $dz, $op, $naplata, $napomena, $promijenjeno, $ispisano, $d1ime, $d1prezime,$d2ime, $d2prezime );
            while($row = $query->fetch()){
                $rn[] = array(
                    "id" => $this->id,
                    "ispisano" => $ispisano,
                    "naziv" => $pn,
                    "datumZaprimanja" => $datZa,
                    "serijski" => $ps,
                    "s_ime" => $si,
                    "s_prezime" => $sp,
                    "tvrtka" => $st,
                    "primka" => $pid,
                    "status" => $status,
                    "pocetak" => $pocetak,
                    "zavrsetak" => $dz,
                    "opis" => $op,
                    "naplata" => $naplata,
                    "napomena" => $napomena,
                    "promijenjeno" => $promijenjeno,
                    "ispisano" => $ispisano,
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
    
    public function sviRNostali($centar) {
       
        
        $query=$this->mysqli->prepare("SELECT rn.rn_id, p.primka_id, p.naziv, p.brand, p.serial, p.datumZaprimanja, s.ime as s_ime, s.prezime as s_prezime, s.tvrtka, rn.status, rn.pocetakRada, rn.danZavrsetka, rn.opisPopravka, rn.naplata, rn.napomena, rn.promijenjeno, rn.broj_ispisa, d1.ime, d1.prezime, d2.ime, d2.prezime 
                FROM radniNaloziServisa rn 
                LEFT JOIN primka p ON p.primka_id = rn.primka_id 
                LEFT JOIN stranka s ON p.stranka_id = s.stranka_id 
                LEFT JOIN djelatnici d1 ON rn.djelatnik_zapoceoRn_id = d1.djelatnik_id 
                LEFT JOIN djelatnici d2 ON rn.djelatnik_zavrsioRn_id = d2.djelatnik_id 
                WHERE (p.status != 'Kupac preuzeo' AND p.status != 'Ekološki zbrinuto' AND p.status NOT LIKE  'Poslano u CS%') 
                AND (rn.status != 'Stranka odustala od popravka' AND 
                        rn.status != 'Popravak završen u jamstvu' AND 
                        rn.status != 'Popravak završen van jamstva' AND 
                        rn.status != 'Stranka odustala od popravka' AND 
                        rn.status != 'Uređaj zamijenjen novim' AND 
                        rn.status != 'Odobren povrat novca' AND 
                        rn.status != 'DOA - Uređaj zamijenjen novim' AND 
                        rn.status != 'DOA - Odobren povrat novca')
                and p.centar = ? 
                ORDER BY p.primka_id ASC");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("s", $centar); 
        
        if($query->execute()){
            $query->bind_result($this->id, $pid, $pn, $pb, $ps, $datZa, $si, $sp, $st, $status, $pocetak, $dz, $op, $naplata, $napomena, $promijenjeno, $ispisano, $d1ime, $d1prezime,$d2ime, $d2prezime );
            while($row = $query->fetch()){
                $rn[] = array(
                    "id" => $this->id,
                    "naziv" => $pn,
                    "brand" => $pb,
                    "datumZaprimanja" => $datZa,
                    "serijski" => $ps,
                    "s_ime" => $si,
                    "s_prezime" => $sp,
                    "tvrtka" => $st,
                    "primka" => $pid,
                    "status" => $status,
                    "pocetak" => $pocetak,
                    "zavrsetak" => $dz,
                    "opis" => $op,
                    "naplata" => $naplata,
                    "napomena" => $napomena,
                    "promijenjeno" => $promijenjeno,
                    "ispisano" => $ispisano,
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

    public function sviRNostaliZavrseni($centar) {
       
        
        $query=$this->mysqli->prepare("SELECT rn.rn_id, p.primka_id, p.naziv, p.brand, p.serial, p.datumZaprimanja, s.ime as s_ime, s.prezime as s_prezime, s.tvrtka, rn.status, rn.pocetakRada, rn.danZavrsetka, rn.opisPopravka, rn.naplata, rn.napomena, rn.promijenjeno, rn.broj_ispisa, d1.ime, d1.prezime, d2.ime, d2.prezime 
                FROM radniNaloziServisa rn 
                LEFT JOIN primka p ON p.primka_id = rn.primka_id 
                LEFT JOIN stranka s ON p.stranka_id = s.stranka_id 
                LEFT JOIN djelatnici d1 ON rn.djelatnik_zapoceoRn_id = d1.djelatnik_id 
                LEFT JOIN djelatnici d2 ON rn.djelatnik_zavrsioRn_id = d2.djelatnik_id 
                WHERE (p.status != 'Kupac preuzeo' AND p.status != 'Ekološki zbrinuto' AND p.status NOT LIKE  'Poslano u CS%') 
                AND (rn.status = 'Stranka odustala od popravka' OR 
                        rn.status = 'Popravak završen u jamstvu' OR 
                        rn.status = 'Popravak završen van jamstva' OR 
                        rn.status = 'Stranka odustala od popravka' OR 
                        rn.status = 'Uređaj zamijenjen novim' OR 
                        rn.status = 'Odobren povrat novca' OR 
                        rn.status = 'DOA - Uređaj zamijenjen novim' OR 
                        rn.status = 'DOA - Odobren povrat novca')
                and p.centar = ? 
                ORDER BY p.primka_id ASC");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("s", $centar); 
        
        if($query->execute()){
            $query->bind_result($this->id, $pid, $pn, $pb, $ps, $datZa, $si, $sp, $st, $status, $pocetak, $dz, $op, $naplata, $napomena, $promijenjeno, $ispisano, $d1ime, $d1prezime,$d2ime, $d2prezime );
            while($row = $query->fetch()){
                $rn[] = array(
                    "id" => $this->id,
                    "naziv" => $pn,
                    "brand" => $pb,
                    "datumZaprimanja" => $datZa,
                    "serijski" => $ps,
                    "s_ime" => $si,
                    "s_prezime" => $sp,
                    "tvrtka" => $st,
                    "primka" => $pid,
                    "status" => $status,
                    "pocetak" => $pocetak,
                    "zavrsetak" => $dz,
                    "opis" => $op,
                    "naplata" => $naplata,
                    "napomena" => $napomena,
                    "promijenjeno" => $promijenjeno,
                    "ispisano" => $ispisano,
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

    
     public function sviRNservis($centar) {
       
        $query=$this->mysqli->prepare("SELECT rn.rn_id, p.status as primka_status, p.primka_id, p.brand, p.naziv, p.serial, p.datumZaprimanja, s.ime as s_ime, s.prezime as s_prezime, s.tvrtka, rn.status, rn.pocetakRada, rn.danZavrsetka, rn.opisPopravka, rn.naplata, rn.napomena, rn.promijenjeno, rn.broj_ispisa, d1.ime, d1.prezime, d2.ime, d2.prezime 
                FROM radniNaloziServisa rn 
                LEFT JOIN primka p ON p.primka_id = rn.primka_id 
                LEFT JOIN stranka s ON p.stranka_id = s.stranka_id 
                LEFT JOIN djelatnici d1 ON rn.djelatnik_zapoceoRn_id = d1.djelatnik_id 
                LEFT JOIN djelatnici d2 ON rn.djelatnik_zavrsioRn_id = d2.djelatnik_id 
                 WHERE p.status != 'Kupac preuzeo' AND p.status != 'Ekološki zbrinuto' 
                 AND p.centar = ? OR p.status LIKE  'Poslano u CS%'  
                 ORDER BY p.primka_id ASC");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("s", $centar); 
        
        if($query->execute()){
            $query->bind_result($this->id, $primka_status, $pid, $pb, $pn, $ps, $datZa, $si, $sp, $st, $status, $pocetak, $dz, $op, $naplata, $napomena, $promijenjeno, $ispisano, $d1ime, $d1prezime,$d2ime, $d2prezime );
            while($row = $query->fetch()){
                $rn[] = array(
                    "id" => $this->id,
                    "primka_status" => $primka_status,
                    "naziv" => $pn,
                    "brand" => $pb,
                    "datumZaprimanja" => $datZa,
                    "serijski" => $ps,
                    "s_ime" => $si,
                    "s_prezime" => $sp,
                    "tvrtka" => $st,
                    "primka" => $pid,
                    "status" => $status,
                    "pocetak" => $pocetak,
                    "zavrsetak" => $dz,
                    "opis" => $op,
                    "naplata" => $naplata,
                    "napomena" => $napomena,
                    "promijenjeno" => $promijenjeno,
                    "ispisano" => $ispisano,
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

    public function sviRNservisZavrseni($centar) {
       
        $query=$this->mysqli->prepare("SELECT rn.rn_id, p.status as primka_status, p.primka_id, p.brand, p.naziv, p.serial, p.datumZaprimanja, s.ime as s_ime, s.prezime as s_prezime, s.tvrtka, rn.status, rn.pocetakRada, rn.danZavrsetka, rn.opisPopravka, rn.naplata, rn.napomena, rn.promijenjeno, rn.broj_ispisa, d1.ime, d1.prezime, d2.ime, d2.prezime 
                FROM radniNaloziServisa rn 
                LEFT JOIN primka p ON p.primka_id = rn.primka_id 
                LEFT JOIN stranka s ON p.stranka_id = s.stranka_id 
                LEFT JOIN djelatnici d1 ON rn.djelatnik_zapoceoRn_id = d1.djelatnik_id 
                LEFT JOIN djelatnici d2 ON rn.djelatnik_zavrsioRn_id = d2.djelatnik_id 
                  WHERE (rn.status = 'Stranka odustala od popravka' or 
                        rn.status = 'Popravak završen u jamstvu' or 
                        rn.status = 'Popravak završen van jamstva' or 
                        rn.status = 'Stranka odustala od popravka' or 
                        rn.status = 'Uređaj zamijenjen novim' or 
                        rn.status = 'Odobren povrat novca' or 
                        rn.status = 'DOA - Uređaj zamijenjen novim' or 
                        rn.status = 'DOA - Odobren povrat novca')
                    AND (p.status != 'Kupac preuzeo' AND p.status != 'Ekološki zbrinuto'                                    
                    AND (p.centar = ? OR p.status LIKE  'Poslano u CS%'))  
                 ORDER BY p.primka_id ASC");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("s", $centar); 
        
        if($query->execute()){
            $query->bind_result($this->id, $primka_status, $pid, $pb, $pn, $ps, $datZa, $si, $sp, $st, $status, $pocetak, $dz, $op, $naplata, $napomena, $promijenjeno, $ispisano, $d1ime, $d1prezime,$d2ime, $d2prezime );
            while($row = $query->fetch()){
                $rn[] = array(
                    "id" => $this->id,
                    "primka_status" => $primka_status,
                    "naziv" => $pn,
                    "brand" => $pb,
                    "datumZaprimanja" => $datZa,
                    "serijski" => $ps,
                    "s_ime" => $si,
                    "s_prezime" => $sp,
                    "tvrtka" => $st,
                    "primka" => $pid,
                    "status" => $status,
                    "pocetak" => $pocetak,
                    "zavrsetak" => $dz,
                    "opis" => $op,
                    "naplata" => $naplata,
                    "napomena" => $napomena,
                    "promijenjeno" => $promijenjeno,
                    "ispisano" => $ispisano,
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

    public function sviRNservisOtvoreni($centar) {
       
        $query=$this->mysqli->prepare("SELECT rn.rn_id, p.status as primka_status, p.primka_id, p.brand, p.naziv, p.serial, p.datumZaprimanja, s.ime as s_ime, s.prezime as s_prezime, s.tvrtka, rn.status, rn.pocetakRada, rn.danZavrsetka, rn.opisPopravka, rn.naplata, rn.napomena, rn.promijenjeno, rn.broj_ispisa, d1.ime, d1.prezime, d2.ime, d2.prezime 
                FROM radniNaloziServisa rn 
                LEFT JOIN primka p ON p.primka_id = rn.primka_id 
                LEFT JOIN stranka s ON p.stranka_id = s.stranka_id 
                LEFT JOIN djelatnici d1 ON rn.djelatnik_zapoceoRn_id = d1.djelatnik_id 
                LEFT JOIN djelatnici d2 ON rn.djelatnik_zavrsioRn_id = d2.djelatnik_id 
                  WHERE (rn.status != 'Stranka odustala od popravka' AND 
                        rn.status != 'Popravak završen u jamstvu' AND 
                        rn.status != 'Popravak završen van jamstva' AND 
                        rn.status != 'Stranka odustala od popravka' AND 
                        rn.status != 'Uređaj zamijenjen novim' AND 
                        rn.status != 'Odobren povrat novca' AND 
                        rn.status != 'DOA - Uređaj zamijenjen novim' AND 
                        rn.status != 'DOA - Odobren povrat novca')
                    AND (p.status != 'Kupac preuzeo' AND p.status != 'Ekološki zbrinuto' 
                    AND (p.centar = ? OR p.status LIKE  'Poslano u CS%'))  
                 ORDER BY p.primka_id ASC");
        
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
        $query->bind_param("s", $centar); 
        
        if($query->execute()){
            $query->bind_result($this->id, $primka_status, $pid, $pb, $pn, $ps, $datZa, $si, $sp, $st, $status, $pocetak, $dz, $op, $naplata, $napomena, $promijenjeno, $ispisano, $d1ime, $d1prezime,$d2ime, $d2prezime );
            while($row = $query->fetch()){
                $rn[] = array(
                    "id" => $this->id,
                    "primka_status" => $primka_status,
                    "naziv" => $pn,
                    "brand" => $pb,
                    "datumZaprimanja" => $datZa,
                    "serijski" => $ps,
                    "s_ime" => $si,
                    "s_prezime" => $sp,
                    "tvrtka" => $st,
                    "primka" => $pid,
                    "status" => $status,
                    "pocetak" => $pocetak,
                    "zavrsetak" => $dz,
                    "opis" => $op,
                    "naplata" => $naplata,
                    "napomena" => $napomena,
                    "promijenjeno" => $promijenjeno,
                    "ispisano" => $ispisano,
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


class odobrenja{
    private $mysqli;
    function __construct(){
        $con = new database();
        $this->mysqli = $con->getConnection();
    }

    public function svaOtvorena(){
        $query = $this->mysqli->query("SELECT f.*, CONCAT(p.brand, ' ', p.naziv) as uredaj, p.sifraUredaja as sifra, p.centar, p.serial  FROM fin_odobrenja f 
                                        LEFT JOIN primka p ON f.primka_id = p.primka_id 
                                        WHERE f.rijeseno != 'Da' ORDER BY f.primka_id ASC");

        
        while($row = $query->fetch_object()){
            $result[]  = $row;
        }
        if($result) return $result;
        $query->close();        
        exit();                       
    }

    public function insert($dob, $od, $nap, $st, $pr){

        $od = date("Y-m-d", strtotime($od));

        $query = $this->mysqli->prepare("INSERT INTO fin_odobrenja (dobavljac, zatrazeno, napomena, status, primka_id, rijeseno) VALUES (?, ?, ?, ?, ?, ?)");
        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        $rijeseno = 'Ne';
        $query->bind_param("ssssis", $dob, $od, $nap, $st, $pr, $rijeseno );

        $query->execute();
        $query->close();
        exit();


    }

    public function ById($id){
        $id = (int) $id;

        if($id){
            $query = $this->mysqli->query("SELECT f.*  FROM fin_odobrenja f  WHERE f.fin_id = $id LIMIT 1");

            $result[]  = $query->fetch_object();
            $query->close();
            if($result) return $result;

            exit();
        } else{
            die("Nije broj");
        }
    }

    public function update($dob, $od, $nap, $st, $pr, $ri, $id){

        $od = date("Y-m-d", strtotime($od));
        if($ri == "Da"){
            date_default_timezone_set('Europe/Zagreb');
            $odobreno = date('Y-m-d', time());
        }

        if($ri == "Da"){
    $query = $this->mysqli->prepare("UPDATE fin_odobrenja SET
                                        dobavljac = ?,
                                        dan_odobrenja = ? ,
                                        napomena = ? ,
                                        status = ? ,
                                        primka_id = ? ,
                                        zatrazeno = ? ,
                                        rijeseno  = ?
                                        WHERE fin_id =? ");
        }else{
    $query = $this->mysqli->prepare("UPDATE fin_odobrenja SET
                                        dobavljac = ?  ,
                                        napomena = ? ,
                                        status = ? ,
                                        primka_id = ? ,
                                        zatrazeno = ? ,
                                        rijeseno  = ?
                                        WHERE fin_id =? ");
    }


        if($query === false){
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }

        if($ri == "Da"){
            $query->bind_param("ssssissi", $dob, $odobreno, $nap, $st, $pr, $od, $ri, $id );
        }else{
            $query->bind_param("sssissi", $dob,  $nap, $st, $pr, $od, $ri, $id );
        }


        $query->execute();
        $query->close();
        exit();


    }


}

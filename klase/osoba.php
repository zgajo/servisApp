<?php

include_once 'database.php';

abstract class osoba {

    private $ime, $prezime, $id;

}

class djelatnik extends osoba {

    private $mysqli, $username, $password;

    function __construct() {
        $con = new database();
        $this->mysqli = $con->getConnection();
    }

    public function chkLogin($user, $passw) {
        $pass = hash("sha256", $passw);

        $query = $this->mysqli->prepare("SELECT djelatnik_id, ime, prezime, odjel, p_centar FROM djelatnici WHERE username = ? AND lozinka = ?");
        if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }

        $query->bind_param('ss', $user, $pass);

        if ($query->execute()) {
            $query->store_result();
            if ($query->num_rows() == 1) {

                $query->bind_result($this->id, $this->ime, $this->prezime, $this->odjel, $this->p_centar);
                $query->fetch();

                
                // UKOLIKO BUDE POTREBNO, STAVITI COOKIE KAO TOKEN U BAZU, TE PROVJERAVATI I DOHVAĆATI DJELATNIKA NA TAJ NAČIN
                date_default_timezone_set('Europe/Zagreb');
                $expire = time() + 43200;
                setcookie("user", "$this->ime $this->prezime", $expire, '/', '', '', TRUE);
                setcookie("id", $this->id, $expire, '/', '', '', TRUE);
                setcookie("odjel", $this->odjel, $expire, '/', '', '', TRUE);

                

                // KORISTITI UNUTAR EUROTRADE

                $ip = $_SERVER['REMOTE_ADDR'];
                $ip = substr($ip, 8, 2);

                switch ($ip) {

                    case 10:
                        setcookie("centar", "Zagreb", $expire, '/', '', '', TRUE);
                        break;
                    case 20:
                        setcookie("centar", "Split", $expire, '/', '', '', TRUE);
                        break;
                    case 30:
                        setcookie("centar", "Rijeka Andrea", $expire, '/', '', '', TRUE);
                        break;
                    case 40:
                        setcookie("centar", "Varaždin", $expire, '/', '', '', TRUE);
                        break;
                    case 50:
                        setcookie("centar", "Osijek", $expire, '/', '', '', TRUE);
                        break;
                    case 60:
                        setcookie("centar", "Sisak", $expire, '/', '', '', TRUE);
                        break;
                    case 70:
                        setcookie("centar", "Pula", $expire, '/', '', '', TRUE);
                        break;
                    case 80:
                        setcookie("centar", "Rijeka Korzo", $expire, '/', '', '', TRUE);
                        break;
                    case 90:
                        setcookie("centar", "Rovinj", $expire, '/', '', '', TRUE);
                        break;
                }
                //  * KRAJ KORISTITI UNUTAR EUROTRADEA
   /*
              //  KORISTITI VAN EUROTRADEA
                  setcookie("centar", $this->p_centar, $expire, '/', '', '', TRUE);
*/
 
                $query->close();
                
                if($user == $passw) header("Location: ./korisnik.php?action=il&id=$this->id");
                else if($this->odjel == "Reklamacije") header('Location: ./rma.php'); 
                else header('Location: ./primke.php');
                
                exit();
            } else {
                $query->close();
                die('<script>alert("Upisano krivo korisničko ime i / ili lozinka")</script>');
            }
        } else {
            trigger_error(", ERROR: " . $conn->errno . " " . $conn->error, E_USER_ERROR);
            $query->close();
            exit();
        }
    }

    public function getDjelatnikById($id) {
        $query = $this->mysqli->prepare("SELECT ime, prezime, odjel, p_centar FROM djelatnici WHERE djelatnik_id = ?");
        if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }

        $query->bind_param("i", $id);
        if ($query->execute()) {
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

    public function izmjenaLozinke($id, $l) {
        
        if ($l != null) {
            $loz = hash("sha256", $l);
            
            $query = $this->mysqli->prepare("UPDATE djelatnici SET lozinka = ? WHERE djelatnik_id =?");
            $query->bind_param('si', $loz, $id);
            
            if ($query->execute()) {
                return 1;
            }
        }
        
    }
    
    public function pl($id, $l) {
        
        $l = hash("Sha256", $l);
        $query = $this->mysqli->prepare("SELECT ime FROM djelatnici WHERE djelatnik_id = ? AND lozinka = ?");
        $query->bind_param("is", $id, $l);
        if($query->execute()) {
            $query->bind_result($ime);
            $query->store_result();
            $broj = $query->num_rows;
            return $broj;
        }
        
    }

}

// -----------  KRAJ DJELATNIKA -------------//
// ----------   STRANKA  ------------//
class stranka extends osoba {

    private $mysqli, $grad, $adresa, $post_broj, $kontakt_broj, $email;

    function __construct() {
        $con = new database();
        $this->mysqli = $con->getConnection();
    }

    public function insert($tvrtka, $ime, $prezime, $adresa = NULL, $grad = NULL, $kontakt_broj = NULL, $email = NULL) {

        $query = $this->mysqli->prepare("INSERT INTO stranka(tvrtka, ime, prezime, adresa, grad, kontaktBroj, email) VALUES(?,?,?,?,?,?,?)");

        if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }

        $query->bind_param('sssssss', $tvrtka, $ime, $prezime, $adresa, $grad, $kontakt_broj, $email);

        if ($query->execute()) {
            $query->close();
            return $this->mysqli->insert_id;
        } else {
            $query->close();
            die("NIJE USPJEŠNO UNEŠENO U BAZU: STRANKA");
        }
    }

    public function getById($id) {
        $query = $this->mysqli->prepare("SELECT tvrtka, ime, prezime, adresa, grad, kontaktBroj, email FROM stranka WHERE stranka_id = ? ");
        if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }

        $query->bind_param('i', $id);

        if ($query->execute()) {
            $query->bind_result($tvrtka, $ime, $prezime, $adresa, $grad, $kontakt, $email);
            $query->fetch();

            $result = array(
                "id" => $id,
                "tvrtka" => $tvrtka,
                "ime" => $ime,
                "prezime" => $prezime,
                "adresa" => $adresa,
                "grad" => $grad,
                "kontakt" => $kontakt,
                "email" => $email
            );

            $query->close();
            return $result;
        } else {
            $query->close();
            die("NIJE PRONAĐEN KUPAC");
        }
    }

    public function update($tvrtka, $ime, $prezime, $adresa = NULL, $grad = NULL, $kontakt_broj = NULL, $email = NULL, $id) {

        $query = $this->mysqli->prepare("UPDATE stranka SET tvrtka = ?, ime = ?, prezime = ?, adresa = ?, grad = ?, kontaktBroj = ?, email = ? "
                . "WHERE stranka_id = ?");

        if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }

        $query->bind_param('sssssssi', $tvrtka, $ime, $prezime, $adresa, $grad, $kontakt_broj, $email, $id);

        if ($query->execute()) {
            $query->close();
        } else {
            $query->close();
            die("NIJE USPJEŠNO UNEŠENO U BAZU: STRANKA");
        }
    }

    public function primkaByKupac($id) {
        $query = $this->mysqli->prepare("SELECT s.*, "
                . "p.primka_id, p.naziv, p.datumZaprimanja, p.brand, p.datumZatvaranja, p.opisKvara,p.status, p.serial  "
                . "FROM stranka s "
                . "LEFT JOIN primka p ON s.stranka_id = p.stranka_id "
                . "WHERE s.stranka_id = ?  ORDER BY p.primka_id DESC");

        if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }

        $query->bind_param("i", $id);

        if ($query->execute()) {
            $meta = $query->result_metadata();
            while ($field = $meta->fetch_field()) {
                $params[] = &$row[$field->name];
            }

            call_user_func_array(array($query, 'bind_result'), $params);

            while ($query->fetch()) {
                foreach ($row as $key => $val) {
                    $c[$key] = $val;
                }
                $result[] = $c;
            }

            $query->close();
            return $result;
        }
    }

}

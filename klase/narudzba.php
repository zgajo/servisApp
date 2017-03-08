<?php

include_once 'database.php';

class narudzba {

    private $mysqli;

    function __construct() {
        $con = new database();
        $this->mysqli = $con->getConnection();
    }

    public function insert($pro, $dob, $pn, $vpc, $skl, $s, $p = NULL) {

        date_default_timezone_set('Europe/Zagreb');
        $naruceno = date('Y-m-d H:i:s', time());

        $query = $this->mysqli->prepare("INSERT INTO narudzbe (naruceno, dio, dobavljac, pn, vpc, skl, stranka_id, primka_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        $query->bind_param("ssssssii", $naruceno, $pro, $dob, $pn, $vpc, $skl, $s, $p);

        if ($query->execute()) {
            $query->close();
            return $this->mysqli->insert_id;
            ;
        } else {
            $query->close();
            die("NIJE USPJEŠNO UNEŠENO U BAZU: Narudzba");
        }
    }

    public function update($dio, $dob, $pn, $vpc, $skl, $p, $id) {
        date_default_timezone_set('Europe/Zagreb');


        $query = $this->mysqli->prepare("UPDATE narudzbe SET "
                . "dio = ?, "
                . "dobavljac = ?, "
                . "pn = ?, "
                . "vpc = ?, "
                . "skl = ?, "
                . "primka_id = ? "
                . "WHERE narudzbe_id = ?");

        if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        $query->bind_param("sssssii", $dio, $dob, $pn, $vpc, $skl, $p, $id);



        if ($query->execute()) {
            $query->close();
            return;
        } else {
            $query->close();
            die("NIJE USPJEŠNO UNEŠENO U BAZU: Narudzba");
        }
    }

    public function otvoreno() {
        $query = $this->mysqli->prepare("SELECT n.*, s.tvrtka as tvrtka, s.ime as ime, s.prezime as prezime FROM narudzbe n "
                . "LEFT JOIN stranka s ON n.stranka_id = s.stranka_id "
                . "WHERE n.status != 'rijeseno' OR n.status IS null");

        if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }


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

    public function getById($id) {

        $query = $this->mysqli->prepare("SELECT * FROM narudzbe WHERE narudzbe_id = ? ");

        if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }

        $query->bind_param('i', $id);

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
    
    public function brisi($id) {
       $query = $this->mysqli->prepare("DELETE FROM narudzbe WHERE narudzbe_id = ? "); 
       
       if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
       $query->bind_param('i', $id);
       
       if ($query->execute()) {
            $query->close();
            return;
        } else {
            $query->close();
            die("NIJE USPJEŠNO BRISANJE: Narudzba");
        }
       
    }
    
    public function zatvori($id) {
        date_default_timezone_set('Europe/Zagreb');
        $rijeseno = date('Y-m-d H:i:s', time());
       $query = $this->mysqli->prepare("UPDATE  narudzbe SET status = 'rijeseno',  stiglo  = '$rijeseno' WHERE narudzbe_id = ? "); 
       
       if ($query === false) {
            trigger_error("Krivi SQL upit: " . $query . ", ERROR: " . $this->mysqli->errno . " " . $this->mysqli->error, E_USER_ERROR);
        }
        
       $query->bind_param('i', $id);
       
       if ($query->execute()) {
            $query->close();
            return;
        } else {
            $query->close();
            die("NIJE USPJEŠNO ZATVORENO: Narudzba");
        }
       
    }

}

<?php

include_once '../../checkLogin.php';
include_once '../../klase/radniNalog.php';
$rn = new servisRN();
$rn->zatvoriRN($_POST['id'],  $_POST['status'], $_POST['popravak'], $_POST['napomena'], $_POST['naplata'], $_POST['ispisano'], $_POST['promijenjeno'], $_COOKIE['id']);
                                    


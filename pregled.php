<?php
include_once './klase/checkLogin.php';
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Pregled primke</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

        <!-- Ionicons -->
        <link rel="stylesheet" href="font/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <link rel="icon" type="ispis/logo.png" href="ispis/icon.ico.png">
        <link href="search/search.css" rel="stylesheet">
        <link rel="stylesheet" href="jquery-ui.css">
        <style>
            
        </style>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include 'pageParts/header.php'; ?>
            <?php include 'pageParts/sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->

                <!-- Main content -->
                
                <div style="margin-top: -15px"></div>

                    <section class="invoice">
                        <!-- this row will not appear when printing -->
                        <div id="t" class="row no-print">
                            <div class="col-xs-12">
                                <a class="btn btn-default" onclick="printaj()"><i class="fa fa-print"></i> Print</a>
                            </div>
                        </div>
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h2>
                                    <img src="ispis/logo.png" style="height: 50px; display: inline; float: left">

                                </h2>

                                <div style="display: inline; float: right; font-size: 14px" class="no-print"><b>Status:</b>
                                    <span style="margin-right: 8px" id="status_primke">

                                    </span>
                                </div>

                            </div>
                            <!-- /.col -->
                            <div style="clear: both">
                                <h2 class="page-header"></div>
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info" >

                            <div class="col-sm-4 invoice-col"  style="font-size: 12px">
                                <strong>Podaci o vlasniku</strong>
                                <address>
                                    <div id="tvrtka"></div>
                                    <div id="osoba"></div>
                                    <div id="tvrtka"></div>
                                    <div id="adresa"></div>
                                    <div id="grad"></div>
                                    Kontakt: <div id="kontakt" style="display: inline"></div><br>
                                    Email: <div id="email" style="display: inline"></div><br>
                                </address>
                            </div><!-- /.col -->

                            <div class="col-sm-4 invoice-col" style="font-size: 12px">
                                <strong>Podaci o uređaju</strong><br>
                                <span id="sifraUredajaSpan"><i>Šifra: </i><p style="display: inline" id="sifra"></p><br></span>
                                <i>Uređaj: </i><p style="display: inline" id="uredaj"></p><br>
                                <i>Serijski: </i><p style="display: inline" id="serijski"></p><br>
                                <i>Datum prodaje: </i><p style="display: inline"  id="dp"></p><br>
                                <i>Račun: </i><p style="display: inline" id="racun"></p><br>
                            </div><!-- /.col -->

                            <div class="col-sm-4 invoice-col" style="float: right; font-size: 12px">
                                <h4 style="margin-top: 0px" id="primka"></h4>
                                <b>Zaprimio: </b><p style="display: inline" id="zap"></p><br>
                                <b>Zaprimljeno: </b><p style="display: inline"  id="dz"></p><br>
                                <span  id="saround"><b >Datum završetka: </b><span id="zav"></span><div style="display:none" id="dat_z"></div><br>
                                    <b  id="zav_ser">Završio serviser: </b><br></span>
                                <span id="osaround"><b  id="os">Ovlašteni servis: </b><br>
                                    <b  id="os_rn">RN ovlaštenog servisa: </b><br>
                                    <b  id="os_v">Vraćeno iz ovlaštenog servisa: </b></span>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Table row -->
                        <div class="row" style="clear: both">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped" style="font-size: 12px">
                                    <thead>
                                        <tr>

                                            <th>Opis kvara</th>
                                            <th>Priloženo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td  id="opis" style="width: 60%"></td>
                                            <td id="prilozeno" style="width: 30%"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped" style="font-size: 12px">
                                    <thead>
                                        <tr>

                                            <th>Opis popravka</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td  id="popravak"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped" style="font-size: 12px">
                                    <thead>
                                        <tr>

                                            <th>Promijenjeni dijelovi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="promijenjeno"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">
                                <p class="lead" style="font-size: 12px"><b>Napomena:</b></p>

                                <p class="text-muted well well-sm no-shadow" style="font-size: 9px;margin-top: 10px;">
                                    Eurotrade d.o.o. ne odgovara za podatke na računalu, HDD uređaju ili bilo kojem uređaju koji služi za pohranu podataka ili eventualni njihov gubitak. Kod popravka pisača, postoji mogućnost da će se zbog potrebe servisiranja potrošni materijal koji se nalazi u pisaču, djelomično ili u cjelosti potrošiti.

                                    Eurotrade d.o.o. poslije 60 dana od zatvaranja radnog naloga ne snosi odgovornost za robu ukoliko ona nije podignuta.

                                    U slučaju odustajanja od popravka naplaćuje se dijagnostika po važećem cjeniku.

                                    Sve radove, materijale i ostale troškove vezane uz radni nalog (troškovi koji nisu pokriveni ugovornom obvezom ili jamstvom) vlasnik neopozivo naručuje potpisom radnog naloga.
                                </p>
                                <strong style="font-size: 13px">PREUZEO:</strong><br><br>
                                <div style="border-bottom:  1px solid black; width: 200px;height: 30px"></div>
                                <div id="potpis" style="text-align:center;  width: 200px;height: 30px"></div><br>
                            </div><!-- /.col -->
                            <div class="col-xs-6" style="font-size: 12px">
                                <p class="lead"  id="status_rada" style="font-size: 14px">Status obavljenog rada: </p><div></div>
                                <p class="lead" style="font-size: 12px">Šifre za naplatiti</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%"  style="font-size: 10px">Naplatiti:</th>
                                                <td id="naplata"></td>
                                            </tr>
                                        </tbody></table>
                                </div>
                            </div>
                        </div><!-- /.row -->







                    </section><!-- /.content -->


                    <?php require 'upload.php'; ?>
                    <div style="clear:both"></div>

            </div><!-- /.content-wrapper -->

            <!-- Main Footer --><div class="no-print">
                <?php require_once('pageParts/footer.php') ?>
            </div>
        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="jquery-ui.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- Select2 -->
        <script src="plugins/select2/select2.full.min.js"></script>
        <!-- InputMask -->

        <!-- Pretrage u sidebaru -->
        <script type="text/javascript" src="search/searchkupca.js"></script>
        <script type="text/javascript" src="search/searchprimka.js"></script>
        <script type="text/javascript" src="search/searchserijski.js"></script>
        <script>
                                            var id = <?php echo $_GET['primka'] ?>;
                                            var opis_popravka = '';
                                            var prom = '';
                                            var naplata = '';
                                            var odjel = "<?php echo $_COOKIE['odjel'] ?>";

                                            $.get("json/primka/getById.php", {"id": id}, function (primka) {

                                                var zaprimljeno = new Date(primka[0].datumZaprimanja);

                                                $('#dz').text([zaprimljeno.getDate(), zaprimljeno.getMonth() + 1, zaprimljeno.getFullYear()].join('.'));
                                                $('#zap').text(primka[0].pot_ime + ' ' + primka[0].pot_prezime);
                                                $('#primka').text('Primka br. ' + primka[0].primka_id);
                                                $("#status_primke").text(primka[0].status);

                                                (primka[0].tvrtka != null && primka[0].tvrtka != '') ? $('#tvrtka').text(primka[0].tvrtka) : $('#tvrtka').text('');
                                                $('#adresa').text(primka[0].adresa);
                                                $('#grad').text(primka[0].grad);
                                                $('#kontakt').text(primka[0].kontaktBroj);
                                                $('#email').text(primka[0].email);
                                                $('#osoba').text(primka[0].ime + ' ' + primka[0].prezime);
                                                if (primka[0].tvrtka)
                                                    $('#potpis').text(primka[0].tvrtka + ', ' + primka[0].ime + ' ' + primka[0].prezime);
                                                else
                                                    $('#potpis').text(primka[0].ime + ' ' + primka[0].prezime);

                                                (primka[0].sifraUredaja) ? $('#sifra').text(primka[0].sifraUredaja) : $('#sifraUredajaSpan').hide();    

                                                $('#uredaj').text(primka[0].brand + ' ' + primka[0].naziv);
                                                $('#serijski').text(primka[0].serial);

                                                var kupljeno = new Date(primka[0].datumKupnje);

                                                (kupljeno && kupljeno.getFullYear() != '1970' && !isNaN(kupljeno)) ? $('#dp').text([kupljeno.getDate(), kupljeno.getMonth() + 1, kupljeno.getFullYear()].join('.')) : $('#dp').text('');
                                                ;

                                                $('#racun').text(primka[0].racun);
                                                $('#opis').text(primka[0].opisKvara);
                                                $('#prilozeno').text(primka[0].prilozeno_primijeceno);



                                                //  DOHVATI RADNI NALOG POVEZAN SA PRIMKOM
                                                $.post("json/rn/getRNbyPrimka.php", {"primka": id}, function (rn) {
                                                    console.log(rn);
                                                    //  UKOLIKO POSTOJI RN POVEZAN SA PRIMKOM
                                                    if (rn) {

                                                        var rnvelicina = rn.length - 1;
                                                        var rn_zav = new Date(rn[rnvelicina].zavrsetak);

                                                        (rn_zav && rn_zav.getFullYear() != '1970') ? $('#zav').text([rn_zav.getDate(), rn_zav.getMonth() + 1, rn_zav.getFullYear()].join('.') + '') : $('#zav').text('');
                                                        (rn[rnvelicina].d2ime) ? $('#zav_ser').after(rn[rnvelicina].d2ime + ' ' + rn[rnvelicina].d2prezime + '') : $('#zav_ser').after('');
                                                        $("#dat_z").text([rn_zav.getDate(), rn_zav.getMonth() + 1, rn_zav.getFullYear()].join('.'))
                                                        opis_popravka += '<b>OPASKA SERVISA:</b> <br>';



                                                        //      Upis radnih naloga u opasku servisa
                                                        for (rn of rn) {
                                                            var pocetak_servisa = new Date(rn.pocetak);
                                                            var status_rada = '<div  id="s' + rn.id + '">' + rn.status + '</div>';
                                                            $("#status_rada").html($("#status_rada").html() + status_rada);

                                                            // PArent span
                                                            opis_popravka += '<span>';
                                                            opis_popravka += '<b style="display:inline">Radni nalog:</b> ' + rn.id + '. ';
                                                            opis_popravka += '<span class="no-print">';
                                                            opis_popravka += '<input style="display:inline;margin-left:15px" type="checkbox" value="Prikazuje se pri ispisu" name="' + rn.id + '" checked="">' +
                                                                    '<span class="text">Prikaži prilikom printanja</span><br>';
                                                            opis_popravka += '</span>';

                                                            if (rn.opis !== null)
                                                                opis_popravka += '<br class="no-print">' + rn.opis + '. <br>';

                                                            opis_popravka += '<span class="no-print"><br>';
                                                            opis_popravka += '<b>Početak servisiranja uređaja:</b> ' + [pocetak_servisa.getDate(), pocetak_servisa.getMonth() + 1, pocetak_servisa.getFullYear()].join('.') + '. ';
                                                            opis_popravka += '<br><b>Servisiranje započeo:</b> ' + rn.d1ime + ' ' + rn.d1prezime;
                                                            opis_popravka += '</span>';

                                                            var zavrsen_servis = new Date(rn.zavrsetak);


                                                            if (zavrsen_servis && zavrsen_servis.getFullYear() != '1970') {

                                                                var dat_zav = new Date($("#dat_z").text().split(".").reverse().join("-"));

                                                                if((zavrsen_servis.getTime() > dat_zav.getTime()) || dat_zav.getFullYear() == '1970') {
                                                                    $("#dat_z").text([zavrsen_servis.getDate(), zavrsen_servis.getMonth() + 1, zavrsen_servis.getFullYear()].join('.'));
                                                                    $('#zav').text([zavrsen_servis.getDate(), zavrsen_servis.getMonth() + 1, zavrsen_servis.getFullYear()].join('.'))
                                                                }

                                                                opis_popravka += '<span  class="no-print">';

                                                                opis_popravka += '<br><b>Završetak servisiranja:</b> ' + [zavrsen_servis.getDate(), zavrsen_servis.getMonth() + 1, zavrsen_servis.getFullYear()].join('.') + '. ';
                                                                opis_popravka += '<br class="no-print"></span>';
                                                            }

                                                            if (rn.napomena !== null && rn.napomena !== '' && (odjel === 'Servis' || odjel === 'Servis')) {
                                                                opis_popravka += '<span   class="no-print"><br>';
                                                                opis_popravka += '<b>Napomena: </b>' + rn.napomena + '. <br class="no-print">';
                                                                opis_popravka += '</span>';
                                                            }

                                                            if (rn.ispisano !== null && rn.ispisano !== '' && odjel === 'Servis') {
                                                                opis_popravka += '<span>';
                                                                opis_popravka += '<b>Ispisano stranica: </b>' + rn.ispisano + '. <br class="no-print">';
                                                                opis_popravka += '</span>';
                                                            }


                                                            opis_popravka += '<br></span>';

                                                            prom += (rn.promijenjeno) ? '<span id="p' + rn.id + '"><b style="display:inline">Radni nalog:</b> ' + rn.id + ': ' + rn.promijenjeno + '<br></span>' : '';


                                                            naplata += (rn.naplata !== '' && rn.naplata != null) ? '<span id="n' + rn.id + '"> ' + rn.naplata + '<br></span>' : '';
                                                        }
                                                        //  DOHVAĆANJE RMA NALOGA I UPISIVANJE




                                                        $('#popravak').html(opis_popravka);
                                                        $('#promijenjeno').html(prom);
                                                        $('#naplata').html(naplata);
                                                    }// UKOLIKO NE POSTOJI RN POVEZAN SA PRIMKOM
                                                    else {
                                                        $('#saround').hide();
                                                    }


                                                });

                                                // DOHVATI RMA NALOG POVEZAN SA PRIMKOM
                                                $.get("json/rma/getRmaByPrimka.php", {"primka": id}, function (rma) {


                                                    console.log(rma);



                                                    if (rma) {

                                                        opis_popravka += '<b>OPASKA OVLAŠTENOG SERVISA:</b><br> ';


                                                        var vraceno = new Date(rma[rma.length - 1].zavrseno);
                                                        if (vraceno && vraceno.getFullYear() != '1970')
                                                            $('#os_v').after([vraceno.getDate(), vraceno.getMonth() + 1, vraceno.getFullYear()].join('.'));

                                                        $('#os').after(rma[rma.length - 1].nazivOS);
                                                        $('#os_rn').after(rma[rma.length - 1].rnOs);

                                                        for (rma of rma) {


                                                            var pripremljeno = new Date(rma.pripremljeno);
                                                            var poslano = new Date(rma.poslano);
                                                            var vraceno = new Date(rma.vraceno);

                                                            opis_popravka += '<span>';

                                                            opis_popravka += '<span class="no-print"><br>';
                                                            opis_popravka += '<b>RMA nalog:</b> ' + rma.id + '. ';
                                                            opis_popravka += '<input style="display:inline;margin-left:15px" type="checkbox" value="Prikazuje se pri ispisu" name="" checked="">' +
                                                                    '<span class="text">Prikaži prilikom printanja</span><br>';
                                                            opis_popravka += '<b>Pripremljeno za slanje:</b> ';
                                                            opis_popravka += (pripremljeno && pripremljeno.getFullYear() != '1970') ? [pripremljeno.getDate(), pripremljeno.getMonth() + 1, pripremljeno.getFullYear()].join('.') + '. ' : '';
                                                            opis_popravka += '</span>';

                                                            opis_popravka += '<span class="no-print"><br>';
                                                            opis_popravka += '<b>Poslano:</b> ';
                                                            opis_popravka += (poslano && poslano.getFullYear() != '1970') ? [poslano.getDate(), poslano.getMonth() + 1, poslano.getFullYear()].join('.') + '. ' : '';
                                                            opis_popravka += '</span>';

                                                            opis_popravka += '<span class="no-print"><br>';
                                                            opis_popravka += '<b>Ovlašteni servis:</b> ';
                                                            opis_popravka += (rma.nazivOS) ? rma.nazivOS : '';
                                                            opis_popravka += '</span>';

                                                            opis_popravka += '<span class="no-print"><br>';
                                                            opis_popravka += '<b>Radni nalog ovlaštenog servisa:</b> ';
                                                            opis_popravka += (rma.rnOs) ? rma.rnOs : '';
                                                            opis_popravka += '</span>';

                                                            if (rma.opis !== null && rma.opis != '')
                                                                opis_popravka += '<br class="no-print">' + rma.opis + '. ';

                                                            if (rma.napomena !== null && rma.napomena !== '' && odjel === 'Servis') {
                                                                opis_popravka += '<span   class="no-print"><br>';
                                                                opis_popravka += '<b>Napomena: </b>' + rma.napomena + '. ';
                                                                opis_popravka += '</span>';
                                                            }

                                                            opis_popravka += '<span class="no-print"><br>';
                                                            opis_popravka += '<b>Vraćeno iz ovlaštenog servisa: </b>';
                                                            opis_popravka += (vraceno && vraceno.getFullYear() != '1970' && !isNaN(vraceno)) ? [vraceno.getDate(), vraceno.getMonth() + 1, vraceno.getFullYear()].join('.') + '. ' : '';
                                                            opis_popravka += '<br></span>';



                                                            opis_popravka += '<br></span>';

                                                            prom += (rma.promijenjeno) ? rma.promijenjeno + '<br>' : '';
                                                            naplata += (rma.naplata !== '' && rma.naplata != null) ? ' ' + rma.naplata + '<br>' : '';
                                                        }
                                                        $('#popravak').html(opis_popravka);
                                                        $('#promijenjeno').html(prom);
                                                        $('#naplata').html(naplata);
                                                    } else {
                                                        $('#osaround').hide();
                                                    }

                                                });



                                            });


                                            function isprintati(i) {
                                                $(document).ready(function () {
                                                    $(this).find("#p" + i).removeClass('no-print');
                                                    $(this).find("#n" + i).removeClass('no-print');
                                                    $(this).find("#s" + i).removeClass('no-print');
                                                })
                                            }

                                            function sakrij(i) {
                                                $(document).ready(function () {
                                                    $(this).find("#p" + i).addClass('no-print');
                                                    $(this).find("#n" + i).addClass('no-print');
                                                    $(this).find("#s" + i).addClass('no-print');
                                                })
                                            }

                                            $('#popravak').on("click", 'input', function () {

                                                if ($(this).is(":checked")) {
                                                    $(this).parent().parent().removeClass('no-print');
                                                    isprintati($(this).attr('name'));
                                                } else {
                                                    $(this).parent().parent().addClass('no-print');
                                                    sakrij($(this).attr('name'));
                                                }

                                            });




                                            function printaj() {
                                                window.print();
                                            }
        </script>

    </body>
</html>

<?php
include_once 'checkLogin.php';
include_once 'klase/radniNalog.php';
include_once 'klase/primka.php';
include_once 'klase/osoba.php';
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
        <title>Primke</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        
        <link href="search/search.css" rel="stylesheet">
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
                <section class="content">


                    <section class="invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h2>
                                    <img src="ispis/logo.png" style="height: 50px; display: inline; float: left">

                                </h2>

                                <div style="display: inline; float: right; font-size: 10px">
                                    <span style="float: left; margin-right: 8px">
                                        Naselje Gripole spine 53/c<br>
                                        Rovinj, 52210<br></span>
                                    <span style="float: right; margin-left: 8px; ">


                                        Kontakt: 052 803 699<br>
                                        Email: servis-ro@eurotrade.hr
                                    </span>
                                </div><!-- /.col -->

                            </div><!-- /.col -->
                            <div style="clear: both"> <h2 class="page-header"></div>
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info" >
                           
                            <div class="col-sm-4 invoice-col"  style="font-size: 12px">
                                <strong>Podaci o vlasniku</strong>
                                <address>
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
                                <i>Uređaj: </i><p style="display: inline" id="uredaj"></p><br>
                                <i>Serijski: </i><p style="display: inline" id="serijski"></p><br>
                                <i>Datum prodaje: </i><p style="display: inline"  id="dp"></p><br>
                                <i>Račun: </i><p style="display: inline" id="racun"></p><br>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col" style="float: right; font-size: 12px">
                                <h4 style="margin-top: 0px" id="primka"></h4>
                                <b>Zaprimio: </b><p style="display: inline" id="zap"></p><br>
                                <b>Zaprimljeno: </b><p style="display: inline"  id="dz"></p><br>
                                <b id="zav">Datum završetka: </b>
                                <b   id="zav_ser">Završio serviser: </b>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Table row -->
                        <div class="row" style="clear: both">
                            <div class="col-xs-12 table-responsive">
                                <!--<table class="table table-striped"  style="font-size: 12px">
                                    <thead>
                                        <tr>
                                            <th>Uređaj</th>
                                            <th>Serijski</th>
                                            <th>Datum prodaje</th>
                                            <th>Račun</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="uredaj"></td>
                                            <td id="serijski"></td>
                                            <td id="dp"></td>
                                            <td id="racun"></td>
                                        </tr>
                                    </tbody>
                                </table>-->
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
                                    Eurotrade d.o.o. ne odgovara za podatke na računalu, HDD uređaju ili bilo kojem uređaju koji služi za pohranu podataka ili eventualni njihov gubitak. Kod pisača u jamstvu Eurotrade d.o.o. koristi vlastiti potrošni materijal. Kod pisača van jamstva Eurotrade d.o.o. koristi potrošni materijal koji se nalazi u pisaču te postoji mogućnost da će se zbog potrebe servisiranja taj isti potrošiti djelomično ili u cijelosti.

                                    Eurotrade d.o.o. poslije 60 dana od zatvaranja radnog naloga ne snosi odgovornost za robu ukoliko ona nije podignuta.

                                    U slučaju odustajanja od popravka naplaćuje se dijagnostika po važećem cjeniku.

                                    Sve radove, materijale i ostale troškove vezane uz radni nalog (troškovi koji nisu pokriveni ugovornom obvezom ili jamstvom) vlasnik neopozivo naručuje potpisom radnog naloga.
                                </p>
                                <strong>Potpis vlasnika</strong><br><div style="border-bottom:  1px solid black; width: 200px;height: 30px"></div><br>
                                <strong>Naplatiti: </strong><br><div id="naplata"></div>
                            </div><!-- /.col -->
                            <div class="col-xs-6" style="font-size: 9px">
                                <p class="lead" style="font-size: 12px"><b>Ostali Eurotrade centri</b></p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">PULA</th>
                                            <td>
                                                Benediktinske opatije 3<br>
                                                tel. 052/211-632, fax 052/211-637
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>ZAGREB</th>
                                            <td>
                                                Gospodarska ulica 15, Donji Stupnik <br>
                                                tel. 01/6531-230, fax 01/6531-231
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>VARAŽDIN</th>
                                            <td>
                                                Miroslava Krleže 1<br>
                                                tel. 042/331-177, fax 042/331-149
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>RIJEKA</th>
                                            <td>
                                                Eugena Kovačića 2, TC Andrea<br>
                                                tel. 051/680-760, fax 051/680-763<br>                                            
                                                Trg 128 brigade HV 4, Korzo<br>
                                                tel. 051/212-321 
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>SPLIT</th>
                                            <td>
                                                Matoševa 86, Solin<br>
                                                tel. 021/262-012, fax 021/262-015
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>OSIJEK</th>
                                            <td>
                                                Vijenac Jakova Gotovca 5<br>
                                                tel. 031/210-999
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>SISAK</th>
                                            <td>
                                                Ante Starčevića 13<br>
                                                tel. 044/524-498, fax 044/524-499
                                            </td>

                                    </table>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div id="t" class="row no-print">
                            <div class="col-xs-12">
                                <a  class="btn btn-default" onclick="printaj()"><i class="fa fa-print"></i> Print</a>
                                <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                                <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                            </div>
                        </div>
                    </section><!-- /.content -->

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Main Footer --><div class="no-print">
                <?php require_once('pageParts/footer.php') ?>
            </div>
        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- Select2 -->
        <script src="plugins/select2/select2.full.min.js"></script>
        <!-- InputMask -->

        <script type="text/javascript" src="search/searchkupca.js"></script>

       <script>
            var id = <?php echo $_GET['primka'] ?>    
                $.get("json/primka/getById.php", {"id":id}, function(primka){
                   
                   var zaprimljeno = new Date(primka[0].datumZaprimanja);
                   
                   $('#dz').text([zaprimljeno.getDate(), zaprimljeno.getMonth(), zaprimljeno.getFullYear()].join('.') );
                   $('#zap').text(primka[0].pot_ime+ ' ' +primka[0].pot_prezime);
                   $('#primka').text('Primka br. ' +primka[0].primka_id);
                   
                   (primka[0].tvrtka != null && primka[0].tvrtka != '') ? $('#tvrtka').text(primka[0].tvrtka) : $('#tvrtka').text('');
                    $('#adresa').text(primka[0].adresa);
                    $('#grad').text(primka[0].grad);
                    $('#kontakt').text(primka[0].kontaktBroj);
                    $('#email').text(primka[0].email);
                    $('#osoba').text(primka[0].ime + ' ' +primka[0].prezime);
                    
                    
                    $('#uredaj').text(primka[0].naziv);
                    $('#serijski').text(primka[0].serial);
                    
                    var kupljeno = new Date(primka[0].datumKupnje);
                    
                    (kupljeno && kupljeno.getDate() != '1970' && !isNaN(kupljeno)) ?  $('#dp').text([kupljeno.getDate(), kupljeno.getMonth(), kupljeno.getFullYear()].join('.') ):  $('#dp').text('');;
                   
                    $('#racun').text(primka[0].racun);
                    $('#opis').text(primka[0].opisKvara);
                    $('#prilozeno').text(primka[0].prilozeno_primijeceno);
                    
                    $.post("json/rn/getRNbyPrimka.php", {"primka":id}, function(rn){
                        
                        //  UKOLIKO POSTOJI RN POVEZAN SA PRIMKOM
                        if(rn){
                            
                        var rnvelicina= rn.length-1;
                        var rn_zav = new Date(rn[rnvelicina].zavrsetak);
                            
                        (rn_zav && rn_zav.getFullYear() !='1970') ? $('#zav').after([rn_zav.getDate(), rn_zav.getMonth()+1, rn_zav.getFullYear()].join('.')  + '<br>' ):$('#zav').after('<br>');
                        (rn[rnvelicina].d2ime) ? $('#zav_ser').after(rn[rnvelicina].d2ime+' '+rn[rnvelicina].d2prezime + '<br>') : $('#zav_ser').after('<br>');    
                            
                        var opis_popravka = '<b>OPASKA SERVISA:</b> ';
                        var prom = '';   
                        var naplata = '';
                        var odjel = "<?php echo $_COOKIE['odjel'] ?>";    
                            console.log(rn);
                            
                            //      DOHVAĆANJE SA RADNIH NALOGA
                        for(rn of rn){
                            var pocetak_servisa = new Date(rn.pocetak);
                            opis_popravka += '<span><span  class="no-print"><br ><b>Radni nalog:</b> '+rn.id+'. <a style=" cursor: pointer; cursor: hand; " class="no-print">Prikazuje se pri ispisu</a><br><b>Početak servisiranja uređaja:</b> '+ [pocetak_servisa.getDate(), pocetak_servisa.getMonth()+1, pocetak_servisa.getFullYear()].join('.') + '. </span>';
                       
                            if(rn.opis !== null) opis_popravka += '<br>'+  rn.opis+ '. ';
                              var zavrsen_servis = new Date(rn.zavrsetak); 
                            if(zavrsen_servis && zavrsen_servis.getFullYear()!='1970') opis_popravka += '<span  class="no-print"><br><b>Završetak servisiranja:</b> '+ [zavrsen_servis.getDate(), zavrsen_servis.getMonth()+1, zavrsen_servis.getFullYear()].join('.') + '. </span><br>';
                            if(rn.napomena !== null && rn.napomena !== '' && odjel === 'Servis') opis_popravka += '<span   class="no-print"><b>Napomena: </b>'+  rn.napomena+ '. <br></span></span>';
                             prom += rn.promijenjeno+ '<br>';
                             
                              naplata += ' + ' + rn.naplata + '<br>';
                        }
                        $('#popravak').html(opis_popravka);
                            $('#promijenjeno').html(prom);
                            $('#naplata').html(naplata);
                        }// UKOLIKO NE POSTOJI RN POVEZAN SA PRIMKOM
                        else{
                            $('#zav_ser').after('<br>');
                            $('#zav').after('<br>');
                        }
                      
                        
                    });
                    
                    
                   
                });
                
                $('#popravak').on("click", 'a',function(){
                if($(this).text() === 'Skriveno je pri ispisu') {
                    $(this).parent().parent().removeClass('no-print');
                    $(this).text('Prikazuje se pri ispisu');
                }else{
                     $(this).parent().parent().addClass('no-print');
                    $(this).text('Skriveno je pri ispisu');
                }
               
                });
                
                
                function printaj(){
                    window.print();
                }
        </script>

    </body>
</html>

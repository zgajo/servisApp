<?php
include_once 'checkLogin.php';
require_once './klase/primka.php';
require_once './klase/radniNalog.php';
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
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <link href="search/search.css" rel="stylesheet">
        <style>
            #stranka{ width: 35%;
            }
            #primka{
                width: 65%;
            }
            #upr{
                float: left; width: 50%;margin-left: 2%;
            }
            
            .hover{
                background-color: lightblue;
            }

            #urn{
                float: right; width: 45%; margin-right: 2%;
            }
            #required:after { content:" *"; color: red}

            @media (max-width: 1024px){
                #stranka{ width: 100%;
                }
                #primka{
                    width: 100%;
                }
                #upr{
                    float: left; width: 100%; margin: auto;
                }
                #urn{
                    float: right; width: 100%;margin: auto;
                }
                #required:after { content:" *"; }
            }

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
                <section class="content">

                    <?php
                    /*
                      UKOLIKO SE PROVJERAVA PRIMKA
                     */
                    if (isset($_GET['primka'])) {

                        require_once 'pageParts/primkaPagePart/uredi_primku.php';
                    } else if (isset($_GET['pregled_serijski'])) {
                        require_once './pageParts/primkaPagePart/pregled_serijski.php';
                    }
                    /*
                      Prikaz svih naloga
                     */ else {
                        require_once 'pageParts/primkaPagePart/sve_primke.php';
                    }
                    ?>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->
            <?php require_once('pageParts/footer.php') ?>

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

        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- InputMask -->
        <script src="plugins/input-mask/jquery.inputmask.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>

        <!-- Pretrage u sidebaru -->
        <script type="text/javascript" src="search/searchkupca.js"></script>
        <script type="text/javascript" src="search/searchprimka.js"></script>
        <script type="text/javascript" src="search/searchserijski.js"></script>


        <?php if (!isset($_GET['primka']) && !isset($_GET['pregled_serijski'])) { ?>

            <script src="search/unos_primke.js" type="text/javascript"></script>

            <script src="search/sve_primke.js" type="text/javascript"></script>
            <script>
                //    LISTANJE SVIH  POSLANIH PRIMKI
                var centar = "<?php echo $_COOKIE['centar'] ?>";
                var odjel = "<?php echo $_COOKIE['odjel'] ?>";


                $.ajax({
                    url: "json/primka/svePoslanePrimke.php",
                    type: 'POST',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function () {
                        if (odjel === "Servis") {
                            $('#svePoslanePrimke').DataTable({
                                "ajax": {
                                    "url": "json/primka/svePoslanePrimke.php",
                                    "dataSrc": ""
                                },
                                "columns": [
                                    {data: "primka_id", "render": function (data, type, row, meta) {
                                            var output = "";
                                            if (odjel === "Servis")
                                                output += '<a target="_blank" id="novi_rn" style="margin-right:15px" class="glyphicon glyphicon-share" href="rn.php?action=novi_rn&primka_id=' + row.primka_id + '"></a>';
                                             output += '<a target="_blank" id="novi_rma" class="glyphicon glyphicon-random" href="rma.php?action=novi_rma&poslano=Da&primka_id=' + row.primka_id + '"></a>';
                                            return output;
                                        }},
                                    {"data": "primka_id", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                            var output = "";
                                            var danas = new Date();
                                            var datum = new Date(row.datumZaprimanja);
                                            var oneDay = 24 * 60 * 60 * 1000;
                                            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime()) / (oneDay)));

                                            if (diffDays <= 10)
                                                var sty = "label label-success";
                                            if (diffDays > 10 && diffDays <= 17)
                                                var sty = "label label-warning";
                                            if (diffDays > 17)
                                                var sty = "label label-danger";
                                            output += '<a class="' + sty + '">' + row.primka_id + '</a>'; // row object contains the row data
                                            return output;
                                        }},
                                    {"data": "primka_id", "render": function (data, type, row, meta) {
                                            var r = null;
                                            var rm = null;


                                            var output = '';
                                            //    DOHVAĆANJE RADNIH NALOGA
                                            $.ajax({
                                                async: false,
                                                url: "json/rn/getRNbyPrimka.php",
                                                type: 'POST',
                                                data: {"primka": row.primka_id},
                                                success: function (data) {

                                                    r = data;

                                                }});
                                            //    DOHVAĆANJE RMA NALOGA
                                            $.ajax({
                                                async: false,
                                                url: "json/rma/getRmaByPrimka.php",
                                                type: 'GET',
                                                data: {"primka": row.primka_id},
                                                success: function (data) {

                                                    rm = data;

                                                }});
                                            //    UKOLIKO IMA DOHVAĆENIH rn
                                            if (r !== null && r.length > 0) {
                                                for (var j = 0; j < r.length; ++j) {
                                                    output += '<a target="_blank" id="uredi_rn" href="rn.php?radni_nalog=' + r[j].id + '"> RN. ' + r[j].id + '</a><br>';
                                                }
                                            }
                                            //    UKOLIKO IMA DOHVAĆENIH rma

                                            if (rm !== null && rm.length > 0) {
                                                for (var j = 0; j < rm.length; ++j) {
                                                    output += '<a target="_blank" id="uredi_rma" href="rma.php?rma=' + rm[j].id + '"> RMA. ' + rm[j].id + '</a><br>';
                                                }
                                            }

                                            return output;

                                        }},
                                    {"data": "naziv"},
                                    {"data": "serial"},
                                    {"data": "s_ime", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                            var osoba = row.s_ime + ' ' + row.s_prezime;
                                            return osoba;
                                        }},
                                    {"data": "datumZaprimanja", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                            var d = new Date(row.datumZaprimanja);
                                            var dat = (d && d.getFullYear() != '1970') ? [d.getDate(), d.getMonth() + 1, d.getFullYear()].join('.') : ' ';
                                            return dat;
                                        }},
                                    {"data": "status"},
                                    {"data": "centar"}


                                ]



                            });
                        } else {
                            $('#svePoslanePrimke').DataTable({
                                "ajax": {
                                    "url": "json/primka/svePoslanePrimke.php",
                                    "dataSrc": ""
                                },
                                "columns": [
                                    {"data": "primka_id", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                            var output = "";
                                            var danas = new Date();
                                            var datum = new Date(row.datumZaprimanja);
                                            var oneDay = 24 * 60 * 60 * 1000;
                                            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime()) / (oneDay)));

                                            if (diffDays <= 10)
                                                var sty = "label label-success";
                                            if (diffDays > 10 && diffDays <= 17)
                                                var sty = "label label-warning";
                                            if (diffDays > 17)
                                                var sty = "label label-danger";
                                            output += '<a class="' + sty + '">' + row.primka_id + '</a>'; // row object contains the row data
                                            return output;
                                        }},
                                    {"data": "naziv"},
                                    {"data": "serial"},
                                    {"data": "s_ime", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                            var osoba = row.s_ime + ' ' + row.s_prezime;
                                            return osoba;
                                        }},
                                    {"data": "datumZaprimanja", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                            var d = new Date(row.datumZaprimanja);
                                            var dat = (d && d.getFullYear() != '1970') ? [d.getDate(), d.getMonth() + 1, d.getFullYear()].join('.') : ' ';
                                            return dat;
                                        }},
                                    {"data": "status"}


                                ]



                            });
                        }

                    },
                    error: function (rn) {
                    }
                })
                $('#svePoslanePrimke').on("mouseover", "#novi_rn", function(){
                   $(this).attr('title', 'Započni servisiranje'); 
                });
                 $('#svePoslanePrimke').on("mouseover", "#novi_rma", function(){
                   $(this).attr('title', 'Stvori novi RMA nalog'); 
                });
                $('#svePoslanePrimke').on("mouseover", "#uredi_rn", function(){
                   $(this).attr('title', 'Uredi radni nalog'); 
                });
                $('#svePoslanePrimke').on("mouseover", "#uredi_rma", function(){
                   $(this).attr('title', 'Uredi RMA nalog'); 
                });


                //    KRAJ    *   LISTANJE SVIH POSLANIH PRIMKI  * KRAJ
            </script>
        <?php } else if (isset($_GET['pregled_serijski'])) { ?>                  
            <script>

                var serijski = "<?php echo $_GET['pregled_serijski'] ?>";
                console.log(serijski);
                $('#serijski_primke').DataTable({
                    "ajax": {
                        "url": "json/primka/getBySerijski.php?serijski=" + serijski,
                        "dataSrc": ""
                    },
                    "columns": [
                        {"data": "primka", "render": function (data, type, row, meta) {
                                var a = '<a style="margin-right:20px" href="pregled.php?primka=' + row.primka + '"><i style="" class="fa  fa-file-text-o"></i></a><p style="display:inline">' + row.primka + '</p>';
                                return a;
                            }},
                        {"data": "status", "render": function (data, type, row, meta) {
                                var dz = new Date(row.zaprimljeno);
                                return [dz.getDate(), dz.getMonth() + 1, dz.getFullYear()].join('.');
                            }},
                        {"data": "uredaj"},
                        {"data": "status", "render": function (data, type, row, meta) {
                                return row.ime + ' ' + row.prezime;
                            }},
                        {"data": "status"}
                    ]
                });
            </script>               
        <?php } else { ?>
            <script>
                $("#uk").attr('title', 'Otvori formu za izmjenu podataka kupca');
$("#up").attr('title', 'Otvori formu za izmjenu podataka primke');
                $(document).ready(function () {

                    var pid = <?php echo $_GET['primka'] ?>
                    
                    funPrimka();

                    function funPrimka() {
                        // Dohvaćanje i pregled upita
                        $.ajax({
                            type: 'GET',
                            url: "json/primka/getById.php",
                            data: {"id": pid},
                            dataType: 'json',
                            contentType: "application/json; charset=utf-8",
                            success: function (data) {

                                var pp = JSON.parse(JSON.stringify(data));

                                var dz = new Date(pp[0].datumZaprimanja);
                                var dk = new Date(pp[0].datumKupnje);
                                var dztv = new Date(pp[0].datumZatvaranja);

                                // PODACI KUPCA

                                $('#ip_kupca').text(pp[0].ime + ' ' + pp[0].prezime);
                                $('#tvrtka').text(pp[0].tvrtka).show();
                                $('#kontakt').text(pp[0].kontaktBroj);
                                $('#email').after('');
                                if(pp[0].email) $('#email').text(pp[0].email); else{ $('#email').hide()};
                                $('#grad').text(pp[0].grad);
                                $('#adresa').text(pp[0].adresa);

                                //     PODACI PRIMKE

                                $('#zap').text([dz.getDate(), dz.getMonth() + 1, dz.getFullYear()].join('.') + ' /  ' + [(dz.getHours() < 10 ? '0' : '') + dz.getHours(), (dz.getMinutes() < 10 ? '0' : '') + dz.getMinutes()].join(':'));
                                $('#po').text(pp[0].pot_ime + ' ' + pp[0].pot_prezime);
                                $('#nu').text(pp[0].naziv);
                                $('#serijski').text(pp[0].serial);
                                $('#brand').text(pp[0].brand);
                                $('#tip').text(pp[0].tip);
                                (dk.getFullYear()!='1970' && dk) ? $('#dk').text([dk.getDate(), dk.getMonth() + 1, dk.getFullYear()].join('.')) :  $('#dk').text() ;
                                $('#br').text(pp[0].racun);
                                $('#ok').text(pp[0].opisKvara);
                                $('#pp').text(pp[0].prilozeno_primijeceno);
                                
                                 var st = pp[0].p_status;


                                // POSTAVLJANJE ZA SELECTED
                                var o = new Option(st, st);
                                /// jquerify the DOM object 'o' so we can use the html method
                                $(o).html(st);
                                $("#status_primke").append(o);
                                $('#status_primke option[value="' + st + '"]').attr("selected", true);
                                    
                                $('#inputTvrtka').val(pp[0].tvrtka);
                                $('#inputIme').val(pp[0].ime);
                                $('#inputPrezime').val(pp[0].prezime);
                                $('#inputAdresa').val(pp[0].adresa);
                                $('#inputGrad').val(pp[0].grad);
                                $('#inputPB').val(pp[0].postBroj);
                                $('#inputKontakt').val(pp[0].kontaktBroj);
                                $('#inputEmail').val(pp[0].email);
                                $('#inputid').text(pp[0].stranka_id);

                                //primka u input
                                $('#inputPK').val(pp[0].opisKvara);
                                $('#inputNaziv').val(pp[0].naziv);
                                $('#inputSifra').val(pp[0].sifraUredaja);
                                $('#inputBrand').val(pp[0].brand);
                                $('#inputTip').val(pp[0].tip);
                                $('#inputSerijski').val(pp[0].serijski);
                                if (dk.getFullYear()!='1970' && dk)
                                    $('#inputDK').val([dk.getDate(), dk.getMonth() + 1, dk.getFullYear()].join('.'));
                                $('#inputRacun').val(pp[0].racun);
                                $('#inputPP').val(pp[0].prilozeno_primijeceno);

                                //  AKO JE KUPAC PREUZEO PRIMKU
                                if (pp[0].p_status == 'Kupac preuzeo') {
                                    $('#skp').show();

                                    $('#azurirajDiv').hide();
                                    $('#pregledFooter').hide();
                                    $('#uk').hide();
                                    $('#up').hide();

                                    $('#zav').text([dztv.getDate(), dztv.getMonth() + 1, dztv.getFullYear()].join('.') + ' /  ' + [(dztv.getHours() < 10 ? '0' : '') + dztv.getHours(), (dztv.getMinutes() < 10 ? '0' : '') + dztv.getMinutes()].join(':')).show();
                                    $('#pz').text(pp[0].pzt_ime + ' ' + pp[0].pzt_prezime).show();
                                    $('#st').text(pp[0].p_status);
                                }


                                //  ISPIS RADNIH I RMA NALOGA KOJI SU POVEZANI SA PRIMKOM
                                $.post("json/rn/getRNbyPrimka.php", {"primka": pid}, function (e) {

                                    var rn = JSON.parse(JSON.stringify(e));

                                    var output = '';

                                    if (rn !== null && rn.length > 0) {
                                        for (var i = 0; i < rn.length; ++i) {

                                            var rnp = new Date(rn[i].pocetak);
                                            var rnz = new Date(rn[i].zavrsetak);

                                            output += '<div class="col-md-6" style="width: 100%">' +
                                                    '<div class="box box-info" style="border-top-color:#00a65a">' +
                                                    '<div class="box-body" style="clear: both">' +
                                                    '<div class="box-header with-border">' +
                                                    '<h3 class="box-title">Radni nalog servisa br. ' + rn[i].id + '</h3> ' +
                                                    '</div>' +
                                                    '<div  id="primka" class="col-sm-4 invoice-col" >' +
                                                    '<address>' +
                                                    '<i><strong>Početak rada: </strong></i>' + [rnp.getDate(), rnp.getMonth() + 1, rnp.getFullYear()].join('.') + ' /  ' + [(rnp.getHours() < 10 ? '0' : '') + rnp.getHours(), (rnp.getMinutes() < 10 ? '0' : '') + rnp.getMinutes()].join(':') + '<br>' +
                                                    '<i><strong>Rad započeo: </strong></i></strong>' + rn[i].d1ime + ' ' + rn[i].d1prezime + '<br>' +
                                                    '<i><strong>Opis popravka: </strong></i></strong><hr>';
                                            output += (rn[i].opis) ? rn[i].opis : "";
                                            output += "<i><strong>Status radnog naloga: </strong></i>"; output += (rn[i].status) ?rn[i].status:'' ;
                                            output += '<hr>' +
                                                    '<i><strong>Naplatiti: </strong></i></strong>';
                                            output += (rn[i].naplata) ? rn[i].naplata : "";
                                            output += '<br>' +
                                                    '<i><strong>Rad završio: </strong></i></strong>';
                                            output += (rn[i].d2ime) ? rn[i].d2ime + ' ' + rn[i].d2prezime : "";
                                            output += '<br>' +
                                                    '<i><strong>Završetak rada: </strong></i> </strong>';
                                            output += (rnz && rnz.getFullYear() != "1970") ? [rnz.getDate(), rnz.getMonth() + 1, rnz.getFullYear()].join('.') + ' /  ' + [(rnz.getHours() < 10 ? '0' : '') + rnz.getHours(), (rnz.getMinutes() < 10 ? '0' : '') + rnz.getMinutes()].join(':') : "";
                                            output += '<br>' +
                                                    '</address>' +
                                                    ' </div>' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '</div>';

                                        }
                                        $('#urn').html(output);
                                    }


                                });

                                $.get("json/rma/getRmaByPrimka.php", {"primka": pid}, function (e) {

                                    var rma = JSON.parse(JSON.stringify(e));

                                    var output = '';

                                    output += $('#urn').html();

                                    if (rma !== null && rma.length > 0) {
                                        for (var i = 0; i < rma.length; ++i) {

                                            var rnp = new Date(rma[i].pripremljeno);
                                            var rnpos = new Date(rma[i].poslano);
                                            var rnvr = new Date(rma[i].zavrseno);

                                            output += '<div class="col-md-6" style="width: 100%">' +
                                                    '<div class="box box-info" style="border-top-color:#ec971f">' +
                                                    '<div class="box-body" style="clear: both">' +
                                                    '<div class="box-header with-border">' +
                                                    '<h3 class="box-title">RMA nalog br. ' + rma[i].id + ' </h3>' +
                                                    ' </div>' +
                                                    '<div  id="primka" class="col-sm-4 invoice-col" >' +
                                                    '<address>' +
                                                    '<i><strong>Pripremljeno za slanje: </strong></i>' + [rnp.getDate(), rnp.getMonth() + 1, rnp.getFullYear()].join('.') + ' /  ' + [(rnp.getHours() < 10 ? '0' : '') + rnp.getHours(), (rnp.getMinutes() < 10 ? '0' : '') + rnp.getMinutes()].join(':') + '<br>' +
                                                    '<i><strong>Poslano u ovlašteni servis: </strong></i>   </strong>';
                                            output += (rnpos && rnpos.getFullYear() != "1970" && !isNaN(rnpos)) ? [rnpos.getDate(), rnpos.getMonth() + 1, rnpos.getFullYear()].join('.') + ' /  ' + [(rnpos.getHours() < 10 ? '0' : '') + rnpos.getHours(), (rnpos.getMinutes() < 10 ? '0' : '') + rnpos.getMinutes()].join(':') : "";
                                            output += '<br>' +
                                                    '<i><strong>Uređaj poslao:  </strong></i>   </strong>' + rma[i].doime + ' ' + rma[i].doprezime + '<hr>' +
                                                    '<i><strong>Ovlašteni servis: </strong></i> </strong>'; 
                                            output +=  (rma[i].nazivOS) ? rma[i].nazivOS  : '';
                                            output += '<br>' +
                                                    '<i><strong>Radni nalog ovlaštenog servisa: </strong></i>  </strong>' + rma[i].rnOs + '<br>' +
                                                    '<i><strong>Opis popravka: </strong></i>   </strong> ' + rma[i].opis + '<br>                ' +
                                                    '<i><strong>Status reklamacije: </strong></i>   </strong>' + rma[i].status + '<hr>' +
                                                    ' <i><strong>Vraćeno iz ovlaštenog servisa: </strong></i> </strong>';
                                            output += (rnvr && rnvr.getFullYear() != "1970") ? [rnvr.getDate(), rnvr.getMonth() + 1, rnvr.getFullYear()].join('.') + ' /  ' + [(rnvr.getHours() < 10 ? '0' : '') + rnvr.getHours(), (rnvr.getMinutes() < 10 ? '0' : '') + rnvr.getMinutes()].join(':') : "";
                                            output += '<br><i><strong>Zatvorio nalog: </strong></i>  </strong>';
                                            output += (rma[i].dzime) ? rma[i].dzime + ' ' + rma[i].dzprezime : "";
                                            output += '<br>' +
                                                    '<i><strong>Naplatiti: </strong></i>  </strong>' + rma[i].naplata + '<br>' +
                                                    '</address>' +
                                                    '</div>' +
                                                    '</div>' +
                                                    ' </div>' +
                                                    '</div>';

                                        }
                                        $('#urn').html(output);
                                    }

                                });
                                //  KRAJ    *   ISPIS RADNIH I RMA NALOGA KOJI SU POVEZANI SA PRIMKOM   *   KRAJ

                                $('#urn').show();
                                $('#upr').show();
                                $('#uredi_kupca').hide();
                                $('#uredi_primku').hide();




                            },
                            error: function (e) {
                                alert(e.message);
                            }
                        });

                    }
                    //Ažuriranje upita
                    $('#azuriraj_status').on("click", this, function () {

                        var status = $('select').val();
                        if(confirm('Ažurirati status u: "'+status+'"?'))    
                        $.ajax({
                            async: false,
                            url: "json/primka/primkaStatusUpdate.php",
                            type: "POST",
                            data: {
                                "status": status, "id": pid
                            },
                            success: function (e) {
                                if(status == 'Poslano u CS - Rovinj'){
                                    var ruc = window.open('rucne.php?primka='+pid, '_blank');
                                if (ruc) {
                                                        //Browser has allowed it to be opened
                                                        ruc.focus();
                                                    } else {
                                                        //Browser has blocked it
                                                        alert('Molim Vas, omogućite prikaz skočnih prozora');
                                                    }
                                                }
                                window.location = "primke.php?primka=" + pid;
                            },
                            error: function (e) {
                                alert('nije u redu' + e);
                            }
                        });

                    });


                    

                    $('#btnNovo').click(function () {


                        $('#novo').toggle();

                    });


                    //    SPREMANJE IZMJENE KUPCA
                    $('#spremiKupca').click(function (e) {
                        e.preventDefault();

                        var tvrtka = $('#inputTvrtka').val();
                        var ime = $('#inputIme').val();
                        var prezime = $('#inputPrezime').val();
                        var adresa = $('#inputAdresa').val();
                        var grad = $('#inputGrad').val();
                        var pb = $('#inputPB').val();
                        var kontakt = $('#inputKontakt').val();
                        var email = $('#inputEmail').val();
                        var idkupca = $('#inputid').text();

                        if (ime === '' || prezime === '' || kontakt === '') {
                            alert('Molim vas da ispunite sva polja');
                        } else {
                            $.post('json/kupac/updateKupca.php', {
                                "tvrtka": tvrtka,
                                "ime": ime,
                                "prezime": prezime,
                                "adresa": adresa,
                                "grad": grad,
                                "pb": pb,
                                "kontakt": kontakt,
                                "email": email,
                                "id": idkupca
                            }, function(data){funPrimka()});
                            

                            $('#upr').show();
                            $('#uredi_kupca').hide();
                            $('#urn').show();

                        }

                    });
                    //  KRAJ * SPREMANJE IZMJENE KUPCA * KRAJ
                    
                    
                    $('#narudzba').click(function(){
                    var pr= <?php echo $_GET['primka'] ?>;
                    window.location = "narudzbe.php?primka="+pr+"&stranka="+$('#inputid').text();
                    })



                    //   SPREMANJE IZMJENE PRIMKE
                    $('#spremiPrimku').click(function () {
                        //primka
                        var naziv = $('#inputNaziv').val();
                        var sifra = $('#inputSifra').val();
                        var brand = $('#inputBrand').val();
                        var tip = $('#inputTip  option:selected').text();
                        var serijski = $('#inputSerijski').val();
                        var dat_k = $('#inputDK').val();
                        var racun = $('#inputRacun').val();
                        var opis = $('#inputPK').val();
                        var prilozeno = $('#inputPP').val();

                        if (opis === '' || naziv === '') {
                            alert('Molim vas da ispunite obavezna sva polja');
                        } else {
                            $.post("json/primka/updatePrimka.php", {
                                "su": sifra, "b": brand, "t": tip, "n": naziv, "s": serijski,
                                "ok": opis, "pp": prilozeno, "r": racun, "dk": dat_k, "id": pid
                            });

                            $('#nu').text(naziv);
                            $('#serijski').text(serijski);
                            $('#brand').text(brand);
                            $('#tip').text(tip);
                            $('#dk').text(dat_k);
                            $('#br').text(racun);
                            $('#ok').text(opis);
                            $('#pp').text(prilozeno);

                            $('#urn').show();
                            $('#upr').show();
                            $('#uredi_primku').hide();
                        }



                    });


                    //   KRAJ    *   SPREMANJE IZMJENE PRIMKE   *   KRAJ

                    //  OMOGUĆAVANJE UREĐIVANJE KUPCA / PRIMKE

                    $('#uk').click(function () {
                        $('#upr').hide();
                        $('#uredi_kupca').show();
                        $('#urn').hide();
                    });

                    $('#ponistiK').click(function () {
                        $('#status_primke option:last-child').remove();
                        
                        funPrimka();
                         

                    });

                    $('#up').click(function () {
                        $('#upr').hide();
                        $('#uredi_primku').show();
                        $('#urn').hide();
                    });

                    $('#ponistiUK').click(function () {
                        
                        $('#status_primke option:last-child').remove();
                        funPrimka();
                        
                        
                    });

                    //  KRAJ    *   OMOGUĆAVANJE UREĐIVANJE KUPCA / PRIMKE   *   KRAJ


                });
            </script>
        <?php } ?>
        <!-- date-range-picker -->
        <script>
            $(function () {

                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd.mm.yyyy", {"placeholder": "dd.mm.yyyy"});

                //Money Euro
                $("[data-mask]").inputmask();

            });
        </script>
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>
</html>

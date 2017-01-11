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
        <title>RMA Nalozi</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        
        <link href="search/search.css" rel="stylesheet">

        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
        <style>
            #stranka{ width: 35%;
            }
            #primka{
                width: 65%;
            }
            @media (max-width: 768px){
                #stranka{ width: 100%;
                }
                #primka{
                    width: 100%;
                }
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
                    if (isset($_GET['action'])) {
                        if ($_GET['action'] == "novi_rma" && !empty($_GET['primka_id'])) {

                            $rma = new rmaNalog();
                            $last = $rma->insert($_GET['primka_id'], $_COOKIE['id']);
                            unset($rma);


                            $primka = new primka();
                            $primka->azurirajStatus("Pripremljeno za slanje OS-u", $_GET['primka_id']);



                            unset($primka);
                            echo '<script> '
                            . 'setTimeout(function(){ window.location.href="rma.php?rma=' . $last . '";}, 100);'
                            . '</script>';
                            ?>

                        <?php
                        }
                    } else if (!empty($_GET['rma'])) {

                        require_once('pageParts/rmaPagePart/uredi_rma.php');
                    } else {

                        require_once('pageParts/rmaPagePart/svi_rma.php');
                    }
                    ?>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

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
        <script type="text/javascript" src="search/searchkupca.js"></script>
<script type="text/javascript" src="search/searchprimka.js"></script>
<script>
$('#rucna').click(function(){
    var primka = $('#primka_id').text();
    window.open("rucne.php?primka="+primka, "_blank");
});
</script>


<?php if (!empty($_GET['rma'])) { ?>
            <script>
                $(document).ready(function () {
                    
                    var rnid = <?php echo $_GET['rma'] ?>;

                    function upisrn(rnid){
                    $.post("json/rma/getById.php", {"id": rnid},function (rn) {
                                console.log(rn);

                                var pocetak = new Date(rn[0].danZaprimanja);
                                var poslano = new Date(rn[0].poslanoOSu);
                                var vraceno = new Date(rn[0].vracenoIzOSa);
                                var zavrseno = new Date(rn[0].danZavrsetka);

                                //   UPIS RMA NALOGA
                                $('#pocetak').text([pocetak.getDate(), pocetak.getMonth()+1, pocetak.getFullYear()].join('.') + ' / ' + [((pocetak.getHours() < 10) ? '0' : '') + pocetak.getHours(), (pocetak.getMinutes() < 10 ? '0' : '') + pocetak.getMinutes()].join(':'));
                                (poslano && poslano.getFullYear() != "1970") ? $('#poslano').text([poslano.getDate(), poslano.getMonth()+1, poslano.getFullYear()].join('.') + ' / ' + [((poslano.getHours() < 10) ? '0' : '') + poslano.getHours(), (poslano.getMinutes() < 10 ? '0' : '') + poslano.getMinutes()].join(':')) : $('#poslano').text();
                                $('#zapoceo').text(rn[0].zapoceoRn_ime + ' ' + rn[0].zapoceoRn_prezime);
                                $('#inputrnOS').val(rn[0].rnOS);
                                $('#inputOSnaziv').val(rn[0].nazivOS);
                                $('#inputPopravak').val(rn[0].opisPopravka);
                                $('#inputNapomena').val(rn[0].napomena);
                                $('#inputNaplata').val(rn[0].naplata);
                                $('#status_rma').val(rn[0].status);

                                if (rn[0].zavrsioRn_ime !== '' && rn[0].zavrsioRn_ime !== null) {
                                    $('#zavrad').show();
                                    $('#zavrsio').text(rn[0].zavrsioRn_ime + ' ' + rn[0].zavrsioRn_prezime);
                                }

                                if (vraceno.getFullYear() != '1970' && vraceno) {
                                    $('#vr').show();
                                    $('#vraceno').text([vraceno.getDate(), vraceno.getMonth()+1, vraceno.getFullYear()].join('.') + ' / ' + [((vraceno.getHours() < 10) ? '0' : '') + vraceno.getHours(), (vraceno.getMinutes() < 10 ? '0' : '') + vraceno.getMinutes()].join(':'));
                                }

                                if (zavrseno.getFullYear() != '1970' && zavrseno) {
                                    $('#zr').show();
                                    $('#zavrseno').text([zavrseno.getDate(), zavrseno.getMonth()+1, zavrseno.getFullYear()].join('.') + ' / ' + [((zavrseno.getHours() < 10) ? '0' : '') + zavrseno.getHours(), (zavrseno.getMinutes() < 10 ? '0' : '') + zavrseno.getMinutes()].join(':'));
                                }

                                //   kraj    *   UPIS RMA NALOGA *   KRAJ


                               
                            }
                    );
                    }
            
                     //       UPIS PRIMKE
                     function  upisprik(rnid){
                    $.post("json/rma/getById.php", {"id": rnid},function (rn){
                        $.get("json/primka/getById.php", {"id": rn[0].primka_id},  function (primka) {
                                            console.log(primka);

                                            var dz = new Date(primka[0].datumZaprimanja);
                                            var dk = new Date(primka[0].datumKupnje);
                                            // PODACI KUPCA

                                            $('#ip_kupca').text(primka[0].ime + ' ' + primka[0].prezime);
                                     $('#tvrtka').text(primka[0].tvrtka).show();
                                     $('#kontakt').text(primka[0].kontaktBroj);
                                     $('#email').after('');
                                     if(primka[0].email) $('#email').text(primka[0].email); else{ $('#email').hide()};
                                     $('#grad').text(primka[0].grad);
                                     $('#adresa').text(primka[0].adresa);
                                            
                                            $('#inputid').text(primka[0].stranka_id);
                                        $('#inputTvrtka').val(primka[0].tvrtka);
                                        $('#inputIme').val(primka[0].ime);
                                        $('#inputPrezime').val(primka[0].prezime);
                                        $('#inputAdresa').val(primka[0].adresa);
                                        $('#inputGrad').val(primka[0].grad);
                                        $('#inputPB').val(primka[0].postBroj);
                                        $('#inputKontakt').val(primka[0].kontaktBroj);
                                        $('#inputEmail').val(primka[0].email);

                                            //     PODACI PRIMKE
                                            $('#primkanaslov').text('Primka ' + primka[0].primka_id);
                                            $('#zap').text([dz.getDate(), dz.getMonth() + 1, dz.getFullYear()].join('.') + ' /  ' + [(dz.getHours() < 10 ? '0' : '') + dz.getHours(), (dz.getMinutes() < 10 ? '0' : '') + dz.getMinutes()].join(':'));
                                            $('#po').text(primka[0].pot_ime + ' ' + primka[0].pot_prezime);
                                            $('#nu').text(primka[0].naziv);
                                            $('#serijski').text(primka[0].serijski);
                                            $('#brand').text(primka[0].brand);
                                            $('#tip').text(primka[0].tip);
                                            (dk.getFullYear() !== '1970' && dk) ? $('#dk').text() : $('#dk').text([dk.getDate(), dk.getMonth() + 1, dk.getFullYear()].join('.'));
                                            $('#br').text(primka[0].racun);
                                            $('#ok').text(primka[0].opisKvara);
                                            $('#pp').text(primka[0].prilozeno_primijeceno);
                                            $('#st').text(primka[0].p_status);
                                            $('#primka_id').text(primka[0].primka_id);
                                            
                                            $('#inputPK').val(primka[0].opisKvara);
                                $('#inputNaziv').val(primka[0].naziv);
                                $('#inputSifra').val(primka[0].sifraUredaja);
                                $('#inputBrand').val(primka[0].brand);
                                $('#inputTip').val(primka[0].tip);
                                $('#inputSerijski').val(primka[0].serijski);
                                var dk = new Date(primka[0].datumKupnje);
                                if (dk.getFullYear() != '1970' && dk)
                                    $('#inputDK').val([dk.getDate(), dk.getMonth() + 1, dk.getFullYear()].join('.'));
                                $('#inputRacun').val(primka[0].racun);
                                $('#inputPP').val(primka[0].prilozeno_primijeceno);
                                   $('#pid').text(primka[0].primka_id);
                                            
                                            
                                        }
                      );     
                    });
                     
                      }
                     //   KRAJ   *    UPIS PRIMKE    *   KRAJ
                     
                     upisrn(rnid);
                     upisprik(rnid);


                    //Ažuriranje statusa rma
                    $('#azuriraj_status').on("click", this, function () {
                        if (confirm('Jeste li sigurni da želite ažurirati?')) {

                            var status_primke = $('#st').text();
                            var primka_id = $('#primka_id').text();
                            var status = $('select').val();

                            if (status === "Popravak završen u jamstvu" || status === "Popravak završen van jamstva" || status === "Stranka odustala od popravka") {
                                $.post("json/rma/zatvori.php", {"id": rnid, "status": status, "popravak": $('#inputPopravak').val(), "napomena": $('#inputNapomena').val(), "naplata": $("#inputNaplata").val(), "rnOS": $("#inputrnOS").val(), "nazivOS": $('#inputOSnaziv').val()});
                                $.post("json/primka/primkaStatusUpdate.php", {"status": "Završen popravak", "id": primka_id}, function () {
                                    window.location = "rma.php?rma=" + rnid;
                                    
                                                var pre = window.open('pregled.php?primka='+primka_id, '_blank');
                                                    if (pre) {
                                                        //Browser has allowed it to be opened
                                                        pre.focus();
                                                    } else {
                                                        //Browser has blocked it
                                                        alert('Molim Vas, omogućite prikaz skočnih prozora');
                                                    }
                                });

                            } else if (status === "Poslano u OS") {
                                // PROVJERA DA LI JE VEĆ POSLANA REKLAMACIJA
                                if ($('#poslano').text()) {
                                    $.post("json/rma/azuriraj.php", {"id": rnid, "status": status, "popravak": $('#inputPopravak').val(), "napomena": $('#inputNapomena').val(), "naplata": $("#inputNaplata").val(), "rnOS": $("#inputrnOS").val(), "nazivOS": $('#inputOSnaziv').val()});

                                } else {
                                    $.post("json/rma/posalji.php", {"id": rnid, "status": status, "popravak": $('#inputPopravak').val(), "napomena": $('#inputNapomena').val(), "naplata": $("#inputNaplata").val(), "rnOS": $("#inputrnOS").val(), "nazivOS": $('#inputOSnaziv').val()});

                                }
                                $.post("json/primka/primkaStatusUpdate.php", {"status": status, "id": primka_id}, function () {
                                    window.location = "rma.php?rma=" + rnid;
                                });

                            } else {
                                $.post("json/rma/azuriraj.php", {"id": rnid, "status": status, "popravak": $('#inputPopravak').val(), "napomena": $('#inputNapomena').val(), "naplata": $("#inputNaplata").val(), "rnOS": $("#inputrnOS").val(), "nazivOS": $('#inputOSnaziv').val()});
                                $.post("json/primka/primkaStatusUpdate.php", {"status": status, "id": primka_id}, function () {
                                    window.location = "rma.php?rma=" + rnid;
                                });

                            }
                        } else {
                        }


                    });
                    //  ****    KRAJ AŽURIRANJA RMA     ***
                    
                    
                    $('#uk').click(function () {
                        $('#upr').hide();
                        $('#uredi_kupca').show();
                        $('#urn').hide();
                    });

                    $('#ponistiK').click(function () {
                        upisprik(rnid);
                        $('#upr').show();
                        $('#uredi_kupca').hide();
                        $('#urn').show();

                    });

                    $('#up').click(function () {
                        $('#upr').hide();
                        $('#uredi_primku').show();
                        $('#urn').hide();
                    });

                    $('#ponistiUK').click(function () {
                        upisprik(rnid);
                        $('#upr').show();
                        $('#uredi_primku').hide();
                        $('#urn').show();
                    });
                    
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
                            });
                            upisprik(rnid);
                        $('#upr').show();
                        $('#uredi_kupca').hide();
                        $('#urn').show();
                    }

                    });
                    
                    //   SPREMANJE IZMJENE PRIMKE
                    $('#spremiPrimku').click(function () {
                        //primka
                        var naziv = $('#inputNaziv').val();
                        var sifra = $('#inputSifra').val();
                        var brand = $('#inputBrand').val();
                        var tip = $('#inputTip').val();
                        var serijski = $('#inputSerijski').val();
                        var dat_k = $('#inputDK').val();
                        var racun = $('#inputRacun').val();
                        var opis = $('#inputPK').val();
                        var prilozeno = $('#inputPP').val();
                        
                        if (opis === '' || naziv === '') {
                            alert('Molim vas da ispunite obavezna sva polja');
                        } else {
                            var pid = $('#pid').text();
                            
                            $.post("json/primka/updatePrimka.php", {
                                "su": sifra, "b": brand, "t": tip, "n": naziv, "s": serijski,
                                "ok": opis, "pp": prilozeno, "r": racun, "dk": dat_k, "id": pid
                            });

                           upisprik(rnid);
                        $('#upr').show();
                        $('#uredi_primku').hide();
                        $('#urn').show();
                        }



                    });






                });
            </script>

<?php } 
    else { 
    
    if($_COOKIE['odjel'] == "Servis" || $_COOKIE['odjel'] == "Reklamacije"){
    
    ?>
            <script type="text/javascript" src="pageParts/rmaPagePart/svi_rma_sr.js"></script>
    <?php }else { ?>
             <script type="text/javascript" src="pageParts/rmaPagePart/svi_rma.js"></script>
    <?php } ?>
           

<?php } ?>


        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>
</html>
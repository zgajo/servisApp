<?php
include_once './checkLogin.php';
include_once './klase/radniNalog.php';
include_once './klase/primka.php';
include_once './klase/osoba.php';

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
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
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
                
                #urn{
                     float: right; width: 45%; margin-right: 2%;
                }
                
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

            <?php include './pageParts/header.php'; ?>
            <?php include './pageParts/sidebar.php'; ?>

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
                        
                        require_once './pageParts/primkaPagePart/uredi_primku.php';
                        
                    }
                    /*
                    Otvaranje nove primke
                    */
                    else if ($_GET['action'] == "nova_primka") {

                        require_once './pageParts/primkaPagePart/nova_primka.php';

                       
                       }
                       /*
                       Prikaz svih naloga
                       */
                       else { 
                    require_once './pageParts/primkaPagePart/sve_primke.php';
                    
                    } ?>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->
            <?php require_once('./pageParts/footer.php') ?>

        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- Select2 -->
        <script src="../../plugins/select2/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
        <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>

        
       <script>
            $(document).ready(function () {
                var left = $('#box').position().left;
                var top = $('#box').position().top;
                var width = $('#box').width();


                $('#search_result').css('left', left).css('top', top + 27).css('width', width + 100).css('z-index', 4);

                $('#search_box').keyup(function () {
                    var value = $(this).val();

                    if (value != '') {
                        $('#search_result').show();
                        
                        //Ispis kupaca
                        $.post('/search/pretrazi_kupca.php', {value: value}, function (data) {
                            
                            //Dohvat json podataka
                            var primka = JSON.parse(JSON.stringify(data));
                            console.log(JSON.parse(JSON.stringify(data)));
                            
                            //Prikaz pronađenih podataka
                            var output ='<ul >';
                            for(var i=0; i < primka.length; ++i){
                                output += '<li><a class="a" id="k" name="'+ primka[i].id + '"> ';
                                if(primka[i].tvrtka) output += primka[i].tvrtka+', '; 
                                output += primka[i].ime+' ' + primka[i].prezime + ', ' + primka[i].grad +', ' + primka[i].adresa +'</a></li>'
                            } 
                            
                            output +='</ul>';   //kraj ispis liste
                            
                            $('#search_result').html(output);
                            
                        });
                        
                    } else {
                        $('#search_result').hide();
                    }

                });
                
                //  Upis podataka  odabranog kupca u polja
                $('#search_result').on("click", "#k", function(e){
                    e.preventDefault();
                    
                    var idkupca = $( this ).attr('name');

                    $.post('/json/kupac/dohvatiKupcaJson.php', {"id": idkupca}, function (data) {
                       console.log(JSON.parse(JSON.stringify(data)));
                        var osoba = JSON.parse(JSON.stringify(data));
                        $('#inputid').text(osoba.id);
                        (osoba.tvrtka) ? $('#inputTvrtka').val(osoba.tvrtka).prop( "disabled", true ) : $('#divTvrtka').hide();
                        $('#inputIme').val(osoba.ime).prop( "disabled", true );
                        $('#inputPrezime').val(osoba.prezime).prop( "disabled", true );
                        $('#inputAdresa').val(osoba.adresa).prop( "disabled", true );
                        $('#inputGrad').val(osoba.grad).prop( "disabled", true );
                        $('#inputPB').val(osoba.postanskiBroj).prop( "disabled", true );
                        $('#inputKontakt').val(osoba.kontakt).prop( "disabled", true );
                        $('#inputEmail').val(osoba.email).prop( "disabled", true );
                        
                        $('#editBtn').show();
        
                        $("#search_box").val("");
                        $('#search_result').hide();
                    });
                });
                  
                  // ČIŠĆENJE SEARCH BOX-A
                  $('#search_button').click(function(e) {
                    e.preventDefault();
                    $("#search_box").val("");
                    $('#search_result').hide();
                  });
                  
                  //   OMOGUĆAVANJE IZMJENE KUPCA
                  $('#editBtn').click(function (e){
                        e.preventDefault();
                        $('#divTvrtka').show().prop( "disabled", false );
                        $('#inputTvrtka').prop( "disabled", false );
                        $('#inputIme').prop( "disabled", false );
                        $('#inputPrezime').prop( "disabled", false );
                        $('#inputAdresa').prop( "disabled", false );
                        $('#inputGrad').prop( "disabled", false );
                        $('#inputPB').prop( "disabled",false );
                        $('#inputKontakt').prop( "disabled", false );
                        $('#inputEmail').prop( "disabled", false );
                        
                        $("#box").hide();
                        $('#submit').prop("disabled", true);
                        
                        $('#spremiKupca').show();
                        $('#editBtn').hide();
                  });
                  
                  //    SPREMANJE IZMJENE KUPCA
                  $('#spremiKupca').click(function (e){
                      e.preventDefault();
                      
                      var tvrtka = $('#inputTvrtka').val();
                      var ime = $('#inputIme').val();
                      var prezime = $('#inputPrezime').val();
                      var adresa = $('#inputAdresa').val();
                      var grad = $('#inputGrad').val();
                      var pb = $('#inputPB').val();
                      var kontakt = $('#inputKontakt').val();
                      var email = $('#inputEmail').val();
                       var idkupca = $( '#inputid' ).text();
                       
                       $.post('/json/kupac/updateKupca.php', {
                           "tvrtka" : tvrtka,
                           "ime":ime,
                           "prezime":prezime, 
                           "adresa" : adresa, 
                           "grad" : grad, 
                           "pb" : pb, 
                           "kontakt":kontakt, 
                           "email":email,
                           "id" : idkupca
                       });
                       
                       
                       

                    $.post('/json/kupac/dohvatiKupcaJson.php', {"id": idkupca}, function (data) {
                       console.log(JSON.parse(JSON.stringify(data)));
                        var osoba = JSON.parse(JSON.stringify(data));
                        $('#inputid').text(osoba.id);
                        (osoba.tvrtka) ? $('#inputTvrtka').val(osoba.tvrtka).prop( "disabled", true ) : $('#divTvrtka').hide();
                        $('#inputIme').val(osoba.ime).prop( "disabled", true );
                        $('#inputPrezime').val(osoba.prezime).prop( "disabled", true );
                        $('#inputAdresa').val(osoba.adresa).prop( "disabled", true );
                        $('#inputGrad').val(osoba.grad).prop( "disabled", true );
                        $('#inputPB').val(osoba.postanskiBroj).prop( "disabled", true );
                        $('#inputKontakt').val(osoba.kontakt).prop( "disabled", true );
                        $('#inputEmail').val(osoba.email).prop( "disabled", true );
                        
                        $('#editBtn').show();
                        $('#spremiKupca').css('display','none');
                        
                        $("#box").show();
                        $('#submit').prop("disabled", false);
        
                        //alert('Trebam namjestiti ažuriranje podataka izmjena kupca');
                        $("#search_box").val("");
                        $('#search_result').hide();
                    });
                      
                  });


            });

        </script>

        <!-- date-range-picker -->
        <script>
            $(function () {
                //Initialize Select2 Elements
                $(".select2").select2();

                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd.mm.yyyy", {"placeholder": "dd.mm.yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                            },
                            startDate: moment().subtract(29, 'days'),
                            endDate: moment()
                        },
                        function (start, end) {
                            $('#reportrange span').php(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                        }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });
        </script>
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>
</html>

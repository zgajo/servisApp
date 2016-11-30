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
                        
                    }
                    /*
                    Otvaranje nove primke
                    */
                    else if(isset($_GET['action'])){
                        if ($_GET['action'] == "nova_primka") {

                        require_once 'pageParts/primkaPagePart/nova_primka.php';

                       
                       }
                    }
                    
                       /*
                       Prikaz svih naloga
                       */
                       else { 
                    require_once 'pageParts/primkaPagePart/sve_primke.php';
                    
                    } ?>

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
        <!-- InputMask -->
        <script src="plugins/input-mask/jquery.inputmask.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
        
        <?php if (!isset($_GET['action']) && !isset($_GET['primka'])){ ?>
        
          <script>
        //    LISTANJE SVIH OTVORENIH PRIMKI
                  $.ajax({
                                type: 'POST',
                                url: "json/primka/sveOtvorenePrimke.php",
                                dataType: 'json',
                                contentType: "application/json; charset=utf-8",
                                success: function (data) {
                                    var danas = new Date();
                                    
                                      var primka = JSON.parse(JSON.stringify(data));
                                      var output = "";
                                      
                                     
                                      
                                      for(var i =0; i<primka.length; ++i){
                                          var datum = new Date(primka[i].datumZaprimanja);
                                          var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds

                                            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime())/(oneDay)));
                                        
                                            if(diffDays<=7)  var sty = "label label-success";
                                            if(diffDays>7 && diffDays<=14)  var sty = "label label-warning";
                                            if(diffDays>14) var sty = "label label-danger";
                                        
                                            output +=   '<tr> \n\
                                                        <td  style="text-align: center;"><a class="glyphicon glyphicon-pencil" href="primke.php?primka='+primka[i].primka_id+'"></a></td>';
                                                                                                                   
                                            output +=     '<td><span class="'+sty+'">Primka ' +primka[i].primka_id+ '</span></td>';
                                           
                                            output +=     '<td>'+ primka[i].naziv +'</td>\n\
                                                                <td>'+ primka[i].s_ime + ' ' + primka[i].s_prezime+'</td>\n\
                                                                <td>'+ primka[i].status +'</td>\n\
                                                                <td>'+ [datum.getDate(), datum.getMonth()+1, datum.getFullYear()].join('.') +' /  '+[(datum.getHours()<10?'0':'') + datum.getHours(), (datum.getMinutes()<10?'0':'') + datum.getMinutes()].join(':')  + '<td>\n\
                                                            </tr>';
                                                         
                                      }
                                      $('#sveprimke').html(output);
                                      
                                      console.log(JSON.parse(JSON.stringify(data)));
                                      
                                },
                                error: function (e) {
                                    alert(e.message);
                                }
                            });
                  //    KRAJ    *   LISTANJE SVIH OTVORENIH PRIMKI  * KRAJ
                
                
                //      HOVER NA RED SVIH PRIMKI
                                $( "#sveprimke" ).on("mouseover", "tr",function() {
                                  $( this ).css("background-color", "#efefef");
                              } );
                                
                                $( "#sveprimke" ).on("mouseout", "tr",function() {
                                  $( this ).css("background-color", "white");
                              } );
                //      KRAJ    *    HOVER NA RED SVIH PRIMKI   *   KRAJ
        </script>
        <?php } elseif(isset($_GET['action'])) { ?>
      
       <script>
            $(document).ready(function () {
                
                var left = $('#box').position().left;
                var top = $('#box').position().top;
                var width = $('#box').width();


                $('#search_result').css('left', left).css('top', top + 27).css('width', width + 100).css('z-index', 4);

                //  PRETRAGA ZA KUPCEM
                $('#search_box').keyup(function () {
                    var value = $(this).val();

                    if (value != '') {
                        $('#search_result').show();
                        
                        //Ispis kupaca
                        $.post('search/pretrazi_kupca.php', {value: value}, function (data) {
                            
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
                //  KRAJ * PRETRAGA ZA KUPCEM * KRAJ
                
                //  UPIS PODATAKA ODABRANOG KUPCA U POLJE
                $('#search_result').on("click", "#k", function(e){
                    e.preventDefault();
                    
                    var idkupca = $( this ).attr('name');

                    $.post('json/kupac/dohvatiKupcaJson.php', {"id": idkupca}, function (data) {
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
                //  KRAJ * UPIS PODATAKA ODABRANOG KUPCA U POLJE * KRAJ
                  
                  // ČIŠĆENJE SEARCH BOX-A
                  $('#search_button').click(function(e) {
                    e.preventDefault();
                    $("#search_box").val("");
                    $('#search_result').hide();
                  });
                  //  KRAJ * ČIŠĆENJE SEARCH BOX-A * KRAJ
                  
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
                  //  KRAJ * OMOGUĆAVANJE IZMJENE KUPCA * KRAJ
                  
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
                       
                       $.post('json/kupac/updateKupca.php', {
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
                       
                       
                       

                    $.post('json/kupac/dohvatiKupcaJson.php', {"id": idkupca}, function (data) {
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
                  //  KRAJ * SPREMANJE IZMJENE KUPCA * KRAJ
                  
               

                  
                  // UNOS PRIMKE
                   
                   $('#submit').click(function (e){
                      e.preventDefault();
                      
                      //kupac
                      var tvrtka = $('#inputTvrtka').val();
                      var ime = $('#inputIme').val();
                      var prezime = $('#inputPrezime').val();
                      var adresa = $('#inputAdresa').val();
                      var grad = $('#inputGrad').val();
                      var pb = $('#inputPB').val();
                      var kontakt = $('#inputKontakt').val();
                      var email = $('#inputEmail').val();
                      
                      //primka
                      var pk = $('#inputPK').val();
                      var naziv = $('#inputNaziv').val();
                      var sifra = $('#inputSifra').val();
                      var brand = $('#inputBrand').val();
                      var tip = $('#inputTip').val();
                      var serijski = $('#inputSerijski').val();
                      var dat_k = $('#inputDK').val();
                      var racun = $('#inputRacun').val();
                      var opis = $('#inputPK').val();
                      var prilozeno = $('#inputPP').val();
                      
                      //  UKOLIKO SU PRAZNA BITNA POLJA
                      if(ime === '' || prezime === '' || kontakt === '' || pk === '' || naziv === '') {
                          alert('Molim vas da ispunite sva polja');
                      }
                      
                      //    
                      else{
                          var idkupca = $( '#inputid' ).text();
                          
                          if(idkupca === '') {
                              if (confirm('Jeste li sigurni da želite unijeti ubisane podatke?')) {
                                $.ajax({
                                 type: 'POST',
                                 url: "json/primka/insertPrimka.php",
                                 data: {"sifra":sifra,"brand":brand, "tip":tip, "naziv":naziv, "serijski": serijski, "opis":opis, "prilozeno":prilozeno, "racun":racun, "dk": dat_k, "stranka_id": idkupca,
                                 "tvrtka" : tvrtka, "ime":ime, "prezime":prezime, "adresa" : adresa, "grad":grad, "post_broj": pb, "kontakt_broj":kontakt, "email" : email},
                                 success: function (data) {
                                     var primkaID = JSON.parse(JSON.stringify(data));
                                     window.location.href = "primke.php";
                                        var win = window.open('ispis/potvrda_zaprimanja.php?primka='+primkaID, '_blank');
                                        if (win) {
                                            //Browser has allowed it to be opened
                                            win.focus();
                                        } else {
                                            //Browser has blocked it
                                            alert('Molim Vas, omogućite prikaz skočnih prozora');
                                        }
                                         
                                        
                                    },
                                    
                                    error: function (e) {
                                    alert(e.message);
                                        }
                                    });
                                } else {
                                    alert('Odustali ste od upisa podataka. Ispravite upis');
                                }
                              
                          }
                          else{ 
                              if (confirm('Jeste li sigurni da želite unijeti upisane podatke?')) {
                              $.ajax({
                                 type: 'POST',
                                 url: "json/primka/insertPrimka.php",
                                 data: {"sifra":sifra,"brand":brand, "tip":tip, "naziv":naziv, "serijski": serijski, "opis":opis, "prilozeno":prilozeno, "racun":racun, "dk": dat_k, "stranka_id": idkupca },
                                 success: function (data) {
                                     var primkaID = JSON.parse(JSON.stringify(data));
                                     window.location.href = "primke.php";
                                        var win = window.open('ispis/potvrda_zaprimanja.php?primka='+primkaID, '_blank');
                                        if (win) {
                                            //Browser has allowed it to be opened
                                            win.focus();
                                        } else {
                                            //Browser has blocked it
                                            alert('Molim Vas, omogućite prikaz skočnih prozora');
                                        }
                                         window.location.href = "primke.php";
                                        
                                    },
                                    
                                error: function (e) {
                                    alert(e.message);
                                }
                              });
                          }else {
                                    alert('Odustali ste od upisa podataka. Ispravite upis');
                                }
                              
                                };
                         
                      }
                      
                  });
                  //  KRAJ * UNOS PRIMKE * KRAJ
                  
            });

        </script>
        <?php } elseif(isset($_GET['primka'])) { ?>
        <script>
                        $(document).ready(function (){
                            
                            var pid = <?php echo $_GET['primka'] ?>
                            // Dohvaćanje i pregled upita
                            $.ajax({
                                type: 'GET',
                                url: "json/primka/updatePrimkaJson.php",
                                data: {"id":pid},
                                dataType: 'json',
                                contentType: "application/json; charset=utf-8",
                                success: function (data) {
                                      
                                     var pp = JSON.parse(JSON.stringify(data));
                                     
                                     var dz = new Date(pp[0].datumZaprimanja);
                                     var dk = new Date(pp[0].datumKupnje);
                                    
                                    // PODACI KUPCA
                                    
                                    $('#ip_kupca').text(pp[0].ime + ' ' + pp[0].prezime);
                                     if(pp[0].tvrtka) $('#tvrtka').text(pp[0].tvrtka).show();
                                     $('#kontakt').text(pp[0].kontaktBroj);
                                     if(pp[0].email) $('#email').after("<p style='display:inline'>"+pp[0].email+"</i>"); else{ $('#email').hide()};
                                     $('#grad').text(pp[0].grad);
                                     $('#adresa').text(pp[0].adresa);
                                     
                                     //     PODACI PRIMKE
                                     
                                     $('#zap').text([dz.getDate(), dz.getMonth()+1, dz.getFullYear()].join('.') +' /  '+[(dz.getHours()<10?'0':'') + dz.getHours(), (dz.getMinutes()<10?'0':'') + dz.getMinutes()].join(':'));
                                     $('#po').text(pp[0].pot_ime + ' ' + pp[0].pot_prezime);
                                     $('#nu').text(pp[0].naziv);
                                     $('#serijski').text(pp[0].serijski);
                                     $('#brand').text(pp[0].brand);
                                     $('#tip').text(pp[0].tip);
                                     (isNaN(dk.getDate())) ? $('#dk').text() : $('#dk').text([dk.getDate(), dk.getMonth()+1, dk.getFullYear()].join('.'));
                                     $('#br').text(pp[0].racun);
                                     $('#ok').text(pp[0].opisKvara);
                                     $('#pp').text(pp[0].prilozeno_primijeceno);
                                     $('select').prepend("<option disabled='disabled' value='"+pp[0].p_status+"'>"+pp[0].p_status+"</option>");
                                     $('select').val(pp[0].p_status);
                                     
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
                                        if(!isNaN(dk.getDate())) $('#inputDK').val([dk.getDate(), dk.getMonth()+1, dk.getFullYear()].join('.'));
                                        $('#inputRacun').val(pp[0].racun);
                                        $('#inputPP').val(pp[0].prilozeno_primijeceno);
                                     
                                      console.log(pp);
                                      
                                },
                                error: function (e) {
                                    alert(e.message);
                                }
                            });
                            
                            //Ažuriranje upita
                            $('#azuriraj').click(function (){
                                var status = $('select').val();
                                $.post('json/primka/primkaStatusUpdate.php', { "status" : status, "id" : pid }, function (data){
                                    alert('Uspješno ažuriran status');
                                });
                                
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
                       
                       if(ime === '' || prezime === '' || kontakt === '') {
                          alert('Molim vas da ispunite sva polja');
                      }
                       else{
                           $.post('json/kupac/updateKupca.php', {
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
                       
                        $('#ip_kupca').text(ime + ' ' + prezime);
                        $('#tvrtka').text(tvrtka);
                        $('#kontakt').text(kontakt);
                        if(email) $('#email').after("<p style='display:inline'>"+email+"</i>"); else{ $('#email').hide()};
                        $('#grad').text(grad);
                        $('#adresa').text(adresa);
                        
                        $('#upr').show();
                        $('#uredi_kupca').hide();
                        
                   
                       }
                       
                  });
                  //  KRAJ * SPREMANJE IZMJENE KUPCA * KRAJ
                            
                            
                       
                       //   SPREMANJE IZMJENE PRIMKE
                       $('#spremiPrimku').click(function (){
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
                      
                      if(opis === '' || naziv === '') {
                          alert('Molim vas da ispunite obavezna sva polja');
                      }
                      else{
                          $.post("json/primka/updatePrimka.php", { 
                          "su" : sifra, "b": brand ,  "t": tip, "n" : naziv, "s" : serijski, 
                          "ok" : opis, "pp" : prilozeno, "r" : racun, "dk" : dat_k, "id" : pid
                      });
                      
                      $('#nu').text(naziv);
                      $('#serijski').text(serijski);
                                     $('#brand').text(brand);
                                     $('#tip').text(tip);
                                     $('#dk').text(dat_k);
                                     $('#br').text(racun);
                                     $('#ok').text(opis);
                                     $('#pp').text(prilozeno);
                                     
                                     
                                     $('#upr').show();
                                $('#uredi_primku').hide();
                      }
                      
                      
                      
                       });
                        
                      
                       //   KRAJ    *   SPREMANJE IZMJENE PRIMKE   *   KRAJ
                            
                            //  OMOGUĆAVANJE UREĐIVANJE KUPCA / PRIMKE
                            
                            $('#uk').click(function(){
                                $('#upr').hide();
                                $('#uredi_kupca').show();
                            });
                            
                            $('#ponistiK').click(function(){
                                $('#upr').show();
                                $('#uredi_kupca').hide();
                            });
                            
                            $('#up').click(function(){
                                $('#upr').hide();
                                $('#uredi_primku').show();
                            });
                            
                            $('#ponistiUK').click(function(){
                                $('#upr').show();
                                $('#uredi_primku').hide();
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

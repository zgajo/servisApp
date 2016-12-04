<?php
include_once './checkLogin.php';
include_once './klase/radniNalog.php';
include_once './klase/primka.php';
include_once './klase/osoba.php';
if($_COOKIE['odjel'] == "Servis"){
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
        <title>Servis RN</title>
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

            <?php include './pageParts/header.php'; ?>
            <?php include './pageParts/sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">

                    <?php if(isset($_GET['action'])) {if($_GET['action'] == "novi_rn"  && !empty($_GET['primka_id'])) { 
                        
                        $rn  = new servisRN();
                        $last = $rn->insert($_GET['primka_id'], $_COOKIE['id']);
                        unset($rn);
                        
                        $primka = new primka();
                        $primka = $primka->getById($_GET['primka_id']);
                        
                        if($primka[0]["p_status"] == "Poslano u CS - Rovinj" || $primka[0]["p_status"] == "Poslano u CS - Rovinj / Čeka dio" || $primka[0]["p_status"] == "Poslano u CS - Rovinj / Započelo servisiranje"){
                           
                            unset($primka);
                            $primka = new primka();
                            $primka->azurirajStatus("Poslano u CS - Rovinj / Započelo servisiranje", $_GET['primka_id']);
                            
                        }else{
                           
                            unset($primka);
                            $primka = new primka();
                            $primka->azurirajStatus("U servisu", $_GET['primka_id']);
                            
                        }
                        
                        unset($primka);
                        echo '<script>alert("Otvoren novi nalog '.$last.'"); '
                           . 'setTimeout(function(){ window.location.href="rn.php?radni_nalog='.$last.'";}, 100);'
                           . '</script>';
                      
                        
                        ?>
                                      
<?php }} else if(!empty($_GET['radni_nalog'])){
                    
                    require_once('./pageParts/rnPagePart/uredi_rn.php');
                    
                    } else{  
                    
                    require_once('./pageParts/rnPagePart/svi_rn.php');
                    
                    } ?>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

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
        <script src="plugins/select2/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="plugins/input-mask/jquery.inputmask.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>

        
        
        <?php if(!empty($_GET['radni_nalog'])){ ?>
        <script>
                        $(document).ready(function (){
                            
                            var rnid = <?php echo $_GET['radni_nalog'] ?>
                           
                           $.post("json/rn/getById.php", {"id":rnid},
                           function(rn){
                               console.log(rn);
                               var pocetak = new Date(rn[0].pocetakRada);
                               var zavrseno = new Date(rn[0].danZavrsetka);
                               //   UPIS RADNOG NALOGA
                               $('#pocetak').text([pocetak.getDate(), pocetak.getMonth(), pocetak.getFullYear()].join('.') + ' / ' + [((pocetak.getHours()<10) ? '0':'') + pocetak.getHours(), (pocetak.getMinutes()<10?'0':'') + pocetak.getMinutes()].join(':'));
                               $('#zapoceo').text(rn[0].zapoceoRn_ime + ' ' + rn[0].zapoceoRn_prezime);
                               $('#inputPopravak').val(rn[0].opisPopravka);
                               $('#inputNapomena').val(rn[0].napomena);
                               $('#inputNaplata').val(rn[0].naplata);
                               $('select').val(rn[0].status);
                               $('select').prepend("<option style='background-color:#ebebeb' disabled='disabled' value='"+rn[0].status+"'>"+rn[0].status+"</option>");
                               if(zavrseno && zavrseno.getFullYear()!="1970") {
                                   $('#zavrseno').text([zavrseno.getDate(), zavrseno.getMonth(), zavrseno.getFullYear()].join('.') + ' / ' + [((zavrseno.getHours()<10) ? '0':'') + zavrseno.getHours(), (zavrseno.getMinutes()<10?'0':'') + zavrseno.getMinutes()].join(':'));
                                   $('#zr').show();
                               }
                               if(rn[0].zavrsioRn_ime !== '' && rn[0].zavrsioRn_ime !== null) {
                                   $('#zavrad').show();
                                   $('#zavrsio').text(rn[0].zavrsioRn_ime + ' ' + rn[0].zavrsioRn_prezime);
                               }
                               
                               //       UPIS PRIMKE
                               $.get("json/primka/getById.php", {"id": rn[0].primka_id}, 
                               function(primka){
                                   console.log(primka);
                                   
                                    var dz = new Date(primka[0].datumZaprimanja);
                                   var dk = new Date(primka[0].datumKupnje);
                                   // PODACI KUPCA
                                    
                                    $('#ip_kupca').text(primka[0].ime + ' ' + primka[0].prezime);
                                     if(primka[0].tvrtka) $('#tvrtka').text(primka[0].tvrtka).show();
                                     $('#kontakt').text(primka[0].kontaktBroj);
                                     if(primka[0].email) $('#email').after("<p style='display:inline'>"+primka[0].email+"</i>"); else{ $('#email').hide()};
                                     $('#grad').text(primka[0].grad);
                                     $('#adresa').text(primka[0].adresa);
                                     
                                     //     PODACI PRIMKE
                                     $('#primkanaslov').text('Primka ' + primka[0].primka_id);
                                     $('#zap').text([dz.getDate(), dz.getMonth()+1, dz.getFullYear()].join('.') +' /  '+[(dz.getHours()<10?'0':'') + dz.getHours(), (dz.getMinutes()<10?'0':'') + dz.getMinutes()].join(':'));
                                     $('#po').text(primka[0].pot_ime + ' ' + primka[0].pot_prezime);
                                     $('#nu').text(primka[0].naziv);
                                     $('#serijski').text(primka[0].serijski);
                                     $('#brand').text(primka[0].brand);
                                     $('#tip').text(primka[0].tip);
                                     (isNaN(dk.getDate())) ? $('#dk').text() : $('#dk').text([dk.getDate(), dk.getMonth()+1, dk.getFullYear()].join('.'));
                                     $('#br').text(primka[0].racun);
                                     $('#ok').text(primka[0].opisKvara);
                                     $('#pp').text(primka[0].prilozeno_primijeceno);
                                     $('#st').text(primka[0].p_status);
                                     $('#primka_id').text(primka[0].primka_id);
                               }
                                );
                               
                           }
                           );
                           
                           
                            //Ažuriranje upita
                            $('#azuriraj_status').on("click", this, function(){
                            
                            var status_primke = $('#st').text();
                            var primka_id = $('#primka_id').text();
                            var status = $('select').val();
                            
                            //  UKOLIKO SE ZATVARA RADNI NALOG
                            if(status === "Popravak završen u jamstvu"  || status === "Popravak završen van jamstva" || status === 'Stranka odustala od popravka'){
                               
                                    $.post("json/rn/zatvori.php", 
                                            {"id":rnid, 
                                            "status": status, 
                                            "popravak": $('#inputPopravak').val(), 
                                            "napomena": $('#inputNapomena').val(),
                                            "naplata" : $("inputNaplata").val()},
                                        function(){
                                            alert("Ažuriran radni nalog " + rnid);
                                            
                                        }
                                        );
                                        
                                        //  AŽURIRANJE STATUSA PRIMKE
                                        if(status_primke === "Poslano u CS - Rovinj" || status_primke === "Poslano u CS - Rovinj / Započelo servisiranje"  || status_primke === "Poslano u CS - Rovinj / Čeka dio") { 
                                            $.post("json/primka/primkaStatusUpdate.php", {"status": "Završen popravak - poslano u centar", "id":primka_id}, function(){
                                                
                                                window.location = "rn.php?radni_nalog="+ rnid;

                                            });
                                        }else{
                                             
                                           $.post("json/primka/primkaStatusUpdate.php", {"status": "Završen popravak", "id":primka_id}, function(){
                                                
                                                window.location = "rn.php?radni_nalog="+ rnid;

                                            });
                                        }
                                        //  KRAJ *  AŽURIRANJE STATUSA PRIMKE   *   KRAJ
                                }
                                // KRAJ *   ZATVARANJE RADNOG NALOGA    *   KRAJ
                                
                                //  AŽURIRAJ STATUSE
                            else{
                                    $.post("json/rn/azuriraj.php", 
                                            {"id":rnid, 
                                            "status": status, 
                                            "popravak": $('#inputPopravak').val(), 
                                            "napomena": $('#inputNapomena').val(),
                                            "naplata" : $("inputNaplata").val()},
                                        function(){
                                            alert("Ažuriran radni nalog " + rnid);
                                            
                                        }
                                        );
                                
                                    //  AŽURIRANJE STATUSA PRIMKE
                                        if(status_primke === "Poslano u CS - Rovinj" || status_primke === "Poslano u CS - Rovinj / Započelo servisiranje"  || status_primke === "Poslano u CS - Rovinj / Čeka dio") { 
                                            $.post("json/primka/primkaStatusUpdate.php", {"status": "Poslano u CS - Rovinj / Čeka dio", "id":primka_id}, function(){
                                                
                                                window.location = "rn.php?radni_nalog="+ rnid;

                                            });
                                        }else{
                                             console.log("2");
                                           $.post("json/primka/primkaStatusUpdate.php", {"status": "Čeka dio", "id":primka_id}, function(){
                                                
                                                window.location = "rn.php?radni_nalog="+ rnid;

                                            });
                                        }
                                    
                                
                                }
                             //  KRAJ    *   AŽURIRAJ STATUSE    *   KRAJ
                            });
                            
                           
                            
                            
                                                       
                        });
                        </script>
        <?php } else{ ?>
        <script>
            
            $( "#sviRN" ).on("mouseover", "tr",function() {
                                  $( this ).css("background-color", "#efefef");
                              } );
                                
                                $( "#sviRN" ).on("mouseout", "tr",function() {
                                  $( this ).css("background-color", "white");
                              } );
             
         //    LISTANJE SVIH OTVORENIH PRIMKI
                  $.ajax({
                                type: 'POST',
                                url: "json/primka/svePrimkeRNServis.php",
                                dataType: 'json',
                                contentType: "application/json; charset=utf-8",
                                success: function (data) {
                                    var output = "";
                                      var primka = JSON.parse(JSON.stringify(data));
                                      var danas = new Date();
                                      console.log(primka);
                                      
                                      for(var i =0; i<primka.length; ++i){
                                          var datum = new Date(primka[i].datumZaprimanja);
                                          var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds

                                            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime())/(oneDay)));
                                        
                                            if(diffDays<=15)  var sty = "label label-success";
                                            if(diffDays>15 && diffDays<=30)  var sty = "label label-warning";
                                            if(diffDays>30) var sty = "label label-danger";
                                            
                                            var rn = null;
                                            var pid = primka[i].primka_id;
                                            
                                            //  TRAŽENJE RADNIH NALOGA POVEZANIH SA PRIMKAMA
                                          $.ajax({
                                                async: false,
                                                 url:"json/rn/getRNbyPrimka.php",
                                                 type: 'POST',
                                                 data: {"primka":pid},
                                                 success:function(data){
                                                    console.log(data);
                                                rn= data;
                                                
                                                },
                                                error: function(){
                                                    console.log("greška");
                                                }
                                            });
                                           
                                            if(rn !== null && rn.length>0){
                                                
                                                
                                                
                                                
                                                output += '<tr>';
                                                   output +=  '<td  style="text-align: center;">';
                                                    for(var j=0; j<rn.length;++j) output += '<a class="glyphicon glyphicon-pencil" href="rn.php?radni_nalog='+rn[j].id+'"></a><br>';
                                                    output +=   '</td>';
                                                                                                                   
                                                    output +=     '<td><span class="'+sty+'">Primka ' +primka[i].primka_id+ '</span></td>';
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rn.length;++j) output += '<strong>RN. ' +rn[j].id+ '</strong><br>';
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rn.length;++j) output += rn[j].d1ime + ' ' + rn[j].d1prezime + '<br>';
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rn.length;++j){
                                                    var pocetak = new Date(rn[j].pocetak);
                                                    output +=  (pocetak && pocetak.getFullYear()!= "1970") ?  [pocetak.getDate(), pocetak.getMonth()+1, pocetak.getFullYear()].join('.') +' /  '+[(pocetak.getHours()<10?'0':'') + pocetak.getHours(), (pocetak.getMinutes()<10?'0':'') + pocetak.getMinutes()].join(':') + '<br>' : ' <br>';
                                                }
                                                       
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rn.length;++j) output += rn[j].status + '<br>';
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rn.length;++j) output += (rn[j].napomena) ? rn[j].napomena + '<br>' : '';
                                                    output += '</td>';
                                                    
                                                output += '</tr>';
                                                
                                            }
                                            
                                                         
                                      }
                                      
                                      $('#sviRN').html(output);
                                      
                                      
                                      
                                      
                                },
                                error: function (e) {
                                    alert(e.message);
                                }
                            });   
            
            $( "#sviRMA" ).on("mouseover", "tr",function() {
                                  $( this ).css("background-color", "#efefef");
                              } );
                                
                                $( "#sviRMA" ).on("mouseout", "tr",function() {
                                  $( this ).css("background-color", "white");
                              } );
        
        </script>                
        <?php } ?>
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>
</html>
<?php } else{
    echo('Nemate prava pristupa');
}
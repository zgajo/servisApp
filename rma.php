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

            <?php include 'pageParts/header.php'; ?>
            <?php include 'pageParts/sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">

                    <?php if(isset($_GET['action'])){ if($_GET['action'] == "novi_rma"  && !empty($_GET['primka_id'])) { 
                        
                        $rma  = new rmaNalog();
                        $last = $rma->insert($_GET['primka_id'], $_COOKIE['id']);
                        unset($rma);
                        
                       
                        $primka = new primka();
                        $primka->azurirajStatus("Pripremljeno za slanje OS-u", $_GET['primka_id']);
                            
                        
                        
                        unset($primka);
                        echo '<script>alert("Otvoren novi RMA nalog '.$last.'"); '
                           . 'setTimeout(function(){ window.location.href="rma.php?rma='.$last.'";}, 100);'
                           . '</script>';
                      
                        
                        ?>
                                      
                    <?php }} else if(!empty($_GET['rma'])){
                    
                    require_once('pageParts/rmaPagePart/uredi_rma.php');
                    
                    } else{  
                    
                    require_once('pageParts/rmaPagePart/svi_rma.php');
                    
                    } ?>
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
        <!-- InputMask -->
        <script src="plugins/input-mask/jquery.inputmask.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>

        <script>
            
         //    LISTANJE SVIH OTVORENIH PRIMKI
                  $.ajax({
                                type: 'POST',
                                url: "json/primka/sveOtvorenePrimke.php",
                                dataType: 'json',
                                contentType: "application/json; charset=utf-8",
                                success: function (data) {
                                    
                                      var primka = JSON.parse(JSON.stringify(data));
                                      
                                      var danas = new Date();
                                      
                                      var output = "";
                                      for(var i =0; i<primka.length; ++i){
                                          var datum = new Date(primka[i].datumZaprimanja);
                                          var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds

                                            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime())/(oneDay)));
                                        
                                            if(diffDays<=15)  var sty = "label label-success";
                                            if(diffDays>15 && diffDays<=30)  var sty = "label label-warning";
                                            if(diffDays>30) var sty = "label label-danger";
                                            
                                            var rma = null;
                                            
                                          $.ajax({
                                                async: false,
                                                url:"json/rma/getRmaByPrimka.php",
                                                type: 'GET',
                                                data: {"primka": primka[i].primka_id},
                                                dataType: 'json',
                                                contentType: "application/json; charset=utf-8",
                                                success: function(data){
                                                    
                                                rma= data;
                                                
                                                },
                                                error: function(){
                                                    console.log("greška");
                                                }
                                            });
                                            
                                            if(rma !== null && rma.length>0){
                                                console.log(rma);
                                                
                                                
                                                
                                                output += '<tr>';
                                                   output +=  '<td  style="text-align: center;">';
                                                    for(var j=0; j<rma.length;++j) output += '<a class="glyphicon glyphicon-pencil" href="rma.php?rma='+rma[j].id+'"></a><br>';
                                                    output +=   '</td>';
                                                                                                                   
                                                    output +=     '<td><span class="'+sty+'">Primka ' +primka[i].primka_id+ '</span></td>';
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rma.length;++j) output += '<strong>RMA. ' +rma[j].id+ '</strong><br>';
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rma.length;++j) 
                                                    output += (rma[j].rnOs) ? rma[j].rnOs+ '<br>' :"";
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rma.length;++j) 
                                                    output += (rma[j].nazivOS) ? rma[j].nazivOS+ '<br>' : "";
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                    output+= (primka[i].tvrtka) ?  '<i>'+primka[i].tvrtka +'</i>, ' : '';
                                                    output += primka[i].s_ime + ' ' + primka[i].s_prezime;
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                        
                                                            var poslano = new Date(rma[rma.length-1].poslano);
                                                            output +=  (poslano && poslano.getFullYear()!= "1970") ?  [poslano.getDate(), poslano.getMonth()+1, poslano.getFullYear()].join('.') +' /  '+[(poslano.getHours()<10?'0':'') + poslano.getHours(), (poslano.getMinutes()<10?'0':'') + poslano.getMinutes()].join(':') : '';

                                                       
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rma.length;++j) output += rma[j].status + '<br>';
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rma.length;++j) output += (rma[j].napomena) ? rma[j].napomena + '<br>' : '';
                                                    output += '</td>';
                                                    
                                                output += '</tr>';
                                                
                                            }
                                            
                                                         $('#sviRMA').html(output);
                                      }
                                      
                                      
                                      
                                      
                                      
                                      
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
            

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>
</html>
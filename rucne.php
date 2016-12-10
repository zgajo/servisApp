<?php
include_once 'checkLogin.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ručna izdatnica</title>
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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2>
                            <img src="ispis/logo.png" style="height: 50px; display: inline;">

                        </h2>

                    </div><!-- /.col -->
                </div>
                <!-- info row -->
                <div  style="margin-left: auto; margin-right: auto; text-align: center">
                    <div>Ručna izdatnica br. </div>
                    <input id="rb" style="border: none; text-align: center" value="broj">
                </div>

                <div class="row">
                    <div class="col-xs-12" style="float:left; margin-top: 50px;">
                        <p class="lead"><b style=" font-size: 30px">ŠALJE:</b></p>
                        <div class="table-responsive">
                            <table class="table" style="font-size: 20px">
                                <tr>
                                    <th style="width:50%">Centar:</th>
                                    <td id="sc"></td>
                                </tr>
                                <tr>
                                    <th>Adresa</th>
                                    <td id="sa"></td>
                                </tr>
                                <tr>
                                    <th>Grad</th>
                                    <td id="sg"></td>
                                </tr>
                                <tr>
                                    <th>Kontakt</th>
                                    <td id="sb"></td>
                                </tr>
                                <tr>
                                    <th>Uređaj</th>
                                    <td id="su"></td>
                                </tr>
                            </table>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->


                <div class="row">
                    <div class="col-xs-12" style="margin-top: 100px; font-size: 35px">
                        <p class="lead"><b style=" font-size: 30px">PRIMA:</b></p>
                        <div class="table-responsive">
                            <table class="table" style="font-size: 20px">
                                <tr>
                                    <th style="width:50%">Tvrtka:</th>
                                    <td><input id="pt" style="width: 100%;border: none"></td>
                                </tr>
                                <tr>
                                    <th>Adresa</th>
                                    <td><input id="pa"   style="width: 100%;border: none"></td>
                                </tr>
                                <tr>
                                    <th>Grad</th>
                                    <td><input id="pg"   style="width: 100%;border: none"></td>
                                </tr>
                                <tr>
                                    <th>Kontakt</th>
                                    <td><input id="pb"   style="width: 100%;border: none"></td>
                                </tr>
                            </table>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->


                <div class="col-xs-12" style="margin-top: 40px">
                    <div style="float: left">
                        <b>Zatražio: </b><p id="z"></p>
                        <b>Zaprimio skladištar: </b><p></p>
                    </div>
                    <div style="float: right">
                        <b>Datum: </b><p id="d"></p>
                    </div>

                </div>
                
                <div id="t" class="row no-print">
                            <div class="col-xs-12">
                                <a  class="btn btn-default" onclick="printaj()"><i class="fa fa-print"></i> Print</a>
                            </div>
                        </div>

            </section><!-- /.content -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- Select2 -->
        <script src="plugins/select2/select2.full.min.js"></script>
        <script>
                function printaj(){
                    window.print();
                }
                var primka = '';
                <?php if(isset($_GET['primka'])) { ?>
                     primka = <?php  echo $_GET['primka']?>;
                <?php } ?>
                
               var sad = new Date();
                $.get("json/primka/getById.php" , {"id" : primka}, function(pr){
                    console.log(pr);
                     
                
                $('#rb').val([sad.getDate(), sad.getMonth()+1].join('') + '/' + [((sad.getHours()<10)?'0':'') + sad.getHours(), ((sad.getMinutes()<10)?'0':'') + sad.getMinutes()].join('') + '/' + pr[0].primka_id);
                
                    
                    var centar = "<?php echo $_COOKIE['centar'] ?>";
                    var s_adresa;
                    var s_grad;
                    var s_kontakt;
                   
                    
                    $('#sc').text('Eurotrade '+ centar);
                    //  PROVJERA KOJI CENTAR ŠALJE
                    switch(centar){
                        case "Rovinj":
                            s_adresa = "Naselje Gripole spine 53/c";
                            s_grad = "Rovinj, 52210";
                            s_kontakt = "052 803 699";
                            break;
                        case "Pula":
                            s_adresa = "Benediktinske opatije 3";
                            s_grad = "Pula, 52100";
                            s_kontakt = "052/211-632";
                            break;
                        case "Zagreb":
                            s_adresa = "Gospodarska ulica 15, Donji Stupnik";
                            s_grad = "Zagreb, 10000";
                            s_kontakt = "01/6531-230";
                            break;
                        case "Rijeka":
                            s_adresa = "Eugena Kovačića 2, TC Andrea";
                            s_grad = "Rijeka, 51000";
                            s_kontakt = "051/680-760";
                            break;
                        case "Rijeka - Korzo":
                            s_adresa = "Trg 128 brigade HV 4, Korzo";
                            s_grad = "Rijeka, 51000";
                            s_kontakt = "051/212-321";
                            break;
                        case "Varaždin":
                            s_adresa = "Miroslava Krleže 1";
                            s_grad = "Varaždin, 42000";
                            s_kontakt = "042/331-177";
                            break;
                        case "Split":
                            s_adresa = "Matoševa 86, Solin";
                            s_grad = "Solin, 21210";
                            s_kontakt = "021/262-012";
                            break;
                        case "Osijek":
                            s_adresa = "Vijenac Jakova Gotovca 5";
                            s_grad = "Osijek, 31000";
                            s_kontakt = "031/210-999";
                            break;
                        case "Sisak":
                            s_adresa = "Ante Starčevića 13 ";
                            s_grad = "Sisak, 44000";
                            s_kontakt = "044/524-498";
                            break;
                            
                    }
                    $('#sa').text(s_adresa);
                    $('#sb').text(s_kontakt);
                    $('#sg').text(s_grad);
                    (pr[0].serial) ? $('#su').text(pr[0].naziv + ', sn: ' +pr[0].serial) : $('#su').text(pr[0].naziv);
                    
                    //  ako je primka poslana u rovinj
                    if(pr[0].p_status === "Poslano u CS - Rovinj"){
                        $('#pt').val("Eurotrade Rovinj - Servis");
                        $('#pa').val("Naselje Gripole spine 53/c");
                        $('#pb').val("052 803 699");
                        $('#pg').val("Rovinj, 52210");
                    }else{
                        // UKOLIKO JE CENTAR ISTI U KOJEM SE NALAZI DJELATNIK, PUŠTA SE DA SE PRAZNO , PA SE MOŽE UPISATI GDJE SE ŠALJE
                        if(pr[0].centar === centar){}
                        //  INAČE SE ROVJERAVA IZ KOJEG JE CENTRA POSLANO I UPISUJU SE NJEGOVI PODACI
                        else{
                            var p_adresa;
                            var p_grad;
                            var p_kontakt;
                            
                            switch(pr[0].centar){
                            case "Rovinj":
                                p_adresa = "Naselje Gripole spine 53/c";
                                p_grad = "Rovinj, 52210";
                                p_kontakt = "052 803 699";
                            break;
                            case "Pula":
                                p_adresa = "Benediktinske opatije 3";
                                p_grad = "Pula, 52100";
                                p_kontakt = "052/211-632";
                            break;
                            case "Zagreb":
                                p_adresa = "Gospodarska ulica 15, Donji Stupnik";
                                p_grad = "Zagreb, 10000";
                                p_kontakt = "01/6531-230";
                            break;
                            case "Rijeka":
                                p_adresa = "Eugena Kovačića 2, TC Andrea";
                                p_grad = "Rijeka, 51000";
                                p_kontakt = "051/680-760";
                                break;
                            case "Rijeka - Korzo":
                                p_adresa = "Trg 128 brigade HV 4, Korzo";
                                p_grad = "Rijeka, 51000";
                                p_kontakt = "051/212-321";
                                break;
                            case "Varaždin":
                                p_adresa = "Miroslava Krleže 1";
                                p_grad = "Varaždin, 42000";
                                p_kontakt = "042/331-177";
                                break;
                            case "Split":
                                p_adresa = "Matoševa 86, Solin";
                                p_grad = "Solin, 21210";
                                p_kontakt = "021/262-012";
                                break;
                            case "Osijek":
                                p_adresa = "Vijenac Jakova Gotovca 5";
                                p_grad = "Osijek, 31000";
                                p_kontakt = "031/210-999";
                                break;
                            case "Sisak":
                                p_adresa = "Ante Starčevića 13 ";
                                p_grad = "Sisak, 44000";
                                p_kontakt = "044/524-498";
                                break;
                            }
                            
                            $('#pt').val("Eurotrade " + pr[0].centar);
                            $('#pa').val(p_adresa);
                            $('#pb').val(p_kontakt);
                            $('#pg').val(p_grad);
                            
                        }
                    }
                    
                    
                });
                
                var djelatnik = '<?php echo $_COOKIE['user'] ?>';
                $('#z').text(djelatnik);
                $('#d').text([sad.getDate(), sad.getMonth()+1, sad.getFullYear()].join('.'));
                
                
        </script>
    </body>
</html>

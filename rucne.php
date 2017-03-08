<?php
include_once './klase/checkLogin.php';
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
        <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="icon" type="ispis/logo.png" href="ispis/icon.ico.png">
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <style>
            .inputSyle {
                display: inline;
                width: 80%;
                margin-left: 5px;
                float: right;
            }
        </style>

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
            <section class="invoice" style="padding-top: 0px;">
                <div style="margin-left: auto; margin-right: auto; padding-left: 0px; padding-right: 0px;">


                    <!-- title row -->
                    <div class="no-print" style="font-size: 20px; background-color: #d80200; color: white; width: 250px ">
                        <input id="op" type="checkbox" style="margin-left: 5px"> Dodati: Oprez - lomljivo</div>

                    <!-- info row -->
                    <strong><div  style="margin-left: auto; margin-right: auto; text-align: center; ">
                    <div style="font-size: 20px">Ručna izdatnica br. </div>
                    <input id="rb" style="border: none; text-align: center; font-size: 20px" value="broj">
                </div></strong>


                    <div class="row" style=" width: 95%; margin-top: 50px; margin-left: 2px; margin-right: 2px ">
                        <p style="margin-bottom: 2px" class="lead"><b style=" font-size: 14px">ŠALJE:</b></p>
                        <div class="col-xs-12" style="float:left;  border: 1px solid black; font-size: 14px ">
                            <b>Centar: <p id="sc" style="display: inline"></p></b>
                            <br>
                            <br>
                            <b>Adresa: <p id="sa" style="display: inline"></p></b>
                            <br>
                            <b>Grad: <p id="sg" style="display: inline"></p></b>
                            <br>
                            <b>Kontakt: <p id="sb" style="display: inline"></p></b>
                            <br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->




                    <div class="row" style=" width: 95%;  margin-top: 50px;  margin-left: 2px; margin-right: 2px ">
                        <p style="margin-bottom: 2px" class="lead"><b style=" font-size: 17px">PRIMA:</b></p>
                        <div class="col-xs-12" style="border: 1px solid black; font-size: 16px; padding-bottom: 1px; padding-top: 1px ">
                            <div style="font-size: 17px; height: 28px"><strong style="display: inline; float: left">Tvrtka: </strong>
                                <input id="pt" class="inputSyle"></input>
                            </div>
                            <br>
                            <div style="height: 28px; margin-bottom: 1px; margin-top: 1px"><strong style="display: inline; float: left">Adresa: </strong>
                                <input id="pa" class="inputSyle"></input>
                            </div>
                            <div style="height: 28px; margin-bottom: 1px; margin-top: 1px"><strong style="display: inline; float: left">Grad: </strong>
                                <input id="pg" class="inputSyle"></input>
                            </div>
                            <div style="height: 28px; margin-bottom: 1px; margin-top: 1px"><strong style="display: inline; float: left">Kontakt: </strong>
                                <input id="pb" class="inputSyle"></input>
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->


                    <div class="row" style="width: 95%;  margin-top: 40px; margin-left: 2px; margin-right: 2px; text-align: center  ">
                        <table style="width: 100%;border: 1px solid black; ">
                            <thead style="text-align: center">
                                <th style="border: 1px solid black; text-align: center">Uređaj</th>
                                <th style="border: 1px solid black; text-align: center">Serijski</th>
                                <th style="border: 1px solid black; text-align: center">Primka</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border: 1px solid black; font-size: 14px">
                                        <p id="su"></p>
                                    </td>
                                    <td style="border: 1px solid black; font-size: 14px">
                                        <p id="ss"></p>
                                    </td>
                                    <td style="border: 1px solid black; font-size: 14px">
                                        <p id="p"></p>
                                    </td>
                            </tbody>

                        </table>

                    </div>

                    <div class="row" style=" width: 95%; margin-top: 40px;  margin-left: 2px; margin-right: 2px  ">
                        Napomena:
                        <textarea rows="2" style="width: 100%; border: 1px solid black"></textarea>

                    </div>


                    <div id="oprez" style="display: none">
                        <div style="font-size: 50px; text-align: center">
                            <u> OPREZ LOMLJIVO!</u>
                        </div>
                        <div style="font-size: 32px; text-align: center "><strong>GORNJA STRANA PRILIKOM TRANSPORTA!!!<strong></div>
                </div>

                <div class="col-xs-12" style="margin-top: 40px; width: 95%; ">
                    <div style="float: left">
                        <b>Zatražio: </b><p id="z"></p><br>
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
                    $("#pg").css("border", "none");
                    $("#pt").css("border", "none");
                    $("#pa").css("border", "none");
                    $("#pb").css("border", "none");
                    window.print();
                     $("#pg").removeAttr("style");
                    $("#pt").removeAttr("style");
                    $("#pa").removeAttr("style");
                    $("#pb").removeAttr("style");
                }
                
                $("#op").on("click", this, function(){
                    if($("#op").is(":checked")) $("#oprez").show();
                else $("#oprez").hide();
                })
                
                
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
                    
                    
                    $('#su').text(pr[0].brand+' '+pr[0].naziv);
                    $('#ss').text(pr[0].serial);
                    $('#p').text(pr[0].primka_id);
                   
                    
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
                        case "Rijeka Andrea":
                            s_adresa = "Eugena Kovačića 2, TC Andrea";
                            s_grad = "Rijeka, 51000";
                            s_kontakt = "051/680-760";
                            break;
                        case "Rijeka Korzo":
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
                            case "Rijeka Korzo":
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

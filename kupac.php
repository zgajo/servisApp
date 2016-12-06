

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Kupac</title>
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

                    <div class="col-md-3">
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <div id="glyphicons" style="text-align: center">

                                    <span class="glyphicon glyphicon-user"></span>
                                </div>
                                <h3 class="profile-username text-center" id="tvrtka"></h3>
                                <h5 class="text-muted text-center" id="ip"></h5>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Adresa</b> <a id="adresa" class="pull-right"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Grad</b> <a id="grad" class="pull-right"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Kontakt broj</b> <a id="kontakt" class="pull-right"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b> <a id="email" class="pull-right"></a>
                                    </li>
                                </ul>

                                <a id="izmijeni_podatke" class="btn btn-primary btn-block"><b>Izmijeni podatke</b></a>
                            </div><!-- /.box-body -->
                        </div>


                    </div>

                    <div class="col-md-9">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="true">Timeline</a></li>
                                <li class=""><a href="#izmjena" data-toggle="tab" aria-expanded="false">Izmjeni podatke stranke</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="timeline">
                                    <!-- The timeline -->

                                </div><!-- /.tab-pane -->
                                
                                <div class="tab-pane" id="izmjena">
                                    <form class="form-horizontal" action="" method="POST">
                                    <?php include 'pageParts/primkaPagePart/uredi_kupca.php'; ?>
                                    </form>
                                </div><!-- /.tab-pane -->

                            </div><!-- /.tab-content -->
                        </div><!-- /.nav-tabs-custom -->
                    </div>
                    <div style="clear: both"></div>
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
        <script type="text/javascript" src="search/searchkupca.js"></script>

        <script>

            $(document).ready(function () {
                var kid = <?php echo $_GET['id'] ?>;
                
                function podaciKupca(kid){
                    $.get("json/kupac/dohvatiKupcaByPrimka.php", {"id": kid}, function (kupac) {
                    var zadnji  =kupac.length - 1;
                    (kupac[zadnji].tvrtka) ? $('#tvrtka').text(kupac[zadnji].tvrtka) : $('#tvrtka').text('');
                    $('#ip').text(kupac[zadnji].ime + ' ' + kupac[zadnji].prezime);
                    $('#adresa').text(kupac[zadnji].adresa);
                    $('#kontakt').text(kupac[zadnji].kontaktBroj);
                    $('#email').text(kupac[zadnji].email);
                    (kupac[0].postBroj) ? $('#grad').text(kupac[zadnji].grad + ', ' + kupac[zadnji].postBroj) : $('#grad').text(kupac[zadnji].grad);

                        $('#inputTvrtka').val(kupac[0].tvrtka);
                        $('#inputIme').val(kupac[0].ime);
                        $('#inputPrezime').val(kupac[0].prezime);
                        $('#inputAdresa').val(kupac[0].adresa);
                        $('#inputGrad').val(kupac[0].grad);
                        $('#inputPB').val(kupac[0].postBroj);
                        $('#inputKontakt').val(kupac[0].kontaktBroj);
                        $('#inputEmail').val(kupac[0].email);
                    
                    
                    
                    
                    var output = '<ul  class="timeline timeline-inverse">';

                    if (kupac) {
                        var num = 1;
                        for (primka of kupac){


                            if (num === 5)
                                num = 1;

                            var bg_datum;
                            var bg_ikona;

                            switch (num) {
                                case 1:
                                    bg_datum = "bg-blue";
                                    bg_ikona = "bg-green";
                                    break;
                                case 2:
                                    bg_datum = "bg-red";
                                    bg_ikona = "bg-aqua";
                                    break;
                                case 3:
                                    bg_datum = "bg-green";
                                    bg_ikona = "bg-yellow";
                                    break;
                                case 4:
                                    bg_datum = "bg-purple";
                                    bg_ikona = "bg-blue";
                                    break;
                                default :
                                    break;
                            }


                            var zaprimljeno = new Date(primka.datumZaprimanja);

                            output += '<li class="time-label">' +
                                    '<span class="' + bg_datum + '" id="datum">' +
                                    '' + [zaprimljeno.getDate(), zaprimljeno.getMonth() + 1, zaprimljeno.getFullYear()].join(".") +
                                    '</span>' +
                                    '</li>' +
                                    '<li>' +
                                    '<i class="fa  fa-list-alt ' + bg_ikona + '"></i>' +
                                    '<div class="timeline-item">' +
                                    '<span class="time"><i class="fa fa-clock-o"></i> ' + [(zaprimljeno.getHours() < 10) ? '0' + zaprimljeno.getHours() : '' + zaprimljeno.getHours(), (zaprimljeno.getMinutes() < 10) ? '0' + zaprimljeno.getMinutes() : '' + zaprimljeno.getMinutes()].join(":") + '</span>' +
                                    
                        '<h3 class="timeline-header"><a href="#">Primka ' + primka.primka_id + '</a> zaprimljena</h3>';
                        
                        
                            output+=  '<div class="timeline-body">' +
                                   '<div style="width:45%; float:right">'+
                                    '<b>Uređaj:</b> ' + primka.naziv + '<br> <b>Serijski broj:</b> ';
                            output += (primka.serial) ? primka.serial + '<br>' : '<br>';
                            output += '<b>Prijavljen kvar:</b> ' + primka.opisKvara + '';
                            
                            if (primka.rn_id) {
                                output += '<hr><b>Izvršeni popravak: </b>';
                                output += (primka.opisPopravka) ? primka.opisPopravka + '<br>' : '<br>';
                            }
                            output += '<h5><b>Status:</b> <a href="#"> ' + primka.status + '</a> </h5><br>';

                            output += ' </div>';
                                    

                            output += ' <div class="timeline-footer" style="clear:both">';
                            output += '<a class="btn btn-primary btn-xs">Pregledaj više</a>' +
                                    '<a style="margin-left:5px" class="btn btn-danger btn-xs">Isprintaj</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    
                                    '</li>';
                            num += 1;

                        }
                    }
                    output += '<li><i class="fa fa-clock-o bg-gray"></i></li></ul>';
                    $('#timeline').html(output);



                });
                }
                 podaciKupca(kid);
                 
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
                       
                       $.post('json/kupac/updateKupca.php', {
                           "tvrtka" : tvrtka,
                           "ime":ime,
                           "prezime":prezime, 
                           "adresa" : adresa, 
                           "grad" : grad, 
                           "pb" : pb, 
                           "kontakt":kontakt, 
                           "email":email,
                           "id" : kid
                       });
                       podaciKupca(kid);
                       

                      
                  });
                  //  KRAJ * SPREMANJE IZMJENE KUPCA * KRAJ
                  
               
                  $('#ponistiK').on("click", this, function(){
                    podaciKupca(kid);
                  });
                  
                 
                 
            });

        </script>        


    </body>
</html>

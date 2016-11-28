
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
                    
                    
<form class="form-horizontal" action="" method="POST" onsubmit="return confirm('Jeste li sigurni da želite stvoriti primku sa upisanim podacima?');">
    <div class="row">
        <div class="col-md-6">
            <!-- Dio za stranku -->
           
           
            
            
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Podaci stranke</h3>
                    <br>
                    <br>
                    
                    
                    <span id="box" style="float: left">
                        Pretraži u bazi : <input type="text" id="search_box">
                        <span id="search_button" >Očisti</span>
                    </span>
                    <div id="search_result">

                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">

                    <div class="form-group">
                        <label for="inputTvrtka" class="col-sm-2 control-label">Tvrtka</label>
                        <div class="col-sm-10">
                            <input name="tvrtka" class="form-control" id="inputTvrtka" placeholder="Tvrtka" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputIme" class="col-sm-2 control-label">Ime</label>
                        <div class="col-sm-10">
                            <input name="ime" class="form-control" id="inputIme" placeholder="Ime" type="text" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPrezime" class="col-sm-2 control-label">Prezime</label>
                        <div class="col-sm-10">
                            <input name="prezime" class="form-control" id="inputPrezime" placeholder="Prezime" type="text" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdresa" class="col-sm-2 control-label">Adresa</label>
                        <div class="col-sm-10">
                            <input name="adresa" class="form-control" id="inputAdresa" placeholder="Adresa" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputGrad" class="col-sm-2 control-label">Grad</label>
                        <div class="col-sm-10">
                            <input name="grad" class="form-control" id="inputGrad" placeholder="Grad" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPB" class="col-sm-2 control-label">Poštanski broj</label>
                        <div class="col-sm-10">
                            <input name="post_broj" class="form-control" id="inputPB" placeholder="Poštanski broj" type="number">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputKontakt" class="col-sm-2 control-label">Kontakt broj</label>
                        <div class="col-sm-10">

                            <div class="input-group" >
                                <div class="input-group-addon" style="">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input name="kontakt_broj" type="text" id="inputKontakt" class="form-control" data-inputmask="&quot;mask&quot;: &quot;999 999 99 99&quot;" data-mask="">
                            </div><!-- /.input group -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Kontakt email</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input name="email" type=email id="inputEmail" class="form-control" placeholder="primjer@domena.hr">
                            </div>
                        </div>
                    </div>


                </div><!-- /.box -->
                <!-- general form elements disabled -->

            </div>
           
        </div>

        <div class="col-md-6">
            <!-- Dio za primku -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Otvaranje nove primke</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">


                    <div class="form-group">
                        <label for="inputSifra" class="col-sm-2 control-label">Šifra</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputSifra" placeholder="Šifra uređaja" type="number" name="sifra">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputBrand" class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputBrand" placeholder="Toshiba, Lenovo, Epson ..." type="text" name="brand">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputTip" class="col-sm-2 control-label">Tip</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputTip" placeholder="Printer, laptop, računalo ..." type="text" name="tip">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNaziv" class="col-sm-2 control-label">Naziv</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputNaziv" placeholder="PC Računalo Feniks, Lenovo G50-70 ..." type="text" name="naziv" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSerijski" class="col-sm-2 control-label">Serijski broj</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputSerijski" placeholder="Serijski broj ..." type="text" name="serijski">
                        </div>
                    </div>

                    <hr>


                    <div class="form-group">
                        <label for="inputDK" class="col-sm-2 control-label">Datum kupnje</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                                <input type="text" id="inputDK" name="dk" class="form-control" data-inputmask="'alias': 'dd.mm.yyyy'" data-mask>
                    </div><!-- /.input group -->
                    
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputRacun" class="col-sm-2 control-label">Račun</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputRacun" placeholder="Broj računa ..." type="text" name="racun">
                        </div>
                    </div>



                    <!-- textarea -->
                    <div class="form-group" >
                        <label for="inputPK" class="col-sm-2 control-label">Prijava kvara</label>
                        <div class="col-sm-10">
                            <textarea id="inputPK" class="form-control" rows="3" placeholder="Kvar koji stranka prijavljuje ..." name="opis" required=""></textarea>
                        </div>
                    </div>



                    <div class="form-group" >
                        <label for="inputPP" class="col-sm-2 control-label">Priloženo / Primijećeno uz uređaj</label>
                        <div class="col-sm-10">
                            <textarea name="prilozeno" id="inputPP" class="form-control" rows="3" placeholder="Upisati što se zaprima uz uređaj (punjač, kablovi, torba i sl.) i primijećena oštećenja ..."></textarea>
                        </div>
                    </div>


                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-info pull-right">Unesi podatke</button>
                </div>

            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>

    </div> 

</form>

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
                        $.post('search/pretrazi_kupca.php', {value: value}, function (data) {
                            $('#search_result').html(data);
                        });
                        
                    } else {
                        $('#search_result').hide();
                    }

                });
                
                $('#search_result kupac li').click(function(e) {
                    e.preventDefault();
                    alert($('#search_result ul li').text());
                  });
                  
                  $('#search_button').click(function(e) {
                    e.preventDefault();
                    $("#search_box").val("");
                    $('#search_result').hide();
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

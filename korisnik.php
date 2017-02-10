<?php
include_once './checkLogin.php';
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
        <title>Radni nalozi</title>
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
        <link href="search/search.css" rel="stylesheet">

        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

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
                    <div class="box box-info">
                        <?php if($_GET['action'] == "il") { ?>
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Pažnja!</h4>
                            Molim Vas izmjenite lozinku. Postavite je da se razlikuje od vašeg korisničkog imena!
                        </div>
                        <?php } ?>
                        <div class="alert alert-danger alert-dismissable" style="display:none" id="greska">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Pažnja!</h4>
                            Upisana ista lozinka, molim ponovite unos.
                        </div>

                        <div class="alert alert-success alert-dismissable" style="display:none" id="uspjesno">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>	<i class="icon fa fa-check"></i> Pažnja!</h4>
                            Upješno izmijenjena lozinka, slobodno nastavite rad! Klinite ovdje za dalje: <a href="primke.php">Nastavi rad</a>
                        </div>

                        <div class="box-header with-border">
                            <h3 class="box-title">Izmjena lozinke</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="loz" class="col-sm-2 control-label">Nova lozinka</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="loz" placeholder="Lozinka" required="">
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button id="submit" class="btn btn-info pull-right">Izmjena</button>
                            </div><!-- /.box-footer -->
                        </form>
                        
                    </div>
                </section>
            </div>
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
        <!-- Pretrage u sidebaru -->
        <script type="text/javascript" src="search/searchkupca.js"></script>
        <script type="text/javascript" src="search/searchprimka.js"></script>
        <script type="text/javascript" src="search/searchserijski.js"></script>

        <script>
            $(document).ready(function () {

                var i = <?php echo $_COOKIE['id'] ?>;

                $("#submit").on("click", this, function (e) {
                    e.preventDefault();
                    $('#uspjesno').hide();
                    $('#greska').hide();

                    var lozinka = $("#loz").val();
                    var provjera = null;

                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: "json/djelatnik/pl.php",
                        data: {"id": i, "l": lozinka},
                        success: function (r) {
                            console.log(r);
                            if (r && r != null)
                                provjera = r;
                        }
                    });

                    if (lozinka) {
                        if (!provjera) {
                            $.ajax({
                                type: 'POST',
                                url: "json/djelatnik/izmjena_lozinke.php",
                                data: {"id": i, "l": lozinka},
                                success: function (r) {
                                    if (r && r != null)
                                        $('#uspjesno').show();
                                    else
                                        $('#greska').show();
                                },
                                error: function (e) {
                                    // $('#greska').show();
                                }
                            });
                        } else {
                            $('#greska').show();
                        }

                    } else {
                        alert("Polje ne može biti prazno");
                    }

                })

            })
        </script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>
</html>
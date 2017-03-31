<?php
include_once './klase/checkLogin.php';
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
    <title>Dokumentacija</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="font/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link href="search/search.css" rel="stylesheet">
    <link rel="icon" type="ispis/logo.png" href="ispis/icon.ico.png">
    <link rel="stylesheet" href="jquery-ui.css">
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

                        <section class="invoice">
                            <form id="unosUpute" class="form-horizontal" action="" method="POST">
                                <div class="row">

                                    <div class="col-md-6">
                                        <!-- Dio za primku -->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Stvaranje nove upute</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <!-- form start -->

                                            <div class="box-body">


                                                <div class="form-group">
                                                    <label for="inputProizvod" class="col-sm-2 control-label" id="required">Proizvod</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id="inputProizvod" placeholder="Dio koji se naručuje" type="text" name="proizvod">
                                                    </div>
                                                </div>

                                                <div class="box-body" >


                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Grupa</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="grupa" name='grupa'>

                                                                <option></option>
                                                                <option>Primka</option>
                                                                <option>Radni nalozi</option>
                                                                <option>RMA nalozi</option>
                                                                <option>Narudžbe</option>
                                                                <option>Dokumentacija</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Podgrupa</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="podgrupa" name='podgrupa'>

                                                                

                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="inputPrimka" class="col-sm-2 control-label">Primka</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="inputPrimka" placeholder="Broj primke (ukoliko je povezano)" type="text" name="primka">
                                                        </div>
                                                    </div>



                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    <button id="insertUputa" name="submit" class="btn btn-info pull-right">Unesi podatke</button>
                                                </div>

                                            </div>
                                            <!-- /.box -->
                                            <!-- general form elements disabled -->

                                        </div>

                                    </div>

                                </form>
                            </section>

                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->

                    <?php require_once('./pageParts/footer.php') ?>
                </div>
                <!-- ./wrapper -->

                <!-- REQUIRED JS SCRIPTS -->

                <!-- jQuery 2.1.4 -->
                <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
                <script src="jquery-ui.js"></script>
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
                <!-- Pretrage u sidebaru -->
                <script type="text/javascript" src="search/searchkupca.js"></script>
                <script type="text/javascript" src="search/searchprimka.js"></script>
                <script type="text/javascript" src="search/searchserijski.js"></script>

                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#grupa').on("click", this, function(){
                            if($(this).val() == 'Primka') {
                                $('#podgrupa option').remove();
                                $('#podgrupa').append('<option></option><option>Nova primka</option><option>Otvaranje primke</option><option>Slanje primke</option><option>Zatvaranje primke</option>');
                            };
                            if($(this).val() == 'Radni nalozi') {
                                $('#podgrupa option').remove();
                                $('#podgrupa').append('<option></option><option>Otvaranje radnog naloga</option><option>Otvaranje primke</option><option>Slanje primke</option><option>Zatvaranje primke</option>');
                            };
                            if($(this).val() == 'RMA nalozi') {
                                $('#podgrupa option').remove();
                                $('#podgrupa').append('<option></option><option>Nova primka</option><option>Otvaranje primke</option><option>Slanje primke</option><option>Zatvaranje primke</option>');
                            };
                        })
                    })
                </script>

            </body>

            </html>

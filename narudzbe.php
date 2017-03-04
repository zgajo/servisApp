<?php
include_once './klase/checkLogin.php';
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
        <title>Narudžbe</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="font/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="font/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="jquery-ui.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        --><link rel="icon" type="ispis/logo.png" href="ispis/icon.ico.png">
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
                    <div class="col-md-push-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="<?php if(!$_GET['primka'] && !$_GET['stranka']  && !$_GET['narudzba']) echo  "active" ?>"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Sve otvorene narudžbe</a></li>
                                <?php if(isset($_GET['narudzba'])) { ?>
                                <li class="<?php if(!$_GET['primka'] && !$_GET['stranka'] && $_GET['narudzba']) echo  "active" ?>"><a href="#tab_2" data-toggle="tab" aria-expanded="true">Uredi narudžbu</a></li>
                                <?php } ?>
                                <li class="<?php if($_GET['primka'] && $_GET['stranka']) echo "active" ?>"><a href="#tab_3" data-toggle="tab" aria-expanded="false">Nova narudžba</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane <?php if(!$_GET['primka'] && !$_GET['stranka'] && !$_GET['narudzba']) echo  "active" ?>" id="tab_1">
                                    <!-- TABLE: Sve otvorene primke -->
                                    <div class="box box-info" style="border-top: none">

                                        <div class="box-body">
                                            <table id="sve_narudzbe" class="table table-bordered table-striped">
                                                <thead >
                                                    <tr>
                                                        <th style="text-align: center">Datum narudžbe</th>
                                                        <th style="text-align: center">Proizvod</th>
                                                        <th style="text-align: center">Part no.</th>
                                                        <th style="text-align: center">Dobavljač</th>
                                                        <th style="text-align: center">Cijena (VPC)</th>
                                                        <th style="text-align: center">Stranka</th>
                                                        <th style="text-align: center">Primka</th>
                                                        <th style="text-align: center">Skladište</th>
                                                        <th  style="text-align: center">Uređivanje</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="sve_narudzbe" >
                                                    
                                                </tbody>
                                            </table>
                                        </div><!-- /.box-body -->

                                        <div style="clear: both">

                                        </div><!-- /.box-footer -->
                                    </div><!-- /.box -->


                                </div><!-- /.tab-pane -->
                                 <?php if(isset($_GET['narudzba'])) { ?>
                                <div class="tab-pane <?php if(!$_GET['primka'] && !$_GET['stranka'] && $_GET['narudzba']) echo  "active" ?>" id="tab_2">
                                    <?php include_once './pageParts/narudzbe/uredi_narudzbu.php'; ?>
                                </div><!-- /.tab-pane -->
                                <?php } ?>

                                <div class=" tab-pane <?php if($_GET['primka'] && $_GET['stranka']) echo "active" ?>" id="tab_3">

                                    <form id="unosNarudzbe" class="form-horizontal" action="" method="POST" >
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Dio za stranku -->

                                                <div class="box box-info">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Podaci stranke</h3>
                                                        <br>
                                                        <br>

                                                        <div id="box"  class="form-group" style="    padding-left: 15px;">
                                                            <!-- Prije mi je  id="box" bio na ovom spanu i bez diva -->
                                                            <span style="float: left">
                                                                <span>Pretraži u bazi :</span> <input type="text" id="search_box" style="    margin-left: 10px;">
                                                                <span id="search_button" >Očisti</span>
                                                            </span>
                                                            <div id="search_result">

                                                            </div>
                                                        </div>

                                                    </div><!-- /.box-header -->
                                                    <!-- form start -->

                                                    <div class="box-body">

                                                        <div class="form-group" id="divTvrtka">
                                                            <label for="inputTvrtka" class="col-sm-2 control-label">Tvrtka</label>
                                                            <div class="col-sm-10">
                                                                <div id="inputid" style="display: none"></div>
                                                                <input name="tvrtka" class="form-control" id="inputTvrtka" placeholder="Tvrtka" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="inputIme" class="col-sm-2 control-label"  id="required">Ime</label>
                                                            <div class="col-sm-10" >
                                                                <input name="ime" class="form-control" id="inputIme" placeholder="Ime" type="text" required="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPrezime" class="col-sm-2 control-label"  id="required">Prezime</label>
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
                                                            <label for="inputKontakt" class="col-sm-2 control-label"  id="required">Kontakt broj</label>
                                                            <div class="col-sm-10">

                                                                <div class="input-group" >
                                                                    <div class="input-group-addon" style="">
                                                                        <i class="fa fa-phone"></i>
                                                                    </div>
                                                                    <input name="kontakt_broj" type="text" id="inputKontakt"  required="" class="form-control" data-inputmask="&quot;mask&quot;: &quot;999 999 99 99&quot;" data-mask="">
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
                                                        <a class="btn btn-app" id="editBtn" style="display: none;  float: right">
                                                            <i class="fa fa-edit"></i> Izmijeni
                                                        </a>

                                                        <a class="btn btn-app" id="editPonistiBtn" style="display: none;  float: right">
                                                            <i class="fa fa-undo"></i> Poništi
                                                        </a>

                                                        <a class="btn btn-app"  id="spremiKupca" style="display: none;  float: right">
                                                            <i class="fa fa-save"></i> Spremi promjene
                                                        </a>

                                                        <a class="btn btn-app"  id="ponistiK" style="display: none; float: right">
                                                            <i class="fa  fa-undo"></i> Poništi
                                                        </a>

                                                    </div><!-- /.box -->
                                                    <!-- general form elements disabled -->

                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <!-- Dio za primku -->
                                                <div class="box box-info">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Otvaranje nove narudžbe</h3>
                                                    </div><!-- /.box-header -->
                                                    <!-- form start -->

                                                    <div class="box-body">


                                                        <div class="form-group">
                                                            <label for="inputProizvod" class="col-sm-2 control-label" id="required">Proizvod</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputProizvod" placeholder="Dio koji se naručuje" type="text" name="proizvod">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPN" class="col-sm-2 control-label">Part no.</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPN" placeholder="Product number dijela koji se naručuje" type="text" name="pn">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="inputDobavljac" class="col-sm-2 control-label" id="required">Dobavljač</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputDobavljac" placeholder="Zelcos, Epson ..." type="text" name="dobavljac">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="inputVPC" class="col-sm-2 control-label" id="required">CIjena (VPC)</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputVPC" placeholder="Cijena koja je javljena kupcu ..." type="text" name="cijenaVPC">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputSkladiste" class="col-sm-2 control-label"  >Skladište</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputSkladiste" placeholder="Skladište na koje se treba poslati proizvod ..." type="text" name="skladiste">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPrimka" class="col-sm-2 control-label">Primka</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPrimka" placeholder="Broj primke (ukoliko je povezano)" type="text" name="primka">
                                                            </div>
                                                        </div>



                                                    </div><!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <button  id="insertNarudzba" name="submit" class="btn btn-info pull-right">Unesi podatke</button>
                                                    </div>

                                                </div><!-- /.box -->
                                                <!-- general form elements disabled -->

                                            </div>

                                        </div> 

                                    </form>



                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- nav-tabs-custom -->
                    </div>

                    <div style="clear: both">

                    </div><!-- /.box-footer -->

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->
            <?php require_once('pageParts/footer.php') ?>

        </div><!-- ./wrapper -->

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
        <script src="search/unos_narudzbe.js" type="text/javascript"></script>
        <?php if($_GET['stranka'] && $_GET['primka']){ ?>
        <script>
        
           upisKupca(<?php echo $_GET['stranka'] ?>);
           $('#inputPrimka').val(<?php echo $_GET['primka'] ?>);
           
        </script>
        <?php } ?>

        

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>
</html>

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
                    
                    
<form class="form-horizontal" action="" method="POST" onsubmit="return confirm('Jeste li sigurni da želite izmijeniti podatke?');">
  <div class="col-md-3">
    <div class="box box-primary">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center" id="djelatnik"><?php echo $_COOKIE['user'] ?></h3>
                    <p class="text-muted text-center" id="pozicija"><?php echo $_COOKIE['odjel'] . ' ' .$_COOKIE['centar'];  ?></p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Mjesečni broj radnih naloga</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                      <b>Prosjek rješavanja reklamacije</b> <a class="pull-right">543</a>
                    </li>
                    
                    <select class="list-group-item"  id="pc">
                        <option>Pula</option>
                        <option>Rovinj</option>
                    </select>
                  </ul>
                    
                    

                    <a href="#" class="btn btn-primary btn-block" id="izmijeni"><b>Izmijeni</b></a>
                </div><!-- /.box-body -->
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
        $(document).ready(function (){
            
            $('#izmijeni').click(function (){
                var id = <?php echo $_COOKIE['id']; ?>;
                var centar = $('#pc').val();
                
                $.post("izmjena_centra.php", {"centar": centar, "id": id});
            });
            
        });
        
        </script>
    </body>
</html>

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
        <title>Radni nalozi</title>
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
        <style>
            #stranka {
                width: 35%;
            }

            #primka {
                width: 65%;
            }

            #required:after {
                content: " *";
                color: red
            }

            @media (max-width: 768px) {
                #stranka {
                    width: 100%;
                }
                #primka {
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

                            <?php
                    if (isset($_GET['action'])) {
                        if ($_GET['action'] == "novi_rn" && !empty($_GET['primka_id'])) {

                            $rn = new servisRN();
                            $last = $rn->insert($_GET['primka_id'], $_COOKIE['id']);
                            unset($rn);

                            $primka = new primka();
                            $primka = $primka->getById($_GET['primka_id']);
                            $trazi = substr($primka[0]["p_status"], 0, 12);
                            if ($trazi == "Poslano u CS") {

                                unset($primka);
                                $primka = new primka();
                                $primka->azurirajStatus("Poslano u CS - Rovinj / Započelo servisiranje", $_GET['primka_id']);
                            } else {

                                unset($primka);
                                $primka = new primka();
                                $primka->azurirajStatus("U servisu", $_GET['primka_id']);
                            }

                            unset($primka);
                            echo '<script>'
                            . 'setTimeout(function(){ window.location.href="rn.php?radni_nalog=' . $last . '";}, 100);'
                            . '</script>';
                            ?>

                                <?php
                        }
                    } else if (!empty($_GET['radni_nalog'])) {

                        require_once('./pageParts/rnPagePart/uredi_rn.php');
                    } else {

                        require_once('./pageParts/rnPagePart/svi_rn.php');
                    }
                    ?>
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
        <script>
            $('#rucna').click(function () {
                var primka = $('#primka_id').text();
                window.open("rucne.php?primka=" + primka, "_blank");
            });
        </script>
        <?php
        if (!empty($_GET['radni_nalog'])) {

            require_once './pageParts/rnPagePart/uredi_rn_js.php';
            ?>



            <?php
        } else {


            if ($_COOKIE['odjel'] == "Servis" || $_COOKIE['odjel'] == "Reklamacije") {
                ?>
                <script type="text/javascript" src="pageParts/rnPagePart/svi_rn_sr.js"></script>
                <?php } else { ?>
                    <script type="text/javascript" src="pageParts/rnPagePart/svi_rn.js"></script>
                    <?php } ?>


                        <?php } ?>


                            <script type="text/javascript">
                                var table = $('#sviRN').DataTable();
                                var data = table
                                    .rows()
                                    .data();
                                // provjeri da li ima već unešenih redova i stavi interval osvježavanja ukoliko postoje redovi
                                if (data.length != 0) {

                                    setInterval(function () {
                                        table.ajax.reload(null, false);
                                    }, 30000);
                                }

                                $(window).on("blur focus", function (e) {
                                    var prevType = $(this).data("prevType");

                                    if (prevType != e.type) { //  reduce double fire issues
                                        switch (e.type) {
                                        case "blur":
                                            console.log('not-active');
                                            break;
                                        case "focus":
                                            var table = $('#sviRN').DataTable();
                                            var data = table
                                                .rows()
                                                .data();
                                            // provjeri da li ima već unešenih redova i stavi interval osvježavanja ukoliko postoje redovi
                                            if (data.length != 0) {
                                                table.ajax.reload(null, false);
                                            }
                                            console.log('active');
                                            break;
                                        }
                                    }


                                    $(this).data("prevType", e.type);
                                })
                            </script>
                            <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>

    </html>

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
        <title>Primke</title>
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
        <link rel="icon" type="ispis/logo.png" href="ispis/icon.ico.png">
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="jquery-ui.css">

        <link href="search/search.css" rel="stylesheet">
        <style>
            #stranka {
                width: 35%;
            }

            #primka {
                width: 65%;
            }

            #upr {
                float: left;
                width: 50%;
                margin-left: 2%;
            }

            .rijeseno {
                background-color: orange;
            }

            .hover {
                background-color: lightblue;
            }

            #urn {
                float: right;
                width: 45%;
                margin-right: 2%;
            }

            #required:after {
                content: " *";
                color: red
            }

            @media (max-width: 1024px) {
                #stranka {
                    width: 100%;
                }
                #primka {
                    width: 100%;
                }
                #upr {
                    float: left;
                    width: 100%;
                    margin: auto;
                }
                #urn {
                    float: right;
                    width: 100%;
                    margin: auto;
                }
                #required:after {
                    content: " *";
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

                            <?php
                    /*
                      UKOLIKO SE PROVJERAVA PRIMKA
                     */
                    if (isset($_GET['primka'])) {

                        require_once 'pageParts/primkaPagePart/uredi_primku.php';
                    } else if (isset($_GET['pregled_serijski'])) {
                        require_once './pageParts/primkaPagePart/pregled_serijski.php';
                    }
                    /*
                      Prikaz svih naloga
                     */ else {
                        require_once 'pageParts/primkaPagePart/sve_primke.php';
                    }
                    ?>

                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->

                    <!-- Main Footer -->
                    <?php require_once('pageParts/footer.php') ?>

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
        <script type="text/javascript" src="search/searchserijski.js"></script>
<script type="text/javascript" src="search/searchprimka.js"></script>

        <?php
        if (!isset($_GET['primka']) && !isset($_GET['pregled_serijski'])) {
            //Prikaz svih primki
            require_once './pageParts/primkaPagePart/sve_primke_js.php';
            require_once './pageParts/primkaPagePart/sve_poslano_js.php';
            ?>


            <script src="pageParts/primkaPagePart/unos_primke.js" type="text/javascript"></script>
            <script src="pageParts/primkaPagePart/unos_sifre.js" type="text/javascript"></script>

            <?php } else if (isset($_GET['pregled_serijski'])) { ?>
                <script>
                    var serijski = "<?php echo $_GET['pregled_serijski'] ?>";
                    console.log(serijski);
                    $('#serijski_primke').DataTable({
                        "ajax": {
                            "url": "json/primka/getBySerijski.php?serijski=" + serijski,
                            "dataSrc": ""
                        },
                        "columns": [
                            {
                                "data": "primka",
                                "render": function (data, type, row, meta) {
                                    var a = '<a style="margin-right:20px" href="pregled.php?primka=' + row.primka + '"><i style="" class="fa  fa-file-text-o"></i></a><p style="display:inline">' + row.primka + '</p>';
                                    return a;
                                }
                            },
                            {
                                "data": "status",
                                "render": function (data, type, row, meta) {
                                    var dz = new Date(row.zaprimljeno);
                                    return [dz.getDate(), dz.getMonth() + 1, dz.getFullYear()].join('.');
                                }
                            },
                            {
                                "data": "uredaj"
                            },
                            {
                                "data": "status",
                                "render": function (data, type, row, meta) {
                                    return row.ime + ' ' + row.prezime;
                                }
                            },
                            {
                                "data": "status"
                            }
                    ]
                    });
                </script>
                <?php
        } else {
            //Uređivanje primke
            require_once './pageParts/primkaPagePart/uredi_primku_js.php';
            ?>

                    <?php } ?>
                        <!-- date-range-picker -->
                        <script>
                            $(function () {

                                //Datemask dd/mm/yyyy
                                $("#datemask").inputmask("dd.mm.yyyy", {
                                    "placeholder": "dd.mm.yyyy"
                                });

                                //Money Euro
                                $("[data-mask]").inputmask();

                            });

                            var table = $('#sve_primkeOtvorenServis').DataTable();
                            var data = table
                                .rows()
                                .data();
                            // provjeri da li ima već unešenih redova i stavi interval osvježavanja ukoliko postoje redovi
                            if (data.length != 0) {
                                setInterval(function () {
                                    table.ajax.reload(null, false);
                                }, 30000);
                            }

                            var table = $('#sve_primkeZavrsenServis').DataTable();
                            var data = table
                                .rows()
                                .data();
                            // provjeri da li ima već unešenih redova i stavi interval osvježavanja ukoliko postoje redovi
                            if (data.length != 0) {
                                setInterval(function () {
                                    table.ajax.reload(null, false);
                                }, 30000);
                            }

                            var check = "<?php echo $_COOKIE['odjel'] ?>";
                            var centar = "<?php echo $_COOKIE['centar'] ?>";

                            $(window).on("blur focus", function (e) {
                                var prevType = $(this).data("prevType");

                                if (prevType != e.type) { //  reduce double fire issues
                                    switch (e.type) {
                                    case "blur":
                                        console.log('not-active');
                                        break;
                                    case "focus":
                                        console.log($("#search_result_primka").is(":visible"));
                                        var table = $('#sve_primkeOtvorenServis').DataTable();
                                        var data = table
                                            .rows()
                                            .data();
                                        // provjeri da li ima već unešenih redova i osvježi ukoliko postoje redovi
                                        if (data.length != 0) {
                                            console.log(data.length);
                                            var table = $('#sve_primkeOtvorenServis').DataTable();
                                            table.ajax.reload(null, false);
                                        }

                                        var table = $('#sve_primkeZavrsenServis').DataTable();
                                        var data = table
                                            .rows()
                                            .data();
                                        // provjeri da li ima već unešenih redova i osvježi ukoliko postoje redovi
                                        if (data.length != 0) {
                                            console.log(data.length);
                                            var table = $('#sve_primkeZavrsenServis').DataTable();
                                            table.ajax.reload(null, false);
                                        }

                                        console.log('active2');
                                        break;
                                    }
                                }


                                $(this).data("prevType", e.type);
                            })






                        </script>


                        </script>
                        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>

    </html>

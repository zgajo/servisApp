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
                    <input style="border: none; text-align: center" value="broj">
                </div>

                <div class="row">
                    <div class="col-xs-12" style="float:left; margin-top: 100px;">
                        <p class="lead"><b style=" font-size: 30px">ŠALJE:</b></p>
                        <div class="table-responsive">
                            <table class="table" style="font-size: 20px">
                                <tr>
                                    <th style="width:50%">Centar:</th>
                                    <td id="sc">Eurotrade Rovinj</td>
                                </tr>
                                <tr>
                                    <th>Adresa</th>
                                    <td id="sa">Naselje Gripole 53/c</td>
                                </tr>
                                <tr>
                                    <th>Grad</th>
                                    <td id="sg">Rovinj, 52210</td>
                                </tr>
                                <tr>
                                    <th>Kontakt</th>
                                    <td id="sb">052 803 699</td>
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
                                    <td><input id="pt" style="border: none" value="Eurotrade Rovinj"></td>
                                </tr>
                                <tr>
                                    <th>Adresa</th>
                                    <td><input id="pa"  style="border: none" value="Naselje Gripole 53/c"></td>
                                </tr>
                                <tr>
                                    <th>Grad</th>
                                    <td><input id="pg"  style="border: none" value="Rovinj, 52210"></td>
                                </tr>
                                <tr>
                                    <th>Kontakt</th>
                                    <td><input id="pb"  style="border: none" value="052 803 699"></td>
                                </tr>
                            </table>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->


                <div class="col-xs-12" style="margin-top: 40px">
                    <div style="float: left">
                        <b>Zatražio: </b><p>Darko</p>
                        <b>Zaprimio skladištar: </b><p>Darko</p>
                    </div>
                    <div style="float: right">
                        <b>Datum: </b><p>10.12.2016</p>
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
                
                
                
                
                
        </script>
    </body>
</html>

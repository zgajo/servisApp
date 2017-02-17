<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Potvrda zaprimanja</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
<style>            
    section{                 
        size: A4;                 
        margin: 0;             
    }             
    @media print {                 
        html, body {                     
            width: 210mm;                     
            height: 297mm;                 
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
    <body>
        <div class="wrapper">
            <!-- Main content -->

            <section class="invoice">
                <div id="t" class="row no-print">
                    <div class="col-xs-12">
                        <a  class="btn btn-default" onclick="printaj()"><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2>
                            <img src="logo.png" style="height: 50px; display: inline; float: left">

                        </h2>

                        <div style="display: inline; float: right; font-size: 10px">
                            <span style="float: left; margin-right: 8px">
                                Naselje Gripole 53/c<br>
                                Rovinj, 52210<br>
                                Radno vrijeme: <br>Pon-pet: 08:00 - 19:30; Sub: 09:00 - 14:00</span>
                            <span style="float: right; margin-left: 8px; ">


                                Kontakt: 052 803 699<br>
                                Email: servis-ro@eurotrade.hr

                            </span>
                        </div><!-- /.col -->

                    </div><!-- /.col -->
                    <div style="clear: both"> <h2 class="page-header"></div>
                </div>
                <!-- info row -->
                <div class="row invoice-info" >

                    <div class="col-sm-4 invoice-col"  style="font-size: 12px">
                        <strong>Podaci o vlasniku</strong>
                        <address>
                            <div id="tvrtka"></div>
                            <div id="osoba"></div>
                            <div id="adresa"></div>
                            <div id="grad"></div>
                            Kontakt: <div id="kontakt" style="display: inline"></div><br>
                            Email: <div id="email" style="display: inline"></div><br>
                        </address>
                    </div><!-- /.col -->


                    <div class="col-sm-4 invoice-col" style="float: right; font-size: 12px">
                        <h5 style="margin-top: 0px"><b>Potvrda o zaprimanju</b></h5>
                        <h4 style="margin-top: 0px" id="primka"></h4>
                        <b>Zaprimio: </b><p style="display: inline" id="zap"></p><br>
                        <b>Zaprimljeno: </b><p style="display: inline"  id="dz"></p>

                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Table row -->
                <div class="row" style="clear: both">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped" style="font-size: 12px">
                            <thead>
                                <tr>

                                    <th>Uređaj</th>
                                    <th>Serijski</th>
                                    <th>Datum prodaje</th>
                                    <th>Račun</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td  id="uredaj"></td>
                                    <td id="serijski"></td>
                                    <td  id="dp"></td>
                                    <td id="racun" ></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped" style="font-size: 12px">
                            <thead>
                                <tr>

                                    <th>Opis kvara</th>
                                    <th>Priloženo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td  id="opis" style="width: 60%"></td>
                                    <td id="prilozeno" style="width: 30%"></td>
                                </tr>
                            </tbody>
                        </table>

                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <p class="lead" style="font-size: 12px"><b>Napomena:</b></p>

                        <p class="text-muted well well-sm no-shadow" style="font-size: 9px;margin-top: 10px;">
                            Eurotrade d.o.o. ne odgovara za podatke na računalu, HDD uređaju ili bilo kojem uređaju koji služi za pohranu podataka ili eventualni njihov gubitak. Kod pisača u jamstvu Eurotrade d.o.o. koristi vlastiti potrošni materijal. Kod pisača van jamstva Eurotrade d.o.o. koristi potrošni materijal koji se nalazi u pisaču te postoji mogućnost da će se zbog potrebe servisiranja taj isti potrošiti djelomično ili u cijelosti.

                            Eurotrade d.o.o. poslije 60 dana od zatvaranja radnog naloga ne snosi odgovornost za robu ukoliko ona nije podignuta.

                            U slučaju odustajanja od popravka naplaćuje se dijagnostika po važećem cjeniku.

                            Sve radove, materijale i ostale troškove vezane uz radni nalog (troškovi koji nisu pokriveni ugovornom obvezom ili jamstvom) vlasnik neopozivo naručuje potpisom radnog naloga.
                        </p>
                        <p class="text-muted well well-sm no-shadow" style="font-size: 9px;margin-top: 10px;">
                            Eurotrade d.o.o. poštuje Vašu privatnost. Vaši podaci su zaštićeni i čuvaju se u skladu sa Zakonom o zaštiti osobnih podataka.

                            Osobne podatke koje prikupljamo prilikom izrade servisne primke služe isključivo za dokazivanje vlasništva kao i za potrebu komunikacije između Vas i naših djelatnika.

                            U svako doba imate pravo zatražiti dopunu, izmjenu ili brisanje osobnih podataka.
                        </p>
                        <strong>Predao:</strong><br><br><div style="border-bottom:  1px solid black; width: 200px;height: 30px"></div><br><br>
                        <strong>Zaprimio:</strong><br><br><div style="border-bottom:  1px solid black; width: 200px;height: 30px"></div><br>
                    </div><!-- /.col -->
                    <div class="col-xs-6" style="font-size: 9px">
                        <p class="lead" style="font-size: 12px"><b>Ostali Eurotrade centri</b></p>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">PULA</th>
                                    <td>
                                        Benediktinske opatije 3<br>
                                        tel. 052/211-632, fax 052/211-637<br>
                                        Radno vrijeme: <br>
                                        pon-pet 8-19:30; 
                                        subota 8-13
                                    </td>
                                </tr>
                                <tr>
                                    <th>ZAGREB</th>
                                    <td>
                                        Gospodarska ulica 15, Donji Stupnik <br>
                                        tel. 01/6531-230, fax 01/6531-231<br>
                                        Radno vrijeme: <br>
                                        pon-pet 8-16; 
                                    </td>
                                </tr>
                                <tr>
                                    <th>VARAŽDIN</th>
                                    <td>
                                        Miroslava Krleže 1<br>
                                        tel. 042/331-177, fax 042/331-149<br>
                                        Radno vrijeme: <br>
                                        pon-pet 8-19:30; 
                                        subota 8-13
                                    </td>
                                </tr>
                                <tr>
                                    <th>RIJEKA</th>
                                    <td>
                                        Eugena Kovačića 2, TC Andrea<br>
                                        tel. 051/680-760, fax 051/680-763<br>    
                                        Radno vrijeme: <br>
                                        pon-pet 8-16; <br>
                                        Trg 128 brigade HV 4, Korzo<br>
                                        tel. 051/212-321 <br>
                                        Radno vrijeme: <br>
                                        pon-pet 8-19:30; subota 8-14
                                    </td>
                                </tr>
                                <tr>
                                    <th>SPLIT</th>
                                    <td>
                                        Matoševa 86, Solin<br>
                                        tel. 021/262-012, fax 021/262-015<br>    
                                        Radno vrijeme: <br>
                                        pon-pet 8-16; 
                                    </td>
                                </tr>
                                <tr>
                                    <th>OSIJEK</th>
                                    <td>
                                        Vijenac Jakova Gotovca 5<br>
                                        tel. 031/210-999<br>
                                        Radno vrijeme: <br>
                                        pon-pet 8-19:30; 
                                        subota 8-13
                                    </td>
                                </tr>
                                <tr>
                                    <th>SISAK</th>
                                    <td>
                                        Ante Starčevića 13<br>
                                        tel. 044/524-498, fax 044/524-499<br>
                                        Radno vrijeme: <br>
                                        pon-pet 8-19:30; 
                                        subota 8-13
                                    </td>

                            </table>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- this row will not appear when printing -->
                
            </section><!-- /.content -->


        </div><!-- ./wrapper -->

        <!-- AdminLTE App -->


        <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script>
                            var id = <?php echo $_GET['primka'] ?>;
                            $.get("../json/primka/getById.php", {"id": id}, function (primka) {
                                console.log(primka);
                                var zaprimljeno = new Date(primka[0].datumZaprimanja);
                                $('#dz').text([zaprimljeno.getDate(), zaprimljeno.getMonth() + 1, zaprimljeno.getFullYear()].join('.') + ' / ' + [((zaprimljeno.getHours() < 10) ? '0' : '') + zaprimljeno.getHours(), ((zaprimljeno.getMinutes() < 10) ? '0' : '') + zaprimljeno.getMinutes()].join(':'));
                                $('#zap').text(primka[0].pot_ime + ' ' + primka[0].pot_prezime);
                                $('#primka').text('Primka: ' + primka[0].primka_id);
                                (primka[0].tvrtka != null && primka[0].tvrtka != '') ? $('#tvrtka').text(primka[0].tvrtka) : $('#tvrtka').text('');
                                $('#adresa').text(primka[0].adresa);
                                $('#grad').text(primka[0].grad);
                                $('#kontakt').text(primka[0].kontaktBroj);
                                $('#email').text(primka[0].email);
                                $('#osoba').text(primka[0].ime + ' ' + primka[0].prezime);
                                $('#uredaj').text(primka[0].naziv);
                                $('#serijski').text(primka[0].serial);
                                var kupljeno = new Date(primka[0].datumKupnje);
                                console.log(kupljeno.getMinutes());
                                (kupljeno && kupljeno.getFullYear() != '1970' && !isNaN(kupljeno)) ? $('#dp').text([kupljeno.getDate(), kupljeno.getMonth() + 1, kupljeno.getFullYear()].join('.')) : $('#dp').text('');
                                ;
                                $('#racun').text(primka[0].racun);
                                $('#opis').text(primka[0].opisKvara);
                                $('#prilozeno').text(primka[0].prilozeno_primijeceno);
                                printaj();
                            });
                            function printaj() {
                                window.print();
                                //setTimeout(function(){window.close();}, 10);
                            }
        </script>

    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
    </head>
    
    <body>
        

<form class="form-horizontal" action="" method="POST" >
    <div class="row" id="upr">
        <div class="col-md-6" style="width: 100%">
            <!-- Dio za primku -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Uređivanje primke </h3><span name="primka_id" id="primka_id"></span>
                    
                </div><!-- /.box-header -->
                <!-- PODACI STRANKE -->
            <div id="stranka" class="col-sm-4 invoice-col">
              <h4>Stranka:</h4>
              <address>
                <?php echo ($primka[0]['tvrtka']==NULL) ? '':'<strong>'.$primka[0]['tvrtka'].'</strong><br>' ?>
                  <p id="ime_prezime"></p><?php echo $primka[0]['ime']. ' '.$primka[0]['prezime']  ?><br>
                <?php echo $primka[0]['adresa'] ?><br>
                <?php echo $primka[0]['grad']; echo($primka[0]['postBroj']==NULL)? '': ', '.$primka[0]['postBroj']  ?><br>
                <i><strong>Kontakt: </strong></i><?php echo $primka[0]['kontaktBroj'] ?><br>
                <i><strong>Email: </strong></i><?php echo $primka[0]['email']?>
              </address>
            </div>
            
                <!-- PODACI PRIMKE -->
                <div  id="primka" class="col-sm-4 invoice-col">
                  <h4>Primka:</h4>
              <address>
                <i><strong>Zaprimljeno: </strong></i> <?php echo $datumZaprimanja; ?><br>
                <i><strong>Primku otvorio: </strong></i>  <?php echo $primka[0]['pot_ime']. ' ' .$primka[0]['pot_prezime'] ; ?> </strong><hr>
                <i><strong>Naziv uređaja: </strong></i>  <?php echo $primka[0]['naziv']; ?> </strong><br>
                
                <?php if(!empty($primka[0]['serial'])){ ?> <i><strong>Serijski: </strong></i> <?php echo $primka[0]['serial']; ?></br> <?php } ?>
                <?php if(!empty($primka[0]['brand'])){ ?>  <i><strong>Brand: </strong></i>  <?php echo $primka[0]['brand']; ?><br> <?php } ?>
                <?php if(!empty($primka[0]['tip'])){ ?>  <i><strong>Tip: </strong></i>  <?php echo $primka[0]['tip']; ?><br> <?php } ?>
                <?php if(!empty($primka[0]['kupljeno'])){ ?>  <i><strong>Datum kupnje: </strong></i>  <?php echo $kupljeno; ?></br> <?php } ?>
                <?php if(!empty($primka[0]['racun'])){ ?>  <i><strong>Broj računa: </strong></i>  <?php echo $primka[0]['racun']?></br> <?php } ?>
                <hr>
               
                <?php if(!empty($primka[0]['opisKvara'])){ ?>  <i><strong>Opis kvara: </strong></i><br>  <?php echo $primka[0]['opisKvara']?></br></br> <?php } ?>
               <?php if(!empty($primka[0]['prilozeno_primijeceno'])){ ?>   <i><strong>Priloženo / primijećeno uz uređaj: </strong></i> <br> <?php echo $primka[0]['prilozeno_primijeceno']?></br> <?php } ?>
                
              </address>
            </div>
                
                <div class="box-body" style="clear: both">

                    
                                                      
                         <div class="form-group">
                        <label class="col-sm-2 control-label">Ažuriraj</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='s_status_primke' id="status_primke">
                                <option style="background-color: #DFDFDF" selected disabled=""><?php echo $primka[0]['p_status']  ?></option>
                                <option <?php if($primka[0]['p_status'] == "Poslano u CS - Rovinj") echo "selected"; ?> >Pošalji u CS - Rovinj</option>
                                <option <?php if($primka[0]['p_status'] == "Čeka preuzimanje stranke") echo "selected"; ?> >Čeka preuzimanje stranke</option>
                                <option <?php if($primka[0]['p_status'] == "Kupac preuzeo") echo "selected"; ?> >Kupac preuzeo</option>
                            </select>
                        </div>
                    </div>
                    

                    


                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="submit" id="azuriraj" class="btn btn-sm btn-info btn-flat pull-right">Unesi promjenu</button>
                    <?php if($_COOKIE["odjel"] == "Servis") { ?><a  style="margin-left: 5px; margin-right: 5px;" class="btn btn-sm btn-info btn-flat pull-left" href="../rn.php?action=novi_rn&primka_id=<?php echo $primka[0]['id']; ?>">Novi radni nalog</a><?php } ?>
                    <a class="btn btn-sm btn-info btn-flat pull-left" href="../rma.php?action=novi_rma&primka_id=<?php echo $primka[0]['id'] ?>" >Novi RMA nalog</a>
                </div>

            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>
        
    </div>
    <div class="row" id="urn">
   
            <div class="col-md-6" style="width: 100%">
            <!-- Dio za primku -->
            
            <div class="box box-info" style="border-top-color:#00a65a">
              <div class="box-body" style="clear: both">
                <div class="box-header with-border">
                    <h3 class="box-title">Radni nalog servisa br. <?php echo $prim['rn_id']; ?></h3>
                    
                </div><!-- /.box-header -->
                <!-- form start -->
                 <div  id="primka" class="col-sm-4 invoice-col" >
              <address>
                <i><strong>Početak rada: </strong></i> <?php echo date("d.m.Y / H:i:s",strtotime($prim['pocetakRada'])); ?><br>
                <i><strong>Rad započeo: </strong></i>  <?php echo $prim['zapoceoRn_ime'] . ' ' .$prim['zapoceoRn_prezime'] ?> </strong><br>
              
                <i><strong>Opis popravka: </strong></i>  <?php echo $prim['opisPopravka']; ?> </strong><br>
              <hr>
                <i><strong>Naplatiti: </strong></i>  <?php echo $prim['naplata']; ?> </strong><br>
                <i><strong>Rad završio: </strong></i>  <?php echo $prim['zavrsioRn_ime'] . ' ' . $prim['zavrsioRn_prezime']; ?> </strong><br>
              <i><strong>Završetak rada: </strong></i>  <?php if(!empty($prim['danZavrsetka'])) echo date("d.m.Y / H:i:s",strtotime($prim['danZavrsetka']));?> </strong><br>
              </address>
            </div>
           
           
           
               <!-- textarea -->
            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>
        </div>
        
        
            <div class="col-md-6" style="width: 100%">
            <!-- Dio za primku -->
            
            <div class="box box-info"  style="border-top-color:#dd4b39">
              <div class="box-body" style="clear: both">
                <div class="box-header with-border">
                    <h3 class="box-title">RMA nalog br. <?php echo $r['id']; ?></h3>
                    
                </div><!-- /.box-header -->
                <!-- form start -->
                 <div  id="primka" class="col-sm-4 invoice-col" >
              <address>
                <i><strong>Pripremljeno za slanje: </strong></i> <?php echo date("d.m.Y / H:i:s",strtotime($r['pripremljeno'])); ?><br>
                <i><strong>Poslano u ovlašteni servis: </strong></i>  <?php if(!empty($r['poslano'])) echo date("d.m.Y / H:i:s",strtotime($r['poslano']));?> </strong><br>
                <i><strong>Uređaj poslao: </strong></i>  <?php echo $r['doime'] . ' ' .$r['doprezime'] ?> </strong><br>
              <hr>
                <i><strong>Ovlašteni servis: </strong></i>  <?php echo $r['nazivOS']; ?> </strong><br>
                <i><strong>Radni nalog ovlaštenog servisa: </strong></i>  <?php echo $r['rnOs']; ?> </strong><br>
                <i><strong>Opis popravka: </strong></i>  <?php echo $r['opis']; ?> </strong><br>  
                <i><strong>Status reklamacije: </strong></i>  <?php echo $r['status']; ?> </strong><br>
              <hr> 
                <i><strong>Vraćeno iz ovlaštenog servisa: </strong></i>  <?php echo $r['zavrseno']; ?> </strong><br>
               <i><strong>Zatvorio nalog: </strong></i>  <?php echo $r['dzime'] . ' ' .$r['dzprezime'] ?> </strong><br>
                <i><strong>Naplatiti: </strong></i>  <?php echo $r['naplata']; ?> </strong><br>
              </address>
            </div>
           
           
           
               <!-- textarea -->
            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>
        </div>
        
        
    </div>
        
        <div class="row" style="clear: both">
           
          </div>
        
        
        
    </div>
    
</form>





<div class="row" style="clear: both">
           
          </div>
                        <script>
                        $(document).ready(function (){
                            
                            //Ažuriranje upita
                            $('#azuriraj').click(function (){
                                
                                var status = $('#status_primke').val();
                                var p_id = $('#primka_id').text();
                                
                                $.post('testUpdate.php', { "status" : status, "id" : p_id });
                                
                            });
                            
                            var pid = <?php echo $_GET['primka'] ?>
                            // Dohvaćanje i pregled upita
                            $.ajax({
                                type: 'GET',
                                url: "testUpdatePrimkaJson.php",
                                data: {"id":pid},
                                dataType: 'json',
                                contentType: "application/json; charset=utf-8",
                                success: function (data) {
                                      
                                      var primka = JSON.parse(JSON.stringify(data));
                                      
                                     $('#ime_prezime').html(primka[0].ime + ' ' + primka[0].prezime);
                                     $('#primka_id').html(primka[0].id);
                                      
                                      console.log(JSON.parse(JSON.stringify(data)));
                                      
                                },
                                error: function (e) {
                                    alert(e.message);
                                }
                            });
                            
                                                       
                        });
                        </script>
    </body>
</html>
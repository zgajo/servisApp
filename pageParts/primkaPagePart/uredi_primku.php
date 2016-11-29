<form class="form-horizontal" action="" method="POST" >
    <div class="row" id="upr">
        <div class="col-md-6" style="width: 100%">
            <!-- Dio za primku -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title" id="uprim">Uređivanje primke </h3>
                    
                </div><!-- /.box-header -->
                <!-- PODACI STRANKE -->
            <div id="stranka" class="col-sm-4 invoice-col">
              <h4>Stranka:</h4>
              <address>
                  <strong id="tvrtka" style="display: none">sddssadsds</strong>
                <p id="ip_kupca"></p>
                <p id="grad"></p>
                <p id="adresa"></p>
                <p id="pb"></p>
                <i  id="kontakt"><strong>Kontakt: </strong></i><br>
                <i id="email"><strong>Email: </strong></i>
              </address>
            </div>
            
                <!-- PODACI PRIMKE -->
                <div  id="primka" class="col-sm-4 invoice-col">
                  <h4>Primka:</h4>
              <address>
                  <i id="zap"><strong>Zaprimljeno: </strong></i> <br>
                  <i id="po"><strong>Primku otvorio: </strong></i>  <br>
                <i id="nu"><strong>Naziv uređaja: </strong></i>  <br>
                
                <i id="serijski"><strong>Serijski: </strong></i> </br>
                <i id="brand"><strong>Brand: </strong></i>  <br> 
                <i id="tip"><strong>Tip: </strong></i><br>
                <i id="dk"><strong>Datum kupnje: </strong></i></br> 
                <i id="br"><strong>Broj računa: </strong></i></br>
                <hr>
               
                <i id="ok"><strong>Opis kvara: </strong></i> </br></br>
                <i id="pp"><strong>Priloženo / primijećeno uz uređaj: </strong></i> <br> <br>
                
              </address>
            </div>
                
                <div id="azuriraj" class="box-body" style="clear: both">

                                                                      
                         <div class="form-group">
                        <label class="col-sm-2 control-label">Ažuriraj</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='status_primke'>
                                <option>Pošalji u CS - Rovinj</option>
                                <option>Čeka preuzimanje stranke</option>
                                <option>Kupac preuzeo</option>
                            </select>
                        </div>
                    </div>
                    

                    


                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="submit"  class="btn btn-sm btn-info btn-flat pull-right">Unesi promjenu</button> 
                   <a  style="margin-left: 5px; margin-right: 5px;" class="btn btn-sm btn-info btn-flat pull-left" href="#">Novi radni nalog</a>
                    <a class="btn btn-sm btn-info btn-flat pull-left" href="#" >Novi RMA nalog</a>
                </div>

            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>
        
    </div>
    <div class="row" id="urn">
    <?php
        if(!empty($primka[0]['rn_id'])){
         
          foreach($primka as $prim){
            ?>
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
        
        <?php
          }
        }
        $rma = new rmaNalog();
        $rma = $rma->RMAbyPrimka($_GET['primka']);
        if(!empty($rma[0]['id'])){
         
          foreach($rma as $r){
            ?>
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
        
        <?php
          }
        }
        ?>
        
    </div>
        
        <div class="row" style="clear: both">
           
          </div>
        
        
        
    </div>
    
</form>





<div class="row" style="clear: both">
           
          </div>
          
          <?php
                          
                          if($_POST){
                            
                            $p = new primka();
                            $status = $_POST['s_status_primke'];
                            if($_POST['s_status_primke'] == "Pošalji u CS - Rovinj") $status = "Poslano u CS - Rovinj";
                            ($_POST['s_status_primke'] == "Kupac preuzeo") ? $p->zatvori($primka[0]['primka_id'], $_COOKIE['id'], $_POST['s_status_primke']) : $p->updatePrimka($status, $primka[0]['primka_id']);
                            
                           
                            unset($primka);
                            unset($p);
                            
                            header('location:primke.php');
                        }
                        
            ?>
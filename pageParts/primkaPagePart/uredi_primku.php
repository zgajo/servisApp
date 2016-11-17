<?php
$primka=new primka();
$primka = $primka->getByIdRN($_GET['primka']);

print_r($primka);
$datumZaprimanja = date("d.m.Y / H:i:s", strtotime($primka[0]['datumZaprimanja']));


if($primka[0]['datumKupnje'] === "0000-00-00"){
    $kupljeno=NULL;
}else{
    $kupljeno = date("d.m.Y / H:i:s", strtotime($primka[0]['datumKupnje']));
}


/*
Djelatnik koji je otvorio primku
*/
$do = new djelatnik();
$do = $do->getDjelatnikById($primka[0]["djelatnik_otvorio_id"]);

?>


<form class="form-horizontal" action="" method="POST" >
    <div class="row" id="upr">
        <div class="col-md-6" style="width: 100%">
            <!-- Dio za primku -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Uređivanje primke <?php echo $primka[0]['id']; ?></h3>
                    
                </div><!-- /.box-header -->
                <!-- PODACI STRANKE -->
            <div id="stranka" class="col-sm-4 invoice-col">
              <h4>Stranka:</h4>
              <address>
                <strong><?php echo $primka[0]['tvrtka'] ?></strong><br>
                <?php echo $primka[0]['ime']. ' '.$primka[0]['prezime']  ?><br>
                <?php echo $primka[0]['adresa'] ?><br>
                <?php echo $primka[0]['grad']. ', '.$primka[0]['postBroj']  ?><br>
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

                    <?php        
                          if($_COOKIE["centar"] == $do["centar"]){
                        ?>
                                                      
                         <div class="form-group">
                        <label class="col-sm-2 control-label">Ažuriraj</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='s_status_primke'>
                                <option style="background-color: #DFDFDF" selected disabled=""><?php echo $primka[0]['p_status']  ?></option>
                                <option <?php if($primka[0]['p_status'] == "Poslano u CS - Rovinj") echo "selected"; ?> >Pošalji u CS - Rovinj</option>
                                <option <?php if($primka[0]['p_status'] == "Čeka preuzimanje stranke") echo "selected"; ?> >Čeka preuzimanje stranke</option>
                                <option <?php if($primka[0]['p_status'] == "Kupac preuzeo") echo "selected"; ?> >Kupac preuzeo</option>
                            </select>
                        </div>
                    </div>
                    
                     <?php
                         }
                     ?>

                    


                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?php if($_COOKIE["centar"] == $do["centar"]) { ?><button type="submit" name="submit"  class="btn btn-sm btn-info btn-flat pull-right">Unesi promjenu</button> <?php } ?>
                    <?php if($_COOKIE["odjel"] == "Servis") { ?><a  style="margin-left: 5px; margin-right: 5px;" class="btn btn-sm btn-info btn-flat pull-left" href="../rn.php?action=novi_rn&primka_id=<?php echo $primka[0]['primka_id']; ?>">Novi radni nalog</a><?php } ?>
                    <a class="btn btn-sm btn-info btn-flat pull-left" href="../rma.php?action=novi_rma&primka_id=<?php echo $primka[0]['id'] ?>" >Novi RMA nalog</a>
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
                <i><strong>Početak rada: </strong></i> <?php echo date("d.m.Y H:i:s",strtotime($prim['pocetakRada'])); ?><br>
                <i><strong>Rad započeo: </strong></i>  <?php echo $prim['zapoceoRn_ime'] . ' ' .$prim['zapoceoRn_prezime'] ?> </strong><br>
                <i><strong>Opis popravka: </strong></i>  <?php echo $prim['opisPopravka']; ?> </strong><br>
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
                <i><strong>Početak rada: </strong></i> <?php echo date("d.m.Y H:i:s",strtotime($prim['pocetakRada'])); ?><br>
                <i><strong>Rad započeo: </strong></i>  <?php echo $prim['zapoceoRn_ime'] . ' ' .$prim['zapoceoRn_prezime'] ?> </strong><br>
                <i><strong>Opis popravka: </strong></i>  <?php echo $prim['opisPopravka']; ?> </strong><br>
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
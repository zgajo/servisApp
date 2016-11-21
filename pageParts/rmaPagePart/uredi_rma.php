<?php


$rma = new rmaNalog();
$rma = $rma->RMAjoinPrimkaOtvorenUredi($_GET['rma']);

$rnPocetakRada = date("d.m.Y / H:i:s", strtotime($rma[0]['pocetakRada']));


if($rma[0]['datumKupnje'] === "0000-00-00"){
    $kupljeno=NULL;
}else{
       $kupljeno = date("d.m.Y / H:i:s", strtotime($rma[0]['datumKupnje']));
}

?>


<form class="form-horizontal" action="" method="POST" onsubmit="return confirm('Dali je sve ispravno ispunjeno?');>
    <div class="row">
        <div class="col-md-6">
            <!-- Dio za primku -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Primka <?php echo $rma[0]['primka_id']  ?></h3>
                    
                </div><!-- /.box-header -->
                <!-- form start -->
            <div id="stranka" class="col-sm-4 invoice-col"  >
              <h4>Stranka:</h4>
              <address>
                <strong><?php echo $rma[0]['tvrtka'] ?></strong><br>
                <?php echo $rma[0]['ime']. ' '.$rma[0]['prezime']  ?><br>
                <?php echo $rma[0]['adresa'] ?><br>
                <?php echo $primka[0]['grad']; echo($primka[0]['postBroj']==NULL)? '': ', '.$primka[0]['postBroj']  ?><br>
                <i><strong>Kontakt: </strong></i><?php echo $rma[0]['kontakt'] ?><br>
                <i><strong>Email: </strong></i><?php echo $rma[0]['email']?>
              </address>
            </div>
                
                <div class="col-sm-4 invoice-col" id="primka">
                  <h4>Primka:</h4>
              <address>
                <i><strong>Zaprimljeno: </strong></i> <?php echo $datumZaprimanja; ?><br>
                <i><strong>Naziv: </strong></i>  <?php echo $rma[0]['naziv']; ?> </strong><br>
                <i><strong>Primku otvorio: </strong></i>  <?php echo $rma[0]['pot_ime']. ' ' .$rma[0]['pot_prezime'] ; ?> </strong><br>
                <?php if(!empty($rma[0]['serial'])){ ?> <i><strong>Serijski: </strong></i> <?php echo $rma[0]['serial']; ?></br> <?php } ?>
                <?php if(!empty($rma[0]['brand'])){ ?>  <i><strong>Brand: </strong></i>  <?php echo $rma[0]['brand']; ?><br> <?php } ?>
                <?php if(!empty($rma[0]['tip'])){ ?>  <i><strong>Tip: </strong></i>  <?php echo $rma[0]['tip']; ?><br> <?php } ?>
                <?php if(!empty($rma[0]['$kupljeno'])){ ?>  <i><strong>Datum kupnje: </strong></i>  <?php echo $kupljeno; ?></br> <?php } ?>
                <?php if(!empty($rma[0]['racun'])){ ?>  <i><strong>Broj računa: </strong></i>  <?php echo $rma[0]['racun']?></br> <?php } ?>
                <hr>
               
                <?php if(!empty($rma[0]['opisKvara'])){ ?>  <i><strong>Opis kvara: </strong></i> <br> <?php echo $rma[0]['opisKvara']?></br></br> <?php } ?>
               <?php if(!empty($rma[0]['prilozeno_primijeceno'])){ ?>   <i><strong>Priloženo / primijećeno uz uređaj: </strong></i><br>  <?php echo $rma[0]['prilozeno_primijeceno']?></br> <?php } ?>
                
              </address>
            </div>
                
                <div class="box-body" style="clear: both">

                </div>

            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>
        
        <div class="col-md-6">
            <!-- Dio za primku -->
            
            <div class="box box-info">
              <div class="box-body" style="clear: both">
                <div class="box-header with-border">
                    <h3 class="box-title">Uređivanje RMA naloga <?php echo $rma[0]['rma_id']; ?></h3>
                    
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="form-group">
                  <label class="col-sm-2 control-label">Početak rada: </label>
                <div class="col-sm-10" >
             
                    <p  class="form-control" style="border: 0px;"><?php echo($rma[0]['danZaprimanja']  != NULL)? date("d.m.Y / H:i:s", strtotime($rma[0]['danZaprimanja'])): ""; ?></p>
            </div>
           </div>
                
            <div class="form-group">
                  <label class="col-sm-2 control-label">Poslano u OS: </label>
                <div class="col-sm-10" >
             
                    <p  class="form-control" style="border: 0px;"><?php echo($rma[0]['poslanoOSu']  != NULL)? date("d.m.Y / H:i:s", strtotime($rma[0]['poslanoOSu'])): "" ; ?></p>
            </div>
           </div>
           
           <div class="form-group">
                  <label class="col-sm-2 control-label">Rad započeo: </label>
                <div class="col-sm-10" >
             
                <p  class="form-control" style="border: 0px;"><?php echo $rma[0]['zapoceoRMA_ime'] . ' ' . $rma[0]['zapoceoRMA_prezime'] ?></p>
            </div>
           </div>
           
               <!-- textarea -->
               <div class="form-group"  >
                        <label for="inputrnOS" class="col-sm-2 control-label">RN OS-a</label>
                        <div class="col-sm-10">
                            <input id="inputrnOS" class="form-control" rows="3" placeholder="Broj naloga pod kojim je uređaj zaprimljen..." name="rnOS" value="<?php echo $rma[0]['rnOS']  ?>">
                        </div>
                    </div>
               <div class="form-group"  >
                        <label for="inputOSnaziv" class="col-sm-2 control-label">OS naziv</label>
                        <div class="col-sm-10">
                            <input id="inputOSnaziv" class="form-control" rows="3" placeholder="Servis u koji je uređaj poslan..." name="nazivOS" value="<?php echo $rma[0]['nazivOS']  ?>">
                        </div>
                    </div>
               
                    <div class="form-group"  >
                        <label for="inputPopravak" class="col-sm-2 control-label">Opis popravka</label>
                        <div class="col-sm-10">
                            <textarea id="inputPopravak" class="form-control" rows="3" placeholder="Opis rada na reklamaciji ..." name="popravak" ><?php echo $rma[0]['opisPopravka']  ?></textarea>
                        </div>
                    </div>
                    
                     <!-- textarea -->
                    <div class="form-group" >
                        <label for="inputNapomena" class="col-sm-2 control-label">Napomena</label>
                        <div class="col-sm-10">
                            <textarea id="inputNapomena" class="form-control" rows="3" placeholder="Napomene" name="napomena" ><?php echo $rma[0]['napomena']  ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputNaplata" class="col-sm-2 control-label">Naplata</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputNaplata" placeholder="Upisati šifru ..." type="text" name="naplata" value="<?php echo $rma[0]['naplata']  ?>">
                        </div>
                    </div>
                
                <div class="box-body" >


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ažuriraj</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='status_rma'>
                                
                                
                                <option style="background-color: #DFDFDF" selected disabled=""><?php echo $rma[0]['status_rma']  ?></option>
                                <option <?php if($rma[0]['status_rma'] == "Pripremljeno za slanje OS-u") echo "selected"; ?> >Pripremljeno za slanje OS-u</option>
                                <option <?php if($rma[0]['status_rma'] == "Čeka dio") echo "selected"; ?> >Čeka dio</option>
                                <option <?php if($rma[0]['status_rma'] == "Poslano u OS") echo "selected"; ?> >Pošalji u OS</option>
                                <option <?php if($rma[0]['status_rma'] == "Popravak završen u jamstvu") echo "selected"; ?> >Popravak završen u jamstvu</option>
                                <option <?php if($rma[0]['status_rma'] == "Popravak završen van jamstva") echo "selected"; ?> >Popravak završen van jamstva</option>
                                <option <?php if($rma[0]['status_rma'] == "Stranka odustala od popravka") echo "selected"; ?> >Stranka odustala od popravka</option>
                                
                                
                                 
                            </select>
                        </div>
                    </div>


                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-info pull-right">Unesi podatke</button>
                </div>
              </div>
            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>
        
    <div class="row" style="clear: both">
           
          </div>
</form>

<?php
                            
                            if(!empty($_POST)){
                                
                                switch ($_POST['status_rma']){
                                    case ($_POST['status_rma'] == "Popravak završen u jamstvu"  || $_POST['status_rma'] == "Popravak završen van jamstva" || $_POST['status_rma']== 'Stranka odustala od popravka'):
                                        $r = new rmaNalog();
                                        $r->zatvori($rma[0]['rma_id'],  $_POST['status_rma'], $_POST['popravak'], $_POST['napomena'], $_POST['naplata'], $_COOKIE['id']);

                                        $primka = new primka();

                                        $primka->updatePrimka("Završen popravak", $rma[0]['primka_id']);


                                        unset($rma);
                                        unset($primka);
                                        unset($r);
                                        header("refresh:0");
                                     break;
                                    case 'Pošalji u OS':
                                        $r = new rmaNalog();
                                        if($rma[0]['status_rma'] != "Poslano u OS"){
                                            $r->posalji($rma[0]['rma_id'], "Poslano u OS", $_COOKIE['id']);

                                        $primka = new primka();
                                        $primka->updatePrimka("Poslano u OS", $rma[0]['primka_id']);

                                        
                                        }
                                        else{
                                            $r->update($rma[0]['rma_id'],  "Poslano u OS", $_POST['popravak'], $_POST['napomena'], $_POST['naplata'], $_POST['nazivOS'], $_POST['rnOS']);

                                        $primka = new primka();                                    
                                        $primka->updatePrimka( "Poslano u OS",  $rma[0]['primka_id']);                                       

                                        }
                                        unset($rma);
                                        unset($primka);
                                        unset($r);
                                        header("refresh:0");
                                    break;
                                    default:
                                        $r = new rmaNalog();
                                        $r->update($rma[0]['rma_id'],  $_POST['status_rma'], $_POST['popravak'], $_POST['napomena'], $_POST['naplata'], $_POST['nazivOS'], $_POST['rnOS']);

                                        $primka = new primka();                                    
                                        $primka->updatePrimka( $_POST['status_rma'],  $rma[0]['primka_id']);                                       

                                        unset($rma);
                                        unset($r);
                                        unset($primka);
                                        header("refresh:0");
                                        
                                 
                                }
                               
                            
                        }
?>
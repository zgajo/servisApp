<?php


$radni = new servisRN();
$radni = $radni->RNjoinPrimkaOtvorenUredi($_GET['radni_nalog']);

$rnPocetakRada = date("d.m.Y H:i:s", strtotime($radni[0]['pocetakRada']));


$datumZaprimanja = date("d.m.Y H:i:s",  strtotime($radni[0]['datumZaprimanja']));



if($radni[0]['datumKupnje'] === "0000-00-00"){
    $kupljeno=NULL;
}else{
       $kupljeno = date("d.m.Y H:i:s", strtotime($radni[0]['datumKupnje']));
}

?>


<form class="form-horizontal" action="" method="POST" onsubmit="return confirm('Dali je sve ispravno ispunjeno?');>
    <div class="row">
        <div class="col-md-6">
            <!-- Dio za primku -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Primka <?php echo $radni[0]['primka_id']  ?></h3>
                    
                </div><!-- /.box-header -->
                <!-- form start -->
            <div id="stranka" class="col-sm-4 invoice-col"  >
              <h4>Stranka:</h4>
              <address>
                <strong><?php echo $radni[0]['tvrtka'] ?></strong><br>
                <?php echo $radni[0]['ime']. ' '.$radni[0]['prezime']  ?><br>
                <?php echo $radni[0]['adresa'] ?><br>
                <?php echo $radni[0]['grad']. ', '.$radni['postanskiBroj']  ?><br>
                <i><strong>Kontakt: </strong></i><?php echo $radni[0]['kontakt'] ?><br>
                <i><strong>Email: </strong></i><?php echo $radni[0]['email']?>
              </address>
            </div>
                
                <div class="col-sm-4 invoice-col" style="border-left: 1px outset ;" id="primka">
                  <h4>Primka:</h4>
              <address>
                <i><strong>Zaprimljeno: </strong></i> <?php echo $datumZaprimanja; ?><br>
                <i><strong>Naziv: </strong></i>  <?php echo $radni[0]['naziv']; ?> </strong><br>
                <i><strong>Primku otvorio: </strong></i>  <?php echo $radni[0]['pot_ime']. ' ' .$radni[0]['pot_prezime'] ; ?> </strong><br>
                <?php if(!empty($radni[0]['serial'])){ ?> <i><strong>Serijski: </strong></i> <?php echo $radni[0]['serial']; ?></br> <?php } ?>
                <?php if(!empty($radni[0]['brand'])){ ?>  <i><strong>Brand: </strong></i>  <?php echo $radni[0]['brand']; ?><br> <?php } ?>
                <?php if(!empty($radni[0]['tip'])){ ?>  <i><strong>Tip: </strong></i>  <?php echo $radni[0]['tip']; ?><br> <?php } ?>
                <?php if(!empty($radni[0]['$kupljeno'])){ ?>  <i><strong>Datum kupnje: </strong></i>  <?php echo $kupljeno; ?></br> <?php } ?>
                <?php if(!empty($radni[0]['racun'])){ ?>  <i><strong>Broj računa: </strong></i>  <?php echo $radni[0]['racun']?></br> <?php } ?>
                <hr>
               
                <?php if(!empty($radni[0]['opisKvara'])){ ?>  <i><strong>Opis kvara: </strong></i> <br> <?php echo $radni[0]['opisKvara']?></br></br> <?php } ?>
               <?php if(!empty($radni[0]['prilozeno_primijeceno'])){ ?>   <i><strong>Priloženo / primijećeno uz uređaj: </strong></i><br>  <?php echo $radni[0]['prilozeno_primijeceno']?></br> <?php } ?>
                
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
                    <h3 class="box-title">Uređivanje radnog naloga <?php echo $radni[0]['rn_id']; ?></h3>
                    
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="form-group">
                  <label class="col-sm-2 control-label">Početak rada: </label>
                <div class="col-sm-10" >
             
                <p  class="form-control" style="border: 0px;"><?php echo $rnPocetakRada; ?></p>
            </div>
           </div>
           
           <div class="form-group">
                  <label class="col-sm-2 control-label">Rad započeo: </label>
                <div class="col-sm-10" >
             
                <p  class="form-control" style="border: 0px;"><?php echo $radni[0]['zapoceoRn_ime'] . ' ' . $radni[0]['zapoceoRn_prezime'] ?></p>
            </div>
           </div>
           
               <!-- textarea -->
               
                    <div class="form-group"  >
                        <label for="inputPopravak" class="col-sm-2 control-label">Opis popravka</label>
                        <div class="col-sm-10">
                            <textarea id="inputPopravak" class="form-control" rows="3" placeholder="Opis rada na reklamaciji ..." name="popravak" ><?php echo $radni[0]['opisPopravka']  ?></textarea>
                        </div>
                    </div>
                    
                     <!-- textarea -->
                    <div class="form-group" >
                        <label for="inputNapomena" class="col-sm-2 control-label">Napomena</label>
                        <div class="col-sm-10">
                            <textarea id="inputNapomena" class="form-control" rows="3" placeholder="Napomene" name="napomena" ><?php echo $radni[0]['napomena']  ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputNaplata" class="col-sm-2 control-label">Naplata</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputNaplata" placeholder="Upisati šifru ..." type="text" name="naplata" value="<?php echo $radni[0]['naplata']  ?>">
                        </div>
                    </div>
                
                <div class="box-body" >


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ažuriraj</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='status_rn'>
                                
                                
                                <option style="background-color: #DFDFDF" selected disabled=""><?php echo $radni[0]['status_rn']  ?></option>
                                <option <?php if($radni[0]['status_rn'] == "Čeka dio") echo "selected"; ?> >Čeka dio</option>
                                <option <?php if($radni[0]['status_rn'] == "Popravak završen u jamstvu") echo "selected"; ?> >Popravak završen u jamstvu</option>
                                <option <?php if($radni[0]['status_rn'] == "Popravak završen van jamstva") echo "selected"; ?> >Popravak završen van jamstva</option>
                                <option <?php if($radni[0]['status_rn'] == "Stranka odustala od popravka") echo "selected"; ?> >Stranka odustala od popravka</option>
                                
                                
                                 
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
        
    </div>
</form>

<?php
                            
                            if(!empty($_POST)){
                               
                                if($_POST['status_rn'] == "Popravak završen u jamstvu"  || $_POST['status_rn'] == "Popravak završen van jamstva" || $_POST['status_rn']== 'Stranka odustala od popravka'){
                                    
                                    $rn = new servisRN();
                                    $rn->zatvoriRN($radni[0]['rn_id'],  $_POST['status_rn'], $_POST['popravak'], $_POST['napomena'], $_POST['naplata'], $_COOKIE['id']);
                                     
                                    $primka = new primka();
                                    
                                    if($radni[0]['status'] == "Poslano u CS - Rovinj" || $radni[0]['status'] == "Poslano u CS - Rovinj / Započelo servisiranje"  || $radni[0]['status'] == "Poslano u CS - Rovinj / Čeka dio") {
                                        $primka->updatePrimka("Završen popravak - poslano u centar", $radni[0]['primka_id']) ;
                                        }else{
                                            $primka->updatePrimka("Završen popravak", $radni[0]['primka_id']);
                                        }
                                    
                                    unset($radni);
                                    unset($rn);
                                    unset($primka);
                                    
                                     header("refresh:0");
                                     
                                }  else{
                                    $rn = new servisRN();
                                    $rn->update($radni[0]['rn_id'],  $_POST['status_rn'], $_POST['popravak'], $_POST['napomena'], $_POST['naplata']);
                                    $primka = new primka();
                                    
                                     if($radni[0]['status'] == "Poslano u CS - Rovinj" || $radni[0]['status'] == "Poslano u CS - Rovinj / Započelo servisiranje" || $radni[0]['status'] == "Poslano u CS - Rovinj / Čeka dio") {
                                         
                                        $primka->updatePrimka("Poslano u CS - Rovinj / Čeka dio", $radni[0]['primka_id']) ;
                                        
                                        }else{
                                           
                                            $primka->updatePrimka("Čeka dio", $radni[0]['primka_id']);
                                        }
                                    
                                    
                                    unset($radni);
                                    unset($rn);
                                    unset($primka);
                                     header("refresh:0");
                                   
                                }
                               
                            
                        }
?>
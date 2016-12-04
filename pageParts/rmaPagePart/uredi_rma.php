


<form class="form-horizontal" action="" method="POST" onsubmit="return confirm('Dali je sve ispravno ispunjeno?');>
    <div class="row">
        <div class="col-md-6">
            <!-- Dio za primku -->
            
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title" id="primkanaslov"></h3>
                    
                </div><!-- /.box-header -->
                <!-- form start -->
             <div id="pregled">
                <!-- PODACI STRANKE -->
                <div id="stranka" class="col-sm-4 invoice-col">
                    
                    <h4 style="display: inline-block">Stranka:</h4>
              <address>
                <strong id="tvrtka"></strong>
                <p id="ip_kupca"></p>
                <p id="grad"></p>
                <p id="adresa"></p>
                <p id="pb"></p>
                <i><strong>Kontakt: </strong></i><p style="display: inline" id="kontakt"></p><br>
                <i><strong>Email: </strong><p style="display: inline" id="email"></p></i>
                
              </address>
            </div>
            
                <!-- PODACI PRIMKE -->
                <div  id="primka" class="col-sm-4 invoice-col">
                    <h4 style="display: inline-block">Primka:</h4>
              <address>
                  <i><strong>Zaprimljeno: </strong></i><p  id="zap" style="display: inline"></p>  <br>
                  <i><strong>Primku otvorio: </strong></i><p  id="po" style="display: inline"></p>  <br>
                  <hr>
                  
                <i><strong>Naziv uređaja: </strong></i><p  id="nu" style="display: inline"></p>   <br>
                <i><strong>Serijski: </strong></i><p  id="serijski" style="display: inline"></p>  </br>
                <i ><strong>Brand: </strong></i><p id="brand" style="display: inline"></p>   <br> 
                <i ><strong>Tip: </strong></i><p id="tip" style="display: inline"></p> <br>
                <i><strong>Datum kupnje: </strong></i><p  id="dk" style="display: inline"></p> </br> 
                <i><strong>Broj računa: </strong></i><p   id="br" style="display: inline"></p> </br>
                <hr>
               
                <i><strong>Opis kvara: </strong></i><br> <p id="ok" style="display: inline"></p> </br></br>
                <i><strong>Priloženo / primijećeno uz uređaj: </strong></i><br><p id="pp" style="display: inline"></p>  <br> <br>
                <i><strong>Status: </strong></i><p id="st" style="display: inline"></p>  <br>
                <div id="skp" style="display: none">
                    <p id="primka_id"></p>
                    
                    <hr>
                    <i><strong>Završeno: </strong></i><p  id="zav"  style="display: none; display: inline"></p>  <br>
                    <i><strong>Primku zatvorio: </strong></i><p  id="pz" style="display: none; display: inline"></p>  <br>
                    
                </div>  
                
              </address>
            </div>
                
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
                    <h3 class="box-title">Uređivanje RMA naloga <?php echo $_GET['rma'] ?></h3>
                    
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="form-group">
                  <label class="col-sm-2 control-label">Početak rada: </label>
                <div class="col-sm-10" >
             
                    <p  class="form-control" style="border: 0px;"   id="pocetak"></p>
            </div>
           </div>
                
            <div class="form-group">
                  <label class="col-sm-2 control-label">Poslano u OS: </label>
                <div class="col-sm-10" >
             
                    <p  class="form-control" style="border: 0px;" id="poslano"></p>
            </div>
           </div>
           
           <div class="form-group">
                  <label class="col-sm-2 control-label">Rad započeo: </label>
                <div class="col-sm-10" >
             
                <p  class="form-control" style="border: 0px;"  id="zapoceo"></p>
            </div>
           </div>
           
               <!-- textarea -->
               <div class="form-group"  >
                        <label for="inputrnOS" class="col-sm-2 control-label">RN OS-a</label>
                        <div class="col-sm-10">
                            <input id="inputrnOS" class="form-control" rows="3" placeholder="Broj naloga pod kojim je uređaj zaprimljen..." name="rnOS">
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
                            <textarea id="inputPopravak" class="form-control" rows="3" placeholder="Opis rada na reklamaciji ..." name="popravak" ></textarea>
                        </div>
                    </div>
                    
                     <!-- textarea -->
                    <div class="form-group" >
                        <label for="inputNapomena" class="col-sm-2 control-label">Napomena</label>
                        <div class="col-sm-10">
                            <textarea id="inputNapomena" class="form-control" rows="3" placeholder="Napomene" name="napomena" ></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputNaplata" class="col-sm-2 control-label">Naplata</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputNaplata" placeholder="Upisati šifru ..." type="text" name="naplata">
                        </div>
                    </div>
                     
                      <div id="vr" class="form-group" style="display: none">
                    <label class="col-sm-2 control-label" >Vraćeno: </label>
                <div class="col-sm-10" >
             
                <p  class="form-control" style="border: 0px;"  id="vraceno"></p>
            </div>
           </div>
                     
                     <div id="zr" class="form-group" style="display: none">
                    <label class="col-sm-2 control-label" >Završen rad: </label>
                <div class="col-sm-10" >
             
                <p  class="form-control" style="border: 0px;"  id="zavrseno"></p>
            </div>
           </div>
           
                     <div class="form-group" id="zavrad"  style="display: none">
                  <label class="col-sm-2 control-label">Rad zavrsio: </label>
                <div class="col-sm-10" >
             
                    <p  class="form-control" style="border: 0px;" id="zavrsio"></p>
            </div>
           </div>
                
                <div class="box-body" >


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ažuriraj</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='status_rma'>
                                
                                <option>Pripremljeno za slanje OS-u</option>
                                <option >Čeka dio</option>
                                <option value="Poslano u OS">Pošalji u OS</option>
                                <option>Popravak završen u jamstvu</option>
                                <option>Popravak završen van jamstva</option>
                                <option>Stranka odustala od popravka</option>
                                <option>Vraćeno is OS-a</option>
                                
                                 
                            </select>
                        </div>
                    </div>


                </div>
                <div class="box-footer">
                    
                    <a class="btn btn-app"  id="azuriraj_status" style="float: right">
                    <i class="fa fa-save"></i> Unesi promjene
                  </a>
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
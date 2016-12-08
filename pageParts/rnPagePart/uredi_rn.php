


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
                    <h3 class="box-title">Uređivanje radnog naloga <?php echo $_GET['radni_nalog']; ?></h3>
                    
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="form-group">
                    <label class="col-sm-2 control-label" >Početak rada: </label>
                <div class="col-sm-10" >
             
                <p  class="form-control" style="border: 0px;"  id="pocetak"></p>
            </div>
           </div>
           
           <div class="form-group">
                  <label class="col-sm-2 control-label">Rad započeo: </label>
                <div class="col-sm-10" >
             
                    <p  class="form-control" style="border: 0px;" id="zapoceo"></p>
            </div>
           </div>
           
               <!-- textarea -->
               
                    <div class="form-group"  >
                        <label for="inputPopravak" class="col-sm-2 control-label">Opis popravka</label>
                        <div class="col-sm-10">
                            <textarea id="inputPopravak" class="form-control" rows="3" placeholder="Opis rada na reklamaciji ..." name="popravak" ></textarea>
                        </div>
                    </div>
                    
                    
                     
                     <!-- textarea -->
                    <div class="form-group" >
                        <label for="inputPromijenjeno" class="col-sm-2 control-label">Promijenjeno</label>
                        <div class="col-sm-10">
                            <textarea id="inputPromijenjeno" class="form-control" rows="3" placeholder="Promijenjeni dio ili novi uređaj" name="promijenjeno" ></textarea>
                        </div>
                    </div>
                     
                     <div class="form-group" >
                        <label for="inputBI" class="col-sm-2 control-label">Broj ispisa</label>
                        <div class="col-sm-3">
                            <input class="form-control" id="inputBI" placeholder="Ispisano" type="text" name="broj_ispisa" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputNaplata" class="col-sm-2 control-label">Naplata</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputNaplata" placeholder="Upisati šifru ..." type="text" name="naplata" >
                        </div>
                    </div>
                     
                      <!-- textarea -->
                    <div class="form-group" >
                        <label for="inputNapomena" class="col-sm-2 control-label">Napomena</label>
                        <div class="col-sm-10">
                            <textarea id="inputNapomena" class="form-control" rows="3" placeholder="Napomene" name="napomena" ></textarea>
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
                            <select class="form-control" name='status_rn'>
                                
                                <option>Čeka dio</option>
                                <option>Popravak završen u jamstvu</option>
                                <option>Popravak završen van jamstva</option>
                                <option>Stranka odustala od popravka</option>
                                
                                
                                 
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

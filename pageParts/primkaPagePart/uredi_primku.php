<form class="form-horizontal" action="" method="POST" >
    <div class="row" id="upr">
        <div class="col-md-6" style="width: 100%">
            <!-- Dio za primku -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title" id="uprim">Uređivanje primke </h3>
                    
                </div><!-- /.box-header -->
                <div id="pregled">
                <!-- PODACI STRANKE -->
                <div id="stranka" class="col-sm-4 invoice-col">
                    
                    <h4 style="display: inline-block">Stranka:</h4><i id="uk" style="display: inline; margin-left: 2em" class="fa fa-fw fa-edit"></i>
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
                    <h4 style="display: inline-block">Primka:</h4><i id="up" style="display: inline; margin-left: 2em" class="fa fa-fw fa-edit"></i>
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
                <div id="skp" style="display: none">
                    <i><strong>Status: </strong></i><p id="st" style="display: inline"></p>  <br>
                    <hr>
                    <i><strong>Završeno: </strong></i><p  id="zav"  style="display: none; display: inline"></p>  <br>
                    <i><strong>Primku zatvorio: </strong></i><p  id="pz" style="display: none; display: inline"></p>  <br>
                </div>  
                
              </address>
            </div>
                
                </div>
                
                
                <div id="azurirajDiv" class="box-body" style="clear: both">

                                                                      
                         <div class="form-group">
                        <label class="col-sm-2 control-label">Statu</label>
                        <div    class="col-sm-10">
                            <select class="form-control" name='status_primke'>
                                <option>Pošalji u CS - Rovinj</option>
                                <option>Čeka preuzimanje stranke</option>
                                <option>Kupac preuzeo</option>
                            </select>
                        </div>
                    </div>
                    

                    


                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div id="pregledFooter" >
                        <a  id="azuriraj_status" name="submit"  class="btn btn-sm btn-info btn-flat pull-right">Izmijeni status</a> 
                   <a  style="margin-left: 5px; margin-right: 5px;" class="btn btn-sm btn-info btn-flat pull-left" href="#">Novi radni nalog</a>
                    <a class="btn btn-sm btn-info btn-flat pull-left" href="#" >Novi RMA nalog</a>
                    </div>
                    
                </div>

            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>
        
    </div>
    
    
    <div class="row" id="urn">
            
            
        
        
    </div>
   
                
    <div class="col-md-6" id="uredi_kupca" style="display:none ">
            <!-- Dio za stranku -->
           
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Uređivanje stranke</h3>
                    <br>
                    <br>
                    
                    
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">

                    <div class="form-group" id="divTvrtka">
                        <label for="inputTvrtka" class="col-sm-2 control-label">Tvrtka</label>
                        <div class="col-sm-10">
                            <div id="inputid" style="display: none"></div>
                            <input name="tvrtka" class="form-control" id="inputTvrtka" placeholder="Tvrtka" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputIme" class="col-sm-2 control-label"  id="required">Ime</label>
                        <div class="col-sm-10" >
                            <input name="ime" class="form-control" id="inputIme" placeholder="Ime" type="text" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPrezime" class="col-sm-2 control-label"  id="required">Prezime</label>
                        <div class="col-sm-10">
                            <input name="prezime" class="form-control" id="inputPrezime" placeholder="Prezime" type="text" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdresa" class="col-sm-2 control-label">Adresa</label>
                        <div class="col-sm-10">
                            <input name="adresa" class="form-control" id="inputAdresa" placeholder="Adresa" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputGrad" class="col-sm-2 control-label">Grad</label>
                        <div class="col-sm-10">
                            <input name="grad" class="form-control" id="inputGrad" placeholder="Grad" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPB" class="col-sm-2 control-label">Poštanski broj</label>
                        <div class="col-sm-10">
                            <input name="post_broj" class="form-control" id="inputPB" placeholder="Poštanski broj" type="number">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputKontakt" class="col-sm-2 control-label"  id="required">Kontakt broj</label>
                        <div class="col-sm-10">

                            <div class="input-group" >
                                <div class="input-group-addon" style="">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input name="kontakt_broj" type="text" id="inputKontakt"  required="" class="form-control" data-inputmask="&quot;mask&quot;: &quot;999 999 99 99&quot;" data-mask="">
                            </div><!-- /.input group -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Kontakt email</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input name="email" type=email id="inputEmail" class="form-control" placeholder="primjer@domena.hr">
                            </div>
                        </div>
                    </div>
                    
                    <a class="btn btn-app"  id="spremiKupca" style=" float: right">
                    <i class="fa fa-save"></i> Spremi promjene
                    </a>
                    
                    <a class="btn btn-app"  id="ponistiK" style=" float: right">
                    <i class="fa  fa-undo"></i> Poništi
                    </a>

                </div><!-- /.box -->
                <!-- general form elements disabled -->

            </div>
           
        </div>

    <div class="col-md-6" id="uredi_primku" style="display: none">
            <!-- Dio za primku -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Ažuriranje primke</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">


                    <div class="form-group">
                        <label for="inputSifra" class="col-sm-2 control-label">Šifra</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputSifra" placeholder="Šifra uređaja" type="number" name="sifra">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputBrand" class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputBrand" placeholder="Toshiba, Lenovo, Epson ..." type="text" name="brand">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputTip" class="col-sm-2 control-label">Tip</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputTip" placeholder="Printer, laptop, računalo ..." type="text" name="tip">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNaziv" class="col-sm-2 control-label"  id="required">Naziv</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputNaziv" placeholder="PC Računalo Feniks, Lenovo G50-70 ..." type="text" name="naziv" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSerijski" class="col-sm-2 control-label">Serijski broj</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputSerijski" placeholder="Serijski broj ..." type="text" name="serijski">
                        </div>
                    </div>

                    <hr>


                    <div class="form-group">
                        <label for="inputDK" class="col-sm-2 control-label">Datum kupnje</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                                <input type="text" id="inputDK" name="dk" class="form-control" data-inputmask="'alias': 'dd.mm.yyyy'" data-mask>
                    </div><!-- /.input group -->
                    
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputRacun" class="col-sm-2 control-label">Račun</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputRacun" placeholder="Broj računa ..." type="text" name="racun">
                        </div>
                    </div>



                    <!-- textarea -->
                    <div class="form-group" >
                        <label for="inputPK" class="col-sm-2 control-label"  id="required">Prijava <br>kvara</label>
                        <div class="col-sm-10">
                            <textarea id="inputPK" class="form-control" rows="3" placeholder="Kvar koji stranka prijavljuje ..." name="opis" required=""></textarea>
                        </div>
                    </div>



                    <div class="form-group" >
                        <label for="inputPP" class="col-sm-2 control-label">Priloženo / Primijećeno uz uređaj</label>
                        <div class="col-sm-10">
                            <textarea name="prilozeno" id="inputPP" class="form-control" rows="3" placeholder="Upisati što se zaprima uz uređaj (punjač, kablovi, torba i sl.) i primijećena oštećenja ..."></textarea>
                        </div>
                    </div>
                    
                    <a class="btn btn-app"  id="spremiPrimku" style=" float: right">
                    <i class="fa fa-save"></i> Spremi promjene
                    </a>
                    
                    <a class="btn btn-app"  id="ponistiUK" style=" float: right">
                    <i class="fa  fa-undo"></i> Poništi
                    </a>

                </div><!-- /.box-body -->
                

            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>

    
    
        <div class="row" style="clear: both">
           
          </div>
        
        
        
    
</form>






          
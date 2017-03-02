


<form class="form-horizontal" >
    <div class="row"  id="upr">
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

                        <h4 style="display: inline-block">Stranka:</h4><i id="uk" style="display: inline; cursor: pointer; cursor: hand; margin-left: 2em" class="fa fa-fw fa-edit"></i>
                        <address>
                            <strong id="tvrtka"></strong>
                            <p id="ip_kupca"></p>
                            <p id="grad"></p>
                            <p id="adresa"></p>
                            <i><strong>Kontakt: </strong></i><p style="display: inline" id="kontakt"></p><br>
                            <i><strong>Email: </strong><p style="display: inline" id="email"></p></i>

                        </address>
                    </div>

                    <!-- PODACI PRIMKE -->
                    <div  id="primka" class="col-sm-4 invoice-col">
                        <h4 style="display: inline-block">Primka:</h4><i id="up" style="display: inline; cursor: pointer; cursor: hand; margin-left: 2em" class="fa fa-fw fa-edit"></i>
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
                
                <a class="btn btn-app" id="rucne"  style=" float: left; height:initial;">
                       <i class="fa fa-send" style="font-size:small; display:inline;"></i> Ručna izdatnica
                   </a>
                    <?php if($_COOKIE['odjel'] === "Reklamacije"){ ?>
                   <a class="btn btn-app" id="fin_odobrenje"  style=" float: left; height:initial;">
                       <i class="glyphicon glyphicon-shopping-cart" style="font-size:small; display:inline;"></i> Financijsko odobrenje
                   </a>
                   <?php  } ?>
                <!--
                <a class="btn btn-app" id="narudzba"  style=" float: left; height:initial;">
                       <i class="fa fa-reorder" style="font-size:small; display:inline;"></i> Narudžba
                   </a>
-->
                <div class="box-body" style="clear: both">

                </div>

            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>
        
        <div class="col-md-6">
            <!-- Dio za RMA -->
            
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
                            <input id="inputrnOS" class="form-control" rows="3" placeholder="Broj naloga ovlaštenog servisa..." name="rnOS">
                        </div>
                    </div>
               <div class="form-group"  >
                   <label for="inputOSnaziv" class="col-sm-2 control-label" id="required">OS naziv</label>
                        <div class="col-sm-10">
                            <input id="inputOSnaziv" class="form-control" rows="3" placeholder="Servis u koji je uređaj poslan..." name="nazivOS" required="">
                        </div>
                    </div>
               
                    <div class="form-group"  >
                        <label for="inputPopravak" class="col-sm-2 control-label" id="required">Opis popravka</label>
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
                            <select class="form-control" id="status_rma" name='status_rma'>
                                
                                <option>Pripremljeno za slanje OS-u</option>
                                <option >Čeka dio u OS-u</option>
                                <option value="Poslano u OS">Pošalji u OS</option>
                                <option>Vraćeno is OS-a</option>
                                <option>Popravak završen u jamstvu</option>
                                <option>Popravak završen van jamstva</option>
                                <option>Stranka odustala od popravka</option>
                                <option>Uređaj zamijenjen novim</option>
                                <option>Odobren povrat novca</option>
                                <option>DOA - Uređaj zamijenjen novim</option>
                                <option>DOA - Odobren povrat novca</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="box-footer">
                    
                    <a class="btn btn-app"  id="azuriraj_status" style="float: RIGHT">
                    <i class="fa fa-save"></i> Ažuriraj
                  </a>
                </div>
              </div>
            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>
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

            <?php include 'pageParts/primkaPagePart/uredi_kupca.php'; ?>
            <!-- general form elements disabled -->

        </div>

    </div>

    <div class="col-md-6" id="uredi_primku" style="display: none">
        <!-- Dio za primku -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Ažuriranje primke </h3><p style="display: inline"> </p><h3  class="box-title" style="display: inline" id="pid"></h3>
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
                            <select class="form-control" id="inputTip" type="text" name="tip">
                                <option>STOLNA RAČUNALA</option>
                                <option>PRIJENOSNICI</option>
                                <option>KOMPONENTE</option>
                                <option>MONITORI</option>
                                <option>PISAČI</option>
                                <option>RAČUNALNA PERIFERIJA</option>
                                <option>MOBITELI</option>
                                <option>TABLET</option>
                                <option>OSTALO</option>
                            </select>
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


 <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script>
           
        $("#narudzba").on("mouseover", this, function () {
                $(this).attr('title', 'Stvori novu narudžbu');
            })
            
            $("#rucne").on("mouseover", this, function () {
                $(this).attr('title', 'Stvori novu ručnu izdatnicu');
            })
            
            $("#narudzba").click(function (e) {
                 var primka_id = $('#primka_id').text();
           var stranka = $('#inputid').text();
                window.open("narudzbe.php?primka="+primka_id+"&stranka="+stranka,"_blank");
            }) 
            
            $("#rucne").click(function (e) {
                 var primka = $('#primka_id').text();
          
                window.open("rucne.php?primka="+primka,"_blank");
            }) 

            $("#fin_odobrenje").click(function (e) {
                 var primka = $('#primka_id').text();

                window.location = "rma.php?action=fin&p="+primka;
            })


        </script>

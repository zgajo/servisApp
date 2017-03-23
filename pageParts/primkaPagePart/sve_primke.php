    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
           
           <li <?php if($_COOKIE['odjel'] == 'Servis') echo "class='active'"?>><a href="#tab_1" data-toggle="tab" aria-expanded="true"><strong>Sve otvorene primke</strong></a></li>
           <?php if(!(($_COOKIE["odjel"] == "Maloprodaja" || $_COOKIE["odjel"] == "Ostalo" ) && $_COOKIE['centar'] == "Rovinj")){ ?> <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><strong>Primke poslane u Centralni Servis - Rovinj</strong></a></li><?php } ?>
           <li <?php if($_COOKIE['odjel'] != 'Servis') echo "class='active'"?>><a href="#tab_3" data-toggle="tab" aria-expanded="false"><strong>Nova primka</strong></a></li>
           <li  style="float:right"><a href="#tab_0" data-toggle="tab" aria-expanded="true"><strong>Odrađene primke</strong></a></li>
       </ul>
       <div class="tab-content">
        <div class="tab-pane"  id="tab_0">
            <!-- TABLE: Sve otvorene primke -->
            <div class="box box-info" style="border-top: none">

                <div class="box-body">
                    <table id="sve_primkeZavrsenServis" class="table table-bordered table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Primka</th>
                                <th>Zaprimljeno</th>
                                <th>Uređaj</th>
                                <th>Serijski</th>
                                <th>Stranka</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody style="color: black"></tbody>
                    </table>
                </div><!-- /.box-body -->

                <div style="clear: both">

                </div><!-- /.box-footer -->
            </div><!-- /.box -->


        </div><!-- /.tab-pane -->
        <div class="tab-pane <?php if($_COOKIE['odjel'] == 'Servis') echo 'active'?>" id="tab_1">
            <!-- TABLE: Sve otvorene primke -->
            <div class="box box-info" style="border-top: none">

                <div class="box-body">
                    <table id="sve_primkeOtvorenServis" class="table table-bordered table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Primka</th>
                                <th>Zaprimljeno</th>
                                <th>Uređaj</th>
                                <th>Serijski</th>
                                <th>Stranka</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody style="color: black"></tbody>
                    </table>
                </div><!-- /.box-body -->

                <div style="clear: both">

                </div><!-- /.box-footer -->
            </div><!-- /.box -->


        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <!-- TABLE: Sve otvorene primke -->
            <div class="box box-info" style="border-top: none">

                <div class="box-body">
                    <?php if ($_COOKIE['odjel'] == "Servis" || $_COOKIE['odjel'] == "Reklamacije" ) { ?>
                    <table id="svePoslanePrimkeServis" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Primka</th>
                                <th>Uređaj</th>
                                <th>Serijski</th>
                                <th>Stranka</th>
                                <th>Zaprimljeno</th>
                                <th>Status</th>
                                <th>Poslao</th>
                                
                            </tr>
                        </thead>
                        <tbody style="color: black"></tbody>
                    </table>
                    <?php } else{ ?>
                    <table id="svePoslanePrimke" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Primka</th>
                                <th>Uređaj</th>
                                <th>Serijski</th>
                                <th>Stranka</th>
                                <th>Zaprimljeno</th>
                                <th>Status</th>
                                
                            </tr>
                        </thead>
                        <tbody style="color: black"></tbody>
                    </table>
                    <?php } ?>
                </div><!-- /.box-body -->

                <div style="clear: both">

                </div><!-- /.box-footer -->
            </div><!-- /.box -->
            
            
        </div><!-- /.tab-pane -->
        <div  class="tab-pane <?php if($_COOKIE['odjel'] != 'Servis') echo 'active'?>" id="tab_3">

            <form id="unosPrimke" class="form-horizontal" action="">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Dio za stranku -->




                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Podaci stranke</h3>
                                <br>
                                <br>

                                <div id="box"  class="form-group" style="    padding-left: 15px;">
                                    <!-- Prije mi je  id="box" bio na ovom spanu i bez diva -->
                                    <span style="float: left">
                                        <span>Pretraži kupca u bazi :</span> <input type="text" id="search_box" style="    margin-left: 10px;" autocomplete="off">
                                        <span id="search_button" >Očisti</span>
                                    </span>

                                </div>

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
                                    <label for="inputKontakt" class="col-sm-2 control-label"  id="required">Kontakt broj</label>
                                    <div class="col-sm-10">

                                        <div class="input-group" >
                                            <div class="input-group-addon" style="">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input name="kontakt_broj" type="text" id="inputKontakt"  required="" class="form-control">
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
                                <a class="btn btn-app" id="editBtn" style="display: none;  float: right">
                                    <i class="fa fa-edit"></i> Izmijeni podatke kupca
                                </a>
                                
                                <a class="btn btn-app" id="editPonistiBtn" style="display: none;  float: right">
                                    <i class="fa fa-undo"></i> Poništi odabir kupca
                                </a>

                                <a class="btn btn-app"  id="spremiKupca" style="display: none;  float: right">
                                    <i class="fa fa-save"></i> Spremi promjene
                                </a>

                                <a class="btn btn-app"  id="ponistiK" style="display: none; float: right">
                                    <i class="fa  fa-undo"></i> Poništi izmjene
                                </a>

                            </div><!-- /.box -->
                            <!-- general form elements disabled -->

                        </div>

                    </div>

                    <div class="col-md-6">
                        <!-- Dio za primku -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Otvaranje nove primke</h3>
                                <br>
                                <br>

                                <div id="box_sifra"  class="form-group" style="    padding-left: 15px;">
                                    <!-- Prije mi je  id="box" bio na ovom spanu i bez diva -->
                                    <span style="float: left">
                                        <span>Šifra artikla :</span> <input type="text" id="search_box_sifra" style="    margin-left: 10px;" autocomplete="off">
                                        <span id="search_button_sifra" >Očisti</span>
                                    </span>
                                    <div id="search_result_sifra">

                                    </div>
                                </div>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">


                                <div class="form-group" id="divInputSifra" style="display:none">
                                    <label for="inputSifra" class="col-sm-2 control-label">Šifra</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputSifra" placeholder="Šifra uređaja" type="number" name="sifra">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputBrand" class="col-sm-2 control-label"  id="required">Brand</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputBrand" placeholder="Toshiba, Lenovo, Epson ..." type="text" name="brand">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="inputNaziv" class="col-sm-2 control-label"  id="required">Model</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputNaziv" placeholder="L310, C660, itd ..." type="text" name="naziv" required="">
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
                                    <label for="inputSerijski" class="col-sm-2 control-label">Serijski broj</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputSerijski" placeholder="Serijski broj ..." type="text" name="serijski" style="text-transform:uppercase">
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


                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <input  id="submit" name="submit" class="btn btn-info pull-right" autocomplete="off" value="Unesi podatke" />
                            </div>

                        </div><!-- /.box -->
                        <!-- general form elements disabled -->

                    </div>

                </div> 

            </form>



        </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
</div><!-- nav-tabs-custom -->
</div>

<div style="clear: both">

</div><!-- /.box-footer -->


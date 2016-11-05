

<form class="form-horizontal" action="" method="POST" onsubmit="return confirm('Jeste li sigurni da želite stvoriti primku sa upisanim podacima?');">
    <div class="row">
        <div class="col-md-6">
            <!-- Dio za stranku -->
            <?php if(isset($_GET['stranka_id'])){ 
                $stranka = new stranka();
                $osoba = $stranka->getById($_GET['stranka_id']);
                ?>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Podaci stranke</h3>
                    
                    
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">

                    <div class="form-group">
                        <label for="inputIme" class="col-sm-2 control-label">Ime</label>
                        <div class="col-sm-10">
                            <input name="ime" class="form-control" id="inputIme" value="<?php echo $osoba['ime'] ?>" type="text" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPrezime" class="col-sm-2 control-label">Prezime</label>
                        <div class="col-sm-10">
                            <input name="prezime" class="form-control" id="inputPrezime" value="<?php echo $osoba['prezime'] ?>" type="text" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdresa" class="col-sm-2 control-label">Adresa</label>
                        <div class="col-sm-10">
                            <input name="adresa" class="form-control" id="inputAdresa" value="<?php echo $osoba['adresa'] ?>" type="text" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputGrad" class="col-sm-2 control-label">Grad</label>
                        <div class="col-sm-10">
                            <input name="grad" class="form-control" id="inputGrad" value="<?php echo $osoba['grad'] ?>" type="text" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPB" class="col-sm-2 control-label">Poštanski broj</label>
                        <div class="col-sm-10">
                            <input name="post_broj" class="form-control" id="inputPB" value="<?php echo $osoba['postanskiBroj'] ?>" type="number" disabled>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputKontakt" class="col-sm-2 control-label">Kontakt broj</label>
                        <div class="col-sm-10">

                            <div class="input-group" >
                                <div class="input-group-addon" style="">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input name="kontakt_broj" type="text" id="inputKontakt" class="form-control" value="<?php echo $osoba['kontakt'] ?>" disabled>
                            </div><!-- /.input group -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Kontakt email</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input name="email" type=email id="inputEmail" class="form-control" value="<?php echo $osoba['email'] ?>" disabled>
                            </div>
                        </div>
                    </div>


                </div><!-- /.box -->
                <!-- general form elements disabled -->

            </div>
            
            <?php } else{ ?>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Podaci stranke</h3>
                    <br>
                    <br>
                    
                    
                    <span id="box" style="float: left">
                        Pretraži u bazi : <input type="text" id="search_box"><button id="search_button">Pretraži</button>
                    </span>
                    <div id="search_result">

                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">

                    <div class="form-group">
                        <label for="inputTvrtka" class="col-sm-2 control-label">Tvrtka</label>
                        <div class="col-sm-10">
                            <input name="tvrtka" class="form-control" id="inputTvrtka" placeholder="Tvrtka" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputIme" class="col-sm-2 control-label">Ime</label>
                        <div class="col-sm-10">
                            <input name="ime" class="form-control" id="inputIme" placeholder="Ime" type="text" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPrezime" class="col-sm-2 control-label">Prezime</label>
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
                        <label for="inputKontakt" class="col-sm-2 control-label">Kontakt broj</label>
                        <div class="col-sm-10">

                            <div class="input-group" >
                                <div class="input-group-addon" style="">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input name="kontakt_broj" type="text" id="inputKontakt" class="form-control" data-inputmask="&quot;mask&quot;: &quot;999 999 99 99&quot;" data-mask="">
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


                </div><!-- /.box -->
                <!-- general form elements disabled -->

            </div>
            <?php } ?>
        </div>

        <div class="col-md-6">
            <!-- Dio za primku -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Otvaranje nove primke</h3>
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
                        <label for="inputNaziv" class="col-sm-2 control-label">Naziv</label>
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
                                <input type="text" id="inputDK" name="dk" class="form-control" data-inputmask="'alias': 'dd.mm.yyyy'" data-mask="" placeholder="dd.mm.yyyy">
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
                        <label for="inputPK" class="col-sm-2 control-label">Prijava kvara</label>
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
                    <button type="submit" name="submit" class="btn btn-info pull-right">Unesi podatke</button>
                </div>

            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>

    </div> 

</form>
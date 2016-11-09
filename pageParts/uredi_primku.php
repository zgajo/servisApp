<?php
$primka=new primka();
$primka = $primka->getById($_GET['primka']);
$id = $primka[0]['id'];
if($primka[0]['datumKupnje'] === "0000-00-00"){
    $kupljeno=NULL;
}else{
    $originalDate = strtotime($primka[0]['datumKupnje']);
    $kupljeno = date("d.m.Y / H:i:s", $originalDate);
}

?>


<form class="form-horizontal" action="" method="POST">
    <div class="row">
        <div class="col-md-6">
            <!-- Dio za primku -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Uređivanje primke</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">


                    <div class="form-group">
                        <label for="inputSifra" class="col-sm-2 control-label">Šifra</label>
                        <div class="col-sm-10">
                            <input disabled class="form-control" id="inputSifra" placeholder="Šifra uređaja" type="number" name="sifra" value="<?php echo $primka[0]['id']?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputBrand" class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-10">
                            <input disabled class="form-control" id="inputBrand" placeholder="Toshiba, Lenovo, Epson ..." type="text" name="brand" value="<?php echo $primka[0]['brand']?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputTip" class="col-sm-2 control-label">Tip</label>
                        <div class="col-sm-10">
                            <input disabled class="form-control" id="inputTip" placeholder="Printer, laptop, računalo ..." type="text" name="tip" value="<?php echo $primka[0]['tip']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNaziv" class="col-sm-2 control-label">Naziv</label>
                        <div class="col-sm-10">
                            <input disabled class="form-control" id="inputNaziv" placeholder="PC Računalo Feniks, Lenovo G50-70 ..." type="text" name="naziv" value="<?php echo $primka[0]['naziv']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSerijski" class="col-sm-2 control-label">Serijski broj</label>
                        <div class="col-sm-10">
                            <input disabled class="form-control" id="inputSerijski" placeholder="Serijski broj ..." type="text" name="serijski" value="<?php echo $primka[0]['serial']?>">
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
                      <input disabled type="text" id="inputDK" name="dk" class="form-control" data-inputmask="'alias': 'dd.mm.yyyy'" data-mask value="<?php echo $kupljeno?>">
                    </div><!-- /.input group -->
                    
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputRacun" class="col-sm-2 control-label">Račun</label>
                        <div class="col-sm-10">
                            <input disabled class="form-control" id="inputRacun" placeholder="Broj računa ..." type="text" name="racun" value="<?php echo $primka[0]['jamstvoRacun']?>">
                        </div>
                    </div>



                    <!-- textarea -->
                    <div class="form-group" >
                        <label for="inputPK" class="col-sm-2 control-label">Prijava kvara</label>
                        <div class="col-sm-10">
                            <textarea disabled="" id="inputPK" class="form-control" rows="3" placeholder="Kvar koji stranka prijavljuje ..." name="opis"><?php echo $primka[0]['opisKvara']?></textarea>
                        </div>
                    </div>



                    <div class="form-group" >
                        <label for="inputPP" class="col-sm-2 control-label">Priloženo / Primijećeno uz uređaj</label>
                        <div class="col-sm-10">
                            <textarea disabled name="prilozeno" id="inputPP" class="form-control" rows="3"  placeholder="Upisati što se zaprima uz uređaj (punjač, kablovi, torba i sl.) i primijećena oštećenja ..."> <?php echo $primka[0]['prilozeno_primijeceno']?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ažuriraj</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='status_primke'>
                                <option <?php if($primka[0]['status'] == "Zaprimljeno") echo "selected"; ?> >Zaprimljeno</option>
                                <option <?php if($primka[0]['status'] == "U servisu") echo "selected"; ?> >U servisu</option>
                                <option <?php if($primka[0]['status'] == "U ovlaštenom servisu") echo "selected"; ?> >U ovlaštenom servisu</option>
                                
                            </select>
                        </div>
                    </div>


                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-info pull-right">Unesi</button>
                    <a href="../rn.php?action=novi_rn&primka_id=<?php echo $primka[0]['id'] ?>"><button style="margin-left: 5px; margin-right: 5px;" type="button" name="novi_rn" class="btn btn-info pull-right">Novi radni nalog</button></a>
                    <a><button type="button" name="novi_rma" class="btn btn-info pull-right">Novi RMA nalog</button></a>
                </div>

            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>
    </div>
</form>

<?php
unset($primka);
?>
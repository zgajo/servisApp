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
<!-- TABLE: Svi otvoreni radni nalozi -->

<?php if($_COOKIE['odjel'] != "Reklamacije") { ?>
<div class="box box-info" style="border-top: none">
    <div class="box-body">
        <table id="sviRMA" class="table table-bordered table-striped" style="text-align: center; color: black">
            <thead>
                <tr>
                    <th>Primka</th>
                    <th>RMA</th>
                    <th>Šifra</th>
                    <th>Uređaj</th>
                    <th>Serijski</th>
                    <th>Stranka</th>
                    <th>OS-RN</th>
                    <th>Naziv OS-a</th>
                    <th>Poslano u OS</th>
                    <th>Status</th>
                    <th>Napomena</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">

    </div>
    <!-- /.box-footer -->
</div>
<!-- /.box -->
<?php } else { ?>

<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li <?php if(!isset($_GET['action'])){ ?> class="active" <?php } ?>><a href="#tab_1" data-toggle="tab" aria-expanded="true"><strong>Sve otvorene primke</strong></a></li>
        <li><a href="#tab_2" data-toggle="tab" aria-expanded="true"><strong>Financijska odobrenja</strong></a></li>
        <li <?php if(isset($_GET['action']) && $_GET['action'] == "fin"){ ?> class=" active" <?php } ?>><a href="#tab_3" data-toggle="tab" aria-expanded="true"><strong>Novo financijsko odobrenje</strong></a></li>
    </ul>
    <div class="tab-content">
        <div <?php if(!isset($_GET['action'])){ ?> class="tab-pane active" <?php }else{ ?>  class="tab-pane" <?php } ?> id="tab_1">
            <!-- TABLE: Sve otvoreni RMA -->
            <div class="box box-info" style="border-top: none">
                <div class="box-body">
                    <table id="sviRMA" class="table table-bordered table-striped" style="text-align: center; color: black">
                        <thead>
                            <tr>
                                <th>Primka</th>
                                <th>RMA</th>
                                <th>Šifra</th>
                                <th>Uređaj</th>
                                <th>Serijski</th>
                                <th>Stranka</th>
                                <th>OS-RN</th>
                                <th>Naziv OS-a</th>
                                <th>Poslano u OS</th>
                                <th>Status</th>
                                <th>Napomena</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
           <input style="display:none" id="fin_id"></input>
            <div id="finOdobDiv" class="box box-info" style="border-top: none">
                <div class="box-body">
                    <table id="svaOdob" class="table table-bordered table-striped" style="text-align: center; color: black">
                        <thead>
                            <tr>
                               <th>Primka</th>
                                <th>Zatraženo</th>
                                <th>Dobavljač</th>
                                <th>Šifra</th>
                                <th>Uređaj</th>
                                <th>Serijski</th>
                                <th>Napomena</th>
                                <th>Status</th>
                                <th>Centar</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
            <div class="form-horizontal" id="updateOdobrenje" style="display:none">

                <div class="box box-info" style="border-top: none">
                    <div class="col-md-6">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="updateDobavljac" class="col-sm-2 control-label">Dobavljač</label>
                                <div class="col-sm-10">
                                    <input name="updatedobavljac" class="form-control" id="updateDobavljac" placeholder="Dobavljač od kojeg se čega odobrenje" type="text"
                                        required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="updateOD" class="col-sm-2 control-label">Zatraženo</label>
                                <div class="col-sm-10">

                                    <input class="form-control pull-right" id="updatedatepicker" name="updatedatepicker" type="text">
                                </div>
                                <!-- /.input group -->
                            </div>

                            <div class="form-group">
                                <label for="updateNapomena" class="col-sm-2 control-label">Napomena</label>
                                <div class="col-sm-10">
                                    <textarea name="updatenapomena" class="form-control" id="updateNapomena" rows="3" placeholder="Napomena" type="text" ></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="updateStatus" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="updateStatus" type="text" name="updatestatus">
                                        <option></option>
                                        <option value="Financijsko odobrenje">Financijsko odobrenje</option>
                                        <option value="Uređaj zamijenjen novim">Uređaj zamijenjen novim</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="updatePrimka" class="col-sm-2 control-label">Primka</label>
                                <div class="col-sm-10">
                                    <input name="updateprimka" class="form-control" id="updatePrimka" placeholder="Broj primke" type="text" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="updateStatus" class="col-sm-2 control-label">Riješeno</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="updateRijeseno" type="text" name="updaterijeseno">
                                        <option value="Ne">Ne</option>
                                        <option value="Da">Da</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10">
                                    <button id="updatesubmit"  name="updatesubmit" class="btn btn-info pull-left" >Unesi podatke </button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.box -->
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">

                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
        </div>

        <!-- /.tab-pane -->
        <div<?php if(isset($_GET['action']) && $_GET['action'] == "fin"){ ?> class="tab-pane active" <?php } else{ ?> class="tab-pane"  <?php } ?> id="tab_3">
            <form class="form-horizontal" id="novoOdobrenje">

                <div class="box box-info" style="border-top: none">
                    <div class="col-md-6">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="inputDobavljac" class="col-sm-2 control-label">Dobavljač</label>
                                <div class="col-sm-10">
                                    <input name="dobavljac" class="form-control" id="inputDobavljac" placeholder="Dobavljač od kojeg se čega odobrenje" type="text"
                                        required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputOD" class="col-sm-2 control-label">Zatraženo</label>
                                <div class="col-sm-10">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control pull-right" id="datepicker" name="datepicker" type="text">
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>

                            <div class="form-group">
                                <label for="inputNapomena" class="col-sm-2 control-label">Napomena</label>
                                <div class="col-sm-10">
                                    <textarea name="napomena" class="form-control" id="inputNapomena" rows="3" placeholder="Napomena" type="text" ></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="inputStatus" type="text" name="status">
                                        <option></option>
                                        <option>Financijsko odobrenje</option>
                                        <option>Uređaj zamijenjen novim</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPrimka" class="col-sm-2 control-label">Primka</label>
                                <div class="col-sm-10">
                                    <input name="primka" class="form-control" id="inputPrimka" placeholder="Broj primke" type="text" required="" value="<?php if(isset($_GET['p'])) echo $_GET['p'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10">
                                    <button id="submit"  name="submit" class="btn btn-info pull-left" >Unesi podatke </button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.box -->
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">

                    </div>
                    <!-- /.box-footer -->
            </form>
            </div>
            <!-- /.box -->


        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->
<?php } ?>

<div style="clear: both">

</div>
<!-- /.box-footer -->

<form id="urediNarudzbe" class="form-horizontal" action="" method="POST" >
    <div class="row">
        <div class="col-md-6">
            <!-- Dio za primku -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Uređivanje narudžbe</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">


                    <div class="form-group">
                        <label for="urediProizvod" class="col-sm-2 control-label" id="required">Proizvod</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="urediProizvod" placeholder="Dio koji se naručuje" type="text" name="proizvod">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="urediPN" class="col-sm-2 control-label">Part no.</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="urediPN" placeholder="Product number dijela koji se naručuje" type="text" name="pn">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="urediDobavljac" class="col-sm-2 control-label" id="required">Dobavljač</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="urediDobavljac" placeholder="Zelcos, Epson ..." type="text" name="dobavljac">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="urediVPC" class="col-sm-2 control-label" id="required">CIjena (VPC)</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="urediVPC" placeholder="Cijena koja je javljena kupcu ..." type="text" name="cijenaVPC">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="urediSkladiste" class="col-sm-2 control-label"  >Skladište</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="urediSkladiste" placeholder="Skladište na koje se treba poslati proizvod ..." type="text" name="skladiste">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="urediPrimka" class="col-sm-2 control-label">Primka</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="urediPrimka" placeholder="Broj primke (ukoliko je povezano)" type="text" name="primka">
                        </div>
                    </div>



                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button  id="urediNarudzba" class="btn btn-info pull-right">Unesi podatke</button>
                </div>

            </div><!-- /.box -->
            <!-- general form elements disabled -->

        </div>
    </div>
</form>

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
console.log(<?php echo $_GET['narudzba'] ?>);
</script>
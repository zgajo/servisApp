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
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><strong>Sve otvorene primke</strong></a></li>
        <li><a href="#tab_2" data-toggle="tab" aria-expanded="true"><strong>Financijska odobrenja</strong></a></li>
        <li><a href="#tab_3" data-toggle="tab" aria-expanded="true"><strong>Novo financijsko odobrenje</strong></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
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
            <div class="box box-info" style="border-top: none">
                <div class="box-body">
                    <table id="svaOdob" class="table table-bordered table-striped" style="text-align: center; color: black">
                        <thead>
                            <tr>
                                <th>Odobreno</th>
                                <th>Dobavljač</th>
                                <th>Šifra</th>
                                <th>Uređaj</th>
                                <th>Serijski</th>
                                <th>Napomena</th>
                                <th>Status</th>
                                <th>Primka</th>
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


        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
            <div class="box box-info" style="border-top: none">
                
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                </div>
                <!-- /.box-footer -->
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
 <!-- TABLE: Sve otvorene primke -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">PRIMKE</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <th  style="text-align: center;">Uredi</th>
                                                <th>Primka</th>
                                                <th>Uređaj</th>
                                                <th>Stranka</th>
                                                <th>Status primke</th>
                                                <th>Datum zaprimanja</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sveprimke">
                                           <!--
                                           AJAX - Sve primke
                                           -->
                                        </tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                            </div><!-- /.box-body -->
                            <div  class="box-footer clearfix">
                                <a href="primke.php?action=nova_primka" class="btn btn-sm btn-info btn-flat pull-right">NOVA PRIMKA</a>
                            </div><!-- /.box-footer -->
                        </div><!-- /.box -->

     
                        
                        
                         <!-- TABLE: Sve otvorene primke -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">PRIMKE POSLANE U CS-ROVINJ</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <?php  if( $_COOKIE['odjel'] == "Servis") { ?><th style="text-align: center">Započni servis</th><?php } ?>
                                                <th>Primka</th>
                                                <?php if($_COOKIE['odjel']=="Servis"){ ?><th>Radni nalog</th><?php } ?>
                                                <th>Uređaj</th>
                                                <th>Stranka</th>
                                                <th>Datum zaprimanja</th>
                                                <th>Status primke</th>
                                                <?php  if( $_COOKIE['odjel'] == "Servis") { ?><th>Poslano iz</th><?php } ?>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="svePoslanePrimke">
                                            
                                        </tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                            </div><!-- /.box-body -->
                            <div  class="box-footer clearfix">
                                
                            </div><!-- /.box-footer -->
                        </div><!-- /.box -->
                        
                        <?php  
                        if($_COOKIE['odjel'] != "Servis"){
                            /*
                        ?>
                         <!-- TABLE: Sve otvorene primke -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">PRIMKE POSLANE IZ CS-ROVINJ</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <th>Primka</th>
                                                <th>Uređaj</th>
                                                <th>Stranka</th>
                                                <th>Status</th>
                                                <th>Datum zaprimanja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $primka = new primka();
                                            $primka = $primka->svePrimke();

                                            if(!empty($primka)){
                                                foreach ($primka as $primka) {
                                                    
                                                    if($primka->status == "Završen popravak - poslano u centar"){
                                                        
                                                         $do = new djelatnik();
                                                $do = $do->getDjelatnikById($primka->djelatnik_otvorio_id);
                                                
                                                    if($_COOKIE['centar'] == $primka->centar){
                                                        
                                                        $datum = strtotime($primka->datumZaprimanja);
                                                $zaprimljeno = date("d.m.Y   -   H:i:s",$datum );
                                                
                                                echo '<tr>
                                                <td><a href="primke.php?primka=' . $primka->primka_id . '">Pregledaj / Uredi ' . $primka->primka_id . '</a></td>
                                                <td>' . $primka->naziv . '</td>
                                                <td>' . $primka->s_ime. ' '.$primka->s_prezime.'</td>
                                                <td><span class="label label-success" style="font-size: 12px">' . $primka->status . '</span></td>
                                                <td><div class="sparkbar" data-color="#00a65a" data-height="20">' . $zaprimljeno . '</div></td>
                                                </tr>';
                                                    }
                                                    }
                                                
                                            }
                                            }
                                            unset($primka);
                                            
                                            ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                            </div><!-- /.box-body -->
                            <div  class="box-footer clearfix">
                                
                            </div><!-- /.box-footer -->
                        </div><!-- /.box -->
                       <?php */ } ?>
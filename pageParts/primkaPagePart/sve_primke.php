
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
                                                <th>Primka</th>
                                                <th>Uređaj</th>
                                                <th>Stranka</th>
                                                <th>Status primke</th>
                                                <th>Datum zaprimanja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $primka = new primka();
                                            $primka = $primka->svePrimke();

                                            if(!empty($primka)){
                                                
                                                foreach ($primka as $primka) {
  
                                                
                                                        
                                                        $datum = strtotime($primka->datumZaprimanja);
                                                        $zaprimljeno = date("d.m.Y   /   H:i:s",$datum );
                                                
                                                $date1=date_create(date('d.m.Y', strtotime($primka->datumZaprimanja)));
                                                $date2=date_create(date('d.m.Y'));
                                                $diff=date_diff($date1,$date2);
                                                
                                               if($diff->format('%a')>6 && $diff->format('%a')<=10) $style = "color:orange;";
                                               elseif ($diff->format('%a')>11) $style = "color:red;";
                                               else $style = "";
                                               
                                                        echo '<tr >
                                                        <td><a  style="'.$style.'" href="primke.php?primka=' . $primka->primka_id . '">Pregledaj / Uredi ' . $primka->primka_id . '</a></td>
                                                        <td>' . $primka->naziv . '</td>
                                                        <td>'; echo($primka->tvrtka==NULL)?"":$primka->tvrtka.', '; echo $primka->s_ime. ' '.$primka->s_prezime.'</td>
                                                        <td style="width:1px"><span class="label label-success" style="font-size: 12px; display:block">' . $primka->status . '</span></td>
                                                        <td><div class="sparkbar" data-color="#00a65a" data-height="20">' . $zaprimljeno . '</div></td>
                                                        </tr>';
                                                        
                                                    
                                                        
                                                
                                            }
                                            }
                                            unset($primka);
                                            ?>
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
                                                <th>Primka</th>
                                                <?php if($_COOKIE['odjel']=="Servis"){ ?><th>Radni nalog</th><?php } ?>
                                                <th>Uređaj</th>
                                                <th>Stranka</th>
                                                <th>Status primke</th>
                                                <th>Datum zaprimanja</th>
                                                <?php  if( $_COOKIE['odjel'] == "Servis") { ?><th>Poslano iz</th><?php } ?>
                                                <?php  if( $_COOKIE['odjel'] == "Servis") { ?><th>Započni servisiranje</th><?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $primka = new primka();
                                            $primka = $primka->svePoslanePrimke();

                                            if(!empty($primka)){
                                                foreach ($primka as $primka) {
                                                    
                                                        
                                                
                                                    if($_COOKIE['centar'] == $primka->centar || $_COOKIE['odjel'] == "Servis"){
                                                        
                                                        $datum = strtotime($primka->datumZaprimanja);
                                                $zaprimljeno = date("d.m.Y   /   H:i:s",$datum );
                                                
                                                $do = new djelatnik();
                                                $do = $do->getDjelatnikById($primka->djelatnik_otvorio_id);
                                                
                                                echo '<tr>
                                                <td><a href="primke.php?primka=' . $primka->primka_id . '">Primka. ' . $primka->primka_id . '</a></td>';
                                                
                                                   if($_COOKIE['odjel']=="Servis"){ 
                                                $rn = new servisRN();
                                                $rn = $rn->RNbyPrimka($primka->primka_id);
                                              echo '<td>';
                                              
                                              if(!empty($rn)){
                                                 foreach($rn as $rn){
                                                    echo('<a href="rn.php?radni_nalog=' . $rn['id'] . '"> RN. ' . $rn['id'] . '</a><br>');
                                                }  
                                                }
                                                echo '</td>';
                                               }
                                               
                                                
                                                echo '<td>' . $primka->naziv . '</td>
                                                <td>'; echo($primka->tvrtka==NULL)?"":$primka->tvrtka.', '; echo $primka->s_ime. ' '.$primka->s_prezime.'</td>
                                                <td  style="width:1px"><span class="label label-success" style="font-size: 12px; display:block">' . $primka->status . '</span></td>
                                                <td><div class="sparkbar" data-color="#00a65a" data-height="20">' . $zaprimljeno . '</div></td>';
                                                if( $_COOKIE['odjel'] == "Servis") { 
                                                echo '<td>'.$do['odjel'].' '. $primka->centar. '</td>
                                                <td><a  style="margin-left: 5px; margin-right: 5px;" class="btn btn-sm btn-info btn-flat pull-left" href="../rn.php?action=novi_rn&primka_id='.$primka->primka_id.'">Novi radni nalog</a></td>';
                                                }
                                                echo '</tr>';
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
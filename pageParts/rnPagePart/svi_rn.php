<?php
$rn = new servisRN();
$rn = $rn->sviRN();

?>

 <!-- TABLE: Svi otvoreni radni nalozi -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">RADNI NALOZI</h3>
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
                                                <th>Radni nalog</th>
                                                <th>Primka</th>
                                                <th>Započeo rad</th>
                                                <th>Početak rada</th>
                                                <th>Status</th>
                                                <th>Napomena</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            
                                            
                                            <?php
                                           
                                            if(!empty($rn)){
                                                
                                            foreach ($rn as $rn) {
                                                    if($rn->status_rn != "Popravak završen u jamstvu"  && $rn->status_rn != "Popravak završen van jamstva"){
                                                    $originalDate = strtotime($rn->pocetakRada);
                                                    $zapoceto = date("d.m.Y H:i:s", $originalDate);
                                                

                                                echo '<tr>
                                                        <td><a href="rn.php?radni_nalog=' . $rn->rn_id . '">Uredi rn. ' . $rn->rn_id . '</a></td>
                                                        <td><a href="primke.php?primka=' . $rn->primka_id . '">Pregledaj pr. ' . $rn->primka_id . '</a></td>
                                                        <td><div class="sparkbar" data-color="#00a65a" data-height="20">' .  $rn->ime . ' '.$rn->prezime. '</div></td>
                                                        <td><div class="sparkbar" data-color="#00a65a" data-height="20">' . $zapoceto . '</div></td>
                                                        <td><span class="label label-success" style="font-size: 12px">' . $rn->status_rn . '</span></td>
                                                        <td><div class="sparkbar" data-color="#00a65a" data-height="20">' . $rn->napomena . '</div></td>
                                                    </tr>';
                                               
                                                
                                            }
                                                }
                                            }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                        
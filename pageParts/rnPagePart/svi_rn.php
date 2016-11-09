<?php

$rn = new servisRN();
$rn = $rn->sviRN();

?>
 <!-- TABLE: Svi otvoreni radni nalozi -->
                        
                        <!-- TABLE: Sve otvorene primke -->
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
                                                <th>Primka</th>
                                                <th>Radni nalog</th>
                                                <th>Započeo rad</th>
                                                <th>Početak rada</th>
                                                <th>Status radnog naloga</th>
                                                <th>Napomena</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $primka = new primka();
                                            $primka = $primka->svePrimkeRN();

                                            if(!empty($primka)){
                                                foreach ($primka as $primka) {
                                                    $rn = new servisRN();
                                                    $rn = $rn->RNbyPrimka($primka->primka_id);
                                                    
                                                    if(!empty($rn)){
                                                        
                                                       echo '<tr>
                                                        <td><a href="primke.php?primka=' . $primka->primka_id . '">Primka. ' . $primka->primka_id . '</a></td>
                                                        <td>';
                                                        foreach($rn as $radn){
                                                              echo('<a href="rn.php?radni_nalog=' . $radn['id'] . '"> RN. ' . $radn['id'] . '</a><br>');
                                                          }  
                                                        echo '</td><td>';
                                                         foreach($rn as $radn){
                                                              echo('<div class="sparkbar" data-color="#00a65a" data-height="20">' .  $radn['ime'] . ' '.$radn['prezime']. '</div>');
                                                          }  
                                                        echo '</td><td>';
                                                        foreach($rn as $radn){
                                                              echo('<div class="sparkbar" data-color="#00a65a" data-height="20">' .  date("d.m.Y / H:i:s",  strtotime($radn['pocetak'])). '</div>');
                                                          }  
                                                        echo '</td><td>';
                                                        foreach($rn as $radn){
                                                              echo('<div class="label label-success" style="font-size: 12px">' .  $radn['status'] . '</div><br>');
                                                          }  
                                                        echo '</td><td>';
                                                        foreach($rn as $radn){
                                                              echo('<div class="sparkbar" data-color="#00a65a" data-height="20">' .  $radn['napomena'] . '</div>');
                                                          }  
                                                        echo '</td></tr>';
                                                    }
                                                    unset($rn);
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
                        
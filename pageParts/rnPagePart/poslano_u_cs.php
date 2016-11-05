 <!-- TABLE: Svi otvoreni radni nalozi -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">POSLANO U CS -RADNI NALOZI</h3>
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
                                                <th>Napomena</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rn = new servisRN();

                                            $rez = $rn->sviRN();
                                            unset($rn);
                                            //print_r($rez);
                                            if(!empty($rez)){
                                                
                                            foreach ($rez as $result) {


                                                $originalDate = strtotime($result->pocetakRada);
                                                $zapoceto = date("d.m.Y H:i:s", $originalDate);
                                                
                                                $djelatnik = new djelatnik();
                                                $djelatnik = $djelatnik->getDjelatnikById($result->djelatnik_otvorio_id);

                                                echo '<tr>
                                                        <td><a href="rn.php?radni_nalog=' . $result->rn_id . '">Uredi rn. ' . $result->rn_id . '</a></td>
                                                        <td><a href="primke.php?primka=' . $result->primka_id . '">Pregledaj pr. ' . $result->primka_id . '</a></td>
                                                        <td><div class="sparkbar" data-color="#00a65a" data-height="20">' .  $djelatnik['ime'] . ' '.$djelatnik['prezime']. '</div></td>
                                                        <td><div class="sparkbar" data-color="#00a65a" data-height="20">' . $zapoceto . '</div></td>
                                                        <td><div class="sparkbar" data-color="#00a65a" data-height="20">' . $result->napomena . '</div></td>
                                                    </tr>';
                                                    unset($djelatnik);
                                            }
                                            
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
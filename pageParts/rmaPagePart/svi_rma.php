
 <!-- TABLE: Svi otvoreni radni nalozi -->
                        
                        <!-- TABLE: Sve otvorene primke -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">RMA Nalozi</h3>
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
                                                <th>RMA nalog</th>
                                                <th>Radni nalog OS-a</th>
                                                <th>Naziv OS-a</th>
                                                <th>Stranka</th>
                                                <th>Poslano u OS</th>
                                                <th>Status</th>
                                                <th>Napomena</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $primka = new primka();
                                            $primka = $primka->svePrimke();

                                            if(!empty($primka)){
                                                foreach ($primka as $primka) {
                                                    $rma = new rmaNalog();
                                                    $rma = $rma->RMAbyPrimka($primka->primka_id);
                                                    
                                                    if(!empty($rma)){
                                                        
                                                       echo '<tr>
                                                        <td><a href="primke.php?primka=' . $primka->primka_id . '">Primka. ' . $primka->primka_id . '</a></td>
                                                        <td>';
                                                        foreach($rma as $r){
                                                              echo('<a href="rma.php?rma=' . $r['id'] . '"> RMA. ' . $r['id'] . '</a><br>');
                                                          }  
                                                        echo '</td><td>';
                                                         foreach($rma as $r){
                                                              echo($r['rnOs'] . "<br>");
                                                          } 
                                                         echo '</td><td>';
                                                         foreach($rma as $r){
                                                              echo($r['nazivOS'] . "<br>");
                                                          } 
                                                         echo '</td><td>';
                                                         foreach($rma as $r){
                                                              echo('<div class="sparkbar" data-color="#00a65a" data-height="20">'); echo($primka->tvrtka==NULL)?"":$primka->tvrtka.', '; echo ($primka->s_ime . ' '.$primka->s_prezime. '</div>');
                                                          }  
                                                        echo '</td><td>';
                                                        foreach($rma as $r){
                                                            echo($r['poslano']  != NULL)? date("d.m.Y / H:i:s", strtotime($r['poslano'])): " " ;echo ('<br>');
                                                          }  
                                                        echo '</td><td>';
                                                        foreach($rma as $r){
                                                              echo($r['status'] != NULL) ? ('<div class="label label-success" style="font-size: 12px;display: block;margin-bottom: 2px;">' .  $r['status'] . '</div>'):"<br>";
                                                          }  
                                                        echo '</td><td>';
                                                        foreach($rma as $r){
                                                              echo('<div class="sparkbar" data-color="#00a65a" data-height="20">' .  $r['napomena'] . '</div>');
                                                          }  
                                                        echo '</td></tr>';
                                                    }
                                                    unset($rma);
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
                        
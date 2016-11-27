<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <link href="search/search.css" rel="stylesheet">
    </head>
    
    <body>
        
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
                                                <th>Primka</th>
                                                <th>Radni nalog</th>
                                                <th>Uređaj</th>
                                                <th>Stranka</th>
                                                <th>Status primke</th>
                                                <th>Datum zaprimanja</th>
                                                <th>Poslano iz</th>
                                                <th>Započni servisiranje</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                          <tr>
                                                <td><a href="">Primka. ' . $primka->primka_id . '</a></td>
                                                
                                                   <td>
                                              
                                            <a href=""> RN. ' . $rn['id'] . '</a><br></td>'
                                               
                                                
                                              <td>' . $primka->naziv . '</td>
                                                <td></td>
                                                <td  style="width:1px"><span class="label label-success" style="font-size: 12px; display:block"></span></td>
                                                <td><div class="sparkbar" data-color="#00a65a" data-height="20"></div></td>';
                                               <td>'.$do['odjel'].' '. $primka->centar. '</td>
                                                <td><a  style="margin-left: 5px; margin-right: 5px;" class="btn btn-sm btn-info btn-flat pull-left" href="">Novi radni nalog</a></td>
                                               </tr>
                                        </tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                            </div><!-- /.box-body -->
                            <div  class="box-footer clearfix">
                                
                            </div><!-- /.box-footer -->
                        </div><!-- /.box -->
                        <script>
                        $(document).ready(function (){
                            
                            $.ajax({
                                type: 'POST',
                                url: "testSvePrimkeJson.php",
                                dataType: 'json',
                                contentType: "application/json; charset=utf-8",
                                success: function (data) {
                                      
                                      var primka = JSON.parse(JSON.stringify(data));
                                      var output = "";
                                      for(var i =0; i<primka.length; ++i){
                                          output += '<tr> \n\
                                                         <td><a href="primke.php?primka='+primka[i].primka_id+ '">Pregledaj / Uredi ' +primka[i].primka_id+ '</a></td>\n\
                                                         <td>'+ primka[i].naziv +'</td>\n\
                                                         <td>'+ primka[i].s_ime + ' ' + primka[i].s_prezime+'<td>\n\
                                                         <td>'+ primka[i].status +'</td>\n\
                                                         <td>'+ primka[i].datumZaprimanja +'<td>\n\
                                                     </tr>';
                                                         
                                      }
                                      $('#sveprimke').html(output);
                                      
                                      console.log(JSON.parse(JSON.stringify(data)));
                                      
                                },
                                error: function (e) {
                                    alert(e.message);
                                }
                            });
                            
                                                       
                        });
                        </script>
    </body>
</html>
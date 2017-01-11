

            
         
                              
                              $('#sviRMA').on("mouseover", "tr", function(){
                                 $(this).find('i').show();
                              });
                              $('#sviRMA').on("mouseout", "tr", function(){
                                 $(this).find('i').hide();
                              });
             
         //    LISTANJE SVIH OTVORENIH PRIMKI
                  $.ajax({
                                type: 'POST',
                                url: "json/primka/svePrimkeRNServis.php",
                                dataType: 'json',
                                contentType: "application/json; charset=utf-8",
                                success: function (data) {
                                    var output = "";
                                      var primka = JSON.parse(JSON.stringify(data));
                                      var danas = new Date();
                                      
                                      for(var i =0; i<primka.length; ++i){
                                          var datum = new Date(primka[i].datumZaprimanja);
                                          var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds

                                            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime())/(oneDay)));
                                        
                                            if(diffDays<=15)  var sty = "label label-success";
                                            if(diffDays>15 && diffDays<=30)  var sty = "label label-warning";
                                            if(diffDays>30) var sty = "label label-danger";
                                            
                                            var rn = null;
                                            var pid = primka[i].primka_id;
                                            
                                            //  TRAŽENJE RADNIH NALOGA POVEZANIH SA PRIMKAMA
                                          $.ajax({
                                                async: false,
                                                 url:"json/rma/getRmaByPrimka.php",
                                                 type: 'GET',
                                                 data: {"primka":pid},
                                                 success:function(rn){
                                                    
                                                    if (rn){
                                                        console.log(rn);
                                                        
                                                            Tabla.rows.add(rn).draw();
                                                        
                                                    }
                                                    
                                                    
                                                
                                                },
                                                error: function(){
                                                    console.log("greška");
                                                }
                                            });
                                           
                                            
                                                         
                                      }
                                      
                                      
                                      
                                      
                                      
                                },
                                error: function (e) {
                                    alert(e.message);
                                }
                            });   
                            
                            var Tabla = $('#sviRMA').DataTable({
                                                "columns": [
                                                            {"data": "pid", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                                                    var danas = new Date();
                                                                    var datum = new Date(row.datumZaprimanja);
                                                                    var oneDay = 24 * 60 * 60 * 1000;
                                                                    var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime()) / (oneDay)));

                                                                    if (diffDays <= 7)
                                                                        var sty = "label label-success";
                                                                    if (diffDays > 7 && diffDays <= 14)
                                                                        var sty = "label label-warning";
                                                                    if (diffDays > 14)
                                                                        var sty = "label label-danger";

                                                                    var a = '<a class="' + sty + '">Primka ' + row.pid + '</a>'; // row object contains the row data
                                                                    return a;
                                                                }},
                                                            {"data": "s_ime", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                                                var osoba = row.s_ime + ' ' + row.s_prezime;
                                                                return osoba;
                                                            }},
                                                            {"data": "naziv"},
                                                            {"data": "serijski"},
                                                            
                                                            {"data": "id" ,"render": function(data, type, row, meta){
                                                            var  output = '<strong>RMA. ' +row.id+ '</strong><a style="margin-left:10px;" href="rma.php?rma='+row.id+'"><i style=" display:none;" class="glyphicon glyphicon-pencil"></i></a><br>';
                                                            return output;
                                                            }},
                                                            {"data": "rnOs"},
                                                            {"data": "nazivOS"},
                                                            {"data": "poslano","render": function(data, type, row, meta){
                                                            var poslano = new Date(row.poslano);   
                                                            var output = [poslano.getDate(), poslano.getMonth()+1, poslano.getFullYear()].join('.');
                                                            return output;
                                                            }},
                                                            {"data": "status"},
                                                            {"data": "napomena"}
                                                        ], "bDestroy": true
                                            });
            
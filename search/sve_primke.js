//    LISTANJE SVIH OTVORENIH PRIMKI
                  $.ajax({
                                type: 'POST',
                                url: "json/primka/sveOtvorenePrimke.php",
                                dataType: 'json',
                                contentType: "application/json; charset=utf-8",
                                success: function (data) {
                                    var danas = new Date();
                                    
                                      var primka = JSON.parse(JSON.stringify(data));
                                      var output = "";
                                      
                                     
                                      
                                      for(var i =0; i<primka.length; ++i){
                                          var datum = new Date(primka[i].datumZaprimanja);
                                          var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds

                                            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime())/(oneDay)));
                                        
                                            if(diffDays<=7)  var sty = "label label-success";
                                            if(diffDays>7 && diffDays<=14)  var sty = "label label-warning";
                                            if(diffDays>14) var sty = "label label-danger";
                                        
                                            output +=   '<tr> \n\
                                                        <td  style="text-align: center;"><a class="glyphicon glyphicon-pencil" href="primke.php?primka='+primka[i].primka_id+'"></a></td>';
                                                                                                                   
                                            output +=     '<td><span class="'+sty+'">Primka ' +primka[i].primka_id+ '</span></td>';
                                           
                                            output +=     '<td>'+ primka[i].naziv +'</td>\n\
                                                                <td>'; output+= (primka[i].tvrtka) ? "<i>"+primka[i].tvrtka +"</i>, " : "";
                                                                    output += primka[i].s_ime + ' ' + primka[i].s_prezime+'</td>\n\
                                                                <td>'+ primka[i].status +'</td>\n\
                                                                <td>'+ [datum.getDate(), datum.getMonth()+1, datum.getFullYear()].join('.') +' /  '+[(datum.getHours()<10?'0':'') + datum.getHours(), (datum.getMinutes()<10?'0':'') + datum.getMinutes()].join(':')  + '<td>\n\
                                                            </tr>';
                                                         
                                      }
                                      $('#sveprimke').html(output);
                                      
                                      console.log(JSON.parse(JSON.stringify(data)));
                                      
                                },
                                error: function (e) {
                                    alert(e.message);
                                }
                            });
                  //    KRAJ    *   LISTANJE SVIH OTVORENIH PRIMKI  * KRAJ
                
                
                
                
                //      HOVER NA RED SVIH PRIMKI
                                $( "#sveprimke" ).on("mouseover", "tr",function() {
                                  $( this ).css("background-color", "#efefef");
                              } );
                                
                                $( "#sveprimke" ).on("mouseout", "tr",function() {
                                  $( this ).css("background-color", "white");
                              } );
                              $( "#svePoslanePrimke" ).on("mouseover", "tr",function() {
                                  $( this ).css("background-color", "#efefef");
                              } );
                                
                                $( "#svePoslanePrimke" ).on("mouseout", "tr",function() {
                                  $( this ).css("background-color", "white");
                              } );
                //      KRAJ    *    HOVER NA RED SVIH PRIMKI   *   KRAJ
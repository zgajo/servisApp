 $( "#sviRN" ).on("mouseover", "tr",function() {
                                  $( this ).css("background-color", "#efefef");
                              } );
                                
                                $( "#sviRN" ).on("mouseout", "tr",function() {
                                  $( this ).css("background-color", "white");
                              } );
                              
                              $('#sviRN').on("mouseover", "tr", function(){
                                 $(this).find('a').show();
                              });
                              $('#sviRN').on("mouseout", "tr", function(){
                                 $(this).find('a').hide();
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
                                      console.log(primka);
                                      
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
                                                 url:"json/rn/getRNbyPrimka.php",
                                                 type: 'POST',
                                                 data: {"primka":pid},
                                                 success:function(data){
                                                    console.log(data);
                                                rn= data;
                                                
                                                },
                                                error: function(){
                                                    console.log("greška");
                                                }
                                            });
                                           
                                            if(rn !== null && rn.length>0){
                                                
                                                
                                                
                                                
                                                output += '<tr>';
                                                                                                                   
                                                    output +=     '<td><span class="'+sty+'">Primka ' +primka[i].primka_id+ '</span></td>';
                                                    
                                                    
                                                    output += '<td>';
                                                       output += primka[i].naziv;
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                       output += primka[i].serial;
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                    output += primka[i].s_ime + ' ' + primka[i].s_prezime;
                                                    output += '</td>';
                                                    
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rn.length;++j) output += '<strong>RN. ' +rn[j].id+ '</strong><a style="margin-left:10px; display:none;" class="glyphicon glyphicon-pencil" href="rn.php?radni_nalog='+rn[j].id+'"></a><br>';
                                                    output += '</td>';
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rn.length;++j) {
                                                        if(rn[j].status === null) output +=  '<br>';
                                                        else output += rn[j].status + '<br>';
                                                    };
                                                    output += '</td>';
                                                    
                                                    
                                                    output += '<td>';
                                                    for(var j=0; j<rn.length;++j) output += (rn[j].napomena) ? rn[j].napomena + '<br>' : '';
                                                    output += '</td>';
                                                    
                                                output += '</tr>';
                                                
                                            }
                                            
                                                         
                                      }
                                      
                                      $('#sviRN').html(output);
                                      
                                      
                                      
                                      
                                },
                                error: function (e) {
                                    alert(e.message);
                                }
                            });   
            
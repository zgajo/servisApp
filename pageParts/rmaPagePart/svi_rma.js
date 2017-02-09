
$("#sviRMA").on("mouseover", "tbody tr", function () {
    $(this).css('background-color', '#ccffcc');
    
});

$("#sviRMA").on("mouseout", "tbody tr", function () {
    $(this).removeAttr( 'style' );
});
            
         
                              
                              $('#sviRMA').on("mouseover", "tr", function(){
                                 $(this).find('i').show();
                              });
                              $('#sviRMA').on("mouseout", "tr", function(){
                                 $(this).find('i').hide();
                              });
             
         //    LISTANJE SVIH OTVORENIH PRIMKI
                  $.ajax({
                                type: 'POST',
                                url: "json/primka/sveOtvorenePrimke.php",
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

                                                                    var a = '<a name ="'+row.pid+'"  style="cursor: default;"  class="' + sty + '">' + row.pid + '</a>'; // row object contains the row data
                                                                    return a;
                                                                }},
                                                            {"data": "id" ,"render": function(data, type, row, meta){
                                                            var  output = '<strong>RMA. ' +row.id+ '</strong><a  name ="'+row.pid+'" style="margin-left:10px; cursor:pointer;" ><i id="uredi_rma" style=" display:none;" class="glyphicon glyphicon-pencil"></i></a><br>';
                                                            return output;
                                                            }},
                                                            {"data": "naziv","render": function(data, type, row, meta){return row.brand + ' ' + row.naziv}},
                                                            {"data": "serijski"},
                                                            {"data": "s_ime", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                                                var osoba = row.s_ime + ' ' + row.s_prezime;
                                                                return osoba;
                                                            }},
                                                            
                                                            {"data": "rnOs"},
                                                            {"data": "nazivOS"},
                                                            {"data": "poslano","render": function(data, type, row, meta){
                                                            var poslano = new Date(row.poslano);  
                                                            var output = (poslano && poslano.getFullYear()!="1970"  && !isNaN(poslano)) ? [poslano.getDate(), poslano.getMonth()+1, poslano.getFullYear()].join('.') : '';
                                                            
                                                            return output;
                                                            }},
                                                            {"data": "status"},
                                                            {"data": "napomena"}
                                                        ], "bDestroy": true
                                            });
                                            
                                            
            $('#sviRMA').on("mouseover", "#uredi_rma",function(){
                $(this).attr("title", "Uredi rma nalog");
            })
            
            $('#sviRMA').on("mouseover", " tbody tr td:first-child",function(){
                $(this).attr("title", "Uredi radni nalog");
            })
            $('#sviRMA').on("mouseover", " tbody tr td:nth-child(2)",function(){
                $(this).attr("title", "Uredi radni nalog");
            })
            $('#sviRMA').on("click", " tbody tr td:first-child", function(){
                window.open("rma.php?rma="+$(this).find('a').attr("name"), "_blank");
            })
            $('#sviRMA').on("click", " tbody tr td:nth-child(2)", function(){
                window.open("rma.php?rma="+$(this).find('a').attr("name"), "_blank");
            })
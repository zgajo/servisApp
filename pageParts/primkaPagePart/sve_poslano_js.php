<script>
                //    LISTANJE SVIH  POSLANIH PRIMKI
                var centar = "<?php echo $_COOKIE['centar'] ?>";
                var odjel = "<?php echo $_COOKIE['odjel'] ?>";


                $.ajax({
                    url: "json/primka/svePoslanePrimke.php",
                    type: 'POST',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (spp) {
                        if(spp){
                        if (odjel === "Servis" || odjel === "Reklamacije" ) {
                            $('#svePoslanePrimkeServis').DataTable({
                                "ajax": {
                                    "url": "json/primka/svePoslanePrimke.php",
                                    "dataSrc": ""
                                },
                                "columns": [
                                    {data: "primka_id", "render": function (data, type, row, meta) {
                                            var output = "";
                                            if (odjel === "Servis" || odjel === "Reklamacije")
                                               
                                            output += '<a target="_blank" href="rn.php?action=novi_rn&primka_id=' + row.primka_id + '" class="btn btn-app" id="novi_rn" name="1" style=" height:initial; margin: 0 0 5px 5px; padding: 5px; background-color:ivory  " title="Otvori nalog servisiranja"><i class="glyphicon glyphicon-share" style="font-size:small; display:inline;"></i> Radni nalog</a>';
                                            output += '<a target="_blank" href="rma.php?action=novi_rma&poslano=Da&primka_id=' + row.primka_id + '" class="btn btn-app" id="novi_rn" name="1" style="padding: 5px; margin: 0 0 5px 5px; height:initial; background-color:ivory  " title="Otvori nalog reklamacija"><i class="glyphicon glyphicon-random" style="font-size:small; display:inline;"></i> RMA nalog</a>';
                                            return output;
                                        }},
                                    {"data": "primka_id", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                            var output = "";
                                            var danas = new Date();
                                            var datum = new Date(row.datumZaprimanja);
                                            var oneDay = 24 * 60 * 60 * 1000;
                                            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime()) / (oneDay)));

                                            if (diffDays <= 10)
                                                var sty = "label label-success";
                                            if (diffDays > 10 && diffDays <= 17)
                                                var sty = "label label-warning";
                                            if (diffDays > 17)
                                                var sty = "label label-danger";
                                            output += '<a class="' + sty + '" href="pregled.php?primka='+row.primka_id+'">' + row.primka_id + '</a>'; // row object contains the row data
                                            return output;
                                        }},
                                    {"data": "naziv", "render": function (data, type, row, meta) { return row.brand + ' ' + row.naziv } },
                                    {"data": "serial"},
                                    {"data": "s_ime", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                    if(row.tvrtka) var osoba =  row.tvrtka + ', ' + row.s_ime + ' ' + row.s_prezime;
                                        else    var osoba =  row.s_ime + ' ' + row.s_prezime;
                                            return osoba;
                                        }},
                                    {"data": "datumZaprimanja", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                            var d = new Date(row.datumZaprimanja);
                                            var dat = (d && d.getFullYear() != '1970') ? [d.getDate(), d.getMonth() + 1, d.getFullYear()].join('.') : ' ';
                                            return dat;
                                        }},
                                    {"data": "status"},
                                    {"data": "centar"}


                                ]



                            });
                        } else {
                            $('#svePoslanePrimke').DataTable({
                                "ajax": {
                                    "url": "json/primka/svePoslanePrimke.php",
                                    "dataSrc": ""
                                },
                                "columns": [
                                    {"data": "primka_id", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                            var output = "";
                                            var danas = new Date();
                                            var datum = new Date(row.datumZaprimanja);
                                            var oneDay = 24 * 60 * 60 * 1000;
                                            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime()) / (oneDay)));

                                            if (diffDays <= 10)
                                                var sty = "label label-success";
                                            if (diffDays > 10 && diffDays <= 17)
                                                var sty = "label label-warning";
                                            if (diffDays > 17)
                                                var sty = "label label-danger";
                                            output += '<a class="' + sty + '">' + row.primka_id + '</a>'; // row object contains the row data
                                            return output;
                                        }},
                                    {"data": "naziv"},
                                    {"data": "serial"},
                                    {"data": "s_ime", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                            var osoba = row.s_ime + ' ' + row.s_prezime;
                                            return osoba;
                                        }},
                                    {"data": "datumZaprimanja", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                            var d = new Date(row.datumZaprimanja);
                                            var dat = (d && d.getFullYear() != '1970') ? [d.getDate(), d.getMonth() + 1, d.getFullYear()].join('.') : ' ';
                                            return dat;
                                        }},
                                    {"data": "status"}


                                ]



                            });
                        }
                    }

                    },
                    error: function (rn) {
                    }
                })
                $('#svePoslanePrimke').on("mouseover", "#novi_rn", function(){
                   $(this).attr('title', 'Započni servisiranje'); 
                });
                 $('#svePoslanePrimke').on("mouseover", "#novi_rma", function(){
                   $(this).attr('title', 'Stvori novi RMA nalog'); 
                });
                $('#svePoslanePrimke').on("mouseover", "#uredi_rn", function(){
                   $(this).attr('title', 'Uredi radni nalog'); 
                });
                $('#svePoslanePrimke').on("mouseover", "#uredi_rma", function(){
                   $(this).attr('title', 'Uredi RMA nalog'); 
                });


                //    KRAJ    *   LISTANJE SVIH POSLANIH PRIMKI  * KRAJ
            </script>
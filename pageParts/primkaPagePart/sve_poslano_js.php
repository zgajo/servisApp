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
                            $('#svePoslanePrimke').DataTable({
                                "ajax": {
                                    "url": "json/primka/svePoslanePrimke.php",
                                    "dataSrc": ""
                                },
                                "columns": [
                                    {data: "primka_id", "render": function (data, type, row, meta) {
                                            var output = "";
                                            if (odjel === "Servis" || odjel === "Reklamacije")
                                                output += '<a target="_blank" id="novi_rn" style="margin-right:15px" class="glyphicon glyphicon-share" href="rn.php?action=novi_rn&primka_id=' + row.primka_id + '"></a>';
                                             output += '<a target="_blank" id="novi_rma" class="glyphicon glyphicon-random" href="rma.php?action=novi_rma&poslano=Da&primka_id=' + row.primka_id + '"></a>';
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
                                            output += '<a class="' + sty + '">' + row.primka_id + '</a>'; // row object contains the row data
                                            return output;
                                        }},
                                    {"data": "primka_id", "render": function (data, type, row, meta) {
                                            var r = null;
                                            var rm = null;


                                            var output = '';
                                            //    DOHVAĆANJE RADNIH NALOGA
                                            $.ajax({
                                                async: false,
                                                url: "json/rn/getRNbyPrimka.php",
                                                type: 'POST',
                                                data: {"primka": row.primka_id},
                                                success: function (data) {

                                                    r = data;

                                                }});
                                            //    DOHVAĆANJE RMA NALOGA
                                            $.ajax({
                                                async: false,
                                                url: "json/rma/getRmaByPrimka.php",
                                                type: 'GET',
                                                data: {"primka": row.primka_id},
                                                success: function (data) {

                                                    rm = data;

                                                }});
                                            //    UKOLIKO IMA DOHVAĆENIH rn
                                            if (r !== null && r.length > 0) {
                                                for (var j = 0; j < r.length; ++j) {
                                                    output += '<a target="_blank" id="uredi_rn" href="rn.php?radni_nalog=' + r[j].id + '"> RN. ' + r[j].id + '</a><br>';
                                                }
                                            }
                                            //    UKOLIKO IMA DOHVAĆENIH rma

                                            if (rm !== null && rm.length > 0) {
                                                for (var j = 0; j < rm.length; ++j) {
                                                    output += '<a target="_blank" id="uredi_rma" href="rma.php?rma=' + rm[j].id + '"> RMA. ' + rm[j].id + '</a><br>';
                                                }
                                            }

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
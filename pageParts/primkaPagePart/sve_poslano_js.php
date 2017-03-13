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
            if (spp) {
                if (odjel === "Servis" || odjel === "Reklamacije") {
                    $('#svePoslanePrimkeServis').DataTable({
                        "ajax": {
                            "url": "json/primka/svePoslanePrimke.php",
                            "dataSrc": ""
                        },
                        "columns": [
                            {
                                data: "primka_id",
                                "render": function (data, type, row, meta) {
                                    var output = "";
                                    if (odjel === "Servis" || odjel === "Reklamacije")

                                        output += '<a  class="btn btn-app" id="novi_rn" name="' + row.primka_id + '" style=" height:initial; margin: 0 0 5px 5px; padding: 5px; background-color:ivory  " title="Otvori nalog servisiranja"><i class="glyphicon glyphicon-share" style="font-size:small; display:inline;"></i> Radni nalog</a>';
                                    output += '<a  class="btn btn-app" id="novi_rma" name="' + row.primka_id + '" style="padding: 5px; margin: 0 0 5px 5px; height:initial; background-color:ivory  " title="Otvori nalog reklamacija"><i class="glyphicon glyphicon-random" style="font-size:small; display:inline;"></i> RMA nalog</a>';
                                    return output;
                                }
                            },
                            {
                                "data": "primka_id",
                                "render": function (data, type, row, meta) { // render event defines the markup of the cell text
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
                                    output += '<a class="' + sty + '" href="pregled.php?primka=' + row.primka_id + '">' + row.primka_id + '</a>'; // row object contains the row data
                                    return output;
                                }
                            },
                            {
                                "data": "naziv",
                                "render": function (data, type, row, meta) {
                                    return row.brand + ' ' + row.naziv
                                }
                            },
                            {
                                "data": "serial"
                            },
                            {
                                "data": "s_ime",
                                "render": function (data, type, row, meta) { // render event defines the markup of the cell text
                                    if (row.tvrtka) var osoba = row.tvrtka + ', ' + row.s_ime + ' ' + row.s_prezime;
                                    else var osoba = row.s_ime + ' ' + row.s_prezime;
                                    return osoba;
                                }
                            },
                            {
                                "data": "datumZaprimanja",
                                "render": function (data, type, row, meta) { // render event defines the markup of the cell text
                                    var zaprimljeno = new Date(row.datumZaprimanja);
                                    var danas = new Date();
                                    var datum = new Date(row.datumZaprimanja);
                                    var oneDay = 24 * 60 * 60 * 1000;
                                    var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime()) / (oneDay)));

                                    var a = '';
                                    a += (zaprimljeno && zaprimljeno.getFullYear() != '1970') ? [zaprimljeno.getDate(), zaprimljeno.getMonth() + 1, zaprimljeno.getFullYear()].join('.') : '';
                                    a += ' <a id="broj_dana" style="display:none"> ' + diffDays + '</a>';
                                    return a;
                                }
                            },
                            {
                                "data": "status"
                            },
                            {
                                "data": "centar"
                            }


                                ]



                    });
                } else {
                    $('#svePoslanePrimke').DataTable({
                        "ajax": {
                            "url": "json/primka/svePoslanePrimke.php",
                            "dataSrc": ""
                        },
                        "columns": [
                            {
                                "data": "primka_id",
                                "render": function (data, type, row, meta) { // render event defines the markup of the cell text
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
                                }
                            },
                            {
                                "data": "naziv"
                            },
                            {
                                "data": "serial"
                            },
                            {
                                "data": "s_ime",
                                "render": function (data, type, row, meta) { // render event defines the markup of the cell text
                                    if (row.tvrtka) var osoba = row.tvrtka + ', ' + row.s_ime + ' ' + row.s_prezime;
                                    else var osoba = row.s_ime + ' ' + row.s_prezime;
                                    return osoba;
                                }
                            },
                            {
                                "data": "datumZaprimanja",
                                "render": function (data, type, row, meta) { // render event defines the markup of the cell text
                                    var d = new Date(row.datumZaprimanja);
                                    var dat = (d && d.getFullYear() != '1970') ? [d.getDate(), d.getMonth() + 1, d.getFullYear()].join('.') : ' ';
                                    return dat;
                                }
                            },
                            {
                                "data": "status"
                            }


                                ]



                    });
                }
            }

        },
        error: function (rn) {}
    })


    $("#svePoslanePrimkeServis").on("click", "#novi_rma", function () {
        var pr = $(this).attr("name");
        $.ajax({
            type: "GET",
            url: "json/rma/getRmaByPrimka.php",
            data: {
                "primka": pr
            },
            success: function (rma) {
                if (rma) {
                    if (confirm("Već postoji otvoren RMA nalog povezan sa ovom primkom. Želite li otvoriti njega?")) {
                        window.location = "rma.php?rma=" + rma[0].id;
                    } else {
                        if (confirm('Stvoriti novi RMA nalog?')) window.location = "rma.php?action=novi_rma&primka_id=" + pr;
                    }
                } else {
                    if (confirm('Stvoriti novi RMA nalog?')) window.open("rma.php?action=novi_rma&poslano=Da&primka_id=" + pr, "_blank");
                }

            }
        })

    });

    $("#svePoslanePrimkeServis").on("click", "#novi_rn", function () {
        var pr = $(this).attr("name");
        $.ajax({
            type: "POST",
            url: "json/rn/getRNbyPrimka.php",
            data: {
                "primka": pr
            },
            success: function (rn) {
                if (rn) {
                    if (confirm("Već postoji otvoren radni nalog povezan sa ovom primkom. Želite li otvoriti njega?")) {
                        window.location = "rn.php?radni_nalog=" + rn[0].id;
                    } else {
                        if (confirm('Stvoriti novi servisni nalog?')) window.location = "rn.php?action=novi_rn&primka_id=" + pr;
                    }
                } else {
                    if (confirm('Stvoriti novi servisni nalog?')) window.open("rn.php?action=novi_rn&primka_id=" + pr, "_blank");
                }

            }
        })


    });

    $("#svePoslanePrimkeServis").on("mouseover", "tbody tr", function () {
        var brdana = $(this).find('#broj_dana').text();
        $(this).attr('title', 'Broj dana od zaprimanja: ' + brdana + '. Kliknite za više opcija ');
        $(this).css('background-color', '#ccffcc');
        $(this).find('#opcije').show();

    });

    $("#svePoslanePrimkeServis").on("mouseout", "tr", function () {
        $(this).removeAttr('style');
        $(this).find('#opcije').hide();
    });




    //    KRAJ    *   LISTANJE SVIH POSLANIH PRIMKI  * KRAJ
</script>

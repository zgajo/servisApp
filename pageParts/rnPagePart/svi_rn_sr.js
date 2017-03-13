$('#sviRN tbody').on("mouseover", "tr", function () {
    $(this).css('background-color', '#ccffcc');
    $(this).find('#uredi_rn').show();
    var brdana  = $(this).find('#broj_dana').text();
    $(this).attr('title', 'Broj dana od zaprimanja: '+brdana+'. Kliknite za više opcija ');
});
$('#sviRN tbody').on("mouseout", "tr", function () {
    $(this).removeAttr('style');
    $(this).find('#uredi_rn').hide();
});


//  TRAŽENJE RADNIH NALOGA POVEZANIH SA PRIMKAMA
$.ajax({
    async: false,
    url: "json/rn/sviRNservis.php",
    type: 'POST',
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function (rn) {

        console.log(rn);
        if (rn) {

            $('#sviRN').DataTable({
                "ajax": {
                    "url": "json/rn/sviRNservis.php",
                    "dataSrc": ""
                },
                "columns": [
                    {
                        "data": "primka",
                        "render": function (data, type, row, meta) { // render event defines the markup of the cell text
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

                            if (row.status == "Stranka odustala od popravka" || row.status == "Popravak završen u jamstvu" || row.status == "Popravak završen van jamstva" || row.status == "Stranka odustala od popravka" || row.status == "Uređaj zamijenjen novim" || row.status == "Odobren povrat novca" || row.status == "DOA - Uređaj zamijenjen novim" || row.status == "DOA - Odobren povrat novca" || row.status == "Čeka preuzimanje stranke") {
                                var a = '<a name="' + row.id + '" class="' + sty + '" style="cursor: default; font-size: 0.8em;">' + row.primka + '</a><p style="display: initial; margin-left:10px; color:purple"><i class="fa fa-angle-double-left"></i></p>';
                            } else
                                var a = '<a name="' + row.id + '" class="' + sty + '" style="cursor: default; font-size: 0.8em;">' + row.primka + '</a>'; // row object contains the row data
                            a += ' <a id="broj_dana" style="display:none"> ' + diffDays + '</a>';
                            return a;
                        }
                    },
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            var output = '<strong>' + row.id + '</strong><a name="' + row.id + '"  style="margin-left:10px;" ><i id="uredi_rn" style=" display:none;" class="glyphicon glyphicon-pencil"></i></a><br>';
                            return output;
                        }
                    },
                    {
                        "data": "naziv",
                        "render": function (data, type, row, meta) {
                            return row.brand + ' ' + row.naziv;
                        }
                    },
                    {
                        "data": "serijski"
                    },
                    {
                        "data": "s_ime",
                        "render": function (data, type, row, meta) { // render event defines the markup of the cell text
                            if (row.tvrtka)
                                var osoba = row.tvrtka + ', ' + row.s_ime + ' ' + row.s_prezime;
                            else
                                var osoba = row.s_ime + ' ' + row.s_prezime;
                            return osoba;
                        }
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "napomena"
                    }
                ],
                "bDestroy": true
            });

        }



    },
    error: function () {
        console.log("greška");
    }
});



$('#sviRN').on("mouseover", "#uredi_rn", function () {
    $(this).attr("title", "Uredi radni nalog");
})

$('#sviRN').on("mouseover", " tbody tr td:first-child", function () {
    $(this).attr("title", "Uredi radni nalog");
})
$('#sviRN').on("mouseover", " tbody tr td:nth-child(2)", function () {
    $(this).attr("title", "Uredi radni nalog");
})
$('#sviRN').on("click", " tbody tr td:first-child", function () {
    window.location = "rn.php?radni_nalog=" + $(this).find('a').attr("name");
})
$('#sviRN').on("click", " tbody tr td:nth-child(2)", function () {
    window.location = "rn.php?radni_nalog=" + $(this).find('a').attr("name");
})

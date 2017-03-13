//PRIKAZ SVIH RMA NALOGA ZA SERVIS I REKLAMACIJE

$("#sviRMA tbody").on("mouseover", " tr", function () {
    $(this).css('background-color', '#ccffcc');
    $(this).find('#uredi_rma').show();
var brdana  = $(this).find('#broj_dana').text();
    $(this).attr('title', 'Broj dana od zaprimanja: '+brdana+'. Kliknite za više opcija ');
});

$("#sviRMA tbody").on("mouseout", "tr", function () {
    $(this).removeAttr('style');
    $(this).find('#uredi_rma').hide();
});




//  TRAŽENJE RADNIH NALOGA POVEZANIH SA PRIMKAMA
$.ajax({
    async: false,
    url: "json/rma/sviRmaSR.php",
    type: 'POST',
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function (rn) {

        if (rn) {
            console.log(rn);

            $('#sviRMA').DataTable({
                "ajax": {
                "url": "json/rma/sviRmaSR.php",
                "dataSrc": ""
            },
                "columns": [
                    {"data": "pid", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                            var danas = new Date();
                            var datum = new Date(row.datumZaprimanja);
                            var oneDay = 24 * 60 * 60 * 1000;
                            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime()) / (oneDay)));

                            if (diffDays <= 15)
                                var sty = "label label-success";
                            if (diffDays > 15 && diffDays <= 30)
                                var sty = "label label-warning";
                            if (diffDays > 30)
                                var sty = "label label-danger";

                            if (row.status == "Stranka odustala od popravka" || row.status == "Popravak završen u jamstvu" || row.status == "Popravak završen van jamstva" || row.status == "Stranka odustala od popravka"
                                    || row.status == "Uređaj zamijenjen novim" || row.status == "Odobren povrat novca" || row.status == "DOA - Uređaj zamijenjen novim" || row.status == "DOA - Odobren povrat novca" || row.status == "Čeka preuzimanje stranke") {
                                var a = '<a name="' + row.id + '" class="' + sty + '" style="cursor: default; font-size: 0.8em;">' + row.pid + '</a><p style="display: initial; margin-left:10px; color:purple"><i class="fa fa-angle-double-left"></i></p>';
                            } else
                                var a = '<a name="' + row.id + '" class="' + sty + '" style="cursor: default; font-size: 0.8em;">' + row.pid + '</a>';
                        a += ' <a id="broj_dana" style="display:none"> '+diffDays+'</a>';

                            return a;
                        }},
                    {"data": "id", "render": function (data, type, row, meta) {
                            var output = '<strong>' + row.id + '</strong><a   name="' + row.id + '" style="margin-left:10px;" href="#"><i id="uredi_rma" style=" display:none;" class="glyphicon glyphicon-pencil"></i></a><br>';
                            return output;
                        }},
                    {"data": "sifra", "render": function (data, type, row, meta) {
                            if (row.sifra)
                                return row.sifra;
                            else
                                return ''
                        }},
                    {"data": "naziv", "render": function (data, type, row, meta) {
                            return row.brand + ' ' + row.naziv
                        }},
                    {"data": "serijski"},
                    {"data": "s_ime", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                            if (row.tvrtka)
                                var osoba = row.tvrtka + ', ' + row.s_ime + ' ' + row.s_prezime;
                            else
                                var osoba = row.s_ime + ' ' + row.s_prezime;
                            return osoba;
                        }},
                    {"data": "rnOs"},
                    {"data": "nazivOS"},
                    {"data": "poslano", "render": function (data, type, row, meta) {
                            var poslano = new Date(row.poslano);
                            var output = (poslano && poslano.getFullYear() != "1970" && !isNaN(poslano)) ? [poslano.getDate(), poslano.getMonth() + 1, poslano.getFullYear()].join('.') : '';
                            return output;
                        }},
                    {"data": "status"},
                    {"data": "napomena"}
                ], "bDestroy": true
            });


        }



    },
    error: function () {
        console.log("greška");
    }
});


$('#sviRMA').on("mouseover", "#uredi_rma", function () {
    $(this).attr("title", "Uredi rma nalog");
})

$('#sviRMA').on("mouseover", " tbody tr td:first-child", function () {
    $(this).attr("title", "Uredi radni nalog");
})
$('#sviRMA').on("mouseover", " tbody tr td:nth-child(2)", function () {
    $(this).attr("title", "Uredi radni nalog");
})
$('#sviRMA').on("click", " tbody tr td:first-child", function () {
    window.location = "rma.php?rma=" + $(this).find('a').attr("name");
})
$('#sviRMA').on("click", " tbody tr td:nth-child(2)", function () {
    window.location = "rma.php?rma=" + $(this).find('a').attr("name");
})

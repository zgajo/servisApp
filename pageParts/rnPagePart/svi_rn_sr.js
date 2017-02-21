


$('#sviRN').on("mouseover", "tr", function () {
    $(this).find('i').show();
});
$('#sviRN').on("mouseout", "tr", function () {
    $(this).find('i').hide();
});


//    LISTANJE SVIH OTVORENIH PRIMKI
$.ajax({
    type: 'POST',
    url: "json/primka/svePoslaneRNPrimke.php",
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function (data) {
        var output = "";
        var primka = JSON.parse(JSON.stringify(data));
        var danas = new Date();

        for (var i = 0; i < primka.length; ++i) {
            var datum = new Date(primka[i].datumZaprimanja);
            var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds

            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime()) / (oneDay)));

            if (diffDays <= 15)
                var sty = "label label-success";
            if (diffDays > 15 && diffDays <= 30)
                var sty = "label label-warning";
            if (diffDays > 30)
                var sty = "label label-danger";

            var rn = null;
            var pid = primka[i].primka_id;

            //  TRAŽENJE RADNIH NALOGA POVEZANIH SA PRIMKAMA
            $.ajax({
                async: false,
                url: "json/rn/getRNbyPrimka.php",
                type: 'POST',
                data: {"primka": pid},
                success: function (rn) {

                    console.log(rn);
                    if (rn) {

                        Tabla.rows.add(rn).draw();

                    }



                },
                error: function () {
                    console.log("greška");
                }
            });



        }


    },
    error: function (e) {
        alert(e.message);
    }
});

var Tabla = $('#sviRN').DataTable({
    "columns": [
        {"data": "primka", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
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

                var a = '<a name="' + row.id + '" style="cursor: default;" class="' + sty + '">' + row.primka + '</a>'; // row object contains the row data
                return a;
            }},
        {"data": "id", "render": function (data, type, row, meta) {
                var output = '<strong>RN. ' + row.id + '</strong><a name="' + row.id + '"  style="margin-left:10px;" ><i id="uredi_rn" style=" display:none;" class="glyphicon glyphicon-pencil"></i></a><br>';
                return output;
            }},
        {"data": "naziv"},
        {"data": "serijski"},
        {"data": "s_ime", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                var osoba = row.s_ime + ' ' + row.s_prezime;
                return osoba;
            }},
        {"data": "status"},
        {"data": "napomena"}
    ], "bDestroy": true
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
    window.open("rn.php?radni_nalog=" + $(this).find('a').attr("name"), "_blank");
})
$('#sviRN').on("click", " tbody tr td:nth-child(2)", function () {
    window.open("rn.php?radni_nalog=" + $(this).find('a').attr("name"), "_blank");
})
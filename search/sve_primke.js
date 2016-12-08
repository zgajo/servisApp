//    LISTANJE SVIH OTVORENIH PRIMKI

$('#sve_primke').DataTable({
    "ajax": {
        "url": "json/primka/sveOtvorenePrimke.php",
        "dataSrc": ""
    },
    "columns": [
        {"data": "primka_id", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
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

                var a = '<a style="margin-right:10px" href="pregled.php?primka=' + row.primka_id + '"><i style="display:none; " class="fa  fa-file-text-o"></i></a>';
                a += '<a style="margin-right:10px" href="primke.php?primka=' + row.primka_id + '"><i style="display:none; " class="glyphicon glyphicon-pencil"></i></a>\n\
                             <a class="' + sty + '">' + row.primka_id + '</a>'; // row object contains the row data
                return a;
            }},
        {"data": "datumZaprimanja", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                var zaprimljeno = new Date(row.datumZaprimanja);

                var a = '';
                a += (zaprimljeno && zaprimljeno.getFullYear() != '1970') ? [zaprimljeno.getDate(), zaprimljeno.getMonth() + 1, zaprimljeno.getFullYear()].join('.') : '';
                return a;
            }},
        {"data": "naziv"},
        {"data": "serial"},
        {"data": "s_ime", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                var osoba = row.s_ime + ' ' + row.s_prezime;
                return osoba;
            }},
        {"data": "status"}
    ]


});

$("#sve_primke").on("mouseover", "tr", function () {
    $(this).find('i').show();
});

$("#sve_primke").on("mouseout", "tr", function () {
    $(this).find('i').hide();
});


//    KRAJ    *   LISTANJE SVIH OTVORENIH PRIMKI  * KRAJ

//    LISTANJE SVIH  POSLANIH PRIMKI



//   KRAJ    *       LISTANJE SVIH  POSLANIH PRIMKI     *   KRAJ




//      KRAJ    *    HOVER NA RED SVIH PRIMKI   *   KRAJ
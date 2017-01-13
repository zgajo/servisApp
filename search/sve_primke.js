//    LISTANJE SVIH OTVORENIH PRIMKI
 
$.ajax({
    url: "json/primka/sveOtvorenePrimke.php",
    type: 'POST',
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function () {
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

                        var a = '<a  class="' + sty + '" style="cursor:default">' + row.primka_id + '</a>'; // row object contains the row data
                        
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
    },
    error: function (rn) {
    }
})

$("#sve_primke").on("mouseover", "#uredi_p", function () {
    
    $(this).attr('title', 'Otvori formu za uređivanje primke');
})
$("#sve_primke").on("mouseover", "#pregledaj_p", function () {
    $(this).attr('title', 'Pregled / ispis primke');
})
$("#sve_primke").on("mouseover", "#novi_rn", function () {
    $(this).attr('title', 'Stvori novi radni nalog');
})

$("#sve_primke").on("mouseover", "#novi_rma", function () {
    $(this).attr('title', 'Stvori novi RMA nalog');
})

$("#sve_primke").on("mouseover", "#narudzba", function () {
    $(this).attr('title', 'Stvori novu narudžbu');
})

$("#sve_primke").on("click", "#narudzba", function () {
    var stranka = $("#str").attr('name');
    var pr= $(this).attr("name");
    window.location = "narudzbe.php?primka="+pr+"&stranka="+stranka;
});



$("#sve_primke").on("mouseover", "tbody tr", function () {
    $(this).attr('title', 'Kliknite za više opcija');
    $(this).css('background-color', '#B5C0EE');
    $(this).find('#opcije').show();
    
});

$("#sve_primke").on("mouseout", "tr", function () {
    $(this).removeAttr( 'style' );
    $(this).find('#opcije').hide();
});

function z(){
    $("#sve_primke tbody tr").nextAll("td").remove();
}

$("#sve_primke").on("click", "tbody tr", function () {
    
    if($(this).next().is('td')){ $(this).next().remove()}
    
    else   {
        z();
        $(this).after('<td colspan=6 style="border:1px solid #F4F4F4; background-color: #ffa" ><div style="margin-top:10px;">'+
                           
                   '<a   class="btn btn-app"  href="rn.php?action=novi_rn&primka_id=" style=" float: left; ">'+
                    '<i class="glyphicon glyphicon-share"></i> Novi radni nalog'+
                    '</a>  '+
                         
                   '<a class="btn btn-app"  href="rma.php?action=novi_rma&primka_id=" style=" float: left; ">'+
                        '<i class="glyphicon glyphicon-random"></i> Novi RMA nalog'+
                    '</a>  '  +
                    
                    '<a  class="btn btn-app"  id="narudzba" style=" float: left;">'+
                       ' <i class="fa fa-reorder"></i> Nova narudžba'+
                    '</a>'+
                         
                    '<a class="btn btn-app"  href="rucne.php?primka=" style=" float: left;">'+
                   '     <i class="fa fa-send"></i> Stvori ručnu izdatnicu'+
                   ' </a>'+
                    
                    
                '</div></td>')}
});

   


//    KRAJ    *   LISTANJE SVIH OTVORENIH PRIMKI  * KRAJ

//    LISTANJE SVIH  POSLANIH PRIMKI



//   KRAJ    *       LISTANJE SVIH  POSLANIH PRIMKI     *   KRAJ




//      KRAJ    *    HOVER NA RED SVIH PRIMKI   *   KRAJ
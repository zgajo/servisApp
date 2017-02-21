<script>

//    LISTANJE SVIH OTVORENIH PRIMKI
 
$.ajax({
    async: false,
    url: "json/primka/sveOtvorenePrimke.php",
    type: 'POST',
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function (prim) {
        console.log(prim)
        if(prim){
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
                        
                        if(row.status == "Stranka odustala od popravka" || row.status == "Popravak završen u jamstvu" || row.status == "Popravak završen van jamstva" || row.status == "Stranka odustala od popravka" 
                            || row.status == "Uređaj zamijenjen novim" || row.status == "Odobren povrat novca" || row.status == "DOA - Uređaj zamijenjen novim" ||  row.status == "DOA - Odobren povrat novca" ||  row.status == "Čeka preuzimanje stranke")   {
                        var a =   '<p style="display: initial; margin-right:10px; color:purple;"><i class="fa fa-angle-double-right"></i></p><a  class="' + sty + '" style="cursor:default">' + row.primka_id + '</a><p style="display: initial; margin-left:10px; color:purple"><i class="fa fa-angle-double-left"></i></p>';
                        return a;
                        }

                      var a =   '<a  class="' + sty + '" style="cursor:default">' + row.primka_id + '</a>'; // row object contains the row data
                        
                        return a;
                    }},
                {"data": "datumZaprimanja", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                        var zaprimljeno = new Date(row.datumZaprimanja);
                         var danas = new Date();
                        var datum = new Date(row.datumZaprimanja);
                        var oneDay = 24 * 60 * 60 * 1000;
                        var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime()) / (oneDay)));

                        var a = '';
                        a += (zaprimljeno && zaprimljeno.getFullYear() != '1970') ? [zaprimljeno.getDate(), zaprimljeno.getMonth() + 1, zaprimljeno.getFullYear()].join('.') : '';
                        a += ' <a id="broj_dana" style="display:none"> '+diffDays+'</a>';
                        return a;
                    }},
                {"data": "naziv", "render": function (data, type, row, meta) { return row.brand +  '  ' + row.naziv }},
                {"data": "serial"},
                {"data": "s_ime", "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                        if(row.tvrtka) var osoba = row.tvrtka;
                        else var osoba = row.s_ime + ' ' + row.s_prezime;
                        return osoba;
                    }},
                {"data": "status"}
            ]


        });
    }
    },
    error: function (rn) {
    }
})



$("#sve_primke").on("mouseover", "#uredi", function () {
    
    $(this).attr('title', 'Ispravi podatke primke, stranke ili uredi status primke');
})
$("#sve_primke").on("mouseover", "#pregledaj_p", function () {
    $(this).attr('title', 'Pregled / ispis primke');
})
$("#sve_primke").on("mouseover", "#ispisi", function () {
    $(this).attr('title', 'Ispis potvrde rada');
})
$("#sve_primke").on("mouseover", "#novi_rn", function () {
    $(this).attr('title', 'Stvori novi radni nalog');
})

$("#sve_primke").on("mouseover", "#rucne", function () {
    $(this).attr('title', 'Kreiranje nove ručne izdatnice');
})

$("#sve_primke").on("mouseover", "#novi_rma", function () {
    $(this).attr('title', 'Stvori novi RMA nalog');
})

$("#sve_primke").on("mouseover", "#narudzba", function () {
    $(this).attr('title', 'Stvori novu narudžbu');
})

$("#sve_primke").on("click", "#narudzba", function () {
    var stranka = $(this).find("#str_id").attr('name');
    var pr= $(this).attr("name");
    if(confirm('Stvoriti novu narudžbu?')) window.open("narudzbe.php?primka="+pr+"&stranka="+stranka, "_blank");
    
});

$("#sve_primke").on("click", "#novi_rma", function () {
    var pr= $(this).attr("name");
    if(confirm('Stvoriti novi RMA nalog?'))  window.open("rma.php?action=novi_rma&primka_id="+pr, "_blank");
    
});

$("#sve_primke").on("click", "#novi_rn", function () {
    var pr= $(this).attr("name");
    if(confirm('Stvoriti novi servisni nalog?'))  window.open("rn.php?action=novi_rn&primka_id="+pr, "_blank");
    
});

$("#sve_primke").on("click", "#rucne", function () {
    var pr= $(this).attr("name");
    window.open("rucne.php?primka="+pr, "_blank");
    
});
$("#sve_primke").on("click", "#uredi", function () {
    var pr= $(this).attr("name");
    window.location = "primke.php?primka="+pr;
    
});
$("#sve_primke").on("click", "#pregledaj_p", function () {
    var pr= $(this).attr("name");
    window.location = "pregled.php?primka="+pr;
    
});
$("#sve_primke").on("click", "#ispisi", function () {
    var pr= $(this).attr("name");
    
    window.open("print.php?primka="+pr, "_blank",   "location=1,status=1,scrollbars=1, resizable=1, directories=1, toolbar=1, titlebar=1, width=800, height=800");
    
});


$("#sve_primke").on("mouseover", "tbody tr", function () {
    var brdana  = $(this).find('#broj_dana').text();
    $(this).attr('title', 'Broj dana od zaprimanja: '+brdana+'. Kliknite za više opcija ');
    $(this).css('background-color', '#ccffcc');
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
        $(this).after('<td colspan=6 style="border:1px solid #F4F4F4; background-color:#e6ffe6 ; padding-right:15px" ><div style="margin-top:10px;">'+
                
                    '<a   class="btn btn-app" id="uredi" name="'+ $(this).find('#primka_id').attr('name') +'" style=" float: left;   height:initial; background-color:ivory ">'+
                    '<i class="glyphicon glyphicon-edit" style="font-size:small; display:inline;" ></i> Uredi'+
                    '</a>  '+
                    
                    '<a   class="btn btn-app" id="pregledaj_p" name="'+ $(this).find('#primka_id').attr('name') +'" style=" float: left;   height:initial; background-color:ivory  ">'+
                    '<i class="glyphicon glyphicon-list-alt" style="font-size:small; display:inline;" ></i> Pregledaj'+
                    '</a>  '+
                    
                    '<a   class="btn btn-app" id="ispisi" name="'+ $(this).find('#primka_id').attr('name') +'" style=" float: left;   height:initial; background-color:ivory  ">'+
                    '<i class="glyphicon glyphicon-print" style="font-size:small; display:inline;" ></i> Ispis potvrde rada'+
                    '</a>  '+
                          
                   '<a   class="btn btn-app" id="novi_rn" name="'+ $(this).find('#primka_id').attr('name') +'"  style=" float: right;   height:initial; background-color:ivory  ">'+
                    '<i class="glyphicon glyphicon-share" style="font-size:small; display:inline;" ></i> Radni nalog'+
                    '</a>  '+
                          
                   '<a class="btn btn-app" id="novi_rma" name="'+ $(this).find('#primka_id').attr('name') +'" style=" float: right; height:initial; background-color:ivory  ">'+
                        '<i class="glyphicon glyphicon-random" style="font-size:small; display:inline;"></i> RMA nalog'+
                    '</a>  '  +
                    <?php if($_COOKIE['odjel'] == "Servis") { ?>
                    '<a  class="btn btn-app"  id="narudzba" name="'+ $(this).find('#primka_id').attr('name') +'" style=" float: right; height:initial; background-color:ivory ">'+
                       ' <i id="str_id" name="'+ $(this).find('#stranka_id').attr('name')+'" class="fa fa-reorder" style="font-size:small; display:inline;"></i> Narudžba'+
                    '</a>'+
                          <?php } ?>   /*
                    '<a class="btn btn-app" id="rucne" name="'+ $(this).find('#primka_id').attr('name') +'" style=" float: right; height:initial; background-color:ivory ">'+
                   '     <i class="fa fa-send" style="font-size:small; display:inline;"></i> Ručna izdatnica'+
                   ' </a>'+
                    */
                    
                '</div></td>')}
});

   


//    KRAJ    *   LISTANJE SVIH OTVORENIH PRIMKI  * KRAJ

//    LISTANJE SVIH  POSLANIH PRIMKI



//   KRAJ    *       LISTANJE SVIH  POSLANIH PRIMKI     *   KRAJ




//      KRAJ    *    HOVER NA RED SVIH PRIMKI   *   KRAJ


</script>
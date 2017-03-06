function unos_podataka(sifra, tip, naziv, brand) {

    $('#divInputSifra').show();
    $('#inputSifra').val(sifra);
    $('#inputBrand').val(brand);
    $('#inputNaziv').val(naziv);
    $('#inputTip').append('<option selected>' + tip + '</option');

}

//  PRETRAGA ZA šifrom
$('#search_box_sifra').keydown(function () {



    $(function () {

        $("#search_box_sifra").autocomplete({
            autoFocus: true,
            minLength: 1,
            source: function (request, response) {
                $.ajax({
                    type: "POST",
                    url: "search/pretrazi_sifru.php",
                    dataType: "json",
                    data: {
                        value: request.term
                    },
                    success: function (data) {


                        response(data);

                    },
                    error: function (e) {

                        var v = [{
                            sifra: 0,
                            value: 0,
                            label: "Nema pronađene šifre"
                            }];

                        response(v);
                    }
                });
            },
            open: function () {
                setTimeout(function () {
                    $('.ui-autocomplete').css('z-index', 99999999999999);
                }, 0);
            },
            select: function (event, ui) {

                if (ui.item.sifra !== 0) {

                    unos_podataka(ui.item.sifra, ui.item.tip, ui.item.naziv, ui.item.brand);

                    var newTag = $(this).val();
                    $(this).val("");
                    event.preventDefault();

                }

            }

        });

    });
});



// ČIŠĆENJE SEARCH BOX-A
$('#search_button_sifra').click(function (e) {
    e.preventDefault();
    $("#search_box_sifra").val("");
});
//  KRAJ * ČIŠĆENJE SEARCH BOX-A * KRAJ

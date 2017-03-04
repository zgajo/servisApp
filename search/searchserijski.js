//  PRETRAGA ZA PRIMKOM
$('#search_serijski').keydown(function () {



    $(function () {

        $("#search_serijski").autocomplete({
            autoFocus: true,
            minLength: 1,
            source: function (request, response) {
                $.ajax({
                    type: "POST",
                    url: "search/pretrazi_serijski.php",
                    dataType: "json",
                    data: {
                        value: request.term
                    },
                    success: function (data) {

                        response(data);

                            $('#cancels').show();
                            $('#searchs').hide();

                    },
                    error: function(e){

                            var v = [{
                                id: 0,
                                value: 0,
                                label: "Nema pronađenog serijskog broja"
                            }];

                        response(v);

                        $('#cancels').show();
                            $('#searchs').hide();
                    }
                });
            },
            open: function () {
                setTimeout(function () {
                    $('.ui-autocomplete').css('z-index', 99999999999999);
                }, 0);
            },
            select: function (event, ui) {

                if(ui.item.id !== 0) window.location = "primke.php?pregled_serijski=" + ui.item.ser;

            }

        });

    });



});


$('#search_serijski').keyup(function () {

    if ($('#search_serijski').val() == '') {
        $('#cancels').hide();
        $('#searchs').show();
    }
})

$('#ikones').on("click", function () {
        $('#search_serijski').val(null);
        $('#cancels').hide();
        $('#searchs').show();
    })
    // KRAJ PRETRAGE ZA PRIMKOM

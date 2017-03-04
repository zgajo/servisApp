//  PRETRAGA ZA PRIMKOM
$('#search_primka').keydown(function () {



    $(function () {

        $("#search_primka").autocomplete({
            autoFocus: true,
            minLength: 1,
            source: function (request, response) {
                $.ajax({
                    type: "POST",
                    url: "search/pretrazi_primku.php",
                    dataType: "json",
                    data: {
                        value: request.term
                    },
                    success: function (data) {
                        

                        response(data);

                            $('#cancelp').show();
                            $('#searchp').hide();

                    },
                    error: function(e){

                            var v = [{
                                id: 0,
                                value: 0,
                                label: "Nema pronađenih primki"
                            }];

                        response(v);

                         $('#cancelp').show();
                            $('#searchp').hide();
                    }
                });
            },
            open: function () {
                setTimeout(function () {
                    $('.ui-autocomplete').css('z-index', 99999999999999);
                }, 0);
            },
            select: function (event, ui) {

                if(ui.item.id !== 0) window.location = "pregled.php?primka=" + ui.item.id;
                
            }

        });

    });



});


$('#search_primka').keyup(function () {

    if ($('#search_primka').val() == '') {
        $('#cancelp').hide();
        $('#searchp').show();
    }
})

$('#ikonep').on("click", function () {
        $('#search_primka').val(null);
        $('#cancelp').hide();
        $('#searchp').show();
    })
    // KRAJ PRETRAGE ZA PRIMKOM

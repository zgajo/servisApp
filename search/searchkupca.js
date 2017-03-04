//  PRETRAGA ZA PRIMKOM
$('#search_kupca').keydown(function () {



    $(function () {

        $("#search_kupca").autocomplete({
            autoFocus: true,
            minLength: 1,
            source: function (request, response) {
                $.ajax({
                    type: "POST",
                    url: "search/pretrazi_kupca.php",
                    dataType: "json",
                    data: {
                        value: request.term
                    },
                    success: function (data) {


                        response(data);

                            $('#cancelk').show();
                            $('#searchk').hide();

                    },
                    error: function(e){
                     
                            var v = [{
                                id: 0,
                                value: 0,
                                label: "Nema pronađenog kupca"
                            }];

                        response(v);
                        $('#cancelk').show();
                            $('#searchk').hide();
                    }
                });
            },
            open: function () {
                setTimeout(function () {
                    $('.ui-autocomplete').css('z-index', 99999999999999);
                }, 0);
            },
            select: function (event, ui) {

                if(ui.item.id !== 0) window.location = "kupac.php?id=" + ui.item.id;
                
            }

        });

    });



});


$('#search_kupca').keyup(function () {

    if ($('#search_kupca').val() == '') {
        $('#cancelp').hide();
        $('#searchp').show();
    }
})

$('#ikonek').on("click", function () {
        $('#search_kupca').val(null);
        $('#cancelk').hide();
        $('#searchk').show();
    })
    // KRAJ PRETRAGE ZA PRIMKOM

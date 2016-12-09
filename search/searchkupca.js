var left = $('#sk').position().left;
                var top = $('#sk').position().top;
                var width = $('#sk').width();


                $('#search_result_kupac').css('top', top + 27).css('width', width+100 ).css('z-index', 4);

                //  PRETRAGA ZA KUPCEM
                $('#search_kupca').keyup(function () {
                    var value = $(this).val();

                    if (value != '') {
                         $('#searchk').hide();
                        $('#cancelk').show();
                        $('#search_result_kupac').show();

                        //Ispis kupaca
                        $.post('search/pretrazi_kupca.php', {value: value}, function (data) {
                            
                            //Dohvat json podataka
                            var primka = JSON.parse(JSON.stringify(data));
                            console.log(JSON.parse(JSON.stringify(data)));
                            
                            //Prikaz pronađenih podataka
                            var output ='<ul >';
                            for(var i=0; i < primka.length; ++i){
                                output += '<li><a style="color:#001F3F" class="a" id="k" name="'+ primka[i].id + '"> ';
                                if(primka[i].tvrtka) output += primka[i].tvrtka+', '; 
                                output += primka[i].ime+' ' + primka[i].prezime + ', ' + primka[i].grad +', ' + primka[i].adresa +'</a></li>'
                            } 
                            
                            output +='</ul>';   //kraj ispis liste
                            
                            $('#search_result_kupac').html(output);
                            
                        }).fail(function(){$('#search_result_kupac').html('Nema rezultata');});
                        
                    } else {
                        $('#searchk').show();
                        $('#cancelk').hide();
                        $('#search_result_kupac').hide();
                    }

                });
                //  KRAJ * PRETRAGA ZA KUPCEM * KRAJ
                
                 $('#ikonek').on("click", this, function(e){
                     $('#search_kupca').val(null);
                     $('#cancelk').hide();
                    $('#searchk').show();
                    $('#search_result_kupac').hide();
                });
                
                
                //  UPIS PODATAKA ODABRANOG KUPCA U POLJE
                $('#search_result_kupac').on("click", 'a', function(e){
                    e.preventDefault();
                    
                    var idkupca = $( this ).attr('name');
                   window.location = "kupac.php?id=" + idkupca;

                    
                });
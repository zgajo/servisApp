var left = $('#sp').position().left;
                var top = $('#sp').position().top;
                var width = $('#sp').width();


                $('#search_result_primka').css('top', top + 27).css('width', width+100 ).css('z-index', 4);

                //  PRETRAGA ZA KUPCEM
                $('#search_primka').keyup(function () {
                    var value = $(this).val();

                    if (value != '') {
                         $('#searchp').hide();
                        $('#cancelp').show();
                        $('#search_result_primka').show(function(){
                            $(this).find("li").first().addClass("hover_a");
                            $(this).find("a").first().css("background", "#4aaee7");
                        });

                        //Ispis kupaca
                        $.post('search/pretrazi_primku.php', {value: value}, function (primka) {
                            
                            if(primka){
                              //Prikaz pronađenih podataka
                            var output ='<ul >';
                            for(var i=0; i < primka.length; ++i){
                                output += '<li><a style="color:#001F3F" class="a" id="k" name="'+ primka[i].primka + '">Primka '+ primka[i].primka + ', ';
                                if(primka[i].tvrtka) output += primka[i].tvrtka+', '; 
                                output += primka[i].ime+' ' + primka[i].prezime +'</a></li>'
                            } 
                            
                            output +='</ul>';   //kraj ispis liste 
                            $('#search_result_primka').html(output);
                            
                            }else{
                                $('#search_result_primka').html('Nema rezultata');
                            }
                            
                            
                            
                            
                        }).fail(function(){$('#search_result_primka').html('Nema rezultata');});
                        
                    } else {
                        $('#searchp').show();
                        $('#cancelp').hide();
                        $('#search_result_primka').hide();
                    }

                });
                //  KRAJ * PRETRAGA ZA KUPCEM * KRAJ
                
                 $('#ikonep').on("click", this, function(e){
                     $('#search_primka').val(null);
                     $('#cancelp').hide();
                    $('#searchp').show();
                    $('#search_result_primka').hide();
                });
                
                
                
                //  UPIS PODATAKA ODABRANOG KUPCA U POLJE
                $('#search_result_primka').on("click", 'a', function(e){
                    e.preventDefault();
                    
                    var idprimka = $( this ).attr('name');
                   window.location = "pregled.php?primka=" + idprimka;

                    
                });

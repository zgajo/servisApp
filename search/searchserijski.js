var left = $('#ss').position().left;
                var top = $('#ss').position().top;
                var width = $('#ss').width();


                $('#search_result_serijski').css('top', top + 27).css('width', width+100 ).css('z-index', 4);

                //  PRETRAGA ZA KUPCEM
                $('#search_serijski').keyup(function () {
                    var value = $(this).val();

                    if (value != '') {
                        $('#searchs').hide();
                        $('#cancels').show();
                        $('#search_result_serijski').show();

                        //Ispis kupaca
                        $.ajax({
                            url:'search/pretrazi_serijski.php',
                            type: 'POST',
                            data: {value: value},
                            success: function (primka) {
                            
                            //Prikaz pronađenih podataka
                           if(primka){
                                var output ='<ul >';
                            for(var i=0; i < primka.length; ++i){
                               
                               
                                output += '<li><a style="color:#001F3F" class="a" id="k" name="'+ primka[i].serijski + '">Serijski: '+ primka[i].serijski + ', Uređaj: ' + primka[i].uredaj;
                               
                            } 
                            
                            output +='</ul>';   //kraj ispis liste
                            
                            $('#search_result_serijski').html(output);
                           }else{
                                $('#search_result_serijski').html('Nema rezultata');
                           }
                               
                           
                        },
                        error: function(nema){
                             $('#search_result_serijski').html('Nema rezultata');
                        }
                        
                    });
                        
                    } else {
                        $('#searchs').show();
                        $('#cancels').hide();
                        $('#search_result_serijski').hide();
                    }

                });
                //  KRAJ * PRETRAGA ZA KUPCEM * KRAJ
                
                $('#ikones').on("click", this, function(e){
                     $('#search_serijski').val(null);
                     $('#cancels').hide();
                    $('#searchs').show();
                    $('#search_result_serijski').hide();
                });
                
                //  UPIS PODATAKA ODABRANOG KUPCA U POLJE
                $('#search_result_serijski').on("click", 'a', function(e){
                    e.preventDefault();
                    
                    var sprimka = $( this ).attr('name');
                   window.location = "primke.php?pregled_serijski=" + sprimka;

                    
                });
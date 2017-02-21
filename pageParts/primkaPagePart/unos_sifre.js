 var left_sifra = $('#box_sifra').position().left;
                var top_sifra = $('#box_sifra').position().top;
                var width_sifra = $('#box_sifra').width();


                $('#search_result_sifra').css('margin-top', '27px').css('width', width_sifra + 400).css('z-index', 4);

                //  PRETRAGA ZA KUPCEM
                $('#search_box_sifra').keyup(function () {
                    var value = $(this).val();

                    if (value != '') {
                        $('#search_result_sifra').show();
                        
                        //Ispis kupaca
                        $.post('search/pretrazi_sifru.php', {value: value}, function (sifra) {
                            console.log(sifra)
                            if(sifra){
                               //Prikaz pronađenih podataka
                            var output ='<ul >';
                            
                                output += '<li><a class="a" id="sifr" name="'+ value + '"> ';
                                output += '<i style= "display:none" id="sNaziv">'+ sifra.naziv +'</i>';
                                output += '<i style= "display:none" id="sBrand">'+ sifra.brand +'</i>';
                                output += '<i style= "display:none" id="sTip">'+ sifra.tip +'</i>';
                                output += sifra.naziv+', ' + sifra.brand + ', ' + sifra.tip +'</a></i>'
                            
                            
                            output +='</ul>';   //kraj ispis liste
                            
                            $('#search_result_sifra').html(output); 
                            }else{
                                $('#search_result_sifra').text('Nema rezultata');
                            }
                            
                            
                        }).fail(function(){ $('#search_result_sifra').text('Nema rezultata')});
                        
                    } else {
                        $('#search_result_sifra').hide();
                    }

                });
                //  KRAJ * PRETRAGA ZA KUPCEM * KRAJ
                
                //  UPIS PODATAKA ODABRANOG KUPCA U POLJE
                $('#search_result_sifra').on("click", "#sifr", function(e){
                    e.preventDefault();
                    $('#divInputSifra').show();
                    $('#inputSifra').val($(this).attr('name'));
                    $('#inputBrand').val($('#sBrand').text());
                    $('#inputNaziv').val($('#sNaziv').text());
                    $('#inputTip').append('<option selected>'+$('#sTip').text()+'</option');
                    
                    $('#search_box_sifra').val('');
                    $('#search_result_sifra').hide();
                    
                });
                //  KRAJ * UPIS PODATAKA ODABRANOG KUPCA U POLJE * KRAJ
                
                // ČIŠĆENJE SEARCH BOX-A
                  $('#search_button_sifra').click(function(e) {
                    e.preventDefault();
                    $("#search_box_sifra").val("");
                    $('#search_result_sifra').hide();
                  });
                  //  KRAJ * ČIŠĆENJE SEARCH BOX-A * KRAJ
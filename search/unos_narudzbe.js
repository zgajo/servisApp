
              
                
                var left = $('#box').position().left;
                var top = $('#box').position().top;
                var width = $('#box').width();


                $('#search_result').css('left', left).css('top', top + 27).css('margin-top', '27px').css('width', width + 400).css('z-index', 4);

                //  PRETRAGA ZA KUPCEM
                $('#search_box').keyup(function () {
                    var value = $(this).val();

                    if (value != '') {
                        $('#search_result').show();
                        
                        //Ispis kupaca
                        $.post('search/pretrazi_kupca.php', {value: value}, function (data) {
                            
                            //Dohvat json podataka
                            var primka = JSON.parse(JSON.stringify(data));
                            console.log(JSON.parse(JSON.stringify(data)));
                            
                            //Prikaz pronađenih podataka
                            var output ='<ul >';
                            for(var i=0; i < primka.length; ++i){
                                output += '<li><a class="a" id="k" name="'+ primka[i].id + '"> ';
                                if(primka[i].tvrtka) output += primka[i].tvrtka+', '; 
                                output += primka[i].ime+' ' + primka[i].prezime + ', ' + primka[i].grad +', ' + primka[i].adresa +'</a></li>'
                            } 
                            
                            output +='</ul>';   //kraj ispis liste
                            
                            $('#search_result').html(output);
                            
                        }).fail(function(){ $('#search_result').text('Nema rezultata')});
                        
                    } else {
                        $('#search_result').hide();
                    }

                });
                //  KRAJ * PRETRAGA ZA KUPCEM * KRAJ
                
                
                function upisKupca(idkupca){
                    $.post('json/kupac/dohvatiKupcaJson.php', {"id": idkupca}, function (data) {
                       console.log(JSON.parse(JSON.stringify(data)));
                        var osoba = JSON.parse(JSON.stringify(data));
                        $('#inputid').text(osoba.id);
                        if(osoba.tvrtka) { $('#inputTvrtka').val(osoba.tvrtka).prop( "disabled", true ) } else{ $('#inputTvrtka').val(null);$('#divTvrtka').hide();}
                        $('#inputIme').val(osoba.ime).prop( "disabled", true );
                        $('#inputPrezime').val(osoba.prezime).prop( "disabled", true );
                        $('#inputAdresa').val(osoba.adresa).prop( "disabled", true );
                        $('#inputGrad').val(osoba.grad).prop( "disabled", true );
                        $('#inputPB').val(osoba.postanskiBroj).prop( "disabled", true );
                        $('#inputKontakt').val(osoba.kontakt).prop( "disabled", true );
                        $('#inputEmail').val(osoba.email).prop( "disabled", true );
                        
                        $('#editBtn').show();
                        $('#editPonistiBtn').show();
        
                        $("#search_box").val("");
                        $('#search_result').hide();
                    });
                }
               
                $('#editPonistiBtn').click(function(){
                    $('#inputid').text(null);
                       $('#inputTvrtka').val(null).prop( "disabled", false );
                       $('#divTvrtka').show();
                        $('#inputIme').val(null).prop( "disabled", false );
                        $('#inputPrezime').val(null).prop( "disabled", false );
                        $('#inputAdresa').val(null).prop( "disabled", false );
                        $('#inputGrad').val(null).prop( "disabled", false );
                        $('#inputPB').val(null).prop( "disabled", false );
                        $('#inputKontakt').val(null).prop( "disabled", false );
                        $('#inputEmail').val(null).prop( "disabled", false );
                        
                        console.log('klik');
                        
                        $('#ponistiK').hide();
                        $('#spremiKupca').hide();
                        $('#editBtn').hide();
                        $(this).hide();
                });
                
                
                //  UPIS PODATAKA ODABRANOG KUPCA U POLJE
                $('#search_result').on("click", "#k", function(e){
                    e.preventDefault();
                    
                    var idkupca = $( this ).attr('name');
                    upisKupca(idkupca);

                    
                });
                //  KRAJ * UPIS PODATAKA ODABRANOG KUPCA U POLJE * KRAJ
                  
                  // ČIŠĆENJE SEARCH BOX-A
                  $('#search_button').click(function(e) {
                    e.preventDefault();
                    $("#search_box").val("");
                    $('#search_result').hide();
                  });
                  //  KRAJ * ČIŠĆENJE SEARCH BOX-A * KRAJ
                  
                  //   OMOGUĆAVANJE IZMJENE KUPCA
                  $('#editBtn').click(function (e){
                        e.preventDefault();
                        $('#divTvrtka').show().prop( "disabled", false );
                        $('#inputTvrtka').prop( "disabled", false );
                        $('#inputIme').prop( "disabled", false );
                        $('#inputPrezime').prop( "disabled", false );
                        $('#inputAdresa').prop( "disabled", false );
                        $('#inputGrad').prop( "disabled", false );
                        $('#inputPB').prop( "disabled",false );
                        $('#inputKontakt').prop( "disabled", false );
                        $('#inputEmail').prop( "disabled", false );
                        
                        $("#box").hide();
                        $('#submit').prop("disabled", true);
                        
                        $('#ponistiK').show();
                        $('#spremiKupca').show();
                        $('#editBtn').hide();
                         $('#editPonistiBtn').hide();
                        
                  });
                  //  KRAJ * OMOGUĆAVANJE IZMJENE KUPCA * KRAJ
                  
                  //    SPREMANJE IZMJENE KUPCA
                  $('#spremiKupca').click(function (e){
                      e.preventDefault();
                      
                      var tvrtka = $('#inputTvrtka').val();
                      var ime = $('#inputIme').val();
                      var prezime = $('#inputPrezime').val();
                      var adresa = $('#inputAdresa').val();
                      var grad = $('#inputGrad').val();
                      var pb = $('#inputPB').val();
                      var kontakt = $('#inputKontakt').val();
                      var email = $('#inputEmail').val();
                       var idkupca = $( '#inputid' ).text();
                       
                       $.post('json/kupac/updateKupca.php', {
                           "tvrtka" : tvrtka,
                           "ime":ime,
                           "prezime":prezime, 
                           "adresa" : adresa, 
                           "grad" : grad, 
                           "pb" : pb, 
                           "kontakt":kontakt, 
                           "email":email,
                           "id" : idkupca
                       });
                       
                       var idkupca = $( '#inputid' ).text();
                       upisKupca(idkupca);
                       
                        $("#box").show();
                        $('#submit').prop("disabled", false);
                        
                        $('#ponistiK').hide();
                        $('#spremiKupca').hide();
                        $('#editBtn').show();
                        
        
                        //alert('Trebam namjestiti ažuriranje podataka izmjena kupca');
                        $("#search_box").val("");
                        $('#search_result').hide();

                      
                  });
                  //  KRAJ * SPREMANJE IZMJENE KUPCA * KRAJ
                  
               
                  $('#ponistiK').on("click", this, function(){
                     upisKupca($('#inputid').text()); 
                     $("#spremiKupca").hide();
                     $("#ponistiK").hide();
                     $('#submit').prop("disabled", false);
                     $("#search_box").val("");
                        $('#search_result').hide();
                        $("#box").show();
                  });
                  
                  // UNOS NARUDŽBE
                   
                   $('#insertNarudzba').click(function (e){
                      e.preventDefault();
                      var idkupca = $('#inputid').text();
                      //kupac
                      var tvrtka = $('#inputTvrtka').val();
                      var ime = $('#inputIme').val();
                      var prezime = $('#inputPrezime').val();
                      var adresa = $('#inputAdresa').val();
                      var grad = $('#inputGrad').val();
                      var pb = $('#inputPB').val();
                      var kontakt = $('#inputKontakt').val();
                      var email = $('#inputEmail').val();
                      
                      //primka
                      var pro = $('#inputProizvod').val();
                      var dob = $('#inputDobavljac').val();
                      var vpc = $('#inputVPC').val();
                      var skl = $('#inputSkladiste').val();
                      var p = $('#inputPrimka').val();
                      var pn = $('#inputPN').val();
                      //  UKOLIKO SU PRAZNA BITNA POLJA
                      if(ime === '' || prezime === '' || kontakt === '' || pro === '' || vpc === '' || dob === '') {
                          alert('Molim vas da ispunite sva obavezna polja');
                      }
                    
                      //    
                      else{
                          var idkupca = $('#inputid').text();
                          
                          if(idkupca === '') {
                              if (confirm('Jeste li sigurni da želite unijeti upisane podatke?')) {
                                $.ajax({
                                 type: 'POST',
                                 url: "json/narudzbe/insert.php",
                                 data: {"dio":pro, "dob":dob, "vpc":vpc, "skl":skl, "p":p, "pn":pn, "stranka_id": idkupca,
                                 "tvrtka" : tvrtka, "ime":ime, "prezime":prezime, "adresa" : adresa, "grad":grad, "post_broj": pb, "kontakt_broj":kontakt, "email" : email},
                                 success: function (data) {
                                            window.location.href = "narudzbe.php";
                                
                                    },
                                    
                                    error: function (e) {
                                    alert('kvar pri upisu di je novi kupac');
                                        }
                                    });
                                } else {
                                    alert('Odustali ste od upisa podataka. Ispravite upis');
                                }
                              
                          }
                          else{ 
                              if (confirm('Jeste li sigurni da želite unijeti upisane podatke?')) {
                              $.ajax({
                                 type: 'POST',
                                 url: "json/narudzbe/insert.php",
                                 data: {"dio":pro, "dob":dob, "vpc":vpc, "skl":skl, "p":p, "pn":pn, "stranka_id": idkupca},
                                 success: function (nar) {
                                     
                                        
                                         window.location.href = "narudzbe.php";
                                        
                                    },
                                    
                                error: function (e) {
                                    alert(e.message);
                                }
                              });
                          }else {
                                    alert('Odustali ste od upisa podataka. Ispravite upis');
                                }
                              
                                };
                         
                      }
                      
                  });
                  //  KRAJ * UNOS PRIMKE * KRAJ
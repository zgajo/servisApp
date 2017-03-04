       function upisKupca(idkupca) {
           $.post('json/kupac/dohvatiKupcaJson.php', {
               "id": idkupca
           }, function (data) {
               console.log(JSON.parse(JSON.stringify(data)));
               var osoba = JSON.parse(JSON.stringify(data));
               $('#inputid').text(osoba.id);
               if (osoba.tvrtka) {
                   $('#inputTvrtka').val(osoba.tvrtka).prop("disabled", true)
               } else {
                   $('#inputTvrtka').val(null);
                   $('#divTvrtka').hide();
               }
               $('#inputIme').val(osoba.ime).prop("disabled", true);
               $('#inputPrezime').val(osoba.prezime).prop("disabled", true);
               $('#inputAdresa').val(osoba.adresa).prop("disabled", true);
               $('#inputGrad').val(osoba.grad).prop("disabled", true);
               $('#inputKontakt').val(osoba.kontakt).prop("disabled", true);
               $('#inputEmail').val(osoba.email).prop("disabled", true);

               $('#editBtn').show();
               $('#editPonistiBtn').show();

               $("#search_box").val("");
               $('#search_result').hide();
           });
       }



       //  PRETRAGA ZA PRIMKOM
       $('#search_box').keydown(function () {



           $(function () {

               $("#search_box").autocomplete({
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

                           },
                           error: function (e) {

                               var v = [{
                                   id: 0,
                                   value: 0,
                                   label: "Nema pronađenog kupca"
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

                       if (ui.item.id !== 0) upisKupca(ui.item.id);

                   }

               });

           });



       });


       $('#search_box').keyup(function () {

           if ($('#search_box').val() == '') {

           }
       })


       $('#editPonistiBtn').click(function () {
           $('#inputid').text(null);
           $('#inputTvrtka').val(null).prop("disabled", false);
           $('#divTvrtka').show();
           $('#inputIme').val(null).prop("disabled", false);
           $('#inputPrezime').val(null).prop("disabled", false);
           $('#inputAdresa').val(null).prop("disabled", false);
           $('#inputGrad').val(null).prop("disabled", false);
           $('#inputKontakt').val(null).prop("disabled", false);
           $('#inputEmail').val(null).prop("disabled", false);

           console.log('klik');

           $('#ponistiK').hide();
           $('#spremiKupca').hide();
           $('#editBtn').hide();
           $(this).hide();
       });


       //  UPIS PODATAKA ODABRANOG KUPCA U POLJE
       $('#search_result').on("click", "#k", function (e) {
           e.preventDefault();

           var idkupca = $(this).attr('name');
           upisKupca(idkupca);


       });
       //  KRAJ * UPIS PODATAKA ODABRANOG KUPCA U POLJE * KRAJ



       // ČIŠĆENJE SEARCH BOX-A
       $('#search_button').click(function (e) {
           e.preventDefault();
           $("#search_box").val("");
           $('#search_result').hide();
       });
       //  KRAJ * ČIŠĆENJE SEARCH BOX-A * KRAJ



       //   OMOGUĆAVANJE IZMJENE KUPCA
       $('#editBtn').click(function (e) {
           e.preventDefault();
           $('#divTvrtka').show().prop("disabled", false);
           $('#inputTvrtka').prop("disabled", false);
           $('#inputIme').prop("disabled", false);
           $('#inputPrezime').prop("disabled", false);
           $('#inputAdresa').prop("disabled", false);
           $('#inputGrad').prop("disabled", false);
           $('#inputKontakt').prop("disabled", false);
           $('#inputEmail').prop("disabled", false);

           $("#box").hide();
           $('#submit').prop("disabled", true);

           $('#ponistiK').show();
           $('#spremiKupca').show();
           $('#editBtn').hide();
           $('#editPonistiBtn').hide();

       });
       //  KRAJ * OMOGUĆAVANJE IZMJENE KUPCA * KRAJ

       //    SPREMANJE IZMJENE KUPCA
       $('#spremiKupca').click(function (e) {
           e.preventDefault();

           var tvrtka = $('#inputTvrtka').val();
           var ime = $('#inputIme').val();
           var prezime = $('#inputPrezime').val();
           var adresa = $('#inputAdresa').val();
           var grad = $('#inputGrad').val();
           var kontakt = $('#inputKontakt').val();
           var email = $('#inputEmail').val();
           var idkupca = $('#inputid').text();

           $.ajax({
               type: 'POST',
               url: 'json/kupac/updateKupca.php',
               data: {
                   "tvrtka": tvrtka,
                   "ime": ime,
                   "prezime": prezime,
                   "adresa": adresa,
                   "grad": grad,
                   "kontakt": kontakt,
                   "email": email,
                   "id": idkupca
               },
               success: function () {

                   upisKupca(idkupca);
               }
           });



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


       $('#ponistiK').on("click", this, function () {
           upisKupca($('#inputid').text());
           $("#spremiKupca").hide();
           $("#ponistiK").hide();
           $('#submit').prop("disabled", false);
           $("#search_box").val("");
           $('#search_result').hide();
           $("#box").show();
       });

       // UNOS PRIMKE

       $('#submit').on("click", function (e) {
           e.preventDefault();
           $('#inputIme').removeAttr('style');
           $('#inputPrezime').removeAttr('style');
           $('#inputKontakt').removeAttr('style');
           $('#inputNaziv').removeAttr('style');
           $('#inputPK').removeAttr('style');
           $('#inputBrand').removeAttr('style');

           //kupac
           var tvrtka = $('#inputTvrtka').val();
           var ime = $('#inputIme').val();
           var prezime = $('#inputPrezime').val();
           var adresa = $('#inputAdresa').val();
           var grad = $('#inputGrad').val();
           var kontakt = $('#inputKontakt').val();
           var email = $('#inputEmail').val();

           //primka
           var pk = $('#inputPK').val();
           var naziv = $('#inputNaziv').val();
           var sifra = $('#inputSifra').val();
           var brand = $('#inputBrand').val();
           var tip = $('#inputTip').val();
           var serijski = $('#inputSerijski').val();
           var dat_k = $('#inputDK').val();
           var racun = $('#inputRacun').val();
           var opis = $('#inputPK').val();
           var prilozeno = $('#inputPP').val();

           //  UKOLIKO SU PRAZNA BITNA POLJA
           if (ime === '' || prezime === '' || kontakt === '' || pk === '' || naziv === '' || brand === '') {
               if (ime === '') $('#inputIme').css('border', '2px solid red');
               if (prezime === '') $('#inputPrezime').css('border', '2px solid red');
               if (kontakt === '') $('#inputKontakt').css('border', '2px solid red');
               if (pk === '') $('#inputPK').css('border', '2px solid red');
               if (naziv === '') $('#inputNaziv').css('border', '2px solid red');
               if (brand === '') $('#inputBrand').css('border', '2px solid red');

               alert('Molim vas da ispunite sva obavezna polja');
           }

           //
           else {
               var idkupca = $('#inputid').text();

               if (idkupca === '') {
                   if (confirm('Jeste li sigurni da želite unijeti upisane podatke?')) {
                       $.ajax({
                           async: false,
                           type: 'POST',
                           url: "json/primka/insertPrimka.php",
                           data: {
                               "sifra": sifra,
                               "brand": brand,
                               "tip": tip,
                               "naziv": naziv,
                               "serijski": serijski,
                               "opis": opis,
                               "prilozeno": prilozeno,
                               "racun": racun,
                               "dk": dat_k,
                               "stranka_id": idkupca,
                               "tvrtka": tvrtka,
                               "ime": ime,
                               "prezime": prezime,
                               "adresa": adresa,
                               "grad": grad,
                               "kontakt_broj": kontakt,
                               "email": email
                           },
                           success: function (data) {
                               var primkaID = JSON.parse(JSON.stringify(data));

                               window.open('ispis/potvrda_zaprimanja.php?primka=' + primkaID, '_blank', "location=1,status=1,scrollbars=1, resizable=1, directories=1, toolbar=1, titlebar=1, width=800, height=800");

                               window.location.href = "primke.php";
                           },

                           error: function (e) {
                               alert(e.message);
                           }
                       });
                   } else {
                       alert('Odustali ste od upisa podataka. Ispravite upis');
                   }

               } else {
                   if (confirm('Jeste li sigurni da želite unijeti upisane podatke?')) {
                       $.ajax({
                           async: false,
                           type: 'POST',
                           url: "json/primka/insertPrimka.php",
                           data: {
                               "sifra": sifra,
                               "brand": brand,
                               "tip": tip,
                               "naziv": naziv,
                               "serijski": serijski,
                               "opis": opis,
                               "prilozeno": prilozeno,
                               "racun": racun,
                               "dk": dat_k,
                               "stranka_id": idkupca
                           },
                           success: function (data) {
                               var primkaID = JSON.parse(JSON.stringify(data));

                               window.open('ispis/potvrda_zaprimanja.php?primka=' + primkaID, '_blank', "location=1,status=1,scrollbars=1, resizable=1, directories=1, toolbar=1, titlebar=1, width=800, height=800");

                               window.location.href = "primke.php";

                           },

                           error: function (e) {
                               alert(e.message);
                           }
                       });
                   } else {
                       alert('Odustali ste od upisa podataka. Ispravite upis');
                   }

               };

           }

       });
       //  KRAJ * UNOS PRIMKE * KRAJ

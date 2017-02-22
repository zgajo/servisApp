<script>
                $("#uk").attr('title', 'Otvori formu za izmjenu podataka kupca');
                $("#up").attr('title', 'Otvori formu za izmjenu podataka primke');
                $(document).ready(function () {

                    var pid = <?php echo $_GET['primka'] ?>
                    
                    funPrimka();

                    function funPrimka() {
                        // Dohvaćanje i pregled upita
                        $.ajax({
                            type: 'GET',
                            url: "json/primka/getById.php",
                            data: {"id": pid},
                            dataType: 'json',
                            contentType: "application/json; charset=utf-8",
                            success: function (data) {
console.log(data);
                                var pp = JSON.parse(JSON.stringify(data));

                                var dz = new Date(pp[0].datumZaprimanja);
                                var dk = new Date(pp[0].datumKupnje);
                                var dztv = new Date(pp[0].datumZatvaranja);

                                // PODACI KUPCA

                                $('#ip_kupca').text(pp[0].ime + ' ' + pp[0].prezime);
                                $('#tvrtka').text(pp[0].tvrtka).show();
                                $('#kontakt').text(pp[0].kontaktBroj);
                                $('#email').after('');
                                if(pp[0].email) $('#email').text(pp[0].email); else{ $('#email').hide()};
                                $('#grad').text(pp[0].grad);
                                $('#adresa').text(pp[0].adresa);

                                //     PODACI PRIMKE

                                $('#zap').text([dz.getDate(), dz.getMonth() + 1, dz.getFullYear()].join('.') + ' /  ' + [(dz.getHours() < 10 ? '0' : '') + dz.getHours(), (dz.getMinutes() < 10 ? '0' : '') + dz.getMinutes()].join(':'));
                                $('#po').text(pp[0].pot_ime + ' ' + pp[0].pot_prezime);
                                $('#nu').text(pp[0].naziv);
                                $('#serijski').text(pp[0].serial);
                                $('#brand').text(pp[0].brand);
                                $('#tip').text(pp[0].tip);
                                (dk.getFullYear()!='1970' && dk) ? $('#dk').text([dk.getDate(), dk.getMonth() + 1, dk.getFullYear()].join('.')) :  $('#dk').text() ;
                                $('#br').text(pp[0].racun);
                                $('#ok').text(pp[0].opisKvara);
                                $('#pp').text(pp[0].prilozeno_primijeceno);
                                
                                 var st = pp[0].p_status;

                                if(st.substring(0,12) !="Poslano u CS"){
                                // POSTAVLJANJE ZA SELECTED
                                var o = new Option(st, st);
                                /// jquerify the DOM object 'o' so we can use the html method
                                $(o).html(st);
                                $("#status_primke").append(o);
                                $('#status_primke option[value="' + st + '"]').attr("selected", true);
                            }
                            else{
                                var o = new Option(st, st);
                                /// jquerify the DOM object 'o' so we can use the html method
                                $(o).html(st);
                                $("#status_primke").append(o);
                                $('#status_primke option[value="' + st + '"]').attr("selected", true);
                               $("#status_primke").prop("disabled", true); 
                            }
                                    
                                $('#inputTvrtka').val(pp[0].tvrtka);
                                $('#inputIme').val(pp[0].ime);
                                $('#inputPrezime').val(pp[0].prezime);
                                $('#inputAdresa').val(pp[0].adresa);
                                $('#inputGrad').val(pp[0].grad);
                                $('#inputPB').val(pp[0].postBroj);
                                $('#inputKontakt').val(pp[0].kontaktBroj);
                                $('#inputEmail').val(pp[0].email);
                                $('#inputid').text(pp[0].stranka_id);

                                //primka u input
                                $('#inputPK').val(pp[0].opisKvara);
                                $('#inputNaziv').val(pp[0].naziv);
                                $('#inputSifra').val(pp[0].sifraUredaja);
                                $('#inputBrand').val(pp[0].brand);
                                $('#inputTip').append('<option selected>'+pp[0].tip+'</option>');
                                $('#inputSerijski').val(pp[0].serial);
                                if (dk.getFullYear()!='1970' && dk)
                                    $('#inputDK').val([dk.getDate(), dk.getMonth() + 1, dk.getFullYear()].join('.'));
                                $('#inputRacun').val(pp[0].racun);
                                $('#inputPP').val(pp[0].prilozeno_primijeceno);

                                //  AKO JE KUPAC PREUZEO PRIMKU
                                if (pp[0].p_status == 'Kupac preuzeo' || pp[0].p_status == 'Ekološki zbrinuto') {
                                    $('#skp').show();

                                    $('#azurirajDiv').hide();
                                    $('#pregledFooter').hide();
                                    $('#uk').hide();
                                    $('#up').hide();

                                    $('#zav').text([dztv.getDate(), dztv.getMonth() + 1, dztv.getFullYear()].join('.') + ' /  ' + [(dztv.getHours() < 10 ? '0' : '') + dztv.getHours(), (dztv.getMinutes() < 10 ? '0' : '') + dztv.getMinutes()].join(':')).show();
                                    $('#pz').text(pp[0].pzt_ime + ' ' + pp[0].pzt_prezime).show();
                                    $('#st').text(pp[0].p_status);
                                }


                                //  ISPIS RADNIH I RMA NALOGA KOJI SU POVEZANI SA PRIMKOM
                                $.post("json/rn/getRNbyPrimka.php", {"primka": pid}, function (e) {

                                    var rn = JSON.parse(JSON.stringify(e));

                                    var output = '';

                                    if (rn !== null && rn.length > 0) {
                                        for (var i = 0; i < rn.length; ++i) {

                                            var rnp = new Date(rn[i].pocetak);
                                            var rnz = new Date(rn[i].zavrsetak);

                                            output += '<div class="col-md-6" style="width: 100%">' +
                                                    '<div class="box box-info" style="border-top-color:#00a65a">' +
                                                    '<div class="box-body" style="clear: both">' +
                                                    '<div class="box-header with-border">' +
                                                    '<h3 class="box-title">Radni nalog servisa br. ' + rn[i].id + '</h3> ' +
                                                    '</div>' +
                                                    '<div   class="col-md-6 invoice-col" style="width:100%" >' +
                                                    '<address>' +
                                                    '<i><strong>Početak rada: </strong></i>' + [rnp.getDate(), rnp.getMonth() + 1, rnp.getFullYear()].join('.') + ' /  ' + [(rnp.getHours() < 10 ? '0' : '') + rnp.getHours(), (rnp.getMinutes() < 10 ? '0' : '') + rnp.getMinutes()].join(':') + '<br>' +
                                                    '<i><strong>Rad započeo: </strong></i></strong>' + rn[i].d1ime + ' ' + rn[i].d1prezime + '<br>' +
                                                    '<i><strong>Opis popravka: </strong></i></strong>';
                                            output += (rn[i].opis) ? rn[i].opis : "";
                                            output += "<hr><i><strong>Status radnog naloga: </strong></i>"; output += (rn[i].status) ?rn[i].status:'' ;
                                            output += '<hr>' +
                                                    '<i><strong>Naplatiti: </strong></i></strong>';
                                            output += (rn[i].naplata) ? rn[i].naplata : "";
                                            output += '<br>' +
                                                    '<i><strong>Rad završio: </strong></i></strong>';
                                            output += (rn[i].d2ime) ? rn[i].d2ime + ' ' + rn[i].d2prezime : "";
                                            output += '<br>' +
                                                    '<i><strong>Završetak rada: </strong></i> </strong>';
                                            output += (rnz && rnz.getFullYear() != "1970") ? [rnz.getDate(), rnz.getMonth() + 1, rnz.getFullYear()].join('.') + ' /  ' + [(rnz.getHours() < 10 ? '0' : '') + rnz.getHours(), (rnz.getMinutes() < 10 ? '0' : '') + rnz.getMinutes()].join(':') : "";
                                            output += '<br>' +
                                                    '</address>' +
                                                    ' </div>' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '</div>';

                                        }
                                        $('#urn').html(output);
                                    }


                                });

                                $.get("json/rma/getRmaByPrimka.php", {"primka": pid}, function (e) {

                                    var rma = JSON.parse(JSON.stringify(e));

                                    var output = '';

                                    output += $('#urn').html();

                                    if (rma !== null && rma.length > 0) {
                                        for (var i = 0; i < rma.length; ++i) {

                                            var rnp = new Date(rma[i].pripremljeno);
                                            var rnpos = new Date(rma[i].poslano);
                                            var rnvr = new Date(rma[i].zavrseno);

                                            output += '<div class="col-md-6" style="width: 100%">' +
                                                    '<div class="box box-info" style="border-top-color:#ec971f">' +
                                                    '<div class="box-body" style="clear: both">' +
                                                    '<div class="box-header with-border">' +
                                                    '<h3 class="box-title">RMA nalog br. ' + rma[i].id + ' </h3>' +
                                                    ' </div>' +
                                                    '<div  class="col-md-6 invoice-col" style="width:100%"  >' +
                                                    '<address>' +
                                                    '<i><strong>Pripremljeno za slanje: </strong></i>' + [rnp.getDate(), rnp.getMonth() + 1, rnp.getFullYear()].join('.') + ' /  ' + [(rnp.getHours() < 10 ? '0' : '') + rnp.getHours(), (rnp.getMinutes() < 10 ? '0' : '') + rnp.getMinutes()].join(':') + '<br>' +
                                                    '<i><strong>Poslano u ovlašteni servis: </strong></i>   </strong>';
                                            output += (rnpos && rnpos.getFullYear() != "1970" && !isNaN(rnpos)) ? [rnpos.getDate(), rnpos.getMonth() + 1, rnpos.getFullYear()].join('.') + ' /  ' + [(rnpos.getHours() < 10 ? '0' : '') + rnpos.getHours(), (rnpos.getMinutes() < 10 ? '0' : '') + rnpos.getMinutes()].join(':') : "";
                                            output += '<br>' +
                                                    '<i><strong>Uređaj poslao:  </strong></i>   </strong>' + rma[i].doime + ' ' + rma[i].doprezime + '<hr>' +
                                                    '<i><strong>Ovlašteni servis: </strong></i> </strong>'; 
                                            output +=  (rma[i].nazivOS) ? rma[i].nazivOS  : '';
                                            output += '<br>' +
                                                    '<i><strong>Radni nalog ovlaštenog servisa: </strong></i>  </strong>' + rma[i].rnOs + '<br>' +
                                                    '<i><strong>Opis popravka: </strong></i>   </strong> ' + rma[i].opis + '<br>                ' +
                                                    '<i><strong>Status reklamacije: </strong></i>   </strong>' + rma[i].status + '<hr>' +
                                                    ' <i><strong>Vraćeno iz ovlaštenog servisa: </strong></i> </strong>';
                                            output += (rnvr && rnvr.getFullYear() != "1970") ? [rnvr.getDate(), rnvr.getMonth() + 1, rnvr.getFullYear()].join('.') + ' /  ' + [(rnvr.getHours() < 10 ? '0' : '') + rnvr.getHours(), (rnvr.getMinutes() < 10 ? '0' : '') + rnvr.getMinutes()].join(':') : "";
                                            output += '<br><i><strong>Zatvorio nalog: </strong></i>  </strong>';
                                            output += (rma[i].dzime) ? rma[i].dzime + ' ' + rma[i].dzprezime : "";
                                            output += '<br>' +
                                                    '<i><strong>Naplatiti: </strong></i>  </strong>' + rma[i].naplata + '<br>' +
                                                    '</address>' +
                                                    '</div>' +
                                                    '</div>' +
                                                    ' </div>' +
                                                    '</div>';

                                        }
                                        $('#urn').html(output);
                                    }

                                });
                                //  KRAJ    *   ISPIS RADNIH I RMA NALOGA KOJI SU POVEZANI SA PRIMKOM   *   KRAJ

                                $('#urn').show();
                                $('#upr').show();
                                $('#uredi_kupca').hide();
                                $('#uredi_primku').hide();




                            },
                            error: function (e) {
                                alert(e.message);
                            }
                        });

                    }
                    //Ažuriranje upita
                    $('#azuriraj_status').on("click", this, function () {

                        var status = $('select').val();
                        if(confirm('Ažurirati status u: "'+status+'"?'))    
                        $.ajax({
                            async: false,
                            url: "json/primka/primkaStatusUpdate.php",
                            type: "POST",
                            data: {
                                "status": status, "id": pid
                            },
                            success: function (e) {
                                if(status == 'Poslano u CS - Rovinj'){
                                    var ruc = window.open('rucne.php?primka='+pid, '_blank');
                                if (ruc) {
                                                        //Browser has allowed it to be opened
                                                        ruc.focus();
                                                    } else {
                                                        //Browser has blocked it
                                                        alert('Molim Vas, omogućite prikaz skočnih prozora');
                                                    }
                                                }
                                               
                                window.location = "primke.php";
                            },
                            error: function (e) {
                                alert('nije u redu' + e);
                            }
                        });

                    });


                    

                    $('#btnNovo').click(function () {


                        $('#novo').toggle();

                    });


                    //    SPREMANJE IZMJENE KUPCA
                    $('#spremiKupca').click(function (e) {
                        e.preventDefault();

                        var tvrtka = $('#inputTvrtka').val();
                        var ime = $('#inputIme').val();
                        var prezime = $('#inputPrezime').val();
                        var adresa = $('#inputAdresa').val();
                        var grad = $('#inputGrad').val();
                        var pb = $('#inputPB').val();
                        var kontakt = $('#inputKontakt').val();
                        var email = $('#inputEmail').val();
                        var idkupca = $('#inputid').text();

                        if (ime === '' || prezime === '' || kontakt === '') {
                            alert('Molim vas da ispunite sva polja');
                        } else {
                            $.post('json/kupac/updateKupca.php', {
                                "tvrtka": tvrtka,
                                "ime": ime,
                                "prezime": prezime,
                                "adresa": adresa,
                                "grad": grad,
                                "pb": pb,
                                "kontakt": kontakt,
                                "email": email,
                                "id": idkupca
                            }, function(data){funPrimka()});
                            

                            $('#upr').show();
                            $('#uredi_kupca').hide();
                            $('#urn').show();

                        }

                    });
                    //  KRAJ * SPREMANJE IZMJENE KUPCA * KRAJ
                    
                    
                    $('#narudzba').click(function(){
                    var pr= <?php echo $_GET['primka'] ?>;
                    window.location = "narudzbe.php?primka="+pr+"&stranka="+$('#inputid').text();
                    })



                    //   SPREMANJE IZMJENE PRIMKE
                    $('#spremiPrimku').click(function () {
                        //primka
                        var naziv = $('#inputNaziv').val();
                        var sifra = $('#inputSifra').val();
                        var brand = $('#inputBrand').val();
                        var tip = $('#inputTip  option:selected').text();
                        var serijski = $('#inputSerijski').val();
                        var dat_k = $('#inputDK').val();
                        var racun = $('#inputRacun').val();
                        var opis = $('#inputPK').val();
                        var prilozeno = $('#inputPP').val();

                        if (opis === '' || naziv === '') {
                            alert('Molim vas da ispunite obavezna sva polja');
                        } else {
                            $.post("json/primka/updatePrimka.php", {
                                "su": sifra, "b": brand, "t": tip, "n": naziv, "s": serijski,
                                "ok": opis, "pp": prilozeno, "r": racun, "dk": dat_k, "id": pid
                            });

                            $('#nu').text(naziv);
                            $('#serijski').text(serijski);
                            $('#brand').text(brand);
                            $('#tip').text(tip);
                            $('#dk').text(dat_k);
                            $('#br').text(racun);
                            $('#ok').text(opis);
                            $('#pp').text(prilozeno);

                            $('#urn').show();
                            $('#upr').show();
                            $('#uredi_primku').hide();
                        }



                    });


                    //   KRAJ    *   SPREMANJE IZMJENE PRIMKE   *   KRAJ

                    //  OMOGUĆAVANJE UREĐIVANJE KUPCA / PRIMKE

                    $('#uk').click(function () {
                        $('#upr').hide();
                        $('#uredi_kupca').show();
                        $('#urn').hide();
                    });

                    $('#ponistiK').click(function () {
                        $('#status_primke option:last-child').remove();
                        
                        funPrimka();
                         

                    });

                    $('#up').click(function () {
                        $('#upr').hide();
                        $('#uredi_primku').show();
                        $('#urn').hide();
                    });

                    $('#ponistiUK').click(function () {
                        
                        $('#status_primke option:last-child').remove();
                        funPrimka();
                        
                        
                    });

                    //  KRAJ    *   OMOGUĆAVANJE UREĐIVANJE KUPCA / PRIMKE   *   KRAJ


                });
            </script>
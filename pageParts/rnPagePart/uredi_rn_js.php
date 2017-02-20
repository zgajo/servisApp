 <script>
            
            //Poruka pri hoveru na gumb izmjene

            $("#uk").attr('title', 'Otvori formu za izmjenu podataka kupca');
            $("#up").attr('title', 'Otvori formu za izmjenu podataka primke');
                        $(document).ready(function (){
                            
                            var rnid = <?php echo $_GET['radni_nalog'] ?>;
                            
                            
                           upisrn();
                           upisprik();
                            
                          //        UPIS RADNOG NALOGA
                        function upisrn(){
                               $.post("json/rn/getById.php", {"id":rnid},  function(rn){
                               
                               var pocetak = new Date(rn[0].pocetakRada);
                               var zavrseno = new Date(rn[0].danZavrsetka);
                               //   UPIS RADNOG NALOGA
                               $('#pocetak').text([pocetak.getDate(), pocetak.getMonth()+1, pocetak.getFullYear()].join('.') + ' / ' + [((pocetak.getHours()<10) ? '0':'') + pocetak.getHours(), (pocetak.getMinutes()<10?'0':'') + pocetak.getMinutes()].join(':'));
                               $('#zapoceo').text(rn[0].zapoceoRn_ime + ' ' + rn[0].zapoceoRn_prezime);
                               $('#inputPopravak').val(rn[0].opisPopravka);
                               $('#inputNapomena').val(rn[0].napomena);
                               $('#inputNaplata').val(rn[0].naplata);
                               $('#inputPromijenjeno').val(rn[0].promijenjeno);
                               $('#inputBI').val(rn[0].broj_ispisa);
                               $('#status_rn').val(rn[0].status);
                              if(zavrseno && zavrseno.getFullYear()!="1970") {
                                   $('#zavrseno').text([zavrseno.getDate(), zavrseno.getMonth()+1, zavrseno.getFullYear()].join('.') + ' / ' + [((zavrseno.getHours()<10) ? '0':'') + zavrseno.getHours(), (zavrseno.getMinutes()<10?'0':'') + zavrseno.getMinutes()].join(':'));
                                   $('#zr').show();
                               }
                               if(rn[0].zavrsioRn_ime !== '' && rn[0].zavrsioRn_ime !== null) {
                                   $('#zavrad').show();
                                   $('#zavrsio').text(rn[0].zavrsioRn_ime + ' ' + rn[0].zavrsioRn_prezime);
                               }
                               
                               
                                }
                            );
                           }
                           
                           
                           //       UPIS PRIMKE
                          function  upisprik(){
                              $.post("json/rn/getById.php", {"id":rnid},  function(rn){
                                  
                               $.get("json/primka/getById.php", {"id": rn[0].primka_id}, function(primka){
                                   
                                    var dz = new Date(primka[0].datumZaprimanja);
                                   var dk = new Date(primka[0].datumKupnje);
                                   // PODACI KUPCA
                                    
                                    $('#ip_kupca').text(primka[0].ime + ' ' + primka[0].prezime);
                                     $('#tvrtka').text(primka[0].tvrtka).show();
                                     $('#kontakt').text(primka[0].kontaktBroj);
                                     $('#email').after('');
                                     if(primka[0].email) $('#email').text(primka[0].email); else{ $('#email').hide()};
                                     $('#grad').text(primka[0].grad);
                                     $('#adresa').text(primka[0].adresa);
                                     
                                     $('#inputid').text(primka[0].stranka_id);
                                        $('#inputTvrtka').val(primka[0].tvrtka);
                                        $('#inputIme').val(primka[0].ime);
                                        $('#inputPrezime').val(primka[0].prezime);
                                        $('#inputAdresa').val(primka[0].adresa);
                                        $('#inputGrad').val(primka[0].grad);
                                        $('#inputKontakt').val(primka[0].kontaktBroj);
                                        $('#inputEmail').val(primka[0].email);
                        
                                     
                                     //     PODACI PRIMKE
                                     $('#primkanaslov').text('Primka ' + primka[0].primka_id);
                                     $('#zap').text([dz.getDate(), dz.getMonth()+1, dz.getFullYear()].join('.') +' /  '+[(dz.getHours()<10?'0':'') + dz.getHours(), (dz.getMinutes()<10?'0':'') + dz.getMinutes()].join(':'));
                                     $('#po').text(primka[0].pot_ime + ' ' + primka[0].pot_prezime);
                                     $('#nu').text(primka[0].naziv);
                                     $('#serijski').text(primka[0].serial);
                                     $('#brand').text(primka[0].brand);
                                     $('#tip').text(primka[0].tip);
                                     (dk.getFullYear()=='1970') ? $('#dk').text() : $('#dk').text([dk.getDate(), dk.getMonth()+1, dk.getFullYear()].join('.'));
                                     $('#br').text(primka[0].racun);
                                     $('#ok').text(primka[0].opisKvara);
                                     $('#pp').text(primka[0].prilozeno_primijeceno);
                                     $('#st').text(primka[0].p_status);
                                     $('#primka_id').text(primka[0].primka_id);
                                     
                                     if(primka[0].p_status == 'Kupac preuzeo') {
                                                $('#status_rn').prop('disabled', true);
                                                $('#azuriraj_status').hide();
                                                $('#rucna').hide();
                                            }
                                     
                                     $('#inputPK').val(primka[0].opisKvara);
                                $('#inputNaziv').val(primka[0].naziv);
                                $('#inputSifra').val(primka[0].sifraUredaja);
                                $('#inputBrand').val(primka[0].brand);
                                $('#inputTip').val(primka[0].tip);
                                $('#inputSerijski').val(primka[0].serial);
                                var dk = new Date(primka[0].datumKupnje);
                                if (!isNaN(dk.getDate()) && dk.getFullYear()!='1970')
                                    $('#inputDK').val([dk.getDate(), dk.getMonth() + 1, dk.getFullYear()].join('.'));
                                $('#inputRacun').val(primka[0].racun);
                                $('#inputPP').val(primka[0].prilozeno_primijeceno);
                                   $('#pid').text(primka[0].primka_id);
                                     
                                     
                               }
                                );
                           });
                               
                          }
                           
                           
                           
                           
                            //Ažuriranje upita
                            $('#azuriraj_status').on("click", this, function(){
                            
                            var status_primke = $('#st').text();
                            var primka_id = $('#primka_id').text();
                            var status = $('select').val();
                            var trazi = status_primke.substring(0,12);
                            if(confirm('Ažurirati radni nalog?')) { 
                            //  UKOLIKO SE ZATVARA RADNI NALOG
                            if(status === "Popravak završen u jamstvu"  || status === "Popravak završen van jamstva" || status === 'Stranka odustala od popravka'  || status === 'Uređaj zamijenjen novim' || status === "Odobren povrat novca" || status === "DOA - Uređaj zamijenjen novim" || status === "DOA - Odobren povrat novca"){
                               
                                    $.post("json/rn/zatvori.php", 
                                            {"id":rnid, 
                                            "status": status, 
                                            "popravak": $('#inputPopravak').val(), 
                                            "napomena": $('#inputNapomena').val(),
                                            "naplata" : $("inputNaplata").val(),
                                            "ispisano" : $('#inputBI').val(),
                                            "promijenjeno" : $('#inputPromijenjeno').val()
                                        }
                                        );
                                        
                                        //  AŽURIRANJE STATUSA PRIMKE ako je servis završen
                                        if(trazi === "Poslano u CS") { 
                                            $.post("json/primka/primkaStatusUpdate.php", {"status": status + " - vraćeno u centar", "id":primka_id}, function(){
                                                
                                                upisrn(rnid);
                                                upisprik(rnid);
                                                 upisrn(rnid);
                                                upisprik(rnid);
                                                
                                                var ruc = window.open('rucne.php?primka='+primka_id, '_blank');
                                                var pre = window.open('pregled.php?primka='+primka_id, '_blank');
                                                    if (ruc) {
                                                        //Browser has allowed it to be opened
                                                        ruc.focus();
                                                        pre.focus();
                                                    } else {
                                                        //Browser has blocked it
                                                        alert('Molim Vas, omogućite prikaz skočnih prozora');
                                                    }
                                                    

                                            });
                                        }else{
                                             
                                           $.post("json/primka/primkaStatusUpdate.php", {"status": status, "id":primka_id}, function(){
                                                
                                                upisrn(rnid);
                                                upisprik(rnid);
                                                 upisrn(rnid);
                                                upisprik(rnid);
                                                var pre = window.open('pregled.php?primka='+primka_id, '_blank');
                                                    if (pre) {
                                                        //Browser has allowed it to be opened
                                                        pre.focus();
                                                    } else {
                                                        //Browser has blocked it
                                                        alert('Molim Vas, omogućite prikaz skočnih prozora');
                                                    }

                                            });
                                        }
                                        //  KRAJ *  AŽURIRANJE STATUSA PRIMKE   *   KRAJ
                                }
                                // KRAJ *   ZATVARANJE RADNOG NALOGA    *   KRAJ
                                
                                //  AŽURIRAJ STATUSE
                            else{
                                    $.post("json/rn/azuriraj.php", 
                                            {"id":rnid, 
                                            "status": status, 
                                            "popravak": $('#inputPopravak').val(), 
                                            "napomena": $('#inputNapomena').val(),
                                            "naplata" : $("inputNaplata").val(),
                                            "ispisano" : $('#inputBI').val(),
                                            "promijenjeno" : $('#inputPromijenjeno').val()
                                        }
                                        );
                                
                                    //  AŽURIRANJE STATUSA PRIMKE
                                        if(trazi === "Poslano u CS") { 
                                            $.post("json/primka/primkaStatusUpdate.php", {"status": "Poslano u CS - Rovinj / "+status, "id":primka_id}, function(){
                                                
                                                upisrn(rnid);
                                                upisprik(rnid);
                                                 upisrn(rnid);
                                                upisprik(rnid);

                                            });
                                        }else{
                                           $.post("json/primka/primkaStatusUpdate.php", {"status": status, "id":primka_id}, function(){
                                                
                                                upisrn(rnid);
                                                upisprik(rnid);
                                                 upisrn(rnid);
                                                upisprik(rnid);

                                            });
                                        }
                                    
                                
                                }
                             //  KRAJ    *   AŽURIRAJ STATUSE    *   KRAJ
                         }
                            });
                            
                    $('#uk').click(function () {
                        $('#upr').hide();
                        $('#uredi_kupca').show();
                        $('#urn').hide();
                    });

                    $('#ponistiK').click(function () {
                        upisprik();
                        $('#upr').show();
                        $('#uredi_kupca').hide();
                        $('#urn').show();

                    });

                    $('#up').click(function () {
                        $('#upr').hide();
                        $('#uredi_primku').show();
                        $('#urn').hide();
                    });

                    $('#ponistiUK').click(function () {
                        upisprik();
                        $('#upr').show();
                        $('#uredi_primku').hide();
                        $('#urn').show();
                    });
                    
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

                        if (ime === '' || prezime === '' || kontakt === '') {
                            alert('Molim vas da ispunite sva polja');
                        } else {
                            $.post('json/kupac/updateKupca.php', {
                                "tvrtka": tvrtka,
                                "ime": ime,
                                "prezime": prezime,
                                "adresa": adresa,
                                "grad": grad,
                                "kontakt": kontakt,
                                "email": email,
                                "id": idkupca
                            });
                            upisprik();
                            upisprik();
                        $('#upr').show();
                        $('#uredi_kupca').hide();
                        $('#urn').show();
                    }

                    });
                    
                    //   SPREMANJE IZMJENE PRIMKE
                    $('#spremiPrimku').click(function () {
                        //primka
                        var naziv = $('#inputNaziv').val();
                        var sifra = $('#inputSifra').val();
                        var brand = $('#inputBrand').val();
                        var tip = $('#inputTip').val();
                        var serijski = $('#inputSerijski').val();
                        var dat_k = $('#inputDK').val();
                        var racun = $('#inputRacun').val();
                        var opis = $('#inputPK').val();
                        var prilozeno = $('#inputPP').val();
                        
                        if (opis === '' || naziv === '') {
                            alert('Molim vas da ispunite obavezna sva polja');
                        } else {
                            var pid = $('#pid').text();
                            
                            $.post("json/primka/updatePrimka.php", {
                                "su": sifra, "b": brand, "t": tip, "n": naziv, "s": serijski,
                                "ok": opis, "pp": prilozeno, "r": racun, "dk": dat_k, "id": pid
                            });
                            upisprik();
                            upisprik();

                        $('#upr').show();
                        $('#uredi_primku').hide();
                        $('#urn').show();
                        
                        }



                    });
                    
                            
                                                       
                        });
                        </script>
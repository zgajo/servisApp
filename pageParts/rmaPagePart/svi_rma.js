           
                //    LISTANJE SVIH OTVORENIH PRIMKI
                var podaci;
                if (odjel === "Servis" || odjel === "Reklamacije") {
                    podaci = "json/primka/svePrimkeRNServis.php";
                } else {
                    podaci = "json/primka/sveOtvorenePrimke.php";
                }
                $('#sviRMA').on("mouseover", "tr", function () {
                    $(this).find('a').show();
                });
                $('#sviRMA').on("mouseout", "tr", function () {
                    $(this).find('a').hide();
                });

                $.ajax({
                    type: 'POST',
                    url: podaci,
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (data) {

                        var primka = JSON.parse(JSON.stringify(data));

                        var danas = new Date();

                        var output = "";
                        for (var i = 0; i < primka.length; ++i) {
                            var datum = new Date(primka[i].datumZaprimanja);
                            var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds

                            var diffDays = Math.round(Math.abs((danas.getTime() - datum.getTime()) / (oneDay)));

                            if (diffDays <= 15)
                                var sty = "label label-success";
                            if (diffDays > 15 && diffDays <= 30)
                                var sty = "label label-warning";
                            if (diffDays > 30)
                                var sty = "label label-danger";

                            var rma = null;

                            $.ajax({
                                async: false,
                                url: "json/rma/getRmaByPrimka.php",
                                type: 'GET',
                                data: {"primka": primka[i].primka_id},
                                dataType: 'json',
                                contentType: "application/json; charset=utf-8",
                                success: function (data) {

                                    rma = data;

                                },
                                error: function () {
                                    console.log("greška");
                                }
                            });

                            if (rma !== null && rma.length > 0) {
                                console.log(rma);



                                output += '<tr>';

                                output += '<td><span class="' + sty + '">Primka ' + primka[i].primka_id + '</span></td>';

                                output += '<td>';
                                for (var j = 0; j < rma.length; ++j)
                                    output += '<strong>RMA. ' + rma[j].id + '</strong><a style="margin-left:10px; display:none;" class="glyphicon glyphicon-pencil" href="rma.php?rma=' + rma[j].id + '"></a><br>';
                                output += '</td>';

                                output += '<td>';
                                for (var j = 0; j < rma.length; ++j)
                                    output += (rma[j].rnOs) ? rma[j].rnOs + '<br>' : "";
                                output += '</td>';

                                output += '<td>';
                                for (var j = 0; j < rma.length; ++j)
                                    output += (rma[j].nazivOS) ? rma[j].nazivOS + '<br>' : "";
                                output += '</td>';

                                output += '<td>';
                                output += (primka[i].tvrtka) ? '<i>' + primka[i].tvrtka + '</i>, ' : '';
                                output += primka[i].s_ime + ' ' + primka[i].s_prezime;
                                output += '</td>';

                                output += '<td>';

                                var poslano = new Date(rma[rma.length - 1].poslano);
                                output += (poslano && poslano.getFullYear() != "1970") ? [poslano.getDate(), poslano.getMonth() + 1, poslano.getFullYear()].join('.') + ' /  ' + [(poslano.getHours() < 10 ? '0' : '') + poslano.getHours(), (poslano.getMinutes() < 10 ? '0' : '') + poslano.getMinutes()].join(':') : '';


                                output += '</td>';

                                output += '<td>';
                                for (var j = 0; j < rma.length; ++j)
                                    output += rma[j].status + '<br>';
                                output += '</td>';

                                output += '<td>';
                                for (var j = 0; j < rma.length; ++j)
                                    output += (rma[j].napomena) ? rma[j].napomena + '<br>' : '';
                                output += '</td>';

                                output += '</tr>';

                            }

                            $('#sviRMA').html(output);
                        }






                    },
                    error: function (e) {
                        alert(e.message);
                    }
                });

                $("#sviRMA").on("mouseover", "tr", function () {
                    $(this).css("background-color", "#efefef");
                });

                $("#sviRMA").on("mouseout", "tr", function () {
                    $(this).css("background-color", "white");
                });

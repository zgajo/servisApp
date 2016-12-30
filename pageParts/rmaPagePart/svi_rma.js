



$.ajax({
                    type: 'POST',
                    url: "json/primka/sveOtvorenePrimke.php",
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
                                
                                output += '<td>'+ primka[i].s_ime + ' ' + primka[i].s_prezime +'</td>';
                                output += '<td>'+ primka[i].naziv +'</td>';
                                output += '<td>'+ primka[i].serial +'</td>';

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

                                var poslano = new Date(rma[rma.length - 1].poslano);
                                output += (poslano && poslano.getFullYear() != "1970") ? [poslano.getDate(), poslano.getMonth() + 1, poslano.getFullYear()].join('.') : '';


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

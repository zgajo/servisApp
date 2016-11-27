$(document).ready(function(){
    $('#klik').click(function(){
        
        $('#test').html('Evo mene');
        
       /* $.getJSON('testJson.php', function(data) {
                $('#getJSON-results').html(JSON.stringify(data));
            });
            */
             event.preventDefault();
            
            $.ajax({
                            type: 'GET',
                            url: '/testJson.php',
                             data: {
                                format: 'json',
                             },
                             dataType: "json",
                             contentType: "application/json; charset=utf-8",
                            success: function(data)
                            {
                                
                                    var out = JSON.parse(JSON.stringify(data));
                                    var output = "" + out[0].adresa;
                                    $('#test').html(output);
                                    
                                    $('#jsonp-results').html(JSON.stringify(data));
                                    console.log(JSON.parse(JSON.stringify(data)));
                                    
                            },
                            error: function(e)
                            {
                               alert(e.message);
                            }, 
                              
                    });
            
    });
    
});
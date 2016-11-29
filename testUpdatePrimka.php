<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <link href="search/search.css" rel="stylesheet">
    </head>
    
    <body>
        


                        <script>
                        $(document).ready(function (){
                            
                            var pid = <?php echo $_GET['primka'] ?>
                            // Dohvaćanje i pregled upita
                            $.ajax({
                                type: 'GET',
                                url: "json/primka/updatePrimkaJson.php",
                                data: {"id":pid},
                                dataType: 'json',
                                contentType: "application/json; charset=utf-8",
                                success: function (data) {
                                      
                                     
                                      
                                      console.log(JSON.parse(JSON.stringify(data)));
                                      
                                },
                                error: function (e) {
                                    alert(e.message);
                                }
                            });
                            
                            //Ažuriranje upita
                            $('#azuriraj').click(function (){
                                
                                var status = $('#status_primke').val();
                                var p_id = $('#primka_id').text();
                                
                                $.post('testUpdate.php', { "status" : status, "id" : p_id });
                                
                            });
                            
                            
                            
                                                       
                        });
                        </script>
    </body>
</html>
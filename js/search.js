$(document).ready(function(){
    var left = $('#box').position().left;
    var top = $('#box').position().top;
    var width = $('#box').width();
    
   
    $('#search_result').css('left', left).css('top', top+22).css('width', width).css('z-index', 1);
    
    $('#search_box').keyup(function(){
        var value = $(this).val();
        
        if(value != ''){
            $('#search_result').show();
            $.post('search/searchStranku.php', {value: value}, function(data){
                $('#search_result').html(data);
            });
        }else{
            $('#search_result').hide();
        }
        
    });
    
    
});

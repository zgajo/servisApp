var output = document.getElementById('test');

var ajaxhttp = new XMLHttpRequest();
var url = "testJson.php";

ajaxhttp.open("GET", url, true);
ajaxhttp.setRequestHeader("content-type", "application/json");

ajaxhttp.onreadystatechange = function(){
    if(ajaxhttp.readyState == 4 && ajaxhttp.status == 200){
        var jcont = JSON.parse(ajaxhttp.responseText);
        output.innerHTML += jcont.name;
        //u slučaju da je više objekata unutar jsona
        //for(var myO in jcont){
        //    output.innerHTML += jcont[myO].name;
       // }
        console.log(jcont);
    }
}

ajaxhttp.send();


console.log(ajaxhttp);

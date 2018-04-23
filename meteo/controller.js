$(document).ready(function(){
  
  //dati meteo tramite località
  $("#search1").click(function(){  
    $.getJSON("http://api.openweathermap.org/data/2.5/weather",{'q':$("#loc1").val(),'APPID':"08f26442f35c69050b5dc94377b4dc7f"},function (result){
      
    });
  });
  
});
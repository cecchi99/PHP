$(document).ready(function(){
  
  //dati meteo tramite località
  $("#search1").click(function(){  
    $.getJSON("http://api.openweathermap.org/data/2.5/weather",{'q':$("#loc1").val(),'APPID':"08f26442f35c69050b5dc94377b4dc7f"},function (result){
     
      //svuotamento tabella precedente
      $("#meteo").empty();
      
      //variabili tabella
      var loc="<tr><th>"+result.name+", "+result.sys.country+"</th><td>(lon="+result.coord.lon+", lat="+result.coord.lat+")</td></tr>";
      var main="<tr><td>Clima:</td><td>"+result.weather[0].main+"</td></tr>";
      var dsc="<tr><td>Descrizione:</td><td>"+result.weather[0].description+"</td></tr>";
      var tmp="<tr><td>Temperatura:</td><td>"+result.main.temp+"°C</td></tr>";
      var pr="<tr><td>Pressione:</td><td>"+result.main.pressure+" hpa</td></tr>";
      var hum="<tr><td>Umidita':</td><td>"+result.main.humidity+"%</td></tr>";
      var spd="<tr><td>Velocita' vento:</td><td>"+result.wind.speed+" m/s</td></tr>";
      var deg="<tr><td>Direzione vento:</td><td>"+result.wind.deg+"°</td></tr>";
      var vis="<tr><td>Visibilita':</td><td>"+result.visibility+"</td></tr>";
      
      //valori in tabella
      var tb=loc+main+dsc+tmp+pr+hum+spd+deg+vis;
      $("#meteo").append(tb);
      
    }).fail(function(){
      alert("Localita' inesistente!");
    });
  });
  
  //cancellazione dati meteo
  $("#delete1").click(function(){
    $("#meteo").empty();
    $("#loc1").val("");
  });
  
  //dati previsioni tramite località
  $("#search2").click(function(){  
    $.getJSON("http://api.openweathermap.org/data/2.5/forecast",{'q':$("#loc2").val(),'APPID':"08f26442f35c69050b5dc94377b4dc7f"},function (result){
     
      //svuotamento tabella precedente
      $("#previsioni").empty();
      
      //variabili tabella
      var loc="<tr><th>"+result.city.name+", "+result.city.country+"</th><td>(lon="+result.city.coord.lon+", lat="+result.city.coord.lat+")</td></tr>";
      var main="<tr><td>Clima:</td><td>"+result.list[0].weather[0].main+"</td></tr>";
      var dsc="<tr><td>Descrizione:</td><td>"+result.list[0].weather[0].description+"</td></tr>";
      var tmp="<tr><td>Temperatura:</td><td>"+result.list[0].main.temp+"°C</td></tr>";
      var pr="<tr><td>Pressione:</td><td>"+result.list[0].main.pressure+" hpa</td></tr>";
      var hum="<tr><td>Umidita':</td><td>"+result.list[0].main.humidity+"%</td></tr>";
      var spd="<tr><td>Velocita' vento:</td><td>"+result.list[0].wind.speed+" m/s</td></tr>";
      var deg="<tr><td>Direzione vento:</td><td>"+result.list[0].wind.deg+"°</td></tr>";
      
      //valori in tabella
      var tb=loc+main+dsc+tmp+pr+hum+spd+deg;
      $("#previsioni").append(tb);
      
    }).fail(function(){
      alert("Localita' inesistente!");
    });
  });
  
  //cancellazione dati previsioni
  $("#delete2").click(function(){
    $("#previsioni").empty();
    $("#loc2").val("");
  });
});
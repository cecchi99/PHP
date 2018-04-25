$(document).ready(function(){
  
  //dati meteo tramite località
  $("#search1").click(function(){  
    $.getJSON("http://api.openweathermap.org/data/2.5/weather",{'q':$("#loc1").val(),'APPID':"08f26442f35c69050b5dc94377b4dc7f"},function (result){
     
      //variabili tabella
      var loc="<td><th>"+result.name+", "+result.sys.country+"</th><tr>(lon="+result.coord.lon+", lat="+result.coord.lat+")</tr></td>";
      var main="<td><tr>Clima:</tr><tr>"+result.weather[0].main+"</tr></td>";
      var dsc="<td><tr>Descrizione:</tr><tr>"+result.weather[0].description+"</tr></td>";
      var tmp="<td><tr>Temperatura:</tr><tr>"+result.main.temp+"°C</tr></td>";
      var pr="<td><tr>Pressione:</tr><tr>"+result.main.pressure+" hpa</tr></td>";
      var hum="<td><tr>Umidita':</tr><tr>"+result.main.humidity+"%</tr></td>";
      var spd="<td><tr>Velocita' vento:</tr><tr>"+result.wind.speed+" m/s</tr></td>";
      var deg="<td><tr>Direzione vento:</tr><tr>"+result.wind.deg+"°</tr></td>";
      var vis="<td><tr>Visibilita':</tr><tr>"+result.visibility+"</tr></td>";
      
      //valori in tabella
      var tb=loc+main+dsc+tmp+pr+hum+spd+deg+vis;
      $("#meteo").append(tb);
      
    }).fail(function(){
      alert("Localita' inesistente!");
    });
  });
  
});
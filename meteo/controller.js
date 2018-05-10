//variabile dei dati ricevuti
var data;

//funzione di cambio valori filtrati con la select
function Change(sel)
{
    Forecast(sel.value,data);
}

//funzione dati meteo
function Weather()
{
  $.getJSON("http://api.openweathermap.org/data/2.5/weather",{'q':$("#loc1").val(),'APPID':"08f26442f35c69050b5dc94377b4dc7f"},function (result){
      
      //svuotamento tabella precedente
      $("#meteo").empty();
      
      //variabili tabella
      var loc="<tr><th>"+result.name+", "+result.sys.country+"</th><td>(lon="+result.coord.lon+", lat="+result.coord.lat+")</td></tr>";
      var main="<tr><td>Clima:</td><td>"+result.weather[0].main+"</td></tr>";
      var dsc="<tr><td>Descrizione:</td><td>"+result.weather[0].description+"</td></tr>";
      var tmp="<tr><td>Temperatura:</td><td>"+result.main.temp+"&deg;C</td></tr>";
      var pr="<tr><td>Pressione:</td><td>"+result.main.pressure+" hpa</td></tr>";
      var hum="<tr><td>Umidita':</td><td>"+result.main.humidity+"%</td></tr>";
      var spd="<tr><td>Velocita' vento:</td><td>"+result.wind.speed+" m/s</td></tr>";
      var deg="<tr><td>Direzione vento:</td><td>"+result.wind.deg+"&deg;</td></tr>";
      
      //valori in tabella
      var tb=loc+main+dsc+tmp+pr+hum+spd+deg;
      $("#meteo").append(tb);
      
    }).fail(function(){
      alert("Localita' inesistente!");
    });
}

//cambio dati meteo per data e ora
function Forecast(n,result)
{
      //svuotamento tabella precedente
      $("#previsioni").empty();
      
      //variabili tabella della option datetime selezionata
      var loc="<tr><th>"+result.city.name+", "+result.city.country+"</th><td>(lon="+result.city.coord.lon+", lat="+result.city.coord.lat+")</td></tr>";
      var main="<tr><td>Clima:</td><td>"+result.list[n].weather[0].main+"</td></tr>";
      var dsc="<tr><td>Descrizione:</td><td>"+result.list[n].weather[0].description+"</td></tr>";
      var tmp="<tr><td>Temperatura:</td><td>"+result.list[n].main.temp+"&deg;C</td></tr>";
      var pr="<tr><td>Pressione:</td><td>"+result.list[n].main.pressure+" hpa</td></tr>";
      var hum="<tr><td>Umidita':</td><td>"+result.list[n].main.humidity+"%</td></tr>";
      var spd="<tr><td>Velocita' vento:</td><td>"+result.list[n].wind.speed+" m/s</td></tr>";
      var deg="<tr><td>Direzione vento:</td><td>"+result.list[n].wind.deg+"&deg;</td></tr>";
      
      //valori in tabella aggiornata
      var tb=loc+main+dsc+tmp+pr+hum+spd+deg;
      $("#previsioni").append(tb);
}

//funzione principale del documento
$(document).ready(function(){
  
  //cancellazione dati meteo
  $("#delete1").click(function(){
    $("#meteo").empty();
    $("#loc1").val("");
  });
  
  //dati previsioni tramite località
  $("#search2").click(function(){
    
    //chiamata al database
    $.getJSON("http://api.openweathermap.org/data/2.5/forecast",{'q':$("#loc2").val(),'APPID':"08f26442f35c69050b5dc94377b4dc7f"},function (result){
     
      //mostra select
      $("#datetime").show();
      
      //associazione dati ricevuti all variabile globale
      data=result;
      
      //richiamo funzione previsioni
      Forecast(0,data);
      
      //svuotamento select precedente
      $("#datetime").empty();
      
      //variabile contatore
      var n=0;
      
      //data e ora nella select
      $.each(result.list, function(k,v)
      {
        //costruzione opzioni della select
        var datetime="<option value='"+n+"'>"+v["dt_txt"]+"</option>";
        $("#datetime").append(datetime);
        n++;
      });
      
    }).fail(function(){
      alert("Localita' inesistente!");
    });
  });
  
  //cancellazione dati previsioni select
  $("#delete2").click(function(){
    $("#previsioni").empty();
    $("#datetime").empty();
    $("#datetime").hide();
    $("#loc2").val("");
  });
});
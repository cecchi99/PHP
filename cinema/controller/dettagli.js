$(document).ready(function(){
  
  //dettagli film selezionato
  $("#filmbtn").click(function(){
    
    //svuotamento tabelle precedenti
    $("#dettagliFilm").empty();
    $("#interpreti").empty();
    
    //mostra display
    $("#divFilm").show();
    $("#divInt").show();
    
    //reperimento dati film
    $.getJSON("script/dettagliFilm.php",{"idFilm":$("#elencoFilm").val()},function(result){
     
      //creazione campi tabella film
      var titolo="<tr><th>Titolo</th><td>"+result.titolo+"<td></tr>";
      var anno="<tr><th>Anno produzione</th><td>"+result.annoProduzione+"<td></tr>";
      var luogo="<tr><th>Luogo produzione</th><td>"+result.luogoProduzione+"<td></tr>";
      var regista="<tr><th>Cognome regista</th><td>"+result.cognomeRegista+"<td></tr>";
      var genere="<tr><th>Genere</th><td>"+result.genere+"<td></tr>";
      var tb=titolo+anno+luogo+regista+genere;
      $("#dettagliFilm").append(tb);
    });
    
    //reperimento dati interpreti
    $.getJSON("script/interpreti.php",{"idFilm":$("#elencoFilm").val()},function(result){
      
      //creazione campi tabella interpreti
      var th="<tr><th>Nome</th><th>Cognome</th><th>Personaggio</th></tr>";
      $("#interpreti").append(th);
      $.each(result,function(k,v){
        var td="<tr><td>"+v["nome"]+"</td><td>"+v["cognome"]+"</td><td>"+v["personaggio"]+"</td></tr>";
        $("#interpreti").append(td);
      });
    });
  });
  
  //dettagli cinema selezionato
  $("#cinemabtn").click(function(){
    
    $("#dettagliCinema").empty();
    $("#divCinema").show();
    
    //reperimento dati cinema
    $.getJSON("script/dettagliCinema.php",{"codCinema":$("#elencoCinema").val()},function(result){
     
      //creazione campi tabella cinema
      var nome="<tr><th>Nome</th><td>"+result.nome+"<td></tr>";
      var posti="<tr><th>Posti</th><td>"+result.posti+"<td></tr>";
      var citta="<tr><th>Citta'</th><td>"+result.citta+"<td></tr>";
      var tb=nome+posti+citta;
      $("#dettagliCinema").append(tb);
    });
  });
  
  //dettagli programmazione selezionata
  $("#progbtn").click(function(){
    
    $("#dettagliProg").empty();
    $("#divProg").show();
    
    //reperimento dati programmazione
    $.getJSON("script/dettagliProg.php",{"dataProiezione":$("#elencoProg").val()},function(result){
      
      //creazione campi tabella programmazioni
      var th="<tr><th>Film</th><th>Cinema</th><th>Citta'</th></tr>";
      $("#dettagliProg").append(th);
      $.each(result,function(k,v){
        var td="<tr><td>"+v["titolo"]+"</td><td>"+v["nome"]+"</td><td>"+v["citta"]+"</td></tr>";
        $("#dettagliProg").append(td);
      });
    });
  });
  
});
$(document).ready(function(){
  
  //dettagli film selezionato
  $("#filmbtn").click(function(){
    $.getJSON("script/dettagliFilm.php",{"idFilm":$("#elencoFilm").val()},function(result){
      
      //creazione campi tabella film
      var titolo="<tr><th>Titolo</th><td>"+result.titolo+"<td></tr>";
      var anno="<tr><th>Anno produzione</th><td>"+result.annoProduzione+"<td></tr>";
      var luogo="<tr><th>Luogo produzione</th><td>"+result.luogoProduzione+"<td></tr>";
      var regista="<tr><th>Cognome regista</th><td>"+result.cognomeRegista+"<td></tr>";
      var genere="<tr><th>Genere</th><td>"+result.genere+"<td></tr>";
      var tb=titolo+anno+luogo+regista+genere;
      $("#dettagliFilm").append(tb);
      
      //creazione campi tabella interpreti
      
    });
  });
  
  //dettagli cinema selezionato
  $("#cinemabtn").click(function(){
    
  });
  
  //dettagli programmazione selezionata
  $("#progbtn").click(function(){
    
  });
  
});
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
      $.each(result,function(k,v){
        var nome="<tr><th>Nome</th><td>"+v["nome"]+"<td></tr>";
        var cognome="<tr><th>Cognome</th><td>"+v["cognome"]+"<td></tr>";
        var personaggio="<tr><th>Personaggio</th><td>"+v["personaggio"]+"<td></tr>";
        var tb=nome+cognome+personaggio;
        $("#interpreti").append(tb);
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
    $.getJSON("script/dettagliProg.php",{"codProg":$("#elencoProg").val()},function(result){
      
      //creazione campi tabella programmazioni
      var titolo="<tr><th>Film</th><td>"+result.titolo+"<td></tr>";
      var cinema="<tr><th>Cinema</th><td>"+result.nome+"<td></tr>";
      var citta="<tr><th>Citta'</th><td>"+result.citta+"<td></tr>";
      var tb=titolo+cinema+citta;
      $("#dettagliProg").append(tb);
    });
  });
  
});
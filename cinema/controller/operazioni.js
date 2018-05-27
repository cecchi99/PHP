$(document).ready(function(){
  
  //aggiungi attore
  $("#adAttore").click(function(){
    //controllo campi vuoti
    if($("#cognome").val()===""||$("#nome").val()===""||$("#annoNascita").val()===""||$("#nazionalita").val()==="")
      {
        alert("Impossibile registrare campi vuoti!");
      }
    //controllo formato anno nascita
    else if(Number.isNaN(Number.parseInt($("#annoNascita").val())))
      {
        alert("Anno di nascita deve essere un numero intero!");
      }
    else
      {
        //conferma registrazione
        if(confirm("Registrare il seguente attore?"))
          {
            $.getJSON("script/adAttore.php",{"cognome":$("#cognome").val(),"nome":$("#nome").val(),"sesso":$("input[name=sesso]:checked").val(),"annoNascita":$("#annoNascita").val(),"nazionalita":$("#nazionalita").val()},function (data){
              if(data)
                {
                  alert("Attore registrato correttamente!");
                }
              else
                {
                  alert("Errore di registrazione: "+data);
                }
            });
          }
      }
  });
  
  //aggiungi film
  $("#adFilm").click(function(){
    //controllo campi vuoti
    if($("#titolo").val()===""||$("#annoProduzione").val()===""||$("#luogoProduzione").val()===""||$("#regista").val()===""||$("#genere").val()==="")
      {
        alert("Impossibile registrare campi vuoti!");
      }
    //controllo formato anno produzione
    else if(Number.isNaN(Number.parseInt($("#annoProduzione").val())))
      {
        alert("Anno di produzione deve essere un numero intero!");
      }
    else
      {
        //conferma registrazione
        if(confirm("Registrare il seguente film?"))
          {
            $.getJSON("script/adFilm.php",{"titolo":$("#titolo").val(),"annoProduzione":$("#annoProduzione").val(),"luogoProduzione":$("luogoProduzione").val(),"cognomeRegista":$("#regista").val(),"genere":$("#genere").val()},function (data){
              if(data)
                {
                  alert("Film registrato correttamente!");
                }
              else
                {
                  alert("Errore di registrazione: "+data);
                }
            });
          }
      }
  });
  
  //aggiungi cinema
  $("#adCinema").click(function(){
    //controllo campi vuoti
    if($("#nomeCinema").val()===""||$("#posti").val()===""||$("#citta").val()==="")
      {
        alert("Impossibile registrare campi vuoti!");
      }
    //controllo formato posti
    else if(Number.isNaN(Number.parseInt($("#posti").val())))
      {
        alert("Il totale dei posti deve essere un numero intero!");
      }
    else
      {
        //conferma registrazione
        if(confirm("Registrare il seguente cinema?"))
          {
            $.getJSON("script/adCinema.php",{"nome":$("#nomeCinema").val(),"posti":$("#posti").val(),"citta":$("citta").val()},function (data){
              if(data)
                {
                  alert("Cinema registrato correttamente!");
                }
              else
                {
                  alert("Errore di registrazione: "+data);
                }
            });
          }
      }
  });
  
});
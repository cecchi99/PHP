$(document).ready(function(){
 
  //elenco film ricevuti dal database
  $.getJSON("script/elencoFilm.php",function(result){
    //creazione option con i film
    $.each(result,function(k,v)
    {
      var opt="<option id='"+v["codFilm"]+"'>"+v["titolo"]+"</option>";
      $("elencoFilm").append(opt);
    });
  });
});
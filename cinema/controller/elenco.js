$(document).ready(function(){
 
  //elenco film dal database
  $.getJSON("script/elencoFilm.php",function(result){
    //creazione option con i film
    $.each(result,function(k,v)
    {
      var opt="<option value='"+v["codFilm"]+"'>"+v["titolo"]+"</option>";
      $("#elencoFilm").append(opt);
    });
  });
  
  //elenco cinema dal database
  $.getJSON("script/elencoCinema.php",function(result){
    //creazione option con i cinema
    $.each(result,function(k,v)
    {
      var opt="<option value='"+v["codCinema"]+"'>"+v["nome"]+"</option>";
      $("#elencoCinema").append(opt);
    });
  });
  
  //elenco programmazioni dal database
  $.getJSON("script/elencoProg.php",function(result){
    //creazione option con le programmazioni
    $.each(result,function(k,v)
    {
      var opt="<option value='"+v["codProg"]+"'>"+v["dataProiezione"]+"</option>";
      $("#elencoProg").append(opt);
    });
  });
  
});
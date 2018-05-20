$(document).ready(function(){
  
  //bottone film
  $("#filmdlt").click(function(){
    $("#dettagliFilm").empty();
    $("#interpreti").empty();
    $("#divFilm").hide();
    $("#divInt").hide();
  });
  
  //bottone cinema
  $("#cinemadlt").click(function(){
    $("#dettagliCinema").empty();
    $("#divCinema").hide();
  });
  
  //bottone programmazioni
  $("#progdlt").click(function(){
    $("#dettagliProg").empty();
    $("#divProg").hide();
  });
  
});
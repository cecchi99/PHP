$(document).ready(function(){
  
  //link login
  $("#link").click(function(){
    $("#elenchi").hide();
    $("#admin").show();
    $("#link").hide();
  });
  
  //bottone login
  $("#login").click(function(){
    if($("#email").val()===""||$("#password").val()==="")
      {
        alert("Email e password non possono essere nulle!");
      }
    else
      {
        $.getJSON("script/login.php",{"email":$("#email").val(),"password":$("#password").val()},function(result){
          if(result===false)
            {
              alert("Credenziali non valide!");
            }
          else
            {
              alert("Accesso eseguito con: "+result.email);
              $("#logout").show();
              $("#elenchi").show();
              $("#admin").hide();
            }
        });
      }
  });
  
  //bottone annulla
  $("#cancel").click(function(){
    $("#elenchi").show();
    $("#admin").hide();
    $("#link").show();
    
    //svuotamento caselle di testo
    $("#email").val("");
    $("#password").val("");
  });
  
  //link logout
  $("#logout").click(function(){
    location.reload();
  });
  
});
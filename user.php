<html>
  <head>
    <title>Modulo di accesso</title>
  </head>
  <body>
    <script>
      function isEmpty()
      {
        if(loginform.email.value==""||loginform.password.value=="")
        {
          alert("Impossibile accedere con campi vuoti!");
          return false; 
        }
      }
      
      function goBack() 
      {
        window.history.back();
      }
    </script>
    
    <h1>Modulo di accesso</h1>
    
    <p>Hai gia' un account?</p>
    <form name="loginform" method="post" action="index.php" onsubmit="return isEmpty()">
      e-Mail: <input type="email" name="email"><br>
      Password: <input type="password" name="password"><br>
      <input type="submit" name="login" value="Accedi">
      <input type="button" name="return" value="Indietro" onclick="goBack()">
    </form>
  </body>
</html>
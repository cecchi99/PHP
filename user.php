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
    
    <?php
    if(isset($_POST["login"]))
    {
      $connection="mysql:host=localhost;dbname=quintab_cecchi";
      $username="root";
      $password="quintab";
      
      try
      {
        $dbh=new PDO($connection,$username,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $query=$dbh->prepare("SELECT email, password FROM iscrizione WHERE email=:email AND password=:password");
        $query->bindValue(":email",$_POST["email"]);
        $query->bindValue(":password",md5($_POST["password"]));
        
        $query->execute();
        
        if($query->fetch()>0)
        {
          echo "Accesso eseguito con: ".$_POST["email"]."<br>";
        }
        else
        {
          echo "Credenziali non valide!"."<br>";
        }
      }
      catch(PDOException $e)
      {
        echo $e->getMessage()."<br>";
      }
    }
    else
    {
    ?>
    
    <p>Hai gia' un account?</p>
    <form name="loginform" method="post" action="" onsubmit="return isEmpty()">
      e-Mail: <input type="email" name="email"><br>
      Password: <input type="password" name="password"><br>
      <input type="submit" name="login" value="Accedi">
      <?php } ?>
      <input type="button" name="return" value="Indietro" onclick="goBack()">
    </form>
    
  </body>
</html>
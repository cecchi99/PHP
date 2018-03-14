<?php session_start(); ?>

<html>
  <head>
    <title>Car pooling</title>
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
    </script>
    
    <h1>Accedi</h1>
    
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
        
        if($_POST["tipo"]=="passeggero")
        {
          $query=$dbh->prepare("SELECT email, password FROM Passeggero WHERE email=:email AND password=:password");
          $query->bindValue(":email",$_POST["email"]);
          $query->bindValue(":password",md5($_POST["password"]));
        }
        else
        {
          $query=$dbh->prepare("SELECT email, password FROM Autista WHERE email=:email AND password=:password");
          $query->bindValue(":email",$_POST["email"]);
          $query->bindValue(":password",md5($_POST["password"]));
        }
        
        $query->execute();
        
        if($query->rowCount()>0)
        {
          $row=$query->fetch();
          $_SESSION["email"]=$row["email"];
          
          echo "Accesso eseguito con: ".$_SESSION["email"]."<br>";
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
    
    <form name="loginform" method="post" action="" onsubmit="return isEmpty()">
      Tipo utente: <input type="radio" name="tipo" value="passeggero" checked>Passeggero <input type="radio" name="tipo" value="autista">Autista<br>
      Email: <input type="email" name="email"><br>
      Password: <input type="password" name="password"><br>
      <input type="submit" name="login" value="Accedi">
      <input type="reset" name="delete" value="Cancella">
    </form>
    
    <?php } ?>
    
    <a href="index.php">Home</a>
    
  </body>
</html>
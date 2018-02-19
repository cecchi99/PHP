<html>
  <head>
    <title>Esito registrazione</title>
  </head>
  <body>
    <h1>Esito registrazione</h1>
    
    <?php
    $connection="mysql:host=localhost;dbname=quintab_cecchi";
    $username="root";
    $password="quintab";
    
    try
    {
      $dbh=new PDO($connection,$username,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $query=$dbh->prepare("INSERT INTO iscrizione(cognome,nome,sesso,nazionalita,patente_a,patente_b,email,password) VALUES(:cognome,:nome,:sesso,:nazionalita,:patente_a,:patente_b,:email,:password)");
      $query->bindValue(":cognome",$_POST["cognome"]);
      $query->bindValue(":nome",$_POST["nome"]);
      $query->bindValue(":sesso",$_POST["sesso"]);
      $query->bindValue(":nazionalita",$_POST["nazionalita"]);
      $query->bindValue(":patente_a",$_POST["patente_a"]);
      $query->bindValue(":patente_b",$_POST["patente_b"]);
      $query->bindValue(":email",$_POST["email"]);
      $query->bindValue(":password",md5($_POST["password"]));
      
      if($query->execute())
      {
        echo "<h2>Dati correttamente registrati</h2>";
      }
      else
      {
        echo "<h2>Errore nella registrazione!</h2>";
      }
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
    ?>
    
    <form method="get" action="index.php">
      <input type="submit" name="restart" value="Chiudi">
    </form>
  </body>
</html>
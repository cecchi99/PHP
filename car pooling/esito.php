<html>
  <head>
    <title>Car pooling</title>
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
      
      if($_POST["tipo"]=="passeggero")
      {
        $query=$dbh->prepare("INSERT INTO Passeggero(cognome,nome,email,password,telefono,dataNascita,sesso,nazionalita) VALUES (:cognome,:nome,:email,:password,:telefono,:dataNascita,:sesso,:nazionalita)");
      }
      else
      {
        $query=$dbh->prepare("INSERT INTO Autista(cognome,nome,email,password,telefono,dataNascita,sesso,nazionalita,numeroPatente,scadenzaPatente) VALUES (:cognome,:nome,:email,:password,:telefono,:dataNascita,:sesso,:nazionalita,:numeroPatente,:scadenzaPatente)");
      }
      
      $query->bindValue(":cognome",$_POST["cognome"]);
      $query->bindValue(":nome",$_POST["nome"]);
      $query->bindValue(":email",$_POST["email"]);
      $query->bindValue(":password",md5($_POST["password"]));
      $query->bindValue(":telefono",$_POST["telefono"]);
      $query->bindValue(":dataNascita",$_POST["nascita"]);
      $query->bindValue(":sesso",$_POST["sesso"]);
      $query->bindValue(":nazionalita",$_POST["nazionalita"]);
      $query->bindValue(":numeroPatente",$_POST["patente"]);
      $query->bindValue(":scadenzaPatente",$_POST["scadenza"]);
    }
    catch(exception $e)
    {
      echo $e->getMessage();
    }
    ?>
  </body>
</html>
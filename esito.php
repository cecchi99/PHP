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
      $dbh->setAttributes(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $query=$dbh->prepare("INSERT INTO (cognome,nome,sesso,nazionalità,patente_a,patente_b,email,password) VALUES(:cognome,:nome,:sesso,:nazionalità,:patente_a,:patente_b,:email,:password)");
      $query->bind(":cognome",$_POST["cognome"]);
      $query->bind(":nome",$_POST["nome"]);
      $query->bind(":sesso",$_POST["sesso"]);
      $query->bind(":nazionalità",$_POST["nazionalità"]);
      $query->bind(":patente_a",$_POST["patente_a"]);
      $query->bind(":patente_b",$_POST["patente_b"]);
      $query->bind(":email",$_POST["email"]);
      $query->bind(":password",$_POST["password"]);
      
      if($query->execute())
      {?>
        <h2>Dati correttamente registrati</h2>
      <?php}
      else
      {?>
        <h2>Errore nella registrazione!</h2>
      <?php}
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
    ?>
    
    <form method="get" action="index.html">
      <input type="submit" name="restart" value="Chiudi">
    </form>
  </body>
</html>
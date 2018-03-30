<?php session_start(); ?>

<html>
  <head>
    <title>Car pooling</title>
  </head>
  <body>
    <h1>Prenota viaggio</h1>
    
    <?php
    $connection="mysql:host=localhost;dbname=quintab_cecchi";
    $username="root";
    $password="quintab";
    
    if(isset($_POST["send"]))
    {
      try
      {
        $dbh=new PDO($connection,$username,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $query=$dbh->prepare("UPDATE Prenotazione SET idPasseggero=:idPasseggero WHERE idViaggio=:idViaggio AND idAutista=:idAutista");
        $query->bindValue(":idPasseggero",$_POST["passeggero"]);
        
        if($query->execute()==false)
        {
          echo "Errore nella prenotazione!<br>";
        }
        else
        {
          echo "Prenotazione effettuata con successo!<br>";
        }
      }
      catch(Exception $e)
      {
        echo $e->getMessage()."<br>";
      }
    }
    else
    {
    try
    {
      $dbh=new PDO($connection,$username,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $query=$dbh->prepare("SELECT * FROM Prenotazione p INNER JOIN Viaggio v ON p.idViaggio=v.idViaggio INNER JOIN Auto a ON v.idAuto=a.targa INNER JOIN Autista au ON v.idAutista=au.idAutista WHERE p.disponibile=1");
      $query->execute();
      
      if($query->rowCount()==0)
      {
        echo "Nessuna prenotazione disponibile!<br>";
      }
      else
      { 
        while($row=$query->fetch())
        { 
          echo "Partenza: ".$row["partenza"]."<br>";
          echo "Destinazione: ".$row["destinazione"]."<br>";
          echo "Data viaggio: ".$row["data"]."<br>";
          echo "Ora partenza: ".$row["oraPartenza"]."<br>";
          echo "Ora arrivo: ".$row["oraArrivo"]."<br>";
          echo "Importo: ".$row["importo"]."<br>";
          echo "Durata: ".$row["durata"]."<br>";
          echo "Data prenotazione: ".$row["data"]."<br>";
          echo "Autista: ".$row["nome"]." ".$row["cognome"]."<br>";
          echo "Auto: ".$row["marca"]." ".$row["modello"]."<br>";
          ?>
    
    <form action="" method="post">
      <input type="hidden" name="passeggero" value="<?php echo $_SESSION["idPasseggero"] ?>">
      <input type="submit" name="send" value="Conferma">
    </form>
    
      <?php  }
      }
    }
    catch(Exception $e)
    {
      echo $e->getMessage()."<br>";
    }
    }
    ?>
    
    <a href="index.php">Home</a>
  </body>
</html>
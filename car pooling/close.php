<?php session_start(); ?>

<html>
  <head>
    <title>Car pooling</title>
  </head>
  <body>
    <h1>Prenotazioni aperte</h1>
    
    <?php
    $connection="mysql:host=localhost;dbname=quintab_cecchi";
    $username="root";
    $password="quintab";
    
    if(isset($_POST["close"]))
    {
      try
      {
        $dbh=new PDO($connection,$username,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $query=$dbh->prepare("UPDATE Prenotazione SET disponibile=false WHERE idPrenotazione=:idPrenotazione");
        $query->bindValue(":idPrenotazione",$_POST["prenotazione"]);
        
        if($query->execute()==false)
        {
          echo "Errore nella chiusura della prenotazione!<br>";
        }
        else
        {
          echo "Prenotazione chiusa con successo!<br>";
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
      
      $query=$dbh->prepare("SELECT * FROM Prenotazione p INNER JOIN Viaggio v ON p.idViaggio=v.idViaggio INNER JOIN Auto a ON v.idAuto=a.targa WHERE p.disponibile=1 AND p.idAutista=:autista");
      $query->bindValue(":autista",$_SESSION["idAutista"]);
      $query->execute();
      
      if($query->rowCount()==0)
      {
        echo "Nessuna hai aperto nessuna prenotazione!<br>";
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
          echo "Auto: ".$row["marca"]." ".$row["modello"]."<br>"; ?>
    
    <form action="" method="post">
      <input type="hidden" name="prenotazione" value="<?php echo $row["idPrenotazione"] ?>">
      <input type="submit" name="close" value="Chiudi">
    </form>
    
       <?php }
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
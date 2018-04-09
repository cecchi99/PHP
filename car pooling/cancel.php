<?php session_start(); 
include "connection.php";
?>

<html>
  <head>
    <title>DriveLend</title>
  </head>
  <body>
    <h1>Viaggi prenotati</h1>
    
    <?php
    if(isset($_POST["delete"]))
    {
      try
      {
        $query=$dbh->prepare("UPDATE Prenotazione SET idPasseggero=NULL WHERE idPrenotazione=:idPrenotazione");
        $query->bindValue(":idPrenotazione",$_POST["prenotazione"]);
        
        if($query->execute()==false)
        {
          echo "Errore nell' annullamento della prenotazione!<br>";
        }
        else
        {
          echo "Prenotazione annullata con successo!<br>";
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
      $query=$dbh->prepare("SELECT * FROM Prenotazione p INNER JOIN Viaggio v ON p.idViaggio=v.idViaggio INNER JOIN Auto a ON v.idAuto=a.targa INNER JOIN Autista au ON v.idAutista=au.idAutista WHERE p.idPasseggero=:passeggero");
      $query->bindValue(":passeggero",$_SESSION["idPasseggero"]);
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
          echo "Autista: ".$row["nome"]." ".$row["cognome"]."<br>";
          echo "Auto: ".$row["marca"]." ".$row["modello"]."<br>"; ?>
    
    <form action="" method="post">
      <input type="hidden" name="prenotazione" value="<?php echo $row["idPrenotazione"] ?>">
      <input type="submit" name="delete" value="Annulla">
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
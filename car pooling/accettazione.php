<?php session_start();
include "connection.php";
?>

<html>
  <head>
    <title>DriveLend</title>
  </head>
  <body>
    <h1>Prenota viaggio</h1>
    
    <?php
    if(isset($_POST["send"]))
    {
      try
      {  
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
      <input type="hidden" name="prenotazione" value="<?php echo $row["idPrenotazione"] ?>">
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

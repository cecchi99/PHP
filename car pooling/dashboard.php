<?php 
session_start();
if(!isset($_SESSION["email"]))
{
  header("Location:index.php");
}
?>

<html>
  <head>
    <title>Car pooling</title>
  </head>
  <body>
    <h1>Home</h1>
    
    <?php
    if($_SESSION["tipo"]=="passeggero")
    {
      echo "<a>Prenota viaggio</a><br>"; 
    }
    else
    {
      echo "<a href='viaggi.php'>Aggiungi viaggio</a><br>";
      echo "<a href='apriPrenotazione.php'>Apri prenotazione</a><br>";
      echo "<a href='chiudiPrenotazione.php'>Chiudi prenotazione</a><br>";      
    }
    ?>
    
    <a href="logout.php">Disconnetti</a>
  </body>
</html>
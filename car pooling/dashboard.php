<?php 
session_start();
if(!isset($_SESSION["email"]))
{
  header("Location:index.php");
}
?>

<html>
  <head>
    <title>DriveLend</title>
  </head>
  <body>
    <h1>Home</h1>
    
    <?php
    if($_SESSION["tipo"]=="passeggero")
    {
      echo "<a href='accettazione.php'>Prenota viaggio</a><br>";
      echo "<a href='cancel.php'>Gestisci prenotazioni</a><br>";
    }
    else
    {
      echo "<a href='auto.php'>Aggiungi auto</a><br>";
      echo "<a href='viaggi.php'>Aggiungi viaggio</a><br>";
      echo "<a href='prenotazioni.php'>Aggiungi prenotazione</a><br>";
      echo "<a href='close.php'>Gestisci prenotazioni</a><br>";
    }
    echo "<a href='feedback.php'>Area feedback</a><br>";
    ?>
    
    <a href="logout.php">Disconnetti</a>
  </body>
</html>
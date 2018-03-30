<?php 
session_start();
if(!isset($_SESSION["email"]))
{
  header("Location:index.php");
}
?>

<html>
  <head>
    <title>Home</title>
  </head>
  <body>
    <h1>Home</h1>
    
    <a href="logout.php">Disconnetti</a>
  </body>
</html>
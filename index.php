<?php 
session_start();
if(isset($_SESSION["email"]))
{
  header("Location:dashboard.php");
}
?>

<html>
  <head>
    <title>Home</title>
  </head>
  <body>
    <h1>Home</h1>
    
    <a href="register.php">Registrati</a><br>
    <a href="user.php">Accedi</a>
  </body>
</html>
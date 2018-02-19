<html>
  <head>
    <title>Pagina utente</title>
  </head>
  <body>
    <h1>Pagina utente</h1>
    
    <p>Dati utente:</p>
    <?php
    echo "e-Mail: ".$_POST["email"];
    ?>
    
    <form method="get" action="index.php">
      <input type="submit" name="return" value="Esci">
    </form>
  </body>
</html>
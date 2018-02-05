<html>
  <head>
    <title>Riepilogo dati</title>
  </head>
  <body>
    
    <script>
      function goBack() 
      {
        window.history.back();
      }
    </script>
    
    <h1>Riepilogo dati</h1>
    <?php
    echo("Cognome: ").$_POST["cognome"]."<br>";
    echo("Nome: ").$_POST["nome"]."<br>";
    echo("Sesso: ").$_POST["sesso"]."<br>";
    echo("Nazionalita': ").$_POST["nazionalità"]."<br>";
    echo("Patente: ");
    if(isset($_POST["patente_a"])&&isset($_POST["patente_b"])==false)
    {
      echo $_POST["patente_a"]."<br>";
    }
    else if(isset($_POST["patente_a"])==false&&isset($_POST["patente_b"]))
    {
      echo $_POST["patente_b"]."<br>";
    }
    else if(isset($_POST["patente_a"])==false&&isset($_POST["patente_b"])==false)
    {
      echo "nessuna"."<br>";
    }
    else
    {
      echo $_POST["patente_a"]." ".$_POST["patente_b"]."<br>";
    }
    echo("e-Mail: ").$_POST["email"]."<br>";
    ?>
    
    <form method="post" action="esito.php">
      <input type="hidden" name="cognome" value="<?php echo $_POST["cognome"] ?>">
      <input type="hidden" name="nome" value="<?php echo $_POST["nome"] ?>">
      <input type="hidden" name="sesso" value="<?php echo $_POST["sesso"] ?>">
      <input type="hidden" name="nazionalità" value="<?php echo $_POST["nazionalità"] ?>">
      <input type="hidden" name="patente_a" value="<?php echo $_POST["patente_a"] ?>">
      <input type="hidden" name="patente_b" value="<?php echo $_POST["patente_b"] ?>">
      <input type="hidden" name="email" value="<?php echo $_POST["email"] ?>">
      <input type="hidden" name="password" value="<?php echo $_POST["password"] ?>">
      <input type="button" name="edit" value="Correggi" onclick="goBack()">
      <input type="submit" name="send" value="Registra">
    </form>
    
  </body>
</html>
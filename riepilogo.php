<html>
  <head>
    <title>Riepilogo dati</title>
  </head>
  <body>
    <h1>Riepilogo dati</h1>
    <?php
    echo("Cognome: ").$_POST["cognome"]."<br>";
    echo("Nome: ").$_POST["nome"]."<br>";
    echo("Sesso: ").$_POST["sesso"]."<br>";
    echo("Nazionalita': ").$_POST["nazionalità"]."<br>";
    echo("Patente: ").$_POST["patente"]."<br>";
    echo("e-Mail: ").$_POST["email"]."<br>";
    ?>
    <form method="post" action="esito.php">
      <input type="hidden" name="cognome" value="<?php echo $_POST["cognome"] ?>">
      <input type="hidden" name="nome" value="<?php echo $_POST["nome"] ?>">
      <input type="hidden" name="sesso" value="<?php echo $_POST["sesso"] ?>">
      <input type="hidden" name="nazionalità" value="<?php echo $_POST["nazionalità"] ?>">
      <input type="hidden" name="patente" value="<?php echo $_POST["patente"] ?>">
      <input type="hidden" name="email" value="<?php echo $_POST["email"] ?>">
      <input type="hidden" name="password" value="<?php echo $_POST["password"] ?>">
      <input type="button" name="edit" value="Correggi">
      <input type="submit" name="send" value="Registra">
    </form>
  </body>
</html>
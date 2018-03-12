<html>
  <head>
    <title>Car pooling</title>
  </head>
  <body>
    
    <script>
      function goBack() 
      {
        window.history.back();
      }
    </script>
    
    <h1>Riepilogo registrazione</h1>
    
    <?php
    echo "Cognome: ".$_POST["cognome"]."<br>";
    echo "Nome: ".$_POST["nome"]."<br>";
    echo "Email: ".$_POST["email"]."<br>";
    echo "Telefono: ".$_POST["telefono"]."<br>";
    echo "Data di nascita: ".$_POST["nascita"]."<br>";
    echo "Sesso: ".$_POST["sesso"]."<br>";
    echo "Nazionalita': ".$_POST["nazionalita"]."<br>";
    ?>
    
    <form method="post" action="esito.php">
      <input type="hidden" name="cognome" value="<?php echo $_POST["cognome"] ?>">
      <input type="hidden" name="nome" value="<?php echo $_POST["nome"] ?>">
      <input type="hidden" name="email" value="<?php echo $_POST["email"] ?>">
      <input type="hidden" name="password" value="<?php echo $_POST["password"] ?>">
      <input type="hidden" name="telefono" value="<?php echo $_POST["telefono"] ?>">
      <input type="hidden" name="nascita" value="<?php echo $_POST["nascita"] ?>">  
      <input type="hidden" name="sesso" value="<?php echo $_POST["sesso"] ?>">
      <input type="hidden" name="nazionalita" value="<?php echo $_POST["nazionalita"] ?>">    
      <input type="submit" name="send" value="Conferma">
      <input type="button" name="edit" value="Correggi" onclick="goBack()">
    </form>
  </body>
</html>
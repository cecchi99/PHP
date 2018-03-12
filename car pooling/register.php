<html>
  <head>
    <title>Car pooling</title>
  </head>
  <body>
    <h1>Registrazione</h1>
    
    <?php
    $connection="mysql:host=localhost;dbname=quintab_cecchi";
    $username="root";
    $password="quintab";
    
    try
    {
      $dbh=new PDO($connection,$username,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $query=$dbh->prepare("SELECT * FROM stati");
      $query->execute();
    }
    catch(Exception $e)
    {
      echo $e->getMessage();
    }
    ?>
    
    <form>
      Tipo utente: <input type="radio" name="tipo" value="passeggero" checked>Passeggero <input type="radio" name="tipo" value="autista">Autista<br>
      Cognome: <input type="text" name="nome"><br>
      Nome: <input type="text" name="cognome"><br>
      Email: <input type="email" name="email"><br>
      Password: <input type="password" name="password"><br>
      Conferma password: <input type="password" name="check_password"><br>
      Telefono: <input type="text" name="telefono"><br>
      Data di nascita: <input type="date" name="nascita"><br>
      Sesso: <input type="radio" name="sesso" value="m" checked>Maschio <input type="radio" name="sesso" value="f">Femmina<br>
      Nazionalita': <select name="nazionalita">
                    <?php
                    while($row=$query->fetch())
                    {
                      echo "<option value=".$row["id_stati"].">".$row["nome_stati"];
                    }
                    ?>
                    </select><br>
      <input type="submit" name="register" value="Registra">
      <input type="reset" name="delete" value="cancella">
    </form>
  </body>
</html>
<html>
  <head>
    <title>Car pooling</title>
  </head>
  <body>
    <h1>Gestione prenotazioni</h1>
    
    <?php
    $connection="mysql:host=localhost;dbname=quintab_cecchi";
    $username="root";
    $password="quintab";
    
    try
    {
      $dbh=new PDO($connection,$username,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $query=$dbh->prepare("SELECT * FROM Viaggio");
      $query->execute();
    }
    catch(exception $e)
    {
      echo $e->getMessage();
    }
    ?>
    
    <form action="" method="post">
      Data: <input type="date" name="data"><br>
      Viaggio: <select name="viaggio">
                    <?php
                    while($row=$query->fetch())
                    {
                      echo "<option value=".$row["idViaggio"].">".$row["partenza"]." - ".$row["destinazione"];
                    }
                    ?>
      </select><br>
      <input type="checkbox" name="terminata"> Terminata<br>
      <input type="submit" name="crea" value="Crea">
    </form>
    
    <a href="index.php">Home</a>
  </body>
</html>
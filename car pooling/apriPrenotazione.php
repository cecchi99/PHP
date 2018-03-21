<?php session_start(); ?>

<html>
  <head>
    <title>Car pooling</title>
  </head>
  <body>
    <script>
      function Check()
      {
        if(prenotaform.data.value=="")
        {
          alert("Inserire la data!"); 
          return false;
        }
      }
      
      function goBack() 
      {
        window.history.back();
      }
    </script>
    
    <h1>Apri prenotazione</h1>
    
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
    
    if(isset($_POST["crea"]))
    {
      if(isset($_POST["send"]))
      {
       try
       {
         $dbh=new PDO($connection,$username,$password);
         $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
         $query=$dbh->prepare("INSERT INTO Prenotazione(idAutista,idViaggio,data,disponibile) VALUES(:idAutista,:idViaggio,:data,:disponibile)");
         $query->bindValue(":idAutista",$_SESSION["idAutista"]);
         $query->bindValue(":idViaggio",$_POST["viaggio"]);
         $query->bindValue(":data",$_POST["data"]);
         $query->bindValue(":disponibile",true);
        
         if($query->execute()==false)
         {
          echo "Errore nella creazione della prenotazione!<br>";
         }
         else
         {
          echo "Prenotazione creata correttamente!<br>";
         }
       }
       catch(Exception $e)
       {
        $e->getMessage();
       }
      }
      else
      {
        echo "Data: ".$_POST["data"]."<br>";
        echo "Viaggio: ".$_POST["viaggio"]."<br>";
      ?>
    
    <form method="post" action="">
      <input type="hidden" name="data" value="<?php echo $_POST["data"] ?>">
      <input type="hidden" name="viaggio" value="<?php echo $_POST["viaggio"] ?>"> 
      <input type="hidden" name="crea" value="<?php echo true ?>">
      <input type="submit" name="send" value="Conferma">
      <input type="button" name="edit" value="Correggi" onclick="goBack()">
    </form>
    
    <?php
      }
    }
    else
    {
    ?>
    
    <form name="prenotaform" action="" method="post" onsubmit="return Check()">
      Data: <input type="date" name="data"><br>
      Viaggio: <select name="viaggio">
                    <?php
                    while($row=$query->fetch())
                    {
                      echo "<option value=".$row["idViaggio"].">".$row["partenza"]." - ".$row["destinazione"];
                    }
                    ?>
      </select><br>
      <input type="submit" name="crea" value="Crea">
    </form>
    
    <?php } ?>
    
    <a href="index.php">Home</a>
  </body>
</html>
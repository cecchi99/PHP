<?php session_start();
include "connection.php";
?>

<html>
  <head>
    <title>DriveLend</title>
  </head>
  <body>
    <script>
      function goBack() 
      {
        window.history.back();
      }
    </script>
    
    <h1>Creazione prenotazione</h1>
    
    <?php
    if(isset($_POST["crea"]))
    {
      if(isset($_POST["send"]))
      {
        try
        {
          $query=$dbh->prepare("INSERT INTO Prenotazione(idAutista,idViaggio,data,disponibile) VALUES(:idAutista,:idViaggio,:data,true)");
          $query->bindValue(":idAutista",$_SESSION["idAutista"]);
          $query->bindValue(":idViaggio",$_POST["viaggio"]);
          $query->bindValue(":data",$_POST["data"]);
          
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
          echo $e->getMessage()."<br>";
        }
      }
      else
      {
        try
        {
          $query=$dbh->prepare("SELECT * FROM Viaggio WHERE idViaggio=:idViaggio");
          $query->bindValue(":idViaggio",$_POST["viaggio"]);
          $query->execute();
          $row=$query->fetch();
          
          echo "Viaggio: ".$row["partenza"]." - ".$row["destinazione"]."<br>";
          echo "Data: ".$_POST["data"]."<br>";
        }
        catch(Exception $e)
        {
          echo $e->getMessage()."<br>";
        }
        ?>
    
    <form method="post" action="">
      <input type="hidden" name="viaggio" value="<?php echo $_POST["viaggio"] ?>">
      <input type="hidden" name="data" value="<?php echo $_POST["data"] ?>">
      <input type="hidden" name="crea" value="<?php echo true ?>">
      <input type="submit" name="send" value="Conferma">
      <input type="button" name="edit" value="Correggi" onclick="goBack()"><br>
    </form>
    
    <?php  }
    }
    else
    {
     try
     {
       $query=$dbh->prepare("SELECT * FROM Viaggio WHERE idAutista=:idAutista");
       $query->bindValue(":idAutista",$_SESSION["idAutista"]);
       $query->execute();
       
       if($query->rowCount()==0)
       {
         echo "E' neccessario aver registrato almeno un viaggio!<br>";
       }
       else
       { ?>
         
    <form name="prenotaform" method="post" action="">
      Viaggio: <select name="viaggio">
                    <?php
                    while($row=$query->fetch())
                    {
                      echo "<option value=".$row["idViaggio"].">".$row["partenza"]." - ".$row["destinazione"];
                    }
                    ?>
               </select><br>
      Data: <input type="date" name="data" required><br>
      <input type="submit" name="crea" value="Crea">
    </form>
    
       <?php }
     }
     catch(Exception $e)
     {
       echo $e->getMessage()."<br>";
     }
    }
     ?>
    
    <a href="index.php">Home</a>
  </body>
</html>
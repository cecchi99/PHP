<?php session_start(); ?>

<html>
  <head>
    <title>Car pooling</title>
  </head>
  <body>
    <script>
      function Check()
      {
        if(viaggioform.partenza.value==""||viaggioform.destinazione.value==""||viaggioform.data.value==""||viaggioform.oraPartenza.value==""||viaggioform.oraArrivo.value==""||viaggioform.importo.value==""||viaggioform.durata.value=="")
        {
          alert("Impossibile elaborare campi vuoti!");
          return false;
        }
        else if(viaggioform.partenza.value==viaggioform.destinazione.value)
        {
          alert("La citta' di partenza non puo' essere uguale a quella di destinazione!");
          return false;
        }
        else if(viaggioform.oraPartenza.value>=viaggioform.oraArrivo.value)
        {
          alert("L' ora di partenza non puo' essere maggiore o uguale a quella di arrivo!")
          return false;
        }
        else if(Number.isNaN(Number.parseFloat(viaggioform.importo.value)))
        {
          alert("L' importo deve essere un valore numerico!");
          return false;
        }
        else if(Number.isNaN(Number.parseInt(viaggioform.durata.value)))
        {
          alert("La durata deve essere un valore numerico!");
          return false;
        }
      }
      
      function goBack() 
      {
        window.history.back();
      }
    </script>
    
    <h1>Creazione viaggio</h1>
    
    <?php
    if(isset($_POST["crea"]))
    {
      if(isset($_POST["send"]))
      {
        $connection="mysql:host=localhost;dbname=quintab_cecchi";
        $username="root";
        $password="quintab";
        
        try
        {
          $dbh=new PDO($connection,$username,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          
          $query=$dbh->prepare("INSERT INTO Viaggio(partenza,destinazione,data,oraPartenza,oraArrivo,importo,durata,bagagli,animali,idAutista,idAuto) VALUES(:partenza,:destinazione,:data,:oraPartenza,:oraArrivo,:importo,:durata,:bagagli,:animali,:idAutista,:idAuto)");
          $query->bindValue(":partenza",$_POST["partenza"]);
          $query->bindValue(":destinazione",$_POST["destinazione"]);
          $query->bindValue(":data",$_POST["data"]);
          $query->bindValue(":oraPartenza",$_POST["oraPartenza"]);
          $query->bindValue(":oraArrivo",$_POST["oraArrivo"]);
          $query->bindValue(":importo",$_POST["importo"]);
          $query->bindValue(":durata",$_POST["durata"]);
          $query->bindValue(":idAuto",$_POST["auto"]);
          $query->bindValue(":bagagli",$_POST["bagagli"]);
          $query->bindValue(":animali",$_POST["animali"]);
          $query->bindValue(":idAutista",$_SESSION["idAutista"]);
          
          if($query->execute()==false)
          {
            echo "Errore nella creazione del viaggio!<br>";
          }
          else
          {
            echo "Viaggio creato correttamente!<br>";
          }
        }
        catch(Exception $e)
        {
          echo $e->getMessage()."<br>";
        }
      }
      else
      {
        $bagagli=false;
        $animali=false;
        
        echo "Partenza: ".$_POST["partenza"]."<br>";
        echo "Destinazione: ".$_POST["destinazione"]."<br>";
        echo "Data: ".$_POST["data"]."<br>";
        echo "Ora partenza: ".$_POST["oraPartenza"]."<br>";
        echo "Ora arrivo: ".$_POST["oraArrivo"]."<br>";
        echo "Importo: ".$_POST["importo"]."<br>";
        echo "Durata: ".$_POST["durata"]."<br>";
        echo "Auto: ".$_POST["auto"]."<br>";
        if(isset($_POST["bagagli"]))
        {
          echo "Bagagli: si<br>";
          $bagagli=true;
        }
        if(isset($_POST["animali"]))
        {
          echo "Animali: si<br>";
          $animali=true;
        }
    ?>
    
    <form method="post" action="">
      <input type="hidden" name="partenza" value="<?php echo $_POST["partenza"] ?>">
      <input type="hidden" name="destinazione" value="<?php echo $_POST["destinazione"] ?>">
      <input type="hidden" name="data" value="<?php echo $_POST["data"] ?>">
      <input type="hidden" name="oraPartenza" value="<?php echo $_POST["oraPartenza"] ?>">
      <input type="hidden" name="oraArrivo" value="<?php echo $_POST["oraArrivo"] ?>">
      <input type="hidden" name="importo" value="<?php echo $_POST["importo"] ?>">
      <input type="hidden" name="durata" value="<?php echo $_POST["durata"] ?>">  
      <input type="hidden" name="bagagli" value="<?php echo $bagagli ?>">
      <input type="hidden" name="animali" value="<?php echo $animali ?>">
      <input type="hidden" name="auto" value="<?php echo $_POST["auto"] ?>">
      <input type="hidden" name="crea" value="<?php echo true ?>">
      <input type="submit" name="send" value="Conferma">
      <input type="button" name="edit" value="Correggi" onclick="goBack()">
    </form>
    
      <?php }
    }
    else
    {
      try
      {
       $connection="mysql:host=localhost;dbname=quintab_cecchi";
       $username="root";
       $password="quintab"; 
        
       $dbh=new PDO($connection,$username,$password);
       $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
       $query=$dbh->prepare("SELECT * FROM Auto WHERE idAutista=:idAutista");
       $query->bindValue(":idAutista",$_SESSION["idAutista"]);
       $query->execute();
        
       if($query->rowCount()==0)
       {
         echo "E' neccessario aver registrato almeno un auto!<br>";
       }
       else
       { ?>
          
     <form name="viaggioform" method="post" action="" onsubmit="return Check()">
      Partenza: <input type="text" name="partenza"><br>
      Destinazione: <input type="text" name="destinazione"><br>
      Data: <input type="date" name="data"><br>
      Ora partenza: <input type="time" name="oraPartenza"><br>
      Ora arrivo: <input type="time" name="oraArrivo"><br>
      Importo: <input type="text" name="importo"> euro<br>
      Durata: <input type="text" name="durata"> minuti<br>
      <input type="checkbox" name="bagagli"> Bagagli<br>
      <input type="checkbox" name="animali"> Animali<br>
      Auto: <select name="auto">
                    <?php
                    while($row=$query->fetch())
                    {
                      echo "<option value=".$row["targa"].">".$row["marca"]." ".$row["modello"];
                    }
                    ?>
            </select><br>
      <input type="submit" name="crea" value="Crea viaggio">
      <input type="reset" name="delete" value="Cancella">
    </form>
    
       <?php }
      }
      catch(Exception $e)
      {
        echo $e->getMessage()."<br>";
      }
    } ?>
    
    <a href="index.php">Home</a>
  </body>
</html>
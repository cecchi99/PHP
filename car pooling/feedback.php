<?php session_start(); ?>

<html>
  <head>
    <title>Car pooling</title>
  </head>
  <body>
    <script>
      function Check()
      {
        if(feedbackform.email.value==""||feedbackform.data.value==""||feedbackform.voto.value==""||feedbackform.giudizio.value=="")
          {
            alert("Impossibile elaborare campi vuoti!");
            return false;
          }
        else if(Number.isNaN(Number.parseInt(feedbackform.voto.value)))
        {
          alert("Il voto deve essere un valore numerico!");
          return false;
        }
      }
      
      function goBack() 
      {
        window.history.back();
      }
    </script>
    
    <h1>Area feedback</h1>
    
    <?php
    $connection="mysql:host=localhost;dbname=quintab_cecchi";
    $username="root";
    $password="quintab";
    
    if(isset($_POST["send"]))
    {
      if(isset($_POST["conferma"]))
      {
        try
        {
          $dbh=new PDO($connection,$username,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          
          $query=$dbh->prepare("INSERT INTO Feedback(mittente,destinatario,data,voto,giudizio) VALUES(:mittente,:destinatario,:data,:voto,:giudizio)");
          $query->bindValue(":mittente",$_POST["mittente"]);
          $query->bindValue(":destinatario",$_POST["destinatario"]);
          $query->bindValue(":data",$_POST["data"]);
          $query->bindValue(":voto",$_POST["voto"]);
          $query->bindValue(":giudizio",$_POST["giudizio"]);
          
          if($query->execute()==false)
          {
            echo "Errore nella scrittura del feedback!<br>";
          }
          else
          {
            echo "Feedback creato correttamente!<br>";
          }
        }
        catch(Exception $e)
        {
          echo $e->getMessage()."<br>";
        }
      }
      else
      {
        echo "Mittente: ".$_SESSION["email"]."<br>";
        echo "Destinatario: ".$_POST["email"]."<br>";
        echo "Data: ".$_POST["data"]."<br>";
        echo "Voto: ".$_POST["voto"]."<br>";
        echo "Giudizio: ".$_POST["giudizio"]."<br>";
        ?>
    
    <form method="post" action="">
      <input type="hidden" name="mittente" value="<?php echo $_SESSION["email"] ?>">
      <input type="hidden" name="destinatario" value="<?php echo $_POST["email"]?>">
      <input type="hidden" name="data" value="<?php echo $_POST["data"] ?>">
      <input type="hidden" name="voto" value="<?php echo $_POST["voto"] ?>">
      <input type="hidden" name="giudizio" value="<?php echo $_POST["giudizio"] ?>">
      <input type="hidden" name="send" value="<?php echo true ?>">
      <input type="submit" name="conferma" value="Conferma">
      <input type="button" name="edit" value="Correggi" onclick="goBack()">
    </form>
    
    <?php  }
    }
    else
    { 
     echo "<h2>Feedback ricevuti</h2>";
     try
    {
      $dbh=new PDO($connection,$username,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $query=$dbh->prepare("SELECT * FROM Feedback WHERE destinatario=:destinatario");
      $query->bindValue(":destinatario",$_SESSION["email"]);
      $query->execute();
      
      if($query->rowCount()==0)
      {
        echo "Non hai ancora nessun feedback!<br>";
      }
      else
      {
        while($row=$query->fetch())
        {
          echo "Feedback di: ".$row["mittente"]."<br>";
          echo "Data: ".$row["data"]."<br>";
          echo "Voto: ".$row["voto"]."<br>";
          echo "Giudizio: ".$row["giudizio"]."<br>";
          echo "<br>";
        }
      }
    }
    catch(Exception $e)
    {
      echo $e->getMessage()."<br>";
    }
     ?>
    
    <h2>Scrivi feedback</h2>
    <form name="feedbackform" method="post" action="" onsubmit="return Check()">
      <?php
      if($_SESSION["tipo"]=="passeggero")
      { 
        echo "Email autista: ";
      }
      else
      { 
        echo "Email passeggero: "; 
      } ?>
      <input type="email" name="email"><br>
      Data: <input type="date" name="data"><br>
      Voto: <input type="text" name="voto"><br>
      Giudizio: <input type="text" name="giudizio"><br>
      <input type="submit" name="send" value="Invia">
      <input type="reset" name="delete" value="Cancella">
    </form>
    
    <?php } ?>
    
    <a href="index.php">Home</a>
  </body>
</html>
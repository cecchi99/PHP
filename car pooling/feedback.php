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
    
    <hi>Feedback</hi>
    
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
          
          $query=$dbh->prepare("INSERT INTO Feedback(idPasseggero,idAutista,data,voto,giudizio) VALUES(:idPasseggero,:idAutista,:data,:voto,:giudizio)");
          $query->bindValue(":idPasseggero",$_POST["passeggero"]);
          $query->bindValue(":idAutista",$_POST["autista"]);
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
        
        if($_SESSION["tipo"]=="passeggero")
        {
          $autista=$_POST["email"];
          $passeggero=$_SESSION["idPasseggero"];
        }
        else
        {
          $autista=$_SESSION["idAutista"];
          $passeggero=$_POST["email"];
        }      
        ?>
    
    <form method="post" action="">
      <input type="hidden" name="passeggero" value="<?php echo $passeggero?>">
      <input type="hidden" name="autista" value="<?php echo $autista?>">
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
    { ?>
    
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
      <input type="submit" name="send" value="Invia"><br>
      <input type="reset" name="delete" value="Cancella">
    </form>
    
    <?php } ?>
    
    <a href="index.php">Home</a>
  </body>
</html>
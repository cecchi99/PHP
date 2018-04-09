<?php session_start(); 
include "connection.php";
?>

<html>
  <head>
    <title>DriveLend</title>
  </head>
  <body>
    <script>
      function Check()
      {
        if(Number.isNaN(Number.parseInt(autoform.cilindrata.value))||Number.isNaN(Number.parseFloat(autoform.potenza.value)))
          {
            alert("Cilindrata e potenza devono essere valori numerici!");
            return false;
          }
      }
      
      function goBack() 
      {
        window.history.back();
      }
    </script>
    
    <h1>Registrazione auto</h1>
    
    <?php
    if(isset($_POST["register"]))
    {
      if(isset($_POST["send"]))
      {
        try
        {
          $query=$dbh->prepare("INSERT INTO Auto(targa,marca,modello,cilindrata,potenza,idAutista) VALUES(:targa,:marca,:modello,:cilindrata,:potenza,:idAutista)");
          $query->bindValue(":targa",$_POST["targa"]);
          $query->bindValue(":marca",$_POST["marca"]);
          $query->bindValue(":modello",$_POST["modello"]);
          $query->bindValue(":cilindrata",$_POST["cilindrata"]);
          $query->bindValue(":potenza",$_POST["potenza"]);
          $query->bindValue(":idAutista",$_SESSION["idAutista"]);
          
          if($query->execute()==false)
          {
            echo "Errore nella registrazione dell' auto!<br>";
          }
          else
          {
            echo "Auto registrata correttamente!<br>";
          }
        }
        catch(Exception $e)
        {
          echo $e->getMessage()."<br>";
        } 
      }
      else
      {
        echo "Targa: ".$_POST["targa"]."<br>";
        echo "Marca: ".$_POST["marca"]."<br>";
        echo "Modello: ".$_POST["modello"]."<br>";
        echo "Cilindrata: ".$_POST["cilindrata"]."<br>";
        echo "Potenza: ".$_POST["potenza"]."<br>";
        ?>
    
    <form name="autoform" method="post" action="">
      <input type="hidden" name="targa" value="<?php echo $_POST["targa"] ?>">
      <input type="hidden" name="marca" value="<?php echo $_POST["marca"] ?>">
      <input type="hidden" name="modello" value="<?php echo $_POST["modello"] ?>">
      <input type="hidden" name="cilindrata" value="<?php echo $_POST["cilindrata"] ?>">
      <input type="hidden" name="potenza" value="<?php echo $_POST["potenza"] ?>">
      <input type="hidden" name="register" value="<?php echo true ?>">
      <input type="submit" name="send" value="Conferma">
      <input type="button" name="edit" value="Correggi" onclick="goBack()"><br>
    </form>
    
    <?php
      }
    }
    else
    {
    ?> 
      
    <form name="autoform" method="post" action="" onsubmit="return Check()">
      Targa: <input type="text" name="targa" required><br>
      Marca: <input type="text" name="marca" required><br>
      Modello: <input type="text" name="modello" required><br>
      Cilindrata: <input type="text" name="cilindrata" required><br>
      Potenza: <input type="text" name="potenza" required><br>
      <input type="submit" name="register" value="Registra">
      <input type="reset" name="delete" value="Cancella"><br>
    </form>
    
    <?php } ?>
    
    <a href="index.php">Home</a> 
  </body>
</html>
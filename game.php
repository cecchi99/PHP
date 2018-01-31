<!doctype html>
<html>
  <head>
    <title>Gioco dell'indovina-numero</title>
  </head>
  <body>
    <h1>Gioco dell'indovina-numero</h1>
    
    <?php
     if(isset($_GET["send"])==false)
     {
       $_GET["tentativi"]=1;
       $_GET["number"]=rand(1,100);
     }
    
     echo $_GET["number"];
    
     if($_GET["tentativi"]==7)
     {
       echo "fine tentativi!"."<br/>";
     }
     else if(isset($_GET["user_number"]))
     {
       $_GET["tentativi"]++;
       
       if($_GET["user_number"]>$_GET["number"])
       {
         echo "Il numero è troppo grande!"."<br/>";
       }
       else if ($_GET["user_number"]<$_GET["number"])
       {
         echo "Il numero è troppo piccolo!"."<br/>";
       }
       else
       {
         echo "indovinato!"."<br/>";
       }
     }
    
     echo "Tentativo n.".$_GET["tentativi"]."<br/>";
    ?>
    
    <b>Inserisci il numero</b>
    <form method="get" action="">
      <input type="text" name="user_number">
      <input type="hidden" name="tentativi" value="<?php echo $_GET["tentativi"] ?>">
      <input type="hidden" name="number" value="<?php echo $_GET["number"] ?>">
      <input type="submit" name="send" value="Conferma">
    </form>
  </body>
</html>
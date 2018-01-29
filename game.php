<!doctype html>
<html>
  <head>
    <title>Gioco dell'indovina-numero</title>
  </head>
  <body>
    <h1>Gioco dell'indovina-numero</h1>
    
    <?php
     $number=30;
    
     if(isset($_GET["send"])==false)
     {
       $_GET["tentativi"]=1;
     }
    
     if(isset($_GET["user_number"]))
     {
       $_GET["tentativi"]++;
       
       if($_GET["user_number"]>$number)
       {
         echo "Il numero è troppo grande!"."<br/>";
       }
       else if ($_GET["user_number"]<$number)
       {
         echo "Il numero è troppo piccolo!"."<br/>";
       }
     }
    
     echo "Tentativo n.".$_GET["tentativi"]."<br/>";
    ?>
    
    <b>Inserisci il numero</b>
    <form method="get" action="">
      <input type="text" name="user_number">
      <input type="hidden" name="tentativi" value="<?php echo $_GET["tentativi"] ?>">
      <input type="submit" name="send" value="Conferma">
    </form>
  </body>
</html>
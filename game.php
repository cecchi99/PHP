<!doctype html>
<html>
  <head>
    <title>Gioco dell'indovina-numero</title>
  </head>
  <body>
    
    <?php
     $tentativi;
     $number=30;
     $indizio="";
     if(isset($_POST["send"])==false)
     {
       $tentativi=0;
     }
     if(isset($_POST["user_number"]))
     {
       $tentativi++;
       
       if($_POST["user_number"]>$number)
       {
         $indizio="Il numero è troppo grande!";
       }
       else if ($_POST["user_number"]<$number)
       {
         $indizio="Il numero è troppo piccolo!";
       }
     }
    ?>
    
    <h1>Gioco dell'indovina-numero</h1>
    <?php echo ($indizio) ?>
    <p>Tentativo n.<?php echo ($tentativi) ?></p>
    <b>Inserisci il numero</b>
    <form method="post" action="">
      <input type="text" name="user_number">
      <input type="submit" name="send" value="Conferma">
    </form>
  </body>
</html>
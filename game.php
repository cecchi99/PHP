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
    
     if($_GET["tentativi"]==7)
     {
       ?>
         <h2>Spiacenti...</h2>
         <p>hai superato il max di 7 tentativi.</p>
         <form method="get" action="index.html">
           <input type="submit" name="restart" value="Gioca di nuovo">
         </form>
       <?php
     }
     else if(isset($_GET["user_number"]))
     {
       if($_GET["user_number"]>$_GET["number"])
       {
         echo "Il numero e' troppo grande!"."<br/>";
       }
       else if ($_GET["user_number"]<$_GET["number"])
       {
         echo "Il numero e' troppo piccolo!"."<br/>";
       }
       else
       {?>
         <h2>BRAVO!</h2>
         <p>Hai indovinato in <?php echo $_GET["tentativi"] ?> tentativi.</p>
         <form method="get" action="index.html">
           <input type="submit" name="restart" value="Gioca di nuovo">
         </form>
       <?php
       }
       
       $_GET["tentativi"]++;
     }
    ?>
    
    <p>Tentativo n.<?php echo $_GET["tentativi"] ?></p>
    <b>Inserisci il numero</b>
    <form method="get" action="">
      <input type="text" name="user_number">
      <input type="hidden" name="tentativi" value="<?php echo $_GET["tentativi"] ?>">
      <input type="hidden" name="number" value="<?php echo $_GET["number"] ?>">
      <input type="submit" name="send" value="Conferma">
    </form>
  </body>
</html>
<!doctype html>
<html>
  <head>
    <title>Gioco dell'indovina-numero</title>
  </head>
  <body>
    <h1>Gioco dell'indovina-numero</h1>
    
    <?php
    if(isset($_POST["send"]))
    {
     if($_POST["tentativi"]==7)
     {
       ?>
         <h2>Spiacenti...</h2>
         <p>hai superato il max di 7 tentativi.</p>
         <form method="get" action="index.html">
           <input type="submit" name="restart" value="Gioca di nuovo">
         </form>
       <?php
     }
     else 
     {
       if($_POST["user_number"]==$_POST["number"])
       {
         ?>
         <h2>BRAVO!</h2>
         <p>Hai indovinato in <?php echo $_POST["tentativi"] ?> tentativi.</p>
         <form method="get" action="index.html">
           <input type="submit" name="restart" value="Gioca di nuovo">
         </form>
       <?php
       }
       else
       {
         $_POST["tentativi"]++;
         
         if($_POST["user_number"]>$_POST["number"])
         {
           echo "Il numero e' troppo grande!"."<br/>";?>
       
           <p>Tentativo n.<?php echo $_POST["tentativi"] ?></p>
           <b>Inserisci il numero</b>
           <form method="post" action="">
            <input type="text" name="user_number">
            <input type="hidden" name="tentativi" value="<?php echo $_POST["tentativi"] ?>">
            <input type="hidden" name="number" value="<?php echo $_POST["number"] ?>">
            <input type="submit" name="send" value="Conferma">
           </form>
    
    <?php }
       else if ($_POST["user_number"]<$_POST["number"])
       {
         echo "Il numero e' troppo piccolo!"."<br/>";?>
       
         <p>Tentativo n.<?php echo $_POST["tentativi"] ?></p>
         <b>Inserisci il numero</b>
         <form method="post" action="">
          <input type="text" name="user_number">
          <input type="hidden" name="tentativi" value="<?php echo $_POST["tentativi"] ?>">
          <input type="hidden" name="number" value="<?php echo $_POST["number"] ?>">
          <input type="submit" name="send" value="Conferma">
         </form>
    
    <?php } 
       }
     }
    }
    else
     {
       $_POST["tentativi"]=1;
       $_POST["number"]=rand(1,100);?>
    
       <p>Tentativo n.<?php echo $_POST["tentativi"] ?></p>
       <b>Inserisci il numero</b>
    <form method="post" action="">
      <input type="text" name="user_number">
      <input type="hidden" name="tentativi" value="<?php echo $_POST["tentativi"] ?>">
      <input type="hidden" name="number" value="<?php echo $_POST["number"] ?>">
      <input type="submit" name="send" value="Conferma">
    </form>
    
    <?php }
    ?>
   
  </body>
</html>
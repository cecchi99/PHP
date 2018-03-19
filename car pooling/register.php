<html>
  <head>
    <title>Car pooling</title>
  </head>
  <body>
    
    <script>
      function Check()
      {
        if(registerform.cognome.value==""||registerform.nome.value==""||registerform.email.value==""||registerform.password.value==""||registerform.telefono.value==""||registerform.nascita.value=="")
        {
          alert("Impossibile elaborare campi vuoti!");
          return false;
        }
        else if(registerform.password.value!=registerform.check_password.value)
        {
          alert("Le password non coincidono!");
          return false;
        }
      }
      
      function goBack() 
      {
        window.history.back();
      }
    </script>
    
    <h1>Registrazione</h1>
    
    <?php
    $connection="mysql:host=localhost;dbname=quintab_cecchi";
    $username="root";
    $password="quintab";
    
    if(isset($_POST["register"]))
    {
      if(isset($_POST["send"]))
      {
        try
        {
          $dbh=new PDO($connection,$username,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
          if($_POST["tipo"]=="passeggero")
          {
            $query=$dbh->prepare("INSERT INTO Passeggero(cognome,nome,email,password,telefono,dataNascita,sesso,nazionalita) VALUES (:cognome,:nome,:email,:password,:telefono,:dataNascita,:sesso,:nazionalita)");
        
            $query->bindValue(":cognome",$_POST["cognome"]);
            $query->bindValue(":nome",$_POST["nome"]);
            $query->bindValue(":email",$_POST["email"]);
            $query->bindValue(":password",md5($_POST["password"]));
            $query->bindValue(":telefono",$_POST["telefono"]);
            $query->bindValue(":dataNascita",$_POST["nascita"]);
            $query->bindValue(":sesso",$_POST["sesso"]);
            $query->bindValue(":nazionalita",$_POST["nazionalita"]);
          }
          else
          {
            $query=$dbh->prepare("INSERT INTO Autista(cognome,nome,email,password,telefono,dataNascita,sesso,nazionalita,numeroPatente,scadenzaPatente) VALUES (:cognome,:nome,:email,:password,:telefono,:dataNascita,:sesso,:nazionalita,:numeroPatente,:scadenzaPatente)");
        
            $query->bindValue(":cognome",$_POST["cognome"]);
            $query->bindValue(":nome",$_POST["nome"]);
            $query->bindValue(":email",$_POST["email"]);
            $query->bindValue(":password",md5($_POST["password"]));
            $query->bindValue(":telefono",$_POST["telefono"]);
            $query->bindValue(":dataNascita",$_POST["nascita"]);
            $query->bindValue(":sesso",$_POST["sesso"]);
            $query->bindValue(":nazionalita",$_POST["nazionalita"]);
            $query->bindValue(":numeroPatente",$_POST["patente"]);
            $query->bindValue(":scadenzaPatente",$_POST["scadenza"]);
         }
      
         if($query->execute()==false)
         {
           echo "Errore nella registrazione!<br>";
         }
         else
         {
           echo "Registrazione ".$_POST["tipo"]." completata!<br>";
         }
        }
        catch(exception $e)
        {
          echo $e->getMessage();
        }
      }
      else
      {
        echo "Cognome: ".$_POST["cognome"]."<br>";
        echo "Nome: ".$_POST["nome"]."<br>";
        echo "Email: ".$_POST["email"]."<br>";
        echo "Telefono: ".$_POST["telefono"]."<br>";
        echo "Data di nascita: ".$_POST["nascita"]."<br>";
        echo "Sesso: ".$_POST["sesso"]."<br>";
        echo "Nazionalita': ".$_POST["nazionalita"]."<br>";
    
        if($_POST["tipo"]=="autista")
        {
          echo "Numero patente: ".$_POST["patente"]."<br>";
          echo "scadenza patente: ".$_POST["scadenza"]."<br>";
        } ?>
    
    <form method="post" action="">
      <input type="hidden" name="tipo" value="<?php echo $_POST["tipo"] ?>">
      <input type="hidden" name="cognome" value="<?php echo $_POST["cognome"] ?>">
      <input type="hidden" name="nome" value="<?php echo $_POST["nome"] ?>">
      <input type="hidden" name="email" value="<?php echo $_POST["email"] ?>">
      <input type="hidden" name="password" value="<?php echo $_POST["password"] ?>">
      <input type="hidden" name="telefono" value="<?php echo $_POST["telefono"] ?>">
      <input type="hidden" name="nascita" value="<?php echo $_POST["nascita"] ?>">  
      <input type="hidden" name="sesso" value="<?php echo $_POST["sesso"] ?>">
      <input type="hidden" name="nazionalita" value="<?php echo $_POST["nazionalita"] ?>">
      <input type="hidden" name="patente" value="<?php echo $_POST["patente"] ?>">
      <input type="hidden" name="scadenza" value="<?php echo $_POST["scadenza"] ?>">
      <input type="hidden" name="register" value="<?php echo true ?>">
      <input type="submit" name="send" value="Conferma">
      <input type="button" name="edit" value="Correggi" onclick="goBack()">
    </form>
    
    <?php  }
    }
    else
    {
      try
      {
        $dbh=new PDO($connection,$username,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
        $query=$dbh->prepare("SELECT nome_stati FROM stati");
        $query->execute();
      }
      catch(Exception $e)
      {
        echo $e->getMessage();
      }
    ?>
    
    <form name="registerform" method="post" action="" onsubmit="return Check()">
      Tipo utente: <input type="radio" name="tipo" value="passeggero" checked>Passeggero <input type="radio" name="tipo" value="autista">Autista<br>
      Cognome: <input type="text" name="nome"><br>
      Nome: <input type="text" name="cognome"><br>
      Email: <input type="email" name="email"><br>
      Password: <input type="password" name="password"><br>
      Conferma password: <input type="password" name="check_password"><br>
      Telefono: <input type="text" name="telefono"><br>
      Data di nascita: <input type="date" name="nascita"><br>
      Sesso: <input type="radio" name="sesso" value="m" checked>Maschio <input type="radio" name="sesso" value="f">Femmina<br>
      Nazionalita': <select name="nazionalita">
                    <?php
                    while($row=$query->fetch())
                    {
                      echo "<option value=".$row["nome_stati"].">".$row["nome_stati"];
                    }
                    ?>
                    </select><br>
      Numero patente: <input type="text" name="patente"><br>
      Scadenza patente: <input type="date" name="scadenza"><br> 
      <input type="submit" name="register" value="Registra">
      <input type="reset" name="delete" value="Cancella"><br>
      
      <?php } ?>
      
      <a href="index.php">Home</a>
    </form>
  </body>
</html>
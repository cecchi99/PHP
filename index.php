<html>
  <head>
    <title>Modulo di iscrizione</title>
  </head>
  <body>
    
    <script>
      function Check()
      {
        if(form.cognome.value==""||form.nome.value==""||form.email.value==""||form.password.value==""||form.check_password.value=="")
        {
          alert("Impossibile elaborare campi vuoti!");
          return false;
        }
        else if(form.password.value!=form.check_password.value)
        {
          alert("Le password non coincidono!");
          return false;
        }
        return true;
      }
    </script>
    
    <h1>Modulo di iscrizione</h1>
    <form name="form" method="post" action="riepilogo.php" onsubmit="return Check()">
      Cognome: <input type="text" name="cognome"><br>
      Nome: <input type="text" name="nome"><br>
      Sesso: <input type="radio" name="sesso" value="maschio" checked>Maschile  <input type="radio" name="sesso" value="femmina">Femminile<br>
      Nazionalita': <select name="nazionalita">
                     <option value="italiana">Italiana</option>
                     <option value="inglese">Inglese</option>
                     <option value="americana">Americana</option>
                     <option value="francese">Francese</option>
                     <option value="spagnola">Spagnola</option>
                     <option value="tedesca">Tedesca</option>
                     <option value="cinese">Cinese</option>
                     <option value="giapponese">Giapponese</option>
                    </select><br>
      Patente: <input type="checkbox" name="patente_a" value="cat. A">cat. A <input type="checkbox" name="patente_b" value="cat. B">cat. B<br>
      e-Mail: <input type="email" name="email"><br>
      Password: <input type="password" name="password"><br>
      Verifica password: <input type="password" name="check_password"><br>
      <input type="reset" name="delete" value="Annulla">
      <input type="submit" name="send" value="Conferma">
    </form>
  </body>
</html>
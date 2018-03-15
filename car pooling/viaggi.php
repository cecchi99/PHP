<html>
  <head>
    <title>Car pooling</title>
  </head>
  <body>
    <script>
      function Check()
      {
        if(viaggioform.partenza.value==""||viaggioform.destinazione.value==""||viaggioform.data.value==""||viaggioform.oraPartenza.value==""||viaggioform.oraArrivo.value==""||viaggioform.importo.value==""||viaggioform.durata.value=="")
        {
          alert("Impossibile elaborare campi vuoti!");
          return false;
        }
        
        else if(Number.isNaN(Number.parseFloat(viaggioform.importo.value)))
        {
          alert("L' importo deve essere un valore decimale!");
          return false;
        }
      }
    </script>
    
    <h1>Creazione viaggio</h1>
    
    <form name="viaggioform" method="post" action="" onsubmit="return Check()">
      Partenza: <input type="text" name="partenza"><br>
      Destinazione: <input type="text" name="destinazione"><br>
      Data: <input type="date" name="data"><br>
      Ora partenza: <input type="time" name="oraPartenza"><br>
      Ora arrivo: <input type="time" name="oraArrivo"><br>
      Importo: <input type="text" name="importo"> euro<br>
      Durata: <input type="text" name="durata"> minuti<br>
      <input type="checkbox" name="bagagli"> Bagagli<br>
      <input type="checkbox" name="animali"> Animali<br>
      <input type="submit" name="crea" value="Crea viaggio">
      <input type="reset" name="delete" value="Cancella">
    </form>
    
    <a href="index.php">Home</a>
  </body>
</html>
<?php
include "connection.php";

try
{
  $query=$dbh->prepare("INSERT INTO Cinema(nome,posti,citta) VALUES(:nome,:posti,:citta)");
  $query->bindValue(":nome",$_GET["nome"]);
  $query->bindValue(":posti",$_GET["posti"]);
  $query->bindValue(":citta",$_GET["citta"]);
  $query->execute();
  echo json_encode(true);
}
catch(Exception $e)
{
  echo json_encode($e->getMessage());
}
?>
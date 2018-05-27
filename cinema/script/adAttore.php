<?php
include "connection.php";

try
{
  $query=$dbh->prepare("INSERT INTO Attore(cognome,nome,sesso,annoNascita,nazionalita) VALUES(:cognome,:nome,:sesso,:annoNascita,:nazionalita)");
  $query->bindValue(":cognome",$_GET["cognome"]);
  $query->bindValue(":nome",$_GET["nome"]);
  $query->bindValue(":sesso",$_GET["sesso"]);
  $query->bindValue(":annoNascita",$_GET["annoNascita"]);
  $query->bindValue(":nazionalita",$_GET["nazionalita"]);
  $query->execute();
  echo json_encode(true);
}
catch(Exception $e)
{
  echo json_encode($e->getMessage());
}
?>
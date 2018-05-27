<?php
include "connection.php";

try
{
  $query=$dbh->prepare("INSERT INTO Film(titolo,annoProduzione,luogoProduzione,cognomeRegista,genere) VALUES(:titolo,:annoProduzione,:luogoProduzione,:cognomeRegista,:genere)");
  $query->bindValue(":titolo",$_GET["titolo"]);
  $query->bindValue(":annoProduzione",$_GET["annoProduzione"]);
  $query->bindValue(":luogoProduzione",$_GET["luogoProduzione"]);
  $query->bindValue(":cognomeRegista",$_GET["cognomeRegista"]);
  $query->bindValue(":genere",$_GET["genere"]);
  $query->execute();
  echo json_encode(true);
}
catch(Exception $e)
{
  echo json_encode($e->getMessage());
}
?>
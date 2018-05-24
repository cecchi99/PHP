<?php
include "connection.php";

try
{
  $query=$dbh->prepare("SELECT DISTINCT dataProiezione FROM Programmato");
  $query->execute();
  echo json_encode($query->fetchAll());
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>
<?php
include "connection.php";

try
{
  $query=$dbh->prepare("SELECT codCinema,nome FROM Cinema");
  $query->execute();
  echo json_encode($query->fetchAll());
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>
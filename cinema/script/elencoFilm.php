<?php
include "connection.php";

try
{
  $query=$dbh->prepare("SELECT codFilm,titolo FROM Film");
  $query->execute();
  echo json_encode($query->fetchAll());
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>
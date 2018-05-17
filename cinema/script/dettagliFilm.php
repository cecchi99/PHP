<?php
include "connection.php";

try
{
  $query=$dbh->prepare("SELECT * FROM Film WHERE codFilm=:idFilm");
  $query->bindValue(":idFilm",$_GET["idFilm"]);
  $query->execute();
  echo json_encode($query->fetch());
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>
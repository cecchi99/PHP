<?php
include "connection.php";

try
{
  $query=$dbh->prepare("SELECT * FROM Attore a INNER JOIN Interpreta i ON a.codAttore=i.codAttore WHERE i.codFilm=:idFilm");
  $query->bindValue(":idFilm",$_GET["idFilm"]);
  $query->execute();
  echo json_encode($query->fetchAll());
}
catch(Exception $ex)
{
  echo $ex->getMessage();
}
?>
<?php
include "connection.php";

try
{
  $query=$dbh->prepare("SELECT f.titolo,c.nome,c.citta FROM Film f INNER JOIN Programmato p ON f.codFilm=p.codFilm INNER JOIN Cinema c ON c.codCinema=p.codCinema WHERE p.codProg=:codProg");
  $query->bindValue(":codProg",$_GET["codProg"]);
  $query->execute();
  echo json_encode($query->fetch());
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>
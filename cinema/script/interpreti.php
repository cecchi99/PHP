<?php
include "connection.php";

try
{
  $query=$dbh->prepare("SELECT * FROM Attore a INNER JOIN Interpreta i ON a.codAttore=i.codAttore WHERE i.codFilm=:idFilm");
  $query->bindValue(":idFilm",$_GET["idFilm"]);
  $query->execute();
  $row=$query->fetchAll();
  if($row==[])
  {
    echo json_encode(false);
  }
  else
  {
    echo json_encode($row);
  }
}
catch(Exception $ex)
{
  echo $ex->getMessage();
}
?>
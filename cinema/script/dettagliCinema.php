<?php
include "connection.php";

try
{
  $query=$dbh->prepare("SELECT * FROM Cinema WHERE codCinema=:codCinema");
  $query->bindValue(":codCinema",$_GET["codCinema"]);
  $query->execute();
  echo json_encode($query->fetch());
}
catch(Exception $ex)
{
  echo $ex->getMessage();
}
?>
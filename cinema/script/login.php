<?php
include "connection.php";

try
{
  $query=$dbh->prepare("SELECT * FROM Admin WHERE email=:email AND password=:password");
  $query->bindValue(":email",$_GET["email"]);
  $query->bindValue(":password",$_GET["password"]);
  $query->execute();
  $row=$query->fetch();
  if($row==0)
  {
    echo json_encode(false);
  }
  else
  {
    echo json_encode($row);
  }
}
catch(Exception $e)
{
  echo json_encode($e->getMessage());
}
?>
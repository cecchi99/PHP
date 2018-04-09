<?php
$connection="mysql:host=localhost;dbname=quintab_cecchi";
$username="root";
$password="quintab";

try
{
  $dbh=new PDO($connection,$username,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>
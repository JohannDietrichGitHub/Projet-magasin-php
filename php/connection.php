<?php
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "bricobrac";

try
{
     $conn = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $conn->exec("set names utf8mb4");
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}
?>
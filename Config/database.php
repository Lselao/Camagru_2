<?php
// connecting to db

$db_server = "localhost";
// $db_user = "home";
$db_user = "root";
$db_name = "camagru";
$db_password = "root1";
$db_driver = "mysql";

try
{
    $conn = new PDO("$db_driver:host=$db_server;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>


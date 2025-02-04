<?php
   require 'database.php';
   

    try {
        $conn = new PDO("mysql:host=$db_server", $db_user, $db_password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE camagru";
        $conn->exec($sql);
        echo "Database created successfully<br>";
        }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
   
    
    $sql = "USE camagru";
    $conn->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS`users` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `email` tinytext NOT NULL,
    `pass` longtext NOT NULL,
    `vkey` varchar(255) NOT NULL,
    `verified` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0',
    `createdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
    )";

    $conn->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS `comments` (
        `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
        `user`varchar(255) NOT NULL,
        `img`  varchar(255) NOT NULL,
        `comments` varchar(255) NOT NULL
    )";
    
    $conn->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS likes (
        `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
        `user_id` INT(11),
        `img_id` varchar(255)
    )";
    $conn->exec($sql);
    
    $sql = "CREATE TABLE  IF NOT EXISTS`images` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` varchar(255) NOT NULL,
    `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `picture` varchar(100) NOT NULL
    )";
    $conn->exec($sql);

    header("Location: ../Forms/login.php");
    
?>

<?php

    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

  if (isset($_POST['login']))
  {
    require("../Config/connection.php");
    $username = $_POST["username"];
    $password = $_POST["password"];

    $password = md5($password);

     $error = NULL;
  
        if (empty($_POST["username"]) || empty($_POST["password"]))
        {
            $message = '<label>ALL fields are required</label>';
        }
        else {
            $sql = "SELECT * FROM users WHERE username = ? AND pass = ? AND verified = 1";
            $stmt= $conn->prepare($sql);
            // $stmt->bindParam(':uname', $username);
            // $stmt->bindParam(':pass', $password);
            $stmt->execute([$username, $password]);
            echo "<br> ";
            
           // $rot = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            $count = $stmt->fetchAll();
        
             if(!empty($count))
            {
                $_SESSION["username"] = $_POST["username"];
                header("location:../Forms/fileUpload.php");
            }
            else {
                 $message = '<label>Wrong Data</label>';
             }
        }
        $conn = null;
    }


?>
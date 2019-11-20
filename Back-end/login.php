<?php

    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

  if (isset($_POST['login']))
  {
    require("../Config/database.php");
    $username = $_POST["username"];
    $password = $_POST["password"];

     $error = NULL;
  
        if (empty($_POST["username"]) || empty($_POST["password"]))
        {
            $message = '<label>ALL fields are required</label>';
        }
        else 
        {
            $password = md5($password);
            $sql = "SELECT * FROM users WHERE username = ? AND pass = ? AND verified = 1 LIMIT 1";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $password);
            $user = $stmt->fetch();
            if ($stmt->rowCount() > 0)
            {
                $_SESSION["login"]["id"] = $user["id"];
                $_SESSION["login"]["email"] = $user["email"];
                $_SESSION["login"]["username"] = $user["username"];
                $_SESSION["username"] = $user["username"];
                echo 'OK';
                header("..Forms/gallery.php");
            }
            else
            {
                echo "ERROR";
            }
            echo "<br>$username<br>$password";
        }
        $conn = null;
    }


?>



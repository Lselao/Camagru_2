<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

    if(isset($_POST['reset'])){
            require_once('../Config/database.php');

            $password = md5($_POST['password_1']);
            $password2 = md5($_POST['password_2']);
            if ($password == $password2){
                $sql = "UPDATE users SET pass = ? WHERE vkey= ?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $password);
                $stmt->bindParam(1, $vkey);
                $result = $stmt->execute([$password,$vkey]);
                header("Location: ../Forms/login.php");
            }
            else  
            {
                echo "Password doesn't Match";   
            }    
}
?>
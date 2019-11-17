<?php
     session_start();
    require '../Config/connection.php';
    

   if (isset($_GET['vkey'])) {
       //Process Verification
       $vkey = $_GET['vkey'];
       
    $sql = "SELECT verified , vkey FROM users WHERE verified = 0 AND vkey = ? LIMIT 1" ;
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(1, $vkey);
    $stmt->execute();
       
    if (count($stmt->fetchAll()) == 1)
    {
        // Validate the email

        $sql = "UPDATE users SET verified = 1 WHERE vkey = ? LIMIT 1";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(1, $vkey);
        
        if ($stmt->execute()){
            $_SESSION['message'] = "Your account has been verified. you may now login.";
        }else{
            $_SESSION['message'] = "Your account has not login";
        }

    }else{
        $_SESSION['message'] = "This account is invalid or already verified";
    }
   }
   else{
       $_SESSION['message'] = "Congradulation you have successfully hacked us !!!!";
   }
    header("Location: ../Views/verifyemail.php");
?>

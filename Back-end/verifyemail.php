<?php
     session_start();
    require '../Config/database.php';
    

   if (isset($_GET['vkey'])) {
       //Process Verification
       echo $vkey = $_GET['vkey'];
       
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
            $_SESSION['message'] = "Account verified.";
        }else{
            $_SESSION['message'] = "Account not loged in";
        }

    }else{
        $_SESSION['message'] = " Invalid account / acoount already verified";
    }
   }
   else{
       $_SESSION['message'] = "Unrestricted access";
   }
    header("Location: ../Forms/verifyemail.php");
?>

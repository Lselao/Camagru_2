<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();
require '../Config/database.php';

 if (isset($_GET['vkey'])) {
       //Process Verification
       $vkey = $_GET['vkey'];
       
    $sql = "SELECT id FROM users WHERE vkey = ?" ;
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(1, $vkey);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo "Change your password ";
    // echo '</br><a href="../Forms/changepassword.php">Click here</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    header("Location:../Forms/changepassword.php?vkey=$vkey");
    
    // if ($result == TRUE)
    // {
    //     $_SESSION['userid'] = $result['id'];  die($_SESSION['userid']);
    //     header("Location:../Forms/changepassword.php");
  
    // }
 }
 ?>
<?php
    require("../Config/database.php");
        
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    
    //is the form been submitted
if (isset($_POST['register']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password_1'];
    $password_1 = md5($_POST['password_1']);
    $password_2 = md5($_POST['password_2']);
    $sql = "SELECT * FROM `users` WHERE `username` = ? OR `email` = ?";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $email);
    $stmt->execute();

    // die(" ". . " " .);

    if (strlen($password) <= 5) {
        echo  "Password Must have 5 Characters or more!";
    }

    if (count($stmt->fetchAll()) > 0){
        $_SESSION['error'] = "$username is already taken";
        // echo "sql/database error";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
           echo "Not a valid mail";
       }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
           echo "invalid email & username";
       }
    else if ($password_1 != $password_2)
        {
          echo "password doesn't match";
        }
    else if (empty($username) || empty($email) || empty($password_1) || empty($password_2))
    {
        echo "missing information";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        echo "Password Must Have 1 Lowercase Letter!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $passwordErr = "Password Must have 1 Capital Letter!";
    }
    // elseif(!preg_match("#[0-9]+#",$password)) {
    //     $passwordErr = "Your Password Must Contain At Least 1 Number!";
    // }

    else
    {
       
        //Generate Vkey
        $vkey = md5(time().$username);
        $password = md5($password_1);
        $sql = "INSERT INTO  users (username, email, pass, vkey) VALUES (?, ?, ?, ?)";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $password_1);
        $stmt->bindParam(4, $vkey);
        if($stmt->execute())
        {
            $_POST['password_1'];
        }
        else
        {
            echo "sql/database error";
        }
        $stmt = null;
        $conn = null;

        // the message
        $msg = "Registration Successul. We have sent a verification email to the address provided<br>
        <a href=http://localhost:8081/Camagru_2/Back-end/verifyemail.php?vkey=$vkey>confirm</a>";
        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);
        // send email
        mail($email,"verify",$msg);
    }
    
}

?>  
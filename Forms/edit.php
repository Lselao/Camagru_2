<?php
   session_start();

if (!issset($_SESSION['login']))
{
    header('location: login.php');
}

require '../Config/database.php';

$username = $_POST['username'];
$password = md5($_POST['passwd']);
$email = $_POST['email'];


if (isset($_POST['submit']))
  {
        $uname = $_SESSION['username'];
        $sql = "UPDATE users SET username = :uname, pass = :pass, email = :email WHERE username = :username";
        $stmt= $conn->prepare($sql);
            $stmt->bindParam(':uname', $username);
            $stmt->bindParam(':pass', $password);
             $stmt->bindParam(':email', $email);
             $stmt->bindparam(':username', $uname);
            $stmt->execute();
            echo "<br> "; 
     
  }

$msg = "$username Your credidantials have been updated!";
// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);
// send email
mail($email,"verify",$msg);

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <style type="text/css">

        #results { padding:20px; border:1px solid; background:#ccc; }

    </style>

</head>
<body>
<ul>
  <li><a href="../Forms/fileUpload.php">CAM</a></li>
  <li><a href="edit.php">My Profile</a></li>
  <li><a href="changepassword.php">change password</a></li>
  <li><a href="gallery.php">Gallery</a></li>
  <li style="float:right"><a class="active" href="../Forms/login.php">Logout</a></li>
</ul>
     
    </div>
<div id = "signup">
        <form action= "edit.php" method = "post" style="margin-top: 100px;">
             <img src = "../images/user.jpg" width = "300" height = "300">
            <p id = "errmsg">
            </p>
            <input  type= "text" name="username" placeholder="Username" required/>
            <br/>
            <input  type= "email" name="email" placeholder="example@domain.com" required/>
            <br/>
            <input  type= "password" name="passwd" placeholder="Password" required/>
            <br/>
    
            <input  type= "submit" name="submit" value = "Save"/>
        </form>
        <div class="div_pic" style = "background-image: url('logback.png');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center; width:500px">
        </div>
    </div>
   <?php include 'footer.php';?> 
</body>
</html>
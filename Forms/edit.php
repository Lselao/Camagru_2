
<?php
session_start();

require '../Config/database.php';

$username = $_POST['username'];
$password = md5($_POST['passwd']);
$email = $_POST['email'];
$user_id = $_SESSION["login"]["id"];

if (isset($_POST['submit']))
  {
      try{
        $sql = "UPDATE users SET `username` = '$username', `pass` = '$password', `email` = '$email' WHERE id = ?";
        $stmt= $conn->prepare($sql);
            
             $stmt->bindParam(1, $user_id);
            $stmt->execute();
            echo "<br> "; 
     
  

        $msg = "$username Your credidantials have been updated!";
        
        $msg = wordwrap($msg,70);
        
        mail($email,"verify",$msg);
        echo "$username Your credidantials have been updated check your email";
      }
      catch(PDOException $e)
      {
          echo "Error".$e;
      }
    }

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../style.css">

    <style type="text/css">

        #results { padding:20px; border:1px solid; background:#ccc; }

    </style>

</head>
<body>
<ul>
  <li><a href="../Forms/fileUpload.php">CAM</a></li>
  <li><a href="edit.php">MY PROFILE</a></li>
  <li><a href="gallery.php">GALLERY</a></li>
  <li style="float:right"><a class="active" href="../Forms/login.php">Logout</a></li>
</ul>
     
    </div>
<div id = "signup">
        <form action= "edit.php" method = "post" style="margin-top: 100px;">
             <!-- <img src = "../images/user.jpg" width = "300" height = "300"> -->
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
       
    </div>
   <?php include 'footer.php';?> 
</body>
</html>
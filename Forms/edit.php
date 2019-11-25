
<?php
session_start();

require '../Config/database.php';

$user_id = $_SESSION["login"]["id"];

// profile change user
if (isset($_POST['ch_user']))
  {
      $username = $_POST['username'];
      $check = $conn->prepare("SELECT username from users where username = ?");
      $check->execute([$username]);
      $res = $check->fetchAll();

      if (empty($res))
      {
      try{
        $sql = "UPDATE users SET `username` = '$username' WHERE id = ?";
        $stmt= $conn->prepare($sql);
            
             $stmt->bindParam(1, $user_id);
            $stmt->execute();
            echo "<br> "; 
     
  

        $msg = "$username Your Username have been updated!";
        
        $msg = wordwrap($msg,70);
        
        mail($email,"verify",$msg);
        echo "$username Your credidantials have been updated check your email";
      }
      catch(PDOException $e)
      {
          echo "Error".$e;
      }
    }else
    {
        echo "username exist, try a new one";
    }
}


// change email
    if (isset($_POST['ch_email']))
  {
    $email = $_POST['email'];
    $check = $conn->prepare("SELECT email from users where email = ?");
    $check->execute([$email]);
    $res = $check->fetchAll();

      if (empty($res))
      {
      try{
        $sql = "UPDATE users SET `email` = '$email' WHERE id = ?";
        $stmt= $conn->prepare($sql);
            
             $stmt->bindParam(1, $user_id);
            $stmt->execute();
            echo "<br> "; 
     
  

        $msg = "$username Your Eamil have been updated!";
        
        $msg = wordwrap($msg,70);
        
        mail($email,"verify",$msg);
        echo "$username Your credidantials have been updated check your email";
      }
      catch(PDOException $e)
      {
          echo "Error".$e;
      }
    }else
    {
        echo "email exist, try a new one";
    }
}
    if (isset($_POST['ch_pass']))
  {
    $password = $_POST['passwd'];
    $password_con = $_POST['passwd_con'];


    //confirms password security && changing password
    if (strlen($password) <= 5) {
        echo  "Password Must have 5 Characters or more!";
    }
        else if ($password_1 != $password_2)
        {
          echo "password doesn't match";
        }

        elseif(!preg_match("#[a-z]+#",$password)) {
            echo "Password Must Have 1 Lowercase Letter!";
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            $passwordErr = "Password Must have 1 Capital Letter!";
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Number!";
        }
        else
        {
            try{
                $vkey = md5(time().$username);
                $password = md5($password);
                $sql = "UPDATE users SET  `pass` = '$password' WHERE id = ?";
                $stmt= $conn->prepare($sql);
                    
                    $stmt->bindParam(1, $user_id);
                    $stmt->execute();
                    echo "<br> "; 
                $msg = "$username Your passsword have been updated!";
                
                $msg = wordwrap($msg,70);
                
                mail($email,"verify",$msg);
                echo "$username Your credidantials have been updated check your email";
              }
              catch(PDOException $e)
              {
                  echo "Error".$e;
              }
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
           
            <input  type= "submit" name="ch_user" value = "Save"/>
        </form>

        <form action= "edit.php" method = "post" style="margin-top: 100px;">
             <!-- <img src = "../images/user.jpg" width = "300" height = "300"> -->
            <p id = "errmsg">
            </p>
            <input  type= "email" name="email" placeholder="example@domain.com" required/>
            <br/>
            <input  type= "submit" name="ch_email" value = "Save"/>
        </form>

        <form action= "edit.php" method = "post" style="margin-top: 100px;">
             <!-- <img src = "../images/user.jpg" width = "300" height = "300"> -->
            <p id = "errmsg">
            </p>
            <input  type= "password" name="passwd" placeholder="Password" required/>
            <br/>
          
            <input  type= "password" name="passwd_con" placeholder="Password" required/>
            <br/>
            <input  type= "submit" name="ch_pass" value = "Save"/>
        </form>
       
    </div>

    <?php include ("../footer.php"); ?> 
  
</body>
</html>
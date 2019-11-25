<?php   
session_start();

if (isset($_POST['login']))
{
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    if (empty($user) || empty($pass))
    {
        echo "missing inputs";
    }
    else
    {
        $pass = md5($pass);
        require("../Config/database.php");
        $sql = "SELECT * FROM users WHERE username = ? AND pass = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $user);
        $stmt->bindParam(2, $pass);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
        {
            // unset($_SESSION['login']);
            $user = $stmt->fetch();
            if ($user['verified'] == 0)
            {
                echo "user not verified";
            }
            else
            {
                $_SESSION["login"]["id"] = $user["id"];
                $_SESSION["login"]["email"] = $user["email"];
                $_SESSION["login"]["username"] = $user["username"];
                $_SESSION["username"] = $user["username"];
                //echo "you are loged in";
                header("Location: ../Back-end/fileUpload.php");
            }
        }
        else
        {
            echo "invalid password/username";
        }
    }
}

?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Camagru | Login</title>
        
    </head>
    <body class="b123"> 
    <ul>
        <li><a style="color: black" href="p_gallery.php">Gallery</a></li>
    </ul>
        <div class="header">
        <h2>Camagru Login</h2>
        </div>

        <div class = "form">
        <form  method="post">
            <div class="input-group">
                <label>Username</label>
                <input class="row" type="text" name="username" placeholder="Enter Username..."maxlength="40" minlength="3">
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <input class="row"  type="password" name="password" placeholder="Enter Password..."maxlength="40" minlength="3">
            </div>
            <div class="input-group">
                <button type="submit" name="login" class="btn">Login</button>
            </div>
            <div>
                <p class="pp">
                Not yet a member? <a class="txt" href="register.php">Register</a>
            </p>
            <br>
            <center><a  class="txt" href="forgotPassword.php"><p>forgot your password?</p></a></center>
            </div>
        </form>
          
    <div>

    <?php include ("../footer.php"); ?> 
    </body>
</html>
<html>
    <head>
        <title>Camagru | Login</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    </head>
    <body>
        <div class="header">
        <h2>Camagru Login</h2>
        </div>

        <div class = "form">
        <form method="post" action="../Views/fileUpload.php">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter Username..."required>
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password..."required>
            </div>
            <div class="input-group">
                <button type="submit" name="login" class="btn">Login</button>
            </div>
            <div>
                <p>
                Not yet a member? <a href="register.php">Register</a>
            </p>
            <br>
            <center><a href="forgotPassword.php"><p>forgot your password?</p></a></center>
            </div>
        </form>
          
    <div>
    </body>
</html>
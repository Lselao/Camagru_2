
<html>
    <head>
        <title>Camagru | Login</title>
        <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    </head>
    <body>
        <div class="header">
        <h2>Forgot Password</h2>
        </div>
        <?php if(isset($result)) echo ($result); ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>

        <div class = "form">
        <form method="post" action="../Back-end/forgotPassword.php">
    
             <div class="input-group">
                <label>Email</label>
                <input type="text" name="email" placeholder="Enter Email..."required>
            </div>
            <div class="input-group">
                <button type="submit" name="forgotPassword" class="btn">Reset Password</button>
            </div>
            <div>
                
            
            </div>
        </form>
          
    <div>
    
    </body>
</html>
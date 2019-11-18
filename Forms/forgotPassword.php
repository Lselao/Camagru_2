<?php
    if(isset($_POST['forgotPassword'])){
        include_once('../Config/connection.php');
        $mail = $_POST['email'];
    
        try{
            $stmt = $conn->prepare("SELECT vkey FROM `registration`.`users` WHERE email = ?");
            $stmt->execute([$mail]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            //echo $result;
            if($result){
                $vkey = $result['vkey'];
                $msg = "click the link verifiy your account : http://localhost:8081/Camagru/Back-end/verifykey.php?vkey=$vkey";
            
                $headers = array('From: noreply');
        
                mail($mail, "Verificatin email", $msg, implode("\r\n", $headers));
                echo "Check your email and change password <br>";
            }else{         
                echo "incorrect email or email does not exists";
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
  ?>
<html>
    <head>
        <title>Camagru | Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
        <h2>Forgot Password</h2>
        </div>
        <?php if(isset($result)) echo $result; ?>
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
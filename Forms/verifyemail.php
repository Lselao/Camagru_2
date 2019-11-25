<?php session_start(); ?>
<html>
    <head>
        <title>Camagru | Verify Mail</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        
            <div>
                <?php
                    if (!empty($_SESSION['message'])){
                        echo $_SESSION['message'] . "<button><a href='login.php'>Login</a></button>";
                    }
                ?>
            </div>
       
    </body>
</html>
<?php session_start(); ?>
<html>
    <head>
        <title>Camagru | Verify Mail</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    </head>
    <body>
        <center>
            <div>
                <?php
                    if (!empty($_SESSION['message'])){
                        echo $_SESSION['message'] . "<button><a href='login.php'>Login</a></button>";
                    }
                ?>
            </div>
        </center>    
    </body>
</html>
<html>
<?php

require ("../Back-end/register.php");
require("../Config/database.php");

?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <h2 Cclass="HEAD">
            <?php
            // echo "<h2>".$login_username."</h2>"; 
            ?>
        </h2>
        <title>Imaging</title>
     <style type="text/css">

        #results { padding:20px; border:1px solid; background:#ccc; }

    </style>

</head>
<body class="b1">
    <ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
<?php

    require ("../Functions/functions.php");
    $image_array = getAllImages();
    $img_id = null;
    if (isset($_GET['img_id']))
    {
        $img_id = $_GET['img_id'];    
    }

?>
<?php foreach($image_array as $image): ?>
<img class="pic" src="<?php echo $image['picture']; ?>" alt=""><br>
<form method="post" action="?img_id=<?php echo $image['id']; ?>">
</form>
<?php endforeach; ?>
 
</body>
</html>

<html>
<?php

require ("../Back-end/register.php");
require("../Config/database.php");
session_start();
if (isset($_SESSION['login']))
{
    $login_id = $_SESSION['login']['id'];
    $login_username = $_SESSION['login']['username'];
}

?>
<html>
    <head>
        <title>Imaging</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
     <style type="text/css">

        #results { padding:20px; border:1px solid; background:#ccc; }

    </style>

</head>
<body class="b1">
<ul>
  <li><a href="../Forms/fileUpload.php">CAM</a></li>
  <li><a href="edit.php">My Profile</a></li>
  <li><a href="gallery.php">Gallery</a></li>
  <li style="float:right"><a class="active" href="../Back-end/logout.php">Logout</a></li>
</ul>
<?php

    require ("../Functions/functions.php");
    $image_array = getAllImages();
    $img_id = null;
    if (isset($_GET['img_id']))
    {
        $img_id = $_GET['img_id'];    
    }
    if (isset($_POST['submit_comment']))
    {
        $comment = strip_tags($_POST['comment']);
        if (empty($comment))
        {
            echo "<p>blank comment</p>";
        }
        else
        {
            require("../Config/database.php");
            $sql = "INSERT INTO comments (username, image_id, comment) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $login_username);
            $stmt->bindParam(2, $img_id);
            $stmt->bindParam(3, $comment);
            $stmt->execute();
        }
    // $stmt = null;
    // $conn = null;
    $msg = "$username Updated Success!";
    $msg = wordwrap($msg,70);
    mail($email,"verify",$msg);

    }
    
    if (isset($_POST['del'])){
        $dell = $_POST['del'];
        $sql = "DELETE FROM camagru.images WHERE id = $img_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    if (isset($_POST['like']))
    {
        if ($login_username)
        {
            require("../Config/database.php");
            $sql = "INSERT INTO camagru.likes (username, image_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $login_username);
            $stmt->bindParam(2, $img_id);
            $stmt->execute();
        }
        
}


    function display_comment($comment_id)
    {
        require ("../Config/database.php");
        $sql = "SELECT * FROM comments WHERE image_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $comment_id);
        $stmt->execute();
        $comments = $stmt->fetchAll();
        if ($stmt->rowCount() > 0)
        {
            foreach($comments as $comment)
            {
                echo "<h5>".$comment['username']."</h5>";
                echo "<p>".$comment['comment']."</p>";
            }
        }
    }
    function count_likes($like_id)
    {
        require ("../Config/database.php");
        $sql = "SELECT * FROM likes WHERE image_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $like_id);
        $stmt->execute();
        echo $stmt->rowCount()." like";
    }
?>
<?php foreach($image_array as $image): ?>
<img class="pic" src="<?php echo $image['picture']; ?>" alt=""><br>
<form method="post" action="?img_id=<?php echo $image['id']; ?>">
    <textarea name="comment" class="comme" cols="20" rows="5"></textarea><br>
    <!-- <input class="comme" type="text" name="comment" placeholder="type comment here ..."><br> -->
    <button  name="submit_comment" type="submit">submit comment</button>
    <?php count_likes($image['id']); ?>
    <button class="b2" type="submit" name="like">like</button>
    <button class="b2" type="submit" name="del">Delete</button><br>
</form>
<?php display_comment($image['id']) ?>
<?php endforeach; ?>
 
</body>
</html>
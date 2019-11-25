<?php

ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

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
  <li><a href="p_gallery.php">GALLERY</a></li>
  <li><a href="login.php">LOGIN</a></li>


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
            $sql = "INSERT INTO comments (`user`,img, comments) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $login_username);
            $stmt->bindParam(2, $img_id);
            $stmt->bindParam(3, $comment);
            $stmt->execute();
        }

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
            $sql = "INSERT INTO camagru.likes (`user_id`, img_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $login_id);
            $stmt->bindParam(2, $img_id);
            $stmt->execute();
        }
        
}


    function display_comment($comment_id) 
    {
        
        require ("../Config/database.php");
        $sql = "SELECT * FROM comments WHERE img = ?"; 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $comment_id);
        $stmt->execute();
        // $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $comments = $stmt->fetchall(); 
        if ($stmt->rowCount() > 0)
        {
            foreach($comments as $comment)
            {
                echo "<h5>".$comment['user']."</h5>";
                echo "<p>".$comment['comments']."</p>";
            }
        }
    }
    function count_likes($like_id)
    {
        require ("../Config/database.php");
        $sql = "SELECT * FROM likes WHERE img_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $like_id);
        $stmt->execute();
        echo $stmt->rowCount()." like";
    }
?>
<?php foreach($image_array as $image): ?>
<img class="pic" src="<?php echo $image['picture']; ?>" alt=""><br>
<form method="post" action="?img_id=<?php echo $image['id']; ?>">

    <?php count_likes($image['id']); ?>
    
</form>

<?php display_comment($image['id']);?>



<?php endforeach; ?>

<?php include "../Forms/page.php";?>

<?php include ("../footer.php"); ?> 
 
</body>
</html>
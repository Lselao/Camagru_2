<?php

ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

// end session when logout
if(!isset($_SESSION))
{
    session_start();
}
if (!isset($_SESSION["login"]["username"]))
{
    echo '<script>window.location= "login.php"</script>';
}

require ("../Back-end/register.php");
require("../Config/database.php");

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
  <li><a href="edit.php">MY PROFILE</a></li>
  <li><a href="gallery.php">GALLERY</a></li>
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
    <!-- <textarea name="comment" class="comme" cols="20" rows="5"></textarea><br> -->
    <input class="comme" type="text" name="comment" placeholder="type comment here ..."><br>
    <button  name="submit_comment" type="submit">submit comment</button>
    <?php count_likes($image['id']); ?>
    <button class="b2" type="submit" name="like">like</button>
    <button class="b2" type="submit" name="del">Delete </button><br>
</form>

<?php display_comment($image['id']);?>



<?php endforeach; ?>

<?php include "../Forms/page.php";?>

<?php include ("../footer.php"); ?> 
 
</body>
</html>
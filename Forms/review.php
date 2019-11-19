<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../style.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <style type="text/css">

        #results { padding:20px; border:1px solid; background:#ccc; }

    </style>

</head>
<body>
<ul>
  <li><a href="home.php">CAM</a></li>
  <li><a href="edit.php">MY Profile</a></li>
  <li><a href="#contact">Contact</a></li>
  <li style="float:right"><a class="active" href="../Back-end/logout.php">Logout</a></li>
</ul>
    

</div>
    <img id="rev" src="<?php echo $_SESSION['img']['src'];?>" alt="Missing image"/><br/>
    <form method='POST' action='../server/add_review.php'>
        <input type="hidden" value="<?php echo $_SESSION['img']['id'];?>" name="id"/>
        <input type="submit" name="like" value="like"/>
    </form>
    <iframe src="../server/likes.php"></iframe>
    <iframe src="../server/comments.php"></iframe>
    <form method='POST' action='../server/add_review.php'>
        <input type="hidden" value="<?php echo $_SESSION['img']['id'];?>" name="id"/>
        <textarea name='comment' place holder='Write Your Comment Here!'></textarea></textarea><br>
        <input type="submit" value="comment" name="com"/>
    </form>
    <div class="footer">
            <p class="copyright">&copy;uisrael 2019</p>
        </div>
</body>
</body>
</html>

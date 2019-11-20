<?php

    if(!isset($_SESSION))
    {
        session_start();
    }
    if (!isset($_SESSION["login"]["username"]))
    {
        echo '<script>window.location= "login.php"</script>';
    }
    echo $_SESSION['error'];
    $_SESSION['error'] = '';
?>

<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Imaging</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
     <style type="text/css">

        #results { padding:20px; border:1px solid; background:#ccc; }

    </style>

</head>
<body class="round">

<ul>
  <li><a href="fileUpload.php">CAM</a></li>
  <li><a href="edit.php">MY PROFILE</a></li>
  <li><a href="../Forms/gallery.php">GALLERY</a></li>
  <li style="float:right"><a class="active" href="../Back-end/logout.php">Logout</a></li>
</ul>
<div class="container">
    <h1 style="color: white">SNAP CHAT!!😋</h1>
<form action="../Back-end/fileUpload.php" method="post" enctype="multipart/form-data">
    Select image:
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    <input type="submit" value="Upload Image" name="upload">
</form>
<script src="../JS/cam.js"></script>
<div class="input-group" style="text-align:center;">
    <div class="container2" style="display:inline-block;">
    <button onclick= "stickers('../stickers/bubbles.png')" class="btn">bubbles</button>
    <button onclick=" stickers('../stickers/lips.jpeg')" class="btn">lips</button>
    <button onclick="stickers('../stickers/squid.png')" class="btn">squid</button>
</div>

<div class="booth">
    <video id="video" width="400" height="300" autoplay></video>
    <canvas id="canvas" width="400" height="300"></canvas>
</div>

<form action="../Back-end/fileUpload.php" method="post">
    <input type="hidden" id="img" name="img">
    <input class="btt" type="submit" name="cam_pic" value="save">
</form>

<input type="submit" id="capture" name="capture" value="Capture">
<input type="submit" id="clear" name="clear" value="Clear"><br>
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
<script src="../JS/cam.js"></script>
<script src="../JS/sticker.js"></script>
</div>

</body>
</html>

<?php
    session_start();
    echo $_SESSION['error'];
    $_SESSION['error'] = '';
?>

<html>
    <head>
        <title>Imaging</title>
        <link rel="stylesheet" type="text/css" href="style.css">
     <style type="text/css">

        #results { padding:20px; border:1px solid; background:#ccc; }

    </style>

</head>
<body>
<ul>
  <li><a href="fileUpload.php">CAM</a></li>
  <li><a href="edit.php">MY Profile</a></li>
  <li><a href="../Forms/gallery.php">Gallery</a></li>
  <li style="float:right"><a class="active" href="../Back-end/logout.php">Logout</a></li>
</ul>
    <div class="container">
    <h1 class="text-center">SNAP CHAT!!😃 </picture></h1>
    
<form action="../Back-end/fileUpload.php" method="post" enctype="multipart/form-data">
    UPLOAD PICTURE:
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    <input type="submit" value="Upload Image" name="upload">
</form>

<div class="booth">
    <video id="video" width="400" hieght="300" autoplay></video>
    <canvas id="canvas" width="400" hiegth="300"></canvas>
</div>

<form action="../Back-end/fileUpload.php" method="post">
    <input type="hidden" id="img" name="img">
    <input type="submit" id="cam_pic" name="cam_pic" value="Upload picture">
</form>

<input type="submit" id="capture" name="capture" value="Capture">
<input type="submit" id="clear" name="clear" value="Clear">

<script src="../JS/cam.js"></script>
<?php

require "footer";

?> 
</body>
</html>
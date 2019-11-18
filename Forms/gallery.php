

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
    <?php
    if (isset($_SESSION['username']) && isset($_SESSION['email']))
    {
        echo "<li><a href='../Forms/fileUpload.php'>CAM</a></li>";
        echo "<li><a href='edit.php'>MY Profile</a></li>";
        echo "<li><a href='gallery.php'>Gallery</a></li>";
        echo "<li style='float:right'><a class='active' href='../Back-end/logout.php'>Logout</a></li>";
    }else
    {
        echo "<li><a href='login.php'>login</a></li>";
    }
  ?>
</ul>
<?php
    require ("../Functions/functions.php");
    $image_array = getAllImages();

    foreach ($image_array as $image) {
        echo '</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="'. $image['picture'] .'" alt="" class="src"></br>'.
        '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button>Like</button>'.
        '<input type="text" name="comment" placeholder="type comment here ...">'.
        '<button>Comment</button></br>
        </br>
     </br>'
        ;
    }
   
?>
</div>
</body>
</html> <?php

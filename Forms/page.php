<?php

ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

include "../Config/database.php";

$numperpage = 5;

$sql = "SELECT * FROM images ORDER BY upload_date DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$re = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
$numrecords = count($rows);
$numlinks = ceil($numrecords/$numperpage);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="" method="POST">
            <?php
                for ($i = 1; $i <= $numlinks; $i++){
                    ?>
                    <input type="submit" value= "<?php echo $i;?>" name = "page">
                    <?php
                }?>
        </form>
    
</body>
</html>
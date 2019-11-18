<?php
    session_start();
    require '../Functions/functions.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    //$username = $_SESSION["username"];
    
    //check if the uploaded image is a real file
    if(isset($_POST["upload"])) {

        //create random number to make image names unique
        $timestamp = new DateTime();
        $timestamp = $timestamp->getTimestamp();

        //get image file type of the uploaded image
        $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
        
        //create a temporary name for our pic inserting file type
        $tmp_name = 'img' . $timestamp .".". $imageFileType;

        //path to where the image is goin to be uploaded
        $pic_path = "../uploads/";

        //name to be submitted to the database
        $pic_name = $pic_path . $tmp_name;

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if($check === false) {
            $_SESSION['error'] = "File is not an image.";
            header("location: ../Forms/fileUpload.php");
        }
    
        //check if image already exist in the destination path
        if (file_exists($pic_name)){
            $_SESSION['error'] = "File already exists";
            header("location: ../Forms/fileUpload.php");
        }
        
        //check if the image size is less than 5MB
        if ($_FILES["fileToUpload"]["size"] > 1000000) {
            $_SESSION['error'] = "file too large";
            header("location: ../Forms/fileUpload.php");
        }
        
        // check if the image file type is the allowed one
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $_SESSION['error'] = "Only JPG, JPEG, PNG files allowed.";
            header("location: ../Forms/fileUpload.php"); 
        }

        // upload image to uploads folder and to database
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $pic_name)) {
            upload_image("username placeholder...", $pic_name);
            $_SESSION['error'] = "The file ". $pic_name . " has been uploaded.";
        } else {
            $_SESSION['error'] = "Error uploading file.";
        }
    }

    if(isset($_POST["cam_pic"]) && !empty($_POST['img'])){

        
        $image_parts = explode(";base64,", $_POST['img']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_file_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $pic_name = "../uploads/" . uniqid() . '.png';
        file_put_contents($pic_name, $image_base64);
        upload_image("username placeholder...", $pic_name);
        $_SESSION['error'] = "The file ". $pic_name . " has been uploaded.";
    }

    header("Location: ../Forms/fileUpload.php");
?>
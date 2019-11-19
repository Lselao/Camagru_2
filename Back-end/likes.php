<?php
        ini_set('display_errors', 1);
         ini_set('display_startup_errors', 1);
          error_reporting(E_ALL);
        require 'Config/database.php';
        if (isset($_GET['type'], $_GET['img_id']))
        {
            session_start();
            $type   = $_GET['type'];
            $id     = $_GET['image_id'];
            
        }
        
        header('location:gallery.php');
?>
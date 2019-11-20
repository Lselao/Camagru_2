<?php
    require "../Config/database.php";
    
    function upload_image($username, $picture)
    {
        global $conn;

        $sql = "INSERT INTO images (username, picture) VALUES (?,?)";
        $stmt= $conn->prepare($sql);

        try{
            $stmt->execute([$username, $picture]);
            echo "successful";
        } 
        catch(Exception $ex) {
            die($ex->getMessage());
        }
    }

    

    function getAllImages()
    {
        global $conn;
        
        $sql = "SELECT * FROM images ORDER BY upload_date DESC";
        $stmt= $conn->prepare($sql);

        try{
            $stmt->execute();
            $images = $stmt->fetchAll();
            return $images;
        }
        catch(Exception $ex){
            die($ex->getMessage());
        }   
    }

    function delete_image($pic_id)
    {
        global $conn;
        
        $sql = "DELETE FROM images WHERE id = ?";
        $stmt= $conn->prepare($sql);

        try{
            $stmt->execute([$pic_id]);
            echo "picture deleted";
        }
        catch(Exception $ex){
            die($ex->getMessage());
        }
    }

    function make_thumb($src, $dest, $desired_width) {

        /* read the source image */
        $source_image = imagecreatefromjpeg($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);
        
        /* find the "desired height" of this thumbnail, relative to the desired width  */
        $desired_height = floor($height * ($desired_width / $width));
        
        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
        
        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
        
        /* create the physical thumbnail image to its destination */
        imagejpeg($virtual_image, $dest);
        }
?>
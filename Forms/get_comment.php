<?php
require ("../Config/database.php");
include ("gallery.php");

if (isset($_POST['submit_comment']))
{
    $comment = $_POST['comment'];
    if (empty($comment))
    {
            echo "<p>blank comment</p>";
    }
    else
    {
        equire("../Config/database.php");
        $sql = "INSERT INTO comments (username, image_id, comment) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $login_username);
        $stmt->bindParam(2, $img_id);
        $stmt->bindParam(3, $comment);
        $stmt->execute();
    }
    $stmt = null;
    $conn = null;
$msg = "$username Your Credidantials have been updated!";
// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);
// send email
mail($email,"verify",$msg);
}
?>
<?php 
include('db.php');
if(isset($_POST['submit'])){
    $post_id = $_POST['post_id'];
    $sql = "DELETE FROM posts WHERE id = '$post_id'";
    $statement = $connection->prepare($sql);
            $statement->execute();
    }
header('Location: posts.php');
?>
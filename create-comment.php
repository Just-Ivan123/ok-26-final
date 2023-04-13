
<?php
session_start();
include('db.php');
if(isset($_POST['submit'])) {
    $body =$_POST['body'];
    if(empty($body)) {
        header("Location: single-post.php");
    } else {
        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $sql = "INSERT INTO comments (
             text, 
             user_id, username, post_id
        ) VALUES ('$body','$id','$username',{$_SESSION['post_id']}
        )";
        $statement = $connection->prepare($sql);
        $statement->execute();
        header("Location: single-post.php");
        }
}
 ?>
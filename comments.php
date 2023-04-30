<?php
if(isset($_POST['submit'])){
$comment_id = $_POST['comment_id'];
$sql = "DELETE FROM comments WHERE id = '$comment_id'";
$statement = $connection->prepare($sql);
        $statement->execute();
header('single-post.php');
}
if (isset($_GET['post_id'])) 
{
    $sql = "SELECT *
     FROM comments 
    WHERE comments.post_id = {$_GET['post_id']}";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $comments = $statement->fetchAll();
}else{
    $sql = "SELECT *
    FROM comments 
   WHERE comments.post_id = {$_SESSION['post_id']}";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $comments = $statement->fetchAll();
}
?>
<ul class ="comments"><h3>Comments</h3>
<?php
foreach ($comments as $comment) 
{
?>
<li>
<h5><a href='#'><?php echo($comment['username']) ?></a></h5>
<div>
    <p><?php echo($comment['text']) ?></p>
    <form action="single-post.php" method="POST" id="profileForm">
    <input type="hidden" name="comment_id" value=<?php echo($comment['id']);?>>
    <button class="btn" type = "submit" name = "submit">Delete</button>
    </form>
</div>
</li>
<hr>
<?php
}
?>
</ul>
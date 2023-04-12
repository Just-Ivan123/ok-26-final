<?php 
if (isset($_GET['post_id'])) 
{
    $sql = "SELECT *
     FROM comments 
    WHERE comments.post_id = {$_GET['post_id']}";
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
<h5><a href='#'><?php echo($comment['author']) ?></a></h5>
<div>
    <p><?php echo($comment['text']) ?></p>
</div>
</li>
<hr>
<?php
}
?>
</ul>
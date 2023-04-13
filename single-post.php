<?php
session_start();
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
    function areUSure(){
        return confirm('Are you sure?');
    }
function validate_form ()
{
	valid = true;

        if ( document.commentForm.body.value == "" )
        {
            document.commentForm.body.className = "alert-danger";
            document.commentForm.body.placeholder = 'This field is required';
            valid = false;
        }

        return valid;
}
</script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php if(empty($_SESSION['id'])){
 include('header.php');}
 else{
 include('header2.php');}?>
    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                <?php
                if (isset($_GET['post_id'])) 
                {
                    $_SESSION['post_id'] = $_GET['post_id'];
                    $sql = "SELECT *
                     FROM posts 
                    WHERE posts.id = {$_GET['post_id']}";
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $posts = $statement->fetchAll();
                }else{
                    $sql = "SELECT *
                     FROM posts 
                    WHERE posts.id = {$_SESSION['post_id']}";
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $posts = $statement->fetchAll();
                }
                ?>
            <?php
                foreach ($posts as $post) 
                {
            ?>
                <div class="blog-post">
                    <h2 class="blog-post-title"><?php echo($post['title']) ?></h2>
                    <p class="blog-post-meta"><?php echo($post['created_at']) ?>. by <a href='#'><?php echo($post['username']) ?></a></p>
                    <div>
                        <p><?php echo($post['body']) ?></p>
                    </div>
                    <form action ="delete-post.php" method="POST" name="deletePost"  onsubmit="return areUSure();">
                        <input type = "hidden" name ="post_id" value=<?php echo $_SESSION['post_id'];?>>
                        <button class ="btn" type="submit" name="submit">Delete Post</button>
                    </form>
                </div>
            <?php
                }
            ?>
            <div class ="create-comment">
            <form action="create-comment.php" method="POST" name="commentForm" onsubmit="return validate_form ( );">
            <label>Create comment</label>
                <div>
                    <textarea type="text" name = "body" id ='body'></textarea>
                    <button class="btn" type = "submit" name = "submit" id="sub" >Save</button>
                </div>
            </form>
            </div>
            <button name="Ad" class ='btn' id ='hider'>Hide comments</button>
            <div id = 'comments'>
            <?php include("comments.php");?>
            </div>
            <script>
            document.getElementById('hider').onclick = function() {
                if(document.getElementById('comments').hidden === false){
                document.getElementById('comments').hidden = true;
                document.getElementById('hider').value = 'Show comments';
                }else{
                    document.getElementById('comments').hidden = false;
                document.getElementById('hider').value = 'Hide comments';
                }
            }
            </script>
                </div>
            <?php include('sidebar.php');?>
        </div>
    </main>
        <?php include('footer.php');?>
</body>
</html>

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "1234";
$dbname = "blog";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include('header.php');?>
    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                <?php
                if (isset($_GET['post_id'])) 
                {
                    $sql = "SELECT *
                     FROM posts 
                    WHERE posts.id = {$_GET['post_id']}";
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
                    <p class="blog-post-meta"><?php echo($post['created_at']) ?>. by <a href='#'><?php echo($post['author']) ?></a></p>
                    <div>
                        <p><?php echo($post['body']) ?></p>
                    </div>
                </div>
            <?php
                }
            ?>
            <?php include("comments.php");?>
                </div>
            <?php include('sidebar.php');?>
        </div>
    </main>
        <?php include('footer.php');?>
</body>
</html>

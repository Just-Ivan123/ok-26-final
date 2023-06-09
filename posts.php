<?php
session_start();
include('db.php');
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
<?php if(empty($_SESSION['id'])){
 include('header.php');}
 else{
 include('header2.php');}?>
<main role="main" class="container">
            <div class="row">
                <div class="col-sm-8 blog-main">
        <?php
            $sql = "SELECT * 
            FROM posts 
            ORDER BY created_at DESC LIMIT 3";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $posts = $statement->fetchAll();
        ?>
        <?php
                foreach ($posts as $post) {
            ?>
                    <div class="blog-post">
                        <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($post['id']) ?>" class ="a-title"><?php echo($post['title']) ?></a></h2>
                            <p class="blog-post-meta">
                                <?php echo($post['created_at']) ?>. by <a href='#'><?php echo($post['username']) ?></a> </p>
                        <div>
                            <p><?php echo($post['body']) ?></p>
                        </div>
                </div>

            <?php
                }
            ?>    
                </div>
            <?php include('sidebar.php');?>
            </div>
        </main>
        <?php include('footer.php');?>
</body>
</html>
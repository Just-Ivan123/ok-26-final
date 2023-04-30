<html>
  <head>
    <style>
      .sidebar-title{
        font-size: 20px;
        color: #b34848;
        text-decoration-color: #b34848;}
        .sidebar-title:hover{
        color: #b34848;
        text-decoration-color: #b34848;
}
      </style>
</head>
<body>
<aside class="col-sm-3 ml-sm-auto blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>Latest posts</h4>
            <?php
            include('db.php');
            $sql = "SELECT id,title 
            FROM posts 
            ORDER BY created_at DESC LIMIT 5";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $posts = $statement->fetchAll();
        ?>
        <?php
                foreach ($posts as $post) {
            ?>
                    <div class="blog-post">
                        <h6 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($post['id']) ?>" class ="sidebar-title"><?php echo($post['title']) ?></a></h6>
                </div>

            <?php
                }
            ?>    
          </div>
        </aside>
        <body>
</html>
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

            // pripremamo upit
            $sql = "SELECT * 
            FROM posts 
            ORDER BY created_at DESC LIMIT 3";
            
            $statement = $connection->prepare($sql);

            // izvrsavamo upit
            $statement->execute();

            // zelimo da se rezultat vrati kao asocijativni niz.
            // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            // punimo promenjivu sa rezultatom upita
            $posts = $statement->fetchAll();

            // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
        ?>
        <?php
                foreach ($posts as $post) {
            ?>

                    <div class="blog-post">
                        
                        <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($post['id']) ?>" class ="a-title"><?php echo($post['title']) ?></a></h2>

                            <!-- zameniti  datum i ime sa pravim imenom i datumom blog post-a iz baze -->
                            <p class="blog-post-meta">
                                <?php echo($post['created_at']) ?>. by <a href='#'><?php echo($post['author']) ?></a> </p>
                        

                        <div>
                            <!-- zameniti ovaj privremeni (testni) text sa pravim sadrzajem blog post-a iz baze -->
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
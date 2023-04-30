<?php 
session_start();
include('header.php');
include('db.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT email, password from users where email = '$email' and password = '$password'";
        $statement = $connection->prepare($sql);

                $statement->execute();

                $statement->setFetchMode(PDO::FETCH_ASSOC);

                $posts = $statement->fetchAll();
                if(!empty($posts))
                {
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                $sql = "SELECT id, username from users where email = '$email'";
                $statement = $connection->prepare($sql);

                $statement->execute();

                $statement->setFetchMode(PDO::FETCH_ASSOC);

                $posts = $statement->fetchAll();
                foreach ($posts as $post)
                {
                    $profile = $post;
                }
                $_SESSION['username'] = $profile['username'];
                $_SESSION['id'] = $profile['id'];
                header("Location: posts.php");
                }else{
                    echo "Incorrect email or password";
                }
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
        <main role="main" class="container">
        <div class="row">
        <div class="col-sm-8 blog-main">
                <header>
                    <h1>Log in</h1>
                </header>
                <form action="sign-in.php" method="POST" id="profileForm">
                <div>
                    <div>
                        <label>Email</label>
                        <input type="text" class="va-c-form-control" name = "email">
                    </div>

                    <div>
                        <label>Password</label>
                        <input type="text" class="va-c-form-control" name = "password">
                    </div>

                    <div>
                        <button class="btn" type = "submit" name = "submit" >Save</button>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </main>
<?php include('footer.php');?>
</body>
</html>

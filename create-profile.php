<?php
include('header.php');
include('db.php');
if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    if(empty($email) || empty($password) || empty($username)) {
        echo "All fields are required";
    } else {
        $sql = "SELECT email, username from users where email = '$email' or username = '$username'";
        $statement = $connection->prepare($sql);

                $statement->execute();

                $statement->setFetchMode(PDO::FETCH_ASSOC);

                $posts = $statement->fetchAll();
                if (empty($posts)){
        session_start();
        $sql = "INSERT INTO users (
            email, password, username
        ) VALUES ('$email', '$password','$username'
        )";

        $statement = $connection->prepare($sql);

        $statement->execute();
        $sql = "SELECT id from users where email = '$email'";
        $statement = $connection->prepare($sql);

                $statement->execute();

                $statement->setFetchMode(PDO::FETCH_NUM);

                $posts = $statement->fetchAll();
                foreach ($posts as $post)
                {
                    $_SESSION['id'] = $post[0];
                }
                header("Location: posts.php");
        }else{
            echo "Username or email is used";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
function validate_form ()
{
    valid = true;
	if ( document.profileForm.email.value == "" )
        {
            document.profileForm.email.className = "alert-danger";
            document.profileForm.email.placeholder = 'This field is required';
            valid = false;
        }
        if ( document.profileForm.password.value == "" )
        {
            document.profileForm.password.className = "alert-danger";
            document.profileForm.password.placeholder = 'This field is required';
            valid = false;
        }
        if ( document.profileForm.username.value == "" )
        {
            document.profileForm.username.className = "alert-danger";
            document.profileForm.username.placeholder = 'This field is required';
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
        <main role="main" class="container">
        <div class="row">
        <div class="col-sm-8 blog-main">
                <header class="va-l-page-header">
                    <h1>User profile</h1>
                </header>
                <form action="create-profile.php" method="POST" name="profileForm" onsubmit="return validate_form ( );">
                    <div>
                        <label >Email</label>
                        <input type="text" class="va-c-form-control" name = "email" id="email">
                    </div>

                    <div >
                        <label >Password</label>
                        <input type="text" class="va-c-form-control" name = "password" id="password">
                    </div>
                    <div >
                        <label >Username</label>
                        <input type="text" class="va-c-form-control" name = "username" id="username">
                    </div>
                    <div >
                        <button class="btn" type = "submit" name = "submit" >Save</button>
                    </div>
                </form>
        </div>
        </div>
        </main>
<?php include('footer.php')?>
</body>
</html>
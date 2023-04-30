
<?php 
session_start();
include('header2.php');
include('db.php');
if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];

    if(!empty($title) || !empty($body)) {
        $id = $_SESSION['id'];
        $currentDate = date('Y-m-d h:i');
        $username = $_SESSION['username'];
        $sql = "INSERT INTO posts (
            title, body, 
            created_at, user_id, username
        ) VALUES ('$title', '$body','$currentDate', '$id','$username'
        )";
        $statement = $connection->prepare($sql);
        $statement->execute();
        header("Location: posts.php");
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
	if ( document.postForm.body.value == "" )
        {
            document.postForm.body.className = "alert-danger";
            document.postForm.body.placeholder = 'This field is required';
            valid = false;
        }
        if ( document.postForm.title.value == "" )
        {
            document.postForm.title.className = "alert-danger";
            document.postForm.title.placeholder = 'This field is required';
            valid = false;
        }
    return valid;
}
</script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents</title>
</head>
<body>
<div >
    <main role="main" class="container">
        <div class="row">
        <div class="col-sm-8 blog-main">
            <header>
                <h1>Create new post</h1>
            </header>
            <form action="create-post.php" method="POST" name="postForm" onsubmit="return validate_form ( );">
            <div >
                <div >
                    <label >Title</label>
                    <input type="text"  name = "title" id ='title'>
                </div>
                <div>
                    <label >Body</label>
                    <textarea type="text"  name = "body" id = 'body'rows = 10></textarea>
                </div>
                    <button class="btn" type = "submit" name = "submit"  >Save</button>
            </div>
            </form>
        </div?>
        </div>
    </main>
    <?php
include('footer.php');?>
</html>
<!DOCTYPE html>
<?php session_start() ?>
<html>
    <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="main.css"> -->
    </head>
    <body>
    <?php
       require "database.php";
       function test_in($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
        }   
       $user = $_SESSION['user'];
       echo("Editing a $user comment.</br>");

       $num = $_POST['num'];

       $title = test_in($_POST['title']);
       $body = test_in($_POST['body']);
       $link = test_in($_POST['link']);

       $otitle = mysqli_query($mysqli, "SELECT title FROM posts where pk_post_ID=$num");
       $obody = mysqli_query($mysqli, "SELECT body FROM posts where pk_post_ID=$num");
       $olink = mysqli_query($mysqli, "SELECT link FROM posts where pk_post_ID=$num");

       if(empty($num)){
           $allErr = "A post number is required";
       } elseif(empty($title)){
           $title = $otitle;
       } elseif(empty($body)){
           $body = $obody;
       } elseif(empty($link)){
           $link = $olink;
       } else {
        echo "We made it to 1";
       $sql = "UPDATE posts SET title='$title', body='$body', link='$link' WHERE pk_post_ID='$num'";
       echo "We made it to 2";
       if ($mysqli->query($sql) === TRUE){
           echo "Success!";
           header("location: forum.php");
       } else {
           echo "Something went wrong";
       }
   }
    ?>
        <p>If any box is left empty, the contents of post for that section will remain the same.</p>
        <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="input-wrapper">
                Post number: <input type="number" name="num"> 

            </div>
            <div class="input-wrapper">
                Title: <input type="title" name="title"> 

            </div>
            <div class="input-wrapper">
                Body: <input type="body" name="body"> 

            </div>
            <div class="input-wrapper">
                Link: <input type="link" name="link"> 
                
            </div>
            <input type="submit" value="Submit">


        </form>
        <form name="input" action="<?php echo htmlspecialchars("myposts.php");?>" method="POST">

            <div class="input-wrapper">
                <input type="submit" value="Back"> 
                
            </div>


        </form>
        <!-- Send user to seperate site to create a new user account -->
    </body>
</html> 
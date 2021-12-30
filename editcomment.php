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

        $user = $_SESSION["user"];
        echo("Editing a $user post.</br>");

        $comment_num = test_in($_POST["num"]);

        $cont = test_in($_POST["content"]);

        // $o_cont = mysqli_query($mysqli, "SELECT comment_body FROM comments where comment_ID=$comment_num");

        if(empty($comment_num)){
            $allErr = "A post number is required";
        } elseif(empty($cont)){
            $allErr = "You must put in some kind of new content, or go back.";
        } else {

        $sql = "UPDATE comments SET comment_body='$cont' WHERE comment_ID='$comment_num'";
        if ($mysqli->query($sql) === TRUE){
            echo "Success!";
            header("location: mycomments.php");
        } else {
            echo "Something went wrong";
        }
    }
        
    ?>
        <p>All fields are required to update a comment.</p>
        <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="input-wrapper">
                Comment number: <input type="text" name="num"> 

            </div>
            <div class="input-wrapper">
                Content: <input type="text" name="content"> 
                <span class="error"> <?php echo htmlentities($allErr)?> </span>
            </div>
            <input type="submit" value="Submit">


        </form>
        <form name="input" action="<?php echo htmlspecialchars("mycomments.php");?>" method="POST">

            <div class="input-wrapper">
                <input type="submit" value="Back"> 
                
            </div>


        </form>
        <!-- Send user to seperate site to create a new user account -->
    </body>
</html> 
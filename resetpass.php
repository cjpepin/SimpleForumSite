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

        $user = (string)test_in($_POST["user"]);
        $new_pass = (string)test_in($_POST["newpass"]);

        
        echo $user, $new_pass;
        

        // if(empty($comment_num)){
        //     $allErr = "A post number is required";
        // } elseif(empty($cont)){
        //     $allErr = "You must put in some kind of new content, or go back.";
        // } else {

    //     $sql = "UPDATE comments SET comment_body='$cont' WHERE comment_ID='$comment_num'";
    //     if ($mysqli->query($sql) === TRUE){
    //         echo "Success!";
    //         header("location: mycomments.php");
    //     } else {
    //         echo "Something went wrong";
    //     }
    // }
        
    ?>
        <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="input-wrapper">
                User: <input type="text" name="user"> 
            </div>
            <div class="input-wrapper">
                New Pass: <input type="text" name="newpass"> 
                <span class="error"> <?php echo htmlentities($allErr)?> </span>
            </div>
            <input type="submit" value="Submit">


        </form>
        <form name="input" action="<?php echo htmlspecialchars("forum.php");?>" method="POST">

            <div class="input-wrapper">
                <input type="submit" value="Home page"> 
                
            </div>


        </form>
        <!-- Send user to seperate site to create a new user account -->
    </body>
</html> 
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

        $user = $_SESSION['user'];
        echo("Deleting a $user post.</br>");

        $post_num = $_POST['num'];

        if(empty($post_num)){
            $allErr = "A post number is required";
        } else { 
        
        $sql = "DELETE from posts WHERE pk_post_ID='$post_num'";
        if ($mysqli->query($sql) === TRUE){
            echo "Success!";
            header("location: forum.php");
        } else {
            echo "Something went wrong";
        }
    }
    ?>
        <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="input-wrapper">
                Post number: <input type="number" name="num"> 

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
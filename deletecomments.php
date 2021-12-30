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
        echo("Deleting a $user comment.</br>");

        $num = (int)test_in($_POST['num']);

        if(empty($num)){
            $allErr = "A post number is required";
        } else { 
        
        $sql = "DELETE from comments WHERE comment_ID='$num'";
        if ($mysqli->query($sql) === TRUE){
            echo "Success!";
            header("location: mycomments.php");
        } else {
            echo "Something went wrong";
        }
    }
    ?>
        <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="input-wrapper">
                Comment number: <input type="number" name="num"> 
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
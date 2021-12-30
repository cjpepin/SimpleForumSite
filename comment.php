<!DOCTYPE html>
<?php session_start() ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
    
        <?php
        require 'database.php';
        //Test input for harmful content
        function test_in($input){
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
        if(isset($_POST["id"])){
            $_SESSION["post_id"] = test_in($_POST["id"]);
        }
        
        $user = $_SESSION["user"];
        if(empty($user)){
            header("location: guest.php");
        } elseif(isset($_POST["seeComment"])){
            echo "You should be seeing comments";
            header("location: seecomments.php");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {        

            echo "This is the post id " . $_SESSION["post_id"];
            $id = (int)$_SESSION["post_id"];
            echo $id;
            $comment = (string)test_in($_POST["comment"]);
            
            if (empty($comment)){
                $allErr = "Comment is required";                       
            }  else {
                $stmt = $mysqli -> prepare("insert into comments (id, comment_body, user) values (?, ?, ?)");
                echo $id;
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    echo "Testing to see";
                }
                $stmt->bind_param('iss', $id, $comment, $user);
                echo $_SESSION["post_id"], $comment, $user;
                $stmt->execute();
                
                $stmt->close();
                
                // header("location: forum.php");
            }            
            }
        ?>

        <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="input-wrapper">
                Comment: <input type="text" name="comment"> 
            </div>
            <input type="submit" value="Add Comment">


        </form>

        <form name="input" action="<?php  echo htmlspecialchars("forum.php");?>" method="POST">
            <input type="submit" value="Back">
        </form>
    
    </body>
</html>
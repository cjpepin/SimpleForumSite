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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Test input for harmful content
            function test_in($input){
                $input = trim($input);
                $input = stripslashes($input);
                $input = htmlspecialchars($input);
                return $input;
            }

            $title = (string)test_in($_POST["title"]);
            $body = (string)test_in($_POST["body"]);
            $link = (string)test_in($_POST["link"]);
            $user = $_SESSION['user'];
            if (empty($title)) {
                $allErr = "Title is required.";
            } elseif (empty($body)){
                $allErr = "Body is required";                       
            }  elseif (empty($link)){
                $allErr = "Link is required";                       
            }  elseif (empty($user)){
                $allErr = "I don't know who you are";                       
            } else {
                $stmt = $mysqli -> prepare("insert into posts (title, body, link, user) values (?, ?, ?, ?)");
            
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt->bind_param('ssss', $title, $body, $link, $user);
                
                $stmt->execute();
                
                $stmt->close();
                
                header("location: forum.php");
            }            
            }
        ?>

        <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="input-wrapper">
                Title: <input type="text" name="title"> 
            </div>
            <div class="input-wrapper">
                Body: <input type="text" name="body"> 
            </div>
            <div class="input-wrapper">
                Link: <input type="text" name="link"> 
                <span class="error"> <?php echo htmlentities($allErr);?> </span>
            </div>

            <input type="submit" value="Submit">


        </form>

        <form name="input" action="<?php  echo htmlspecialchars("forum.php");?>" method="POST">
            <input type="submit" value="Go Home">
        </form>
    
    </body>
</html>
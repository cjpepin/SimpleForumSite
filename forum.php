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
            echo("welcome to the forum $user</br>");

            // $result = mysqli_query($mysqli, "SELECT * FROM posts");

            $sql = "SELECT * FROM posts";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $link = $row["link"];
                $id = $row["pk_post_ID"];
                echo $row["pk_post_ID"] . ". " . $row["title"] . "</br>";
                echo $row["body"] . "</br>" . "<a href='$link'>" . $link . "</a>" . "</br>";
                echo "<form name='comment' action='comment.php' method='POST'>
                            <input type='submit' value='See Comments' name='seeComment'>
                            <input type='submit' value='Write Comment' name='writeComment'>
                            <input type='hidden' name='id' value='" . $id . "' />
                        </form>";
            }
            } else {
            echo "0 results";
            }
            $mysqli->close();

            $create = (string)test_in($_POST["createPost"]);
            if (!empty($create)){
                if(empty($user)){
                    $allErr = "You are a guest, you cannot create a post";
                } else {
                    header("location: makepost.php");
                }
            }
            $edit = (string)test_in($_POST["myPost"]);
            if (!empty($edit)){
                if(empty($user)){
                    $allErr = "You are a guest, you cannot edit a post";
                } else {
                    header("location: myposts.php");
                }
            }
            $my_comments = (string)test_in($_POST["myComments"]);
            if (!empty($my_comments)){
                if(empty($user)){
                    $allErr = "You are a guest, you don't have comments";
                } else {
                    header("location: mycomments.php");
                }
            }
            if(isset($_POST["logout"])){
                session_destroy();
                header("location: main.php");
            }
    ?>
        <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="input-wrapper">
                <input type="submit" value="Create Post" name="createPost"> 
                <input type="submit" value="My Posts" name="myPost"> 
                <input type="submit" value="My Comments" name="myComments"> 
                <span class="error"> <?php echo htmlentities($allErr)?> </span>
            </div>
            
           
        </form>
        <form name="input" action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="input-wrapper">
                <input type="submit" name="logout" value="Log Out"> 
                
            </div>
        </form>
        <!-- Send user to seperate site to create a new user account -->
    </body>
</html> 
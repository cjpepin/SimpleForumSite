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
        echo("welcome to the forum $user</br>");

        // $result = mysqli_query($mysqli, "SELECT * FROM posts");

        $sql = "SELECT * FROM comments where user='$user'";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        $i = 0;
        while($row = $result->fetch_assoc()) {
            $i = $i + 1;
            echo "ID(" . $row["comment_ID"] . "): " . $row["comment_body"] . " on post number " . $row["id"] . "</br></br>";
        }
        } else {
        echo "0 results";
        }
        $mysqli->close();
        
    ?>
        <form name="input" action="<?php echo htmlspecialchars("editcomment.php");?>" method="POST">
            <div class="input-wrapper">
                <input type="submit" value="Edit Comment"> 
                
            </div>
        </form>
        <form name="input" action="<?php echo htmlspecialchars("deletecomments.php");?>" method="POST">
            <div class="input-wrapper">
                <input type="submit" value="Delete Comment"> 
            </div>
        </form>
        <form name="input" action="<?php echo htmlspecialchars("forum.php");?>" method="POST">

            <div class="input-wrapper">
                <input type="submit" value="Back"> 
                
            </div>


        </form>
        <!-- Send user to seperate site to create a new user account -->
    </body>
</html> 
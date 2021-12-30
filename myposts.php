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

        $sql = "SELECT * FROM posts where user='$user'";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $link = $row["link"];
            echo $row["pk_post_ID"] . ". " . $row["title"] . "</br>";
            echo $row["body"] . "</br>" . "<a href='$link'>" . $link . "</a>" . "</br>";
        }
        } else {
        echo "0 results";
        }
        $mysqli->close();
        
    ?>
        <form name="input" action="<?php echo htmlspecialchars("edit.php");?>" method="POST">
            <div class="input-wrapper">
                <input type="submit" value="Edit Post"> 
                
            </div>
        </form>
        <form name="input" action="<?php echo htmlspecialchars("delete.php");?>" method="POST">
            <div class="input-wrapper">
                <input type="submit" value="Delete Post"> 
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
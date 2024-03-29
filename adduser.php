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

            $user = (string)test_in($_POST["newUser"]);
            $pass = (string)test_in($_POST["newPass"]);
            $email = (string)test_in($_POST["newEmail"]);
            
            $safe_pass = (string)password_hash($pass, PASSWORD_BCRYPT);
            
            $stmt = $mysqli -> prepare("insert into users (user, pass, email) values (?, ?, ?)");
            
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            
            $stmt->bind_param('sss', $user, $safe_pass, $email);
           
            
            $stmt->execute();
            
            $stmt->close();
     
            }
        ?>

        <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="input-wrapper">
                Username: <input type="text" name="newUser"> <span class="error"> <?php echo htmlentities($dirErr);?> </span>
            </div>
            <div class="input-wrapper">
                Password: <input type="password" name="newPass"> <span class="error"> <?php echo htmlentities($dirErr);?> </span>
            </div>
            <div class="input-wrapper">
                Email: <input type="text" name="newEmail"> <span class="error"> <?php echo htmlentities($dirErr);?> </span>
            </div>

            <input type="submit" value="Submit">


        </form>
        <form name="input" action="<?php session_destroy(); echo htmlspecialchars("main.php");?>" method="POST">
            <input type="submit" value="Go Home">
        </form>
    
    </body>
</html>
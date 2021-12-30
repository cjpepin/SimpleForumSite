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
            echo "Since you are a guest, you cannot add/edit any comments."
        ?>

        <form name="input" action="<?php  echo htmlspecialchars("forum.php");?>" method="POST">
            <input type="submit" value="Back">
        </form>
    
    </body>
</html>
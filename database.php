<?php 

$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'Module3');

        if($mysqli->connect_errno) {
            printf("Connection Failed: %s\n", $mysqli->connect_error);
            exit;
        }

?>
<?php
    $db       = mysqli_connect("localhost", "root", "", "users");
    if($db === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>
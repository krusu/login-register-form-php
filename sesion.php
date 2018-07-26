<?php 
    include ('conection.php');
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $user = $_SESSION['username'];
        $img = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username = '$user'"));
        $row = "<img src='".$img['UserImg']."'>";
        //echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
    } else {
        header('location: index.php');
    }
?>
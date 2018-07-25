<?php 
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $user = $_SESSION['username'];
        $conn    = mysqli_connect("localhost", "root", "", "users");
        $logresult = mysqli_fetch_assoc(mysqli_query($conn, "SELECT UserImg FROM users WHERE username = '$user'"));
        $img    = implode($logresult);
        //echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
    } else {
        header('location: index.php');
    }
?>
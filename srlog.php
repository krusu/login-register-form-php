<?php
    $errors  = array(); 
    $logpass = $logusername = "";   
    $conn    = mysqli_connect("localhost", "root", "", "users");
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    if(isset($_POST['login'])){
        $logusername  = mysqli_real_escape_string($conn, $_POST['logusername']);
        $logpass      = mysqli_real_escape_string($conn, $_POST['logpass']);
        if (empty($logusername) || empty($logpass)){
            array_push($errors, "Username is required");
        } 
        if(count($errors) == 0){
            $pswrdchk = md5($logpass);
            $logrow   = mysqli_fetch_row(mysqli_query($conn, "SELECT count(*) FROM users WHERE username = '$logusername' AND pass = '$pswrdchk'"));
                if(implode($logrow) == 1){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $logusername;
                $_SESSION['success']  = "You are now logged in";
                header('location:profile.php');
            } 
            else{
                array_push($errors, "Wrong username/password combination");
                header('location: index.php');
            }
        }
    }
?>
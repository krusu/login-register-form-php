<?php
    include ('connection.php');
    $errors  = array(); 
    $logpass = $logusername = "";   
    if(isset($_POST['login'])){
        $logusername = mysqli_real_escape_string($db, $_POST['logusername']);
        $logpass     = mysqli_real_escape_string($db, $_POST['logpass']);
        if (empty($logusername) || empty($logpass)){
            array_push($errors, "Username is required");
        } 
        if(count($errors) == 0){
            $pswrdchk = md5($logpass);
            $logrow   = mysqli_fetch_row(mysqli_query($db, "SELECT count(*) FROM users WHERE username = '$logusername' AND pass = '$pswrdchk'"));
                if(implode($logrow) == 1){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $logusername;
                $_SESSION['success']  = "You are now logged in";
                header('location:profile.php');
            } 
            else{
                header('location: index.php');
            }
        }
        else{
            header('location: index.php');
        }
    }
?>
<?php
include ('connection.php');
    $errors   = array(); 
    $firstname= $lastname = $pass1 = $pass2 = $username = $email = $UserImg ="";
    if(isset($_POST['register'])){
        $firstname= mysqli_real_escape_string($db, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email    = mysqli_real_escape_string($db, $_POST['email']);
        $pass1    = mysqli_real_escape_string($db, $_POST['pass1']);
        $pass2    = mysqli_real_escape_string($db, $_POST['pass2']);
        $target   = "upload/". basename( $_FILES['image']['name']); 
        $UserImg = ($_FILES['image']['name']); 
        if(empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($pass1) || empty($pass2) || $pass1 != $pass2){
            array_push($errors, "field is required");
        } 
        $result = mysqli_fetch_assoc(mysqli_query($db, "SELECT count(*) FROM users WHERE username='$username' AND email = '$email'"));
        if(implode($result)<1 && count($errors)<1){
            $pass1 = md5($pass1);
            $sql = "INSERT INTO users (firstname, lastname, username, email, pass, UserImg) VALUES ('$firstname', '$lastname', '$username', '$email', '$pass1', '$target')";
            mysqli_query($db, $sql);
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username']= $username;  
            $_SESSION['success'] = "You are now logged in";
            header('location: profile.php');
        } else{
            echo '<script type="text/javascript">window.location = "index.php"</script>'; 
        }
    }
?>
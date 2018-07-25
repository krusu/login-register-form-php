<?php
    $errors   = array(); 
    $firstname= $lastname = $pass1 = $pass2 = $username = $email = $UserImg ="";
    $db       = mysqli_connect("localhost", "root", "", "users");
    if($db === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    if(isset($_POST['register'])){
        $firstname= mysqli_real_escape_string($db, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email    = mysqli_real_escape_string($db, $_POST['email']);
        $pass1    = mysqli_real_escape_string($db, $_POST['pass1']);
        $pass2    = mysqli_real_escape_string($db, $_POST['pass2']);
        $UserImg  = addslashes(file_get_contents($_FILES['image']['name']));
        if(empty($firstname)){array_push($errors, "field is required");} 
        if(empty($lastname)) { array_push($errors, "field is required");} 
        if(empty($username)) {array_push($errors, "field is required");} 
        if(empty($email)) {array_push($errors, "field is required");} 
        if(empty($pass1)) {array_push($errors, "field is required");} 
        if(empty($pass2)) {array_push($errors, "field is required");}
        if($pass1 != $pass2) {array_push($errors, "The two passwords do not match");}
        $result = mysqli_query($db, "SELECT count(*) AS total FROM users WHERE username='$username' AND email = '$email'");
        $row = mysqli_fetch_assoc($result);
        $cnt = $row['total'];
        if ($cnt<1 && count($errors)<1){
            $pass1 = md5($pass1);
            $sql = "INSERT INTO users (firstname, lastname, username, email, pass, UserImg) VALUES ('$firstname', '$lastname', '$username', '$email', '$pass1', '$UserImg')";
            mysqli_query($db, $sql);
            session_start();
            $_SESSION['logedin'] = true;
            $_SESSION['username']= $username;  
            $_SESSION['success'] = "You are now logged in";
            $_SESSION['img']     = $UserImg;
            header('location:profile.php');
        } else{
            echo '<script type="text/javascript">window.location = "index.php"</script>'; 
        }
    }
?>
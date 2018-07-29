<?php
include ('connection.php');
    $errors       = array(); 
    $firstname    = $lastname = $pass1 = $pass2 = $username = $email = $image ="";
    if(isset($_POST['register'])){
        $firstname= mysqli_real_escape_string($db, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email    = mysqli_real_escape_string($db, $_POST['email']);
        $pass1    = mysqli_real_escape_string($db, $_POST['pass1']);
        $pass2    = mysqli_real_escape_string($db, $_POST['pass2']);
        $data     = explode(".", $_FILES["image"]["name"]);
        $extension= $data[1];
        $alwd_ext = array("jpg", "png", "gif");
        if(in_array($extension, $alwd_ext)){
            $filename = ($_FILES['image']['name']);
            $nchk = 'upload/'. $filename;
            if(mysqli_fetch_assoc(mysqli_query($db, "SELECT count(*) FROM users WHERE image ='$nchk'")) > 0){
                $new_file_name = rand() . '.' . $extension;
                $path = 'upload/' . $new_file_name;
                move_uploaded_file($_FILES["image"]["tmp_name"], $path);
            }
            else {
                $path = 'upload/'.$filename;
                move_uploaded_file($_FILES['image']['tmp_name'], $path);
            }
        }
        if(empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($pass1) || empty($pass2) || $pass1 != $pass2){
            array_push($errors, "field is required");
        }
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,}$/', $pass1)) {
            array_push($errors, "Password does not meet the requirements! It must be alphanumeric and atleast 8 characters long");
        }
        $result   = mysqli_fetch_assoc(mysqli_query($db, "SELECT count(*) FROM users WHERE username='$username' AND email = '$email'"));
        if(implode($result)<1 && count($errors)<1){
            $pass1= md5($pass1);
            $sql  = "INSERT INTO users (firstname, lastname, username, email, pass, image) VALUES ('$firstname', '$lastname', '$username', '$email', '$pass1', '$path')";
            mysqli_query($db, $sql);
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username']= $username;  
            $_SESSION['success'] = "You are now logged in";
            header('location: profile.php');
        } else{
            echo header('location: index.php'); 
        }

    }
?>
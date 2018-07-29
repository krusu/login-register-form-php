<?php
    include('connection.php');
    session_start();
    if(isset($_POST['uploadimgs'])){
        $user = $_SESSION['username'];
        $foldername = $user."imgs".'/';
        if(!file_exists($foldername)){
            mkdir("$foldername", 0700);
            $UserID = mysqli_query($db, "SELECT UserID FROM users WHERE username = '$user'");
            if (mysqli_num_rows($UserID) > 0) {        
                while($row = mysqli_fetch_assoc($UserID)){        
                    $id = $row["UserID"]; 
                }
            }
            mysqli_query($db, "INSERT INTO imgsfolder (UserID, dir) VALUES ('$id','$foldername')");
        }
        $sql = mysqli_query($db, "SELECT * FROM imgsfolder WHERE dir = '$foldername'");
        while($folderidrow = mysqli_fetch_array($sql)){
            $folderid = $folderidrow['folderid'];
        }
        $data     = explode(".", $_FILES["userfiles"]["name"]);
        $extension= $data[1];
        $AlwdExt  = array("jpg", "JPG", "png", "gif");
        $FileName = ($_FILES['userfiles']['name']);
        if(in_array($extension, $AlwdExt)){
            $chkrow = mysqli_query($db, "SELECT count(*) as c FROM images WHERE imagename ='$FileName'");
            while($chkrows = mysqli_fetch_array($chkrow)){
                $foo = $chkrows['c'];
            }
            if($foo != 0){
                $NewFileName = rand() . '.' . $extension;
                $path = $foldername . $NewFileName;
                if(move_uploaded_file($_FILES["userfiles"]["tmp_name"], $path)){
                mysqli_query($db, "INSERT INTO images (imagename, folderID) VALUES ('$NewFileName', '$folderid')");
                header('location: profile.php');
                }
                else {
                    echo "false;";
                    print_r($_FILES);}
            }
            else if($foo == 0){
                $path = $foldername.$FileName;
                if(move_uploaded_file($_FILES['userfiles']['tmp_name'], $path)){
                mysqli_query($db, "INSERT INTO images (imagename, folderID) VALUES ('$FileName', '$folderid')");
                header('location: profile.php');
                }
                else {
                    echo "false";
                    print_r($_FILES);
                }
            }
        }
    }
?>
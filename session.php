<?php 
    include ('connection.php');
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $user = $_SESSION['username'];
        $img  = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username = '$user'"));
        $row  = "<img src='".$img['image']."'";
        $userid = $img['UserID'];
        $images = array();
        if($img = mysqli_query($db, "SELECT imagename FROM images WHERE folderID = (SELECT folderid FROM imgsfolder WHERE UserID = '$userid')")){
            while($row = mysqli_fetch_assoc($img)){
                $images[] = $row['imagename'];
            }
        }
        if($fldr = mysqli_query($db, "SELECT dir FROM imgsfolder WHERE UserID = (SELECT UserID FROM Users WHERE username = '$user')")){
            while($rows = mysqli_fetch_assoc($fldr)){
                $folder = $rows['dir'];
            }
        }
    } else {
        header('location: index.php');
    }
?>
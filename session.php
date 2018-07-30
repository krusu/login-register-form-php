<?php 
    include ('connection.php');
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $user = $_SESSION['username'];
        $img  = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username = '$user'"));
        $folder = $user."imgs".'/';
        $display  = $folder.$img['image'];
        $images = array();
        if($img = mysqli_query($db, "SELECT imagename FROM images WHERE folderID = (SELECT folderid FROM imgsfolder WHERE dir = '$folder')")){
            while($row = mysqli_fetch_assoc($img)){
                $images[] = $folder.$row['imagename'];
            }
        }
    } else {
        header('location: index.php');
    }
?>
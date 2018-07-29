<?php include('session.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>for fun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
    <h1>Welcome: <?php echo $_SESSION['username'];?></h1> <br>
    <h3><?php echo $_SESSION['success'];?></h3> <br>
    <?php echo $row.'height="100px" width="100px">';?>
    <form method="get">
        <button name="logout">Logout</button>
    </form>
    <?php 
        if(isset($_GET['logout'])){
            session_unset();
            session_destroy();
            header('location: index.php');
        }
    ?>
    <form method="post" action="upload.php" enctype="multipart/form-data">
        <input type="file" name="userfiles">
        <input type="submit" name="uploadimgs">
    </form>
</body>
</html>
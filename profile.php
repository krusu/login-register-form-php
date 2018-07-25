<?php include('sesion.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
    <h1>Welcome: <?php echo $_SESSION['username'];?></h1>
    <h3><?php echo $_SESSION['success'];?></h3>
    <img src="<?php echo $img['UserImg'];?>" heigth="100" width="100">;
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
</body>
</html>
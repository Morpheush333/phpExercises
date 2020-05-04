<?php
    session_start();

    if(!isset($_SESSION['correctRegistration'])){
        header('Location: index.php');
        exit();
    }
    else{
        unset($_SESSION['correctRegistration']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <title>The Settlers - browser game</title>
</head>

<body>

    Hello in the game settlers <br /> Thanks for registry in our servis!<br/> <br/>

    <a href="index.php">LogIn on your account! </a>
    <br><br>
    
</body>
</html>

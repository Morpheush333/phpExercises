<?php
    session_start();

    if(!isset($_SESSION['correctRegistration'])){
        header('Location: index.php');
        exit();
    }
    else{
        unset($_SESSION['correctRegistration']);
    }

    if(isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
    if(isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
    if(isset($_SESSION['fr_password1'])) unset($_SESSION['fr_password1']);
    if(isset($_SESSION['fr_password2'])) unset($_SESSION['fr_password2']);
    if(isset($_SESSION['fr_regulations'])) unset($_SESSION['fr_regulations']);

    if(isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
    if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
    if(isset($_SESSION['e_password1'])) unset($_SESSION['e_password1']);
    if(isset($_SESSION['e_password2'])) unset($_SESSION['e_password2']);
    if(isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);
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

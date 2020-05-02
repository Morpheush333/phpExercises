<?php
    session_start();

    if((isset($_SESSION['logInTrue'])) && ($_SESSION['logInTrue']==true)){
        header('Location: game.php');
        exit();
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

    The Settlers <br/> <br/>

    <a href="registration.php">Create a new free account! </a>

    <form action="login.php" method="POST">

        Login: <br><input type="text" name="login"><br>
        Password: <br><input type="password" name="password"><br><br>
        <input type="submit" value="Log In">


    </form>

<?php
    if(isset($_SESSION['wrongLog']))    echo $_SESSION['wrongLog'];

?>
    
</body>
</html>
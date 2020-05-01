<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <title>The Settlers - browser game</title>
</head>

<body>

<?php

    echo"<p>Hello ".$_SESSION['user']."!</p>";
    echo"<p><b>Wood</b>: ".$_SESSION['wood'];
    echo" | <b>Stone</b>: ".$_SESSION['stone'];
    echo" | <b>Gold</b>: ".$_SESSION['gold']."</p>";

    echo"<p><b>Email</b>: ".$_SESSION['email'];
    echo"</br><b>Premium</b>: ".$_SESSION['premium']."</p>";


?>
    
</body>
</html>
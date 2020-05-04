<?php
    session_start();

    if(!isset($_SESSION['logInTrue'])){
        header('Location: index.php');
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

<?php

    echo"<p>Hello ".$_SESSION['user'].'! [ <a href="logout.php">Logout</a> ] </p>';
    echo"<p><b>Wood</b>: ".$_SESSION['wood'];
    echo" | <b>Stone</b>: ".$_SESSION['stone'];
    echo" | <b>Gold</b>: ".$_SESSION['gold']."</p>";

    echo"<p><b>Email</b>: ".$_SESSION['email'];
    echo"</br><b>Premium expiration date</b>: ".$_SESSION['premium']."</p>";

    echo time()."<br>";
    echo date('d-m-Y H:i:s').'<br>';

    $dateTime = new DateTime('2150-01-06 22:10:59');
    echo "Data time server: ".$dateTime->format('Y-m-d H:i:s')."<br>";

    $premiumEnd = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['premium']);

    $subtraction = $dateTime->diff($premiumEnd);

    if($dateTime<$premiumEnd)
    echo "Premium left: ".$subtraction->format('%d days, %h hour, %i minutes, %s second');
    else
    echo "Premium not active from: ".$subtraction->format('%y years, %m months, %d days, %h hour, %i minutes, %s second');
    


?>
    
</body>
</html>
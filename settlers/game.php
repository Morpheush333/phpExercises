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

    echo"<p>Hello ".$_SESSION['user']."!";


?>
    
</body>
</html>
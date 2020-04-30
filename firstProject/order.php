<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pharmacy order collection</title>
</head>
<body>

<?php

    $aspirine = $_POST['aspirine'];
    $mask = $_POST['mask'];
    $result = $aspirine * 2.99 + $mask * 8.99; 

echo<<<END
    
    <h2>Summary order <h2>
    <table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <td>Aspirine (2,99 Euro/each) </td><td>$aspirine </td>
    </tr>
    <tr>
        <td>Mask (8,99 Euro/pack x12) </td><td>$mask </td>
    </tr>
    <tr>
        <td>To pay </td> <td> $result Euro</td>
    </tr>
    </table>
    <br><a href="index.html">Return to Pharmacy order form</a>


END;

?>
    
</body>
</html>
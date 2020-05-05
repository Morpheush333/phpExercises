<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Newsletter - save profile!</title>
    <meta name="description" content="Using PDO - save to database MySQL">
    <meta name="keywords" content="php, PDO, connect, MySQL">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">

        <header>
            <h1>Newsletter</h1>
        </header>

        <main>
            <article>
                <form method="post" action="save.php">
                    <label>Enter your e-mail
                        <input type="email" name="email" <?= isset($_SESSION['given_email'])
                        ? 'value="' .$_SESSION['given_email'] . '"' : '' ?>>
                    </label>
                    <input type="submit" value="Register!">
                    <?php

                    if(isset($_SESSION['given_email'])){
                        echo '<p>Provide email is incorrect! </p>';
                        unset($_SESSION['given_email']);
                    }
                    ?>
                </form>
            </article>
        </main>

    </div>
</body>
</html>
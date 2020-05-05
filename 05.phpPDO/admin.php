<?php
session_start();

if(isset($_SESSION['logged_id'])){
    header('Location: list.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Panel admin</title>
    <meta name="description" content="Using PDO - load from MySQL">
    <meta name="keywords" content="php, PDO, connect, MySQL">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">

        <header>
            <h1>Admin</h1>
        </header>

        <main>
            <article>
                <form method="post" action="list.php">
                    <label>Login <input type="text" name="login"></label>
                    <label>Password <input type="password" name="pass"></label>
                    <input type="submit" value="Login!">
                    <?php
                        if(isset($_SESSION['bad_attempt'])){
                            echo '<p>Wrong login or password </p>';
                            unset($_SESSION['bad_attempt']);
                        }
                    ?>


                </form>
            </article>
        </main>

    </div>
</body>
</html>
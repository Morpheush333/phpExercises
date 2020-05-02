<?php

    session_start();

    if(!isset($_POST['login']) || (!isset($_POST['password']))){
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";

    $connect = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connect->connect_errno !=0){
        echo'Error: '.$connect->connect_errno;
    }
    else{
        
        $login = $_POST['login'];
        $password = $_POST['password'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $password = htmlentities($password, ENT_QUOTES, "UTF-8");

        if($result = @$connect->query(
            sprintf("SELECT * FROM users WHERE BINARY user='%s' AND BINARY pass='%s'",
            mysqli_real_escape_string($connect, $login),
            mysqli_real_escape_string($connect, $password)))){

            $db_users = $result->num_rows;

            if($db_users > 0){

                $_SESSION['logInTrue'] = true;

                $line = $result->fetch_assoc();
                $_SESSION['id'] = $line['id'];
                $_SESSION['user'] = $line['user'];
                $_SESSION['wood'] = $line['wood'];

                $_SESSION['stone'] = $line['stone'];
                $_SESSION['gold'] = $line['gold'];
                $_SESSION['email'] = $line['email'];
                $_SESSION['premium'] = $line['premium'];

                unset($_SESSION['wrongLog']);
                $result->free_result();
                header('Location: game.php');
            }
            else {

            $_SESSION['wrongLog'] = '<span style="color:red"> Wrong login or password!</span>';
            header('Location: index.php');

            }

        }

        $connect->close();
    }

?>
<?php

    require_once "connect.php";

    $connect = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connect->connect_errno !=0){
        echo'Error: '.$connect->connect_errno;
    }
    else{
        
        $login = $_POST['login'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE user='$login' AND pass='$password'";

        if($result = @$connect->query($sql)){

            $db_users = $result->num_rows;
            if($db_users > 0){
                $line = $result->fetch_assoc();
                $user = $line['user'];

                $result->free_result();

                echo $user;
            }
            else {

            }

        }

        $connect->close();
    }

?>
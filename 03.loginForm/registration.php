<?php
    session_start();

    if(isset($_POST['email'])){

        $allGood = true;

        $nick=$_POST['nick'];

        if((strlen($nick) <3) || (strlen($nick) > 20)){

            $allGood = false;
            $_SESSION['e_nick'] = "Nickname must be between 3 and 20 characters long";
        }

        if(ctype_alnum($nick)==false){

            $allGood = false;
            $_SESSION['e_nick'] = "Nickname must contains letters and numbers";
        }

        $email = $_POST['email'];
        $emailValidation = filter_var($email, FILTER_SANITIZE_EMAIL);

        if((filter_var($emailValidation, FILTER_VALIDATE_EMAIL) == false) || $emailValidation != $email){

            $allGood = false;
            $_SESSION['e_email'] = "please enter a valid email";
        }

        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if((strlen($password1) < 8) || (strlen($password2) > 20)){

            $allGood = false;
            $_SESSION['e_password'] = "Password must be between 8 and 20 characters long";
        }

        if($password1 != $password2){

            $allGood = false;
            $_SESSION['e_password'] = "Passwords aren't equal";
        }

        $password_hash = password_hash($password1, PASSWORD_DEFAULT);
        
        if(!isset($_POST['regulations'])){

            $allGood = false;
            $_SESSION['e_regulations'] = "Confirm regulations";
        }

        
        $secret = "";

        $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);

        $response = json_decode($check);

        if($response->success==false){

            $allGood = false;
            $_SESSION['e_bot'] = "Confirm that you are not a bot";
        }

        $_SESSION['fr_nick'] = $nick;
        $_SESSION['fr_email'] = $email;
        $_SESSION['fr_password1'] = $password1;
        $_SESSION['fr_password2'] = $password2;
        if(isset($_POST['regulations'])) $_SESSION['fr_regulations'] = true;

        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try{
            $connect = new mysqli($host, $db_user, $db_password, $db_name);
            if($connect->connect_errno !=0){
                throw new Exception(mysqli_connect_errno());
            }
            else{
                // check email
                $results = $connect->query("SELECT id FROM users WHERE email='$email'");

                if(!$results) throw new Exception($connect->error); 

                $check_email = $results->num_rows;
                if($check_email > 0){
                    $allGood = false;
                    $_SESSION['e_email'] = "There is an account assigned to this email";
                }

                // check nick
                $results = $connect->query("SELECT id FROM users WHERE user='$nick'");

                if(!$results) throw new Exception($connect->error); 

                $check_nick = $results->num_rows;
                if($check_nick > 0){
                    $allGood = false;
                    $_SESSION['e_nick'] = "There is already a player with such a nickname, choose another one";
                }

                if($allGood == true){
                    
                    if($connect->query("INSERT INTO users VALUES (NULL, '$nick', '$password_hash', '$email', 100, 100, 50, 14)")){
                        $_SESSION['correctRegistration'] = true;
                        header('Location: hello.php');
                    }
                    else{
                        throw new Exception($connect->error);
                    }
                }
                
                $connect -> close();
            }
        }
        catch (exception $e){
            echo '<span style="color:red;">Server error, sorry for any inconvenience please log in at another time</span>';
            echo '<br />Developer information '.$e;
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <title>The Settlers - create free account!</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        .error{
            color:red;
            margin-top:10px;
            margin-bottom:10px;
        }
    </style>
</head>

<body>

    <form method = "post">

    Nickname: <br/><input type="text" value="<?php
        if(isset($_SESSION['fr_nick'])){
            echo $_SESSION['fr_nick'];
            unset($_SESSION['fr_nick']);
        }
    ?>" name="nick" /><br/>
    <?php
        if(isset($_SESSION['e_nick'])){
            echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
            unset($_SESSION['e_nick']);
        }
    ?>

    E-mail: <br/><input type="text" value="<?php
        if(isset($_SESSION['fr_email'])){
            echo $_SESSION['fr_email'];
            unset($_SESSION['fr_email']);
        }
    ?>" name="email"> </input><br/>

    <?php
        if(isset($_SESSION['e_email'])){
            echo '<div class="error">'.$_SESSION['e_email'].'</div>';
            unset($_SESSION['e_email']);
        }
    ?>

    Password: <br/><input type="password" value="<?php
        if(isset($_SESSION['fr_password1'])){
            echo $_SESSION['fr_password1'];
            unset($_SESSION['fr_password1']);
        }
    ?>" name="password1"><br/>
    <?php
        if(isset($_SESSION['e_password'])){
            echo '<div class="error">'.$_SESSION['e_password'].'</div>';
            unset($_SESSION['e_password']);
        }
    ?>
    Repeat-password: <br/><input type="password" value="<?php
        if(isset($_SESSION['fr_password2'])){
            echo $_SESSION['fr_password2'];
            unset($_SESSION['fr_password2']);
        }
    ?>" name="password2"><br/>

    <label>
    <input type="checkbox" name="regulations" <?php
        if(isset($_SESSION['fr_regulations'])){
            echo $_SESSION['fr_regulations'];
            unset($_SESSION['fr_regulations']);
        }
    ?>>I accept the terms and conditions
    <label>
    <?php
        if(isset($_SESSION['e_regulations'])){
            echo '<div class="error">'.$_SESSION['e_regulations'].'</div>';
            unset($_SESSION['e_regulations']);
        }
    ?>

    <div class="g-recaptcha" data-sitekey="6LfMYPEUAAAAAAv2xW_T0hgdzEavvla8e6HUrmOH"></div>
    <?php
        if(isset($_SESSION['e_bot'])){
            echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
            unset($_SESSION['e_bot']);
        }
    ?>

    <br />
    <input type="submit" value="register">

</form>
    
</body>
</html>
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

        $secret = "6LfMYPEUAAAAANMszXsDVpJHIcol0vgo1QcUWS6H";

        $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);

        $response = json_decode($check);

        if($response->success==false){

            $allGood = false;
            $_SESSION['e_bot'] = "Confirm that you are not a bot";
        }

        if($allGood == true){
            echo "Validation ok"; exit();
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

    Nickname: <br/><input type="text" name="nick"> </input><br/>
    <?php
        if(isset($_SESSION['e_nick'])){
            echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
            unset($_SESSION['e_nick']);
        }
    ?>

    E-mail: <br/><input type="text" name="email"> </input><br/>

    <?php
        if(isset($_SESSION['e_email'])){
            echo '<div class="error">'.$_SESSION['e_email'].'</div>';
            unset($_SESSION['e_email']);
        }
    ?>

    Password: <br/><input type="password" name="password1"> </input><br/>
    <?php
        if(isset($_SESSION['e_password'])){
            echo '<div class="error">'.$_SESSION['e_password'].'</div>';
            unset($_SESSION['e_password']);
        }
    ?>
    Repeat-password: <br/><input type="password" name="password2"> </input><br/>

    <label>
    <input type="checkbox" name="regulations">I accept the terms and conditions
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
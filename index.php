<?php
include('includes/sessions.php');

include("create_session.php");
$objectDB = new CreateSession;
$objectDB->connect();

include("./db.php");
include("signup/login_page.php");

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup/index.css">
    <title>Document</title>
</head>
<body>
    <?= include("./includes/header.php") ?>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
        <div>
            <label for="login-email">Email</label>
            <input type="email" name="login-email" id="login-email"/>
        </div>
        <div>
            <label for="login-password">Password</label>
            <input type="password" name="login-password" id="login-password"/>
        </div>
        <button type="submit">Login</button>
         <a href="signup/signup_page.php" >Sign up</a>
    </form>
</body>
</html>
<?php
// Session for login/ logout
include('includes/sessions.php');

// Session for creating new database
include("create_session.php");
$objectDB = new CreateSession;
$objectDB->connect();

// Connect to MyPhp App
include("./db.php");

// Check if users login
include("signup/login_page.php");

// Validate homepage
function test_inputs($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$msgClass = "";
$displayMsg = "";
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
    <?php include("./includes/header.php") ?>
    <?php if( $displayMsg != "") {
    ?>
        <div class= "msg <?= $msgClass ?>"><?= $displayMsg ?></div>
    <?php        
        }
    ?>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
        <div>
            <label for="login-email">Email</label>
            <input type="email" name="login-email" id="login-email" placeholder="Please enter email" value="<?= isset($_POST['login-email']) ? test_inputs($_POST['login-email']) : "" ?>"/>
        </div>
        <div>
            <label for="login-password">Password</label>
            <input type="password" name="login-password" id="login-password" placeholder="Please enter password"/>
        </div>
        <button type="submit">Login</button>
        <a href="signup/updated_password.php" >Change password</a>
        <a href="signup/signup_page.php" >Sign up</a>
    </form>
</body>
</html>
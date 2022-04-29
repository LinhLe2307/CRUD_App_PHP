<?php
    include("../db.php");  
    $objectDb = new DatabaseConnect;
    $conn = $objectDb->connect();

    // $method = $_SERVER[];
    if(isset($_POST['submit'])) {

        $email = $_POST['email'];
        $oldPassword = $_POST['old-password'];
        $updatedPassword = $_POST['update-password'];
        $updatedPassAgain = $_POST['update-password-again'];

        // Password encryption
        $hashFormat = "$2y$10$";
        $salt = "helsinkibusinesscollege";
        $hashFormatAndSalt = $hashFormat . $salt;
        $oldPassEncrypted = crypt($oldPassword, $hashFormatAndSalt);
        $passEncrypted = crypt($updatedPassword, $hashFormatAndSalt);

        $query = "SELECT email FROM user_registration_123 ";
        $query .= "WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if (!$stmt->rowCount() ) {
            echo ("Please enter a valid address");
            // exit;
        } else {

            $query2 = "SELECT password FROM user_registration_123 ";
            $query2 .= "WHERE email = :email";
            $stmt2 = $conn->prepare($query2);
            $stmt2->bindValue(':email', $email);
            $stmt2->execute();

            while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                //This is for checking the input's password with the one in the database
                if ($oldPassEncrypted === $row['password']) {
                    
                    // This is for checking the first update password with the password again
                    if($updatedPassword === $updatedPassAgain) {
                        $query = "UPDATE user_registration_123 SET ";
                        $query .= "password = :password ";
                        $query .= "WHERE email = :email";
                        
                        $stmt = $conn->prepare($query);
                        $stmt->bindValue(':password', $passEncrypted);
                        $stmt->bindValue(':email', $email);
                        $stmt->execute();
                    } else {
                        echo 'Please enter the same password';
                    }
                }
                break;
            }
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
    <?php include("../includes/header.php") ?>
    <h1>CHANGE PASSWORD</h1>
    <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
        <div>
            <label for='email'>Please enter email</label>
            <input id='email' name='email' type="email"/>
        </div>
        <div>
            <label for='old-password'>Please enter your old password</label>
            <input id='old-password' name='old-password' type="password" />
        </div>
        <div>
            <label for='update-password'>Please enter password</label>
            <input id='update-password' name='update-password' type="password" />
        </div>
        <div>
            <label for='update-password-again'>Please enter password again</label>
            <input id='update-password-again' name='update-password-again' type="password" />
        </div>
        <button type=submit name='submit'>UPDATE</button>
    </form>
</body>
</html>
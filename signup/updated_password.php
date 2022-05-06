<?php
    include("../db.php");  
    $objectDb = new DatabaseConnect;
    $conn = $objectDb->connect();
    function test_inputs($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $msgClass = "";
    $displayMsg = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = $_POST['email'];
        $oldPassword = $_POST['old-password'];
        $updatedPassword = $_POST['update-password'];
        $updatedPassAgain = $_POST['reenter-password'];

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
            $displayMsg = ("Please enter valid inputs");
            $msgClass = "danger-alert";
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
                        $displayMsg = "Update password successfully!";
                        $msgClass = "success-alert";
                    } else {
                        $displayMsg = 'Please update the same passwords';
                         $msgClass = "danger-alert";
                    }
                } else {
                    $displayMsg = 'Please enter the correct password';
                    $msgClass = "danger-alert";
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
    <link rel="stylesheet" href="./index.css">
    <title>Document</title>
</head>
<body>
    <?php include("../includes/header.php") ?>
    <h1 id="title">Change Password</h1>
    <a href="../index.php" class="back-link">Back</a>

    <?php if($displayMsg != "") {
    ?>
        <div class= "msg <?= $msgClass ?>"><?= $displayMsg ?></div>
    <?php        
        }
        ?>
    <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
        <div>
            <label for='email'>Enter your email</label>
            <input id='email' name='email' type="email" value= "<?= isset($_POST['email']) ? test_inputs($_POST['email']) : "" ?>" placeholder="Your email"/>
        </div>
        <div>
            <label for='old-password'>Enter old password</label>
            <input id='old-password' name='old-password' type="password" placeholder="Old password"/>
        </div>
        <div>
            <label for='update-password'>Enter new password</label>
            <input id='update-password' name='update-password' type="password" placeholder="New password"/>
        </div>
        <div>
            <label for='reenter-password'>Re-enter new password</label>
            <input id='reenter-password' name='reenter-password' type="password" placeholder="Re-enter new password"/>
        </div>
        <button type=submit name='submit'>UPDATE</button>
    </form>

</body>
</html>
<?php
    $objectDb = new DatabaseConnect;
    $conn = $objectDb->connect();

    $query = "SELECT * FROM user_registration_123";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    if($logged_in) {
        header('Location: form/form.php');
        exit;
    }

    

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $user_email = $_POST['login-email'];
        $user_password = $_POST['login-password'];

        // Password encryption
        $hashFormat = "$2y$10$";
        $salt = "helsinkibusinesscollege";
        $hashFormatAndSalt = $hashFormat . $salt;
        $pass_encrypted = crypt($user_password, $hashFormatAndSalt);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($user_email === $row['email'] && $pass_encrypted === $row['password']) {
                login();
                // login(); //Call login function
                header('Location: form/form.php'); // Redirect to form page
                exit;
            }
        }
    }
?>
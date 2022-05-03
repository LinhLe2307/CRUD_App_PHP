<?php
    // Create DatabaseConnect object
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

        $userEmail = $_POST['login-email'];
        $userPassword = $_POST['login-password'];

        // Password encryption
        $hashFormat = "$2y$10$";
        $salt = "helsinkibusinesscollege";
        $hashFormatAndSalt = $hashFormat . $salt;
        $passEncrypted = crypt($userPassword, $hashFormatAndSalt);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($userEmail === $row['email'] && $passEncrypted === $row['password']) {
                login();
                // login(); //Call login function
                header('Location: form/form.php'); // Redirect to form page
                $_SESSION['userDatabase'] = $userEmail;
                exit;
            } else {
                $displayMsg = ('Please enter correct email and password');
                $msgClass = "danger-alert";
            }
        }
    }
?>
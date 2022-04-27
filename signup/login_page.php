<?php
    // include ("../db.php");

    $objectDb = new DatabaseConnect;
    $conn = $objectDb->connect();

    $query = "SELECT * FROM user_registration_123";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $user_email = $_POST['login-email'];
        $user_password = $_POST['login-password'];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($user_email === $row['email'] && $user_password === $row['password']) {
                // login(); //Call login function
                header('Location: form/form.php'); // Redirect to form page
                exit;
            }
        }
    }
?>
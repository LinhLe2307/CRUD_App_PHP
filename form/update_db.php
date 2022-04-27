<?php

if(isset($_POST['update'])) {
    $update = ($_POST['update']);
    $userId = $_POST['userId'];
    $count = count($userId);
    for($x = 0; $x < $count; $x += 1){
        if ($userId[$x] === $update) {
            $objectDb = new DatabaseConnect;
            $conn = $objectDb->connect();
        break;
        }
    }
    
    // This is for sanitizing the user's inputs
    $firstname = ($_POST['updateFirstname']) ?? ($_POST['updateFirstname']);
    $lastname = ($_POST['updateLastname']) ?? ($_POST['updateLastname']);
    $email = ($_POST['updateEmail']) ?? ($_POST['updateEmail']);
    $phonenumber = ($_POST['updatePhone']) ?? ($_POST['updatePhone']);
    $gender = ($_POST['updateGender']) ?? ($_POST['updateGender']);

    $query = "UPDATE form_table_123 SET ";
    $query .= "firstname = :firstname, ";
    $query .= "lastname = :lastname, ";
    $query .= "email = :email, ";
    $query .= "phonenumber = :phonenumber, ";
    $query .= "gender = :gender ";
    $query .= "WHERE id = :update";

    $stmt = $conn->prepare($query);

    $stmt->bindValue(':firstname', $firstname[$x]);
    $stmt->bindValue(':lastname', $lastname[$x]);
    $stmt->bindValue(':email', $email[$x]);
    $stmt->bindValue(':phonenumber', $phonenumber[$x]);
    $stmt->bindValue(':gender', $gender[$x]);
    $stmt->bindValue(':update', $update);
    $stmt->execute();
            
    if(!$stmt->execute()) {
        $displayMsg = die('Update task(s) failed!');
        $msgClass = "danger-alert";
    } else {
        $displayMsg = ('Update task(s) successfully!');
        $msgClass = "success-alert";
    }

}
 
?>
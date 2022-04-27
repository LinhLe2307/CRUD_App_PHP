<?php 
    // $method = $_SERVER['REQUEST_METHOD'];
    // switch ($method) {
        //     case 'POST':
            if (isset($_POST['submit'])) {
                // This is for sanitizing the user's inputs
                $firstname = test_inputs($_POST['firstname']);
                $lastname = test_inputs($_POST['lastname']);
                $email = test_inputs($_POST['email']);
                $phonenumber = test_inputs($_POST['phonenumber']);
                $gender = test_inputs($_POST['gender'] ?? "");
                
                if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($phonenumber) && !empty($gender)) {
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $objectDB = new DatabaseConnect;
                $conn = $objectDB->connect();
                $sql = 'INSERT INTO form_table_123(id, firstname, lastname, email, phonenumber, gender) VALUES(null, :firstname, :lastname, :email, :phonenumber, :gender)';
                $stmt = $conn->prepare($sql);
                    
                $stmt->bindValue(':firstname', $firstname);
                $stmt->bindValue(':lastname', $lastname);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':phonenumber', $phonenumber);
                $stmt->bindValue(':gender', $gender);

                if($stmt->execute()){
                    $response = ['status'=>1, 'message'=> 'Record created successfully.'];
                    // $response = 'Success';
                    $displayMsg = "Add task successfully!";
                    $msgClass = "success-alert";
                } else {
                    $response = ['status'=>0, 'message'=> 'Failed to insert or create record.'];
                    $displayMsg = "Please fill in all fields!";
                    $msgClass = "danger-alert";
                }
                    
                } else {
                    $displayMsg = "Please fill in all fields!";
                    $msgClass = "danger-alert";
                }
            } else {
                    $displayMsg = "Please fill in all fields!";
                    $msgClass = "danger-alert";
                }
   
}
        
    



<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['delete'])) {
            $delete = $_POST['delete'];
            $objectDb = new DatabaseConnect;
            $conn = $objectDb->connect();
            $query = "DELETE FROM `{$_SESSION['userDatabase']}` ";
            $query .= "WHERE id = :delete";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':delete', $delete);
            
            if(!$stmt->execute()) {
                $displayMsg = die('Delete task(s) failed!');
                $msgClass = "danger-alert";
            } else {
                $displayMsg = ('Delete task(s) successfully!');
                $msgClass = "success-alert";
            }
        }
    }
?>
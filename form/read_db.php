<?php
    $objectDB = new DatabaseConnect;
    $conn = $objectDB->connect();
    $query = "SELECT * FROM `{$_SESSION['userDatabase']}`";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if($displayMsg != "") {
?>
        <div class= "msg <?= $msgClass ?>"><?= $displayMsg ?></div>
<?php        
    }
?>
<table class="output-container">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Gender</th>
        <th>Update/ Delete</th>
    </tr>
    
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        static $orderNumber = 0;
        $id = $row['id'];
        ?>
        <tr>
            <td><?= ++$orderNumber ?></td>
            <input name="userId[]" value="<?= $id; ?>" hidden />
            <td><input name="updateFirstname[]" id="update-firstname" value="<?= $row['firstname'] ?>" required /></td>
            <td><input name="updateLastname[]" id="update-lastname" value="<?= $row['lastname']?>" required /></td>
            <td><input name="updateEmail[]" id="update-email" value="<?= $row['email']?>" required /></td>
            <td><input name="updatePhone[]" id="update-phonenumber" value="<?= $row['phonenumber']?>" required /></td>
            <td> <?= $row['gender']?>
                <select name="updateGender[]" >
                    <option value="Male"
                        <?= 
                           (($row['gender'] === 'Male')) ? ' selected="selected"' : ""
                            
                        ?>
                    >Male</option>
                    <option value="Female"
                        <?= 
                            (($row['gender'] === 'Female')) ? ' selected="selected"' : "";
                        ?>
                    >Female</option>
                    <option value="Other"
                        <?=
                            (($row['gender'] === 'Other')) ? ' selected="selected"' : "" ;
                            
                        ?>
                    >Other</option>
                </select>
            </td>
            <td>
                <button type="submit" name="update" class="btn updateBtn" value="<?= $id; ?>">UPDATE</button>
                <button type="submit" name="delete" class="btn deleteBtn" value="<?= $id; ?>">DELETE</button>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
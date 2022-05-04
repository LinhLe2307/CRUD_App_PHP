<?php 
    include("../create_session.php");
    $objectDB = new CreateSession;
    $objectDB->connect();

    include("../db.php");  

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
    <link rel="stylesheet" href="index.css">
    <title>Form Application</title>
</head>
<body>
    <?php include("../includes/header.php") ?>
    <main>
        <h1 id="title">SignUp Form</h1>
        <form method="post" action="" class="form-container">
            <div>
                <label for="firstname">First name: </label>
                <input type="text" id="firstname" name="firstname" placeholder="First Name"value="<?= isset($_POST['firstname']) ? test_inputs($_POST['firstname']) : "" ?>"/>
            </div>
            <div>
                <label for="lastname">Last name: </label>
                <input type="text" id="lastname" name="lastname" placeholder="Last Name" value="<?= isset($_POST['lastname']) ? test_inputs($_POST['lastname']) : "" ?>"/>
            </div>
            <div>
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? test_inputs($_POST['email']) : "" ?>"/>
            </div>
            <div>
                <label for="password">Password: </label>
                <input type="password" id="password" name="password" placeholder="Password"/>
            </div>
            <div>
                <label for="phonenumber">Phone Number: </label>
                <input type="tel" id="phonenumber" name="phonenumber" placeholder="Phone Number" value="<?= isset($_POST['phonenumber']) ? test_inputs($_POST['phonenumber']) : "" ?>"/>
            </div>
            <div>
                <label for="gender" class="gender">Gender: </label>
                <input type="radio" id="male" name="gender" value="Male"
                <?php 
                    if (isset($_POST["gender"]) && (test_inputs($_POST["gender"]) === 'Male')) {
                        echo 'checked';
                    }
                ?>
                />
                <label for="male" class="gender">Male </label>
                <input type="radio" id="female" name="gender" value="Female"
                <?php 
                    if (isset($_POST["gender"]) && (test_inputs($_POST["gender"]) === 'Female')) {
                        echo 'checked';
                    }
                ?>
                />
                <label for="female" class="gender">Female </label>
                <input type="radio" id="other" name="gender" value="Other"
                <?php 
                    if (isset($_POST["gender"]) && (test_inputs($_POST["gender"]) === 'Other')) {
                        echo 'checked';
                    }
                ?>
                />
                <label for="other" class="gender">Other </label>
            </div>
            <button type="submit" name="submit" class="btn submitBtn">SUBMIT</button>

            <!-- Insert all users' inputs to database -->
            <?php include("insert_db.php")?>
            
        </form>
        
        <!-- Back to index.php -->
    </main>
    <a href="../index.php" class="back-link">Back</a>

</body>
</html>
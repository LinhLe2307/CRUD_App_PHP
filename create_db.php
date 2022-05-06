<?php 
class CreateDatabase {
    private $server = 'db';
    private $user = 'root';
    private $pass = 'lionPass';

    public function connect(){
        try {
            
            $conn = new PDO('mysql:host=' .$this->server , $this->user, $this->pass);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Drop database if exitsts
            $query = "DROP DATABASE IF EXISTS Linh_Le_CRUD"; 
            $stmt = $conn->prepare($query);
            $stmt->execute();

            // Create database
            $query = "CREATE DATABASE Linh_Le_CRUD";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            
            // Use database
            $query = "USE Linh_Le_CRUD";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            

            $query = "CREATE TABLE IF NOT EXISTS user_registration_123(
                id INTEGER(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                firstname VARCHAR(50) NOT NULL,
                lastname VARCHAR(50) NOT NULL,
                email VARCHAR(50) NOT NULL,
                password VARCHAR(50) NOT NULL,
                phonenumber VARCHAR(14) NOT NULL,
                gender VARCHAR(12) NOT NULL
                )";
            $stmt = $conn->prepare($query);
            $stmt->execute();

        } catch(\Exception $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
}
?>
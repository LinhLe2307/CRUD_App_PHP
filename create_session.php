<?php 
    // session_start();
    
    class CreateSession {
        private $host = 'db';
        private $dbname = 'Linh_Le_CRUD';
        private $user = 'root';
        private $pass = 'lionPass';
        public function connect(){
        try {
            $conn = new PDO('mysql:host=' .$this->host , $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SHOW DATABASES LIKE :dbname";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':dbname', $this->dbname);
            $stmt->execute();
            
            if (empty($stmt->fetchAll(PDO::FETCH_ASSOC))) {
                
                // unset if exists
                unset($_SESSION['first_run']);
                
                //create a new session
                $_SESSION['first_run'] = 1;

                include ("create_db.php");
                $objectDB = new CreateDatabase;
                $objectDB->connect();

            }

            
        } catch(\Exception $e){
            echo "Database error: " . $e->getMessage();
        }
        }
        }

    
?>
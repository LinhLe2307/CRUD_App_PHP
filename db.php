<?php 
    //Connect to MyPhp App    
    class DatabaseConnect {
        private $host = 'db';
        private $dbname = 'crud_app_1234';
        private $user = 'root';
        private $pass = 'lionPass';
        public function connect(){
        try {
            $conn = new PDO('mysql:host=' .$this->host . ';dbname=' . $this->dbname, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;        
        } catch(\Exception $e){
            echo "Database error: " . $e->getMessage();
        }
        
        }
    }
?>
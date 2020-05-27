<?php
    
    class Database{

        //stuff to create connection
        private $user = "root";
        private $password = "";
        public $conn;

        public function createConnection(){
            $this->conn = null;

            //need to be done inside a try/catch block otherwise all database informations will be exposed
            try{
                $this->conn = new PDO('mysql:host=localhost;dbname=nfeasy', $this->user, $this->password);
            }catch(PDOExeption $e){
                echo "SOMETHING WENTS WRONG " . $e.getMessage();
                die();
            }

            return $this->conn;
        }
    }
?>
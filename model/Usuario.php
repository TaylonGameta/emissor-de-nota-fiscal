<?php

    include_once "Token.php";

    /*
    **** this class will handle user stuff
    */

    class Usuario{

        public $email;
        public $password;
        private $conn;

        public function __construct($db){
            $this->conn = $db;
        }

        public function login(){
            $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE email = :email AND password = :password");
            $stmt->execute(array(':email' => $this->email, ':password' => $this->password));

            $rowLength = $stmt->rowCount();

            if($rowLength > 0){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $result['id'];

                $token = new Token();
                $newToken = $token->create($id);
                $message = ['token' => $newToken];
                echo json_encode($message);
                exit();
            }
            
            $message = ['error'=> 'user not found'];
            echo json_encode($message);
            exit();
        }   
    
        public function auth($userToken){
            $part = explode(" ", $userToken);
            $bearer = $part[0];
            $tokenValue = $part[1];

            $token = new Token();
            $valid = $token->verify($tokenValue);
            
            if(!$valid){
                $message = array('error'=> 'user not found');
                echo json_encode($message);
                exit();
            }
        }
    }

?>
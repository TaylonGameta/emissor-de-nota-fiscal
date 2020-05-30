<?php
    /*
    *** this class will take care about emitente
    */

    class Emitente{
        private $conn;
        public $nome;
        public $cnpj;
        public $uf;
        public $inscricao_estadual;

        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            $stmt = $this->conn->prepare("
                INSERT INTO emitente(nome, cnpj, uf, inscricao_estadual)
                VALUES(:nome, :cnpj, :uf, :inscricao_estadual)
            ");

            $stmt->execute(array(
                ':nome' => $this->nome,
                ':cnpj' => $this->cnpj,
                ':uf' => $this->uf,
                ':inscricao_estadual' => $this->inscricao_estadual
            ));

            if($stmt->rowCount() > 0){
                $message = ['success'=> 'emitente created'];
                echo json_encode($message);
                exit();
            }

            $message = ['error'=> 'something went wrong'];
            echo json_encode($message);
            exit();
        }

        public function getAll(){
            $stmt = $this->conn->prepare("SELECT * FROM emitente");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }

         /*
        *** @arg {int} id to get
        */
        public function getById($id){
            $stmt = $this->conn->prepare("SELECT * FROM emitente WHERE id = :id");
            $stmt->execute(array(':id' => $id));
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }

         /*
        *** @arg {int} id to update
        */
        public function update($id){
            $stmt = $this->conn->prepare("
                UPDATE emitente
                SET nome= :nome, cnpj= :cnpj, uf= :uf, inscricao_estadual= :inscricao_estadual
                WHERE id = :id;
            ");

            $stmt->execute(array(
                ':nome' => $this->nome,
                ':cnpj' => $this->cnpj,
                ':uf' => $this->uf,
                ':inscricao_estadual' => $this->inscricao_estadual,
                ':id' => $id
            ));

            if($stmt->rowCount() > 0){
                $message = ['success'=> 'emitente updated'];
                echo json_encode($message);
                exit();
            }

            $message = ['error'=> 'something went wrong'];
            echo json_encode($message);
            exit();
        }

        /*
        *** @arg {int} id to delete
        */
        public function delete($id){
            $stmt = $this->conn->prepare("DELETE FROM emitente WHERE id = :id");
            $stmt->execute(array(':id' => $id));

            if($stmt->rowCount() < 1){
                $message = ['error' => 'something wents wrong'];
                echo json_encode($message);
                exit();
            }

            $message = ['success' => 'deleted successfuly'];
            echo json_encode($message);
            exit();
        }


    }
?>
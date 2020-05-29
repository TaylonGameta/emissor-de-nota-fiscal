<?php
    /*
    *** this class take care about destinario
    */

    class Produto{
        private $conn;
        public $descricao;
        public $valor_unitario;

        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            $stmt = $this->conn->prepare("
                INSERT INTO produto(descricao, valor_unitario)
                VALUES(:descricao, :valor_unitario)
            ");

            $stmt->execute(array(
                ':descricao' => $this->descricao,
                ':valor_unitario' => $this->valor_unitario
            ));

            if($stmt->rowCount() > 0){
                $message = ['success'=> 'product created'];
                echo json_encode($message);
                exit();
            }

            $message = ['error'=> 'something wents wrong'];
            echo json_encode($message);
            exit();
        }
        /*
        *** @arg {int} product id to update
        */

        public function update($id){
            $stmt = $this->conn->prepare("
                UPDATE produto
                SET descricao= :descricao, valor_unitario= :valor_unitario
                WHERE id = :id
            ");

            $stmt->execute(array(':id'=>$id, ':descricao' => $this->descricao, ':valor_unitario'=> $this->valor_unitario));
            
            if($stmt->rowCount() > 0){
                $message = ['success' => 'product updated successfuly'];
                echo json_encode($message);
                exit();
            }

            $message = ['error' => 'something wents wrong'];
            echo json_encode($message);
            exit();
        }

        public function getAll(){
            $stmt = $this->conn->prepare("SELECT * FROM produto");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }

        public function getById($id){
            $stmt = $this->conn->prepare("SELECT * FROM produto WHERE id = :id");
            $stmt->execute(array(':id' => $id));
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }

        public function delete($id){
            $stmt = $this->conn->prepare("DELETE FROM produto WHERE id = :id");
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
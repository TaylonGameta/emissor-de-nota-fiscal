<?php
    
    /*
    *** this class take care about destinario
    */

    class Destinario{

        private $conn;
        public $nome;
        public $cnpj;
        public $endereco;
        public $municipio;
        public $uf;
        public $telefone;
        public $inscricao_estadual;

        //pass the connection in construct
        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            $stmt = $this->conn->prepare("INSERT INTO destinario(nome, cnpj, endereco, municipio, uf, telefone, inscricao_estadual)
            VALUES (:nome, :cnpj, :endereco, :municipio, :uf, :telefone, :inscricao_estadual)");

            $stmt->execute(array(
                ':nome' => $this->nome,
                ':cnpj' => $this->cnpj,
                ':endereco' => $this->endereco,
                ':municipio' => $this->municipio,
                ':uf' => $this->uf,
                ':telefone' => $this->telefone,
                ':inscricao_estadual' => $this->inscricao_estadual
            ));

            if($stmt->rowCount() < 1){
                $message = ['error' => 'something wents wrong'];
                echo json_encode($message);
                exit();
            }

            $message = ['success' => 'added successfuly'];
            echo json_encode($message);
            exit();

        }

        /*
        *** @arg {id} destinario id
        */
        public function update($id){
            $stmt = $this->conn->prepare("
                UPDATE destinario

                SET nome= :nome, cnpj= :cnpj, endereco= :endereco, municipio= :municipio, uf= :uf, telefone= :telefone,
                inscricao_estadual = :inscricao_estadual

                WHERE id = :id
            ");

            $stmt->execute(array(
                ':id' => $id,
                ':nome' => $this->nome,
                ':cnpj' => $this->cnpj,
                ':endereco' => $this->endereco,
                ':municipio' => $this->municipio,
                ':uf' => $this->uf,
                ':telefone' => $this->telefone,
                ':inscricao_estadual' => $this->inscricao_estadual
            ));

            if($stmt->rowCount() < 1){
                $message = ['error' => 'something wents wrong'];
                echo json_encode($message);
                exit();
            }

            $message = ['success' => 'updated successfuly'];
            echo json_encode($message);
            exit();
        }

        /*
        ** @arg {int} the destinario id
        */
        public function getById($id){
            $stmt = $this->conn->prepare("SELECT * FROM destinario WHERE id = :id");
            $stmt->execute(array(':id' => $id));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }


        public function getAll(){
            $stmt = $this->conn->prepare("SELECT * FROM destinario");
            $stmt->execute();
            $data = [];
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                //using that function to get array data easier
                extract($row);
                
                $data[] = array(
                    'nome'=> $nome,
                    'cnpj'=> $cnpj,
                    'endereco' => $endereco,
                    'uf'=> $uf,
                    'telefone'=> $telefone,
                    'inscricao_estadual' => $inscricao_estadual
                );
            }

            echo json_encode($data);
            
        }

        public function delete($id){
            $stmt = $this->conn->prepare("DELETE FROM destinario WHERE id = :id");
            $stmt->execute(array(':id'=> $id));

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
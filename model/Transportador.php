<?php
    /*
    *** this class will handle transportador stuff
    */

    class Transportador{

        private $conn;
        public $nome;
        public $cnpj;
        public $uf;
        public $inscricao_estadual;
        public $placa_do_veiculo;
        public $frete_por_conta;
        public $cod_antt;
        
        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            $stmt = $this->conn->prepare("
                INSERT INTO transportador(nome, cnpj, uf, inscricao_estadual, placa_do_veiculo, frete_por_conta, cod_antt)
                VALUES(:nome, :cnpj, :uf, :inscricao_estadual, :placa_do_veiculo, :frete_por_conta, :cod_antt)
            ");

            $stmt->execute(array(
                ':nome' => $this->nome,
                ':cnpj' => $this->cnpj,
                ':uf' => $this->uf,
                ':inscricao_estadual' => $this->inscricao_estadual,
                ':placa_do_veiculo' => $this->placa_do_veiculo,
                ':frete_por_conta' => $this->frete_por_conta,
                ':cod_antt' => $this->cod_antt
            ));

            if($stmt->rowCount() > 0){
                $message = ['success' => 'transportador added successfuly'];
                echo json_encode($message);
                exit();
            }
            $message = ['error' => 'something went wrong'];
            echo json_encode($message);
            exit();
        }

        public function getAll(){
            $stmt = $this->conn->prepare("SELECT * FROM transportador");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }

        /*
        *** @arg {int} id to find
        */
        public function getById($id){
            $stmt = $this->conn->prepare("SELECT * FROM transportador WHERE id = :id");
            $stmt->execute(array(':id' => $id));
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }

        /*
        *** @arg {int} id to update
        */
        public function update($id){
            $stmt = $this->conn->prepare("
                UPDATE transportador

                SET nome= :nome, cnpj= :cnpj, uf= :uf, inscricao_estadual= :inscricao_estadual, placa_do_veiculo= :placa_do_veiculo,
                frete_por_conta= :frete_por_conta, cod_antt= :cod_antt

                WHERE id = :id
            ");

            $stmt->execute(array(
                ':nome' => $this->nome,
                ':cnpj' => $this->cnpj,
                ':uf' => $this->uf,
                ':inscricao_estadual' => $this->inscricao_estadual,
                ':placa_do_veiculo' => $this->placa_do_veiculo,
                ':frete_por_conta' => $this->frete_por_conta,
                ':cod_antt' => $this->cod_antt,
                ':id' => $id
            ));

            if($stmt->rowCount() > 0){
                $message = ['success' => 'transportador updated successfuly'];
                echo json_encode($message);
                exit();
            }
            $message = ['error' => 'something went wrong'];
            echo json_encode($message);
            exit();

        }

        public function delete($id){
            $stmt = $this->conn->prepare("DELETE FROM transportador WHERE id = :id");
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
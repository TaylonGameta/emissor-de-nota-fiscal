<?php
    
    /*
    *** this class take care about destinario
    */

    class Destinario{

        private $conn;

        //pass the connection in construct
        public function __construct($db){
            $this->conn = $db;
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
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                //using that function to get array data easier
                extract($row);

                $data[] = array(
                    'nome'=> utf8_encode($nome),
                    'cnpj'=> $cnpj,
                    'endereco' => $endereco,
                    'uf'=> $uf,
                    'telefone'=> $telefone,
                    'inscricao_estadual' => $inscricao_estadual
                );
            }
            echo json_encode($data);
            
        }
    }

?>
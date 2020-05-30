<?php
    include_once "../../../config/Database.php";
    include_once "../../../model/Transportador.php";
    include_once "../../../model/Usuario.php";
    include_once "../../../model/Token.php";

    // headers
    header("Content-Type: application/json");

    // database connection
    $database = new Database();
    $conn = $database->createConnection();

    // auth
    $headers = apache_request_headers();
    $token = $headers['Authorization'];

    $usuario = new Usuario($conn);
    $auth = $usuario->auth($token);

    //get values from json request raw
    $data = json_decode(file_get_contents("php://input"));

    /*
    *** creating a transportador class and adding attributes to insert inside database
    */
    $transportador = new Transportador($conn);
    $transportador->nome = $data->nome;
    $transportador->cnpj = $data->cnpj;
    $transportador->uf = $data->uf;
    $transportador->inscricao_estadual = $data->inscricao_estadual;
    $transportador->placa_do_veiculo = $data->placa_do_veiculo;
    $transportador->frete_por_conta = $data->frete_por_conta;
    $transportador->cod_antt = $data->cod_antt;

    $transportador->create();


?>
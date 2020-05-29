<?php
    include_once "../../../config/Database.php";
    include_once "../../../model/Destinario.php";
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
    *** creating a destinario class and adding attributes to update database
    */
    $destinario = new Destinario($conn);
    $destinario->nome = $data->nome;
    $destinario->cnpj = $data->cnpj;
    $destinario->endereco = $data->endereco;
    $destinario->municipio = $data->municipio;
    $destinario->uf = $data->uf;
    $destinario->telefone = $data->telefone;
    $destinario->inscricao_estadual = $data->inscricao_estadual;

    $update = $destinario->update($data->id);


?>
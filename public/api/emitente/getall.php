<?php
    include_once "../../../config/Database.php";
    include_once "../../../model/Emitente.php";
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
    *** creating a emitente class to get all
    */
    $emitente = new Emitente($conn);
    
    $emitente->getAll();


?>
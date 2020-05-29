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


    //resume application if it was properly authenticated
    $destinario = new Destinario($conn);
    $getById = $destinario->getById(4);


?>
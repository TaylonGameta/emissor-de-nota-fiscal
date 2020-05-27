<?php
    include_once "../../../../config/Database.php";
    include_once "../../../../model/Destinario.php";
    include_once "../../../../model/Usuario.php";
    include_once "../../../../model/Token.php";

    // database connection
    $database = new Database();
    $conn = $database->createConnection();

    // auth
    $headers = apache_request_headers();
    $token = $headers['Authorization'];

    $usuario = new Usuario();
    $auth = $usuario->auth($token);

    if(!$auth){
        $message = [
            'msg'=> 'result'
        ];

        echo json_encode($message);
        exit();
    }

    //resume application if it was properly authenticated
    $destinario = new Destinario($conn);
    $getAll = $destinario->getAll();


?>
<?php
    include_once "../../../model/Usuario.php";
    include_once "../../../config/Database.php";


    //headers 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');


    //database connection
    $database = new Database();
    $conn = $database->createConnection();
   
    //get values from json request raw
    $data = json_decode(file_get_contents("php://input"));


    //user stuff
    $usuario = new Usuario($conn);
    $usuario->email = $data->email;
    $usuario->password = $data->password;

    $usuario->login();


?>
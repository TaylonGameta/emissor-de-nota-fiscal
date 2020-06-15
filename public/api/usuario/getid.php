<?php
    include_once "../../../model/Token.php";
    include_once "../../../config/Database.php";


    //headers 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');


    
   
    //get values from json request raw
    $data = json_decode(file_get_contents("php://input"));


    $token = new Token;
    $id = $token->getUserId($data->token);
    echo json_encode($id);

?>
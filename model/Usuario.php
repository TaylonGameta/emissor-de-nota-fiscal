<?php

    include_once "Token.php";

    /*
    **** this class will handle user stuff
    */

    class Usuario{
    
        public function auth($userToken){
            $part = explode(" ", $userToken);
            $bearer = $part[0];
            $tokenValue = $part[1];

            $token = new Token();
            $valid = $token->verify($tokenValue);
            return $valid;
        }
    }

?>
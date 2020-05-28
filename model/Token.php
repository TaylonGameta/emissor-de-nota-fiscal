<?php
    
    /*
    *** this class will create, sign and validate JWT token
    */

    class Token{

        /*
        *** @arg {int} user id
        *** @arg {string} hash algoritm
        */

        private $secretkey = "153ed1a063cc16adf9344c746db5fa3b";

        public function create($id, $alg = 'HS256'){
            $header = [
                'alg' => $alg,
                'typ' => 'JWT'
            ];

            $header = json_encode($header);
            $header = base64_encode($header);

            $payload = [
                'sub' => $id
            ];

            $payload = json_encode($payload);
            $payload = base64_encode($payload);

            $signature = hash_hmac('sha256', "$header.$payload", $this->secretkey, true);
            $signature = base64_encode($signature);

            return "$header.$payload.$signature";
        }

        /*
        *** @arg {string} token provided by create function
        */

        public function verify($token){
            $part = explode(".", $token);
            $header = $part[0];
            $payload = $part[1];
            $signature = $part[2];

            $valid = hash_hmac('sha256', "$header.$payload", $this->secretkey, true);
            $valid = base64_encode($valid);

            if($valid == $signature){
                $payload = base64_decode($payload);
                return json_decode($payload);
            }else{
                return false;
            }

        }
    }


?>
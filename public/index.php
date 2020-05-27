<?php
    include_once "../config/Database.php";
    include_once "../model/Destinario.php";
    include_once "../model/Token.php";

    $token = new Token();
    $valid = $token->verify("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjF9.zTnNBbjbuxbmLGk33VtDxStuCpe6w2wufu8NI3jd4Wc=", "minhasenha");
    var_dump($valid);

?>
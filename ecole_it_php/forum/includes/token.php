<?php 

function token_random_string($len = 25) {
    $str = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    $token = "";

    for ($i = 0; $i < $len; $i++) {
        $token.= $str[rand(0, strlen($str) -1)];
    }
    return $token;
}
$token = token_random_string(25);
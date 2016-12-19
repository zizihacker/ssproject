<?php
function aes_enc($dataToEncrypt, $key)
{
    return base64_encode(openssl_encrypt($dataToEncrypt, "aes-256-cbc", $key, true, str_repeat(chr(0), 16)));
}

function aes_dec($dataToDecrypt, $key)
{
    return openssl_decrypt(base64_decode($dataToDecrypt), "aes-256-cbc", $key, true, str_repeat(chr(0), 16));
}

?>

 


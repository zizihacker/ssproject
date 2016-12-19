<?php
function rsa_enc($dataToEncrypt) {
	$pubKey = @openssl_pkey_get_public(file_get_contents("../key/public_key.pub"));
	$maxlength=117;
	$sealed='';
	while($dataToEncrypt){
	  $input= substr($dataToEncrypt,0,$maxlength);
	  $dataToEncrypt=substr($dataToEncrypt,$maxlength);
	  $ok= @openssl_public_encrypt($input,$encrypted,$pubKey);
	  $sealed.=$encrypted;
	}
    return base64_encode($sealed);
}

function rsa_dec($dataToDecrypt,$priKey) {
	$dataToDecrypt = base64_decode($dataToDecrypt);
	$maxlength=128;
	$sealed='';
	while($dataToDecrypt){
	  $input= substr($dataToDecrypt,0,$maxlength);
	  $dataToDecrypt=substr($dataToDecrypt,$maxlength);
	  $ok= @openssl_private_decrypt($input,$out,$priKey);
	  $sealed.=$out;
	}
    return $sealed;
}
?>

 


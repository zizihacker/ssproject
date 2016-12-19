<?php
session_start();
require_once "./include/aes_func.php";
require_once "./include/rsa_func.php";

$private_tmp = $_FILES['private_key']['tmp_name'];
$private_key = @file_get_contents($private_tmp);
$private_pass = hash('sha256',$_POST['password']);

$_SESSION['private_key'] = $private_key;
$_SESSION['private_pass'] = $private_pass;

$file = @fopen("../key/key_check","r");
$enc_check = fread($file, filesize('../key/key_check'));
fclose($file);

$rsa_prikey = aes_dec($_SESSION['private_key'],$_SESSION['private_pass']);
$dec_check = rsa_dec($enc_check,@openssl_pkey_get_private($rsa_prikey));

if($dec_check)
{
	echo "<script>alert('Login Success');</script>";
	echo "<script>location.href='./'</script>";
	exit();
}
else{
	echo "<script>alert('Login Fail...');</script>";
	echo "<script>history.back();</script>";
	exit();
}
?>

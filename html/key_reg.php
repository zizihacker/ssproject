<?php
ob_start();
session_start();
require_once "./include/aes_func.php";
require_once "./include/rsa_func.php";


$key_check = "True";

$public_tmp = $_FILES['public_key']['tmp_name'];
$private_tmp = $_FILES['private_key']['tmp_name'];

$private_key = file_get_contents($private_tmp);
$public_key = file_get_contents($public_tmp);
$private_pass = hash('sha256',$_POST['password']);

$enc_result = aes_enc($private_key,$private_pass);

if(@is_dir("../key")!=True){
	@mkdir("../key");
}

$file = fopen("../key/public_key.pub","w");
fwrite($file, $public_key);
fclose($file);

$file = fopen("../key/key_check","w");
fwrite($file, rsa_enc($key_check));
fclose($file);

$_SESSION['register']="Y";

header("Content-Disposition: attachment; filename=private_key.enc"); // File name's encoding type change
header("Content-type: application/x-msdownload");
header("Content-Transfer-Encoding: g-zip"); 
header("Pragma: no-cache"); 
header("Content-Length: ".strlen($enc_result));
ob_end_clean();

echo $enc_result;
?>

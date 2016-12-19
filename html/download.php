<?php
session_start();
ob_start();

require_once "./include/mail/PHPMailerAutoload.php";
require_once './include/mailing.php';
require_once './include/dbconn.php';
require_once './include/rsa_func.php';
require_once './include/aes_func.php';

$seed = addslashes($_GET['seed']);

$query1 = "select * from user_rec where r_seed='".$seed."'";
$result1 = mysqli_query($link,$query1);
$data1 = mysqli_fetch_array($result1);

$query2 = "select * from rec_file where f_seed='".$seed."'";
$result2 = mysqli_query($link,$query2);
$data2 = mysqli_fetch_array($result2);
if(!$data2){
	echo "<script>alert('There is not Recruit File');location.href='./';</script>";
	exit();
}

$query3 = "update user_rec set r_down=".($data1['r_down']+1)." where r_seed='".$seed."'";
mysqli_query($link,$query3);

$rsa_prikey = aes_dec($_SESSION['private_key'],$_SESSION['private_pass']);
$result = rsa_dec($data2['f_file'],openssl_pkey_get_private($rsa_prikey));


$mail_info = "<!DOCTYPE html>

	    <meta http-equiv=\"Content-Type\" content=\"IE=edge; charset=utf-8\" />

		<img src=\"http://imageshack.com/a/img923/994/3lqbTL.png\" hight=\"80\" width=\"720\">

		</br>
    


        <h2>SS 채용서류 보안 관리 솔루션 이용안내 메일입니다.</h2>


        <span style=\"font-size:15px;\">안녕하세요 귀하의 채용서류가 열람되었음을 알려드립니다.<br><br> SS솔루션의 관리자로부터 채용서류가 이용 되었습니다.<br></span><br><br>
	<table border=0 cellspacing=\"0\"><tr><td colspan=\"2\"><span style=\"font-size:15px;\"><b>[ 이용 정보 ]</b></span></td></tr>";

$info="<tr><td><span style=\"font-size:15px;\"><b>일시</b></span>&nbsp;</td><td>
        <span style=\"color: gray;font-size:15px;\">".date('Y-m-d H:i:s',time())."</span></td></tr><tr><td>
        <span style=\"font-size:15px;\"><b>상태</b></span></td><td>
        <span style=\"color: gray;font-size:15px;\">채용서류 이용 ".($data1['r_down']+1)."회</span></td></tr></table><br><br>
      <img src=\"http://imageshack.com/a/img921/2563/8kEE7x.png\"  hight=\"100\" width=\"720\"></img>";


	sendMail($data1['r_user'],"[SecuritySquad] 이력서 열람 알림메일입니다.",$mail_info.$info);
	header("Content-Disposition: attachment; filename=".iconv("UTF-8","cp949//IGNORE", $data2['f_name'])); // File name's encoding type change
	header("Content-type: application/x-msdownload");
	header("Content-Transfer-Encoding: binary"); 
	header("Pragma: no-cache"); 
	header("Content-Length: ".strlen($result));
ob_end_clean();
	echo $result;

?>

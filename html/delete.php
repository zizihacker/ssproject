<?php
require_once "./include/dbconn.php";
require_once "./include/config.php";
require_once "./include/rsa_func.php";
require_once "./include/mail/PHPMailerAutoload.php";
require_once './include/mailing.php';

if(isset($_GET['seed'])){

	$query = "select * from user_rec where r_seed='".$_GET['seed']."'";
	$result = mysqli_query($link,$query);
	$data = mysqli_fetch_array($result);
	if(count($data)<1){
		echo "<script>alert('파기에 실패하였습니다.');location.href='./?p=recruit';</script>";
		exit();
	}

	$del_no = addslashes($_GET['seed']);
	$query = "delete from user_rec where r_seed = '".$_GET['seed']."'";
	mysqli_query($link,$query);
	$query = "delete from rec_file where f_seed = '".$_GET['seed']."'";
	mysqli_query($link,$query);


	$info="<html>
	<head><!DOCTYPE html>

	    <meta http-equiv=\"Content-Type\" content=\"IE=edge; charset=utf-8\" />

		<img src=\"http://imageshack.com/a/img923/994/3lqbTL.png\" hight=\"80\" width=\"720\">

		</br>
    


        <h2>SS 채용서류 보안 관리 솔루션 이용안내 메일입니다.</h2>


        <span style=\"font-size:15px;\">안녕하세요 귀하위 채용서류가 파기되었음을 알려드립니다.<br><br> SS솔루션의 관리자로부터 채용서류가 파기 되었습니다.<br></span><br><br>
	<table border=0 cellspacing=\"0\"><tr><td colspan=\"2\"><span style=\"font-size:15px;\"><b>[ 파기 정보 ]</b></span></td></tr>

<tr><td><span style=\"font-size:15px;\"><b>일시</b></span>&nbsp;</td><td>
        <span style=\"color: gray;font-size:15px;\">".date('Y-m-d H:i:s',time())."</span></td></tr><tr><td>
        <span style=\"font-size:15px;\"><b>상태</b></span></td><td>
        <span style=\"color: gray;font-size:15px;\">수동 파기</span></td></tr></table><br><br>
      <img src=\"http://imageshack.com/a/img921/2563/8kEE7x.png\"  hight=\"100\" width=\"720\"></img>";


	sendMail($data['r_user'],"[SecuritySquad] 이력서 파기 알림메일입니다.",$info);
	echo "<script>alert('파기되었습니다.');location.href='./?p=recruit';</script>";
	exit();
}
else{
	echo "<script>alert('파기에 실패하였습니다.');location.href='./?p=recruit';</script>";
	exit();
}

?>

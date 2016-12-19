<?php

include "config.php";

function sendMail($MAILTO, $SUBJECT, $CONTENT){
	global $email_id, $email_pw, $email_name;

	$mail = new PHPMailer();
	$body = $CONTENT;

	$mail->IsSMTP(); 
	$mail->Host   = "www.ssproject.xyz";

	$mail->CharSet= "utf-8";
	$mail->SMTPAuth   = true; 
	$mail->SMTPSecure = "ssl"; 
	$mail->Host   = "smtp.gmail.com"; 
	$mail->Port   = 465;  
	$mail->Username   = $email_id; 
	$mail->Password   = $email_pw; 

	$mail->SetFrom($email_id, $email_name);
	$mail->AddReplyTo($email_id, $email_name);
	$mail->isHTML(true);
	$mail->Subject= $SUBJECT;
	$mail->MsgHTML($body);

	$address = $MAILTO;
	$mail->AddAddress($address, "");

	$mail->Send();
}

?>

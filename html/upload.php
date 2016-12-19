<?php
session_start();
require_once "./include/dbconn.php";
require_once "./include/rsa_func.php";
require_once "./include/aes_func.php";
require_once "./include/func.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitle</title>
</head>

<body>


<?php



if(isset($_GET['type'])){
	$info_type = $_GET['type'];
	if($info_type == "F"){
		echo "File type<br><br>";
		$time = time();
		$file_name = $_FILES['rec']['name'];
		$file_tmp = $_FILES['rec']['tmp_name'];
		$file_size = $_FILES['rec']['size'];
		$user_email = addslashes($_POST['email']);
		$user_seed = rand_str(); // 10 char random string generation;

		if(is_uploaded_file($file_tmp)){
			//file upload check
			$fp = fopen($file_tmp,'r');
			$file_contents = fread($fp,$file_size);
			//user's recruit information is uploaded to database
			$query = "insert into user_rec(r_user, r_file, r_date, r_seed, r_name) values('".$user_email."','S',".$time.",'".$user_seed."','".$file_name."');";
			mysqli_query($link,$query);
			//user information load in database
			$query = "select * from user_rec where r_user='".$user_email."' and r_date = ".$time." and r_seed='".$user_seed."'";
			$result = mysqli_query($link,$query);
			$data = mysqli_fetch_array($result);
			//user's recruit file is uploaded to database
			$query = "insert into rec_file(f_rec, f_type, f_file, f_size ,f_date, f_seed, f_hash, f_name) values('".$data[0]."','S','".rsa_enc($file_contents)."',".$file_size.",".$time.",'".$user_seed."','".md5($file_contents)."','".$file_name."');";
			mysqli_query($link,$query);
			//integriry checking
			$query = "select f_file,f_hash from rec_file where f_seed='".$user_seed."'";
			$result = mysqli_query($link,$query);
			$data = mysqli_fetch_array($result);
			//RSA Check
			$rsa_prikey = aes_dec($_SESSION['private_key'],$_SESSION['private_pass']);
			$dec_data = rsa_dec($data['f_file'],openssl_pkey_get_private($rsa_prikey));

			if(md5($dec_data) != $data['f_hash']){
				//File expiring
				echo "File Integrity Error!!!<br>";
				$query = "delete from rec_file where f_seed='".$user_seed."'";
				mysqli_query($link,$query);
				$query = "delete from user_rec where f_seed='".$user_seed."'";
				mysqli_query($link,$query);
				echo "File was deleted... <br>";
			}
			else{
				echo "<script>alert(\"File Upload Success!!\");location.href='./?p=recruit';</script>";
				exit();
			}
		}
	}
	else{
		echo "File Type Error!!!";
		exit();
	}
}

?>
</body>
</html>

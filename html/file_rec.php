<?php
session_start();

require_once "./include/dbconn.php";
require_once "./include/rsa_func.php";
require_once "./include/aes_func.php";
require_once "./include/func.php";
require_once "./include/excel_reader2.php";
require_once "./include/pclzip.lib.php";

$listfile_name = $_FILES['rec_list']['name'];
$listfile_tmp = $_FILES['rec_list']['tmp_name'];
$listfile_size = $_FILES['rec_list']['size'];

$recfile_name = $_FILES['rec_file']['name'];
$recfile_tmp = $_FILES['rec_file']['tmp_name'];
$recfile_size = $_FILES['rec_file']['size'];

$excel_data = new Spreadsheet_Excel_Reader($listfile_tmp);
$excel_data->setOutputEncoding('CP949');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<?php
$user_length = count($excel_data->sheets[0]['cells']);

for($i=2;$i<=$user_length;$i++){
	$user_email = $excel_data->sheets[0]['cells'][$i][1];
	$file_name = $excel_data->sheets[0]['cells'][$i][2];
	echo $user_email." - ".$file_name."<br>";

	$zipfile = new PclZip($recfile_tmp);
	$zip_list = $zipfile->listContent();

	$extract = $zipfile->extract(PCLZIP_OPT_PATH, './file_tmp/');

	$file_length = count($zip_list);
	for($j=0;$j<=$file_length;$j++){
		$zip_list[$j]['filename'] = @iconv("EUC-KR", "UTF-8", $zip_list[$j]['filename']);
		if($file_name == $zip_list[$j]['filename']){
			$time = time();
			$user_seed = rand_str();
			$file_size = $zip_list[$j]['size'];

			$fp = fopen("./file_tmp/".$file_name,'r');
			if(!$fp){
				echo "File Open Error!!";
				exit();
			}
			$file_contents = fread($fp,$file_size);
			//user's recruit information is uploaded to database
			$query = "insert into user_rec(r_user, r_file, r_date, r_seed, r_name) values('".$user_email."','D',".$time.",'".$user_seed."','".$file_name."');";
			mysqli_query($link,$query);
			//user information load in database
			$query = "select * from user_rec where r_user='".$user_email."' and r_date = ".$time." and r_seed='".$user_seed."'";
			$result = mysqli_query($link,$query);
			$data = mysqli_fetch_array($result);
			//user's recruit file is uploaded to database
			$query = "insert into rec_file(f_rec, f_type, f_file, f_size ,f_date, f_seed, f_hash, f_name) values('".$data[0]."','D','".rsa_enc($file_contents)."',".$file_size.",".$time.",'".$user_seed."','".md5($file_contents)."','".$file_name."');";
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
				echo "File Upload Success!!<br>";
			}
		}
		else continue;
	}
}
@exec("rm ./file_tmp/*");
echo "<script>alert(\"Done!\");location.href='./?p=recruit';</script>";
exit();

?>
</body>
</html>

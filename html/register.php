<?php
@session_start();
if(isset($_SESSION['register']) and $_SESSION['register']=="Y" and file_exists("../key/public_key.pub")==True){
	echo "<script>location.href='./';</script>";
}
?>

<script>
function done(){

	var form = document.getElementById("key-form");
	form.submit();
	
	return alert('Done! you need refresh F5');

}

</script>

<!DOCTYPE html>
<html lang="kr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-ico" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SecuritySquad Registration</title>

  <script src="./js/bootstrap.min.js"></script>
  <link href="./css/bootstrap.min.css" rel="stylesheet"/>
  <link href="./css/signin.css" rel="stylesheet"/>
  <script src="./js/jquery.min.js"></script>
  </head>

  <body style="background-color:#eee">
<br><br><br><br><br><br><br>
<div align="center">
    <div class="container">
      <form action="./key_reg.php" method="post" enctype="multipart/form-data" class="form-signin" id="key-form" onsubmit="return done();";>
	<h2 class="form-signin-heading"><img src="./img/logo_1.png" width="50">Registration</h2><br>
        <input type="password" size="25" name="password" class="form-control" placeholder="Private Password" required autofocus>
	<div class="input-group">
	  <span class="input-group-btn">
	    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Private Key</span>
	    <input name="private_key" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" accept=".pri" style="display: none;" type="file">
	  </span>
	  <span class="form-control"></span>
	</div>
	<div class="input-group">
	  <span class="input-group-btn">
	    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Public Key</span>
	    <input name="public_key" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" accept=".pub" style="display: none;" type="file">
	  </span>
	  <span class="form-control"></span>
	</div>
	<br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
      </form>
    </div>
</div>
  </body>
</html>

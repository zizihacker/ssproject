<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="kr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-ico" />

    <title>SecuritySquad Login</title>

  <script src="./js/bootstrap.min.js"></script>
  <link href="./css/bootstrap.min.css" rel="stylesheet"/>
  <link href="./css/signin.css" rel="stylesheet"/>
  <script src="./js/jquery.min.js"></script>
  </head>

  <body style="background-color:#eee">
<br><br><br><br><br><br><br>
<div align="center">
    <div class="container">
      <form action="./user_auth.php" method="post" enctype="multipart/form-data" class="form-signin">
	<h2 class="form-signin-heading"><img src="./img/logo_1.png" width="50"> Login Plz</h2><br>
	<div class="input-group">
	  <span class="input-group-btn">
	    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Private Key</span>
	    <input name="private_key" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" accept=".enc" style="display: none;" type="file">
	  </span>
	  <span class="form-control"></span>
	</div>
	<br>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" size="25" name="password" class="form-control" placeholder="password" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
</div>
  </body>
</html>

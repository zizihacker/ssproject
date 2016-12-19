<?php
session_start();
include "./include/dbconn.php";
include "./include/config.php";

if(file_exists("../key/public_key.pub")==False){
	echo "<script>location.href='./register.php';</script>";
	exit();
}

if(!isset($_SESSION['private_key'])){
	echo "<script>location.href='./login.php'</script>";
	exit();
}
?>

<!DOCTYPE html>
<html lang="kr">
  <head>
    <meta http-equiv="Content-Type" content="IE=edge; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-ico" />

    <title>Security Squad</title>

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/ie-emulation-modes-warning.js"></script>
    <link href="./css/carousel.css" rel="stylesheet">
  </head>

  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand"><img src="./img/logo_1.png" width="40"></a><a class="navbar-brand" href="./">SSproject</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-left">
<?php
if(!isset($_GET['p'])) echo '<li class="active"><a href="./">Home</a></li>';
else echo '<li><a href="./">Home</a></li>';
?>
<?php
if(isset($_GET['p']) && $_GET['p']=="about") echo '<li class="active"><a href="./?p=about">About</a></li>';
else echo '<li><a href="./?p=about">About</a></li>';
?>
<?php
if(isset($_GET['p']) && $_GET['p']=="recruit") echo '<li class="active"><a href="./?p=recruit">Recruit</a></li>';
else echo '<li><a href="./?p=recruit">Recruit</a></li>';
?>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Upload<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
<?php
if(isset($_GET['p']) && $_GET['p']=="single_upload") echo '<li class="active"><a href="./?p=single_upload">Upload(Single)</a></li>';
else echo '<li><a href="./?p=single_upload">Upload(Single)</a></li>';
?>
<?php
if(isset($_GET['p']) && $_GET['p']=="multi_upload") echo '<li class="active"><a href="./?p=multi_upload">Upload(Multi)</a></li>';
else echo '<li><a href="./?p=multi_upload">Upload(Multi)</a></li>';
?>
                  </ul>
                </li>
              </ul>
<ul class="nav navbar-nav navbar-right">
<il>
<a href="./logout.php" class="btn btn-secondary btn-lg">
<span class="glyphicon glpyicon-log-out"></span>Log out</a>
</il>
</ul>
            </div>
          </div>
        </nav>

      </div>
    </div>

<?php

if(!isset($_GET['p'])) include "./home.php";
else if($_GET['p']=="about") include "./about.php";
else if($_GET['p']=="recruit") include "./list.php";
else if($_GET['p']=="single_upload") include "./single_upload.php";
else if($_GET['p']=="multi_upload") include "./multi_upload.php";
else if($_GET['p']=="del") include "./delete.php";
else if($_GET['p']=="404") include "./404.php";
else{
	echo "<script>location.href='./?p=404';</script>";
	exit();
}

?>
    <div class="container marketing">
      <hr class="featurette-divider">

      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
<p>본원 | 서울시 구로구 디지털로 34길 43 코오롱싸이언스밸리 1차 4층&nbsp; /&nbsp; 대표전화 : 02-869-8301&nbsp; /&nbsp; FAX : 02-869-6052
<br>센터 | 서울시 강남구 테헤란로 4길 14 미림타워 3층&nbsp; /&nbsp; Tel : 02-869-8301(#9821) &nbsp;/&nbsp; FAX : 02-565-6052&nbsp; /&nbsp; E-Mail : bob@kitri.re.kr, ssprojecta@gmail.com

<br><br><b><font color="#808080">COPYRIGHT © 2016 BEST OF THE BEST 5th Security Squad ALL RIGHTS RESERVED.</font></b></p>
      </footer>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>


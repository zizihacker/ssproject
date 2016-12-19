<script type="text/javascript">
 
function expire(seed){
 var message = "정말 파기하시겠습니까?";
 var result = confirm(message);
 
 if(result==true){
 location.href="./?p=del&seed="+seed;
 }
}
 
</script>

<?php
session_start();
include "./include/dbconn.php";
include "./include/config.php";
include "./include/rsa_func.php";

if(!isset($_SESSION['private_key'])){
	echo "<script>location.href='./login.php'</script>";
	exit();
}
?>

<style>
#back{
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
background-size: cover;



  height:500px; background-image:url(./img/back.png);
}
</style>
    <div id="back">

    <div class="container marketing">

<br><br><br><br>
<br />
<br />
<div class="table-responsive">
<h2 class="sub-header"><img src="./img/rec.png" width="250"></h2>
<table border="0" cellspacing="0" class="table">
<thead><tr><td width="50" bgcolor="#fffff3"><div align="center"><b><font color="#303030"><?=$table1?></font></b></div></td>
<td width="300" bgcolor="#fffff3"><div align="center"><b><font color="#303030"><?=$table2?></font></b></div></td>
<td width="300" bgcolor="#fffff3"><div align="center"><b><font color="#303030"><?=$table3?></font></b></div></td>
<td width="50" bgcolor="#fffff3"><div align="center"><b><font color="#303030"><?=$table4?></font></b></div></td>
<td width="150" bgcolor="#fffff3"><div align="center"><b><font color="#303030"><?=$table5?></font></b></div></td>
<td width="50" bgcolor="#fffff3"><div align="center"><b><font color="#303030"><?=$table6?></font></b></div></td>
<td width="50" bgcolor="#fffff3"><div align="center"><b><font color="#303030"><?=$table7?></font></b></div></td></tr></thead>
<tbody>
<?php

if(!isset($_GET['c']) or is_numeric($_GET['c'])!=True){
	$limit = 0;
}
else{
	$limit = $_GET['c']-1;
}

if(isset($_GET['user'])){
	$email = addslashes($_GET['user']);
	$query = "select * from user_rec where r_user like '%".$email."%' limit ".($limit*15).",15";
}
else{
	$query = "select * from user_rec limit ".($limit*15).",15";
}

$result = mysqli_query($link,$query);

$row_num = mysqli_num_rows($result);
$i=($limit*15)+1;
if($row_num!=0){
	while($data = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td><b><div align=\"center\">".$i."</div></b></td>";
		echo "<td><b><div align=\"center\"><a href=\"./download.php?seed=".$data['r_seed']."\">".htmlspecialchars($data['r_name'])."</a></b></div></td>";
		echo "<td><b><div align=\"center\">".$data['r_user']."</div></b></td>";
		echo "<td><b><div align=\"center\">".$data['r_file']."</div></b></td>";
		echo "<td><b><div align=\"center\">".date('Y-m-d H:i:s',$data['r_date'])."</div></b></td>";
		echo "<td><b><div align=\"center\">".$data['r_down']."</div></b></td>";
		echo "<td><b><div align=\"center\"><a href='javascript:expire(\"".$data['r_seed']."\")'>X</a></div></b></td>";
		echo "</tr>";
		$i=$i+1;
	}
	echo "</table>";
}
else{
	echo "</table>";
	echo "<h1>No Data</h1>";
}
?>
</tbody>
</table>
</div>


<div align="center">
  <ul class="pagination pagination-sm">
<?php
if(!isset($_GET['c']) or $_GET['c']<=1 and $row_num==15){
	$page = 2;
	if(isset($_GET['user'])){
		$user = addslashes($_GET['user']);
		echo "<li><a href=\"./?p=recruit&c=".$page."&user=".$user."\">Next</a></li>";
	}
	else{
		echo "<li><a href=\"./?p=recruit&c=".$page."\">Next</a></li>";
	}
}
else if($row_num==15){
	$page = $_GET['c'];
	if(isset($_GET['user'])){
		$user = addslashes($_GET['user']);
		echo "<li><a href=\"./?p=recruit&c=".($page-1)."&user=".$user."\">Prev</a></li>";
		echo "<li><a href=\"./?p=recruit&c=".($page+1)."&user=".$user."\">Next</a></li>";
	}
	else{
		echo "<li><a href=\"./?p=recruit&c=".($page-1)."\">Prev</a></li>";
		echo "<li><a href=\"./?p=recruit&c=".($page+1)."\">Next</a></li>";
	}
}
else if(isset($_GET['c']) and $_GET['c']>1){
	$page = $_GET['c'];
	if(isset($_GET['user'])){
		$user = addslashes($_GET['user']);
		echo "<li><a href=\"./?p=recruit&c=".($page-1)."&user=".$user."\">Prev</a></li>";
	}
	else{
		echo "<li><a href=\"./?p=recruit&c=".($page-1)."\">Prev</a></li>";
	}
}
?>
  </ul>
</div>

<div class="container" align="center">
            <form class="form-inline global-search" role="form" action="./" method="GET">
        <div class="form-group">
        		<b>User E-mail</b> &nbsp;&nbsp;<input type="text" size="40" name="user" class="form-control" placeholder="Search here">
			<input type="hidden" name="p" value="recruit" />
        </div>
        <button type="submit" id="quick-search" class="btn btn-custom"><span class="glyphicon glyphicon-search custom-glyph-color"></span></button>
      </form>
</div>


</div>

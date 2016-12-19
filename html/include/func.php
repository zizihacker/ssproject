<?php

function rand_str()
{
	$characters  = "0123456789";
	$characters .= "abcdefghijklmnopqrstuvwxyz";
	$characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	
	$gen_str = "";
	
	$number = 10;
	while ($number--)
	{
		$gen_str .= $characters[mt_rand(0, strlen($characters)-1)];
	}
	
	return user_seed_gen($gen_str);
}

function user_seed_gen($gen_str)
{
	global $link;

	$query = "select count(r_seed) from user_rec where r_seed='".$gen_str."'";
	$result = mysqli_query($link,$query);
	$data = mysqli_fetch_array($result);
	
	if($data[0]!=0){
		rend_str();
	}
	else{
		return $gen_str;
	}
}

?>

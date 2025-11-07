<?php 
	session_start();
	require "get_user_no.php";
	require "dbcon_open.php"; 
	$cnt=0;
	do 
	{
		$text = get_rand_id(5);
		
		$qr = mysqli_query($link,"SELECT * FROM $RFR_FRND_TBL_NAME WHERE reg_id = '$text'")or die(mysqli_error($link));
		
		$num = mysqli_num_rows($qr);
		if($num == 0)
		{
			$_SESSION["vercode_raf"] = $text;
			$cnt++;
		}
	}
	while(!($cnt == 1));
?>
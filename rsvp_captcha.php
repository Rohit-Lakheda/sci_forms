<?php 
	 
	session_start(); 
	require "dbcon_open.php"; 
	require "get_user_no.php";
	$i = 0; 
	
	do 
	{
		$text = get_rand_id(5);
		$_SESSION["vercode_rsvp"] = $text; 	
		
		$chq_qr = mysqli_query($link,"SELECT * FROM $RSVP_COMP_REG_TBL_NAME WHERE reg_id = '$text'")or die(mysqli_error($link));
		$chq_no = mysqli_num_rows($chq_qr); 
		if($chq_no < 1)
		{
			$i++;
		}
		else
		{
			continue;
		}
	}
	while(!($i == 1));
?>
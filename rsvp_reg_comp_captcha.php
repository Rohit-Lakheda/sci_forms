<?php 
	 
	session_start();  
	require "dbcon_open.php"; 
	require "get_user_no.php";
	$i = 0; 
	
	do 
	{
		$text = get_rand_id(5);
		$_SESSION["vercode_rsvp_reg"] = $text; 		
		$chq_qr = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_REG_DEMO WHERE reg_id = '$text'")or die(mysqli_error($link));
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
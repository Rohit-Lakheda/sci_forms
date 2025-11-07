<?php
 session_start();
	require "dbcon_open.php";  
	require "get_user_no.php";
	$i = 0;
	$j = 0; 
	
	do
	{
		$text = get_rand_id(6);
		$_SESSION["vercode_ex"] = $text; 
				
		$chq_qr_demo = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_DEMO_PHASE_2." WHERE reg_id = '$text'")or die(mysqli_error($link));
		$chq_no_demo = mysqli_num_rows($chq_qr_demo); 
		
		//$chq_qr = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE reg_id = '$text'")or die(mysqli_error($link));
		//$chq_no = mysqli_num_rows($chq_qr); 
		
		if( ($chq_no_demo > 0) )
		{
			$i++;
			$j++;
			continue;
		}
		else
		{
			$i = 0;
			$j = 0; 
		}
	}while( ($i != 0) || ($j != 0) );
?>
         
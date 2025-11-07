<?php
 session_start();
	require "dbcon_open.php";  
	require "get_user_no.php";
	$i = 0;
	$j = 0; 
	
	do
	{
		$text = get_rand_id(6);
		$_SESSION["vercode_spkr_reg"] = $text; 
				
		$chq_qr_demo = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_SKILL_SPKR_DATA." WHERE reg_id = '$text'")or die(mysqli_error($link));
		$chq_no_demo = mysqli_num_rows($chq_qr_demo); 
		
		if(  ($chq_no_demo > 0) )
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
         
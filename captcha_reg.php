<?php

 session_start();

 // Check if this is an AJAX request for refresh
	if(isset($_GET['action']) && $_GET['action'] == 'refresh') {
		header('Content-Type: application/json');
		
		// Generate simple random captcha for AJAX refresh (more reliable)
		$_SESSION["vercode_reg"] = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5));
		
		echo json_encode([
			'success' => true,
			'captcha' => $_SESSION["vercode_reg"]
		]);
		
		exit();
	}

	// Original logic for initial page load

	require "dbcon_open.php";  

	require "get_user_no.php";

	$i = 0;

	$j = 0; 

	

	do

	{

		$text = get_rand_id(6);

		$_SESSION["vercode_reg"] = $text; 

				

		$chq_qr_demo = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$text'")or die(mysqli_error($link));

		$chq_no_demo = mysqli_num_rows($chq_qr_demo); 

		

		$chq_qr = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE reg_id = '$text'")or die(mysqli_error($link));

		$chq_no = mysqli_num_rows($chq_qr); 

		

		if( ($chq_no > 0) || ($chq_no_demo > 0) )

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

         
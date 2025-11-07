<?php   

	session_start(); 

	// session_destroy();

	 

	// session_start();   


	 // Check if this is an AJAX request for refresh
	if(isset($_GET['action']) && $_GET['action'] == 'refresh') {
		header('Content-Type: application/json');
		
		// Generate simple random captcha for AJAX refresh (more reliable)
		$_SESSION["vercode_ex"] = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5));
		
		echo json_encode([
			'success' => true,
			'captcha' => $_SESSION["vercode_ex"]
		]);
		
		exit();
	}

	// Original logic for initial page load

	require "dbcon_open.php";   

	require "get_user_no.php";

	$i = 0;  

	do 

	{

		$text = get_rand_id(5);

		$_SESSION["vercode_ex"] = $text; 		

		$chq_qr = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO WHERE reg_id = '$text'")or die(mysqli_error($link));

		$chq_no = mysqli_num_rows($chq_qr);

		$chq_qr1 = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL WHERE reg_id = '$text'")or die(mysqli_error($link));

		$chq_no1 = mysqli_num_rows($chq_qr1);

		if($chq_no < 1 && $chq_no1 < 1)

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
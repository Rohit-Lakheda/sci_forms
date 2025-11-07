<?php 

	session_start();

	// Check if this is an AJAX request for refresh
	if(isset($_GET['action']) && $_GET['action'] == 'refresh') {
		header('Content-Type: application/json');
		
		// Generate simple random captcha for AJAX refresh (more reliable)
		$_SESSION["vercode_enq"] = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5));
		
		echo json_encode([
			'success' => true,
			'captcha' => $_SESSION["vercode_enq"]
		]);
		
		exit();
	}

	// Original logic for initial page load
	require "get_user_no.php";
	require "dbcon_open.php";

	$cnt=0;

	do 
	{
		$text = get_rand_id(5);

		$qr = mysqli_query($link,"SELECT * FROM $ENQUIRY_TBL_NAME WHERE reg_id = '$text'")or die(mysqli_error($link));

		$num = mysqli_num_rows($qr);

		if($num == 0)
		{
			$_SESSION["vercode_enq"] = $text;
			$cnt++;
		}
	}
	while(!($cnt == 1));

?>
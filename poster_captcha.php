<?php  
	session_start();
	require "get_user_no.php";
	require "dbcon_open.php"; 
	$cnt=0;
	do 
	{
		$text = get_rand_id(5);
		$qr = mysqli_query($link,"SELECT * FROM $PSTR_TBL_NAME_DEMO WHERE reg_id = '$text'")or die(mysqli_error($link));
		$num = mysqli_num_rows($qr);
		if($num == 0)
		{
			$_SESSION["vercode_pstr"] = $text;
			$cnt++;
		}
	}
	while(!($cnt == 1));
?> 
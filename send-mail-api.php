<?php

	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	exit;
	//$recipients = array('test.interlinks@gmail.com');//,'', 'sagar.patil@interlinks.in');
	//$recipients = array('sagar.patil@interlinks.in');//,'', '');
	//echo "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " LIMIT " . ($_GET['t'] * 80). ", 80";exit;
	$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " LIMIT " . ($_GET['t'] * 80). ", 80");
			
	while($qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qry_email_chk)) {

		include "reg_inx_emailer.php";
		echo $mail_interlinx_str;//exit;
		//break;
		$recipients = array($qr_gt_user_inx_login_data_ans['pri_email'], '', 'test.interlinks@gmail.com');
		//$recipients = array($qr_gt_user_inx_login_data_ans['pri_email']);
		//$recipients = array('sagarpatil2112@gmail.com', 'vivek.patil@mmactiv.com');
		elastic_mail("Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " - InterlinX", $mail_interlinx_str, $recipients);
		//exit;
	}
	
	
	exit;
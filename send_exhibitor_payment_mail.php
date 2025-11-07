<?php
exit;
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	$id = $_GET['id'];
	$qr_gt_user_data_id1      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE tin_no = '$id'");
	$res = mysqli_fetch_assoc($qr_gt_user_data_id1);
	
	$OrderId = $res['pg_paymentid'];
	$tracking_id = $res['pg_trackid'];
	$bank_ref_no = $res['pg_tranid'];
	$order_status = 'Success';
	$payment_mode = 'Bank Transfer';
	$bank_ref_no = $res['pg_tranid'];
	$currency = "INR ";
	$Amount = $res['total_amt_received'];
	$recipients = array('ambika.kiran@mmactiv.com', '', 'chandrachood.as@mmactiv.com', '', '', '','test.interlinks@gmail.com','', $EVENT_ENQUIRY_EMAIL, '', 'accounts@mmactiv.com','', $res['cp_email'], '', 'vivek.patil@mmactiv.com');
	
	//$recipients = array('', 'test.interlinks@gmail.com','', 'sagarpatil2112@gmail.com');
	require "emailer_pg_response.php";
	require "emailer_exhibitor_payment.php";
	//echo $mail_body;exit;
	$Subject     = "Thank you for Making payment for Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR;
			   
	elastic_mail($Subject, $mail_body, $recipients);
	//echo $mail_body;exit;
	//exit;
	
	
?>
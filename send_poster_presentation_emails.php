<?php
exit;
require("includes/form_constants_both.php");
require "dbcon_open.php";
	$qr_gt_user_data_id1      = mysqli_query($link,"SELECT * FROM " . $PSTR_TBL_NAME );
	while($qr_gt_user_data_ans_row1 = mysqli_fetch_assoc($qr_gt_user_data_id1)) {
		
		//$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $PSTR_TBL_NAME . " WHERE reg_id = '$reg_id'");
		$res = $qr_gt_user_data_ans_row1;// = mysqli_fetch_assoc($qr_gt_user_data_id);
		
		//require "emailer_client_poster_submission.php";
		require "poster_emailer.php";
		$email = @$_POST['lead_email'];
		$email_1 = @$_POST['pp_email'];
		
		//$recipients = array('', $email,'', $email_1, '', 'prabha.j@mmactiv.com', '', 'test.interlinks@gmail.com');
		$recipients = array($email,$email_1, 'test.interlinks@gmail.com');
		//$recipients = array( 'test.interlinks@gmail.com');
		$email_pstr_bdy_user = $mail_body;
		echo $mail_body;//exit;
		
		elastic_mail($PSTR_FROM_SUBJECT_USER_MAIL, $email_pstr_bdy_user, $recipients);

	}
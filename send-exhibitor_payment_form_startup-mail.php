<?php
	
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require 'class.phpmailer.php';
	$reg_id = 'LXNJU';
	exit;
	if(1) {
		$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE reg_id = '$reg_id'");
		$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
		$res = $qr_gt_user_data_ans_row;
		
		if($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
			$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
		} else {
			$total_amt = $qr_gt_user_data_ans_row['total'];
		}
		
	    $recipients = array('','test.interlinks@gmail.com','', $EVENT_ENQUIRY_EMAIL, '', 'ambika.kiran@mmactiv.com', '', 'chandrachood.as@mmactiv.com', '', '');
		
		$recipients[] = '';
		$recipients[] = $res['cp_email'];
	    //$recipients = array('', 'test.interlinks@gmail.com','', 'sagarpatil2112@gmail.com');
	    require "emailer_exhibitor_payment.php";
	    //echo $mail_body;exit;
		$MAIL_HOST       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
		$MAIL_PORT       = 2525;                   // set the SMTP port for the server
		$MAIL_USER_NAME  = "enquiry-bengalurutechsummit";  // username
		$MAIL_PASS		 = "Enq@ui2ry@be";            // password
			
		$mail             = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
													// 1 = errors and messages
													// 2 = messages only
		$mail->SMTPAuth   = true;					// enable SMTP authentication
		//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
		$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
		$mail->Port       = 25;                   // set the SMTP port for the server
		$mail->Username   = "enquiry-bengalurutechsummit";  // username
		$mail->Password   = "Enq@ui2ry@be";
				
		$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
		 
		$mail->Subject    = "Thank you for Making payment for Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR;
		$mail->MsgHTML($mail_body);

    	elastic_mail("Thank you for Making payment for Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR, $mail_body, $recipients);
	    //echo $mail_body;exit;
	}
		exit;
		
	
?>
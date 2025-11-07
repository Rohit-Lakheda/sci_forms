<?php	
	require("includes/form_constants.php");
	require "dbcon_open.php";
	require 'class.phpmailer.php';
	$reg_id = 'A237KS';
	
	exit;
		$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE reg_id = '$reg_id'");
		$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
		$res = $qr_gt_user_data_ans_row;
		$temp_receiver_org       = $qr_gt_user_data_ans_row['org'];
					
		if($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
			$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
		} else {
			$total_amt = $qr_gt_user_data_ans_row['total'];
		}

	    $recipients = array();
	    $recipient = array('','test.interlinks@gmail.com','', $EVENT_ENQUIRY_EMAIL, '', 'bhavya.mmactiv@gmail.com', '', 'vinay.mmactiv@gmail.com', '', 'utsav.activ@gmail.com','', 'mohanram@mmactiv.in');
	    switch($qr_gt_user_data_ans_row['sub_delegates']) {
	    	case 1:
		        $recipients = array('', $res['email1']);
		        break;
		    case 3:
		        $recipients = array('', $res['email1'], $res['email2'], $res['email3']);
		        break;
		    case 4:
		        $recipients = array('', $res['email1'], $res['email2'], $res['email3'], $res['email4']);
		        break;
		    case 5:
		       	$recipients = array('', $res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5']);
		        break;
		    case 6:
		        $recipients = array('', $res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5'], $res['email6']);
		        break;
		    case 7:
		        $recipients = array('', $res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5'], $res['email6'], $res['email7']);
		        break;
	    }
	    $recipients = array_merge($recipients, $recipient);
	    //print_r($recipients);exit;
	    //$recipients = array('', 'test.interlinks@gmail.com','', 'sagar.patil@interlinks.in');
	    //require 'class.phpmailer.php';
	    require "emailer_reg.php";
	    //echo $mail_body;exit;
    	$mail = new PHPMailer();
    	$mail->IsSMTP(); // telling the class to use SMTP
    	$mail->Host = "localhost"; // SMTP server
    	$mail->FromName = $EVENT_NAME . ' ' . $EVENT_YEAR;
    	$mail->From = $EVENT_ENQUIRY_EMAIL;
    	$mail->Subject = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR ;
    	$mail->IsHTML(true);
    	$mail->Body = $mail_body;
    	foreach($recipients as $emailid) {
    		$mail->AddAddress($emailid);
    		if(!$mail->Send()) {
    		}
    		$mail->clearAddresses();
    	}
	    //echo $mail_body;exit;
    	//exit;
	
	
	
?>
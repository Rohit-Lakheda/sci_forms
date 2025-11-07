<?php ini_set("display_errors", "1");
error_reporting(E_ALL);
	//print_r($_POST);exit;
	/*session_start();
	if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
		session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		echo "<script language='javascript'>window.location = 'registration.php';</script>";
		exit;
	}*/
	exit;

	require 'class.phpmailer.php';
	require("includes/form_constants.php");
	require "dbcon_open.php";
	$reg_id = 'S6CA1U';//$_SESSION["vercode_reg"];
	
	
		$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE reg_id = '$reg_id'");
		$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
		$res = $qr_gt_user_data_ans_row;
		$temp_receiver_org       = $qr_gt_user_data_ans_row['org'];
		
		//print_r($qr_gt_user_data_ans_row);
		//=======================================================================================================================================
		//=======================================================================================================================================
		
				
		if($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
			$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
		} else {
			$total_amt = $qr_gt_user_data_ans_row['total'];
		}

	    	$qr_gt_user_inx_login_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE tin_no = '$res[tin_no]' ");
		while ($qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qr_gt_user_inx_login_data_id)) {		
			include "reg_inx_emailer.php";
			$temp_p_email   = $EVENT_ENQUIRY_EMAIL;
			$temp_p_name    = $EVENT_NAME . " InterlinX";
			$str_career     = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";
			$str_career_bdy = $mail_interlinx_str;
			
			//$recipients = array('', 'test.interlinks@gmail.com','', 'sagar.patil@interlinks.in');
			$recipients = array($qr_gt_user_inx_login_data_ans['pri_email'], '', 'test.interlinks@gmail.com', '', $EVENT_ENQUIRY_EMAIL, '', 'interlinx@outlook.com');
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
	        $mail->Host     = "localhost"; // SMTP server 
	        $mail->FromName = $temp_p_name;
	        $mail->From     = $temp_p_email;
	        $mail->Subject  = $str_career;
	        $mail->IsHTML(true);
	        $mail->Body = $str_career_bdy;
	        //echo $str_career_bdy;exit;
			foreach($recipients as $emailid) {
				 $mail->AddAddress($emailid);
				 if(!$mail->Send()) {
				 }// else {echo '###';}
				 $mail->clearAddresses();
			 }
		}

	
	    $recipients = array();
	    $recipient = array('','test.interlinks@gmail.com','', $EVENT_ENQUIRY_EMAIL, '', 'bhavya.mmactiv@gmail.com', '', 'vinay.mmactiv@gmail.com', '', 'ambika.kiran@mmactiv.in', '', 'utsav.activ@gmail.com');
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
	    require "emailer_reg.php";
	    
    	$mail = new PHPMailer();
    	$mail->IsSMTP(); // telling the class to use SMTP
    	$mail->Host = "localhost"; // SMTP server
    	$mail->FromName = $EVENT_NAME . ' ' . $EVENT_YEAR;
    	$mail->From = $EVENT_ENQUIRY_EMAIL;
    	$mail->Subject = $EVENT_NAME . ' ' . $EVENT_YEAR . " Thanks for Registering ";
    	$mail->IsHTML(true);
    	$mail->Body = $mail_body;echo $mail_body;
    	foreach($recipients as $emailid) {
    		$mail->AddAddress($emailid);
    		if(!$mail->Send()) {
    		}
    		$mail->clearAddresses();
    	}
	    //echo $mail_body;exit;
    	exit;
	    if(($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
	    	//echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
	    	echo 'Please wait while you redirecting to CCAvenue payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
	    	echo "<script language='javascript'>setTimeout(function(){ window.location = ('$EVENT_OL_PAY_ACT_LINK?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
			exit;
	    } else if(($qr_gt_user_data_ans_row['paymode'] == "Cheque")||($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD") || $qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") {
	    	echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
	    	exit;
	    } 
	    
	    /* if($_POST['make_payment'] == 1) {
	    	
	    } else if($_POST['make_payment'] == 0) {
	    	if($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {
		    	echo "<script language='javascript'>window.location = 'registration9.php';</script>";
		    	exit;
	    	}
	    } */
	
	
	echo "<script language='javascript'>alert('Sorry, your registration has been failed!');</script>";
	echo "<script language='javascript'>window.location = 'registration.php';</script>";
	exit;
?>
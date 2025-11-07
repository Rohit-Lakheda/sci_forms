<?php
	//print_r($_POST);exit;
	session_start();
	
	if((!isset($_SESSION["vercode_drone"]))||($_SESSION["vercode_drone"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		echo "<script language='javascript'>window.location = 'drone-racing.php';</script>";
        exit;
	}

	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require 'class.phpmailer.php';
	$reg_id = $_SESSION["vercode_drone"];
	
	if(isset($_POST['make_payment'])) {
		$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_DRONE_RACING_DEMO . " WHERE reg_id = '$reg_id'");
		$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
		$res = $qr_gt_user_data_ans_row;
		//print_r($qr_gt_user_data_ans_row);
		
		$qr_gt_user_data_id1      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_DRONE_RACING . " WHERE reg_id = '$reg_id'");
		$qr_gt_user_data_ans_row1 = mysqli_fetch_assoc($qr_gt_user_data_id1);
		if(!empty($qr_gt_user_data_ans_row1)) {			
			echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
			echo "<script language='javascript'>window.location = 'drone-racing.php';</script>";
			exit;
		}
		
		if(!empty($qr_gt_user_data_ans_row)) {
			$fields = '';
			$values = '';
			foreach ($qr_gt_user_data_ans_row as $key=>$value) {
				if($key != 'srno') {
					$fields .= $key . ',';
					
					$values .= "'" . $value . "',";
				}
			}
			$values = trim($values, ',');
			$fields = trim($fields, ',');
			
			mysqli_query($link,"insert  into " . $EVENT_DB_FORM_DRONE_RACING . "($fields) VALUES($values)");
		}
		
		$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_DRONE_RACING . " WHERE reg_id = '$reg_id'");
		$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
		$res = $qr_gt_user_data_ans_row;

		if($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
			$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
		} else {
			$total_amt = $qr_gt_user_data_ans_row['total'];
		}

		$recipients = array('','test.interlinks@gmail.com','', $EVENT_ENQUIRY_EMAIL, '', 'bhavya.mmactiv@gmail.com', '', 'vinay.mmactiv@gmail.com', '', 'ambika.kiran@mmactiv.com','', 'mohanram@mmactiv.in', '','gurunath.angadi@mmactiv.com','', $qr_gt_user_data_ans_row['email']);	
	    //print_r($recipients);exit;
	    //$recipients = array('', 'test.interlinks@gmail.com','', 'sagar.patil@interlinks.in');
	    
		/*$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "72.9.105.77"; // SMTP server
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "72.9.105.77";      // sets  as the SMTP server
		$mail->Port       = 587;                   // set the SMTP port for the server
		$mail->Username   = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
		$mail->Password   = "dcpl5555";            // password			
		$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
		$mail->Subject    = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR ;		
		$mail->MsgHTML($mail_body);*/
		
		include 'emailer_drone_racing.php';

		$MAIL_HOST       = "72.9.105.77";      // sets  as the SMTP server
		$MAIL_PORT       = 587;                   // set the SMTP port for the server
		$MAIL_USER_NAME  = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
		$MAIL_PASS		 = "dcpl5555";            // password
			
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
		$mail->Password   = "Enq@ui2ry@be";				// password
				
		$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
		$mail->Subject    = "Thank you for drone racing registration with " . $EVENT_NAME . " " . $EVENT_YEAR ;
		$mail->MsgHTML($mail_body);

    	/*$mail = new PHPMailer();
    	$mail->IsSMTP(); // telling the class to use SMTP
    	$mail->Host = "localhost"; // SMTP server
    	$mail->FromName = $EVENT_NAME . ' ' . $EVENT_YEAR;
    	$mail->From = $EVENT_ENQUIRY_EMAIL;
    	$mail->Subject = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR ;
    	$mail->IsHTML(true);
    	$mail->Body = $mail_body;*/
    	foreach($recipients as $emailid) {
    		$mail->AddAddress($emailid);
    		if(!$mail->Send()) {//echo '#'.$emailid;
    		}
    		$mail->clearAddresses();
    	}
	    //echo $mail_body;exit;
    	//exit;
	    if(($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
	    	//echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
			session_destroy();
	    	echo 'Please wait while you redirecting to CCAvenue payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
	    	echo "<script language='javascript'>setTimeout(function(){ window.location = ('$EVENT_OL_PAY_ACT_LINK_DR?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
			exit;
	    } else if(($qr_gt_user_data_ans_row['paymode'] == "Cheque")||($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD") || $qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") {
	    	echo "<script language='javascript'>window.location = 'drone-racing5.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
	    	exit;
	    } 
	    
	    /* if($_POST['make_payment'] == 1) {
	    	
	    } else if($_POST['make_payment'] == 0) {
	    	if($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {
		    	echo "<script language='javascript'>window.location = 'registration9.php';</script>";
		    	exit;
	    	}
	    } */
	}
	
	echo "<script language='javascript'>alert('Sorry, your registration has been failed!');</script>";
	echo "<script language='javascript'>window.location = 'drone-racing.php';</script>";
	exit;
?>
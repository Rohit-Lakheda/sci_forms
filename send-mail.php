<?php

	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require 'class.phpmailer.php';
	
	$recipients = array('test.interlinks@gmail.com');//,'', 'sagar.patil@interlinks.in');
	//$recipients = array('sagar.patil@interlinks.in');//,'', '');


	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  =1;						// enables SMTP debug information (for testing)
												// 1 = errors and messages
												// 2 = messages only
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
	$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the server
	$mail->Username   = "enquiry-bengalurutechsummit";  // username
	$mail->Password   = "Enq@ui2ry@be";			// password
			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
	$mail->Subject    = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR ;
	$mail->MsgHTML('<h1>Test,</h1>');

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
		if(!$mail->Send()) {
			//echo '<br/>Email: '.$emailid;// . '<br/>Error: ' . $mail->ErrorInfo;
		}
		$mail->clearAddresses();
	}
	//echo $mail_body;exit;
	exit;

	$tin_no = $_GET['id'];
	$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no'");
	//$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE pay_status = 'Not Paid'");
	while($qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id)) {
		$res = $qr_gt_user_data_ans_row;

	$recipients = array();
		$recipient = array('','test.interlinks@gmail.com','', '', '', 'bhavya.mmactiv@gmail.com', '', 'vinay.mmactiv@gmail.com', '', 'ambika.kiran@mmactiv.com','', 'mohanram@mmactiv.in', '','gurunath.angadi@mmactiv.com','','');
		
		if ($res['sector'] == 'Bio Technology') {
			$recipient[] = '';
			$recipient[] = 'vani.faustina@mmactiv.com';
		}
	    switch($qr_gt_user_data_ans_row['sub_delegates']) {
	    	case 1:
		        $recipients = array('', $res['email1']);
		        break;
		    case 2:
		        $recipients = array('', $res['email1'],'',  $res['email2']);
		        break;
		    case 3:
		        $recipients = array('', $res['email1'],'',  $res['email2'],'',  $res['email3']);
		        break;
		    case 4:
		        $recipients = array('', $res['email1'],'',  $res['email2'],'',  $res['email3'],'',  $res['email4']);
		        break;
		    case 5:
		       	$recipients = array('', $res['email1'],'',  $res['email2'],'',  $res['email3'],'',  $res['email4'],'',  $res['email5']);
		        break;
		    case 6:
		        $recipients = array('', $res['email1'],'',  $res['email2'],'',  $res['email3'],'',  $res['email4'],'',  $res['email5'],'',  $res['email6']);
		        break;
		    case 7:
		        $recipients = array('', $res['email1'],'',  $res['email2'],'',  $res['email3'],'',  $res['email4'],'',  $res['email5'],'',  $res['email6'],'',  $res['email7']);
		        break;
	    }
		//$recipients = array();
	    //$recipients = array_merge($recipients, $recipient);
	    print_r($recipients);
	    //$recipients = array('', 'test.interlinks@gmail.com','', 'sagar.patil@interlinks.in');
	    //require 'class.phpmailer.php';
	    require "emailer_reg.php";
	    //echo $mail_body;exit;	

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
		$mail->Subject    = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR ;
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
	    echo $mail_body;
		//exit;
	}
<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require "class.phpmailer.php";
	exit;

	//============ Payment recei[t mail===========================
	$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '" . $_GET['id'] . "'");
	$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
	$res = $qr_gt_user_data_ans_row;

	$recipients = array();
	$recipient = array('', 'ambika.kiran@mmactiv.com', '','gurunath.angadi@mmactiv.com','','','test.interlinks@gmail.com','', $EVENT_ENQUIRY_EMAIL, '', 'bhavya.mmactiv@gmail.com', '', 'vinay.mmactiv@gmail.com', '', '','', 'mohanram@mmactiv.com', '', 'accounts@mmactiv.com', '', 'adarsh.accounts@mmactiv.com');
	
	if ($res['sector'] == 'Bio Technology') {
		$recipient[] = '';
		$recipient[] = 'vani.faustina@mmactiv.com';
	}
	switch($qr_gt_user_data_ans_row['sub_delegates']) {
		case 1:
			$recipients = array('', $res['email1']);
			break;
		case 2:
			$recipients = array('', $res['email1'], $res['email2']);
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
	//$recipients = array('', 'test.interlinks@gmail.com');
	//$recipients = array('', 'accounts@mmactiv.com', '', 'adarsh.accounts@mmactiv.com');
	//require 'class.phpmailer.php';
	$pg_result_arr = explode("#",$res['pg_result']);
	
	$OrderId=$res['pg_paymentid'];
	$tracking_id=$res['pg_trackid'];
	$bank_ref_no = $res['pg_tranid'];
	$payment_mode=$pg_result_arr[0];
	$order_status=@$pg_result_arr[5];
	$currency = @$pg_result_arr[4];
	$Amount=$res['pg_amt'];
	$order_status = "Success";
	$lmt = $res['sub_delegates'];	
	//require "emailer_pg_response.php";
	require "emailer_pg_response_paypal.php";

	
	require "emailer_reg.php";

			
	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
	$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the server
	$mail->Username   = "enquiry-bengalurutechsummit";  // username
	$mail->Password   = "Enq@ui2ry@be";            // password	
			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
	$mail->Subject    = "Thanks for making payment on " . $EVENT_NAME . " " . $EVENT_YEAR;
	$mail->MsgHTML($mail_body);

	//echo $mail_body;exit;

	foreach($recipients as $emailid) {
		$mail->AddAddress($emailid);
		if(!$mail->Send()) {echo '#'.$emailid;
		}
		$mail->clearAddresses();
	}

	/*for ($i = 1; $i <= $res['sub_delegates']; $i++) {
		$dele_title      = $res['title' . $i];
		$dele_fname      = $res['fname' . $i];
		$dele_lname      = $res['lname' . $i];
		$dele_email      = $res['email' . $i];
		$job_title       = $res['job_title' . $i];
		$dele_cellno     = $res['cellno' . $i];
		$dele_cellno_arr = explode("-", $dele_cellno);

		if(isset($dele_cellno_arr[0])) {
			$country_code = $dele_cellno_arr[0];
			if(strlen($country_code) >= 6) {
				$phone = $country_code;
				$country_code = '+91';
			}
		}
		if(isset($dele_cellno_arr[1])) {
			$phone = $dele_cellno_arr[1];
		}
		//Call save Operator API
		$data = array();
		$data['name']= $dele_title . ' ' . $dele_fname . ' ' . $dele_lname;
		$data['email']= $dele_email;
		$data['country_code']= $country_code;
		$data['phone']= $phone;
		$data['company']= $res['org'];
		$data['designation']= $job_title;
		$data['booking_id']= $res['tin_no'];
		//$data['additional_data_1']= $res['assoc_name'];
		//$data['additional_data_2']= $res['city'];
		//$data['additional_data_3']= $res['state'];
		//Call API
		if($res['assoc_name'] == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI') {
			callUniversalAPI($data, 31427, 'Association Partner');
		} else {
			callDelegateAPI($data);
		}
	}*/

	echo $mail_body;exit;
	exit;



	
?>
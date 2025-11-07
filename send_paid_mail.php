<?php
	
	$tin_no = @$_GET['id'];
	require("includes/form_constants_both.php");
	require "dbcon_open.php";

	
	
	
	$qr_gt_user_data_id1      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no'");
	$res = $qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id1);
	

	    $recipients = array();
		$recipient = array('','test.interlinks@gmail.com','', '', '', 'bhavya.mmactiv@gmail.com', '', '', '', 'ambika.kiran@mmactiv.com','', '', '','','','');
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
		//$recipients = array();
	    //$recipients = array_merge($recipients, $recipient);
	    //$recipients = array('test.interlinks@gmail.com','', 'sagarpatil2112@gmail.com');
	    //print_r($recipients);exit;
	   //$recipients = array('', 'test.interlinks@gmail.com','', 'mayuri.ladi@interlinks.in');
	    //require 'class.phpmailer.php';
	    /*if($res['pay_status'] == 'Free') {
			for ($i = 1; $i <= $res['sub_delegates']; $i++) {
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
				$data['email_id']= $dele_email;
				$data['country_code']= $country_code;
				$data['mobile']= $phone;
				$data['company']= $res['org'];
				$data['designation']= $job_title;
				$data['type']= 1;
				
				//$data['booking_id']= $res['tin_no'];
				//$data['additional_data_1']= $res['assoc_name'];
				//$data['additional_data_2']= $res['city'];
				//$data['additional_data_3']= $res['state'];
				//Call API
				//callUniversalAPI($data);
				if($res['cata' . $i] == 'Conference Delegate') {
					$data['category_id']= 113;
					callUniversalAPI($data);
				} else {
					$data['category_id']= 114;
					callUniversalAPI($data);
				}
			}
			require "emailer_reg_del.php";
	    } else {
	        //require "emailer_reg_del.php";
			require "emailer_reg.php";
		}*/
		/*if($res['paymode'] == 'Paypal') {
			require "emailer_pg_response_paypal.php";
		} else {
			require "emailer_pg_response.php";
		}*/
		require "emailer_reg.php";

		//require "emailer_reg_free.php";
		//require "emailer_reg_comp.php";
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
							
		
		$recipients[] = 'test.interlinks@gmail.com';
		//$recipients = array('test.interlinks@gmail.com','', 'sagarpatil2112@gmail.com');
		elastic_mail("Thanks for making payment on " . $EVENT_NAME . " " . $EVENT_YEAR, $mail_body, $recipients);
	    echo $mail_body;
		exit;
    	//exit;
	    
?>
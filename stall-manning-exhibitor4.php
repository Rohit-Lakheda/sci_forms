<?php
	session_start();
	require "includes/form_constants_both.php";
	require "dbcon_open.php";
	// print_r($_POST);exit;
	$en = '';
	//$eventName = 'Bengaluru Tech Summit';
	$event_name = 'Bangalore IT';
	$assoc_code = mysqli_escape_string($link,htmlspecialchars(@$_REQUEST['a']));
	$promo_code = $assoc_code = trim($assoc_code);
    if (($_SESSION ["vercode_ex"] == '')) {
        session_destroy();
        echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		if(!empty($assoc_code)) {
			echo "<script language='javascript'>window.location = 'stall-manning-exhibitor.php?a=$assoc_code';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'stall-manning-exhibitor.php?a=$assoc_code';</script>";
		}
        exit;
    }
	
	
	if(!empty($promo_code)) {
		$sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_STALL_MANNING_TBL WHERE promo_code='" . $promo_code . "'";
		$discountDetail = mysqli_fetch_assoc(mysqli_query($link,$sql));
		if(isset($discountDetail['reg_done'])) {
			if($discountDetail['reg_done'] >= $discountDetail['total_reg']) {
				session_destroy();
				echo "<script language='javascript'>alert('For exhibitor " . $discountDetail['assoc_name'] . " registrations seats are fulled.');</script>";
				echo "<script language='javascript'>window.location = 'stall-manning-exhibitor.php';</script>";
				exit;
			}
		} else {
			session_destroy();
			echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
			echo "<script language='javascript'>window.location='stall-manning-exhibitor.php';</script>";
			exit;
		}
	} else {
		echo "<script language='javascript'>alert('Invalid promo code. Please try again!');</script>";
		echo "<script language='javascript'>window.location='stall-manning-exhibitor.php';</script>";
		exit;
	}

	if($discountDetail['promo_code'] != 'T3JSW1N1') {
		//print_r($discountDetail);
		if($discountDetail['reg_done'] >= $discountDetail['total_reg']) {
			//session_destroy();
			echo "<script language='javascript'>alert('For exhibitor "  .$assoc_name . " registrations seats are fulled. Please try again!');</script>";
			echo "<script language='javascript'>window.location = 'registration-assoc-conf.php';</script>";
			exit;
		} else {
			$discountDetail['reg_done']++;
			$sql = "UPDATE " . $EVENT_DB_FORM_PROMO_CODE_STALL_MANNING_TBL . " SET reg_done=" . $discountDetail['reg_done'] . " WHERE srno=" . $discountDetail['srno'];
			mysqli_query($link,$sql);
		}
	}
	
	$reg_id = $_SESSION['vercode_ex'];
	
	//$qr_chk_exb_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_PHASE_2 WHERE (exhibitor_id='$discountDetail[code]') " );
	//$qr_chk_exb_ans = mysqli_fetch_array ( $qr_chk_exb_id );

	$sql = "SELECT * FROM $EVENT_DB_FORM_STALL_MANNING_TBL_DEMO WHERE reg_id='" . $reg_id . "'";
	$user_data = mysqli_query($link,$sql);

	if(mysqli_num_rows($user_data) > 0) {
		while ($row = mysqli_fetch_assoc($user_data)) {
			$exhi_user_data[] = $row;
			$fields = $values = '';
			foreach ($row as $key=>$value) {
				if($key != 'srno') {
					$fields .= $key . ',';
					$values .= "'" . mysqli_escape_string($link,htmlspecialchars($value)) . "',";
				}
			}
			$values = trim($values, ',');
			$fields = trim($fields, ',');
				
			mysqli_query($link,"insert  into " . $EVENT_DB_FORM_STALL_MANNING_TBL . "($fields) VALUES($values)");
			

			$sql = "SELECT * FROM $EVENT_DB_FORM_STALL_MANNING_TBL WHERE reg_id='" . $reg_id . "'";
			$res1 = mysqli_query($link,$sql);
			$res = mysqli_fetch_assoc($res1);
			$qr_chk_exb_ans['exhibitor_name'] = $row['org'];
			require 'emailer_stall_manning.php';
			//echo $mail_body;exit;
			$EMAIL = $row['email'];
			// $recipients = array ('', 'test.interlinks@gmail.com', '', 'faiz.khan@mmactiv.com','','puneet.kashyap@mmactiv.com', '', 'milan.ks@mmactiv.com');
			$recipients = array ('', 'test.interlinks@gmail.com', '', 'chandrachood.as@mmactiv.com', '', 'ambika.kiran@mmactiv.com',$EMAIL );
			//$recipients = array ('', 'test.interlinks@gmail.com', '', 'sagarpatil2112@gmail.com' );
			$temp_p_email = $EVENT_ENQUIRY_EMAIL;
			$temp_p_name = $EVENT_NAME . " " . $EVENT_YEAR;
			$str_career = "New exhibitor stall manning details on " . $EVENT_NAME . " " . $EVENT_YEAR . " - " . $row['org'];
			$str_career_bdy = $mail_body;
			// print_r($recipients);
			// exit;
			/*$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
			$mail->Port       = 25;                   // set the SMTP port for the server
			$mail->Username   = "enquiry-bengalurutechsummit";  // username
			$mail->Password   = "Enq@ui2ry@be";               // password			
			$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
			$mail->Subject    = $str_career ;		
			$mail->MsgHTML($str_career_bdy); */
			
			elastic_mail($str_career, $str_career_bdy, $recipients);
			$country_code = '';
			/*$dele_cellno_arr = str_replace('+', '', $res['mob']);//explode("-", $row['mob']);
			if(isset($dele_cellno_arr[0])) {
				$country_code = $dele_cellno_arr[0];
				if(strlen($country_code) >= 6) {
					$phone = $country_code;
					$country_code = '91';
				}
			}
			if(isset($dele_cellno_arr[1])) {
				$phone = $dele_cellno_arr[1];
			}*/
			//Call save Operator API
			// $data = array();
			// $data['api_key'] = 'scan626246ff10216s477754768osk';
			// $data['event_id'] = 117859;
			// $data['name']= $row['fname'] . ' ' . $row['lname'];
			// $data['email']= $row['email'];
			// $data['country_code']= (empty($country_code) ? '91' : $country_code);
			// $data['mobile']= $res['mob'];
			// $data['company']= $qr_chk_exb_ans['exhibitor_name'];
			// $data['designation']= $row['desig'];
			// $data['category_id']= 1894;
			// $data['qsn_366']= 'Exhibitor';
			// //Call API
			// sendchkdinapi($data);;//exit;
		}
	}
	//exit;
	echo "<script language='javascript'>window.location = 'stall-manning-exhibitor5.php?a=$assoc_code';</script>";
	exit;
?>
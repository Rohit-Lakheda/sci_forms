<?php
//print_r($_POST);exit;
session_start();

if ((!isset($_SESSION["vercode_ex"])) || ($_SESSION["vercode_ex"] == '')) {
	session_destroy();
	echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
	echo "<script language='javascript'>window.location = 'exhibitor_payment_form_tiemem.php';</script>";
	exit;
}
require("includes/form_constants_both.php");
require "dbcon_open.php";
require 'class.phpmailer.php';
$reg_id = $_SESSION["vercode_ex"];

if (isset($_POST['make_payment'])) {
	$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
	$res = $qr_gt_user_data_ans_row;
	$tin_no_final = $qr_gt_user_data_ans_row['tin_no'];

	$qr_gt_user_data_id1      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row1 = mysqli_fetch_assoc($qr_gt_user_data_id1);
	if (!empty($qr_gt_user_data_ans_row1)) {
		echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
		echo "<script language='javascript'>window.location = 'exhibitor_payment_form_tiemem.php';</script>";
		exit;
	}
	//=======================================================================================================================================
	//=======================================================================================================================================

	if (!empty($qr_gt_user_data_ans_row)) {
		$fields = '';
		$values = '';
		foreach ($qr_gt_user_data_ans_row as $key => $value) {
			if ($key != 'srno') {
				$fields .= $key . ',';

				$values .= "'" . mysqli_real_escape_string($link,$value) . "',";
			}
		}
		$values = trim($values, ',');
		$fields = trim($fields, ',');

		mysqli_query($link,"insert  into " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . "($fields) VALUES($values)");
	}

	$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
	$res = $qr_gt_user_data_ans_row;

	if ($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
		$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
	} else {
		$total_amt = $qr_gt_user_data_ans_row['total'];
	}

	$recipients = array('test.interlinks@gmail.com', $EVENT_ENQUIRY_EMAIL, 'ambika.kiran@mmactiv.com', 'chandrachood.as@mmactiv.com', $res['cp_email']);

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
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
	$mail->Host       = $MAIL_HOST;				// sets  as the SMTP server
	$mail->Port       = $MAIL_PORT;				// set the SMTP port for the server
	$mail->Username   = $MAIL_USER_NAME;		// username
	$mail->Password   = $MAIL_PASS;				// password

	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);

	$mail->Subject    = "Thank you for Initiating Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR;
	$mail->MsgHTML($mail_body);

	/*foreach($recipients as $emailid) {
		 $mail->AddAddress($emailid);
		 if(!$mail->Send()) {//echo '#'.$emailid;
		 }
		 $mail->clearAddresses();
		 }*/
	$Subject    = "Thank you for Initiating Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR;

	$recipients = array('test.interlinks@gmail.com', $EVENT_ENQUIRY_EMAIL, 'ambika.kiran@mmactiv.com', 'chandrachood.as@mmactiv.com');
	elastic_mail($Subject, $mail_body, $recipients);
	//echo $mail_body;exit;

	/*session_destroy();
	echo "<script language='javascript'>window.location = ('exhibitor_payment_form5_no_pg.php');</script>";
	exit;*/

	//////////////////////////////////////////////////////////
	/*
	$qrygetdata = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL WHERE tin_no = '$tin_no_final'");
	$qrygetdata_ans = mysqli_fetch_array($qrygetdata);

	$promo_code_status = "";
	do {
		$promo_code = mt_rand(10, 100000);
		$chk_promo_code = mysqli_query($link,"SELECT * FROM it_2023_promo_code_stall_manning_tbl WHERE promo_code = '$promo_code'");
		$res_chk_promo_code = mysqli_num_rows($chk_promo_code);
		if ($res_chk_promo_code < 1) {
			$promo_code_status = "OK";
		}
	} while ($promo_code_status == "");

	$inr_promocode = mysqli_query($link,"INSERT INTO it_2023_promo_code_stall_manning_tbl (assoc_name,code,promo_code,total_reg,reg_done) VALUES ('$qrygetdata_ans[exhibitor_name]','$tin_no_final','$promo_code','4','0')");
	//echo "INSERT INTO it_2023_promo_code_stall_manning_tbl (assoc_name,code,promo_code,total_reg,reg_done) VALUES ('$qrygetdata_ans[exhibitor_name]','$tin_no_final','$promo_code','4','0')";
	//exit;
	*/
	/////////////////////////////////////////////////////////////

	if (($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
		//echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
		session_destroy();
		echo 'Please wait while you redirecting to CCAvenue payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		echo "<script language='javascript'>setTimeout(function(){ window.location = ('$EVENT_OL_PAY_ACT_LINK_EX?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
		exit;
	} else if (($qr_gt_user_data_ans_row['paymode'] == 'Cashfree') && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
		//echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
		session_destroy();
		echo 'Please wait while you redirecting to Cashfree payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CF_EVENT_OL_PAY_ACT_LINK_EX?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
		exit;
	} else if (($qr_gt_user_data_ans_row['paymode'] == "Cheque") || ($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD") || $qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") {
		echo "<script language='javascript'>window.location = 'exhibitor_payment_form5.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
		exit;
	} else if ($qr_gt_user_data_ans_row['paymode'] == "Paypal" && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
		session_destroy();
		echo 'Please wait while you redirecting to Paypal payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CANCEL_URL_EXHIBITOR?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
		exit;
	}


	$qr_gt_user_data_id1      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = 'ex$reg_id'");
	$qr_gt_user_data_ans_row1 = mysqli_fetch_assoc($qr_gt_user_data_id1);
	$temp_receiver_org       = $qr_gt_user_data_ans_row1['org'];

	if (!empty($qr_gt_user_data_ans_row1)) {
		$fields = '';
		$values = '';
		foreach ($qr_gt_user_data_ans_row1 as $key => $value) {
			if ($key != 'srno') {
				$fields .= $key . ',';

				$values .= "'" . mysqli_real_escape_string($link,$value) . "',";
			}
		}
		$values = trim($values, ',');
		$fields = trim($fields, ',');

		mysqli_query($link,"insert  into " . $EVENT_DB_FORM_REG . "($fields) VALUES($values)");
	}

	$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
	$res = $qr_gt_user_data_ans_row;

	if ($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
		$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
	} else {
		$total_amt = $qr_gt_user_data_ans_row['total'];
	}

	$recipients = array('test.interlinks@gmail.com', $EVENT_ENQUIRY_EMAIL, 'ambika.kiran@mmactiv.com', 'chandrachood.as@mmactiv.com');

	$recipients[] = '';
	$recipients[] = $res['cp_email'];
	//$recipients = array('', 'test.interlinks@gmail.com','', 'sagar.patil@interlinks.in');
	require "emailer_exhibitor_payment.php";
	//echo $mail_body;//exit;
	$MAIL_HOST       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$MAIL_PORT       = 2525;                   // set the SMTP port for the server
	$MAIL_USER_NAME  = "enquiry-bengalurutechsummit";  // username
	$MAIL_PASS		 = "Enq@ui2ry@be";            // password

	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
	$mail->Host       = $MAIL_HOST;				// sets  as the SMTP server
	$mail->Port       = $MAIL_PORT;				// set the SMTP port for the server
	$mail->Username   = $MAIL_USER_NAME;		// username
	$mail->Password   = $MAIL_PASS;				// password

	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);

	$mail->Subject    = "Thank you for Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR;
	$mail->MsgHTML($mail_body);

	/*foreach($recipients as $emailid) {
    		$mail->AddAddress($emailid);
    		if(!$mail->Send()) {//echo '#'.$emailid;
    		}
    		$mail->clearAddresses();
    	}*/
	$Subject    = "Thank you for Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR;
	//$recipients[] = 'test.interlinks@gmail.com';
	//elastic_mail($Subject, $mail_body, $recipients);
	//echo $mail_body;exit;
	//exit;

	$qr_gt_user_data_id1      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE reg_id = 'ex$reg_id'");
	$res = $qr_gt_user_data_ans_row1 = mysqli_fetch_assoc($qr_gt_user_data_id1);
	//========================== Interlinx
	if ($qr_gt_user_data_ans_row1['cata2'] == 'Premium Delegate') {
		/*for ($i = 2; $i <= $qr_gt_user_data_ans_row1['sub_delegates']; $i++) {
			if($i >= 3) {
				break;
			}*/
		$i = 2;
		$test_delegate_email = $qr_gt_user_data_ans_row1['email' . $i];
		$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'");
		$qry_email_chk_num   = mysqli_num_rows($qry_email_chk);

		if ($qry_email_chk_num >= 1) {
		} else {
			//-------------------------------------------------- Generating User Id ------------------------------------------------
			$usr_no = $EVENT_TBL_PREFIX . '_' . $EVENT_YEAR . "_nrm_";
			$i_gim_inx_user_id_cnt = 0;
			do {
				$temp_no     = rand(1, 9999999);
				$temp_no_len = strlen($temp_no);

				if ($temp_no_len < 7) {
					$temp_no_len = 7 - $temp_no_len;
					while ($temp_no_len) {
						$temp_no = $temp_no . "0";
						$temp_no_len--;
					}
				}
				$usr_no1 = $usr_no . $temp_no;
				$qry     = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE user_id = '$usr_no1'");
				$res_no  = mysqli_num_rows($qry);
				if ($res_no < 1) {
					$i_gim_inx_user_id_cnt++;
				} else {
					$usr_no1 = "";
				}
			} while (!($i_gim_inx_user_id_cnt == 1));
			//-------------------------------------------------End Generating User Id ------------------------------------------------

			$dele_title      = $qr_gt_user_data_ans_row1['title' . $i];
			$dele_fname      = $qr_gt_user_data_ans_row1['fname' . $i];
			$dele_lname      = $qr_gt_user_data_ans_row1['lname' . $i];
			$dele_email      = $qr_gt_user_data_ans_row1['email' . $i];
			$dele_cellno     = $qr_gt_user_data_ans_row1['cellno' . $i];
			$dele_cellno_arr = explode("-", $dele_cellno);

			$test_title = $qr_gt_user_data_ans_row1['title' . $i];
			$test_fname = $qr_gt_user_data_ans_row1['fname' . $i];
			$test_lname = $qr_gt_user_data_ans_row1['lname' . $i];
			$test_email = $qr_gt_user_data_ans_row1['email' . $i];


			$pas1_inx    = str_replace(' ', '_', $qr_gt_user_data_ans_row1['fname' . $i]) . "123";
			$pas2_inx    = md5($pas1_inx);
			$user_id_md5 = md5($usr_no1);

			$temp_qr_gt_user_data_ans_row_fone_arr = explode("-", $qr_gt_user_data_ans_row1['fone']);
			$temp_qr_gt_user_data_ans_row_fax_arr  = explode("-", $qr_gt_user_data_ans_row1['fax']);

			//------------------------------------------------- Inserting Values in interlinx registration table --------------------------------------
			/*echo "INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
	            		(user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,org_info,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,				fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,reg_id,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no) values 
	            		('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','','$dele_email','','$qr_gt_user_data_ans_row[org]','','','$dele_cellno_arr[0]','$dele_cellno_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row[reg_id]','$qr_gt_user_data_ans_row[reg_id]','uploads/default_file.jpg','$qr_gt_user_data_ans_row[org_profile]','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[tin_no]');";*/
			mysqli_query($link,"INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
	            		(user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,org_info,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,				fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,reg_id,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no) values 
	            		('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row1[addr1]','$qr_gt_user_data_ans_row1[addr2]','$qr_gt_user_data_ans_row1[city]','$qr_gt_user_data_ans_row1[state]','$qr_gt_user_data_ans_row1[country]','$qr_gt_user_data_ans_row1[pin]','','$dele_email','','$qr_gt_user_data_ans_row1[org]','','','$dele_cellno_arr[0]','$dele_cellno_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row1[intr1]','$qr_gt_user_data_ans_row1[intr2]','$qr_gt_user_data_ans_row1[intr3]','$qr_gt_user_data_ans_row1[intr4]','$qr_gt_user_data_ans_row1[intr5]','$qr_gt_user_data_ans_row1[intr6]','$qr_gt_user_data_ans_row1[intr7]','$qr_gt_user_data_ans_row1[intr8]','$qr_gt_user_data_ans_row1[intr9]','$qr_gt_user_data_ans_row1[intr10]','$qr_gt_user_data_ans_row1[intr11]','$qr_gt_user_data_ans_row1[intr12]','$qr_gt_user_data_ans_row1[intr13]','$qr_gt_user_data_ans_row1[intr14]','$qr_gt_user_data_ans_row1[intr15]','$qr_gt_user_data_ans_row1[intr16]','$qr_gt_user_data_ans_row1[intr17]','$qr_gt_user_data_ans_row1[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row1[reg_id]','$qr_gt_user_data_ans_row1[reg_id]','uploads/default_file.jpg','$qr_gt_user_data_ans_row1[org_profile]','$qr_gt_user_data_ans_row1[reg_date]','$qr_gt_user_data_ans_row1[reg_time]','$qr_gt_user_data_ans_row1[tin_no]')") or die(mysqli_error($link));

			$year = $EVENT_YEAR;
			$month = 11;
			$date = 29;
			mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values				

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL), 				
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:00:00 pm','18:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));

			/*(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','19:00:00 pm','19:30:00 pm',NULL,'',NULL,NULL)*/

			$month = 11;
			$date = 30;
			mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
					
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),		
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:00:00 pm','18:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));
			/*(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','19:00:00 pm','19:30:00 pm',NULL,'',NULL,NULL)
    				*/
			$month = "12";
			$date = "01";
			mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
    				
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:00:00 pm','18:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));
			/*(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),*/
			//------------------------------------------------- end Inserting Values in interlinx registration table --------------------------------------

		}

		$dele_title      = $res['title' . $i];
		$dele_fname      = $res['fname' . $i];
		$dele_lname      = $res['lname' . $i];
		$dele_email      = $res['email' . $i];
		$job_title       = $res['job_title' . $i];
		$dele_cellno     = $res['cellno' . $i];
		$dele_cellno_arr = explode("-", $dele_cellno);

		if (isset($dele_cellno_arr[0])) {
			$country_code = $dele_cellno_arr[0];
			if (strlen($country_code) >= 6) {
				$phone = $country_code;
				$country_code = '+91';
			}
		}
		if (isset($dele_cellno_arr[1])) {
			$phone = $dele_cellno_arr[1];
		}
		//Call save Operator API
		$data = array();
		$data['name'] = $dele_title . ' ' . $dele_fname . ' ' . $dele_lname;
		$data['email'] = $dele_email;
		$data['country_code'] = $country_code;
		$data['phone'] = $phone;
		$data['company'] = $res['org'];
		$data['designation'] = $job_title;
		$data['booking_id'] = $res['tin_no'];
		//echo $res['assoc_name'];

		/*if(($res['assoc_name'] == 'Faculty')||($res['assoc_name'] == 'Student-Coordinator')||($res['assoc_name'] == 'Program-Coordinators')) {
				callUniversalAPI($data, 31036, 'Delegate');
			} else if($res['assoc_name'] == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI') {
				callUniversalAPI($data, 31427, 'Association Partner');
			}*/
		//}
	}

	$recipients = array();
	$recipient = array('test.interlinks@gmail.com', 'bhavya.mmactiv@gmail.com', 'ambika.kiran@mmactiv.com', $EVENT_ENQUIRY_EMAIL); //,'sagarpatil2112@gmail.com'

	switch ($qr_gt_user_data_ans_row1['sub_delegates']) {
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
	$recipients = array_merge($recipients, $recipient);
	//print_r($recipients);exit;
	//$recipients = array('', 'test.interlinks@gmail.com','', 'mayuri.ladi@interlinks.in');
	require "emailer_reg_comp.php";
	//echo $mail_body;exit;		

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
	$mail->Subject    = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR;
	$mail->MsgHTML($mail_body);

	/*foreach($recipients as $emailid) {
    		$mail->AddAddress($emailid);
    		if(!$mail->Send()) {//echo '#'.$emailid;
    		}
    		$mail->clearAddresses();
    	}*/
	$Subject    = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR;
	//$recipients[] = 'test.interlinks@gmail.com';
	elastic_mail($Subject, $mail_body, $recipients);

	if (($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
		//echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
		session_destroy();
		echo 'Please wait while you redirecting to CCAvenue payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		echo "<script language='javascript'>setTimeout(function(){ window.location = ('$EVENT_OL_PAY_ACT_LINK_EX?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
		exit;
	} else if (($qr_gt_user_data_ans_row['paymode'] == 'Cashfree') && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
		//echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
		session_destroy();
		echo 'Please wait while you redirecting to Cashfree payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CF_EVENT_OL_PAY_ACT_LINK_EX?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
		exit;
	} else if (($qr_gt_user_data_ans_row['paymode'] == "Cheque") || ($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD") || $qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") {
		echo "<script language='javascript'>window.location = 'exhibitor_payment_form5.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
		exit;
	} else if ($qr_gt_user_data_ans_row['paymode'] == "Paypal" && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
		session_destroy();
		echo 'Please wait while you redirecting to Paypal payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CANCEL_URL_EXHIBITOR?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
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
echo "<script language='javascript'>window.location = 'exhibitor_payment_form_tiemem.php';</script>";
exit;

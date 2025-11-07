<?php
//print_r($_POST);exit;
// ini_set("display_errors", "1");
session_start();

if (!isset($_SESSION['vercode_pstr']) || empty($_SESSION['vercode_pstr'])) {
	echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
	echo "<script language='javascript'> window.location =('poster_presentation_form.php');</script>";
	exit();
}
require("includes/form_constants_both.php");
require "dbcon_open.php";
$reg_id = mysqli_escape_string($link, htmlspecialchars($_SESSION['vercode_pstr']));

require 'class.phpmailer.php';

if (isset($_POST['make_payment'])) {
	$qr_gt_user_data_id = mysqli_query($link, "SELECT * FROM " . $PSTR_TBL_NAME_DEMO . " WHERE reg_id = '$reg_id'");
	$res = $qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);

	$qr_gt_user_data_id1 = mysqli_query($link, "SELECT * FROM " . $PSTR_TBL_NAME . " WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row1 = mysqli_fetch_assoc($qr_gt_user_data_id1);
	if (!empty($qr_gt_user_data_ans_row1)) {
		echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
		echo "<script language='javascript'>window.location = 'poster_presentation_form.php';</script>";
		exit;
	}
	//print_r($qr_gt_user_data_ans_row);

	if (!empty($qr_gt_user_data_ans_row)) {
		$fields = '';
		$values = '';

		foreach ($qr_gt_user_data_ans_row as $key => $value) {
			if ($key != 'srno') {

				// Skip payment_date if it's empty (let DB default to NULL)
				if ($key === 'payment_date' && trim($value) === '') {
					continue;
				}

				$fields .= mysqli_real_escape_string($link, htmlspecialchars($key)) . ',';
				$escaped_value = mysqli_real_escape_string($link, htmlspecialchars($value));
				$values .= "'$escaped_value',";
			}
		}

		$fields = rtrim($fields, ',');
		$values = rtrim($values, ',');

		$query = "INSERT INTO `$PSTR_TBL_NAME` ($fields) VALUES ($values)";
		mysqli_query($link, $query) or die('Query Error: ' . mysqli_error($link));
	}


	$qr_gt_user_data_id = mysqli_query($link, "SELECT * FROM " . $PSTR_TBL_NAME . " WHERE reg_id = '$reg_id'");
	$res = $qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);

	//require "emailer_client_poster_submission.php";
	require "poster_emailer.php";
	// $email = mysqli_escape_string($link,htmlspecialchars(@$_POST['lead_email']));
	// $email_1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['pp_email']));
	$email = mysqli_escape_string($link, $qr_gt_user_data_ans_row['lead_email']);
	$email_1 = mysqli_escape_string($link, $qr_gt_user_data_ans_row['pp_email']);


	$recipients = array('', $email, '', $email_1, '', 'prabha.j@mmactiv.com', '', 'test.interlinks@gmail.com', '', 'ambika.kiran@mmactiv.com');
	//$recipients = array( 'test.interlinks@gmail.com');
	$email_pstr_bdy_user = $mail_body;
	//echo $mail_body;exit;
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
	$mail->SMTPAuth = true;                  // enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port = 25;                   // set the SMTP port for the server
	$mail->Username = "enquiry-bengalurutechsummit";  // username
	$mail->Password = "Enq@ui2ry@be";            // password
	$mail->SetFrom($PSTR_EMAIL_ID, $EVENT_NAME . " " . $EVENT_YEAR);
	$mail->Subject = $PSTR_FROM_SUBJECT_USER_MAIL;
	$mail->MsgHTML($email_pstr_bdy_user);

	/*$mail = new PHPMailer();
	 $mail->IsSMTP(); // telling the class to use SMTP
	 $mail->Host = "localhost"; // SMTP server
	 $mail->FromName = $temp_p_name;
	 $mail->From = $temp_p_email;
	 $mail->Subject = $str_career;
	 $mail->IsHTML(true);
	 $mail->Body = $str_career_bdy;*/

	/*foreach($recipients as $emailid) {
		$mail->AddAddress($emailid);
		if(!$mail->Send()) {//echo '#'.$emailid;
		}
		$mail->clearAddresses();
	}*/
	// print_r($recipients) ;
	// exit;
	elastic_mail($PSTR_FROM_SUBJECT_USER_MAIL, $email_pstr_bdy_user, $recipients);

	/* require "emailer_admin_poster_submission.php";

	$recipients = $PSTR_RECIPIENTS_ADMIN_MAIL;
	//$recipients = array('', 'test.interlinks@gmail.com');

	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the server
	$mail->Username   = "enquiry-bengalurutechsummit";  // username
	$mail->Password   = "Enq@ui2ry@be";           // password
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME." ".$EVENT_YEAR);
	$mail->Subject    = $PSTR_FROM_SUBJECT_ADMIN_MAIL;
	$mail->MsgHTML($email_pstr_bdy_admin); */

	/*$mail = new PHPMailer();
	 $mail->IsSMTP(); // telling the class to use SMTP
	 $mail->Host = "localhost"; // SMTP server
	 $mail->FromName = $temp_p_name;
	 $mail->From = $temp_p_email;
	 $mail->Subject = $str_career;
	 $mail->IsHTML(true);
	 $mail->Body = $str_career_bdy;*/
	/* foreach($recipients as $emailid)
	 {
	 $mail->AddAddress($emailid);
	 if(!$mail->Send())
	 {
	 //echo $emailid .'##'.$mail->ErrorInfo;
	 }
	 $mail->clearAddresses();
	 } */
	//-------------------------------------------------End mail to Admin --------------------------------------------------------

	//echo "$email_pstr_bdy_admin<br />";
	//echo "$email_pstr_bdy_user<br />";
	//exit;

	if (($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking' || $qr_gt_user_data_ans_row['paymode'] == 'Google pay') && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
		/*echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";*/
		session_destroy();
		echo 'Please wait while you redirecting to CCAvenue payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		echo "<script language='javascript'>setTimeout(function(){ window.location = ('$EVENT_OL_PAY_ACT_LINK_POSTER?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
		exit;
	} else if (($qr_gt_user_data_ans_row['paymode'] == 'Cashfree') && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
		/*echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";*/
		session_destroy();
		echo 'Please wait while you redirecting to Cashfree payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CF_EVENT_OL_PAY_ACT_LINK_poster?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
		exit;
	} else if (($qr_gt_user_data_ans_row['paymode'] == "Cheque") || ($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD") || $qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") {
		echo "<script language='javascript'>window.location = 'poster_presentation_form5.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
		exit;
	} else if ($qr_gt_user_data_ans_row['paymode'] == "Paypal" && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
		session_destroy();
		echo 'Please wait while you redirecting to Paypal payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CANCEL_URL_POSTER?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
		exit;
	} else {
		echo "<script language='javascript'>window.location = 'poster_presentation_form5.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
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
echo "<script language='javascript'>window.location = 'poster_presentation_form.php';</script>";
exit;
?>
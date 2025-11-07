<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
session_start();
$rsvp_city = $_GET['city'];

if (($_POST["vercode"] != $_SESSION["vercode_rsvp"]) || ($_SESSION["vercode_rsvp"] == '')) {
	session_destroy();
	echo "<script language='javascript'>alert('Please Enter Verification Code.');</script>";
	echo "<script language='javascript'>window.location = 'rsvp.php?city=$rsvp_city';</script>";
	exit;
}

//print_r($_POST); exit;

$rsvp_city = $_GET['city'];
/*if(empty($rsvp_city)) {
		$rsvp_city = "Mumbai";
	}*/

if ($rsvp_city == "") {
	echo "<script language='javascript'>alert('Your session has been expired!');</script>";
	echo "<script language='javascript'>window.location = 'rsvp.php';</script>";
	exit;
}

$titlers = @$_POST['title'];
$namers = @$_POST["name"];
$org = @$_POST["org"];
$desig = @$_POST["desig"];
$email = @$_POST["email"];
$mob = @$_POST['cellnoCountryCode'] . "-" . $_POST['mob'];
$city = @$_POST['city'];
$country = @$_POST["country"];
$association_name = @$_POST["association_name"];
$Event_Identity = "Interaction Meet with Shri Priyank Kharge at New Delhi";

if ($association_name == "OTHER") {
	$association_name = $association_name . " - " . @$_POST['association_name_other'];
}

//$mob = @$_POST["mob"];
//mysqli_real_escape_string(@$_POST["comment"]);

if (($namers == "") || ($email == "") || ($mob == "")) {
	echo "<script language='javascript'>alert('Please Enter Required Information');</script>";
	echo "<script language='javascript'>window.location = 'rsvp.php?city=$rsvp_city';</script>";
	exit;
}

/*for($i_pr=1;$i_pr<=5;$i_pr++){

		if(@$_POST['pr_'.$i_pr] != '') {
			if($participant=="") {
				$participant = @$_POST['pr_'.$i_pr];
			} else {
				$participant .= ",".@$_POST['pr_'.$i_pr];
			}
		}
	}*/

$ses = @$_SESSION["vercode_rsvp"];
$ddate = date("Y-m-d");
$ttime = date("H:i:s A");
$nm = $name = $titlers . " " . $namers;

include "includes/form_constants_both.php";
require "dbcon_open.php";

$comment = 'Date: ' . $RSVP_DATE . ' Time: ' . $RSVP_TIME;
$participant = $RSVP_NAME;

$qr_gt_user_data_id1 = mysqli_query($lnk, "SELECT * FROM " . $RSVP_TBL_NAME . " WHERE email = '$email' AND participant='$participant'");
$qr_gt_user_data_ans_row1 = mysqli_fetch_assoc($qr_gt_user_data_id1);
if (!empty($qr_gt_user_data_ans_row1)) {
	echo "<script language='javascript'>alert('Entered email address already registered. Please try again with different Email-id !');</script>";
	echo "<script language='javascript'>window.location = 'rsvp.php?city=$rsvp_city';</script>";
	exit;
}

$qr = mysqli_query($lnk, "INSERT INTO $RSVP_TBL_NAME(name,org,desig,email,mob,city,comment,reg_id,participant,ddate,ttime,rsvp_location,country,association_name,event_identity) VALUES('$namers','$org','$desig','$email','$mob','$city','$comment','$ses','$participant','$ddate','$ttime','$RSVP_CITY','$country','$association_name','$Event_Identity')") or die(mysqli_error($link));
$id = mysqli_insert_id($link);
if (!empty($id)) {
	//Call save Operator API
	$data = array();
	$data['name'] = $namers;
	$data['email_id'] = $email;
	$data['country_code'] = $_POST['cellnoCountryCode'];
	$data['mobile'] = $mob;
	$data['company'] = $org;
	$data['designation'] = $desig;
	$data['type'] = 1;
	$data['category_id'] = 113;
	$data['association_name'] = "association_name";

	callUniversalAPI($data);

	//user
	require "class.phpmailer.php";
	//admin 
	$temp_p_email = $EVENT_ENQUIRY_EMAIL;
	$temp_p_name = $namers;

	require "rsvp_emailer_admin.php";
	//echo $enq_rsvp_mail_msg_admin;exit;
	//$str_career = $RSVP_FROM_SUBJECT_ADMIN_MAIL;
	$str_career_bdy = $enq_rsvp_mail_msg_admin;

	/*$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host = "localhost"; // SMTP server
		$mail->From = $temp_p_email;
		$mail->FromName = $temp_p_name;
		$mail->Subject = $str_career;
		$mail->IsHTML(true);
		$mail->Body = $str_career_bdy;*/
	$MAIL_HOST = "smtp.bengalurutechsummit.com";      // sets  as the SMTP server
	$MAIL_PORT = 465;               // set the SMTP port for the server
	$MAIL_USER_NAME = "enquiry@bengalurutechsummit.com";  // username
	$MAIL_PASS = "Enq#4321Prawaas";            // password
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = true;					// enable SMTP authentication
	$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
	$mail->Host = $MAIL_HOST;				// sets  as the SMTP server
	$mail->Port = $MAIL_PORT;				// set the SMTP port for the server
	$mail->Username = $MAIL_USER_NAME;		// username
	$mail->Password = $MAIL_PASS;				// password

	$mail->SetFrom($temp_p_email, $temp_p_name);
	$mail->Subject = $str_career;
	$mail->MsgHTML($str_career_bdy);
	$RSVP_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL, 'enquiry@bengalurutechsummit.com', 'test.interlinks@gmail.com', 'samanth.anikar@mmactiv.com', 'santosh.jagtap@mmactiv.com');
	//$RSVP_RECIPIENTS_ADMIN_MAIL = array('test.interlinks@gmail.com');
	/*foreach($RSVP_RECIPIENTS_ADMIN_MAIL as $emailid) {
			$mail->AddAddress($emailid);		
			if(!$mail->Send()) {
			   //echo '<br/>###'.$emailid;
			}
			$mail->clearAddresses();
		}*/
	elastic_mail("New RSVP on " . $RSVP_HEADING, $str_career_bdy, $RSVP_RECIPIENTS_ADMIN_MAIL);

	require "rsvp_emailer_user.php";
	//echo $enq_rsvp_mail_msg_user;exit;
	$str_career = $RSVP_FROM_SUBJECT_USER_MAIL;
	$str_career_bdy = $enq_rsvp_mail_msg_user;
	$temp_p_email = $EVENT_ENQUIRY_EMAIL;
	$temp_p_name = $EVENT_NAME . " " . $EVENT_YEAR;

	/*$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host = "localhost"; // SMTP server
		$mail->From = $temp_p_email;
		$mail->FromName = $temp_p_name;
		$mail->Subject = $str_career;
		$mail->IsHTML(true);
		$mail->Body = $str_career_bdy;	*/
	$MAIL_HOST = "smtp.bengalurutechsummit.com";      // sets  as the SMTP server
	$MAIL_PORT = 465;                 // set the SMTP port for the server
	//$MAIL_USER_NAME  = "enquiry@bengalurutechsummit.com";  // username
	//$MAIL_PASS		 = "Enq#4321Prawaas";

	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug = 0;						// enables SMTP debug information (for testing)
	// 1 = errors and messages
	// 2 = messages only
	$mail->SMTPAuth = true;					// enable SMTP authentication
	$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
	$mail->Host = $MAIL_HOST;				// sets  as the SMTP server
	$mail->Port = $MAIL_PORT;				// set the SMTP port for the server
	$mail->Username = $MAIL_USER_NAME;		// username
	$mail->Password = $MAIL_PASS;				// password

	$mail->SetFrom($temp_p_email, $temp_p_name);
	$mail->Subject = $str_career;
	$mail->MsgHTML($str_career_bdy);
	$RSVP_RECIPIENTS_USER_MAIL = array($email, 'test.interlinks@gmail.com');
	/*foreach($RSVP_RECIPIENTS_USER_MAIL as $emailid) {
			$mail->AddAddress($emailid);		
			if(!$mail->Send()) {
				//echo '<br/>###'.$emailid . $mail->ErrorInfo;
			}
			$mail->clearAddresses();
		}*/
	elastic_mail($str_career, $str_career_bdy, $RSVP_RECIPIENTS_USER_MAIL);
	/*echo $enq_rsvp_mail_msg_user;	
		echo $enq_rsvp_mail_msg_admin;;
		exit;*/
	echo "<script language='javascript'>window.location = 'rsvp3.php?nm=$nm&enq_emler=rsvp&city=$rsvp_city';</script>";
	exit;
}


echo "<script language='javascript'>window.location = 'rsvp.php?city=$rsvp_city';</script>";
exit;

<?php
// ini_set("error_display", 1);
// ini_set("display_errors", 1);
// error_reporting(E_ALL);
session_start();
require "dbcon_open.php";
$mailer_type = @$_REQUEST['mailer_type'];
$sector = mysqli_real_escape_string($link, htmlspecialchars($_POST['sector']));
require "includes/form_constants_both.php";
// print_r($_POST);
// exit;
$event_name = 'Bangalore IT';
/*if($sector == 'Bio Technology') {
		$en = '1';
		$eventName = 'Bengaluru INDIA BIO';
		$event_name = 'Bangalore INDIA BIO';
		//$EVENT_WEBSITE_LINK = 'http://www.bengaluruindiabio.in/';
	}*/
if ($mailer_type != "mailF34D") {
	if (mysqli_escape_string($link, htmlspecialchars(($_POST["vercode"])) != $_SESSION["vercode_enq"]) || ($_SESSION["vercode_enq"] == '')) {
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		echo "<script language='javascript'>window.location = ('roadshow.php?en=" . $en . "');</script>";
		exit;
	}
}





$comments = @$_POST['comment'];

$temp_mda_type = @$_REQUEST['mda_type'];
$fname          = @$_POST['fname'];
$lname          = @$_POST['lname'];
$name = $fname . ' ' . $lname;
$company       = @$_POST['company'];
// $timezone	   = @$_POST['timezone'];
//$company = str_replace(" ", "", $company);
$addr          = @$_POST['addr1'];
//$addr = str_replace(" ", "", $addr);
$ddate         = date("d-M-Y");
$ttime         = date("H:i:s A");
$email         = strtolower(@$_POST['email']);

//if(($name == "")  ||  ($company == "")  ||  ($addr == ""))
if (($fname == "") || ($lname == "") || ($email == "") || $event_name == '') {
	echo "<script language='javascript'>alert('Please Enter Required Details.');</script>";
	echo "<script language='javascript'>document.location = ('enquiry.php?en=" . $en . "');</script>";
	exit();
}




//------------------------------------------------- Capturing enquiry fields ------------------------------------------
// if (@$_POST['find_us'] == "Others") {
// 	$know_from = "Others" . '-' . @$_POST['other_txtbx_find_us'];
// } else {
// 	$know_from = @$_POST['find_us'];
// }

// if (($know_from == "") || ($temp_mda_type != "")) {
// 	$know_from = $know_from . ", - " . $temp_mda_type;
// }
$fone = '';
if (!empty($_POST['fone'])) {
	$fone = '+' . $_POST['foneCountryCode'] . "-" . $_POST['fone'];
}

// $ENQUIRY_RECIPIENTS_ADMIN_MAIL_STR = implode(",", $ENQUIRY_RECIPIENTS_ADMIN_MAIL);
$title = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['title']));
$company = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['company']));
$desig = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['desig']));
$addr1 = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['addr1']));
$addr2 = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['addr2']));
$city = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['city']));
$state = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['state']));
$country = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['country']));
$zip = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['zip']));
$cellno = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['cellno']));
$corr_ist = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['ist_converted_datetime']));
// $website = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['website']));
$event_name = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['event_name']));
$sector = mysqli_real_escape_string($link, html_entity_decode(trim($_POST['sector']), ENT_QUOTES, 'UTF-8'));
$org_type = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['org_reg_type']));
$prefered_date = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['preferred_date']));
$prefered_time = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['preferred_time']));
$timezone = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['timezone']));
// echo $timezone;
// die;
// echo "$prefered_date, $prefered_time";

$ROADSHOW_TBL_NAME = 'it_roadshow_table';

$sql = "SELECT * FROM $ROADSHOW_TBL_NAME WHERE reg_id='" . $_SESSION['vercode_enq'] . "'";
$res = mysqli_query($link, $sql);
$res = mysqli_fetch_assoc($res);
$q="insert into $ROADSHOW_TBL_NAME (title, fname, lname,name, org, org_type, addr, city, state, country, zip, fone, cellno, corr_ist, email,pre_date,pre_time ,ddate, ttime, reg_id, event_name, event_year, sector,time_zone) values('$title', '$fname', '$lname','$name', '$company', '$org_type', '$addr1.$addr2', '$city', '$state', '$country', '$zip', '$fone', '$fone', '$corr_ist', '$email', '$prefered_date', '$prefered_time','$ddate', '$ttime', '$_SESSION[vercode_enq]', '$event_name', '$EVENT_YEAR', '$sector','$timezone')";
// print_r($q);exit;

mysqli_query($link, "INSERT INTO $ROADSHOW_TBL_NAME (title, fname, lname, name, org, org_type, addr, city, state, country, zip, fone, cellno, corr_ist, email, pre_date, pre_time,ddate, ttime, reg_id, event_name, event_year, sector,time_zone) VALUES ('$title', '$fname', '$lname', '$name', '$company', '$org_type', '$addr1.$addr2', '$city', '$state', '$country', '$zip', '$fone', '$fone', '$corr_ist', '$email', '$prefered_date', '$prefered_time','$ddate', '$ttime', '$_SESSION[vercode_enq]', '$event_name', '$EVENT_YEAR', '$sector','$timezone')") or die(mysqli_error($link));




//admin


// $temp_p_email = $email;
// $temp_p_name = $name;

require "roadshow_emailer_admin.php";
//$str_career = "New Enquiry on http://www.bangaloreindiabio.in";	
$str_career = "Bengaluru Tech Summit 2025 Virtual Roadshow";
$str_career_bdy = $roadshow_mail_msg_admin;

/* $headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	 */

/* foreach($ENQUIRY_RECIPIENTS_ADMIN_MAIL as $emailid)
		{
			if(mail($emailid,$str_career,$str_career_bdy,$headers))
			{
					//echo "<br />mail successful : $emailid<br />";
			}
			else
			{
					//echo "<br />mail failed : $emailid<br />";
			}
		
		}  */
// $ENQUIRY_RECIPIENTS_ADMIN_MAIL = array('test.interlinks@gmail.com','', 'sagar.patil@interlinks.in');
$ADMIN_MAIL = array('test.interlinks@gmail.com','anjali.nair@mmactiv.com');

/*$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server 
			$mail->FromName = $temp_p_name;
			$mail->From = $temp_p_email;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;*/

// $MAIL_HOST       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
// $MAIL_PORT       = 2525;                   // set the SMTP port for the server
// $MAIL_USER_NAME  = "enquiry-bengalurutechsummit";  // username
// $MAIL_PASS		 = "Enq@ui2ry@be";            // password

// // $mail             = new PHPMailer();
// // $mail->IsSMTP(); // telling the class to use SMTP
// $mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
// // 1 = errors and messages
// // 2 = messages only
// $mail->SMTPAuth   = true;					// enable SMTP authentication
// //$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
// $mail->Host       = $MAIL_HOST;				// sets  as the SMTP server
// $mail->Port       = $MAIL_PORT;				// set the SMTP port for the server
// $mail->Username   = $MAIL_USER_NAME;		// username
// $mail->Password   = $MAIL_PASS;				// password

// $mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
// $mail->Subject    = $str_career;
// $body = $str_career_bdy;
// $mail->MsgHTML($body);

// /*
// foreach ($ENQUIRY_RECIPIENTS_ADMIN_MAIL as $emailid) {
// 	$mail->AddAddress($emailid);
// 	if (!$mail->Send()) {
// 		//echo $emailid.'###';
// 	}
// 	$mail->clearAddresses();
// }*/

elastic_mail_frm($str_career, $str_career_bdy, $ADMIN_MAIL, "enquiry@bengalurutechsummit.com");

// /*---------------------------------------------------------------------------------------------------------------------------*/


// //user



// $temp_p_email = $ENQUIRY_FROM_EMAIL_USER_MAIL;
// $temp_p_name = $ENQUIRY_FROM_NAME_USER_MAIL;

require "roadshow_emailer_user.php";
$str_career = "Thank you for submitting the Virtual Roadshow form for " . $EVENT_NAME . " " . $EVENT_YEAR;
$str_career_bdy = $roadshow_emailer_mail_msg_user;

// /* $headers  = 'MIME-Version: 1.0' . "\r\n";
// 		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// 		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion(); */

// /*foreach($ENQUIRY_RECIPIENTS_USER_MAIL as $emailid)
// 		{
// 			if(mail($emailid,$str_career,$str_career_bdy,$headers))
// 			{
// 					//echo "<br />mail successful : $emailid<br />";
// 			}
// 			else
// 			{
// 					//echo "<br />mail failed : $emailid<br />";
// 			}
		
// 		}*/
// $ENQUIRY_RECIPIENTS_USER_MAIL[] = '';
// $ENQUIRY_RECIPIENTS_USER_MAIL[] = $email;

// $ENQUIRY_RECIPIENTS_USER_MAIL = array('test.interlinks@gmail.com','', 'sagar.patil@interlinks.in');
$USER_MAIL = array($email,'test.interlinks@gmail.com','anjali.nair@mmactiv.com');
// $USER_MAIL = array($email);
// /*$mail = new PHPMailer();
// 			$mail->IsSMTP(); // telling the class to use SMTP
// 			$mail->Host = "localhost"; // SMTP server 
// 			$mail->FromName = $temp_p_name;
// 			$mail->From = $temp_p_email;
// 			$mail->Subject = $str_career;
// 			$mail->IsHTML(true);
// 			$mail->Body = $str_career_bdy;*/
// $MAIL_HOST       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
// $MAIL_PORT       = 2525;                   // set the SMTP port for the server
// $MAIL_USER_NAME  = "enquiry-bengalurutechsummit";  // username
// $MAIL_PASS		 = "Enq@ui2ry@be";            // password

// // $mail             = new PHPMailer();
// // $mail->IsSMTP(); // telling the class to use SMTP
// $mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
// // 1 = errors and messages
// // 2 = messages only
// $mail->SMTPAuth   = true;					// enable SMTP authentication
// //$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
// $mail->Host       = $MAIL_HOST;				// sets  as the SMTP server
// $mail->Port       = $MAIL_PORT;				// set the SMTP port for the server
// $mail->Username   = $MAIL_USER_NAME;		// username
// $mail->Password   = $MAIL_PASS;				// password

// $mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
// $mail->Subject    = $str_career;
// $body = $str_career_bdy;
// $mail->MsgHTML($body);
// foreach ($ENQUIRY_RECIPIENTS_USER_MAIL as $emailid) {
// 	$mail->AddAddress($emailid);
// 	if (!$mail->Send()) {
// 	}
// 	$mail->clearAddresses();
// }

// elastic_mail_frm($str_career, $str_career_bdy, $ENQUIRY_RECIPIENTS_USER_MAIL, "enquiry@bengalurutechsummit.com");
elastic_mail_frm($str_career, $str_career_bdy, $USER_MAIL, "enquiry@bengalurutechsummit.com");

// /* echo "$enq_mail_msg_admin<br />";
// 	 echo "<br />$str_career_bdy";
// 	 exit; */

// // echo "hii";

echo "<script language='javascript'>window.location='roadshow_confirmation.php?dele_typ=$name&en=$eventName';</script>";
exit;

<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
	session_start();
	
	require "includes/form_constants_both.php";
	
	$en = '';
	$eventName = 'BengaluruITE.BIZ';
	$event_name = 'Bangalore IT';
	if($sector == 'Bio Technology') {
		$en = '1';
		$eventName = 'Bengaluru INDIA BIO';
		$event_name = 'Bangalore INDIA BIO';
		//$EVENT_WEBSITE_LINK = 'http://www.bengaluruindiabio.in/';
	}

		if (($_POST["vercode"] != $_SESSION["vercode_enq"]) || ($_SESSION["vercode_enq"] == '')) {
			session_destroy();
			echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
			echo "<script language='javascript'>window.location = ('enquiry.php?en=" . $en . "');</script>";
			exit;
		}
	

	require "dbcon_open.php";
	//require "class.phpmailer.php";
	
	
	$name          = @$_POST['name'];
	//$name = str_replace(" ", "", $name);
	$fone       = @$_POST['fone'];
	$ddate         = date("d-M-Y");
	$ttime         = date("H:i:s A");
	$email         = @$_POST['email'];
		
	//if(($name == "")  ||  ($company == "")  ||  ($addr == ""))
	if (($name == "") || ($email == "") ||($fone == "")|| $event_name == '') {
		echo "<script language='javascript'>alert('Please Enter Required Details.');</script>";
		echo "<script language='javascript'>document.location = ('enquiry.php?en=" . $en . "');</script>";
		exit();
	}
	
	
		//------------------------------------------------- Capturing enquiry fields ------------------------------------------
	
	if (!empty($_POST['fone'])) {
		$fone = '+' . $_POST['foneCountryCode'] . "-" . $_POST['fone'];
	}

	$sql = "SELECT * FROM $EVENT_DB_FORM_FREE_CONTEST WHERE reg_id='".$_SESSION['vercode_enq'] ."'";
	$res = mysqli_query($link,$sql);
	$res = mysqli_fetch_assoc($res);

	if ( !empty($_POST['name']) && !empty($_POST['email']) && empty($res)) {
		mysqli_query($link,"insert into $EVENT_DB_FORM_FREE_CONTEST (reg_title, reg_name, reg_phone, reg_email, reg_create_date, reg_create_time, reg_id) values('$_POST[title]', '$_POST[name]', '$fone', '$email','$ddate', '$ttime', '$_SESSION[vercode_enq]')") or die(mysql_error("cant insert"));
	}
	
	
		$temp_p_email = $email;
		$temp_p_name = $name;

		require 'class.phpmailer.php';
		require "contest_emailer_admin.php";	
		
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "72.9.105.77"; // SMTP server
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "72.9.105.77";      // sets  as the SMTP server
	$mail->Port       = 587;                   // set the SMTP port for the server
	$mail->Username   = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
	$mail->Password   = "dcpl5555";   

	$mail->SMTPAuth   = true;					// enable SMTP authentication
	$mail->SMTPSecure = "tls";                // sets the prefix to the servier
	$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the server
	$mail->Username   = "enquiry-bengalurutechsummit";  // username
	$mail->Password   = "Enq@ui2ry@be";		         // password
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
	
	$Subject = "New Free Delegate Contest Registration on ". $EVENT_NAME . ' ' . $EVENT_YEAR ;
	if($sector == 'Bio Technology') {
		$Subject = "New Free Delegate Contest Registration on " . $EVENT_NAME . ' ' . $EVENT_YEAR;
	}
	$mail->Subject    = $Subject;
	$mail->MsgHTML($contest_mail_msg_admin);

	$recipients = array('devyani@axisvantage.com','ambika.kiran@mmactiv.com','test.interlinks@gmail.com');
	foreach($recipients as $emailid) {
		$mail->AddAddress($emailid);
		if(!$mail->Send()) {
			
		}
		$mail->clearAddresses();
	}

	echo "<script language='javascript'>window.location='free-contest3.php?en=$event_name';</script>";
	exit;
?>
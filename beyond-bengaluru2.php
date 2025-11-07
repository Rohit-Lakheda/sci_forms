<?php 
	session_start();
	require("includes/form_constants_both.php");
	
	if (empty($_SESSION["vercode_spkr_reg"]) || ($_POST["vercode"] != $_SESSION["vercode_spkr_reg"])) {
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		echo "<script language='javascript'>window.location = 'beyond-bengaluru.php';</script>";
		exit;
	}
	
	//print_r($_POST);exit;
	require "dbcon_open.php";
	$rs = @$_GET['rs'];//check updatestatus
	
	$add_date = date("Y-m-d H:i:s");
	
	$sector = $_POST['sector'];
	$title = $_POST['title'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$desig = $_POST['desig'];
	$org = $_POST['org'];
	$email = $_POST['email'];
	$mob_cntry_code = $_POST['mob_cntry_code'];
	$mob = $_POST['mob'];
	$city = $_POST['city'];
	$reg_id = $_SESSION["vercode_spkr_reg"];
	
	if( ($sector == "") || ($title == "") || ($fname == "") || ($lname == "") || ($desig == "") || ($org == "")|| ($email == "") || ($mob_cntry_code == "") || ($mob == "")){				
		echo "<script language='javascript'> alert('Please Enter Required Details');</script>";					
		echo "<script language='javascript'> window.location =('beyond-bengaluru.php');</script>";
		exit();
	}
	$reg_id = $_SESSION['vercode_spkr_reg'];
	mysqli_query($link,"INSERT INTO $EVENT_DB_FORM_BEYOND_BENG_REG(sector,title,fname,lname,desig,org,email,mob_cntry_code,mob,created_at, reg_id,city) 
	VALUES ('$sector','$title','$fname','$lname','$desig','$org','$email','$mob_cntry_code','$mob','$add_date','$reg_id','$city')")or die(mysqli_error($link));
	
	$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_BEYOND_BENG_REG . " WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
	$res = $qr_gt_user_data_ans_row;
	
	require 'class.phpmailer.php';
	require 'emailer_beyond_beng_reg.php';
	//echo $mail_body;exit;
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
	
	$Subject = "Thank you for Speaker registration on ". $EVENT_NAME . ' ' . $EVENT_YEAR ;
	if($sector == 'Bio Technology') {
		$Subject = "Thank you for Speaker registration on " . $EVENT_NAME . ' ' . $EVENT_YEAR;
	}
	$mail->Subject    = $Subject;
	$mail->MsgHTML($mail_body);
	$recipients = array('test.interlinks@gmail.com', '', 'ambika.kiran@mmactiv.com','',$res['email']);
	//$recipients = array('','test.interlinks@gmail.com');
	/* foreach($recipients as $emailid) {
		$mail->AddAddress($emailid);
		if(!$mail->Send()) {
		}
		$mail->clearAddresses();
	} */
	elastic_mail("Thank you for Registering with Beyond Bengaluru - Delegate Registration Form on " . $EVENT_NAME . " " . $EVENT_YEAR, $mail_body, $recipients);
	//exit;
	$nm = $title . ' ' . $fname . ' ' . $lname;
	echo "<script language='javascript'>window.location = ('beyond-bengaluru3.php?nm=$nm');</script>";
	exit;
?>
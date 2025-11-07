<?php 
	session_start(); 
	//print_r($_POST);echo "<br>";
	
	$reg_id = $_SESSION['vercode_jml'];
	if (!isset($_SESSION['vercode_jml']) || empty($_SESSION['vercode_jml']) || $_SESSION['vercode_jml'] == "") 
	{
		unset($_SESSION['vercode_jml']);
		echo "<script language='javascript'>alert('Verification Image Mismatched');</script>";
		echo "<script language='javascript'>window.location = ('join_mailing_list.php');</script>";
		exit;
	}
	
	if( (@$_POST['name'] == "" ) ||  (@$_POST['email'] == "" ) ||  (@$_POST['org'] == "" ) || (@$_POST['desig'] == "" )  || (@$_POST['city'] == "" ) )
	{
		echo "<script language='javascript'>alert('Error in Registration. Please Reregister.');</script>";
		echo "<script language='javascript'> window.location =('join_mailing_list.php');</script>";
		exit();	
	}

	$name = @$_POST['name'];
	$email = @$_POST['email'];
	$org = @$_POST['org'];
	$desig = @$_POST['desig'];
	$city = @$_POST['city'];
	$foneCountryCode = @$_POST['foneCountryCode'];
	$fone = @$_POST['fone'];
$eventName="Bangalore IT";
	require "dbcon_open.php";
	require "includes/form_constants.php";
	
	$target_path_lead_auth_cv = "";
	$target_path_abstract = "";
	
	$temp_dt = date("Y-m-d");
	$temp_dt2 = date("d-M-Y");
	$temp_tm_1 = date("H:i:s A");

	$temp_contact_no = $foneCountryCode.'-'.$fone;

	mysqli_query($link,"INSERT INTO $JN_MA_LST_TBL_NAME (name, desig, org, city, email, contact_no, ddate, ttime, reg_id, event_name, event_year) VALUES ('$name', '$desig', '$org', '$city', '$email', '$temp_contact_no', '$temp_dt', '$temp_tm_1', '$_SESSION[vercode_jml]', '$eventName', '$EVENT_YEAR')") or die(mysqli_error($link));

//---------------------------------------------------------mail to Admin-----------------------------------------------------
	require "emailer_admin_join_mailinglist.php";	
	require "class.phpmailer.php";	
	/*$mail = new PHPMailer();
	$mail->IsSMTP(); 									// telling the class to use SMTP
	$mail->IsHTML(true);
	$mail->Host = "localhost"; 							// SMTP server
	$mail->From = $EVENT_ENQUIRY_EMAIL;
	$mail->FromName = $ENQUIRY_FROM_NAME_ADMIN_MAIL;
	$recipients = $JN_MA_LST_RECIPIENTS_ADMIN_MAIL;
	$mail->Subject = $JN_MA_LST_FROM_SUBJECT_ADMIN_MAIL;	
	$mail->Body = $email_admin_prp_sub;
	$mail->WordWrap = 50;*/
	
	
	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	//$mail->Host       = "72.9.105.77"; // SMTP server
	$mail->SMTPDebug  = 0;						
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
	$mail->Host       = $MAIL_HOST;				// sets  as the SMTP server
	$mail->Port       = $MAIL_PORT;				// set the SMTP port for the server
	$mail->Username   = $MAIL_USER_NAME;		// username
	$mail->Password   = $MAIL_PASS;				// password
			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $ENQUIRY_FROM_NAME_ADMIN_MAIL);
	$mail->Subject    = $JN_MA_LST_FROM_SUBJECT_ADMIN_MAIL;
	$mail->MsgHTML($email_admin_prp_sub);
	$recipients = $JN_MA_LST_RECIPIENTS_ADMIN_MAIL;
	foreach($recipients as $email_id)
	{
		$mail->AddAddress($email_id);		
		if(!$mail->Send())
		{
		   
			
		  
		}
		$mail->clearAddresses();
	} 
	
		
//-------------------------------------------------End mail to Admin --------------------------------------------------------
	
//--------------------------------------------------- mail to client --------------------------------------------------------
	require "emailer_client_join_mailing_list.php";
	/*$mail = new PHPMailer();
	$mail->IsSMTP(); 									// telling the class to use SMTP
	$mail->IsHTML(true);
	$mail->Host = "localhost"; 							// SMTP server
	$mail->From = $EVENT_ENQUIRY_EMAIL;
	$mail->FromName = $ENQUIRY_FROM_NAME_ADMIN_MAIL;
	$recipients = array($email,'', 'test.interlinks@gmail.com');
	$mail->Subject = $JN_MA_LST_FROM_SUBJECT_ADMIN_MAIL;	
	$mail->WordWrap = 50;
	$mail->Body = $email_client_prp_sub;*/
		
	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	//$mail->Host       = "72.9.105.77"; // SMTP server
	$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
												// 1 = errors and messages
												// 2 = messages only
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
	$mail->Host       = $MAIL_HOST;				// sets  as the SMTP server
	$mail->Port       = $MAIL_PORT;				// set the SMTP port for the server
	$mail->Username   = $MAIL_USER_NAME;		// username
	$mail->Password   = $MAIL_PASS;				// password
			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $ENQUIRY_FROM_NAME_ADMIN_MAIL);
	$mail->Subject    = $JN_MA_LST_FROM_SUBJECT_USER_MAIL;
	$mail->MsgHTML($email_client_prp_sub);
	$recipients = array('',$email,'', 'test.interlinks@gmail.com');
	foreach($recipients as $email_id)
	{
		$mail->AddAddress($email_id);		
		if(!$mail->Send())
		{
		 	
		}
		$mail->clearAddresses();
	}
	
	/*echo "$email_client_prp_sub<br />";
	echo "$email_admin_prp_sub<br />";
	exit;*/
	//--------------------------------------------------- End mail to client -----------------------------------------------------
	echo "<script language='javascript'> window.location =('join_mailing_list3.php?nm=DRF456DFF7G');</script>";
?>
<?php 
 
 
	session_start(); 
	if(($_POST["vercode"] != $_SESSION["vercode_raf"]) || ($_SESSION["vercode_raf"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Try After some time');</script>";
		echo "<script language='javascript'>window.location = ('refer-friend.php');</script>";
		exit;
	}

	if( (@$_POST['s_name'] == "" ) ||  (@$_POST['s_email'] == "" ) ||  (@$_POST['r_name'] == "" ) || (@$_POST['r_email'] == "" )  || (@$_POST['msg'] == "" ) )
	{
		echo "<script language='javascript'>alert('Error in Process. Please Try Again.');</script>";
		echo "<script language='javascript'> window.location =('refer-friend.php');</script>";
		exit();	
	}
 
	
	require "dbcon_open.php";
	require "includes/form_constants.php";
	
	$temp_reg_id = $_SESSION["vercode_raf"];
	$s_name = @$_POST['s_name'];
	$s_email = @$_POST['s_email'];
	$r_name = @$_POST['r_name'];
	$r_email = @$_POST['r_email'];
	$msg = @$_POST['msg'];
	$link = "mailto:".$s_email;
	$dt= date("Y-m-d");
	$tm = date("H:i:s A");	
	
	$temp_dt = date("Y-m-d");
	$temp_dt2 = date("d-M-Y");
	$temp_tm_1 = date("H:i:s A");
	

	mysqli_query($link,"INSERT INTO $RFR_FRND_TBL_NAME (sender_name, sender_email, friend_name, friend_email, sender_msg, ddate, ttime,reg_id) VALUES('$s_name', '$s_email', '$r_name', '$r_email', '$msg', '$dt', '$tm', '$temp_reg_id')") or die(mysqli_error($link));

//---------------------------------------------------------mail to Admin-----------------------------------------------------
	require "class.phpmailer.php";
	require "friend_request_emailer_admin.php";

	$MAIL_HOST="mail.bengalurutechsummit.com";
	$MAIL_PORT=25;
	$MAIL_USER_NAME="enquiry-bengalurutechsummit";
	$MAIL_PASS="Enq@ui2ry@be";

		$recipients = $RFR_FRND_RECIPIENTS_ADMIN_MAIL;
	
	
		
	/*$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $RFR_FRND_FROM_NAME_USER_MAIL;
	$mail->From = $RFR_FRND_FROM_EMAIL_USER_MAIL;
	//$recipients = array('', 'test.interlinks@gmail.com');
	$mail->Subject = $RFR_FRND_FROM_SUBJECT_ADMIN_MAIL;
	$mail->IsHTML(true);
	$mail->Body = $str_mail_refer_friend_admin;*/


	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	//$mail->Host       = "72.9.105.77"; // SMTP server
	$mail->SMTPDebug  = 0;						
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	$mail->SMTPSecure = "tls";                // sets the prefix to the servier
	$mail->Host       = $MAIL_HOST;				// sets  as the SMTP server
	$mail->Port       = $MAIL_PORT;				// set the SMTP port for the server
	$mail->Username   = $MAIL_USER_NAME;		// username
	$mail->Password   = $MAIL_PASS;				// password
			
	$mail->SetFrom($RFR_FRND_FROM_EMAIL_USER_MAIL, $RFR_FRND_FROM_NAME_USER_MAIL);
	$mail->Subject    = $RFR_FRND_FROM_SUBJECT_ADMIN_MAIL;
	$mail->MsgHTML($str_mail_refer_friend_admin);
	foreach($recipients as $emailid)
	{
		$mail->AddAddress($emailid);		
		if(!$mail->Send())
		{
		   
		}
		$mail->clearAddresses();
	}
		
	//echo $str_mail_refer_friend_admin."<br />";
	
//-------------------------------------------------End mail to Admin --------------------------------------------------------
	
//--------------------------------------------------- mail to client --------------------------------------------------------

	
	require "friend_request_emailer_user.php";
	$RFR_FRND_RECIPIENTS_USER_MAIL[] = "";
	$RFR_FRND_RECIPIENTS_USER_MAIL[] = $r_email;
	$recipients = $RFR_FRND_RECIPIENTS_USER_MAIL;
	
		
	/*$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $RFR_FRND_FROM_NAME_USER_MAIL;
	$mail->From = $RFR_FRND_FROM_EMAIL_USER_MAIL;
	//$recipients = array('', 'test.interlinks@gmail.com');	
	$mail->Subject = $s_name . ' ' . $RFR_FRND_FROM_SUBJECT_USER_MAIL;
	$mail->IsHTML(true);
	$mail->Body = $str_mail_refer_friend_user;*/

	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "72.9.105.77"; // SMTP server
	$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
												// 1 = errors and messages
												// 2 = messages only
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	$mail->SMTPSecure = "tls";                // sets the prefix to the servier
	$mail->Host       = $MAIL_HOST;				// sets  as the SMTP server
	$mail->Port       = $MAIL_PORT;				// set the SMTP port for the server
	$mail->Username   = $MAIL_USER_NAME;		// username
	$mail->Password   = $MAIL_PASS;				// password
			
	$mail->SetFrom($RFR_FRND_FROM_EMAIL_USER_MAIL, $RFR_FRND_FROM_NAME_USER_MAIL);
	$mail->Subject    = $s_name . ' ' . $RFR_FRND_FROM_SUBJECT_USER_MAIL;
	$mail->MsgHTML($str_mail_refer_friend_user);
	foreach($recipients as $emailid)
	{
		$mail->AddAddress($emailid);		
		if(!$mail->Send())
		{
		   
		}
		$mail->clearAddresses();
	}
		
	//echo $str_mail_refer_friend_user."<br />";
	//exit;
//--------------------------------------------------- End mail to client -----------------------------------------------------
	echo "<script language='javascript'>window.location ='refer-friend3.php?rf=sdf3243sd';</script>";
	echo "<script language='javascript'>window.document ='refer-friend3.php?rf=sdf3243sd';</script>";
	exit;
?>
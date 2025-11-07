<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
	session_start(); 
	if(($_POST["vercode"] != $_SESSION["vercode_rsvp"]) || ($_SESSION["vercode_rsvp"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Enter Verification Code.');</script>";
		echo "<script language='javascript'>window.location = 'rsvp.php';</script>";
		exit;
	}	

	//print_r($_POST); exit;
		
	$emler = @$_POST['enq_emler'];
	if($emler ==""){
		$emler = @$_GET['enq_emler'];
	}

	$title = @$_POST['title'];
	$name = @$_POST["name"];
	$org = @$_POST["org"];
	$desig = @$_POST["desig"];
	$email = @$_POST["email"];
	$mob = @$_POST['cellnoCountryCode']."-".$_POST['mob'];
	//$mob = @$_POST["mob"];
	//$comment = addslashes(@$_POST["comment"]);
	
	if(($name == "") || ($email == "") || ($mob == "") ){
		
		echo "<script language='javascript'>alert('Please Enter Required Information');</script>";
		echo "<script language='javascript'>window.location = 'rsvp.php';</script>";
		exit;
	}
	
	$participant = "";
	
	for($i_pr=1;$i_pr<=5;$i_pr++){
		
		if(@$_POST['pr_'.$i_pr] != '')
		{
			if($participant=="")
			{
				$participant = @$_POST['pr_'.$i_pr];
			}
			else
			{
				$participant .= ",".@$_POST['pr_'.$i_pr];
			}
		}
	
	}
	
	
	
	
	$ses = @$_SESSION["vercode_rsvp"];
	$ddate=date("Y-m-d");
	$ttime=date("H:i:s A");
	
	include "includes/form_constants_both.php";
	require "dbcon_open.php";
		$name = $title." ".$name;
	$qr = mysqli_query($link,"INSERT INTO $RSVP_TBL_NAME(name,org,desig,email,mob,reg_id,participant,ddate,ttime) VALUES('$name','$org','$desig','$email','$mob','$ses','$participant','$ddate','$ttime')") or die(mysqli_error($link));
	
	
	//user
	
	
		require "class.phpmailer_1.php";
		
		//admin 
	
		$temp_p_email = $email;
		$temp_p_name = $name;
		
		require "lunch_emailer_admin.php";
		//echo $enq_rsvp_mail_msg_admin;exit;
		$str_career = $RSVP_FROM_SUBJECT_ADMIN_MAIL;
		$str_career_bdy = $enq_rsvp_mail_msg_admin;
		
		//$RSVP_RECIPIENTS_ADMIN_MAIL = array('', $email,'', 'test.interlinks@gmail.com');
			/*$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;*/

			$mail             = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = "72.9.105.77"; // SMTP server
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
													   // 1 = errors and messages
													  // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "72.9.105.77";      // sets  as the SMTP server
			$mail->Port       = 587;                   // set the SMTP port for the server
			$mail->Username   = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
			$mail->Password   = "dcpl5555";            // password
			
			$mail->SetFrom($temp_p_email, $temp_p_name);
			$mail->Subject = $str_career;
			//$mail->Body = $str_career_bdy;
			//$mail->FromName = 'BengaluruITE.BIZ & Bengaluru INDIA BIO';
			$mail->MsgHTML($str_career_bdy);
			$RSVP_RECIPIENTS_ADMIN_MAIL = array('', $EVENT_ENQUIRY_EMAIL,'', $EVENT_ENQUIRY_EMAIL_2,'', 'vani.faustina@mmactiv.com','', 'bhavya.n@mmactiv.com','', 'test.interlinks@gmail.com');
			foreach($RSVP_RECIPIENTS_ADMIN_MAIL as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   //echo '<br/>###'.$emailid;
				   
				}
				$mail->clearAddresses();
			}
		
		
		
		//exit;
		
		require "lunch_emailer_user.php";
		//echo $enq_rsvp_mail_msg_user;exit;
		$str_career = $RSVP_FROM_SUBJECT_USER_MAIL;	
		$str_career_bdy = $enq_rsvp_mail_msg_user;
		$temp_p_email = $EVENT_ENQUIRY_EMAIL;
		$temp_p_name = $EVENT_NAME." ".$EVENT_YEAR;
		
		$RSVP_RECIPIENTS_USER_MAIL = array('', $email,'', 'test.interlinks@gmail.com');
	
			/*$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;	*/
			$mail             = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = "72.9.105.77"; // SMTP server
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
													   // 1 = errors and messages
													  // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "72.9.105.77";      // sets  as the SMTP server
			$mail->Port       = 587;                   // set the SMTP port for the server
			$mail->Username   = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
			$mail->Password   = "dcpl5555";            // password
			
			$mail->SetFrom($temp_p_email, $temp_p_name);
			$mail->Subject = $str_career;
			//$mail->Body = $str_career_bdy;
			//$mail->FromName = 'BengaluruITE.BIZ & Bengaluru INDIA BIO';
			$mail->MsgHTML($str_career_bdy);
			foreach($RSVP_RECIPIENTS_USER_MAIL as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   
				   
				}
				$mail->clearAddresses();
			}
		
		
		
		
	/*	$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
	
		foreach($RSVP_RECIPIENTS_USER_MAIL as $emailid)
		{
			if(mail($emailid,$str_career,$str_career_bdy,$headers))
			{
				//echo "<br />mail successful : 1<br />";
			}
			else
			{
					//echo "<br />mail failed : 1<br />";
			}
		
		}
		
	*/	
		
	
	/*	$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
		
		
		foreach($RSVP_RECIPIENTS_ADMIN_MAIL as $emailid)
		{
			if(mail($emailid,$str_career,$str_career_bdy,$headers))
			{
				//echo "<br />mail successful : 1<br />";
			}
			else
			{
					//echo "<br />mail failed : 1<br />";
			}
		
		}
	*/	
		
	/*echo $enq_rsvp_mail_msg_user;	
	echo $enq_rsvp_mail_msg_admin;;
	exit; */
	//exit;
	echo "<script language='javascript'>window.location = 'rsvp3.php?nm=$name&enq_emler=rsvp';</script>";	
	exit;
	
	
?>
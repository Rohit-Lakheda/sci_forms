<?php

	session_start(); 
	if(($_POST["vercode"] != $_SESSION["vercode_ae"]) || ($_SESSION["vercode_ae"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Enter Verification Code.');</script>";
		echo "<script language='javascript'>window.location = 'awards-evening.php';</script>";
		exit;
	}
	
	require "includes/form_constants.php";

	//print_r($_POST); exit;
		
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
		echo "<script language='javascript'>window.location = 'awards-evening.php';</script>";
		exit;
	}
	
	$ses = @$_SESSION["vercode_ae"];
	$ddate=date("Y-m-d");
	$ttime=date("H:i:s A");
	
	require "dbcon_open.php";
		$name = $title." ".$name;
	$qr = mysqli_query($link,"INSERT INTO $EVENT_DB_FORM_AWARD_EVENING(name,org,desig,email,mob,reg_id,ddate,ttime) VALUES('$name','$org','$desig','$email','$mob','$ses','$ddate','$ttime')") or die(mysqli_error($link));
	
	
	//user
	
	
		require "class.phpmailer.php";
		
		require "award_emailer_user.php";
		
		
		$str_career_bdy = $enq_rsvp_mail_msg_user;
		$temp_p_email = $EVENT_ENQUIRY_EMAIL;
		$temp_p_name = $EVENT_NAME." ".$EVENT_YEAR;
		
		$RSVP_RECIPIENTS_USER_MAIL = array($email,'test.interlinks@gmail.com');
	
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = 'Thank you for confirmation to attend award evening of the BengaluruITE.BIZ 2016';
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
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
		
	//admin 
	
	$RSVP_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL,'', 'manjunath.reddy@mmactiv.in','', 'jyothi.mahadev@mmactiv.in','','test.interlinks@gmail.com');
		//$RSVP_RECIPIENTS_ADMIN_MAIL = array($email,'test.interlinks@gmail.com');
		$temp_p_email = $email;
		$temp_p_name = $name;
		
		require "award_emailer_admin.php";
		
		$str_career = $RSVP_FROM_SUBJECT_ADMIN_MAIL;
		$str_career_bdy = $enq_rsvp_mail_msg_admin;
		
		
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
			foreach($RSVP_RECIPIENTS_ADMIN_MAIL as $emailid)
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
	echo "<script language='javascript'>window.location = 'awards-evening3.php?nm=$name';</script>";	
	exit;
	
	
?>
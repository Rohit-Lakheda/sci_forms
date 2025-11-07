<?php
 
	session_start(); 
	if(($_POST["vercode"] != $_SESSION["vercode_rsvp"]) || ($_SESSION["vercode_rsvp"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Enter Verification Code.');</script>";
		echo "<script language='javascript'>window.location = 'rsvp_comp_registration.php';</script>";
		exit;
	}
	
	require "includes/form_constants.php";
		
	$emler = @$_POST['enq_emler'];
	if($emler ==""){
		$emler = @$_GET['enq_emler'];
	}

	
	$name = @$_POST["name"];
	$org = @$_POST["org"];
	$desig = @$_POST["desig"];
	$email = @$_POST["email"];
	$mob = @$_POST["mob"];
	$comment = addslashes(@$_POST["comment"]);
	
	if(($name == "") || ($email == "") || ($mob == "") ){
		
		echo "<script language='javascript'>alert('Please Enter Required Information');</script>";
		echo "<script language='javascript'>window.location = 'rsvp_comp_registration.php';</script>";
		exit;
	}
	
	$participant = "";
	
	/*
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
	*/
	
	
	
	
	$ses = @$_SESSION["vercode_rsvp"];
	$ddate=date("Y-m-d");
	$ttime=date("H:i:s A");
	
	require "dbcon_open.php";
		
	$qr = mysqli_query($link,"INSERT INTO $RSVP_COMP_REG_TBL_NAME(name,org,desig,email,mob,reg_id,participant,comment,ddate,ttime,event_identity) VALUES('$name','$org','$desig','$email','$mob','$ses','$participant','$comment','$ddate','$ttime','HubliEvent_2013-10-08')") or die(mysqli_error($link));
	
	
	//user
	
	
		require "class.phpmailer.php";
		
		require "rsvp_emailer_user_comp_registration.php";
		
		$str_career = $RSVP_COMP_REG_FROM_SUBJECT_USER_MAIL;	
		$str_career_bdy = $enq_rsvp_reg_comp_mail_msg_user;
		$temp_p_email = $EVENT_ENQUIRY_EMAIL;
		$temp_p_name = $EVENT_NAME." ".$EVENT_YEAR;
		
		
		$RSVP_COMP_REG_RECIPIENTS_USER_MAIL = array($email,'test.interlinks@gmail.com');
	
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
			foreach($RSVP_COMP_REG_RECIPIENTS_USER_MAIL as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   
				   
				}
				$mail->clearAddresses();
			}
		
		
		
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
	
		foreach($RSVP_COMP_REG_RECIPIENTS_USER_MAIL as $emailid)
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
		
		
		
	//admin 
	
	$RSVP_COMP_REG_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL,$EVENT_ENQUIRY_EMAIL_2,'vinay.kumar@mmactiv.in','test.interlinks@gmail.com','vinay.sagdeo@mmactiv.in','rashmi.singh@mmactiv.in','kaustubh@mmactiv.in','utsav.activ@gmail.com');
		
		$temp_p_email = $email;
		$temp_p_name = $name;
		
		require "rsvp_emailer_admin_comp_registration.php";
		
		$str_career = $RSVP_COMP_REG_FROM_SUBJECT_ADMIN_MAIL;
		$str_career_bdy = $enq_rsvp_reg_comp_mail_msg_admin;
		
		
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
			foreach($RSVP_COMP_REG_RECIPIENTS_ADMIN_MAIL as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   
				   
				}
				$mail->clearAddresses();
			}
		
		
		
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
		
		
		foreach($RSVP_COMP_REG_RECIPIENTS_ADMIN_MAIL as $emailid)
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
		
		
	/*echo $mail_msg;	
	echo $lunch_mail_msg_admin;;
	exit;*/
	
	echo "<script language='javascript'>window.location = 'rsvp_3_comp_registration.php?nm=$name&enq_emler=rsvp';</script>";	
	exit;
	
	
?>
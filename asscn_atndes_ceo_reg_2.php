<?php
  
	session_start(); 
	if(($_POST["vercode"] != $_SESSION["vercode_asscn_atndes_ceo"]) || ($_SESSION["vercode_asscn_atndes_ceo"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Enter Verification Code.');</script>";
		echo "<script language='javascript'>window.location = 'asscn_atndes_ceo_reg.php';</script>";
		exit;
	}
	
	$asscn_atndes_ceo_reg_location = @$_REQUEST['asscn_atndes_ceo_reg_city'];
	
	$name = @$_POST["name"];	
	$org = @$_POST["org"];
	$desig = @$_POST["desig"];
	$email = @$_POST["email"];
	$mob = @$_POST["mob"];
	$comment = addslashes(@$_POST["comment"]);
	$assoc_name = addslashes(@$_POST['assoc_name']);
	
	if(($name == "") || ($email == "") || ($mob == "") || ($assoc_name == "") ){
		
		echo "<script language='javascript'>alert('Please Enter Required Information');</script>";
		echo "<script language='javascript'>window.location = 'asscn_atndes_ceo_reg.php';</script>";
		exit;
	}
	
	
	require "includes/form_constants.php";
		
	$emler = @$_POST['enq_emler'];
	if($emler ==""){
		$emler = @$_GET['enq_emler'];
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
	
	
	
	
	$ses = @$_SESSION["vercode_asscn_atndes_ceo"];
	$ddate=date("Y-m-d");
	$ttime=date("H:i:s A");
	$asscn_atndes_ceo_reg_identity = $EVENT_NAME." ".$EVENT_YEAR." Association attendees at CEO Conclave.";
	$asscn_atndes_ceo_reg_location = @$_REQUEST['asscn_atndes_ceo_reg_city'];
	
	
	require "dbcon_open.php";
		
	$qr = mysqli_query($link,"INSERT INTO $ASSCN_ATNDES_CEO_REG_TBL_NAME(name,org,desig,email,mob,reg_id,participant,comment,ddate,ttime,ceo_reg_identity,ceo_reg_location,ceo_reg_status,event_year,know_from_src) VALUES('$name','$org','$desig','$email','$mob','$ses','$participant','$comment','$ddate','$ttime','$asscn_atndes_ceo_reg_identity','$asscn_atndes_ceo_reg_location','Confirm','2013','$assoc_name')") or die(mysqli_error($link));
	
	
	//user
	
	
		require "class.phpmailer.php";
		
		require "asscn_atndes_ceo_reg_emailer_user.php";
		
		$str_career = $ASSCN_ATNDES_CEO_REG_FROM_SUBJECT_USER_MAIL;	
		$str_career_bdy = $enq_ceo_mail_msg_user;
		$temp_p_email = $EVENT_ENQUIRY_EMAIL;
		$temp_p_name = $EVENT_NAME." ".$EVENT_YEAR;
		
		
		$ASSCN_ATNDES_CEO_REG_RECIPIENTS_USER_MAIL = array($email,'test.interlinks@gmail.com');
	
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
			foreach($ASSCN_ATNDES_CEO_REG_RECIPIENTS_USER_MAIL as $emailid)
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
	
		foreach($ASSCN_ATNDES_CEO_REG_RECIPIENTS_USER_MAIL as $emailid)
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
	
	$ASSCN_ATNDES_CEO_REG_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL,$EVENT_ENQUIRY_EMAIL_2,'tabasum.mmactiv@gmail.com','test.interlinks@gmail.com','kaustubh.mmactiv@gmail.com','anamikammactiv@gmail.com');
	
		$temp_p_email = $email;
		$temp_p_name = $name;
		
		require "asscn_atndes_ceo_reg_emailer_admin.php"; 
		
		$str_career = $ASSCN_ATNDES_CEO_REG_FROM_SUBJECT_ADMIN_MAIL;
		$str_career_bdy = $enq_ceo_mail_msg_admin;
		
		
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
			foreach($ASSCN_ATNDES_CEO_REG_RECIPIENTS_ADMIN_MAIL as $emailid)
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
		
		
		foreach($ASSCN_ATNDES_CEO_REG_RECIPIENTS_ADMIN_MAIL as $emailid)
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
	
	echo "<script language='javascript'>window.location = 'asscn_atndes_ceo_reg_3_enq.php?nm=$name&enq_emler=ceo&ceo_reg_city=$ceo_reg_location';</script>";	
	exit;
	
	
?>
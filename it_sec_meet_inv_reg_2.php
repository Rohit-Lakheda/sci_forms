<?php
  
	session_start(); 
	if(($_POST["vercode"] != $_SESSION["vercode_it_sec_meet_inv_reg"]) || ($_SESSION["vercode_it_sec_meet_inv_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Enter Verification Code.');</script>";
		echo "<script language='javascript'>window.location = 'it_sec_meet_inv_reg.php';</script>";
		exit;
	}
	
	$IT_SEC_MEET_INV_REG_location = @$_REQUEST['it_sec_meet_inv_reg_city'];
	
	$name = @$_POST["name"];	
	$org = @$_POST["org"];
	$desig = @$_POST["desig"];
	$email = @$_POST["email"];
	$mob = @$_POST["mob"];
	$comment = addslashes(@$_POST["comment"]);
	$assoc_name = addslashes(@$_POST['assoc_name']);
	
	if(($name == "") || ($email == "") || ($mob == "") ){
		
		echo "<script language='javascript'>alert('Please Enter Required Information');</script>";
		echo "<script language='javascript'>window.location = 'it_sec_meet_inv_reg.php';</script>";
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
	
	
	
	
	$ses = @$_SESSION["vercode_it_sec_meet_inv_reg"];
	$ddate=date("Y-m-d");
	$ttime=date("H:i:s A");
	$IT_SEC_MEET_INV_REG_identity = $EVENT_NAME." ".$EVENT_YEAR." secretaries meet.";
	$IT_SEC_MEET_INV_REG_location = @$_REQUEST['it_sec_meet_inv_reg_city'];
	
	
	require "dbcon_open.php";
		
	$qr = mysqli_query($link,"INSERT INTO $IT_SEC_MEET_INV_REG_TBL_NAME(name,org,desig,email,mob,reg_id,participant,comment,ddate,ttime,reg_status,know_from_src,event_year) VALUES('$name','$org','$desig','$email','$mob','$ses','$participant','$comment','$ddate','$ttime','Confirm','$assoc_name','$EVENT_YEAR')") or die(mysqli_error($link));
	
	
	//user
	
	
		require "class.phpmailer.php";
		
		require "it_sec_meet_inv_reg_emailer_user.php";
		
		$str_career = $IT_SEC_MEET_INV_REG_FROM_SUBJECT_USER_MAIL;	
		$str_career_bdy = $enq_ceo_mail_msg_user;
		$temp_p_email = $EVENT_ENQUIRY_EMAIL;
		$temp_p_name = $EVENT_NAME." ".$EVENT_YEAR;
		
		
		$IT_SEC_MEET_INV_REG_RECIPIENTS_USER_MAIL = array($email,'test.interlinks@gmail.com');
	
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
			foreach($IT_SEC_MEET_INV_REG_RECIPIENTS_USER_MAIL as $emailid)
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
	
		foreach($IT_SEC_MEET_INV_REG_RECIPIENTS_USER_MAIL as $emailid)
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
	
	$IT_SEC_MEET_INV_REG_RECIPIENTS_ADMIN_MAIL =  array('',$EVENT_ENQUIRY_EMAIL,'',$EVENT_ENQUIRY_EMAIL_2,'','test.interlinks@gmail.com','','kaustubh.patil@mmactiv.in','','sagdeo.mmactiv@gmail.com');
	
		$temp_p_email = $email;
		$temp_p_name = $name;
		
		require "it_sec_meet_inv_reg_emailer_admin.php"; 
		
		$str_career = $IT_SEC_MEET_INV_REG_FROM_SUBJECT_ADMIN_MAIL;
		$str_career_bdy = $enq_ceo_mail_msg_admin;
		
		
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
			foreach($IT_SEC_MEET_INV_REG_RECIPIENTS_ADMIN_MAIL as $emailid)
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
		
		
		foreach($IT_SEC_MEET_INV_REG_RECIPIENTS_ADMIN_MAIL as $emailid)
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
	
	echo "<script language='javascript'>window.location = 'it_sec_meet_inv_reg_3_enq.php?nm=$name&enq_emler=ceo&ceo_reg_city=$ceo_reg_location';</script>";	
	exit;
	
	
?>
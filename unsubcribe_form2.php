<?php
	
	session_start(); 
	if(($_POST["vercodeusub"] != $_SESSION["vercodeunsub"]) || ($_SESSION["vercodeunsub"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Try After some time');</script>";
		echo "<script language='javascript'>window.location = ('unsubcribe_form1.php');</script>";
		exit;
	}
	
	require "includes/form_constants.php";	
	require "dbcon_open.php";
	require "class.phpmailer.php";
	
	$unsub_email = @$_REQUEST['email1'];
	
	if(@$_POST['unsubscrb_feedback']=="Other"){
		
		$unsubscrbFeedback = @$_POST['unsubscrb_feedback_other'];
	}
	else{
		
		$unsubscrbFeedback = @$_POST['unsubscrb_feedback'];
	}
	
	if($unsub_email != ""){
	
	mysqli_query($link,"INSERT INTO $UNSBCRB_FORM_EVENT_TBL_NAME(name1,email1,unsubcrb_reason,reg_id,event_name,event_year) VALUES('','$unsub_email','$unsubscrbFeedback','{$_SESSION['vercodeunsub']}','$EVENT_NAME','$EVENT_YEAR')") or die(mysqli_error($link));
	
	//admin email		
	$UNSBCRB_FORM_EVENT_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL,'', 'utsav.activ@gmail.com','', 'accounts@mmactiv.in','', 'test.interlinks@gmail.com');
		
		require "unsubcribe_emailer_admin.php";	
		//echo $unsub_emailer_mail_msg_admin;exit;
		$temp_p_email = $unsub_email;
		$temp_p_name = $unsub_email;	
		$str_career = "Unsubscribe Request on " . $EVENT_NAME;
		$str_career_bdy =  $unsub_emailer_mail_msg_admin;
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
		//$UNSBCRB_FORM_EVENT_RECIPIENTS_ADMIN_MAIL =array('sagar.patil@interlinks.in');
		foreach($UNSBCRB_FORM_EVENT_RECIPIENTS_ADMIN_MAIL as $emailid)
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
			
			/*$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server 
			$mail->FromName = $temp_p_name;
			$mail->From = $temp_p_email;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;
			foreach($UNSBCRB_FORM_EVENT_RECIPIENTS_ADMIN_MAIL as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   
				}
				$mail->clearAddresses();
			}
		*/
		//user emails
		
		require "unsubcribe_emailer_user.php";	
		$UNSBCRB_FORM_EVENT_RECIPIENTS_User_MAIL = array('','test.interlinks@gmail.com','',$unsub_email);
		//echo $unsub_emailer_mail_msg_user;exit;
		$temp_p_email = $EVENT_ENQUIRY_EMAIL;
		$temp_p_name = $EVENT_ENQUIRY_EMAIL;	
		$str_career = "Unsubscribe Request Completed on " . $EVENT_NAME;
		$str_career_bdy =  $unsub_emailer_mail_msg_user;
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
		//$UNSBCRB_FORM_EVENT_RECIPIENTS_User_MAIL =array('sagar.patil@interlinks.in');
		foreach($UNSBCRB_FORM_EVENT_RECIPIENTS_User_MAIL as $emailid)
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
		
		
			/*$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server 
			$mail->FromName = $temp_p_name;
			$mail->From = $temp_p_email;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;
			foreach($UNSBCRB_FORM_EVENT_RECIPIENTS_User_MAIL as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   
				}
				$mail->clearAddresses();
			}*/
		 
	}
		 
		
	
	echo "<script language='javascript'>window.location = 'unsubcribe_form3.php';</script>";
	
?>
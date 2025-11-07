<?php
	   
	session_start();   
	if(($_POST["vercodevp"] != $_SESSION["vercodevp"]) || ($_SESSION["vercodevp"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Enter Verification Image.');</script>";
		echo "<script language='javascript'>window.location = 'visitor_pass_form1.php';</script>";
		exit;
	}
	
	$temp_assoc_nm_vp = @$_REQUEST['assoc_nm_vp'];
	
	$email = @$_POST['email'];	 
	if($email == "")
	{
		echo "<script language='javascript'>alert('Please Enter Complete Information');</script>";
		echo "<script language='javascript'>window.location=('visitor_pass_form1.php');</script>";
		exit;
	}
	
	require "includes/form_constants.php";
	
	$reg_id_temp = $_POST["vercodevp"];
	require "dbcon_open.php";
	$chk_no=0;
	$chk_no_id = mysqli_query($link,"SELECT * FROM $VSTR_TBL_NAME WHERE email = '$email'");
	$chk_no = mysqli_num_rows($chk_no_id);
	if($chk_no > 0)
	{
		 echo "<script language='javascript'>alert('Your Email Id is already Registered with us Please try other Email Id');</script>";
		echo "<script language='javascript'>window.location=('visitor_pass_form1.php');</script>";
		exit;
	}
	require "class.phpmailer.php";
	$purpose = "";
	if(@$_POST['purpose1'] != "")
	{
		$purpose = @$_POST['purpose1'];
	}
	if(@$_POST['purpose2'] != "")
	{
		if($purpose != "")
		{
			$purpose = $purpose.", ".@$_POST['purpose2'];
		}
		else
		{
			$purpose = @$_POST['purpose2'];
		}			
	}
	if(@$_POST['purpose3'] != "")
	{
		if($purpose != "")
		{
			$purpose = $purpose.", ".@$_POST['purpose3'];
		}
		else
		{
			$purpose = @$_POST['purpose3'];
		}			
	}
	if(@$_POST['purpose4'] != "")
	{
		if($purpose != "")
		{
			$purpose = $purpose.", ".@$_POST['purpose4'];
		}
		else
		{
			$purpose = @$_POST['purpose4'];
		}			
	}
	if(@$_POST['purpose5'] != "")
	{
		if($purpose != "")
		{
			$purpose = $purpose.", ".@$_POST['purpose5'];
		}
		else
		{
			$purpose = @$_POST['purpose5'];
		}			
	}
	if(@$_POST['purpose6'] != "")
	{
		if($purpose != "")
		{
			$purpose = $purpose.", ".@$_POST['purpose6'];
		}
		else
		{
			$purpose = @$_POST['purpose6'];
		}			
	}
	if(@$_POST['purpose7'] != "")
	{
		if($purpose != "")
		{
			$purpose = $purpose.", ".@$_POST['other_v'];
		}
		else
		{
			$purpose = @$_POST['other_v'];
		}			
	}
	
	
	$know = "";
	if(@$_POST['know1'] != "")
	{
		$know = @$_POST['know1']." - ".@$_POST['association_name'];;
	}
	if(@$_POST['know2'] != "")
	{
		if($know != "")
		{
			$know = $know.", ".@$_POST['know2'];
		}
		else
		{
			$know = @$_POST['know2'];
		}
	}
	if(@$_POST['know3'] != "")
	{
		if($know != "")
		{
			$know = $know.", ".@$_POST['know3'];
		}
		else
		{
			$know = @$_POST['know3'];
		}
	}
	if(@$_POST['know4'] != "")
	{
		if($know != "")
		{
			$know = $know.", ".@$_POST['know4'];
		}
		else
		{
			$know = @$_POST['know4'];
		}
	}
	if(@$_POST['know5'] != "")
	{
		if($know != "")
		{
			$know = $know.", ".@$_POST['know5'];
		}
		else
		{
			$know = @$_POST['know5'];
		}
	}
	if(@$_POST['know6'] != "")
	{
		if($know != "")
		{
			$know = $know.", ".@$_POST['know6'];
		}
		else
		{
			$know = @$_POST['know6'];
		}
	}
	if(@$_POST['know7'] != "")
	{
		if($know != "")
		{
			$know = $know.", ".@$_POST['other_k'];
		}
		else
		{
			$know = @$_POST['other_k'];
		}
	}
	
	if(@$_POST['know8'] != "")
	{
		if($know != "")
		{
			$know = $know.", ".@$_POST['know8'];
		}
		else
		{
			$know = @$_POST['know8'];
		}
	}
	
	if(@$_POST['know9'] != "")
	{
		if($know != "")
		{
			$know = $know.", ".@$_POST['know9'];
		}
		else
		{
			$know = @$_POST['know9'];
		}
	}
	
	if(@$_POST['know10'] != "")
	{
		if($know != "")
		{
			$know = $know.", ".@$_POST['know10'];
		}
		else
		{
			$know = @$_POST['know10'];
		}
	}
	
	if($temp_assoc_nm_vp != ""){
		$know = $temp_assoc_nm_vp.", ".$know;
	}
	
	if( (@$_POST['email'] == "") || ($know == "") || ($purpose == "") || (@$_POST['fname']== "") || (@$_POST['lname'] == "") || (@$_POST['job_title'] == "") || (@$_POST['org'] == "") || (@$_POST['fone'] == ""))
	{
		echo "<script language='javascript'>alert('Please Enter All Required Information.');</script>";
		echo "<script language='javascript'>document.location = 'visitor_pass_form1.php';</script>";
		exit();
	}
	
	$st = $EVENT_EXTENSION_SMALL."VP".$EVENT_YEAR."-";
	$end = "IN";
	$i = 0;
	do
	{
		$no = rand(1, 50000);
		if(strlen($no) == 1)
		{
			$no = "0000".$no;
		}
		if(strlen($no) == 2)
		{
			$no = "000".$no;
		}
		if(strlen($no) == 3)
		{
			$no = "00".$no;
		}
		if(strlen($no) == 4)
		{
			$no = "0".$no;
		}
		$pass_no = $st.$no.$end;
		
		$qry = mysqli_query($link,"SELECT * FROM $VSTR_TBL_NAME WHERE pass_no = '$pass_no'");
		$res_no = mysqli_num_rows($qry);
		if($res_no < 1)
		{
			$i++;			
		} 
		//echo "1";
	}while(!($i == 1));
	
	$sys_ddate = date("Y-d-m");
	$user_ddate = date("d-M-Y"); 
	$ttime = date("H:i:s A");
	
	mysqli_query($link,"INSERT INTO $VSTR_TBL_NAME(title, fname, lname, email, pass_no, job_title, website, org, addr, city, state, country, zip, fone, fax, activity, interest, purpose1, purpose2, purpose3, purpose4, purpose5, purpose6, purpose7, know1, know2, know3, know4, know5, know6, know7, know8, know9, feedback, reg_id, sys_ddate, user_ddate, ttime, event_year) VALUES('$_POST[title]', '$_POST[fname]', '$_POST[lname]', '$email', '$pass_no', '$_POST[job_title]', '$_POST[website]', '$_POST[org]', '$_POST[addr]', '$_POST[city]', '$_POST[state]', '$_POST[country]', '$_POST[zip]', '$_POST[fone]', '$_POST[fax]', '$_POST[org_act]', '$_POST[interest]', '$_POST[purpose1]', '$_POST[purpose2]', '$_POST[purpose3]', '$_POST[purpose4]', '$_POST[purpose5]', '$_POST[purpose6]', '$_POST[other_v]', '$_POST[know1]', '$_POST[know2]', '$_POST[know3]', '$_POST[know4]', '$_POST[know5]', '$_POST[know6]', '$_POST[other_k]', '$_POST[know8]', '$temp_assoc_nm_vp', '$_POST[feedback]', '$reg_id_temp', '$sys_ddate', '$user_ddate', '$ttime', '$EVENT_YEAR')") or die(mysqli_error($link));
	
	
	$qr_vp_d_id = mysqli_query($link,"SELECT * FROM $VSTR_TBL_NAME WHERE reg_id = '$reg_id_temp'")or die(mysqli_error($link));
	$res_vp_d = mysqli_fetch_array($qr_vp_d_id);
	
		
		$VSTR_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL,$EVENT_ENQUIRY_EMAIL_2,'test.interlinks@gmail.com','utsav.activ@gmail.com','vinay.mmactiv@gmail.com');
		
		require "visitor_pass_emailer_admin.php";		
		
		$temp_p_email = @$_POST['email'];
		$temp_p_name = @$_POST['title']." ".@$_POST['fname']." ".@$_POST['lname'];	
		$str_career = $VSTR_FROM_SUBJECT_ADMIN_MAIL;
		$str_career_bdy =  $VSTR_FROM_BODY_ADMIN_MAIL;
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
		
		foreach($VSTR_RECIPIENTS_ADMIN_MAIL as $emailid)
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
		 
		
		
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
			foreach($VSTR_RECIPIENTS_ADMIN_MAIL as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   
				   
				}
				$mail->clearAddresses();
			}
		
	
	
		
		$recipients = array('test.interlinks@gmail.com',$email);
		
		require "visitor_pass_emailer_user.php";
		
		$temp_p_email = $VSTR_FROM_EMAIL_USER_MAIL;
		$temp_p_name = $VSTR_FROM_NAME_USER_MAIL;
		$str_career = $VSTR_FROM_SUBJECT_USER_MAIL;
		$str_career_bdy = $VSTR_FROM_BODY_ADMIN_MAIL;
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
		 
		foreach($recipients as $emailid)
		{
			if(mail($emailid,$str_career,$str_career_bdy,$headers))
			{
				//echo "<br /> $emailid : mail successful : 1<br />"; 
			}
			else
			{
					//echo "<br /> $emailid : mail failed : 1<br />";
			}
		
		}
		
		/*	$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
			foreach($recipients as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				  // echo "<br /> $emailid :mail failed : 2<br />";
				   
				}
				else{
				//	echo "<br /> $emailid : mail successful : 2<br />"; 
				}
				$mail->clearAddresses();
			}
			*/
		
	//exit;
	echo "<script language='javascript'>window.location = 'visitor_pass_form3.php?assoc_nm_vp=$temp_assoc_nm_vp';</script>";
	
?>
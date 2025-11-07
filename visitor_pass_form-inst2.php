<?php
	//ini_set("display_errors", "1");
	//error_reporting(E_ALL);
  
	session_start();  
	require('dbcon_open.php');
	//print_r($_POST); exit;
	if(($_POST["vercodevp"] != $_SESSION["vercodevp"]) || ($_SESSION["vercodevp"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Enter Verification Image.');</script>";
		echo "<script language='javascript'>window.location = 'visitor_pass_form-inst1.php';</script>";
		exit;
	}
	
	$temp_assoc_nm_vp = @$_REQUEST['assoc_nm_vp'];
	if($temp_assoc_nm_vp==""){

		$temp_assoc_nm_vp = "instcollstudmm";
	}
	
	$email = @$_POST['email'];	 
	/* if($email == "")
	{
		echo "<script language='javascript'>alert('Please Enter Complete Information');</script>";
		echo "<script language='javascript'>window.location=('visitor_pass_form-inst1.php');</script>";
		exit;
	} */
	
	require "includes/form_constants_both.php";
	
	$reg_id_temp = $_POST["vercodevp"];
	
	$chk_no=0;
	if(!empty($email)) {
		$chk_no_sql = "SELECT * FROM $VSTR_TBL_NAME WHERE email = '$email' AND sector='$_POST[sector]' AND event_year='$EVENT_YEAR'"; //echo $chk_no_sql;exit;
		$chk_no_id = mysqli_query($link,$chk_no_sql); 
		$chk_no = mysqli_num_rows($chk_no_id); 
		if($chk_no > 0)
		{
			 echo "<script language='javascript'>alert('Your Email Id is already Registered with us Please try other Email Id');</script>";
			echo "<script language='javascript'>window.location=('visitor_pass_form-inst1.php');</script>";
			exit;
		}
	}	

	$enq1 = $purpose1 = $purpose2 = $purpose3 = $purpose4 = $purpose5 = $purpose6 = $purpose7 = $purpose8 = "";
	if(@$_POST['purpose1'] != ""){
		$enq1 = $enq1.@$_POST['purpose1'].",";
		$purpose1 = $_POST['purpose1'];
	}
	
	if(@$_POST['purpose2'] != ""){
		$enq1 = $enq1.@$_POST['purpose2'].",";
		$purpose2 = $_POST['purpose2'];
	}
	
	if(@$_POST['purpose3'] != ""){
		$enq1 = $enq1.@$_POST['purpose3'].",";
		$purpose3 = $_POST['purpose3'];
	}
	
	if(@$_POST['purpose4'] != ""){
		$enq1 = $enq1.@$_POST['purpose4'].",";
		$purpose4 = $_POST['purpose4'];
	}
	
	if(@$_POST['purpose5'] != ""){
		$enq1 = $enq1.@$_POST['purpose5'].",";
		$purpose5 = $_POST['purpose5'];
	}
	
	if(@$_POST['purpose6'] != ""){
		$enq1 = $enq1.@$_POST['purpose6'];	
		$purpose6 = $_POST['purpose6'];
	}
	
	if(@$_POST['purpose7'] != ""){
		$enq1 = $enq1.@$_POST['purpose7'].",";	
		$purpose7 = $_POST['purpose7'];
	}
	
	if(@$_POST['purpose8'] != ""){
		$enq1 = $enq1.@$_POST['purpose8']."- ".@$_POST['other_v']." , ";
		$purpose8 = $_POST['purpose8']."- ".@$_POST['other_v'];
	}
	
	$purpose = $enq_str = $enq1;

	//find us dropdown 

	$temp_mda_type = @$_REQUEST['mda_type'];
	if(@$_POST['find_us'] == "Others")
	{
		$know_from = "Others" . '-' . @$_POST['other_txtbx_find_us'];
	}
	else
	{
		$know_from = @$_POST['find_us'];
	}
	
	if(($know_from=="") || ($temp_mda_type !="")){
			$know_from = $know_from.", - ".$temp_mda_type;	
	}
	
	//if( (@$_POST['email'] == "") || ($know_from == "") || ($enq1 == "") || (@$_POST['fname']== "") || (@$_POST['job_title'] == "") || (@$_POST['org'] == "") || (@$_POST['fone'] == ""))
	if( (@$_POST['fname']== "") || (@$_POST['org'] == ""))
	{
		echo "<script language='javascript'>alert('Please Enter All Required Information.');</script>";
		echo "<script language='javascript'>document.location = 'visitor_pass_form-inst1.php';</script>";
		exit();
	}
	$know = $know_from;
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
	
	$fone=$_POST['foneCountryCode'].'-'.$_POST['fone'];

	mysqli_query($link,"INSERT INTO $VSTR_TBL_NAME(title, fname, lname, email, pass_no, job_title, website, org, addr, city, state, country, zip, fone, fax, activity, interest, purpose1, purpose2, purpose3, purpose4, purpose5, purpose6, purpose7, know1, know2, know3, know4, know5, know6, know7, know8, know9, feedback, reg_id, sys_ddate, user_ddate, ttime, event_year, sector) VALUES('$_POST[title]', '$_POST[fname]', '', '$email', '$pass_no', '$_POST[job_title]', '', '$_POST[org]', '', '$_POST[city]', '', '$_POST[country]', '', '$fone', '', '', '', '$_POST[purpose1]', '$_POST[purpose2]', '$_POST[purpose3]', '$_POST[purpose4]', '$_POST[purpose5]', '$_POST[purpose6]', '$_POST[other_v]', '$_POST[know1]', '$_POST[know2]', '$_POST[know3]', '$_POST[know4]', '$_POST[know5]', '$_POST[know6]', '$_POST[other_k]', '$_POST[know8]', '$temp_assoc_nm_vp', '$_POST[feedback]', '$reg_id_temp', '$sys_ddate', '$user_ddate', '$ttime', '$EVENT_YEAR', '$_POST[sector]')") or die(mysqli_error($link));
	

	$qr_vp_d_id = mysqli_query($link,"SELECT * FROM $VSTR_TBL_NAME WHERE reg_id = '$reg_id_temp'")or die(mysqli_error($link));
	$res_vp_d = mysqli_fetch_array($qr_vp_d_id);
	$res= $res_vp_d;

	$cntry= explode("-", str_replace('+', '', $res['fone']));
	$country_code=$cntry[0];
	$phone = $cntry[1];
	
	// call visitor api 
	/*$data = array();
	$data['name']=$res['title'].' '.$res['fname'].' '.$res['lname'];
	$data['email']=$res['email'];
	$data['country_code']=$country_code;
	$data['mobile']=$phone;
	$data['company']= $res['org'];
	$data['designation']= 'Student';
	$data['category_id']= 406;
	$data['print_val']= 'Visitor';
	//$data['booking_id']=$res['pass_no'];
	//callUniversalAPI($data);*/
	$data = array();
	$data['firstName']=$res['fname'];
	$data['lastName']=$res['lname'];
	$data['email']=$res['email'];
	//$data['country_code']=$country_code;
	$data['mobile']=$phone;
	$data['organization']= $res['org'];
	//$data['designation']= $res['job_title'];
	//$data['category_id']= 406;
	//$data['print_val']= 'Visitor';
	//$data['booking_id']=$res['pass_no'];
	//callUniversalAPI($data);
	callWizVisitorAPI($data);


	//$VSTR_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL,'',$EVENT_ENQUIRY_EMAIL_2,'', 'test.interlinks@gmail.com','', '');
	$VSTR_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL,'test.interlinks@gmail.com');
	require "visitor_pass_emailer_admin.php";		
	
	$temp_p_email = @$_POST['email'];
	$temp_p_name = @$_POST['title']." ".@$_POST['fname']." ".@$_POST['lname'];	
	$str_career = $VSTR_FROM_SUBJECT_ADMIN_MAIL;
	$str_career_bdy =  $VSTR_FROM_BODY_ADMIN_MAIL;
	//echo $VSTR_FROM_BODY_ADMIN_MAIL;exit;
		
	/*$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->From = $temp_p_email;
	$mail->FromName = $temp_p_name;
	$mail->Subject = $str_career;
	$mail->IsHTML(true);
	$mail->Body = $str_career_bdy;	*/
	
	require 'class.phpmailer.php';

	$MAIL_HOST       = "72.9.105.77";      // sets  as the SMTP server
	$MAIL_PORT       = 587;                   // set the SMTP port for the server
	$MAIL_USER_NAME  = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
	$MAIL_PASS		 = "dcpl5555";            // password
		
	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
												// 1 = errors and messages
												// 2 = messages only
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	$mail->SMTPSecure = "tls";                // sets the prefix to the servier
	$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the server
	$mail->Username   = "enquiry-bengalurutechsummit";  // username
	$mail->Password   = "Enq@ui2ry@be";				// password
			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
	$mail->Subject    = $str_career ;
	$mail->MsgHTML($str_career_bdy);

	/*$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $EVENT_NAME . ' ' . $EVENT_YEAR;
	$mail->From = $EVENT_ENQUIRY_EMAIL;
	$mail->Subject = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR ;
	$mail->IsHTML(true);
	$mail->Body = $mail_body;*/
	foreach($VSTR_RECIPIENTS_ADMIN_MAIL as $emailid) {
		$mail->AddAddress($emailid);
		if(!$mail->Send()) {//echo '#'.$emailid;
			//echo 'Mailer Error: ' . $mail->ErrorInfo;echo "<br />";
		}
		$mail->clearAddresses();
	}


	/*$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "72.9.105.77"; // SMTP server
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "72.9.105.77";      // sets  as the SMTP server
	$mail->Port       = 587;                   // set the SMTP port for the server
	$mail->Username   = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
	$mail->Password   = "dcpl5555";            // password			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
	$mail->Subject    = $VSTR_FROM_SUBJECT_ADMIN_MAIL;		
	$mail->MsgHTML($VSTR_FROM_BODY_ADMIN_MAIL);

	foreach($VSTR_RECIPIENTS_ADMIN_MAIL as $emailid) {
		$mail->AddAddress($emailid);		
		if(!$mail->Send()) {echo 'Mailer Error: ' . $mail->ErrorInfo;echo "<br /> $emailid :mail failed :1<br />";}
		$mail->clearAddresses();
	}*/
	
	//echo $str_career_bdy;exit;	
	$recipients = array('test.interlinks@gmail.com',$email);
	
	require "visitor_pass_emailer_user.php";
	//require "visitor_emailer_user.php";
	
	$temp_p_email = $VSTR_FROM_EMAIL_USER_MAIL;
	$temp_p_name = $VSTR_FROM_NAME_USER_MAIL;
	$str_career = $VSTR_FROM_SUBJECT_USER_MAIL;
	$str_career_bdy = $VSTR_FROM_BODY_ADMIN_MAIL;
	
	/*$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->From = $temp_p_email;
	$mail->FromName = $temp_p_name;
	$mail->Subject = $str_career;
	$mail->IsHTML(true);
	$mail->Body = $str_career_bdy;*/	
	
	$MAIL_HOST       = "72.9.105.77";      // sets  as the SMTP server
	$MAIL_PORT       = 587;                   // set the SMTP port for the server
	$MAIL_USER_NAME  = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
	$MAIL_PASS		 = "dcpl5555";            // password
		
	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
												// 1 = errors and messages
												// 2 = messages only
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
	$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the server
	$mail->Username   = "enquiry-bengalurutechsummit";  // username
	$mail->Password   = "Enq@ui2ry@be";			// password
			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
	$mail->Subject    = $VSTR_FROM_SUBJECT_USER_MAIL;		
	$mail->MsgHTML($VSTR_FROM_BODY_ADMIN_MAIL);

	/*$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "72.9.105.77"; // SMTP server
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "72.9.105.77";      // sets  as the SMTP server
	$mail->Port       = 587;                   // set the SMTP port for the server
	$mail->Username   = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
	$mail->Password   = "dcpl5555";            // password			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
	$mail->Subject    = $VSTR_FROM_SUBJECT_USER_MAIL;		
	$mail->MsgHTML($VSTR_FROM_BODY_ADMIN_MAIL);*/

	
	foreach($recipients as $emailid)
	{
		$mail->AddAddress($emailid);		
		if(!$mail->Send())
		{
		   //echo 'Mailer Error: ' . $mail->ErrorInfo;echo "<br /> $emailid :mail failed : 2<br />";
		}
		$mail->clearAddresses();
	}
	

	//elastic_mail($VSTR_FROM_SUBJECT_USER_MAIL, $str_career_bdy, $recipients);
	
	//echo $VSTR_FROM_BODY_ADMIN_MAIL;exit;
	echo "<script language='javascript'>window.location = 'visitor_pass_form-inst3.php?assoc_nm_vp=$temp_assoc_nm_vp';</script>";
	exit;
	
?>
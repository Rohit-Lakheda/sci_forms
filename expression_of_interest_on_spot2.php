<?php 
	session_start ();
	$recaptcha = @$_POST['g-recaptcha-response'];
	if (empty($recaptcha)) {
		if (empty($_SESSION["vercode_exp"]) || ($_POST["vercode"] != $_SESSION["vercode_exp"])) {
			session_destroy();
			echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
			echo "<script language='javascript'>window.location = 'expression_of_interest_on_spot.php';</script>";
			exit;
		}
		 
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		echo "<script language='javascript'>window.location = 'expression_of_interest_on_spot.php';</script>";
		exit;
	}
	unset($_POST['g-recaptcha-response']);
	if ((@$_POST ['title'] == "") ||(@$_POST ['fname'] == "") ||(@$_POST ['lname'] == "") ||
		(@$_POST ['org'] == "") ||(@$_POST ['desig'] == "") ||(@$_POST ['email'] == "") ||(@$_POST ['mobile'] == "")) {
		echo "<script language='javascript'>alert('Please Enter All Mandatory fields(marked *).');</script>";
		echo "<script language='javascript'>document.location = 'expression_of_interest_on_spot.php';</script>";
		exit ();
	}
	
	require "includes/form_constants.php";
	require "dbcon_open.php";
	require "class.phpmailer.php";
	
	$creation_date = date ( "Y-m-d H:i:s" );

	if (!empty ( $_POST ['mobile'] )) {
		$_POST ['mobile'] = '+' . $_POST ['cellnoCountryCode'] . "-" . $_POST ['mobile'];
	}
	unset($_POST ['cellnoCountryCode']);
	unset($_POST['cellnoCountryCodeIso']);
	$_POST['creation_date'] = $creation_date;
	$_POST['reg_id'] = $_POST['vercode'];
	unset($_POST['vercode']);
	$fields = $values = '';
	foreach ($_POST as $key=>$value) {
		$fields .= $key . ',';
		$values .= "'" . $value . "',";
	}
	$values = trim($values, ',');
	$fields = trim($fields, ',');
	//print_r($_POST);
	$sql = "INSERT INTO " . $EVENT_DB_FORM_REG_EXPRESSION_OF_INTEREST . "($fields) VALUES($values)";
	//echo $sql;exit;
	mysqli_query($link,$sql);
    
	$temp_p_email = $EVENT_ENQUIRY_EMAIL;
	$temp_p_name = $ENQUIRY_FROM_NAME_USER_MAIL;

	// admin
	require "expression_of_interest_on_spot_emailer_admin.php";
	//echo $enq_mail_msg_admin;exit();
	$mail = new PHPMailer ();
	$mail->IsSMTP (); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $temp_p_name;
	$mail->From = $temp_p_email;
	$mail->Subject = "Expression of interest for registering on spot for " .  $EVENT_NAME." ".$EVENT_YEAR;
	$mail->IsHTML ( true );
	$mail->Body = $enq_mail_msg_admin;
	$receipents = array('', 'test.interlinks@gmail.com','', $EVENT_ENQUIRY_EMAIL, '', 'vinay.kumar@mmactiv.in', '', 'utsav.activ@gmail.com', '', 'bhavya.mmactiv@gmail.com','', $_POST['email']);
	//$receipents = array('', 'test.interlinks@gmail.com', '', 'utsav.activ@gmail.com');
	foreach($receipents as $emailid)
	{
		$mail->AddAddress($emailid);		
		if(!$mail->Send())
		{
		   
		}
		$mail->clearAddresses();
	}
	//exit();
	/* --------------------------------------------------------------------------------------------------------------------------- */
	
	// user
	/*require "expression_of_interest_on_spot_emailer_user.php";
	//echo $enq_emailer_mail_msg_user;exit;
	$receipents = array('', 'test.interlinks@gmail.com','', $_POST['email']);
	$mail = new PHPMailer ();
	$mail->IsSMTP (); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $temp_p_name;
	$mail->From = $temp_p_email;
	$mail->Subject = "Thank you for your expression of interest for registering on spot for " .  $EVENT_NAME." ".$EVENT_YEAR;
	$mail->IsHTML ( true );
	$mail->Body = $enq_emailer_mail_msg_user;
	foreach($receipents as $emailid)
	{
		$mail->AddAddress($emailid);		
		if(!$mail->Send())
		{
		   
		}
		$mail->clearAddresses();
	}*/
	//exit;
	//print_r($_SESSION);exit;
	echo "<script language='javascript'>window.location='expression_of_interest_on_spot3.php';</script>";
	exit ();
?>
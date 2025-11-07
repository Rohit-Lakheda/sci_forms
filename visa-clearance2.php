<?php

// ini_set("display_errors", "1");

error_reporting(E_ALL);

	session_start(); 

	if(($_POST["vercode"] != $_SESSION["vercode_visa"]) || ($_SESSION["vercode_visa"]==''))  

	{ 

    	session_destroy();

		echo "<script language='javascript'>alert('Please enter valid verification code.');</script>";

		echo "<script language='javascript'>window.location = 'visa-clearance.php';</script>";

		exit;

	}	

	//print_r($_POST); exit;

	include "form_includes/form_constants_both.php";

	require "dbcon_open.php";



	$org_name = mysqli_real_escape_string($link,htmlspecialchars($_POST['org_name']));

	$passport_name =mysqli_real_escape_string($link,htmlspecialchars($_POST['passport_name']));

	$father_name = mysqli_real_escape_string($link,htmlspecialchars($_POST['father_name']));

	$date_of_birth = mysqli_real_escape_string($link,htmlspecialchars($_POST["date_of_birth"]));

	$place_of_birth = mysqli_real_escape_string($link,htmlspecialchars($_POST["place_of_birth"]));

	$nationality =mysqli_real_escape_string($link,htmlspecialchars( $_POST["nationality"]));

	$passport_number = mysqli_real_escape_string($link,htmlspecialchars($_POST["passport_number"]));

	$date_of_issue =mysqli_real_escape_string($link,htmlspecialchars( $_POST["date_of_issue"]));

	$place_of_issue = mysqli_real_escape_string($link,htmlspecialchars($_POST["place_of_issue"]));

	$date_of_expiry = mysqli_real_escape_string($link,htmlspecialchars($_POST["date_of_expiry"]));

	$email = mysqli_real_escape_string($link,htmlspecialchars($_POST["email"]));

	$addr1 = mysqli_real_escape_string($link,htmlspecialchars($_POST["addr1"]));

	$addr2 = mysqli_real_escape_string($link,htmlspecialchars($_POST["addr2"]));

	$city = mysqli_real_escape_string($link,htmlspecialchars($_POST["city"]));

	$state = mysqli_real_escape_string($link,htmlspecialchars($_POST["state"]));

	$country = mysqli_real_escape_string($link,htmlspecialchars($_POST["country"]));

	$pin =mysqli_real_escape_string($link,htmlspecialchars( $_POST["pin"]));

	$mobile = mysqli_real_escape_string($link,htmlspecialchars($_POST['mobileCountryCode']))."-".mysqli_real_escape_string($link,htmlspecialchars($_POST['mobile']));

	$designation =mysqli_real_escape_string($link,htmlspecialchars( $_POST["designation"]));

	$entry_date = mysqli_real_escape_string($link,htmlspecialchars($_POST["entry_date"]));

	$exit_date = mysqli_real_escape_string($link,htmlspecialchars($_POST["exit_date"]));

	

	if(empty($org_name) &&empty($passport_name) && empty($father_name) && empty($date_of_birth) && empty($place_of_birth) && empty($nationality) &&

			empty($passport_number) && empty($date_of_issue) && empty($place_of_issue) && empty($date_of_expiry) && empty($email) && 

			empty($addr1) && empty($city) && empty($state) && empty($country) && empty($pin) && empty($mobile) && empty($designation) && empty($entry_date) && empty($exit_date)){

		echo "<script language='javascript'>alert('Please enter Required Information');</script>";

		echo "<script language='javascript'>window.location = 'visa-clearance.php';</script>";

		exit;

	}

	

	$reg_id = $_SESSION["vercode_visa"];

	$reg_date = date("Y-m-d H:i:s");

	

	$sql = "INSERT INTO $EVENT_DB_FORM_VISA_CLEARANCE(passport_name,father_name,date_of_birth,place_of_birth,nationality,passport_number,date_of_issue,place_of_issue,date_of_expiry,mobile,email,addr1,addr2,city,state,country,pin,reg_id,reg_date,org_name,designation,entry_date,exit_date) VALUES('$passport_name','$father_name','$date_of_birth','$place_of_birth','$nationality','$passport_number','$date_of_issue','$place_of_issue','$date_of_expiry','$mobile','$email','$addr1','$addr2','$city','$state','$country','$pin','$reg_id','$reg_date','$org_name','$designation','$entry_date','$exit_date')";

	//echo $sql;

	mysqli_query($link,$sql) or die(mysqli_error($link));

	//exit;

	//user

	// require "class.phpmailer.php";

		

	require "visa_clearance_emailer_user.php";

	//echo $visa_mail_msg_user;exit;

	$str_career_bdy = $visa_mail_msg_user;

	$temp_p_email = $EVENT_ENQUIRY_EMAIL;

	$temp_p_name = $EVENT_NAME." ".$EVENT_YEAR;

		



	$recipients = array( $email,'test.interlinks@gmail.com');

	//$recipients = array('test.interlinks@gmail.com');

	/*foreach($recipients as $emailid) {

		$mail->AddAddress($emailid);		

		if(!$mail->Send()) {

			//echo '<br/>%%%%'.$emailid;

		}

		$mail->clearAddresses();

	}*/

	elastic_mail("Thank you for Visa Clearance Registration on ".$EVENT_NAME." ".$EVENT_YEAR, $visa_mail_msg_user, $recipients);



	//admin 

	$temp_p_email = $email;

	$temp_p_name = $passport_name;

	

	require "visa_clearance_emailer_admin.php";

	//echo $visa_mail_msg_admin;exit;

	$str_career_bdy = $visa_mail_msg_admin;

		

	// $recipients = array($EVENT_ENQUIRY_EMAIL,'gerard.bhagwanthraj@mmactiv.com','anjali.nair@mmactiv.com', 'test.interlinks@gmail.com', 'gurunath.angadi@mmactiv.com','ambika.kiran@mmactiv.com');

	$recipients = array('test.interlinks@gmail.com');

	/*foreach($recipients as $emailid) {

		$mail->AddAddress($emailid);		

		if(!$mail->Send()) {

		   //echo '<br/>###'.$emailid;

		}

		$mail->clearAddresses();

	}*/

	elastic_mail($EVENT_NAME." ".$EVENT_YEAR." New Visa Clearance", $visa_mail_msg_admin, $recipients);

	//exit;

	echo "<script language='javascript'>window.location = 'visa-clearance3.php';</script>";	

	exit;

?>
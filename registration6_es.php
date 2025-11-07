<?php
//print_r($_POST);exit;
// ini_set('display_errors', '1');
session_start();
$event_name = 'Bangalore IT';
$en = '';
if (isset($_POST['en']) && !empty($_POST['en'])) {
	$en = '1';
	$event_name = 'Bangalore INDIA BIO';
}
$assoc_name = @$_GET['assoc_name'];
$assoc_name = trim($assoc_name);

if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
	session_destroy();
	echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
	if (!empty($assoc_name)) {
		echo "<script language='javascript'>window.location = 'registration_es.php?en=$en&assoc_name=$assoc_name';</script>";
	} else {
		echo "<script language='javascript'>window.location = 'registration_es.php?en=$en';</script>";
	}
	exit;
}
//print_r($_POST);exit;
require("includes/form_constants_both.php");
require "dbcon_open.php";
$reg_id = mysqli_real_escape_string($link,htmlspecialchars($_SESSION["vercode_reg"]));

ini_set("max_execution_time", "3600");
$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'");
$qr_gt_user_data_ans_no = 0;
$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
if (($qr_gt_user_data_ans_no <= 0) || ($qr_gt_user_data_ans_no == "")) {
	session_destroy();
	mysqli_close($link);
	echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
	if (!empty($assoc_name)) {
		echo "<script language='javascript'>window.location = 'registration_es.php?en=$en&assoc_name=$assoc_name';</script>";
	} else {
		echo "<script language='javascript'>window.location = 'registration_es.php?en=$en';</script>";
	}
	exit;
}

$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'");
$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);

$res1 = $qr_gt_user_data_ans_row;
$res = $res1;

$comp_date = $EVENT_DB_COMP_DATE;
$lmt = $res['sub_delegates'];

function checkEmailMatch($email, $lmt, $ind)
{
	// Iterate through the session emails
	for ($j = 1; $j <= $lmt; $j++) {
		if ($ind == $j)
			continue;
		else {
			if (isset($_POST['email_m' . $j]) && $_POST['email_m' . $j] === $email) {
				return true; // Match found
			}
		}
	}
	return false; // No match found
}

// Array to store unique emails

for ($j = 1; $j <= $lmt; $j++) {

	$emailss = mysqli_real_escape_string($link,htmlspecialchars($_POST['email_m' . $j]));
	$_SESSION['email' . $j] = mysqli_real_escape_string($link,htmlspecialchars($_POST['email_m' . $j]));
	$_SESSION['title' . $j] = mysqli_real_escape_string($link,htmlspecialchars($_POST['title' . $j]));
	$_SESSION['fname' . $j] = mysqli_real_escape_string($link,htmlspecialchars($_POST['fname' . $j]));
	$_SESSION['lname' . $j] = mysqli_real_escape_string($link,htmlspecialchars($_POST['lname' . $j]));
	$_SESSION['job_title' . $j] = mysqli_real_escape_string($link,htmlspecialchars($_POST['job_title' . $j]));
	//$_SESSION ['badge' . $j] = $_POST ['job_title' . $j];
	$_SESSION['cellno' . $j] = mysqli_real_escape_string($link,htmlspecialchars($_POST['cellnoCountryCode' . $j])) . '-' . mysqli_real_escape_string($link,htmlspecialchars($_POST['cellno' . $j]));
	//$_SESSION ['cellno' . $j] = ;
	$_SESSION['catagory' . $j] = mysqli_real_escape_string($link,htmlspecialchars($_POST['catagory' . $j]));
	if (checkEmailMatch($emailss, $lmt, $j)) {
		mysqli_close($link);
		//alert the user that email should be unique for each delegate
		echo "<script language='javascript'>alert('Email should be unique for each delegate.');</script>";
		echo "<script language='javascript'>window.location = ('registration5_es.php?en=" . $en . "&a=" . $a . "&assoc_name=" . $assoc_name . "');</script>";
		exit;
	}


}
//for 1 to lmt check that email should not be same  $_POST['email_m' . $j]





$tno = $res['tin_no'];
$curr = $res['curr'];
$date1 = date("Y-m-d");


// $emailFound = false;  // Initialize a flag to track if any valid email is found

// for ($j = 1; $j <= $lmt; $j++) {
// 	$email = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['email_m' . $j]));

// 	// Check both email fields (email1 and email2) individually
// 	for ($k = 1; $k <= 2; $k++) {
// 		$field = "email"; // You can adjust this if you're checking different email fields
// 		$qr2 = "SELECT * FROM it_2024_early_stage_startup WHERE $field = '$email'";
// 		$result2 = mysqli_query($link,$qr2) or die(mysqli_error($link));

// 		if (mysqli_num_rows($result2) > 0) {
// 			// Email found in the database, now check the flag value
// 			$row2 = mysqli_fetch_assoc($result2);

// 			if ($row2['flag'] == '0') {
// 				// Valid email found with flag 0, set emailFound to true
// 				$emailFound = true;
// 				break 2; // Exit both loops (the inner and outer) if a valid email is found
// 			} else {
// 				mysqli_close($link);
// 				// If flag is 1, show alert and exit
// 				echo "<script language='javascript'>alert('The email id \'" . $email . "\' is already registered with us.');</script>";
// 				echo "<script language='javascript'>window.location = ('registration5_es.php?ret=retds4fu324rn_ed24d3it&en=" . $en . "&a=" . $a . "&assoc_name=" . $assoc_name . "');</script>";
// 				exit;
// 			}
// 		}
// 	}
// }

// // If no valid email with flag 0 is found after checking both fields
// if (!$emailFound) {
// 	echo "<script language='javascript'>alert('The email id \'" . $email . "\' is not registered in pitching request form.');</script>";
// 	echo "<script language='javascript'>window.location = ('registration5_es.php?ret=retds4fu324rn_ed24d3it&en=" . $en . "&a=" . $a . "&assoc_name=" . $assoc_name . "');</script>";
// 	exit;
// }



// Continue with the rest of your code if all emails pass the check



for ($j = 1; $j <= $lmt; $j++) {
	$email = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['email_m' . $j]));
	$field = "email" . $j;


	for ($k = 1; $k <= 7; $k++) {
		$field1 = "email" . $k;
		$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field1 = '$email'") or die(mysqli_error($link));
		$num_row = mysqli_num_rows($qr);
		if ($num_row > 0) {
			$qr_gt_user_data_ans_row1 = mysqli_fetch_array($qr);
			$tin_no1 = $qr_gt_user_data_ans_row1['tin_no'];
			echo "<script language='javascript'>alert('The email id \'" . $email . "\' is already registered with us.');</script>";
			mysqli_close($link);
			echo "<script language='javascript'>window.location = 'https://www.mmactiv.in/pay/it-2024/reg_pay_1.php?id=" . $tin_no1 . "';</script>";
			// echo "<script language='javascript'>window.location = ('registration5_es.php?ret=retds4fu324rn_ed24d3it&en=" . $en . "&a=" . $a . "&assoc_name=" . $assoc_name . "');</script>";
			exit;

		}
	}

	/*$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$email'" ) or die ( mysqli_error ($link) );
																												 $num_row = mysqli_num_rows ( $qr );
																												 if ($num_row > 0) {
																													 echo "<script language='javascript'>alert('The email id \'". $email . "\' is already registered with us as a premium delegate.');</script>";
																													 echo "<script language='javascript'>window.location = ('registration5.php?ret=retds4fu324rn_ed24d3it&en=" .$en . "&a=" .$a . "&assoc_name=" .$assoc_name."');</script>";
																													 exit;
																												 }*/

	$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'") or die(mysqli_error($link));
	$num_row = mysqli_num_rows($qr);
	if ($num_row > 0) {
		$qr_gt_user_data_ans_row = mysqli_fetch_array($qr);
		if ($qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
			if (($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking' || $qr_gt_user_data_ans_row['paymode'] == 'Google pay')) {
				/*echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";*/
				//session_destroy();
				echo 'Please wait while you redirecting to CCAvenue payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
				echo "<script language='javascript'>setTimeout(function(){ window.location = ('$EVENT_OL_PAY_ACT_LINK?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
				mysqli_close($link);
				exit;
			} else if (($qr_gt_user_data_ans_row['paymode'] == 'Cashfree')) {
				/*echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";*/
				//session_destroy();
				echo 'Please wait while you redirecting to Cashfree payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
				echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CF_EVENT_OL_PAY_ACT_LINK?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
				mysqli_close($link);
				exit;
			} else if (($qr_gt_user_data_ans_row['paymode'] == "Cheque") || ($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD") || $qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") {
				echo "<script language='javascript'>window.location = 'registration9_es.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
				mysqli_close($link);
				exit;
			} else if ($qr_gt_user_data_ans_row['paymode'] == "Paypal" && $qr_gt_user_data_ans_row['curr'] == 'Foreign') {
				echo 'Please wait while you redirecting to Paypal payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
				echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CANCEL_URL?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
				mysqli_close($link);
				exit;
			}
		} else {
			/*echo "<script language='javascript'>alert('Provided email id $email, is alredy registered with us.');</script>";
																																																																																		   echo "<script language='javascript'>window.location='registration5.php?en=$en&assoc_name=$assoc_name';</script>";
																																																																																		   exit ();*/
			echo "<script language='javascript'>window.location = 'registration9_es.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
			mysqli_close($link);
			exit;
		}
	}
}

$paymode = '';
$pay_status = "Free";
$isPaid = false;
for ($i = 1; $i <= $lmt; $i++) {
	if ($_POST['catagory' . $i] == 'Premium Delegate' || $_POST['catagory' . $i] == 'International Premium Delegate') {
		$isPaid = true;
	}
}
if ($isPaid) {
	$paymode = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['paymode']));
	$pay_status = "Not Paid";
}
$paymode = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['paymode']));
$pay_status = "Not Paid";
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET paymode = '$paymode', pay_status='$pay_status' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));

$amt = 0;
for ($i = 1; $i <= $lmt; $i++) {
	$a1 = "title" . $i;
	$a2 = "fname" . $i;
	$a3 = "lname" . $i;
	$a5 = "job_title" . $i;
	$a6 = "badge" . $i;
	$a7 = "email" . $i;
	$a8 = "cellno" . $i;
	$a9 = "cata" . $i;
	$a10 = "amt" . $i;
	$title = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['title' . $i]));
	$title = trim($title);

	$fname = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['fname' . $i]));
	$fname = mysqli_real_escape_string($link,trim($fname));

	$lname = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['lname' . $i]));
	$lname = mysqli_real_escape_string($link,trim($lname));

	$job_title = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['job_title' . $i]));
	$job_title = mysqli_real_escape_string($link,trim($job_title));

	$badge = $title . ' ' . $fname . ' ' . $lname;
	$badge = mysqli_real_escape_string($link,htmlspecialchars($badge));


	$email = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['email_m' . $i]));
	$email = strtolower(trim($email));

	$cellno = '';
	if (!empty($_POST['cellno' . $i])) {
		$cellno = '+' . mysqli_real_escape_string($link,htmlspecialchars(@$_POST['cellnoCountryCode' . $i])) . "-" . mysqli_real_escape_string($link,htmlspecialchars($_POST['cellno' . $i]));
	}
	//$cata = @$_POST['cata'.$i];
	$cata = mysqli_real_escape_string($link,htmlspecialchars($_POST['catagory' . $i]));
	$org_reg_type = $res['org_reg_type'];
	$no_dele = $res['sub_delegates'];
	$conf_type = $res['conference_type'];
	/**/
	$qr_tot_del = mysqli_query($link,"SELECT SUM(sub_delegates) AS tot_dele FROM " . $EVENT_DB_FORM_REG);

	$qr_gt_tot_del_ans_row = mysqli_fetch_array($qr_tot_del);
	$res_tot_del = $qr_gt_tot_del_ans_row;
	$num_dele = $res_tot_del['tot_dele'];

	if ($curr == "Indian") {
		// Check how many days are selected
		$selectedDays = 0;

		if (!empty($qr_gt_user_data_ans_row['day1']))
			$selectedDays++;
		if (!empty($qr_gt_user_data_ans_row['day2']))
			$selectedDays++;
		if (!empty($qr_gt_user_data_ans_row['day3']))
			$selectedDays++;

		// Determine the rate based on the number of selected days
		if ($selectedDays == 3) {
			// All days selected (Full Delegate)
			$rate = "3000";
			$rate_org = "3000";
		} elseif ($selectedDays == 2) {
			// Two days selected
			$rate = "2000";
			$rate_org = "2000";
		} elseif ($selectedDays == 1) {
			// One day selected
			$rate = "1000";
			$rate_org = "1000";
		}
	}


	$amt = $amt + $rate;
	//echo $amt;
	$pas1 = $fname . "123";
	$pas2 = password_hash($pas1, PASSWORD_BCRYPT);

	if (($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == "")) {
		mysqli_close($link);
		echo "<script language='javascript'>alert('Provided all required details of all $lmt delegates.');</script>";
		echo "<script language='javascript'>window.location='registration5_es.php?en=$en&assoc_name=$assoc_name';</script>";
		exit;
	}

	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET $a1 = '$title' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET $a2 = '$fname' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET $a3 = '$lname' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET $a5 = '$job_title' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET $a6 = '$badge' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET $a7 = '$email' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET $a8 = '$cellno' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET $a9 = '$cata' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET $a10 = '$rate_org' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET selection_amt = '$amt' where reg_id = '$reg_id'") or die(mysqli_error($link));

	mysqli_query($link,"INSERT INTO " . $EVENT_DB_FORM_REG_TBL_LOGIN . "(tin_no,reg_id,title,fname,lname,email,cata,user_name,pass1,pass2) VALUES ('$tno','$reg_id','$title','$fname','$lname','$email','$cata','$email','$pas1','$pas2')") or die(mysqli_error($link));
}

$membershipDiscount = $membership_discount = 0;
$gr_discount = 0;
$admin_discount = 0;
$tax = 0;
$total = 0;
$main_amt = 0;
$processing_charge_per = $processing_charge = 0;

$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'");
$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
$res = $res1 = $qr_gt_user_data_ans_row;
$curr = $res['curr'];




if ($res['paymode'] == "") {
	$res['paymode'] == 'CCAvenue';
	$res['paymode'] == 'Credit Card';
}


if ($curr == "Indian") {
	if ($res['paymode'] == 'Credit Card' || $res['paymode'] == 'Google pay' || $res['paymode'] == 'Cashfree') {
		$processing_charge_per = $CC_IND_PROCESSING_CHARGE_PER;
	}
} else if ($curr == "Foreign") {
	if ($res['paymode'] == 'Paypal') {
		$processing_charge_per = $PAYPAL_PROCESSING_CHARGE_PER;
	} else if ($res['paymode'] == 'CCAvenue' || $res['paymode'] == 'Credit Card') {
		$processing_charge_per = $CC_INT_PROCESSING_CHARGE_PER;
	}
}



//$qr_gt_user_dataid = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG);
//mysqli_num_rows($qr_gt_user_dataid);
$adminDiscount = 0;
$deytaikls = array();

$assoc_srno = @$res['assoc_srno'];
$user_type = @$res['user_type'];
if (!empty($assoc_srno) && !empty($user_type)) {
	$sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_TBL WHERE srno=$assoc_srno AND assoc_name='$user_type'";
	$resulre = mysqli_query($link,$sql);
	$deytaikls = mysqli_fetch_assoc($resulre);
	$adminDiscount = $deytaikls['discount'];
}

if ($res['cata'] == 'Full Delegate' || $res['cata'] == '3 days with speaker offer' || $res['cata'] == '3 days with power bank offer' || $res['cata'] == 'YESSS Abstract Presenter - 3 days') {
	/*$totalRegistrations = 200;
																												 if($totalRegistrations >= 0 && $totalRegistrations <= 100) {
																													 $adminDiscount = $admin_discount = 90;
																												 } else if($totalRegistrations >= 101 && $totalRegistrations <= 200) {
																													 $adminDiscount = $admin_discount = 80;
																												 } else if($totalRegistrations >= 201 && $totalRegistrations <= 300) {
																													 $adminDiscount = $admin_discount = 70;
																												 } else if($totalRegistrations >= 301 && $totalRegistrations <= 400) {
																													 $adminDiscount = $admin_discount = 60;
																												 } else if($totalRegistrations >= 401 && $totalRegistrations <= 500) {
																													 $adminDiscount = $admin_discount = 50;
																												 } else if($totalRegistrations >= 501 && $totalRegistrations <= 600) {
																													 $adminDiscount = $admin_discount = 40;
																												 }  else if($totalRegistrations >= 601 && $totalRegistrations <= 700) {
																													 $adminDiscount = $admin_discount = 30;
																												 } else if($totalRegistrations >= 701 && $totalRegistrations <= 800) {
																													 $adminDiscount = $admin_discount = 20;
																												 } else if($totalRegistrations >= 801 && $totalRegistrations <= 900) {
																													 $adminDiscount = $admin_discount = 10;
																												 } else if($totalRegistrations >= 901 && $totalRegistrations <= 1000) {
																													 $adminDiscount = $admin_discount = 5;
																												 }*/

	//$adminDiscount = $admin_discount = 80;

	if ($res['cata'] == 'Full Delegate' || $res['cata'] == 'International Delegate') {
		//$adminDiscount = $admin_discount = 90;
	}/* else if($res['cata'] == '3 days with speaker offer') {
																				  $adminDiscount = $admin_discount = 70;
																			  } else if($res['cata'] == '3 days with power bank offer') {
																				  $adminDiscount = $admin_discount = 60;
																			  }*/

	if (($res['gr_type'] == "Single") || ($res['sub_delegates'] <= "2")) {

		$amt_per_del = $main_amt = $res['selection_amt'];

		if (!empty($adminDiscount)) {
			$admin_discount = round(($main_amt * $adminDiscount) / 100);
		}
		$main_amt = $main_amt - $admin_discount;
		/*if($res['assoc_name'] == 'NASSCOM' || $res['assoc_name'] == 'NextBigWhat' || $res['assoc_name'] == 'IAMAI' || 
																																																								  $res['assoc_name'] == '91 Spring Board' || $res['assoc_name'] == 'Your Story' || $res['assoc_name'] == 'Work Bench Projects' || 
																																																							  $res['assoc_name'] == 'IACC' || $res['assoc_name'] == 'Startup Cell' || $res['assoc_name'] == 'STPI' || $res['assoc_name'] == 'IESA' || $res['assoc_name'] == 'KBITS' ) {
																																																									  $membershipDiscount = 20;
																																																									  $membership_discount = round(($main_amt * $membershipDiscount) / 100);
																																																									  $main_amt = $main_amt - $membership_discount;
																																																								  }*/
		/*if($res['member_of_assoc'] == 'Yes') {
																																																								  $membershipDiscount = 10;
																																																								  $membership_discount = round(($main_amt * $membershipDiscount) / 100);
																																																								  $main_amt = $main_amt - $membership_discount;
																																																							  }*/
		/*if(!empty($res['assoc_name'])) {
																																																								  if($res['assoc_name'] == 'Karnataka Startup Cell' || $res['assoc_name'] == 'Karnataka Incubators' || $res['assoc_name'] == 'KBITS StartUp Member') {
																																																									  $membershipDiscount = 50;	
																																																								  } else {
																																																									  $membershipDiscount = 20;					
																																																								  }

																																																								  $membership_discount = round(($main_amt * $membershipDiscount) / 100);
																																																								  $main_amt = $main_amt - $membership_discount;
																																																							  }*/
		$tax = round(($main_amt * $SERVICE_TAX) / 100);
		$total = round($main_amt + $tax);
		if (!empty($processing_charge_per)) {
			$processing_charge = round(($total * $processing_charge_per) / 100);
			$total = round($total + $processing_charge);
		}
	} else if (($res['gr_type'] == "Group") && ($res['sub_delegates'] >= "3")) {

		$amt_per_del = $main_amt = $res['selection_amt'];

		//if($res['org_reg_type'] != 'Poster') {
		$gr_discount = round(($amt_per_del * 10) / 100);
		//}


		/*if(!empty($adminDiscount)) {
																																																								  $admin_discount = round(($main_amt * $adminDiscount) / 100);
																																																							  }*/
		$main_amt = $main_amt - $gr_discount;


		/*if($res['assoc_name'] == 'NASSCOM' || $res['assoc_name'] == 'NextBigWhat' || $res['assoc_name'] == 'IAMAI' ||
																																																							  $res['assoc_name'] == '91 Spring Board' || $res['assoc_name'] == 'Your Story' || $res['assoc_name'] == 'Work Bench Projects' ||
																																																							  $res['assoc_name'] == 'IACC' || $res['assoc_name'] == 'Startup Cell' || $res['assoc_name'] == 'STPI' || $res['assoc_name'] == 'IESA' || $res['assoc_name'] == 'KBITS' ) {
																																																									  $membershipDiscount = 20;
																																																									  $membership_discount = round(($main_amt * $membershipDiscount) / 100);
																																																									  $main_amt = $main_amt - $membership_discount;
																																																							  }*/
		/*if($res['member_of_assoc'] == 'Yes') {
																																																								  $membershipDiscount = 10;
																																																								  $membership_discount = round(($main_amt * $membershipDiscount) / 100);
																																																								  $main_amt = $main_amt - $membership_discount;
																																																							  }*/
		/*if(!empty($res['assoc_name'])) {
																																																								  if($res['assoc_name'] == 'Karnataka Startup Cell' || $res['assoc_name'] == 'Karnataka Incubators' || $res['assoc_name'] == 'KBITS StartUp Member') {
																																																									  $membershipDiscount = 50;	
																																																								  }/* else {
																																																									  $membershipDiscount = 20;					
																																																								  }*/

		/*$membership_discount = round(($main_amt * $membershipDiscount) / 100);
																																																								  $main_amt = $main_amt - $membership_discount;
																																																							  }*/
		$tax = round(($main_amt * $SERVICE_TAX) / 100);
		$total = round($main_amt + $tax);
		if (!empty($processing_charge_per)) {
			$processing_charge = round(($total * $processing_charge_per) / 100);
			$total = round($total + $processing_charge);
		}
		//echo $gr_discount.'--1--'.$total.'1--';exit;
		/*echo $main_amt;
																																																							  echo $tax;
																																																							  echo $total;
																																																							  exit;*/
	}
} else if ($res['cata'] == 'Single Day-Nov 29th,Nov 30th,Dec 1st' || $res['cata'] == 'Single Day-Nov 29th,Dec 1st' || $res['cata'] == 'Single Day-Nov 29th,Dec 1st' || $res['cata'] == 'Single Day-Nov 30th,Dec 1st' || $res['cata'] == 'Single Day-Nov 29th' || $res['cata'] == 'Single Day-Nov 30th' || $res['cata'] == 'Single Day-Dec 1st') {
	$amt_per_del = $main_amt = $res['selection_amt'];
	/*if($res['member_of_assoc'] == 'Yes') {
																													 $membershipDiscount = 10;
																													 $membership_discount = round(($main_amt * $membershipDiscount) / 100);
																													 $main_amt = $main_amt - $membership_discount;
																												 }*/
	if (!empty($adminDiscount)) {
		$admin_discount = round(($main_amt * $adminDiscount) / 100);
	}
	$main_amt = $main_amt - $admin_discount;
	if (!empty($res['assoc_name'])) {
		if ($res['assoc_name'] == 'Karnataka Startup Cell' || $res['assoc_name'] == 'Karnataka Incubators' || $res['assoc_name'] == 'KBITS StartUp Member') {
			$membershipDiscount = 50;
		}/* else {
																																															   $membershipDiscount = 20;					
																																														   }*/

		$membership_discount = round(($main_amt * $membershipDiscount) / 100);
		$main_amt = $main_amt - $membership_discount;
	}
	$tax = round(($main_amt * $SERVICE_TAX) / 100);
	$total = round($main_amt + $tax);
} else {
	$main_amt = $res['selection_amt'];
	if (!empty($adminDiscount)) {
		$admin_discount = round(($main_amt * $adminDiscount) / 100);
	}
	$main_amt = $main_amt - $admin_discount;
	if ($res['gr_type'] == 'Group' && $res['sub_delegates'] >= 3) {
		$gr_discount = round(($main_amt * 10) / 100);
	}
	$main_amt = $main_amt - $gr_discount;
	/*if($res['assoc_name'] == 'NASSCOM' || $res['assoc_name'] == 'NextBigWhat' || $res['assoc_name'] == 'IAMAI' ||
																												 $res['assoc_name'] == '91 Spring Board' || $res['assoc_name'] == 'Your Story' || $res['assoc_name'] == 'Work Bench Projects' ||
																												 $res['assoc_name'] == 'IACC' || $res['assoc_name'] == 'Startup Cell' || $res['assoc_name'] == 'STPI' || $res['assoc_name'] == 'IESA' || $res['assoc_name'] == 'KBITS' ) {
																													 $membershipDiscount = 20;
																													 $membership_discount = round(($total * $membershipDiscount) / 100);
																													 $total = $total - $membership_discount;
																												 }*/
	/*if($res['member_of_assoc'] == 'Yes') {
																													 $membershipDiscount = 10;
																													 $membership_discount = round(($main_amt * $membershipDiscount) / 100);
																													 $main_amt = $main_amt - $membership_discount;
																												 }*/

	if (!empty($res['assoc_name'])) {
		if ($res['assoc_name'] == 'NASSCOM' || $res['assoc_name'] == 'IESA' || $res['assoc_name'] == 'ABAI' || $res['assoc_name'] == 'ABLE' || $res['assoc_name'] == 'TIE' || $res['assoc_name'] == 'IACC' || $res['assoc_name'] == 'AMCHAM' || $res['assoc_name'] == 'USIBC') {
			$membershipDiscount = 10;
		}
		/*if($res['assoc_name'] == 'Karnataka Startup Cell' || $res['assoc_name'] == 'Karnataka Incubators' || $res['assoc_name'] == 'KBITS StartUp Member') {
																																																								  $membershipDiscount = 50;	
																																																							  }*//* else {
																																																								  $membershipDiscount = 20;					
																																																							  }*/

		$membership_discount = round(($main_amt * $membershipDiscount) / 100);
		$main_amt = $main_amt - $membership_discount;
	}

	$tax = round(($main_amt * $SERVICE_TAX) / 100);
	$total = round($main_amt + $tax);
	if (!empty($processing_charge_per)) {
		$processing_charge = round(($total * $processing_charge_per) / 100);
		$total = round($total + $processing_charge);
	}
}

//echo $gr_discount;
//echo '----'.$total;exit;
if ($res['pay_status'] == 'Not Paid') {
	if ($total == 0) {
		echo "<script language='javascript'>alert('Very rare condition occurs. Please try after 30 sec..');</script>";
		mysqli_query($link,"DELETE FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
		session_destroy();
		mysqli_close($link);
		if (!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration_es.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration_es.php?en=$en';</script>";
		}
		exit;
	}
}
//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET amt_per_del = '$amt_per_del' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET gr_discount = '$gr_discount' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET admin_discount = '$admin_discount' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET tax = '$tax' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET total = '$total' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET membership_discount = '$membership_discount' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET adminDiscountPer = '$adminDiscount' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET membershipDiscountPer = '$membershipDiscount' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET processing_charge_per = '$processing_charge_per' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET processing_charge = '$processing_charge' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_close($link);
echo "<script language='javascript'>window.location = 'registration7_es.php?en=$en&assoc_name=$assoc_name';</script>";
exit;

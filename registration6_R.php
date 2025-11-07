<?php
// print_r($_POST);exit;
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
$event_name = 'Bangalore IT';
$en = '';
if (isset($_POST['en']) && !empty($_POST['en'])) {
	$en = '1';
	$event_name = 'Bangalore INDIA BIO';
}
$assoc_name = @$_GET['assoc_name'];
$assoc_name = trim($assoc_name);




$del = @$_GET["del"];
$cit = @$_GET["cit"];

date_default_timezone_set('Asia/Kolkata');
$today = date("Y-m-d");
$event_date = date("Y-m-d", strtotime("2025-09-03"));
$early_date = '2025-07-31';
$early_date2 = '2025-09-30';
$early_date3 = '2025-11-15';
$standard_date = '2025-09-03';






if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
	session_destroy();
	mysqli_close($link);
	echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
	if (!empty($assoc_name)) {
		echo "<script language='javascript'>window.location = 'registration.php?en=$en&assoc_name=$assoc_name';</script>";
	} else {
		echo "<script language='javascript'>window.location = 'registration.php?en=$en';</script>";
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
		echo "<script language='javascript'>window.location = 'registration.php?en=$en&assoc_name=$assoc_name';</script>";
	} else {
		echo "<script language='javascript'>window.location = 'registration.php?en=$en';</script>";
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
// echo $res['sub_delegates'];
// print_r( $res);
// die;
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
		//alert the user that email should be unique for each delegate
		echo "<script language='javascript'>alert('Email should be unique for each delegate.');</script>";
		echo "<script language='javascript'>window.location = ('registration5.php?en=" . $en . "&a=" . $a . "&assoc_name=" . $assoc_name . "');</script>";
		exit;
	}
}
//for 1 to lmt check that email should not be same  $_POST['email_m' . $j]





$tno = $res['tin_no'];
$curr = $res['curr'];
$date1 = date("Y-m-d");

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
			echo "<script language='javascript'>window.location = 'https://www.mmactiv.in/pay/it-2024/reg_pay_1.php?id=" . $tin_no1 . "';</script>";
			//  echo "<script language='javascript'>window.location = ('registration5.php?ret=retds4fu324rn_ed24d3it&en=" .$en . "&a=" .$a . "&assoc_name=" .$assoc_name."');</script>";
			mysqli_close($link);
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
				exit;
			} else if (($qr_gt_user_data_ans_row['paymode'] == 'Cashfree')) {
				/*echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";*/
				//session_destroy();
				echo 'Please wait while you redirecting to Cashfree payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
				echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CF_EVENT_OL_PAY_ACT_LINK?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
				exit;
			} else if (($qr_gt_user_data_ans_row['paymode'] == "Cheque") || ($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD") || $qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") {
				echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
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
			echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
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
function getRate($early_rate1, $early_rate2, $early_rate3, $standard_rate, $today, $early_date, $early_date2, $early_date3, $standard_date)
{
    if ($today <= $early_date) {
        return $early_rate1;
    } elseif ($today <= $early_date2) {
        return $early_rate2;
    } elseif ($today <= $early_date3) {
        return $early_rate3;
    } elseif ($today <= $standard_date) {
        return $standard_rate;
    } else {
        return $standard_rate; // or you can return a late_fee if applicable
    }
}
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
	// echo $cata;
	// die;
	$org_reg_type = $res['org_reg_type'];
	$no_dele = $res['sub_delegates'];
	$conf_type = $res['conference_type'];
	/**/
	$qr_tot_del = mysqli_query($link,"SELECT SUM(sub_delegates) AS tot_dele FROM " . $EVENT_DB_FORM_REG);

	$qr_gt_tot_del_ans_row = mysqli_fetch_array($qr_tot_del);
	$res_tot_del = $qr_gt_tot_del_ans_row;
	$num_dele = $res_tot_del['tot_dele'];


	if ($curr == "Indian") {
		if ($cata === "VIP Delegate Pass") {
			$rate = getRate(10000, 14000, 18000, 20000, $today, $early_date,$early_date2,$early_date3, $standard_date);
		} elseif ($cata === "Premium Delegate Pass") {
			$rate = getRate(6000, 8400, 10800, 12000, $today, $early_date,$early_date2,$early_date3, $standard_date);
		} elseif ($cata === "Conference Delegate Pass") {
			$rate = getRate(3000, 4200, 5400, 6000, $today, $early_date, $early_date2, $early_date3, $standard_date);
		} elseif ($cata === "MPMF Delegate Pass") {
			$rate = getRate(2000, 2800, 3600, 4000, $today, $early_date,$early_date2,$early_date3, $standard_date);
		} elseif ($cata === "FMC Delegate Pass") {
			$rate = getRate(1500,2400, 2700, 3000, $today, $early_date,$early_date2,$early_date3, $standard_date);
		} else {
			$rate = 30000;
		}
	} else if ($curr == "Foreign") {
		if ($cata === "VIP Delegate Pass") {
			$rate = getRate(2000, 2800, 3600, 4000, $today, $early_date,$early_date2,$early_date3, $standard_date);
		} elseif ($cata === "Premium Delegate Pass") {
			$rate = getRate(1200, 1680, 2160, 2400, $today, $early_date,$early_date2,$early_date3, $standard_date);
		} elseif ($cata === "Conference Delegate Pass") {
			$rate = getRate(600, 840, 1080, 1200, $today, $early_date,$early_date2,$early_date3, $standard_date);
		} elseif ($cata === "MPMF Delegate Pass") {
			$rate = getRate(400, 560, 720, 800, $today, $early_date,$early_date2,$early_date3, $standard_date);
		} elseif ($cata === "FMC Delegate Pass") {
			$rate = getRate(300,420, 540, 600, $today, $early_date,$early_date2,$early_date3, $standard_date);
		} else {
			$rate = 30000;
		}
	}

	// echo $rate . "<br>";
	// echo $cata . "<br>";
	
	// exit;
$rate_org  =$rate;

	$amt = $amt + $rate;




// Function to get applicable rate




	$pas1 = $fname . "123";
	$pas2 = password_hash($pas1, PASSWORD_BCRYPT);

	if (($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == "")) {
		echo "<script language='javascript'>alert('Provided all required details of all $lmt delegates.');</script>";
		echo "<script language='javascript'>window.location='registration5.php?en=$en&assoc_name=$assoc_name';</script>";
		exit;
	}

	$updateQuery = "
		UPDATE " . $EVENT_DB_FORM_REG_DEMO . " 
		SET 
			$a1 = '$title',
			$a2 = '$fname',
			$a3 = '$lname',
			$a5 = '$job_title',
			$a6 = '$badge',
			$a7 = '$email',
			$a8 = '$cellno',
			$a9 = '$cata',
			$a10 = '$rate_org',
			selection_amt = '$amt',
			amt_per_del = '$rate_org',
		WHERE reg_id = '$reg_id'
	";
	mysqli_query($link,$updateQuery) or die(mysqli_error($link));

	// mysqli_query($link,"INSERT INTO " . $EVENT_DB_FORM_REG_TBL_LOGIN . "(tin_no,reg_id,title,fname,lname,email,cata,user_name,pass1,pass2) VALUES ('$tno','$reg_id','$title','$fname','$lname','$email','$cata','$email','$pas1','$pas2')") or die(mysqli_error($link));
}

// echo $amt . '--1--';
// die;
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
	

	if (($res['gr_type'] == "Single") || ($res['sub_delegates'] <= "2")) {

		$amt_per_del = $main_amt = $res['selection_amt'];

		if (!empty($adminDiscount)) {
			$admin_discount = round(($main_amt * $adminDiscount) / 100);
		}
		$main_amt = $main_amt - $admin_discount;
		
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
}  else {
	$main_amt = $res['selection_amt'];
	if (!empty($adminDiscount)) {
		$admin_discount = round(($main_amt * $adminDiscount) / 100);
	}
	$main_amt = $main_amt - $admin_discount;
	if ($res['gr_type'] == 'Group' && $res['sub_delegates'] >= 3) {
		$gr_discount = round(($main_amt * 10) / 100);
	}
	$main_amt = $main_amt - $gr_discount;
	

	if (!empty($res['assoc_name'])) {
		if ($res['assoc_name'] == 'NASSCOM' || $res['assoc_name'] == 'IESA' || $res['assoc_name'] == 'ABAI' || $res['assoc_name'] == 'ABLE' || $res['assoc_name'] == 'TIE' || $res['assoc_name'] == 'IACC' || $res['assoc_name'] == 'AMCHAM' || $res['assoc_name'] == 'USIBC') {
			$membershipDiscount = 10;
		}
	

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
echo $main_amt . '--2--' . $total . '2--';
echo $admin_discount . '--3--' . $total . '3--';
echo $gr_discount;
echo '----'.$total;exit;
if ($res['pay_status'] == 'Not Paid') {
	if ($total == 0) {
		echo "<script language='javascript'>alert('Very rare condition occurs. Please try after 30 sec..');</script>";
		mysqli_query($link,"DELETE FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
		session_destroy();
		if (!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration.php?en=$en';</script>";
		}
		exit;
	}
}
//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET amt_per_del = '$amt_per_del' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
$updateFields = [
	"gr_discount = '$gr_discount'",
	"admin_discount = '$admin_discount'",
	"tax = '$tax'",
	"total = '$total'",
	"membership_discount = '$membership_discount'",
	"adminDiscountPer = '$adminDiscount'",
	"membershipDiscountPer = '$membershipDiscount'",
	"processing_charge_per = '$processing_charge_per'",
	"processing_charge = '$processing_charge'"
];

$updateQuery = "UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET " . implode(", ", $updateFields) . " WHERE reg_id = '$reg_id'";
mysqli_query($link,$updateQuery) or die(mysqli_error($link));
mysqli_close($link);
echo "<script language='javascript'>window.location = 'registration7.php?en=$en&assoc_name=$assoc_name';</script>";
exit;

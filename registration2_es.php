<?php
session_start();
$sector = $_POST['sector'];
require "includes/form_constants_both.php";
//print_r($_POST);exit;
$en = '';
//$eventName = 'Bengaluru Tech Summit';
$event_name = 'Bangalore IT';
/*if($sector == 'Bio Technology') {
	   $en = '1';
	   $eventName = 'Bengaluru INDIA BIO';
	   $event_name = 'Bangalore INDIA BIO';
	   //$EVENT_WEBSITE_LINK = 'http://www.bengaluruindiabio.in/';
   }*/

//=========== ORG
$_SESSION['sector'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['sector']));
$_SESSION['nature'] = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['nature']));
//$_SESSION['event_know'] = mysqli_real_escape_string($link,@$_POST['addr1']);
//$_SESSION['event_know'] = mysqli_real_escape_string($link,@$_POST['addr2']);
$_SESSION['city'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['city']));
$_SESSION['state'] = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['state']));
$_SESSION['country'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['country']));
$_SESSION['event_know'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['event_know']));
$_SESSION['foneCountryCode'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['foneCountryCode']));
$_SESSION['fone'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['fone']));
$_SESSION['total_dele'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['total_dele']));
$_SESSION['org_reg_type'] = $_POST['org_reg_type'];
$cata_m = @$_POST['org_reg_type'];

$_SESSION['is_gst_invoice_needed'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['is_gst_invoice_needed']));
$_SESSION['gst_inv_addr'] = '';
$_SESSION['gst_inv_reg_no'] = '';
$_SESSION['gst_inv_pan'] = '';
$_SESSION['gst_inv_state'] = '';
$_SESSION['gst_inv_cp'] = '';
$_SESSION['gst_inv_phone'] = '';
$_SESSION['gst_inv_email'] = '';

if ($_POST['is_gst_invoice_needed'] == 'Yes') {
	$_SESSION['gst_inv_addr'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_addr']));
	$_SESSION['gst_inv_reg_no'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_reg_no']));
	$_SESSION['gst_inv_pan'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_pan']));
	$_SESSION['gst_inv_state'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_state']));
	$_SESSION['gst_inv_cp'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_cp']));
	$_SESSION['gst_inv_phone'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_phone']));
	$_SESSION['gst_inv_email'] = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_email']));
}
// Retrieve selected days from the form submission
$selectedDays = isset($_POST['days']) ? $_POST['days'] : [];

// Initialize values for each day (empty if not selected)
$day_1 = in_array('19th', $selectedDays) ? '19th' : '';
$day_2 = in_array('20th', $selectedDays) ? '20th' : '';
$day_3 = in_array('21st', $selectedDays) ? '21st' : '';

// Now you can store $day_1, $day_2, and $day_3 in the database

$assoc_name = @$_POST['assoc_name'];
$assoc_name = trim($assoc_name);
//echo $_SESSION["vercode_reg"] . '#' . $_POST["vercode"];exit;
if (empty($_SESSION["vercode_reg"]) || mysqli_real_escape_string($link,htmlspecialchars(($_POST["vercode"])) != $_SESSION["vercode_reg"])) {
	session_destroy();
	mysqli_close($link);
	echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
	if (!empty($assoc_name)) {
		echo "<script language='javascript'>window.location = 'registration_es.php?en=$en&assoc_name=$assoc_name';</script>";
	} else {
		echo "<script language='javascript'>window.location = 'registration_es.php?en=$en';</script>";
	}
	exit;
}

$conf_type = "Virtual Conference";
/* if($conf_type==""){
	   session_destroy();
	   echo "<script language='javascript'>alert('Please select delegate type.');</script>";
	   echo "<script language='javascript'>window.location = 'registration.php?en=$en';</script>";
	   exit;
   } */

//$cata_m = @$_POST['cata_m'];
/* if ($cata_m == "") {
	   session_destroy();
	   echo "<script language='javascript'>alert('Please select delegate type.');</script>";
	   if(!empty($assoc_name)) {
		   echo "<script language='javascript'>window.location = 'registration.php?en=$en&assoc_name=$assoc_name';</script>";
	   } else {
		   echo "<script language='javascript'>window.location = 'registration.php?en=$en';</script>";
	   }
	   exit;
   } */

//print_r($_POST);exit;
$total_dele = $_POST['total_dele'];
if ($cata_m == "Poster") {
	if ($total_dele == 'No') {
		$total_dele = 1;
	} else if ($total_dele == '1') {
		$total_dele = 2;
	} else if ($total_dele == '2') {
		$total_dele = 3;
	} else if ($total_dele == '3') {
		$total_dele = 4;
	}
}

if (empty($total_dele)) {
	session_destroy();
	echo "<script language='javascript'>alert('Please select number of delegate.');</script>";
	mysqli_close($link);
	if (!empty($assoc_name)) {
		echo "<script language='javascript'>window.location = 'registration_es.php?en=$en&assoc_name=$assoc_name';</script>";
	} else {
		echo "<script language='javascript'>window.location = 'registration_es.php?en=$en';</script>";
	}
	exit;
}

//require("includes/form_constants.php");
require "dbcon_open.php";

$ddate = date("Y-m-d");
$ttime = date("H:i:s A");
$reg_id = $_SESSION['vercode_reg'];
$ret = mysqli_real_escape_string($link,htmlspecialchars(@$_GET['ret']));

if ($ret == "retds4fu324rn_ed24d3it") {
	mysqli_query($link,"delete from " . $EVENT_DB_FORM_REG_DEMO . " where reg_id = '$reg_id' ") or die(mysqli_error($link));
}

//$cata = @$_POST['cata'];

//print_r($_POST);exit;
$curr = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['curr']));
$pay_status = "Not Paid";
$paymode = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['paymode']));
//$grp        = $_POST['grp'];
$member_of_assoc = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['member_of_assoc']));
$grp = 'Group';
if ($total_dele == 1) {
	$grp = 'Single';
}

if ($grp != "Single") {
	if (($total_dele > 2) || ($total_dele <= 1)) {
		session_destroy();
		echo "<script language='javascript'>alert('In group only 2 delegates are allowed.');</script>";
		if (!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration_es.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration_es.php?en=$en';</script>";
		}
		exit;
	}
}
$event_know = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['event_know']));
if ($curr == "Indian" && $sector == 'Bio Technology') {
	if ($member_of_assoc == "Yes") {
		$promo_code = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['promo_code']));
		/*if($promo_code != $PROMO_CODE) {
																							 echo "<script language='javascript'>alert('Please enter valid Genotypic Techchnology Member Code.');</script>";
																							 if(!empty($assoc_name)) {
																								 echo "<script language='javascript'>window.location = 'registration.php?en=$en&assoc_name=$assoc_name';</script>";
																							 } else {
																								 echo "<script language='javascript'>window.location = 'registration.php?en=$en';</script>";
																							 }
																							 exit;
																						 }*/
	}
	if (empty($event_know)) {
		echo "<script language='javascript'>alert('Please Select How do you know about Bangalore Bio 2017.');</script>";
		if (!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration_es.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration_es.php?en=$en';</script>";
		}
		exit;
	} else {
		if ($event_know == 'Others') {
			if (empty($_POST['other_value'])) {
				echo "<script language='javascript'>alert('Please enter other value of How do you know about Bangalore Bio 2017.');</script>";
				if (!empty($assoc_name)) {
					echo "<script language='javascript'>window.location = 'registration_es.php?en=$en&assoc_name=$assoc_name';</script>";
				} else {
					echo "<script language='javascript'>window.location = 'registration_es.php?en=$en';</script>";
				}
				exit;
			}
			$event_know .= '-' . @$_POST['other_value'];
		}
	}
} else {
	//$member_of_assoc = '';
}

$assoc_srno = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['assoc_srno']));
$user_type = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['user_type']));
$promo_code = '';
if (!empty($assoc_srno) && !empty($user_type)) {
	$sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_TBL WHERE srno=$assoc_srno AND assoc_name='$user_type'";
	$resulre = mysqli_query($link,$sql);
	if (mysqli_num_rows($resulre) <= 0) {
		echo "<script language='javascript'>alert('Invalid promo code. Please try again!');</script>";
		echo "<script language='javascript'>window.location='registration_es.php';</script>";
		exit;
	}
	$resulre = mysqli_fetch_assoc($resulre);
	$promo_code = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['promo_code']));
	if ($resulre['promo_code'] != $promo_code) {
		echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
		echo "<script language='javascript'>window.location='registration_es.php';</script>";
		exit;
	}
}

$org = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['org']));
$nature = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['nature']));
$addr1 = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['addr1']));
$addr2 = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['addr2']));
$city = mysqli_real_escape_string($link,htmlspecialchars($_POST['city']));
$state = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['state']));
$country = mysqli_real_escape_string($link,htmlspecialchars($_POST['country']));
$pin = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['pin']));
$gst = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['gst']));

if (($org == "") || ($city == "") || ($country == "") || (@$_POST['fone'] == "")) {
	mysqli_close($link);
	echo "<script language='javascript'>alert('Provided all required (* marked) details .');</script>";
	echo "<script language='javascript'>window.location = 'registration_es.php?assoc_name=$assoc_name';</script>";
	exit;
}

$is_gst_invoice_needed = $gst_inv_addr = $gst_inv_reg_no = $gst_inv_pan = $gst_inv_state = $gst_inv_cp = $gst_inv_phone = $gst_inv_email = '';
if ($_POST['is_gst_invoice_needed'] == 'Yes') {
	$is_gst_invoice_needed = mysqli_real_escape_string($link,htmlspecialchars($_POST['is_gst_invoice_needed']));
	$gst_inv_addr = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_addr']));
	$gst_inv_reg_no = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_reg_no']));
	$gst_inv_pan = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_pan']));
	$gst_inv_state = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_state']));
	$gst_inv_cp = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_cp']));
	$gst_inv_phone = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_phone']));
	$gst_inv_email = mysqli_real_escape_string($link,htmlspecialchars($_POST['gst_inv_email']));

	if (($gst_inv_addr == "") || ($gst_inv_reg_no == "") || ($gst_inv_pan == "") || ($gst_inv_state == "") || ($gst_inv_cp == "") || ($gst_inv_phone == "") || ($gst_inv_email == "")) {
		mysqli_close($link);
		echo "<script language='javascript'>alert('Provided all required (* marked) details .');</script>";
		echo "<script language='javascript'>window.location = 'registration_es.php?assoc_name=$assoc_name';</script>";
		exit;
	}
}

//$assoc_name = str_replace('_', ' ', $assoc_name);
$amt_ext = "";
$dollar = "";
$cata = "";
if ($curr == "Indian") {
	$dollar = "1";
	$amt_ext = "Rs.";
	$nationality = "Indian Organization";
	if (mysqli_real_escape_string($link,htmlspecialchars(@$_POST['cata'])) != "") {
		$cata = mysqli_real_escape_string($link,htmlspecialchars($_POST['cata']));
	}
} else if ($curr == "Foreign") {
	$dollar = $DOLLAR_RATE;
	;
	$amt_ext = "USD";
	$nationality = "International Organization";
	if (isset($_POST['cata']) && $_POST['cata'] != "") {
		$cata = mysqli_real_escape_string($link,htmlspecialchars($_POST['cata']));
	}
}

if ($_POST['daytype'] == 'Single Day') {
	/*if($cata_m == 'Student') {
											   $cata = 'Single Day-Student';
											   } else if($cata_m == 'Industry') {
											   $cata = 'Single Day-Industry';
											   }*/
	if ($assoc_name == 'ABAI') {
		$cata = mysqli_real_escape_string($link,htmlspecialchars($_POST['cata']));
	}

	$days = '';
	if ($_POST['day1'] != "") {
		$days .= mysqli_real_escape_string($link,htmlspecialchars($_POST['day1']));
	}
	if ($_POST['day2'] != "") {
		if (!empty($days)) {
			$days .= ',';
		}
		$days .= mysqli_real_escape_string($link,htmlspecialchars($_POST['day2']));
	}
	if ($_POST['day3'] != "") {
		if (!empty($days)) {
			$days .= ',';
		}
		$days .= mysqli_real_escape_string($link,htmlspecialchars($_POST['day3']));
	}
	$cata .= '-' . $days;
}

if ($assoc_name == 'KBITS StartUp Member') {
	$cata = mysqli_real_escape_string($link,htmlspecialchars($_POST['cata'])) . '-Nov 18th';
}

//$dollar      = "1";
//$amt_ext     = "Rs.";
/* if ($_POST['daytype'] != "") {
	   $cata .= $_POST['daytype'];
   } */
$paymode = '';
/* if($paymode==""){
	   $paymode="Credit Card";
   } */
if ($cata_m == 'Attendees/Visitors') {
	$paymode = 'Free';
}
if ($cata_m == 'Poster') {
	$EVENT_DB_TIN_NO = "TIN-BTS" . $EVENT_YEAR . "-PSTR-";

	if ($sector == 'Bio Technology') {
		$EVENT_DB_TIN_NO = "TIN-BTS" . $EVENT_YEAR . "-PSTR-";
	}
}

$rate_org = $amt = $temp_sess_sp_msg = 0;
mysqli_query($link,"insert into " . $EVENT_DB_FORM_REG_DEMO . "(org_reg_type,nationality,cata,curr,gr_type,sub_delegates,paymode,
	pay_status,amt_ext,amt_per_del,selection_amt,total,reg_id,reg_date,reg_time,sp_msg,dollar,assoc_name,member_of_assoc,assoc_srno,
	user_type,conference_type, day1, day2, day3) values ('$cata_m','$nationality','$cata','$curr','$grp','$total_dele','$paymode','$pay_status','$amt_ext','$rate_org','$amt','$amt','$reg_id','$ddate','$ttime','$temp_sess_sp_msg','$dollar','$assoc_name', '$member_of_assoc','$assoc_srno','$user_type','$conf_type','$day_1','$day_2','$day_3')") or die(mysqli_error($link));

$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
$res = mysqli_fetch_array($qry);

//----------------------------------------- End Geneating Tin Number ----------------------------------------------------

$tin_no = $EVENT_DB_TIN_NO;
if ($_POST['daytype'] == 'Single Day') {
	$tin_no = $EVENT_DB_TIN_NO = "TIN-BTSSD" . $EVENT_YEAR . "-";
}

/*if($sector == 'Bio Technology') {		
	   $tin_no = $EVENT_DB_TIN_NO="TIN-BIB".$EVENT_YEAR."-";

	   if($_POST['daytype'] == 'Single Day') {
		   $tin_no = $EVENT_DB_TIN_NO="TIN-BIBSD".$EVENT_YEAR."-";
	   }
   }*/

$tin_no1 = "";

$i = 0;
$j = 0;

$temp_srno_gt = $res['srno'];
do {
	$i = $j = 0;

	$tin_no1 = $tin_no . $temp_srno_gt . mt_rand(1, 99999);

	$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE tin_no = '$tin_no1'");
	$res_no = mysqli_num_rows($qry);

	$qry1 = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no1'");
	$res_no1 = mysqli_num_rows($qry1);

	if (($res_no == 0) || ($res_no1 == 0)) {
		$i++;
		$j++;
	} else {
		$i = 0;
		$j = 0;
		$tin_no1 = "";
	}
} while (($i <= 0) || ($j <= 0));

//------------------------------------------ End Geneating Tin Number ----------------------------------------------------
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET tin_no = '$tin_no1' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));

/* if(isset($_POST['daytype']) && !empty($_POST['daytype'])) {
	   $offer = '';
	   if($_POST['daytype'] == '3 days with speaker offer') {
		   $offer = 'YOU ARE ALSO ENTITLED FOR A FREE <u>PHILIPS BT50B WIRELESS SPEAKER WORTH Rs. 2000 FREE</u> ALONG WITH THIS REGISTRATION.';
	   } else if($_POST['daytype'] == '3 days with power bank offer') {
		   $offer = 'YOU ARE ALSO ENTITLED FOR A FREE <u>MI 20800 MAH POWER BANK WORTH RS. 2,999 FREE</u> ALONG WITH THIS REGISTRATION.';
	   }
	   if(!empty($offer)) {
		   mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET user_type = '$offer' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	   }
   } */

mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET event_name = '$event_name', sector = '$sector' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));

mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET event_know = '$event_know' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));

//exit;
$gst_number = '';
if ($gst == 'Registered') {
	$gst_number = $_POST['gst_number'];
} else if ($gst == 'Unregistered') {
	$gst_number = 'Not Applicable';
}

$fone = '';
if (!empty($_POST['fone'])) {
	$fone = '+' . mysqli_real_escape_string($link,htmlspecialchars($_POST['foneCountryCode'])) . "-" . mysqli_real_escape_string($link,htmlspecialchars($_POST['fone']));
}
$fax = '';
if (!empty($_POST['fax'])) {
	$fax = '+' . mysqli_real_escape_string($link,htmlspecialchars(@$_POST['faxCountryCode'])) . "-" . mysqli_real_escape_string($link,htmlspecialchars(@$_POST['fax']));
}
//exit;
//echo "UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET org='$org',addr1='$addr1',addr2='$addr2',city='$city',state='$state',country='$country',pin='$pin',fone='$fone',fax='$fax' WHERE reg_id = '$reg_id' ";
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET org='$org',nature='$nature',addr1='$addr1',addr2='$addr2',city='$city',state='$state',country='$country',pin='$pin',fone='$fone',fax='$fax', gst_number='$gst_number',
                is_gst_invoice_needed='$is_gst_invoice_needed', gst_inv_addr='$gst_inv_addr', gst_inv_reg_no='$gst_inv_reg_no', gst_inv_pan='$gst_inv_pan', gst_inv_state='$gst_inv_state', gst_inv_cp='$gst_inv_cp', gst_inv_phone='$gst_inv_phone', gst_inv_email='$gst_inv_email' WHERE reg_id = '$reg_id' ") or die(mysqli_error($link));
				mysqli_close($link);
echo "<script language='javascript'>window.location = 'registration5_es.php?en=$en&assoc_name=$assoc_name';</script>";
exit;
?>
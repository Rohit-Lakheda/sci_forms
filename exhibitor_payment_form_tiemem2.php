<?php
session_start();
//print_r($_POST);exit;
if (empty($_SESSION["vercode_ex"]) || ($_POST["vercode_ex"] != $_SESSION["vercode_ex"])) {
	session_destroy();
	echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
	echo "<script language='javascript'>window.location = 'exhibitor_payment_form_tiemem.php';</script>";
	exit;
}

require("includes/form_constants_both.php");
require "dbcon_open.php";

$reg_id = $_SESSION['vercode_ex'];

$_SESSION['sess_subsector'] = $temp_exhi_subsector = @$_POST['subsector'];
if ($temp_exhi_subsector == 'Other') {
	$temp_exhi_subsector = 'Other -' . $_POST['other-sector'];
	$_SESSION['sess_other_sector'] = $_POST['other-sector'];
}
$_SESSION['sess_sector'] = $temp_exhi_sector = @$_POST['sector'];

$eventName = 'BengaluruITE.BIZ';
$event_name = 'Bangalore IT';
/*if($temp_exhi_sector == 'Bio Technology') {
		$eventName = 'Bengaluru INDIA BIO';
		$event_name = 'Bangalore INDIA BIO';
	}*/
$curr = @$_POST['curr'];
$assoc_nm = @$_POST['assoc_nm'];

$temp_exhi_sector = trim($temp_exhi_sector);

$temp_exhi_name = mysqli_real_escape_string($link,@$_POST['exhi_name']);

$temp_cp_title = @$_POST['cp_title'];
$temp_cp_title = trim($temp_cp_title);

$temp_cp_fname = mysqli_real_escape_string($link,@$_POST['cp_fname']);
$temp_cp_fname = trim($temp_cp_fname);

$temp_cp_lname = mysqli_real_escape_string($link,@$_POST['cp_lname']);
$temp_cp_lname = trim($temp_cp_lname);
$temp_cp_desig = @$_POST['cp_desig'];
$temp_addr1 = mysqli_real_escape_string($link,@$_POST['addr1']);
$temp_addr2 = @$_POST['addr2'];
$temp_city = @$_POST['city'];
$temp_state = @$_POST['state'];
$temp_country = @$_POST['country'];
$temp_zip = @$_POST['zip'];
$temp_fon_cntry = @$_POST['foneCountryCode'];
$temp_fon = @$_POST['fon'];
$temp_mob_cntry = @$_POST['cellnoCountryCode'];
$temp_mob = @$_POST['mob'];
$temp_email = @$_POST['email'];
$temp_email = strtolower(trim($temp_email));
$temp_reg_date = date("Y-m-d");
$temp_reg_time = date("H:i:s a");
$temp_reg_id = @$_POST['vercode_ex'];
$temp_gst_number = @$_POST['gst_number'];

$temp_del_title = @$_POST['del_title'];
$temp_del_title = trim($temp_del_title);
$temp_del_fname = @$_POST['del_fname'];
$temp_del_fname = trim($temp_del_fname);
$temp_del_lname = @$_POST['del_lname'];
$temp_del_lname = trim($temp_del_lname);
$temp_del_mob_cntry = @$_POST['del_cellnoCountryCode'];
$temp_del_mob = @$_POST['del_mob'];
$temp_del_email = @$_POST['del_email'];

$temp_del_title2 = @$_POST['del_title2'];
$temp_del_title2 = trim($temp_del_title2);
$temp_del_fname2 = @$_POST['del_fname2'];
$temp_del_fname2 = trim($temp_del_fname2);
$temp_del_lname2 = @$_POST['del_lname2'];
$temp_del_lname2 = trim($temp_del_lname2);
$temp_del_mob_cntry2 = @$_POST['del_cellnoCountryCode2'];
$temp_del_mob2 = @$_POST['del_mob2'];
$temp_del_email2 = @$_POST['del_email2'];

//Partner
$temp_part_title = @$_POST['part_title'];
$temp_part_title = trim($temp_part_title);
$temp_part_fname = @$_POST['part_fname'];
$temp_part_fname = trim($temp_part_fname);
$temp_part_lname = @$_POST['part_lname'];
$temp_part_lname = trim($temp_part_lname);
$temp_part_mob_cntry = @$_POST['part_cellnoCountryCode'];
$temp_part_mob = @$_POST['part_mob'];
$temp_part_email = @$_POST['part_email'];

$paymode = $temp_paymode = @$_POST['paymode'];
$temp_website = @$_POST['website'];
$temp_exbhi_profile = @$_POST['exbhi_profile'];

$_SESSION['sess_curr'] = $curr;
$_SESSION['sess_exhi_name'] = $temp_exhi_name;
$_SESSION['sess_cp_title'] = $temp_cp_title;
$_SESSION['sess_cp_fname'] = $temp_cp_fname;
$_SESSION['sess_cp_lname'] = $temp_cp_lname;
$_SESSION['sess_cp_desig'] = $temp_cp_desig;
$_SESSION['sess_email'] = $temp_email;
$_SESSION['sess_mobile'] = $temp_mob;
$_SESSION['sess_addr1'] = $temp_addr1;
$_SESSION['sess_addr2'] = $temp_addr2;
$_SESSION['sess_city'] = $temp_city;
$_SESSION['sess_state'] = $temp_state;
$_SESSION['sess_country'] = $temp_country;
$_SESSION['sess_zip'] = $temp_zip;
$_SESSION['sess_foneCountryCode'] = $temp_fon_cntry;
$_SESSION['sess_fon'] = $temp_fon;
$_SESSION['sess_cellnoCountryCode'] = $temp_mob_cntry;
$_SESSION['sess_mob'] = $temp_mob;
$_SESSION['sess_vercode_ex'] = $temp_reg_id;
$_SESSION['vercode_ex'] = $temp_reg_id;
$_SESSION['sess_paymode'] = $temp_paymode;
$_SESSION['gst'] = @$_POST['gst'];
$_SESSION['pan_number'] = $pan_number = @$_POST['pan_number'];
$_SESSION['booth_size'] = $booth_size = @$_POST['booth_size'];
$_SESSION['assoc_nm'] = $assoc_nm;

$_SESSION['sess_del_title'] = $temp_del_title;
$_SESSION['sess_del_fname'] = $temp_del_fname;
$_SESSION['sess_del_lname'] = $temp_del_lname;
$_SESSION['sess_del_email'] = $temp_del_email;
$_SESSION['sess_del_mobile_cntry'] = $temp_del_mob_cntry;
$_SESSION['sess_del_mobile'] = $temp_del_mob;
$_SESSION['sess_website'] = $temp_website;
$_SESSION['sess_exbhi_profile'] = $temp_exbhi_profile;
$_SESSION['sess_fascia_name'] = $temp_fascia_name = @$_POST['fascia_name'];
$_SESSION['sess_part_desig'] = $temp_part_desig = @$_POST['part_desig'];

$_SESSION['sess_del_desig'] = $temp_del_desig = @$_POST['del_desig'];
$_SESSION['sess_del_desig2'] = $temp_del_desig2 = @$_POST['del_desig2'];

$gst = $_POST['gst'];
$_SESSION['gst_number'] = '';
if ($gst == 'Registered') {
	$temp_gst_number = $_SESSION['gst_number'] = $_POST['gst_number'];
} else if ($gst == 'Unregistered') {
	$temp_gst_number = 'Not Applicable';
}
//exit;


/* Start Company Registration Certificate Upload */

if (isset($_FILES['ci_certf']['name']) && !empty($_FILES['ci_certf']['name'])) {

	$maxsize    = 4194304;
	$file_size = $_FILES['ci_certf']['size'];
	$file_type = pathinfo($_FILES['ci_certf']['name'], PATHINFO_EXTENSION);
	$mimeType = array('pdf', 'PDF');

	if (!in_array($file_type, $mimeType)) {
		echo "<script language='javascript'>alert('Please upload only PDF file.');</script>";
		echo "<script language='javascript'>window.location='exhibitor_payment_form_tiemem.php';</script>";
		exit;
	}
	if ($file_size > $maxsize) {
		echo "<script language='javascript'>alert('File size must under 1MB!');</script>";
		echo "<script language='javascript'>window.location='exhibitor_payment_form_tiemem.php';</script>";
		exit;
	}

	$ci_certf_UploadPath = 'photo/';

	if (!file_exists($ci_certf_UploadPath)) {
		mkdir($ci_certf_UploadPath, 0777);
	}

	$filePath = $ci_certf_UploadPath . 'ci_certf_' . date("dmyHis") . $reg_id . '.' . pathinfo($_FILES['ci_certf']['name'], PATHINFO_EXTENSION);
	$filePath = $filePath . ".pdf";
	//echo "<br />fp:" . $filePath;

	if (move_uploaded_file($_FILES['ci_certf']['tmp_name'], $filePath)) {
	} else {
		echo "<script language='javascript'>alert('Error in Uploading Company Registration Certificate, Please try again or contact admin');</script>";
		echo "<script language='javascript'>window.location='exhibitor_payment_form_tiemem.php';</script>";
		exit;
	}

	$filePath = $EVENT_FORM_LINK . $filePath;
}

//echo "<br />pass1" . $_FILES['ci_certf']['name'];
//echo "<br />pas2" . $filePath;
//exit;

if (!isset($filePath)) {
	echo "<script language='javascript'>alert('Please upload your Company Certificate in PDF format.');</script>";
	echo "<script language='javascript'>window.location='exhibitor_payment_form_tiemem.php';</script>";
	exit;
}


/* End Company Registration Certification upload */

$temp_reg_date = date("Y-m-d");
$temp_reg_time = date("H:i:s");

$fone = '';
if (!empty($_POST['fon'])) {
	$fone = $temp_fon_cntry . "-" . $temp_fon;
}
$mob = $temp_mob_cntry . "-" . $temp_mob;

if (($temp_exhi_name == "") || ($temp_addr1 == "") || ($temp_city == "")  || ($temp_state == "")  || ($temp_zip == "") || ($temp_email == "")) {
	echo "<script language='javascript'>alert('Provided all required (* marked) details .');</script>";
	echo "<script language='javascript'>window.location = 'exhibitor_payment_form_tiemem.php?rt=retds4fn324rn_ed24d3it';</script>";
	exit;
}

$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE cp_email = '$temp_email'") or die(mysqli_error($link));
if (mysqli_num_rows($qr) > 0) {
	echo "<script language='javascript'>alert('Entered contact perrson email address already registered with us. Please add another email address.');</script>";
	echo "<script language='javascript'>window.location = 'exhibitor_payment_form_tiemem.php?rt=retds4fn324rn_ed24d3it';</script>";
}

if (!empty($temp_del_email)) {
	for ($j = 1; $j <= 7; $j++) {
		$email = $temp_del_email;
		$field = "email" . $j;
		$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$email'") or die(mysqli_error($link));
		$num_row = mysqli_num_rows($qr);
		if ($num_row > 0) {
			echo "<script language='javascript'>alert('The email id \'" . $email . "\' is already registered with us as a premium delegate.');</script>";
			echo "<script language='javascript'>window.location = ('exhibitor_payment_form_tiemem.php?rt=retds4fn324rn_ed24d3it');</script>";
			exit;
		}

		$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'") or die(mysqli_error($link));
		if (mysqli_num_rows($qr) > 0) {
			echo "<script language='javascript'>alert('Entered delegate email address already registered with us. Please add another delegate email address.');</script>";
			echo "<script language='javascript'>window.location = 'exhibitor_payment_form_tiemem.php?rt=retds4fn324rn_ed24d3it';</script>";
		}
	}
}
$ret = @$_GET['rt'];

if ($ret == "retds4fn324rn_ed24d3it") {
	mysqli_query($link,"delete from " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " where reg_id = '$reg_id' ") or die(mysqli_error($link));
}
if (empty($temp_paymode)) {
	$paymode = $temp_paymode = 'Credit Card';
}
$processing_charge_per = $processing_charge = 0;
if ($curr == "Indian") {
	$dollar      = "1";
	$amt_ext     = "Rs.";
	//$selection_amt = "9999";
	$nationality = 'Indian';

	if ($paymode == 'Credit Card' || $paymode == 'Cashfree') {
		$processing_charge_per = $CC_IND_PROCESSING_CHARGE_PER;
	}
} else {
	$dollar      = $DOLLAR_RATE;
	$amt_ext     = "USD";
	//$selection_amt = "150";
	$nationality = 'International';

	if ($paymode == 'Paypal') {
		$processing_charge_per = $PAYPAL_PROCESSING_CHARGE_PER;
	} else if ($paymode == 'Credit Card') {
		$processing_charge_per = $CC_INT_PROCESSING_CHARGE_PER;
	}
}

if ($booth_size == '4 SQM') {
	$selection_amt = 24999;
} /*else if ($booth_size == '6 SQM') {
	$selection_amt = 39999;
}*/
//echo "UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET org='$org',addr1='$addr1',addr2='$addr2',city='$city',state='$state',country='$country',pin='$pin',fone='$fone',fax='$fax' WHERE reg_id = '$reg_id' ";
mysqli_query($link,"INSERT INTO " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . "(sector,subsector,exhibitor_name,reg_id,reg_date,reg_time,ci_certf,website)" .
	" VALUES('$temp_exhi_sector','$temp_exhi_subsector', '$temp_exhi_name','$reg_id','$temp_reg_date','$temp_reg_time','$filePath','$temp_website') ") or die(mysqli_error($link));
$assoc_nm = 'Tie-Bangalore(members)';
$sql = "UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " SET cp_title='$temp_cp_title',cp_fname='$temp_cp_fname',
			cp_lname='$temp_cp_lname',cp_mobile='$mob',cp_email='$temp_email',cp_desig='$temp_cp_desig',addr1='$temp_addr1',addr2='$temp_addr2',city='$temp_city',
			state='$temp_state',country='$temp_country',zip='$temp_zip',phone='$fone',gst_number='$temp_gst_number',paymode='$temp_paymode',
			amt_ext='$amt_ext',pay_status='Not Paid',selection_amt='$selection_amt',total='$selection_amt',event_name='$event_name',dollar='$dollar',
			curr='$curr',nationality='$nationality', pan_number='$pan_number',booth_size='$booth_size', user_type='$assoc_nm' WHERE reg_id = '$reg_id'";
mysqli_query($link,$sql);

if (!empty($processing_charge_per)) {
	$main_amt = $selection_amt;
	$tax = round(($main_amt * $SERVICE_TAX) / 100);
	$total = round($main_amt + $tax);

	$processing_charge = round(($total * $processing_charge_per) / 100);
	$total = round($total + $processing_charge);

	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " SET total = '$total' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
}

mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " SET tax = '$tax' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));

mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " SET processing_charge_per = '$processing_charge_per' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " SET processing_charge = '$processing_charge' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));

$tin_no  = "TIN-BTS" . $EVENT_YEAR . "-EXHST-";
/*if($temp_exhi_sector == 'Bio Technology') {
		$tin_no = $EVENT_DB_TIN_NO="TIN-BIBEX".$EVENT_YEAR."-";
	}*/
$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
$res = mysqli_fetch_array($qry);

$tin_no1 = "";

$i = 0;
$j = 0;

$temp_srno_gt = $res['srno'];
do {
	$i = $j = 0;

	$tin_no1 = $tin_no . $temp_srno_gt . mt_rand(1, 99999);

	$qry    = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE tin_no = '$tin_no1'");
	$res_no = mysqli_num_rows($qry);

	$qry1    = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " WHERE tin_no = '$tin_no1'");
	$res_no1 = mysqli_num_rows($qry1);

	if (($res_no == 0) || ($res_no1 == 0)) {
		$i++;
		$j++;
	} else {
		$i       = 0;
		$j       = 0;
		$tin_no1 = "";
	}
} while (($i <= 0) || ($j <= 0));

//------------------------------------------ End Geneating Tin Number ----------------------------------------------------
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " SET tin_no = '$tin_no1' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
//exit;
$reg_id = 'ex' . $reg_id;
$pin_no = str_replace('TIN', 'PRN', $tin_no1);

$sub_delegates = 2;
if (!empty($temp_del_email2)) {
	$sub_delegates = 3;
}

/*mysqli_query($link,"insert into ".$EVENT_DB_FORM_REG_DEMO."(org_reg_type,nationality,curr,gr_type,sub_delegates,paymode,pay_status,amt_ext,reg_id,reg_date,reg_time,sector,tin_no,pin_no, cata) values 
	('Conference Delegate','$nationality','$curr','Single','$sub_delegates','Complimentary','Complimentary','$amt_ext','$reg_id','$temp_reg_date','$temp_reg_time','$temp_exhi_sector','$tin_no1', '$pin_no', 'Complimentary Exhibitors Delegate')")or die(mysqli_error($link));

	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET org='$temp_exhi_name',addr1='$temp_addr1',addr2='$temp_addr2',city='$temp_city',
	state='$temp_state',country='$temp_country',pin='$temp_zip',fone='$fone' WHERE reg_id = '$reg_id' ") or die(mysqli_error($link));

	$badge = $temp_del_title . ' ' . $temp_del_fname . ' ' . $temp_del_lname;
	$temp_del_mob = $temp_del_mob_cntry . '-' . $temp_del_mob;
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET title1 = '$temp_del_title' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET fname1 = '$temp_del_fname' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET lname1 = '$temp_del_lname' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET badge1 = '$badge' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET email1 = '$temp_del_email' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cellno1 = '$temp_del_mob' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cata1 = 'Conference Delegate' where reg_id = '$reg_id'") or die(mysqli_error($link));
	
	$badge2 = $temp_del_title2 . ' ' . $temp_del_fname2 . ' ' . $temp_del_lname2;
	$temp_del_mob2 = $temp_del_mob_cntry2 . '-' . $temp_del_mob2;
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET title3 = '$temp_del_title2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET fname3 = '$temp_del_fname2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET lname3 = '$temp_del_lname2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET badge3 = '$badge2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET email3 = '$temp_del_email2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cellno3 = '$temp_del_mob2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cata3 = 'Conference Delegate' where reg_id = '$reg_id'") or die(mysqli_error($link));

	$badge = $temp_part_title . ' ' . $temp_part_fname . ' ' . $temp_part_lname;
	$temp_part_mob = $temp_part_mob_cntry . '-' . $temp_part_mob;
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET title2 = '$temp_part_title' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET fname2 = '$temp_part_fname' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET lname2 = '$temp_part_lname' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET badge2 = '$badge' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET email2 = '$temp_part_email' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cellno2 = '$temp_part_mob' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cata2 = 'Premium Delegate' where reg_id = '$reg_id'") or die(mysqli_error($link));

	//mysqli_query($link,"INSERT INTO ".$EVENT_DB_FORM_REG_TBL_LOGIN."(tin_no,reg_id,title,fname,lname,email,cata,user_name,pass1,pass2) VALUES ('$tno','$reg_id','$title','$fname','$lname','$email','$cata','$email','$pas1','$pas2')") or die(mysqli_error($link));
    */
echo "<script language='javascript'>window.location = 'exhibitor_payment_form_tiemem3.php';</script>";
exit;

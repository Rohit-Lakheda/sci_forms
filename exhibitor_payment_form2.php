<?php

session_start();
ini_set('display_errors', 1);

// print_r($_POST);exit;

require ("form_includes/form_constants_both.php");

require "dbcon_open.php";

if (empty($_SESSION["vercode_ex"]) || (mysqli_escape_string($link,htmlspecialchars($_POST["vercode_ex"])) != $_SESSION["vercode_ex"])) {

	session_destroy();

	echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";

	echo "<script language='javascript'>window.location = 'exhibitor_payment_form.php?assoc_nm=$assoc_nm';</script>";

	exit;

}







$reg_id = $_SESSION['vercode_ex'];



$_SESSION['sess_subsector'] = $temp_exhi_subsector = mysqli_real_escape_string($link, htmlspecialchars(@$_POST['subsector']));

if ($temp_exhi_subsector == 'Other') {

	$temp_exhi_subsector = 'Other -' . mysqli_escape_string($link,htmlspecialchars($_POST['other-sector']));

	$_SESSION['sess_other_sector'] = mysqli_escape_string($link,htmlspecialchars($_POST['other-sector']));

}

$_SESSION['sess_sector'] = $temp_exhi_sector = mysqli_escape_string($link,htmlspecialchars(@$_POST['sector']));


$event_name = 'Super Computing India';


$curr = mysqli_escape_string($link,htmlspecialchars(@$_POST['curr']));

$assoc_nm = mysqli_escape_string($link,htmlspecialchars(@$_POST['assoc_nm']));



$temp_exhi_sector = trim($temp_exhi_sector);



$temp_exhi_name = mysqli_escape_string($link,htmlspecialchars(@$_POST['exhi_name']));



$temp_cp_title = mysqli_escape_string($link,htmlspecialchars(@$_POST['cp_title']));

$temp_cp_title = trim($temp_cp_title);



$temp_cp_fname = mysqli_escape_string($link,htmlspecialchars(@$_POST['cp_fname']));

$temp_cp_fname = trim($temp_cp_fname);



$temp_cp_lname = mysqli_escape_string($link,htmlspecialchars(@$_POST['cp_lname']));

$temp_cp_lname = trim($temp_cp_lname);

$temp_cp_desig = mysqli_escape_string($link,htmlspecialchars(@$_POST['cp_desig']));

$temp_comp_years = mysqli_escape_string($link,htmlspecialchars(@$_POST['comp_years']));

$temp_addr1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['addr1']));

$temp_addr2 = mysqli_escape_string($link,htmlspecialchars(@$_POST['addr2']));

$temp_city = mysqli_escape_string($link,htmlspecialchars(@$_POST['city']));

$temp_state = mysqli_escape_string($link,htmlspecialchars(@$_POST['state']));

$temp_country = mysqli_escape_string($link,htmlspecialchars(@$_POST['country']));

$temp_zip = mysqli_escape_string($link,htmlspecialchars(@$_POST['zip']));

$temp_fon_cntry = mysqli_escape_string($link,htmlspecialchars(@$_POST['foneCountryCode']));

$temp_fon = mysqli_escape_string($link,htmlspecialchars(@$_POST['fon']));

$temp_mob_cntry = mysqli_escape_string($link,htmlspecialchars(@$_POST['cellnoCountryCode']));

$temp_mob = mysqli_escape_string($link,htmlspecialchars(@$_POST['mob']));

$temp_email = mysqli_escape_string($link,htmlspecialchars(@$_POST['email']));

$temp_email = strtolower(trim($temp_email));

$temp_reg_date = date("Y-m-d");

$temp_reg_time = date("H:i:s a");

$temp_reg_id = mysqli_escape_string($link,htmlspecialchars(@$_POST['vercode_ex']));

$temp_gst_number = mysqli_escape_string($link,htmlspecialchars(@$_POST['gst_number']));



$temp_del_title = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_title']));

$temp_del_title = trim($temp_del_title);

$temp_del_fname = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_fname']));

$temp_del_fname = trim($temp_del_fname);

$temp_del_lname = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_lname']));

$temp_del_lname = trim($temp_del_lname);

$temp_del_mob_cntry = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_cellnoCountryCode']));

$temp_del_mob = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_mob']));

$temp_del_email = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_email']));



$temp_del_title2 = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_title2']));

$temp_del_title2 = trim($temp_del_title2);

$temp_del_fname2 = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_fname2']));

$temp_del_fname2 = trim($temp_del_fname2);

$temp_del_lname2 = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_lname2']));

$temp_del_lname2 = trim($temp_del_lname2);

$temp_del_mob_cntry2 = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_cellnoCountryCode2']));

$temp_del_mob2 = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_mob2']));

$temp_del_email2 = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_email2']));



//Partner

$temp_part_title = mysqli_escape_string($link,htmlspecialchars(@$_POST['part_title']));

$temp_part_title = trim($temp_part_title);

$temp_part_fname = mysqli_escape_string($link,htmlspecialchars(@$_POST['part_fname']));

$temp_part_fname = trim($temp_part_fname);

$temp_part_lname = mysqli_escape_string($link,htmlspecialchars(@$_POST['part_lname']));

$temp_part_lname = trim($temp_part_lname);

$temp_part_mob_cntry = mysqli_escape_string($link,htmlspecialchars(@$_POST['part_cellnoCountryCode']));

$temp_part_mob = mysqli_escape_string($link,htmlspecialchars(@$_POST['part_mob']));

$temp_part_email = mysqli_escape_string($link,htmlspecialchars(@$_POST['part_email']));



$paymode = $temp_paymode = mysqli_escape_string($link,htmlspecialchars(@$_POST['paymode']));

$temp_website = mysqli_escape_string($link,htmlspecialchars(@$_POST['website']));

$temp_exbhi_profile = mysqli_escape_string($link,htmlspecialchars(@$_POST['exbhi_profile']));



$_SESSION['sess_curr'] = $curr;

$_SESSION['sess_exhi_name'] = $temp_exhi_name;

$_SESSION['sess_cp_title'] = $temp_cp_title;

$_SESSION['sess_cp_fname'] = $temp_cp_fname;

$_SESSION['sess_cp_lname'] = $temp_cp_lname;

$_SESSION['sess_cp_desig'] = $temp_cp_desig;

$_SESSION['sess_email'] = $temp_email;

$_SESSION['sess_mobile'] = $temp_mob;

$_SESSION['comp_years'] = $temp_comp_years;

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

$_SESSION['pan_number'] = $pan_number = mysqli_escape_string($link,htmlspecialchars(@$_POST['pan_number']));

$_SESSION['booth_size'] = $booth_size = mysqli_escape_string($link,htmlspecialchars(@$_POST['booth_size']));

$_SESSION['assoc_nm'] = $assoc_nm;


// print($booth_size);
// exit;
//booth_space

$_SESSION['booth_space'] = $booth_space = mysqli_escape_string($link,htmlspecialchars(@$_POST['booth_space']));





$_SESSION['sess_del_title'] = $temp_del_title;

$_SESSION['sess_del_fname'] = $temp_del_fname;

$_SESSION['sess_del_lname'] = $temp_del_lname;

$_SESSION['sess_del_email'] = $temp_del_email;

$_SESSION['sess_del_mobile_cntry'] = $temp_del_mob_cntry;

$_SESSION['sess_del_mobile'] = $temp_del_mob;

$_SESSION['sess_website'] = $temp_website;

$_SESSION['sess_exbhi_profile'] = $temp_exbhi_profile;

$_SESSION['sess_fascia_name'] = $temp_fascia_name = mysqli_escape_string($link,htmlspecialchars(@$_POST['fascia_name']));

$_SESSION['sess_part_desig'] = $temp_part_desig = mysqli_escape_string($link,htmlspecialchars(@$_POST['part_desig']));



$_SESSION['sess_del_desig'] = $temp_del_desig = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_desig']));

$_SESSION['sess_del_desig2'] = $temp_del_desig2 = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_desig2']));



$gst = mysqli_escape_string($link,htmlspecialchars($_POST['gst']));

$_SESSION['gst_number'] = '';

if ($gst == 'Registered') {

	$temp_gst_number = $_SESSION['gst_number'] = mysqli_escape_string($link,htmlspecialchars($_POST['gst_number']));

} else if ($gst == 'Unregistered') {

	$temp_gst_number = 'Not Applicable';

}

//exit;

if ($assoc_nm === '') {

	$assoc_nm = 'Startup Exhibitor';

}


// echo $booth_size;
// die;


/* Start Company Registration Certificate Upload */



if (isset($_FILES['ci_certf']['name']) && !empty($_FILES['ci_certf']['name'])) {

	// Check for upload errors
	if ($_FILES['ci_certf']['error'] !== UPLOAD_ERR_OK) {
		$error_message = 'Unknown upload error';
		switch ($_FILES['ci_certf']['error']) {
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				$error_message = 'File size exceeds the maximum allowed size (2MB)';
				break;
			case UPLOAD_ERR_PARTIAL:
				$error_message = 'File was only partially uploaded';
				break;
			case UPLOAD_ERR_NO_FILE:
				$error_message = 'No file was uploaded';
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$error_message = 'Missing temporary folder';
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$error_message = 'Failed to write file to disk';
				break;
			case UPLOAD_ERR_EXTENSION:
				$error_message = 'File upload stopped by extension';
				break;
		}
		echo "<script language='javascript'>alert('Upload Error: $error_message');</script>";
		echo "<script language='javascript'>window.location='exhibitor_payment_form.php?assoc_nm=$assoc_nm';</script>";
		exit;
	}

	$maxsize = 2097152; // 2MB in bytes (2 * 1024 * 1024)

	$file_size = $_FILES['ci_certf']['size'];

	$file_type = strtolower(pathinfo($_FILES['ci_certf']['name'], PATHINFO_EXTENSION));

	$mimeType = array('pdf');

	if (!in_array($file_type, $mimeType)) {
		echo "<script language='javascript'>alert('Please upload only PDF file.');</script>";
		echo "<script language='javascript'>window.location='exhibitor_payment_form.php?assoc_nm=$assoc_nm';</script>";
		exit;
	}

	if ($file_size > $maxsize) {
		echo "<script language='javascript'>alert('File size must be less than 2MB!');</script>";
		echo "<script language='javascript'>window.location='exhibitor_payment_form.php?assoc_nm=$assoc_nm';</script>";
		exit;
	}

	$ci_certf_UploadPath = 'photo/';

	if (!file_exists($ci_certf_UploadPath)) {
		if (!mkdir($ci_certf_UploadPath, 0777, true)) {
			echo "<script language='javascript'>alert('Error: Unable to create upload directory. Please contact admin.');</script>";
			echo "<script language='javascript'>window.location='exhibitor_payment_form.php?assoc_nm=$assoc_nm';</script>";
			exit;
		}
	}

	// Sanitize reg_id for use in filename
	$safe_reg_id = preg_replace('/[^a-zA-Z0-9]/', '_', $reg_id);
	
	// Generate unique filename without double extension
	$filePath = $ci_certf_UploadPath . 'ci_certf_' . date("dmyHis") . '_' . $safe_reg_id . '.pdf';

	// Check if file already exists and add a counter if needed
	$counter = 1;
	$originalPath = $filePath;
	while (file_exists($filePath)) {
		$filePath = $ci_certf_UploadPath . 'ci_certf_' . date("dmyHis") . '_' . $safe_reg_id . '_' . $counter . '.pdf';
		$counter++;
	}

	if (move_uploaded_file($_FILES['ci_certf']['tmp_name'], $filePath)) {
		// File uploaded successfully
	} else {
		$error_details = '';
		if (!is_writable($ci_certf_UploadPath)) {
			$error_details = ' Upload directory is not writable.';
		} elseif (!is_uploaded_file($_FILES['ci_certf']['tmp_name'])) {
			$error_details = ' Invalid file upload.';
		}
		echo "<script language='javascript'>alert('Error in Uploading Company Registration Certificate$error_details Please try again or contact admin');</script>";
		echo "<script language='javascript'>window.location='exhibitor_payment_form.php?assoc_nm=$assoc_nm';</script>";
		exit;
	}

	$filePath = $EVENT_FORM_LINK . $filePath;
}



//echo "<br />pass1" . $_FILES['ci_certf']['name'];

//echo "<br />pas2" . $filePath;

//exit;



if (!isset($filePath)) {

	echo "<script language='javascript'>alert('Please upload your Company Certificate in PDF format.');</script>";

	echo "<script language='javascript'>window.location='exhibitor_payment_form.php?assoc_nm=$assoc_nm';</script>";

	exit;

}





/* End Company Registration Certification upload */



$temp_reg_date = date("Y-m-d");

$temp_reg_time = date("H:i:s");



$fone = '';

if (!empty(mysqli_escape_string($link,htmlspecialchars($_POST['fon'])))) {

	$fone = $temp_fon_cntry . "-" . $temp_fon;

}

$mob = $temp_mob_cntry . "-" . $temp_mob;



if (($temp_exhi_name == "") || ($temp_comp_years == "") || ($temp_addr1 == "") || ($temp_city == "") || ($temp_state == "") || ($temp_zip == "") || ($temp_email == "")) {

	echo "<script language='javascript'>alert('Provided all required (* marked) details .');</script>";

	echo "<script language='javascript'>window.location = 'exhibitor_payment_form.php?assoc_nm=$assoc_nm&rt=retds4fn324rn_ed24d3it';</script>";

	exit;

}



$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE cp_email = '$temp_email'") or die(mysqli_error($link));

if (mysqli_num_rows($qr) > 0) {

	echo "<script language='javascript'>alert('Entered contact perrson email address already registered with us. Please add another email address.');</script>";

	echo "<script language='javascript'>window.location = 'exhibitor_payment_form.php?assoc_nm=$assoc_nm&rt=retds4fn324rn_ed24d3it';</script>";

}







if (!empty($temp_del_email)) {

	for ($j = 1; $j <= 7; $j++) {

		$email = $temp_del_email;

		$field = "email" . $j;

		$field = mysqli_escape_string($link,htmlspecialchars($field));

		$email = mysqli_escape_string($link,htmlspecialchars($email));

		$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$email'") or die(mysqli_error($link));

		$num_row = mysqli_num_rows($qr);

		if ($num_row > 0) {

			echo "<script language='javascript'>alert('The email id \'" . $email . "\' is already registered with us as a premium delegate.');</script>";

			echo "<script language='javascript'>window.location = ('exhibitor_payment_form.php?assoc_nm=$assoc_nm&rt=retds4fn324rn_ed24d3it');</script>";

			exit;

		}



		$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'") or die(mysqli_error($link));

		if (mysqli_num_rows($qr) > 0) {

			echo "<script language='javascript'>alert('Entered delegate email address already registered with us. Please add another delegate email address.');</script>";

			echo "<script language='javascript'>window.location = 'exhibitor_payment_form.php?assoc_nm=$assoc_nm&rt=retds4fn324rn_ed24d3it';</script>";

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

	$dollar = "1";

	$amt_ext = "Rs.";

	//$selection_amt = "9999";

	$nationality = 'Indian';



	if ($paymode == 'Credit Card' || $paymode == 'Cashfree') {

		$processing_charge_per = $CC_IND_PROCESSING_CHARGE_PER;

	}

} else {

	$dollar = $DOLLAR_RATE;

	$amt_ext = "USD";

	//$selection_amt = "150";

	$nationality = 'International';



	if ($paymode == 'Paypal') {

		$processing_charge_per = $PAYPAL_PROCESSING_CHARGE_PER;

	} else if ($paymode == 'Credit Card') {

		$processing_charge_per = $CC_INT_PROCESSING_CHARGE_PER;

	}

}



/*if ($booth_size == '4 SQM') {

	$selection_amt = 24999;

} else if ($booth_size == '6 SQM') {

	$selection_amt = 39999;

}*/

//if booth space is  Premium Stall 

if ($booth_space == "Premium Stall") {

	//alert that premium stall is sold out 

	echo "<script language='javascript'>alert('Premium Stall is sold out. Please select Standard Stall.');</script>";

	//redirect to exhibitor_payment_form.php

	echo "<script language='javascript'>window.location = 'exhibitor_payment_form.php?assoc_nm=$assoc_nm&rt=retds4fn324rn_ed24d3it';</script>";

	exit;

}



// if ($booth_size == '3 SQM') {

// 	if ($booth_space == "Standard Stall") {

// 		$selection_amt = 16999;

// 	} else {

// 		$selection_amt = 30000; // Default to Premium Stall amount

// 	}

// } else if ($booth_size == '6 SQM') {

// 	$selection_amt = 44999;

// }

// if ($booth_size == '9 SQM') {

// 	$selection_amt = 30000;

// }
if ($booth_size == 'Booth / POD') {
	$selection_amt = 30000;
}





//echo "UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET org='$org',addr1='$addr1',addr2='$addr2',city='$city',state='$state',country='$country',pin='$pin',fone='$fone',fax='$fax' WHERE reg_id = '$reg_id' ";

mysqli_query($link,"INSERT INTO " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . "(sector,subsector,exhibitor_name,reg_id,reg_date,reg_time,ci_certf,website,approval_status)" .

	" VALUES('$temp_exhi_sector','$temp_exhi_subsector', '$temp_exhi_name','$reg_id','$temp_reg_date','$temp_reg_time','$filePath','$temp_website', 'Pending') ") or die(mysqli_error($link));





$sql = "UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " SET cp_title='$temp_cp_title',cp_fname='$temp_cp_fname',

			cp_lname='$temp_cp_lname',cp_mobile='$mob',cp_email='$temp_email',cp_desig='$temp_cp_desig',company_years='$temp_comp_years',addr1='$temp_addr1',addr2='$temp_addr2',city='$temp_city',

			state='$temp_state',country='$temp_country',zip='$temp_zip',phone='$fone',gst_number='$temp_gst_number',paymode='$temp_paymode', booth_space = '$booth_space', 

			amt_ext='$amt_ext',pay_status='Not Paid',selection_amt='$selection_amt',total='$selection_amt',event_name='$event_name',dollar='$dollar',

			curr='$curr',nationality='$nationality', pan_number='$pan_number',booth_size='$booth_size', user_type='$assoc_nm' WHERE reg_id = '$reg_id'";

mysqli_query($link,$sql);

$discountper = 0;
$discount = 0;
$main_amt = $selection_amt;

$promo_query = mysqli_query($link,"SELECT discount FROM sci_2025_promo_code_tbl WHERE promo_code = '$assoc_nm'");
if ($promo_query && mysqli_num_rows($promo_query) > 0) {
	$promo_row = mysqli_fetch_assoc($promo_query);
	$discountper = (int)$promo_row['discount'];
	if ($discountper > 0) {
		$discount = round(($main_amt * $discountper) / 100);
	}
}


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

mysqli_query(
	$link,"UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " 
	SET 
		promocode = '$assoc_nm'
	WHERE reg_id = '$reg_id'"
) or die(mysqli_error($link));

$tin_no = "TIN-SCI" . $EVENT_YEAR . "-EXHST-";

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



	$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE tin_no = '$tin_no1'");

	$res_no = mysqli_num_rows($qry);



	$qry1 = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " WHERE tin_no = '$tin_no1'");

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

echo "<script language='javascript'>window.location = 'exhibitor_payment_form3.php';</script>";

exit;


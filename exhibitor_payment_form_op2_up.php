<?php
session_start();
//print_r($_POST);exit;
if (empty($_SESSION["vercode_ex"]) || ($_POST["vercode_ex"] != $_SESSION["vercode_ex"])) {
	session_destroy();
	echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
	echo "<script language='javascript'>window.location = 'exhibitor_payment_form_op.php';</script>";
	exit;
}

require("includes/form_constants_both.php");
require "dbcon_open.php";

$reg_id = mysqli_escape_string($link,htmlspecialchars($_SESSION['vercode_ex']));
$sectors = mysqli_escape_string($link,htmlspecialchars($_POST['sector']));

$_SESSION['sess_subsector'] = $temp_exhi_subsector = $sectors;
if ($temp_exhi_subsector == 'Other') {
	$temp_exhi_subsector = 'Other -' . $sectors;
	$_SESSION['sess_other_sector'] = $sectors;
}
$_SESSION['sess_sector'] = $temp_exhi_sector = $sectors;

$eventName = 'BengaluruITE.BIZ';
$event_name = 'Bangalore IT';
/*
if($temp_exhi_sector == 'Bio Technology') {
		$eventName = 'Bengaluru INDIA BIO';
		$event_name = 'Bangalore INDIA BIO';
	}
		*/
		/*
$curr = htmlspecialchars(@$_POST['curr'], ENT_QUOTES, 'UTF-8');
$assoc_nm = htmlspecialchars(@$_POST['assoc_nm'], ENT_QUOTES, 'UTF-8');

$temp_exhi_sector = htmlspecialchars(trim($temp_exhi_sector), ENT_QUOTES, 'UTF-8');

$temp_exhi_name = mysqli_real_escape_string($conn, htmlspecialchars(@$_POST['exhi_name'], ENT_QUOTES, 'UTF-8'));

$temp_cp_title = htmlspecialchars(trim(@$_POST['cp_title']), ENT_QUOTES, 'UTF-8');

$temp_cp_fname = mysqli_real_escape_string($conn, htmlspecialchars(trim(@$_POST['cp_fname']), ENT_QUOTES, 'UTF-8'));

$temp_cp_lname = mysqli_real_escape_string($conn, htmlspecialchars(trim(@$_POST['cp_lname']), ENT_QUOTES, 'UTF-8'));
$temp_cp_desig = htmlspecialchars(@$_POST['cp_desig'], ENT_QUOTES, 'UTF-8');
$temp_addr1 = mysqli_real_escape_string($conn, htmlspecialchars(@$_POST['addr1'], ENT_QUOTES, 'UTF-8'));
$temp_addr2 = htmlspecialchars(@$_POST['addr2'], ENT_QUOTES, 'UTF-8');
$temp_city = htmlspecialchars(@$_POST['city'], ENT_QUOTES, 'UTF-8');
$temp_state = htmlspecialchars(@$_POST['state'], ENT_QUOTES, 'UTF-8');
$temp_country = htmlspecialchars(@$_POST['country'], ENT_QUOTES, 'UTF-8');
$temp_zip = htmlspecialchars(@$_POST['zip'], ENT_QUOTES, 'UTF-8');
$temp_fon_cntry = htmlspecialchars(@$_POST['foneCountryCode'], ENT_QUOTES, 'UTF-8');
$temp_fon = htmlspecialchars(@$_POST['fon'], ENT_QUOTES, 'UTF-8');
$temp_mob_cntry = htmlspecialchars(@$_POST['cellnoCountryCode'], ENT_QUOTES, 'UTF-8');
$temp_mob = htmlspecialchars(@$_POST['mob'], ENT_QUOTES, 'UTF-8');
$temp_email = htmlspecialchars(strtolower(trim(@$_POST['email'])), ENT_QUOTES, 'UTF-8');
$temp_reg_date = date("Y-m-d");
$temp_reg_time = date("H:i:s a");
$temp_reg_id = htmlspecialchars(@$_POST['vercode_ex'], ENT_QUOTES, 'UTF-8');
$temp_gst_number = htmlspecialchars(@$_POST['gst_number'], ENT_QUOTES, 'UTF-8');

$temp_del_title = htmlspecialchars(trim(@$_POST['del_title']), ENT_QUOTES, 'UTF-8');
$temp_del_fname = htmlspecialchars(trim(@$_POST['del_fname']), ENT_QUOTES, 'UTF-8');
$temp_del_lname = htmlspecialchars(trim(@$_POST['del_lname']), ENT_QUOTES, 'UTF-8');
$temp_del_mob_cntry = htmlspecialchars(@$_POST['del_cellnoCountryCode'], ENT_QUOTES, 'UTF-8');
$temp_del_mob = htmlspecialchars(@$_POST['del_mob'], ENT_QUOTES, 'UTF-8');
$temp_del_email = htmlspecialchars(@$_POST['del_email'], ENT_QUOTES, 'UTF-8');

$temp_del_title2 = htmlspecialchars(trim(@$_POST['del_title2']), ENT_QUOTES, 'UTF-8');
$temp_del_fname2 = htmlspecialchars(trim(@$_POST['del_fname2']), ENT_QUOTES, 'UTF-8');
$temp_del_lname2 = htmlspecialchars(trim(@$_POST['del_lname2']), ENT_QUOTES, 'UTF-8');
$temp_del_mob_cntry2 = htmlspecialchars(@$_POST['del_cellnoCountryCode2'], ENT_QUOTES, 'UTF-8');
$temp_del_mob2 = htmlspecialchars(@$_POST['del_mob2'], ENT_QUOTES, 'UTF-8');
$temp_del_email2 = htmlspecialchars(@$_POST['del_email2'], ENT_QUOTES, 'UTF-8');

// Partner
$temp_part_title = htmlspecialchars(trim(@$_POST['part_title']), ENT_QUOTES, 'UTF-8');
$temp_part_fname = htmlspecialchars(trim(@$_POST['part_fname']), ENT_QUOTES, 'UTF-8');
$temp_part_lname = htmlspecialchars(trim(@$_POST['part_lname']), ENT_QUOTES, 'UTF-8');
$temp_part_mob_cntry = htmlspecialchars(@$_POST['part_cellnoCountryCode'], ENT_QUOTES, 'UTF-8');
$temp_part_mob = htmlspecialchars(@$_POST['part_mob'], ENT_QUOTES, 'UTF-8');
$temp_part_email = htmlspecialchars(@$_POST['part_email'], ENT_QUOTES, 'UTF-8');
$booth_space = htmlspecialchars(@$_POST['booth_space'], ENT_QUOTES, 'UTF-8');

$paymode = $temp_paymode = htmlspecialchars(@$_POST['paymode'], ENT_QUOTES, 'UTF-8');
$temp_website = htmlspecialchars(@$_POST['website'], ENT_QUOTES, 'UTF-8');
$temp_exbhi_profile = htmlspecialchars(@$_POST['exbhi_profile'], ENT_QUOTES, 'UTF-8');
$delegate_type = htmlspecialchars(@$_POST['delegate_type'], ENT_QUOTES, 'UTF-8');
$sales_exec = htmlspecialchars(@$_POST['sales_exec'], ENT_QUOTES, 'UTF-8');
$pan_number = htmlspecialchars( @$_POST['pan_number'], ENT_QUOTES, 'UTF-8');
$booth_size = htmlspecialchars(@$_POST['booth_size'], ENT_QUOTES, 'UTF-8');
$assoc_nm = htmlspecialchars(@$_POST['assoc_nm'], ENT_QUOTES, 'UTF-8');
$temp_fascia_name = htmlspecialchars(@$_POST['fascia_name'], ENT_QUOTES, 'UTF-8');
//
$temp_part_desig = htmlspecialchars(@$_POST['part_desig'], ENT_QUOTES, 'UTF-8');
//
$temp_del_desig2 = htmlspecialchars(@$_POST['del_desig2'], ENT_QUOTES, 'UTF-8'); 
$sales = htmlspecialchars(@$_POST['sales_exec'], ENT_QUOTES, 'UTF-8'); */

$curr = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['curr'], ENT_QUOTES, 'UTF-8'));
$assoc_nm = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['assoc_nm'], ENT_QUOTES, 'UTF-8'));

$temp_exhi_sector = mysqli_real_escape_string($link,htmlspecialchars(trim($temp_exhi_sector), ENT_QUOTES, 'UTF-8'));

$temp_exhi_name = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['exhi_name'], ENT_QUOTES, 'UTF-8'));

$temp_cp_title = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['cp_title']), ENT_QUOTES, 'UTF-8'));

$temp_cp_fname = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['cp_fname']), ENT_QUOTES, 'UTF-8'));

$temp_cp_lname = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['cp_lname']), ENT_QUOTES, 'UTF-8'));
$temp_cp_desig = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['cp_desig'], ENT_QUOTES, 'UTF-8'));
$temp_addr1 = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['addr1'], ENT_QUOTES, 'UTF-8'));
$temp_addr2 = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['addr2'], ENT_QUOTES, 'UTF-8'));
$temp_city = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['city'], ENT_QUOTES, 'UTF-8'));
$temp_state = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['state'], ENT_QUOTES, 'UTF-8'));
$temp_country = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['country'], ENT_QUOTES, 'UTF-8'));
$temp_zip = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['zip'], ENT_QUOTES, 'UTF-8'));
$temp_fon_cntry = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['foneCountryCode'], ENT_QUOTES, 'UTF-8'));
$temp_fon = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['fon'], ENT_QUOTES, 'UTF-8'));
$temp_mob_cntry = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['cellnoCountryCode'], ENT_QUOTES, 'UTF-8'));
$temp_mob = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['mob'], ENT_QUOTES, 'UTF-8'));
$temp_email = mysqli_real_escape_string($link,htmlspecialchars(strtolower(trim(@$_POST['email'])), ENT_QUOTES, 'UTF-8'));
$temp_reg_date = date("Y-m-d");
$temp_reg_time = date("H:i:s a");
$temp_reg_id = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['vercode_ex'], ENT_QUOTES, 'UTF-8'));
$temp_gst_number = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['gst_number'], ENT_QUOTES, 'UTF-8'));

$temp_del_title = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['del_title']), ENT_QUOTES, 'UTF-8'));
$temp_del_fname = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['del_fname']), ENT_QUOTES, 'UTF-8'));
$temp_del_lname = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['del_lname']), ENT_QUOTES, 'UTF-8'));
$temp_del_mob_cntry = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['del_cellnoCountryCode'], ENT_QUOTES, 'UTF-8'));
$temp_del_mob = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['del_mob'], ENT_QUOTES, 'UTF-8'));
$temp_del_email = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['del_email'], ENT_QUOTES, 'UTF-8'));

$temp_del_title2 = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['del_title2']), ENT_QUOTES, 'UTF-8'));
$temp_del_fname2 = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['del_fname2']), ENT_QUOTES, 'UTF-8'));
$temp_del_lname2 = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['del_lname2']), ENT_QUOTES, 'UTF-8'));
$temp_del_mob_cntry2 = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['del_cellnoCountryCode2'], ENT_QUOTES, 'UTF-8'));
$temp_del_mob2 = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['del_mob2'], ENT_QUOTES, 'UTF-8'));
$temp_del_email2 = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['del_email2'], ENT_QUOTES, 'UTF-8'));

// Partner
$temp_part_title = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['part_title']), ENT_QUOTES, 'UTF-8'));
$temp_part_fname = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['part_fname']), ENT_QUOTES, 'UTF-8'));
$temp_part_lname = mysqli_real_escape_string($link,htmlspecialchars(trim(@$_POST['part_lname']), ENT_QUOTES, 'UTF-8'));
$temp_part_mob_cntry = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['part_cellnoCountryCode'], ENT_QUOTES, 'UTF-8'));
$temp_part_mob = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['part_mob'], ENT_QUOTES, 'UTF-8'));
$temp_part_email = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['part_email'], ENT_QUOTES, 'UTF-8'));
$booth_space = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['booth_space'], ENT_QUOTES, 'UTF-8'));

$paymode = $temp_paymode = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['paymode'], ENT_QUOTES, 'UTF-8'));
$temp_website = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['website'], ENT_QUOTES, 'UTF-8'));
$temp_exbhi_profile = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['exbhi_profile'], ENT_QUOTES, 'UTF-8'));
$delegate_type = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['delegate_type'], ENT_QUOTES, 'UTF-8'));
$sales_exec = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['sales_exec'], ENT_QUOTES, 'UTF-8'));
$pan_number = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['pan_number'], ENT_QUOTES, 'UTF-8'));
$booth_size = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['booth_size'], ENT_QUOTES, 'UTF-8'));
$assoc_nm = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['assoc_nm'], ENT_QUOTES, 'UTF-8'));
$temp_fascia_name = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['fascia_name'], ENT_QUOTES, 'UTF-8'));

$temp_part_desig = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['part_desig'], ENT_QUOTES, 'UTF-8'));

$temp_del_desig2 = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['del_desig2'], ENT_QUOTES, 'UTF-8')); 
$sales = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['sales_exec'], ENT_QUOTES, 'UTF-8'));

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
$_SESSION['pan_number'] = $pan_number;
$_SESSION['booth_size'] = $booth_size ;;
$_SESSION['assoc_nm'] = $assoc_nm;

$_SESSION['sess_del_title'] = $temp_del_title;
$_SESSION['sess_del_fname'] = $temp_del_fname;
$_SESSION['sess_del_lname'] = $temp_del_lname;
$_SESSION['sess_del_email'] = $temp_del_email;
$_SESSION['sess_del_mobile_cntry'] = $temp_del_mob_cntry;
$_SESSION['sess_del_mobile'] = $temp_del_mob;
$_SESSION['sess_website'] = $temp_website;
$_SESSION['sess_exbhi_profile'] = $temp_exbhi_profile;
$_SESSION['sess_fascia_name'] = $temp_fascia_name;
$_SESSION['sess_part_desig'] = $temp_part_desig;

$_SESSION['sess_del_desig'] = $temp_del_desig ;
$_SESSION['sess_del_desig2'] = $temp_del_desig2;

$_SESSION['sales_exec'] = $sales;

$gst = $_POST['gst'];
$_SESSION['gst_number'] = '';
if ($gst == 'Registered') {
	$temp_gst_number = $_SESSION['gst_number'] = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['gst_number'], ENT_QUOTES, 'UTF-8'));
} else if ($gst == 'Unregistered') {
	$temp_gst_number = 'Not Applicable';
}
//exit;

$temp_reg_date = date("Y-m-d");
$temp_reg_time = date("H:i:s");

$fone = '';
if (!empty(mysqli_real_escape_string($link,htmlspecialchars(@$_POST['fon'], ENT_QUOTES, 'UTF-8')))) {
	$fone = $temp_fon_cntry . "-" . $temp_fon;
}
$mob = $temp_mob_cntry . "-" . $temp_mob;

if (($temp_exhi_name == "") || ($temp_addr1 == "") || ($temp_city == "")  || ($temp_state == "")  || ($temp_zip == "") || ($temp_email == "")) {
	echo "<script language='javascript'>alert('Provided all required (* marked) details .');</script>";
	echo "<script language='javascript'>window.location = 'exhibitor_payment_form_op.php?rt=retds4fn324rn_ed24d3it';</script>";
	exit;
}

$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE cp_email = '$temp_email'") or die(mysqli_error($link));
if (mysqli_num_rows($qr) > 0) {
	echo "<script language='javascript'>alert('Entered contact perrson email address already registered with us. Please add another email address.');</script>";
	echo "<script language='javascript'>window.location = 'exhibitor_payment_form_op.php?rt=retds4fn324rn_ed24d3it';</script>";
}

if (!empty($temp_del_email)) {
	for ($j = 1; $j <= 7; $j++) {
		$email = $temp_del_email;
		$field = "email" . $j;
		$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$email'") or die(mysqli_error($link));
		$num_row = mysqli_num_rows($qr);
		if ($num_row > 0) {
			echo "<script language='javascript'>alert('The email id \'" . $email . "\' is already registered with us as a premium delegate.');</script>";
			echo "<script language='javascript'>window.location = ('exhibitor_payment_form_op.php?rt=retds4fn324rn_ed24d3it');</script>";
			exit;
		}

		$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'") or die(mysqli_error($link));
		if (mysqli_num_rows($qr) > 0) {
			echo "<script language='javascript'>alert('Entered delegate email address already registered with us. Please add another delegate email address.');</script>";
			echo "<script language='javascript'>window.location = 'exhibitor_payment_form_op.php?rt=retds4fn324rn_ed24d3it';</script>";
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
if (strpos($booth_size, 's') !== false) {
    $booth_space = 'Shell';
    } else {
    $booth_space = 'Raw';
}
$boothSizes = [
    '9' => [
        'selection_amt' => 117000,
        'booth_area' => '9sqm (9sqm x Rs. 13,000) Raw Space = 1,17,000 + 18% GST',
        'booth_size' => '9 SQM',
    ],
    '9s' => [
        'selection_amt' => 126000,
        'booth_area' => '9sqm (9sqm x Rs. 14,000) Shell Space = 1,26,000 + 18% GST',
        'booth_size' => '9 SQM',
    ],
    '15' => [
        'selection_amt' => 195000,
        'booth_area' => '15sqm (15sqm x Rs. 13,000) Raw Space = 1,95,000 + 18% GST',
        'booth_size' => '15 SQM',
    ],
	'12s' => [
		'selection_amt' => 168000,
        'booth_area' => '12sqm (12sqm x Rs. 14,000) Shell Space = 1,68,000 + 18% GST',
        'booth_size' => '12 SQM',
	],
    '15s' => [
        'selection_amt' => 210000,
        'booth_area' => '15sqm (15sqm x Rs. 14,000) Shell Space = 2,10,000 + 18% GST',
        'booth_size' => '15 SQM',
    ],
    '18' => [
        'selection_amt' => 234000,
        'booth_area' => '18sqm (18sqm x Rs. 13,000) Raw Space = 2,34,000 + 18% GST',
        'booth_size' => '18 SQM',
    ],
    '18s' => [
        'selection_amt' => 252000,
        'booth_area' => '18sqm (18sqm x Rs. 14,000) Shell Space = 2,52,000 + 18% GST',
        'booth_size' => '18 SQM',
    ],
    '27' => [
        'selection_amt' => 351000,
        'booth_area' => '27sqm (27sqm x Rs. 13,000) Raw Space = 3,51,000 + 18% GST',
        'booth_size' => '27 SQM',
    ],
    '27s' => [
        'selection_amt' => 378000,
        'booth_area' => '27sqm (27sqm x Rs. 14,000) Shell Space = 3,78,000 + 18% GST',
        'booth_size' => '27 SQM',
    ],
	//30
	'30' => [
		'selection_amt' => 390000,
		'booth_area' => '30sqm (30sqm x Rs. 13,000) Raw Space = 3,90,000 + 18% GST',
		'booth_size' => '30 SQM',
	],
    '36' => [
        'selection_amt' => 468000,
        'booth_area' => '36sqm (36sqm x Rs. 13,000) Raw Space = 4,68,000 + 18% GST',
        'booth_size' => '36 SQM',
    ],
    '36s' => [
        'selection_amt' => 504000,
        'booth_area' => '36sqm (36sqm x Rs. 14,000) Shell Space = 5,04,000 + 18% GST',
        'booth_size' => '36 SQM',
    ],
	'48' => [
        'selection_amt' => 624000,
        'booth_area' => '48sqm (48sqm x Rs. 13,000) Raw Space = 6,24,000 + 18% GST',
        'booth_size' => '48 SQM',
    ],
    '48s' => [
        'selection_amt' => 672000,
        'booth_area' => '48sqm (48sqm x Rs. 14,000) Shell Space = 6,72,000 + 18% GST',
        'booth_size' => '48 SQM',
    ],
    '54' => [
        'selection_amt' => 702000,
        'booth_area' => '54sqm (54sqm x Rs. 13,000) Raw Space = 7,02,000 + 18% GST',
        'booth_size' => '54 SQM',
    ],
    '54s' => [
        'selection_amt' => 756000,
        'booth_area' => '54sqm (54sqm x Rs. 14,000) Shell Space = 7,56,000 + 18% GST',
        'booth_size' => '54 SQM',
    ],
    '72' => [
        'selection_amt' => 936000,
        'booth_area' => '72sqm (72sqm x Rs. 13,000) Raw Space = 9,36,000 + 18% GST',
        'booth_size' => '72 SQM',
    ],
    '72s' => [
        'selection_amt' => 1008000,
        'booth_area' => '72sqm (72sqm x Rs. 14,000) Shell Space = 10,08,000 + 18% GST',
        'booth_size' => '72 SQM',
    ],
    '100' => [
        'selection_amt' => 1300000,
        'booth_area' => '100sqm (100sqm x Rs. 13,000) Raw Space = 13,00,000 + 18% GST',
        'booth_size' => '100 SQM',
    ],
    '100s' => [
        'selection_amt' => 1400000,
        'booth_area' => '100sqm (100sqm x Rs. 14,000) Shell Space = 14,00,000 + 18% GST',
        'booth_size' => '100 SQM',
	],
	'108'=> [
		'selection_amt' => 1404000,
		'booth_area' => '108sqm (108sqm x Rs. 13,000) Raw Space = 14,04,000 + 18% GST',
		'booth_size' => '108 SQM'

	],
	'108s'=> [
		'selection_amt' => 1512000,
		'booth_area' => '108sqm (108sqm x Rs. 14,000) Shell Space = 15,12,000 + 18% GST',
		'booth_size' => '108 SQM'

	],
	'135'=> [
		'selection_amt' => 1755000,
		'booth_area' => '135sqm (135sqm x Rs. 13,000) Raw Space = 17,55,000 + 18% GST',
		'booth_size' => '135 SQM'

	],
];

	if (isset($boothSizes[$booth_size])) {
		$selection_amt = $boothSizes[$booth_size]['selection_amt'];
		$booth_area = $boothSizes[$booth_size]['booth_area'];
		$booth_size = $boothSizes[$booth_size]['booth_size'];
	   
		//echo $booth_size;
		
	}

	if($assoc_nm == "IESA"){
		//give discount of 15% on selection amount 
		// $selection_amt =  15% * $selection_amt 
		$discount = "15";
	}
	if($assoc_nm == null){
		$assoc_nm = 'Exhibitor';
		$discount = null;
		$discount_amt = null;
		$total = $selection_amt;
	}
	else{
		$assoc_nm = $assoc_nm;
		$total = $selection_amt;
	}

	//if discount is not null then calculate the discount amount
	if($discount != null){
		$discount_amount = ($selection_amt * $discount) / 100;
    	// Calculate total after discount
		$total_amount = $selection_amt - $discount_amount;

		//round off 
		$total = round($total_amount);

	}

	/*
	echo "<br>";
	echo $selection_amt;
	echo "<br>";
	echo $discount_amount;
	echo "<br>";
	echo $discount;
	echo "<br>";
	echo $total;
	exit;
	*/






//santize the input before inserting into the database
$temp_exhi_name = mysqli_real_escape_string($link,htmlspecialchars($temp_exhi_name));
$temp_cp_title = mysqli_real_escape_string($link,htmlspecialchars($temp_cp_title));
$temp_cp_fname = mysqli_real_escape_string($link,htmlspecialchars($temp_cp_fname));
$temp_cp_lname = mysqli_real_escape_string($link,htmlspecialchars($temp_cp_lname));
$temp_cp_desig = mysqli_real_escape_string($link,htmlspecialchars($temp_cp_desig));
$temp_addr1 = mysqli_real_escape_string($link,htmlspecialchars($temp_addr1));
$temp_addr2 = mysqli_real_escape_string($link,htmlspecialchars($temp_addr2));
$temp_city = mysqli_real_escape_string($link,htmlspecialchars($temp_city));
$temp_state = mysqli_real_escape_string($link,htmlspecialchars($temp_state));
$temp_country = mysqli_real_escape_string($link,htmlspecialchars($temp_country));
$temp_zip = mysqli_real_escape_string($link,htmlspecialchars($temp_zip));
$temp_fon =mysqli_real_escape_string($link,htmlspecialchars($temp_fon));
$temp_mob = mysqli_real_escape_string($link,htmlspecialchars($temp_mob));
$temp_email = mysqli_real_escape_string($link,htmlspecialchars($temp_email));
$temp_website =mysqli_real_escape_string($link,htmlspecialchars($temp_website));
$temp_exbhi_profile = mysqli_real_escape_string($link,htmlspecialchars($temp_exbhi_profile));
$temp_del_title = mysqli_real_escape_string($link,htmlspecialchars($temp_del_title));
$temp_del_fname = mysqli_real_escape_string($link,htmlspecialchars($temp_del_fname));
$temp_del_lname = mysqli_real_escape_string($link,htmlspecialchars($temp_del_lname));
$temp_del_email = mysqli_real_escape_string($link,htmlspecialchars($temp_del_email));
$temp_del_title2 =mysqli_real_escape_string($link,htmlspecialchars($temp_del_title2));
$temp_del_fname2 = mysqli_real_escape_string($link,htmlspecialchars($temp_del_fname2));
$temp_del_lname2 = mysqli_real_escape_string($link,htmlspecialchars($temp_del_lname2));
$temp_del_email2 = mysqli_real_escape_string($link,htmlspecialchars($temp_del_email2));
$temp_part_title = mysqli_real_escape_string($link,htmlspecialchars($temp_part_title));
$temp_part_fname = mysqli_real_escape_string($link,htmlspecialchars($temp_part_fname));
$temp_part_lname = mysqli_real_escape_string($link,htmlspecialchars($temp_part_lname));
$temp_part_email =mysqli_real_escape_string($link,htmlspecialchars($temp_part_email));
$temp_part_desig = mysqli_real_escape_string($link,htmlspecialchars($temp_part_desig));
$temp_part_mob = mysqli_real_escape_string($link,htmlspecialchars($temp_part_mob));
$temp_part_mob_cntry = mysqli_real_escape_string($link,htmlspecialchars($temp_part_mob_cntry));
$temp_del_mob2 = mysqli_real_escape_string($link,htmlspecialchars($temp_del_mob2));
$temp_del_mob_cntry2 = mysqli_real_escape_string($link,htmlspecialchars($temp_del_mob_cntry2));
$temp_del_desig = mysqli_real_escape_string($link,htmlspecialchars($temp_del_desig));
$temp_del_desig2 = mysqli_real_escape_string($link,htmlspecialchars($temp_del_desig2));
$mob2 = $temp_del_mob_cntry2 . "-" . $temp_del_mob2;





//echo "UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET org='$org',addr1='$addr1',addr2='$addr2',city='$city',state='$state',country='$country',pin='$pin',fone='$fone',fax='$fax' WHERE reg_id = '$reg_id' ";
mysqli_query($link,"INSERT INTO " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . "(sector,subsector,exhibitor_name,reg_id,reg_date,reg_time,sales_exec,website)" .
	" VALUES('$temp_exhi_sector','$temp_exhi_subsector', '$temp_exhi_name','$reg_id','$temp_reg_date','$temp_reg_time','$sales_exec','$temp_website') ") or die(mysqli_error($link));

$sql = "UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " SET cp_title='$temp_cp_title',cp_fname='$temp_cp_fname',
			cp_lname='$temp_cp_lname',cp_mobile='$mob',cp_email='$temp_email',cp_desig='$temp_cp_desig',addr1='$temp_addr1',addr2='$temp_addr2',city='$temp_city',
			state='$temp_state',country='$temp_country',zip='$temp_zip',phone='$fone',gst_number='$temp_gst_number',paymode='$temp_paymode',
			amt_ext='$amt_ext',pay_status='Not Paid',selection_amt='$selection_amt',total='$total',event_name='$event_name',dollar='$dollar',
			curr='$curr',nationality='$nationality', pan_number='$pan_number',booth_size='$booth_size', booth_area='$booth_area', user_type='$assoc_nm', delegate_type='$delegate_type',booth_space='$booth_space', adminDiscountPer = '$discount', admin_discount = '$discount_amount' WHERE reg_id = '$reg_id'";
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

$tin_no  = "TIN-BTS" . $EVENT_YEAR . "-EXH-";
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
echo "<script language='javascript'>window.location = 'exhibitor_payment_form_op3.php';</script>";
exit;

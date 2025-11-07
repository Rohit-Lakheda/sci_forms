<?php
session_start();
if (($_SESSION["vercode_ex"] == '')) {
	session_destroy();
	mysqli_close($link);
	echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
	echo "<script language='javascript'>window.location = ('exhibitor.php');</script>";
	exit();
}
require "includes/form_constants_both.php";
require "dbcon_open.php";
//print_r($_POST);exit;
$temp_reg_id = mysqli_escape_string($link,htmlspecialchars(@$_SESSION['vercode_ex']));
$assoc_nm = mysqli_escape_string($link,htmlspecialchars($_REQUEST['assoc_nm']));
for ($j_exb = 1; $j_exb <= 1; $j_exb++) {
	$title_1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['title' . $j_exb]));
	$fname_1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['fname' . $j_exb]));
	// $mname_1 = @$_POST ['mname' . $j_exb];
	$lname_1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['lname' . $j_exb]));
	$desig_1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['desig' . $j_exb]));
	$mob_1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['mob' . $j_exb]));
	$email_1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['email' . $j_exb]));
	$del_category_1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['del_category' . $j_exb]));
}

if (($title_1 == "") || ($fname_1 == "") || ($lname_1 == "") || ($desig_1 == "") || ($email_1 == "") || ($del_category_1 == "") || ($mob_1 == "")) {
	echo "<script language='javascript'>alert('Please Enter Complete exhibitors Details.');</script>";
	mysqli_close($link);
	echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
	exit();
}

$qr_chk_exb_id = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_2 WHERE (reg_id='$temp_reg_id') ");
$qr_chk_exb_num_rows = mysqli_num_rows($qr_chk_exb_id);

if (($qr_chk_exb_num_rows <= 0) || ($qr_chk_exb_num_rows == "")) {
	session_destroy();
	mysqli_close($link);
	echo "<script language='javascript'>alert('Please Enter Complete exhibitors details.');</script>";
	echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
	exit();
}
$qr_chk_exb_id = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_2 WHERE (reg_id='$temp_reg_id') ");
$qr_chk_exb_ans = mysqli_fetch_array($qr_chk_exb_id);

$exhibitor_id_ex = $qr_chk_exb_ans['exhibitor_id'];
$temp_booth_no = $qr_chk_exb_ans['booth_no'];
$temp_booth_area = $qr_chk_exb_ans['booth_area'];
/*if (($assoc_nm == "STPI") || ($assoc_nm == "KBITS")) {
		$temp_booth_area = 6;
	}*/
$temp_booth_area_unit = $qr_chk_exb_ans['booth_area_unit'];
$temp_fascia_name = $qr_chk_exb_ans['fascia_name'];
$temp_fascia_name_up = strtoupper($temp_fascia_name);

$temp_exhi_name = $qr_chk_exb_ans['exhibitor_name'];
$temp_exhi_name_up = strtoupper($temp_exhi_name);
$temp_exhi_name_upwc = ucwords($temp_exhi_name);
$temp_cp_title = $qr_chk_exb_ans['cp_title'];
$temp_cp_fname = mysqli_real_escape_string($link,$qr_chk_exb_ans['cp_fname']);
$temp_cp_mname = mysqli_real_escape_string($link,$qr_chk_exb_ans['cp_mname']);
$temp_cp_lname = mysqli_real_escape_string($link,$qr_chk_exb_ans['cp_lname']);
$temp_desig = $qr_chk_exb_ans['cp_desig'];
$temp_addr1 = mysqli_real_escape_string($link,$qr_chk_exb_ans['address_line_1']);
$temp_addr2 = mysqli_real_escape_string($link,$qr_chk_exb_ans['address_line_2']);
$temp_city = $qr_chk_exb_ans['city'];
$temp_state = $qr_chk_exb_ans['state'];
$temp_country = $qr_chk_exb_ans['country'];
$temp_zip = $qr_chk_exb_ans['zip'];
$temp_fon_cntry = $qr_chk_exb_ans['cntry_code_phone'];
// $temp_fon_area = $qr_chk_exb_ans['area_code_phone'];
$temp_fon = $qr_chk_exb_ans['phone'];
$temp_mob_cntry = $qr_chk_exb_ans['cntry_code_mob'];
$temp_mob = $qr_chk_exb_ans['mob'];
$temp_fax_cntry = $qr_chk_exb_ans['cntry_code_fax'];
// $temp_fax_area = $qr_chk_exb_ans['area_code_fax'];
$temp_fax = $qr_chk_exb_ans['fax'];
$temp_email = $qr_chk_exb_ans['email'];
$temp_website = $qr_chk_exb_ans['website'];
$temp_reg_date = $qr_chk_exb_ans['reg_date'];
$temp_reg_time = $qr_chk_exb_ans['reg_time'];
$temp_reg_id = $qr_chk_exb_ans['reg_id'];
$temp_profile = $qr_chk_exb_ans['profile'];
$category = $qr_chk_exb_ans['category'];
$assoc_nm = $qr_chk_exb_ans['assoc_nm'];

// ----------------------------------------- End Geneating Tin Number ----------------------------------------------------
// $total_exbhitors = round($temp_booth_area/9)*2;
/* if (($temp_booth_area <= 9) && ($temp_booth_area >= 3)) {
			$total_exbhitors = 2;
			$total_del = 2;
	} else {
		$total_exbhitors = (floor ( $temp_booth_area / 9 ) * 2);
		$total_del = (floor ( $temp_booth_area / 9 ) * 2);
		if ($total_del > 14) {
			$total_del = 14;
			$total_del_max_flag = "True";
		}
		if ($total_exbhitors > 14) {
			$total_exbhitors = 14;
			$total_exbhitors_max_flag = "True";
		}
	} */

if (!empty($assoc_nm)) {
	if($assoc_nm =="STPI"){
		if (($temp_booth_area == 1) || ($temp_booth_area == 2) || ($temp_booth_area == 3) || ($temp_booth_area == 4) || ($temp_booth_area == 6 ||$temp_booth_area == "Startup Booth" )) {
			$total_exbhitors = 2;
			$temp_total_exbhitors = $total_exbhitors;
			$total_del = 2;
			$temp_total_del = $total_del;
			$total_del_max_flag = "False";
		} 

	}

	elseif  (($temp_booth_area == 1) || ($temp_booth_area == 2) || ($temp_booth_area == 3) || ($temp_booth_area == 4) || ($temp_booth_area == 6 ||$temp_booth_area == "Startup Booth" )) {
		$total_exbhitors = 2;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 1;
		$temp_total_del = $total_del;
		$total_del_max_flag = "False";
	} 

	
	else if ($temp_booth_area == 9) {
		//echo  floor( $temp_booth_area / 9 );
		$total_exbhitors = 2;
		$temp_total_exbhitors = $total_exbhitors;
		$total_exbhitors_max_flag = "False";

		$total_del = 1;
		$temp_total_del = $total_del;
		$total_del_max_flag = "False";
	} else {

		echo "<script language='javascript'>alert('Error in  Stall Size');</script>";
		mysqli_close($link);
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit();
	}
}

 else {
	if (($temp_booth_area >= 3) && ($temp_booth_area <= 8)) {
		$total_exbhitors = 2;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 1;
		$temp_total_del = $total_del;
	}
	else if (($temp_booth_area >= 9) && ($temp_booth_area <= 11)) {
		$total_exbhitors = 2; //Personal Information of Exhibitor
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 1; //Conference Delegate
		$temp_total_del = $total_del;
	} else if (($temp_booth_area >= 12) && ($temp_booth_area <= 14)) {
		$total_exbhitors = 3;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 2;
		$temp_total_del = $total_del;
	} 
	else if (($temp_booth_area >= 15) && ($temp_booth_area <= 17)) {
		$total_exbhitors = 4;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 2;
		$temp_total_del = $total_del;
	} 
	else if (($temp_booth_area >= 18) && ($temp_booth_area <= 26)) {
		$total_exbhitors = 4;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 2;
		$temp_total_del = $total_del;
	} else if (($temp_booth_area >= 27) && ($temp_booth_area <= 29)) {
		$total_exbhitors = 6;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 3;
		$temp_total_del = $total_del;
	}
	else if (($temp_booth_area >= 30) && ($temp_booth_area <= 36)) {
		$total_exbhitors = 7;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 4;
		$temp_total_del = $total_del;
	} else if (($temp_booth_area >= 37) && ($temp_booth_area <= 53)) {
		$total_exbhitors = 7;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 5;
		$temp_total_del = $total_del;
	} else if (($temp_booth_area >= 54) && ($temp_booth_area <= 71)) {
		$total_exbhitors = 7;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 7;
		$temp_total_del = $total_del;
	} else if (($temp_booth_area >= 72) && ($temp_booth_area <= 81)) {
		$total_exbhitors = 7;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 7;
		$temp_total_del = $total_del;
	} else {
		echo "<script language='javascript'>alert('Error in  Stall Size');</script>";
		mysqli_close($link);
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit();
	}
}

if ($total_exbhitors >= 7) {
	$total_exbhitors = 7;
	$total_exbhitors_max_flag = "True";
}

if ($total_del >= 7) {
	$total_del = 7;
	$total_del_max_flag = "True";
}

// if(($temp_booth_area<9) && (($temp_booth_area>1)) ){
/* if (($temp_booth_area < 4)) {
		echo "<script language='javascript'>alert('Booth/ Stall area should be greater than or equal to 4 sqm');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit ();
	} */

if ($total_exbhitors <= 0 || $total_del <= 0) {
	echo "<script language='javascript'>alert('Please Enter Correct Booth/Pavilion Details.');</script>";
	mysqli_close($link);
	echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
	exit();
}

$temp_total_exbhitors = $total_exbhitors;
$sql = "DELETE FROM $EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_DEMO_PHASE_2 WHERE exhibitor_id='" . $qr_chk_exb_ans['exhibitor_id'] . "'";
mysqli_query($link,$sql);
for ($j_exb = 1; $j_exb <= $temp_total_exbhitors; $j_exb++) {
	$title = mysqli_escape_string($link,htmlspecialchars(@$_POST['title' . $j_exb]));
	$fname = mysqli_escape_string($link,htmlspecialchars(@$_POST['fname' . $j_exb]));
	// $mname = @$_POST ['mname' . $j_exb];
	$lname = mysqli_escape_string($link,htmlspecialchars(@$_POST['lname' . $j_exb]));
	$desig = mysqli_escape_string($link,htmlspecialchars(@$_POST['desig' . $j_exb]));
	$mob = mysqli_escape_string($link,htmlspecialchars($_POST['mob' . $j_exb]));
	$email = mysqli_escape_string($link,htmlspecialchars(@$_POST['email' . $j_exb]));
	$del_category = $category; //@$_POST ['del_category' . $j_exb];

	$pas1 = $fname . "123";
	$pas2 = md5($pas1);

	if (($title != "") && ($fname != "") && ($lname != "") && ($desig != "") && ($email != "") && ($del_category != "") && ($mob != "")) {
		mysqli_query($link,"INSERT INTO $EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_DEMO_PHASE_2 (exhibitor_id,title,fname,lname,email,desig,mob,category) values('$qr_chk_exb_ans[exhibitor_id]','$title','$fname','$lname','$email','$desig','$mob','$del_category')") or die(mysqli_error($link));
	}
}


//============================================ Save delegate datqa=================================================================

$ddate = date("Y-m-d");
$ttime = date("H:i:s A");
$assoc_nm = @$_REQUEST['assoc_nm'];
$reg_id = $qr_chk_exb_ans['srno'] . '_' . $_SESSION['vercode_ex'];
$ret = @$_GET['ret'];

mysqli_query($link,"delete from " . $EVENT_DB_FORM_REG_DEMO . " where reg_id = '$reg_id' ") or die(mysqli_error($link));

$cata = mysqli_escape_string($link,htmlspecialchars(@$_POST['cata']));
$cata_m = mysqli_escape_string($link,htmlspecialchars(@$_POST['cata_m']));

if ($cata == "") {
	//session_destroy();
	echo "<script language='javascript'>alert('Please select registration category.');</script>";
	mysqli_close($link);
	echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
	exit;
}
/* if($cata_m == ""){
		//session_destroy();
		echo "<script language='javascript'>alert('Please select delegate type.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit;
	} */

//$comp_date=$LAST_DATE_EVENT_REG;
$date1 = date("Y/m/d");
$pay_status = "Complimentary";
$paymode = 'Complimentary';
$total_dele = $total_del; //$total_exbhitors;

$grp = "Group";
if ($total_dele == 1) {
	$grp = "Single";
}

if (($total_dele > 7) || ($total_dele < 1)) {
	//session_destroy();
	echo "<script language='javascript'>alert('In group min 2 and maximum 7 delegates are allowded.');</script>";
	mysqli_close($link);
	echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
	exit;
}

$amt_ext = "";
$dollar = "";

if ($temp_country == "India") {
	$dollar = "1";
	$amt_ext = "Rs.";
	$nationality = "Indian Organization";
	$curr = 'Indian';
} else {
	$dollar = "71";
	$amt_ext = "USD";
	$nationality = "International Organization";
	$curr = 'Foreign';
}
$dollar = "";
$amt_ext = "";
$rate = "0";
$rate_org = "0";

$amt = $total_dele * $rate_org;
$amt_per_del = $dis = $temp_amt = $mem_disc = $gr_discount = $admin_discount = $tax = $total = $main_amt = 0;
$spl_delegate_asso_type = $temp_ticket_type = $temp_sess_sp_msg = '';
mysqli_query($link,"insert into " . $EVENT_DB_FORM_REG_DEMO . "(org_reg_type,nationality,cata,curr,gr_type,sub_delegates,paymode,pay_status,amt_ext,amt_per_del,selection_amt,total,reg_id,reg_date,reg_time,sp_msg,dollar,membership_name,ticket_type,user_type) values ('$cata_m','$nationality','$cata','$curr','$grp','$total_dele','$paymode','$pay_status','$amt_ext','$rate_org','$amt','$amt','$reg_id','$ddate','$ttime','$temp_sess_sp_msg','$dollar','$spl_delegate_asso_type','$temp_ticket_type','Exhibitor Registration')") or die(mysqli_error($link));


$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
$res = mysqli_fetch_array($qry);

if ($cata == "Complimentary Exhibitors Delegate") {
	$EVENT_DB_TIN_NO = "TIN-BTS" . $EVENT_YEAR . "-EXHC-";
} else if ($cata == "Complimentary Sponsor Delegate") {
	$EVENT_DB_TIN_NO = "TIN-BTS" . $EVENT_YEAR . "-SPRC-";
} else if ($cata == "Complimentary Speaker Delegate") {
	$EVENT_DB_TIN_NO = "TIN-BTS" . $EVENT_YEAR . "-SPKC-";
} else if ($cata == "Complimentary Invitee Delegate") {
	$EVENT_DB_TIN_NO = "TIN-BTS" . $EVENT_YEAR . "-INVC-";
} else {
	$EVENT_DB_TIN_NO = "TIN-BTS" . $EVENT_YEAR . "-";
}

$tin_no = $EVENT_DB_TIN_NO;
$tin_no1 = "";

$i = 0;
$j = 0;

$temp_srno_gt = $res['srno'];
do {
	$i = 0;
	$j = 0;

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

$pin_no1 = str_replace("TIN", "PRN", $tin_no1);

mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET amt_per_del = '$amt_per_del' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET gr_discount = '$gr_discount' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET admin_discount = '$admin_discount' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET tax = '$tax' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET total = '$total' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET membership_discount = '$mem_disc' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET tin_no = '$tin_no1' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET pin_no = '$pin_no1' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET assoc_name = '$assoc_nm' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));


//================================= Save organisation =======================================================================
$cp_name = $qr_chk_exb_ans['cp_title'] . " " . mysqli_real_escape_string($link,$qr_chk_exb_ans['cp_fname']) . " " . mysqli_real_escape_string($link,$qr_chk_exb_ans['cp_lname']);
$cp_email = $qr_chk_exb_ans['email'];
//$cp_name = "";
//$cp_email = "";
$nature = '';
$org = mysqli_real_escape_string($link,@$qr_chk_exb_ans['exhibitor_name']);
$addr1 = mysqli_real_escape_string($link,@$qr_chk_exb_ans['address_line_1']);
$addr2 = mysqli_real_escape_string($link,@$qr_chk_exb_ans['address_line_2']);
$city = $qr_chk_exb_ans['city'];
$state = $qr_chk_exb_ans['state'];
$country = $qr_chk_exb_ans['country'];
$pin = $qr_chk_exb_ans['zip'];

$fone = $qr_chk_exb_ans['cntry_code_phone'] . "-" . $qr_chk_exb_ans['phone'];
$fax = $qr_chk_exb_ans['cntry_code_fax'] . "-" . @$qr_chk_exb_ans['fax'];
$cellno = $qr_chk_exb_ans['cntry_code_mob'] . "-" . @$qr_chk_exb_ans['mob'];
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET cp_name='$cp_name',cp_email='$cp_email',nature='$nature',org='$org',addr1='$addr1',addr2='$addr2',city='$city',state='$state',country='$country',pin='$pin',fone='$fone',fax='$fax', cellno='$cellno' WHERE reg_id = '$reg_id' ") or die(mysqli_error($link));

$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
$res = mysqli_fetch_array($qry);

//================================= Save Delegate data =======================================================================
$cata = $res['cata'];
$rate = "0";
$rate_org = "0";
$lmt = $res['sub_delegates'];
$tno = $res['tin_no'];
$ccode = '';
if ($res['curr'] == 'Indian') {
	$ccode = '+91-';
}

for ($j = 1; $j <= $lmt; $j++) {
	$email = mysqli_escape_string($link,htmlspecialchars(@$_POST['email_m' . $j]));
	$field = "email" . $j;
	if (!empty($email)) {
		$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'") or die(mysqli_error($link));
		$num_row = mysqli_num_rows($qr);
		if ($num_row > 0) {
			echo "<script language='javascript'>alert('Provided email id $email, is alredy registered with us.');</script>";
			echo "<script language='javascript'>window.location='exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm';</script>";
			exit();
		}
	}
}

/* for($j = 1; $j <= $lmt; $j ++) {
		if(!empty($_POST['cellno'.$j])) {
			$cellno = $ccode.$_POST['cellno'.$j];
			$field = "cellno" . $j;
			if(!empty($cellno)) {
				$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field LIKE '%$cellno'" ) or die ( mysqli_error ($link) );
				$num_row = mysqli_num_rows ( $qr );
				if ($num_row > 0) {
					echo "<script language='javascript'>alert('Provided mobile number $cellno, is alredy registered with us.');</script>";
					echo "<script language='javascript'>window.location='exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm';</script>";
					exit ();
				}
			}
		}
	} */

//if($_POST['same-stall'] == 'No') {
$amt = 0;
$del_count = 0;
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

	$email = mysqli_escape_string($link,htmlspecialchars(@$_POST['email_m' . $i]));
	$email = strtolower(trim($email));

	if (!empty($email)) {
		++$del_count;

		$title = mysqli_escape_string($link,htmlspecialchars(@$_POST['dtitle' . $i]));
		$title = trim($title);

		$fname = mysqli_escape_string($link,htmlspecialchars(@$_POST['dfname' . $i]));
		$fname = trim($fname);

		$lname = mysqli_escape_string($link,htmlspecialchars(@$_POST['dlname' . $i]));
		$lname = trim($lname);

		$job_title = mysqli_escape_string($link,htmlspecialchars(@$_POST['job_title' . $i]));
		$job_title = trim($job_title);

		$badge = mysqli_escape_string($link,htmlspecialchars(@$_POST['badge' . $i]));
		$badge = trim($badge);



		$cellno = $ccode . mysqli_escape_string($link,htmlspecialchars($_POST['cellno' . $i]));
		//$cata = @$_POST['cata'.$i];

		$amt = $amt + $rate_org;

		$pas1 = str_replace("'", '', mysqli_escape_string($link,htmlspecialchars($_POST['dfname' . $i]))) . "123";
		$pas2 = md5($pas1);

		if (($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == "")) {
			echo "<script language='javascript'>alert('Provided all required details of all $lmt delegates.');</script>";
			if (!empty($assoc_nm)) {
				echo "<script language='javascript'>window.location = ('exhibitor_stpi.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
			} else {
				echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it');</script>";
			}
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
}
mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET sub_delegates = '$del_count' where reg_id = '$reg_id'") or die(mysqli_error($link));

/*} else if($_POST['same-stall'] == 'Yes') {
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET sub_delegates = '$total_exbhitors' where reg_id = '$reg_id'") or die(mysqli_error($link));

		$amt=0;
		for($i=1; $i<= $total_exbhitors; $i++) {
			$a1 = "title".$i;
			$a2 = "fname".$i;
			$a3 = "lname".$i;
			$a5 = "job_title".$i;
			$a6 = "badge".$i;
			$a7 = "email".$i;
			$a8 = "cellno".$i;
			$a9 = "cata".$i;
			$a10 = "amt".$i;
			$title = @$_POST['title'.$i];
			$title = trim($title);
		
			$fname = mysqli_real_escape_string($link,@$_POST['fname'.$i]);
			$fname = trim($fname);
		
			$lname = mysqli_real_escape_string($link,@$_POST['lname'.$i]);
			$lname = trim($lname);
		
			$job_title = @$_POST['desig'.$i];
			$job_title = trim($job_title);
		
			$badge = $fname . ' ' . $lname;
			$badge = trim($badge);
		
			$email = @$_POST['email'.$i];
			$email = strtolower(trim($email));
		
			$cellno = $_POST['mob'.$i];
			//$cata = @$_POST['cata'.$i];
		
			$amt = $amt+$rate_org;
		
			$pas1=str_replace("'", '', $_POST['fname'.$i]) . "123";
			$pas2=md5($pas1);
		
			if( ($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == ""))
			{
				echo "<script language='javascript'>alert('Provided all required details of all $lmt delegates.');</script>";
				echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it');</script>";
				exit;
			}
		
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a1 = '$title' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a2 = '$fname' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a3 = '$lname' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a5 = '$job_title' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a6 = '$badge' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a7 = '$email' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a8 = '$cellno' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a9 = '$cata' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a10 = '$rate_org' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET selection_amt = '$amt' where reg_id = '$reg_id'") or die(mysqli_error($link));
		
			mysqli_query($link,"INSERT INTO ".$EVENT_DB_FORM_REG_TBL_LOGIN."(tin_no,reg_id,title,fname,lname,email,cata,user_name,pass1,pass2) VALUES ('$tno','$reg_id','$title','$fname','$lname','$email','$cata','$email','$pas1','$pas2')") or die(mysqli_error($link));
		}
	}*/

//exit ();
mysqli_close($link);
echo "<script language='javascript'>window.location= 'exhibitor4.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm';</script>";
exit();

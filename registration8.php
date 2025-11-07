<?php
// print_r($_POST);exit;

// ini_set('display_errors', 1);
// session_start();
include 'csrf_token.php';
// Function to validate CSRF token
function validateCsrfToken($token)
{
	return isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === $token;
}

// echo $formToken = generateCsrfToken();
// echo '<br>';
// echo $_SESSION['csrf_token'];

// echo '<br>';
// echo $_POST['csrf_token'];
// die;
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Retrieve the CSRF token from the form submission
	$formToken = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

	if (!validateCsrfToken($formToken)) {
		echo '<script type="text/javascript">
				alert("An error occurred. Please try again.");
				window.location.href = "https://sci25.supercomputingindia.org";
			  </script>';
		exit; // Stop further processing
	}

	unset($_SESSION['csrf_token']);
}
$event_name = 'Supercomputing India';
$en = '';
if (isset($_POST['en']) && !empty($_POST['en'])) {
	$en = '1';
	$event_name = 'Supercomputing India';
}
$assoc_name = @$_GET['assoc_name'];
$assoc_name = trim($assoc_name);

if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
	session_destroy();
	echo "<script language='javascript'>alert('Session Expired.');</script>";
	if (!empty($assoc_name)) {
		echo "<script language='javascript'>window.location = 'registration.php';</script>";
	} else {
		echo "<script language='javascript'>window.location = 'registration.php';</script>";
	}
	exit;
}
require ("form_includes/form_constants_both.php");
require "dbcon_open.php";
// require 'class.phpmailer.php';
$reg_id = $_SESSION["vercode_reg"];



if (isset($_POST['make_payment'])) {


	$qr_gt_user_data_id = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
	$res = $qr_gt_user_data_ans_row;
	$temp_receiver_org = $qr_gt_user_data_ans_row['org'];

	$qr_gt_user_data_id1 = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row1 = mysqli_fetch_assoc($qr_gt_user_data_id1);
	// echo $qr_gt_user_data_ans_row1;
	// print_r($qr_gt_user_data_ans_row1);
	// die;
	
	if (!empty($qr_gt_user_data_ans_row1)) {
		echo "<script language='javascript'>alert('Session expired. Please try again!');</script>";
		echo "<script language='javascript'>window.location = 'https://sci25.supercomputingindia.org';</script>";
		exit;
	}

	if (!empty($qr_gt_user_data_ans_row['user_type']) && !empty($qr_gt_user_data_ans_row['assoc_srno'])) {
		$assoc_name = $qr_gt_user_data_ans_row['user_type'];
		$assoc_srno = $qr_gt_user_data_ans_row['assoc_srno'];
		$qry = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_PROMO_CODE_TBL . " WHERE srno='$assoc_srno' AND assoc_name='$assoc_name'");

		if (mysqli_num_rows($qry)) {
			$result = mysqli_fetch_assoc($qry);
			//print_r($result);
			if ($result['reg_done'] >= $result['total_reg']) {
				//session_destroy();
				echo "<script language='javascript'>alert('For " . $assoc_name . " Association/ Dignitary registrations seats are fulled. Please try again!');</script>";
				echo "<script language='javascript'>window.location = 'registration.php';</script>";
				exit;
			} else {
				$result['reg_done']++;
				$sql = "UPDATE " . $EVENT_DB_FORM_PROMO_CODE_TBL . " SET reg_done=" . $result['reg_done'] . " WHERE srno=" . $result['srno'];
				mysqli_query($link, $sql);
			}
		}
	}

	//print_r($qr_gt_user_data_ans_row);
	//=======================================================================================================================================
	//=======================================================================================================================================

	// Explanation:
	// The previous code block takes all user registration data from a temporary table/array ($qr_gt_user_data_ans_row),
	// adds a value from $_POST['delegate_flag'] (which you say you do NOT have), 
	// then constructs an INSERT SQL statement to copy all fields except 'srno', 'inv_gen_flag', and 'inv_sent_flag'
	// from the temp/demo registration table to the main/official registration table.
	// If you do not (and will never) use 'delegate_flag', you can REMOVE that line.

	if (!empty($qr_gt_user_data_ans_row)) {
		$fields = '';
		$values = '';
		foreach ($qr_gt_user_data_ans_row as $key => $value) {
			if ($key != 'srno' && $key != 'inv_gen_flag' && $key != 'inv_sent_flag') {  // Skip these fields
				$fields .= $key . ',';
				$values .= "'" . mysqli_real_escape_string($link, $value) . "',";
			}
		}
		$values = trim($values, ',');
		$fields = trim($fields, ',');

		mysqli_query($link, "INSERT INTO " . $EVENT_DB_FORM_REG . " ($fields) VALUES ($values)");
	}

	if ($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
		$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
	} else {
		$total_amt = $qr_gt_user_data_ans_row['total'];
	}

	for ($i = 1; $i <= $qr_gt_user_data_ans_row['sub_delegates']; $i++) {
		//############################################################################
		break;
		//############################################################################
		if (true) { //($qr_gt_user_data_ans_row['cata' . $i] == 'Premium Delegate') || ($qr_gt_user_data_ans_row['cata' . $i] == 'International Premium Delegate') ) {
			$test_delegate_email = $qr_gt_user_data_ans_row['email' . $i];
			$qry_email_chk = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'");
			$qry_email_chk_num = mysqli_num_rows($qry_email_chk);

			if ($qry_email_chk_num >= 1) {
			} else {
				//-------------------------------------------------- Generating User Id ------------------------------------------------
				$usr_no = $EVENT_TBL_PREFIX . '_' . $EVENT_YEAR . "_nrm_";
				$i_gim_inx_user_id_cnt = 0;
				do {
					$temp_no = rand(1, 9999999);
					$temp_no_len = strlen($temp_no);

					if ($temp_no_len < 7) {
						$temp_no_len = 7 - $temp_no_len;
						while ($temp_no_len) {
							$temp_no = $temp_no . "0";
							$temp_no_len--;
						}
					}
					$usr_no1 = $usr_no . $temp_no;
					$qry = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE user_id = '$usr_no1'");
					$res_no = mysqli_num_rows($qry);
					if ($res_no < 1) {
						$i_gim_inx_user_id_cnt++;
					} else {
						$usr_no1 = "";
					}
				} while (!($i_gim_inx_user_id_cnt == 1));
				//-------------------------------------------------End Generating User Id ------------------------------------------------

				$dele_title = $qr_gt_user_data_ans_row['title' . $i];
				$dele_fname = $qr_gt_user_data_ans_row['fname' . $i];
				$dele_lname = $qr_gt_user_data_ans_row['lname' . $i];
				$dele_email = $qr_gt_user_data_ans_row['email' . $i];
				$dele_cellno = $qr_gt_user_data_ans_row['cellno' . $i];
				$dele_cellno_arr = explode("-", $dele_cellno);

				$test_title = $qr_gt_user_data_ans_row['title' . $i];
				$test_fname = $qr_gt_user_data_ans_row['fname' . $i];
				$test_lname = $qr_gt_user_data_ans_row['lname' . $i];
				$test_email = $qr_gt_user_data_ans_row['email' . $i];


				$pas1_inx = str_replace(' ', '_', $qr_gt_user_data_ans_row['fname' . $i]) . "123";
				$pas2_inx = md5($pas1_inx);
				$user_id_md5 = md5($usr_no1);

				$temp_qr_gt_user_data_ans_row_fone_arr = explode("-", $qr_gt_user_data_ans_row['fone']);
				$temp_qr_gt_user_data_ans_row_fax_arr = explode("-", $qr_gt_user_data_ans_row['fax']);

				//------------------------------------------------- Inserting Values in interlinx registration table --------------------------------------
				mysqli_query($link, "INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
    	            		(user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,org_info,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,				fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,reg_id,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no) values 
    	            		('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','','$dele_email','','$qr_gt_user_data_ans_row[org]','','','$dele_cellno_arr[0]','$dele_cellno_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row[reg_id]','$qr_gt_user_data_ans_row[reg_id]','uploads/default_file.jpg','','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[tin_no]')") or die(mysqli_error($link));

				$year = $EVENT_YEAR;
				$month = 11;
				$date = 29;
				mysqli_query($link, "insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values				

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL), 				
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:00:00 pm','18:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));

				/*(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),
																																																																																																																																																																																																											(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
																																																																																																																																																																																																											(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
																																																																																																																																																																																																											(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
																																																																																																																																																																																																											(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
																																																																																																																																																																																																											(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
																																																																																																																																																																																																											(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','19:00:00 pm','19:30:00 pm',NULL,'',NULL,NULL)*/

				$month = 11;
				$date = 30;
				mysqli_query($link, "insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
					
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),		
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:00:00 pm','18:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));
				/*(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
																																																																																																																																																																																																											(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),
																																																																																																																																																																																																											(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
																																																																																																																																																																																																											(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),
																																																																																																																																																																																																											(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),
																																																																																																																																																																																																											(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','19:00:00 pm','19:30:00 pm',NULL,'',NULL,NULL)
																																																																																																																																																																																																											*/
				$month = "12";
				$date = "01";
				mysqli_query($link, "insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
    				
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),

					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:00:00 pm','18:30:00 pm',NULL,'',NULL,NULL),
    				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));
				//------------------------------------------------- end Inserting Values in interlinx registration table --------------------------------------

			}
		}
	}

	$qr_gt_user_inx_login_data_id = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE tin_no = '$res[tin_no]' ");
	while ($qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qr_gt_user_inx_login_data_id)) {
		include "reg_inx_emailer.php";
		$temp_p_email = $EVENT_ENQUIRY_EMAIL;
		$temp_p_name = $EVENT_NAME . " InterlinX";
		$str_career = "Thank you for Registration on " . $EVENT_NAME . " InterlinX";
		$str_career_bdy = $mail_interlinx_str;

		$recipients = array($qr_gt_user_inx_login_data_ans['pri_email'], 'test.interlinks@gmail.com'); //, '', $EVENT_ENQUIRY_EMAIL, '', 'interlinx@outlook.com', '', '');

	}
	

//  echo "<script language='javascript'>window.location = 'registration9_no_pg.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
//                 exit;
	// ieee_member is Yes from $EVENT_DB_FORM_REG then redirect to registration9.php
	// if ($qr_gt_user_data_ans_row['ieee_member'] == 'Yes') {
	// 	echo "<script language='javascript'>window.location = 'registration9_no_pg.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
	// 	exit;
	// }

	if ($qr_gt_user_data_ans_row['cata'] == 'Next Gen HPC Experience') {
		echo "<script language='javascript'>window.location = 'registration9_no_pg.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
		exit;
	}
	$recipients = array();
	// $recipient = array('test.interlinks@gmail.com', 'bhavya.n@mmactiv.com', 'ambika.kiran@mmactiv.com');
	$recipient = array('test.interlinks@gmail.com');

	switch ($qr_gt_user_data_ans_row['sub_delegates']) {
		case 1:
			$recipients = array($res['email1']);
			break;
		case 2:
			$recipients = array($res['email1'], $res['email2']);
			break;
		case 3:
			$recipients = array($res['email1'], $res['email2'], $res['email3']);
			break;
		case 4:
			$recipients = array($res['email1'], $res['email2'], $res['email3'], $res['email4']);
			break;
		case 5:
			$recipients = array($res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5']);
			break;
		case 6:
			$recipients = array($res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5'], $res['email6']);
			break;
		case 7:
			$recipients = array($res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5'], $res['email6'], $res['email7']);
			break;
	}
	//$recipients = array();
	//$recipients = array_merge($recipients, $recipient);
	//$recipients = array('test.interlinks@gmail.com','', 'sagarpatil2112@gmail.com');
	//print_r($recipients);exit;
	//$recipients = array('', 'test.interlinks@gmail.com','', 'mayuri.ladi@interlinks.in');
	// require 'class.phpmailer.php';

	// require 'api/delegate.php';
	if ($res['pay_status'] == 'Free') {
		for ($i = 1; $i <= $res['sub_delegates']; $i++) {
			$dele_title = $res['title' . $i];
			$dele_fname = $res['fname' . $i];
			$dele_lname = $res['lname' . $i];
			$dele_email = $res['email' . $i];
			$job_title = $res['job_title' . $i];
			$dele_cellno = $res['cellno' . $i];
			$dele_cellno_arr = explode("-", $dele_cellno);

			if (isset($dele_cellno_arr[0])) {
				$country_code = $dele_cellno_arr[0];
				if (strlen($country_code) >= 6) {
					$phone = $country_code;
					$country_code = '+91';
				}
			}
			if (isset($dele_cellno_arr[1])) {
				$phone = $dele_cellno_arr[1];
			}
			//Call save Operator API
			$data = array();
			$data['name'] = $dele_title . ' ' . $dele_fname . ' ' . $dele_lname;
			$data['email_id'] = $dele_email;
			$data['country_code'] = $country_code;
			$data['mobile'] = $phone;
			$data['company'] = $res['org'];
			$data['designation'] = $job_title;
			$data['type'] = 1;

			//$data['booking_id']= $res['tin_no'];
			//$data['additional_data_1']= $res['assoc_name'];
			//$data['additional_data_2']= $res['city'];
			//$data['additional_data_3']= $res['state'];
			//Call API
			//callUniversalAPI($data);
			if ($res['cata' . $i] == 'Conference Delegate') {
				$data['category_id'] = 113;
				//callUniversalAPI($data);
			} else {
				$data['category_id'] = 114;
				//callUniversalAPI($data);
			}
		}
		require "emailer_reg_del.php";
	} else {
		//require "emailer_reg_del.php";
		require "emailer_reg.php";
	}
	//if promocode1 != INVCOMGOLD then skip below code

	//echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
	//exit;

	// if ($res['promocode1'] != 'INVCOMGOLD') {
	// if (strpos($qr_gt_user_data_ans_row['investor_flag'], 'inv') !== false) {
	// 	// update db with approval_status = pending
	// 	$query = "UPDATE $EVENT_DB_FORM_REG SET approved_status = 'Pending' WHERE tin_no = '$res[tin_no]'";
	// 	$result = mysqli_query($link, $query);
	// 	echo "<script language='javascript'>window.location = 'https://www.startupmahakumbh.org/startup_forms/investor_form_review.php?id=" . $qr_gt_user_data_ans_row['email1'] . "';</script>";
	// 	exit;
	// }
	// }

	//merge the recipient array
	$recipients = array_merge($recipients, $recipient);
	//$recipients = array('test.interlinks@gmail.com','', 'sagarpatil2112@gmail.com');
	if ($qr_gt_user_data_ans_row['pay_status'] == "Not Paid") {
		// elastic_mail("Thank you for Initiating Registration with " . $EVENT_NAME, $mail_body, $recipients);
	}//echo $mail_body;exit;
	//exit;
	// $EVENT_OL_PAY_ACT_LINK = "https://sci25.supercomputingindia.org/pay/create-order.php";


	if (($qr_gt_user_data_ans_row['paymode'] == 'Online' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking' || $qr_gt_user_data_ans_row['paymode'] == 'Google pay') && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid' && $qr_gt_user_data_ans_row['adminDiscountPer'] != '100') {
		/*//echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";*/
		session_destroy();
		echo 'Please wait while you redirecting to payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		echo "<script language='javascript'>setTimeout(function(){ window.location = ('$EVENT_OL_PAY_ACT_LINK?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 3000);</script>";
		exit;
		// } else if ($qr_gt_user_data_ans_row['paymode'] == "Online" && $qr_gt_user_data_ans_row['curr'] == 'Foreign' && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
		// 	session_destroy();
		// 	echo 'Please wait while you redirecting to Razorpay payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		// 	echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CANCEL_URL?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 3000);</script>";
		// 	exit;
	} elseif (
		($qr_gt_user_data_ans_row['paymode'] == "Online" && $qr_gt_user_data_ans_row['pay_status'] == "Complimentary") || ($qr_gt_user_data_ans_row['adminDiscountPer'] == "100")
	) {
		$pin_no1 = "PRN-SCI" . $EVENT_YEAR . "-";
		$i = 0;
		$pg_error = "";
		do {
			$pin_no2 = rand(1, 99999);
			switch (strlen($pin_no2)) {
				case 1:
					$pin_no2 = "0000" . $pin_no2;
					break;
				case 2:
					$pin_no2 = "000" . $pin_no2;
					break;
				case 3:
					$pin_no2 = "00" . $pin_no2;
					break;
				case 4:
					$pin_no2 = "0" . $pin_no2;
					break;
				case 5:
					$pin_no2 = $pin_no2;
					break;
			}
			$pin_no = $pin_no1 . $pin_no2;
			$pin_no = mysqli_real_escape_string($link, $pin_no);
			$qry = mysqli_query($link, "SELECT * FROM $EVENT_DB_FORM_REG WHERE pin_no = '$pin_no'");
			$res_no = mysqli_num_rows($qry);
			if ($res_no < 1) {
				$i++;
			} else {
				$pin_no = "";
				$pin_no2 = "";
			}

		} while (!($i == 1));

		//update $EVENT_DB_FORM_REG  table pin_no where tin_no = $res['tin_no']
		$sq = "UPDATE $EVENT_DB_FORM_REG SET pin_no = '$pin_no' WHERE tin_no = '$res[tin_no]'";
		$qr = mysqli_query($link, $sq);
		$recipients = array();

		if ($res['adminDiscountPer'] == "100") {
			$query = "UPDATE $EVENT_DB_FORM_REG SET pay_status = 'Complimentary' WHERE tin_no = '$res[tin_no]'";
			$result = mysqli_query($link, $query);
		}
		// Update promocode table
		$sub_delegates_count = $res['sub_delegates'];
		$promocode_query = mysqli_query($link, "UPDATE promo_codes SET used = used + $sub_delegates_count, remaining = remaining - $sub_delegates_count WHERE code = '$res[promocode1]'");

		// require 'mail/function.php';


		$to2 = array();


		//send elastic mail with thank for registration 
		// for ($i = 1; $i <= $res['sub_delegates']; $i++) {
		// 	$dele_title = $res['title' . $i];
		// 	$dele_fname = $res['fname' . $i];
		// 	$dele_lname = $res['lname' . $i];
		// 	$dele_email = $res['email' . $i];

		// 	$recipients[] = $dele_email;

		// 	$name = $dele_title . ' ' . $dele_fname . ' ' . $dele_lname;

		// 	require 'mail/content.php';

		// 	$subjects = "Your registration is confirmed!";
		// 	$bodys = $mail_contents;

		// 	array_push($to2, $dele_email, 'test.interlinks@gmail.com');

		// 	$event_name = $res['event_name'];

		// 	$attachmentPath = '';

		// 	if ($event_name == "Bengaluru + Mysuru Event") {
		// 		$attachmentPath = 'mail/bangalore&mysore.ics';
		// 	} elseif ($event_name == "Bengaluru Event") {
		// 		$attachmentPath = 'mail/bengaluru.ics';
		// 	} elseif ($event_name == "Mysuru Event") {
		// 		$attachmentPath = 'mail/mysuru.ics';
		// 	}

		// 	elastic_mail_attach($subjects, $bodys, $to2, $attachmentPath);

		// }
		$recipient[] = 'test.interlinks@gmail.com';
		//merge the recipient array
		$recipients = array_merge($recipients, $recipient);
		elastic_mail("Thank you for Registration with " . $EVENT_NAME, $mail_body, $recipients);
		$tin_no = $qr_gt_user_data_ans_row['tin_no'];
		// require '../api/send_delegate_data.php';
		// sendPaymentData($tin_no, $link);

		// send data to chkdin

		// function log_to_file($message)
		// {
		// 	$logPath = __DIR__ . '/chkdin_debug.log'; // You can change the path
		// 	$timestamp = date('[Y-m-d H:i:s]');
		// 	file_put_contents($logPath, "$timestamp $message\n", FILE_APPEND);
		// }

		// for ($i = 1; $i <= $res['sub_delegates']; $i++) {
		// 	try {
		// 		$dele_title = $res['title' . $i];
		// 		$dele_fname = $res['fname' . $i];
		// 		$dele_lname = $res['lname' . $i];
		// 		$dele_email = $res['email' . $i];
		// 		$job_title = $res['job_title' . $i];
		// 		$dele_cellno = str_replace('+', '', $res['cellno' . $i]);
		// 		$dele_cellno_arr = explode("-", $dele_cellno);

		// 		$country_code = '91';
		// 		$phone = $dele_cellno;

		// 		if (isset($dele_cellno_arr[0])) {
		// 			if (strlen($dele_cellno_arr[0]) >= 6) {
		// 				$phone = $dele_cellno_arr[0];
		// 			} else {
		// 				$country_code = $dele_cellno_arr[0];
		// 			}
		// 		}
		// 		if (isset($dele_cellno_arr[1])) {
		// 			$phone = $dele_cellno_arr[1];
		// 		}

		// 		$data = [
		// 			'name' => $dele_fname . ' ' . $dele_lname,
		// 			'email' => $dele_email,
		// 			'country_code' => $country_code,
		// 			'mobile' => $phone,
		// 			'company' => $res['org'],
		// 			'api_key' => 'scan626246ff10216s477754768osk',
		// 			'event_id' => 118089
		// 		];

		// 		if ($res['cata' . $i] == 'Industry Delegate') {
		// 			$data['category_id'] = 3026;
		// 			$data['qsn_764'] = 'Industry Delegate';
		// 		} elseif ($res['cata' . $i] == 'Academia Delegate') {
		// 			$data['category_id'] = 3027;
		// 			$data['qsn_764'] = 'Academia Delegate';
		// 		} elseif ($res['cata' . $i] == 'Student Delegate') {
		// 			$data['category_id'] = 3028;
		// 			$data['qsn_764'] = 'Student Delegate';
		// 		}

		// 		log_to_file("Calling sendchkdinapi for: " . $data['email']);
		// 		$response = sendchkdinapi($data);
		// 		log_to_file("Response from sendchkdinapi for {$data['email']}: $response");

		// 	} catch (Throwable $e) {
		// 		log_to_file("Exception for {$res['email' . $i]}: " . $e->getMessage());
		// 	}
		// }


		//send to dreamcast system
		// individual_delegate($qr_gt_user_data_ans_row['tin_no']);

		// mysqli_close($link);
		header("Location: registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no']);
		exit;
	} else {

		// mysqli_close($link);
		echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
		exit;
	}

	/* if($_POST['make_payment'] == 1) {

																																																			  } else if($_POST['make_payment'] == 0) {
																																																				  if($qr_gt_user_data_ans_row['paymode'] == 'Online' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {
																																																					  echo "<script language='javascript'>window.location = 'registration9.php';</script>";
																																																					  exit;
																																																				  }
																																																			  } */
}

mysqli_close($link);
echo "<script language='javascript'>alert('Your registration has been failed. Please try again.');</script>";
echo "<script language='javascript'>window.location = 'https://sci25.supercomputingindia.org';</script>";
exit;

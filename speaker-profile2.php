<?php
session_start();
//$recaptcha = @$_SESSION["vercode_sp"];//@$_POST['g-recaptcha-response'];
//if (empty($recaptcha)) {

if (empty($_SESSION["vercode_sp"]) || ($_POST["vercode"] != $_SESSION["vercode_sp"])) {
	session_destroy();
	echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
	echo "<script language='javascript'>window.location = 'speaker-profile.php';</script>";
	exit;
}

/*print_r($_POST);
echo $_POST['delegate_flag'];
exit;*/

$delegate_flag = @$_POST['delegate_flag'];

//}
require("includes/form_constants_both.php");
require "dbcon_open.php";

//print_r($_POST);


$nm = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['speaker_title'])) . " " . mysqli_real_escape_string($link,htmlspecialchars(@$_POST['speaker_fname'])) . " " . mysqli_real_escape_string($link,htmlspecialchars(@$_POST['speaker_lname']));

$sessTrack = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['session_track']));
$reg_date = date('Y-m-d');
$reg_time = date('H:i:s');
$vercode = mysqli_real_escape_string($link,htmlspecialchars($_POST['vercode']));

/*if (isset($_FILES['speaker_photo']['name']) && !empty($_FILES['speaker_photo']['name'])) {
	//$maxsize    = 2097152;
	$file_size = $_FILES['speaker_photo']['size'];
	$file_type = pathinfo($_FILES['speaker_photo']['name'], PATHINFO_EXTENSION);
	$mimeType = array('gif', 'png', 'jpg', 'jpeg');

	if (!in_array($file_type, $mimeType)) {
		echo "<script language='javascript'>alert('Please upload only image file.');</script>";
		echo "<script language='javascript'>window.location='speaker-profile.php';</script>";
		exit;
	}
	/* if($file_size > $maxsize){
				  echo "<script language='javascript'>alert('File size must under 1MB!');</script>";
				  echo "<script language='javascript'>window.location='speaker-profile.php';</script>";
				  exit;
			  } */

	/*$photoUploadPath = 'photo/';

	if (!file_exists($photoUploadPath)) {
		mkdir($photoUploadPath, 0777);
	}

	$filePath = $photoUploadPath . 'photo_' . $vercode . '.' . pathinfo($_FILES['speaker_photo']['name'], PATHINFO_EXTENSION);

	$filePath = $EVENT_FORM_LINK . $filePath . ".png";
	//echo $filePath;

	move_uploaded_file($_FILES['speaker_photo']['tmp_name'], $filePath);


	if (move_uploaded_file($_FILES['speaker_photo']['tmp_name'], $filePath)) {
	} else {
		echo "<script language='javascript'>alert('Error in Uploading Image, Please try again or contact admin');</script>";
		echo "<script language='javascript'>window.location='speaker-profile.php';</script>";
		exit;
	}
	//verify file is uploaded or not



	

}*/

if (isset($_FILES['speaker_photo']['name']) && !empty($_FILES['speaker_photo']['name'])) {
    $maxsize = 4 * 1024 * 1024; // 4MB
    $file_size = $_FILES['speaker_photo']['size'];
    $file_type = pathinfo($_FILES['speaker_photo']['name'], PATHINFO_EXTENSION);
    $mimeType = array('gif', 'png', 'jpg', 'jpeg');

    if (!in_array($file_type, $mimeType)) {
        echo "<script language='javascript'>alert('Please upload only image files.');</script>";
        echo "<script language='javascript'>window.location='speaker-profile.php';</script>";
        exit;
    }

    if ($file_size > $maxsize) {
        echo "<script language='javascript'>alert('File size must be under 4MB!');</script>";
        echo "<script language='javascript'>window.location='speaker-profile.php';</script>";
        exit;
    }

    $photoUploadPath = 'photo/';
    if (!file_exists($photoUploadPath)) {
        mkdir($photoUploadPath, 0777);
    }

    $vercode = uniqid(); // Ensure $vercode is defined
    $filePath = $photoUploadPath . 'photo_' . $vercode . '.' . $file_type;

    if (move_uploaded_file($_FILES['speaker_photo']['tmp_name'], $filePath)) {
        //echo "<script language='javascript'>alert('File uploaded successfully!');</script>";
    } else {
        echo "<script language='javascript'>alert('Error in Uploading Image, Please try again or contact admin');</script>";
		echo "<script language='javascript'>window.location='speaker-profile.php';</script>";
		exit;
    }

	$filePath = $EVENT_FORM_LINK . $filePath;
}



if (!isset($filePath)) {
	echo "<script language='javascript'>alert('Please upload your Photo.');</script>";
	echo "<script language='javascript'>window.location='speaker-profile.php';</script>";
	exit;
}

$email = $_POST['speaker_email_1'];
$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_SPEAKER_PROFILE . " WHERE speaker_email_1 = '$email'") or die(mysqli_error($link));
$num_row = mysqli_num_rows($qr);
if ($num_row > 0) {
	echo "<script language='javascript'>alert('The email id \'" . $email . "\' is already registered with us.');</script>";
	echo "<script language='javascript'>window.location='speaker-profile.php';</script>";
	exit;
}

$sql = "INSERT INTO $EVENT_DB_FORM_SPEAKER_PROFILE(added_date,added_time,reg_id)VALUES('$reg_date','$reg_time','$vercode')";
//echo "<br />".$sql."<br />";

mysqli_query($link,$sql);

//exit;
$detail = $_POST;

$field = '';
//$detail['mob'] = $detail['c_code'] . '-' . $detail['mob'];
$detail['shrt_bgrphy_fl'] = mysqli_real_escape_string($link,htmlspecialchars(($detail['shrt_bgrphy_fl'])));

//unset($detail['speaker_mob_cntry_code']);
unset($detail['vercode']);
unset($detail['g-recaptcha-response']);
$field = '';

//print_r($detail);
//echo "<br />";

foreach ($detail as $key => $val) {
	$field .= ",`" . $key . "`='" . mysqli_real_escape_string($link,htmlspecialchars($val)) . "'";
}
$field = trim($field, ',');
$field =mysqli_real_escape_string($link,htmlspecialchars($field));




//echo $field;
$sesion = mysqli_real_escape_string($link,htmlspecialchars($_POST['session_track']));
//speaker_title
$speaker_title = mysqli_real_escape_string($link,htmlspecialchars($_POST['speaker_title']));
//speaker_fname
$speaker_fname  =  mysqli_real_escape_string($link,htmlspecialchars($_POST['speaker_fname']));
//speaker_lname
$speaker_lname =  mysqli_real_escape_string($link,htmlspecialchars($_POST['speaker_lname']));
$speaker_desig =  mysqli_real_escape_string($link,htmlspecialchars($_POST['speaker_desig']));
$speaker_org =  mysqli_real_escape_string($link,htmlspecialchars($_POST['speaker_org']));
//speaker_email_1
$speaker_email_1 =  mysqli_real_escape_string($link,htmlspecialchars($_POST['speaker_email_1']));
//speaker_mob_cntry_code
$speaker_mob_cntry_code =  mysqli_real_escape_string($link,htmlspecialchars($_POST['speaker_mob_cntry_code']));
//speaker_mob
$speaker_mob =  mysqli_real_escape_string($link,htmlspecialchars($_POST['speaker_mob']));
//linkedin_link
$linkedin_link =  mysqli_real_escape_string($link,htmlspecialchars($_POST['linkedin_link']));
//twitter_link
$twitter_link =  mysqli_real_escape_string($link,htmlspecialchars($_POST['twitter_link']));
$speaker_country = mysqli_real_escape_string($link,htmlspecialchars($_POST['speaker_country']));
//shrt_bgrphy_fl
$shrt_bgrphy_fl = mysqli_real_escape_string($link,htmlspecialchars($_POST['shrt_bgrphy_fl']));
$delegate_flag = mysqli_real_escape_string($link,htmlspecialchars($_POST['delegate_flag']));
//vercode_sp2
$vercode_sp2 = mysqli_real_escape_string($link,htmlspecialchars($_POST['vercode']));

/*$sql = "UPDATE $EVENT_DB_FORM_SPEAKER_PROFILE SET $field WHERE `session_track`='$sesion' AND `speaker_title`='$speaker_title' AND `speaker_fname`='$speaker_fname' AND `speaker_lname`='$speaker_lname' AND `speaker_desig`='$speaker_desig' AND `speaker_org`='$speaker_org' AND `speaker_email_1`='$speaker_email_1' AND `speaker_mob_cntry_code`='$speaker_mob_cntry_code' AND `speaker_mob`='$speaker_mob' AND `linkedin_link`='$linkedin_link' AND `twitter_link`='$twitter_link' AND `speaker_country`='$speaker_country' AND `shrt_bgrphy_fl`='$shrt_bgrphy_fl' AND `delegate_flag`='$delegate_flag' AND `vercode_sp2`='$vercode_sp2' ";
*/

$sql = "UPDATE $EVENT_DB_FORM_SPEAKER_PROFILE SET `session_track`='$sesion', `speaker_title`='$speaker_title', `speaker_fname`='$speaker_fname', `speaker_lname`='$speaker_lname', `speaker_desig`='$speaker_desig', `speaker_org`='$speaker_org', `speaker_email_1`='$speaker_email_1', `speaker_mob_cntry_code`='$speaker_mob_cntry_code', `speaker_mob`='$speaker_mob', `linkedin_link`='$linkedin_link', `twitter_link`='$twitter_link', `speaker_country`='$speaker_country', `shrt_bgrphy_fl`='$shrt_bgrphy_fl', `delegate_flag`='$delegate_flag', `vercode_sp2`='$vercode_sp2' WHERE reg_id='$vercode'";

mysqli_query($link,$sql);



//print_r($_FILES);
if (isset($filePath) && !empty($filePath)) {
	$sql = "UPDATE $EVENT_DB_FORM_SPEAKER_PROFILE SET speaker_photo='$filePath' WHERE reg_id='$vercode'";
	mysqli_query($link,$sql) or die(mysqli_error($link));
}
//exit;
require "class.phpmailer.php";

include "speaker-profile-user-mail.php";
//echo $enq_emailer_mail_msg_user;//exit;


/* $mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $EVENT_NAME . ' ' . $EVENT_YEAR;
	$mail->From = $EVENT_ENQUIRY_EMAIL;
	$mail->Subject = 'Thank you for submitting speaker information form for ' . $EVENT_NAME . ' ' . $EVENT_YEAR;
	$mail->IsHTML(true);
	$mail->Body = $enq_emailer_mail_msg_user; */

$mail = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPDebug = 0;						// enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth = true;					// enable SMTP authentication
//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
$mail->Host = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
$mail->Port = 25;                   // set the SMTP port for the server
$mail->Username = "enquiry-bengalurutechsummit";  // username
$mail->Password = "Enq@ui2ry@be";				// password

$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
$mail->Subject = 'Thank you for submitting speaker information form for ' . $EVENT_NAME . ' ' . $EVENT_YEAR;
$mail->MsgHTML($enq_emailer_mail_msg_user);

//echo $enq_emailer_mail_msg_user;exit;
$receipents = array('test.interlinks@gmail.com', '', $detail['speaker_email_1']);
//$receipents = array('test.interlinks@gmail.com', 'sagarpatil2112@gmail.com');
/*foreach ( $receipents as $emailid ) {
		$mail->AddAddress ( $emailid );
		if (! $mail->Send ()) {
			echo '#'.$emailid;
		}
		$mail->clearAddresses ();
	}*/

$Subject = 'Thank you for submitting speaker information form for ' . $EVENT_NAME . ' ' . $EVENT_YEAR;
$receipents[] = 'test.interlinks@gmail.com';
elastic_mail($Subject, $enq_emailer_mail_msg_user, $receipents);

//admin
include "speaker-profile-admin-mail.php";
//echo $mail_msg;exit;
/* $mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $nm;
	$mail->From = $EVENT_ENQUIRY_EMAIL;
	$mail->Subject = 'Speaker profile information for ' . $EVENT_NAME . ' ' . $EVENT_YEAR;
	$mail->IsHTML(true);
	$mail->Body = $mail_msg; */

$mail = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPDebug = 0;						// enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth = true;					// enable SMTP authentication
//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
$mail->Host = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
$mail->Port = 25;                   // set the SMTP port for the server
$mail->Username = "enquiry-bengalurutechsummit";  // username
$mail->Password = "Enq@ui2ry@be";				// password

$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
$mail->Subject = 'Speaker profile information for ' . $EVENT_NAME . ' ' . $EVENT_YEAR;
$mail->MsgHTML($mail_msg);

$receipents = array('test.interlinks@gmail.com', 'conference@mmactiv.com');

//$receipents = array('test.interlinks@gmail.com', 'sagarpatil2112@gmail.com');
/*foreach ( $receipents as $emailid ) {
		$mail->AddAddress ( $emailid );
		if (! $mail->Send ()) {
		}
		$mail->clearAddresses ();
	}*/
	$delegate_flag = @$_POST['delegate_flag'];
$Subject = 'Speaker profile information for ' . $EVENT_NAME . ' ' . $EVENT_YEAR;
//$receipents[] = 'test.interlinks@gmail.com';
$receipents = array('test.interlinks@gmail.com', 'conference@mmactiv.com', 'priyamvada.bhide@mmactiv.com', 'sneha.singh@mmactiv.com', 'hemalatha.br@mmactiv.com');
elastic_mail($Subject, $mail_msg, $receipents);

//=================== Start Interlinx =======================================
if (true) {
	$temp_srno_gt = rand(10, 100);
	$tin_no = $EVENT_DB_TIN_NO;
	do {
		$i = $j = 0;

		$tin_no1 = $tin_no . $temp_srno_gt . mt_rand(1, 99999);

		$qry1 = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no1'");
		$res_no1 = mysqli_num_rows($qry1);

		if (($res_no1 == 0)) {
			$i++;
			$j++;
		} else {
			$i = 0;
			$j = 0;
			$tin_no1 = "";
		}
	} while (($i <= 0) || ($j <= 0));
	$tin_no = $tin_no1;

	$regData = array();
	$regData['title1'] = $detail['speaker_title'];
	$regData['fname1'] = $detail['speaker_fname'];
	$regData['lname1'] = $detail['speaker_lname'];
	$regData['email1'] = $detail['speaker_email_1'];
	$regData['badge1'] = $nm;
	$regData['job_title1'] = $detail['speaker_desig'];
	$regData['cellno1'] = $detail['speaker_mob_cntry_code'] . '-' . $detail['speaker_mob'];
	$regData['cata1'] = $regData['cata'] = $regData['user_type'] = 'Speaker';
	$regData['org'] = $detail['speaker_org'];
	//$regData['city'] = $detail['speaker_city'];
	$regData['country'] = $detail['speaker_country'];
	$regData['gr_type'] = 'Single';
	$regData['sub_delegates'] = 1;
	$regData['pay_status'] = 'Complimentary';
	$regData['assoc_srno'] = 102;
	$ddate = date("Y-m-d");
	$ttime = date("H:i:s A");
	$regData['reg_date'] = $ddate;
	$regData['reg_time'] = $ttime;
	$regData['tin_no'] = $tin_no;
	$regData['pin_no'] = str_replace('TIN', 'PRN', $tin_no);

	if (!empty($regData)) {
		$fields = '';
		$values = '';
		foreach ($regData as $key => $value) {
			if ($key != 'srno') {
				$fields .= $key . ',';
				$values .= "'" . mysqli_real_escape_string($link,$value) . "',";
			}
		}
		$values = trim($values, ',');
		$fields = trim($fields, ',');

		$sql = "INSERT INTO " . $EVENT_DB_FORM_REG . " ($fields) VALUES ($values)";
		

		mysqli_query($link,"insert  into " . $EVENT_DB_FORM_REG . "($fields) VALUES($values)");
	}

	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no'");
	$res = $qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);

	$i = $sub_delegate = 1;
	$test_delegate_email = $qr_gt_user_data_ans_row['email' . $i];
	$qry_email_chk = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'");
	$qry_email_chk_num = mysqli_num_rows($qry_email_chk);
	$temp_receiver_org = $qr_gt_user_data_ans_row['org'];
	if ($qry_email_chk_num >= 1) {
		//alert user that this email is already exist
		echo "<script>alert('This email already exists.');</script>";
		//redirect to previous page
		 echo "<script language='javascript'>window.location='speaker-profile.php';</script>";
		exit;
		//echo $test_delegate_email. ' ' . $qr_gt_user_data_ans_row['cata' . $i] . ' ' . $i . ' #<br/>';
	} else 
	
	{

		
		if($delegate_flag == "Yes"){

		
		//echo $test_delegate_email. ' ' . $qr_gt_user_data_ans_row['cata' . $i] . ' ' . $i . ' <br/>';
		//exit;
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
			$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE user_id = '$usr_no1'");
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


		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = substr(str_shuffle($characters), 0, 4);
		$pas1_inx = str_replace(' ', '_', $qr_gt_user_data_ans_row['fname' . $i]) . $randomString;
		$pas2_inx = password_hash($pas1_inx, PASSWORD_BCRYPT);
		$user_id_md5 = md5($usr_no1);

		$temp_qr_gt_user_data_ans_row_fone_arr = explode("-", $qr_gt_user_data_ans_row['fone']);
		$temp_qr_gt_user_data_ans_row_fax_arr = explode("-", $qr_gt_user_data_ans_row['fax']);

		$qr_gt_user_data_ans_row['org_profile'] = '';
		//------------------------------------------------- Inserting Values in interlinx registration table --------------------------------------
		/*echo "INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
								(user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,org_info,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,				fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,reg_id,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no) values 
								('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','','$dele_email','','$qr_gt_user_data_ans_row[org]','','','$dele_cellno_arr[0]','$dele_cellno_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row[reg_id]','$qr_gt_user_data_ans_row[reg_id]','uploads/default_file.jpg','$qr_gt_user_data_ans_row[org_profile]','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[tin_no]');";*/
		mysqli_query($link,"INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
					(user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,org_info,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,reg_id,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no) values 
					('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','','$dele_email','','$qr_gt_user_data_ans_row[org]','','','$dele_cellno_arr[0]','$dele_cellno_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row[reg_id]','$qr_gt_user_data_ans_row[reg_id]','uploads/default_file.jpg','$qr_gt_user_data_ans_row[org_profile]','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[tin_no]')") or die(mysqli_error($link));

		$year = $EVENT_YEAR;
		$month = 11;
		$date = 19;
		mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values				
		
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
		(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)
		
		
		
		") or die(mysqli_error($link));

		/*
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
					 
					 (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),
					 (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
					 (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
					 (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
			 ,
					 (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:00:00 pm','18:30:00 pm',NULL,'',NULL,NULL)
					 (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL),
					 (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','19:00:00 pm','19:30:00 pm',NULL,'',NULL,NULL)*/

	
		$date = 20;
		mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
			
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
			(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)
			
			
			") or die(mysqli_error($link));
		/*
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),

						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),,
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:00:00 pm','18:30:00 pm',NULL,'',NULL,NULL)
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','19:00:00 pm','19:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL)
						*/
		
		$date = "21";
		mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
			
			
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
			(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL)
    		
			
			") or die(mysqli_error($link));
		/*
										(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),
					(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),

						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:00:00 pm','18:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL)*/
		//------------------------------------------------- end Inserting Values in interlinx registration table --------------------------------------

		$qr_gt_user_inx_login_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE user_name = '$dele_email' ");
		$qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qr_gt_user_inx_login_data_id);
		include "reg_inx_emailer.php";
		//echo $mail_interlinx_str;exit;
		$recipients = array($qr_gt_user_inx_login_data_ans['pri_email'], '', 'test.interlinks@gmail.com');
		//$recipients = array($qr_gt_user_inx_login_data_ans['pri_email']);
		//$recipients = array('sagarpatil2112@gmail.com', 'vivek.patil@mmactiv.com');
		elastic_mail("Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " - InterlinX", $mail_interlinx_str, $recipients);
		
	
		}
	}
	$recipients = array();
	$recipient = array($res['email1'], '', 'test.interlinks@gmail.com', '', '', '', 'bhavya.mmactiv@gmail.com', '', 'vinay.mmactiv@gmail.com', '', 'ambika.kiran@mmactiv.com', '', 'mohanram@mmactiv.in', '', 'gurunath.angadi@mmactiv.com', '', '');
	require "emailer_reg_free_vip.php";
	//echo $mail_body;exit;
	$Subject = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR;
	$recipients[] = 'test.interlinks@gmail.com';
	//$recipients = array('test.interlinks@gmail.com','', 'sagarpatil2112@gmail.com');
	elastic_mail($Subject, $mail_body, $recipients);

	//To push data in the API
	$result = array();
	$result['category_id'] = 434;
	$result['badge_print_category'] = 'Speaker';
	if (!empty($qr_gt_user_data_ans_row['assoc_srno'])) {
		$assoc_name = $qr_gt_user_data_ans_row['user_type'];
		$assoc_srno = $qr_gt_user_data_ans_row['assoc_srno'];
		$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_PROMO_CODE_TBL . " WHERE srno='$assoc_srno' AND assoc_name='$assoc_name'");
		$result = mysqli_fetch_assoc($qry);
	}
	$i = $sub_delegate;
	$dele_title = $res['title' . $i];
	$dele_fname = $res['fname' . $i];
	$dele_lname = $res['lname' . $i];
	$dele_email = $res['email' . $i];
	$job_title = $res['job_title' . $i];
	$dele_cellno = str_replace('+', '', $res['cellno' . $i]);
	$dele_cellno_arr = explode("-", $dele_cellno);

	if (isset($dele_cellno_arr[0])) {
		$country_code = $dele_cellno_arr[0];
		if (strlen($country_code) >= 6) {
			$phone = $country_code;
			$country_code = '91';
		}
	}
	if (isset($dele_cellno_arr[1])) {
		$phone = $dele_cellno_arr[1];
	}
	//Call save Operator API
	// $data = array();
	// $data['api_key'] = 'scan626246ff10216s477754768osk';
	// $data['event_id'] = 117859;
	// $data['name'] = $dele_fname . ' ' . $dele_lname;
	// $data['email'] = $dele_email;
	// $data['country_code'] = $country_code;
	// $data['mobile'] = $phone;
	// $data['company'] = $res['org'];
	// $data['designation'] = $job_title;
	// //$data['type']= 1;
	// $data['category_id']= 1869;
	// $data['qsn_366'] = "Speaker";
	// $data['country'] = $res['country'];
	
	// //print_r($data);
	// //Call API
	// sendchkdinapi($data);;//exit;
}
//exit;
echo "<script language='javascript'>window.location = 'speaker-profile3.php?nm=$nm';</script>";
exit;

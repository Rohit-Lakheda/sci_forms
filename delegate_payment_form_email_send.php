<?php


require("includes/form_constants_both.php");
require "dbcon_open.php";
require 'class.phpmailer.php';

$tin_no = "";
$tin_no = $_GET['id'];

if ($tin_no == "") {

	$tin_no = $_POST['id'];

	if ($tin_no == "") {
		$tin_no = $_REQUEST['id'];
	}
	if ($tin_no == "") {
		$tin_no = $_REQUEST['tin_no'];
	}
	if ($tin_no == "") {
		echo "<script language='javascript'>alert('Invalid TIN No., Please contact Admin.');</script>";
		echo "<script language='javascript'>window.location = ('https://www.mmactiv.in/pay/it-2023/enter_reg_tin_no_ex.php');</script>";
		exit;
	}
}

$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE tin_no = '$retin_nog_id'");
$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
$res = $qr_gt_user_data_ans_row;
$tin_no_final = $qr_gt_user_data_ans_row['tin_no'];

$qr_gt_user_data_id1      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE tin_no = '$tin_no'");


$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE tin_no = '$tin_no'");
$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
$res = $qr_gt_user_data_ans_row;

if ($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
	$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
} else {
	$total_amt = $qr_gt_user_data_ans_row['total'];
}

$recipient = array('test.interlinks@gmail.com');

switch ($qr_gt_user_data_ans_row['sub_delegates']) {
	case 1:
		$recipients = array('', $res['email1']);
		break;
	case 2:
		$recipients = array('', $res['email1'], $res['email2']);
		break;
	case 3:
		$recipients = array('', $res['email1'], $res['email2'], $res['email3']);
		break;
	case 4:
		$recipients = array('', $res['email1'], $res['email2'], $res['email3'], $res['email4']);
		break;
	case 5:
		$recipients = array('', $res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5']);
		break;
	case 6:
		$recipients = array('', $res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5'], $res['email6']);
		break;
	case 7:
		$recipients = array('', $res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5'], $res['email6'], $res['email7']);
		break;
}

//merge all email ids	
$recipients = array_merge($recipient, $recipients);


//print_r($recipients);


require "emailer_reg.php";


//print_r($res);
if($res['pay_status']== "Paid"){
    $Subject    = "Thank you for Making payment for Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR;
} else{
    $Subject    = "Thank you for Initiating Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR;
}
/*echo $Subject . "<br>";

print_r($recipients) . "<br>";

echo $mail_body;
exit;
*/
//$recipients[] = 'test.interlinks@gmail.com';
elastic_mail($Subject, $mail_body, $recipients);
//echo $mail_body;exit;
//exit;

//redirect to previous page

echo "<script language='javascript'>alert('Email Sent Successfully');</script>";

exit;

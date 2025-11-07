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



$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " WHERE tin_no = '$retin_nog_id'");

$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);

$res = $qr_gt_user_data_ans_row;

$tin_no_final = $qr_gt_user_data_ans_row['tin_no'];



$qr_gt_user_data_id1      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE tin_no = '$tin_no'");





$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE tin_no = '$tin_no'");

$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);

$res = $qr_gt_user_data_ans_row;



if ($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {

	$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];

} else {

	$total_amt = $qr_gt_user_data_ans_row['total'];

}



$recipients = array('test.interlinks@gmail.com', $EVENT_ENQUIRY_EMAIL, 'ambika.kiran@mmactiv.com', 'chandrachood.as@mmactiv.com', $res['cp_email']);



//$recipients[] = '';

//$recipients[] = $res['cp_email'];

//$recipients = array('', 'test.interlinks@gmail.com','', 'sagarpatil2112@gmail.com');

require "emailer_exhibitor_payment.php";

//echo $mail_body;exit;

$MAIL_HOST       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server

$MAIL_PORT       = 2525;                   // set the SMTP port for the server

$MAIL_USER_NAME  = "enquiry-bengalurutechsummit";  // username

$MAIL_PASS		 = "Enq@ui2ry@be";            // password



$mail             = new PHPMailer();

$mail->IsSMTP(); // telling the class to use SMTP

$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)

$mail->SMTPAuth   = true;					// enable SMTP authentication

//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier

$mail->Host       = $MAIL_HOST;				// sets  as the SMTP server

$mail->Port       = $MAIL_PORT;				// set the SMTP port for the server

$mail->Username   = $MAIL_USER_NAME;		// username

$mail->Password   = $MAIL_PASS;				// password



$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);



$mail->Subject    = "Thank you for Initiating Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR;

$mail->MsgHTML($mail_body);



/*foreach($recipients as $emailid) {

		 $mail->AddAddress($emailid);

		 if(!$mail->Send()) {//echo '#'.$emailid;

		 }

		 $mail->clearAddresses();

		 }*/

$Subject = " ";

//print_r($res);

if($res['pay_status']== "Paid"){

    $Subject    = "Thank you for making payment for Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR;

} else{

    $Subject    = "Thank you for Initiating Startup registration on " . $EVENT_NAME . " " . $EVENT_YEAR;

}



//$recipients[] = 'test.interlinks@gmail.com';

$recipients = array('test.interlinks@gmail.com', $EVENT_ENQUIRY_EMAIL, 'ambika.kiran@mmactiv.com', 'chandrachood.as@mmactiv.com', $res['cp_email']);

elastic_mail($Subject, $mail_body, $recipients);

//echo $mail_body;exit;

//exit;



// $sq = "UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " SET mail_sent = '1' WHERE tin_no = '$tin_no'";

$sq = "UPDATE $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL SET mail_sent = 1, approval_status = 'Approved', approved_by = '$Admin' WHERE tin_no = '$tin_no'";

$result = mysqli_query($link,$sq);



// Check whether the above query is executed or not









echo "<br><strong>Email Sent to:</strong> " . $res['cp_email'] . " <br/> <strong>CC to:</strong> chandrachood.as@mmactiv.com & ambika.kiran@mmactiv.com ";

echo "<br/> <strong>Note:</strong> Advice to check in SPAM / JUNK Folder<br/>";

exit;


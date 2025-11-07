<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require "class.phpmailer.php";
	exit;
	
	//$sql = "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL ." int_reg, " . $EVENT_DB_FORM_REG . " reg WHERE int_reg.tin_no=reg.tin_no AND int_reg.inx_reg_date>='2018-11-22'";

	//$sql = "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL ." WHERE tin_no LIKE 'EXHC%' AND inx_reg_date>='2018-11-22';";

	//$sql = "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL ." WHERE tin_no ='TIN-It2018-EXHC-304957965'";

	$sql = "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL ." int_reg, " . $EVENT_DB_FORM_REG . " reg WHERE int_reg.tin_no=reg.tin_no";
	//echo $sql;exit;
	$qr_gt_user_inx_login_data_id = mysqli_query($link,$sql) or (die(mysqli_error($link)));
	
	//echo $sql;
	//echo mysqli_num_rows($qr_gt_user_inx_login_data_id);
	//exit;
    while ($qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qr_gt_user_inx_login_data_id)) {
		include "reg_inx_emailer.php";
		//include "emailer_bio_interlinx_use.php";
		//print_r($qr_gt_user_inx_login_data_ans);echo '<hr>';
		
		$temp_p_email   = $EVENT_ENQUIRY_EMAIL;
		$temp_p_name    = $EVENT_NAME . " InterlinX";
		$str_career_intx = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX!";
		//$str_career     = "Registration confirmation for " . $qr_gt_user_inx_login_data_ans['title'] . " " . $qr_gt_user_inx_login_data_ans['fname'] . " ". $qr_gt_user_inx_login_data_ans['lname'] . " ".$EVENT_NAME. " " . $EVENT_YEAR . " Event powered by InterlinX";
		$str_career_bdy_intx = $mail_interlinx_str;
		//$str_career_bdy = $mail_body;
		//echo $str_career_bdy_intx."<br />";exit;
	   // echo $str_career_bdy."<br />";
		//$recipients = array('', $qr_gt_user_inx_login_data_ans['pri_email'],'', 'test.interlinks@gmail.com', '', 'interlinx@outlook.com');
		$recipients = array('', $qr_gt_user_inx_login_data_ans['pri_email']);
		//$recipients = array('test.interlinks@gmail.com');
								
		/*$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		//$mail->Host     = "localhost"; // SMTP server
		$mail->FromName = $temp_p_name;
		$mail->From     = $temp_p_email;
		$mail->Subject  = $str_career_intx;
		$mail->IsHTML(true);
		$mail->Body = $str_career_bdy_intx;*/

		$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		//$mail->Host       = "72.9.105.77"; // SMTP server
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		/*$mail->Host       = "72.9.105.77";      // sets  as the SMTP server
		$mail->Port       = 587;                   // set the SMTP port for the server
		$mail->Username   = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
		$mail->Password   = "dcpl5555";            // password	*/
		$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
		$mail->Port       = 25;                   // set the SMTP port for the server
		$mail->Username   = "enquiry-bengalurutechsummit";  // username
		$mail->Password   = "Enq@ui2ry@be";            // password	
		$mail->SetFrom($temp_p_email, $temp_p_name);
		//$mail->FromName = $temp_p_name;
		//$mail->From     = $temp_p_email;
		$mail->Subject    = $str_career_intx ;		
		$mail->MsgHTML($str_career_bdy_intx);
		foreach ($recipients as $emailid) {
			$mail->AddAddress($emailid);
			if (!$mail->Send()) {
				echo '<br /><br />#####' . $emailid . $mail->ErrorInfo;
			} else {echo '<br /><br />' . $emailid;}
			$mail->clearAddresses();
		}            
		/*echo "<br />".$qr_gt_user_inx_login_data_ans['pri_email'];
		echo $mail_interlinx_str;
		exit;*/
		//exit;
	}
?>
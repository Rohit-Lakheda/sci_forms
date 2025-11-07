<?php
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require "class.phpmailer.php";
	
	
	exit;


	//echo "SELECT * FROM " . $EVENT_DB_FORM_REG." WHERE `org_reg_type` = 'Premium Delegate' AND `pay_status` = 'Paid' AND sector !='Biotechnology'";exit;

	$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG." WHERE `org_reg_type` = 'Premium Delegate' AND `pay_status` = 'Paid' AND sector !='Biotechnology'");
	$qr2 = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG." where `cata2` = 'Premium Delegate' AND sector !='Biotechnology'");

	/*$sql = "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE org='CodeChef'";
	$qr_reg = mysqli_query($link,$sql) or (die(mysqli_error($link)));*/
	
	$str_career_intx = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";

	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
	$mail->Host       = "interlinksin.mailserverone.com";      // sets  as the SMTP server
	$mail->Port       = 587;                   // set the SMTP port for the server
	$mail->Username   = "noreply-interlinks";  // username
	$mail->Password   = "NrP#5@lt6ks";            // password	
	$mail->SetFrom("noreply@interlinks.in", $EVENT_NAME . ' ' . $EVENT_YEAR . ' InterlinX');
	$mail->Subject    = $str_career_intx ;		
	
	$sql = "SELECT * FROM it_2020_interlinx_reg_table";
	$qr_gt_user_data_id      = mysqli_query($link,$sql);
	while ($qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id)) {//print_r($qr_gt_user_data_ans_row);
		//for ($i = 1; $i <= $qr_gt_user_data_ans_row['sub_delegates']; $i++) {
	        //$test_delegate_email = $qr_gt_user_data_ans_row['email' . $i];
			$test_delegate_email = $qr_gt_user_data_ans_row['pri_email'];
			
			//echo "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'";
			$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'");
			
			if(mysqli_num_rows($qry_email_chk)) {
				$qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qry_email_chk);

				include "reg_inx_emailer.php";
				echo $mail_interlinx_str;//exit;
				//include "emailer_bio_interlinx_use.php";
				//print_r($qr_gt_user_inx_login_data_ans);echo '<hr>';
				
				$str_career_intx = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";
				$str_career_bdy_intx = $mail_interlinx_str;
				$recipients = array('', $qr_gt_user_inx_login_data_ans['pri_email'],'', 'test.interlinks@gmail.com');
				//$recipients = array('test.interlinks@gmail.com');
				
				$mail->MsgHTML($str_career_bdy_intx);

				//$recipients = array($qr_gt_user_inx_login_data_ans['pri_email']);
				foreach($recipients as $emailid) {
					 $mail->AddAddress($emailid);
					 if(!$mail->Send()) {
						 echo '<br /><br />#####' . $emailid . '<br/>'. $mail->ErrorInfo;
					 } else {
						 //echo '<br /><br />##' . $emailid;
					 }
					 $mail->clearAddresses();
				 }
			}
			//exit;
		//}
	}
	exit;

	//-------------------for second query -------------
	while ($qr_gt_user_data_ans_row2 = mysqli_fetch_array($qr2)) {
		for ($i = 2; $i <= 2; $i++) {
	        $test_delegate_email = $qr_gt_user_data_ans_row2['email' . $i];
			
			$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'");
			$qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qry_email_chk);

			include "reg_inx_emailer.php";
			//include "emailer_bio_interlinx_use.php";
			//print_r($qr_gt_user_inx_login_data_ans);echo '<hr>';
			
			$str_career_intx = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";
			$str_career_bdy_intx = $mail_interlinx_str;
			$recipients = array('', $qr_gt_user_inx_login_data_ans['pri_email'],'', 'test.interlinks@gmail.com', '', 'interlinx@outlook.com');
			//$recipients = array('', 'mayuriladi39@gmail.com', 'mayuri.ladi@interlinks.in');
			
			$mail->MsgHTML($str_career_bdy_intx);

			//$recipients = array($qr_gt_user_inx_login_data_ans['pri_email']);
			foreach($recipients as $emailid) {
				 $mail->AddAddress($emailid);
				 if(!$mail->Send()) {
					 echo '<br /><br />#####' . $mail->ErrorInfo;
				 } else {echo '<br /><br />' . $emailid;}
				 $mail->clearAddresses();
			 }
			 //exit;
		}
	}
	exit;
?>
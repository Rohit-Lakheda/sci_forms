<?php
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require "class.phpmailer.php";
	
	
	exit;

/*$arr_list = array('ytchiang@most.gov.tw',);
*/
	
		
		//foreach ($arr_list as $arr) {
			/*print_r($arr);
			echo "<br/>";*/
			//$test_delegate_email = $arr;
			//$qry_email_chk       = mysqli_query($link,"SELECT * FROM it_2023_reg_tbl  i WHERE tin_no NOT IN(SELECT DISTINCT(tin_no) FROM it_2023_interlinx_reg_table) AND pay_status='Paid'");
			//$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE delegate_flag != 2 OR ISNULL(delegate_flag) LIMIT 700, 100");

			//$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE tin_no IN ('TIN-BTS2023-31587727')");
			$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " LIMIT 2000, 300" );
			
			while($qr_gt_user_inx_login_data_ans   = mysqli_fetch_array($qry_email_chk)) {
				//$qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qry_email_chk);

				include "interlinx_mail-2023.php";
				//echo $mail_interlinx_str;//exit;
				echo $qr_gt_user_inx_login_data_ans['pri_email'] . '<br/>';
				//include "emailer_bio_interlinx_use.php";
				//print_r($qr_gt_user_inx_login_data_ans);echo '<hr>';
					
				$str_career_intx = 'Update your Profile and Book a slot for B2B lounge (Bengaluru Tech Summit 2023 - InterlinX B2B Partnering)';//"Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";
				$str_career_bdy_intx = $mail_interlinx_str;
				//$recipients = array($arr);
				//$recipients = array('sagarpatil2112@gmail.com', 'vivek.patil@mmactiv.com');
				$recipients = array($qr_gt_user_inx_login_data_ans['pri_email'], 'test.interlinks@gmail.com');

				//$mail->MsgHTML($str_career_bdy_intx);
				elastic_mail($str_career_intx, $str_career_bdy_intx, $recipients);
//exit;
				//$recipients = array($qr_gt_user_inx_login_data_ans['pri_email']);
				/*foreach($recipients as $emailid) {
					$mail->AddAddress($emailid);
					if(!$mail->Send()) {
						echo '<br />' . $emailid . '<br/>';
					} else {
						//echo '<br /><br />##' . $emailid;
					}
					$mail->clearAddresses();
				}*///exit;
			}
			//exit;
		//}
	
?>
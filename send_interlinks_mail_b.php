<?php
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require "class.phpmailer.php";
	
	//$sql = "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL ." int_reg, " . $EVENT_DB_FORM_REG . " reg WHERE int_reg.tin_no=reg.tin_no";

	$sql = "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL ." WHERE tin_no LIKE 'TIN-BIB%' AND inx_reg_date='2017-11-09';";
	
	$qr_gt_user_inx_login_data_id = mysqli_query($link,$sql) or (die(mysqli_error($link)));
	
	//echo $sql;
	//echo mysqli_num_rows($qr_gt_user_inx_login_data_id);
	//exit;
    while ($qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qr_gt_user_inx_login_data_id)) {
            include "reg_inx_emailer.php";
			include "emailer_bio_interlinx_use.php";
            //print_r($qr_gt_user_inx_login_data_ans);echo '<hr>';
            
			$temp_p_email   = $EVENT_ENQUIRY_EMAIL;
            $temp_p_name    = $EVENT_NAME . " InterlinX";
            $str_career_intx     = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";
			$str_career     = "Registration confirmation for " . $qr_gt_user_inx_login_data_ans['title'] . " " . $qr_gt_user_inx_login_data_ans['fname'] . " ". $qr_gt_user_inx_login_data_ans['lname'] . " ".$EVENT_NAME. " " . $EVENT_YEAR . " Event powered by InterlinX";
            $str_career_bdy_intx = $mail_interlinx_str;
			$str_career_bdy = $mail_body;
			//echo $str_career_bdy_intx."<br />";
           // echo $str_career_bdy."<br />";
		   
            $recipients = array('', $qr_gt_user_inx_login_data_ans['pri_email'],'', 'test.interlinks@gmail.com', '', 'interlinx@outlook.com');
			//$recipients = array('', 'test.interlinks@gmail.com');
            
            
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = "72.9.105.77"; // SMTP server
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "72.9.105.77";      // sets  as the SMTP server
			$mail->Port       = 587;                   // set the SMTP port for the server
			$mail->Username   = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
			$mail->Password   = "dcpl5555";            // password			
			$mail->SetFrom($temp_p_email, $temp_p_name);
			$mail->Subject    = $str_career ;		
			$mail->MsgHTML($str_career_bdy);

	        //echo $str_career_bdy;exit;
			foreach($recipients as $emailid) {
				 $mail->AddAddress($emailid);
				 if(!$mail->Send()) {
				 }
				 $mail->clearAddresses();
			 }
			
			
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = "72.9.105.77"; // SMTP server
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "72.9.105.77";      // sets  as the SMTP server
			$mail->Port       = 587;                   // set the SMTP port for the server
			$mail->Username   = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
			$mail->Password   = "dcpl5555";            // password			
			$mail->SetFrom($temp_p_email, $temp_p_name);
			$mail->Subject    = $str_career_intx ;		
			$mail->MsgHTML($str_career_bdy_intx);

	        //echo $str_career_bdy;exit;
			foreach($recipients as $emailid) {
				 $mail->AddAddress($emailid);
				 if(!$mail->Send()) {
				 }
				 $mail->clearAddresses();
			 }
			
			/*$mail = new PHPMailer();
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->Host     = "localhost"; // SMTP server
            $mail->FromName = $temp_p_name;
            $mail->From     = $temp_p_email;
            $mail->Subject  = $str_career;
            $mail->IsHTML(true);
            $mail->Body = $str_career_bdy;
            foreach ($recipients as $emailid) {
                $mail->AddAddress($emailid);
                if (!$mail->Send()) {
                    echo '<br /><br />#####' . $emailid;
                } else {echo '<br /><br />' . $emailid;}
                $mail->clearAddresses();
            }
			
			
			$mail = new PHPMailer();
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->Host     = "localhost"; // SMTP server
            $mail->FromName = $temp_p_name;
            $mail->From     = $temp_p_email;
            $mail->Subject  = $str_career_intx;
            $mail->IsHTML(true);
            $mail->Body = $str_career_bdy_intx;
            foreach ($recipients as $emailid) {
                $mail->AddAddress($emailid);
                if (!$mail->Send()) {
                    echo '<br /><br />#####' . $emailid;
                } else {echo '<br /><br />' . $emailid;}
                $mail->clearAddresses();
            }*/
			/**/
            //echo '####' . $qr_gt_user_inx_login_data_ans['sub_delegates'] . '<br />';
           /*  for($index = 1; $index <= $qr_gt_user_inx_login_data_ans['sub_delegates']; $index++) {
            	$sql = "UPDATE $EVENT_DB_FORM_REG SET tin_no" . $index . " = '" . $qr_gt_user_inx_login_data_ans['tin_no'] . $index . "' WHERE tin_no = '" . $qr_gt_user_inx_login_data_ans['tin_no'] . "'";
            	//echo $sql . '<br />';
            	
            	mysqli_query($link,$sql) or(die(mysqli_error($link)));
            	
            } */
            
            /*echo "<br />".$qr_gt_user_inx_login_data_ans['pri_email'];
            echo $mail_interlinx_str;
            exit;*/
			//exit;
	}
?>
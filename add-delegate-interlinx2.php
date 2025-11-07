<?php

	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require "class.phpmailer.php";

	 exit;


//$delegate_list = array(array('P. Pratham','','tester','p.pratham@bcg.com','91','7795938800','Boston Consulting Group',''));
//$delegate_list = array(array('Vivek','Patil','Manager','vivek@interlinks.in','91','9878786756','MMActiv',''));
//$qwe = mysqli_query($link,"SELECT * FROM it_2024_offline_data_sagar where is_success!='1'");
$qwe = mysqli_query($link,"SELECT * FROM it_2024_offline_comp_data_sagar where is_success='1'");
	//$row = mysqli_num_rows($qry);
while($del = mysqli_fetch_assoc($qwe)) {
	$dele_title      = "";
	$dele_fname      = $del['Name'];
	$dele_lname      = null;//$del[1];
	$dele_desig      = $del['Designation'];
	$dele_email      = strtolower($del['Email']);
	$dele_cntry_code = $del['Country_Code'];
	$dele_mob		 = $del['Phone'];
	$org 			 = $del['Organization'];
	$country 		 = null;//$del[7];//explode(",", $org);
	/*$country = trim($contry[1]);
	$org = trim($contry[0]);*/
	$state = $city = '';
	//$dele_cellno_arr = explode("-", $dele_cellno);
	
	$test_title = $dele_title;
	$test_fname = $dele_fname;
	$test_lname = $dele_lname;
	$test_email = $dele_email;

	$fname = explode(" ", $test_fname);
	$fname1 = $fname[0];
	$fone = $fax ='';

	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = substr(str_shuffle($characters), 0, 4);
	$pas1_inx = str_replace(' ', '_', $fname1) . $randomString;
	//$pas1_inx    = str_replace(' ', '_', $qr_gt_user_data_ans_row['fname' . $i]) . rand(1, 9999999);
	$pas2_inx = password_hash($pas1_inx, PASSWORD_BCRYPT);
	$user_id_md5 = md5($usr_no1);


	//$pas1_inx    = str_replace(' ', '_', $fname1) . "123";
	//$pas2_inx    = md5($pas1_inx);
	//$user_id_md5 = md5($usr_no1);
	
	$temp_qr_gt_user_data_ans_row_fone_arr = explode("-", $fone);
	$temp_qr_gt_user_data_ans_row_fax_arr  = explode("-", $fax);
	$inx_reg_date = date('Y-m-d');
	$inx_reg_time = date('H:i:s');
	

	//Call save Operator API
	$data = array();
	$data['api_key'] = 'scan626246ff10216s477754768osk';
	$data['event_id'] = 117859;	

	$data['name'] = $dele_fname;// . ' ' . $dele_lname;
	$data['email'] = $dele_email;
	$data['country_code'] = $dele_cntry_code;
	$data['mobile'] = $dele_mob;
	$data['company'] = $org;
	$data['designation'] = $dele_desig;
	$data['category_id']= 1881; //Complimentary delegate
	//$data['category_id']= 1879; //Paid delegate
	$data['qsn_366'] = 'Delegate';
	$data['country'] = "";//$res['country'];
	$data['city'] = "";//$res['city'];



	//sendchkdinapi($data);
	print_r(($data));
	echo '<br/>';
	print_r(sendchkdinapi($data));
	echo '<br/>================================================<br/>'; 
	//exit;
	//mysqli_query($link,"update it_2024_offline_data_sagar set is_success ='1' where email='$dele_email'");
	mysqli_query($link,"update it_2024_offline_comp_data_sagar set is_success ='1' where email='$dele_email'");


	/*$str_career_intx = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";

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
	
	
	$test_delegate_email =  $del[2];
			
	//echo "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'";
	$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'");
	$qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qry_email_chk);

	include "reg_inx_emailer.php";
	//echo '#'.$mail_interlinx_str;//exit;
	//include "emailer_bio_interlinx_use.php";
	//print_r($qr_gt_user_inx_login_data_ans);echo '<hr>';
			
	$str_career_intx = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";
	$str_career_bdy_intx = $mail_interlinx_str;
	//$recipients = array('', $qr_gt_user_inx_login_data_ans['pri_email'],'', 'test.interlinks@gmail.com', '', 'interlinx@outlook.com');
	$recipients = array('test.interlinks@gmail.com');
			
	$mail->MsgHTML($str_career_bdy_intx);

		//$recipients = array($qr_gt_user_inx_login_data_ans['pri_email']);
	foreach($recipients as $emailid) {
		$mail->AddAddress($emailid);
		if(!$mail->Send()) {
			echo '<br /><br />#####' . $mail->ErrorInfo;
		} else {echo '<br /><br />' . $emailid;}
			$mail->clearAddresses();
		}*/
	
	}
?>
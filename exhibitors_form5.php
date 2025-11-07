<?php
	session_start ();
	$assoc_nm = @$_REQUEST ['assoc_nm'];
	if (($_SESSION ["vercode_ex"] == '')) {
		session_destroy ();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		if(!empty($assoc_nm)) {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?assoc_nm=" . $assoc_nm . "');</script>";
		} else {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php');</script>";
		}
		exit ();
	}
	require "includes/form_constants_both.php";
	require "dbcon_open.php";
	
	$temp_reg_id = @$_SESSION ['vercode_ex'];
	
	$qr_chk_exb_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO WHERE (reg_id='$temp_reg_id') " );
	$qr_chk_exb_num_rows = mysqli_num_rows ( $qr_chk_exb_id );
	$qr_chk_exb_ans_1 = $qr_chk_exb_ans = mysqli_fetch_assoc ( $qr_chk_exb_id );
	
	if (($qr_chk_exb_num_rows <= 0) || ($qr_chk_exb_num_rows == "")) {
		session_destroy ();
		echo "<script language='javascript'>alert('Please Enter Complete exhibitors Details.');</script>";
		if(!empty($assoc_nm)) {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?assoc_nm=" . $assoc_nm . "');</script>";
		} else {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php');</script>";
		}
		exit ();
	}
	
	$exhi_user_data = array();
	if(!empty($qr_chk_exb_ans)) {
		/*$qr_gt_user_data_id1      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS . " WHERE reg_id = '$temp_reg_id'");
		$qr_gt_user_data_ans_row1 = mysqli_fetch_assoc($qr_gt_user_data_id1);
		if(!empty($qr_gt_user_data_ans_row1)) {
			echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
			echo "<script language='javascript'>window.location = 'registration.php';</script>";
			exit;
		}*/

		$fields = $values = '';
		foreach ($qr_chk_exb_ans as $key=>$value) {
			if($key != 'srno') {
				$fields .= $key . ',';
				if($key == 'profile') {
					$values .= "'" . mysqli_real_escape_string($link,$value) . "',";
				} else {
					$values .= "'" . $value . "',";
				}
			}
		}
		$values = trim($values, ',');
		$fields = trim($fields, ',');
		//echo "insert  into " . $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS . "($fields) VALUES($values)";
		mysqli_query($link,"insert  into " . $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS . "($fields) VALUES($values)") or die(mysqli_error($link));
		
		$sql = "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_DEMO WHERE exhibitor_id='" . $qr_chk_exb_ans['exhibitor_id'] . "'";
		$user_data = mysqli_query($link,$sql);
		
		if(mysqli_num_rows($user_data) > 0) {
			while ($row = mysqli_fetch_assoc($user_data)) {
				$exhi_user_data[] = $row;
				$fields = $values = '';
				foreach ($row as $key=>$value) {
					if($key != 'srno') {
						$fields .= $key . ',';
						$values .= "'" . $value . "',";
					}
				}
				$values = trim($values, ',');
				$fields = trim($fields, ',');
					
				mysqli_query($link,"insert  into " . $EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS . "($fields) VALUES($values)");

				$category=$qr_chk_exb_ans ['category'];
	
				/*$ticket_id = 31429;
				$ticket_type = 'Exhibitor';
				if($category == 'Sponsor') {
					$ticket_id = 31428;
					$ticket_type = 'Sponsor';
				}
				$data=array();
				$data['name']=$row['title'].' '.$row['fname'].' '.$row['mname'].' '.$row['lname'] ;
				$data['email']= $row['email'];
				$data['country_code']='91' ;
				$data['phone']= $row['mob'];
				$data['booking_id']= $row['exhibitor_id'];
				
				callUniversalAPI($data, $ticket_id, $ticket_type);*/
			}
		}
	}
	
	$qr_chk_exb_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS WHERE (reg_id='$temp_reg_id') " );
	$qr_chk_exb_ans = mysqli_fetch_assoc ( $qr_chk_exb_id );
	
	$exhibitor_id_ex = $qr_chk_exb_ans ['exhibitor_id'];
	$booth_space = $qr_chk_exb_ans ['booth_space'];
	$temp_booth_no = $qr_chk_exb_ans ['booth_no'];
	$temp_booth_area = $qr_chk_exb_ans ['booth_area'];
	$temp_booth_area_unit = $qr_chk_exb_ans ['booth_area_unit'];
	$temp_fascia_name = $qr_chk_exb_ans ['fascia_name'];
	$temp_fascia_name_up = strtoupper ( $temp_fascia_name );
	$assoc_nm = $qr_chk_exb_ans['assoc_nm'];
	$temp_exhi_sector = $qr_chk_exb_ans ['sector'];
	$en = '';
	$eventName = 'BengaluruITE.BIZ';
	$event_name = 'Bangalore IT';
	if($temp_exhi_sector == 'Bio Technology') {
		$en = '1';
		$eventName = 'Bengaluru INDIA BIO';
		$event_name = 'Bangalore INDIA BIO';
		//$EVENT_WEBSITE_LINK = 'http://www.bengaluruindiabio.in/';
	}
	$temp_exhi_name = $qr_chk_exb_ans ['exhibitor_name'];
	$temp_exhi_name_up = strtoupper ( $temp_exhi_name );
	$temp_exhi_name_upwc = ucwords ( $temp_exhi_name );
	$temp_cp_title = $qr_chk_exb_ans ['cp_title'];
	$temp_cp_fname = $qr_chk_exb_ans ['cp_fname'];
	$temp_cp_mname = $qr_chk_exb_ans ['cp_mname'];
	$temp_cp_lname = $qr_chk_exb_ans ['cp_lname'];
	$temp_desig = $qr_chk_exb_ans ['cp_desig'];
	$temp_addr1 = $qr_chk_exb_ans ['address_line_1'];
	$temp_addr2 = $qr_chk_exb_ans ['address_line_2'];
	$temp_city = $qr_chk_exb_ans ['city'];
	$temp_state = $qr_chk_exb_ans ['state'];
	$temp_country = $qr_chk_exb_ans ['country'];
	$temp_zip = $qr_chk_exb_ans ['zip'];
	$temp_fon_cntry = $qr_chk_exb_ans ['cntry_code_phone'];
	// $temp_fon_area = $qr_chk_exb_ans['area_code_phone'];
	$temp_fon = $qr_chk_exb_ans ['phone'];
	$temp_mob_cntry = $qr_chk_exb_ans ['cntry_code_mob'];
	$temp_mob = $qr_chk_exb_ans ['mob'];
	$temp_fax_cntry = $qr_chk_exb_ans ['cntry_code_fax'];
	// $temp_fax_area = $qr_chk_exb_ans['area_code_fax'];
	$temp_fax = $qr_chk_exb_ans ['fax'];
	$temp_email = $qr_chk_exb_ans ['email'];
	$temp_website = $qr_chk_exb_ans ['website'];
	$temp_reg_date = $qr_chk_exb_ans ['reg_date'];
	$temp_reg_time = $qr_chk_exb_ans ['reg_time'];
	$temp_reg_id = $qr_chk_exb_ans ['reg_id'];
	$temp_profile = $qr_chk_exb_ans ['profile'];
	$temp_order_no = $qr_chk_exb_ans ['order_no'];
	$exhi_profile = $qr_chk_exb_ans ['exhi_profile'];
	
	$category=$qr_chk_exb_ans ['category'];
	
	/* ---------------------------------------------user---------------------------------------------------------------- */
	require "class.phpmailer.php";
	require "exbi_emailer_user.php";
	
	$recipients = array ('', 'test.interlinks@gmail.com', '', $temp_email);
	//$recipients = array ('', 'test.interlinks@gmail.com', '', 'sagar.patil@interlinks.in' );

	$temp_p_email = $EVENT_ENQUIRY_EMAIL;
	$temp_p_name = $EVENT_NAME . " " . $EVENT_YEAR;
	$str_career = "Thanks for sending exhibitor directory details on " . $EVENT_NAME . " " . $EVENT_YEAR;
	$str_career_bdy = $str_exb;
			
	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
												// 1 = errors and messages
												// 2 = messages only
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
	$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the server
	$mail->Username   = "enquiry-bengalurutechsummit";  // username
	$mail->Password   = "Enq@ui2ry@be";				// password
			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
	$mail->Subject    = $str_career ;		
	$mail->MsgHTML($str_career_bdy);

	/*$mail = new PHPMailer ();
	$mail->IsSMTP (); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $EVENT_NAME . " " . $EVENT_YEAR;
	$mail->From = $EVENT_ENQUIRY_EMAIL;
	$mail->Subject = $str_career;
	$mail->IsHTML ( true );
	$mail->Body = $str_career_bdy;*/
	foreach ( $recipients as $emailid ) {
		 $mail->AddAddress ( $emailid );
		 if (! $mail->Send ()) {
		 } // else echo '###';
		 $mail->clearAddresses ();
	 }
	
	/* ---------------------------------------------admin---------------------------------------------------------------- */
	require "exbi_emailer_admin.php";
	
	$recipients = array ('', 'test.interlinks@gmail.com', '', 'ambika.kiran@mmactiv.com');
	//$recipients = array ('', 'test.interlinks@gmail.com', '', 'sagar.patil@interlinks.in' );
	
	$temp_p_email = $EVENT_ENQUIRY_EMAIL;
	$temp_p_name = $EVENT_NAME . " " . $EVENT_YEAR;
	$str_career = "New exhibitor directory details on " . $EVENT_NAME . " " . $EVENT_YEAR . " - " . $temp_fascia_name;
	$str_career_bdy = $str_exb_admin;
	
	$MAIL_HOST       = "72.9.105.77";      // sets  as the SMTP server
	$MAIL_PORT       = 587;                   // set the SMTP port for the server
	$MAIL_USER_NAME  = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
	$MAIL_PASS		 = "dcpl5555";            // password
		
	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
												// 1 = errors and messages
												// 2 = messages only
	$mail->SMTPAuth   = true;					// enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                // sets the prefix to the servier
	$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the server
	$mail->Username   = "enquiry-bengalurutechsummit";  // username
	$mail->Password   = "Enq@ui2ry@be";				// password
			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
	$mail->Subject    = $str_career ;		
	$mail->MsgHTML($str_career_bdy);

	/*$mail = new PHPMailer ();
	$mail->IsSMTP (); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $EVENT_NAME . " " . $EVENT_YEAR;
	$mail->From = $EVENT_ENQUIRY_EMAIL;
	$mail->Subject = $str_career;
	$mail->IsHTML ( true );
	$mail->Body = $str_career_bdy;*/

	foreach ( $recipients as $emailid ) {
		 $mail->AddAddress ( $emailid );
		 if (! $mail->Send ()) {  
			 //echo '###' . $emailid;
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
		 }//  else echo '@@@@';
		 $mail->clearAddresses ();
	 }
	
	/*echo $str_exb . "<br />";
	 echo $str_exb_admin . "<br />";
	 exit ();*/
	  	
	
	//##################################################################################################################################
	//================================ Save Delegate data ==================================================================
	//##################################################################################################################################
	$reg_id = $qr_chk_exb_ans_1['srno'] . $_SESSION ['vercode_ex'];
	$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
	$res = $qr_gt_user_data_ans_row;
	$temp_receiver_org       = $qr_gt_user_data_ans_row['org'];
	
	//print_r($qr_gt_user_data_ans_row);
	if(!empty($qr_gt_user_data_ans_row)) {
		$fields = '';
		$values = '';
		foreach ($qr_gt_user_data_ans_row as $key=>$value) {
			if($key != 'srno') {
				$fields .= $key . ',';
					
				$values .= "'" . $value . "',";
			}
		}
		$values = trim($values, ',');
		$fields = trim($fields, ',');
			
		mysqli_query($link,"insert  into " . $EVENT_DB_FORM_REG . "($fields) VALUES($values)");
	}
	
	for ($i = 1; $i <= $qr_gt_user_data_ans_row['sub_delegates']; $i++) {
	$test_delegate_email = $qr_gt_user_data_ans_row['email' . $i];
	if(!empty($test_delegate_email)) {
		$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'");
		$qry_email_chk_num   = mysqli_num_rows($qry_email_chk);
			
		if ($qry_email_chk_num >= 1) {
			 
		} else {
			//-------------------------------------------------- Generating User Id ------------------------------------------------
			$usr_no = $EVENT_TBL_PREFIX . '_' . $EVENT_YEAR . "_nrm_";
			$i_gim_inx_user_id_cnt = 0;
			do {
				$temp_no     = rand(1, 9999999);
				$temp_no_len = strlen($temp_no);
				 
				if ($temp_no_len < 7) {
					$temp_no_len = 7 - $temp_no_len;
					while ($temp_no_len) {
						$temp_no = $temp_no . "0";
						$temp_no_len--;
					}
				}
				$usr_no1 = $usr_no . $temp_no;
				$qry     = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE user_id = '$usr_no1'");
				$res_no  = mysqli_num_rows($qry);
				if ($res_no < 1) {
					$i_gim_inx_user_id_cnt++;
				} else {
					$usr_no1 = "";
				}
			} while (!($i_gim_inx_user_id_cnt == 1));
			//-------------------------------------------------End Generating User Id ------------------------------------------------
			 
			$dele_title      = $qr_gt_user_data_ans_row['title' . $i];
			$dele_fname      = $qr_gt_user_data_ans_row['fname' . $i];
			$dele_lname      = $qr_gt_user_data_ans_row['lname' . $i];
			$dele_email      = $qr_gt_user_data_ans_row['email' . $i];
			$dele_cellno     = $qr_gt_user_data_ans_row['cellno' . $i];
			$dele_cellno_arr = explode("-", $dele_cellno);
			 
			$test_title = $qr_gt_user_data_ans_row['title' . $i];
			$test_fname = $qr_gt_user_data_ans_row['fname' . $i];
			$test_lname = $qr_gt_user_data_ans_row['lname' . $i];
			$test_email = $qr_gt_user_data_ans_row['email' . $i];
			 
			 
			$pas1_inx    = str_replace(' ', '_', $qr_gt_user_data_ans_row['fname' . $i]) . "123";
			$pas2_inx    = md5($pas1_inx);
			$user_id_md5 = md5($usr_no1);
			 
			$temp_qr_gt_user_data_ans_row_fone_arr = explode("-", $qr_gt_user_data_ans_row['fone']);
			$temp_qr_gt_user_data_ans_row_fax_arr  = explode("-", $qr_gt_user_data_ans_row['fax']);
			 
			//------------------------------------------------- Inserting Values in interlinx registration table --------------------------------------
			/*echo "INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
			 (user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,org_info,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,				fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,reg_id,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no) values
			 ('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','','$dele_email','','$qr_gt_user_data_ans_row[org]','','','$dele_cellno_arr[0]','$dele_cellno_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row[reg_id]','$qr_gt_user_data_ans_row[reg_id]','uploads/default_file.jpg','$qr_gt_user_data_ans_row[org_profile]','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[tin_no]');";*/
			mysqli_query($link,"INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
					(user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,org_info,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,				fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,reg_id,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no) values
					('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','','$dele_email','','$qr_gt_user_data_ans_row[org]','','','$dele_cellno_arr[0]','$dele_cellno_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row[reg_id]','$qr_gt_user_data_ans_row[reg_id]','uploads/default_file.jpg','$qr_gt_user_data_ans_row[org_profile]','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[tin_no]')") or die(mysqli_error($link));
			 
			$year = $EVENT_YEAR;
	            $month = 11;
				$date = 19;
				mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values				
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

				$date = 20;
				mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
				
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
				$date = 21;
				mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
				
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
				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),*/
	            //------------------------------------------------- end Inserting Values in interlinx registration table --------------------------------------
					
		}
		//exit;

		$dele_title      = $res['title' . $i];
		$dele_fname      = $res['fname' . $i];
		$dele_lname      = $res['lname' . $i];
		$dele_email      = $res['email' . $i];
		$job_title       = $res['job_title' . $i];
		$dele_cellno     = $res['cellno' . $i];
		$dele_cellno_arr = explode("-", $dele_cellno);

		if(isset($dele_cellno_arr[0])) {
			$country_code = $dele_cellno_arr[0];
			if(strlen($country_code) >= 6) {
				$phone = $country_code;
				$country_code = '+91';
			}
		}
		if(isset($dele_cellno_arr[1])) {
			$phone = $dele_cellno_arr[1];
		}
		//Call save Operator API
		$data = array();
		$data['name']= $dele_title . ' ' . $dele_fname . ' ' . $dele_lname;
		$data['email']= $dele_email;
		$data['country_code']= $country_code;
		$data['phone']= $phone;
		$data['company']= $res['org'];
		$data['designation']= $job_title;
		$data['booking_id']= $res['tin_no'];
		//$data['additional_data_1']= $res['assoc_name'];
		//$data['additional_data_2']= $res['city'];
		//$data['additional_data_3']= $res['state'];
		//Call API
		callUniversalAPI($data, 31036, 'Delegate');

		$sql = "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS WHERE exhibitor_id='" . $qr_chk_exb_ans['exhibitor_id'] . "'";
		$user_data = mysqli_query($link,$sql);
		
		if(mysqli_num_rows($user_data) > 0) {
			while ($row = mysqli_fetch_assoc($user_data)) {
				/*$exhi_user_data[] = $row;
				$fields = $values = '';
				foreach ($row as $key=>$value) {
					if($key != 'srno') {
						$fields .= $key . ',';
						$values .= "'" . $value . "',";
					}
				}
				$values = trim($values, ',');
				$fields = trim($fields, ',');
					
				mysqli_query($link,"insert  into " . $EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS . "($fields) VALUES($values)");*/

				$category=$qr_chk_exb_ans ['category'];
	
				$ticket_id = 31429;
				$ticket_type = 'Exhibitor';
				if($category == 'Sponsor') {
					$ticket_id = 31428;
					$ticket_type = 'Sponsor';
				}
				$data=array();
				$data['name']=$row['title'].' '.$row['fname'].' '.$row['mname'].' '.$row['lname'] ;
				$data['email']= $row['email'];
				$data['country_code']='91' ;
				$data['phone']= $row['mob'];
				$data['booking_id']= $row['exhibitor_id'];
				
				callUniversalAPI($data, $ticket_id, $ticket_type);
			}
		}
		
	}
	}
	
	

	$qr_gt_user_inx_login_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE tin_no = '$qr_gt_user_data_ans_row[tin_no]' ");
	while ($qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qr_gt_user_inx_login_data_id)) {		
		include "reg_inx_emailer.php";
		$temp_p_email   = $EVENT_ENQUIRY_EMAIL;
		$temp_p_name    = $EVENT_NAME . " InterlinX";
		$str_career     = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";
		$str_career_bdy = $mail_interlinx_str;
	
		$recipients = array($qr_gt_user_inx_login_data_ans['pri_email'], '', 'test.interlinks@gmail.com', '', $EVENT_ENQUIRY_EMAIL, '', 'interlinx@outlook.com', '', '');
	
		//$recipient = array('','test.interlinks@gmail.com','', 'madhuri.aswale10@gmail.com');
	
		/*$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host     = "localhost"; // SMTP server
		$mail->FromName = $temp_p_name;
		$mail->From     = $temp_p_email;
		$mail->Subject  = $str_career;
		$mail->IsHTML(true);
		$mail->Body = $str_career_bdy;*/
		
		$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "72.9.105.77"; // SMTP server
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
		$mail->Port       = 25;                   // set the SMTP port for the server
		$mail->Username   = "enquiry-bengalurutechsummit";  // username
		$mail->Password   = "Enq@ui2ry@be";            // password			
		$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
		$mail->Subject    = $str_career;		
		$mail->MsgHTML($str_career_bdy);

		//echo $str_career_bdy;exit;
		foreach($recipients as $emailid) {
		 $mail->AddAddress($emailid);
		 if(!$mail->Send()) {
		 }
		 $mail->clearAddresses();
		 }
	}
	
	
	$recipients = array();	
	
	$recipient = array('','test.interlinks@gmail.com','', $EVENT_ENQUIRY_EMAIL, '', 'bhavya.mmactiv@gmail.com', '', 'vinay.mmactiv@gmail.com', '', '','', 'mohanram@mmactiv.in', '','','','gurunath.angadi@mmactiv.com');
	if ($res['sector'] == 'Bio Technology') {
		$recipient[] = '';
		$recipient[] = 'vani.faustina@mmactiv.com';
	}

	//$recipient = array('','test.interlinks@gmail.com','', 'madhuri.aswale10@gmail.com');
	switch($qr_gt_user_data_ans_row['sub_delegates']) {
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
	$recipients = array_merge($recipients, $recipient);
	//print_r($recipients);exit;
	//$recipients = array('', 'test.interlinks@gmail.com','', 'sagar.patil@interlinks.in');
	//require 'class.phpmailer.php';
	require "emailer_reg_comp.php";
	 
	/*$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $EVENT_NAME . ' ' . $EVENT_YEAR;
	$mail->From = $EVENT_ENQUIRY_EMAIL;
	$mail->Subject = $EVENT_NAME . ' ' . $EVENT_YEAR . " Thanks for Registering ";
	$mail->IsHTML(true);
	$mail->Body = $mail_body;*/

	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "72.9.105.77"; // SMTP server
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the server
	$mail->Username   = "enquiry-bengalurutechsummit";  // username
	$mail->Password   = "Enq@ui2ry@be";            // password			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
	$mail->Subject    = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR ;		
	$mail->MsgHTML($mail_body);


	foreach($recipients as $emailid) {
	 $mail->AddAddress($emailid);
	 if(!$mail->Send()) {
	 }
	 $mail->clearAddresses();
	 }
	//echo $mail_body;exit;
	
	/*session_destroy ();
	echo "<script language='javascript'>window.location= 'registration_comp.php?exhi=E34XH3IDf6gyy77&assoc_nm=$assoc_nm&exhibitor_id=".$exhibitor_id_ex."';</script>";
	exit;*/
	
	echo "<script language='javascript'>window.location= 'exhibitors_form6.php?exhi=E34XH3IDf6gyy77&assoc_nm=$assoc_nm&exhibitor_id=" . $exhibitor_id_ex . "';</script>";
	exit;
?>
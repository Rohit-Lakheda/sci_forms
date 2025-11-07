<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require "class.phpmailer.php";
	exit;
	
	//$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL);
	//$qry_email_chk1       = mysqli_query($link,"SELECT * FROM it_2023_reg_tbl  i WHERE tin_no NOT IN(SELECT DISTINCT(tin_no) FROM it_2023_interlinx_reg_table) AND pay_status='Paid'");
	$qry_email_chk1       = mysqli_query($link,"SELECT * FROM it_2023_reg_tbl  i WHERE tin_no IN('TIN-BTS2023-31587727') AND pay_status='Paid'");
	$qry_email_chk_num1   = mysqli_num_rows($qry_email_chk1);

	while($qr_gt_user_data_ans_row   = mysqli_fetch_array($qry_email_chk1)) {
		//print_r($qr_gt_user_data_ans_row);exit;
		echo $qr_gt_user_data_ans_row['tin_no'].'<br/>';
		for ($i = 1; $i <= $qr_gt_user_data_ans_row['sub_delegates']; $i++) {
			//############################################################################
			//break;
			//############################################################################
			if (true) { //($qr_gt_user_data_ans_row['cata' . $i] == 'Premium Delegate') || ($qr_gt_user_data_ans_row['cata' . $i] == 'International Premium Delegate') ) {
				$test_delegate_email = $qr_gt_user_data_ans_row['email' . $i];
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
					$delegate_flag = 0;
					if($qr_gt_user_data_ans_row['delegate_flag'] == 'No') {
						$delegate_flag = 2;
					}
					$org = mysqli_real_escape_string($link,$qr_gt_user_data_ans_row['org']);
					//------------------------------------------------- Inserting Values in interlinx registration table --------------------------------------
					mysqli_query($link,"INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
								(user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,org_info,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,reg_id,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no,delegate_flag) values 
								('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','','$dele_email','','$org','','','$dele_cellno_arr[0]','$dele_cellno_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row[reg_id]','$qr_gt_user_data_ans_row[reg_id]','uploads/default_file.jpg','','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[tin_no]', '$delegate_flag')") or die(mysqli_error($link));

					$year = $EVENT_YEAR;
					$month = 11;
					$date = 29;
					mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values				
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));

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

					$month = 11;
					$date = 30;
					mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
						
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
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));
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
					$month = "12";
					$date = "01";
					mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
						
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),
						(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));
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

				}
			}
		}
	}
	exit;

	//############################################################################
	//==== Create slot===============
	$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG);
	// . " WHERE tin_no='TIN-BIB2018-EXHC-353679409'"
	while($qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id)) {
		
		for ($i = 1; $i <= $qr_gt_user_data_ans_row['sub_delegates']; $i++) {
	        $test_delegate_email = $qr_gt_user_data_ans_row['email'];
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
	            
	            $dele_title      = $qr_gt_user_data_ans_row['title'];
	            $dele_fname      = $qr_gt_user_data_ans_row['fname'];
	            $dele_lname      = $qr_gt_user_data_ans_row['lname'];
	            $dele_email      = $qr_gt_user_data_ans_row['email'];
	            $dele_cellno     = $qr_gt_user_data_ans_row['cellno'];
	            $dele_cellno_arr = explode("-", $dele_cellno);
	            
	            $test_title = $qr_gt_user_data_ans_row['title'];
	            $test_fname = $qr_gt_user_data_ans_row['fname'];
	            $test_lname = $qr_gt_user_data_ans_row['lname'];
	            $test_email = $qr_gt_user_data_ans_row['email'];
	            
	            
	            $pas1_inx    = str_replace(' ', '_', $qr_gt_user_data_ans_row['fname']) . "123";
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
				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL),
				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','19:00:00 pm','19:30:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));

				$date = 20;
				mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
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
				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL),
				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','19:00:00 pm','19:30:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));

				$date = 21;
				mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
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
				(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));
	            //------------------------------------------------- end Inserting Values in interlinx registration table --------------------------------------
					
		    }
	    }
	}
	exit;

	/*$sql = "SELECT * FROM `it_2019_reg_tbl` WHERE (pay_status='Paid' || pay_status='Complimentary');";
	$qr_reg = mysqli_query($link,$sql) or (die(mysqli_error($link)));

	while ($qr_gt_user_data_ans_row = mysqli_fetch_array($qr_reg)) {
		for ($i = 1; $i <= $qr_gt_user_data_ans_row['sub_delegates']; $i++) {
	        $test_delegate_email = $qr_gt_user_data_ans_row['email'];
			//$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'");
			$qry_email_chk       = mysqli_query($link,"SELECT * FROM it_2019_all_users_schedule WHERE receiver_email = '$test_delegate_email'");
			if(mysqli_num_rows($qry_email_chk)) {
				echo $test_delegate_email . '## ' . mysqli_num_rows($qry_email_chk) . ' <br/>';
			}
		}
	}
	exit;*/

	//========= Send Interlinx mail ====================
	//$sql = "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL ." int_reg, " . $EVENT_DB_FORM_REG . " reg WHERE int_reg.tin_no=reg.tin_no AND reg.tin_no='TIN-ItSD2017-195828246'";
	$sql = "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE org='CodeChef'";
	//$sql = "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE (pay_status='Paid' || pay_status='Complimentary')";
	//$sql = "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE pay_status='Paid'";
	//$sql = "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE pay_status='Complimentary'";
	$qr_reg = mysqli_query($link,$sql) or (die(mysqli_error($link)));
	//exit;
	
	$str_career_intx = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";

	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the server
	$mail->Username   = "enquiry-bengalurutechsummit";  // username
	$mail->Password   = "Enq@ui2ry@be";            // password			
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR . ' InterlinX');
	$mail->Subject    = $str_career_intx ;		
	
	while ($qr_gt_user_data_ans_row = mysqli_fetch_array($qr_reg)) {
		/*$sql = "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE tin_no='" . $qr_reg_data['tin_no'] . "'";
		//echo $sql;exit;
		$qr_gt_user_inx_login_data_id = mysqli_query($link,$sql) or (die(mysqli_error($link)));

		//echo mysqli_num_rows($qr_gt_user_inx_login_data_id);
		/zexit;
		while ($qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qr_gt_user_inx_login_data_id)) {*/
		//echo '@' . $qr_gt_user_data_ans_row['sub_delegates'];
		for ($i = 1; $i <= $qr_gt_user_data_ans_row['sub_delegates']; $i++) {
	        $test_delegate_email = $qr_gt_user_data_ans_row['email'];
			//echo "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'";
			$qry_email_chk       = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'");
			$qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qry_email_chk);

			include "reg_inx_emailer.php";
			//include "emailer_bio_interlinx_use.php";
			//print_r($qr_gt_user_inx_login_data_ans);echo '<hr>';
			
			$str_career_intx = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";
			$str_career_bdy_intx = $mail_interlinx_str;
			$recipients = array('', $qr_gt_user_inx_login_data_ans['pri_email'],'', 'test.interlinks@gmail.com', '', 'interlinx@outlook.com');
			//$recipients = array('', 'test.interlinks@gmail.com', 'sagar.patil@interlinks.in');
			
			$mail->MsgHTML($str_career_bdy_intx);

			$recipients = array($qr_gt_user_inx_login_data_ans['pri_email']);
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
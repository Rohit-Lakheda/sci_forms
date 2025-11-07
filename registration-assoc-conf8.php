<?php
	//print_r($_POST);exit;
	session_start();
	$event_name = 'Bangalore IT';
	$en = '';
	if(isset($_POST['en']) && !empty($_POST['en'])) {
		$en = '1';
		$event_name = 'Bangalore INDIA BIO';
	}
	
	$assoc_code = @$_GET['a'];
	$assoc_code = trim($assoc_code);

	if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
		session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		if(!empty($assoc_code)) {
			echo "<script language='javascript'>window.location = 'registration-assoc-conf.php?a=$assoc_code';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-assoc-conf.php?a=$assoc_code';</script>";
		}
		exit;
	}
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require 'class.phpmailer.php';
	$reg_id = $_SESSION["vercode_reg"];
	
	if(isset($_POST['make_payment'])) {
		$qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'");
		$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
		$res = $qr_gt_user_data_ans_row;
		$temp_receiver_org       = $qr_gt_user_data_ans_row['org'];
		
		$qr_gt_user_data_id1      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE reg_id = '$reg_id'");
		$qr_gt_user_data_ans_row1 = mysqli_fetch_assoc($qr_gt_user_data_id1);
		if(!empty($qr_gt_user_data_ans_row1)) {
			echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
			echo "<script language='javascript'>window.location = 'registration-assoc-conf.php?a=$assoc_code';</script>";
			exit;
		}

		$category_id = 1881;
		
		if(!empty($qr_gt_user_data_ans_row['user_type']) && !empty($qr_gt_user_data_ans_row['assoc_srno'])) {
			$assoc_name = $qr_gt_user_data_ans_row['user_type'];
			$assoc_srno = $qr_gt_user_data_ans_row['assoc_srno'];
			$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_PROMO_CODE_TBL . " WHERE srno='$assoc_srno' AND assoc_name='$assoc_name'");
				
			if(mysqli_num_rows($qry)) {
				$result = mysqli_fetch_assoc($qry);

				$category_id = $result['category_id'];

				if($result['promo_code'] != 'T3JSW1N1') {
    				//print_r($result);
    				if($result['reg_done'] >= $result['total_reg']) {
    					//session_destroy();
    					echo "<script language='javascript'>alert('For "  .$assoc_name . " Association/ Dignitary registrations seats are fulled. Please try again!');</script>";
    					echo "<script language='javascript'>window.location = 'registration-assoc-conf.php';</script>";
    					exit;
    				} else {
    					$result['reg_done']++;
    					$sql = "UPDATE " . $EVENT_DB_FORM_PROMO_CODE_TBL . " SET reg_done=" . $result['reg_done'] . " WHERE srno=" . $result['srno'];
    					mysqli_query($link,$sql);
    				}
				}
			}
		}
		
		//print_r($qr_gt_user_data_ans_row);
		//=======================================================================================================================================
		//=======================================================================================================================================
		
		if(!empty($qr_gt_user_data_ans_row)) {
			$fields = '';
			$values = '';
			foreach ($qr_gt_user_data_ans_row as $key=>$value) {
				if($key != 'srno') {
					$fields .= mysqli_real_escape_string($link,htmlspecialchars($key)) . ',';
					
					$values .= "'" . mysqli_real_escape_string($link,htmlspecialchars(($value))) . "',";
				}
			}
			$values = trim($values, ',');
			$fields = trim($fields, ',');
			
			mysqli_query($link,"insert  into " . $EVENT_DB_FORM_REG . "($fields) VALUES($values)");
		}
		
		if($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
			$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
		} else {
			$total_amt = $qr_gt_user_data_ans_row['total'];
		}
		
	    for ($i = 1; $i <= $qr_gt_user_data_ans_row['sub_delegates']; $i++) {
			//############################################################################
			//break;
			//############################################################################
	        if( true){//($qr_gt_user_data_ans_row['cata' . $i] == 'Premium Delegate') || ($qr_gt_user_data_ans_row['cata' . $i] == 'International Premium Delegate') ) {
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
    	            
    	            
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$randomString = substr(str_shuffle($characters), 0, 4);
					$pas1_inx = str_replace(' ', '_', $qr_gt_user_data_ans_row['fname' . $i]) . $randomString;
					$pas2_inx = password_hash($pas1_inx, PASSWORD_BCRYPT);
    	            $user_id_md5 = md5($usr_no1);
    	            
    	            $temp_qr_gt_user_data_ans_row_fone_arr = explode("-", $qr_gt_user_data_ans_row['fone']);
    	            $temp_qr_gt_user_data_ans_row_fax_arr  = explode("-", $qr_gt_user_data_ans_row['fax']);
    	            
    	            //------------------------------------------------- Inserting Values in interlinx registration table --------------------------------------
    	            mysqli_query($link,"INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
    	            		(user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,org_info,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,				fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,reg_id,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no) values 
    	            		('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','','$dele_email','','$qr_gt_user_data_ans_row[org]','','','$dele_cellno_arr[0]','$dele_cellno_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row[reg_id]','$qr_gt_user_data_ans_row[reg_id]','uploads/default_file.jpg','','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[tin_no]')") or die(mysqli_error($link));
    	            
    	            $year = $EVENT_YEAR;
					$month = '11';
					$date = "19";
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

				$date = "20";
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
		
    		    }
	        }
	    }

	    $qr_gt_user_inx_login_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE tin_no = '$res[tin_no]' ");
		while ($qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qr_gt_user_inx_login_data_id)) {

			include "reg_inx_emailer.php";
			$recipients = array($qr_gt_user_inx_login_data_ans['pri_email'], '', 'test.interlinks@gmail.com');
			//$recipients = array($qr_gt_user_inx_login_data_ans['pri_email']);
			//$recipients = array('sagarpatil2112@gmail.com', 'vivek.patil@mmactiv.com');
			//elastic_mail("Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " - InterlinX", $mail_interlinx_str, $recipients);

			/*include "reg_inx_emailer.php";
			$temp_p_email   = $EVENT_ENQUIRY_EMAIL;
			$temp_p_name    = $EVENT_NAME . " InterlinX";
			$str_career     = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";
			$str_career_bdy = $mail_interlinx_str;
			 
			$recipients = array($qr_gt_user_inx_login_data_ans['pri_email'], '', 'test.interlinks@gmail.com', '', $EVENT_ENQUIRY_EMAIL, '', 'interlinx@outlook.com', '', '');
			*//*$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
	        $mail->Host     = "localhost"; // SMTP server 
	        $mail->FromName = $temp_p_name;
	        $mail->From     = $temp_p_email;
	        $mail->Subject  = $str_career;
	        $mail->IsHTML(true);
	        $mail->Body = $str_career_bdy;*/

			/*$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
			$mail->Port       = 25;                   // set the SMTP port for the server
			$mail->Username   = "enquiry-bengalurutechsummit";  // username
			$mail->Password   = "Enq@ui2ry@be";           // password			
			$mail->SetFrom($temp_p_email, $temp_p_name);
			$mail->Subject    = $str_career ;		
			$mail->MsgHTML($str_career_bdy);*/

	        //echo $str_career_bdy;exit;
			/*foreach($recipients as $emailid) {
				 $mail->AddAddress($emailid);
				 if(!$mail->Send()) {
				 }
				 $mail->clearAddresses();
			 }*/
		}


	    $recipients = array();
		$recipient = array('','test.interlinks@gmail.com','', '', '', 'bhavya.mmactiv@gmail.com', '', 'vinay.mmactiv@gmail.com', '', 'ambika.kiran@mmactiv.com','', 'mohanram@mmactiv.in', '','gurunath.angadi@mmactiv.com','','');
		if ($res['sector'] == 'Bio Technology') {
			$recipient[] = '';
			$recipient[] = 'vani.faustina@mmactiv.com';
		}
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
		//$recipients = array();
	    //$recipients = array_merge($recipients, $recipient);
	    //$recipients = array('test.interlinks@gmail.com','', 'sagarpatil2112@gmail.com');
	    //print_r($recipients);exit;
	   //$recipients = array('', 'test.interlinks@gmail.com','', 'mayuri.ladi@interlinks.in');
	    //require 'class.phpmailer.php';
		/*for ($i = 1; $i <= $res['sub_delegates']; $i++) {
			//To push data in the API
			$result = array();
			$result['category_id'] = 391;
			$result['badge_print_category'] = 'Delegate';
			if(!empty($qr_gt_user_data_ans_row['assoc_srno'])) {
				$assoc_name = $qr_gt_user_data_ans_row['user_type'];
				$assoc_srno = $qr_gt_user_data_ans_row['assoc_srno'];
				$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_PROMO_CODE_TBL . " WHERE srno='$assoc_srno' AND assoc_name='$assoc_name'");
				$result = mysqli_fetch_assoc($qry);	
			}
			$dele_title      = $res['title' . $i];
			$dele_fname      = $res['fname' . $i];
			$dele_lname      = $res['lname' . $i];
			$dele_email      = $res['email' . $i];
			$job_title       = $res['job_title' . $i];
			$dele_cellno     = str_replace('+', '', $res['cellno' . $i]);
			$dele_cellno_arr = explode("-", $dele_cellno);

			if(isset($dele_cellno_arr[0])) {
				$country_code = $dele_cellno_arr[0];
				if(strlen($country_code) >= 6) {
					$phone = $country_code;
					$country_code = '91';
				}
			}
			if(isset($dele_cellno_arr[1])) {
				$phone = $dele_cellno_arr[1];
			}
			//Call save Operator API
			$data = array();
			$data['name']= $dele_fname . ' ' . $dele_lname;
			$data['email']= $dele_email;
			$data['country_code']= $country_code;
			$data['mobile']= $phone;
			$data['company']= $res['org'];
			$data['designation']= $job_title;
			$data['category_id']= $result['category_id'];
			$data['print_val']= $result['badge_print_category'];
			//print_r($data);exit;
			//Call API
			callUniversalAPI($data);
		}*/
		for ($i = 1; $i <= $res['sub_delegates']; $i++) {
			$dele_title      = $res['title' . $i];
			$dele_fname      = $res['fname' . $i];
			$dele_lname      = $res['lname' . $i];
			$dele_email      = $res['email' . $i];
			$job_title       = $res['job_title' . $i];
			$dele_cellno     = str_replace('+', '', $res['cellno' . $i]);
			$dele_cellno_arr = explode("-", $dele_cellno);
			$category 	  = $res['cata' . $i];
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
			$data = array();
			$data['api_key'] = 'scan626246ff10216s477754768osk';
			$data['event_id'] = 117859;

			$data['name'] = $dele_fname . ' ' . $dele_lname;
			$data['email'] = $dele_email;
			$data['country_code'] = $country_code;
			$data['mobile'] = $phone;
			$data['company'] = $res['org'];
			$data['designation'] = $job_title;
			//$data['type']= 1;
			$data['category_id']= $category_id;
			$data['qsn_366'] = $category;
			//print_r($data);
			//Call API
			sendchkdinapi($data);;//exit;
			
		}
	    require "emailer_reg_free_prem.php";
	    /* if($res['pay_status'] == 'Free') {
			require "emailer_reg_del.php";
		} else {
			require "emailer_reg.php";
		} */
	    //echo $mail_body;exit;
		/*$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "72.9.105.77"; // SMTP server
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "72.9.105.77";      // sets  as the SMTP server
		$mail->Port       = 587;                   // set the SMTP port for the server
		$mail->Username   = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
		$mail->Password   = "dcpl5555";            // password			
		$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
		$mail->Subject    = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR ;		
		$mail->MsgHTML($mail_body);*/
							
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
		$mail->Subject    = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR ;
		$mail->MsgHTML($mail_body);

    	/*$mail = new PHPMailer();
    	$mail->IsSMTP(); // telling the class to use SMTP
    	$mail->Host = "localhost"; // SMTP server
    	$mail->FromName = $EVENT_NAME . ' ' . $EVENT_YEAR;
    	$mail->From = $EVENT_ENQUIRY_EMAIL;
    	$mail->Subject = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR ;
    	$mail->IsHTML(true);
    	$mail->Body = $mail_body;*/
    	/*foreach($recipients as $emailid) {
    		$mail->AddAddress($emailid);
    		if(!$mail->Send()) {//echo '#'.$emailid;
    		}
    		$mail->clearAddresses();
    	}*/
		$Subject    = "Thank you for Registering with " . $EVENT_NAME . " " . $EVENT_YEAR ;
		$recipients[] = 'test.interlinks@gmail.com';
		//$recipients = array('test.interlinks@gmail.com','', 'sagarpatil2112@gmail.com');
		elastic_mail($Subject, $mail_body, $recipients);
	    //echo $mail_body;exit;
    	//exit;
    	
		echo "<script language='javascript'>window.location = 'registration-assoc-conf9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
    	exit;
    	
	    if(($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking' || $qr_gt_user_data_ans_row['paymode'] == 'Google pay') && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
	    	/*//echo "<script language='javascript'>window.location = 'registration-assoc-conf9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";*/
			session_destroy();
			echo 'Please wait while you redirecting to CCAvenue payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
	    	echo "<script language='javascript'>setTimeout(function(){ window.location = ('$EVENT_OL_PAY_ACT_LINK?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
			exit;
	    } else if(($qr_gt_user_data_ans_row['paymode'] == "Cheque")||($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD") || $qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") {
	    	echo "<script language='javascript'>window.location = 'registration-assoc-conf9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
	    	exit;
	    } else if($qr_gt_user_data_ans_row['paymode'] == "Paypal" && $qr_gt_user_data_ans_row['curr'] == 'Foreign'  && $qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
		    session_destroy();
			echo 'Please wait while you redirecting to Paypal payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
		    echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CANCEL_URL?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
		    exit;
	    }else{
	    	echo "<script language='javascript'>window.location = 'registration-assoc-conf9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
		    	exit;
	    }
	    
	    /* if($_POST['make_payment'] == 1) {
	    	
	    } else if($_POST['make_payment'] == 0) {
	    	if($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {
		    	echo "<script language='javascript'>window.location = 'registration-assoc-conf9.php';</script>";
		    	exit;
	    	}
	    } */
	}
	
	echo "<script language='javascript'>alert('Sorry, your registration has been failed!');</script>";
	echo "<script language='javascript'>window.location = 'registration-assoc-conf.php';</script>";
	exit;
?>
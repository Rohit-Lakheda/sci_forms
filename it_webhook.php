<?php 
ini_set("display_errors", "1");
error_reporting(E_ALL);
	exit;
	//$EVENT_DB_FORM_INTERLINX_REG_TBL = "apcat_2017_interlinx_reg_table";
	
	//$EVENT_DB_FORM_ALL_USERS_SCHEDULE="apcat_2017_all_users_schedule";
	//$EVENT_DB_FORM_REG="apcat_2017_reg_tbl";
	/* Array ( [orderNo] => EXXXXXXE12345 [datePurchased] => 2016-10-26 12:27:22 
		[quantity] => 1 [ticketcost] => 10 [billingname] => XXXXXX [buyerPhoneNo] => 12345678 
		[attendee] => Array ( [0] => Array ( [attendeeInfo] => Array ( [Name] => XXXX [Email] => XXXXX@XXXXX.COM )
	[ticketNumber] => 123 [bibNo] => 1234 [seatNo] => S01 [ticketName] => Dummy Name [ticketPrice] => 10 
				[name] => XXXX [emailId] => XXXXX@XXXXX.COM [categoryId] => 123 [categoryName] => XXX ) ) ) */
	//echo $ddate  = date("Y-m-d");exit;	

	$servername='localhost';     // Your MySql Server Name or IP address here
	$dbusername='bangaloreite';          // Login user id here
	$dbpassword='BdkqLC025a';              // Login password here
	$dbname='bangaloreite';
	
	/* $servername='localhost';     // Your MySql Server Name or IP address here
	$dbusername='root';          // Login user id here
	$dbpassword='';              // Login password here
	$dbname='bangaloreite'; */

	$link = connecttodb($servername,$dbname,$dbusername,$dbpassword);
	function connecttodb($servername,$dbname,$dbuser,$dbpassword)
	{
		global $link;
		$link=mysqli_connect($servername,$dbuser,$dbpassword,$dbname);
		return $link;
		//if(!$link){die("Could not connect to MySQL");}
		//mysql_select_db("$dbname",$link) or die ("could not open db - ".mysqli_error($link));
	}
	
	date_default_timezone_set ('Asia/Kolkata');
	require("includes/form_constants.php");
	//require "dbcon_open.php";
	ini_set("max_execution_time","3600");
	$response = json_decode(file_get_contents('php://input'), true);
	//print_r($data);

	//Write log
	$handle = fopen('loger1.log', 'a+');
	fwrite($handle, PHP_EOL . PHP_EOL . '------------ Start Webhook ' . date('Y-m-d H:i:s') . ' --------------'. PHP_EOL);
	fwrite($handle, 'Response=======>' . json_encode($response) . PHP_EOL);
		
	if(!empty($response)) {
		$sub_delegates = count($response['attendee']);
		$delegateList = $response['attendee'];

		$isSuccess = true;
		foreach ($delegateList as $delegateDetail) {
			if(!isset($delegateDetail['emailId']) || empty($delegateDetail['emailId'])) {
				$isSuccess = false;
				$ticketNumber = $delegateDetail['ticketNumber'];
				if(!isset($delegateDetail['ticketNumber'])) {
					$ticketNumber = '';
				}
				fwrite($handle, 'OrderNo ====>' . $response['orderNo'] . 'TicketNumber====>' . $ticketNumber . ' \n\n');
			}
		}
		
		if($isSuccess) {
			$tin_no = $response['orderNo'];
			
			$index = 1;
			$ddate  = date("Y-m-d");
			$ttime  = date("H:i:s A");
			foreach ($delegateList as $delegateDetail) {
				$email = strtolower($delegateDetail['emailId']);
				$email = trim($email);
				//echo "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$email'";exit;
				$qry_email_chk       = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$email'");
				$qry_email_chk_num   = mysqli_num_rows($qry_email_chk);
				//echo $qry_email_chk_num;exit;
				if ($qry_email_chk_num >= 1) {
				
				} else {
					$fname = $name = $delegateDetail['name'];
					$nameData = explode(' ', $name);
					if(isset($nameData[0]) && !empty($nameData[0])) {
						$fname = $nameData[0];
					}
					$lname = '';
					if(isset($nameData[1]) && !empty($nameData[1])) {
						$lname = $nameData[1];
					}
					$fname = trim($fname);
					$lname = trim($lname);
					
					if($index == 1) {
						$sql = "INSERT INTO " . $EVENT_DB_FORM_REG . "(reg_date,reg_time, fname1, lname1, email1,sub_delegates,tin_no) values
								('$ddate','$ttime', '$fname','$lname','$email','$sub_delegates','$tin_no')";
						mysqli_query($link, $sql);
					}
					//exit;
					$qry = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no'");
					$res = mysqli_fetch_array($qry);
					
					$index++;
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
						$qry     = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE user_id = '$usr_no1'");
						$res_no  = mysqli_num_rows($qry);
						if ($res_no < 1) {
							$i_gim_inx_user_id_cnt++;
						} else {
							$usr_no1 = "";
						}
					} while (!($i_gim_inx_user_id_cnt == 1));
					
					$reg_srno = $res['srno'];
					
					$sql = "INSERT INTO " . $EVENT_DB_FORM_REG_DELEGATE . "(fname, lname, email,reg_srno,tin_no) values
							('$fname','$lname','$email','$reg_srno','$tin_no')";
					mysqli_query($link, $sql);
					
					 $pas1_inx    = str_replace(' ', '_', $fname) . "123";
					$pas2_inx    = md5($pas1_inx);
					$user_id_md5 = md5($usr_no1);

					mysqli_query($link, "INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
							(user_id,dup_user_id,fname,lname,pri_email,user_name,pass1,pass2,photo,inx_reg_date,inx_reg_time,tin_no) values
							('$usr_no1','$user_id_md5','$fname','$lname','$email','$email','$pas1_inx','$pas2_inx','uploads/default_file.jpg','$ddate','$ttime','$tin_no')") or die(mysqli_error($link));
					
					$test_title = '';
					$test_fname = $fname;
					$test_lname = $lname;
					$temp_receiver_org = '';
					$test_email = $email;
					
					$year = $EVENT_YEAR;
					$month = '11';
					$date = 28;
						mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));
					//------------------------------------------------- end Inserting Values in interlinx registration table --------------------------------------
							   $date = 29;
								mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
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
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));
					//------------------------------------------------- end Inserting Values in interlinx registration table --------------------------------------
					   $date = 30;
						mysqli_query($link,"insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
								(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));
					//------------------------------------------------- end Inserting Values in interlinx registration table --------------------------------------

				}
			}
		}
	
		/*for ($i = 1; $i <= $qr_gt_user_data_ans_row['sub_delegates']; $i++) {
			$test_delegate_email = $qr_gt_user_data_ans_row['email' . $i];
			$qry_email_chk       = mysqli_query("SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$test_delegate_email'");
			$qry_email_chk_num   = mysqli_num_rows($qry_email_chk);
			$temp_receiver_org   = '';//mysqli_real_escape_string($link,$qr_gt_user_data_ans_row['org' . $i]);
			
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
					$qry     = mysqli_query("SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE user_id = '$usr_no1'");
					$res_no  = mysqli_num_rows($qry);
					if ($res_no < 1) {
						$i_gim_inx_user_id_cnt++;
					} else {
						$usr_no1 = "";
					}
				} while (!($i_gim_inx_user_id_cnt == 1));
				//-------------------------------------------------End Generating User Id ------------------------------------------------
				
				$pas1_inx    = str_replace(' ', '_', $fname) . "123";
				$pas2_inx    = md5($pas1_inx);
				$user_id_md5 = md5($usr_no1);
				
				mysqli_query("INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
						(user_id,dup_user_id,fname,lname,pri_email,user_name,pass1,pass2,photo,inx_reg_date,inx_reg_time,tin_no) values
						('$usr_no1','$user_id_md5','$dele_fname','$dele_lname','$dele_email','$dele_email','$pas1_inx','$pas2_inx','uploads/default_file.jpg','$reg_date','$reg_time','$tin_no')") or die(mysqli_error($link));
				
				/* $temp_qr_gt_user_data_ans_row_fone_arr = explode("-", $qr_gt_user_data_ans_row['fone']);
				if(empty($temp_qr_gt_user_data_ans_row_fone_arr)) {
					$temp_qr_gt_user_data_ans_row_fone_arr[0] = $temp_qr_gt_user_data_ans_row_fone_arr[1] = $temp_qr_gt_user_data_ans_row_fone_arr[2];
				} */
				/* $temp_qr_gt_user_data_ans_row_fax_arr  = explode("-", $qr_gt_user_data_ans_row['fax']);
				if(empty($temp_qr_gt_user_data_ans_row_fax_arr)) {
					$temp_qr_gt_user_data_ans_row_fax_arr[0] = $temp_qr_gt_user_data_ans_row_fax_arr[1] = $temp_qr_gt_user_data_ans_row_fax_arr[2];
				} */
				
				//------------------------------------------------- Inserting Values in interlinx registration table --------------------------------------
				/*echo "INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
						(user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,org_info,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,				fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,reg_id,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no) values 
						('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','','$dele_email','','$qr_gt_user_data_ans_row[org]','','','$dele_cellno_arr[0]','$dele_cellno_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row[reg_id]','$qr_gt_user_data_ans_row[reg_id]','uploads/default_file.jpg','$qr_gt_user_data_ans_row[org_profile]','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[tin_no]');";*/
				/*mysqli_query("INSERT INTO " . $EVENT_DB_FORM_INTERLINX_REG_TBL . "
						(user_id,dup_user_id,title,fname,lname,addr1,addr2,city,state,country,pin,pri_email,mob_number,fax_number,user_name,pass1,pass2,photo,inx_reg_date,inx_reg_time,tin_no) values 
						('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','$addr1','$addr2','$city','$state','$country','$pin','$dele_email','$mob_number','$fax_number','$dele_email','$pas1_inx','$pas2_inx','uploads/default_file.jpg','$reg_date','$reg_time','$tin_no')") or die(mysqli_error($link));
				*/
				/* $year = $EVENT_YEAR;
				$month = '01';
				for($date = 17; $date <= 21; $date++) { */
					/*echo "insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-0$date','18:00:00 pm','18:30:00 pm',NULL,'',NULL,NULL)";*/
					/* mysqli_query("insert  into `" . $EVENT_DB_FORM_ALL_USERS_SCHEDULE . "` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:00:00 am','09:30:00 am',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','09:30:00 am','10:00:00 am',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:30:00 pm','19:00:00 pm',NULL,'',NULL,NULL),
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
							(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'$year-$month-$date','18:00:00 pm','18:30:00 pm',NULL,'',NULL,NULL)") or die(mysqli_error($link));
				}
				//------------------------------------------------- end Inserting Values in interlinx registration table --------------------------------------
			}
			//exit;
		} */
		
		require 'class.phpmailer1.php';
		$qr_gt_user_inx_login_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE tin_no = '$tin_no' ");	
		while ($qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qr_gt_user_inx_login_data_id)) {
			//print_r($qr_gt_user_inx_login_data_ans);exit;
			include "reg_inx_emailer.php";
			$temp_p_email   = $EVENT_ENQUIRY_EMAIL;
			$temp_p_name    = $EVENT_NAME . " InterlinX";
			$str_career     = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";
			$str_career_bdy = $mail_interlinx_str;
		
			$recipients = array($qr_gt_user_inx_login_data_ans['pri_email'], '', 'test.interlinks@gmail.com', '', $EVENT_ENQUIRY_EMAIL, '', 'interlinx@outlook.com', '', 'utsav.activ@gmail.com');
			//$recipients = array('test.interlinks@gmail.com');
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host     = "localhost"; // SMTP server
			$mail->FromName = $temp_p_name;
			$mail->From = $EVENT_ENQUIRY_EMAIL;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;
			//echo $str_career_bdy;exit;
			foreach($recipients as $emailid) {
			 $mail->AddAddress($emailid);
			 if(!$mail->Send()) {
				fwrite($handle, PHP_EOL . '------------ Mail not send: ' . $emailid . ' --------------'. PHP_EOL);
				 echo 'Mail not send:' . $emailid . '<br/>'.$mail->ErrorInfo;
				  
			 }// else  echo $emailid . '!!!!!!';
			 $mail->clearAddresses();
			 }
		}
	}
	fwrite($handle, '------------ End Webhook ' . date('Y-m-d H:i:s') . ' --------------'. PHP_EOL);
	echo 'Success';
	?>
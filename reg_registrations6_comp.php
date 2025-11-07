<?php 
		
 session_start(); 
	if((!isset($_SESSION["vercode_reg"]))||($_SESSION["vercode_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		echo "<script language='javascript'>window.location = 'reg_registrations_comp.php';</script>";
		exit; 
	}
	require("includes/form_constants.php");
	require "dbcon_open.php";
	$reg_id = $_SESSION["vercode_reg"];
	
	ini_set("max_execution_time","3600");	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_no = 0;
	$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
	if( ($qr_gt_user_data_ans_no<=0) || ($qr_gt_user_data_ans_no=="") ){
		session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
		echo "<script language='javascript'>window.location=('reg_registrations_comp.php');</script>";
		echo "<script language='javascript'>document.location=('reg_registrations_comp.php');</script>";
		exit; 
	}	
	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
	
	$res1 = $qr_gt_user_data_ans_row;
	$res= $res1;
	
	$lmt = $res['sub_delegates'];
	$tno = $res['tin_no'];
	$curr = $res['curr'];
	$cata = $res['cata'];
	
	/*
	for($j=1; $j<= $lmt; $j++)
	{	
		
			$title = @$_POST['title'.$i];
			$title = trim($title);
			
			$fname = @$_POST['fname'.$i];
			$fname = trim($fname);
			
			$lname = @$_POST['lname'.$i];
			$lname = trim($lname);
			
			$job_title = @$_POST['job_title'.$i];
			$job_title = trim($job_title);
			
			$badge = @$_POST['badge'.$i];
			$badge = trim($badge);
			
			$email = @$_POST['email_m'.$i];
			$email = trim($email);
			
			$cell_cntry = @$_POST['c_code'.$i];
			$cell_cntry = trim($cell_cntry);
			
			$cell_act_no = @$_POST['cellno'.$i];
			$cell_act_no = trim($cell_act_no);
			
			$cellno = $cell_cntry."-".$cell_act_no;
	echo "($title == '') || ($fname == '') || ($lname == '') || ($job_title == '') || ($badge == '') || ($email == '') || ($cell_cntry == '') || ($cell_act_no == '')";
			exit;
			
			if( ($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == "") || ($cell_cntry == "") || ($cell_act_no == "") )
			{
				echo "<script language='javascript'>alert('provided all required details of all $lmt delegates.');</script>";
				echo "<script language='javascript'>window.location='reg_registrations5.php';</script>";
				exit;	
			}		
		
						
		
	}
	*/
	
	for($j=1; $j<= $lmt; $j++)
	{			
		
		$email = @$_POST['email_m'.$j];
		$field = "email".$j;
		$qr = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE $field = '$email'")or die(mysqli_error($link));
		$num_row = mysqli_num_rows($qr);
		if($num_row > 0)
		{
			echo "<script language='javascript'>alert('provided email id $email, is alredy registered with us.');</script>";
			echo "<script language='javascript'>window.location='reg_registrations5_comp.php';</script>";
			exit;	
		}		
		
						
		
	}
	
	$amt_per_user = "";
	$gr_cata_name = "";
	$total_amt_per_dele ="";
		
	for($i=1; $i<= $lmt; $i++)
	{	
			$a1 = "title".$i; 
			$a2 = "fname".$i;
			$a3 = "lname".$i;
			$a5 = "job_title".$i;
			$a6 = "badge".$i;
			$a7 = "email".$i;
			$a8 = "cellno".$i;
			$a9 = "cata".$i;
			$a10 = "amt".$i;
			$title = @$_POST['title'.$i];
			$title = trim($title);
			
			$fname = @$_POST['fname'.$i];
			$fname = trim($fname);
			
			$lname = @$_POST['lname'.$i];
			$lname = trim($lname);
			
			$job_title = @$_POST['job_title'.$i];
			$job_title = trim($job_title);
			
			$badge = @$_POST['badge'.$i];
			$badge = trim($badge);
			
			$email = @$_POST['email_m'.$i];
			$email = trim($email);
			
			$cellno = @$_POST['c_code'.$i]."-".$_POST['cellno'.$i];
			$amt_per_dele = $res['amt_per_del'];
			
			$gr_cata_name = "";
			$cata_per_dele = "";
			$cata = "";
			
			
			$pas1=$fname."123";
			$pas2=md5($pas1);
		
			
	/*		
			$cata1_day1 = @$_POST['vcheckbox1'.$i];
			$cata1_day2 = @$_POST['vcheckbox2'.$i];
			$cata1_day3 = @$_POST['vcheckbox3'.$i];
			
			
			if( ($res['cata']=="Industry - Single Day Delegate") || ($res['cata']=="GOVT., R&D & Faculty - Single Day Delegate") ){
				
				if( ($cata1_day1 == "") && ($cata1_day2 == "") && ($cata1_day3 == "") ){
		
					echo "<script language='javascript'>alert('Please Enter Complete Information');</script>";
					echo "<script language='javascript'>window.location = 'reg_registrations5_comp.php';</script>";
					exit;
				}
			}
			
			if( ($res['cata']=="Industry - Single Day Delegate") || ($res['cata']=="GOVT., R&D & Faculty - Single Day Delegate") ){
				
				$amt_per_user = 0 ;
					
				if($res['cata'] == "Industry - Single Day Delegate"){	
				
					if($cata1_day1 == "Single Day 04 Dec 2013"){				
						
						$amt_per_user = $amt_per_user + 4500;
						$gr_cata_name = $gr_cata_name."<br />Single Day 04 Dec 2013 ";
					}
					if($cata1_day2 == "Single Day 05 Dec 2013"){
						
						$amt_per_user = $amt_per_user + 4500;
						$gr_cata_name = $gr_cata_name."<br />Single Day 05 Dec 2013 ";
								
					}
					if($cata1_day3 == "Single Day 06 Dec 2013"){
					
						$amt_per_user = $amt_per_user + 4500;
						$gr_cata_name = $gr_cata_name."<br />Single Day 06 Dec 2013 ";
					
					}
				}
				
				else if($res['cata'] == "GOVT., R&D & Faculty - Single Day Delegate"){	
				
					if($cata1_day1 == "Single Day 04 Dec 2013"){				
						
						$amt_per_user = $amt_per_user + 3500;
						$gr_cata_name = $gr_cata_name."<br />Single Day 04 Dec 2013 ";
					}
					if($cata1_day2 == "Single Day 05 Dec 2013"){
						
						$amt_per_user = $amt_per_user + 3500;
						$gr_cata_name = $gr_cata_name."<br />Single Day 05 Dec 2013 ";
								
					}
					if($cata1_day3 == "Single Day 06 Dec 2013"){
					
						$amt_per_user = $amt_per_user + 3500;
						$gr_cata_name = $gr_cata_name."<br />Single Day 06 Dec 2013 ";
					
					}
				}
				else{
						echo "<script language='javascript'>alert('Error in process, please try again.');</script>";
						echo "<script language='javascript'>window.location='reg_registrations5_comp.php';</script>";
						exit;	
				}
				
				$amt_per_dele = $amt_per_user;
			}
		
		*/
			if( ($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == "")  )
			{
				echo "<script language='javascript'>alert('provided all required details of all $lmt delegates.');</script>";
				echo "<script language='javascript'>window.location='reg_registrations5_comp.php';</script>";
				exit;	
			}	
			
			//if( ($res['cata']=="Only Tutorial") || ($res['cata']=="Conference + Tutorial") ){			 
				$cata_per_dele =  @$_POST['tut1'.$i];
			// }
			 
			
			
			if( ($res['cata'] != "Complimentary Exhibitors Delegate")  ){
			/*
				if(($cata_per_dele == "") || ($cata_per_dele == " , ") || ($cata_per_dele == "")){
					echo "<script language='javascript'>alert('Please Select Tutorials for every user.');</script>";
					echo "<script language='javascript'>window.location='nano_registrations5_comp.php';</script>";
					exit;
				}
				*/
			}
			
			$cata = $res['cata']." - ".$cata_per_dele;			
			
			//$cata = $res['cata']." - ".$gr_cata_name;
			$total_amt_per_dele = $total_amt_per_dele + $amt_per_user;
			
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a1 = '$title' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a2 = '$fname' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a3 = '$lname' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a5 = '$job_title' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a6 = '$badge' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a7 = '$email' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a8 = '$cellno' where reg_id = '$reg_id'") or die(mysqli_error($link));			
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a9 = '$cata' where reg_id = '$reg_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a10 = '$amt_per_dele' where reg_id = '$reg_id'") or die(mysqli_error($link));
			
			
			mysqli_query($link,"INSERT INTO ".$EVENT_DB_FORM_REG_TBL_LOGIN."(tin_no,reg_id,title,fname,lname,email,cata,user_name,pass1,pass2) VALUES ('$tno','$reg_id','$title','$fname','$lname','$email','$cata','$email','$pas1','$pas2')") or die(mysqli_error($link));
			
			
	}
	
/*	if( ($res['cata']=="Industry - Single Day Delegate") || ($res['cata']=="GOVT., R&D & Faculty - Single Day Delegate") ){
		
		$main_amt = $amt_per_del = $amt_payable = $gr_discount =$grp_discount = $membership_discount = $govt_discount = $spl_discount = $tax = $total = 0;
		
		$amt_payable = $total_amt_per_dele;
			
		if( ($res['gr_type'] == "Group") && ($res['sub_delegates'] >2) ){
			
			$gr_discount = round( (($amt_payable * 10) / 100) ); 
			
		}	
		
		$tax = round((( ($amt_payable - $gr_discount) * 14) / 100));	// calculating tax
			
		$total = $amt_payable + $tax - $gr_discount;
		$total = round($total);
		
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET selection_amt = '$amt_payable' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET amt_per_del = '$amt_per_user' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET gr_discount = '$gr_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET admin_discount = '$admin_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET tax = '$tax' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET total = '$total' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET membership_discount = '$mem_disc' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));	
		
			
	}*/
	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
	$temp_receiver_org = $qr_gt_user_data_ans_row['org'];
	
	

	
	mysqli_query($link,"insert  into ".$EVENT_DB_FORM_REG."(cp_name,cp_email,org_reg_type,org,addr1,addr2,city,state,country,pin,cellno,fone,fax,nature,nationality,curr,cata,gr_type,sub_delegates,paymode,cc_same,cc_photo,cc_own_photo,dollar,amt_ext,pay_status,tin_no,pin_no,reg_id,ticket_type,reg_date,reg_time,title1,fname1,lname1,email1,badge1,job_title1,cellno1,cata1,amt1,title2,fname2,lname2,email2,badge2,job_title2,cellno2,cata2,amt2,title3,fname3,lname3,email3,badge3,job_title3,cellno3,cata3,amt3,title4,fname4,lname4,email4,badge4,job_title4,cellno4,cata4,amt4,title5,fname5,lname5,email5,badge5,job_title5,cellno5,cata5,amt5,title6,fname6,lname6,email6,badge6,job_title6,cellno6,cata6,amt6,title7,fname7,lname7,email7,badge7,job_title7,cellno7,cata7,amt7,amt_per_del,selection_amt,membership_discount,admin_discount,gr_discount,tax,total,total_amt_received,delegate_type,task_assigned_to1,task_assigned_to2,task_assigned_from,sp_msg,chq_no,chq_dt,chq_time,admin_name,trans_id_hdfc,spon_flg,spon_type,spon_comp_id,reg_cancel,pg_ErrorText,pg_paymentid,pg_trackid,pg_Error,pg_result,pg_postdate,pg_tranid,pg_auth,pg_avr,pg_ref,pg_amt,pg_udf1,pg_udf2,pg_udf3,pg_udf4,pg_udf5,user_ip_addr,membership_name,membership_code,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_type) values ('$qr_gt_user_data_ans_row[cp_name]','$qr_gt_user_data_ans_row[cp_email]','$qr_gt_user_data_ans_row[org_reg_type]','$qr_gt_user_data_ans_row[org]','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','$qr_gt_user_data_ans_row[cellno]','$qr_gt_user_data_ans_row[fone]','$qr_gt_user_data_ans_row[fax]','$qr_gt_user_data_ans_row[nature]','$qr_gt_user_data_ans_row[nationality]','$qr_gt_user_data_ans_row[curr]','$qr_gt_user_data_ans_row[cata]','$qr_gt_user_data_ans_row[gr_type]','$qr_gt_user_data_ans_row[sub_delegates]','$qr_gt_user_data_ans_row[paymode]','$qr_gt_user_data_ans_row[cc_same]','$qr_gt_user_data_ans_row[cc_photo]','$qr_gt_user_data_ans_row[cc_own_photo]','$qr_gt_user_data_ans_row[dollar]','$qr_gt_user_data_ans_row[amt_ext]','$qr_gt_user_data_ans_row[pay_status]','$qr_gt_user_data_ans_row[tin_no]','$qr_gt_user_data_ans_row[pin_no]','$qr_gt_user_data_ans_row[reg_id]','$qr_gt_user_data_ans_row[ticket_type]','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[title1]','$qr_gt_user_data_ans_row[fname1]','$qr_gt_user_data_ans_row[lname1]','$qr_gt_user_data_ans_row[email1]','$qr_gt_user_data_ans_row[badge1]','$qr_gt_user_data_ans_row[job_title1]','$qr_gt_user_data_ans_row[cellno1]','$qr_gt_user_data_ans_row[cata1]','$qr_gt_user_data_ans_row[amt1]','$qr_gt_user_data_ans_row[title2]','$qr_gt_user_data_ans_row[fname2]','$qr_gt_user_data_ans_row[lname2]','$qr_gt_user_data_ans_row[email2]','$qr_gt_user_data_ans_row[badge2]','$qr_gt_user_data_ans_row[job_title2]','$qr_gt_user_data_ans_row[cellno2]','$qr_gt_user_data_ans_row[cata2]','$qr_gt_user_data_ans_row[amt2]','$qr_gt_user_data_ans_row[title3]','$qr_gt_user_data_ans_row[fname3]','$qr_gt_user_data_ans_row[lname3]','$qr_gt_user_data_ans_row[email3]','$qr_gt_user_data_ans_row[badge3]','$qr_gt_user_data_ans_row[job_title3]','$qr_gt_user_data_ans_row[cellno3]','$qr_gt_user_data_ans_row[cata3]','$qr_gt_user_data_ans_row[amt3]','$qr_gt_user_data_ans_row[title4]','$qr_gt_user_data_ans_row[fname4]','$qr_gt_user_data_ans_row[lname4]','$qr_gt_user_data_ans_row[email4]','$qr_gt_user_data_ans_row[badge4]','$qr_gt_user_data_ans_row[job_title4]','$qr_gt_user_data_ans_row[cellno4]','$qr_gt_user_data_ans_row[cata4]','$qr_gt_user_data_ans_row[amt4]','$qr_gt_user_data_ans_row[title5]','$qr_gt_user_data_ans_row[fname5]','$qr_gt_user_data_ans_row[lname5]','$qr_gt_user_data_ans_row[email5]','$qr_gt_user_data_ans_row[badge5]','$qr_gt_user_data_ans_row[job_title5]','$qr_gt_user_data_ans_row[cellno5]','$qr_gt_user_data_ans_row[cata5]','$qr_gt_user_data_ans_row[amt5]','$qr_gt_user_data_ans_row[title6]','$qr_gt_user_data_ans_row[fname6]','$qr_gt_user_data_ans_row[lname6]','$qr_gt_user_data_ans_row[email6]','$qr_gt_user_data_ans_row[badge6]','$qr_gt_user_data_ans_row[job_title6]','$qr_gt_user_data_ans_row[cellno6]','$qr_gt_user_data_ans_row[cata6]','$qr_gt_user_data_ans_row[amt6]','$qr_gt_user_data_ans_row[title7]','$qr_gt_user_data_ans_row[fname7]','$qr_gt_user_data_ans_row[lname7]','$qr_gt_user_data_ans_row[email7]','$qr_gt_user_data_ans_row[badge7]','$qr_gt_user_data_ans_row[job_title7]','$qr_gt_user_data_ans_row[cellno7]','$qr_gt_user_data_ans_row[cata7]','$qr_gt_user_data_ans_row[amt7]','$qr_gt_user_data_ans_row[amt_per_del]','$qr_gt_user_data_ans_row[selection_amt]','$qr_gt_user_data_ans_row[membership_discount]','$qr_gt_user_data_ans_row[admin_discount]','$qr_gt_user_data_ans_row[gr_discount]','$qr_gt_user_data_ans_row[tax]','$qr_gt_user_data_ans_row[total]','$qr_gt_user_data_ans_row[total_amt_received]','$qr_gt_user_data_ans_row[delegate_type]','$qr_gt_user_data_ans_row[task_assigned_to1]','$qr_gt_user_data_ans_row[task_assigned_to2]','$qr_gt_user_data_ans_row[task_assigned_from]','$qr_gt_user_data_ans_row[sp_msg]','$qr_gt_user_data_ans_row[chq_no]','$qr_gt_user_data_ans_row[chq_dt]','$qr_gt_user_data_ans_row[chq_time]','$qr_gt_user_data_ans_row[admin_name]','$qr_gt_user_data_ans_row[trans_id_hdfc]','$qr_gt_user_data_ans_row[spon_flg]','$qr_gt_user_data_ans_row[spon_type]','$qr_gt_user_data_ans_row[spon_comp_id]','$qr_gt_user_data_ans_row[reg_cancel]','$qr_gt_user_data_ans_row[pg_ErrorText]','$qr_gt_user_data_ans_row[pg_paymentid]','$qr_gt_user_data_ans_row[pg_trackid]','$qr_gt_user_data_ans_row[pg_Error]','$qr_gt_user_data_ans_row[pg_result]','$qr_gt_user_data_ans_row[pg_postdate]','$qr_gt_user_data_ans_row[pg_tranid]','$qr_gt_user_data_ans_row[pg_auth]','$qr_gt_user_data_ans_row[pg_avr]','$qr_gt_user_data_ans_row[pg_ref]','$qr_gt_user_data_ans_row[pg_amt]','$qr_gt_user_data_ans_row[pg_udf1]','$qr_gt_user_data_ans_row[pg_udf2]','$qr_gt_user_data_ans_row[pg_udf3]','$qr_gt_user_data_ans_row[pg_udf4]','$qr_gt_user_data_ans_row[pg_udf5]','$qr_gt_user_data_ans_row[user_ip_addr]','$qr_gt_user_data_ans_row[membership_name]','$qr_gt_user_data_ans_row[membership_code]','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','$qr_gt_user_data_ans_row[intr19]','$qr_gt_user_data_ans_row[user_type]') ")or die(mysqli_error($link));
	
	
	
	for($i=1; $i<= $lmt; $i++)
	{
		$test_delegate_email = $qr_gt_user_data_ans_row['email'.$i];
		$qry_email_chk = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_INTERLINX_REG_TBL." WHERE pri_email = '$test_delegate_email'");
		$qry_email_chk_num = 0;
		$qry_email_chk_num = mysqli_num_rows($qry_email_chk);
		if($qry_email_chk_num >= 1){
			
		}
		else{
			//-------------------------------------------------- Generating User Id ------------------------------------------------
			
				$usr_no = $EVENT_TBL_PREFIX.$EVENT_YEAR."_nrm_";
				$i_gim_inx_user_id_cnt = 0;
				do
				{		
				
					$temp_no = rand(1, 9999999);
					$temp_no_len = strlen($temp_no);
					
					if($temp_no_len < 7)
					{
						$temp_no_len = 7 - $temp_no_len;
						while($temp_no_len)
						{
							$temp_no=$temp_no."0";		
							$temp_no_len--;
						}
					}
					$usr_no1 = $usr_no.$temp_no;
					$qry = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_INTERLINX_REG_TBL." WHERE user_id = '$usr_no1'");
					$res_no = mysqli_num_rows($qry);
					if($res_no < 1)
					{
						$i_gim_inx_user_id_cnt++;			
					}
					else 
					{
						$usr_no1 = "";
					}
				}while(!($i_gim_inx_user_id_cnt == 1));
			//-------------------------------------------------End Generating User Id ------------------------------------------------
				
				$dele_title = $qr_gt_user_data_ans_row['title'.$i];
				$dele_fname = $qr_gt_user_data_ans_row['fname'.$i];
				$dele_mname = "";
				$dele_lname = $qr_gt_user_data_ans_row['lname'.$i];
				$dele_email = $qr_gt_user_data_ans_row['email'.$i];
				$dele_cellno = $qr_gt_user_data_ans_row['cellno'.$i];
				$dele_cellno_arr = explode("-",$dele_cellno);
			
				$test_title = $qr_gt_user_data_ans_row['title'.$i];
				$test_fname = $qr_gt_user_data_ans_row['fname'.$i];
				$test_lname = $qr_gt_user_data_ans_row['lname'.$i];
				$test_email = $qr_gt_user_data_ans_row['email'.$i];
				
				
				$pas1_inx = $qr_gt_user_data_ans_row['fname'.$i]."123";
				$pas2_inx =md5($pas1_inx);				
				$user_id_md5 = md5($usr_no1);
				
				$temp_qr_gt_user_data_ans_row_fone_arr = explode("-",$qr_gt_user_data_ans_row['fone']);
				$temp_qr_gt_user_data_ans_row_fax_arr = explode("-",$qr_gt_user_data_ans_row['fax']);
				
				
			//------------------------------------------------- Inserting Values in interlinx registration table --------------------------------------
				mysqli_query($link,"INSERT INTO ".$EVENT_DB_FORM_INTERLINX_REG_TBL."(user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no,intr_other) values ('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','','$dele_email','','$qr_gt_user_data_ans_row[org]','','$dele_cellno_arr[0]','$dele_cellno_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row[reg_id]','uploads/default_file.jpg','','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[tin_no]','')") or die(mysqli_error($link));
				
				
				// OLD Date & time mysqli_query($link,"insert  into `".$EVENT_DB_FORM_ALL_USERS_SCHEDULE."` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL)")or die(mysqli_error($link));
				
				//mysqli_query($link,"insert  into `".$EVENT_DB_FORM_ALL_USERS_SCHEDULE."` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-12','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)")or die(mysqli_error($link));
	
				
				//mysqli_query($link,"insert  into `".$EVENT_DB_FORM_ALL_USERS_SCHEDULE."` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-13','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)")or die(mysqli_error($link));
				
				
				//mysqli_query($link,"insert  into `".$EVENT_DB_FORM_ALL_USERS_SCHEDULE."` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2014-03-14','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)")or die(mysqli_error($link));
				
				
			mysqli_query($link,"insert  into `".$EVENT_DB_FORM_ALL_USERS_SCHEDULE."` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL) ,(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-19','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)")or die(mysqli_error($link));
	


		mysqli_query($link,"insert  into `".$EVENT_DB_FORM_ALL_USERS_SCHEDULE."` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL) ,(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2015-03-20','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)")or die(mysqli_error($link));
	

	 
	 
	//---------------------------------------------- End Inserting Values in Database --------------------------------------
	 
				 
		//------------------------------------------------- end Inserting Values in interlinx registration table --------------------------------------
		
		}
		
	}	
	
	echo "<script language='javascript'>window.location = 'reg_registrations7_comp.php';</script>";
		
	exit;
?>


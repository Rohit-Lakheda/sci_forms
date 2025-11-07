<?php
 
	session_start(); 
	$cata_type=$_REQUEST["cata_type"];
	if(($_POST["vercode"] != $_SESSION["vercode_rsvp_reg"]) || ($_SESSION["vercode_rsvp_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Enter Verification Code.');</script>";
		echo "<script language='javascript'>window.location = 'pay_registrations.php?cata_type=$cata_type';</script>";
		exit;
	}
	require "dbcon_open.php"; 
	require "includes/form_constants.php";
	require "class.phpmailer.php";		
		
	$emler = @$_POST['enq_emler'];
	if($emler ==""){
		$emler = @$_GET['enq_emler'];
	}
	
	$cata_type=$_REQUEST["cata_type"];
	
	$address = @$_POST['address'];	
	$name = @$_POST["title"]." ".@$_POST["fname"]." ".@$_POST["lname"];
	$org = @$_POST["org"];
	$desig = @$_POST["desig"];
	$email = @$_POST["email"];
	$mob = @$_POST["mob"];
	$comment = addslashes(@$_POST["comment"]);
	
	if(($email == "") || ($mob == "") ){
		
		echo "<script language='javascript'>alert('Please Enter Required Information');</script>";
		echo "<script language='javascript'>window.location = 'pay_registrations.php?cata_type=$cata_type';</script>";
		exit;
	}
	
	
	$qr_chk_email_id_user_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE email1 = '$email'");
	$qr_chk_email_id_user_ans_row = mysqli_fetch_array($qr_chk_email_id_user_id);
	if($qr_chk_email_id_user_ans_row['email1'] == $email){
		
		session_destroy();
		echo "<script language='javascript'>alert('Provided Email Id Already Registered With Us.');</script>";
		echo "<script language='javascript'>window.location = 'pay_registrations.php?cata_type=$cata_type';</script>";
		exit;
	}

	
	
	$participant = "";		
	$ses = @$_SESSION["vercode_rsvp_reg"];
	$ddate=date("Y-m-d");
	$ttime=date("H:i:s A");
	
	if($_POST['supo_mem']!= ""){
			$spl_type = @$_POST['supo_mem'];
	}
	
	$temp_ticket_type = @$_POST['ticket_type'];	
	$spl_delegate_asso_type=$cata_type;	
	$nt_sele_mem_cnt=0;
	
	$reg_id = $ses;	
	$ret = @$_GET['ret'];		
	
	if($ret == "retds4fu324rn_ed24d3it"){	
		mysqli_query($link,"delete from ".$EVENT_DB_FORM_REG_DEMO." where reg_id = '$reg_id' ") or die(mysqli_error($link));
		
	}	
	
	$cata = "";
	$cata_m = @$_POST['delegate'];	
	$comp_date=$EVENT_DB_COMP_DATE;
	$date1=date("Y/m/d");	
	$pay_status = "Not Paid";
	$paymode = @$_POST['paymode'];	
	$vercode = $reg_id;
	$grp = "Single";
	$total_dele = 1;	
	$lmt = $total_dele;
	$amt_ext = "Rs.";
	$dollar = "1";	
	$curr = "Indian";
	$cata = "";
	$amtsel = "";
	
	
	
	if(@$_POST['delegate']  !=""){
				
		$delegate = $_POST['delegate'];
	}
	
	
	
	
	
	
	if($delegate== "Corporate" || $delegate== "Government" || $delegate== "R&D" || $delegate== "Academia")
	{
	
	/*if(@$_POST['daycata1'] != ""){
		
		if($cata == ""){
			$cata = $_POST['daycata1'];
			$amtsel=1000;		
		}
		else{
			$cata = $cata.$_POST['daycata1'];
			$amtsel=$amtsel+1000;		
		}
	}*/
	
	
	
	if(@$_POST['daycata2'] != ""){
		
		if(@$_POST['reg_day_2_p'] == ""){
			
			echo "<script language='javascript'>alert('Please Select Parallel track of day two');</script>";
			mysqli_query($link,"DELETE FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
			session_destroy();
			echo "<script language='javascript'>window.location='pay_registrations.php?cata_type=$cata_type';</script>";
			exit;
		}
		
		if($cata == ""){
			$cata = $_POST['reg_day_2_p'];	
			$amtsel=$amtsel+1000;
		}
		else{
			$cata = $cata.", ".$_POST['reg_day_2_p'];	
			$amtsel=$amtsel+1000;	
		}
	
	
	}
	
	
	
	
	if(@$_POST['daycata3'] != ""){
		
		if($cata == ""){
			$cata = $_POST['daycata3'];	
			$amtsel=$amtsel+1000;		
		}
		else{
			$cata = $cata.", ".$_POST['daycata3'];	
			$amtsel=$amtsel+1000;		
		}		
	}
	
	if(@$_POST['daycata4'] != ""){
		
		
		if($cata == ""){
			$cata = $_POST['daycata4'];	
			$amtsel=3000;		
		}
		else{
			$cata = $cata.", ".$_POST['daycata4'];	
			$amtsel=3000;		
		}		
	
		if(@$_POST['reg_day_2_p'] != ""){
		
			if($cata == ""){
				$cata = $_POST['reg_day_2_p'];		
			}
			else{
				$cata = $cata.", ".$_POST['reg_day_2_p'];		
			}
		}
	}
	}
	else if($delegate == "Students")
	{
	
	   /*if(@$_POST['daycata5'] != ""){
		
		if($cata == ""){
			$cata = $_POST['daycata5'];	
			$amtsel=500;	
		}
		else{
			$cata = $cata.$_POST['daycata5'];	
			$amtsel=500;	
		}
	}*/
	
	
	
	if(@$_POST['daycata6'] != ""){
		
		if(@$_POST['reg_day_2_p'] == ""){
			
			echo "<script language='javascript'>alert('Please Select Parallel track of day two');</script>";
			mysqli_query($link,"DELETE FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
			session_destroy();
			echo "<script language='javascript'>window.location='pay_registrations.php?cata_type=$cata_type';</script>";
			exit;
		}
		
		
		if($cata == ""){
			$cata = $_POST['reg_day_2_p'];		
			$amtsel=$amtsel+500;
		}
		else{
			$cata = $cata.", ".$_POST['reg_day_2_p'];	
			$amtsel=$amtsel+500;	
		}
	
		
	}
	
	
	
	
	
	if(@$_POST['daycata7'] != ""){
		
		if($cata == ""){
			$cata = $_POST['daycata7'];		
			$amtsel=$amtsel+500;	
		}
		else{
			$cata = $cata.", ".$_POST['daycata7'];	
			$amtsel=$amtsel+500;		
		}		
	}
	
	if(@$_POST['daycata8'] != ""){
		
		if($cata == ""){
			$cata = $_POST['daycata8'];	
			$amtsel=1500;		
		}
		else{
			$cata = $cata.", ".$_POST['daycata8'];	
			$amtsel=1500;		
		}		
	
		if(@$_POST['reg_day_2_p'] != ""){
		
			if($cata == ""){
				$cata = $_POST['reg_day_2_p'];
						
			}
			else{
				$cata = $cata.", ".$_POST['reg_day_2_p'];		
			}
		}
		
	  }
	
	}
	else{
		echo "<script language='javascript'>alert('Very rare condition occures. Please try after 10 sec..');</script>";
		mysqli_query($link,"DELETE FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		session_destroy();
		echo "<script language='javascript'>window.location='pay_registrations.php?cata_type=$cata_type';</script>";
		exit;
	}
	
	//echo $cata."CATA";  echo $amtsel; exit;
	
	if($cata == "")
	{
		echo "<script language='javascript'>alert('Very rare condition occures. Please try after 10 sec..');</script>";
		mysqli_query($link,"DELETE FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		session_destroy();
		echo "<script language='javascript'>window.location='pay_registrations.php?cata_type=$cata_type';</script>";
		exit;
	}
	
	$rate = $amtsel;
	$rate_org = $amtsel;
		
				
			
	$amt = $total_dele * $rate_org;
	$dis = 0;	
	$temp_amt = 0;
	$mem_disc = 0;
	$gr_discount = 0;	
	$admin_discount = 0;
	$tax= 0;
	$total= 0;
	$main_amt = 0;
	$amt = 0;
	$temp_sess_sp_msg = "";
	
	if($amtsel == 0)
	{
		session_destroy();
		echo "<script language='javascript'>alert('Very rare condition occures. Please try after 30 sec.');</script>";
		echo "<script language='javascript'>window.location='pay_registrations.php';</script>";
		exit;
	}
	
	
	mysqli_query($link,"insert into ".$EVENT_DB_FORM_REG_DEMO."(org,org_reg_type,nationality,cata,curr,gr_type,sub_delegates,paymode,pay_status,amt_ext,amt_per_del,selection_amt,total,reg_id,reg_date,reg_time,sp_msg,dollar,membership_name,ticket_type,addr1,amt1) values ('$org','$cata_m','$nationality','Conference Delegate','$curr','$grp','$total_dele','$paymode','$pay_status','$amt_ext','$rate_org','$amtsel','$amt','$reg_id','$ddate','$ttime','$temp_sess_sp_msg','$dollar','$spl_delegate_asso_type','$temp_ticket_type','$address',$amtsel)")or die(mysqli_error($link));
	
	
	$qry = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	$res = mysqli_fetch_array($qry);
	
	//----------------------------------------- End Geneating Tin Number ----------------------------------------------------
	
	
	
	if($cata == "Complimentary Exhibitors Delegate"){		
		
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-EXHC-";
	}
	else if($cata == "Complimentary Sponsor Delegate"){	
		
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-SPOC-";
	}
	else if($cata == "Complimentary Speaker Delegate"){
	
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-SPKC-";
	}
	else if($cata == "Complimentary Invitee Delegate"){
	
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-INVC-";
	}
	else{
		
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-";
	}
	
	$tin_no = $EVENT_DB_TIN_NO;
	$tin_no1 = "";
	
	$i = 0;
	$j = 0;
	
	$temp_srno_gt = $res['srno'];
	do
	{
		$i = 0;
		$j = 0;
	
		$tin_no1 = $tin_no.$temp_srno_gt.mt_rand(1,99999);
		
		$qry = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE tin_no = '$tin_no1'");
		$res_no = mysqli_num_rows($qry);
		
		$qry1 = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE tin_no = '$tin_no1'");
		$res_no1 = mysqli_num_rows($qry1);
		
		
		if( ($res_no == 0 ) || ($res_no1 == 0))
		{
			$i++;
			$j++;
						
		}		
		else 
		{
			$i = 0;
			$j = 0;
			$tin_no1 = "";					
		}
		
	}while( ($i<=0) || ($j<=0) );
	
	//------------------------------------------ End Geneating Tin Number ----------------------------------------------------

	$pin_no1 = str_replace("TIN","PRN",$tin_no1);
	$pin_no1 = "";

	if($res['gr_type'] == "Single")
	{
		
		$main_amt = $res['selection_amt']; 
		$amt_per_del = $main_amt;
		//echo $main_amt; exit;
		
/*		if($spl_type == "Members Of Supporting Associations"){
			
			if($spl_delegate_asso_type != ""){
				$mem_disc = round( (($main_amt * 10) / 100) ); 
				
			}
		}*/
		
/*		$main_amt = $main_amt - $admin_discount - $mem_disc;	
		if($res['org_reg_type'] == "Poster"){
			
			$tax = 0;
			$admin_discount = 0;
			$mem_disc = 0;
			
			$total = $res['selection_amt'] + $tax - $admin_discount - $mem_disc;
			$total = round($total);
		
		}
		else
		{*/
			$tax = 12.36;
			$admin_discount = 0;
			$mem_disc = 0;
						
			$tax = round((($main_amt * 12.36) / 100));
			$total = $res['selection_amt'] + $tax - $admin_discount - $mem_disc;
			$total = round($total);
		
		//}	
		
	
	}
	else if($res['gr_type'] == "Group")
	{
		
		$main_amt = $res['selection_amt']; 
		$mem_disc = 0;
		$main_amt = $main_amt - $admin_discount;
		if(($cata=="Standard")||($cata=="Small Scale Industry / Government and R&D Institutes")||($cata=="Nutritionists / Dieticians / Doctors / Academia")||($cata=="Students"))
		{			
			//$gr_discount = round( (($main_amt * 10) / 100) ); 
			$gr_discount =0;
		}	
		else
		{
			$gr_discount = 0;
		}
		$main_amt = $main_amt - $gr_discount;
		$amt_per_del = $rate_org;
		
/*		if($res['org_reg_type'] == "Poster"){
			
			$tax = 0;
			$admin_discount = 0;
			$gr_discount = 0;
			
			$total = $res['selection_amt'] + $tax - $admin_discount - $gr_discount;
			$total = round($total);
			
		} 
		else{	*/		
			//$tax = round((($main_amt * 12.36) / 100));
			$tax =0;
			$total = $res['selection_amt'] + $tax - $admin_discount - $gr_discount;
			$total = round($total);		
		//}
		 
		
		
	}
	/*if($total == 0)
	{
		echo "<script language='javascript'>alert('Very rare condition occures. Please try after 30 sec..');</script>";
		mysqli_query($link,"DELETE FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		session_destroy();
		echo "<script language='javascript'>window.location='pay_registrations.php?cata_type=$cata_type';</script>";
		exit;
	}*/
	
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET amt_per_del = '$amt_per_del' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET gr_discount = '$gr_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET admin_discount = '$admin_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET tax = '$tax' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET total = '$total' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET membership_discount = '$mem_disc' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));	
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET tin_no = '$tin_no1' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET pin_no = '$pin_no1' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	
	
	
/*	
	require "dbcon_open.php";
		
	$qr = mysqli_query($link,"INSERT INTO $RSVP_COMP_REG_TBL_NAME(name,org,desig,email,mob,reg_id,participant,comment,ddate,ttime,event_identity) VALUES('$name','$org','$desig','$email','$mob','$ses','$participant','$comment','$ddate','$ttime','MysoreEvent_2013-08-07')") or die(mysqli_error($link));
*/	
	
	
	$amt_per_user = "";
	$gr_cata_name = "";
	$total_amt_per_dele ="";
	
	//------------------------------------------------ please ask it you want  ot change code below -------------------------------------------------------------------------------------------	
	//------------------------------------------------ please ask it you want  ot change code below -------------------------------------------------------------------------------------------	
	//------------------------------------------------ please ask it you want  ot change code below -------------------------------------------------------------------------------------------	
	//------------------------------------------------ please ask it you want  ot change code below -------------------------------------------------------------------------------------------	
	
	for($i=1; $i<= $lmt; $i++)
	{	
			$a1 = "title".$i; 
			$a2 = "fname".$i;
			$a_mname = "mname".$i;
			$a3 = "lname".$i;
			$a5 = "job_title".$i;
			$a6 = "badge".$i;
			$a7 = "email".$i;
			$a8 = "cellno".$i;
			$a9 = "cata".$i;
			$a10 = "amt".$i;
			$title = @$_POST['title'.$i];
			$title = trim($title);
			
			
	
	
	
	
			$comment = addslashes(@$_POST["comment"]);
	
			$fname = @$_POST['fname'.$i];
			$fname = trim($fname);
			
			$lname = @$_POST['lname'.$i];
			$lname = trim($lname);
			
			$job_title = @$_POST['desig'];
			$job_title = trim($job_title);
			
			$badge = $title." ".$fname." ".$lname;
			$badge = trim($badge);
			
			$email = @$_POST['email'];
			$email = trim($email);
			
			$cellno =@$_POST["mob"];
			$amt_per_dele = $res['amt_per_del'];
			
			
			
			$pas1=$fname."123";
			$pas2=md5($pas1);
		
			
			if( ($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == "")  )
			{
				echo "<script language='javascript'>alert('provided all required details of all $lmt delegates.');</script>";
				echo "<script language='javascript'>window.location='reg_registrations5.php?cata_type=$cata_type';</script>";
				exit;	
			}	
			
			
			//$cata = $res['cata']." - ".$cata_per_dele;			
			
			$cata = $cata;
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
		
		$tax = round((( ($amt_payable - $gr_discount) * 12.36) / 100));	// calculating tax
			
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
	$res = $qr_gt_user_data_ans_row;
	$temp_receiver_org = $qr_gt_user_data_ans_row['org'];
	
	if($qr_gt_user_data_ans_row['amt_ext'] != "Rs.")
	{
		$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];	
	}
	else
	{
		$total_amt = $qr_gt_user_data_ans_row['total'];		
	}		

	
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
			
				$usr_no = "it2013_nrm_";
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
				$dele_job_title = $qr_gt_user_data_ans_row['job_title'.$i];
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
				
				if($delegate != "Students"){
					
				
				
			//------------------------------------------------- Inserting Values in interlinx registration table --------------------------------------
				mysqli_query($link,"INSERT INTO ".$EVENT_DB_FORM_INTERLINX_REG_TBL."(user_id,dup_user_id,title,fname,lname,birth_date,sex,addr1,addr2,city,state,country,pin,web_site,pri_email,sec_email,org_name,desig,mob_cntry_code,mob_number,hm_ph_cntry_code,hm_ph_area_code,hm_ph_number,fax_cntry_code,fax_area_code,fax_number,reg_cata,intr1,intr2,intr3,intr4,intr5,intr6,intr7,intr8,intr9,intr10,intr11,intr12,intr13,intr14,intr15,intr16,intr17,intr18,intr19,user_name,pass1,pass2,vercode,photo,org_profile,inx_reg_date,inx_reg_time,tin_no,intr_other) values ('$usr_no1','$user_id_md5','$dele_title','$dele_fname','$dele_lname','','','$qr_gt_user_data_ans_row[addr1]','$qr_gt_user_data_ans_row[addr2]','$qr_gt_user_data_ans_row[city]','$qr_gt_user_data_ans_row[state]','$qr_gt_user_data_ans_row[country]','$qr_gt_user_data_ans_row[pin]','','$dele_email','','$qr_gt_user_data_ans_row[org]','$dele_job_title','','$dele_cellno','$temp_qr_gt_user_data_ans_row_fone_arr[0]','$temp_qr_gt_user_data_ans_row_fone_arr[1]','$temp_qr_gt_user_data_ans_row_fone_arr[2]','$temp_qr_gt_user_data_ans_row_fax_arr[0]','$temp_qr_gt_user_data_ans_row_fax_arr[1]','$temp_qr_gt_user_data_ans_row_fax_arr[2]','','$qr_gt_user_data_ans_row[intr1]','$qr_gt_user_data_ans_row[intr2]','$qr_gt_user_data_ans_row[intr3]','$qr_gt_user_data_ans_row[intr4]','$qr_gt_user_data_ans_row[intr5]','$qr_gt_user_data_ans_row[intr6]','$qr_gt_user_data_ans_row[intr7]','$qr_gt_user_data_ans_row[intr8]','$qr_gt_user_data_ans_row[intr9]','$qr_gt_user_data_ans_row[intr10]','$qr_gt_user_data_ans_row[intr11]','$qr_gt_user_data_ans_row[intr12]','$qr_gt_user_data_ans_row[intr13]','$qr_gt_user_data_ans_row[intr14]','$qr_gt_user_data_ans_row[intr15]','$qr_gt_user_data_ans_row[intr16]','$qr_gt_user_data_ans_row[intr17]','$qr_gt_user_data_ans_row[intr18]','','$dele_email','$pas1_inx','$pas2_inx','$qr_gt_user_data_ans_row[reg_id]','uploads/default_file.jpg','','$qr_gt_user_data_ans_row[reg_date]','$qr_gt_user_data_ans_row[reg_time]','$qr_gt_user_data_ans_row[tin_no]','')") or die(mysqli_error($link));
				
				
				// OLD Date & time mysqli_query($link,"insert  into `".$EVENT_DB_FORM_ALL_USERS_SCHEDULE."` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-12-04','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL)")or die(mysqli_error($link));

				//2013-10-22 is hide due to utsav email
				//mysqli_query($link,"insert  into `".$EVENT_DB_FORM_ALL_USERS_SCHEDULE."` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-22','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)")or die(mysqli_error($link));
				
				
				mysqli_query($link,"insert  into `".$EVENT_DB_FORM_ALL_USERS_SCHEDULE."` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-23','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)")or die(mysqli_error($link));
	
	mysqli_query($link,"insert  into `".$EVENT_DB_FORM_ALL_USERS_SCHEDULE."` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','17:00:00 pm','17:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-10-24','17:30:00 pm','18:00:00 pm',NULL,'',NULL,NULL)")or die(mysqli_error($link));
	
	
	//mysqli_query($link,"insert  into `".$EVENT_DB_FORM_ALL_USERS_SCHEDULE."` (`req_date`,`req_time`,`sender_id`,`sender_title`,`sender_fname`,`sender_lname`,`sender_org`,`sender_desig`,`sender_org_profile`,`sender_email`,`receiver_id`,`receiver_title`,`receiver_fname`,`receiver_lname`,`receiver_org`,`receiver_desig`,`receiver_org_profile`,`receiver_email`,`req_type`,`meeting_date`,`meeting_time_start`,`meeting_time_end`,`message`,`status`,`read_flag`,`table_no`) values (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','10:00:00 am','10:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','10:30:00 am','11:00:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','11:00:00 am','11:30:00 am',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','11:30:00 am','12:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','12:00:00 pm','12:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','12:30:00 pm','13:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','13:00:00 pm','13:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','13:30:00 pm','14:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','14:00:00 pm','14:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','14:30:00 pm','15:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','15:00:00 pm','15:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','15:30:00 pm','16:00:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','16:00:00 pm','16:30:00 pm',NULL,'',NULL,NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$usr_no1','$test_title','$test_fname','$test_lname','$temp_receiver_org',NULL,NULL,'$test_email',NULL,'2013-03-16','16:30:00 pm','17:00:00 pm',NULL,'',NULL,NULL)")or die(mysqli_error($link));
	 
	//---------------------------------------------- End Inserting Values in Database --------------------------------------
	
				
		//------------------------------------------------- end Inserting Values in interlinx registration table --------------------------------------
		
			
		//------------------------------------------------- Start Interlinx Email  --------------------------------------
		
		$recipients = array('utsav.activ@gmail.com',$dele_email,'test.interlinks@gmail.com');
			
		include "reg_emailer_interlinx_un.php";
/*
		if($temp_lg_st != "N02MA34D"){
		
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server 
			$mail->FromName = $EVENT_NAME;
			$mail->From = $EVENT_ENQUIRY_EMAIL;
			$mail->Subject = "Registration Details Of ".$EVENT_NAME." ".$EVENT_YEAR." InterlinX ";
			$mail->IsHTML(true);
			$mail->Body = $reg_interlinx_mail_body_login;
			foreach($recipients as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   
				}
				$mail->clearAddresses();
			}
		
		
		}
		
	*/
		
		if($temp_lg_st != "N02MA34D"){
			
			$temp_p_email = $EVENT_ENQUIRY_EMAIL;
			$temp_p_name = $EVENT_NAME;	
			$str_career = "Registration Details Of ".$EVENT_NAME." ".$EVENT_YEAR." InterlinX ";
			$str_career_bdy = $reg_interlinx_mail_body_login;
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
			
			foreach($recipients as $emailid)
			{
				if(mail($emailid,$str_career,$str_career_bdy,$headers))
				{
					//echo "<br />mail successful : 1<br />";
				}
				else
				{
						//echo "<br />mail failed : 1<br />";
				}
			
			}
			
		}
		
		}
		
		//------------------------------------------------- End Interlinx Email  --------------------------------------
		
		}
		
	}	
	
	
	
	
	
	
	
	
	
	//user	
	
		
		
		$lmt = $qr_gt_user_data_ans_row['sub_delegates'];
		switch($lmt)
		{
				case 1	:	$recipients = array('kaustubh.mmactiv@gmail.com','enquiry@bangaloreite.biz','accounts@mmactiv.in','test.interlinks@gmail.com','utsav.activ@gmail.com',$qr_gt_user_data_ans_row['email1']);
							break;
				case 3	:	$recipients = array('kaustubh.mmactiv@gmail.com','enquiry@bangaloreite.biz','accounts@mmactiv.in','test.interlinks@gmail.com','utsav.activ@gmail.com',$qr_gt_user_data_ans_row['email1'],$qr_gt_user_data_ans_row['email2'],$qr_gt_user_data_ans_row['email3']);
							break;
				case 4	:	$recipients = array('kaustubh.mmactiv@gmail.com','enquiry@bangaloreite.biz','accounts@mmactiv.in','test.interlinks@gmail.com','utsav.activ@gmail.com',$qr_gt_user_data_ans_row['email1'],$qr_gt_user_data_ans_row['email2'],$qr_gt_user_data_ans_row['email3'],$qr_gt_user_data_ans_row['email4']);
							break;
				case 5	:	$recipients = array('kaustubh.mmactiv@gmail.com','enquiry@bangaloreite.biz','accounts@mmactiv.in','test.interlinks@gmail.com','utsav.activ@gmail.com',$qr_gt_user_data_ans_row['email1'],$qr_gt_user_data_ans_row['email2'],$qr_gt_user_data_ans_row['email3'],$qr_gt_user_data_ans_row['email4'],$qr_gt_user_data_ans_row['email5']);
							break;
				case 6	:	$recipients = array('kaustubh.mmactiv@gmail.com','enquiry@bangaloreite.biz','accounts@mmactiv.in','test.interlinks@gmail.com','utsav.activ@gmail.com',$qr_gt_user_data_ans_row['email1'],$qr_gt_user_data_ans_row['email2'],$qr_gt_user_data_ans_row['email3'],$qr_gt_user_data_ans_row['email4'],$qr_gt_user_data_ans_row['email5'],$qr_gt_user_data_ans_row['email6']);
							break;
				case 7	:	$recipients = array('kaustubh.mmactiv@gmail.com','enquiry@bangaloreite.biz','accounts@mmactiv.in','test.interlinks@gmail.com','utsav.activ@gmail.com',$qr_gt_user_data_ans_row['email1'],$qr_gt_user_data_ans_row['email2'],$qr_gt_user_data_ans_row['email3'],$qr_gt_user_data_ans_row['email4'],$qr_gt_user_data_ans_row['email5'],$qr_gt_user_data_ans_row['email6'],$qr_gt_user_data_ans_row['email7']);
							break;
				
				default	:	$recipients = array('kaustubh.mmactiv@gmail.com','enquiry@bangaloreite.biz','accounts@mmactiv.in','test.interlinks@gmail.com','utsav.activ@gmail.com');
							break;			
		}
 


		require "pay_registrations_emailer.php";
/*
		if($temp_lg_st != "N02MA34D"){
		
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server 
			$mail->FromName = $EVENT_NAME;
			$mail->From = $EVENT_ENQUIRY_EMAIL;
			$mail->Subject = "Thanks for Registering on ".$EVENT_NAME;
			$mail->IsHTML(true);
			$mail->Body = $rsvp_registration_mail_body;
			foreach($recipients as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   
				}
				$mail->clearAddresses();
			}
		
		
		}
		*/
	
		
		if($temp_lg_st != "N02MA34D"){
			
			$temp_p_email = $EVENT_ENQUIRY_EMAIL;
			$temp_p_name = $EVENT_NAME;	
			$str_career = "Thanks for Registering on ".$EVENT_NAME;
			$str_career_bdy = $rsvp_registration_mail_body;
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
			
			foreach($recipients as $emailid)
			{
				if(mail($emailid,$str_career,$str_career_bdy,$headers))
				{
					//echo "<br />mail successful : 1<br />";
				}
				else
				{
						//echo "<br />mail failed : 1<br />";
				}
			
			}
			
		}
		
		
		
		
	
	
	echo "<script language='javascript'>window.location = 'pay_3_registrations.php?nm=$name&enq_emler=rsvp&cata_type=$cata_type';</script>";	
	exit;
	
	
?>
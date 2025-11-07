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
	
	$reg_id = $_SESSION['vercode_reg'];	
	
	
	$exhi_log = @$_REQUEST['exhi_log'];
	
	$exhi = @$_REQUEST['exhi'];
	$exhibitor_id = "";
	if($exhi== "E34XH3IDf6gyy77"){
		$exhibitor_id = $_REQUEST['exhibitor_id'];
	
	
	$qr_chk_exbhi = "Select * from ".$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS." where exhibitor_id = '$exhibitor_id' ";
	$qr_chk_exbhi_id = mysqli_query($link,$qr_chk_exbhi);
	$qr_chk_exbhi_num_rows = "";
	$qr_chk_exbhi_num_rows = mysqli_num_rows($qr_chk_exbhi_id);
	
	$qr_chk_exbhi_id = mysqli_query($link,$qr_chk_exbhi);
	$qr_chk_exbhi_ans_rows = mysqli_fetch_array($qr_chk_exbhi_id);
	
		if(($qr_chk_exbhi_num_rows == 0) || ($qr_chk_exbhi_ans_rows['exhibitor_id'] != $exhibitor_id))
		{
			session_destroy();
			echo "<script language='javascript'>alert('Please get register as a exhibitor on online exhibitor form.');</script>";
			echo "<script language='javascript'>window.location = '".$EVENT_DB_EXHI_DIR_REG_LINK."';</script>";
			exit;
		}
	
	}
	
	/*****
	Organisation Details
	*****/
	
	$cp_name = $_POST['cp_name_title']." ".$_POST['cp_name_fname']." ".$_POST['cp_name_lname'];
	$cp_email = @$_POST['cp_email'];
	//$cp_name = "";
	//$cp_email = "";
	$nature = @$_POST['nature'];
	$org = @$_POST['org'];
	$addr1 = @$_POST['addr1'];
	$addr2 = @$_POST['addr2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$pin = $_POST['pin'];
	$fone = $_POST['country_code1']."-".$_POST['std1']."-".$_POST['fone'];
	$fax = @$_POST['country_code2']."-".@$_POST['std2']."-".@$_POST['fax'];
	
	if( ($org == "") || ($addr1 == "") || ($city == "")  || ($state == "")  || ($country == "")  || ($pin == "") || (@$_POST['std1'] == "") || (@$_POST['fone'] == "") || ($_POST['country_code1'] == "") ){
		
		echo "<script language='javascript'>alert('provided all required (* marked) details .');</script>";
		echo "<script language='javascript'>window.location = 'reg_registrations3_comp.php?exhi=$exhi&exhibitor_id=$exhibitor_id';</script>";
		exit; 
	}
	
	
	
//--------------------------------------------------- Start  checking exhibitor -----------------------------------------------------------------------	

	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//echo "SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'"."<br />";
	
	$qr_gt_user_data_ans_no = 0;
	$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
	if( ($qr_gt_user_data_ans_no<=0) || ($qr_gt_user_data_ans_no=="") ){
		session_destroy();
		echo "<script language='javascript'>alert('Problem in Connection.......please try again.');</script>";
		echo "<script language='javascript'>window.location=('reg_registrations_comp.php?exhi=$exhi&exhibitor_id=$exhibitor_id');</script>";
		echo "<script language='javascript'>document.location=('reg_registrations_comp.php?exhi=$exhi&exhibitor_id=$exhibitor_id');</script>";
		exit; 
	}	
	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
	
	
	
	if($qr_gt_user_data_ans_row['cata'] == "Complimentary Exhibitors Delegate"){
	
	
	$temp_org_cap = strtoupper($org);
	
	$qr_chk_exbhi = "Select * from ".$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS." where UPPER(exhibitor_name) = '$temp_org_cap' ";
	//echo $qr_chk_exbhi."<br />";
	//echo $temp_org_cap."<br />";
	//exit;
	
	$qr_chk_exbhi_id = mysqli_query($link,$qr_chk_exbhi);
	$qr_chk_exbhi_num_rows = "";
	$qr_chk_exbhi_num_rows = mysqli_num_rows($qr_chk_exbhi_id);
	
	if(($qr_chk_exbhi_num_rows == 0) || ($qr_chk_exbhi_num_rows == ""))
	{
		session_destroy();
		echo "<script language='javascript'>alert('Please get register as a exhibitor on online exhibitor form.');</script>";
		echo "<script language='javascript'>window.location = '".$EVENT_DB_EXHI_DIR_REG_LINK."';</script>";
		exit;
	}
	
			
		$temp_org_cap = strtoupper($org);
		
		$qr_chk_exbhi = "Select * from ".$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS." where UPPER(exhibitor_name) = '$temp_org_cap' ";
		$qr_chk_exbhi_id = mysqli_query($link,$qr_chk_exbhi);
		$qr_chk_exbhi_ans_rows = mysqli_fetch_array($qr_chk_exbhi_id);
		
		//echo $qr_chk_exbhi_ans_rows['booth_area']."<br />";
		
		$temp_booth_area = $qr_chk_exbhi_ans_rows['booth_area'];
		
		if(($temp_booth_area==4) || ($temp_booth_area==6) ){
	 	
		$total_exbhitors = 1;
	 
		 
		 }
		 else{
		 
			$total_exbhitors = (round($temp_booth_area/9)*2);
		 
		 }
		
		
		
		if(($temp_booth_area<4) ){
			session_destroy();
			echo "<script language='javascript'>alert('Please Contact Admin As Exhibitor booth area is below 4sqm..');</script>";
			mysqli_query($link,"delete from ".$EVENT_DB_FORM_REG_DEMO." where reg_id = '$reg_id' ") or die(mysqli_error($link));
			echo "<script language='javascript'>window.location = 'reg_registrations_comp.php';</script>";
			exit;	
		}
		
		$temp_total_exbhitors=$total_exbhitors;
		
		$total_exbhitors_max_flag = "";	 
		
		if($total_exbhitors >7){	
			$total_exbhitors = 7;
			$total_exbhitors_max_flag = "True";	
		}
		
		//echo $total_exbhitors."<br />";
		$temp_already_reg_users = 0;
		
		$temp_org_cap = strtoupper($org);
		
		$qr_gt_user_data_mdata_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE UPPER(org) = '$temp_org_cap' ")or die(mysqli_error($link));
		$qr_gt_user_data_mdata_no = 0;
		$qr_gt_user_data_mdata_no = mysqli_num_rows($qr_gt_user_data_mdata_id);
		if( ($qr_gt_user_data_mdata_no<=0) || ($qr_gt_user_data_mdata_no=="") ){
			
		}else{
			 
			$qr_gt_user_data_mdata_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE UPPER(org) = '$temp_org_cap' ")or die(mysqli_error($link));
			//echo "SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE UPPER(org) = '$temp_org_cap'"; exit;
			while($qr_gt_user_data_mdata_ans_row = mysqli_fetch_array($qr_gt_user_data_mdata_id)){
				$temp_already_reg_users = $temp_already_reg_users + $qr_gt_user_data_mdata_ans_row['sub_delegates'];
			}
			
			//$total_exbhitors = $total_exbhitors - $temp_already_reg_users;
		
		}	
		//echo $temp_already_reg_users."<br />";
	//	exit;
		if($total_exbhitors<=0)
		{
			session_destroy();
			echo "<script language='javascript'>alert('Allocated Exhibitor Delegates are over. please contact admin..');</script>";
			mysqli_query($link,"delete from ".$EVENT_DB_FORM_REG_DEMO." where reg_id = '$reg_id' ") or die(mysqli_error($link));
			echo "<script language='javascript'>window.location = 'reg_registrations_comp.php';</script>";
			exit;		
		}
	
		if($total_exbhitors > 1){
			$gr_type = "Group";
		} 
		else if($total_exbhitors == 1){
			$gr_type = "Single";
		}
		
		
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET gr_type = '$gr_type' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET sub_delegates = '$total_exbhitors' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		//echo "UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET sub_delegates = '$total_exbhitors' WHERE reg_id = '$reg_id'<br />";
	}
	//exit;
	//--------------------------------------------------- End checking exhibitor -----------------------------------------------------------------------
	
	 
	
	$gst_number = $_POST['gst_number'];
	
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cp_name='$cp_name',cp_email='$cp_email',nature='$nature',org='$org',addr1='$addr1',addr2='$addr2',city='$city',state='$state',country='$country',pin='$pin',fone='$fone',fax='$fax', gst_number='$gst_number' WHERE reg_id = '$reg_id' ") or die(mysqli_error($link));
	
	
	
	
	echo "<script language='javascript'>window.location = 'reg_registrations5_comp.php';</script>";
		
	exit; 
?>
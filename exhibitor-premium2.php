<?php
	session_start();  
	//print_r($_POST);exit;
    if (empty($_SESSION["vercode_ex"]) || ($_POST["vercode_ex"] != $_SESSION["vercode_ex"])) {
        session_destroy();
        echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
        echo "<script language='javascript'>window.location = 'exhibitor-premium.php';</script>";
        exit;
    }
    
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	 
	$reg_id = $_SESSION['vercode_ex'];	
	
	$_SESSION['sess_subsector'] = $temp_exhi_subsector = @$_POST ['subsector'];
	if($temp_exhi_subsector == 'Other') {
		$temp_exhi_subsector = 'Other -' . $_POST ['other-sector'];
		$_SESSION ['sess_other_sector'] = $_POST ['other-sector'];
	}
	$_SESSION['sess_sector'] = $temp_exhi_sector = @$_POST ['sector'];
	
	$eventName = 'BengaluruITE.BIZ';
	$event_name = 'Bangalore IT';
	/*if($temp_exhi_sector == 'Bio Technology') {
		$eventName = 'Bengaluru INDIA BIO';
		$event_name = 'Bangalore INDIA BIO';
	}*/
	$curr = @$_POST ['curr'];
	$assoc_nm = @$_POST ['assoc_nm'];

	$temp_exhi_sector = trim ( $temp_exhi_sector );
	
	$temp_exhi_name = @$_POST ['exhi_name'];
	
	$temp_cp_title = @$_POST ['cp_title'];
	$temp_cp_title = trim ( $temp_cp_title );
	
	$temp_cp_fname = @$_POST ['cp_fname'];
	$temp_cp_fname = mysqli_real_escape_string($link,trim ( $temp_cp_fname ));
	
	$temp_cp_lname = @$_POST ['cp_lname'];
	$temp_cp_lname = mysqli_real_escape_string($link,trim ( $temp_cp_lname ));
	
	$temp_addr1 = mysqli_real_escape_string($link,@$_POST ['addr1']);
	$temp_addr2 = mysqli_real_escape_string($link,@$_POST ['addr2']);
	$temp_city = @$_POST ['city'];
	$temp_state = @$_POST ['state'];
	$temp_country = @$_POST ['country'];
	$temp_zip = @$_POST ['zip'];
	$temp_fon_cntry = @$_POST ['foneCountryCode'];
	$temp_fon = @$_POST ['fon'];
	$temp_mob_cntry = @$_POST ['cellnoCountryCode'];
	$temp_mob = @$_POST ['mob'];
	$temp_email = @$_POST ['email'];
	$temp_email = strtolower ( trim ( $temp_email ) );
	$temp_reg_date = date ( "Y-m-d" );
	$temp_reg_time = date ( "H:i:s a" );
	$temp_reg_id = @$_POST ['vercode_ex'];
	$temp_gst_number = @$_POST ['gst_number'];
	
	$temp_del_title = @$_POST ['del_title1'];
	$temp_del_title = trim ( $temp_del_title );
	
	$temp_del_fname = @$_POST ['del_fname1'];
	$temp_del_fname = trim ( $temp_del_fname );
	
	$temp_del_lname = @$_POST ['del_lname1'];
	$temp_del_lname = trim ( $temp_del_lname );
	$temp_del_mob_cntry = @$_POST ['del_cellnoCountryCode1'];
	$temp_del_mob = @$_POST ['del_mob1'];
	$temp_del_email = @$_POST ['del_email1'];
	
	$temp_del_title2 = @$_POST ['del_title2'];
	$temp_del_title2 = trim ( $temp_del_title2 );	
	$temp_del_fname2 = @$_POST ['del_fname2'];
	$temp_del_fname2 = trim ( $temp_del_fname2 );	
	$temp_del_lname2 = @$_POST ['del_lname2'];
	$temp_del_lname2 = trim ( $temp_del_lname2 );
	$temp_del_mob_cntry2 = @$_POST ['del_cellnoCountryCode2'];
	$temp_del_mob2 = @$_POST ['del_mob2'];
	$temp_del_email2 = @$_POST ['del_email2'];
	
	$temp_del_title3 = @$_POST ['del_title3'];
	$temp_del_title3 = trim ( $temp_del_title3 );
	$temp_del_fname3 = @$_POST ['del_fname3'];
	$temp_del_fname3 = trim ( $temp_del_fname3 );
	$temp_del_lname3 = @$_POST ['del_lname3'];
	$temp_del_lname3 = trim ( $temp_del_lname3 );
	$temp_del_mob_cntry3 = @$_POST ['del_cellnoCountryCode3'];
	$temp_del_mob3 = @$_POST ['del_mob3'];
	$temp_del_email3 = @$_POST ['del_email3'];

	$temp_del_title4 = @$_POST ['del_title4'];
	$temp_del_title4 = trim ( $temp_del_title4 );
	$temp_del_fname4 = @$_POST ['del_fname4'];
	$temp_del_fname4 = trim ( $temp_del_fname4 );
	$temp_del_lname4 = @$_POST ['del_lname4'];
	$temp_del_lname4 = trim ( $temp_del_lname4 );
	$temp_del_mob_cntry4 = @$_POST ['del_cellnoCountryCode4'];
	$temp_del_mob4 = @$_POST ['del_mob4'];
	$temp_del_email4 = @$_POST ['del_email4'];
	
	$temp_del_title5 = @$_POST ['del_title5'];
	$temp_del_title5 = trim ( $temp_del_title5 );
	$temp_del_fname5 = @$_POST ['del_fname5'];
	$temp_del_fname5 = trim ( $temp_del_fname5 );
	$temp_del_lname5 = @$_POST ['del_lname5'];
	$temp_del_lname5 = trim ( $temp_del_lname5 );
	$temp_del_mob_cntry5 = @$_POST ['del_cellnoCountryCode5'];
	$temp_del_mob5 = @$_POST ['del_mob5'];
	$temp_del_email5 = @$_POST ['del_email5'];
	
	$temp_del_title6 = @$_POST ['del_title6'];
	$temp_del_title6 = trim ( $temp_del_title6 );
	$temp_del_fname6 = @$_POST ['del_fname6'];
	$temp_del_fname6 = trim ( $temp_del_fname6 );
	$temp_del_lname6 = @$_POST ['del_lname6'];
	$temp_del_lname6 = trim ( $temp_del_lname6 );
	$temp_del_mob_cntry6 = @$_POST ['del_cellnoCountryCode6'];
	$temp_del_mob6 = @$_POST ['del_mob6'];
	$temp_del_email6 = @$_POST ['del_email6'];

	//Partner
	$temp_part_title = @$_POST ['part_title'];
	$temp_part_title = trim ( $temp_part_title );
	
	$temp_part_fname = @$_POST ['part_fname'];
	$temp_part_fname = trim ( $temp_part_fname );
	
	$temp_part_lname = @$_POST ['part_lname'];
	$temp_part_lname = trim ( $temp_part_lname );
	$temp_part_mob_cntry = @$_POST ['part_cellnoCountryCode'];
	$temp_part_mob = @$_POST ['part_mob'];
	$temp_part_email = @$_POST ['part_email'];

	$paymode = $temp_paymode = @$_POST ['paymode'];
	
	$_SESSION ['sess_curr'] = $curr;
	$_SESSION ['sess_exhi_name'] = $temp_exhi_name;
	$_SESSION ['sess_cp_title'] = $temp_cp_title;
	$_SESSION ['sess_cp_fname'] = $temp_cp_fname;
	$_SESSION ['sess_cp_lname'] = $temp_cp_lname;
	$_SESSION ['sess_email'] = $temp_email;
	$_SESSION ['sess_mobile'] = $temp_mob;
	$_SESSION ['sess_addr1'] = $temp_addr1;
	$_SESSION ['sess_addr2'] = $temp_addr2;
	$_SESSION ['sess_city'] = $temp_city;
	$_SESSION ['sess_state'] = $temp_state;
	$_SESSION ['sess_country'] = $temp_country;
	$_SESSION ['sess_zip'] = $temp_zip;	
	$_SESSION ['sess_foneCountryCode'] = $temp_fon_cntry;
	$_SESSION ['sess_fon'] = $temp_fon;
	$_SESSION ['sess_cellnoCountryCode'] = $temp_mob_cntry;
	$_SESSION ['sess_mob'] = $temp_mob;
	$_SESSION ['sess_vercode_ex'] = $temp_reg_id;
	$_SESSION ['vercode_ex'] = $temp_reg_id;
	$_SESSION ['sess_paymode'] = $temp_paymode;
	$_SESSION ['gst'] = @$_POST ['gst'];
	$_SESSION ['pan_number'] = $pan_number = @$_POST ['pan_number'];
	$_SESSION ['booth_size'] = $booth_size = @$_POST ['booth_size'];
	$_SESSION ['assoc_nm'] = $assoc_nm;
	
	$_SESSION ['sess_del_title'] = $temp_del_title;
	$_SESSION ['sess_del_fname'] = $temp_del_fname;
	$_SESSION ['sess_del_lname'] = $temp_del_lname;
	$_SESSION ['sess_del_email'] = $temp_del_email;
	$_SESSION ['sess_del_mobile_cntry'] = $temp_del_mob_cntry;
	$_SESSION ['sess_del_mobile'] = $temp_del_mob;

	$_SESSION ['sess_part_title'] = $temp_part_title;
	$_SESSION ['sess_part_fname'] = $temp_part_fname;
	$_SESSION ['sess_part_lname'] = $temp_part_lname;
	$_SESSION ['sess_part_email'] = $temp_part_email;
	$_SESSION ['sess_part_mobile_cntry'] = $temp_part_mob_cntry;
	$_SESSION ['sess_part_mobile'] = $temp_part_mob;

	$gst=$_POST['gst'];
	$_SESSION ['gst_number'] = '';
	if($gst=='Registered'){
		$temp_gst_number = $_SESSION ['gst_number'] = $_POST['gst_number'];
	}else if($gst=='Unregistered'){
		$temp_gst_number = 'Not Applicable';
	}

	$temp_reg_date = date ( "Y-m-d" );
	$temp_reg_time = date ( "H:i:s" );
	
	$fone = '';
	if(!empty($_POST['fon'])) {
		$fone = $temp_fon_cntry."-".$temp_fon;
	}
	$mob = $temp_mob_cntry."-".$temp_mob;

	if( ($temp_exhi_name == "") || ($temp_addr1 == "") || ($temp_city == "")  || ($temp_state == "")  || ($temp_country == "")  || ($temp_zip == "") || ($temp_email == "") || ($temp_del_title == "") || ($temp_del_fname == "") || ($temp_del_lname == "") || ($temp_del_email == "") || ($temp_del_mob == "")){
		echo "<script language='javascript'>alert('Provided all required (* marked) details .');</script>";
		echo "<script language='javascript'>window.location = 'exhibitor-premium.php?rt=retds4fn324rn_ed24d3it';</script>";
		exit; 
	}

	$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE cp_email = '$temp_email'" ) or die ( mysqli_error ($link) );
	if (mysqli_num_rows ( $qr ) > 0) {
		echo "<script language='javascript'>alert('Entered contact perrson email address already registered with us. Please add another email address.');</script>";
		echo "<script language='javascript'>window.location = 'exhibitor-premium.php?rt=retds4fn324rn_ed24d3it';</script>";
	}

	for($j = 1; $j <= 7; $j ++) {
		$email = $temp_del_email;
		$field = "email" . $j;
		$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'" ) or die ( mysqli_error ($link) );
		if (mysqli_num_rows ( $qr ) > 0) {
			echo "<script language='javascript'>alert('Entered delegate email address already registered with us. Please add another delegate email address.');</script>";
			echo "<script language='javascript'>window.location = 'exhibitor-premium.php?rt=retds4fn324rn_ed24d3it';</script>";
		}
	}
	$ret = @$_GET['rt'];
	
	if ($ret == "retds4fn324rn_ed24d3it") {
		mysqli_query($link,"delete from " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " where reg_id = '$reg_id' ") or die(mysqli_error($link));
	}
	
	$processing_charge_per = $processing_charge = 0;
	/*if ($curr == "Indian") {
		$dollar      = "1";
		$amt_ext     = "Rs.";
		$selection_amt = "9999";
		$nationality = 'Indian';
		
		if($paymode == 'Credit Card') {
			$processing_charge_per = $CC_IND_PROCESSING_CHARGE_PER;
		}
	} else {
		$dollar      = $DOLLAR_RATE;
		$amt_ext     = "USD";
		$selection_amt = "150";
		$nationality = 'International';

		if($paymode == 'Paypal') {
			$processing_charge_per = $PAYPAL_PROCESSING_CHARGE_PER;
		} else if($paymode == 'Credit Card') {
			$processing_charge_per = $CC_INT_PROCESSING_CHARGE_PER;
		}
	}*/
	$selection_amt = "0";
	/*if($booth_size =='4 Sqm') {
		$selection_amt = 19999;
	} else { //if($booth_size =='6 Sqm') {
		$selection_amt = 34999;
	}*/
	//echo "UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET org='$org',addr1='$addr1',addr2='$addr2',city='$city',state='$state',country='$country',pin='$pin',fone='$fone',fax='$fax' WHERE reg_id = '$reg_id' ";
	mysqli_query($link,"INSERT INTO ".$EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO. "(sector,subsector,exhibitor_name,reg_id,reg_date,reg_time,user_type)".
			" VALUES('$temp_exhi_sector','$temp_exhi_subsector', '$temp_exhi_name','$reg_id','$temp_reg_date','$temp_reg_time','') ") or die(mysqli_error($link));
	
	/*$sql = "UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " SET cp_title='$temp_cp_title',cp_fname='$temp_cp_fname',
			cp_lname='$temp_cp_lname',cp_mobile='$mob',cp_email='$temp_email',addr1='$temp_addr1',addr2='$temp_addr2',city='$temp_city',
			state='$temp_state',country='$temp_country',zip='$temp_zip',phone='$fone',gst_number='$temp_gst_number',paymode='$temp_paymode',
			amt_ext='$amt_ext',pay_status='Not Paid',selection_amt='$selection_amt',total='$selection_amt',event_name='$event_name',dollar='$dollar',
			curr='$curr',nationality='$nationality', pan_number='$pan_number',booth_size='$booth_size' WHERE reg_id = '$reg_id'";*/
	
	$sql = "UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " SET cp_title='$temp_cp_title',cp_fname='$temp_cp_fname',
			cp_lname='$temp_cp_lname',cp_mobile='$mob',cp_email='$temp_email',addr1='$temp_addr1',addr2='$temp_addr2',city='$temp_city',
			state='$temp_state',country='$temp_country',zip='$temp_zip',phone='$fone',gst_number='$temp_gst_number',
			event_name='$event_name',dollar='$dollar',
			nationality='$curr', pan_number='$pan_number',booth_size='$booth_size' WHERE reg_id = '$reg_id'";
	mysqli_query($link,$sql);
	
	if(!empty($processing_charge_per)) {
		$total = $selection_amt;
		$processing_charge = round(($total * $processing_charge_per) / 100);
		$total = round ($total + $processing_charge);

		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO." SET total = '$total' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	}
	
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO." SET tax = '$tax' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));	

	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO." SET processing_charge_per = '$processing_charge_per' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO." SET processing_charge = '$processing_charge' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	
	$tin_no  = "TIN-BTS".$EVENT_YEAR."-EXH-";
	/*if($temp_exhi_sector == 'Bio Technology') {
		$tin_no = $EVENT_DB_TIN_NO="TIN-BIBEX".$EVENT_YEAR."-";
	}*/
	$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
	$res = mysqli_fetch_array($qry);
	
	$tin_no1 = "";
	
	$i = 0;
	$j = 0;
	
	$temp_srno_gt = $res['srno'];
	do {
		$i = $j = 0;
		 
		$tin_no1 = $tin_no . $temp_srno_gt . mt_rand(1, 99999);
		 
		$qry    = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE tin_no = '$tin_no1'");
		$res_no = mysqli_num_rows($qry);
		 
		$qry1    = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " WHERE tin_no = '$tin_no1'");
		$res_no1 = mysqli_num_rows($qry1);
		 
		if (($res_no == 0) || ($res_no1 == 0)) {
			$i++;
			$j++;
		} else {
			$i       = 0;
			$j       = 0;
			$tin_no1 = "";
		}
	} while (($i <= 0) || ($j <= 0));
	
	//------------------------------------------ End Geneating Tin Number ----------------------------------------------------
	$pin = str_replace('TIN', 'PIN', $tin_no1);
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " SET tin_no = '$tin_no1', pin_no = '$pin' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
	//exit;
	$reg_id = 'ex' . $reg_id;
	$pin_no = str_replace('TIN', 'PRN', $tin_no1);

	$sub_delegates = 2;
	if(!empty($temp_del_email2)) {
		$sub_delegates = 3;
	}
	if(!empty($temp_del_email3)) {
		$sub_delegates = 4;
	}
	if(!empty($temp_del_email4)) {
		$sub_delegates = 5;
	}
	if(!empty($temp_del_email5)) {
		$sub_delegates = 6;
	}
	if(!empty($temp_del_email6)) {
		$sub_delegates = 7;
	}
	
	mysqli_query($link,"insert into ".$EVENT_DB_FORM_REG_DEMO."(org_reg_type,nationality,curr,gr_type,sub_delegates,paymode,pay_status,amt_ext,reg_id,reg_date,reg_time,sector,tin_no,pin_no, cata,user_type) values 
	('','$nationality','$curr','Group','$sub_delegates','Complimentary','Complimentary','$amt_ext','$reg_id','$temp_reg_date','$temp_reg_time','$temp_exhi_sector','$tin_no1', '$pin_no', 'Complimentary Exhibitors Delegate','')")or die(mysqli_error($link));

	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET org='$temp_exhi_name',addr1='$temp_addr1',addr2='$temp_addr2',city='$temp_city',
	state='$temp_state',country='$temp_country',pin='$temp_zip',fone='$fone' WHERE reg_id = '$reg_id' ") or die(mysqli_error($link));


	$badge = $temp_del_title . ' ' . $temp_del_fname . ' ' . $temp_del_lname;
	$temp_del_mob = $temp_del_mob_cntry . '-' . $temp_del_mob;
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET title1 = '$temp_del_title' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET fname1 = '$temp_del_fname' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET lname1 = '$temp_del_lname' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET badge1 = '$badge' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET email1 = '$temp_del_email' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cellno1 = '$temp_del_mob' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cata1 = 'Conference Delegate' where reg_id = '$reg_id'") or die(mysqli_error($link));

	$badge2 = $temp_del_title2 . ' ' . $temp_del_fname2 . ' ' . $temp_del_lname2;
	$temp_del_mob2 = $temp_del_mob_cntry2 . '-' . $temp_del_mob2;
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET title3 = '$temp_del_title2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET fname3 = '$temp_del_fname2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET lname3 = '$temp_del_lname2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET badge3 = '$badge2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET email3 = '$temp_del_email2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cellno3 = '$temp_del_mob2' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cata3 = 'Conference Delegate' where reg_id = '$reg_id'") or die(mysqli_error($link));
	

	$badge3 = $temp_del_title3 . ' ' . $temp_del_fname3 . ' ' . $temp_del_lname3;
	$temp_del_mob3 = $temp_del_mob_cntry3 . '-' . $temp_del_mob3;
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET title4 = '$temp_del_title3' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET fname4 = '$temp_del_fname3' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET lname4 = '$temp_del_lname3' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET badge4 = '$badge3' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET email4 = '$temp_del_email3' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cellno4 = '$temp_del_mob3' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cata4 = 'Conference Delegate' where reg_id = '$reg_id'") or die(mysqli_error($link));
	

	$badge4 = $temp_del_title4 . ' ' . $temp_del_fname4 . ' ' . $temp_del_lname4;
	$temp_del_mob4 = $temp_del_mob_cntry4 . '-' . $temp_del_mob4;
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET title5 = '$temp_del_title4' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET fname5 = '$temp_del_fname4' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET lname5 = '$temp_del_lname4' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET badge5 = '$badge4' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET email5 = '$temp_del_email4' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cellno5 = '$temp_del_mob4' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cata5 = 'Conference Delegate' where reg_id = '$reg_id'") or die(mysqli_error($link));

	
	$badge5 = $temp_del_title5 . ' ' . $temp_del_fname5 . ' ' . $temp_del_lname5;
	$temp_del_mob5 = $temp_del_mob_cntry5 . '-' . $temp_del_mob5;
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET title6 = '$temp_del_title5' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET fname6 = '$temp_del_fname5' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET lname6 = '$temp_del_lname5' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET badge6 = '$badge5' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET email6 = '$temp_del_email5' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cellno6 = '$temp_del_mob5' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cata6 = 'Conference Delegate' where reg_id = '$reg_id'") or die(mysqli_error($link));

	
	$badge6 = $temp_del_title6 . ' ' . $temp_del_fname6 . ' ' . $temp_del_lname6;
	$temp_del_mob6 = $temp_del_mob_cntry6 . '-' . $temp_del_mob6;
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET title7 = '$temp_del_title6' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET fname7 = '$temp_del_fname6' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET lname7 = '$temp_del_lname6' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET badge7 = '$badge6' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET email7 = '$temp_del_email6' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cellno7 = '$temp_del_mob6' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cata7 = 'Conference Delegate' where reg_id = '$reg_id'") or die(mysqli_error($link));


	$badge = $temp_part_title . ' ' . $temp_part_fname . ' ' . $temp_part_lname;
	$temp_part_mob = $temp_part_mob_cntry . '-' . $temp_part_mob;
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET title2 = '$temp_part_title' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET fname2 = '$temp_part_fname' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET lname2 = '$temp_part_lname' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET badge2 = '$badge' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET email2 = '$temp_part_email' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cellno2 = '$temp_part_mob' where reg_id = '$reg_id'") or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cata2 = 'Premium Delegate' where reg_id = '$reg_id'") or die(mysqli_error($link));
	
	//mysqli_query($link,"INSERT INTO ".$EVENT_DB_FORM_REG_TBL_LOGIN."(tin_no,reg_id,title,fname,lname,email,cata,user_name,pass1,pass2) VALUES ('$tno','$reg_id','$title','$fname','$lname','$email','$cata','$email','$pas1','$pas2')") or die(mysqli_error($link));

	echo "<script language='javascript'>window.location = 'exhibitor-premium3.php';</script>";
	exit;
?>
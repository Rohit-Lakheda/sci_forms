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
	//print_r($_POST);exit;
	$temp_reg_id = @$_SESSION ['vercode_ex'];
	
	for($j_exb = 1; $j_exb <= 1; $j_exb ++) {
		$title_1 = @$_POST ['title' . $j_exb];
		$fname_1 = @$_POST ['fname' . $j_exb];
		// $mname_1 = @$_POST ['mname' . $j_exb];
		$lname_1 = @$_POST ['lname' . $j_exb];
		$desig_1 = @$_POST ['desig' . $j_exb];
		$mob_1 = @$_POST ['mob' . $j_exb];
		$email_1 = @$_POST ['email' . $j_exb];
		$del_category_1 = @$_POST ['del_category' . $j_exb];
	}
	
	if (($title_1 == "") || ($fname_1 == "") || ($lname_1 == "") || ($desig_1 == "") || ($email_1 == "") || ($del_category_1 == "") || ($mob_1 == "")) {
		echo "<script language='javascript'>alert('Please Enter Complete exhibitors Details.');</script>";
		if(!empty($assoc_nm)) {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		} else {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
		}		
		exit ();
	}
	
	$qr_chk_exb_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO WHERE (reg_id='$temp_reg_id') " );
	$qr_chk_exb_num_rows = mysqli_num_rows ( $qr_chk_exb_id );
	
	if (($qr_chk_exb_num_rows <= 0) || ($qr_chk_exb_num_rows == "")) {
		session_destroy ();
		echo "<script language='javascript'>alert('Please Enter Complete exhibitors Details.');</script>";
		if(!empty($assoc_nm)) {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		} else {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
		}		
		exit ();
	}
	$qr_chk_exb_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO WHERE (reg_id='$temp_reg_id') " );
	$qr_chk_exb_ans = mysqli_fetch_array ( $qr_chk_exb_id );
	
	$exhibitor_id_ex = $qr_chk_exb_ans ['exhibitor_id'];
	$temp_booth_no = $qr_chk_exb_ans ['booth_no'];
	$temp_booth_area = $qr_chk_exb_ans ['booth_area'];
	/*if (($assoc_nm == "STPI") || ($assoc_nm == "KBITS")) {
		$temp_booth_area = 6;
	}*/
	$temp_booth_area_unit = $qr_chk_exb_ans ['booth_area_unit'];
	$temp_fascia_name = $qr_chk_exb_ans ['fascia_name'];
	$temp_fascia_name_up = strtoupper ( $temp_fascia_name );
	
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
	$category = $qr_chk_exb_ans ['category'];
	
	// ----------------------------------------- End Geneating Tin Number ----------------------------------------------------
	$year = date ( "Y" );
	// $total_exbhitors = round($temp_booth_area/9)*2;
	if(!empty($assoc_nm)) {
		if ($assoc_nm == "STPI") {
			$total_exbhitors = 2;
			$temp_total_exbhitors = $total_exbhitors;
			$total_del = 1;
			$temp_total_del = $total_del;
		} else if ($assoc_nm == "STARTUP") {
			if ($temp_booth_area == 4) {
				$total_exbhitors = 2;
				$temp_total_exbhitors = $total_exbhitors;
				$total_del = 1;
				$temp_total_del = $total_del;
			} else if ($temp_booth_area == 6) {
				//echo  floor( $temp_booth_area / 9 );
				$total_exbhitors = 2;
				$temp_total_exbhitors = $total_exbhitors;
				$total_exbhitors_max_flag = "False";

				$total_del = 2;
				$temp_total_del = $total_del;
				$total_del_max_flag = "False";
			}
		}
	} else {
		if (($temp_booth_area <= 9) && ($temp_booth_area >= 4)) {
			$total_exbhitors = 2;
			$temp_total_exbhitors = $total_exbhitors;
			$total_del = 2;
			$temp_total_del = $total_del;
		} else {
			//echo  floor( $temp_booth_area / 9 );
			$total_exbhitors = (floor ( $temp_booth_area / 9 ) * 2);
			$temp_total_exbhitors = $total_exbhitors;
			$total_exbhitors_max_flag = "False";

			$total_del = (floor ( $temp_booth_area / 9 ) * 2);
			$temp_total_del = $total_del;
			$total_del_max_flag = "False";
		}
	}
	
	if ($total_del > 7) {
		$total_del = 7;
		$total_exbhitors_max_flag = "True";
	}
	
	// if(($temp_booth_area<9) && (($temp_booth_area>1)) ){
	if (($temp_booth_area < 3)) {
		echo "<script language='javascript'>alert('Booth/ Stall area should be greater than or equal to 3sqm');</script>";
		if(!empty($assoc_nm)) {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		} else {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
		}
		exit ();
	}
	$total_delegates = $total_del;
	if ($total_exbhitors <= 0 || $total_del <= 0) {
		echo "<script language='javascript'>alert('Please Enter Correct Booth/Pavilion Details.');</script>";
		if(!empty($assoc_nm)) {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		} else {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
		}
		exit ();
	}
	
	$temp_total_exbhitors = $total_exbhitors;
	$sql = "DELETE FROM $EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_DEMO WHERE exhibitor_id='" . $qr_chk_exb_ans['exhibitor_id'] . "'";
	mysqli_query($link,$sql);
	for($j_exb = 1; $j_exb <= $temp_total_exbhitors; $j_exb ++) {
		$title = @$_POST ['title' . $j_exb];
		$fname = @$_POST ['fname' . $j_exb];
		// $mname = @$_POST ['mname' . $j_exb];
		$lname = @$_POST ['lname' . $j_exb];
		$desig = @$_POST ['desig' . $j_exb];
		$mob = @$_POST ['mob' . $j_exb];
		$email = @$_POST ['email' . $j_exb];
		$del_category = @$_POST ['del_category' . $j_exb];
		
		$pas1 = $fname . "123";
		$pas2 = md5 ( $pas1 );
		
		if (($title != "") && ($fname != "") && ($lname != "") && ($desig != "") && ($email != "") && ($del_category != "") && ($mob != "")) {
			mysqli_query ($link, "INSERT INTO $EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_DEMO (exhibitor_id,title,fname,lname,email,desig,mob,category) values('$qr_chk_exb_ans[exhibitor_id]','$title','$fname','$lname','$email','$desig','$mob','$del_category')") or die ( mysqli_error ($link) );
		}
	}
	
	
	//============================================ Save delegate datqa=================================================================
	
	$ddate = date("Y-m-d");
	$ttime = date("H:i:s A");
	$assoc_nm = @$_REQUEST['assoc_nm'];
	$reg_id = $qr_chk_exb_ans['srno'] . $_SESSION ['vercode_ex'];
	$ret = @$_GET['ret'];
	
	mysqli_query($link,"delete from ".$EVENT_DB_FORM_REG_DEMO." where reg_id = '$reg_id' ") or die(mysqli_error($link));
	
	$cata = @$_POST['cata'];
	$cata_m = @$_POST['cata_m'];
	
	if($cata == ""){
		//session_destroy();
		echo "<script language='javascript'>alert('Please select registration category.');</script>";
		if(!empty($assoc_nm)) {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		} else {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
		}	
		exit;
	}
	if($cata_m == ""){
		//session_destroy();
		echo "<script language='javascript'>alert('Please select delegate type.');</script>";
		if(!empty($assoc_nm)) {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		} else {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
		}	
		exit;
	}
	
	$comp_date=$EVENT_DB_COMP_DATE;
	$date1=date("Y/m/d");
	$pay_status = "Complimentary";
	$paymode = 'Complimentary';
	$total_dele = $total_delegates;
	
	$grp = "Group";
	if($total_dele == 1){
		$grp = "Single";
	}
	
	if(($total_dele>7)||($total_dele<1)){
		//session_destroy();
		echo "<script language='javascript'>alert('In group min 2 and maximum 7 delegates are allowded.');</script>";
		if(!empty($assoc_nm)) {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		} else {
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
		}	
		exit;
	}
	
	$amt_ext = "";
	$dollar = "";
	
	if($temp_country=="India"){
		$dollar = "1";
		$amt_ext = "Rs.";
		$nationality = "Indian Organization";
		$curr = 'Indian';
	}
	else{
		$dollar = "71";
		$amt_ext = "USD";
		$nationality = "International Organization";
		$curr = 'Foreign';
	}
	
	$rate = "0";
	$rate_org = "0";
	
	$amt = $total_dele * $rate_org;
	$amt_per_del = $dis = $temp_amt =$mem_disc =$gr_discount =$admin_discount = $tax=$total=$main_amt = 0;
	$spl_delegate_asso_type=$temp_ticket_type = $temp_sess_sp_msg = '';
	mysqli_query($link,"insert into ".$EVENT_DB_FORM_REG_DEMO."(org_reg_type,nationality,cata,curr,gr_type,sub_delegates,paymode,pay_status,amt_ext,amt_per_del,selection_amt,total,reg_id,reg_date,reg_time,sp_msg,dollar,membership_name,ticket_type,event_name,sector) values ('$cata_m','$nationality','$cata','$curr','$grp','$total_dele','$paymode','$pay_status','$amt_ext','$rate_org','$amt','$amt','$reg_id','$ddate','$ttime','$temp_sess_sp_msg','$dollar','$spl_delegate_asso_type','$temp_ticket_type','$event_name','$temp_exhi_sector')")or die(mysqli_error($link));
	
	
	$qry = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	$res = mysqli_fetch_array($qry);
	
	if($cata == "Complimentary Exhibitors Delegate"){	
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-EXHC-";
		if($qr_chk_exb_ans ['sector'] == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-EXHC-";		
		}
	}
	else if($cata == "Complimentary Sponsor Delegate"){	
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-SPOC-";
		if($qr_chk_exb_ans ['sector'] == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-SPOC-";		
		}
	}
	else if($cata == "Complimentary Speaker Delegate"){	
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-SPKC-";
		if($qr_chk_exb_ans ['sector'] == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-SPKC-";		
		}
	}
	else if($cata == "Complimentary Invitee Delegate"){	
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-INVC-";
		if($qr_chk_exb_ans ['sector'] == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-INVC-";		
		}
	}
	else{	
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-";
		if($qr_chk_exb_ans ['sector'] == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR;		
		}
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
	
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET amt_per_del = '$amt_per_del' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET gr_discount = '$gr_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET admin_discount = '$admin_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET tax = '$tax' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET total = '$total' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET membership_discount = '$mem_disc' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET tin_no = '$tin_no1' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET pin_no = '$pin_no1' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET assoc_name = '$assoc_nm' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	
	
	//================================= Save organisation =======================================================================
	$cp_name = $qr_chk_exb_ans['cp_title']." ".$qr_chk_exb_ans['cp_fname']." ".$qr_chk_exb_ans['cp_lname'];
	$cp_email = $qr_chk_exb_ans['email'];
	//$cp_name = "";
	//$cp_email = "";
	$nature = '';
	$org = @$qr_chk_exb_ans['exhibitor_name'];
	$addr1 = @$qr_chk_exb_ans['address_line_1'];
	$addr2 = @$qr_chk_exb_ans['address_line_2'];
	$city = $qr_chk_exb_ans['city'];
	$state = $qr_chk_exb_ans['state'];
	$country = $qr_chk_exb_ans['country'];
	$pin = $qr_chk_exb_ans['zip'];
	
	$fone = $qr_chk_exb_ans['cntry_code_phone']."-".$qr_chk_exb_ans['phone'];
	$fax = $qr_chk_exb_ans['cntry_code_fax']."-".@$qr_chk_exb_ans['fax'];
	$cellno = $qr_chk_exb_ans['cntry_code_mob'] ."-".@$qr_chk_exb_ans['mob'];
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET cp_name='$cp_name',cp_email='$cp_email',nature='$nature',org='$org',addr1='$addr1',addr2='$addr2',city='$city',state='$state',country='$country',pin='$pin',fone='$fone',fax='$fax', cellno='$cellno' WHERE reg_id = '$reg_id' ") or die(mysqli_error($link));
	
	$qry = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	$res = mysqli_fetch_array($qry);
	
	//================================= Save Delegate data =======================================================================
	$cata = $res['cata'];
	$rate = "0";
	$rate_org = "0";
	$lmt = $res['sub_delegates'];
	$tno = $res['tin_no'];
	if(!isset($_POST['same-stall']) || empty($_POST['same-stall']) || $_POST['same-stall'] == 'No') {
		$amt=0;
		for($i=1; $i<= $lmt; $i++) {
			$a1 = "title".$i;
			$a2 = "fname".$i;
			$a3 = "lname".$i;
			$a5 = "job_title".$i;
			$a6 = "badge".$i;
			$a7 = "email".$i;
			$a8 = "cellno".$i;
			$a9 = "cata".$i;
			$a10 = "amt".$i;
			$title = @$_POST['dtitle'.$i];
			$title = trim($title);
		
			$fname = @$_POST['dfname'.$i];
			$fname = trim($fname);
		
			$lname = @$_POST['dlname'.$i];
			$lname = trim($lname);
		
			$job_title = @$_POST['job_title'.$i];
			$job_title = trim($job_title);
		
			$badge = @$_POST['badge'.$i];
			$badge = trim($badge);
		
			$email = @$_POST['email_m'.$i];
			$email = strtolower(trim($email));
		
			$cellno = $_POST['cellno'.$i];
			//$cata = @$_POST['cata'.$i];
		
			$amt = $amt+$rate_org;
		
			$pas1=$fname."123";
			$pas2=md5($pas1);
			
			if($i == 1 && $i == 2) {
				if( ($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == ""))
				{
					echo "<script language='javascript'>alert('Provided all required details of all $lmt delegates.');</script>";
					if(!empty($assoc_nm)) {
						echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
					} else {
						echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
					}	
					exit;
				}
			}
			if(!empty($email)) {
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a1 = '$title' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a2 = '$fname' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a3 = '$lname' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a5 = '$job_title' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a6 = '$badge' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a7 = '$email' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a8 = '$cellno' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a9 = '$cata' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a10 = '$rate_org' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET selection_amt = '$amt' where reg_id = '$reg_id'") or die(mysqli_error($link));
			
				mysqli_query($link,"INSERT INTO ".$EVENT_DB_FORM_REG_TBL_LOGIN."(tin_no,reg_id,title,fname,lname,email,cata,user_name,pass1,pass2) VALUES ('$tno','$reg_id','$title','$fname','$lname','$email','$cata','$email','$pas1','$pas2')") or die(mysqli_error($link));
			}
		}
	} else if($_POST['same-stall'] == 'Yes') {
		$amt=0;
		for($i=1; $i<= $lmt; $i++) {
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
		
			$job_title = @$_POST['desig'.$i];
			$job_title = trim($job_title);
		
			$badge = $fname . ' ' . $lname;
			$badge = trim($badge);
		
			$email = @$_POST['email'.$i];
			$email = strtolower(trim($email));
		
			$cellno = $_POST['mob'.$i];
			//$cata = @$_POST['cata'.$i];
		
			$amt = $amt+$rate_org;
		
			$pas1=$fname."123";
			$pas2=md5($pas1);
			
			if($i == 1 && $i == 2) {
				if( ($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == ""))
				{
					echo "<script language='javascript'>alert('Provided all required details of all $lmt delegates.');</script>";
					if(!empty($assoc_nm)) {
						echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
					} else {
						echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
					}	
					exit;
				}
			}
			if(!empty($email)) {
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a1 = '$title' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a2 = '$fname' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a3 = '$lname' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a5 = '$job_title' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a6 = '$badge' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a7 = '$email' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a8 = '$cellno' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a9 = '$cata' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a10 = '$rate_org' where reg_id = '$reg_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET selection_amt = '$amt' where reg_id = '$reg_id'") or die(mysqli_error($link));
			
				mysqli_query($link,"INSERT INTO ".$EVENT_DB_FORM_REG_TBL_LOGIN."(tin_no,reg_id,title,fname,lname,email,cata,user_name,pass1,pass2) VALUES ('$tno','$reg_id','$title','$fname','$lname','$email','$cata','$email','$pas1','$pas2')") or die(mysqli_error($link));
			}
		}
	}
	
	//exit ();
	echo "<script language='javascript'>window.location= 'exhibitors_form4.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm';</script>";
	exit ();
?>
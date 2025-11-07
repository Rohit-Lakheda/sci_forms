<?php  
	session_start(); 
	if(($_POST["vercode_reg"] != $_SESSION["vercode_reg"]) || ($_SESSION["vercode_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		echo "<script language='javascript'>window.location = 'registration_comp.php';</script>";
		exit; 
	}
	require("includes/form_constants_both.php");

	require "dbcon_open.php";
	
	/*if($_POST['supo_mem']!= ""){
			$spl_type = @$_POST['supo_mem'];
	}
	*/
	//print_r($_POST);exit;
	$sector = $_POST['sector'];
	$en = '';
	$eventName = 'BengaluruITE.BIZ';
	$event_name = 'Bangalore IT';
	/*if($sector == 'Bio Technology') {
		$en = '1';
		$eventName = 'Bengaluru INDIA BIO';
		$event_name = 'Bangalore INDIA BIO';
		//$EVENT_WEBSITE_LINK = 'http://www.bengaluruindiabio.in/';
	}*/

	$exhi = @$_REQUEST['exhi'];
	$exhibitor_id = "";
	if($exhi== "E34XH3IDf6gyy77"){
		$exhibitor_id = $_REQUEST['exhibitor_id'];
	}
	
	
	$temp_ticket_type = @$_POST['ticket_type'];
	
	$spl_delegate_asso_type="";
	
	$nt_sele_mem_cnt=0;
	
	$ddate = date("Y-m-d");
	$ttime = date("H:i:s A");
	$assoc_nm = @$_REQUEST['assoc_nm'];
	$reg_id = $_SESSION['vercode_reg'];	
	$ret = @$_GET['ret'];		
	
	if($ret == "retds4fu324rn_ed24d3it"){	
		mysqli_query($link,"delete from ".$EVENT_DB_FORM_REG_DEMO." where reg_id = '$reg_id' ") or die(mysqli_error($link));
		
	}
	
	$cata = @$_POST['cata'];
	$cata_m = @$_POST['cata_m'];

	if($cata == ""){
		session_destroy();
		echo "<script language='javascript'>alert('Please select registration category.!');</script>";
		echo "<script language='javascript'>window.location = 'registration_comp.php';</script>";
		exit; 
	}
	
	$cata_type = @$_GET['cata_type'];
	

	if($cata_type == 'QM3D14X' || $cata_type == 'SC0MZP2' || $cata_type == 'AS5OC' || $cata_type == 'GVTINV' || $cata_type == 'SPLINV' || $cata_type == 'APTVDS') {
		$cata_type = 'cata_type=' . $cata_type;
	}/* else {
		session_destroy();
		echo "<script language='javascript'>alert('Your link has been expired. Please try again.');</script>";
		echo "<script language='javascript'>window.location = 'registration_comp.php?cata_type=" . $cata_type . "';</script>";
		exit; 
	}*/
	/*if($cata == "Complimentary Media Delegate"){
		$cata_type = 'cata_type=QM3D14X';
	}*/
	$country = '';
	if($cata == 'Complimentary GIA Partner Delegate') {
		$country = @$_POST['country'];
		if($country == 'Other') {
			$country = @$_POST['other_country'];
		}
	}

	if($cata_m == ""){
		session_destroy();
		echo "<script language='javascript'>alert('Please select delegate type.');</script>";
		echo "<script language='javascript'>window.location = 'registration_comp.php?" . $cata_type . "';</script>";
		exit; 
	}

	
	$comp_date=$EVENT_DB_COMP_DATE;
	$date1=date("Y/m/d");
	$curr = @$_POST['curr'];
	$pay_status = "Complimentary";
	$paymode = @$_POST['paymode'];
	$total_dele = "";
	$vercode = @$_POST['vercode'];
	//$grp = $_POST['grp'];
	
	if(!isset($_POST['total_dele'])) {
		$total_dele = 1;
	}

	$grp = 'Group';
	if ($total_dele == 1) {
	    $grp = 'Single';
	}
	
	if($grp == "Single"){
		$total_dele = 1; 
	} else{
		$total_dele = $_POST['total_dele']; 
	}
	
	if(($total_dele>7)||($total_dele<1)){
		session_destroy();
		echo "<script language='javascript'>alert('In group min 2 and maximum 7 delegates are allowded.');</script>";
		echo "<script language='javascript'>window.location = 'registration_comp.php?" . $cata_type . "';</script>";
		exit;
	}
	$lmt = $total_dele;
	
	for($j = 1; $j <= $lmt; $j ++) {
		$email = @$_POST ['email_m' . $j];
		$field = "email" . $j;
		$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'" ) or die ( mysqli_error ($link) );
		$num_row = mysqli_num_rows ( $qr );
		if ($num_row > 0) {
			echo "<script language='javascript'>alert('Provided email id $email, is alredy registered with us.');</script>";
			echo "<script language='javascript'>window.location='registration_comp.php?" . $cata_type . "';</script>";
			exit ();
		}
	}
	
	$org = $_POST['org'];
	$city = $_POST['city'];
	$country = $_POST['country'];
	
	$i = 1;
	$title = @$_POST['title'.$i];
	$fname = @$_POST['fname'.$i];
	$lname = @$_POST['lname'.$i];
	$email = @$_POST['email_m'.$i];
	$cellno = '';
	if(!empty($_POST['cellno'.$i])) {
		$cellno = '+' . @$_POST['cellnoCountryCode'.$i]."-".$_POST['cellno'.$i];
	}
	
	if(empty($city) || empty($country) || empty($title) || empty($fname) || empty($lname) || empty($email) || empty($cellno) || empty($sector)) {
		echo "<script language='javascript'>alert('Please enter all mandatory fields.');</script>";
		echo "<script language='javascript'>window.location = 'registration_comp.php?" . $cata_type . "';</script>";
		exit;
	}
	
	$amt_ext = "";
	$dollar = "";
	
	if($country == 'India'){
		$curr = 'Indian';
		$dollar = "1";
		$amt_ext = "Rs.";
		$nationality = "Indian Organization";
	} else{
		$curr = 'International';
		$dollar = "71";
		$amt_ext = "USD";
		$nationality = "International Organization";
	}
	
	/*if($cata == 'Complimentary GIA Partner Delegate' && $country == 'India') {
		$curr ="Indian";
		$dollar = "1";
		$amt_ext = "Rs.";
		$nationality = "Indian Organization";
	}*/

	$rate = "0";
	$rate_org = "0";
		
	$amt = $total_dele * $rate_org;
	$dis = 0;	
	$temp_amt = 0;
	$mem_disc = 0;
	$gr_discount = 0;	
	$admin_discount = 0;
	$tax= 0;
	$total= 0;
	$main_amt = 0; 
	
	/*if($amt == 0)
	{
		session_destroy();
		echo "<script language='javascript'>alert('Very rare condition occures. Please try after 30 sec.');</script>";
		echo "<script language='javascript'>window.location='reg_registrations_comp.php';</script>";
		exit;
	}*/
	
	$member_of_assoc = '';

	mysqli_query($link,"insert into ".$EVENT_DB_FORM_REG_DEMO."(org_reg_type,nationality,cata,curr,gr_type,sub_delegates,paymode,pay_status,amt_ext,amt_per_del,selection_amt,total,reg_id,reg_date,reg_time,sp_msg,dollar,membership_name,ticket_type,member_of_assoc) values ('$cata_m','$nationality','$cata','$curr','$grp','$total_dele','$paymode','$pay_status','$amt_ext','$rate_org','$amt','$amt','$reg_id','$ddate','$ttime','$temp_sess_sp_msg','$dollar','$spl_delegate_asso_type','$temp_ticket_type', '$member_of_assoc')")or die(mysqli_error($link));
	
	$qry = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	$res = mysqli_fetch_array($qry);
	

	if($cata == "Complimentary Exhibitors Delegate"){	
		$EVENT_DB_TIN_NO="TIN-BTS".$EVENT_YEAR."-EXHC-";
		/*if($sector == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-EXHC-";		
		}*/
	} else if($cata == "Complimentary Sponsor Delegate"){	
		$EVENT_DB_TIN_NO="TIN-BTS".$EVENT_YEAR."-SPON-";
		/*if($sector == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-SPON-";		
		}*/
	} else if($cata == "Complimentary Speaker Delegate"){
		$EVENT_DB_TIN_NO="TIN-BTS".$EVENT_YEAR."-SPKC-";
		/*if($sector == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-SPKC-";		
		}*/
	} else if($cata == "Complimentary Invitee Delegate"){
		$EVENT_DB_TIN_NO="TIN-BTS".$EVENT_YEAR."-INVC-";
		/*if($sector == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-INVC-";		
		}*/
	} else if($cata == "Complimentary Media Delegate"){
		$EVENT_DB_TIN_NO="TIN-BTS".$EVENT_YEAR."-MDA-";
		/*if($sector == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-MDA-";		
		}*/
	}  else if($cata == "Complimentary GIA Partner Delegate"){
		$EVENT_DB_TIN_NO="TIN-BTS".$EVENT_YEAR."-GIAP-";
		/*if($sector == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-GIAP-";		
		}*/
	}  else if($cata == "Complimentary Trade Commissions Delegate"){
		$EVENT_DB_TIN_NO="TIN-BTS".$EVENT_YEAR."-TRDC-";
		/*if($sector == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-TRDC-";		
		}*/
	} else{

		$EVENT_DB_TIN_NO="TIN-BTS".$EVENT_YEAR."-";
		/*if($sector == 'Bio Technology') {		
			$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR;		
		}*/
	}

	if(isset($_GET['cata_type']) && $_GET['cata_type'] == 'AS5OC') {
		$EVENT_DB_TIN_NO="TIN-BTS".$EVENT_YEAR."-ASSO-";
			/*if($sector == 'Bio Technology') {		
				$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-ASSO-";		
			}*/
	}

	if($exhi== "E34XH3IDf6gyy77"){
		$exhibitor_id = $_REQUEST['exhibitor_id'];
		$qr_chk_exbhi = "Select * from ".$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS." where exhibitor_id = '$exhibitor_id' ";
		$qr_chk_exbhi_id = mysqli_query($link,$qr_chk_exbhi);

		$qr_chk_exbhi_ans_rows = mysqli_fetch_array($qr_chk_exbhi_id);

		if($qr_chk_exbhi_ans_rows['category'] == 'Exhibitor') {
			$EVENT_DB_TIN_NO = "TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-EXHC-";
			if($sector == 'Bio Technology') {		
				$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-EXHC-";		
			}
		} else if($qr_chk_exbhi_ans_rows['category'] == 'Sponsor') {
			$EVENT_DB_TIN_NO = "TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-SPON-";
			if($sector == 'Bio Technology') {		
				$EVENT_DB_TIN_NO = "TIN-BIB".$EVENT_YEAR."-SPON-";		
			}
		}
	}
	
	$tin_no = $EVENT_DB_TIN_NO;
	
	$tin_no1 = "";
	
	$i = 0;
	$j = 0;
	
	$temp_srno_gt = $res['srno'];
	do {
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
	
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET amt_per_del = '$amt_per_del' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET gr_discount = '$gr_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET admin_discount = '$admin_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET tax = '$tax' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET total = '$total' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET membership_discount = '$mem_disc' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));	
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET tin_no = '$tin_no1' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET pin_no = '$pin_no1' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET assoc_name = '$assoc_nm' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET event_name = '$event_name', sector = '$sector' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	
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
	
		$job_title = @$_POST['job_title'.$i];
		$job_title = trim($job_title);
	
		//$badge = @$_POST['badge'.$i];
		$badge = $fname . ' ' . $lname;
	
		$email = @$_POST['email_m'.$i];
		$email = strtolower(trim($email));
	
		$cellno = '';
		if(!empty($_POST['cellno'.$i])) {
			$cellno = '+' . @$_POST['cellnoCountryCode'.$i]."-".$_POST['cellno'.$i];
		}
		//$cata = @$_POST['cata'.$i];
		$cata = $res['cata'];
	
		/*if($curr == "Indian") {
		 $rate = "10000";
		 $rate_org = "10000";
		 } else if($curr == "Foreign") {
		 $rate = "210";
		 $rate_org = "210";
		 }*/
	
		$amt = $amt+$rate_org;
	
		$pas1=$fname."123";
		$pas2=md5($pas1);
	
		/*if( ($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == ""))
		{
			echo "<script language='javascript'>alert('Provided all required details of all $lmt delegates.');</script>";
			echo "<script language='javascript'>window.location='registration_comp5.php?$cata_type';</script>";
			exit;
		}*/
	
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
	
		//mysqli_query($link,"INSERT INTO ".$EVENT_DB_FORM_REG_TBL_LOGIN."(tin_no,reg_id,title,fname,lname,email,cata,user_name,pass1,pass2) VALUES ('$tno','$reg_id','$title','$fname','$lname','$email','$cata','$email','$pas1','$pas2')") or die(mysqli_error($link));
	}
	
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET org='$org',city='$city',country='$country' WHERE reg_id = '$reg_id' ") or die(mysqli_error($link));
	
	if(isset($_GET['cata_type']) && $_GET['cata_type'] == 'AS5OC') {
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET assoc_name = '" . $_POST['assoc_name'] . "' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	}
	
	
	$event_know = @$_POST['event_know'];
	if($event_know == 'Others') {
		/*if(empty($_POST['other_value'])) {
			echo "<script language='javascript'>alert('Please enter other value of How do you know about Bangalore Bio 2017.');</script>";
			if(!empty($assoc_name)) {
				echo "<script language='javascript'>window.location = 'registration-assoc.php?en=$en&assoc_name=$assoc_name';</script>";
			} else {
				echo "<script language='javascript'>window.location = 'registration.php?en=$en';</script>";
			}
			exit;
		}*/
		$event_know .= '-' . @$_POST['other_value'];
	}
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET event_know = '$event_know' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));

	echo "<script language='javascript'>window.location = 'registration_comp3.php?exhi=$exhi&exhibitor_id=$exhibitor_id&exhi_log=r34tr1&assoc_nm=$assoc_nm&" . $cata_type . "';</script>";		
		
	exit;
?>
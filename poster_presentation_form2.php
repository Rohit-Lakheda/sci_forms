<?php

session_start();
	// ini_set("display_errors", "1");
	// error_reporting(E_ALL);
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	//print_r($_POST);
	$session_ver = mysqli_escape_string($link,htmlspecialchars($_SESSION["vercode_pstr"]));
	$post_ver = mysqli_escape_string($link,htmlspecialchars($_POST['vercode']));
	if(($session_ver != $post_ver) || ($session_ver == "")){
		echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
		echo "<script language='javascript'> window.location =('poster_presentation_form.php');</script>";
		exit();	
	}
	
	$list = array('title', 'lead_name', 'lead_email', 'lead_org', 'lead_acode', 'lead_phone', 'lead_mob', 'lead_addr', 'lead_city', 'lead_state', 
				'lead_country', 'lead_zip', 'pp_name', 'pp_email', 'pp_org', 'pp_acode', 'pp_phone', 'pp_mob', 'pp_addr', 'pp_city', 'pp_state', 'pp_country', 'pp_country', 'pp_zip', 'sector', 'curr', 'paymode');
	foreach ($list as $filed) {
		if( (mysqli_escape_string($link,htmlspecialchars(@$_POST[$filed])) == "" )){
			echo "<script language='javascript'>alert('Please enter mandatory(* marked) fields.');</script>";
			echo "<script language='javascript'> window.location =('poster_presentation_form.php');</script>";
			exit();
		}
	}

	
	$target_path_lead_auth_cv = ""; 
	$target_path_abstract = "";
	$reg_id = mysqli_escape_string($link,htmlspecialchars($_POST['vercode']));
	$ret    = mysqli_escape_string($link,htmlspecialchars(@$_GET['ret']));
	if ($ret == "retds4fu324rn_ed24d3it") {
		mysqli_query($link,"delete from " . $PSTR_TBL_NAME_DEMO . " where reg_id = '$reg_id' ") or die(mysqli_error($link));
	}
	
	$temp_dt = date("Y-m-d");
	$temp_dt2 = date("d-M-Y");
	$temp_tm_1 = date("H:i:s A");
	if(mysqli_escape_string($link,htmlspecialchars(@$_POST['pp_website'])) != "")
	{
		$pp_website = "http://".mysqli_escape_string($link,htmlspecialchars(@$_POST['pp_website']));
	}
	$pp_org = mysqli_escape_string($link,htmlspecialchars(@$_POST['pp_org']));
	
	/**************************************** Uploading checking session Abstract File **************************************/
	
	$temp_sess_abstract = ($_FILES['sess_abstract']['size']);
	$temp_sess_abstract = ($temp_sess_abstract / 1048576);
	 
	 
	if($temp_sess_abstract > 2) {
		echo "<script language='javascript'>alert(' Session Abstract File Size Should Be Less Than 1 MB.');  </script>";		
		echo "<script language='javascript'>window.location = ('poster_presentation_form.php');  </script>";
		exit();

	}
	
	$path_sess_abstract = "upload1/";
	$f_sess_abstract_dt = date('dmyHis');
	$f_sess_abstract = basename(@$_FILES['sess_abstract']['name']);
	if($f_sess_abstract !="") {
		$f_sess_abstract_1 = $f_sess_abstract_dt.$f_sess_abstract;
		$f_sess_abstract_1 = str_replace(" ", "",$f_sess_abstract_1);
		$target_path_sess_abstract = $path_sess_abstract.$f_sess_abstract_1;
		if(!move_uploaded_file($_FILES['sess_abstract']['tmp_name'], $target_path_sess_abstract)) { 
    		echo "<script language='javascript'> alert('There was an error uploading the file, ".basename($_FILES['sess_abstract']['name'])." please try again')";
			echo "<script language='javascript'> window.location =('poster_presentation_form.php');</script>";
			exit();
		}	
	}
	$target_path_sess_abstract = $PSTR_FILE_PATH_TO_UPLOAD . $target_path_sess_abstract;	
	/************************************* End Uploading checking session Abstract File *************************************/
	
	/************************************* Uploading checking chair person brief File ****************************************/
	
	$temp_chair_brief = ($_FILES['lead_auth_cv']['size']);
	$temp_chair_brief = ($temp_chair_brief / 1048576);
	 
	if($temp_chair_brief > 2) {
		echo "<script language='javascript'>alert(' Session Abstract File Size Should Be Less Than 1 MB.');  </script>";		
		echo "<script language='javascript'>window.location = ('poster_presentation_form.php');  </script>";
		exit();
	}
	$path_chair_brief = "upload1/";
	$f_chair_brief_dt = date('dmyHis');
	$f_chair_brief = basename(@$_FILES['lead_auth_cv']['name']);
	if($f_chair_brief !="")
	{
		$f_chair_brief_1 = $f_chair_brief_dt.$f_chair_brief;
		$f_chair_brief_1 = str_replace(" ", "",$f_chair_brief_1);
		$target_path_chair_brief = $path_chair_brief . $f_chair_brief_1;
	
		if(!move_uploaded_file($_FILES['lead_auth_cv']['tmp_name'], $target_path_chair_brief)) {
    		echo "<script language='javascript'> alert('There was an error uploading the file, ".basename($_FILES['lead_auth_cv']['name'])." please try again')";
			echo "<script language='javascript'> window.location =('poster_presentation_form.php');</script>";
			exit();
		}	
	}
	
	$target_path_chair_brief =$PSTR_FILE_PATH_TO_UPLOAD . $target_path_chair_brief;	
	
	$theme = mysqli_escape_string($link,htmlspecialchars($_POST['theme']));
	if($theme == "Other")
	{
		$theme = mysqli_escape_string($link,htmlspecialchars(@$_POST['othrdiv']));
	}
	/*********************************** End Uploading checking chair person brief File ***********************************/
	$lead_mob = mysqli_escape_string($link,htmlspecialchars($_POST['lead_mob'])); 
	$lead_mob_ctry  = mysqli_escape_string($link,htmlspecialchars($_POST['lead_mobCountryCode'])); 
	$lead_mob  = mysqli_escape_string($link,htmlspecialchars($lead_mob_ctry . '-' . $lead_mob));
	$pp_mob = mysqli_escape_string($link,htmlspecialchars($_POST['pp_mob']));
	$pp_mob_ctry  = mysqli_escape_string($link,htmlspecialchars($_POST['pp_mobCountryCode']));
	$pp_mob  = mysqli_escape_string($link,htmlspecialchars($pp_mob_ctry . '-' . $pp_mob));
	$pp_website = mysqli_escape_string($link,htmlspecialchars($_POST['pp_website']));
	// $sector = mysqli_escape_string($link,htmlspecialchars($_POST['sector']));
	$sector = mysqli_real_escape_string($link,html_entity_decode(trim($_POST['sector']), ENT_QUOTES, 'UTF-8'));
	$curr       = mysqli_escape_string($link,htmlspecialchars(@$_POST['curr']));
	$pay_status = "Not Paid";
	$paymode    = mysqli_escape_string($link,htmlspecialchars(@$_POST['paymode']));
	
	$amt_ext = $dollar  = "";
	$processing_charge_per = $processing_charge = 0;
	if ($curr == "Indian") {
		$dollar      = "1";
		$amt_ext     = "Rs.";
		$selection_amt = "3000";
		
		if($paymode == 'Credit Card' || $paymode == 'Cashfree') {
			$processing_charge_per = $CC_IND_PROCESSING_CHARGE_PER;
		}
	} else {
		$dollar      = $DOLLAR_RATE;;
		$amt_ext     = "USD";
		$selection_amt = "50";
		
		if($paymode == 'Paypal') {
			$processing_charge_per = $PAYPAL_PROCESSING_CHARGE_PER;
		} else if($paymode == 'Credit Card') {
			$processing_charge_per = $CC_INT_PROCESSING_CHARGE_PER;
		}
	}
	
	$EVENT_DB_TIN_NO = "TIN-BTS" . $EVENT_YEAR . "-PSTR-";
	do {
		$i = 0;
		$tin_no1 = $EVENT_DB_TIN_NO . mt_rand(1, 99999);
		$qry    = mysqli_query($link,"SELECT * FROM " . $PSTR_TBL_NAME_DEMO . " WHERE tin_no = '$tin_no1'");
		$res_no = mysqli_num_rows($qry);
		if ($res_no == 0) {
			$i++;
		} else {
			$i       = 0;
			$tin_no1 = "";
		}
	} while ($i <= 0);
	
	$lead_org = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_org']));
	$pp_org = mysqli_real_escape_string($link,htmlspecialchars($pp_org));
	$lead_addr = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_addr']));
	$pp_addr = mysqli_real_escape_string($link,htmlspecialchars($_POST['pp_addr']));
	$abstract_text = isset($_POST['abstract_text']) && !empty($_POST['abstract_text']) 
    ? mysqli_real_escape_string($link,htmlspecialchars($_POST['abstract_text'])) 
    : null;
	$title = mysqli_real_escape_string($link,htmlspecialchars($_POST['title']));
	$lead_name = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_name']));
	$lead_email = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_email']));
	$lead_ccode = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_ccode']));
	$lead_acode = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_acode']));
	$lead_phone = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_phone']));
	$lead_mob = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_mob']));
	$lead_city = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_city']));
	$lead_state = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_state']));
	$lead_country = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_country']));
	$lead_zip = mysqli_real_escape_string($link,htmlspecialchars($_POST['lead_zip']));
	$pp_name = mysqli_real_escape_string($link,htmlspecialchars($_POST['pp_name']));
	$pp_email = mysqli_real_escape_string($link,htmlspecialchars($_POST['pp_email']));
	$pp_ccode = mysqli_real_escape_string($link,htmlspecialchars($_POST['pp_ccode']));
	$pp_acode = mysqli_real_escape_string($link,htmlspecialchars($_POST['pp_acode']));
	$pp_phone = mysqli_real_escape_string($link,htmlspecialchars($_POST['pp_phone']));
	$pp_mob = mysqli_real_escape_string($link,htmlspecialchars($_POST['pp_mob']));
	$pp_city = mysqli_real_escape_string($link,htmlspecialchars($_POST['pp_city']));
	$pp_state = mysqli_real_escape_string($link,htmlspecialchars($_POST['pp_state']));
	$pp_country = mysqli_real_escape_string($link,htmlspecialchars($_POST['pp_country']));
	$pp_zip = mysqli_real_escape_string($link,htmlspecialchars($_POST['pp_zip']));
	$co_auth_name_1 = mysqli_real_escape_string($link,htmlspecialchars($_POST['co_auth_name_1']));
	$co_auth_name_2 = mysqli_real_escape_string($link,htmlspecialchars($_POST['co_auth_name_2']));
	$co_auth_name_3 = mysqli_real_escape_string($link,htmlspecialchars($_POST['co_auth_name_3']));
	$co_auth_name_4 = mysqli_real_escape_string($link,htmlspecialchars($_POST['co_auth_name_4']));
	$acc_co_auth_name_1 = mysqli_real_escape_string($link,htmlspecialchars($_POST['acc_co_auth_name_1']));
	$acc_co_auth_name_2 = mysqli_real_escape_string($link,htmlspecialchars($_POST['acc_co_auth_name_2']));
	$acc_co_auth_name_3 = mysqli_real_escape_string($link,htmlspecialchars($_POST['acc_co_auth_name_3']));
	$acc_co_auth_name_4 = mysqli_real_escape_string($link,htmlspecialchars($_POST['acc_co_auth_name_4']));
	$vercode = mysqli_real_escape_string($link,htmlspecialchars($_POST['vercode']));
	$ver = mysqli_real_escape_string($link,htmlspecialchars($_POST['vercode']));
	//abstract_text
	//$abstract_text 



	mysqli_query($link,"INSERT INTO $PSTR_TBL_NAME_DEMO (poster_title, lead_name, lead_email, lead_org, lead_ccode, lead_acode, lead_phone, 
	lead_mob, lead_addr, lead_city, lead_state, lead_country, lead_zip, pp_name, pp_org, pp_website, pp_email, pp_ccode, pp_acode, 
	pp_phone, pp_mob, pp_addr, pp_city, pp_state, pp_country, pp_zip, co_author_1, co_author_2, co_author_3, co_author_4, 
	accop_co_author_1, accop_co_author_2, accop_co_author_3, accop_co_author_4, poster_abstract, lead_cv, reg_date, reg_time, 
	reg_id, usr_disp_date, vercode, poster_catagory,sector, curr, pay_status, paymode, amt_ext, dollar, tin_no, abstract_text) VALUES 
	('$title', '$lead_name', '$lead_email', '$lead_org', '$lead_ccode', '$lead_acode', '$lead_phone',
	'$lead_phone', '$lead_addr', '$lead_city', '$lead_city', '$lead_country', '$lead_zip', '$pp_name', 
	'$pp_org', '$pp_website', '$pp_email', '$pp_ccode', '$pp_acode', '$pp_phone', '$pp_mob', '$pp_addr', 
	'$pp_city', '$pp_state', '$pp_country', '$pp_zip', '$co_auth_name_1', '$co_auth_name_2', 
	'$co_auth_name_3', '$co_auth_name_4', '$acc_co_auth_name_1', '$acc_co_auth_name_2', '$acc_co_auth_name_3',
	'$acc_co_auth_name_4', '$target_path_sess_abstract', '$target_path_chair_brief', '$temp_dt', '$temp_tm_1', '$vercode',
	'$temp_dt2', '$vercode', '$theme','$sector', '$curr', '$pay_status', '$paymode', '$amt_ext', '$dollar', '$tin_no1', '$abstract_text')") 
	or die("err " . mysqli_error($link));
	
	$tax = $total = $main_amt = 0;
	
	mysqli_query($link,"UPDATE ".$PSTR_TBL_NAME_DEMO." SET selection_amt = '$selection_amt' where reg_id = '$reg_id'") or die(mysqli_error($link));
	$main_amt = $selection_amt;
	$tax = round(($main_amt * $SERVICE_TAX) / 100);
	$total = round ($main_amt + $tax);
	if(!empty($processing_charge_per)) {
		$processing_charge = round(($total * $processing_charge_per) / 100);
		$total = round ($total + $processing_charge);
	}
	
	//mysqli_query($link,"UPDATE ".$PSTR_TBL_NAME_DEMO." SET gr_discount = '$gr_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//mysqli_query($link,"UPDATE ".$PSTR_TBL_NAME_DEMO." SET admin_discount = '$admin_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$PSTR_TBL_NAME_DEMO." SET tax = '$tax' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$PSTR_TBL_NAME_DEMO." SET total = '$total' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//mysqli_query($link,"UPDATE ".$PSTR_TBL_NAME_DEMO." SET membership_discount = '$membership_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//mysqli_query($link,"UPDATE ".$PSTR_TBL_NAME_DEMO." SET adminDiscountPer = '$adminDiscount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//mysqli_query($link,"UPDATE ".$PSTR_TBL_NAME_DEMO." SET membershipDiscountPer = '$membershipDiscount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$PSTR_TBL_NAME_DEMO." SET processing_charge_per = '$processing_charge_per' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$PSTR_TBL_NAME_DEMO." SET processing_charge = '$processing_charge' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	
	// call API for lead author
	$mobile=explode('-',mysqli_escape_string($link,htmlspecialchars($_POST['lead_mob'])));
	$mob_no=$mobile[1];

	$data=array();
	$data['name']=mysqli_escape_string($link,htmlspecialchars($_POST['lead_name'])) ;
	$data['email']= mysqli_escape_string($link,htmlspecialchars($_POST['lead_email'])) ;
	$data['country_code']=mysqli_escape_string($link,htmlspecialchars($_POST['lead_mobCountryCode']));
	$data['phone'] = mysqli_escape_string($link,htmlspecialchars($mob_no)) ;
	$data['booking_id']= mysqli_escape_string($link,htmlspecialchars($_POST['vercode']));
	$ticket_id = 31423 ;
	$ticket_type='Lead Author';
	//callUniversalAPI($data,$ticket_id,$ticket_type);

	// call API for Poster Presenter
	$cntry= explode("-",mysqli_escape_string($link,htmlspecialchars($_POST['pp_mob'])));
	$phone=$cntry[1];

	$data1=array();
	$data1['name']=mysqli_escape_string($link,htmlspecialchars($_POST['pp_name'])) ;
	$data1['email']= mysqli_escape_string($link,htmlspecialchars($_POST['pp_email'])) ;
	$data1['country_code']=mysqli_escape_string($link,htmlspecialchars($_POST['pp_ccode']));
	$data1['phone'] = mysqli_escape_string($link,htmlspecialchars($phone));
	$data1['booking_id']= mysqli_escape_string($link,htmlspecialchars($_POST['vercode']));
	$ticket_type='Poster Presenter';
	//callUniversalAPI($data1,$ticket_id,$ticket_type);
	
	echo "<script language='javascript'> window.location =('poster_presentation_form3.php?nm=$temp_nm');</script>";
	echo "<script language='javascript'> document.location =('poster_presentation_form3.php?nm=$temp_nm');</script>";	
	exit;
?>
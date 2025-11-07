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

	if((!isset($_SESSION["vercode_reg"]))||($_SESSION["vercode_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		if(!empty($assoc_code)) {
			echo "<script language='javascript'>window.location = 'registration-assoc-conf.php?a=$assoc_code';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-assoc-conf.php?a=$assoc_code';</script>";
		}
		exit; 
	}
	//print_r($_POST);exit;
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	$reg_id = $_SESSION["vercode_reg"];
	
	ini_set("max_execution_time","3600");	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_no = 0;
	$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
	if( ($qr_gt_user_data_ans_no<=0) || ($qr_gt_user_data_ans_no=="") ) {
		session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
		if(!empty($assoc_code)) {
			echo "<script language='javascript'>window.location = 'registration-assoc-conf.php?a=$assoc_code';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-assoc-conf.php?a=$assoc_code';</script>";
		}
		exit; 
	}	
			
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
	
	$res1 = $qr_gt_user_data_ans_row;
	$res= $res1;
	
	$comp_date=$EVENT_DB_COMP_DATE;
	$lmt = $res['sub_delegates'];
	
	for($j = 1; $j <= $lmt; $j ++) {
		$_SESSION ['email' . $j] = $_POST ['email_m' . $j];
		$_SESSION ['title' . $j] = $_POST ['title' . $j];
		$_SESSION ['fname' . $j] = $_POST ['fname' . $j];
		$_SESSION ['lname' . $j] = $_POST ['lname' . $j];
		$_SESSION ['job_title' . $j] = $_POST ['job_title' . $j];
		//$_SESSION ['badge' . $j] = $_POST ['job_title' . $j];
		$_SESSION ['cellno' . $j] = $_POST ['cellnoCountryCode' . $j] . '-' . $_POST ['cellno' . $j];
		//$_SESSION ['cellno' . $j] = ;
		$_SESSION ['catagory' . $j] = $_POST ['catagory' . $j];
	}
	$tno = $res['tin_no'];
	$curr = $res['curr'];
	$date1=date("Y-m-d");
	
	for($j = 1; $j <= $lmt; $j ++) {
		$email = @$_POST ['email_m' . $j];
		$field = "email" . $j;
		$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE pri_email = '$email'" ) or die ( mysqli_error ($link) );
		$num_row = mysqli_num_rows ( $qr );
		if ($num_row > 0) {
			echo "<script language='javascript'>alert('The email id \'". $email . "\' is already registered with us as a premium delegate.');</script>";
			echo "<script language='javascript'>window.location = ('registration-assoc-conf5.php?ret=retds4fu324rn_ed24d3it&en=" .$en . "&a=" .$a . "&assoc_name=" .$assoc_name."');</script>";
			exit;
		}

		$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'" ) or die ( mysqli_error ($link) );
		$num_row = mysqli_num_rows ( $qr );
		if ($num_row > 0) {
			$qr_gt_user_data_ans_row = mysqli_fetch_array($qr);
			if($qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
				if(($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking' || $qr_gt_user_data_ans_row['paymode'] == 'Google pay')) {
					/*echo "<script language='javascript'>window.location = 'registration-assoc-conf9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";*/
					//session_destroy();
					echo 'Please wait while you redirecting to CCAvenue payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
					echo "<script language='javascript'>setTimeout(function(){ window.location = ('$EVENT_OL_PAY_ACT_LINK?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
					exit;
				} else if(($qr_gt_user_data_ans_row['paymode'] == "Cheque")||($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD") || $qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") {
					echo "<script language='javascript'>window.location = 'registration-assoc-conf9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
					exit;
				} else if($qr_gt_user_data_ans_row['paymode'] == "Paypal" && $qr_gt_user_data_ans_row['curr'] == 'Foreign') {
					echo 'Please wait while you redirecting to Paypal payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
					echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CANCEL_URL?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
					exit;
				}
			} else {
				/*echo "<script language='javascript'>alert('Provided email id $email, is alredy registered with us.');</script>";
				echo "<script language='javascript'>window.location='registration-assoc-conf5.php?a=$assoc_code';</script>";
				exit ();*/
				echo "<script language='javascript'>window.location = 'registration-assoc-conf9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
				exit;
			}
		}
	}
	
	$paymode    = '';
	$pay_status = "Free";
	/* $isPaid = false;
	for($i=1; $i<= $lmt; $i++) {
		if($_POST['catagory' . $i] == 'Premium Delegate' || $_POST['catagory' . $i] == 'International Premium Delegate') {
			$isPaid = true;
		}
	}
	if($isPaid) {
		$paymode    = @$_POST['paymode'];
		$pay_status = "Not Paid";
	} */
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET paymode = '$paymode', pay_status='$pay_status' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));

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
		$fname = mysqli_real_escape_string($link,trim($fname));
		
		$lname = @$_POST['lname'.$i];
		$lname = mysqli_real_escape_string($link,trim($lname));
		
		$job_title = @$_POST['job_title'.$i];
		$job_title = mysqli_real_escape_string($link,trim($job_title));
		
		$badge = $title.' '.$fname.' '.$lname;
		$badge = mysqli_real_escape_string($link,trim($badge));
		
		$email = @$_POST['email_m'.$i];
		$email = strtolower(trim($email));
		
		$cellno = '';
		if(!empty($_POST['cellno'.$i])) {
			$cellno = '+' . @$_POST['cellnoCountryCode'.$i]."-".$_POST['cellno'.$i];
		}
		//$cata = @$_POST['cata'.$i];
		$cata = $_POST['catagory' . $i];
		$org_reg_type=$res['org_reg_type'];
		$no_dele=$res['sub_delegates'];
		$conf_type = $res['conference_type'];
		/**/
		$qr_tot_del=mysqli_query($link,"SELECT SUM(sub_delegates) AS tot_dele FROM ".$EVENT_DB_FORM_REG);

		$qr_gt_tot_del_ans_row = mysqli_fetch_array($qr_tot_del);
		$res_tot_del = $qr_gt_tot_del_ans_row;
		$num_dele=$res_tot_del['tot_dele'];
		
		//$amt = $amt + $rate;
		//echo $amt;
		$pas1 = $fname . "123";
		$pas2 = md5($pas1);
	
	    if( ($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == "")) {
			echo "<script language='javascript'>alert('Provided all required details of all $lmt delegates.');</script>";
			echo "<script language='javascript'>window.location='registration-assoc-conf5.php?a=$assoc_code';</script>";
			exit;	
		}	
		$rate_org = 'Free';
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a1 = '$title' where reg_id = '$reg_id'") or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a2 = '$fname' where reg_id = '$reg_id'") or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a3 = '$lname' where reg_id = '$reg_id'") or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a5 = '$job_title' where reg_id = '$reg_id'") or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a6 = '$badge' where reg_id = '$reg_id'") or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a7 = '$email' where reg_id = '$reg_id'") or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a8 = '$cellno' where reg_id = '$reg_id'") or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a9 = '$cata' where reg_id = '$reg_id'") or die(mysqli_error($link));
		mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET $a10 = '$rate_org' where reg_id = '$reg_id'") or die(mysqli_error($link));
		//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET selection_amt = '$amt' where reg_id = '$reg_id'") or die(mysqli_error($link));
		
		mysqli_query($link,"INSERT INTO ".$EVENT_DB_FORM_REG_TBL_LOGIN."(tin_no,reg_id,title,fname,lname,email,cata,user_name,pass1,pass2) VALUES ('$tno','$reg_id','$title','$fname','$lname','$email','$cata','$email','$pas1','$pas2')") or die(mysqli_error($link));
	}
	
	//$qr_gt_user_dataid = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG);
	//mysqli_num_rows($qr_gt_user_dataid);
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET amt_per_del = '$amt_per_del' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	/* mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET gr_discount = '$gr_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET admin_discount = '$admin_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET tax = '$tax' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET total = '$total' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET membership_discount = '$membership_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));	
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET adminDiscountPer = '$adminDiscount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET membershipDiscountPer = '$membershipDiscount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
    mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET processing_charge_per = '$processing_charge_per' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
    mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET processing_charge = '$processing_charge' WHERE reg_id = '$reg_id'")or die(mysqli_error($link)); */
	echo "<script language='javascript'>window.location = 'registration-assoc-conf7.php?a=$assoc_code';</script>";
	exit;
?>
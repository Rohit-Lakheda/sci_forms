<?php
	//print_r($_POST);exit;
 	session_start(); 
 	$event_name = 'Bangalore IT';
 	$en = '';
 	if(isset($_POST['en']) && !empty($_POST['en'])) {
 		$en = '1';
 		$event_name = 'Bangalore INDIA BIO';
 	}
	$assoc_name = @$_GET['assoc_name'];
	$assoc_name = trim($assoc_name);

	if((!isset($_SESSION["vercode_reg"]))||($_SESSION["vercode_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		if(!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration-del.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-del.php?en=$en';</script>";
		}
		exit; 
	}
	
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
		if(!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration-del.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-del.php?en=$en';</script>";
		}
		exit; 
	}	
	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
	
	$res1 = $qr_gt_user_data_ans_row;
	$res= $res1;
	
	$comp_date=$EVENT_DB_COMP_DATE;
	$lmt = $res['sub_delegates'];
	
	/* for($j = 1; $j <= $lmt; $j ++) {
		$_SESSION ['email' . $j] = $_POST ['email_m' . $j];
		$_SESSION ['title' . $j] = $_POST ['title' . $j];
		$_SESSION ['fname' . $j] = $_POST ['fname' . $j];
		$_SESSION ['lname' . $j] = $_POST ['lname' . $j];
		$_SESSION ['job_title' . $j] = $_POST ['badge' . $j];
		$_SESSION ['badge' . $j] = $_POST ['job_title' . $j];
		$_SESSION ['cellnoCountryCode' . $j] = $_POST ['cellnoCountryCode' . $j];
		$_SESSION ['cellno' . $j] = $_POST ['cellno' . $j];
	} */
	$tno = $res['tin_no'];
	$curr = $res['curr'];
	$date1=date("Y-m-d");
	
	for($j = 1; $j <= $lmt; $j ++) {
		$email = @$_POST ['email_m' . $j];
		$field = "email" . $j;
		$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'" ) or die ( mysqli_error ($link) );
		$num_row = mysqli_num_rows ( $qr );
		if ($num_row > 0) {
			$qr_gt_user_data_ans_row = mysqli_fetch_array($qr);
			if($qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
				if(($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking' || $qr_gt_user_data_ans_row['paymode'] == 'Google pay')) {
					/*echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";*/
					//session_destroy();
					echo 'Please wait while you redirecting to CCAvenue payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
					echo "<script language='javascript'>setTimeout(function(){ window.location = ('$EVENT_OL_PAY_ACT_LINK?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
					exit;
				} else if(($qr_gt_user_data_ans_row['paymode'] == "Cheque")||($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD") || $qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") {
					echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
					exit;
				} else if($qr_gt_user_data_ans_row['paymode'] == "Paypal" && $qr_gt_user_data_ans_row['curr'] == 'Foreign') {
					echo 'Please wait while you redirecting to Paypal payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
					echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CANCEL_URL?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
					exit;
				}
			} else {
				/*echo "<script language='javascript'>alert('Provided email id $email, is alredy registered with us.');</script>";
				echo "<script language='javascript'>window.location='registration5.php?en=$en&assoc_name=$assoc_name';</script>";
				exit ();*/
				echo "<script language='javascript'>window.location = 'registration9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
				exit;
			}
		}
	}
	
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
		
		$job_title = @$_POST['job_title'.$i];
		$job_title = trim($job_title);
		
		$badge = $title.' '.$fname.' '.$lname;
		$badge = trim($badge);
		
		$email = @$_POST['email_m'.$i];
		$email = strtolower(trim($email));
		
		$cellno = '';
		if(!empty($_POST['cellno'.$i])) {
			$cellno = '+' . @$_POST['cellnoCountryCode'.$i]."-".$_POST['cellno'.$i];
		}
		//$cata = @$_POST['cata'.$i];
		$cata = $_POST['catagory' . $i];
		$org_reg_type= $cata;//$res['org_reg_type'];
		
	    if($curr == "Indian") {
	    		if($org_reg_type == 'Premium Delegate') {
	    			$rate = "2000";
			    	$rate_org = "2000";
	    		}else if($org_reg_type == 'Standard Delegate') {
    				$rate = "0";
	    			$rate_org = "Free";
	    		}
        }else if($curr == "Foreign") {
    		if($org_reg_type == 'Premium Delegate'){
    				$rate = "50";
		    		$rate_org = "50";
    		}else if($org_reg_type == 'Standard Delegate'){
    				$rate = "0";
		    		$rate_org = "Free";
    		}
		}
		
		$amt = $amt + $rate;
		//echo $amt;
		$pas1 = $fname . "123";
		$pas2 = md5($pas1);
	
	    if( ($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == "")) {
			echo "<script language='javascript'>alert('Provided all required details of all $lmt delegates.');</script>";
			echo "<script language='javascript'>window.location='registration5.php?en=$en&assoc_name=$assoc_name';</script>";
			exit;	
		}	
		
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
	
	$membershipDiscount = $membership_discount = 0;
	$gr_discount = 0;	
	$admin_discount = 0;
	$tax= 0;
	$total= 0;
	$main_amt = 0;
	$processing_charge_per = $processing_charge = 0;

	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
	$res = $res1 = $qr_gt_user_data_ans_row;
	$curr = $res['curr'];
	if($curr == "Indian") {
		if($res ['paymode'] == 'Credit Card' || $res ['paymode'] == 'Google pay') {
			$processing_charge_per = $CC_IND_PROCESSING_CHARGE_PER;
		}
	} else if($curr == "Foreign") {
		if($res ['paymode'] == 'Paypal') {
			$processing_charge_per = $PAYPAL_PROCESSING_CHARGE_PER;
		} else if($res ['paymode'] == 'CCAvenue' || $res ['paymode'] == 'Credit Card') {
			$processing_charge_per = $CC_INT_PROCESSING_CHARGE_PER;
		}
	}
	//$qr_gt_user_dataid = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG);
	//mysqli_num_rows($qr_gt_user_dataid);
	$adminDiscount = 0;
	$deytaikls = array();
	
	$assoc_srno = @$res['assoc_srno'];
	$user_type = @$res['user_type'];
	if(!empty($assoc_srno) && !empty($user_type)) {
		$sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_TBL WHERE srno=$assoc_srno AND assoc_name='$user_type'";
		$resulre = mysqli_query($link,$sql);
		$deytaikls = mysqli_fetch_assoc($resulre);
		$adminDiscount = $deytaikls['discount'];
	}
	
	if($res['cata'] == 'Full Delegate' || $res['cata'] == '3 days with speaker offer' || $res['cata'] == '3 days with power bank offer' || $res['cata'] == 'YESSS Abstract Presenter - 3 days') {
		if($res['cata'] == 'Full Delegate' || $res['cata'] == 'International Delegate') {
			//$adminDiscount = $admin_discount = 90;
		}/* else if($res['cata'] == '3 days with speaker offer') {
			$adminDiscount = $admin_discount = 70;
		} else if($res['cata'] == '3 days with power bank offer') {
			$adminDiscount = $admin_discount = 60;
		}*/
		
		if (($res ['gr_type'] == "Single") || ($res ['sub_delegates'] <= "2")) {
			
			$amt_per_del = $main_amt = $res ['selection_amt'];
						
			if(!empty($adminDiscount)) {
				$admin_discount = round(($main_amt * $adminDiscount) / 100);
			}
			$main_amt = $main_amt - $admin_discount;
			if(!empty($res['assoc_name'])) {
				if($res['assoc_name'] == 'Karnataka Startup Cell' || $res['assoc_name'] == 'Karnataka Incubators' || $res['assoc_name'] == 'KBITS StartUp Member') {
					$membershipDiscount = 50;	
				}/* else {
					$membershipDiscount = 20;					
				}*/

				$membership_discount = round(($main_amt * $membershipDiscount) / 100);
				$main_amt = $main_amt - $membership_discount;
			}
			$tax = round(($main_amt * $SERVICE_TAX) / 100);
			$total = round ($main_amt + $tax);
			if(!empty($processing_charge_per)) {
				$processing_charge = round(($total * $processing_charge_per) / 100);
				$total = round ($total + $processing_charge);
			}
		} else if (($res ['gr_type'] == "Group") && ($res ['sub_delegates'] >= "3")) {

			$amt_per_del = $main_amt = $res ['selection_amt'];

			$main_amt = $main_amt - $gr_discount;

			$tax = round(($main_amt * $SERVICE_TAX) / 100);
			$total = round ($main_amt + $tax);
			if(!empty($processing_charge_per)) {
				$processing_charge = round(($total * $processing_charge_per) / 100);
				$total = round ($total + $processing_charge);
			}
			//echo $gr_discount.'--1--'.$total.'1--';exit;
			/*echo $main_amt;
			echo $tax;
			echo $total;
			exit;*/

		}
	} else if($res['cata'] == 'Single Day-Nov 29th,Nov 30th,Dec 1st' || $res['cata'] == 'Single Day-Nov 29th,Dec 1st' || $res['cata'] == 'Single Day-Nov 29th,Dec 1st' || $res['cata'] == 'Single Day-Nov 30th,Dec 1st' || $res['cata'] == 'Single Day-Nov 29th' || $res['cata'] == 'Single Day-Nov 30th' || $res['cata'] == 'Single Day-Dec 1st') {
		$amt_per_del = $main_amt = $res ['selection_amt'];		
		/*if($res['member_of_assoc'] == 'Yes') {
			$membershipDiscount = 10;
			$membership_discount = round(($main_amt * $membershipDiscount) / 100);
			$main_amt = $main_amt - $membership_discount;
		}*/
		if(!empty($adminDiscount)) {
			$admin_discount = round(($main_amt * $adminDiscount) / 100);
		}
		$main_amt = $main_amt - $admin_discount;
		if(!empty($res['assoc_name'])) {
			if($res['assoc_name'] == 'Karnataka Startup Cell' || $res['assoc_name'] == 'Karnataka Incubators' || $res['assoc_name'] == 'KBITS StartUp Member') {
				$membershipDiscount = 50;	
			}/* else {
				$membershipDiscount = 20;					
			}*/

			$membership_discount = round(($main_amt * $membershipDiscount) / 100);
			$main_amt = $main_amt - $membership_discount;
		}
		$tax = round(($main_amt * $SERVICE_TAX) / 100);
		$total = round ($main_amt + $tax);
	} else {
		$main_amt = $res ['selection_amt'];
		/*if(!empty($adminDiscount)) {
			$admin_discount = round(($main_amt * $adminDiscount) / 100);
		}
		$main_amt = $main_amt - $admin_discount;*/
		if($res['gr_type']=='Group' && $res['sub_delegates']>=3){
			$gr_discount=round(($main_amt * 10)/100);
		}
		$main_amt = $main_amt - $gr_discount;
		/*if($res['assoc_name'] == 'NASSCOM' || $res['assoc_name'] == 'NextBigWhat' || $res['assoc_name'] == 'IAMAI' ||
		$res['assoc_name'] == '91 Spring Board' || $res['assoc_name'] == 'Your Story' || $res['assoc_name'] == 'Work Bench Projects' ||
		$res['assoc_name'] == 'IACC' || $res['assoc_name'] == 'Startup Cell' || $res['assoc_name'] == 'STPI' || $res['assoc_name'] == 'IESA' || $res['assoc_name'] == 'KBITS' ) {
			$membershipDiscount = 20;
			$membership_discount = round(($total * $membershipDiscount) / 100);
			$total = $total - $membership_discount;
		}*/
		/*if($res['member_of_assoc'] == 'Yes') {
			$membershipDiscount = 10;
			$membership_discount = round(($main_amt * $membershipDiscount) / 100);
			$main_amt = $main_amt - $membership_discount;
		}*/
		
		if(!empty($res['assoc_name'])) {
			if($res['assoc_name'] == 'Karnataka Startup Cell' || $res['assoc_name'] == 'Karnataka Incubators' || $res['assoc_name'] == 'KBITS StartUp Member') {
				$membershipDiscount = 50;	
			}/* else {
				$membershipDiscount = 20;					
			}*/

			$membership_discount = round(($main_amt * $membershipDiscount) / 100);
			$main_amt = $main_amt - $membership_discount;
		}

		$tax = round(($main_amt * $SERVICE_TAX) / 100);
		$total = round ($main_amt + $tax);
		if(!empty($processing_charge_per)) {
			$processing_charge = round(($total * $processing_charge_per) / 100);
			$total = round ($total + $processing_charge);
		}
	}
	/*echo $gr_discount;
	echo '----'.$total;exit;*/
	if($org_reg_type !='Attendees/Visitors' && $total == 0) {
		echo "<script language='javascript'>alert('Very rare condition occurs. Please try after 30 sec..');</script>";
		mysqli_query($link,"DELETE FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		session_destroy();
		if(!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration-del.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-del.php?en=$en';</script>";
		}
		exit;
	}
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET amt_per_del = '$amt_per_del' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET gr_discount = '$gr_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET admin_discount = '$admin_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET tax = '$tax' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET total = '$total' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET membership_discount = '$membership_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));	
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET adminDiscountPer = '$adminDiscount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET membershipDiscountPer = '$membershipDiscount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET processing_charge_per = '$processing_charge_per' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET processing_charge = '$processing_charge' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	echo "<script language='javascript'>window.location = 'registration-del7.php?en=$en&assoc_name=$assoc_name';</script>";
	exit;
?>
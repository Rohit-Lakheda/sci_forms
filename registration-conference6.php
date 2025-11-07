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
			echo "<script language='javascript'>window.location = 'registration-conference.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-conference.php?en=$en';</script>";
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
		if(!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration-conference.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-conference.php?en=$en';</script>";
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
			echo "<script language='javascript'>window.location = ('registration-conference5.php?ret=retds4fu324rn_ed24d3it&en=" .$en . "&a=" .$a . "&assoc_name=" .$assoc_name."');</script>";
			exit;
		}

		$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'" ) or die ( mysqli_error ($link) );
		$num_row = mysqli_num_rows ( $qr );
		if ($num_row > 0) {
			$qr_gt_user_data_ans_row = mysqli_fetch_array($qr);
			if($qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
				if(($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking' || $qr_gt_user_data_ans_row['paymode'] == 'Google pay')) {
					/*echo "<script language='javascript'>window.location = 'registration-conference9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";*/
					//session_destroy();
					echo 'Please wait while you redirecting to CCAvenue payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
					echo "<script language='javascript'>setTimeout(function(){ window.location = ('$EVENT_OL_PAY_ACT_LINK?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
					exit;
				} else if(($qr_gt_user_data_ans_row['paymode'] == "Cheque")||($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD") || $qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") {
					echo "<script language='javascript'>window.location = 'registration-conference9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
					exit;
				} else if($qr_gt_user_data_ans_row['paymode'] == "Paypal" && $qr_gt_user_data_ans_row['curr'] == 'Foreign') {
					echo 'Please wait while you redirecting to Paypal payment gateway...<br/> Do not "close the window" or press "refresh" or "browser back button".';
					echo "<script language='javascript'>setTimeout(function(){ window.location = ('$CANCEL_URL?id=" . $qr_gt_user_data_ans_row['tin_no'] . "'); }, 5000);</script>";
					exit;
				}
			} else {
				/*echo "<script language='javascript'>alert('Provided email id $email, is alredy registered with us.');</script>";
				echo "<script language='javascript'>window.location='registration-conference5.php?en=$en&assoc_name=$assoc_name';</script>";
				exit ();*/
				echo "<script language='javascript'>window.location = 'registration-conference9.php?id=" . $qr_gt_user_data_ans_row['tin_no'] . "';</script>";
				exit;
			}
		}
	}
	
	$paymode    = '';
	$pay_status = "Free";
	$isPaid = false;
	for($i=1; $i<= $lmt; $i++) {
		if($_POST['catagory' . $i] == 'Premium Delegate' || $_POST['catagory' . $i] == 'International Premium Delegate') {
			$isPaid = true;
		}
	}
	if($isPaid) {
		$paymode    = @$_POST['paymode'];
		$pay_status = "Not Paid";
	}
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
		
	    if($curr == "Indian") {
	    	//if($date1 <= '2020-11-21'){
	           if($cata == 'Premium Delegate') {
	    			$rate = "5000";
			    	$rate_org = "5000";
	           }else if($cata == 'Conference Delegate') {
	    			$rate = "0";
			    	$rate_org = "Free";
	    		}/*else if($org_reg_type == 'Attendees/Visitors') {
	    			$rate = "00";
			    	$rate_org = "00";
	    		} */
	    	/*}else if($date1 >= '2020-11-13' && $date1 <= '2020-11-17'){
	    		if($org_reg_type == 'Premium Delegate') {
	    			$rate = "6000";
			    	$rate_org = "6000";
	    		}else if($org_reg_type == 'Standard Delegate') {
	    			$rate = "2000";
			    	$rate_org = "2000";
	    		}else if($org_reg_type == 'Attendees/Visitors') {
	    			$rate = "00";
			    	$rate_org = "00";
	    		}
	    	}else {//if($date1 >= '2020-11-18' && $date1 <= '2020-11-26'){
	    		if($org_reg_type == 'Premium Delegate') {
	    			$rate = "6000";
			    	$rate_org = "6000";
	    		}else if($org_reg_type == 'Standard Delegate') {
	    			$rate = "3000";
			    	$rate_org = "3000";
	    		}else if($org_reg_type == 'Attendees/Visitors') {
	    			$rate = "00";
			    	$rate_org = "00";
	    		}
	    	}*/
	    	/*if($date1 <= '2019-11-13') {
	    		if($org_reg_type == 'Industry') {
	    			if( $num_dele <= '200') {
	    				$rate = "2000";
		    			$rate_org = "2000";
	    			} else if( $num_dele >= '201' && $num_dele <= '600') {
	    				$rate = "2000";
			    		$rate_org = "2000";
	    			} else if( $num_dele >= '601' && $num_dele <= '1500') {
	    				$rate = "2000";
		    			$rate_org = "2000";
	    			} else if( $num_dele >= '1001') {
	    				$rate = "2000";
		    			$rate_org = "2000";
	    			}	
		    	}
	    	} else */
			/*if($date1 <= '2019-11-17') {
	    		if($org_reg_type == 'Industry') {
		    		if( $num_dele <= '600') {
	    				$rate = "3000";
			    		$rate_org = "3000";
	    			} else if( $num_dele >= '601' && $num_dele <= '1500') {
	    				$rate = "3000";
		    			$rate_org = "3000";
	    			} else if( $num_dele >= '1501') {
	    				$rate = "3000";
		    			$rate_org = "3000";
	    			} 
		    	}
	    	} else {*///if($date1 >= '2019-11-18') {
	    		/*if($org_reg_type=='Industry') {
	    			if( $num_dele <= '1500') {
	    				$rate = "5000";
		    			$rate_org = "5000";
	    			} else if( $num_dele >= '1501') {
	    				$rate = "5000";
		    			$rate_org = "5000";
	    			}
	    		}*/
				/*$rate = "5000";
		    	$rate_org = "5000";
	    	} else if($date1 >= '2019-11-18') {
	    		if($org_reg_type == 'Industry') {
	    				$rate = "5000";
		    			$rate_org = "5000";
	    			
	    		}
	    	}*/
	    	
			/*if($org_reg_type == 'Student') {
				$rate = "2000";
				$rate_org = "2000";
			} else if($org_reg_type == 'Poster') {
				if($res['sub_delegates'] == 1) {
					$rate = "3000";
					$rate_org = "3000";
					$cata = 'Poster Presenters';
				} else if($res['sub_delegates'] == 2) {
					if($i == 1) {
						$rate = "3000";
						$rate_org = "3000";
						$cata = 'Poster Presenters';
					} else if($i == 2) {
						$rate = "Free";
						$rate_org = "Free";
						$cata = 'Poster Co-Author';
					}
				} else if($res['sub_delegates'] == 3 || $res['sub_delegates'] == 4) {
					if($i == 1) {
						$rate = "3000";
						$rate_org = "3000";
						$cata = 'Poster Presenters';
					} else if($i == 2) {
						$rate = "Free";
						$rate_org = "Free";
						$cata = 'Poster Co-Author';
					} else if($i == 3) {
						$rate = "1500";
						$rate_org = "1500";
						$cata = 'Poster Co-Author';
					} else if($i == 4) {
						$rate = "1500";
						$rate_org = "1500";
						$cata = 'Poster Co-Author';
					}
				}
			}*/
			
			if($assoc_name=="STPI"){				
				$rate = "2000";
				$rate_org = "2000";
				
			}
			
			if($assoc_name=="Program-Coordinators"){				
				$rate = "2000";
				$rate_org = "2000";
				
			}
			
			if($assoc_name=="Faculty"){				
				$rate = "1500";
				$rate_org = "1500";
				
			}
			
			if($assoc_name=="Student-Coordinator"){				
				$rate = "2000";
				$rate_org = "2000";
				
			}
			
			if($assoc_name=="UK-StartUps"){				
				$rate = "2000";
				$rate_org = "2000";
			}
			
			if($assoc_name=="Session-StartUps"){				
				$rate = "2000";
				$rate_org = "2000";
			}
	    	
	    	/*if($cata == '3 Days' || $cata == 'Full Delegate' ||  $cata == '3 days with speaker offer' || $cata == '3 days with power bank offer') {
		    	$rate = "3000";
		    	$rate_org = "3000";
	    	} else if($cata == 'Single Day-Nov 29th,Nov 30th,Dec 1st') {
		    	$rate = 1750 * 3;
		    	$rate_org = 1750 * 3;
	    	} else if($cata == 'Single Day-Nov 29th,Nov 30th' || $cata == 'Single Day-Nov 29th,Dec 1st' || $cata == 'Single Day-Nov 30th,Dec 1st') {
		    	$rate = 1750 * 2;
		    	$rate_org = 1750 * 2;
	    	} else if($cata == 'Single Day-Nov 29th' || $cata == 'Single Day-Nov 30th' || $cata == 'Single Day-Dec 1st') {
		    	$rate = 1750;
		    	$rate_org = 1750;
	    	}else if($cata=='3 Days' && $date1<='2019/09/30') {
	    		$rate = "3000";
		    	$rate_org = "3000";
	    	}else if($cata=='3 Days' && $date1>='2019/10/01' && $date1<='2019/10/31') {
	    		$rate = "6000";
		    	$rate_org = "6000";
	    	}else if($org_reg_type=='Student') {
	    		$rate = "3000";
		    	$rate_org = "3000";
	    	} else if($cata == 'Single Day-Student-Day 1,Day 2,Day 3') {
		    	$rate = 500 * 3;
		    	$rate_org = 500 * 3;
	    	} else if($cata == 'Single Day-Student-Day 1,Day 2' || $cata == 'Single Day-Student-Day 1,Day 3' || $cata == 'Single Day-Student-Day 2,Day 3') {
		    	$rate = 500 * 2;
		    	$rate_org = 500 * 2;
	    	} else if($cata == 'Single Day-Student-Day 1' || $cata == 'Single Day-Student-Day 2' || $cata == 'Single Day-Student-Day 3') {
		    	$rate = 500;
		    	$rate_org = 500;
	    	} else if($cata == 'Single Day-Industry-Day 1,Day 2,Day 3') {
		    	$rate = 1500 * 3;
		    	$rate_org = 1500 * 3;
	    	} else if($cata == 'Single Day-Industry-Day 1,Day 2' || $cata == 'Single Day-Industry-Day 1,Day 3' || $cata == 'Single Day-Industry-Day 2,Day 3') {
		    	$rate = 1500 * 2;
		    	$rate_org = 1500 * 2;
	    	} else if($cata == 'Single Day-Industry-Day 1' || $cata == 'Single Day-Industry-Day 2' || $cata == 'Single Day-Industry-Day 3') {
		    	$rate = 1500;
		    	$rate_org = 1500;
	    	}else if($cata == 'ABAI Single Day-Industry-Day 2') {
		    	$rate = 500;
		    	$rate_org = 500;
	    	} else if($cata == 'ABAI Single Day-Student-Day 2') {
		    	$rate = 250;
		    	$rate_org = 250;
	    	} else if($cata == 'YESSS Abstract Presenter - 3 days') {
	    		$rate = 1500;
	    		$rate_org = 1500;
			} */
        } else if($curr == "Foreign") {
        	//if($date1 <= '2020-11-12'){
                if($cata == 'International Premium Delegate'){
	    				$rate = "100";
			    		$rate_org = "100";
                } else if($cata == 'Conference Delegate') {
	    			$rate = "0";
			    	$rate_org = "Free";
	    		}/* else if($org_reg_type == 'Conference Delegate'){
	    				$rate = "100";
			    		$rate_org = "100";
	    		}else if($org_reg_type == 'Attendees/Visitors'){
	    				$rate = "000";
			    		$rate_org = "000";
	    		} */
	    	/*}else if($date1 >= '2020-11-13' && $date1 <= '2020-11-17'){
	    		if($org_reg_type == 'Premium Delegate'){
	    				$rate = "200";
			    		$rate_org = "200";
	    		}else if($org_reg_type == 'Conference Delegate'){
	    				$rate = "200";
			    		$rate_org = "200";
	    		}else if($org_reg_type == 'Attendees/Visitors'){
	    				$rate = "000";
			    		$rate_org = "000";
	    		}
	    	}else { //if($date1 >= '2020-11-18' && $date1 <= '2020-11-26'){
	    		if($org_reg_type == 'Premium Delegate'){
	    				$rate = "200";
			    		$rate_org = "200";
	    		}else if($org_reg_type == 'Conference Delegate'){
	    				$rate = "200";
			    		$rate_org = "200";
	    		}else if($org_reg_type == 'Attendees/Visitors'){
	    				$rate = "000";
			    		$rate_org = "000";
	    		}
	    	}*/
		}
		
		$amt = $amt + $rate;
		//echo $amt;
		$pas1 = $fname . "123";
		$pas2 = md5($pas1);
	
	    if( ($title == "") || ($fname == "") || ($lname == "") || ($job_title == "") || ($badge == "") || ($email == "")) {
			echo "<script language='javascript'>alert('Provided all required details of all $lmt delegates.');</script>";
			echo "<script language='javascript'>window.location='registration-conference5.php?en=$en&assoc_name=$assoc_name';</script>";
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
		/*$totalRegistrations = 200;
		if($totalRegistrations >= 0 && $totalRegistrations <= 100) {
			$adminDiscount = $admin_discount = 90;
		} else if($totalRegistrations >= 101 && $totalRegistrations <= 200) {
			$adminDiscount = $admin_discount = 80;
		} else if($totalRegistrations >= 201 && $totalRegistrations <= 300) {
			$adminDiscount = $admin_discount = 70;
		} else if($totalRegistrations >= 301 && $totalRegistrations <= 400) {
			$adminDiscount = $admin_discount = 60;
		} else if($totalRegistrations >= 401 && $totalRegistrations <= 500) {
			$adminDiscount = $admin_discount = 50;
		} else if($totalRegistrations >= 501 && $totalRegistrations <= 600) {
			$adminDiscount = $admin_discount = 40;
		}  else if($totalRegistrations >= 601 && $totalRegistrations <= 700) {
			$adminDiscount = $admin_discount = 30;
		} else if($totalRegistrations >= 701 && $totalRegistrations <= 800) {
			$adminDiscount = $admin_discount = 20;
		} else if($totalRegistrations >= 801 && $totalRegistrations <= 900) {
			$adminDiscount = $admin_discount = 10;
		} else if($totalRegistrations >= 901 && $totalRegistrations <= 1000) {
			$adminDiscount = $admin_discount = 5;
		}*/
		
		//$adminDiscount = $admin_discount = 80;
		
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
			/*if($res['assoc_name'] == 'NASSCOM' || $res['assoc_name'] == 'NextBigWhat' || $res['assoc_name'] == 'IAMAI' || 
				$res['assoc_name'] == '91 Spring Board' || $res['assoc_name'] == 'Your Story' || $res['assoc_name'] == 'Work Bench Projects' || 
			$res['assoc_name'] == 'IACC' || $res['assoc_name'] == 'Startup Cell' || $res['assoc_name'] == 'STPI' || $res['assoc_name'] == 'IESA' || $res['assoc_name'] == 'KBITS' ) {
					$membershipDiscount = 20;
					$membership_discount = round(($main_amt * $membershipDiscount) / 100);
					$main_amt = $main_amt - $membership_discount;
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
		} else if (($res ['gr_type'] == "Group") && ($res ['sub_delegates'] >= "3")) {

			$amt_per_del = $main_amt = $res ['selection_amt'];

			//if($res['org_reg_type'] != 'Poster') {
				$gr_discount=round(($amt_per_del * 10)/100);
			//}
			

			/*if(!empty($adminDiscount)) {
				$admin_discount = round(($main_amt * $adminDiscount) / 100);
			}*/
			$main_amt = $main_amt - $gr_discount;


			/*if($res['assoc_name'] == 'NASSCOM' || $res['assoc_name'] == 'NextBigWhat' || $res['assoc_name'] == 'IAMAI' ||
			$res['assoc_name'] == '91 Spring Board' || $res['assoc_name'] == 'Your Story' || $res['assoc_name'] == 'Work Bench Projects' ||
			$res['assoc_name'] == 'IACC' || $res['assoc_name'] == 'Startup Cell' || $res['assoc_name'] == 'STPI' || $res['assoc_name'] == 'IESA' || $res['assoc_name'] == 'KBITS' ) {
					$membershipDiscount = 20;
					$membership_discount = round(($main_amt * $membershipDiscount) / 100);
					$main_amt = $main_amt - $membership_discount;
			}*/
			/*if($res['member_of_assoc'] == 'Yes') {
				$membershipDiscount = 10;
				$membership_discount = round(($main_amt * $membershipDiscount) / 100);
				$main_amt = $main_amt - $membership_discount;
			}*/
			/*if(!empty($res['assoc_name'])) {
				if($res['assoc_name'] == 'Karnataka Startup Cell' || $res['assoc_name'] == 'Karnataka Incubators' || $res['assoc_name'] == 'KBITS StartUp Member') {
					$membershipDiscount = 50;	
				}/* else {
					$membershipDiscount = 20;					
				}*/

				/*$membership_discount = round(($main_amt * $membershipDiscount) / 100);
				$main_amt = $main_amt - $membership_discount;
			}*/
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
		if($res['gr_type']=='Group' && $res['sub_delegates'] >= 3){
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
	
	//echo $gr_discount;
	//echo '----'.$total;exit;
	if($res['pay_status'] == 'Not Paid') {
    	if($total == 0) {
    		echo "<script language='javascript'>alert('Very rare condition occurs. Please try after 30 sec..');</script>";
    		mysqli_query($link,"DELETE FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
    		session_destroy();
    		if(!empty($assoc_name)) {
    			echo "<script language='javascript'>window.location = 'registration-conference.php?en=$en&assoc_name=$assoc_name';</script>";
    		} else {
    			echo "<script language='javascript'>window.location = 'registration-conference.php?en=$en';</script>";
    		}
    		exit;
    	}
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
	echo "<script language='javascript'>window.location = 'registration-conference7.php?en=$en&assoc_name=$assoc_name';</script>";
	exit;
?>
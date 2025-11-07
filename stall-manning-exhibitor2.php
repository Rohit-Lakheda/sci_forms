<?php
	session_start();
	require "includes/form_constants_both.php";
	require "dbcon_open.php";
	//print_r($_POST);exit;
	$en = '';
	//$eventName = 'Bengaluru Tech Summit';
	$event_name = 'Bangalore IT';
	
	//=========== ORG
	$_SESSION['org1'] = mysqli_escape_string($link,htmlspecialchars($_POST['org1']));
	$_SESSION['title1'] = mysqli_escape_string($link,htmlspecialchars($_POST['title1']));
	$_SESSION['fname1'] = mysqli_escape_string($link,htmlspecialchars((@$_POST['fname1'])));
	$_SESSION['lname1'] = mysqli_escape_string($link,htmlspecialchars(@$_POST['lname1']));
	//$_SESSION['event_know'] = mysqli_real_escape_string($link,@$_POST['addr1']);
	//$_SESSION['event_know'] = mysqli_real_escape_string($link,@$_POST['addr2']);
	$_SESSION['desig1'] = mysqli_escape_string($link,htmlspecialchars(($_POST['desig1'])));
	$_SESSION['mob1'] = mysqli_escape_string($link,htmlspecialchars((@$_POST['mob1'])));
	$_SESSION['email1'] = mysqli_escape_string($link,htmlspecialchars($_POST['email1']));
	$assoc_code =mysqli_escape_string($link,htmlspecialchars( @$_POST['promo_code']));
	
	$promo_code = $assoc_code = trim($assoc_code);
	

    if (empty($_SESSION["vercode_ex"]) || ($_POST["vercode_ex"] != $_SESSION["vercode_ex"])) {
        session_destroy();
        echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		if(!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'stall-manning-exhibitor.php?a=$assoc_code';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'stall-manning-exhibitor.php?a=$assoc_code';</script>";
		}
        exit;
    }
	
	$assoc_srno =mysqli_escape_string($link,htmlspecialchars( @$_POST['assoc_srno']));
	
	$user_type = mysqli_escape_string($link,htmlspecialchars(@$_POST['user_type']));
	
	$promo_code =mysqli_escape_string($link,htmlspecialchars( @$_POST['promo_code']));
	

	if(!empty($assoc_srno) && !empty($user_type)) {
		$sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_STALL_MANNING_TBL WHERE srno=$assoc_srno AND assoc_name='$user_type' AND promo_code='$promo_code'";
		
		$resulre = mysqli_query($link,$sql);
		//echo $sql;exit;
		if(mysqli_num_rows($resulre) <= 0) {
			echo "<script language='javascript'>alert('Invalid promo code. Please try again!');</script>";
			echo "<script language='javascript'>window.location='stall-manning-exhibitor.php';</script>";
			exit;
		}
		$resulre = mysqli_fetch_assoc($resulre);
		
	} else {
		echo "<script language='javascript'>alert('Invalid promo code. Please try again!');</script>";
		echo "<script language='javascript'>window.location='stall-manning-exhibitor.php';</script>";
		exit;
	}

	
	$org1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['org1']));
	$title1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['title1']));
	$fname1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['fname1']));
	$lname1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['lname1']));
	$desig1 = mysqli_escape_string($link,htmlspecialchars($_POST['desig1']));
	$mob1 =mysqli_escape_string($link,htmlspecialchars( @$_POST['mob1']));
	$email1=mysqli_escape_string($link,htmlspecialchars(@$_POST['email1']));
	
	if(($org1 == "") ||  ($title1 == "") || ($fname1 == "") || ($lname1 == "")  || ($desig1 == "")  || ($mob1 == "")  || ($email1 == "")){
	    echo "<script language='javascript'>alert('Provided all required (* marked) details .');</script>";
	    echo "<script language='javascript'>window.location = 'stall-manning-exhibitor.php?a=$assoc_code';</script>";
	    exit;
	}

	
	
	$ddate  = date("Y-m-d");
	$ttime  = date("H:i:s A");
	$reg_id = mysqli_escape_string($link,htmlspecialchars($_SESSION['vercode_ex']));
	$ret    = @$_GET['ret'];
	
	if ($ret == "retds4fu324rn_ed24d3it") {
	    mysqli_query($link,"delete from " . $EVENT_DB_FORM_STALL_MANNING_TBL_DEMO . " where reg_id = '$reg_id' ") or die(mysqli_error($link));
	}
	
	//$qr_chk_exb_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_PHASE_2 WHERE (exhibitor_id='$resulre[code]') " );
	//$qr_chk_exb_ans = mysqli_fetch_array ( $qr_chk_exb_id );
	$reg_date = date('Y-m-d H:i:s');
	$temp_total_exbhitors = 1;
	for($j_exb = 1; $j_exb <= $temp_total_exbhitors; $j_exb ++) {
		$org = mysqli_escape_string($link,htmlspecialchars(@$_POST['org' . $j_exb]));
		$title = mysqli_escape_string($link,htmlspecialchars(@$_POST ['title' . $j_exb]));
		$fname = mysqli_real_escape_string($link,@$_POST ['fname' . $j_exb]);
		// $mname = @$_POST ['mname' . $j_exb];
		$lname = mysqli_real_escape_string($link,@$_POST ['lname' . $j_exb]);
		$desig = mysqli_real_escape_string($link,@$_POST ['desig' . $j_exb]);
		$mob = mysqli_escape_string($link,htmlspecialchars($_POST ['mob' . $j_exb]));
		$email = mysqli_escape_string($link,htmlspecialchars(@$_POST ['email' . $j_exb]));
		$del_category = mysqli_escape_string($link,htmlspecialchars(@$_POST ['del_category' . $j_exb]));
		
		if (($org != "") && ($title != "") && ($fname != "") && ($lname != "") && ($desig != "") && ($email != "") && ($del_category != "") && ($mob != "")) {
			mysqli_query ($link, "INSERT INTO $EVENT_DB_FORM_STALL_MANNING_TBL_DEMO 
			(exhibitor_id,title,fname,lname,email,desig,mob,category,reg_id,promo_code,org,reg_date) values
			('$qr_chk_exb_ans[exhibitor_id]','$title','$fname','$lname','$email','$desig','$mob','$del_category', '$reg_id', '$promo_code', '$org', '$reg_date')") or die ( mysqli_error ($link) );
		}
	}
	//exit;
	echo "<script language='javascript'>window.location = 'stall-manning-exhibitor3.php?a=$assoc_code';</script>";
	exit;
?>
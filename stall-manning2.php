<?php
	session_start();
	require "includes/form_constants_both.php";
	//print_r($_POST);exit;
	$en = '';
	//$eventName = 'Bengaluru Tech Summit';
	$event_name = 'Bangalore IT';
	
	//=========== ORG
	$_SESSION['title1'] = $_POST['title1'];
	$_SESSION['fname1'] = (@$_POST['fname1']);
	$_SESSION['lname1'] = @$_POST['lname1'];
	//$_SESSION['event_know'] = mysqli_real_escape_string($link,@$_POST['addr1']);
	//$_SESSION['event_know'] = mysqli_real_escape_string($link,@$_POST['addr2']);
	$_SESSION['desig1'] = ($_POST['desig1']);
	$_SESSION['mob1'] = (@$_POST['mob1']);
	$_SESSION['email1'] = $_POST['email1'];
	$assoc_code = @$_POST['promo_code'];
	$promo_code = $assoc_code = trim($assoc_code);

    if (empty($_SESSION["vercode_ex"]) || ($_POST["vercode_ex"] != $_SESSION["vercode_ex"])) {
        session_destroy();
        echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		if(!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'stall-manning.php?a=$assoc_code';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'stall-manning.php?a=$assoc_code';</script>";
		}
        exit;
    }
	require "dbcon_open.php";
	$assoc_srno = @$_POST['assoc_srno'];
	$user_type = @$_POST['user_type'];
	if(!empty($assoc_srno) && !empty($user_type)) {
		$sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_STALL_MANNING_TBL WHERE srno=$assoc_srno AND assoc_name='$user_type' AND promo_code='$promo_code'";
		$resulre = mysqli_query($link,$sql);
		//echo $sql;exit;
		if(mysqli_num_rows($resulre) <= 0) {
			echo "<script language='javascript'>alert('Invalid promo code. Please try again!');</script>";
			echo "<script language='javascript'>window.location='stall-manning.php';</script>";
			exit;
		}
		$resulre = mysqli_fetch_assoc($resulre);
		/*
		$promo_code = @$_POST['promo_code'];
		if($resulre['promo_code'] != $promo_code) {
			echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
			echo "<script language='javascript'>window.location='stall-manning.php';</script>";
			exit;
		}*/
	} else {
		echo "<script language='javascript'>alert('Invalid promo code. Please try again!');</script>";
		echo "<script language='javascript'>window.location='stall-manning.php';</script>";
		exit;
	}
	
	$title1 = @$_POST['title1'];
	$fname1 = @$_POST['fname1'];
	$lname1 = @$_POST['lname1'];
	$desig1 = $_POST['desig1'];
	$mob1 = @$_POST['mob1'];
	$email1=@$_POST['email1'];
	
	if( ($title1 == "") || ($fname1 == "") || ($lname1 == "")  || ($desig1 == "")  || ($mob1 == "")  || ($email1 == "")){
	    echo "<script language='javascript'>alert('Provided all required (* marked) details .');</script>";
	    echo "<script language='javascript'>window.location = 'stall-manning.php?a=$assoc_code';</script>";
	    exit;
	}

	
	
	$ddate  = date("Y-m-d");
	$ttime  = date("H:i:s A");
	$reg_id = $_SESSION['vercode_ex'];
	$ret    = @$_GET['ret'];
	
	if ($ret == "retds4fu324rn_ed24d3it") {
	    mysqli_query($link,"delete from " . $EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_DEMO_PHASE_2 . " where reg_id = '$reg_id' ") or die(mysqli_error($link));
	}
	
	$qr_chk_exb_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_PHASE_2 WHERE (exhibitor_id='$resulre[code]') " );
	$qr_chk_exb_ans = mysqli_fetch_array ( $qr_chk_exb_id );

	$temp_total_exbhitors = 1;
	for($j_exb = 1; $j_exb <= $temp_total_exbhitors; $j_exb ++) {
		$title = @$_POST ['title' . $j_exb];
		$fname = mysqli_real_escape_string($link,@$_POST ['fname' . $j_exb]);
		// $mname = @$_POST ['mname' . $j_exb];
		$lname = mysqli_real_escape_string($link,@$_POST ['lname' . $j_exb]);
		$desig = mysqli_real_escape_string($link,@$_POST ['desig' . $j_exb]);
		$mob = $_POST ['mob' . $j_exb];
		$email = @$_POST ['email' . $j_exb];
		$del_category = $qr_chk_exb_ans['category'];//@$_POST ['del_category' . $j_exb];
		
		if (($title != "") && ($fname != "") && ($lname != "") && ($desig != "") && ($email != "") && ($del_category != "") && ($mob != "")) {
			mysqli_query ($link, "INSERT INTO $EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_DEMO_PHASE_2 
			(exhibitor_id,title,fname,lname,email,desig,mob,category,reg_id,promo_code) values
			('$qr_chk_exb_ans[exhibitor_id]','$title','$fname','$lname','$email','$desig','$mob','$del_category', '$reg_id', '$promo_code')") or die ( mysqli_error ($link) );
		}
	}
	//exit;
	echo "<script language='javascript'>window.location = 'stall-manning3.php?a=$assoc_code';</script>";
	exit;
?>
<?php
	session_start();
	require "includes/form_constants_both.php";
	
	//print_r($_POST);exit;

    if (empty($_SESSION["vercode_drone"]) || ($_POST["vercode"] != $_SESSION["vercode_drone"])) {
        session_destroy();
        echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		echo "<script language='javascript'>window.location = 'drone-racing.php';</script>";
        exit;
    }
	require "dbcon_open.php";
	
	$ddate  = date("Y-m-d");
	$ttime  = date("H:i:s A");
	$reg_id = $_SESSION['vercode_drone'];
	$ret    = @$_GET['ret'];
	$_SESSION = $_POST;
	$_SESSION["vercode_drone"] = $reg_id;

	if ($ret == "retds4fu324rn_ed24d3it") {
	    mysqli_query($link,"delete from " . $EVENT_DB_FORM_DRONE_RACING_DEMO . " where reg_id = '$reg_id' ") or die(mysqli_error($link));
	}

	//print_r($_POST);exit;
	$pay_status = "Not Paid";
	$paymode    = @$_POST['paymode'];
	$dollar      = "1";
	$amt_ext     = "Rs.";
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$nickname = $_POST['nickname'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$phone = $_POST['foneCountryCode'] .'-' . $_POST['phone'];
	$addr1 = $_POST['addr1'];
	$addr2 = $_POST['addr2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$pin = $_POST['pin'];
	$skill_level = $_POST['skill_level'];
	$drone_experience = $_POST['drone_experience'];
	$rate_org = $amt = 1000;

	$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_DRONE_RACING . " WHERE email = '$email'") or die(mysqli_error($link));
	if(mysqli_num_rows($qry)) {
		echo "<script language='javascript'>alert('Entered email address already registered with us. Please use another email address.');</script>";
		echo "<script language='javascript'>window.location = 'drone-racing.php?ret=retds4fu324rn_ed24d3it';</script>";
        exit;
	}

	mysqli_query($link,"insert into " . $EVENT_DB_FORM_DRONE_RACING_DEMO . "(paymode,pay_status,amt_ext,selection_amt,total,reg_id,reg_date,reg_time,dollar, fname ,lname ,nickname ,email ,dob ,gender,phone ,addr1 ,addr2 ,city ,state ,country ,pin ,skill_level ,drone_experience) values ('$paymode','$pay_status','$amt_ext','$rate_org','$amt','$reg_id','$ddate','$ttime','$dollar', '$fname','$lname','$nickname','$email','$dob','$gender','$phone','$addr1','$addr2','$city','$state','$country','$pin','$skill_level','$drone_experience')") or die(mysqli_error($link));
	
	$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_DRONE_RACING_DEMO . " WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
	$res = mysqli_fetch_array($qry);
	
	//----------------------------------------- End Geneating Tin Number ----------------------------------------------------
	
	$tin_no = $EVENT_DB_TIN_NO="TIN-".strtoupper($EVENT_TABLE_PRFIX).'DR'.$EVENT_YEAR."-";

	$tin_no1 = "";
	
	$i = 0;
	$j = 0;
	
	$temp_srno_gt = $res['srno'];
	do {
	    $i = $j = 0;
	    
	    $tin_no1 = $tin_no . $temp_srno_gt . mt_rand(1, 99999);
	    
	    $qry    = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_DRONE_RACING_DEMO . " WHERE tin_no = '$tin_no1'");
	    $res_no = mysqli_num_rows($qry);
	    
	    $qry1    = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_DRONE_RACING . " WHERE tin_no = '$tin_no1'");
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
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_DRONE_RACING_DEMO . " SET tin_no = '$tin_no1' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));

	//exit;
	echo "<script language='javascript'>window.location = 'drone-racing3.php';</script>";
	exit;
?>
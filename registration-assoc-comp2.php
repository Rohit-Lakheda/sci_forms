<?php
	session_start();
	$sector = $_POST['sector'];
	require "includes/form_constants_both.php";
	//print_r($_POST);exit;
	$event_name = 'Bangalore IT';
	
	$assoc_name = @$_POST['assoc_name'];
	$assoc_name = trim($assoc_name);
	
	$assoc_code = @$_POST['promo_code'];
	$assoc_code = trim($assoc_code);

    if (empty($_SESSION["vercode_reg"]) || ($_POST["vercode"] != $_SESSION["vercode_reg"])) {
        session_destroy();
        echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		if(!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
		}
        exit;
    }

	$conf_type = "Virtual Conference";
	if($conf_type==""){
		session_destroy();
	    echo "<script language='javascript'>alert('Please select delegate type.');</script>";
	    echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
	    exit;
	}

	$cata_m = @$_POST['cata_m'];
	if ($cata_m == "") {
	    session_destroy();
	    echo "<script language='javascript'>alert('Please select delegate type.');</script>";
	    if(!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
		}
	    exit;
	}

	//print_r($_POST);exit;
	$total_dele = $_POST['total_dele'];
	if ($cata_m == "Poster") {
		if($total_dele == 'No') {
			$total_dele = 1;
		} else if($total_dele == '1') {
			$total_dele = 2;
		} else if($total_dele == '2') {
			$total_dele = 3;
		} else if($total_dele == '3') {
			$total_dele = 4;
		}
	}

	if (empty($total_dele)) {
		session_destroy();
		echo "<script language='javascript'>alert('Please select number of delegate.');</script>";

		if(!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
		}
		exit;
	}
	
	//require("includes/form_constants.php");
	require "dbcon_open.php";
	
	$ddate  = date("Y-m-d");
	$ttime  = date("H:i:s A");
	$reg_id = $_SESSION['vercode_reg'];
	$ret    = @$_GET['ret'];
	
	if ($ret == "retds4fu324rn_ed24d3it") {
	    mysqli_query($link,"delete from " . $EVENT_DB_FORM_REG_DEMO . " where reg_id = '$reg_id' ") or die(mysqli_error($link));
	}
	
	//$cata = @$_POST['cata'];
	
	//print_r($_POST);exit;
	$curr       = @$_POST['curr'];
	$pay_status = "Complimentary";
	$paymode    = @$_POST['paymode'];
	//$grp        = $_POST['grp'];
	$member_of_assoc = @$_POST['member_of_assoc'];
	$grp = 'Group';
	if ($total_dele == 1) {
	    $grp = 'Single';
	}
	
	if ($grp != "Single") {
	    if (($total_dele > 7) || ($total_dele <= 1)) {
	        session_destroy();
	        echo "<script language='javascript'>alert('In group min 2 and maximum 7 delegates are allowed.');</script>";
	        if(!empty($assoc_name)) {
				echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
			} else {
				echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
			}
	        exit;
	    }
	}
	
	$lmt = $total_dele;
	
	for($j = 1; $j <= $lmt; $j ++) {
		$email = @$_POST ['email_m' . $j];
		$field = "email" . $j;
		$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'" ) or die ( mysqli_error ($link) );
		$num_row = mysqli_num_rows ( $qr );
		if ($num_row > 0) {
			echo "<script language='javascript'>alert('Provided email id $email, is alredy registered with us.');</script>";
			echo "<script language='javascript'>window.location='registration-assoc-comp.php?a=$assoc_code';</script>";
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
		echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
		exit;
	}
	
	$event_know = @$_POST['event_know'];
	if ($curr == "Indian" && $sector == 'Bio Technology') {
		if ($member_of_assoc == "Yes") {
			$promo_code = @$_POST['promo_code'];
			/*if($promo_code != $PROMO_CODE) {
				echo "<script language='javascript'>alert('Please enter valid Genotypic Techchnology Member Code.');</script>";
				if(!empty($assoc_name)) {
					echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
				} else {
					echo "<script language='javascript'>window.location = 'registration-assoc-comp.php';</script>";
				}
				exit;
			}*/
		}
		if(empty($event_know)) {
				echo "<script language='javascript'>alert('Please Select How do you know about Bangalore Bio 2017.');</script>";
				if(!empty($assoc_name)) {
					echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
				} else {
					echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
				}
				exit;
		} else {
			if($event_know == 'Others') {
				if(empty($_POST['other_value'])) {
					echo "<script language='javascript'>alert('Please enter other value of How do you know about Bangalore Bio 2017.');</script>";
					if(!empty($assoc_name)) {
						echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
					} else {
						echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?a=$assoc_code';</script>";
					}
					exit;
				}
				$event_know .= '-' . @$_POST['other_value'];
			}
		}
	} else {
		//$member_of_assoc = '';
	}
	
	$assoc_srno = @$_POST['assoc_srno'];
	$user_type = @$_POST['user_type'];
	$promo_code = '';
	if(!empty($assoc_srno) && !empty($user_type)) {
		$sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_TBL WHERE srno=$assoc_srno AND assoc_name='$user_type'";
		$resulre = mysqli_query($link,$sql);
		if(mysqli_num_rows($resulre) <= 0) {
			echo "<script language='javascript'>alert('Invalid promo code. Please try again!');</script>";
			echo "<script language='javascript'>window.location='registration-assoc-comp.php?a=$assoc_code';</script>";
			exit;
		}
		$resulre = mysqli_fetch_assoc($resulre);
		$promo_code = @$_POST['promo_code'];
		if($resulre['promo_code'] != $promo_code) {
			echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
			echo "<script language='javascript'>window.location='registration-assoc-comp.php?a=$assoc_code';</script>";
			exit;
		}
	}
	
	//$assoc_name = str_replace('_', ' ', $assoc_name);
	$amt_ext = "";
	$dollar  = "";
	$cata = $nationality = "";
	if($country == 'India'){
		$curr = 'Indian';
	    $dollar      = "1";
	    $amt_ext     = "Rs.";
	    $nationality = "Indian Organization";
	} else  {
		$curr = 'International';
	    $dollar      = $DOLLAR_RATE;;
	    $amt_ext     = "USD";
	    $nationality = "International Organization";
	}
	
	if ($_POST['cata'] != "") {
		$cata = $_POST['cata'];
	}
	
	//$dollar      = "1";
	//$amt_ext     = "Rs.";
	/* if ($_POST['daytype'] != "") {
		$cata .= $_POST['daytype'];
	} */
	if($cata_m == 'Poster') {
		 $EVENT_DB_TIN_NO="TIN-BTS".$EVENT_YEAR."-PSTR-";

		 if($sector == 'Bio Technology') {		
			$EVENT_DB_TIN_NO="TIN-BTS".$EVENT_YEAR."-PSTR-";
		}
	}
	$paymode = 'Complimentary';
	
	$rate_org = $amt = $temp_sess_sp_msg = 0;
	mysqli_query($link,"insert into " . $EVENT_DB_FORM_REG_DEMO . "(org_reg_type,nationality,cata,curr,gr_type,sub_delegates,paymode,pay_status,amt_ext,amt_per_del,selection_amt,total,reg_id,reg_date,reg_time,sp_msg,dollar,assoc_name,member_of_assoc,assoc_srno,user_type,conference_type) values ('$cata_m','$nationality','$cata','$curr','$grp','$total_dele','$paymode','$pay_status','$amt_ext','$rate_org','$amt','$amt','$reg_id','$ddate','$ttime','$temp_sess_sp_msg','$dollar','$assoc_name', '$member_of_assoc','$assoc_srno','$user_type','$conf_type')") or die(mysqli_error($link));
	
	$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
	$res = mysqli_fetch_array($qry);
	
	//----------------------------------------- End Geneating Tin Number ----------------------------------------------------
	
	$tin_no  = $EVENT_DB_TIN_NO;
	if($_POST['daytype'] == 'Single Day') {
		$tin_no = $EVENT_DB_TIN_NO="TIN-BTSSD".$EVENT_YEAR."-";
	}

	/*if($sector == 'Bio Technology') {		
		$tin_no = $EVENT_DB_TIN_NO="TIN-BIB".$EVENT_YEAR."-";

		if($_POST['daytype'] == 'Single Day') {
			$tin_no = $EVENT_DB_TIN_NO="TIN-BIBSD".$EVENT_YEAR."-";
		}
	}*/

	$tin_no1 = "";
	
	$i = 0;
	$j = 0;
	
	$temp_srno_gt = $res['srno'];
	do {
	    $i = $j = 0;
	    
	    $tin_no1 = $tin_no . $temp_srno_gt . mt_rand(1, 99999);
	    
	    $qry    = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE tin_no = '$tin_no1'");
	    $res_no = mysqli_num_rows($qry);
	    
	    $qry1    = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no1'");
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
	$pin = str_replace('TIN', 'PRN', $tin_no1);
	mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET tin_no = '$tin_no1', pin_no='$pin' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
	
	/*if(isset($_POST['daytype']) && !empty($_POST['daytype'])) {
		$offer = '';
		if($_POST['daytype'] == '3 days with speaker offer') {
			$offer = 'YOU ARE ALSO ENTITLED FOR A FREE <u>PHILIPS BT50B WIRELESS SPEAKER WORTH Rs. 2000 FREE</u> ALONG WITH THIS REGISTRATION.';
		} else if($_POST['daytype'] == '3 days with power bank offer') {
			$offer = 'YOU ARE ALSO ENTITLED FOR A FREE <u>MI 20800 MAH POWER BANK WORTH RS. 2,999 FREE</u> ALONG WITH THIS REGISTRATION.';
		}
		if(!empty($offer)) {
			mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET user_type = '$offer' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
		}
	}*/
	
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET event_name = '$event_name', sector = '$sector' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET event_know = '$event_know' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	
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
		$cata = @$_POST['cata'.$i];
		//$cata = $res['cata'];
	
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
	
	//exit;
	echo "<script language='javascript'>window.location = 'registration-assoc-comp3.php?a=$assoc_code';</script>";
	exit;
?>
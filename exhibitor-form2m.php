<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
	session_start ();
	//print_r($_POST);exit;
	$ret = @$_GET ['rt'];
	$return = @$_GET['ret'];
	$assoc_nm = @$_POST['assoc_nm'];
	if ($ret == "retds4fn324rn_ed24d3it") {
		if ((! isset ( $_SESSION ["vercode_ex"] )) || ($_SESSION ["vercode_ex"] == '')) {
			//session_destroy ();
			echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
			echo "<script language='javascript'>window.location = ('exhibitor-form.php?assoc_nm=$assoc_nm');</script>";
			exit ();
		}
		$text = $_SESSION ["vercode_ex"];
	} else {
		if (($_POST ["vercode_ex"] != $_SESSION ["vercode_ex"]) || ($_SESSION ["vercode_ex"] == '')) {
			//session_destroy ();
			echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
			echo "<script language='javascript'>window.location = ('exhibitor-form.php?assoc_nm=$assoc_nm');</script>";
			exit ();
		}
	}
	
	require "includes/form_constants.php";
	
	require "dbcon_open.php";
	
	
	$temp_booth_no = @$_POST ['booth_no'];
	$temp_booth_area = @$_POST ['booth_area'];
	/*if (($assoc_nm == "STPI") || ($assoc_nm == "KBITS")) {
		$temp_booth_area = 6;
	}*/
	$booth_space = @$_POST ['booth_space'];
	$temp_booth_area_unit = @$_POST ['booth_area_unit'];
	$temp_fascia_name = mysqli_real_escape_string($link,@$_POST ['fascia_name']);
	$temp_fascia_name = trim ( $temp_fascia_name );
	
	$temp_fascia_name_up = strtoupper ( $temp_fascia_name );
	
	$temp_exhi_name = mysqli_real_escape_string($link,@$_POST ['exhi_name']);
	$temp_exhi_name = trim ( $temp_exhi_name );
	$temp_exhi_name_up = strtoupper ( $temp_exhi_name );
	$temp_exhi_name_upwc = ucwords ( $temp_exhi_name );
	
	$temp_cp_title = @$_POST ['cp_title'];
	$temp_cp_title = trim ( $temp_cp_title );
	
	$temp_cp_fname = mysqli_real_escape_string($link,@$_POST ['cp_fname']);
	$temp_cp_fname = trim ( $temp_cp_fname );
	
	// $temp_cp_mname = @$_POST ['cp_mname'];
	// $temp_cp_mname = trim ( $temp_cp_mname );
	
	$temp_cp_lname = mysqli_real_escape_string($link,@$_POST ['cp_lname']);
	$temp_cp_lname = trim ( $temp_cp_lname );
	
	$temp_desig = @$_POST ['desig'];
	$temp_desig = trim ( $temp_desig );
	
	$temp_addr1 = mysqli_real_escape_string($link,@$_POST ['addr1']);
	$temp_addr2 = mysqli_real_escape_string($link,@$_POST ['addr2']);
	$temp_city = @$_POST ['city'];
	$temp_state = @$_POST ['state'];
	$temp_country = @$_POST ['country'];
	$temp_zip = @$_POST ['zip'];
	$temp_fon_cntry = @$_POST ['foneCountryCode'];
	// $temp_fon_area = @$_POST['fon_area'];
	$temp_fon = @$_POST ['fon'];
	$temp_mob_cntry = @$_POST ['cellnoCountryCode'];
	$temp_mob = @$_POST ['mob'];
	$temp_fax_cntry = @$_POST ['faxCountryCode'];
	// $temp_fax_area = @$_POST['fax_area'];
	$temp_fax = @$_POST ['fax'];
	$temp_email = @$_POST ['email'];
	$temp_email = strtolower ( trim ( $temp_email ) );
	$temp_website = @$_POST ['website'];
	$temp_reg_date = date ( "Y-m-d" );
	$temp_reg_time = date ( "H:i:s a" );
	$temp_reg_id = @$_POST ['vercode_ex'];
	$temp_profile = @$_POST ['exbhi_profile'];
	$temp_profile = mysqli_real_escape_string ($link, $temp_profile );
	$category = @$_POST['category'];
	/*$isother = false;
	if(!empty($_POST['exhi_profile'])) {
		foreach($_POST['exhi_profile'] as $rt) {
			if($rt == 'Other') {
				$isother = true;
			}
		}
	}
	$exhi_profile = implode('#', $_POST['exhi_profile']);
	if($isother) {
		$exhi_profile .= ' - ' . $_POST['exhi_profile-other'];
	}*/
	if(isset($_POST['exhi_profile'][0])) {
	   //$exhi_profile = implode('#', $_POST['exhi_profile']);
	   $exhi_profile = @$_POST['exhi_profile'][0];
	   if($exhi_profile == 'Other') {
			$exhi_profile .= ' - ' . @$_POST['exhi_profile-other'];
	   }
	}
	
	$keywords = $_POST['keywords'];
	
	$_SESSION ['sess_booth_booth_space'] = $booth_space;
	$_SESSION ['sess_booth_no'] = $temp_booth_no;
	$_SESSION ['sess_booth_area'] = $temp_booth_area;
	$_SESSION ['sess_booth_area_unit'] = $temp_booth_area_unit;
	$_SESSION ['sess_fascia_name'] = $temp_fascia_name;
	
	$_SESSION ['sess_exhi_name'] = $temp_exhi_name;
	$_SESSION ['sess_cp_title'] = $temp_cp_title;
	$_SESSION ['sess_cp_fname'] = $temp_cp_fname;
	// $_SESSION ['sess_cp_mname'] = $temp_cp_mname;
	$_SESSION ['sess_cp_lname'] = $temp_cp_lname;
	$_SESSION ['sess_desig'] = $temp_desig;
	$_SESSION ['sess_addr1'] = $temp_addr1;
	$_SESSION ['sess_addr2'] = $temp_addr2;
	$_SESSION ['sess_city'] = $temp_city;
	$_SESSION ['sess_state'] = $temp_state;
	$_SESSION ['sess_country'] = $temp_country;
	$_SESSION ['sess_zip'] = $temp_zip;
	$_SESSION ['sess_fon_cntry'] = $temp_fon_cntry;
	// $_SESSION['sess_fon_area'] = $temp_fon_area;
	$_SESSION ['sess_fon'] = $temp_fon;
	$_SESSION ['sess_mob_cntry'] = $temp_mob_cntry;
	$_SESSION ['sess_mob'] = $temp_mob;
	$_SESSION ['sess_fax_cntry'] = $temp_fax_cntry;
	// $_SESSION['sess_fax_area'] = $temp_fax_area;
	$_SESSION ['sess_fax'] = $temp_fax;
	$_SESSION ['sess_email'] = $temp_email;
	$_SESSION ['sess_website'] = $temp_website;
	$_SESSION ['sess_vercode_ex'] = $temp_reg_id;
	$_SESSION ['vercode_ex'] = $temp_reg_id;
	$_SESSION ['sess_category'] = $category;

	$_SESSION ['sess_exhi_profile'] = $exhi_profile;
	$_SESSION ['sess_keywords'] = $keywords;
	$_SESSION ['assoc_nm'] = $assoc_nm = @$_POST['assoc_nm'];
	
	$temp_reg_date = date ( "Y-m-d" );
	$temp_reg_time = date ( "H:i:s a" );
	
	$temp_profile = @$_POST ['exbhi_profile'];
	
	$prof = str_replace('&nbsp;', '', strip_tags ( $temp_profile ));
	$prof = preg_replace("/(\/[^>]*>)([^<]*)(<)/","\\1\\3",$prof);
	$prof = str_replace(array("\r","\n"),"",$prof);
	$temp_profile_len = strlen ($prof);
	//echo strip_tags ( $temp_profile );exit;
	//echo $temp_profile_len;
	//echo '<pre>' .$prof; exit;
	$_SESSION ['sess_exbhi_profile'] = $temp_profile;
	$temp_profile = mysqli_real_escape_string ($link, nl2br ( $temp_profile ) );
	
	if ($temp_profile_len > 750) {
		echo "<script language='javascript'>alert('Please Enter Profile less than or equal to 750 characters.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor-form.php?rt=retds4fn324rn_ed24d3it');</script>";
		exit ();
	}
	$temp_exhi_name_lower = strtolower ( $temp_exhi_name );
	
	// start checking duplicate exhibitor entry
	$qr_chk_exb_dup_name_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_PHASE_1 WHERE (LOWER(exhibitor_name)='$temp_exhi_name_lower') " );
	$qr_chk_exb_dup_name_id_num_rows = mysqli_num_rows ( $qr_chk_exb_dup_name_id );
	if ($qr_chk_exb_dup_name_id_num_rows > 0) {
		echo "<script language='javascript'>alert('Exhibitor- $temp_exhi_name is already registerd with us.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor-form.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit ();
	}
	
	$qr_chk_exb_dup_name_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_1 WHERE (LOWER(exhibitor_name)='$temp_exhi_name_lower') " );
	$qr_chk_exb_dup_name_id_num_rows = mysqli_num_rows ( $qr_chk_exb_dup_name_id );
	if ($qr_chk_exb_dup_name_id_num_rows > 0) {
		$qr_chk_exb_dup_name_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_1 WHERE (LOWER(exhibitor_name)='$temp_exhi_name_lower') " );
		$qr_chk_exb_dup_name_id_ans_rows = mysqli_fetch_array ( $qr_chk_exb_dup_name_id );
		if (($qr_chk_exb_dup_name_id_ans_rows ['reg_id'] == $_SESSION ["vercode_ex"])) {
			mysqli_query ($link, "delete from $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_1 where reg_id='$qr_chk_exb_dup_name_id_ans_rows[reg_id]' " );
			mysqli_query ($link, "delete from $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_1 where exhibitor_id='$qr_chk_exb_dup_name_id_ans_rows[exhibitor_id]' " );
			unlink(str_replace($EVENT_FORM_LINK,'',$qr_chk_exb_dup_name_id_ans_rows['logo']));
		}
	}
	// end checking duplicate exhibitor entry
	
	if (($temp_exhi_name == "") || ($temp_cp_title == "") || ($temp_cp_fname == "") || ($temp_cp_lname == "") || ($temp_desig == "") || ($temp_addr1 == "") || ($temp_city == "") || ($temp_state == "") || ($temp_country == "") || ($temp_zip == "") || ($temp_mob == "") || ($temp_email == "") || ($temp_reg_id == "") || ($temp_profile == "") || ($temp_fascia_name == "") || ($temp_mob_cntry == "")) {
		//|| ($temp_booth_area == "") || ($temp_booth_area_unit == "")  || ($category == "")
		echo "<script language='javascript'>alert('Please Enter Complete Details.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor-form.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit ();
	}
	
	$temp_total_exbhitors = $total_del = null;
	/*if (($temp_booth_area <= 9) && ($temp_booth_area >= 3)) {
		$total_exbhitors = 2;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 1;
		$temp_total_del = $total_del;
	} else {
		//echo  floor( $temp_booth_area / 9 );
		$total_exbhitors = (floor ( $temp_booth_area / 9 ) * 2);
		$temp_total_exbhitors = $total_exbhitors;
		$total_exbhitors_max_flag = "False";

		$total_del = (floor ( $temp_booth_area / 9 ) * 1);
		$temp_total_del = $total_del;
		$total_del_max_flag = "False";
	}
	
	if ($total_exbhitors > 7) {
		$total_exbhitors = 7;
		$total_exbhitors_max_flag = "True";
	}
	
	if ($total_del > 7) {
		$total_del = 7;
		$total_del_max_flag = "True";
	}
	
	// if(($temp_booth_area<9) && (($temp_booth_area>1)) ){
	if (($temp_booth_area <= 2)) {
		echo "<script language='javascript'>alert('Booth/ Stall area should be greater than or equal to 3 sqm');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor-form.php?rt=retds4fn324rn_ed24d3it');</script>";
		exit ();
	}
	
	if ($total_exbhitors <= 0 || $total_del <= 0) {
		echo "<script language='javascript'>alert('Please Enter Correct Booth/Pavilion Area Details.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor-form.php?rt=retds4fn324rn_ed24d3it');</script>";
		exit ();
	}*/
	
	$temp_website = "https://" . $temp_website;
	
	$i_ex_cnt = 0;
	$exhibitor_id_ex = "";
	
	do {
		$i_ex_cnt = 0;
		$exhibitor_id_ex = strtoupper ( $EVENT_TBL_PREFIX ) . $EVENT_YEAR . "_EXB_" . mt_rand ( 1, 9999 );
		
		$chq_ex_qr = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_1 WHERE exhibitor_id = '$exhibitor_id_ex'" ) or die ( mysqli_error ($link) );
		$chq_ex_no = mysqli_num_rows ( $chq_ex_qr );
		
		if ($chq_ex_no < 1) {
			$i_ex_cnt ++;
		} else {
			continue;
		}
	} while ( ! ($i_ex_cnt == 1) );
	
	$target_file = '';
	if(!empty($_FILES["logo"]["name"]) && $_FILES["logo"]["size"] > 0) {
		$target_dir = "upload1/";
		$imageFileType = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));

		$target_file = $target_dir . pathinfo(str_replace(' ', '-', $_FILES["logo"]["name"]), PATHINFO_FILENAME) . '-' . date('YmdHis') . '.' . $imageFileType;
		$uploadOk = 1;
		
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["logo"]["tmp_name"]);
		if($check !== false) {
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			//echo "File is not an image.";
			$uploadOk = 0;
		}
		
		// Check file size
		/*if ($_FILES["logo"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}*/
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			 echo "<script language='javascript'>alert('Please upload only JPG, JPEG, PNG & GIF files are allowed.');</script>";
			//echo "<script language='javascript'>window.location = ('exhibitor-form.php?rt=retds4fn324rn_ed24d3it');</script>";
			exit ();
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "<script language='javascript'>alert('Your file was not uploaded. Please try again');</script>";
			//echo "<script language='javascript'>window.location = ('exhibitor-form.php?rt=retds4fn324rn_ed24d3it');</script>";
			exit ();
		// if everything is ok, try to upload file
		} else {
			//echo $target_file;
			if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
				//echo "The file ". basename( $_FILES["logo"]["name"]). " has been uploaded.";
			} else {
				echo "<script language='javascript'>alert('There was an error uploading your logo.');</script>";
				//echo "<script language='javascript'>window.location = ('exhibitor-form.php?rt=retds4fn324rn_ed24d3it');</script>";
				exit ();
			}

			$target_file = $EVENT_FORM_LINK . $target_file;
		}
	}

	mysqli_query ($link, "insert  into $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_1(order_no,exhibitor_id,exhibitor_name,cp_title,cp_fname,cp_lname,cp_desig,cntry_code_phone,phone,cntry_code_fax,fax,cntry_code_mob,mob,email,website,address_line_1,address_line_2,city,state,country,zip,profile,area_by_executive,area_unit_by_executive,reg_date,reg_time,reg_id,booth_no,booth_area,booth_area_unit,fascia_name,total_exbhitors,category,booth_space,exhi_profile,keywords,logo,assoc_nm) values ('','$exhibitor_id_ex','$temp_exhi_name','$temp_cp_title','$temp_cp_fname','$temp_cp_lname','$temp_desig','$temp_fon_cntry','$temp_fon','$temp_fax_cntry','$temp_fax','$temp_mob_cntry','$temp_mob','$temp_email','$temp_website','$temp_addr1','$temp_addr2','$temp_city','$temp_state','$temp_country','$temp_zip','$temp_profile','','','$temp_reg_date','$temp_reg_time','$temp_reg_id','$temp_booth_no','$temp_booth_area','$temp_booth_area_unit','$temp_fascia_name','$temp_total_exbhitors','$category','$booth_space','$exhi_profile','$keywords','$target_file', '$assoc_nm') " ) or die ( mysqli_error ($link) );
	
	$lmt = $total_del;// + $total_exbhitors;

	$qr_chk_exb_dup_name_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_1 WHERE reg_id='$temp_reg_id'" );
	$exhibiorData = mysqli_fetch_assoc( $qr_chk_exb_dup_name_id );

	/*$logo = str_replace($EVENT_FORM_LINK,'',$exhibiorData['logo']);
	if(!file_exists($logo)) {
		echo "<script language='javascript'>alert('There was an error uploading your logo.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor-form.php?rt=retds4fn324rn_ed24d3it');</script>";
		exit ();
	}*/

	echo "<script language='javascript'>window.location = ('exhibitor-form3.php?assoc_nm=$assoc_nm');</script>";

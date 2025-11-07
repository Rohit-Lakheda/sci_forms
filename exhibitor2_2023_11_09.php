<?php
session_start();
//print_r($_POST);
$ret = @$_GET['rt'];
$return = @$_GET['ret'];
if ($ret == "retds4fn324rn_ed24d3it") {
	if ((!isset($_SESSION["vercode_ex"])) || ($_SESSION["vercode_ex"] == '')) {
		//session_destroy ();
		echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php');</script>";
		exit();
	}
	$text = $_SESSION["vercode_ex"];
} else {
	if (($_POST["vercode_ex"] != $_SESSION["vercode_ex"]) || ($_SESSION["vercode_ex"] == '')) {
		//session_destroy ();
		echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php');</script>";
		exit();
	}
}

require "includes/form_constants.php";

require "dbcon_open.php";


$temp_booth_no = @$_POST['booth_no'];
$temp_booth_area = @$_POST['booth_area'];
if (($assoc_nm == "STPI") || ($assoc_nm == "KBITS")) {
	$temp_booth_area = 6;
}
if (($assoc_nm == "VoICE Consortium Pavilion")) {
	$temp_booth_area = 9;
}
$booth_space = @$_POST['booth_space'];
$temp_booth_area_unit = @$_POST['booth_area_unit'];
$temp_fascia_name = mysqli_real_escape_string($link,@$_POST['fascia_name']);
$temp_fascia_name = trim($temp_fascia_name);

$temp_fascia_name_up = strtoupper($temp_fascia_name);

$temp_exhi_name = mysqli_real_escape_string($link,@$_POST['exhi_name']);
$temp_exhi_name = trim($temp_exhi_name);
$temp_exhi_name_up = strtoupper($temp_exhi_name);
$temp_exhi_name_upwc = ucwords($temp_exhi_name);

$temp_cp_title = @$_POST['cp_title'];
$temp_cp_title = trim($temp_cp_title);

$temp_cp_fname = mysqli_real_escape_string($link,@$_POST['cp_fname']);
$temp_cp_fname = trim($temp_cp_fname);

// $temp_cp_mname = @$_POST ['cp_mname'];
// $temp_cp_mname = trim ( $temp_cp_mname );

$temp_cp_lname = mysqli_real_escape_string($link,@$_POST['cp_lname']);
$temp_cp_lname = trim($temp_cp_lname);

$temp_desig = @$_POST['desig'];
$temp_desig = trim($temp_desig);

$temp_addr1 = mysqli_real_escape_string($link,@$_POST['addr1']);
$temp_addr2 = mysqli_real_escape_string($link,@$_POST['addr2']);
$temp_city = @$_POST['city'];
$temp_state = @$_POST['state'];
$temp_country = @$_POST['country'];
$temp_zip = @$_POST['zip'];
$temp_fon_cntry = @$_POST['foneCountryCode'];
// $temp_fon_area = @$_POST['fon_area'];
$temp_fon = @$_POST['fon'];
$temp_mob_cntry = @$_POST['cellnoCountryCode'];
$temp_mob = @$_POST['mob'];
$temp_fax_cntry = @$_POST['faxCountryCode'];
// $temp_fax_area = @$_POST['fax_area'];
$temp_fax = @$_POST['fax'];
$temp_email = @$_POST['email'];
$temp_email = strtolower(trim($temp_email));
$temp_website = @$_POST['website'];
$temp_reg_date = date("Y-m-d");
$temp_reg_time = date("H:i:s a");
$temp_reg_id = @$_POST['vercode_ex'];
$temp_profile = @$_POST['exbhi_profile'];
$temp_profile = mysqli_real_escape_string($link,$temp_profile);
$category = @$_POST['category'];
$exhi_profile = '';
if (isset($_POST['exhi_profile'][0])) {
	//$exhi_profile = implode('#', $_POST['exhi_profile']);
	$exhi_profile = @$_POST['exhi_profile'][0];
	if ($exhi_profile == 'Other') {
		$exhi_profile .= ' - ' . @$_POST['exhi_profile-other'];
	}
}

$keywords = @$_POST['keywords'];

$_SESSION['sess_booth_booth_space'] = $booth_space;
$_SESSION['sess_booth_no'] = $temp_booth_no;
$_SESSION['sess_booth_area'] = $temp_booth_area;
$_SESSION['sess_booth_area_unit'] = $temp_booth_area_unit;
$_SESSION['sess_fascia_name'] = $temp_fascia_name;

$_SESSION['sess_exhi_name'] = $temp_exhi_name;
$_SESSION['sess_cp_title'] = $temp_cp_title;
$_SESSION['sess_cp_fname'] = $temp_cp_fname;
// $_SESSION ['sess_cp_mname'] = $temp_cp_mname;
$_SESSION['sess_cp_lname'] = $temp_cp_lname;
$_SESSION['sess_desig'] = $temp_desig;
$_SESSION['sess_addr1'] = $temp_addr1;
$_SESSION['sess_addr2'] = $temp_addr2;
$_SESSION['sess_city'] = $temp_city;
$_SESSION['sess_state'] = $temp_state;
$_SESSION['sess_country'] = $temp_country;
$_SESSION['sess_zip'] = $temp_zip;
$_SESSION['sess_fon_cntry'] = $temp_fon_cntry;
// $_SESSION['sess_fon_area'] = $temp_fon_area;
$_SESSION['sess_fon'] = $temp_fon;
$_SESSION['sess_mob_cntry'] = $temp_mob_cntry;
$_SESSION['sess_mob'] = $temp_mob;
$_SESSION['sess_fax_cntry'] = $temp_fax_cntry;
// $_SESSION['sess_fax_area'] = $temp_fax_area;
$_SESSION['sess_fax'] = $temp_fax;
$_SESSION['sess_email'] = $temp_email;
$_SESSION['sess_website'] = $temp_website;
$_SESSION['sess_vercode_ex'] = $temp_reg_id;
$_SESSION['vercode_ex'] = $temp_reg_id;
$_SESSION['sess_category'] = $category;

$_SESSION['sess_exhi_profile'] = $exhi_profile;
$_SESSION['sess_keywords'] = $keywords;
$_SESSION['assoc_nm'] = $assoc_nm = @$_POST['assoc_nm'];

$temp_reg_date = date("Y-m-d");
$temp_reg_time = date("H:i:s a");

$temp_profile = @$_POST['exbhi_profile'];
$temp_profile_len = strlen(str_replace('&nbsp;', '', strip_tags($temp_profile)));
//echo strip_tags ( $temp_profile );exit;
$_SESSION['sess_exbhi_profile'] = $temp_profile;
$temp_profile = mysqli_real_escape_string($link,nl2br($temp_profile));

if ($temp_profile_len > 751) {
	echo "<script language='javascript'>alert('Please Enter Profile less than or equal to 750 characters.');</script>";
	echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
	exit();
}
$temp_exhi_name_lower = strtolower($temp_exhi_name);

// start checking duplicate exhibitor entry
$qr_chk_exb_dup_name_id = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_PHASE_2 WHERE (LOWER(exhibitor_name)='$temp_exhi_name_lower') ");
$qr_chk_exb_dup_name_id_num_rows = mysqli_num_rows($qr_chk_exb_dup_name_id);
if ($qr_chk_exb_dup_name_id_num_rows > 0) {
	echo "<script language='javascript'>alert('Exhibitor- $temp_exhi_name is already registerd with us.');</script>";
	echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
	exit();
}

$qr_chk_exb_dup_name_id = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_2 WHERE (LOWER(exhibitor_name)='$temp_exhi_name_lower') ");
$qr_chk_exb_dup_name_id_num_rows = mysqli_num_rows($qr_chk_exb_dup_name_id);
if ($qr_chk_exb_dup_name_id_num_rows > 0) {
	$qr_chk_exb_dup_name_id = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_2 WHERE (LOWER(exhibitor_name)='$temp_exhi_name_lower') ");
	$qr_chk_exb_dup_name_id_ans_rows = mysqli_fetch_array($qr_chk_exb_dup_name_id);
	if (($qr_chk_exb_dup_name_id_ans_rows['reg_id'] == $_SESSION["vercode_ex"])) {
		mysqli_query($link,"delete from $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_2 where reg_id='$qr_chk_exb_dup_name_id_ans_rows[reg_id]' ");
		mysqli_query($link,"delete from $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_2 where exhibitor_id='$qr_chk_exb_dup_name_id_ans_rows[exhibitor_id]' ");
		if (!empty($qr_chk_exb_dup_name_id_ans_rows['logo']))
			unlink(str_replace($EVENT_FORM_LINK, '', $qr_chk_exb_dup_name_id_ans_rows['logo']));
	}
}
// end checking duplicate exhibitor entry

//if (($temp_exhi_name == "") || ($temp_cp_title == "") || ($temp_cp_fname == "") || ($temp_cp_lname == "") || ($temp_desig == "") || ($temp_addr1 == "") || ($temp_city == "") || ($temp_state == "") || ($temp_country == "") || ($temp_zip == "") || ($temp_mob == "") || ($temp_email == "") || ($temp_reg_id == "") || ($temp_profile == "") || ($temp_booth_area == "") || ($temp_booth_area_unit == "") || ($temp_fascia_name == "") || ($temp_mob_cntry == "") || ($category == "")) {
if (($temp_exhi_name == "") || ($temp_addr1 == "") || ($temp_city == "") || ($temp_state == "") || ($temp_country == "") || ($temp_zip == "") || ($temp_reg_id == "") || ($temp_booth_area == "") || ($temp_booth_area_unit == "") || ($category == "")) {
	echo "<script language='javascript'>alert('Please Enter Complete Details.');</script>";
	echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
	exit();
}

if (!empty($assoc_nm)) {
	if (($temp_booth_area == 3) || ($temp_booth_area == 4) || ($temp_booth_area == 6)) {
		$total_exbhitors = 1;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 1;
		$temp_total_del = $total_del;
		$total_del_max_flag = "False";
	} else if ($temp_booth_area == 9) {
		//echo  floor( $temp_booth_area / 9 );
		$total_exbhitors = 2;
		$temp_total_exbhitors = $total_exbhitors;
		$total_exbhitors_max_flag = "False";

		$total_del = 1;
		$temp_total_del = $total_del;
		$total_del_max_flag = "False";
	} else {

		echo "<script language='javascript'>alert('Error in  Stall Size');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit();
	}
} else {
	if (($temp_booth_area >= 3) && ($temp_booth_area <= 8)) {
		$total_exbhitors = 1;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 1;
		$temp_total_del = $total_del;
	} else if (($temp_booth_area >= 9) && ($temp_booth_area <= 17)) {
		$total_exbhitors = 2;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 1;
		$temp_total_del = $total_del;
	} else if (($temp_booth_area >= 18) && ($temp_booth_area <= 26)) {
		$total_exbhitors = 4;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 1;
		$temp_total_del = $total_del;
	} else if (($temp_booth_area >= 27) && ($temp_booth_area <= 35)) {
		$total_exbhitors = 6;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 3;
		$temp_total_del = $total_del;
	} else if (($temp_booth_area >= 36) && ($temp_booth_area <= 53)) {
		$total_exbhitors = 7;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 5;
		$temp_total_del = $total_del;
	} else if (($temp_booth_area >= 54) && ($temp_booth_area <= 71)) {
		$total_exbhitors = 7;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 7;
		$temp_total_del = $total_del;
	} else if (($temp_booth_area >= 72) && ($temp_booth_area <= 81)) {
		$total_exbhitors = 7;
		$temp_total_exbhitors = $total_exbhitors;
		$total_del = 7;
		$temp_total_del = $total_del;
	} else {
		echo "<script language='javascript'>alert('Error in  Stall Size');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit();
	}
}

if ($total_exbhitors >= 7) {
	$total_exbhitors = 7;
	$total_exbhitors_max_flag = "True";
}

if ($total_del >= 7) {
	$total_del = 7;
	$total_del_max_flag = "True";
}

/* if (($temp_total_exbhitors>7)&& ($temp_total_del>7)) {
	  echo "<script language='javascript'>alert('Maximum limit to allocate Stall Manning People or Complimentary Exhibitor Delegates is 14 people.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit ();
	} */
if (!empty($assoc_nm)) {
	// if(($temp_booth_area<9) && (($temp_booth_area>1)) ){
	if (($temp_booth_area <= 3)) {
		echo "<script language='javascript'>alert('Booth/ Stall area should be greater than or equal to 4 sqm');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit();
	}
} else {
	if (($temp_booth_area == 8)) {
		echo "<script language='javascript'>alert('Booth/ Stall area should be greater than or equal to 9 sqm');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit();
	}
}
if (($temp_booth_area >= 201)) {
	echo "<script language='javascript'>alert('Booth/ Stall area should be less than or equal to 200 sqm');</script>";
	echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
	exit();
}

if ($total_exbhitors <= 0 || $total_del <= 0) {
	echo "<script language='javascript'>alert('Please Enter Correct Booth/Pavilion Area Details.');</script>";
	echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
	exit();
}

if (!empty($temp_website))
	$temp_website = "http://" . $temp_website;

$i_ex_cnt = 0;
$exhibitor_id_ex = "";

do {
	$i_ex_cnt = 0;
	$exhibitor_id_ex = strtoupper($EVENT_TBL_PREFIX) . $EVENT_YEAR . "_EXB_" . mt_rand(1, 9999);

	$chq_ex_qr = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_2 WHERE exhibitor_id = '$exhibitor_id_ex'") or die(mysqli_error($link));
	$chq_ex_no = mysqli_num_rows($chq_ex_qr);

	if ($chq_ex_no < 1) {
		$i_ex_cnt++;
	} else {
		continue;
	}
} while (!($i_ex_cnt == 1));

$target_file = '';
if (isset($_FILES["logo"]) && !empty($_FILES["logo"]["name"]) && $_FILES["logo"]["size"] > 0) {
	$target_dir = "uploads/";
	$imageFileType = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));

	$target_file = $target_dir . pathinfo(str_replace(' ', '-', $_FILES["logo"]["name"]), PATHINFO_FILENAME) . '-' . date('YmdHis') . '.' . $imageFileType;
	$uploadOk = 1;

	// Check if image file is a actual image or fake image
	$check = getimagesize($_FILES["logo"]["tmp_name"]);
	if ($check !== false) {
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
	if (
		$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif"
	) {
		echo "<script language='javascript'>alert('Please upload only JPG, JPEG, PNG & GIF files are allowed.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit();
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "<script language='javascript'>alert('Your file was not uploaded. Please try again');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
		exit();
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES["logo"]["name"]). " has been uploaded.";
		} else {
			echo "<script language='javascript'>alert('There was an error uploading your logo.');</script>";
			echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it&assoc_nm=$assoc_nm');</script>";
			exit();
		}

		$target_file = $EVENT_FORM_LINK . $target_file;
	}
}

mysqli_query($link,"insert  into $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_2(order_no,exhibitor_id,exhibitor_name,cp_title,cp_fname,cp_lname,cp_desig,cntry_code_phone,phone,cntry_code_fax,fax,cntry_code_mob,mob,email,website,address_line_1,address_line_2,city,state,country,zip,profile,area_by_executive,area_unit_by_executive,reg_date,reg_time,reg_id,booth_no,booth_area,booth_area_unit,fascia_name,total_exbhitors,category,booth_space,exhi_profile,keywords,logo,assoc_nm) values ('','$exhibitor_id_ex','$temp_exhi_name','$temp_cp_title','$temp_cp_fname','$temp_cp_lname','$temp_desig','$temp_fon_cntry','$temp_fon','$temp_fax_cntry','$temp_fax','$temp_mob_cntry','$temp_mob','$temp_email','$temp_website','$temp_addr1','$temp_addr2','$temp_city','$temp_state','$temp_country','$temp_zip','$temp_profile','','','$temp_reg_date','$temp_reg_time','$temp_reg_id','$temp_booth_no','$temp_booth_area','$temp_booth_area_unit','$temp_fascia_name','$temp_total_exbhitors','$category','$booth_space','$exhi_profile','$keywords','$target_file','$assoc_nm') ") or die(mysqli_error($link));

$lmt = $total_del; // + $total_exbhitors;

$qr_chk_exb_dup_name_id = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_2 WHERE reg_id='$temp_reg_id'");
$exhibiorData = mysqli_fetch_assoc($qr_chk_exb_dup_name_id);

/*$logo = str_replace($EVENT_FORM_LINK,'',$exhibiorData['logo']);
	if(!file_exists($logo)) {
		echo "<script language='javascript'>alert('There was an error uploading your logo.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it');</script>";
		exit ();
	}*/
?>
<?php require 'includes/reg_form_header.php'; ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_2">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase">
						Exhibitor Personnel/Delegate Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="exhibitor3.php?ret=<?php echo $return; ?>&assoc_nm=<?php echo $assoc_nm; ?>" class="form-horizontal" name="reg_registration_form_2" id="reg_registration_form_2" method="post" onsubmit="return validate_ex2();">
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="done">
									<a href="#tab1" data-toggle="tab" class="step dips-default-cursor">
										<span class="number"> 1 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Sponsor/Exhibitor Details </span>
									</a>
								</li>
								<li class="active">
									<a href="#tab1" data-toggle="tab" class="step dips-default-cursor">
										<span class="number"> 2 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Exhibitor Personnel/Delegate Details </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
										<span class="number"> 3 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Preview Detail </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
										<span class="number"> 4 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Confirmation </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success"> </div>
							</div>
							<div class="tab-content">
								<div class="tab-pane active">
									<?php if (!empty($assoc_nm) && $assoc_nm == 'Startup') { ?>
										<h3><strong>Startup Innovation Zone</strong></h3>
									<?php } ?>
									<h4 class="block">Enter Exhibitor/Delegate Details </h4>
									<?php /*?>These names are for the exhibitor badges who would be manning the exhibition booth. <br />To register delegate who would be attending the conference link is available on next page.<br/><br/><?php */ ?>
									<div class="alert alert-info">Please provide the <strong>Names of the persons who would be manning the stall (EXHIBITOR)</strong> from your organisation and <strong>Names of persons who would be attending the sessions (DELEGATE)</strong> by selecting the appropriate drop down below:
									</div>
									<input type="hidden" name="speaker_event_name" id="speaker_event_name" value="<?php echo $EVENT_NAME; ?>" />
									<input type="hidden" name="speaker_event_year" id="speaker_event_year" value="<?php echo $EVENT_YEAR; ?>" />
									<?php /*<div class="form-group <?php if ($total_del == 1) echo 'hide';?>">
										<label class="control-label col-md-3"> Is stall manning people same as delegate <span class="required"> * </span>
										</label>
										<div class="col-md-6">
											<select id="same-stall" name="same-stall" class="form-control" required="required" onchange="exhiShow();">
												<?php if ($total_del == 1) {?>
												<option value="No">No</option>
												<?php }else {?>
												<option value="">-- Select --</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>
												<?php }?>
											</select>
										</div>
									</div>*/ ?>

									<?php for ($i_exb = 1; $i_exb <= $total_exbhitors; $i_exb++) { ?>
										<div class="h4">Personal Information of Exhibitor:
											<?php if ($total_exbhitors > 1) {
												echo $i_exb . ":";
											} ?>(Stall Manning)
											<?php if ($i_exb <= 2) { ?><span class="dips-required"> * </span><?php } ?>
											<input name="del_category<?php echo $i_exb; ?>" type="hidden" id="del_category<?php echo $i_exb; ?>" class="del_category" value="Exhibitor" />
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Contact Person Name<?php if ($i_exb <= 2) { ?> <span class="required"> * </span><?php } ?></label>
											<div class="col-md-2">
												<select class="form-control" name="title<?php echo $i_exb; ?>" <?php if ($i_exb <= 2) { ?>required<?php } ?> id="title<?php echo $i_exb; ?>">
													<option value="">-Title-</option>
													<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
													foreach ($titleList as $title) {
														echo '<option value="' . $title . '">' . $title . '</option>';
													} ?>
												</select>
											</div>
											<div class="col-md-2"><input type="text" class="form-control" placeholder="First Name" name="fname<?php echo $i_exb; ?>" id="fname<?php echo $i_exb; ?>" <?php if ($i_exb <= 2) { ?>required<?php } ?> maxlength="100" onkeyup="check_char(event,'cp_fname');"></div>
											<div class="col-md-2"><input type="text" class="form-control" placeholder="Last Name" name="lname<?php echo $i_exb; ?>" id="lname<?php echo $i_exb; ?>" <?php if ($i_exb <= 2) { ?>required<?php } ?> maxlength="100" onkeyup="check_char(event,'cp_lname');"></div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Designation <?php if ($i_exb <= 2) { ?> <span class="dips-required"> * </span> <?php } ?></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="desig<?php echo $i_exb; ?>" id="desig<?php echo $i_exb; ?>" maxlength="249" <?php if ($i_exb <= 2) { ?>required<?php } ?> />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Mobile No <?php if ($i_exb <= 2) { ?> <span class="dips-required"> * </span> <?php } ?></label>
											<div class="col-md-6">
												<input type="number" class="form-control" name="mob<?php echo $i_exb; ?>" id="mob<?php echo $i_exb; ?>" maxlength="12" <?php if ($i_exb <= 2) { ?>required<?php } ?> />
											</div>
										</div>

										<?php /* ?><div class="form-group">
											<label class="control-label col-md-3"> Selected Category 
											</label>
											<div class="col-md-6">
												<span id="selectcata<?php echo $i_exb;?>" class="selectcata">-</span>
												<select id="del_category<?php echo $i_exb;?>" name="del_category<?php echo $i_exb;?>" class="form-control" <?php if($i_exb<=2){?>required<?php } ?>>
													<option value="">-- Select Category  --</option>
													<?php $cataList = array('Exhibitor'=>'Exhibitor', 'Delegate'=>'Delegate');
															//$countryList = array('Information Technology'=>'Information Technology');
															foreach ($cataList as $key=>$value) {
																echo '<option value="' . $key . '">' . $value . '</option>'; 
															}
														?>
												</select>
												<input name="del_category<?php echo $i_exb;?>" type="hidden" id="del_category<?php echo $i_exb;?>" class="del_category" />
											</div>
										</div> <?php */ ?>

										<?php /* ?><div class="form-group">
											<label class="col-md-3 control-label">Department <?php if($i_exb<=2){?> <span class="dips-required"> * </span> <?php } ?></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="dept<?php echo $i_exb;?>" id="dept<?php echo $i_exb;?>" maxlength="249" <?php if($i_exb<=2){?>required<?php } ?> />
											</div> 
										</div> <?php */ ?>
										<div class="form-group">
											<label class="col-md-3 control-label">Email Address <?php if ($i_exb <= 2) { ?> <span class="dips-required"> * </span> <?php } ?></label>
											<div class="col-md-6">
												<input type="email" class="form-control" name="email<?php echo $i_exb; ?>" id="email<?php echo $i_exb; ?>" <?php if ($i_exb <= 2) { ?>required<?php } ?> />
											</div>
										</div>
									<?php  } ?>

									<span class="dele-dpan" style="display: none1;">
										<?php
										for ($i = 1; $i <= $total_del; $i++) { ?>
											<div class="h4">Enter Information of Delegate
												<?php if ($lmt > 1) {
													echo $i;
												} ?>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Name <?php if ($i <= 2) { ?><span class="dips-required"> * </span><?php } ?></label>
												<div class="col-md-2">
													<select class="form-control" name="dtitle<?php echo $i; ?>" id="dtitle<?php echo $i; ?>" <?php if ($i <= 2) { ?>required<?php } ?>>
														<option value="">-Title-</option>
														<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
														foreach ($titleList as $title) {
															$selected = '';
															if ($qr_gt_user_data_ans_row['title' . $i] == $title || $_SESSION['title' . $i] == $title) {
																$selected = 'selected="selected"';
															}
															echo '<option value="' . $title . '" ' . $selected . '>' . $title . '</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-2"><input type="text" class="form-control" placeholder="First Name" name="dfname<?php echo $i; ?>" type="text" id="dfname<?php echo $i; ?>" maxlength="255" value="<?php if (isset($_SESSION['dfname' . $i])) {
																																																											echo $_SESSION['dfname' . $i];
																																																										} else {
																																																											echo @$qr_gt_user_data_ans_row['fname' . $i];
																																																										} ?>" <?php if ($i <= 2) { ?>required<?php } ?>></div>
												<div class="col-md-2"><input type="text" class="form-control" placeholder="Last Name" name="dlname<?php echo $i; ?>" type="text" id="dlname<?php echo $i; ?>" maxlength="255" value="<?php if (isset($_SESSION['dlname' . $i])) {
																																																											echo $_SESSION['dlname' . $i];
																																																										} else {
																																																											echo @$qr_gt_user_data_ans_row['lname' . $i];
																																																										} ?>" <?php if ($i <= 2) { ?>required<?php } ?>></div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Designation<?php if ($i <= 2) { ?><span class="dips-required"> * </span><?php } ?></label>
												<div class="col-md-6">
													<input class="form-control" name="job_title<?php echo $i; ?>" type="text" id="job_title<?php echo $i; ?>" maxlength="100" value="<?php if (isset($_SESSION['job_title' . $i])) {
																																															echo $_SESSION['job_title' . $i];
																																														} else {
																																															echo @$qr_gt_user_data_ans_row['job_title' . $i];
																																														} ?>" <?php if ($i <= 2) { ?>required<?php } ?> />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Name on Badge <?php if ($i <= 2) { ?><span class="dips-required"> * </span><?php } ?></label>
												<div class="col-md-6">
													<input class="form-control" name="badge<?php echo $i; ?>" type="text" id="badge<?php echo $i; ?>" maxlength="150" value="<?php if (isset($_SESSION['badge' . $i])) {
																																													echo $_SESSION['badge' . $i];
																																												} else {
																																													echo @$qr_gt_user_data_ans_row['badge' . $i];
																																												} ?>" onkeyup="check_char(event,'badge<?php echo $i; ?>')" <?php if ($i <= 2) { ?>required<?php } ?> />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Email Address <?php if ($i <= 2) { ?><span class="dips-required"> * </span><?php } ?></label>
												<div class="col-md-6">
													<input class="form-control" name="email_m<?php echo $i; ?>" type="email" id="email_m<?php echo $i; ?>" maxlength="150" value="<?php if (isset($_SESSION['email' . $i])) {
																																														echo $_SESSION['email' . $i];
																																													} else {
																																														echo @$qr_gt_user_data_ans_row['email' . $i];
																																													} ?>" <?php if ($i <= 2) { ?>required<?php } ?> />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Mobile Number <?php if ($i <= 2) { ?><span class="dips-required"> * </span><?php } ?></label>
												<div class="col-md-6">
													<?php
													$mobile = '';
													if (isset($qr_gt_user_data_ans_row['cellno' . $i]))
														$mobile = $qr_gt_user_data_ans_row['cellno' . $i];
													?>
													<input class="form-control" name="cellno<?php echo $i; ?>" type="number" id="cellno<?php echo $i; ?>" maxlength="12" value="<?php echo $mobile; ?>" onkeyup="check_num(event, 'cellno<?php echo $i; ?>');" <?php if ($i <= 2) { ?>required<?php } ?> />
												</div>
											</div>
											<?php /*?><div class="form-group">
												<label class="control-label col-md-3"> Selected Category
												</label>
												<div class="col-md-6">
													<span>Delegate</span>
												</div>
											</div> 
                                            <?php */ if ($category == 'Exhibitor') { ?>
												<input name="catagory<?php echo $i; ?>" type="hidden" id="catagory<?php echo $i; ?>" value="Complimentary Exhibitors Delegate" />
											<?php } else { ?>
												<input name="catagory<?php echo $i; ?>" type="hidden" id="catagory<?php echo $i; ?>" value="Complimentary Sponsor Delegate" />
											<?php } ?>
										<?php } ?>
										<?php if ($category == 'Exhibitor') { ?>
											<input name="cata" type="hidden" value="Complimentary Exhibitors Delegate" />
										<?php } else { ?>
											<input name="cata" type="hidden" value="Complimentary Sponsor Delegate" />
										<?php } ?>
										<input name="cata_m" type="hidden" value="" />
									</span>
									<div class="form-group">
										<div class="col-md-6 col-md-offset-3">
											<div class="note note-success">
												<?php /*<p> If you have any issue with exhibitor or stall manning people, please contact our executive <br />
													</span>Name: <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_COMP_CONTACT_PERSON_NAME;?> <br />
													Email:  <a href="mailto:<?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_COMP_CONTACT_PERSON_EMAIL;?>"><?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_COMP_CONTACT_PERSON_EMAIL;?></a> <br />
													Mobile: <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_COMP_CONTACT_PERSON_MOBILE_NO;?><br />
													<!-- Phone:<?php echo $EVENT_DB_FORM_DELEGATE_PERSON_PHONE_NO;?> <br/> --><br/>
												</p>
												<?php /*<p>	If you want more stall manning people, please contact our executive <br />
													</span>Name: <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_NAME;?><br />
													Email: <a href="mailto:<?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_EMAIL;?>"><?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_EMAIL;?></a><br />
													Mobile: <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_MOBILE_NO;?><br />
													Phone: <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_PHONE_NO;?><br/><br/>
												</p>*/ ?>
												<p> If you have any technical problem, please contact our executive <br />
													</span>Name: <?php echo $EVENT_DB_FORM_TECHNICAL_PERSON_NAME; ?> <br />
													Email: <a href="mailto:<?php echo $EVENT_DB_FORM_TECHNICAL_PERSON_EMAIL; ?>"><?php echo $EVENT_DB_FORM_TECHNICAL_PERSON_EMAIL; ?></a> <br />
													<!-- Mobile:<?php echo $EVENT_DB_FORM_TECHNICAL_PERSON_MOBILE_NO; ?> <br />
													Phone: <?php echo $EVENT_DB_FORM_TECHNICAL_PERSON_PHONE_NO; ?> -->
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<a href="javascript:;" class="btn default" onclick="go_back();">
										<i class="fa fa-angle-left"></i> Back </a>
									<button type="submit" class="btn sbold uppercase green-jungle"> Continue
										<i class="fa fa-angle-right"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/reg_form_footer.php'; ?>
<?php echo "<script language='javascript'>var total_delegates = '$total_del'; var total_exbhitors= '$total_exbhitors';</script>"; ?>
<script src="js/exhibitor-stall2.js?lolk3s"></script>
<script>
	jQuery(document).ready(function() {
		Registration.init('registration_form_2', 1);

		<?php if ($total_del == 1) { ?>
			exhiShow();
		<?php } ?>
	});

	function go_back() {
		window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it');
	}

	function exhiShow() {
		var da = $('#same-stall').val();

		if (da == 'Yes') {
			$('.selectcata').text('Exhibitor+Delegate');
			$('.del_category').val('Exhibitor+Delegate');
			$('.dele-dpan').hide();
		} else {
			$('.selectcata').text('Exhibitor');
			$('.del_category').val('Exhibitor');
			$('.dele-dpan').show();
		}

	}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
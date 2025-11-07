<?php
//echo "<script language='javascript'>window.location.href='https://www.bengalurutechsummit.com/web/it_forms/enquiry.php';</script>";
//exit;
//ob_start();
//ini_set(session.save_path, 'E:\work\xampp\tmp');
require("includes/form_constants_both.php");
$ret = @$_GET['ret'];

if ($ret == "retds4fu324rn_ed24d3it") {
	session_start();
	if ((!isset($_SESSION["vercode_spkr_reg"])) || ($_SESSION["vercode_spkr_reg"] == '')) {
		session_destroy();
		echo "<script language='javascript'>alert('Please try again.');</script>";
		echo "<script language='javascript'>window.location=('speakers-registration.php');</script>";
		echo "<script language='javascript'>document.location=('speakers-registration.php');</script>";
		exit;
	}
	require "dbcon_open.php";
} else {
	include('captcha_speaker.php');
}
?>
<?php require 'includes/reg_form_header.php'; ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Speaker Registration Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<?php if (date('Y-m-d H:i') <= '2025-11-20 20:00') { ?>
					<form action="speakers-registration2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post" enctype="multipart/form-data" onsubmit="return validate_registration()">
						<?php /*?><input type="hidden" value="Standard" name="cata_m" /><?php */ ?>
						<div class="form-wizard">
							<div class="form-body">
								<ul class="nav nav-pills nav-justified steps">
									<li class="active">
										<a href="#tab1" data-toggle="tab" class="step">
											<span class="number"> 1 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Information </span>
										</a>
									</li>
									<li>
										<a data-toggle="tab" class="step dips-default-cursor">
											<span class="number"> 2 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Receipt </span>
										</a>
									</li>
								</ul>
								<div id="bar" class="progress progress-striped" role="progressbar">
									<div class="progress-bar progress-bar-success"> </div>
								</div>
								<div class="tab-content">
									<div class="tab-pane active">
										<div class="form-group">
											<label class="control-label col-md-3"> Select Sector <span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<select id="sector" name="sector" class="form-control" required="required" onchange="eventSessShow(this);">
													<option value="">-- Select Sector --</option>
													<?php $countryList = array('Information Technology' => 'Information Technology', 'Bio Technology' => 'Bio Technology', 'Global Innovation Alliance' => 'Global Innovation Alliance');
													$countrys = 'India';
													foreach ($countryList as $key => $value) {
														echo '<option value="' . $key . '">' . $value . '</option>';
													}
													?>
												</select>
											</div>
										</div>
										<!-- <div class="form-group">
										<label class="col-md-3 control-label">Session Title <span class="required"> * </span></label>
										<div class="col-md-6">
										  <input type="text" class="form-control" placeholder="Session Title" name="speaker_session_title" id="speaker_session_title"  value="<?php if (isset($_SESSION['speaker_session_title'])) {
																																													echo $_SESSION['speaker_session_title'];
																																												} else {
																																													echo @$qr_gt_user_data_ans_row['speaker_session_title'];
																																												} ?>" required="required" />
										</div>
									</div> -->
										<?php /*?><div class="form-group">
										<label class="col-md-3 control-label">Session Description</label>
										<div class="col-md-6">
											<textarea name="speaker_session_desc" id="speaker_session_desc" rows="" cols="" class="form-control"><?php if(isset($_SESSION['speaker_session_desc'])) { echo $_SESSION['speaker_session_desc']; }else{ echo @$qr_gt_user_data_ans_row['speaker_session_desc']; } ?></textarea>
										</div>
									</div><?php */ ?>
										<div class="form-group">
											<label class="control-label col-md-3">Speaker Name <span class="dips-required"> * </span></label>
											<div class="col-md-2">
												<select class="form-control" name="speaker_title" id="speaker_title" required="required">
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
											<div class="col-md-2"><input type="text" class="form-control" placeholder="First Name" name="speaker_fname" id="speaker_fname" value="<?php if (isset($_SESSION['speaker_fname'])) {
																																														echo $_SESSION['speaker_fname'];
																																													} else {
																																														echo @$qr_gt_user_data_ans_row['speaker_fname'];
																																													} ?>" required="required"></div>
											<div class="col-md-2"><input type="text" class="form-control" placeholder="Middle Name" name="speaker_mname" id="speaker_mname" value="<?php if (isset($_SESSION['speaker_mname'])) {
																																														echo $_SESSION['speaker_mname'];
																																													} else {
																																														echo @$qr_gt_user_data_ans_row['speaker_mname'];
																																													} ?>"></div>
											<div class="col-md-2"><input type="text" class="form-control" placeholder="Last Name" name="speaker_lname" id="speaker_lname" value="<?php if (isset($_SESSION['speaker_lname'])) {
																																														echo $_SESSION['speaker_lname'];
																																													} else {
																																														echo @$qr_gt_user_data_ans_row['speaker_lname'];
																																													} ?>" required="required"></div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Speaker Email <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input type="email" class="form-control" name="speaker_email_1" id="speaker_email_1" value="<?php if (isset($_SESSION['speaker_email_1'])) {
																																				echo $_SESSION['speaker_email_1'];
																																			} else {
																																				echo @$qr_gt_user_data_ans_row['speaker_email_1'];
																																			} ?>" required="required" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3"> Mobile Number <span class="required"> * </span>
											</label>
											<div class="col-md-4">
												<div class="input-group-box">
													<?php /*?><input name="c_code" type="hidden" id="c_code" value="91"/><?php */ ?>
													<span><input name="speaker_mob_cntry_code" id="speaker_mob_cntry_code" type="text" class="form-control" maxlength="4" placeholder="Country Code" required value="91" onkeyup="checkPhoneNumber(event, 'speaker_mob_cntry_code');" /><span class="dash">-</span></span>
													<span><input name="speaker_mob" type="text" id="speaker_mob" class="form-control" maxlength="10" placeholder="Mobile Number" required style="width: 120%;" onkeyup="checkPhoneNumber(event, 'speaker_mob');" /></span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Organisation Name <span class="required"> * </span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="speaker_org" id="speaker_org" value="<?php if (isset($_SESSION['speaker_org'])) {
																																		echo $_SESSION['speaker_org'];
																																	} else {
																																		echo @$qr_gt_user_data_ans_row['speaker_org'];
																																	} ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Speaker Designation <span class="required"> * </span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="speaker_desig" id="speaker_desig" value="<?php if (isset($_SESSION['speaker_desig'])) {
																																			echo $_SESSION['speaker_desig'];
																																		} else {
																																			echo @$qr_gt_user_data_ans_row['speaker_desig'];
																																		} ?>" required="required" />
											</div>
										</div>
										<!-- <div class="form-group">
										<label class="col-md-3 control-label">Profile Tag line</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="speaker_profile_tag_line" id="speaker_profile_tag_line" value="<?php if (isset($_SESSION['speaker_profile_tag_line'])) {
																																								echo $_SESSION['speaker_profile_tag_line'];
																																							} else {
																																								echo @$qr_gt_user_data_ans_row['speaker_profile_tag_line'];
																																							} ?>" />
											<span class="help-block"> (Education+Experience) </span>
										</div>
									</div> -->
										<div class="form-group">
											<label class="col-md-3 control-label">Speakers Profile<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<textarea name="para_desc_1" id="para_desc_1" rows="" cols="" class="form-control" maxlength="750" onkeyup="totalCount();"><?php if (isset($_SESSION['para_desc_1'])) {
																																												echo $_SESSION['para_desc_1'];
																																											} else {
																																												echo @$qr_gt_user_data_ans_row['para_desc_1'];
																																											} ?></textarea>
												<span class="help-block">Total Characters count: <span id="display_count">0</span> characters. Characters left: <span id="word_left">750</span></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Speaker Photo <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input type="file" class="form-control1" name="speaker_photo" id="speaker_photo" required="required" />
											</div>
										</div>
										<!-- <div class="form-group">
										<label class="col-md-3 control-label">Speaker Organisation Logo </label>
										<div class="col-md-6">
											<input type="file" class="form-control1" name="speaker_logo" id="speaker_logo" />
										</div>
									</div> -->
										<div class="form-group">
											<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<div class="input-group">
													<input name="vercode" type="text" class="form-control" id="vercodevp" maxlength="10" required autocomplete="off" />
													<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_spkr_reg"]; ?>" />
													<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercode_spkr_reg"]; ?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn sbold uppercase green-jungle"> Continue
											<i class="fa fa-angle-right"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				<?php } else { ?>
					<h1>Registrations for <?php echo $EVENT_NAME . ' ' . $EVENT_YEAR; ?> is now closed. If you wish to register for the same you can do so on the spot at the venue.</h1>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/reg_form_footer.php'; ?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
	jQuery(document).ready(function() {
		Registration.init('registration_form_1', 0);
		$('.sele-it-sess').hide();
		$('.sele-bio-sess').hide();

		maxLength(document.getElementById("para_desc_1"));
	});

	function validate_registration() {

		//alert("c");

		if (document.getElementById("sector").value == "") {
			alert("Please select the sector");
			document.getElementById("sector").focus();
			return false;
		}
		/*if(document.getElementById("sector").value == "") {
			alert("Please select the Session Title");
			document.getElementById("speaker_session_title").focus();
			return false;
		}*/
		if (document.getElementById("speaker_title").value == "") {
			alert("Please select the Title");
			document.getElementById("speaker_title").focus();
			return false;
		}
		if (document.getElementById("speaker_fname").value == "") {
			alert("Please enter first name");
			document.getElementById("speaker_fname").focus();
			return false;
		}
		if (document.getElementById("speaker_lname").value == "") {
			alert("Please enter last name");
			document.getElementById("speaker_lname").focus();
			return false;
		}
		if (document.getElementById("speaker_desig").value == "") {
			alert("Please enter Designation ");
			document.getElementById("speaker_desig").focus();
			return false;
		}
		if (document.getElementById("speaker_org").value == "") {
			alert("Please enter Organisation ");
			document.getElementById("speaker_org").focus();
			return false;
		}
		if (document.getElementById("speaker_email_1").value == "") {
			alert("Please enter email");
			document.getElementById("speaker_email_1").focus();
			return false;
		}
		if (document.getElementById("para_desc_1").value == "") {
			alert("Please enter Speaker Profile");
			document.getElementById("para_desc_1").focus();
			return false;
		}
		if (document.getElementById("speaker_photo").value == "") {
			alert("Please upload speaker photo");
			document.getElementById("speaker_photo").focus();
			return false;
		}

		if (document.getElementById("vercodevp").value == "") {
			alert("Please fill the characters you see in image.");
			document.getElementById("vercodevp").focus();
			return false;
		} else if (document.getElementById("vercodevp").value != "") {
			compstr = document.getElementById("test").value;
			if (document.getElementById("vercodevp").value != compstr) {
				alert("Please fill correct characters you see in image.");
				document.getElementById("vercodevp").value = "";
				document.getElementById("vercodevp").focus();
				return false;
			}
		}
		//document.reg_registration_form_3.submit();
		return true;
	}


	function eventSessShow(control1) {

		var eveSelVal = $(control1).val();

		if (eveSelVal == 'Information Technology') {
			$('.sele-it-sess').show();
			$('.sele-bio-sess').hide();
			//$('.sele-NoEve-sess').hide();


		} else if (eveSelVal == 'Bio Technology') {
			// alert(eveSelVal);		
			$('.sele-it-sess').hide();
			$('.sele-bio-sess').show();
			//$('.sele-NoEve-sess').hide();
		} else {
			$('.sele-it-sess').hide();
			$('.sele-bio-sess').hide();
			//$('.sele-NoEve-sess').show();
			//alert("Please Select Sector.");
			return false;
		}

	}

	function maxLength(el) {
		if (!('maxLength' in el)) {
			var max = el.attributes.maxLength.value;
			el.onkeypress = function() {
				if (this.value.length > max) {
					return false;
				}
			};
		}
	}

	function totalCount() {
		if ($('#para_desc_1').val().length > 750) {
			return false;
		} else {
			$('#display_count').text($('#para_desc_1').val().length);
			$('#word_left').text(750 - $('#para_desc_1').val().length);
		}
	}

	function checkPhoneNumber(e, txt) {
		var intRegex = /^\d+$/;
		var str = document.getElementById(txt).value;
		if (!intRegex.test(str)) {
			document.getElementById(txt).value = "";
		}
	}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
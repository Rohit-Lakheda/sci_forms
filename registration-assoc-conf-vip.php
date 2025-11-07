<?php

//echo "<script language='javascript'>window.location.href='https://www.bengalurutechsummit.com/web/it_forms/enquiry.php';</script>";
//exit;
//ob_start();
//ini_set(session.save_path, 'E:\work\xampp\tmp');
require("includes/form_constants_both.php");
$assoc_name1 = "";
$ret = @$_GET['ret'];

if ($ret == "retds4fu324rn_ed24d3it") {
	session_start();
	if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
		session_destroy();
		echo "<script language='javascript'>alert('Please try again.');</script>";
		echo "<script language='javascript'>window.location=('registration-assoc-conf-vip.php');</script>";
		echo "<script language='javascript'>document.location=('registration-assoc-conf-vip.php');</script>";
		exit;
	}
	require "dbcon_open.php";
} else {
	include('captcha_reg.php');
}

$discountDetail = array();
if (isset($_GET['a']) && !empty($_GET['a'])) {
	$assoc_name1 = $_GET['a'];

	$sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_TBL WHERE promo_code='" . $assoc_name1 . "'";
	// echo $sql;
	// die;
	$discountDetail = mysqli_fetch_assoc(mysqli_query($link,$sql));
	if (isset($discountDetail['reg_done'])) {
		if ($discountDetail['reg_done'] >= $discountDetail['total_reg']) {
			session_destroy();
			echo "<script language='javascript'>alert('For " . $discountDetail['assoc_name'] . " Association/ Dignitary registrations seats are full.');</script>";
			echo "<script language='javascript'>window.location = 'registration-assoc-conf-vip.php';</script>";
			exit;
		}
	} else {
		session_destroy();
		echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
		echo "<script language='javascript'>window.location='registration-assoc-conf-vip.php';</script>";
		exit;
	}
}
/*$en = '';
 if(isset($_GET['en']) && !empty($_GET['en'])) {
 $en = '1';
 }*/

//$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG);
$totalRegistrations = 200;//mysqli_num_rows($qr_gt_user_data_id);
//echo $qr_gt_user_data_ans_no;
$assoc_name = '';
/* $assoc_name = @$_GET['assoc_name'];
 if($assoc_name == 'STPI') {
 echo "<script language='javascript'>window.location = 'registration-assoc-conf-vip.php?assoc_name=SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)';</script>";
 exit;
 } */
//print_r($_SESSION);

/*$del_category = '';
if($qr_gt_user_data_ans_row['assoc_srno'] == 101) {
   $del_category
}*/
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />';
require 'includes/reg_form_header.php'; ?>
<style>
	.selected-flag {
		margin-top: -5px;
	}

	.first-row td {
		background: #acb9ca;
	}

	.second-row td {
		background: #f4b084;
	}

	.third-row td {
		background: #dbdbdb;
	}

	.fourth-row td {
		background: #b4c6e7;
	}

	.fifth-row td {
		background: #00b050;
	}

	.button {
		background-color: #f00;
		-webkit-border-radius: 10px;
		border-radius: 10px;
		border: none;
		color: #FFFFFF;
		padding: 5px 7px;
		/*display: inline-block;
	  font-family: Arial;
	  font-size: 20px;
	  text-align: center;
	  text-decoration: none;*/
	}

	@-webkit-keyframes glowing {
		0% {
			background-color: #f00;
			-webkit-box-shadow: 0 0 3px #f00;
		}

		50% {
			background-color: #fff;
			-webkit-box-shadow: 0 0 10px #fff;
		}

		100% {
			background-color: #f00;
			-webkit-box-shadow: 0 0 3px #f00;
		}
	}

	@-moz-keyframes glowing {
		0% {
			background-color: #f00;
			-moz-box-shadow: 0 0 3px #f00;
		}

		50% {
			background-color: #fff;
			-moz-box-shadow: 0 0 10px #fff;
		}

		100% {
			background-color: #f00;
			-moz-box-shadow: 0 0 3px #f00;
		}
	}

	@-o-keyframes glowing {
		0% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}

		50% {
			background-color: #fff;
			box-shadow: 0 0 10px #fff;
		}

		100% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}
	}

	@keyframes glowing {
		0% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}

		50% {
			background-color: #fff;
			box-shadow: 0 0 10px #fff;
		}

		100% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}
	}

	.button {
		-webkit-animation: glowing 3000ms infinite;
		-moz-animation: glowing 3000ms infinite;
		-o-animation: glowing 3000ms infinite;
		animation: glowing 3000ms infinite;
	}

	@keyframes glowing {
		0% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}

		50% {
			background-color: #000;
			box-shadow: 0 0 10px #fff;
		}

		100% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}
	}

	.button {
		animation: glowing 3000ms infinite;
	}

	.align-td {
		text-align: center;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase">
						<?php if (empty($discountDetail['form_title'])) { ?>
							Complimentary delegate registration form
						<?php } else { ?>
							<?php echo $discountDetail['form_title']; ?>
						<?php } ?>
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<?php if (date('Y-m-d H:i') <= '2025-12-21 19:00' && !empty($discountDetail)) { ?>
					<form action="registration-assoc-conf-vip2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>"
						class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post"
						onsubmit="return validate_registration_form_2();">
						<?php /*?><input type="hidden" value="Standard" name="cata_m" /><?php */ ?>
						<input type="hidden" id="user_type" name="user_type" class="form-control"
							value="<?php echo $discountDetail['assoc_name']; ?>" />
						<input type="hidden" name="assoc_srno" id="assoc_srno"
							value="<?php echo $discountDetail['srno']; ?>" />
						<input name="promo_code" type="hidden" id="promo_code"
							value="<?php echo $discountDetail['promo_code']; ?>" />
						<div class="form-wizard">
							<div class="form-body" <?php echo date('Y-m-d H:i'); ?>>
								<ul class="nav nav-pills nav-justified steps">
									<li class="active">
										<a href="#tab1" data-toggle="tab" class="step">
											<span class="number"> 1 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Delegate Information </span>
										</a>
									</li>
									<?php /*<li>
																																<a data-toggle="tab" class="step dips-default-cursor">
																																<span class="number"> 2 </span>
																																<span class="desc">
																																<i class="fa fa-check"></i> Organisation Information </span>
																																</a>
																															</li>
																															<li>
																																<a data-toggle="tab" class="step dips-default-cursor">
																																<span class="number"> 2 </span>
																																<span class="desc">
																																<i class="fa fa-check"></i> Delegate Information </span>
																																</a>
																															</li>*/ ?>
									<li>
										<a data-toggle="tab" class="step dips-default-cursor">
											<span class="number"> 2 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Confirm </span>
										</a>
									</li>
									<li>
										<a data-toggle="tab" class="step dips-default-cursor">
											<span class="number"> 3 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Receipt </span>
										</a>
									</li>
								</ul>
								<div id="bar" class="progress progress-striped" role="progressbar">
									<div class="progress-bar progress-bar-success"> </div>
								</div>
								<!-- <h3 class="block">Provide required information for registration</h3> -->

								<div class="tab-content main-form-div" id="main-form-div">
									<div class="tab-pane active">
										<?php /*?>
																																			<div class="form-group form-md-radios">
																																				<label class="control-label col-md-3"> Single/ Group Delegate(s)<span class="required"> * </span> </label>
																																				<div class="col-md-9">
																																					<div class="md-radio-inline">
																																						<div class="md-radio">
																																							<input type="radio" id="Single" name="grp" class="md-radiobtn" value="Single" onclick="show_div_group_user();" checked="checked" required="required">
																																							<label for="Single">
																																							<span></span>
																																							<span class="check"></span>
																																							<span class="box"></span> Single Delegate </label>
																																						</div>
																																						<div class="md-radio">
																																							<input type="radio" id="Group" name="grp" class="md-radiobtn" value="Group" onclick="show_div_group_user();" required="required">
																																							<label for="Group">
																																							<span></span>
																																							<span class="check"></span>
																																							<span class="box"></span> Group Delegates </label>
																																						</div>
																																					</div>
																																				</div>
																																			</div>
																																			<div class="form-group" id="div_group_user">
																																				<label class="control-label col-md-3">Number of Delegates<span class="required"> * </span> </label>
																																				<div class="col-md-5 col-sm-3">
																																					<div class="group">
																																						<input type="text" name="total_dele" type="text" id="total_dele" maxlength="1" onkeyup="check_dele(event, 'total_dele');" />
																																						<span class="highlight"></span> 
																																						<span class="bar"></span> 
																																						<span class="help-block"> Min. 2 and max. 7 delegates are allowed. </span>
																																						<div class="alert alert-danger" id="del-error" style="display: none;">
																																							<strong>Error!</strong> Please enter number between 2 to 7 only.
																																						</div>
																																					</div>
																																				</div>
																																			</div>
																																			<div class="form-group">
																																				<label class="control-label col-md-3"> Select Sector <span class="required"> * </span>
																																				</label>
																																				<div class="col-md-6">
																																					<select id="sector" name="sector" class="form-control" required="required" onchange="showPayment();">
																																						<?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') {?>
																																							<?php $countryList = array('Information Technology'=>'Information Technology');
																																									foreach ($countryList as $key=>$value) {
																																										echo '<option value="' . $key . '">' . $value . '</option>'; 
																																									}
																																								?>
																																						<?php } else {?>
																																							<option value="">-- Select Sector --</option>
																																							<?php $countryList = array('Information Technology'=>'Information Technology', 'Biotechnology'=>'Biotechnology','Electronics'=>'Electronics', 'Startup'=>'Startup','Others'=>'Others');
																																									//$countryList = array('Information Technology'=>'Information Technology');
																																									foreach ($countryList as $key=>$value) {
																																										$selected = '';
																																										if(isset($_SESSION['sector']) && $_SESSION['sector'] == $value)
																																											$selected = 'selected=selected';
																																											echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>'; 
																																									}
																																								?>
																																						<?php } ?>
																																					</select>
																																				</div>
																																			</div>
																																			<?php */ ?>
										<?php if ($discountDetail['promo_code'] == 'T3JSW1N1') { ?>
											<div class="form-group">
												<label class="control-label col-md-3"> <span class="normal-cata">Number of
														Delegate(s)</span> <span class="required"> * </span></label>
												<div class="col-md-6">
													<select class="form-control" name="total_dele" id="total_dele" required>
														<?php $lmt = 7; ?>
														<option value="" class="normal-cata">-- Select --</option>
														<?php
														for ($index = 1; $index <= $lmt; $index++) {
															$selected = '';
															if (isset($_SESSION['total_dele']) && $_SESSION['total_dele'] == $index)
																$selected = 'selected="selected"';
															echo '<option value="' . $index . '" ' . $selected . '>' . $index . '</option>';
														}
														?>
													</select>
												</div>
											</div>

										<?php } else { ?>
											<div class="form-group hide" style="display: none;">
												<label class="control-label col-md-3"> <span class="normal-cata">Number of
														Delegate(s)</span> <span class="required"> * </span></label>
												<div class="col-md-6">
													<select class="form-control" name="total_dele" id="total_dele">
														<option value="1" selected="selected">1</option>
														<?php /*$lmt = 7;
																																																				if(isset($discountDetail['code']) && !empty($discountDetail['code'])) {
																																																					$lmt = 1;
																																																				} else {?>
																																																			<?php }*/ ?>
													</select>
												</div>
											</div>
										<?php }
										if ($assoc_name == 'ABAI OLD' || $assoc_name == 'Spread OLD' || $assoc_name == 'KSRSAC OLD' || $assoc_name == 'TiE Bangalore OLD' || $assoc_name == 'YESSS Abstract Presenter OLD' || $assoc_name == 'KBITS OLD') { ?>
											<div class="form-group form-md-radios" id="del_type">
												<label class="control-label col-md-3">Delegate Type <span class="required"> *
													</span> </label>
												<div class="col-md-9">
													<div class="md-radio-inline">
														<div class="md-radio">
															<input type="radio" id="Industry" name="cata_m" class="md-radiobtn"
																value="Industry" checked="checked" onclick="assignSingleDay();"
																required="required">
															<label for="Industry">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> Industry
															</label>
														</div>
														<div class="md-radio">
															<input type="radio" id="Student" name="cata_m" class="md-radiobtn"
																value="Student" onclick="assignSingleDay();"
																required="required">
															<label for="Student">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> Student
															</label>
														</div>
													</div>
												</div>
											</div>
											<input type="radio" id="Indian" name="curr" class="hide" value="Indian"
												checked="checked" onclick="show_cata();" required="required">
											<input type="radio" id="Single_Day" name="daytype" class="hide" value="Single Day"
												checked="checked" onclick="showDays();">
											<div class="group form-group">
												<label class="control-label col-md-3">Association Name: </label>
												<div class="col-md-9" style="margin-top: 8px;"><?php echo $assoc_name; ?>
													<input type="hidden" id="assoc_name" name="assoc_name"
														value="<?php echo $assoc_name; ?>">
												</div>
											</div>
											<?php if ($assoc_name == 'ABAI OLD') { ?>
												<input type="checkbox" id="day2" name="day2" class="hide" checked="checked"
													value="Day 2">
												<div class="group form-group">
													<label class="control-label col-md-3">Registration Single Day: </label>
													<div class="col-md-9" style="margin-top: 8px;">Day 2 - Tuesday, November 19,
														2019</div>
												</div>
											<?php } else if ($assoc_name == 'Spread OLD') { ?>
													<input type="checkbox" id="day3" name="day3" class="hide" checked="checked"
														value="Day 3">
													<div class="group form-group">
														<label class="control-label col-md-3">Regitration Single Day: </label>
														<div class="col-md-9" style="margin-top: 8px;">Day 3 -Wednesday, November 20,
															2019</div>
													</div>
											<?php } else if ($assoc_name == 'KSRSAC OLD' || $assoc_name == 'KBITS OLD') { ?>
														<input type="checkbox" id="day3" name="day3" class="hide" checked="checked"
															value="Day 3">
														<div class="group form-group">
															<label class="control-label col-md-3">Regitration Single Day: </label>
															<div class="col-md-9" style="margin-top: 8px;">Day 3 - Wednesday, November 20,
																2019</div>
														</div>
											<?php } else if ($assoc_name == 'TiE Bangalore OLD') { ?>
															<input type="checkbox" id="day3" name="day3" class="hide" checked="checked"
																value="Day 3">
															<div class="group form-group">
																<label class="control-label col-md-3">Regitration Single Day: </label>
																<div class="col-md-9" style="margin-top: 8px;">Day 3 - Wednesday, November 20,
																	2019</div>
															</div>
											<?php } else if ($assoc_name == 'YESSS Abstract Presenter OLD') { ?>
												<?php /*?><input type="radio" id="Full_Day" name="daytype" class="hide" value="3 Days" checked="checked">
																																											<?php */ ?>
																<input type="radio" id="Single_Day" name="daytype" class="hide" value="Single Day"
																	checked="checked">

																<div class="group form-group">
																	<label class="control-label col-md-3">Regitration Days: </label>
																	<div class="col-md-9" style="margin-top: 8px;">All 3 days</div>
																</div>
											<?php }
										} else { ?>
											<?php if (!empty($assoc_name)) { ?>
												<?php if (!empty($assoc_name) && $assoc_name == 'Program-Coordinators OLD') { ?>
													<div class="group form-group">
														<label class="control-label col-md-3"><strong>Select Program Coordinators<span
																	class="dips-required"> * </span></strong> </label>
														<div class="col-md-6">
															<select id="member_of_assoc" name="member_of_assoc" class="form-control"
																required="required">
																<option value="">-- Select Program Coordinators --</option>
																<?php $countryList = array('BiSEP', 'DAC', 'NAIN');
																foreach ($countryList as $value) {
																	echo '<option value="' . $value . '">' . $value . '</option>';
																}
																?>
															</select>
														</div>
													</div>
												<?php } else if (!empty($assoc_name) && $assoc_name == 'Faculty OLD') { ?>
														<div class="group form-group">
															<label class="control-label col-md-3"><strong>Select Faculty<span
																		class="dips-required"> * </span></strong> </label>
															<div class="col-md-6">
																<select id="member_of_assoc" name="member_of_assoc" class="form-control"
																	required="required">
																	<option value="">-- Select Faculty --</option>
																<?php $countryList = array('IBAB', 'CHG', 'IIIT-B');
																foreach ($countryList as $value) {
																	echo '<option value="' . $value . '">' . $value . '</option>';
																}
																?>
																</select>
															</div>
														</div>
												<?php } else if (!empty($assoc_name) && $assoc_name == 'Student-Coordinator OLD') { ?>
															<div class="group form-group">
																<label class="control-label col-md-3"><strong>Select <span
																			class="dips-required"> * </span></strong> </label>
																<div class="col-md-6">
																	<select id="member_of_assoc" name="member_of_assoc" class="form-control"
																		required="required">
																		<option value="">-- Select --</option>
																<?php $countryList = array('IBAB', 'CHG', 'IIIT-B', 'BiSEP', 'DAC', 'NAIN');
																foreach ($countryList as $value) {
																	echo '<option value="' . $value . '">' . $value . '</option>';
																}
																?>
																	</select>
																</div>
															</div>
												<?php } else { ?>
															<div class="group form-group">
																<label class="control-label col-md-3"><strong>Association Name:</strong>
																</label>
																<div class="col-md-9" style="margin-top: 8px;">
																	<strong><?php echo $assoc_name; ?></strong>
																</div>
															</div>
												<?php }
											} /*?>
																																							   <div class="form-group form-md-radios">
																																								   <label class="control-label col-md-3">Category <span class="required"> * </span> </label>
																																								   <div class="col-md-9">
																																									   <div class="md-radio-inline">
																																										   <div class="md-radio">
																																											   <input type="hidden" id="assoc_name" name="assoc_name" value="<?php echo !empty($assoc_name)? $assoc_name : '';?>">
																																											   <input type="radio" id="Indian" name="curr" class="md-radiobtn" value="Indian" onclick="show_cata();" checked="checked" required="required">
																																											   <label for="Indian">
																																											   <span></span>
																																											   <span class="check"></span>
																																											   <span class="box"></span> Indian 
																																											   </label>
																																										   </div>
																																										   <div class="md-radio <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)' || $assoc_name == "Student-Coordinator OLD") {?>hide<?php }?>">
																																											   <input type="radio" id="Foreign" name="curr" class="md-radiobtn" value="Foreign" onclick="show_cata();" required="required">
																																											   <label for="Foreign">
																																											   <span></span>
																																											   <span class="check"></span>
																																											   <span class="box"></span> International 
																																											   </label>
																																										   </div>
																																									   </div>
																																								   </div>
																																							   </div>								
																																							   <?php *//*?><div class="group form-group" id="genotypic-div" style="display:none;">
																																								   <label class="control-label col-md-3">Genotypic Techchnology Member code: <span class="required"> * </span></label>
																																								   <div class="col-md-6">
																																									   <input type="text" class="form-control" id="promo_code" name="promo_code">
																																								   </div>
																																							   </div><?php */ ?>
											<?php /*if(!empty($discountDetail) && $discountDetail['promo_code'] != 'T3JSW1N1') {?>
																																								<div class="form-group">
																																								<?php if($discountDetail['promo_code'] == 'France' ||$discountDetail['promo_code'] == 'Australia' ||$discountDetail['promo_code'] == 'Finland' ||$discountDetail['promo_code'] == 'Denmark' ||$discountDetail['promo_code'] == 'SouthKorea' ||$discountDetail['promo_code'] == 'UK' ||$discountDetail['promo_code'] == 'Sweden' ||$discountDetail['promo_code'] == 'Netherlands' ||$discountDetail['promo_code'] == 'Israel' ||$discountDetail['promo_code'] == 'EuropeanUnion' ||$discountDetail['promo_code'] == 'Lithuania' ||$discountDetail['promo_code'] == 'Germany' ||$discountDetail['promo_code'] == 'Switzerland' ||$discountDetail['promo_code'] == 'Japan' ||$discountDetail['promo_code'] == 'SAEA') {?>
																																									<label class="col-md-3 control-label">GIA Partner<span class="dips-required">  </span></label>
																																								<?php } else if($discountDetail['promo_code'] == '') {?>
																																									<label class="col-md-3 control-label">Association Name/ Dignitary Name<span class="dips-required">  </span></label>
																																								<?php } else {?>
																																									<label class="col-md-3 control-label">Association Name/ Dignitary Name<span class="dips-required">  </span></label>
																																								<?php }?>
																																									<div class="col-md-6" style="padding-top: 7px">
																																										<?php echo $discountDetail['assoc_name'];?>
																																										<input type="hidden" id="user_type" name="user_type" class="form-control" value="<?php echo $discountDetail['assoc_name'];?>"/>
																																										<input type="hidden" name="assoc_srno" id="assoc_srno" value="<?php echo $discountDetail['srno'];?>"/>
																																										<input name="promo_code" type="hidden" id="promo_code" value="<?php echo $discountDetail['promo_code'];?>"/>
																																									</div>
																																								</div>
																																							<?php } else {?>
																																								<input type="hidden" id="user_type" name="user_type" class="form-control" value="<?php echo $discountDetail['assoc_name'];?>"/>
																																								<input type="hidden" name="assoc_srno" id="assoc_srno" value="<?php echo $discountDetail['srno'];?>"/>
																																								<input name="promo_code" type="hidden" id="promo_code" value="<?php echo $discountDetail['promo_code'];?>"/>
																																							<?php }*/ ?>

										<?php } ?>
										<?php /*<h3 class="block">Provide Organisation Information</h3>
																																			
																																			<div class="form-group hide" style="display:none;">
																																				<label class="col-md-3 control-label">Nature Of Business</label>
																																				<div class="col-md-6">
																																					<input type="text" class="form-control" name="nature" id="nature" value="<?php echo (isset($_SESSION['nature']) ? $_SESSION['nature'] : '');?>" />
																																				</div>
																																			</div>
																																			<div class="form-group">
																																				<label class="col-md-3 control-label">Address 1<span class="dips-required"> * </span></label>
																																				<div class="col-md-6">
																																					<textarea name="addr1" id="addr1" rows="" cols="" required="required" class="form-control"><?php echo $qr_gt_user_data_ans_row['addr1'];?></textarea>
																																				</div>
																																			</div>
																																			<div class="form-group">
																																				<label class="col-md-3 control-label">Address 2</label>
																																				<div class="col-md-6">
																																					<textarea name="addr2" id="addr2" rows="" cols="" class="form-control"><?php echo $qr_gt_user_data_ans_row['addr2'];?></textarea>
																																				</div>
																																			</div>
																																			<div class="form-group hide" style="display:none;">
																																				<label class="col-md-3 control-label">State<span class="dips-required"> * </span></label>
																																				<div class="col-md-6">
																																					<input type="text" class="form-control" name="state" id="state" value="<?php echo (isset($_SESSION['state']) ? $_SESSION['state'] : '');?>"/>
																																				</div>
																																			</div>*/ ?>
										<?php /*<div class="form-group">
																																				<label class="col-md-3 control-label">Postal Code<span class="dips-required"> * </span></label>
																																				<div class="col-md-6">
																																					<input type="text" class="form-control" name="pin" id="pin" value="<?php echo $qr_gt_user_data_ans_row['pin'];?>" required="required"/>
																																				</div>
																																			</div>
																																			<div class="form-group">
																																				<label class="col-md-3 control-label">GST Number<span class="dips-required"> * </span></label>
																																					<div class="col-md-3">
																																						<select id="gst" name="gst" class="form-control" onchange="hidegst();" required="required">
																																							<option value="">- Select -</option>
																																							<option value="Registered" <?php if(!empty($qr_gt_user_data_ans_row['gst_number']) && $qr_gt_user_data_ans_row['gst_number'] != 'Unregistered')echo 'selected=selected';?> >Registered</option>
																																							<option value="Unregistered" <?php if(!empty($qr_gt_user_data_ans_row['gst_number']) && $qr_gt_user_data_ans_row['gst_number'] == 'Unregistered')echo 'selected=selected';?>>Unregistered</option>
																																						</select>
																																						<span class="help-block" style="color: #f00;">Note: If you want to leave this field empty,it will be considered <b>"Not Available"</b></span>
																																					</div>
																																					<div class="col-md-3" style="display:none;" id="gst-div">
																																						<input type="text" class="form-control" name="gst_number" id="gst_number" value="<?php if(empty($qr_gt_user_data_ans_row['gst_number']) || $qr_gt_user_data_ans_row['gst_number'] != 'Unregistered')echo $qr_gt_user_data_ans_row['gst_number'];?>" placeholder="Enter GST Number"  maxlength="15"/>
																																					</div>													
																																			</div>*/ ?>
										<?php /*<div class="form-group">
																																				<label class="col-md-3 control-label">GST Number<span class="dips-required"> * </span></label>
																																				<div class="col-md-6">
																																					<input type="text" class="form-control" name="gst_number" id="gst_number" value="<?php echo $qr_gt_user_data_ans_row['gst_number'];?>" required="required"/>
																																					<span class="help-block" style="color: #f00;">(Note: Only for India Companies for Raising an Invoice GST Number is a must.)</span>
																																					<span class="help-block" style="color: #f00;">Note: If you want to leave this field empty, then add it's value <b>"Not Available"</b></span>
																																				</div>
																																			</div>
																																			<div class="form-group">
																																				<label class="col-md-3 control-label">Telephone Number<span class="dips-required"> * </span></label>
																																				<div class="col-md-6" style="margin-top: -16px;">
																																					<span type="tel" id="telCountryIsoCode" data-fax-iso-code-hidden-field-name="foneCountryCode" class="hide"></span>
																																					<input type="hidden" name="foneCountryCode" id="foneCountryCode" value="<?php echo (isset($_SESSION['foneCountryCode'])) ? $_SESSION['foneCountryCode']: '';?>"/>
																																					<input type="hidden" id="foneCountryCodeIso" />
																																					<input name="fone" type="text" id="fone" class="form-control" maxlength="20" value="<?php echo (isset($_SESSION['fone'])) ? $_SESSION['fone']: '';?>" required onkeyup="checkPhoneNumber(event, 'fone');" style="padding-left: 92px;" />
																																					<span class="help-block">+Country Code-Area Code-Phone Number(xxx-xxxxxxx)</span>
																																				</div>
																																			</div>*/ ?>
										<h3 class="block">Provide Delegate Information</h3>
										<?php $lmt = 1;
										for ($i = 1; $i <= $lmt; $i++) { ?>
											<!-- <h4 class="form-section">Enter Information of Delegate 
										<?php if ($lmt > 1) {
											echo $i;
										} ?>
									</h4> -->
											<?php if ($discountDetail['srno'] != 74) { ?>
												<div class="form-group">
													<label class="control-label col-md-3"><strong>Tag:</strong> </label>
													<div class="col-md-9" style="margin-top: 8px;">
														<strong><?php echo $discountDetail['assoc_name']; ?></strong>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3"> Select Sector <span class="required"> *
														</span>
													</label>
													<div class="col-md-6">
														<select id="sector" name="sector" class="form-control" required="required">
															<?php if ($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') { ?>
																<?php $countryList = array('Information Technology' => 'Information Technology');
																foreach ($countryList as $key => $value) {
																	echo '<option value="' . $key . '">' . $value . '</option>';
																}
																?>
															<?php } else { ?>
																<option value="">-- Select Sector --</option>
																<?php $countryList = array("Information Technology" => "Information Technology",
																						    "Electronics & Semiconductor" => "Electronics & Semiconductor",
																						    "Drones & Robotics" => "Drones & Robotics",
																						    "EV, Energy, Climate, Water, Soil, GSDI" => "EV, Energy, Climate, Water, Soil, GSDI",
																						    "Telecommunications" => "Telecommunications",
																						    "Cybersecurity" => "Cybersecurity",
																						    "Artificial Intelligence" => "Artificial Intelligence", 
																						    "Cloud Services" => "Cloud Services",
																						    "E-Commerce" => "E-Commerce",
																						    "Automation" => "Automation",
																						    "AVGC" => "AVGC",
																						    "Aerospace, Defence & Space Tech" => "Aerospace, Defence & Space Tech", 
																						    "Mobility Tech" => "Mobility Tech",
																						    "Infrastructure" => "Infrastructure",
																						    "Biotech" => "Biotech",
																						    "Agritech" => "Agritech",
																						    "Medtech" => "Medtech",
																						    "Fintech" => "Fintech",
																						    "Healthtech" => "Healthtech",
																						    "Edutech" => "Edutech", 
																						    "Startup" => "Startup",
																						    "Unicorn/ VCs" => "Unicorn/ VCs",
																						    "Academia & University" => "Academia & University", 
																						    "Tech Parks / Co-Working Spaces of India" => "Tech Parks / Co-Working Spaces of India",
																						    "Banking / Insurance" => "Banking / Insurance",
																						    "R&D and Central Govt." => "R&D and Central Govt.",
																						    "Others" => "Others"
																						);
																//$countryList = array('Information Technology'=>'Information Technology');
																foreach ($countryList as $key => $value) {
																	$selected = '';
																	if (isset($_SESSION['sector']) && $_SESSION['sector'] == $value)
																		$selected = 'selected=selected';
																	echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
																}
																?>
															<?php } ?>
														</select>
													</div>
												</div>
											<?php } ?>
											<div class="form-group">
												<label class="control-label col-md-3">Name <span class="dips-required"> *
													</span></label>
												<div class="col-md-2">
													<select class="form-control" name="title<?php echo $i; ?>"
														id="title<?php echo $i; ?>" required="required">
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
												<div class="col-md-2"><input type="text" class="form-control"
														placeholder="First Name" name="fname<?php echo $i; ?>" type="text"
														id="fname<?php echo $i; ?>" maxlength="100" value="<?php if (isset($_SESSION['fname' . $i])) {
															   echo $_SESSION['fname' . $i];
														   } else {
															   echo @$qr_gt_user_data_ans_row['fname' . $i];
														   } ?>" required="required"></div>
												<div class="col-md-2"><input type="text" class="form-control"
														placeholder="Last Name" name="lname<?php echo $i; ?>" type="text"
														id="lname<?php echo $i; ?>" maxlength="100" value="<?php if (isset($_SESSION['lname' . $i])) {
															   echo $_SESSION['lname' . $i];
														   } else {
															   echo @$qr_gt_user_data_ans_row['lname' . $i];
														   } ?>" required="required"></div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">
													<?php if (($assoc_name1 == "GOKT3J") || ($assoc_name1 == "ITBTST")) {
														echo "Department Name";
													} else {
														echo "Organisation Name";
													} ?>


													<span class="dips-required"> * </span></label>
												<div class="col-md-6">
													<input type="text" class="form-control" name="org" id="org"
														value="<?php echo (isset($_SESSION['org']) ? $_SESSION['org'] : ''); ?>"
														required="required" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Job Title/ Designation <span
														class="dips-required"> * </span></label>
												<div class="col-md-6">
													<input class="form-control" name="job_title<?php echo $i; ?>" type="text"
														id="job_title<?php echo $i; ?>" maxlength="100" value="<?php if (isset($_SESSION['job_title' . $i])) {
															   echo $_SESSION['job_title' . $i];
														   } else {
															   echo @$qr_gt_user_data_ans_row['job_title' . $i];
														   } ?>" required="required" />
												</div>
											</div>
											<?php /*?><div class="form-group hide">
																																								<label class="col-md-3 control-label">Name on Badge <span class="dips-required"> * </span></label>
																																								<div class="col-md-6">
																																									<input class="form-control" name="badge<?php echo $i; ?>" type="text" id="badge<?php echo $i; ?>" maxlength="150" value="<?php if(isset($_SESSION['badge'.$i])) { echo $_SESSION['badge'.$i]; }else{ echo @$qr_gt_user_data_ans_row['badge'.$i]; } ?>" required onkeyup="check_char(event,'badge<?php echo $i; ?>')"/>
																																								</div>
																																							</div><?php */ ?>
											<div class="form-group">
												<label class="col-md-3 control-label">Email Address <span class="dips-required">
														* </span></label>
												<div class="col-md-6">
													<input class="form-control" name="email_m<?php echo $i; ?>" type="email"
														id="email_m<?php echo $i; ?>" maxlength="150" value="<?php if (isset($_SESSION['email' . $i])) {
															   echo $_SESSION['email' . $i];
														   } else {
															   echo @$qr_gt_user_data_ans_row['email' . $i];
														   } ?>" required />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Mobile Number <span
														class="dips-required"><?php if ($discountDetail['promo_code'] != 'T3JS12') { ?>*<?php } ?>
													</span></label>
												<div class="col-md-6" style="margin-top: -18px;">
													<span type="tel" id="mobile-country-code<?php echo $i; ?>"
														data-fax-iso-code-hidden-field-name="cellnoCountryCode<?php echo $i; ?>"></span>
													<?php
													$mobile = array();
													if (isset($qr_gt_user_data_ans_row['cellno' . $i]))
														$mobile = explode("-", $qr_gt_user_data_ans_row['cellno' . $i]);
													?>
													<input type="hidden" name="cellnoCountryCode<?php echo $i; ?>"
														id="cellnoCountryCode<?php echo $i; ?>"
														value="<?php echo !empty($mobile[1]) ? str_replace('+', '', @$mobile[0]) : ''; ?>" />
													<input type="hidden" id="cellnoCountryCode<?php echo $i; ?>Iso" />
													<input class="form-control" name="cellno<?php echo $i; ?>" type="text"
														id="cellno<?php echo $i; ?>" maxlength="10" <?php if ($discountDetail['promo_code'] != 'T3JS12') { ?>required<?php } ?> value="<?php if (isset($_SESSION['cellno' . $i])) {
																	   echo $_SESSION['cellno' . $i];
																   } ?>" onkeyup="check_num(event, 'cellno<?php echo $i; ?>');" style="padding-left: 92px;" />
													<span class="help-block">+Country Code-Mobile Number(xxx-xxxxxxxxxx)</span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">City<span class="dips-required"> *
													</span></label>
												<div class="col-md-6">
													<input type="text" class="form-control" name="city" id="city"
														value="<?php echo (isset($_SESSION['city']) ? $_SESSION['city'] : ''); ?>"
														onkeyup="check_char(event,'city')" required="required" />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3"> Country <span class="required"> * </span>
												</label>
												<div class="col-md-6">
													<select id="country" name="country" class="form-control">
														<option value="">Select Country </option>
														<?php $countryList = array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "American Samoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "Bosniaand Herzegowina", "BW" => "Botswana", "BV" => "BouvetIsland", "BR" => "Brazil", "IO" => "British Indian Ocean Territory", "BN" => "Brunei Darussalam", "BG" => "Bulgaria", "BF" => "Burkina Faso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "CapeVerde", "KY" => "Cayman Islands", "CF" => "CentralAfricanRepublic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "ChristmasIsland", "CC" => "Cocos Keeling Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo the Democratic Republicofthe", "CK" => "Cook Islands", "CR" => "CostaRica", "CI" => "Coted Ivoire", "HR" => "Croatia(Hrvatska)", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "Czech Republic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "Dominican Republic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "ElSalvador", "GQ" => "Equatorial Guinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "Falkland Islands Malvinas", "FO" => "FaroeIslands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "French Guiana", "PF" => "French Polynesia", "TF" => "French Southern Territories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "Heardand McDonald Islands", "VA" => "HolySee Vatican City State", "HN" => "Honduras", "HK" => "Hong Kong", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran Islamic Republic", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KP" => "Korea Democratic People Republic", "KR" => "Korea Republic", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "LaoPeoples Democratic Republic", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "Libyan Arab Jamahiriya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau", "MK" => "Macedonia The Former Yugoslav Republic", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "Marshall Islands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia,FederatedStatesof", "MD" => "Moldova Republic", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "Netherlands Antilles", "NC" => "NewCaledonia", "NZ" => "New Zealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "Norfolk Island", "MP" => "Northern Mariana Islands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PA" => "Panama", "PG" => "Papua New Guinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PT" => "Portugal", "PR" => "PuertoRico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "Russian Federation", "RW" => "Rwanda", "KN" => "Saint Kittsand Nevis", "LC" => "SaintLUCIA", "VC" => "Saint VincentandtheGrenadines", "WS" => "Samoa", "SM" => "SanMarino", "ST" => "Sa oTomeand Principe", "SA" => "Saudi Arabia", "SN" => "Senegal", "SC" => "Seychelles", "SL" => "Sierra Leone", "SG" => "Singapore", "SK" => "Slovakia SlovakRepublic", "SI" => "Slovenia", "SB" => "Solomon Islands", "SO" => "Somalia", "ZA" => "South Africa", "GS" => "South Georgiaand the South Sandwich Islands", "ES" => "Spain", "LK" => "SriLanka", "SH" => "St.Helena", "PM" => "St.Pierreand Miquelon", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "Svalbardand Jan Mayen Islands", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "Syrian Arab Republic", "TW" => "Taiwan", "TJ" => "Tajikistan", "TZ" => "Tanzania United Republic", "TH" => "Thailand", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "TrinidadandTobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "Turksand Caicos Islands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "United Arab Emirates", "GB" => "United Kingdom", "US" => "United States", "UM" => "United States Minor Outlying Islands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "VietNam", "VG" => "VirginIslands British ", "VI" => "Virgin Islands U.S.", "WF" => "Wallisand Futuna Islands", "EH" => "Western Sahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");
														if (!isset($_SESSION) || empty($_SESSION['country'])) {
															$qr_gt_user_data_ans_row['country'] = 'India';
														}
														foreach ($countryList as $country) {
															$selected = '';

															if (isset($_SESSION['country']) && $_SESSION['country'] == $country) {
																$selected = 'selected=selected';
															} else if ($country == "India") {
																if (($assoc_name1 == "GOKT3J") || ($assoc_name1 == "ITBTST")) {
																	$selected = 'selected=selected';
																} else {

																}
															} else {

															}

															echo '<option value="' . $country . '" ' . $selected . ' >' . $country . '</option>';
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3"> Category <span class="required"> </span>
												</label>
												<div class="col-md-6" style="margin-top: 8px;">
													<?php echo $discountDetail['badge_print_category']; ?>
													<input type="hidden" id="catagory<?php echo $i; ?>"
														name="catagory<?php echo $i; ?>"
														value="<?php echo $discountDetail['badge_print_category']; ?>" />

													<?php /*<select id="catagory<?php echo $i; ?>" name="catagory<?php echo $i; ?>" class="form-control" required="required" onchange="showPayment();">
																																																	<option value="">-- Category  --</option>
																																																	<?php if($qr_gt_user_data_ans_row['nationality'] == 'Indian Organization') {
																																																			   $countryList = array('Conference Delegate', 'Premium Delegate');
																																																	} else {
																																																		$countryList = array('Conference Delegate', 'International Premium Delegate');
																																																	}
																																																		//$countryList = array('Information Technology'=>'Information Technology');
																																																		foreach ($countryList as $value) {
																																																			$selected = '';
																																																			if(isset($qr_gt_user_data_ans_row['cata'.$i]) && $qr_gt_user_data_ans_row['cata'.$i] == $value) {
																																																				$selected = 'selected="selected"';
																																																			}
																																																			echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>'; 
																																																		}
																																																	?>
																																															</select>*/ ?>
												</div>
											</div>
										<?php }/*?><div class="form-group">
																																			<label class="col-md-3 control-label">Fax Number</label>
																																			<div class="col-md-6" style="margin-top: -15px;">
																																				<span type="tel" id="faxCountryIsoCode" data-fax-iso-code-hidden-field-name="faxCountryCode"></span>
																																				<?php $fax = explode('-', $qr_gt_user_data_ans_row['fax']);?>
																																				<input type="hidden" name="faxCountryCode" id="faxCountryCode" value="<?php echo !empty($fax[1]) ? @$fax[0] : '';?>"/>
																																				<input type="hidden" id="faxCountryCodeIso" />
																																				<input name="fax" type="text" id="fax" class="form-control" maxlength="20" value="<?php echo !empty($fax[1]) ? @$fax[1] .@$fax[2] : '';?>" onkeyup="checkPhoneNumber(event, 'fax');" style="padding-left: 92px;"/>
																																				<span class="help-block">+Country Code-Area Code-Fax Number(xxx-xxxxxxx)</span>
																																			</div>
																																		</div><?php */ ?>
										<div class="form-group">
											<label class="col-md-3 control-label">Enter text see in the image <span
													class="dips-required"> * </span></label>
											<div class="col-md-6">
												<div class="input-group">
													<input name="vercode" type="text" class="form-control" id="vercodevp"
														maxlength="10" required autocomplete="off" />
													<input name="test" type="hidden" id="test"
														value="<?php echo $_SESSION["vercode_reg"]; ?>" />
													<span class="input-group-addon"
														style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercode_reg"]; ?></span>
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
					<h1>This link is either invalid or expired. Please use correct link.</h1>
				<?php }/*Online registration for <?php echo $EVENT_NAME . ' ' . $EVENT_YEAR;?> is closed.*/ ?>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/reg_form_footer.php'; ?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript">var assoc_name = '<?php echo $assoc_name; ?>';</script>
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script>
	jQuery(document).ready(function () {
		Registration.init('registration_form_1', 0);
		//$('#main-form-div').hide();
		//debugger;
		//showForm();
		//show_cata();
		//show_div_group_user();
		//showTxt();
		//showDays();
		//assignSingleDay();
		//showPromoCode();
		//$("#telCountryIsoCode").intlTelInput();
		<?php for ($i = 1; $i <= $lmt; $i++) { ?>
			$("#mobile-country-code<?php echo $i; ?>").intlTelInput();
		<?php } ?>
	});

	function validate_registration_form_2() {
		<?php if ($discountDetail['srno'] != 74) { ?>
			if (document.getElementById("sector").value == "") {
				alert("Please select the sector");
				document.getElementById("sector").focus();
				return false;
			}
		<?php } ?>
		j = 1;
		if (document.getElementById("title" + j).value == "") {
			alert("Please fill delegate  title ");
			document.getElementById("title" + j).focus();
			return false;
		}
		if (document.getElementById("fname" + j).value == "") {
			alert("Please fill delegate  first name");
			document.getElementById("fname" + j).focus();
			return false;
		}
		if (document.getElementById("lname" + j).value == "") {
			alert("Please fill delegate  last name");
			document.getElementById("lname" + j).focus();
			return false;
		}

		if ((document.getElementById("org").value == "")) {
			alert("Please Enter Organisation Name.");
			document.getElementById("org").focus();
			return false;
		}
		if (document.getElementById("job_title" + j).value == "") {
			alert("Please fill delegate Designation");
			document.getElementById("job_title" + j).focus();
			return false;
		}
		/*if(document.getElementById("badge"+j).value == "")
		{
			alert("Please fill delegate badge name");
			document.getElementById("badge"+j).focus();
			return false;
		}*/

		if (document.getElementById("email_m" + j).value == "") {
			alert("Please fill delegate email");
			document.getElementById("email_m" + j).focus();
			return false;
		} else if (document.getElementById("email_m" + j).value != "") {
			var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var toArr = document.getElementById("email_m" + j).value.split(","); 			//split into array
			for (var i = 0; i < toArr.length; i++) 				    					//loop array to validate correct address
			{
				if (!toArr[i].match(reg)) 										//if not match, alert and stop loop
				{
					alert("Invalid email address \n" + toArr[i]);
					document.getElementById("email_m" + j).focus();
					return false;
				}
			}
		}

		<?php if ($discountDetail['promo_code'] != 'T3JS12') { ?>

			/*if(document.getElementById("c_code"+j).value == "")
			{
				alert("Please fill delegate country code");
				document.getElementById("c_code"+j).focus();
				return false;
			}*/
			if (document.getElementById("cellno" + j).value == "") {
				alert("Please fill delegate mobile number");
				document.getElementById("cellno" + j).focus();
				return false;
			}
		<?php } ?>
		if (document.getElementById("catagory" + j).value == "") {
			alert("Please fill delegate category");
			document.getElementById("catagory" + j).focus();
			return false;
		}

		if ((document.getElementById("city").value == "")) {
			alert("Please Enter City.");
			document.getElementById("city").focus();
			return false;
		}
		if ((document.getElementById("country").value == "")) {
			alert("Please Enter Country.");
			document.getElementById("country").focus();
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

		//document.getElementById("reg_registration_form_1").submit();
		return true;
	}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
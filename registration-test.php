<?php
/*echo "<script language='javascript'>window.location.href='https://www.bengalurutechsummit.com/web/it_forms/enquiry.php';</script>";
exit;*/
//ob_start();
//ini_set(session.save_path, 'E:\work\xampp\tmp');
require("includes/form_constants_both.php");
$ret = @$_GET['ret'];

if ($ret == "retds4fu324rn_ed24d3it") {
	session_start();
	if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
		session_destroy();
		echo "<script language='javascript'>alert('Please try again.');</script>";
		echo "<script language='javascript'>window.location=('registrations.php');</script>";
		echo "<script language='javascript'>document.location=('registrations.php');</script>";
		exit;
	}
	require "dbcon_open.php";
} else {
	include('captcha_reg.php');
}

$discountDetail = array();
if(isset($_GET['a']) && !empty($_GET['a'])) {
	$assoc_name1 = $_GET['a'];

	$sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_TBL WHERE promo_code='" . $assoc_name1 . "'";
	$discountDetail = mysqli_fetch_assoc(mysqli_query($link,$sql));
	if(isset($discountDetail['reg_done'])) {
		if($discountDetail['reg_done'] >= $discountDetail['total_reg']) {
			session_destroy();
			echo "<script language='javascript'>alert('For " . $discountDetail['assoc_name'] . " Association/ Dignitary registrations seats are fulled.');</script>";
			echo "<script language='javascript'>window.location = 'registration.php';</script>";
			exit;
		}
	} else {
		session_destroy();
		echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
		echo "<script language='javascript'>window.location='registration.php';</script>";
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

$assoc_name = @$_GET['assoc_name'];
if($assoc_name == 'STPI') {
	echo "<script language='javascript'>window.location = 'registration.php?assoc_name=SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)';</script>";
	exit;
}
?>
<?php require 'includes/reg_form_header.php';?>
<style>
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
	  0% { background-color: #f00; -webkit-box-shadow: 0 0 3px #f00; }
	  50% { background-color: #fff; -webkit-box-shadow: 0 0 10px #fff; }
	  100% { background-color: #f00; -webkit-box-shadow: 0 0 3px #f00; }
	}

	@-moz-keyframes glowing {
	  0% { background-color: #f00; -moz-box-shadow: 0 0 3px #f00; }
	  50% { background-color: #fff; -moz-box-shadow: 0 0 10px #fff; }
	  100% { background-color: #f00; -moz-box-shadow: 0 0 3px #f00; }
	}

	@-o-keyframes glowing {
	  0% { background-color: #f00; box-shadow: 0 0 3px #f00; }
	  50% { background-color: #fff; box-shadow: 0 0 10px #fff; }
	  100% { background-color: #f00; box-shadow: 0 0 3px #f00; }
	}

	@keyframes glowing {
	  0% { background-color: #f00; box-shadow: 0 0 3px #f00; }
	  50% { background-color: #fff; box-shadow: 0 0 10px #fff; }
	  100% { background-color: #f00; box-shadow: 0 0 3px #f00; }
	}

	.button {
	  -webkit-animation: glowing 3000ms infinite;
	  -moz-animation: glowing 3000ms infinite;
	  -o-animation: glowing 3000ms infinite;
	  animation: glowing 3000ms infinite;
	}

	@keyframes glowing {
	  0% { background-color: #f00; box-shadow: 0 0 3px #f00; }
	  50% { background-color: #000; box-shadow: 0 0 10px #fff; }
	  100% { background-color: #f00; box-shadow: 0 0 3px #f00; }
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
					<span class="caption-subject font-red bold uppercase"> Delegate Registration Form <?php 
					
					
					if($assoc_name != ""){ 
						if($assoc_name == "Faculty"){
							$assoc_name_disp = "ONLY FOR IBAB, CHG AND IIIT-B FACULTY ";	
						} else if($assoc_name == "Program-Coordinators"){
							$assoc_name_disp = "ONLY FOR BiSEP, DAC and NAIN PROGRAM-COORDINATORS ";	
						} else if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') {
							$assoc_name_disp = " For SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI MEMBER)";
						} else if($assoc_name == "Student-Coordinator"){
							$assoc_name_disp = "For IBAB, CHG, IIIT-B, BiSEP, DAC and NAIN Students";	
						}else{
							$assoc_name_disp = "For ".$assoc_name;	
						}
					
						echo " $assoc_name_disp"; 
					}
					
					?>
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<?php if(date('Y-m-d H:i') >= '2019-11-15 19:00') {?>
				<form action="registration2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post" onsubmit="return validate_registration_form_2();">
					<?php /*?><input type="hidden" value="Standard" name="cata_m" /><?php */?>
					<div class="form-wizard">
						<div class="form-body" <?php echo date('Y-m-d H:i');?>>
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a href="#tab1" data-toggle="tab" class="step">
									<span class="number"> 1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Registration Category </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Organisation Information </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 3 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Delegate Information </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 4 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Confirm </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 5 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Receipt </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success"> </div>
							</div>
							<h3 class="block">Provide required information for registration</h3>
							<div class="row form-group hide">
								<label class="control-label col-md-3"> Select Conference Type <span class="required"> * </span></label>
								<div class="col-md-9">
									<div class="md-radio-inline">
										<?php /* ?><div class="md-radio">
											<input type="radio" id="delegate-conf" name="conf_type" class="md-radiobtn" value="Physical Conference" onclick="showForm();"  required="required">
											<label for="delegate-conf">
											<span></span>
											<span class="check"></span>
											<span class="box"></span> Physical Conference </label>
										</div><?php */ ?>
										<div class="md-radio">
											<input type="radio" id="delegate-virtual" name="conf_type" class="md-radiobtn" value="Virtual Conference" onclick="showForm();" >
											<label for="delegate-virtual">
											<span></span>
											<span class="check"></span>
											<span class="box"></span> Virtual Conference </label>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-content main-form-div" id="main-form-div" >
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
									<?php */?>
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
													<?php $countryList = array('Information Technology'=>'Information Technology', 'Biotechnology'=>'Biotechnology','Electronics'=>'Electronics');
															//$countryList = array('Information Technology'=>'Information Technology');
															foreach ($countryList as $key=>$value) {
																echo '<option value="' . $key . '">' . $value . '</option>'; 
															}
														?>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group form-md-radios del_type" id="del_type">
										<label class="control-label col-md-3">Delegate Type <span class="required"> * </span> </label>
										<div class="col-md-9">
											<div class="md-radio-inline">
												<div class="md-radio <?php if($assoc_name == 'Student-Coordinator') {?>hide<?php }?>">
													<input type="radio" id="Industry" name="cata_m" class="md-radiobtn" value="Partnering Delegate" <?php if($assoc_name != 'Student-Coordinator') {?>checked="checked"<?php }?> onclick="assignSingleDay();" required="required">
													<label for="Industry">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Partnering Delegate
													</label>
												</div>
												<div class="md-radio <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') {?>hide<?php }?>">
													<input type="radio" id="Student" name="cata_m" class="md-radiobtn" value="Conference Delegate" onclick="assignSingleDay();" required="required">
													<label for="Student">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Conference Delegate 
													</label>
												</div>
												<div class="md-radio hide">
													<input type="radio" id="Visitors" name="cata_m" class="md-radiobtn" value="Attendees/Visitors" onclick="assignSingleDay();" required="required">
													<label for="Visitors">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Attendees/Visitors
													</label>
												</div>
												<?php /*?><div class="md-radio <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)' || $assoc_name == 'Student-Coordinator') {?>hide<?php }?>">
													<input type="radio" id="Academia" name="cata_m" class="md-radiobtn" value="R&D and Academia" onclick="assignSingleDay();" required="required">
													<label for="Academia">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> R&D and Academia 
													</label>
												</div><?php */?>
											</div>
										</div>
									</div>	
									<div class="form-group">
										<label class="control-label col-md-3"> <span class="normal-cata">Number of Delegate(s)</span><span class="poster-cata" style="display:none;">Number of Co-Author</span> <span class="required"> * </span></label>
										<div class="col-md-6">
											<select class="form-control" name="total_dele" id="total_dele" required>
												<?php $lmt = 7;
													if(isset($discountDetail['code']) && !empty($discountDetail['code']) && $discountDetail['code'] == 'WOF') {
														$lmt = 1;
													} else {?>
												<option value="" class="normal-cata">-- Select --</option>
												<option value="No" class="poster-cata" style="display:none;">No</option>
												<?php }
													for($index = 1; $index <= $lmt; $index++) {
														$className = '';
														if($index >= 4) {
															$className = 'class="normal-cata"';
														}
														echo '<option value="' . $index . '" ' . $className . '>' . $index . '</option>';
													}
													?>
											</select>
										</div>
									</div>
									<?php if($assoc_name == 'ABAI' || $assoc_name == 'Spread' || $assoc_name == 'KSRSAC' || $assoc_name == 'TiE Bangalore' || $assoc_name == 'YESSS Abstract Presenter'|| $assoc_name=='KBITS') {?>
									<div class="form-group form-md-radios" id="del_type">
										<label class="control-label col-md-3">Delegate Type <span class="required"> * </span> </label>
										<div class="col-md-9">
											<div class="md-radio-inline">
												<div class="md-radio">
													<input type="radio" id="Industry" name="cata_m" class="md-radiobtn" value="Industry" checked="checked" onclick="assignSingleDay();" required="required">
													<label for="Industry">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Industry 
													</label>
												</div>
												<div class="md-radio">
													<input type="radio" id="Student" name="cata_m" class="md-radiobtn" value="Student" onclick="assignSingleDay();" required="required">
													<label for="Student">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Student 
													</label>
												</div>
											</div>
										</div>
									</div>
									<input type="radio" id="Indian" name="curr" class="hide" value="Indian" checked="checked" onclick="show_cata();" required="required">
									<input type="radio" id="Single_Day" name="daytype" class="hide" value="Single Day" checked="checked" onclick="showDays();">
									<div class="group form-group">
										<label class="control-label col-md-3">Association Name: </label>
										<div class="col-md-9" style="margin-top: 8px;"><?php echo $assoc_name;?>
											<input type="hidden" id="assoc_name" name="assoc_name" value="<?php echo $assoc_name;?>">
										</div>
									</div>
									<?php if($assoc_name == 'ABAI') {?>
									<input type="checkbox" id="day2" name="day2" class="hide" checked="checked" value="Day 2">
									<div class="group form-group">
										<label class="control-label col-md-3">Registration Single Day: </label>
										<div class="col-md-9" style="margin-top: 8px;">Day 2 - Tuesday, November 19, 2019</div>
									</div>
									<?php } else if($assoc_name == 'Spread') {?>
									<input type="checkbox" id="day3" name="day3" class="hide" checked="checked" value="Day 3">
									<div class="group form-group">
										<label class="control-label col-md-3">Regitration Single Day: </label>
										<div class="col-md-9" style="margin-top: 8px;">Day 3 -Wednesday, November 20, 2019</div>
									</div>
									<?php } else if($assoc_name == 'KSRSAC'||$assoc_name == 'KBITS') {?>
									<input type="checkbox" id="day3" name="day3" class="hide" checked="checked" value="Day 3">
									<div class="group form-group">
										<label class="control-label col-md-3">Regitration Single Day: </label>
										<div class="col-md-9" style="margin-top: 8px;">Day 3 - Wednesday, November 20, 2019</div>
									</div>
									<?php } else if($assoc_name == 'TiE Bangalore') {?>
									<input type="checkbox" id="day3" name="day3" class="hide" checked="checked" value="Day 3">
									<div class="group form-group">
										<label class="control-label col-md-3">Regitration Single Day: </label>
										<div class="col-md-9" style="margin-top: 8px;">Day 3 - Wednesday, November 20, 2019</div>
									</div>
									<?php } else if($assoc_name == 'YESSS Abstract Presenter') {?>
									<?php /*?><input type="radio" id="Full_Day" name="daytype" class="hide" value="3 Days" checked="checked">
									<?php */?>
                                    <input type="radio" id="Single_Day" name="daytype" class="hide" value="Single Day" checked="checked">
                                    
                                    <div class="group form-group">
										<label class="control-label col-md-3">Regitration Days: </label>
										<div class="col-md-9" style="margin-top: 8px;">All 3 days</div>
									</div>
									<?php }} else {?>
									<?php if(!empty($assoc_name)) {?>
										<?php if(!empty($assoc_name) && $assoc_name == 'Program-Coordinators') {?>
										<div class="group form-group">
											<label class="control-label col-md-3"><strong>Select Program Coordinators<span class="dips-required"> * </span></strong> </label>
											<div class="col-md-6">
												<select id="member_of_assoc" name="member_of_assoc" class="form-control" required="required">
												<option value="">-- Select Program Coordinators --</option>
												<?php $countryList = array('BiSEP', 'DAC', 'NAIN');
														foreach ($countryList as $value) {
															echo '<option value="' . $value . '">' . $value . '</option>'; 
														}
													?>
												</select>
											</div>
										</div>
										<?php } else if(!empty($assoc_name) && $assoc_name == 'Faculty') {?>
										<div class="group form-group">
											<label class="control-label col-md-3"><strong>Select Faculty<span class="dips-required"> * </span></strong> </label>
											<div class="col-md-6">
												<select id="member_of_assoc" name="member_of_assoc" class="form-control" required="required">
												<option value="">-- Select Faculty --</option>
												<?php $countryList = array('IBAB', 'CHG', 'IIIT-B');
														foreach ($countryList as $value) {
															echo '<option value="' . $value . '">' . $value . '</option>'; 
														}
													?>
												</select>
											</div>
										</div>
										<?php } else if(!empty($assoc_name) && $assoc_name == 'Student-Coordinator') {?>
										<div class="group form-group">
											<label class="control-label col-md-3"><strong>Select <span class="dips-required"> * </span></strong> </label>
											<div class="col-md-6">
												<select id="member_of_assoc" name="member_of_assoc" class="form-control" required="required">
												<option value="">-- Select --</option>
												<?php $countryList = array('IBAB', 'CHG', 'IIIT-B', 'BiSEP', 'DAC', 'NAIN');
														foreach ($countryList as $value) {
															echo '<option value="' . $value . '">' . $value . '</option>'; 
														}
													?>
												</select>
											</div>
										</div>
										<?php } else {?>
										<div class="group form-group">
											<label class="control-label col-md-3"><strong>Association Name:</strong> </label>
											<div class="col-md-9" style="margin-top: 8px;"><strong><?php echo $assoc_name;?></strong>
											</div>
										</div>
									<?php }}?>
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
												<div class="md-radio <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)' || $assoc_name == "Student-Coordinator") {?>hide<?php }?>">
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
									<?php /*?><div class="group form-group" id="genotypic-div" style="display:none;">
										<label class="control-label col-md-3">Genotypic Techchnology Member code: <span class="required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="promo_code" name="promo_code">
										</div>
									</div><?php */?>
									<?php if(!empty($discountDetail)) {?>
										<div class="form-group">
											<label class="col-md-3 control-label">Association Name/ Dignitary Name<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<?php echo $discountDetail['assoc_name'];?>
												<input type="hidden" id="user_type" name="user_type" class="form-control" value="<?php echo $discountDetail['assoc_name'];?>"/>
												<input type="hidden" name="assoc_srno" id="assoc_srno" value="<?php echo $discountDetail['srno'];?>"/>
												<input name="promo_code" type="hidden" id="promo_code" value="<?php echo $discountDetail['promo_code'];?>"/>
												<span class="help-block"><i>Note: Discount will get added at last step of registration.</i></span>
											</div>
										</div>
									<?php }?>
									<div class="form-group form-md-radios hide" id="reg_type">
										<label class="control-label col-md-3"> Type of registration<span class="required"> * </span> </label>
										<div class="col-md-9">
											<div class="md-radio-inline">
												<?php /*?><div class="md-radio" id="Single_Day_button">
													<input type="radio" id="Single_Day" name="daytype" class="md-radiobtn" value="Single Day" onclick="showDays();">
													<label for="Single_Day">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Single Day </label>
												</div><?php */?>
												<div class="md-radio">
													<input type="radio" id="Full_Day" name="daytype" class="md-radiobtn" value="3 Days" checked="checked" onclick="showDays();">
													<label for="Full_Day">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> 3 Days </label>
												</div>
												<?php /*?><div class="md-radio">
													<input type="radio" id="3_days_speaker" name="daytype" class="md-radiobtn" value="3 days with speaker offer" checked="checked" onclick="showDays();">
													<label for="3_days_speaker">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> 3 Days with speaker offer </label>
												</div>
												<div class="md-radio hide">
													<input type="radio" id="3_days_power_bank" name="daytype" class="md-radiobtn" value="" checked="checked">
													<label for="3_days_power_bank">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> </label>
												</div><?php */?>
											</div>
										</div>
									</div>
									<div class="form-group form-md-radios" id="div_single_day" style="display: none;">
										<label class="control-label col-md-3">Select Day(s)<span class="required"> * </span> </label>
										<div class="col-md-9">
											<div class="md-checkbox-inline">
												<div class="md-checkbox">
													<input type="checkbox" id="day1" name="day1" class="md-check" value="Nov 18th">
													<label for="day1">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Nov 18<sup>th</sup>
													</label>
												</div><?php /*?><?php */?>
												<?php if(date('Y-m-d H:i') <= '2019-11-20 20:00') {?>
												<div class="md-checkbox">
													<input type="checkbox" id="day2" name="day2" class="md-check" value="Nov 19th">
													<label for="day2">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Nov 19<sup>th</sup>
													</label>
												</div>
												<?php }?>
												<div class="md-checkbox">
													<input type="checkbox" id="day3" name="day3" class="md-check" value="Nov 20th">
													<label for="day3">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Nov 20<sup>th</sup>
													</label>
												</div>
											</div>
										</div>
									</div>
									<?php }?>
									<div class="form-group">
										<label class="control-label col-md-1"></label>
										<div class="col-md-9">
                                        <?php if($assoc_name=="SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)"){?>
											<table class="table table-striped table-hover1 table-bordered teriff-table">
												<thead>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
														<th colspan="1">Catagory</th>
														<th colspan="1">REGISTRATION SLABS*</th>
														<?php /*<th colspan="2">Actual Tariff</th>*/?>
														<th colspan="2">TARIFF**</th></th>
														<?php /*<th>Special Offer(Till 30th Sept,2019)</th>
														<th>Offer (1st Oct - 31st Oct,2019)</th>
														<th>Offer (1st Nov - 18th Nov,2019)</th>*/?>
													</tr>
												</thead>
                                                
                                                <tr class="indian-tariff first-row">
														<td colspan="1"><?php echo $assoc_name;?></td>
														<td colspan="1">-</td>
														<?php /*<td colspan="2" class="success1">INR 9000</td>*/?>
														<td  colspan="2" class="success1">INR 2000 <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata1" /></td>
														<?php /*<td class="success1">INR 6000 </td>
														<td class="success1">INR 9000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>*/?>
													</tr>
                                                <tr>
														<td colspan="6">
															<p><strong>Please note</strong><br/>																
																- ** 18% GST Applicable<br/>														
                                                               </p>
														</td>
													</tr>
                                                
											</table>
                                        
                                        <?php } else if($assoc_name == 'Program-Coordinators') {?>
											<table class="table table-striped table-hover1 table-bordered teriff-table">
												<thead>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
														<th colspan="1">Catagory</th>
														<th colspan="1">REGISTRATION SLABS*</th>
														<?php /*<th colspan="2">Actual Tariff</th>*/?>
														<th colspan="2">TARIFF**</th></th>
														<?php /*<th>Special Offer(Till 30th Sept,2019)</th>
														<th>Offer (1st Oct - 31st Oct,2019)</th>
														<th>Offer (1st Nov - 18th Nov,2019)</th>*/?>
													</tr>
												</thead>
                                                
                                                <tr class="indian-tariff first-row">
														<td colspan="1"><?php echo $assoc_name;?> : BiSEP, DAC and NAIN</td>
														<td colspan="1">-</td>
														<?php /*<td colspan="2" class="success1">INR 9000</td>*/?>
														<td  colspan="2" class="success1">INR 2000 <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata1" /></td>
														<?php /*<td class="success1">INR 6000 </td>
														<td class="success1">INR 9000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>*/?>
													</tr>
													 <tr>
														<td colspan="6">
															<p><strong>Please note</strong><br/>
																- ** 18% GST Applicable<br/>	
                                                            </p>
														</td>
													</tr>
											</table>
										<?php } else if($assoc_name == 'Faculty') {?>
											<table class="table table-striped table-hover1 table-bordered teriff-table">
												<thead>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
														<th colspan="1">Catagory</th>
														<th colspan="1">REGISTRATION SLABS*</th>
														<?php /*<th colspan="2">Actual Tariff</th>*/?>
														<th colspan="2">TARIFF**</th></th>
														<?php /*<th>Special Offer(Till 30th Sept,2019)</th>
														<th>Offer (1st Oct - 31st Oct,2019)</th>
														<th>Offer (1st Nov - 18th Nov,2019)</th>*/?>
													</tr>
												</thead>
                                                
                                                <tr class="indian-tariff first-row">
														<td colspan="1"><?php echo $assoc_name;?> : IBAB, CHG and IIIT-B</td>
														<td colspan="1">-</td>
														<?php /*<td colspan="2" class="success1">INR 9000</td>*/?>
														<td  colspan="2" class="success1">INR 1500 <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata1" /></td>
														<?php /*<td class="success1">INR 6000 </td>
														<td class="success1">INR 9000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>*/?>
													</tr>
													 <tr>
														<td colspan="6">
															<p><strong>Please note</strong><br/>
																- ** 18% GST Applicable<br/>	
                                                            </p>
														</td>
													</tr>
											</table>
										<?php } else if($assoc_name == 'Student-Coordinator') {?>
											<table class="table table-striped table-hover1 table-bordered teriff-table">
												<thead>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
														<th colspan="1">Catagory</th>
														<th colspan="1">REGISTRATION SLABS*</th>
														<?php /*<th colspan="2">Actual Tariff</th>*/?>
														<th colspan="2">TARIFF**</th></th>
														<?php /*<th>Special Offer(Till 30th Sept,2019)</th>
														<th>Offer (1st Oct - 31st Oct,2019)</th>
														<th>Offer (1st Nov - 18th Nov,2019)</th>*/?>
													</tr>
												</thead>
                                                
                                                <tr class="indian-tariff first-row">
														<td colspan="1">IBAB, CHG, IIIT-B, BiSEP, DAC and NAIN Students </td>
														<td colspan="1">-</td>
														<?php /*<td colspan="2" class="success1">INR 9000</td>*/?>
														<td  colspan="2" class="success1">INR 2000 <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata1" /></td>
														<?php /*<td class="success1">INR 6000 </td>
														<td class="success1">INR 9000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>*/?>
													</tr>
													 <tr>
														<td colspan="6">
															<p><strong>Please note</strong><br/>
																- ** 18% GST Applicable<br/>	
                                                            </p>
														</td>
													</tr>
											</table>
										<?php } else if($assoc_name == 'UK-StartUps') {?>
											<table class="table table-striped table-hover1 table-bordered teriff-table">
												<thead>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
														<th colspan="1">Catagory</th>
														<th colspan="1">REGISTRATION SLABS*</th>
														<th colspan="2">TARIFF**</th></th>
													</tr>
												</thead>
                                                
                                                <tr class="indian-tariff first-row">
														<td colspan="1">UK-StartUps</td>
														<td colspan="1">-</td>
														<td  colspan="2" class="success1">INR 2000 <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata1" /></td>
													</tr>
													 <tr>
														<td colspan="6">
															<p><strong>Please note</strong><br/>
																- ** 18% GST Applicable<br/>	
                                                            </p>
														</td>
													</tr>
											</table>
										<?php } else if($assoc_name == 'Session-StartUps') {?>
											<table class="table table-striped table-hover1 table-bordered teriff-table">
												<thead>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
														<th colspan="1">Catagory</th>
														<th colspan="1">REGISTRATION SLABS*</th>
														<th colspan="2">TARIFF**</th></th>
													</tr>
												</thead>
                                                
                                                <tr class="indian-tariff first-row">
														<td colspan="1">Session-StartUps</td>
														<td colspan="1">-</td>
														<td  colspan="2" class="success1">INR 2000 <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata1" /></td>
													</tr>
													 <tr>
														<td colspan="6">
															<p><strong>Please note</strong><br/>
																- ** 18% GST Applicable<br/>	
                                                            </p>
														</td>
													</tr>
											</table>
										<?php }else{?>
											<table class="table table-hover1 table-bordered teriff-table col-md-offset-1 col-md-7 main-tariff-table">
												<thead>
													<?php /*<tr bgcolor="#2fa0dd" style="color: #fff;">
														<th colspan="1">DATE</th>
														<th colspan="1">REGISTRATION SLABS*</th>
														<?php /*<th colspan="2">Actual Tariff</th>*/?>
														<?php /*<th colspan="2">EARLY BIRD DISCOUNT TARIFF**</th></th>
														<th>Special Offer(Till 30th Sept,2019)</th>
														<th>Offer (1st Oct - 31st Oct,2019)</th>
														<th>Offer (1st Nov - 18th Nov,2019)</th>
														<th colspan="6">Delegate Tariff</th>
													</tr>*/?>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
                                            			<th colspan="6">Delegate Tariff for Virtual Event</th>
													</tr>
													<tr  bgcolor="#2fa0dd" style="color: #fff;">
														<?php /*?><th colspan="2" class="align-td">PACKAGE</th>*/?>
														<th colspan="3" class="align-td">DELEGATE CATEGORY</th>
														<th colspan="1" class="align-td">Till 5th October, 2020</th>
														<th colspan="1" class="align-td">6th Oct to 7th Nov, 2020</th>
														<th colspan="1" class="align-td">8th Nov to 16th Nov, 2020</th>
													</tr>
												</thead>
												<tbody>
													<?php /*?> <tr class="indian-tariff industry" style="background-color: #e1e1e1;">
														<td colspan="2" class="align-td">All Access</td>
														<td colspan="2" class="align-td">Indian</td>
														<td colspan="1" class="align-td">Rs. 2500 </td>
														<td colspan="1" class="align-td">Rs. 3500 </td>
													</tr> <?php */?>
													<tr class="indian-tariff" style="background-color: #e1e1e1;" >
                                            			<?php /*?><td colspan="2" class="align-td">All Access</td>*/?>
                                            			<td colspan="3" class="align-td">Partnering Delegate</td>
                                            			<td colspan="1" class="align-td">INR 4000</td>
                                            			<td colspan="1" class="align-td">INR 5000</td>
                                            			<td colspan="1" class="align-td">INR 6000</td>
                                            		</tr>
                                            		<tr class="indian-tariff-1" style="background-color: #e1e1e1;" >
                                            			<?php /*?><td colspan="2" class="align-td">All Access</td>*/?>
                                            			<td colspan="3" class="align-td">Conference Delegate</td>
                                            			<td colspan="1" class="align-td">INR 1000</td>
                                            			<td colspan="1" class="align-td">INR 2000</td>
                                            			<td colspan="1" class="align-td">INR 3000</td>
                                            		</tr>
													<?php /*?><tr class="indian-tariff second-row academia">
														<td colspan="2">R&D and Academia</td>
														<td colspan="2">Rs. 2500 </td>
														<td colspan="2">Rs. 3500 </td>
													</tr>
													<tr class="indian-tariff student" style="background-color: #e1e1e1;">
														<td colspan="2" class="align-td">Limited  Access</td>
														<td colspan="2" class="align-td">Students</td>
														<td colspan="1" class="align-td">Rs. 2000 </td>
														<td colspan="1" class="align-td">Rs. 2500 </td>
													</tr><?php */?>
													<?php /*if($totalRegistrations >= 0 && $totalRegistrations <= 100) {?>
													<tr class="indian-tariff">
														<td>1 - 100</td>
														<td class="success">10000</td>
														<td>90%</td>
														<td class="danger">1000 <input name="cata" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td>1 - 100</td>
														<td class="success">200</td>
														<td>90%</td>
														<td class="danger">20 <input name="cata" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<?php } else if($totalRegistrations >= 101 && $totalRegistrations <= 200) {?>
													<tr class="indian-tariff">
														<td>101 - 200</td>
														<td class="success">10000</td>
														<td>80%</td>
														<td class="danger">2000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td>101 - 200</td>
														<td class="success">200</td>
														<td>80%</td>
														<td class="danger">40 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<?php } else if($totalRegistrations >= 201 && $totalRegistrations <= 300) {?>
													<tr class="indian-tariff">
														<td>201 - 300</td>
														<td class="success">10000</td>
														<td>70%</td>
														<td class="danger">3000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td>201 - 300</td>
														<td class="success">200</td>
														<td>70%</td>
														<td class="danger">60 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<?php } else if($totalRegistrations >= 301 && $totalRegistrations <= 400) {?>
													<tr class="indian-tariff">
														<td>301 - 400</td>
														<td class="success">10000</td>
														<td>60%</td>
														<td class="danger">4000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td>301 - 400</td>
														<td class="success">200</td>
														<td>60%</td>
														<td class="danger">80 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<?php } else if($totalRegistrations >= 401 && $totalRegistrations <= 500) {?>
													<tr class="indian-tariff">
														<td>401 - 500</td>
														<td class="success">10000</td>
														<td>50%</td>
														<td class="danger">5000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td>401 - 500</td>
														<td class="success">200</td>
														<td>50%</td>
														<td class="danger">100 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<?php } else if($totalRegistrations >= 501 && $totalRegistrations <= 600) {?>
													<tr class="indian-tariff">
														<td>501 - 600</td>
														<td class="success">10000</td>
														<td>40%</td>
														<td class="danger">6000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td>501 - 600</td>
														<td class="success">200</td>
														<td>40%</td>
														<td class="danger">120 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<?php } else if($totalRegistrations >= 601 && $totalRegistrations <= 700) {?>
													<tr class="indian-tariff">
														<td>601 - 700</td>
														<td class="success">10000</td>
														<td>30%</td>
														<td class="danger">7000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td>601 - 700</td>
														<td class="success">200</td>
														<td>30%</td>
														<td class="danger">140 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<?php } else if($totalRegistrations >= 701 && $totalRegistrations <= 800) {?>
													<tr class="indian-tariff">
														<td>701 - 800</td>
														<td class="success">10000</td>
														<td>20%</td>
														<td class="danger">8000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td>701 - 800</td>
														<td class="success">200</td>
														<td>30%</td>
														<td class="danger">160 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<?php } else if($totalRegistrations >= 801 && $totalRegistrations <= 900) {?>
													<tr class="indian-tariff">
														<td>801 - 900</td>
														<td class="success">10000</td>
														<td>10%</td>
														<td class="danger">9000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td>801 - 900</td>
														<td class="success">200</td>
														<td>10%</td>
														<td class="danger">180 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<?php } else if($totalRegistrations >= 801 && $totalRegistrations <= 900) {?>
													<tr class="indian-tariff">
														<td>901 - 1000</td>
														<td class="success">10000</td>
														<td>5%</td>
														<td class="danger">9500 <input name="cata" type="radio" class="hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td>901 - 1000</td>
														<td class="success">200</td>
														<td>5%</td>
														<td class="danger">190 <input name="cata" type="radio" class="hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<?php } else {?>
													<tr class="indian-tariff">
														<td>Above 501</td>
														<td class="success">10000</td>
														<td>-</td>
														<td class="danger">10000 <input name="cata" type="radio" class="hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td class="success">200</td>
														<td>-</td>
														<td class="danger">200 <input name="cata" type="radio" class="hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<?php }*/?>
													<?php /*if($assoc_name == 'YESSS Abstract Presenter') {?>
													<tr class="indian-tariff">
														<td>All 3 days</td>
														<td class="success">1500</td>
														<td>0%</td>
														<td class="danger">1500 <input name="cata" type="radio" class="hide" checked="checked" value="YESSS Abstract Presenter - 3 days" id="cata3" /></td>
													</tr>
													<?php } else if($assoc_name == 'KBITS') {?>
													<tr class="indian-tariff">
														<td>Registration Charges</td>
														<td class="success">Rs. 1000</td>
														<td>20%</td>
														<td class="danger">Rs. 800 <input name="cata" type="radio" class="hide" value="KBITS Single Day" id="cata3" /></td>
													</tr>
													<?php } else {?>
													<tr class="indian-tariff">
														<td>3 days</td>
														<td class="success">10000</td>
														<td>80%</td>
														<td class="danger">2000 <input name="cata" type="radio" class="hide" value="Indian Delegate" id="cata1" /></td>
													</tr>
													<tr class="international-tariff">
														<td>3 days</td>
														<td class="success">200</td>
														<td>80%</td>
														<td class="danger">40 <input name="cata" type="radio" class="hide" value="International Delegate" id="cata2" /></td>
													</tr>
													<tr class="indian-tariff">
														<td>3 Days with speaker offer</td>
														<td class="success">10000</td>
														<td>70%</td>
														<td class="danger">3000 <input name="cata" type="radio" class="hide" value="3 days with speaker offer" id="cata5" /></td>
													</tr>
													<tr class="international-tariff">
														<td>3 Days with speaker offer</td>
														<td class="success">200</td>
														<td>70%</td>
														<td class="danger">60 <input name="cata" type="radio" class="hide" value="3 days with speaker offer" id="cata6" /></td>
													</tr>
													<tr class="indian-tariff123 hide">
														<td>3 days with power bank offer </td>
														<td class="success">10000</td>
														<td>60%</td>
														<td class="danger">4000 <input name="cata" type="radio" class="hide" value="" id="cata7" /></td>
													</tr>
													<tr class="international-tariff123 hide">
														<td>3 days with power bank offer </td>
														<td class="success">200</td>
														<td>60%</td>
														<td class="danger">80 <input name="cata" type="radio" class="hide" value="" id="cata8" /></td>
													</tr>
													<?php if($assoc_name == 'ABAI') {?>
													<tr class="indian-tariff">
														<td>Single Day-Industry</td>
														<td class="success">500</td>
														<td>0%</td>
														<td class="danger">500 <input name="cata" type="radio" class="hide" value="ABAI Single Day-Industry" id="cata3" /></td>
													</tr>
													<tr class="indian-tariff">
														<td>Single Day-Student</td>
														<td class="success">250</td>
														<td>0%</td>
														<td class="danger">250 <input name="cata" type="radio" class="hide" value="ABAI Single Day-Student" id="cata4" /></td>
													</tr>
													<?php } else {?>
													<tr class="indian-tariff">
														<td>Single Day-Industry</td>
														<td class="success">1500</td>
														<td>0%</td>
														<td class="danger">1500 <input name="cata" type="radio" class="hide" value="Single Day-Industry" id="cata3" /></td>
													</tr>
													<tr class="indian-tariff">
														<td>Single Day-Student</td>
														<td class="success">500</td>
														<td>0%</td>
														<td class="danger">500 <input name="cata" type="radio" class="hide" value="Single Day-Student" id="cata4" /></td>
													</tr>
													<?php }}*/?>
													
													<?php /*if(date('Y-m-d') <= '2019-09-30') {?>
													<tr class="indian-tariff first-row">
														<td colspan="1">Till 30<sup>th</sup> Sep, 2019</td>
														<td colspan="1">Upto 200 </td>
														<?php /*<td colspan="2" class="success1">INR 9000</td>*/?>
														<?php /*<td  colspan="2" class="success1">INR 2000 <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata1" /></td>
														<?php /*<td class="success1">INR 6000 </td>
														<td class="success1">INR 9000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>
													</tr>
													<?php } if(date('Y-m-d') <= '2019-10-13') {?>
													<tr class="indian-tariff first-row">
														<td colspan="1">1<sup>st</sup> Oct, 2019 onwards</td>
														<td colspan="1">Upto 600 </td>
														<?php /*<td colspan="2" class="success1">INR 9000</td>?>
														<td colspan="2" class="success1">INR 3500 <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata1" /></td>
														<?php /*<td class="success1">INR 6000 </td>
														<td class="success1">INR 9000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>
													</tr>
													<?php } if(date('Y-m-d') <= '2019-11-13') {?>
													<tr class="indian-tariff first-row">
														<td colspan="1">Till 13<sup></sup> Nov, 2019</td>
														<td colspan="1">Upto 600</td><?php */?>
														<?php /*<td colspan="2" class="success1">INR 9000</td>?>
														<td colspan="2" class="success1">INR 2000 
														  <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata1" /></td>
														<?php /*<td class="success1">INR 6000 </td>
														<td class="success1">INR 9000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>
													</tr>
													<?php }?><tr class="indian-tariff first-row">
														<td colspan="1">14<sup>th</sup> to 16<sup>th</sup> Nov, 2019 onwards</td>
														<td colspan="1">1001 & Above Delegates </td>
														<?php /*<td colspan="2" class="success1">INR 9000</td>
														<td colspan="2" class="success1">INR 3000 <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata1" /></td>
														 <td class="success1">INR 6000 </td>
														<td class="success1">INR 9000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>
													</tr>
                                                    <tr class="indian-tariff first-row">
														<td colspan="1">18<sup>th</sup> Nov, 2019 & onwards, On-Spot Registrations at Event Venue </td>
														<td colspan="1">-</td>
														<?php /*<td colspan="2" class="success1">INR 9000</td>
														<td colspan="2" class="success1">INR 5000 <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata1" /></td>
														<?php /* <td class="success1">INR 6000 </td>
														<td class="success1">INR 9000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>
													</tr>
													<tr class="indian-tariff second-row <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') {?>hide<?php }?>">
														<td colspan="1">-</td>
														<td colspan="1">Students</td>
														<?php /*<td colspan="2" class="success1">INR 2500</td>
														<td colspan="2" class="success1">INR 2000 <input name="cata" type="radio" class="hide" value="Student Delegate" id="ind-tariff2" /></td>
														<?php /*<td class="success1">INR 3000 </td>
														<td class="success1">INR 3000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>
													</tr>
													<tr class="indian-tariff third-row <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') {?>hide<?php }?>">
														<td colspan="1">-</td>
														<td colspan="1">Poster Presenters </td>
														<?php /*<td colspan="2" class="success1">INR 3000</td>
														<td colspan="2" class="success1">INR 3000 <input name="cata" type="radio" class="hide" value="Poster Presenters" id="ind-tariff3" /></td>
														<?php /*<td class="success1">INR 3000 </td>
														<td class="success1">INR 3000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>
													</tr>
													<tr class="indian-tariff third-row <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') {?>hide<?php }?>">
														<td colspan="1">-</td>
														<td colspan="1">1st Co-Author  </td>
														<?php /*<td colspan="2" class="success1">INR 3000</td>
														<td colspan="2" class="success1">Free </td>
														<?php /*<td class="success1">INR 3000 </td>
														<td class="success1">INR 3000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>
													</tr>
													<tr class="indian-tariff third-row <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') {?>hide<?php }?>">
														<td colspan="1">-</td>
														<td colspan="1">2nd Co-Author </td>
														<?php /*<td colspan="2" class="success1">INR 3000</td>
														<td colspan="2" class="success1">INR 1500 </td>
														<?php /*<td class="success1">INR 3000 </td>
														<td class="success1">INR 3000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>
													</tr>
													<tr class="indian-tariff third-row <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') {?>hide<?php }?>">
														<td colspan="1">-</td>
														<td colspan="1">3rd Co-Author </td>
														<?php /*<td colspan="2" class="success1">INR 3000</td>
														<td colspan="2" class="success1">INR 1500</td>
														<?php /*<td class="success1">INR 3000 </td>
														<td class="success1">INR 3000 </td>
														<td>80%</td>
														<td class="success1">INR 2000 </td>*/?>
													</tr><?php ?>
													<?php /*?><tr class="indian-tariff second-row">
														<td>3 days for 201 - 400 delegates </td>
														<td class="success1">INR 9000</td>
														<td>60%</td>
														<td class="success1">INR 3500 </td>
													</tr>
													<tr class="indian-tariff third-row">
														<td>3 days for 401- 600 delegates </td>
														<td class="success1">INR 9000</td>
														<td>43.50%</td>
														<td class="success1">INR 5000 </td>
													</tr>
													<tr class="indian-tariff fourth-row">
														<td>3 days for 601 - 800 delegates </td>
														<td class="success1">INR 9000</td>
														<td>27%</td>
														<td class="success1">INR 6500 </td>
													</tr>
													<tr class="indian-tariff fifth-row">
														<td>3 days for 801 & Above delegates </td>
														<td class="success1">INR 9000</td>
														<td>11%</td>
														<td class="success1">INR 8000 </td>
													</tr><?php */?>
													<?php /*<tr class="indian-tariff">
														<td>Single Day</td>
														<td class="success1">INR 1750 <input name="cata" type="radio" class="hide" value="Single Day" id="cata2" /></td>
														<td class="success1">INR 1750 </td>
														<td>0%</td>
														<td class="success1">INR 1000 </td>
													</tr>*/?>
													<?php /*<tr class="international-tariff" style="display: none;">
														<td>3 days</td>
														<td class="success">USD 200</td>
														<td>90%</td>
														<td class="danger">USD 20 <input name="cata" type="radio" class="hide" value="Full Delegate" id="cata3" /></td>
													</tr> 
													<tr class="international-tariff" style="background-color: #e1e1e1;">
														<td colspan="2" class="success1 align-td">All Access</td>
														<td colspan="2" class="align-td">International</td>
														<td colspan="1" class="success1 align-td">USD 250</td>
														<td colspan="1" class="success1 align-td">USD 300</td>*/?>
													<tr class="international-tariff" style="background-color: #e1e1e1;display: none;">
                                            			<?php /*<td colspan="2" class="align-td">All Access</td>*/?>
                                            			<td colspan="2" class="align-td">International</td>
                                            			<td colspan="2" class="align-td">USD 100</td>
                                            			<td colspan="1" class="align-td">USD 175</td>
                                            			<td colspan="1" class="align-td">USD 175</td>
                                            		</tr>
														<?php /*<td class="success1">USD 250</td>
														<td class="success1">USD 300</td>
														<td>USD 50</td>
														<td class="success1">USD 250</td>*/?>
													</tr>
													<?php /*<tr>
														<td colspan="6">
															<strong>Please note</strong><br/>
																- 18% GST Applicable<br/>
																<strong>Terms & Conditions</strong><br/>
																- Group discount of 10% for 3 or more DELEGATES from same organisation<br/>
																- Spot registration will be charged @ Rs. 7,000 plus 18% GST
														</td>
													</tr>*/?>
												</tbody>
											</table>
											<table class="table table-hover1 table-bordered teriff-table col-md-offset-1 col-md-7">
												<tbody>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
														<td colspan="10">Entitlements :</td>
													</tr>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
														<td width="20%" style="font-size: 14px;font-weight: 600px;">Category</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">One 2 One Business Meetings**</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Inaugural/ Keynote/ Plenary/Cultural Programme</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Conference/ On Demand Sessions</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">International Exhibition</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Industry Awards IT/Biotech/ Start-ups</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Quiz Competition IT/Biotech</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Biotech Posters Walkway Of Discovery</td>
													</tr>
													<tr class="partner-del">
														<td bgcolor="#2fa0dd" width="20%" style="color: #fff;">
															Partnering Delegate
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
													</tr>
													<tr class="conference-del">
														<td bgcolor="#2fa0dd" width="20%" style="color: #fff;">
															Conference Delegate
														</td>
														<td width="10%" bgcolor="#e5ebf1" class="align-td">
															<i class="fa fa-times" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#e5ebf1" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#e5ebf1" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#e5ebf1" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#e5ebf1" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#e5ebf1" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#e5ebf1" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
													</tr>
													<?php /* <tr class="attendee" >
														<td bgcolor="#2fa0dd" width="20%" style="color: #fff;">
															<strong>Attendees/Visitors</strong>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<strong><i class="fa fa-times" aria-hidden="true"></i></strong>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<strong><i class="fa fa-check" aria-hidden="true"></i></strong>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<strong><i class="fa fa-times" aria-hidden="true"></i></strong>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<strong><i class="fa fa-check" aria-hidden="true"></i></strong>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<strong><i class="fa fa-times" aria-hidden="true"></i></strong>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<strong><i class="fa fa-times" aria-hidden="true"></i></strong>
														</td>
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<strong><i class="fa fa-times" aria-hidden="true"></i></strong>
														</td>
													</tr>*/?>
													<tr>
														<td colspan="10">
															<strong>Note : </strong><br/>
																-  *18% GST is applicable for the above delegate cost.<br/>
																-  **One 2 One business meetings will be organised by using the advanced partnering tool Virtual Partnering will allow you to arrange partnering meetings virtually. You can self-schedule meetings in advance and meet your potential business partners, collaborators, customers during the 3 full days of partnering from November 19-21, 2020.  <br/>
														</td>
													</tr>
												</tbody>
											</table>
                                            <?php } ?>
						        </div><br/><br/>
									<?php /*?>	<div class="col-md-2">
											<span class="flash"><strong>SEATS FILLING FAST</strong></span>
											<span class="button"><strong>SEATS FILLING FAST</strong></span>
										</div><?php */?>
									</div>
									<div class="form-group form-md-radios" id="tech-div" style="display:none1;">
										<label class="control-label col-md-3">How do you know about Event <span class="required"> * </span> </label>
										<div class="col-md-6">
											<select id="event_know" name="event_know" class="form-control" onchange="showPromo();" required="required">
												<option value="">-- Select --</option>
												<option value="News Paper Ads">News Paper Ads</option>
												<option value="Social Media">Social Media</option>
												<option value="Past Participant">Past Participant</option>
												<option value="Mailer">Mailer</option>
												<option value="Hoarding">Hoarding</option>
												<option value="Others">Others</option>
											</select>
											<?php /*?><div class="md-radio-inline">
												<div class="md-radio">
													<input type="radio" id="member_Yes" name="member_of_assoc" class="md-radiobtn" value="Yes" onclick="showPromoCode();">
													<label for="member_Yes">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Yes 
													</label>
												</div>
												<div class="md-radio">
													<input type="radio" id="member_No" name="member_of_assoc" class="md-radiobtn" value="No" onclick="showPromoCode();" >
													<label for="member_No">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> No 
													</label>
												</div>
											</div><?php */?>
										</div>
										<div class="col-md-3" id="other-div" style="display:none;">
											<input type="text" class="form-control" id="other_value" name="other_value" placeholder="Other Value">
											<span class="help-block">Eg. Friends, Colleague</span>
										</div>
									</div>
									<div class="form-group form-md-radios" id="pay">
										<label class="control-label col-md-3">Payment Mode <span class="required"> * </span> </label>
										<div class="col-md-9">
											<div class="md-radio-inline">
												<div class="md-radio">
													<input type="radio" id="Cc" name="paymode" class="md-radiobtn" value="Credit Card" onclick="showTxt();" >
													<label for="Cc">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> CCAvenue Payment - Credit Card / Debit Card / Net Banking
													</label>
												</div>
												&nbsp;&nbsp;
												<div class="md-radio" style="display: none;">
													<input type="radio" id="Dc" name="paymode" class="md-radiobtn" value="Debit Card" onclick="showTxt();" >
													<label for="Dc">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Debit Card 
													</label>
												</div>
												<div class="md-radio hide">
													<input type="radio" id="Cheque" name="paymode" class="md-radiobtn" value="Cheque" onclick="showTxt();" >
													<label for="Cheque">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Cheque / DD
													</label>
												</div>
												<div class="md-radio">
													<input type="radio" id="BT" name="paymode" class="md-radiobtn" value="Bank Transfer" onclick="showTxt();" >
													<label for="BT">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Bank Transfer<strong>(Offline)</strong> / NEFT / RTGS / IMPS
													</label>
												</div>
												<div class="md-radio">
													<input type="radio" id="gpay" name="paymode" class="md-radiobtn" value="Google pay" onclick="showTxt();" >
													<label for="gpay">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Google pay/ Phonepe/ Paytm
													</label>
												</div>
												<div class="md-radio international-tariff">
													<input type="radio" id="paypal" name="paymode" class="md-radiobtn" value="Paypal" onclick="showTxt();" >
													<label for="paypal">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Paypal - Credit Card / Debit Card
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group" id="bite">
										<label class="control-label col-md-1"></label>
										<div class="col-md-11">
											<table class="table table-striped table-bordered well" id="credit_card" style="display: none;">
												<tbody>
													<tr>
														<td style="border: medium none;"></td>
														<td style="border: medium none;">
															<ul>
																<li>
																	If the holder of the card is not the delegate, then the delegate should possess: 
																	<ul type="i">
																		<li>A Photocopy of both sides of the card, which will have to be self attested by the card holder authorising the use of the card for the delegate registration fee. For security reasons, please strike out the Card Verification Value (CVV) code on the copy of your card.</li>
																		<li>This Photocopy should also contain the name of the delegate.</li>
																	</ul>
																</li>
																<li>The above document MUST be produced at the Registration Desk at <?php echo $EVENT_NAME;?>. If the delegate fails to comply with these conditions, <?php echo $EVENT_NAME;?> Secretariat  reserves the right to deny the delegate from attending the event.</li>
															</ul>
														</td>
													</tr>
												</tbody>
											</table>
											<table class="table table-striped table-bordered well" id="debit_card" style="display: none;"></table>
											<table class="table table-striped table-bordered table-hover " id="bank_transfer1" style="display: none;">
												<tbody>
													<tr>
														<td colspan="2">Delegates are requested to Bank Transfer the registration fees to the following account</td>
													</tr>
													<tr>
														<td>Account Name :</td>
														<td style="width: 828px;">MM ACTIV SCI TECH COMMUNICATIONS PVT. LTD.</td>
													</tr>
													<tr>
														<td>Account Type :</td>
														<td>Current Account</td>
													</tr>
													<tr>
														<td>Account Number :</td>
														<td>2827201001176</td>
													</tr>
													<tr>
														<td>Bank Name :</td>
														<td>Canara Bank K.S.F.C Complex Branch</td>
													</tr>
													<tr>
														<td>DP Code No. :</td>
														<td>2827</td>
													</tr>
													<tr>
														<td>Bank Address :</td>
														<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
													</tr>
													<tr>
														<td>Bank IFSC Code :</td>
														<td>CNRB0002827</td>
													</tr>
													<tr>
														<td>Bank MICR Code :</td>
														<td>560015137</td>
													</tr>

													<?php /*<tr>
														<td>Account Name :</td>
														<td style="width: 828px;">BANGALORE IT.BIZ </td>
													</tr>
													<tr>
														<td>Account Type :</td>
														<td>Current Account</td>
													</tr>
													<tr>
														<td>Account Number :</td>
														<td>2827201001190</td>
													</tr>
													<tr>
														<td>Bank Name :</td>
														<td>Canara Bank K.S.F.C Complex Branch</td>
													</tr>
													<tr>
														<td>DP Code No. :</td>
														<td>2827</td>
													</tr>
													<tr>
														<td>Bank Address :</td>
														<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
													</tr>
													<tr>
														<td>Bank IFSC Code :</td>
														<td>CNRB0002827</td>
													</tr>
													<tr>
														<td>Bank MICR Code :</td>
														<td>560015137</td>
													</tr>*/?>
													<tr>
														<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>
													</tr>
												</tbody>
											</table>
											<table class="table table-striped table-bordered table-hover " id="bank_transfer2" style="display: none;">
												<tbody>
													<tr>
														<td colspan="2">Delegates are requested to Bank Transfer the registration fees to the following account</td>
													</tr>
													<tr>
														<td>Account Name :</td>
														<td style="width: 824px;">MM ACTIV SCI-TECH COMMUNICATIONS PVT.LTD.</td>
													</tr>
													<tr>
														<td>Account Type :</td>
														<td>Current Account</td>
													</tr>
													<tr>
														<td>Account Number :</td>
														<td>2827241000004</td>
													</tr>
													<tr>
														<td>Bank Name :</td>
														<td>Canara Bank K.S.F.C Complex Branch</td>
													</tr>
													<tr>
														<td>DP Code No. :</td>
														<td>2827</td>
													</tr>
													<tr>
														<td>Bank Address :</td>
														<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
													</tr>
													<tr>
														<td>Bank SWIFT Code :</td>
														<td>CNRBINBBLFD</td>
													</tr>
													<tr>
														<td>Bank MICR Code :</td>
														<td>560015137</td>
													</tr>
													<tr>
														<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>
													</tr>
												</tbody>
											</table>
											<table class="table table-striped table-bordered well" id="cheque" style="display: none;">
												<tbody>
													<tr>
														<td style="border: medium none;"></td>
														<td style="border: medium none; width: 99%;">
															<p>
																Please send your Cheque/DD in favour of <?php echo $EVENT_CHEQUE_PAYBLE_AT_NAME;?> payable at <?php echo $EVENT_CHEQUE_PAYBLE_AT;?>.<br />
																Along with the copy of your registration receipt and send to<br />
																<strong>Address :</strong><br/><?php echo $EVENT_CHEQUE_PAYBLE_ADDRESS;?>
															<p>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="form-group" id="bib" style="display: none;">
										<label class="control-label col-md-1"></label>
										<div class="col-md-11">
											<table class="table table-striped table-bordered well" id="bcredit_card" style="display: none;">
												<tbody>
													<tr>
														<td style="border: medium none;"></td>
														<td style="border: medium none;">
															<ul>
																<li>
																	If the holder of the card is not the delegate, then the delegate should possess: 
																	<ul type="i">
																		<li>A Photocopy of both sides of the card, which will have to be self attested by the card holder authorising the use of the card for the delegate registration fee. For security reasons, please strike out the Card Verification Value (CVV) code on the copy of your card.</li>
																		<li>This Photocopy should also contain the name of the delegate.</li>
																	</ul>
																</li>
																<li>The above document MUST be produced at the Registration Desk at Bengaluru INDIA BIO. If the delegate fails to comply with these conditions, Bengaluru INDIA BIO Secretariat  reserves the right to deny the delegate from attending the event.</li>
															</ul>
														</td>
													</tr>
												</tbody>
											</table>
											<table class="table table-striped table-bordered well" id="bdebit_card" style="display: none;"></table>
											<table class="table table-striped table-bordered table-hover " id="bbank_transfer1" style="display: none;">
												<tbody>
													<tr>
															<td colspan="2">Delegates are requested to Bank Transfer the registration fees to the following account</td>
														</tr>
													<tr>
														<td>Account Name :</td>
														<td style="width: 828px;">MM ACTIV SCI TECH COMMUNICATIONS PVT. LTD.</td>
													</tr>
													<tr>
														<td>Account Type :</td>
														<td>Current Account</td>
													</tr>
													<tr>
														<td>Account Number :</td>
														<td>2827201001176</td>
													</tr>
													<tr>
														<td>Bank Name :</td>
														<td>Canara Bank K.S.F.C Complex Branch</td>
													</tr>
													<tr>
														<td>DP Code No. :</td>
														<td>2827</td>
													</tr>
													<tr>
														<td>Bank Address :</td>
														<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
													</tr>
													<tr>
														<td>Bank IFSC Code :</td>
														<td>CNRB0002827</td>
													</tr>
													<tr>
														<td>Bank MICR Code :</td>
														<td>560015137</td>
													</tr>

													<?php /*<tr>
														<td>Account Name :</td>
														<td style="width: 828px;">BANGALORE IT.BIZ </td>
													</tr>
													<tr>
														<td>Account Type :</td>
														<td>Current Account</td>
													</tr>
													<tr>
														<td>Account Number :</td>
														<td>2827201001190</td>
													</tr>
													<tr>
														<td>Bank Name :</td>
														<td>Canara Bank K.S.F.C Complex Branch</td>
													</tr>
													<tr>
														<td>DP Code No. :</td>
														<td>2827</td>
													</tr>
													<tr>
														<td>Bank Address :</td>
														<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
													</tr>
													<tr>
														<td>Bank IFSC Code :</td>
														<td>CNRB0002827</td>
													</tr>
													<tr>
														<td>Bank MICR Code :</td>
														<td>560015137</td>
													</tr>*/?>
													<tr>
														<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>
													</tr>
												</tbody>
											</table>
											<table class="table table-striped table-bordered table-hover " id="bank_transfer2" style="display: none;">
												<tbody>
													<tr>
														<td colspan="2">Delegates are requested to Bank Transfer the registration fees to the following account</td>
													</tr>
													<tr>
														<td>Account Name :</td>
														<td style="width: 824px;">MM ACTIV SCI-TECH COMMUNICATIONS PVT.LTD.</td>
													</tr>
													<tr>
														<td>Account Type :</td>
														<td>Current Account</td>
													</tr>
													<tr>
														<td>Account Number :</td>
														<td>2827241000004</td>
													</tr>
													<tr>
														<td>Bank Name :</td>
														<td>Canara Bank K.S.F.C Complex Branch</td>
													</tr>
													<tr>
														<td>DP Code No. :</td>
														<td>2827</td>
													</tr>
													<tr>
														<td>Bank Address :</td>
														<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
													</tr>
													<tr>
														<td>Bank SWIFT Code :</td>
														<td>CNRBINBBLFD</td>
													</tr>
													<tr>
														<td>Bank MICR Code :</td>
														<td>560015137</td>
													</tr>
													<tr>
														<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>
													</tr>
												</tbody>
											</table>
											<table class="table table-striped table-bordered well" id="cheque" style="display: none;">
												<tbody>
													<tr>
														<td style="border: medium none;"></td>
														<td style="border: medium none; width: 99%;">
															<p>
																Please send your Cheque/DD in favour of <?php echo $EVENT_CHEQUE_PAYBLE_AT_NAME;?> payable at <?php echo $EVENT_CHEQUE_PAYBLE_AT;?>.<br />
																Along with the copy of your registration receipt and send to<br />
																<strong>Address :</strong><br/><?php echo $EVENT_CHEQUE_PAYBLE_ADDRESS;?>
															<p>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="form-group" id="bib" style="display: none;">
										<label class="control-label col-md-1"></label>
										<div class="col-md-11">
											<table class="table table-striped table-bordered well" id="bcredit_card" style="display: none;">
												<tbody>
													<tr>
														<td style="border: medium none;"></td>
														<td style="border: medium none;">
															<ul>
																<li>
																	If the holder of the card is not the delegate, then the delegate should possess: 
																	<ul type="i">
																		<li>A Photocopy of both sides of the card, which will have to be self attested by the card holder authorising the use of the card for the delegate registration fee. For security reasons, please strike out the Card Verification Value (CVV) code on the copy of your card.</li>
																		<li>This Photocopy should also contain the name of the delegate.</li>
																	</ul>
																</li>
																<li>The above document MUST be produced at the Registration Desk at Bengaluru INDIA BIO. If the delegate fails to comply with these conditions, Bengaluru INDIA BIO Secretariat  reserves the right to deny the delegate from attending the event.</li>
															</ul>
														</td>
													</tr>
												</tbody>
											</table>
											<table class="table table-striped table-bordered well" id="bdebit_card" style="display: none;"></table>
											<table class="table table-striped table-bordered table-hover " id="bbank_transfer1" style="display: none;">
												<tbody>
													<tr>
															<td colspan="2">Delegates are requested to Bank Transfer the registration fees to the following account</td>
														</tr>
														<tr>
														<td>Account Name :</td>
														<td style="width: 828px;">MM ACTIV SCI TECH COMMUNICATIONS PVT. LTD.</td>
													</tr>
													<tr>
														<td>Account Type :</td>
														<td>Current Account</td>
													</tr>
													<tr>
														<td>Account Number :</td>
														<td>2827201001176</td>
													</tr>
													<tr>
														<td>Bank Name :</td>
														<td>Canara Bank K.S.F.C Complex Branch</td>
													</tr>
													<tr>
														<td>DP Code No. :</td>
														<td>2827</td>
													</tr>
													<tr>
														<td>Bank Address :</td>
														<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
													</tr>
													<tr>
														<td>Bank IFSC Code :</td>
														<td>CNRB0002827</td>
													</tr>
													<tr>
														<td>Bank MICR Code :</td>
														<td>560015137</td>
													</tr>
														<?php /*<tr>
															<td>Account Name :</td>
															<td style="width: 828px;">Bengaluru INDIA BIO </td>
														</tr>
														<tr>
															<td>Account Type :</td>
															<td>Current Account</td>
														</tr>
														<tr>
															<td>Account Number :</td>
															<td>2827 201 001175</td>
														</tr>
														<tr>
															<td>Bank Name :</td>
															<td>Canara Bank K.S.F.C Complex Branch</td>
														</tr>
														<tr>
															<td>DP Code No. :</td>
															<td>2827</td>
														</tr>
														<tr>
															<td>Bank Address :</td>
															<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
														</tr>
														<tr>
															<td>Bank IFSC Code :</td>
															<td>CNRB0002827</td>
														</tr>
														<tr>
															<td>Bank SWIFT Code :</td>
															<td>CNRBINBBLFD</td>
														</tr>
														<tr>
															<td>Bank MICR Code :</td>
															<td>560015137</td>
														</tr>*/?>
													<tr>
														<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>
													</tr>
												</tbody>
											</table>
											<table class="table table-striped table-bordered table-hover " id="bbank_transfer2" style="display: none;">
												<tbody>
													<tr>
														<td colspan="2">Delegates are requested to Bank Transfer the registration fees to the following account</td>
													</tr>
													<tr>
														<td>Account Name :</td>
														<td style="width: 824px;">MM ACTIV SCI-TECH COMMUNICATIONS PVT.LTD.</td>
													</tr>
													<tr>
														<td>Account Type :</td>
														<td>Current Account</td>
													</tr>
													<tr>
														<td>Account Number :</td>
														<td>2827241000004</td>
													</tr>
													<tr>
														<td>Bank Name :</td>
														<td>Canara Bank K.S.F.C Complex Branch</td>
													</tr>
													<tr>
														<td>DP Code No. :</td>
														<td>2827</td>
													</tr>
													<tr>
														<td>Bank Address :</td>
														<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
													</tr>
													<tr>
														<td>Bank SWIFT Code :</td>
														<td>CNRBINBBLFD</td>
													</tr>
													<tr>
														<td>Bank MICR Code :</td>
														<td>560015137</td>
													</tr>
													<tr>
														<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>
													</tr>
												</tbody>
											</table>
											<table class="table table-striped table-bordered well" id="bcheque" style="display: none;">
												<tbody>
													<tr>
														<td style="border: medium none;"></td>
														<td style="border: medium none; width: 99%;">
															<p>
																Please send your Cheque/DD in favour of BANGALORE INDIA BIO payable at Bengaluru, India.<br>
																Along with the copy of your registration receipt and send to<br>
																<strong>Address :</strong><br/><?php echo $EVENT_CHEQUE_PAYBLE_ADDRESS; /*?><br>Website: <a href="http://www.bengaluruindiabio.in" target="_blank">www.bengaluruindiabio.in</a><?php */?>
															</p>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="form-group">
                                    	<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
                                        <div class="col-md-6">
                                        	<div class="input-group">
												<input name="vercode" type="text" class="form-control" id="vercodevp" maxlength="10" required autocomplete="off"/>
												<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_reg"];?>" />
										  		<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercode_reg"];?></span>
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
				<?php } else {?>
				<h1>Online registration for <?php echo $EVENT_NAME . ' ' . $EVENT_YEAR;?> is closed. 
				However Onspot registration is available at event venue <strong><?php echo $EVENT_VENUE;?></strong>
				</h1>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/reg_form_footer.php';?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript">var assoc_name = '<?php echo $assoc_name;?>';</script>   
<script src="js/registration-test.js?sagar"></script>
<script>
	jQuery(document).ready(function() {  
		Registration.init('registration_form_1', 0);
		//$('#main-form-div').hide();
		//debugger;
		//showForm();
	   	show_cata();
	   	//show_div_group_user();
	   	showTxt();
	   	showDays();
	   	assignSingleDay();
		showPromoCode();
	});

	function showPayment() {
		var valie = $('#sector').val();
		if(valie == 'Information Technology') {
			$('#bite').show();
			$('#bib').hide();
			//$('#tech-div').hide();
			//$('#genotypic-div').hide();
			//document.getElementById("member_Yes").checked = false;
			//document.getElementById("member_No").checked = false;
		} else if(valie == 'Bio Technology') {
			$('#bite').hide();
			$('#bib').show();
			
			//$('#tech-div').show();
			//$('#genotypic-div').show();
		}
		showTxt();
	}

	function showPromo() {
		var valie = $('#event_know').val();
		if(valie == 'Others') {
			$('#other-div').show();
		} else {
			$('#other-div').hide();
		}
	}

	/*function showForm(){
		//$('#main-form-div').hide();
		if($('#delegate-conf').val() =='Delegate'){
			$('#main-form-div').show();
			$('#del_type').show();
		}else if($('#delegate-virtual').val() =='Virtual Conference'){
			$('#main-form-div').show();
			$('#del_type').hide();
		}
	}*/
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
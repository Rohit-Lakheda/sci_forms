<?php
echo "<script language='javascript'>window.location.href='https://www.bengalurutechsummit.com/web/it_forms/enquiry.php';</script>";
exit;
//ob_start();
//ini_set(session.save_path, 'E:\work\xampp\tmp');
require("includes/form_constants_both.php");
$ret = @$_GET['ret'];

if ($ret == "retds4fu324rn_ed24d3it") {
	session_start();
	if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
		session_destroy();
		echo "<script language='javascript'>alert('Please try again.');</script>";
		echo "<script language='javascript'>window.location=('registration-conference.php');</script>";
		echo "<script language='javascript'>document.location=('registration-conference.php');</script>";
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
			echo "<script language='javascript'>window.location = 'registration-conference.php';</script>";
			exit;
		}
	} else {
		session_destroy();
		echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
		echo "<script language='javascript'>window.location='registration-conference.php';</script>";
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
	echo "<script language='javascript'>window.location = 'registration-conference.php?assoc_name=SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)';</script>";
	exit;
}
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />'; 
    require 'includes/reg_form_header.php';?>
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
					<span class="caption-subject font-red bold uppercase"> Standard delegate registration (Free)
 <?php 
					
					
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
				<form action="registration-conference2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post" onsubmit="return validate_registration_form_2();">
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
								<?php /*<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Organisation Information </span>
									</a>
								</li>*/?>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Delegate Information </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 3 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Confirm </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 4 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Receipt </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success"> </div>
							</div>
							<h3 class="block">Provide required information for Free registration</h3>
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
													<?php $countryList = array('Information Technology'=>'Information Technology', 'Startup'=>'Startup');
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
									<?php /*?><div class="form-group form-md-radios del_type" id="del_type">
										<label class="control-label col-md-3">Delegate Type <span class="required"> * </span> </label>
										<div class="col-md-9">
											<div class="md-radio-inline">
												<div class="md-radio <?php if($assoc_name == 'Student-Coordinator') {?>hide<?php }?>">
													<input type="radio" id="Industry" name="cata_m" class="md-radiobtn" value="Premium Delegate" <?php if($assoc_name != 'Student-Coordinator') {?>checked="checked"<?php }?> onclick="assignSingleDay();" required="required">
													<label for="Industry">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Premium Delegate
													</label>
												</div>
												<div class="md-radio del-type-con <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') {?>hide<?php }?>">
													<input type="radio" id="Student" name="cata_m" class="md-radiobtn" value="Standard Delegate" onclick="assignSingleDay();" required="required">
													<label for="Student">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Standard Delegate 
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
												<?php ?><div class="md-radio <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)' || $assoc_name == 'Student-Coordinator') {?>hide<?php }?>">
													<input type="radio" id="Academia" name="cata_m" class="md-radiobtn" value="R&D and Academia" onclick="assignSingleDay();" required="required">
													<label for="Academia">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> R&D and Academia 
													</label>
												</div><?php ?>
											</div>
										</div>
									</div><?php */?>
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
														$selected = '';
														if(isset($_SESSION['total_dele']) && $_SESSION['total_dele'] == $index)
														    $selected = 'selected="selected"';
														echo '<option value="' . $index . '" ' . $className . ' ' . $selected . '>' . $index . '</option>';
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
											<table class="table table-hover1 table-bordered teriff-table col-md-offset-1 col-md-7 main-tariff-table" style="display: none;">
												<thead>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
                                            			<th colspan="6">Delegate Tariff for Virtual Event</th>
													</tr>
													<tr  bgcolor="#2fa0dd" style="color: #fff;">
														<?php /*?><th colspan="2" class="align-td">PACKAGE</th>*/?>
														<th colspan="3" class="align-td">DELEGATE CATEGORY</th>
														<th colspan="1" class="align-td">TARIFF</th>
														<?php /*<th colspan="1" class="align-td">13th Nov to 17th Nov, 2020</th>
														<th colspan="1" class="align-td">8th Nov to 16th Nov, 2020</th>*/?>
													</tr>
												</thead>
												<tbody>
													<tr class="" style="background-color: #e1e1e1;" >
                                            			<?php /*?><td colspan="2" class="align-td">All Access</td>*/?>
                                            			<td colspan="3" class="align-td">Conference Delegate<br/>(Access to entire summit)</td>
                                            			<td colspan="1" class="align-td">FREE</td>
                                            			<?php /*<td colspan="1" class="align-td">INR 3000</td>
                                            			<td colspan="1" class="align-td">INR 6000</td>*/?>
                                            		</tr>
													<?php /*<tr class="indian-tariff" style="background-color: #e1e1e1;" >
                                            			<?php /*?><td colspan="2" class="align-td">All Access</td>//?>
                                            			<td colspan="3" class="align-td">Premium Delegate<br/>(B2B Partnering + Access to entire summit)</td>
                                            			<td colspan="1" class="align-td">INR 5000</td>
                                            			<?php /*<td colspan="1" class="align-td">INR 3000</td>
                                            			<td colspan="1" class="align-td">INR 6000</td>//?>
                                            		</tr>
                                            		<?php *//*<tr class="indian-tariff-1" style="background-color: #e1e1e1;" >
                                            			<td colspan="3" class="align-td">Standard Delegate</td>
                                            			<td colspan="1" class="align-td">INR 2000</td>
                                            			<td colspan="1" class="align-td">INR 3000</td>
                                            		</tr>*/?>
													<?php /*<tr class="international-tariff" style="background-color: #e1e1e1;display: none;">
                                            			<?php /*<td colspan="2" class="align-td">All Access</td>//?>
                                            			<td colspan="2" class="align-td">International Premium Delegate<br/>(B2B Partnering + Access to entire summit)</td>
                                            			<td colspan="2" class="align-td">USD 100</td>
                                            			<?php /*<td colspan="1" class="align-td">USD 200</td>
                                            			<td colspan="1" class="align-td">USD 200</td>//?>
                                            		</tr>
													<tr>
														<td colspan="10">
															<strong>Note: </strong><br/>
																-  18% GST is applicable for the above delegate cost.<br/>
														</td>
													</tr>*/?>
												</tbody>
											</table>
											<table class="table table-hover1 table-bordered teriff-table col-md-offset-1 col-md-7">
												<tbody>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
														<td colspan="10">DELEGATE ENTITLEMENTS :</td>
													</tr>
													<?php /*<tr bgcolor="#2fa0dd" style="color: #fff;">
														<td width="20%" style="font-size: 14px;font-weight: 600px;">Category</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">One 2 One Business Meetings**</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Inaugural/ Keynote/ Plenary/Cultural Programme</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Special Programme India - US Conclave Bengaluru Next</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Conference/ On Demand Sessions</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">International Exhibition</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Industry Awards IT/Biotech/ Start-ups</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Quiz Competition IT/Biotech</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Biotech Posters Walkway of Discovery</td>
													</tr>
													<tr class="conference-del">
														<td bgcolor="#2fa0dd" width="20%" style="color: #fff;">
															Conference Delegate
														</td>
														<td width="10%" bgcolor="#e5ebf1" class="align-td" style="color:red;">
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
														<td width="10%" bgcolor="#e5ebf1" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
													</tr>*/?>
													<?php /*<tr class="partner-del">
														<td bgcolor="#2fa0dd" width="20%" style="color: #fff;">
															Premium Delegate
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
														<td width="10%" bgcolor="#c9e0f3" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
													</tr>
													<tr class="conference-del">
														<td bgcolor="#2fa0dd" width="20%" style="color: #fff;">
															International Premium Delegate
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
														<td width="10%" bgcolor="#e5ebf1" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
														<td width="10%" bgcolor="#e5ebf1" class="align-td">
															<i class="fa fa-check" aria-hidden="true"></i>
														</td>
													</tr>*/?>
													<tr>
														<td colspan="10">
															<?php /*- **One 2 One business meetings will be organised by using the advanced partnering tool will allow you to arrange partnering meetings virtually. You can self-schedule meetings in advance and meet your potential business partners, collaborators, customers during the 3 full days of partnering during the event.<br/>*/?>
															You can access the entire BTS Summit -Inaugural, Plenary Talks, Technical Sessions in IT, Start-up, Biotech, and GIA Tracks,  STPI IT Export Awards, Smart Bio Awards and Start-up Unicorns Felicitation, Rural IT Quiz, Bio Quiz, and Biotech Posters, etc.
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
									<div class="form-group form-md-radios" id="tech-div" style="display:none;">
										<label class="control-label col-md-3">How do you know about Event <span class="required"> * </span> </label>
										<div class="col-md-6">
											<select id="event_know" name="event_know" class="form-control" onchange="showPromo();" >
												<option value="">-- Select --</option>
												<option value="News Paper Ads" <?php if(isset($_SESSION['event_know']) && $_SESSION['event_know'] == 'News Paper Ads'){?>selected="selected"<?php }?>>News Paper Ads</option>
												<option value="Social Media" <?php if(isset($_SESSION['event_know']) && $_SESSION['event_know'] == 'Social Media'){?>selected="selected"<?php }?>>Social Media</option>
												<option value="Past Participant" <?php if(isset($_SESSION['event_know']) && $_SESSION['event_know'] == 'Past Participant'){?>selected="selected"<?php }?>>Past Participant</option>
												<option value="Mailer" <?php if(isset($_SESSION['event_know']) && $_SESSION['event_know'] == 'Mailer'){?>selected="selected"<?php }?>>Mailer</option>
												<option value="Hoarding" <?php if(isset($_SESSION['event_know']) && $_SESSION['event_know'] == 'Hoarding'){?>selected="selected"<?php }?>>Hoarding</option>
												<option value="Others" <?php if(isset($_SESSION['event_know']) && $_SESSION['event_know'] == 'Others'){?>selected="selected"<?php }?>>Others</option>
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
									<?php /*<div class="form-group form-md-radios" id="pay">
										<label class="control-label col-md-3">Payment Mode <span class="required"> * </span> </label>
										<div class="col-md-9">
											<div class="md-radio indian-tariff">
												<input type="radio" id="gpay" name="paymode" class="md-radiobtn" value="Google pay" onclick="showTxt();" >
												<label for="gpay">
												<span></span>
												<span class="check"></span>
												<span class="box"></span> Google pay/ Phonepe/ Paytm
												</label>													
												<span class="help-block">Please Note: <?php echo $CC_IND_PROCESSING_CHARGE_PER;?>% processing charges is applicable for this payment mode.</span>
											</div>
											<div class="md-radio-inline">
												<div class="md-radio indian-tariff">
													<input type="radio" id="Cc" name="paymode" class="md-radiobtn" value="Credit Card" onclick="showTxt();" >
													<label for="Cc">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> CCAvenue Payment - Credit Card / Debit Card / Net Banking
													</label>													
													<span class="help-block indian-tariff">Please Note: <?php echo $CC_IND_PROCESSING_CHARGE_PER;?>% processing charges is applicable for CCAVenue payment mode.</span>													
												</div>
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
												<?php //<div class="md-radio">
													<input type="radio" id="BT" name="paymode" class="md-radiobtn" value="Bank Transfer" onclick="showTxt();" >
													<label for="BT">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Bank Transfer<strong>(Offline)</strong> / NEFT / RTGS / IMPS
													</label>
												</div>//?>
												<div class="md-radio international-tariff">
													<input type="radio" id="paypal" name="paymode" class="md-radiobtn" value="Paypal" onclick="showTxt();" >
													<label for="paypal">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Paypal - Credit Card / Debit Card
													</label>													
													<span class="help-block">Please Note: 9.5% processing charges is applicable for PayPal payment mode.</span>
												</div>
											</div>
										</div>
									</div>*/?>
									<div class="form-group" id="bite" style="display:none;">
										<label class="control-label col-md-1"></label>
										<div class="col-md-11">
											<table class="" id="credit_card" style="display: none;"></table>
											<table class="" id="debit_card" style="display: none;"></table>
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
									<h3 class="block">Provide Organisation Information</h3>
									<div class="form-group">
										<label class="col-md-3 control-label">Organisation Name<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="org" id="org" value="<?php echo (isset($_SESSION['org']) ? $_SESSION['org'] : '');?>" required="required" />
										</div>
									</div>
									<div class="form-group hide" style="display:none;">
										<label class="col-md-3 control-label">Nature Of Business</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="nature" id="nature" value="<?php echo (isset($_SESSION['nature']) ? $_SESSION['nature'] : '');?>" />
										</div>
									</div>
									<?php /*<div class="form-group">
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
									</div>*/?>
									<div class="form-group">
										<label class="col-md-3 control-label">City<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="city" id="city" value="<?php echo (isset($_SESSION['city']) ? $_SESSION['city'] : '');?>" onkeyup="check_char(event,'city')" required="required"/>
										</div>
									</div>
									<div class="form-group hide" style="display:none;">
										<label class="col-md-3 control-label">State<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="state" id="state" value="<?php echo (isset($_SESSION['state']) ? $_SESSION['state'] : '');?>"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"> Country <span class="required"> * </span>
										</label>
										<div class="col-md-6">
											<select id="country" name="country" class="form-control">
												<option value="">Select Country </option>
												<?php $countryList = array("AF"=>"Afghanistan","AL"=>"Albania","DZ"=>"Algeria","AS"=>"American Samoa","AD"=>"Andorra","AO"=>"Angola","AI"=>"Anguilla","AQ"=>"Antarctica","AR"=>"Argentina","AM"=>"Armenia","AW"=>"Aruba","AU"=>"Australia","AT"=>"Austria","AZ"=>"Azerbaijan","BS"=>"Bahamas","BH"=>"Bahrain","BD"=>"Bangladesh","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Belgium","BZ"=>"Belize","BJ"=>"Benin","BM"=>"Bermuda","BT"=>"Bhutan","BO"=>"Bolivia","BA"=>"Bosniaand Herzegowina","BW"=>"Botswana","BV"=>"BouvetIsland","BR"=>"Brazil","IO"=>"British Indian Ocean Territory","BN"=>"Brunei Darussalam","BG"=>"Bulgaria","BF"=>"Burkina Faso","BI"=>"Burundi","KH"=>"Cambodia","CM"=>"Cameroon","CA"=>"Canada","CV"=>"CapeVerde","KY"=>"Cayman Islands","CF"=>"CentralAfricanRepublic","TD"=>"Chad","CL"=>"Chile","CN"=>"China","CX"=>"ChristmasIsland","CC"=>"Cocos Keeling Islands","CO"=>"Colombia","KM"=>"Comoros","CG"=>"Congo","CD"=>"Congo the Democratic Republicofthe","CK"=>"Cook Islands","CR"=>"CostaRica","CI"=>"Coted Ivoire","HR"=>"Croatia(Hrvatska)","CU"=>"Cuba","CY"=>"Cyprus","CZ"=>"Czech Republic","DK"=>"Denmark","DJ"=>"Djibouti","DM"=>"Dominica","DO"=>"Dominican Republic","EC"=>"Ecuador","EG"=>"Egypt","SV"=>"ElSalvador","GQ"=>"Equatorial Guinea","ER"=>"Eritrea","EE"=>"Estonia","ET"=>"Ethiopia","FK"=>"Falkland Islands Malvinas","FO"=>"FaroeIslands","FJ"=>"Fiji","FI"=>"Finland","FR"=>"France","GF"=>"French Guiana","PF"=>"French Polynesia","TF"=>"French Southern Territories","GA"=>"Gabon","GM"=>"Gambia","GE"=>"Georgia","DE"=>"Germany","GH"=>"Ghana","GI"=>"Gibraltar","GR"=>"Greece","GL"=>"Greenland","GD"=>"Grenada","GP"=>"Guadeloupe","GU"=>"Guam","GT"=>"Guatemala","GN"=>"Guinea","GW"=>"Guinea-Bissau","GY"=>"Guyana","HT"=>"Haiti","HM"=>"Heardand McDonald Islands","VA"=>"HolySee Vatican City State","HN"=>"Honduras","HK"=>"Hong Kong","HU"=>"Hungary","IS"=>"Iceland","IN"=>"India","ID"=>"Indonesia","IR"=>"Iran Islamic Republic","IQ"=>"Iraq","IE"=>"Ireland","IL"=>"Israel","IT"=>"Italy","JM"=>"Jamaica","JP"=>"Japan","JO"=>"Jordan","KZ"=>"Kazakhstan","KE"=>"Kenya","KI"=>"Kiribati","KP"=>"Korea Democratic People Republic","KR"=>"Korea Republic","KW"=>"Kuwait","KG"=>"Kyrgyzstan","LA"=>"LaoPeoples Democratic Republic","LV"=>"Latvia","LB"=>"Lebanon","LS"=>"Lesotho","LR"=>"Liberia","LY"=>"Libyan Arab Jamahiriya","LI"=>"Liechtenstein","LT"=>"Lithuania","LU"=>"Luxembourg","MO"=>"Macau","MK"=>"Macedonia The Former Yugoslav Republic","MG"=>"Madagascar","MW"=>"Malawi","MY"=>"Malaysia","MV"=>"Maldives","ML"=>"Mali","MT"=>"Malta","MH"=>"Marshall Islands","MQ"=>"Martinique","MR"=>"Mauritania","MU"=>"Mauritius","YT"=>"Mayotte","MX"=>"Mexico","FM"=>"Micronesia,FederatedStatesof","MD"=>"Moldova Republic","MC"=>"Monaco","MN"=>"Mongolia","MS"=>"Montserrat","MA"=>"Morocco","MZ"=>"Mozambique","MM"=>"Myanmar","NA"=>"Namibia","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Netherlands","AN"=>"Netherlands Antilles","NC"=>"NewCaledonia","NZ"=>"New Zealand","NI"=>"Nicaragua","NE"=>"Niger","NG"=>"Nigeria","NU"=>"Niue","NF"=>"Norfolk Island","MP"=>"Northern Mariana Islands","NO"=>"Norway","OM"=>"Oman","PK"=>"Pakistan","PW"=>"Palau","PA"=>"Panama","PG"=>"Papua New Guinea","PY"=>"Paraguay","PE"=>"Peru","PH"=>"Philippines","PN"=>"Pitcairn","PL"=>"Poland","PT"=>"Portugal","PR"=>"PuertoRico","QA"=>"Qatar","RE"=>"Reunion","RO"=>"Romania","RU"=>"Russian Federation","RW"=>"Rwanda","KN"=>"Saint Kittsand Nevis","LC"=>"SaintLUCIA","VC"=>"Saint VincentandtheGrenadines","WS"=>"Samoa","SM"=>"SanMarino","ST"=>"Sa oTomeand Principe","SA"=>"Saudi Arabia","SN"=>"Senegal","SC"=>"Seychelles","SL"=>"Sierra Leone","SG"=>"Singapore","SK"=>"Slovakia SlovakRepublic","SI"=>"Slovenia","SB"=>"Solomon Islands","SO"=>"Somalia","ZA"=>"South Africa","GS"=>"South Georgiaand the South Sandwich Islands","ES"=>"Spain","LK"=>"SriLanka","SH"=>"St.Helena","PM"=>"St.Pierreand Miquelon","SD"=>"Sudan","SR"=>"Suriname","SJ"=>"Svalbardand Jan Mayen Islands","SZ"=>"Swaziland","SE"=>"Sweden","CH"=>"Switzerland","SY"=>"Syrian Arab Republic","TW"=>"Taiwan","TJ"=>"Tajikistan","TZ"=>"Tanzania United Republic","TH"=>"Thailand","TG"=>"Togo","TK"=>"Tokelau","TO"=>"Tonga","TT"=>"TrinidadandTobago","TN"=>"Tunisia","TR"=>"Turkey","TM"=>"Turkmenistan","TC"=>"Turksand Caicos Islands","TV"=>"Tuvalu","UG"=>"Uganda","UA"=>"Ukraine","AE"=>"United Arab Emirates","GB"=>"United Kingdom","US"=>"United States","UM"=>"United States Minor Outlying Islands","UY"=>"Uruguay","UZ"=>"Uzbekistan","VU"=>"Vanuatu","VE"=>"Venezuela","VN"=>"VietNam","VG"=>"VirginIslands British ","VI"=>"Virgin Islands U.S.","WF"=>"Wallisand Futuna Islands","EH"=>"Western Sahara","YE"=>"Yemen","ZM"=>"Zambia","ZW"=>"Zimbabwe");
												    if(!isset($_SESSION) ||empty($_SESSION['country'])) {
														$qr_gt_user_data_ans_row['country'] = 'India';
													}
													foreach ($countryList as $country) {
														$selected = '';
														if(isset($_SESSION['country']) && $_SESSION['country'] == $country) {
															$selected = 'selected=selected';
														}
														echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>'; 
													}
													?>
											</select>
										</div>
									</div>
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
									</div>*/?>
									<?php /*<div class="form-group">
										<label class="col-md-3 control-label">GST Number<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="gst_number" id="gst_number" value="<?php echo $qr_gt_user_data_ans_row['gst_number'];?>" required="required"/>
											<span class="help-block" style="color: #f00;">(Note: Only for India Companies for Raising an Invoice GST Number is a must.)</span>
											<span class="help-block" style="color: #f00;">Note: If you want to leave this field empty, then add it's value <b>"Not Available"</b></span>
										</div>
									</div>*/?>
									<div class="form-group">
										<label class="col-md-3 control-label">Telephone Number<span class="dips-required"> * </span></label>
										<div class="col-md-6" style="margin-top: -16px;">
											<span type="tel" id="telCountryIsoCode" data-fax-iso-code-hidden-field-name="foneCountryCode" class="hide"></span>
											<input type="hidden" name="foneCountryCode" id="foneCountryCode" value="<?php echo (isset($_SESSION['foneCountryCode'])) ? $_SESSION['foneCountryCode']: '';?>"/>
											<input type="hidden" id="foneCountryCodeIso" />
											<input name="fone" type="text" id="fone" class="form-control" maxlength="20" value="<?php echo (isset($_SESSION['fone'])) ? $_SESSION['fone']: '';?>" required onkeyup="checkPhoneNumber(event, 'fone');" style="padding-left: 92px;" />
											<span class="help-block">+Country Code-Area Code-Phone Number(xxx-xxxxxxx)</span>
										</div>
									</div>
									<?php /*?><div class="form-group">
										<label class="col-md-3 control-label">Fax Number</label>
										<div class="col-md-6" style="margin-top: -15px;">
											<span type="tel" id="faxCountryIsoCode" data-fax-iso-code-hidden-field-name="faxCountryCode"></span>
											<?php $fax = explode('-', $qr_gt_user_data_ans_row['fax']);?>
											<input type="hidden" name="faxCountryCode" id="faxCountryCode" value="<?php echo !empty($fax[1]) ? @$fax[0] : '';?>"/>
											<input type="hidden" id="faxCountryCodeIso" />
											<input name="fax" type="text" id="fax" class="form-control" maxlength="20" value="<?php echo !empty($fax[1]) ? @$fax[1] .@$fax[2] : '';?>" onkeyup="checkPhoneNumber(event, 'fax');" style="padding-left: 92px;"/>
											<span class="help-block">+Country Code-Area Code-Fax Number(xxx-xxxxxxx)</span>
										</div>
									</div><?php */?>
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
<script src="js/registration-conf.js?tej"></script>
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
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
		$('.main-tariff-table').remove();
		$("#telCountryIsoCode").intlTelInput();
	});

	function showPayment() {
		$('#bite').show();
		$('#bib').hide();
		/*var valie = $('#sector').val();
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
		showTxt();*/
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
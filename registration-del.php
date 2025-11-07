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
				<form action="registration-del2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post" onsubmit="return validate_registration_form_2();">
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
											</div>
										</div>
									</div>	<?php */?>
									<div class="form-group">
										<label class="control-label col-md-3"> <span class="normal-cata">Number of Delegate(s)</span><span class="poster-cata" style="display:none;">Number of Co-Author</span> <span class="required"> * </span></label>
										<div class="col-md-6">
											<select class="form-control" name="total_dele" id="total_dele" required>
												<option value="2" class="normal-cata">2</option>
												<?php /*$lmt = 7;
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
													}*/
													?>
											</select>
										</div>
									</div>
									<?php if($assoc_name == 'ABAI' || $assoc_name == 'Spread' || $assoc_name == 'KSRSAC' || $assoc_name == 'TiE Bangalore' || $assoc_name == 'YESSS Abstract Presenter'|| $assoc_name=='KBITS') {?>
									<?php if($assoc_name == 'ABAI') {?>
									<?php } else if($assoc_name == 'Spread') {?>
									<?php } else if($assoc_name == 'KSRSAC'||$assoc_name == 'KBITS') {?>
									<?php } else if($assoc_name == 'TiE Bangalore') {?>
									<?php } else if($assoc_name == 'YESSS Abstract Presenter') {?>
									<?php }} else {?>
									<?php if(!empty($assoc_name)) {?>
										<?php if(!empty($assoc_name) && $assoc_name == 'Program-Coordinators') {?>
										<?php } else if(!empty($assoc_name) && $assoc_name == 'Faculty') {?>
										<?php } else if(!empty($assoc_name) && $assoc_name == 'Student-Coordinator') {?>
										<?php } else {?>
									<?php }}?>
									<div class="form-group form-md-radios">
										<label class="control-label col-md-3">Category <span class="required"> * </span> </label>
										<div class="col-md-9">
											<div class="md-radio-inline">
												<div class="md-radio hide">
													<input type="hidden" id="assoc_name" name="assoc_name" value="<?php echo !empty($assoc_name)? $assoc_name : '';?>">
													<input type="radio" id="Indian" name="curr" class="md-radiobtn" value="Indian" onclick="show_cata();" required="required">
													<label for="Indian">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Indian 
													</label>
												</div>
												<div class="md-radio ">
													<input type="radio" id="Foreign" name="curr" class="md-radiobtn" value="Foreign" onclick="show_cata();" checked="checked" required="required">
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
									<?php }?>
									<div class="form-group">
										<label class="control-label col-md-1"></label>
										<div class="col-md-9">
											<table class="table table-hover1 table-bordered teriff-table col-md-offset-1 col-md-7 main-tariff-table">
												<thead>
													<tr bgcolor="#2fa0dd" style="color: #fff;">
                                            			<th colspan="6">Delegate Tariff for Virtual Event</th>
													</tr>
													<tr  bgcolor="#2fa0dd" style="color: #fff;">
														<?php /*?><th colspan="2" class="align-td">PACKAGE</th>*/?>
														<th colspan="3" class="align-td">DELEGATE CATEGORY</th>
														<th colspan="1" class="align-td">Tariff</th>
													</tr>
												</thead>
												<tbody>
													<tr class="indian-tariff" style="background-color: #e1e1e1;" >
                                            			<td colspan="3" class="align-td">Premium Delegate</td>
                                            			<td colspan="1" class="align-td">INR 2000</td>
                                            		</tr>
													<tr class="international-tariff" style="background-color: #e1e1e1;display: none;">
                                            			<td colspan="2" class="align-td">Premium Delegate</td>
                                            			<td colspan="2" class="align-td">USD 50&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            		</tr>
                                            		<tr class="indian-tariff-123" style="background-color: #e1e1e1;" >
                                            			<td colspan="3" class="align-td">Standard Delegate</td>
                                            			<td colspan="1" class="align-td">Free</td>
                                            		</tr>
													<tr>
														<td colspan="10">
															<strong>Note: </strong><br/>
																-  18% GST is applicable for the above delegate cost.<br/>
														</td>
													</tr>
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
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Inaugural/ Keynotes/ Plenary Sessions and  Cultural Programme</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Conference/ On Demand Sessions</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">International Exhibition</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Industry Awards IT/Biotech/ Start-ups</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Quiz Competition IT/Biotech</td>
														<td width="10%" style="font-size: 14px;font-weight: 600px;">Biotech Posters Walkway Of Discovery</td>
													</tr>
													<tr class="partner-del1">
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
													</tr>
													<tr class="conference-del1">
														<td bgcolor="#2fa0dd" width="20%" style="color: #fff;">
															Standard Delegate
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
													<tr>
														<td colspan="10">
															-  **One 2 One business meetings will be organised by using the advanced partnering tool Virtual Partnering will allow you to arrange partnering meetings virtually. You can self-schedule meetings in advance and meet your potential business partners, collaborators, customers during the 3 full days of partnering from November 19-21, 2020.<br/>
														</td>
													</tr>
												</tbody>
											</table>
						        		</div><br/><br/>
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
										</div>
										<div class="col-md-3" id="other-div" style="display:none;">
											<input type="text" class="form-control" id="other_value" name="other_value" placeholder="Other Value">
											<span class="help-block">Eg. Friends, Colleague</span>
										</div>
									</div>
									<div class="form-group form-md-radios" id="pay">
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
												<?php /*<div class="md-radio">
													<input type="radio" id="BT" name="paymode" class="md-radiobtn" value="Bank Transfer" onclick="showTxt();" >
													<label for="BT">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Bank Transfer<strong>(Offline)</strong> / NEFT / RTGS / IMPS
													</label>
												</div>*/?>
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
									</div>
									<div class="form-group" id="bite">
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
<script src="js/registration-del.js?sagar"></script>
<script>
	jQuery(document).ready(function() {  
		Registration.init('registration_form_1', 0);
		//$('#main-form-div').hide();
		//debugger;
		//showForm();
	   	show_cata();
	   	//show_div_group_user();
	   	showTxt();
	   	//showDays();
	   	//assignSingleDay();
		showPromoCode();
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
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
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
		echo "<script language='javascript'>window.location=('registration-assoc-comp.php');</script>";
		echo "<script language='javascript'>document.location=('registration-assoc-comp.php');</script>";
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
			echo "<script language='javascript'>window.location = 'registration-assoc-comp.php';</script>";
			exit;
		}
	} else {
		session_destroy();
		echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
		echo "<script language='javascript'>window.location='registration-assoc-comp.php';</script>";
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
//echo $assoc_name1;
$assoc_name = @$_GET['assoc_name'];
/*if($assoc_name == 'STPI') {
	echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?assoc_name=SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)';</script>";
	exit;
}*/
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />'; 
	  require 'includes/reg_form_header.php';?>
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
          	.selected-flag {
          		margin-top: -23px;
          	}
		optgroup {
			font-weight: bold;
		}
	</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Complimentary Delegate Registration Form <?php 
					
					
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
				<?php if(!empty($assoc_name1)) {//date('Y-m-d H:i') >= '2019-11-15 19:00') {?>
				<form action="registration-assoc-comp2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post" onsubmit="return validate_registration_form_2();">
					<?php /*?><input type="hidden" value="Standard" name="cata_m" /><?php */?>
					<div class="form-wizard">
						<div class="form-body" <?php echo date('Y-m-d H:i');?>>
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a href="#tab1" data-toggle="tab" class="step">
										<span class="number"> 1 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Information </span>
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
										<span class="number"> 3 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Delegate Information </span>
									</a>
								</li>*/?>
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
									
									<?php $i = 1;?>
									<div class="form-group form-md-radios del_type" id="del_type">
										<label class="control-label col-md-3">Delegate Type <span class="required"> * </span> </label>
										<div class="col-md-9">
											<div class="md-radio-inline">
												<?php if($assoc_name1 == 'STPIMC' || $assoc_name1 == 'STPIDNE' || $assoc_name1 == 'STPIPME' || $assoc_name1 == 'ICTTRES' || $assoc_name1 == 'IICFP' || $assoc_name1 == 'PQ7KFH' || $assoc_name1 == 'S3TNJD' || $assoc_name1 == '9EU52J' || $assoc_name1 == 'FL764M' || $assoc_name1 == 'SLT1R2' || $assoc_name1 == 'FD2HTL' || $assoc_name1 == 'TCS' || $assoc_name1 == 'AUVTU' || $assoc_name1 == 'BIOCON' || $assoc_name1 == 'INFOSYS' || $assoc_name1 == '1EU2Y7' || $assoc_name1 == 'BCTIVJ' || $assoc_name1 == 'AY1RJN' || $assoc_name1 == 'J2VPDF' || $assoc_name1 == 'MIDC' || $assoc_name1 == 'TLCFMY' || $assoc_name1 == '1RJAPZ' || $assoc_name1 == 'ALZQMF' || $assoc_name1 == 'IIITB' || $assoc_name1 == 'BIRAC' || $assoc_name1 == 'INTUIT' || $assoc_name1 == 'KITS' || $assoc_name1 == 'EITBTST' || $assoc_name1 == 'GIAP' || $assoc_name1 == 'DCM') {?>
												<div class="md-radio del-type-con ">
													<input type="radio" id="Student" name="cata_m" class="md-radiobtn" value="Standard Delegate" onclick="assignSingleDay();" checked="checked" required="required">
													<label for="Student">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Standard Delegate 
													</label>
												</div>
												<?php } else if($assoc_name1 == 'PBIOCON' || $assoc_name1 == 'PINFOSYS') {?>
													<div class="md-radio ">
														<input type="radio" id="Industry" name="cata_m" class="md-radiobtn" value="Premium Delegate" <?php if($assoc_name != 'Student-Coordinator') {?>checked="checked"<?php }?>  required="required">
														<label for="Industry">
														<span></span>
														<span class="check"></span>
														<span class="box"></span> Premium Delegate
														</label>
													</div>
												<?php } else {?>
												<div class="md-radio">
													<input type="radio" id="Industry" name="cata_m" class="md-radiobtn" value="VIP Conference Delegate" checked="checked" onclick="assignSingleDay();" required="required">
													<label for="Industry">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> VIP Conference Delegate
													</label>
												</div>
												<?php }?>
											</div>
										</div>
									</div>	
									<div class="form-group hide">
										<label class="control-label col-md-3"> <span class="normal-cata">Number of Delegate(s)</span> <span class="required"> * </span></label>
										<div class="col-md-6">
											<select class="form-control" name="total_dele" id="total_dele" required>
												<option value="1">1</option>
												<?php $lmt = 7;
													if(isset($discountDetail['code']) && !empty($discountDetail['code'])) {
														$lmt = 1;
													} else {?>
												<?php }?>
											</select>
										</div>
									</div>
									<?php if($assoc_name1 == 'STPIMC' || $assoc_name1 == 'STPIDNE' || $assoc_name1 == 'STPIPME' || $assoc_name1 == 'ICTTRES' || $assoc_name1 == 'IICFP') {?>
										<div class="form-group form-md-radios">
											<label class="control-label col-md-3">Category: <span class="required">  </span> </label>
											<div class="col-md-9">Complimentary Invitee Delegate</div>
											<input name="cata" type="hidden" value="Complimentary Invitee Delegate" />
										</div>
										<input name="cata<?php echo $i; ?>" type="hidden" id="cata<?php echo $i; ?>" value="Standard Delegate"  />
									<?php } else if($assoc_name1 == 'BIOCON' || $assoc_name1 == 'PBIOCON' || $assoc_name1 == 'INFOSYS' || $assoc_name1 == 'PINFOSYS' || $assoc_name1 == '1EU2Y7' || $assoc_name1 == 'BCTIVJ' || $assoc_name1 == 'AY1RJN' || $assoc_name1 == 'J2VPDF' || $assoc_name1 == 'MIDC' || $assoc_name1 == 'TLCFMY' || $assoc_name1 == '1RJAPZ' || $assoc_name1 == 'ALZQMF' || $assoc_name1 == 'IIITB' || $assoc_name1 == 'BIRAC' || $assoc_name1 == 'INTUIT') {?>
										<div class="form-group form-md-radios">
											<label class="control-label col-md-3">Category: <span class="required">  </span> </label>
											<div class="col-md-9">Complimentary Sponsors Delegate</div>
											<input name="cata" type="hidden" value="Complimentary Sponsors Delegate" />
										</div>
										<?php if($assoc_name1 == 'PBIOCON' || $assoc_name1 == 'PINFOSYS') {?>
											<input name="cata<?php echo $i; ?>" type="hidden" id="cata<?php echo $i; ?>" value="Premium Delegate"  />
										<?php } else {?>
											<input name="cata<?php echo $i; ?>" type="hidden" id="cata<?php echo $i; ?>" value="Standard Delegate"  />
									<?php }} else {?>
										<div class="form-group form-md-radios">
											<label class="control-label col-md-3">Category: <span class="required">  </span> </label>
											<div class="col-md-9">Complimentary Delegate</div>
											<input name="cata" type="hidden" value="Complimentary Delegate" />
										</div>
										<input name="cata<?php echo $i; ?>" type="hidden" id="cata<?php echo $i; ?>" value="Standard Delegate"  />
									<?php }if(!empty($discountDetail)) {?>
										<div class="form-group">
											<label class="col-md-3 control-label">Association Name/ Dignitary Name<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<?php echo $discountDetail['assoc_name'];?>
												<input type="hidden" id="user_type" name="user_type" class="form-control" value="<?php echo $discountDetail['assoc_name'];?>"/>
												<input type="hidden" name="assoc_srno" id="assoc_srno" value="<?php echo $discountDetail['srno'];?>"/>
												<input name="promo_code" type="hidden" id="promo_code" value="<?php echo $discountDetail['promo_code'];?>"/>
												<span class="help-block"><i></i></span>
											</div>
										</div>
									<?php }?>
									</div>
									<div class="form-group">
								    	<label class="control-label col-md-3">Name <span class="dips-required"> * </span></label>
								      	<div class="col-md-2">
								      		<select class="form-control" name="title<?php echo $i; ?>" id="title<?php echo $i; ?>" required="required">
									   			<option value="">-Title-</option>
												<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
						                            foreach ($titleList as $title) {
						                            	$selected = '';
						                            	if($qr_gt_user_data_ans_row['title'.$i] == $title || $_SESSION['title'.$i] == $title){
						                            		$selected = 'selected="selected"';
						                            	}
						                            	echo '<option value="' . $title . '" ' . $selected . '>' . $title . '</option>';
						                            }
						                    	?>
									        </select>
								      	</div>
								      	<div class="col-md-2"><input type="text" class="form-control" placeholder="First Name" name="fname<?php echo $i; ?>" type="text" id="fname<?php echo $i; ?>" maxlength="100" value="<?php if(isset($_SESSION['fname'.$i])) { echo $_SESSION['fname'.$i]; }else{echo @$qr_gt_user_data_ans_row['fname'.$i]; } ?>" required="required"></div>
								      	<div class="col-md-2"><input type="text" class="form-control" placeholder="Last Name" name="lname<?php echo $i; ?>" type="text" id="lname<?php echo $i; ?>" maxlength="100" value="<?php if(isset($_SESSION['lname'.$i])) { echo $_SESSION['lname'.$i]; }else{ echo @$qr_gt_user_data_ans_row['lname'.$i]; } ?>" required="required"></div>
										</div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Job Title <span class="dips-required">  </span></label>
                                                <div class="col-md-6">
                                                	<input class="form-control" name="job_title<?php echo $i; ?>" type="text" id="job_title<?php echo $i; ?>" maxlength="100" value="<?php if(isset($_SESSION['job_title'.$i])) { echo $_SESSION['job_title'.$i]; }else{ echo @$qr_gt_user_data_ans_row['job_title'.$i]; } ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Email Address <span class="dips-required"> * </span></label>
                                                <div class="col-md-6">
                                                	<input class="form-control" name="email_m<?php echo $i; ?>" type="email" id="email_m<?php echo $i; ?>" maxlength="150" value="<?php if(isset($_SESSION['email'.$i])) { echo $_SESSION['email'.$i]; }else{ echo @$qr_gt_user_data_ans_row['email'.$i]; } ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Mobile Number <span class="dips-required"> * </span></label>
                                                <div class="col-md-6" >
                                                	<span type="tel" id="mobile-country-code<?php echo $i; ?>" data-fax-iso-code-hidden-field-name="cellnoCountryCode<?php echo $i; ?>"></span>
											<?php 
												$mobile = array();
												if(isset($qr_gt_user_data_ans_row['cellno'.$i]))
													$mobile = explode("-",$qr_gt_user_data_ans_row['cellno'.$i]);
											?>
											<input type="hidden" name="cellnoCountryCode<?php echo $i; ?>" id="cellnoCountryCode<?php echo $i; ?>" value="<?php echo !empty($mobile[1]) ? str_replace('+', '', @$mobile[0]) : '';?>"/>
											<input type="hidden" id="cellnoCountryCode<?php echo $i; ?>Iso" />
											<input class="form-control" name="cellno<?php echo $i; ?>" type="text" id="cellno<?php echo $i; ?>" maxlength="10"  value="<?php echo !empty($mobile[1]) ? @$mobile[1] : '';?>" required onkeyup="check_num(event, 'cellno<?php echo $i; ?>');"  style="padding-left: 92px;    margin-top: -16px;"/>
													<span class="help-block">+Country Code-Mobile Number(xxx-xxxxxxxxxx)</span>
                                                </div>
                                            </div>
										<div class="form-group">
											<label class="col-md-3 control-label">Organisation Name<span class="dips-required">  </span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="org" id="org" value="<?php echo @$temp_org;?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">City<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="city" id="city" value="<?php echo @$temp_city;?>" onkeyup="check_char(event,'city')" required="required"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"> Country <span class="required"> * </span>
										</label>
										<div class="col-md-6">
											<select id="country" name="country" class="form-control">
												<option value="">Select Country </option>
												<?php $countryList = array("AF"=>"Afghanistan","AL"=>"Albania","DZ"=>"Algeria","AS"=>"AmericanSamoa","AD"=>"Andorra","AO"=>"Angola","AI"=>"Anguilla","AQ"=>"Antarctica","AR"=>"Argentina","AM"=>"Armenia","AW"=>"Aruba","AU"=>"Australia","AT"=>"Austria","AZ"=>"Azerbaijan","BS"=>"Bahamas","BH"=>"Bahrain","BD"=>"Bangladesh","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Belgium","BZ"=>"Belize","BJ"=>"Benin","BM"=>"Bermuda","BT"=>"Bhutan","BO"=>"Bolivia","BA"=>"BosniaandHerzegowina","BW"=>"Botswana","BV"=>"BouvetIsland","BR"=>"Brazil","IO"=>"BritishIndianOceanTerritory","BN"=>"BruneiDarussalam","BG"=>"Bulgaria","BF"=>"BurkinaFaso","BI"=>"Burundi","KH"=>"Cambodia","CM"=>"Cameroon","CA"=>"Canada","CV"=>"CapeVerde","KY"=>"CaymanIslands","CF"=>"CentralAfricanRepublic","TD"=>"Chad","CL"=>"Chile","CN"=>"China","CX"=>"ChristmasIsland","CC"=>"Cocos(Keeling)Islands","CO"=>"Colombia","KM"=>"Comoros","CG"=>"Congo","CD"=>"Congo,theDemocraticRepublicofthe","CK"=>"CookIslands","CR"=>"CostaRica","CI"=>"Coted'Ivoire","HR"=>"Croatia(Hrvatska)","CU"=>"Cuba","CY"=>"Cyprus","CZ"=>"CzechRepublic","DK"=>"Denmark","DJ"=>"Djibouti","DM"=>"Dominica","DO"=>"DominicanRepublic","EC"=>"Ecuador","EG"=>"Egypt","SV"=>"ElSalvador","GQ"=>"EquatorialGuinea","ER"=>"Eritrea","EE"=>"Estonia","ET"=>"Ethiopia","FK"=>"FalklandIslands(Malvinas)","FO"=>"FaroeIslands","FJ"=>"Fiji","FI"=>"Finland","FR"=>"France","GF"=>"FrenchGuiana","PF"=>"FrenchPolynesia","TF"=>"FrenchSouthernTerritories","GA"=>"Gabon","GM"=>"Gambia","GE"=>"Georgia","DE"=>"Germany","GH"=>"Ghana","GI"=>"Gibraltar","GR"=>"Greece","GL"=>"Greenland","GD"=>"Grenada","GP"=>"Guadeloupe","GU"=>"Guam","GT"=>"Guatemala","GN"=>"Guinea","GW"=>"Guinea-Bissau","GY"=>"Guyana","HT"=>"Haiti","HM"=>"HeardandMcDonaldIslands","VA"=>"HolySee(VaticanCityState)","HN"=>"Honduras","HK"=>"HongKong","HU"=>"Hungary","IS"=>"Iceland","IN"=>"India","ID"=>"Indonesia","IR"=>"Iran(IslamicRepublicof)","IQ"=>"Iraq","IE"=>"Ireland","IL"=>"Israel","IT"=>"Italy","JM"=>"Jamaica","JP"=>"Japan","JO"=>"Jordan","KZ"=>"Kazakhstan","KE"=>"Kenya","KI"=>"Kiribati","KP"=>"Korea,DemocraticPeople'sRepublicof","KR"=>"Korea,Republicof","KW"=>"Kuwait","KG"=>"Kyrgyzstan","LA"=>"LaoPeople'sDemocraticRepublic","LV"=>"Latvia","LB"=>"Lebanon","LS"=>"Lesotho","LR"=>"Liberia","LY"=>"LibyanArabJamahiriya","LI"=>"Liechtenstein","LT"=>"Lithuania","LU"=>"Luxembourg","MO"=>"Macau","MK"=>"Macedonia,TheFormerYugoslavRepublicof","MG"=>"Madagascar","MW"=>"Malawi","MY"=>"Malaysia","MV"=>"Maldives","ML"=>"Mali","MT"=>"Malta","MH"=>"MarshallIslands","MQ"=>"Martinique","MR"=>"Mauritania","MU"=>"Mauritius","YT"=>"Mayotte","MX"=>"Mexico","FM"=>"Micronesia,FederatedStatesof","MD"=>"Moldova,Republicof","MC"=>"Monaco","MN"=>"Mongolia","MS"=>"Montserrat","MA"=>"Morocco","MZ"=>"Mozambique","MM"=>"Myanmar","NA"=>"Namibia","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Netherlands","AN"=>"NetherlandsAntilles","NC"=>"NewCaledonia","NZ"=>"NewZealand","NI"=>"Nicaragua","NE"=>"Niger","NG"=>"Nigeria","NU"=>"Niue","NF"=>"NorfolkIsland","MP"=>"NorthernMarianaIslands","NO"=>"Norway","OM"=>"Oman","PK"=>"Pakistan","PW"=>"Palau","PA"=>"Panama","PG"=>"PapuaNewGuinea","PY"=>"Paraguay","PE"=>"Peru","PH"=>"Philippines","PN"=>"Pitcairn","PL"=>"Poland","PT"=>"Portugal","PR"=>"PuertoRico","QA"=>"Qatar","RE"=>"Reunion","RO"=>"Romania","RU"=>"RussianFederation","RW"=>"Rwanda","KN"=>"SaintKittsandNevis","LC"=>"SaintLUCIA","VC"=>"SaintVincentandtheGrenadines","WS"=>"Samoa","SM"=>"SanMarino","ST"=>"SaoTomeandPrincipe","SA"=>"SaudiArabia","SN"=>"Senegal","SC"=>"Seychelles","SL"=>"SierraLeone","SG"=>"Singapore","SK"=>"Slovakia(SlovakRepublic)","SI"=>"Slovenia","SB"=>"SolomonIslands","SO"=>"Somalia","ZA"=>"SouthAfrica","GS"=>"SouthGeorgiaandtheSouthSandwichIslands","ES"=>"Spain","LK"=>"SriLanka","SH"=>"St.Helena","PM"=>"St.PierreandMiquelon","SD"=>"Sudan","SR"=>"Suriname","SJ"=>"SvalbardandJanMayenIslands","SZ"=>"Swaziland","SE"=>"Sweden","CH"=>"Switzerland","SY"=>"SyrianArabRepublic","TW"=>"Taiwan,ProvinceofChina","TJ"=>"Tajikistan","TZ"=>"Tanzania,UnitedRepublicof","TH"=>"Thailand","TG"=>"Togo","TK"=>"Tokelau","TO"=>"Tonga","TT"=>"TrinidadandTobago","TN"=>"Tunisia","TR"=>"Turkey","TM"=>"Turkmenistan","TC"=>"TurksandCaicosIslands","TV"=>"Tuvalu","UG"=>"Uganda","UA"=>"Ukraine","AE"=>"UnitedArabEmirates","GB"=>"UnitedKingdom","US"=>"UnitedStates","UM"=>"UnitedStatesMinorOutlyingIslands","UY"=>"Uruguay","UZ"=>"Uzbekistan","VU"=>"Vanuatu","VE"=>"Venezuela","VN"=>"VietNam","VG"=>"VirginIslands(British)","VI"=>"VirginIslands(U.S.)","WF"=>"WallisandFutunaIslands","EH"=>"WesternSahara","YE"=>"Yemen","ZM"=>"Zambia","ZW"=>"Zimbabwe");
													if(empty($temp_country)) {
														$temp_country = 'India';
													}
													foreach ($countryList as $country) {
														$selected = '';
														if($temp_country == $country) {
															$selected = 'selected=selected';
														}
														echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>'; 
													}
												?>
											</select>
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
				<h1>Invalid link. Please use correct link for association registration</h1>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/reg_form_footer.php';?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript">var assoc_name = '<?php echo $assoc_name;?>';</script>   
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script>
	jQuery(document).ready(function() {  
		Registration.init('registration_form_3', 2);
		<?php $i=1;//for($i=1;$i<=$lmt;$i++){ ?>
			$("#mobile-country-code<?php echo $i; ?>").intlTelInput();
	});
</script>
<script>
	jQuery(document).ready(function() {  
		Registration.init('registration_form_1', 0);
		//$('#main-form-div').hide();
		//debugger;
		//showForm();
	   	/*show_cata();
	   	//show_div_group_user();
	   	showTxt();
	   	showDays();
	   	assignSingleDay();
		showPromoCode();*/
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
	
	function validate_registration_form_2() {
		if(document.getElementById("sector").value == "") {
			alert("Please select sector.");
			document.getElementById("sector").focus();
			return false;
		}
		if(document.getElementById("event_know").value == "") {
			alert("Please select How do you know about Event.");
			document.getElementById("event_know").focus();
			return false;
		} else if(document.getElementById("event_know").value == "Others") {
			if(document.getElementById("other_value").value == "") {
				alert("Please enter other value of How do you know about Event.");
				document.getElementById("other_value").focus();
				return false;
			}
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
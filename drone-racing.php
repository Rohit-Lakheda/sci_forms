<?php
	require("includes/form_constants_both.php");
	$ret = @$_GET['ret'];
	
	if ($ret == "retds4fu324rn_ed24d3it") {
		session_start();
		if ((!isset($_SESSION["vercode_drone"])) || ($_SESSION["vercode_drone"] == '')) {
			session_destroy();
			echo "<script language='javascript'>alert('Please try again.');</script>";
			echo "<script language='javascript'>window.location=('drone-racing.php');</script>";
			echo "<script language='javascript'>document.location=('drone-racing.php');</script>";
			exit;
		}
		require "dbcon_open.php";
		$reg_id = $_SESSION["vercode_drone"];
		$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_DRONE_RACING_DEMO." WHERE reg_id = '$reg_id'");
		$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
		/*if( ($qr_gt_user_data_ans_no<=0) || ($qr_gt_user_data_ans_no=="") ){
			session_destroy();
			echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
			echo "<script language='javascript'>window.location=('drone-racing.php');</script>";
			echo "<script language='javascript'>document.location=('drone-racing.php');</script>";
			exit; 
		}	*/
		
		//$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_DRONE_RACING_DEMO." WHERE reg_id = '$reg_id'");
		//$qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
		$qr_gt_user_data_ans_row = $_SESSION;
	} else {
		include('captcha_drone.php');
	}
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />
	<link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />'; 
	require 'includes/reg_form_header.php';?>
<style>
	.selected-flag {
	margin-top: -5px;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_2">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Night Drone Racing Registration Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="drone-racing2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_2" id="reg_registration_form_2" method="post" onsubmit="return validate_registration_form_2();">
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a class="step dips-default-cursor">
									<span class="number"> 1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Information </span>
									</a>
								</li>
								<li class="active1">
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Confirmation </span>
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
							<div class="tab-content">
								<div class="tab-pane active">
									<div class="form-group">
										<label class="control-label col-md-3">Name <span class="dips-required"> * </span></label>
										<?php /*?><div class="col-md-2">
											<select class="form-control" name="title" id="title" required="required">
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
										</div><?php */?>
										<div class="col-md-3"><input type="text" class="form-control" placeholder="First Name" name="fname" type="text" id="fname" maxlength="100" value="<?php echo @$qr_gt_user_data_ans_row['fname']; ?>" required="required"></div>
										<div class="col-md-3"><input type="text" class="form-control" placeholder="Last Name" name="lname" type="text" id="lname" maxlength="100" value="<?php echo @$qr_gt_user_data_ans_row['lname']; ?>" required="required"></div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Pilot CallSign or Nickname<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="nickname" id="nickname" value="<?php echo @$qr_gt_user_data_ans_row['nickname'];?>" required="required" placeholder="E.g. FlyingSid" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Email Address <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input class="form-control" name="email" type="email" id="email" maxlength="150" value="<?php echo @$qr_gt_user_data_ans_row['email']; ?>" required />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Date of Birth<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control date-picker" name="dob" id="dob" value="<?php echo @$qr_gt_user_data_ans_row['dob'];?>" required="required" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Gender<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<select class="form-control" name="gender" id="gender" required>
												<option value="Male" <?php if(isset($qr_gt_user_data_ans_row['gender']) && $qr_gt_user_data_ans_row['gender'] == 'Male'){?>selected="selected"<?php }?>>Male</option>
												<option value="Female" <?php if(isset($qr_gt_user_data_ans_row['gender']) && $qr_gt_user_data_ans_row['gender'] == 'Female'){?>selected="selected"<?php }?>>Female</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Phone<span class="dips-required"> * </span></label>
										<div class="col-md-6" style="margin-top: -16px;">
											<span type="tel" id="telCountryIsoCode" data-fax-iso-code-hidden-field-name="foneCountryCode" class="hide"></span>
											<?php $phone = explode('-', @$qr_gt_user_data_ans_row['phone']);?>
											<input type="hidden" name="foneCountryCode" id="foneCountryCode" value="<?php echo !empty($phone[1]) ? str_replace('+', '', @$phone[0]) : '';?>"/>
											<input type="hidden" id="foneCountryCodeIso" />
											<input name="phone" type="text" id="fone" class="form-control" maxlength="20" value="<?php echo !empty($phone[1]) ? @$phone[1] . @$phone[2] : '';?>" required onkeyup="checkPhoneNumber(event, 'fone');" style="padding-left: 92px;" />
											<span class="help-block">+Country Code-Phone Number(xxx-xxxxxxx)</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Address 1<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<textarea name="addr1" id="addr1" rows="" cols="" required="required" class="form-control"><?php echo @$qr_gt_user_data_ans_row['addr1'];?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Address 2</label>
										<div class="col-md-6">
											<textarea name="addr2" id="addr2" rows="" cols="" class="form-control"><?php echo @$qr_gt_user_data_ans_row['addr2'];?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">City<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="city" id="city" value="<?php echo @$qr_gt_user_data_ans_row['city'];?>" onkeyup="check_char(event,'city')" required="required"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">State<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="state" id="state" value="<?php echo @$qr_gt_user_data_ans_row['state'];?>" required="required"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"> Country <span class="required"> * </span>
										</label>
										<div class="col-md-6">
											<select id="country" name="country" class="form-control">
												<option value="">Select Country </option>
												<?php $countryList = array("AF"=>"Afghanistan","AL"=>"Albania","DZ"=>"Algeria","AS"=>"American Samoa","AD"=>"Andorra","AO"=>"Angola","AI"=>"Anguilla","AQ"=>"Antarctica","AR"=>"Argentina","AM"=>"Armenia","AW"=>"Aruba","AU"=>"Australia","AT"=>"Austria","AZ"=>"Azerbaijan","BS"=>"Bahamas","BH"=>"Bahrain","BD"=>"Bangladesh","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Belgium","BZ"=>"Belize","BJ"=>"Benin","BM"=>"Bermuda","BT"=>"Bhutan","BO"=>"Bolivia","BA"=>"Bosniaand Herzegowina","BW"=>"Botswana","BV"=>"BouvetIsland","BR"=>"Brazil","IO"=>"British Indian Ocean Territory","BN"=>"Brunei Darussalam","BG"=>"Bulgaria","BF"=>"Burkina Faso","BI"=>"Burundi","KH"=>"Cambodia","CM"=>"Cameroon","CA"=>"Canada","CV"=>"CapeVerde","KY"=>"Cayman Islands","CF"=>"CentralAfricanRepublic","TD"=>"Chad","CL"=>"Chile","CN"=>"China","CX"=>"ChristmasIsland","CC"=>"Cocos Keeling Islands","CO"=>"Colombia","KM"=>"Comoros","CG"=>"Congo","CD"=>"Congo the Democratic Republicofthe","CK"=>"Cook Islands","CR"=>"CostaRica","CI"=>"Coted Ivoire","HR"=>"Croatia(Hrvatska)","CU"=>"Cuba","CY"=>"Cyprus","CZ"=>"Czech Republic","DK"=>"Denmark","DJ"=>"Djibouti","DM"=>"Dominica","DO"=>"Dominican Republic","EC"=>"Ecuador","EG"=>"Egypt","SV"=>"ElSalvador","GQ"=>"Equatorial Guinea","ER"=>"Eritrea","EE"=>"Estonia","ET"=>"Ethiopia","FK"=>"Falkland Islands Malvinas","FO"=>"FaroeIslands","FJ"=>"Fiji","FI"=>"Finland","FR"=>"France","GF"=>"French Guiana","PF"=>"French Polynesia","TF"=>"French Southern Territories","GA"=>"Gabon","GM"=>"Gambia","GE"=>"Georgia","DE"=>"Germany","GH"=>"Ghana","GI"=>"Gibraltar","GR"=>"Greece","GL"=>"Greenland","GD"=>"Grenada","GP"=>"Guadeloupe","GU"=>"Guam","GT"=>"Guatemala","GN"=>"Guinea","GW"=>"Guinea-Bissau","GY"=>"Guyana","HT"=>"Haiti","HM"=>"Heardand McDonald Islands","VA"=>"HolySee Vatican City State","HN"=>"Honduras","HK"=>"Hong Kong","HU"=>"Hungary","IS"=>"Iceland","IN"=>"India","ID"=>"Indonesia","IR"=>"Iran Islamic Republic","IQ"=>"Iraq","IE"=>"Ireland","IL"=>"Israel","IT"=>"Italy","JM"=>"Jamaica","JP"=>"Japan","JO"=>"Jordan","KZ"=>"Kazakhstan","KE"=>"Kenya","KI"=>"Kiribati","KP"=>"Korea Democratic People Republic","KR"=>"Korea Republic","KW"=>"Kuwait","KG"=>"Kyrgyzstan","LA"=>"LaoPeoples Democratic Republic","LV"=>"Latvia","LB"=>"Lebanon","LS"=>"Lesotho","LR"=>"Liberia","LY"=>"Libyan Arab Jamahiriya","LI"=>"Liechtenstein","LT"=>"Lithuania","LU"=>"Luxembourg","MO"=>"Macau","MK"=>"Macedonia The Former Yugoslav Republic","MG"=>"Madagascar","MW"=>"Malawi","MY"=>"Malaysia","MV"=>"Maldives","ML"=>"Mali","MT"=>"Malta","MH"=>"Marshall Islands","MQ"=>"Martinique","MR"=>"Mauritania","MU"=>"Mauritius","YT"=>"Mayotte","MX"=>"Mexico","FM"=>"Micronesia,FederatedStatesof","MD"=>"Moldova Republic","MC"=>"Monaco","MN"=>"Mongolia","MS"=>"Montserrat","MA"=>"Morocco","MZ"=>"Mozambique","MM"=>"Myanmar","NA"=>"Namibia","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Netherlands","AN"=>"Netherlands Antilles","NC"=>"NewCaledonia","NZ"=>"New Zealand","NI"=>"Nicaragua","NE"=>"Niger","NG"=>"Nigeria","NU"=>"Niue","NF"=>"Norfolk Island","MP"=>"Northern Mariana Islands","NO"=>"Norway","OM"=>"Oman","PK"=>"Pakistan","PW"=>"Palau","PA"=>"Panama","PG"=>"Papua New Guinea","PY"=>"Paraguay","PE"=>"Peru","PH"=>"Philippines","PN"=>"Pitcairn","PL"=>"Poland","PT"=>"Portugal","PR"=>"PuertoRico","QA"=>"Qatar","RE"=>"Reunion","RO"=>"Romania","RU"=>"Russian Federation","RW"=>"Rwanda","KN"=>"Saint Kittsand Nevis","LC"=>"SaintLUCIA","VC"=>"Saint VincentandtheGrenadines","WS"=>"Samoa","SM"=>"SanMarino","ST"=>"Sa oTomeand Principe","SA"=>"Saudi Arabia","SN"=>"Senegal","SC"=>"Seychelles","SL"=>"Sierra Leone","SG"=>"Singapore","SK"=>"Slovakia SlovakRepublic","SI"=>"Slovenia","SB"=>"Solomon Islands","SO"=>"Somalia","ZA"=>"South Africa","GS"=>"South Georgiaand the South Sandwich Islands","ES"=>"Spain","LK"=>"SriLanka","SH"=>"St.Helena","PM"=>"St.Pierreand Miquelon","SD"=>"Sudan","SR"=>"Suriname","SJ"=>"Svalbardand Jan Mayen Islands","SZ"=>"Swaziland","SE"=>"Sweden","CH"=>"Switzerland","SY"=>"Syrian Arab Republic","TW"=>"Taiwan Province of China","TJ"=>"Tajikistan","TZ"=>"Tanzania United Republic","TH"=>"Thailand","TG"=>"Togo","TK"=>"Tokelau","TO"=>"Tonga","TT"=>"TrinidadandTobago","TN"=>"Tunisia","TR"=>"Turkey","TM"=>"Turkmenistan","TC"=>"Turksand Caicos Islands","TV"=>"Tuvalu","UG"=>"Uganda","UA"=>"Ukraine","AE"=>"United Arab Emirates","GB"=>"United Kingdom","US"=>"United States","UM"=>"United States Minor Outlying Islands","UY"=>"Uruguay","UZ"=>"Uzbekistan","VU"=>"Vanuatu","VE"=>"Venezuela","VN"=>"VietNam","VG"=>"VirginIslands British ","VI"=>"Virgin Islands U.S.","WF"=>"Wallisand Futuna Islands","EH"=>"Western Sahara","YE"=>"Yemen","ZM"=>"Zambia","ZW"=>"Zimbabwe");
													if(empty($qr_gt_user_data_ans_row['country'])) {
														$qr_gt_user_data_ans_row['country'] = 'India';
													}
													foreach ($countryList as $country) {
														$selected = '';
														if($qr_gt_user_data_ans_row['country'] == $country) {
															$selected = 'selected=selected';
														}
														echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>'; 
													}
													?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Postal Code<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="pin" id="pin" value="<?php echo @$qr_gt_user_data_ans_row['pin'];?>" required="required"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Skill Level <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<select class="form-control" name="skill_level" id="skill_level" required>
												<?php /*<option value="Beginner" <?php if(isset($qr_gt_user_data_ans_row['skill_level']) && $qr_gt_user_data_ans_row['skill_level'] == 'Beginner'){?>selected="selected"<?php }?>>Beginner</option>*/?>
												<option value="Intermediate" <?php if(isset($qr_gt_user_data_ans_row['skill_level']) && $qr_gt_user_data_ans_row['skill_level'] == 'Intermediate'){?>selected="selected"<?php }?>>Intermediate</option>
												<option value="Pro" <?php if(isset($qr_gt_user_data_ans_row['skill_level']) && $qr_gt_user_data_ans_row['skill_level'] == 'Pro'){?>selected="selected"<?php }?>>Pro</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Drone Experience <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<textarea name="drone_experience" id="drone_experience" rows="" cols="" class="form-control" required="required"><?php echo @$qr_gt_user_data_ans_row['drone_experience'];?></textarea>
										</div>
									</div>
									<div class="form-group form-md-radios">
										<label class="control-label col-md-3">Payment Mode <span class="required"> * </span> </label>
										<div class="col-md-9">
											<div class="md-radio-inline">
												<div class="md-radio">
													<input type="radio" id="Cc" name="paymode" class="md-radiobtn" value="Credit Card" onclick="showTxt();" >
													<label for="Cc">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Credit Card / Debit Card / Net Banking
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
												<div class="md-radio">
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
														<td colspan="2">Indian delegates are requested to Bank Transfer the registration fees to the following account</td>
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
													<tr>
														<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:adarsh.accounts@mmactiv.com">adarsh.accounts@mmactiv.com</a></td>
													</tr>
												</tbody>
											</table>
											<table class="table table-striped table-bordered table-hover " id="bank_transfer2" style="display: none;">
												<tbody>
													<tr>
														<td colspan="2">International delegates are requested to Bank Transfer the registration fees to the following account</td>
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
														<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:adarsh.accounts@mmactiv.com">adarsh.accounts@mmactiv.com</a></td>
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
									<div class="form-group">
                                    	<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
                                        <div class="col-md-6">
                                        	<div class="input-group">
												<input name="vercode" type="text" class="form-control" id="vercodevp" maxlength="10" required autocomplete="off"/>
												<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_drone"];?>" />
										  		<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercode_drone"];?></span>
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
			</div>
		</div>
	</div>
</div>
<?php require 'includes/reg_form_footer.php';?>
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.date-picker').datepicker({
		    rtl: App.isRTL(),
		    format: 'yyyy-m-dd',
		    endDate: '+0d',
		    autoclose: true
		});
	});
</script>
<script src="js/drone-racing.js"></script>
<script>
	jQuery(document).ready(function() {  
		Registration.init('registration_form_2', 0);
		$("#telCountryIsoCode").intlTelInput();
		$("#faxCountryIsoCode").intlTelInput();
		/* var foneCountryCodeIso = $('#foneCountryCodeIso').val();
		if(foneCountryCodeIso != '') {
			$("#telCountryIsoCode").intlTelInput("setCountry", foneCountryCodeIso);
		} */
	});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
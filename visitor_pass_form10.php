<?php
echo "<script language='javascript'>document.location='enquiry.php';</script>";
exit;
/*echo "<script language='javascript'>window.location.href='https://www.bengalurutechsummit.com/web/it_forms/enquiry.php';</script>";
exit;*/

require "includes/form_constants_both.php";
require "visitor_pass_captcha_vp.php";
$temp_assoc_nm_vp = @$_REQUEST['assoc_nm_vp'];
/*if(empty($temp_assoc_nm_vp)) {
	echo "<script language='javascript'>document.location=('https://bts.wizit.app/#/virtual/auth/register');</script>";
	exit;
}*/
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />';
require 'includes/reg_form_header.php'; ?>
<style>
	.selected-flag {
		margin-top: -5px;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="enq_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> FREE Business Exhibition Visitor Registration Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="visitor_form1" name="form1" class="form-horizontal" method="post" action="visitor_pass_form2.php?assoc_nm_vp=<?php echo $temp_assoc_nm_vp; ?>" onsubmit="return  validate_vpass('<?php echo $EVENT_NAME; ?>');">
					<input name="vercode" type="hidden" id="vercode" value="<?php echo $_SESSION['vercodevp']; ?>" />
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a class="step">
										<span class="number"> 1 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Visitor's Details </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
										<span class="number"> 2 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Confirmation </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success"> </div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"> Industry Sector <span class="required"> * </span>
								</label>
								<div class="col-md-5">
									<select id="sector" name="sector" class="form-control" required="required">
										<option value="">-- Select Industry Sector --</option>
										<?php //$countryList = array('Information Technology'=>'Information Technology', 'Bio Technology'=>'Bio Technology','DeepTech'=>'DeepTech','IoT'=>'IoT','AI&ML'=>'AI&ML','AR &VR'=>'AR &VR','Electronics'=>'Electronics','Telecommunications'=>'Telecommunications','Smarttech'=>'Smarttech','Fintech'=>'Fintech','Edutech'=>'Edutech','Gaming'=>'Gaming','Healthtech'=>'Healthtech','Medtech'=>'Medtech','Mobility'=>'Mobility','Robo &Drone'=>'Robo &Drone','Other'=>'Other');
										$countryList = array('Information Technology' => 'Information Technology', 'Bio Technology' => 'Bio Technology', 'Startup' => 'Startup', 'Other' => 'Other');

										//$countryList = array('Information Technology'=>'Information Technology');
										foreach ($countryList as $key => $value) {
											echo '<option value="' . $key . '">' . $value . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"> Organisation Type<span class="required"> * </span>
								</label>
								<div class="col-md-5">
									<select id="org_reg_type" name="org_reg_type" class="form-control" required="required" onchange="showPayment();">
											<option value="">-- Select Organisation Type --</option>
											<?php $countryList = array('Startup' => 'Startup','MSME' => 'MSME', 'Corporate / Industry' => 'Corporate / Industry', 'R&D Labs' => 'R&D Labs',  'Investors' => 'Investors','Government'=>'Government', 'Industry Associations'=>'Industry Associations','Consulting'=>'Consulting','Trade Mission'=>'Trade Mission', 'Others' => 'Others');
											foreach ($countryList as $key => $value) {
												$selected = '';
												if (isset($_SESSION['org_reg_type']) && $_SESSION['org_reg_type'] == $value)
													$selected = 'selected=selected';
												echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
											}
											?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Name <span class="dips-required"> * </span></label>
								<div class="col-md-2">
									<select class="form-control" name="title" id="title" required="required">
										<option value="">-Title-</option>
										<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
										foreach ($titleList as $title) {
											echo '<option value="' . $title . '">' . $title . '</option>';
										}
										?>
									</select>
								</div>
								<div class="col-md-3"><input type="text" class="form-control" placeholder="Name" name="fname" type="text" id="fname" maxlength="100" required="required"></div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Email Address <span class="dips-required"> * </span></label>
								<div class="col-md-5">
									<input class="form-control" name="email" type="email" id="email" maxlength="150" required />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Organisation <span class="dips-required"> * </span></label>
								<div class="col-md-5">
									<input class="form-control" name="org" type="text" id="org" required />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Designation <span class="dips-required"> * </span></label>
								<div class="col-md-5">
									<input class="form-control" name="job_title" type="text" id="job_title" required />
								</div>
							</div>
							<!-- <div class="form-group">
									<label class="col-md-3 control-label">Organisation URL </label>
									<div class="col-md-5">
										<input class="form-control" name="website" type="text" id="website" />
									</div>
								</div> -->
							<!-- <div class="form-group">
                                	<label class="col-md-3 control-label">Address <span class="dips-required"> * </span></label>
                                 	<div class="col-md-5">
                                    	<textarea name="addr" id="addr" rows="" cols="" class="form-control" required></textarea>
                                    </div>
                                </div> -->
							<div class="form-group">
								<label class="col-md-3 control-label">City <span class="dips-required"> * </span></label>
								<div class="col-md-5">
									<input class="form-control" name="city" type="text" id="city" required onkeyup="check_char(event,'city');" />
								</div>
							</div>
							<!-- <div class="form-group">
									<label class="col-md-3 control-label">State <span class="dips-required"> * </span></label>
									<div class="col-md-5">
										<input class="form-control" name="state" type="text" id="state" required onkeyup="check_char(event,'state');"/>
									</div>
								</div> -->
							<div class="form-group">
								<label class="control-label col-md-3"> Country <span class="required"> * </span></label>
								<div class="col-md-5">
									<select class="form-control" name="country" id="country">
										<option value="">-- Select Country --</option>
										<?php $countryList = array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "AmericanSamoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "BosniaandHerzegowina", "BW" => "Botswana", "BV" => "BouvetIsland", "BR" => "Brazil", "IO" => "BritishIndianOceanTerritory", "BN" => "BruneiDarussalam", "BG" => "Bulgaria", "BF" => "BurkinaFaso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "CapeVerde", "KY" => "CaymanIslands", "CF" => "CentralAfricanRepublic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "ChristmasIsland", "CC" => "Cocos(Keeling)Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo,theDemocraticRepublicofthe", "CK" => "CookIslands", "CR" => "CostaRica", "CI" => "Coted'Ivoire", "HR" => "Croatia(Hrvatska)", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "CzechRepublic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "DominicanRepublic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "ElSalvador", "GQ" => "EquatorialGuinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "FalklandIslands(Malvinas)", "FO" => "FaroeIslands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "FrenchGuiana", "PF" => "FrenchPolynesia", "TF" => "FrenchSouthernTerritories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "HeardandMcDonaldIslands", "VA" => "HolySee(VaticanCityState)", "HN" => "Honduras", "HK" => "HongKong", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran(IslamicRepublicof)", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KP" => "Korea,DemocraticPeople'sRepublicof", "KR" => "Korea,Republicof", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "LaoPeople'sDemocraticRepublic", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "LibyanArabJamahiriya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau", "MK" => "Macedonia,TheFormerYugoslavRepublicof", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "MarshallIslands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia,FederatedStatesof", "MD" => "Moldova,Republicof", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "NetherlandsAntilles", "NC" => "NewCaledonia", "NZ" => "NewZealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "NorfolkIsland", "MP" => "NorthernMarianaIslands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PA" => "Panama", "PG" => "PapuaNewGuinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PT" => "Portugal", "PR" => "PuertoRico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "RussianFederation", "RW" => "Rwanda", "KN" => "SaintKittsandNevis", "LC" => "SaintLUCIA", "VC" => "SaintVincentandtheGrenadines", "WS" => "Samoa", "SM" => "SanMarino", "ST" => "SaoTomeandPrincipe", "SA" => "SaudiArabia", "SN" => "Senegal", "SC" => "Seychelles", "SL" => "SierraLeone", "SG" => "Singapore", "SK" => "Slovakia(SlovakRepublic)", "SI" => "Slovenia", "SB" => "SolomonIslands", "SO" => "Somalia", "ZA" => "SouthAfrica", "GS" => "SouthGeorgiaandtheSouthSandwichIslands", "ES" => "Spain", "LK" => "SriLanka", "SH" => "St.Helena", "PM" => "St.PierreandMiquelon", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "SvalbardandJanMayenIslands", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "SyrianArabRepublic", "TW" => "Taiwan,ProvinceofChina", "TJ" => "Tajikistan", "TZ" => "Tanzania,UnitedRepublicof", "TH" => "Thailand", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "TrinidadandTobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "TurksandCaicosIslands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "UnitedArabEmirates", "GB" => "UnitedKingdom", "US" => "UnitedStates", "UM" => "UnitedStatesMinorOutlyingIslands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "VietNam", "VG" => "VirginIslands(British)", "VI" => "VirginIslands(U.S.)", "WF" => "WallisandFutunaIslands", "EH" => "WesternSahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");
										$countrys = 'India';
										foreach ($countryList as $country) {
											echo '<option value="' . $country . '">' . $country . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<!-- <div class="form-group">
									<label class="col-md-3 control-label">Postal Code <span class="dips-required"> * </span></label>
									<div class="col-md-5">
										<input class="form-control" name="zip" type="text" id="zip" required />
									</div>
								</div> -->
							<div class="form-group">
								<label class="col-md-3 control-label">Contact Number<span class="dips-required"> * </span></label>
								<div class="col-md-5" style="margin-top: -20px;">
									<span type="tel" id="mobileCountryCode" data-fax-iso-code-hidden-field-name="foneCountryCode"></span>
									<input type="hidden" name="foneCountryCode" id="foneCountryCode" />
									<input type="hidden" id="foneCountryCodeIso" name="foneCountryCodeIso" />
									<input name="fone" type="text" id="fone" class="form-control" maxlength="20" required onkeyup="check_num(event, 'fone');" style="padding-left: 92px;" />
								</div>
							</div>
							<!-- <div class="form-group">
									<label class="control-label col-md-3"> Organisation's Main Activity  </label>
									<div class="col-md-5">
										<textarea name="org_act" class="form-control" rows="3" id="org_act" ></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3"> Main Interest  <span class="required"> * </span></label>
									<div class="col-md-5">
										<textarea name="interest" class="form-control" rows="3" id="interest" required="required"></textarea>
									</div>
								</div> -->
							<div class="form-group">
								<label class="control-label col-md-3"> Purpose of Visit? <span class="required"> * </span></label>
								<div class="col-md-9">
									<div class="md-checkbox-list">
										<?php $id = 0;
										for ($listIndex = 0; $listIndex < 2; $listIndex++) {
											$length = count($VISITOR_WNT_INFO_ARR);
											$index = count($VISITOR_WNT_INFO_ARR) / 2;
											if ($listIndex == 0) {
												$index = 0;
												$length = count($VISITOR_WNT_INFO_ARR) / 2;
											}
										?>
											<div class="md-checkbox-inline">
												<?php
												for ($index = $index; $index < $length; $index++) {
													$id++;
													$checked = ''; ?>
													<div class="md-checkbox">
														<input type="checkbox" name="purpose<?php echo $id; ?>" id="purpose<?php echo $id; ?>" value="<?php echo $VISITOR_WNT_INFO_ARR[$index]; ?>" class="md-check" <?php echo $checked; ?> <?php if ($VISITOR_WNT_INFO_ARR[$index] == 'Other') { ?>onclick="show_othr_fun('purpose<?php echo $id; ?>');" <?php } ?>>
														<label for="purpose<?php echo $id; ?>">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> <?php echo $VISITOR_WNT_INFO_ARR[$index]; ?></label>
													</div>
													<?php if ($VISITOR_WNT_INFO_ARR[$index] == 'Other') { ?>
														<span class="" id="div_enq_other" style="display: none; margin-top: -42px; width: 35%; margin-left: 77px;">
															<input name="other_v" id="other_v" class="form-control" placeholder="Other" type="text">
														</span>
												<?php }
												} ?>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">How did you know about this event?<span class="dips-required"> * </span></label>
								<div class="col-md-3">
									<select class="form-control" name="know1" id="find_us" onchange="disp_other_k();">
										<option value="">Select Option</option>
										<?php $find_usList = array("Social Media", "Brochure", "Colleague", "Link on Site", "Previous Attendee", "Internet search", "Sales Call", "Association", "Direct Mailer", "News Paper Ad", "Trade Publication", "Invitation from Exhibitor", "Hoarding", "Others");
										foreach ($find_usList as $find_us) {
											echo '<option value="' . $find_us . '">' . $find_us . '</option>';
										}
										?>
									</select>
								</div>
								<div class="col-md-2" style="">
									<div id="div_find_us" style="display:none;">
										<input name="other_txtbx_find_us" id="other_txtbx_find_us" type="text" class="form-control" placeholder="Other" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Do You Wish to Receive Info from <?php echo $EVENT_NAME; ?>?<span class="required"> * </span> </label>
								<div class="col-md-9">
									<div class="md-radio-inline">
										<div class="md-radio">
											<input type="radio" id="feedback1" name="feedback" class="md-radiobtn" value="Yes" checked="checked" required="required">
											<label for="feedback1">
												<span></span>
												<span class="check"></span>
												<span class="box"></span> Yes </label>
										</div>
										<div class="md-radio">
											<input type="radio" id="feedback2" name="feedback" class="md-radiobtn" value="No" required="required">
											<label for="feedback2">
												<span></span>
												<span class="check"></span>
												<span class="box"></span> No </label>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
								<div class="col-md-6">
									<div class="input-group">
										<input name="vercodevp" class="form-control" id="vercodevp" maxlength="10" required="" autocomplete="off" type="text">
										<input name="test" id="test" value="<?php echo $_SESSION["vercodevp"]; ?>" type="hidden">
										<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercodevp"]; ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-2 col-md-8">
								<div class="note note-success">
									<p><strong>Note:</strong> <br />
										<strong>Please carry your business card during your visit to the exhibition.</strong><br />
										For any additional information or clarification, contact us on <br />
										<?php ?>Event Secretariat: <?php echo $EVENT_SECRT_ADDR; ?><br /><?php  ?>
										Email: <a href="mailto:<?php echo $EVENT_ENQUIRY_EMAIL; ?>" target="_blank"><?php echo $EVENT_ENQUIRY_EMAIL; ?></a> <br />
									</p>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn sbold uppercase green-jungle"> Generate Pass
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
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script src="js/visiter-pass.js"></script>
<script>
	jQuery(document).ready(function() {
		Registration.init('enq_form_1', 0);
		$("#mobileCountryCode").intlTelInput();

		disp_other_k();
		show_othr_fun('purpose8');
	});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
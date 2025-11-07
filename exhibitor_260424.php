<?php
//echo "<script language='javascript'>window.location.href='https://www.bengalurutechsummit.com/web/it_forms/enquiry.php';</script>";
//exit;
//echo "<script language='javascript'>window.location = ('exhibitors_form.php');</script>";
//exit ();
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  */
$ret = @$_GET['rt'];
require "includes/form_constants_both.php";

$assoc_nm = @$_REQUEST['assoc_nm'];

if (!empty($assoc_nm) && $assoc_nm != $ASSOC_NAME_EXHIBITOR) {
	//$assoc_nm = '';
}

if ($ret == "retds4fn324rn_ed24d3it") {
	session_start();
	if ((!isset($_SESSION["vercode_ex"])) || ($_SESSION["vercode_ex"] == '')) {
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?assoc_nm=$assoc_nm');</script>";
		exit();
	}

	$text = $_SESSION["vercode_ex"];
	$assoc_nm = @$_SESSION['assoc_nm'];
} else {
	require "exhibitor_captcha.php";

	$_SESSION['speaker_event_name'] = $EVENT_NAME;
	$_SESSION['speaker_event_year'] = $EVENT_YEAR;

	$_SESSION['sess_booth_no'] = "";
	$_SESSION['sess_booth_area'] = "";
	$_SESSION['sess_booth_area_unit'] = "";
	$_SESSION['sess_fascia_name'] = "";

	$_SESSION['sess_exhi_name'] = "";
	$_SESSION['sess_cp_title'] = "";
	$_SESSION['sess_cp_fname'] = "";
	$_SESSION['sess_cp_lname'] = "";
	$_SESSION['sess_desig'] = "";
	$_SESSION['sess_addr1'] = "";
	$_SESSION['sess_addr2'] = "";
	$_SESSION['sess_city'] = "";
	$_SESSION['sess_state'] = "";
	$_SESSION['sess_country'] = "";
	$_SESSION['sess_zip'] = "";
	$_SESSION['foneCountryIso'] = "";
	$_SESSION['sess_fon'] = "";
	$_SESSION['cellnoCountryCode'] = "";
	$_SESSION['sess_mob'] = "";
	$_SESSION['faxCountryIso'] = "";
	$_SESSION['sess_fax'] = "";
	$_SESSION['sess_email'] = "";
	$_SESSION['sess_website'] = "";
	$_SESSION['sess_exbhi_profile'] = "";
	$_SESSION['sess_category'] = "";
	$_SESSION['sess_exhi_profile'] = "";
	$_SESSION['sess_keywords'] = "";
	$_SESSION['assoc_nm'] = "";
}

if (($assoc_nm == "VoICE Consortium Pavilion")) {
	$qr_chk_exb_dup_name_id = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_PHASE_2 WHERE assoc_nm='$assoc_nm'");
	if (mysqli_num_rows($qr_chk_exb_dup_name_id) >= 20) {
		echo "<script language='javascript'>alert('For VoICE Consortium Pavilion 20 stalls are booked.');</script>";
		//echo "<script language='javascript'>window.location = ('exhibitor.php');</script>";
		exit();
	}
}
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css">';
require 'includes/reg_form_header.php'; ?>
<style>
	.selected-flag {
		margin-top: -5px;
	}

	.checkbox>input {
		margin-left: 10px !important;
		position: inherit !important;
	}

	.dropdown-menu>.active>a,
	.dropdown-menu>.active>a:focus,
	.dropdown-menu>.active>a:hover {
		background-color: #337ab7 !important;
		color: #fff !important;
		outline: 0 none !important;
		text-decoration: none !important;
	}

	.multiselect-clear-filter {
		background-color: #d5d5d5 !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Exhibitor Personnel/Delegate Form </span>
				</div>
			</div>
			<div class="portlet-body form">
				<?php if (date('Y-m-d') <= '2024-11-19') { ?>
					<form action="exhibitor2.php?assoc_nm=<?php echo $assoc_nm; ?>" class="form-horizontal" name="exhibitors_form_1" id="exhibitors_form_1" method="post" onsubmit="return validate_ex();" enctype="multipart/form-data">
						<div class="form-wizard">
							<div class="form-body">
								<ul class="nav nav-pills nav-justified steps">
									<li class="active">
										<a href="#tab1" data-toggle="tab" class="step">
											<span class="number"> 1 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Sponsor/Exhibitor Details </span>
										</a>
									</li>
									<li>
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
												<i class="fa fa-check"></i> Preview Detail</span>
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
										<div class="alert alert-info">
											<span class="block">Dear Sponsor/Exhibitor, <br />Please note: The details submitted through this form will be published in the Event Document. Please take necessary precaution to give the correct details.</span>
										</div>
										<?php if (!empty($assoc_nm)) { ?>
											<?php if ($assoc_nm == $ASSOC_NAME_EXHIBITOR) { ?>
												<h3><strong>Startup Innovation Zone</strong></h3><br />
												<div class="form-group">
													<label class="col-md-3 control-label">Sector <span class="dips-required"> * </span></label>
													<div class="col-md-6">
														<select id="exhi_profile" name="exhi_profile[]" class="form-control" required onchange="sectorChanged();">
															<option value="">-- Select Sector --</option>
															<?php //$countryList = array('Information Technology'=>'Information Technology', 'Bio Technology'=>'Bio Technology');
															$countryList = array('IT', 'IoT', 'AI & ML', 'AR & VR', 'Electronics', 'Smarttech', 'Fintech', 'Edutech', 'Gaming', 'Biotech', 'Healthtech', 'Medtech', 'Mobility', 'Robo & Drone', 'Other');
															foreach ($countryList as $value) {
																$selected = '';
																if ($_SESSION['sess_sector'] == $value) {
																	$selected = 'selected="selected"';
																}
																echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
															}
															?>
														</select>
													</div>
												</div>
												<div class="form-group" id="other-div" style="display:none;">
													<label class="col-md-3 control-label">Specify Other Sector<span class="required"> * </span></label>
													<div class="col-md-6">
														<input type="text" class="form-control" name="exhi_profile-other" id="exhi_profile-other" />
													</div>
												</div>
											<?php } else { ?>
												<div class="form-group">
													<label class="col-md-3 control-label">Association Name </label>
													<div class="col-md-6">
														<?php echo $assoc_nm; ?>
													</div>
												</div>
											<?php } ?>
											<input type="hidden" value="<?php echo $assoc_nm; ?>" name="assoc_nm" />
										<?php } ?>
										<div class="form-group">
											<label class="control-label col-md-3"> Select Category <span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<select id="category" name="category" class="form-control" required="required">
													<option value="">-- Select Category --</option>
													<?php $cataList = array('Exhibitor' => 'Exhibitor', 'Sponsor' => 'Sponsor'); //, 'Startup'=>'Startup');
													//$countryList = array('Information Technology'=>'Information Technology');
													foreach ($cataList as $key => $value) {
														$selected = '';
														if (isset($_SESSION['sess_category']) && $key == $_SESSION['sess_category']) {
															$selected = 'selected="selected"';
														}
														echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Name of the Exhibitor <span style="font-size:10px;">&nbsp;<br />(Organisation Name)</span><span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input class="form-control" name="exhi_name" type="text" id="exhi_name" maxlength="100" value="<?php echo $_SESSION['sess_exhi_name'];  ?>" required="required" />
											</div>
										</div>
										<?php if (!empty($assoc_nm) && $assoc_nm == $ASSOC_NAME_EXHIBITOR) { ?>
											<input type="hidden" value="Shell" id="booth_space" name="booth_space" />
										<?php } else { ?>
											<div class="form-group">
												<label class="control-label col-md-3"> Select Booth Space <span class="required"> * </span>
												</label>
												<div class="col-md-6">
													<select id="booth_space" name="booth_space" class="form-control" required="required">
														<option value="">-- Select Booth Space --</option>
														<?php $cataList = array('Raw' => 'Raw', 'Shell' => 'Shell');
														//$countryList = array('Information Technology'=>'Information Technology');
														foreach ($cataList as $key => $value) {
															$selected = '';
															if (isset($_SESSION['sess_booth_booth_space']) && $key == $_SESSION['sess_booth_booth_space']) {
																$selected = 'selected="selected"';
															}
															echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
														}
														?>
													</select>
												</div>
											</div>
										<?php } ?>
										<div class="form-group">
											<label class="col-md-3 control-label">Enter Area in sqm <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<?php if (!empty($assoc_nm)) { ?>
													<select id="booth_area" name="booth_area" class="form-control" required="required">
														<option value="">-- Select Booth Area --</option>
														<?php $cataList = array(6);
														if ($assoc_nm == $ASSOC_NAME_EXHIBITOR) {
															$cataList = array(4, 6);
														}
														if ($assoc_nm == 'VoICE Consortium Pavilion') {
															$cataList = array(9);
														}
														foreach ($cataList as $value) {
															$selected = '';
															if (isset($_SESSION['sess_booth_area']) && $value == $_SESSION['sess_booth_area']) {
																$selected = 'selected="selected"';
															}
															echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
														}
														?>
													</select>
													<input name="booth_area_unit" type="hidden" id="booth_area_unit" value="sqm">
												<?php } else { ?>
													<input class="form-control" name="booth_area" type="number" id="booth_area" maxlength="100" value="<?php echo $_SESSION['sess_booth_area']; ?>" required="required" onkeyup="check_num(event, 'booth_area');" />
													<input name="booth_area_unit" type="hidden" id="booth_area_unit" value="sqm">
												<?php /*<select id="booth_area" name="booth_area" class="form-control" required="required">
												<option value="">-- Select Booth Area --</option>
												<?php $cataList = array(9,18,27,36,60,72,100,200);
														foreach ($cataList as $value) {
															$selected = '';
															if(isset($_SESSION['sess_booth_area']) && $value==$_SESSION['sess_booth_area']) {
																$selected = 'selected="selected"';
															}
															echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>'; 
														}
													?>
											<?php */ } ?>
											</div>
										</div>
										<?php /*<div class="form-group">
										<label class="col-md-3 control-label">Name for Fascia <span style="font-size:10px;">&nbsp;(written on Stall)</span><span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input class="form-control" name="fascia_name" type="text" id="fascia_name" maxlength="249" value="<?php echo $_SESSION['sess_fascia_name']; ?>" required="required" onkeyup="check_char(event,'fascia_name');" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Name <span class="dips-required"> * </span></label>
										<div class="col-md-2">
											<select class="form-control" name="cp_title" id="cp_title" required="required">
												<option value="">-Title-</option>
												<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
													foreach ($titleList as $title) {
														$selected = '';
														if(@$_SESSION['sess_cp_title'] == $title){
															$selected = 'selected="selected"';
														}
														echo '<option value="' . $title . '" ' . $selected . '>' . $title . '</option>';
													}
													?>
											</select>
										</div>
										<div class="col-md-2"><input type="text" class="form-control" placeholder="First Name" name="cp_fname"  id="cp_fname" maxlength="100" value="<?php if(isset($_SESSION['sess_cp_fname'])) { echo $_SESSION['sess_cp_fname']; } ?>" required="required" onkeyup="check_char(event,'cp_fname');"></div>
										<div class="col-md-2"><input type="text" class="form-control" placeholder="Last Name" name="cp_lname" id="cp_lname" maxlength="100" value="<?php if(isset($_SESSION['sess_cp_lname'])) { echo $_SESSION['sess_cp_lname']; } ?>" required="required" onkeyup="check_char(event,'cp_lname');"></div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Designation <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="desig" id="desig" value="<?php echo $_SESSION['sess_desig']; ?>" required="required" />
										</div>
									</div>*/ ?>
										<div class="form-group">
											<label class="col-md-3 control-label">Organisation Address 1<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<textarea name="addr1" id="addr1" rows="" cols="" required="required" class="form-control" maxlength="150"><?php echo $_SESSION['sess_addr1']; ?></textarea>
												<span class="help-block"><span id="limit-char1">Character count 0/150</span></span>
											</div>
										</div>
										<?php /*<div class="form-group">
										<label class="col-md-3 control-label">Address 2</label>
										<div class="col-md-6">
											<textarea name="addr2" id="addr2" rows="" cols="" class="form-control"><?php echo $_SESSION['sess_addr2']; ?></textarea>
										</div>
									</div>*/ ?>
										<div class="form-group">
											<label class="control-label col-md-3">City<span class="dips-required"> * </span></label>
											<div class="col-md-3">
												<input type="text" class="form-control" name="city" id="city" value="<?php echo $_SESSION['sess_city']; ?>" onkeyup="check_char(event,'city');" required="required" />
											</div>
											<div class="col-md-1 col-md-offset-14" style="margin-top: 8px;">State<span class="dips-required"> * </span></div>
											<div class="col-md-2"><input type="text" class="form-control" name="state" id="state" value="<?php echo $_SESSION['sess_state']; ?>" required="required" onkeyup="check_char(event,'state');" /></div>
										</div>

										<div class="form-group">
											<label class="control-label col-md-3">Country<span class="dips-required"> * </span></label>
											<div class="col-md-3">
												<select id="country" name="country" class="form-control" required>
													<option value="">-- Select Country --</option>
													<?php $countryList = array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "AmericanSamoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "BosniaandHerzegowina", "BW" => "Botswana", "BV" => "BouvetIsland", "BR" => "Brazil", "IO" => "BritishIndianOceanTerritory", "BN" => "BruneiDarussalam", "BG" => "Bulgaria", "BF" => "BurkinaFaso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "CapeVerde", "KY" => "CaymanIslands", "CF" => "CentralAfricanRepublic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "ChristmasIsland", "CC" => "Cocos(Keeling)Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo,theDemocraticRepublicofthe", "CK" => "CookIslands", "CR" => "CostaRica", "CI" => "Coted'Ivoire", "HR" => "Croatia(Hrvatska)", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "CzechRepublic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "DominicanRepublic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "ElSalvador", "GQ" => "EquatorialGuinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "FalklandIslands(Malvinas)", "FO" => "FaroeIslands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "FrenchGuiana", "PF" => "FrenchPolynesia", "TF" => "FrenchSouthernTerritories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "HeardandMcDonaldIslands", "VA" => "HolySee(VaticanCityState)", "HN" => "Honduras", "HK" => "HongKong", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran(IslamicRepublicof)", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KP" => "Korea,DemocraticPeople'sRepublicof", "KR" => "Korea,Republicof", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "LaoPeople'sDemocraticRepublic", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "LibyanArabJamahiriya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau", "MK" => "Macedonia,TheFormerYugoslavRepublicof", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "MarshallIslands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia,FederatedStatesof", "MD" => "Moldova,Republicof", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "NetherlandsAntilles", "NC" => "NewCaledonia", "NZ" => "NewZealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "NorfolkIsland", "MP" => "NorthernMarianaIslands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PA" => "Panama", "PG" => "PapuaNewGuinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PT" => "Portugal", "PR" => "PuertoRico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "RussianFederation", "RW" => "Rwanda", "KN" => "SaintKittsandNevis", "LC" => "SaintLUCIA", "VC" => "SaintVincentandtheGrenadines", "WS" => "Samoa", "SM" => "SanMarino", "ST" => "SaoTomeandPrincipe", "SA" => "SaudiArabia", "SN" => "Senegal", "SC" => "Seychelles", "SL" => "SierraLeone", "SG" => "Singapore", "SK" => "Slovakia(SlovakRepublic)", "SI" => "Slovenia", "SB" => "SolomonIslands", "SO" => "Somalia", "ZA" => "SouthAfrica", "GS" => "SouthGeorgiaandtheSouthSandwichIslands", "ES" => "Spain", "LK" => "SriLanka", "SH" => "St.Helena", "PM" => "St.PierreandMiquelon", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "SvalbardandJanMayenIslands", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "SyrianArabRepublic", "TW" => "Taiwan,ProvinceofChina", "TJ" => "Tajikistan", "TZ" => "Tanzania,UnitedRepublicof", "TH" => "Thailand", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "TrinidadandTobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "TurksandCaicosIslands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "UnitedArabEmirates", "GB" => "UnitedKingdom", "US" => "UnitedStates", "UM" => "UnitedStatesMinorOutlyingIslands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "VietNam", "VG" => "VirginIslands(British)", "VI" => "VirginIslands(U.S.)", "WF" => "WallisandFutunaIslands", "EH" => "WesternSahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");
													if (empty($_SESSION['sess_country'])) {
														$_SESSION['sess_country'] = 'India';
													}
													foreach ($countryList as $country) {
														$selected = '';
														if ($_SESSION['sess_country'] == $country) {
															$selected = 'selected=selected';
														}
														echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>';
													}
													?>
												</select>
											</div>
											<div class="col-md-1 col-md-offset-15" style="font-size: 12px; margin-top: 8px;">Zip Code<span class="dips-required">*</span></div>
											<div class="col-md-2"><input type="text" class="form-control" name="zip" id="zip" value="<?php echo $_SESSION['sess_zip']; ?>" required="required" maxlength="10" /></div>
										</div>
										<?php /*<div class="form-group">
										<label class="col-md-3 control-label">Email Address <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="email" class="form-control" name="email" id="email" value="<?php echo $_SESSION['sess_email']; ?>" required="required"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mobile Number<span class="dips-required"> * </span></label>
										<div class="col-md-6" style="margin-top: -15px;">
											<span type="tel" id="mobile-country-code" data-fax-iso-code-hidden-field-name="cellnoCountryCode" class="hide"></span>
											<input type="hidden" name="cellnoCountryCode" id="cellnoCountryCode" value="<?php echo @$_SESSION['sess_mob_cntry'];?>"/>
											<input type="hidden" id="cellnoCountryCodeIso" name="cellnoCountryCodeIso"/>
											<input name="mob" type="text" id="mob" class="form-control" maxlength="10" value="<?php echo @$_SESSION['sess_mob'];?>" required onkeyup="check_num(event, 'mob');" style="padding-left: 92px;"/>
											<span class="help-block">+Country Code-Mobile Number(xxx-xxxxxxxxxx)</span>
										</div>
									</div>*/ ?>
										<div class="form-group">
											<label class="col-md-3 control-label">Telephone Number</label>
											<div class="col-md-6" style="margin-top: -15px;">
												<span type="tel" id="telCountryIsoCode" data-fax-iso-code-hidden-field-name="foneCountryCode"></span>
												<input type="hidden" name="foneCountryCode" id="foneCountryCode" value="<?php echo @$_SESSION['sess_fon_cntry']; ?>" />
												<input type="hidden" id="foneCountryCodeIso" name="foneCountryCodeIso" />
												<input name="fon" type="text" id="fon" class="form-control" maxlength="20" value="<?php echo @$_SESSION['sess_fon']; ?>" onkeyup="check_num(event, 'fon');" style="padding-left: 92px;" />
												<span class="help-block">+Country Code-Area Code-Phone Number(Eg. 91-123412345)</span>
											</div>
										</div>
										<?php /*<div class="form-group">
										<label class="col-md-3 control-label">Fax Number</label>
										<div class="col-md-6" style="margin-top: -15px;">
											<span type="tel" id="faxCountryIsoCode" data-fax-iso-code-hidden-field-name="faxCountryCode"></span>
											<?php $fax = explode('-', $_SESSION['sess_fax']);?>
											<input type="hidden" name="faxCountryCode" id="faxCountryCode"  value="<?php echo @$_SESSION['sess_fax_cntry'];?>"/>
											<input type="hidden" id="faxCountryCodeIso" name="faxCountryCodeIso"/>
											<input name="fax" type="text" id="fax" class="form-control" maxlength="20"  value="<?php echo @$_SESSION['sess_fax'];?>" onkeyup="check_num(event, 'fax');" style="padding-left: 92px;"/>
											<span class="help-block">+Country Code-Area Code-Phone Number(Eg. 91-123412345)</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Website <span class="required"> * </span></label>
										<div class="col-md-6">
											<div class="input-group">
												<span class="input-group-addon">http://</span>
												<input type="text" class="form-control" name="website" id="website" value="<?php echo $_SESSION['sess_website'];?>" required="required"/>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Exhibitor Sector <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<select id="exhi_profile" name="exhi_profile[]" class="form-control" required multiple="multiple">
												<?php $countryList = array('OEMs - Bus & Car manufacturers (ICE and Electric)','Maxi Cab & Tourist Cab Manufacturer','Bus & Coach Builders','Parts & Components','Electronics & systems','Repairs & Maintenance','Accessories & Customizing','Tyres & Tubes','Services','Research, Education, Skill Development and Training','Tourism','STUs and Municipal Transport Corporations','Fuel','Aggregators','Leading Bus & Car Operators','Electric Mobility Showcase');
													$exhiProfile = explode(',', $_SESSION['sess_exhi_profile']);
													foreach ($countryList as $country) {
														$selected = '';
														foreach ($exhiProfile as $profile) {
															if($profile == $country) {
																$selected = 'selected=selected';
																break;
															}
														}
														echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>'; 
													}
													?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Organisation Logo<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<div class="input-group">
												<label class="input-group-btn">
													<span class="btn btn-primary">
														Choose Image&hellip; <input type="file" name="logo" id="logo" required="required" class="hide"/>
													</span>
												</label>
												<input type="text" class="form-control" readonly>
											</div>
											<span class="help-block">Image Dimesion should be: 200px(width)x125px(height) & image size less than 100kb. Image format should be JPG, JPEG, PNG & GIF only.</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Keywords<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="keywords" id="keywords" value="<?php echo $_SESSION['sess_keywords'];?>" required="required"/>
											<span class="help-block">Add comma separated keywords. Using this keywords user will easily to search your organisation.</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Organisation Profile <span class="required"> * </span></label>
										<div class="col-md-6">
											<textarea rows="9" cols="" class="form-control exbhi_profile" name="exbhi_profile" id="exbhi_profile"><?php echo $_SESSION['sess_exbhi_profile']; ?></textarea>
											<span class="help-block"><span id="limit-char">Character count 0/750</span></span>
										</div>
									</div>*/ ?>
										<div class="form-group">
											<div class="col-md-6 col-md-offset-3">
												<div class="note note-success">
													<?php /*<p> If you have any issue with exhibitor complimentary delegate, please contact our executive<br />
													</span>Name:  <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_COMP_CONTACT_PERSON_NAME;?><br />
													Email: <a href="mailto:<?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_COMP_CONTACT_PERSON_EMAIL;?>"><?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_COMP_CONTACT_PERSON_EMAIL;?> </a><br />
													Mobile:<?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_COMP_CONTACT_PERSON_MOBILE_NO;?><br />
													<!-- Phone: <?php echo $EVENT_DB_FORM_DELEGATE_PERSON_PHONE_NO;?> <br/> --><br/> 
												</p>
												<?php /*<p>	If you have any issue with exhibitor complimentary delegate, please contact our executive <br />
													</span>Name: <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_NAME;?><br />
													Email: <a href="mailto:<?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_EMAIL;?>"><?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_EMAIL;?></a><br />
													Mobile: <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_MOBILE_NO;?><br />
													Phone: <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_PHONE_NO;?><br/><br/>
												</p>*/ ?>
													<p> If you have any technical problem, please contact our executive <br />
														</span>Name: <?php echo $EVENT_DB_FORM_TECHNICAL_PERSON_NAME; ?><br />
														Email: <a href="mailto:<?php echo $EVENT_DB_FORM_TECHNICAL_PERSON_EMAIL; ?>"> <?php echo $EVENT_DB_FORM_TECHNICAL_PERSON_EMAIL; ?> </a><br />
														<!-- Mobile:  <?php echo $EVENT_DB_FORM_TECHNICAL_PERSON_MOBILE_NO; ?> <br />
													Phone: <?php echo $EVENT_DB_FORM_TECHNICAL_PERSON_PHONE_NO; ?> -->
													</p>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<div class="input-group">
													<input name="vercode_ex" type="text" class="form-control" id="vercode_ex" maxlength="10" required autocomplete="off" />
													<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_ex"]; ?>" />
													<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $text; ?></span>
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
					<h1>Online Exhibitors Directory Registrations for <?php echo $EVENT_NAME . ' ' . $EVENT_YEAR; ?> is closed.</h1>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/reg_form_footer.php'; ?>
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script src="assets/global/plugins/tiny_mce/tiny_mce.js"></script>
<script src="js/bootstrap-multiselect.js"></script>
<?php if (!empty($assoc_nm) && $assoc_nm == $ASSOC_NAME_EXHIBITOR) { ?>
	<script src="js/exhibitor-startup-stall.js"></script>
<?php } else { ?>
	<script src="js/exhibitor-stall.js"></script>
<?php } ?>
<script>
	jQuery(document).ready(function() {
		Registration.init('registration_form_1', 0);

		<?php if (!empty($_SESSION['foneCountryIso'])) { ?>
			$("#telCountryIsoCode").intlTelInput({
				preferredCountries: ["<?php echo $_SESSION['foneCountryIso']; ?>"]
			});
		<?php } else { ?>
			$("#telCountryIsoCode").intlTelInput();
		<?php } ?>

		<?php /*if(!empty($_SESSION['faxCountryIso'])) { ?>
			$("#faxCountryIsoCode").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['faxCountryIso'];?>" ]});
		<?php } else {?>
			$("#faxCountryIsoCode").intlTelInput();
		<?php }?>
		
		 <?php if(!empty($_SESSION['cellnoCountryCodeIso'])) { ?>
		 	$("#mobile-country-code").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['cellnoCountryCodeIso'];?>" ]});
		 <?php } else {?>
			 $("#mobile-country-code").intlTelInput();
		 <?php } */ ?>

		$(window).load(function() {
			//profileTextCount();
		});

		/*$('#exhi_profile').multiselect({
            includeSelectAllOption: true,
            buttonWidth: 250,
            enableFiltering: true,
			enableCaseInsensitiveFiltering:true,
        });*/
	});

	function sectorChanged() {
		if ($('#exhi_profile').val() == 'Other') {
			$('#exhi_profile-other').val('');
			//action taken here if true
			$('#other-div').show();
			$('#exhi_profile-other').attr('required', 'required');
		} else {
			$('#other-div').hide();
			$('#exhi_profile-other').val('');
			$('#exhi_profile-other').removeAttr('required');
		}
	}

	$(function() {
		$('#addr1').keyup(function(e) {
			var tval = $('#addr1').val(),
				tlength = tval.length,
				set = 151,
				remain = parseInt(set - tlength);
			var htmlcount = "Character Count: " + tlength + "/150";
			$('#limit-char1').text(htmlcount);
			if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
				$('#addr1').val((tval).substring(0, tlength - 1))
			}
		});

		/*// We can attach the `fileselect` event to all file inputs on the page
	  $(document).on('change', ':file', function() {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	  });

	  // We can watch for our custom `fileselect` event like this
	  $(document).ready( function() {
		  $(':file').on('fileselect', function(event, numFiles, label) {
			  var input = $(this).parents('.input-group').find(':text'),
				  log = numFiles > 1 ? numFiles + ' files selected' : label;

			  if( input.length ) {
				  input.val(log);
			  } else {
				  if( log ) alert(log);
			  }
		  });
	  });*/
	});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
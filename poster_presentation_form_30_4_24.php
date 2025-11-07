<?php
echo "<script language='javascript'>document.location='enquiry.php';</script>";
exit;
require "includes/form_constants_both.php";
$ret = @$_GET['ret'];

if ($ret == "retds4fu324rn_ed24d3it") {
	session_start();
	if ((!isset($_SESSION["vercode_pstr"])) || ($_SESSION["vercode_pstr"] == '')) {
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
		echo "<script language='javascript'>window.location=('poster_presentation_form.php');</script>";
		echo "<script language='javascript'>document.location=('poster_presentation_form.php');</script>";
		exit;
	}
	require "dbcon_open.php";

	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $PSTR_TBL_NAME_DEMO . " WHERE reg_id = '" . $_SESSION["vercode_pstr"] . "'");
	$res = $qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
} else {
	require "poster_captcha.php";
}
$pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />';
require 'includes/reg_form_header.php';
?>
<style>
	.selected-flag {
		margin-top: -7px;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="enq_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Poster (RESEARCH PAPER) Submission Form </span>
				</div>
			</div>
			<div class="portlet-body form">
				<?php if (date('Y-m-d H:i') <= $PSTR_LAST_DATE_OF_SUB1) { ?>
					<form action="poster_presentation_form2.php?ret=<?php echo $ret; ?>" class="form-horizontal" enctype="multipart/form-data" name="form1" id="form1" method="post" onsubmit="return validate_poster_form();">
						<div class="form-wizard">
							<div class="form-body">
								<ul class="nav nav-pills nav-justified steps">
									<li class="active">
										<a class="step">
											<span class="number"> 1 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Poster Info </span>
										</a>
									</li>
									<li>
										<a data-toggle="tab" class="step dips-default-cursor">
											<span class="number"> 2 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Preview </span>
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
											<label class="control-label col-md-3"> Select Sector <span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<select id="sector" name="sector" class="form-control" required="required">
													<option value="">-- Select Sector --</option>
													<?php $countryList = array('BioInstrumentation/Diagnostics', 'Nano-Biotechnology/Nanotoxicology', 'Bio Energy And Bio Fuels', 'Medical Technology', 'Bio Pharmaceutical', 'Drug Discovery And Diet', 'Agri-Biotechnology', 'Nano Biotechnology & Healthcare.', 'Environment And Sustainable Development', 'Healthcare Biotech', 'NEUROSCIENCE AND ENVIRONMENTA', 'BioInformatics', 'Food Biotechnology', 'Other'); //,'Others'=>'Others');
													//$countryList = array('Information Technology'=>'Information Technology');
													foreach ($countryList as $value) {
														$selected = '';
														if (isset($qr_gt_user_data_ans_row['sector']) && $qr_gt_user_data_ans_row['sector'] == $value)
															$selected = 'selected="selected"';
														echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group form-md-radios">
											<label class="control-label col-md-3">Nationality <span class="required"> * </span> </label>
											<div class="col-md-9">
												<div class="md-radio-inline">
													<div class="md-radio">
														<input type="radio" id="Indian" name="curr" class="md-radiobtn" value="Indian" onclick="show_cata();" checked="checked" required="required">
														<label for="Indian">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Indian
														</label>
													</div>
													<div class="md-radio">
														<input type="radio" id="Foreign" name="curr" class="md-radiobtn" value="International" onclick="show_cata();" required="required">
														<label for="Foreign">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> International
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-1"></label>
											<div class="col-md-9">
												<table class="table table-hover1 table-bordered teriff-table col-md-offset-1 col-md-7 main-tariff-table">
													<thead>
														<tr bgcolor="#2fa0dd" style="color: #fff;">
															<th colspan="6" style="text-align: center;">Poster Tariff</th>
														</tr>
														<tr bgcolor="#2fa0dd" style="color: #fff;">
															<th class="align-td">Nationality</th>
															<th class="align-td">Amount</th>
														</tr>
													</thead>
													<tbody>
														<tr class="indian-tariff" style="background-color: #e1e1e1;">
															<td class="align-td">Indian</td>
															<td class="align-td">INR 2500</td>
														</tr>
														<tr class="international-tariff" style="background-color: #e1e1e1;">
															<td class="align-td">International</td>
															<td colspan="1" class="align-td">USD 100</td>
														</tr>
														<tr>
															<td colspan="10">
																<strong>Note : </strong><br />
																- * 18% GST is applicable.<br /><br />
																<strong>Entitlements</strong><br />
																
																&bull; Live chat facility with Delegates / Visitors<br />
																&bull; One Conference Delegate Registration to access Inaugural, Keynote, all Technical Sessions Awards, Quiz Competition, Exhibition etc.<br />
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Title of Paper <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input class="form-control" name="title" type="text" id="title" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['poster_title']; ?>" />
											</div>
										</div>
										<h4 class="block">Please enter details of Lead Author </h4>
										<div class="form-group">
											<label class="col-md-3 control-label">Name of Lead Author <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input class="form-control" name="lead_name" type="text" id="lead_name" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['lead_name']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Email Address <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input class="form-control" name="lead_email" type="email" id="lead_email" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['lead_email']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">College Name/Organisation Name<span class="dips-required">* </span></label>
											<div class="col-md-6">
												<input class="form-control" name="lead_org" type="text" id="lead_org" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['lead_org']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Phone Number <span class="dips-required"> * </span></label>
											<div class="col-md-1" style="margin-top: -20px;">
												<span type="tel" id="phone_lead_ccode" data-fax-iso-code-hidden-field-name="lead_ccode"></span>
												<input type="hidden" name="lead_ccode" id="lead_ccode" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['lead_ccode']; ?>" />
												<input type="hidden" id="lead_ccodeCountryCodeIso" name="lead_ccodeCountryCodeIso" />
												<span class="form-control" style="width: 138%; "></span>
											</div>
											<div class="col-md-2" style="margin-top: 0px;">
												<input class="form-control" name="lead_acode" type="text" id="lead_acode" maxlength="10" onkeyup="check_num(event, 'lead_acode');" placeholder="Area Code" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['lead_acode']; ?>" />
											</div>
											<div class="col-md-3" style="margin-top: 0px;">
												<input class="form-control" name="lead_phone" type="text" id="lead_phone" maxlength="10" onkeyup="check_num(event, 'lead_phone');" placeholder="Phone Number" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['lead_phone']; ?>" />
											</div>
										</div>
										<?php if (isset($qr_gt_user_data_ans_row['poster_title']))
											$lead_mobs = explode('-', $qr_gt_user_data_ans_row['lead_mob']); ?>
										<div class="form-group">
											<label class="col-md-3 control-label">Mobile Number <span class="dips-required"> * </span></label>
											<div class="col-md-6" style="margin-top: -20px;">
												<span type="tel" id="lead_mobcountry-code" data-fax-iso-code-hidden-field-name="lead_mobCountryCode"></span>
												<input type="hidden" name="lead_mobCountryCode" id="lead_mobCountryCode" value="<?php if (isset($lead_mobs[0])) echo $lead_mobs[0]; ?>" />
												<input type="hidden" id="lead_mobCountryCodeIso" name="lead_mobCountryCodeIso" />
												<input class="form-control" name="lead_mob" type="text" id="lead_mob" maxlength="10" onkeyup="check_num(event, 'lead_mob');" required="required" value="<?php if (isset($lead_mobs[1])) echo $lead_mobs[1]; ?>" style="padding-left: 92px;" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Address<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<textarea name="lead_addr" id="lead_addr" rows="" cols="" required="required" class="form-control"><?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['lead_addr']; ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">City<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="lead_city" id="lead_city" onkeyup="check_char(event,'lead_city')" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['lead_city']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">State<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="lead_state" id="lead_state" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['lead_state']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3"> Country <span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<select name="lead_country" class="form-control" id="lead_country" required="required">
													<option value="">Select Country </option>
													<?php $countryList = array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "AmericanSamoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "BosniaandHerzegowina", "BW" => "Botswana", "BV" => "BouvetIsland", "BR" => "Brazil", "IO" => "BritishIndianOceanTerritory", "BN" => "BruneiDarussalam", "BG" => "Bulgaria", "BF" => "BurkinaFaso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "CapeVerde", "KY" => "CaymanIslands", "CF" => "CentralAfricanRepublic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "ChristmasIsland", "CC" => "Cocos(Keeling)Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo,theDemocraticRepublicofthe", "CK" => "CookIslands", "CR" => "CostaRica", "CI" => "Coted'Ivoire", "HR" => "Croatia(Hrvatska)", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "CzechRepublic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "DominicanRepublic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "ElSalvador", "GQ" => "EquatorialGuinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "FalklandIslands(Malvinas)", "FO" => "FaroeIslands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "FrenchGuiana", "PF" => "FrenchPolynesia", "TF" => "FrenchSouthernTerritories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "HeardandMcDonaldIslands", "VA" => "HolySee(VaticanCityState)", "HN" => "Honduras", "HK" => "HongKong", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran(IslamicRepublicof)", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KP" => "Korea,DemocraticPeople'sRepublicof", "KR" => "Korea,Republicof", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "LaoPeople'sDemocraticRepublic", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "LibyanArabJamahiriya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau", "MK" => "Macedonia,TheFormerYugoslavRepublicof", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "MarshallIslands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia,FederatedStatesof", "MD" => "Moldova,Republicof", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "NetherlandsAntilles", "NC" => "NewCaledonia", "NZ" => "NewZealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "NorfolkIsland", "MP" => "NorthernMarianaIslands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PA" => "Panama", "PG" => "PapuaNewGuinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PT" => "Portugal", "PR" => "PuertoRico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "RussianFederation", "RW" => "Rwanda", "KN" => "SaintKittsandNevis", "LC" => "SaintLUCIA", "VC" => "SaintVincentandtheGrenadines", "WS" => "Samoa", "SM" => "SanMarino", "ST" => "SaoTomeandPrincipe", "SA" => "SaudiArabia", "SN" => "Senegal", "SC" => "Seychelles", "SL" => "SierraLeone", "SG" => "Singapore", "SK" => "Slovakia(SlovakRepublic)", "SI" => "Slovenia", "SB" => "SolomonIslands", "SO" => "Somalia", "ZA" => "SouthAfrica", "GS" => "SouthGeorgiaandtheSouthSandwichIslands", "ES" => "Spain", "LK" => "SriLanka", "SH" => "St.Helena", "PM" => "St.PierreandMiquelon", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "SvalbardandJanMayenIslands", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "SyrianArabRepublic", "TW" => "Taiwan,ProvinceofChina", "TJ" => "Tajikistan", "TZ" => "Tanzania,UnitedRepublicof", "TH" => "Thailand", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "TrinidadandTobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "TurksandCaicosIslands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "UnitedArabEmirates", "GB" => "UnitedKingdom", "US" => "UnitedStates", "UM" => "UnitedStatesMinorOutlyingIslands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "VietNam", "VG" => "VirginIslands(British)", "VI" => "VirginIslands(U.S.)", "WF" => "WallisandFutunaIslands", "EH" => "WesternSahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");
													if (empty($qr_gt_user_data_ans_row['country'])) {
														$qr_gt_user_data_ans_row['country'] = 'India';
													}
													foreach ($countryList as $country) {
														$selected = '';
														if ($qr_gt_user_data_ans_row['lead_country'] == $country) {
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
												<input type="text" class="form-control" name="lead_zip" id="lead_zip" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['lead_zip']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-7 col-md-offset-2">
												<div class="well">
													<div class="md-checkbox-inline">
														<div class="md-checkbox">
															<input type="checkbox" class="md-check" name="lead_presenter_same" id="lead_presenter_same" value="lead_presenter_same" onclick="cpy_lead_auth();">
															<label for="lead_presenter_same">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> Please click here if "Poster Presenter" details are same as "Lead Author".
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										<h4 class="block">Please enter details of Poster Presenter </h4>
										<div class="form-group">
											<label class="col-md-3 control-label">Name of Poster Presenter <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input class="form-control" name="pp_name" type="text" id="pp_name" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['pp_name']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Email Address <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input class="form-control" name="pp_email" type="email" id="pp_email" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['pp_email']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">College Name/Organisation Name<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input class="form-control" name="pp_org" type="text" id="pp_org" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['pp_org']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Website </label>
											<div class="col-md-6">
												<div class="input-group">
													<span class="input-group-addon">http://</span>
													<input class="form-control" name="pp_website" type="text" id="pp_website" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['pp_website']; ?>" />
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Phone Number <span class="dips-required"> * </span></label>
											<div class="col-md-1" style="margin-top: -20px;">
												<span type="tel" id="phone_pp_ccode" data-fax-iso-code-hidden-field-name="pp_ccode"></span>
												<input type="hidden" name="pp_ccode" id="pp_ccode" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['pp_ccode']; ?>" />
												<input type="hidden" id="pp_ccodeCountryCodeIso" name="pp_ccodeCountryCodeIso" />
												<span class="form-control" style="width: 138%; "></span>
											</div>
											<div class="col-md-2" style="margin-top: 0px;">
												<input class="form-control" name="pp_acode" type="text" id="pp_acode" maxlength="10" onkeyup="check_num(event, 'pp_acode');" placeholder="Area Code" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['pp_ccode']; ?>" />
											</div>
											<div class="col-md-3" style="margin-top: 0px;">
												<input class="form-control" name="pp_phone" type="text" id="pp_phone" maxlength="10" onkeyup="check_num(event, 'pp_phone');" placeholder="Phone Number" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['pp_phone']; ?>" />
											</div>
										</div>
										<?php if (isset($qr_gt_user_data_ans_row['poster_title']))
											$lead_mobs1 = explode('-', $qr_gt_user_data_ans_row['pp_mob']); ?>
										<div class="form-group">
											<label class="col-md-3 control-label">Mobile Number </label>
											<div class="col-md-6" style="margin-top: -20px;">
												<span type="tel" id="pp_mobcountry-code" data-fax-iso-code-hidden-field-name="pp_mobCountryCode"></span>
												<input type="hidden" name="pp_mobCountryCode" id="pp_mobCountryCode" value="<?php if (isset($lead_mobs1[0])) echo $lead_mobs1[0]; ?>" />
												<input type="hidden" id="lead_mobCountryCodeIso" name="lead_mobCountryCodeIso" />
												<input class="form-control" name="pp_mob" type="text" id="pp_mob" maxlength="10" onkeyup="check_num(event, 'pp_mob');" required="required" value="<?php if (isset($lead_mobs1[1])) echo $lead_mobs1[1]; ?>" style="padding-left: 92px;" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Address<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<textarea name="pp_addr" id="pp_addr" rows="" cols="" required="required" class="form-control"><?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['pp_addr']; ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">City<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="pp_city" id="pp_city" onkeyup="check_char(event,'pp_city')" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['pp_city']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">State<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="pp_state" id="pp_state" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['pp_state']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3"> Country <span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<select name="pp_country" class="form-control" id="pp_country" required="required">
													<option value="">Select Country </option>
													<?php $countryList = array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "AmericanSamoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "BosniaandHerzegowina", "BW" => "Botswana", "BV" => "BouvetIsland", "BR" => "Brazil", "IO" => "BritishIndianOceanTerritory", "BN" => "BruneiDarussalam", "BG" => "Bulgaria", "BF" => "BurkinaFaso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "CapeVerde", "KY" => "CaymanIslands", "CF" => "CentralAfricanRepublic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "ChristmasIsland", "CC" => "Cocos(Keeling)Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo,theDemocraticRepublicofthe", "CK" => "CookIslands", "CR" => "CostaRica", "CI" => "Coted'Ivoire", "HR" => "Croatia(Hrvatska)", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "CzechRepublic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "DominicanRepublic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "ElSalvador", "GQ" => "EquatorialGuinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "FalklandIslands(Malvinas)", "FO" => "FaroeIslands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "FrenchGuiana", "PF" => "FrenchPolynesia", "TF" => "FrenchSouthernTerritories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "HeardandMcDonaldIslands", "VA" => "HolySee(VaticanCityState)", "HN" => "Honduras", "HK" => "HongKong", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran(IslamicRepublicof)", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KP" => "Korea,DemocraticPeople'sRepublicof", "KR" => "Korea,Republicof", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "LaoPeople'sDemocraticRepublic", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "LibyanArabJamahiriya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau", "MK" => "Macedonia,TheFormerYugoslavRepublicof", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "MarshallIslands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia,FederatedStatesof", "MD" => "Moldova,Republicof", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "NetherlandsAntilles", "NC" => "NewCaledonia", "NZ" => "NewZealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "NorfolkIsland", "MP" => "NorthernMarianaIslands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PA" => "Panama", "PG" => "PapuaNewGuinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PT" => "Portugal", "PR" => "PuertoRico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "RussianFederation", "RW" => "Rwanda", "KN" => "SaintKittsandNevis", "LC" => "SaintLUCIA", "VC" => "SaintVincentandtheGrenadines", "WS" => "Samoa", "SM" => "SanMarino", "ST" => "SaoTomeandPrincipe", "SA" => "SaudiArabia", "SN" => "Senegal", "SC" => "Seychelles", "SL" => "SierraLeone", "SG" => "Singapore", "SK" => "Slovakia(SlovakRepublic)", "SI" => "Slovenia", "SB" => "SolomonIslands", "SO" => "Somalia", "ZA" => "SouthAfrica", "GS" => "SouthGeorgiaandtheSouthSandwichIslands", "ES" => "Spain", "LK" => "SriLanka", "SH" => "St.Helena", "PM" => "St.PierreandMiquelon", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "SvalbardandJanMayenIslands", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "SyrianArabRepublic", "TW" => "Taiwan,ProvinceofChina", "TJ" => "Tajikistan", "TZ" => "Tanzania,UnitedRepublicof", "TH" => "Thailand", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "TrinidadandTobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "TurksandCaicosIslands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "UnitedArabEmirates", "GB" => "UnitedKingdom", "US" => "UnitedStates", "UM" => "UnitedStatesMinorOutlyingIslands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "VietNam", "VG" => "VirginIslands(British)", "VI" => "VirginIslands(U.S.)", "WF" => "WallisandFutunaIslands", "EH" => "WesternSahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");
													if (empty($qr_gt_user_data_ans_row['pp_country'])) {
														$qr_gt_user_data_ans_row['pp_country'] = 'India';
													}
													foreach ($countryList as $country) {
														$selected = '';
														if ($qr_gt_user_data_ans_row['pp_country'] == $country) {
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
												<input type="text" class="form-control" name="pp_zip" id="pp_zip" required="required" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['pp_zip']; ?>" />
											</div>
										</div>
										<h4 class="block">Please enter details of Co-Author(s) </h4>
										<div class="form-group">
											<label class="col-md-3 control-label">1. Co-Author Name </label>
											<div class="col-md-6">
												<input class="form-control" name="co_auth_name_1" type="text" id="co_auth_name_1" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['co_author_1']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">2. Co-Author Name </label>
											<div class="col-md-6">
												<input class="form-control" name="co_auth_name_2" type="text" id="co_auth_name_2" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['co_author_2']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">3. Co-Author Name </label>
											<div class="col-md-6">
												<input class="form-control" name="co_auth_name_3" type="text" id="co_auth_name_3" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['co_author_3']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">4. Co-Author Name </label>
											<div class="col-md-6">
												<input class="form-control" name="co_auth_name_4" type="text" id="co_auth_name_4" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['co_author_4']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-8 col-md-offset-2">
												<div class="well">
													<div class="md-checkbox-inline">
														<div class="md-checkbox">
															<input type="checkbox" id="co_auth_same" name="co_auth_same" class="md-check" onclick="cpy_co_auth_same();">
															<label for="co_auth_same">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> Please click here if "Accompanying Co-Author(s) " details are same as "Co-Author(s)".
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										<h4 class="block">Please enter details of Accompanying Co-Author(s) at event </h4>
										<div class="form-group">
											<label class="col-md-3 control-label">1. Co-Author Name </label>
											<div class="col-md-6">
												<input class="form-control" name="acc_co_auth_name_1" type="text" id="acc_co_auth_name_1" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['accop_co_author_1']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">2. Co-Author Name </label>
											<div class="col-md-6">
												<input class="form-control" name="acc_co_auth_name_2" type="text" id="acc_co_auth_name_2" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['accop_co_author_2']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">3. Co-Author Name </label>
											<div class="col-md-6">
												<input class="form-control" name="acc_co_auth_name_3" type="text" id="acc_co_auth_name_3" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['accop_co_author_3']; ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">4. Co-Author Name </label>
											<div class="col-md-6">
												<input class="form-control" name="acc_co_auth_name_4" type="text" id="acc_co_auth_name_4" value="<?php if (isset($qr_gt_user_data_ans_row['poster_title'])) echo $qr_gt_user_data_ans_row['accop_co_author_4']; ?>" />
											</div>
										</div>
										<div class="form-group form-md-radios" id="nom_gend">
											<label class="control-label col-md-3"> Poster Presentation Theme<span class="required"> </span> </label>
											<div class="col-md-8">
												Breaking Boundaries
												<div class="md-radio-inline" style="display: none;">
													<input type="radio" name="theme" id="theme<?php echo $index; ?>" value="Nanotech for Sustainable Future" checked="checked" />
													<?php //$themeList = array('Energy', 'Advanced Materials Sufrace Treatments and Coatings', 'Devices and Sensors', 'Translational Nano Medicine', 'Scanning Probe Microscopy(SPM)', 'Healthcare, Medicine and Food', 'Agri Nano', 'Other');
													/*$themeList = array('BioPharma', 'AgriTechnology', 'BioEnergy & Bio Fuels', 'Bio Services', 'Bio Informatics', 'Bio Industries', 'Academia', 'Other');
														$index = 1;
														foreach($themeList as $theme) { 
													?>
												<div class="md-radio">
													<input type="radio" name="theme" id="theme<?php echo $index;?>" value="<?php echo $theme;?>" class="md-radiobtn" <?php if($index == 1) {?>checked="checked"<?php }?> onclick="other_div();" required="required">
													<label for="theme<?php echo $index;?>">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> <?php echo $theme;?> </label>
												</div>
												<?php if($theme == 'Other') { ?>
												<span class="col-md-6" id="othr" style="display: none; margin-top: -3%; margin-left: 28%;">
												<input name="othrdiv" id="othrdiv" type="text" class="form-control" placeholder="Specify Other"/>
												</span>
												<?php } if($index % 2 == 0) {echo '<br/>';}$index++;
													}*/ ?>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Abstract / Description of the Session (Limited to: 200 Words / 1 page) <span class="dips-required"> * </span> </label>
											<div class="col-md-6">
												<input type="file" id="sess_abstract" name="sess_abstract">
												<span class="help-block">File size should not exceed 1 MB.</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">CV of Lead Author Contaning Contact details <span class="dips-required"> * </span> </label>
											<div class="col-md-6">
												<input type="file" id="lead_auth_cv" name="lead_auth_cv">
												<span class="help-block">File size should not exceed 1 MB.</span>
											</div>
										</div>
										<div class="form-group form-md-radios" id="pay">
											<label class="control-label col-md-3">Payment Mode <span class="required"> * </span> </label>
											<div class="col-md-9">
												<div class="md-radio-inline">
													<div class="md-radio ">
														<input type="radio" id="cashfree" name="paymode" class="md-radiobtn" value="Cashfree" onclick="showTxt();">
														<label for="cashfree">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Cashfree Payment - Credit Card / Debit Card / Net Banking / Google Pay / PhonePe / Paytm
														</label>
														<span class="help-block indian-tariff">Please Note: <?php echo $CC_IND_PROCESSING_CHARGE_PER; ?>% processing charges is applicable for CCAVenue payment mode.</span>
														<span class="help-block international-tariff">Please Note: <?php echo $CC_INT_PROCESSING_CHARGE_PER; ?>% processing charges is applicable for CCAVenue payment mode.</span>
													</div>
													<div class="md-radio">
														<input type="radio" id="Cc" name="paymode" class="md-radiobtn" value="Credit Card" onclick="showTxt();" checked>
														<label for="Cc">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> CCAvenue Payment - Credit Card / Debit Card / Net Banking / Google Pay / PhonePe / Paytm
														</label>
														<span class="help-block indian-tariff">Please Note: <?php echo $CC_IND_PROCESSING_CHARGE_PER; ?>% processing charges is applicable for CCAVenue payment mode.</span>
														<span class="help-block international-tariff">Please Note: <?php echo $CC_INT_PROCESSING_CHARGE_PER; ?>% processing charges is applicable for CCAVenue payment mode.</span>
													</div>
													&nbsp;&nbsp;
													<div class="md-radio">
														<input type="radio" id="BT" name="paymode" class="md-radiobtn" value="Bank Transfer" onclick="showTxt();">
														<label for="BT">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Bank Transfer<strong>(Offline)</strong> / NEFT / RTGS / IMPS
														</label>
													</div>
													<div class="md-radio international-tariff">
														<input type="radio" id="paypal" name="paymode" class="md-radiobtn" value="Paypal" onclick="showTxt();">
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
										<div class="form-group">
											<label class="control-label col-md-1"></label>
											<div class="col-md-11">
												<table class="table table-striped table-bordered table-hover " id="bank_transfer1" style="display: none;">
													<tbody>
														<tr>
															<td colspan="2">Delegates are requested to Bank Transfer the registration fees to the following account</td>
														</tr>
														<tr>
															<td>Account Name :</td>
															<td style="width: 828px;">MM ACTIV SCI TECH COMMUNICATIONS PVT LTD</td>
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
															<td>Bank Address :</td>
															<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed,Bangalore - 560 052, INDIA.</td>
														</tr>
														<tr>
															<td>Bank IFSC Code :</td>
															<td>CNRB0002827</td>
														</tr>
														<tr>
															<td>MICR Code :</td>
															<td>560015137</td>
														</tr>
														<tr>
															<td>DP Code No:</td>
															<td>2827</td>
														</tr>
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
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<div class="input-group">
													<input name="vercode" type="text" class="form-control" id="vercode" maxlength="10" required autocomplete="off" />
													<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_pstr"]; ?>" />
													<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercode_pstr"]; ?></span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-offset-2 col-md-7">
												<div class="alert alert-info">
													Note:<br />
													<ol>
														<?php /*<li>Registration fees is Non-Refundable.</li>*/ ?>
														<li>Last date of submission is&nbsp;<strong><?php echo $PSTR_LAST_DATE_OF_SUB_HTML; ?></strong></li>
														<?php /*<li>After receiveing an official acceptance email you can pay your fees.</li>*/ ?>
														<li>Documents to be submitted in MS-word Format.</li>
														<li><strong>For any additional information or clarification</strong>,
															<br /> Ms. Prabha Sharon
															<br />Email: <a href="mailto:<?php echo $PSTR_EMAIL_ID_2; ?>"><?php echo $PSTR_EMAIL_ID_2; ?></a> / <a href="mailto:<?php echo $PSTR_EMAIL_ID; ?>"><?php echo $PSTR_EMAIL_ID; ?></a><br />
															Tel: <?php echo $PSTR_CONTACT_NO; ?><br />
															Mobile: <?php echo $PSTR_MOBILE_NO; ?>
														</li>
													</ol>
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
					<h1>Registrations for <?php echo $EVENT_NAME . ' ' . $EVENT_YEAR; ?> is now closed. If you wish to register call Ms. Prabha Sharon.<br />Mobile: <?php echo $PSTR_MOBILE_NO; ?>.</h1>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/reg_form_footer.php'; ?>
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script type="text/javascript" src="js/poster-presentation.js"></script>
<script>
	jQuery(document).ready(function() {
		Registration.init('enq_form_1', 0);
		$("#phone_lead_ccode").intlTelInput();
		$("#lead_mobcountry-code").intlTelInput();

		$("#phone_pp_ccode").intlTelInput();
		$("#pp_mobcountry-code").intlTelInput();

		show_cata();
	});

	function show_cata() {
		if (document.getElementById("Indian").checked == true) {
			$('.international-tariff').hide();
			$('.indian-tariff').show();
		} else if (document.getElementById("Foreign").checked == true) {
			$('.international-tariff').show();
			$('.indian-tariff').hide();
		}

		if (document.getElementById("BT").checked == true) {
			if (document.getElementById("Indian").checked == true) {
				document.getElementById("bank_transfer1").style.display = "block";
				document.getElementById("bank_transfer2").style.display = "none";
			} else if (document.getElementById("Foreign").checked == true) {
				document.getElementById("bank_transfer2").style.display = "block";
				document.getElementById("bank_transfer1").style.display = "none";
			}
		}
	}

	function showTxt() {
		document.getElementById("bank_transfer1").style.display = "none";
		document.getElementById("bank_transfer2").style.display = "none";
		if (document.getElementById("BT").checked == true) {
			if (document.getElementById("Indian").checked == true) {
				document.getElementById("bank_transfer1").style.display = "block";
				document.getElementById("bank_transfer2").style.display = "none";
			} else if (document.getElementById("Foreign").checked == true) {
				document.getElementById("bank_transfer2").style.display = "block";
				document.getElementById("bank_transfer1").style.display = "none";
			}
		}
	}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
<?php
//echo "<script language='javascript'>window.location = 'enquiry.php';</script>";
//exit;

//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
$rsvp_city = @$_GET['city'];
if (empty($rsvp_city)) {
	$rsvp_city = "Delhi";
}
//https://www.bengalurutechsummit.com/web/it_forms/rsvp.php?city=Delhi

//echo "city:".$rsvp_city;
//exit;
if ($rsvp_city == "") {
	echo "<script language='javascript'>alert('Your session has been expired!');</script>";
	echo "<script language='javascript'>window.location = 'rsvp.php';</script>";
	exit;
}
include "includes/form_constants_both.php";
require "rsvp_captcha.php";
$emler = @$_POST['enq_emler'];
/*if($emler ==""){
		$emler = @$_GET['enq_emler'];
	}*/

/*$participant1 = @$_POST['pr_1'];
	$participant2 = @$_POST['pr_2'];
	$participant3 = @$_POST['pr_3'];
	$participant4 = @$_POST['pr_4'];
	$participant5 = @$_POST['pr_5'];
	$participant6 = @$_POST['pr_6'];
	$participant = "";
	if(@$_POST['pr_1'] != '') {
		$participant = $participant.$_POST['pr_1'].", ";
	}
	if(@$_POST['pr_2'] != '') {
		$participant = $participant.$_POST['pr_2'].", ";
	}
	if(@$_POST['pr_3'] != '') {
		$participant = $participant.$_POST['pr_3'].", ";
	}
	if(@$_POST['pr_4'] != '') {
		$participant = $participant.$_POST['pr_4'].", ";
	}
	if(@$_POST['pr_5'] != '') {
		$participant = $participant.$_POST['pr_5'].", ";
	}
	if(@$_POST['pr_6'] != '') {
		$participant = $participant.$_POST['pr_6'];
	}
	if($participant == "") {
		$participant = "Delegate";
	}*/
if ($emler == "enq_email") {
	$em = "emailer_request";
} else {
	$em = "no_request";
}
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
		<div class="portlet light bordered" id="registration_form_2">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase">
						<?php //echo $EVENT_NAME . ' ' . $EVENT_YEAR;
						//echo "Prelude to " . $EVENT_NAME . " " . $EVENT_YEAR . "<br/>AN OPEN DIALOGUE OF INDUSTRY STAKEHOLDERS WITH Hon'ble Minister 'SHRI. PRIYANK KHARGE', Govt. of Karnataka "; 
						if($rsvp_city == "New_Delhi"){ 
							echo "RSVP: Invitation to attend Interaction Meet with Hon’ble Minister Shri Priyank Kharge at New Delhi for Bengaluru Tech Summit 2025";
						} ?>
						<?php
						//echo "Prelude to BENGALURU TECH SUMMIT 2022  and Industry Interaction with​ <br/> ​Dr. C N Ashwath Narayan, Hon’ble Minister, Govt. of Karnataka " //$RSVP_HEADING; 
						?>
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="rsvp2.php?city=<?php echo $rsvp_city ?>" class="form-horizontal" name="reg_registration_form_2" id="reg_registration_form_2" method="post" onsubmit="return validateEnquiry1223();">
					<input type="hidden" name="rsvp_city" id="rsvp_city" value="<?php echo $rsvp_city; ?>" />
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a href="#" data-toggle="tab" class="step">
										<span class="number"> 1 </span>
										<span class="desc">
											<i class="fa fa-check"></i> User Details </span>
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
							<div class="tab-content">
								<div class="tab-pane active">
									<h3 class="block">Provide Your Information</h3>
									<div class="form-group">
										<label class="control-label col-md-3">Name <span class="dips-required"> * </span></label>
										<div class="col-md-2">
											<select class="form-control" name="title" id="title" required="required">
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
										<div class="col-md-4"><input type="text" class="form-control" placeholder="Name" name="name" id="name" maxlength="100" required="required"></div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Organisation Name<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="org" id="org" required="required" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Designation<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="desig" id="desig" required="required" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Email Id<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="email" class="form-control" name="email" id="email" required="required" />
										</div>
									</div>
									<div class="form-group" style="margin-top: -15px;">
										<label class="col-md-3 control-label">Contact Number<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<span type="tel" id="mobile-country-code" data-fax-iso-code-hidden-field-name="cellnoCountryCode" class="hide"></span>
											<input type="hidden" name="cellnoCountryCode" id="cellnoCountryCode" />
											<input type="hidden" id="cellnoCountryCodeIso" name="cellnoCountryCodeIso" />
											<input name="mob" type="number" id="mob" class="form-control" maxlength="12" required style="padding-left: 92px;" />
											<span class="help-block">+Country Code-Contact Number(xxx-xxxxxxxxx)</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">City<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="city" id="city" required autocomplete="off" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Country<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<select id="country" name="country" class="form-control" required>
												<option value="">Select Country </option>
												<?php $countryList = array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "American Samoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "Bosniaand Herzegowina", "BW" => "Botswana", "BV" => "BouvetIsland", "BR" => "Brazil", "IO" => "British Indian Ocean Territory", "BN" => "Brunei Darussalam", "BG" => "Bulgaria", "BF" => "Burkina Faso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "CapeVerde", "KY" => "Cayman Islands", "CF" => "CentralAfricanRepublic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "ChristmasIsland", "CC" => "Cocos Keeling Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo the Democratic Republicofthe", "CK" => "Cook Islands", "CR" => "CostaRica", "CI" => "Coted Ivoire", "HR" => "Croatia(Hrvatska)", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "Czech Republic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "Dominican Republic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "ElSalvador", "GQ" => "Equatorial Guinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "Falkland Islands Malvinas", "FO" => "FaroeIslands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "French Guiana", "PF" => "French Polynesia", "TF" => "French Southern Territories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "Heardand McDonald Islands", "VA" => "HolySee Vatican City State", "HN" => "Honduras", "HK" => "Hong Kong", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran Islamic Republic", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KP" => "Korea Democratic People Republic", "KR" => "Korea Republic", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "LaoPeoples Democratic Republic", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "Libyan Arab Jamahiriya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau", "MK" => "Macedonia The Former Yugoslav Republic", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "Marshall Islands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia,FederatedStatesof", "MD" => "Moldova Republic", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "Netherlands Antilles", "NC" => "NewCaledonia", "NZ" => "New Zealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "Norfolk Island", "MP" => "Northern Mariana Islands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PA" => "Panama", "PG" => "Papua New Guinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PT" => "Portugal", "PR" => "PuertoRico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "Russian Federation", "RW" => "Rwanda", "KN" => "Saint Kittsand Nevis", "LC" => "SaintLUCIA", "VC" => "Saint VincentandtheGrenadines", "WS" => "Samoa", "SM" => "SanMarino", "ST" => "Sa oTomeand Principe", "SA" => "Saudi Arabia", "SN" => "Senegal", "SC" => "Seychelles", "SL" => "Sierra Leone", "SG" => "Singapore", "SK" => "Slovakia SlovakRepublic", "SI" => "Slovenia", "SB" => "Solomon Islands", "SO" => "Somalia", "ZA" => "South Africa", "GS" => "South Georgiaand the South Sandwich Islands", "ES" => "Spain", "LK" => "SriLanka", "SH" => "St.Helena", "PM" => "St.Pierreand Miquelon", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "Svalbardand Jan Mayen Islands", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "Syrian Arab Republic", "TW" => "Taiwan", "TJ" => "Tajikistan", "TZ" => "Tanzania United Republic", "TH" => "Thailand", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "TrinidadandTobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "Turksand Caicos Islands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "United Arab Emirates", "GB" => "United Kingdom", "US" => "United States", "UM" => "United States Minor Outlying Islands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "VietNam", "VG" => "VirginIslands British ", "VI" => "Virgin Islands U.S.", "WF" => "Wallisand Futuna Islands", "EH" => "Western Sahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");

												foreach ($countryList as $country) {
													$selected = '';

													if ($country == "India") {
														$selected = 'selected';
													}
													/*if($qr_gt_user_data_ans_row['country'] == $country) {
															$selected = 'selected=selected';
														}*/
													echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>';
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Your Association / Organisation Type<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<select id="association_name" name="association_name" onchange="chk_other()" class="form-control" required>
												<option value="" selected="selected">Select Association Name </option>
												<?php $associationameList = array("AMCHAM" => "AMCHAM", "ASSOCHAM" => "ASSOCHAM", "Association of Biotechnology Led Enterprises (ABLE)" => "Association of Biotechnology Led Enterprises (ABLE)", "CII" => "CII", "Drone Federation of India" => "Drone Federation of India", "DFI" => "DFI", "Electric Lamp and Component Manufacturers Association of India (ELCOMA)" => "Electric Lamp and Component Manufacturers Association of India (ELCOMA)", "Electronics City Industries Association (ELCIA)" => "Electronics City Industries Association (ELCIA)", "Electronic Industries Association Of India (ELCINA)" => "Electronic Industries Association Of India (ELCINA)", "Electronics Sector Skills Council Of India" => "Electronics Sector Skills Council Of India", "FICCI" => "FICCI", "India Cellular & Electronics Association (ICEA)" => "India Cellular & Electronics Association (ICEA)", "India Electronics & Semiconductor Association (IESA)" => "India Electronics & Semiconductor Association (IESA)", "Indian Electrical and Electronics Manufacturers' Association (IEEMA)" => "Indian Electrical and Electronics Manufacturers' Association (IEEMA)", "Manufacturers Association of Information Technology (MAIT)" => "Manufacturers Association of Information Technology (MAIT)", "NASSCOM" => "NASSCOM", "Semiconductor Fabless Accelerator Lab (SFAL)" => "Semiconductor Fabless Accelerator Lab (SFAL)", "Semiconductor Industry Association (SIA)" => "Semiconductor Industry Association (SIA)", "Software Technology Park of India (STPI)" => "Software Technology Park of India (STPI)", "U.S.-India Business Council (USIBC)" => "U.S.-India Business Council (USIBC)", "VLSI Society of India" => "VLSI Society of India", "R&D Lab / Government Organization" => "R&D Lab / Government Organization", "Startup" => "Startup", "OTHER" => "OTHER");

												foreach ($associationameList as $associationame) {
													$selected = '';


													echo '<option value="' . $associationame . '" ' . $selected . '>' . $associationame . '</option>';
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group" id="div_association_name_other" style="display: none;">
										<label class="col-md-3 control-label">Please specify Other Association Name / Organisation Type</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="association_name_other" id="association_name_other" />
										</div>
									</div>
									<div class="form-group hide">
										<label class="col-md-3 control-label">Comment</label>
										<div class="col-md-6">
											<textarea row="3" class="form-control" name="comment" id="comment"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<div class="input-group">
												<input name="vercode" type="text" class="form-control" id="vercode" maxlength="10" required autocomplete="off" />
												<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_rsvp"]; ?>" />
												<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercode_rsvp"]; ?></span>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<button type="submit" class="btn sbold uppercase green-jungle"> Submit
													<i class="fa fa-angle-right"></i>
												</button>
											</div>
										</div>
									</div>
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
<script src="js/rsvp.js"></script>
<script>
	jQuery(document).ready(function() {
		Registration.init('registration_form_2', 0);
		$("#mobile-country-code").intlTelInput();
	});

	function chk_other() {
		//alert(document.getElementById("div_association_name_other").style.display);
		if (document.getElementById("association_name").value == "OTHER") {

			document.getElementById("div_association_name_other").style.display = "block";

		} else {
			document.getElementById("div_association_name_other").style.display = "none";
		}
	}
</script>
</body>

</html>
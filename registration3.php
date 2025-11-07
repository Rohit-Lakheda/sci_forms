<?php

echo "<script language='javascript'>window.location = 'registration5.php';</script>";

exit;

session_start();

$en = '';

if (isset($_GET['en']) && !empty($_GET['en'])) {

	$en = '1';
}



$assoc_name = @$_GET['assoc_name'];

$assoc_name = trim($assoc_name);



if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {

	session_destroy();

	echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";

	if (!empty($assoc_name)) {

		echo "<script language='javascript'>window.location = 'registration.php?en=$en&assoc_name=$assoc_name';</script>";
	} else {

		echo "<script language='javascript'>window.location = 'registration.php?en=$en';</script>";
	}

	exit;
}

require("includes/form_constants_both.php");

require "dbcon_open.php";

$reg_id = $_SESSION['vercode_reg'];



$qr_gt_user_data_id = mysql_query("SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'");

$qr_gt_user_data_ans_no = 0;

$qr_gt_user_data_ans_no = mysql_num_rows($qr_gt_user_data_id);

if (($qr_gt_user_data_ans_no <= 0) || ($qr_gt_user_data_ans_no == "")) {

	session_destroy();

	echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";

	if (!empty($assoc_name)) {

		echo "<script language='javascript'>window.location = 'registration.php?en=$en&assoc_name=$assoc_name';</script>";
	} else {

		echo "<script language='javascript'>window.location = 'registration.php?en=$en';</script>";
	}

	exit;
}



$qr_gt_user_data_id = mysql_query("SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'");

$qr_gt_user_data_ans_row = mysql_fetch_array($qr_gt_user_data_id);



$a = '';

if (!empty($qr_gt_user_data_ans_row['user_type']) && !empty($qr_gt_user_data_ans_row['assoc_srno'])) {

	$assoc_name = $qr_gt_user_data_ans_row['user_type'];

	$assoc_srno = $qr_gt_user_data_ans_row['assoc_srno'];

	$qry = mysql_query("SELECT * FROM " . $EVENT_DB_FORM_PROMO_CODE_TBL . " WHERE srno='$assoc_srno' AND assoc_name='$assoc_name'");



	if (mysql_num_rows($qry)) {

		$result = mysql_fetch_assoc($qry);

		$a = $result['promo_code'];
	}
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

					<span class="caption-subject font-red bold uppercase"> Delegate Registration Form

					</span>

				</div>

			</div>

			<div class="portlet-body form">

				<form action="registration4.php?assoc_name=<?php echo $qr_gt_user_data_ans_row['assoc_name']; ?><?php echo !empty($ret) ? '&ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_2" id="reg_registration_form_2" method="post" onsubmit="return validate_registration_form_2();">

					<input name="en" type="hidden" id="en" value="<?php echo $en; ?>" />

					<div class="form-wizard">

						<div class="form-body">

							<ul class="nav nav-pills nav-justified steps">

								<li class="done">

									<a class="step dips-default-cursor">

										<span class="number"> 1 </span>

										<span class="desc">

											<i class="fa fa-check"></i> Registration Category </span>

									</a>

								</li>

								<li class="active">

									<a data-toggle="tab" class="step">

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

							<div class="tab-content">

								<div class="tab-pane active">

									<h3 class="block">Provide Organisation Information</h3>

									<div class="form-group">

										<label class="col-md-3 control-label">Organisation Name<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="org" id="org" value="<?php echo $qr_gt_user_data_ans_row['org']; ?>" required="required" />

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Nature Of Business</label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="nature" id="nature" value="<?php echo $qr_gt_user_data_ans_row['nature']; ?>" />

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Address 1<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<textarea name="addr1" id="addr1" rows="" cols="" required="required" class="form-control"><?php echo $qr_gt_user_data_ans_row['addr1']; ?></textarea>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Address 2</label>

										<div class="col-md-6">

											<textarea name="addr2" id="addr2" rows="" cols="" class="form-control"><?php echo $qr_gt_user_data_ans_row['addr2']; ?></textarea>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">City<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="city" id="city" value="<?php echo $qr_gt_user_data_ans_row['city']; ?>" onkeyup="check_char(event,'city')" required="required" />

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">State<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="state" id="state" value="<?php echo $qr_gt_user_data_ans_row['state']; ?>" required="required" />

										</div>

									</div>

									<div class="form-group">

										<label class="control-label col-md-3"> Country <span class="required"> * </span>

										</label>

										<div class="col-md-6">

											<select id="country" name="country" class="form-control">

												<option value="">Select Country </option>

												<?php $countryList = array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "American Samoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "Bosniaand Herzegowina", "BW" => "Botswana", "BV" => "BouvetIsland", "BR" => "Brazil", "IO" => "British Indian Ocean Territory", "BN" => "Brunei Darussalam", "BG" => "Bulgaria", "BF" => "Burkina Faso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "CapeVerde", "KY" => "Cayman Islands", "CF" => "CentralAfricanRepublic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "ChristmasIsland", "CC" => "Cocos Keeling Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo the Democratic Republicofthe", "CK" => "Cook Islands", "CR" => "CostaRica", "CI" => "Coted Ivoire", "HR" => "Croatia(Hrvatska)", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "Czech Republic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "Dominican Republic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "ElSalvador", "GQ" => "Equatorial Guinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "Falkland Islands Malvinas", "FO" => "FaroeIslands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "French Guiana", "PF" => "French Polynesia", "TF" => "French Southern Territories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "Heardand McDonald Islands", "VA" => "HolySee Vatican City State", "HN" => "Honduras", "HK" => "Hong Kong", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran Islamic Republic", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KP" => "Korea Democratic People Republic", "KR" => "Korea Republic", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "LaoPeoples Democratic Republic", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "Libyan Arab Jamahiriya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau", "MK" => "Macedonia The Former Yugoslav Republic", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "Marshall Islands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia,FederatedStatesof", "MD" => "Moldova Republic", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "Netherlands Antilles", "NC" => "NewCaledonia", "NZ" => "New Zealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "Norfolk Island", "MP" => "Northern Mariana Islands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PA" => "Panama", "PG" => "Papua New Guinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PT" => "Portugal", "PR" => "PuertoRico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "Russian Federation", "RW" => "Rwanda", "KN" => "Saint Kittsand Nevis", "LC" => "SaintLUCIA", "VC" => "Saint VincentandtheGrenadines", "WS" => "Samoa", "SM" => "SanMarino", "ST" => "Sa oTomeand Principe", "SA" => "Saudi Arabia", "SN" => "Senegal", "SC" => "Seychelles", "SL" => "Sierra Leone", "SG" => "Singapore", "SK" => "Slovakia SlovakRepublic", "SI" => "Slovenia", "SB" => "Solomon Islands", "SO" => "Somalia", "ZA" => "South Africa", "GS" => "South Georgiaand the South Sandwich Islands", "ES" => "Spain", "LK" => "SriLanka", "SH" => "St.Helena", "PM" => "St.Pierreand Miquelon", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "Svalbardand Jan Mayen Islands", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "Syrian Arab Republic", "TW" => "Taiwan", "TJ" => "Tajikistan", "TZ" => "Tanzania United Republic", "TH" => "Thailand", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "TrinidadandTobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "Turksand Caicos Islands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "United Arab Emirates", "GB" => "United Kingdom", "US" => "United States", "UM" => "United States Minor Outlying Islands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "VietNam", "VG" => "VirginIslands British ", "VI" => "Virgin Islands U.S.", "WF" => "Wallisand Futuna Islands", "EH" => "Western Sahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");

												if (empty($qr_gt_user_data_ans_row['country'])) {

													$qr_gt_user_data_ans_row['country'] = 'India';
												}

												foreach ($countryList as $country) {

													$selected = '';

													if ($qr_gt_user_data_ans_row['country'] == $country) {

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

											<input type="text" class="form-control" name="pin" id="pin" value="<?php echo $qr_gt_user_data_ans_row['pin']; ?>" required="required" />

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">GST Number<span class="dips-required"> * </span></label>

										<div class="col-md-3">

											<select id="gst" name="gst" class="form-control" onchange="hidegst();" required="required">

												<option value="">- Select -</option>

												<option value="Registered" <?php if (!empty($qr_gt_user_data_ans_row['gst_number']) && $qr_gt_user_data_ans_row['gst_number'] != 'Unregistered') echo 'selected=selected'; ?>>Registered</option>

												<option value="Unregistered" <?php if (!empty($qr_gt_user_data_ans_row['gst_number']) && $qr_gt_user_data_ans_row['gst_number'] == 'Unregistered') echo 'selected=selected'; ?>>Unregistered</option>

											</select>

											<span class="help-block" style="color: #f00;">Note: If you want to leave this field empty,it will be considered <b>"Not Available"</b></span>

										</div>

										<div class="col-md-3" style="display:none;" id="gst-div">

											<input type="text" class="form-control" name="gst_number" id="gst_number" value="<?php if (empty($qr_gt_user_data_ans_row['gst_number']) || $qr_gt_user_data_ans_row['gst_number'] != 'Unregistered') echo $qr_gt_user_data_ans_row['gst_number']; ?>" placeholder="Enter GST Number" maxlength="15" />

										</div>



									</div>

									<!-- <div class="form-group">

										<label class="col-md-3 control-label">GST Number<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="gst_number" id="gst_number" value="<?php echo $qr_gt_user_data_ans_row['gst_number']; ?>" required="required"/>

											<span class="help-block" style="color: #f00;">(Note: Only for India Companies for Raising an Invoice GST Number is a must.)</span>

											<span class="help-block" style="color: #f00;">Note: If you want to leave this field empty, then add it's value <b>"Not Available"</b></span>

										</div>

									</div> -->

									<div class="form-group">

										<label class="col-md-3 control-label">Telephone Number<span class="dips-required"> * </span></label>

										<div class="col-md-6" style="margin-top: -16px;">

											<span type="tel" id="telCountryIsoCode" data-fax-iso-code-hidden-field-name="foneCountryCode" class="hide"></span>

											<?php $phone = explode('-', $qr_gt_user_data_ans_row['fone']); ?>

											<input type="hidden" name="foneCountryCode" id="foneCountryCode" value="<?php echo !empty($phone[1]) ? str_replace('+', '', @$phone[0]) : ''; ?>" />

											<input type="hidden" id="foneCountryCodeIso" />

											<input name="fone" type="text" id="fone" class="form-control" maxlength="20" value="<?php echo !empty($phone[1]) ? @$phone[1] . @$phone[2] : ''; ?>" required onkeyup="checkPhoneNumber(event, 'fone');" style="padding-left: 92px;" />

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

									</div><?php */ ?>

								</div>

							</div>

						</div>

						<div class="form-actions">

							<div class="row">

								<div class="col-md-offset-3 col-md-9">

									<a href="javascript:;" class="btn default" onclick="go_back();">

										<i class="fa fa-angle-left"></i> Back </a>

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

<?php require 'includes/reg_form_footer.php'; ?>

<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>

<script>
	var assoc_name = '<?php echo $qr_gt_user_data_ans_row['assoc_name']; ?>';

	var a = '<?php echo $a; ?>';

	var en = '<?php echo $en; ?>';
</script>

<script src="js/registration2.js?hbvcy"></script>

<script>
	jQuery(document).ready(function() {

		Registration.init('registration_form_2', 1);

		$("#telCountryIsoCode").intlTelInput();

		/*$("#faxCountryIsoCode").intlTelInput();*/

		/* var foneCountryCodeIso = $('#foneCountryCodeIso').val();

		if(foneCountryCodeIso != '') {

			$("#telCountryIsoCode").intlTelInput("setCountry", foneCountryCodeIso);

		} */

		$(document).on('change', "#gst_number", function() {

			var inputvalues = $(this).val();

			var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');



			if (gstinformat.test(inputvalues)) {

				return true;

			} else {

				alert('Please Enter Valid GSTIN Number');

				$("#gst_number").val('');

				$("#gst_number").focus();

			}

		});

		hidegst();

	});



	function hidegst() {

		$('#gst-div').hide();

		if ($('#gst').val() == 'Registered') {

			$('#gst-div').show();

		}

	}
</script>

<!-- END PAGE LEVEL SCRIPTS -->

</body>

</html>
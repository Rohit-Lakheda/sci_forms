<?php
//redirecrt to enquiry.php
header('Location: enquiry.php');

exit;
session_start();
require("includes/form_constants_both.php");



require "dbcon_open.php";
require "get_user_no.php";
do {
	$i = 0;
	$text = get_rand_id(6);
	$_SESSION["vercode_sp"] = $text;

	$chq_qr_demo = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_SPEAKER_PROFILE . " WHERE reg_id = '$text'") or die(mysqli_error($link));
	$chq_no_demo = mysqli_num_rows($chq_qr_demo);

	if (($chq_no_demo > 0)) {
		$i++;
		continue;
	} else {
		$i = 0;
	}
} while (($i != 0));
?>
<?php require 'includes/reg_form_header.php'; ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_2">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Speakers Profile Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="speaker-profile2.php" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" enctype="multipart/form-data" method="post" onsubmit="return validate_reg_registration_form_1();">
					<?php /*<input name="vercode" type="hidden" id="vercode" value="<?php echo $_SESSION['vercode_sp'];?>"/>
                    <input name="speaker_addr1" type="hidden"  id="addr1" value="" />
        			<input name="speaker_addr2" type="hidden" id="addr2" value="" />
        			<input name="speaker_state" type="hidden"  id="state" value="" />
        			<input name="speaker_pin" type="hidden"  id="pin" value="" />*/ ?>
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a href="#tab1" data-toggle="tab" class="step">
										<span class="number"> 1 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Registration </span>
									</a>
								</li>
								<li class="active">
									<a data-toggle="tab" class="step">
										<span class="number"> 2 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Confirmation Receipt </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success"> </div>
							</div>
							<div class="tab-content">
								<div class="tab-pane active">
									<h3 class="block">Provide Speaker Information</h3>


									<div class="form-group">
										<label class="control-label col-md-3"> Select Your Session Track <span class="required"> * </span>
										</label>
										<div class="col-md-6">
											<select class="form-control" id="session_track" name="session_track" required>
												<option value=""> -Select Your Session Track- </option>
												<?php $sessTrackList = array('TREND STAGE (IT, Deeptech & Trends)',
												'CIRCUIT STAGE (Electronics & Semicon)', 
												'LIFE STAGE (Biotech & Healthtech)',
												'FOUNDERS STAGE (Startup Ecosystem)',
												'WORLD STAGE-1',
												'INDIA US CONCLAVE',
												'WORKSHOP',
												'WORLD STAGE -2',
												'Plenary Session',
											);
												foreach ($sessTrackList as $sessTrack) {
													echo '<option value="' . $sessTrack . '">' . $sessTrack . '</option>';
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3"> Name <span class="required"> * </span></label>
										<div class="col-md-2">
											<select class="form-control" id="speaker_title" name="speaker_title" required>
												<option value="">-Title-</option>
												<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
												foreach ($titleList as $title) {
													echo '<option value="' . $title . '">' . $title . '</option>';
												}
												?>
											</select>
										</div>
										<div class="col-md-2">
											<input name="speaker_fname" type="text" class="form-control" id="speaker_fname" placeholder="First Name" required />
										</div>
										<div class="col-md-2">
											<input name="speaker_lname" type="text" class="form-control" id="speaker_lname" placeholder="Last Name" required />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"> Designation <span class="required"> * </span>
										</label>
										<div class="col-md-6">
											<input name="speaker_desig" type="text" class="form-control" id="desig" required />
											<span class="help-block">(If you don't belong to any organization then write 'Not Applicable')
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3"> Organisation <span class="required"> * </span>
									</label>
									<div class="col-md-6">
										<input name="speaker_org" type="text" class="form-control " id="org" required />
										<span class="help-block">(If you don't belong to any organization then write 'Not Applicable')</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3"> Email Id <span class="required"> * </span>
									</label>
									<div class="col-md-6">
										<input name="speaker_email_1" type="email" class="form-control" id="speaker_email_1" required />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3"> Mobile Number <span class="required"> * </span>
									</label>
									<div class="col-md-2">
										<input name="speaker_mob_cntry_code" type="text" class="form-control" id="speaker_mob_cntry_code" onkeyup="check_num(event,'speaker_mob_cntry_code')" maxlength="4" placeholder="Country Code" required />
									</div>
									<div class="col-md-4">
										<input name="speaker_mob" type="text" class="form-control" id="speaker_mob" onkeyup="check_num(event,'speaker_mob')" maxlength="10" placeholder="Mobile Number" required />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">LinkedIn Profile link<span class="required"> * </span>
									</label>
									<div class="col-md-6">
										<input name="linkedin_link" type="text" class="form-control " id="linkedin_link" required />
										<span class="help-block">Note: If you don't have linkedIn profile link then write as Not-Applicable</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Social Media Handle Link:</label>
									<div class="col-md-6">
										<input name="twitter_link" type="text" class="form-control " id="twitter_link" />
										<span class="help-block"></span>
									</div>
								</div>
								<?php /*<div class="form-group">
                                    	<label class="control-label col-md-3"> City<span class="required"> * </span>
                                    	</label>
                                    	<div class="col-md-6">
                                    		<input name="speaker_city" type="text" class="form-control " id="city" required/>
                                    	</div>
                                    </div>*/ ?>
								<div class="form-group">
									<label class="control-label col-md-3"> Country<span class="required"> * </span>
									</label>
									<div class="col-md-6">
										<select class="form-control" name="speaker_country" id="country" required="required">
											<option value=""></option>
											<?php $countryList = array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "AmericanSamoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "BosniaandHerzegowina", "BW" => "Botswana", "BV" => "BouvetIsland", "BR" => "Brazil", "IO" => "BritishIndianOceanTerritory", "BN" => "BruneiDarussalam", "BG" => "Bulgaria", "BF" => "BurkinaFaso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "CapeVerde", "KY" => "CaymanIslands", "CF" => "CentralAfricanRepublic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "ChristmasIsland", "CC" => "Cocos(Keeling)Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo,theDemocraticRepublicofthe", "CK" => "CookIslands", "CR" => "CostaRica", "CI" => "Coted'Ivoire", "HR" => "Croatia(Hrvatska)", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "CzechRepublic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "DominicanRepublic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "ElSalvador", "GQ" => "EquatorialGuinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "FalklandIslands(Malvinas)", "FO" => "FaroeIslands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "FrenchGuiana", "PF" => "FrenchPolynesia", "TF" => "FrenchSouthernTerritories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "HeardandMcDonaldIslands", "VA" => "HolySee(VaticanCityState)", "HN" => "Honduras", "HK" => "HongKong", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran(IslamicRepublicof)", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KP" => "Korea,DemocraticPeople'sRepublicof", "KR" => "Korea,Republicof", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "LaoPeople'sDemocraticRepublic", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "LibyanArabJamahiriya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau", "MK" => "Macedonia,TheFormerYugoslavRepublicof", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "MarshallIslands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia,FederatedStatesof", "MD" => "Moldova,Republicof", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "NetherlandsAntilles", "NC" => "NewCaledonia", "NZ" => "NewZealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "NorfolkIsland", "MP" => "NorthernMarianaIslands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PA" => "Panama", "PG" => "PapuaNewGuinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PT" => "Portugal", "PR" => "PuertoRico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "RussianFederation", "RW" => "Rwanda", "KN" => "SaintKittsandNevis", "LC" => "SaintLUCIA", "VC" => "SaintVincentandtheGrenadines", "WS" => "Samoa", "SM" => "SanMarino", "ST" => "SaoTomeandPrincipe", "SA" => "SaudiArabia", "SN" => "Senegal", "SC" => "Seychelles", "SL" => "SierraLeone", "SG" => "Singapore", "SK" => "Slovakia(SlovakRepublic)", "SI" => "Slovenia", "SB" => "SolomonIslands", "SO" => "Somalia", "ZA" => "SouthAfrica", "GS" => "SouthGeorgiaandtheSouthSandwichIslands", "ES" => "Spain", "LK" => "SriLanka", "SH" => "St.Helena", "PM" => "St.PierreandMiquelon", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "SvalbardandJanMayenIslands", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "SyrianArabRepublic", "TW" => "Taiwan,ProvinceofChina", "TJ" => "Tajikistan", "TZ" => "Tanzania,UnitedRepublicof", "TH" => "Thailand", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "TrinidadandTobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "TurksandCaicosIslands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "UnitedArabEmirates", "GB" => "UnitedKingdom", "US" => "UnitedStates", "UM" => "UnitedStatesMinorOutlyingIslands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "VietNam", "VG" => "VirginIslands(British)", "VI" => "VirginIslands(U.S.)", "WF" => "WallisandFutunaIslands", "EH" => "WesternSahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");
											foreach ($countryList as $country) {
												$selected = '';
												if ('India' == $country) {
													$selected = 'selected=selected';
												}
												echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3"> Photo<span class="required"> * </span>
									</label>
									<div class="col-md-6">
										<input name="speaker_photo" type="file" id="photo" required accept="image/*" onchange="checkFileType(this);" />
										<br>
										Note: <br>1. Photos dimension should be <strong>width:400px & height: 400px</strong><br>2. Photos size should be <strong>less than 4MB</strong>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3"> Profile <span class="required"> * </span>
									</label>
									<div class="col-md-6">
										<textarea rows="3" cols="" class="form-control" name="shrt_bgrphy_fl" id="shrt_bgrphy_fl" required></textarea>
										<span class="help-block">Total word count: <span id="display_count">0</span> words. Words left: <span id="word_left">80</span></span>
									</div>
								</div>
								<div class="row">
					<div class="col-md-12">
                      <div class="well well-lg">
					  <label class="control-label1 col-md-9">
						Would you be interested in exploring B2B Partnering possibilities through the Interlinx B2B Portal at BTS2024?</label>
						<div class="col-md-3">
							<div class="md-radio-inline">
								<div class="md-radio">
								<input type="radio" id="delegate_flag-yes" name="delegate_flag" class="md-radiobtn" value="Yes">
								<label for="delegate_flag-yes">
								<span></span>
								<span class="check"></span>
								<span class="box"></span> Yes</label>
							</div>
								<div class="md-radio">
									<input type="radio" id="delegate_flag-no" name="delegate_flag" class="md-radiobtn" value="No">
									<label for="delegate_flag-no">
										<span></span>
										<span class="check"></span>
										<span class="box"></span> No</label>
								</div>
							</div>
						</div><br/>
						<label >
						<i>Note: By selecting 'Yes,' you are committing to actively engage in B2B Partnering - InterlinX. This entails keeping your profile up-to-date, promptly responding to meeting and message requests, and honoring any meeting commitments.</i>
						</label>
                      </div>
                    </div>
								<?php /*?>
                                    <div class="form-group">
                                    	<label class="control-label col-md-3"> 
                                    	</label>
                                    	<div class="col-md-4">
                                    		<div class="g-recaptcha" data-sitekey="<?php echo $EVENT_DATA_SITE_KEY; ?>"></div>
                                    	</div>
                                    </div>
                                    <?php */ ?>
								<div class="form-group">
									<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
									<div class="col-md-6">
										<div class="input-group">
											<input name="vercode" type="text" class="form-control dips-name-textbox" id="vercode" maxlength="10" required />
											<input name="vercode_sp2" type="hidden" class="form-control dips-name-textbox" id="vercode_sp2" value="<?php echo $text; ?>" />
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

<script src="js/speaker.js?sdf"></script>

<script>
	if ($('input[name="delegate_flag"]:checked').val() == '') {
    alert('Please select Yes or No');
    return false;
}

	jQuery(document).ready(function() {
		Registration.init('reg_registration_form_1', 0);
	});

	var maxWords = 80;
	//jQuery('#shrt_bgrphy_fl').keypress(function() {
	jQuery('#shrt_bgrphy_fl').on('keydown', function(e) {
		var words = 0;

		if ((this.value.match(/\S+/g)) != null) {
			words = this.value.match(/\S+/g).length;
		}

		if (words > maxWords) {
			// Split the string on first 200 words and rejoin on spaces
			var trimmed = $(this).val().split(/\s+/, maxWords).join(" ");
			// Add a space at the end to make sure more typing creates new words
			$(this).val(trimmed + " ");
		} else {
			$('#display_count').text(words);
			$('#word_left').text(maxWords - words);
		}
	});

	//jQuery('#shrt_bgrphy_fl').change(function() {
	/*jQuery('#shrt_bgrphy_fl').on('change', function(e){
		if(e.keyCode == 8 || e.keyCode == 37 || e.keyCode == 38 || e.keyCode == 39 || e.keyCode == 40) {
		} else {
			var words = $(this).val().split(/\b[\s,\.-:;]//);
			// console.log(words.length);
			if (words.length > maxWords) {
				//words.splice(maxWords);
				//$(this).val(words.join(""));
				//alert("You've reached the maximum allowed words. Extra words removed.");
			}
		}
	    // console.log(words.length);
	});	*/
</script>

</body>

</html>
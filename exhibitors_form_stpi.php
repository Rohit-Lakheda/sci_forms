<?php  
	$ret = @$_GET ['rt'];
	require "includes/form_constants_both.php";
	
	if ($ret == "retds4fn324rn_ed24d3it") {
		session_start ();
		if ((! isset ( $_SESSION ["vercode_ex"] )) || ($_SESSION ["vercode_ex"] == '')) {
			session_destroy ();
			echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
			echo "<script language='javascript'>window.location = ('exhibitors_form_stpi.php');</script>";
			exit ();
		}
		
		$text = $_SESSION ["vercode_ex"];
	} else {
		require "exhibitors_form_captcha.php";
		
		$_SESSION ['speaker_event_name'] = $EVENT_NAME;
		$_SESSION ['speaker_event_year'] = $EVENT_YEAR;
		
		$_SESSION ['sess_booth_no'] = "";
		$_SESSION ['sess_booth_area'] = "";
		$_SESSION ['sess_booth_area_unit'] = "";
		$_SESSION ['sess_fascia_name'] = "";
		
		$_SESSION ['sess_exhi_name'] = "";
		$_SESSION ['sess_cp_title'] = "";
		$_SESSION ['sess_cp_fname'] = "";
		$_SESSION ['sess_cp_lname'] = "";
		$_SESSION ['sess_desig'] = "";
		$_SESSION ['sess_addr1'] = "";
		$_SESSION ['sess_addr2'] = "";
		$_SESSION ['sess_city'] = "";
		$_SESSION ['sess_state'] = "";
		$_SESSION ['sess_country'] = "";
		$_SESSION ['sess_zip'] = "";
		$_SESSION ['foneCountryIso'] = "";
		$_SESSION ['sess_fon'] = "";
		$_SESSION ['cellnoCountryCode'] = "";
		$_SESSION ['sess_mob'] = "";
		$_SESSION ['faxCountryIso'] = "";
		$_SESSION ['sess_fax'] = "";
		$_SESSION ['sess_email'] = "";
		$_SESSION ['sess_website'] = "";
		$_SESSION ['sess_exbhi_profile'] = "";
		$_SESSION ['sess_category'] = "";

	}
	
	$assoc_nm = 'STPI';//@$_REQUEST['assoc_nm'];
	
	/*if( ($assoc_nm=="STPI") || ($assoc_nm=="KBITS") ) {
		$_SESSION['sess_booth_area'] = 6;
	}*/
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />'; 
	require 'includes/reg_form_header.php';?>
<style>
	.selected-flag {
	margin-top: -5px;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Exhibitors Directory Form for STPI</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="exhibitors_form2.php?assoc_nm=<?php echo $assoc_nm;?>" class="form-horizontal" name="exhibitors_form_1" id="exhibitors_form_1" method="post" onsubmit="return validate_ex();">
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a href="#tab1" data-toggle="tab" class="step">
									<span class="number"> 1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Exhibitor/Sponsor Details </span>
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
										<span class="block">Dear Sponsor/Exhibitor, <br />Please note: The details   submitted through this form will be published in the Event Document. Please take   necessary precaution to give the correct details.</span>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"> Select Sector <span class="required"> * </span>
										</label>
										<div class="col-md-6">
											<select id="sector" name="sector" class="form-control" required="required">
												<option value="">-- Select Sector --</option>
												<?php $countryList = array('Information Technology'=>'Information Technology', 'Bio Technology'=>'Bio Technology');
														//$countryList = array('Information Technology'=>'Information Technology');
														foreach ($countryList as $key=>$value) {
															echo '<option value="' . $key . '">' . $value . '</option>'; 
														}
													?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"> Select Category <span class="required"> * </span>
										</label>
										<div class="col-md-6">
											<select id="category" name="category" class="form-control" required="required">
												<option value="">-- Select Category  --</option>
												<?php $cataList = array('Exhibitor'=>'Exhibitor', 'Sponsor'=>'Sponsor');
														//$countryList = array('Information Technology'=>'Information Technology');
														foreach ($cataList as $key=>$value) {
															echo '<option value="' . $key . '">' . $value . '</option>'; 
														}
													?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Name of Exhibitor <span style="font-size:10px;">&nbsp;(Organisation Name)</span><span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input class="form-control" name="exhi_name" type="text" id="exhi_name" maxlength="100" value="<?php echo $_SESSION['sess_exhi_name'];  ?>" required="required"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Enter Area in sqm <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input class="form-control" name="booth_area" type="text" id="booth_area" maxlength="100" value="<?php echo $_SESSION['sess_booth_area']; ?>" required="required" onkeyup="check_num(event, 'booth_area');" />
											<input name="booth_area_unit" type="hidden" id="booth_area_unit" value="sqm">
										</div>
									</div>
									<div class="form-group">
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
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Address 1<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<textarea name="addr1" id="addr1" rows="" cols="" required="required" class="form-control"><?php echo $_SESSION['sess_addr1']; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Address 2</label>
										<div class="col-md-6">
											<textarea name="addr2" id="addr2" rows="" cols="" class="form-control"><?php echo $_SESSION['sess_addr2']; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">City<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="city" id="city" value="<?php echo $_SESSION['sess_city'];?>" onkeyup="check_char(event,'city');" required="required"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">State<span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="state" id="state" value="<?php echo $_SESSION['sess_state'];?>" required="required" onkeyup="check_char(event,'state');"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"> Country <span class="required"> * </span>
										</label>
										<div class="col-md-6">
											<select id="country" name="country" class="form-control">
												<option value="">-- Select Country --</option>
												<?php $countryList = array("AF"=>"Afghanistan","AL"=>"Albania","DZ"=>"Algeria","AS"=>"AmericanSamoa","AD"=>"Andorra","AO"=>"Angola","AI"=>"Anguilla","AQ"=>"Antarctica","AR"=>"Argentina","AM"=>"Armenia","AW"=>"Aruba","AU"=>"Australia","AT"=>"Austria","AZ"=>"Azerbaijan","BS"=>"Bahamas","BH"=>"Bahrain","BD"=>"Bangladesh","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Belgium","BZ"=>"Belize","BJ"=>"Benin","BM"=>"Bermuda","BT"=>"Bhutan","BO"=>"Bolivia","BA"=>"BosniaandHerzegowina","BW"=>"Botswana","BV"=>"BouvetIsland","BR"=>"Brazil","IO"=>"BritishIndianOceanTerritory","BN"=>"BruneiDarussalam","BG"=>"Bulgaria","BF"=>"BurkinaFaso","BI"=>"Burundi","KH"=>"Cambodia","CM"=>"Cameroon","CA"=>"Canada","CV"=>"CapeVerde","KY"=>"CaymanIslands","CF"=>"CentralAfricanRepublic","TD"=>"Chad","CL"=>"Chile","CN"=>"China","CX"=>"ChristmasIsland","CC"=>"Cocos(Keeling)Islands","CO"=>"Colombia","KM"=>"Comoros","CG"=>"Congo","CD"=>"Congo,theDemocraticRepublicofthe","CK"=>"CookIslands","CR"=>"CostaRica","CI"=>"Coted'Ivoire","HR"=>"Croatia(Hrvatska)","CU"=>"Cuba","CY"=>"Cyprus","CZ"=>"CzechRepublic","DK"=>"Denmark","DJ"=>"Djibouti","DM"=>"Dominica","DO"=>"DominicanRepublic","EC"=>"Ecuador","EG"=>"Egypt","SV"=>"ElSalvador","GQ"=>"EquatorialGuinea","ER"=>"Eritrea","EE"=>"Estonia","ET"=>"Ethiopia","FK"=>"FalklandIslands(Malvinas)","FO"=>"FaroeIslands","FJ"=>"Fiji","FI"=>"Finland","FR"=>"France","GF"=>"FrenchGuiana","PF"=>"FrenchPolynesia","TF"=>"FrenchSouthernTerritories","GA"=>"Gabon","GM"=>"Gambia","GE"=>"Georgia","DE"=>"Germany","GH"=>"Ghana","GI"=>"Gibraltar","GR"=>"Greece","GL"=>"Greenland","GD"=>"Grenada","GP"=>"Guadeloupe","GU"=>"Guam","GT"=>"Guatemala","GN"=>"Guinea","GW"=>"Guinea-Bissau","GY"=>"Guyana","HT"=>"Haiti","HM"=>"HeardandMcDonaldIslands","VA"=>"HolySee(VaticanCityState)","HN"=>"Honduras","HK"=>"HongKong","HU"=>"Hungary","IS"=>"Iceland","IN"=>"India","ID"=>"Indonesia","IR"=>"Iran(IslamicRepublicof)","IQ"=>"Iraq","IE"=>"Ireland","IL"=>"Israel","IT"=>"Italy","JM"=>"Jamaica","JP"=>"Japan","JO"=>"Jordan","KZ"=>"Kazakhstan","KE"=>"Kenya","KI"=>"Kiribati","KP"=>"Korea,DemocraticPeople'sRepublicof","KR"=>"Korea,Republicof","KW"=>"Kuwait","KG"=>"Kyrgyzstan","LA"=>"LaoPeople'sDemocraticRepublic","LV"=>"Latvia","LB"=>"Lebanon","LS"=>"Lesotho","LR"=>"Liberia","LY"=>"LibyanArabJamahiriya","LI"=>"Liechtenstein","LT"=>"Lithuania","LU"=>"Luxembourg","MO"=>"Macau","MK"=>"Macedonia,TheFormerYugoslavRepublicof","MG"=>"Madagascar","MW"=>"Malawi","MY"=>"Malaysia","MV"=>"Maldives","ML"=>"Mali","MT"=>"Malta","MH"=>"MarshallIslands","MQ"=>"Martinique","MR"=>"Mauritania","MU"=>"Mauritius","YT"=>"Mayotte","MX"=>"Mexico","FM"=>"Micronesia,FederatedStatesof","MD"=>"Moldova,Republicof","MC"=>"Monaco","MN"=>"Mongolia","MS"=>"Montserrat","MA"=>"Morocco","MZ"=>"Mozambique","MM"=>"Myanmar","NA"=>"Namibia","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Netherlands","AN"=>"NetherlandsAntilles","NC"=>"NewCaledonia","NZ"=>"NewZealand","NI"=>"Nicaragua","NE"=>"Niger","NG"=>"Nigeria","NU"=>"Niue","NF"=>"NorfolkIsland","MP"=>"NorthernMarianaIslands","NO"=>"Norway","OM"=>"Oman","PK"=>"Pakistan","PW"=>"Palau","PA"=>"Panama","PG"=>"PapuaNewGuinea","PY"=>"Paraguay","PE"=>"Peru","PH"=>"Philippines","PN"=>"Pitcairn","PL"=>"Poland","PT"=>"Portugal","PR"=>"PuertoRico","QA"=>"Qatar","RE"=>"Reunion","RO"=>"Romania","RU"=>"RussianFederation","RW"=>"Rwanda","KN"=>"SaintKittsandNevis","LC"=>"SaintLUCIA","VC"=>"SaintVincentandtheGrenadines","WS"=>"Samoa","SM"=>"SanMarino","ST"=>"SaoTomeandPrincipe","SA"=>"SaudiArabia","SN"=>"Senegal","SC"=>"Seychelles","SL"=>"SierraLeone","SG"=>"Singapore","SK"=>"Slovakia(SlovakRepublic)","SI"=>"Slovenia","SB"=>"SolomonIslands","SO"=>"Somalia","ZA"=>"SouthAfrica","GS"=>"SouthGeorgiaandtheSouthSandwichIslands","ES"=>"Spain","LK"=>"SriLanka","SH"=>"St.Helena","PM"=>"St.PierreandMiquelon","SD"=>"Sudan","SR"=>"Suriname","SJ"=>"SvalbardandJanMayenIslands","SZ"=>"Swaziland","SE"=>"Sweden","CH"=>"Switzerland","SY"=>"SyrianArabRepublic","TW"=>"Taiwan,ProvinceofChina","TJ"=>"Tajikistan","TZ"=>"Tanzania,UnitedRepublicof","TH"=>"Thailand","TG"=>"Togo","TK"=>"Tokelau","TO"=>"Tonga","TT"=>"TrinidadandTobago","TN"=>"Tunisia","TR"=>"Turkey","TM"=>"Turkmenistan","TC"=>"TurksandCaicosIslands","TV"=>"Tuvalu","UG"=>"Uganda","UA"=>"Ukraine","AE"=>"UnitedArabEmirates","GB"=>"UnitedKingdom","US"=>"UnitedStates","UM"=>"UnitedStatesMinorOutlyingIslands","UY"=>"Uruguay","UZ"=>"Uzbekistan","VU"=>"Vanuatu","VE"=>"Venezuela","VN"=>"VietNam","VG"=>"VirginIslands(British)","VI"=>"VirginIslands(U.S.)","WF"=>"WallisandFutunaIslands","EH"=>"WesternSahara","YE"=>"Yemen","ZM"=>"Zambia","ZW"=>"Zimbabwe");
													if(empty($_SESSION['sess_country'])) {
														$_SESSION['sess_country'] = 'India';
													}
													foreach ($countryList as $country) {
														$selected = '';
														if($_SESSION['sess_country'] == $country) {
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
											<input type="text" class="form-control" name="zip" id="zip" value="<?php echo $_SESSION['sess_zip'];?>" required="required"/>
										</div>
									</div>
									<div class="form-group">
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
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Telephone Number</label>
										<div class="col-md-6" style="margin-top: -15px;">
											<span type="tel" id="telCountryIsoCode" data-fax-iso-code-hidden-field-name="foneCountryCode"></span>
											<input type="hidden" name="foneCountryCode" id="foneCountryCode" value="<?php echo @$_SESSION['sess_fon_cntry'];?>"/>
											<input type="hidden" id="foneCountryCodeIso" name="foneCountryCodeIso"/>
											<input name="fon" type="text" id="fon" class="form-control" maxlength="20" value="<?php echo @$_SESSION['sess_fon'];?>" onkeyup="check_num(event, 'fon');" style="padding-left: 92px;"/>
											<span class="help-block">+Country Code-Area Code-Phone Number(Eg. 91-123412345)</span>
										</div>
									</div>
									<div class="form-group">
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
										<label class="col-md-3 control-label">Organisation Profile <span class="required"> * </span></label>
										<div class="col-md-6">
											<textarea rows="9" cols="" class="form-control exbhi_profile" name="exbhi_profile" id="exbhi_profile"><?php echo $_SESSION['sess_exbhi_profile']; ?></textarea>
											<span class="help-block"><span id="limit-char">Character count 0/750</span></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<div class="input-group">
												<input name="vercode_ex" type="text" class="form-control" id="vercode_ex" maxlength="10" required autocomplete="off"/>
												<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_ex"];?>" />
												<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $text;?></span>
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
<script src="assets/global/plugins/tiny_mce/tiny_mce.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="js/exhibitor.js"></script>
<script>
	jQuery(document).ready(function() {  
		Registration.init('registration_form_1', 0);
	
		<?php if(!empty($_SESSION['foneCountryIso'])) { ?>
			$("#telCountryIsoCode").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['foneCountryIso'];?>" ]});
		<?php } else {?>
			$("#telCountryIsoCode").intlTelInput();
		<?php }?>
	
		<?php if(!empty($_SESSION['faxCountryIso'])) { ?>
			$("#faxCountryIsoCode").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['faxCountryIso'];?>" ]});
		<?php } else {?>
			$("#faxCountryIsoCode").intlTelInput();
		<?php }?>
		
		 <?php if(!empty($_SESSION['cellnoCountryCodeIso'])) { ?>
		 	$("#mobile-country-code").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['cellnoCountryCodeIso'];?>" ]});
		 <?php } else {?>
			 $("#mobile-country-code").intlTelInput();
		 <?php } ?>	 
		 
		 $(window).load(function() { 
			profileTextCount();
		});
	});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
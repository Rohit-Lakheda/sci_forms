<?php //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
	$ret = @$_GET['rt'];
	require "includes/form_constants_both.php";
	
	$assoc_nm = @$_REQUEST['assoc_nm'];
	if ($ret == "retds4fn324rn_ed24d3it") {
		session_start ();
		if ((! isset ( $_SESSION ["vercode_ex"] )) || ($_SESSION ["vercode_ex"] == '')) {
			session_destroy ();
			echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
			echo "<script language='javascript'>window.location = ('exhibitor-standard.php');</script>";
			exit ();
		}
		
		$text = $_SESSION ["vercode_ex"];
		$assoc_nm = @$_SESSION['assoc_nm'];
	} else {
		require "exhibitor_payment_form_startup_captcha.php";
		
		$_SESSION ['sess_booth_size'] = "";
		$_SESSION ['sess_exhi_name'] = "";
		$_SESSION ['sess_cp_title'] = "";
		$_SESSION ['sess_cp_fname'] = "";
		$_SESSION ['sess_cp_lname'] = "";
		$_SESSION ['sess_email'] = "";
		$_SESSION ['sess_mobile'] = "";
		$_SESSION ['sess_addr1'] = "";
		$_SESSION ['sess_addr2'] = "";
		$_SESSION ['sess_city'] = "";
		$_SESSION ['sess_state'] = "";
		$_SESSION ['sess_country'] = "";
		$_SESSION ['sess_zip'] = "";
		$_SESSION ['gst'] = "";
		$_SESSION ['gst_number'] = "";
		$_SESSION ['pan_number'] = "";
		$_SESSION ['sess_foneCountryCode'] = "";
		$_SESSION ['sess_fon'] = "";
		$_SESSION ['sess_cellnoCountryCode'] = "";
		$_SESSION ['sess_mob'] = "";
		$_SESSION ['sess_other_sector'] = "";
		$_SESSION ['assoc_nm'] = "";

		$_SESSION ['sess_del_title'] = '';
		$_SESSION ['sess_del_fname'] = '';
		$_SESSION ['sess_del_lname'] = '';
		$_SESSION ['sess_del_email'] = '';
		$_SESSION ['sess_del_mobile_cntry'] = '';
		$_SESSION ['sess_del_mobile'] = '';

		$_SESSION ['sess_part_title'] = '';
		$_SESSION ['sess_part_fname'] = '';
		$_SESSION ['sess_part_lname'] = '';
		$_SESSION ['sess_part_email'] = '';
		$_SESSION ['sess_part_mobile_cntry'] = '';
		$_SESSION ['sess_part_mobile'] = '';
	}

	/*if( ($assoc_nm=="STPI") || ($assoc_nm=="KBITS") ) {
		$_SESSION['sess_booth_area'] = 6;
	}
	if($assoc_nm=="STARTUP-ZONE") {
		$_SESSION['sess_booth_area'] = 4;
		$_SESSION['sess_booth_booth_space'] = 'Shell';
	}*/
	/*if(empty($assoc_nm)) {
		$ex_pay_bts = true;
	} else {
		$ex_pay_bts_assoc = true;
	}*/
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />'; 
	require 'includes/reg_form_header.php';?>
<style>
	.selected-flag {
	margin-top: -5px;
	}
	.tariff-table > tbody > tr > td, tariff-table > tbody > tr > th, tariff-table > tfoot > tr > td, tariff-table > tfoot > tr > th, tariff-table > thead > tr > td, tariff-table > thead > tr > th {
		border: 1px solid #c7c7c7 !important;
		color: #000 !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase">
						Standard Exhibitor Delegate registration form
						<?php /*if(!empty($assoc_nm)) { ?>
							Exhibitors Directory Form For <?php echo $assoc_nm;?>
						<?php } else {?>
							Exhibitor at Startup Zone
						<?php } */?>
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<?php if(date('Y-m-d') <= '2021-11-19') {?>
				<form action="exhibitor-standard2.php<?php echo !empty($ret) ? '?rt=' . $ret : ''; ?>" class="form-horizontal" name="exhibitors_form_1" id="exhibitors_form_1" method="post" onsubmit="return validate_ex();">
					<input type="hidden" value="<?php echo $assoc_nm;?>" name="assoc_nm" />
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a href="#tab1" data-toggle="tab" class="step">
									<span class="number"> 1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Exhibitor Details </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Preview Detail</span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 3 </span>
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
									<div class="row hide">
										<div class="col-md-offset-2 col-md-7 table-responsive1">
											<table class="table table-bordered tariff-table" style="border: thin solid #dddddd; box-shadow: 5px 5px 5px 0 rgb(219, 219, 219);">
												<thead>
													<tr bgcolor="#E39101" style="color: #fff;">
		                                            	<th colspan="6" style="text-align: center;">STARTUP BOOTH (VIRTUAL EXPO TARIFF)*</th>
													</tr>
													<tr  bgcolor="#2fa0dd" style="color: #fff;">
														<th class="align-td">Nationality</th>
														<th class="align-td">Amount</th>
													</tr>
												</thead>
												<tbody>
													<tr class="indian-tariff" style="background-color: #e1e1e1;" >
														<td class="align-td">Indian</td>
														<td class="align-td">INR 9,999</td>
		                                            </tr>
													<tr class="international-tariff" style="background-color: #e1e1e1;" >
														<td class="align-td">International</td>
														<td colspan="1" class="align-td">USD 150</td>
		                                            </tr>
													<tr>
														<td colspan="6">
															<p><strong>Note:</strong><br/>
																- GST is inclusive in the above Startup Booth prices<br/>
																*Less than 5 years old company </p>
															<p><strong>Entitlements</strong><br>		
                                                                &bull;&nbsp;Start-up sponsor showcase area in the exhibition hall<br/>
																&bull;&nbsp;15 MB digital assets ( Video/ Product Brochure) can be uploaded in the exhibition booth<br/>
																&bull;&nbsp;One Contacts and One Video Chat facility<br/>			
																&bull;&nbsp;One Conference Delegate Registration<br/>			
																&bull;&nbsp;One B2B partner delegate registration.<br/>
																&bull;&nbsp;The entire content is available 30 days post the event
															</p>
														</td>
													</tr>
												</tbody>												
											</table>
										</div>
									</div>
									<div class="main-form">
										<?php /*<div class="alert alert-info">
											<span class="block">Dear Sponsor/Exhibitor, <br />Please note: The details   submitted through this form will be published in the Event Document. Please take   necessary precaution to give the correct details.</span>
										</div>*/?>
										
										<div class="form-group">
											<label class="control-label col-md-3"> Select Sector <span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<select id="sector" name="sector" class="form-control" required="required">
													<?php if($assoc_nm == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') {?>
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
										<div class="form-group">
											<label class="control-label col-md-3"> Select Subsector <span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<select id="subsector" name="subsector" class="form-control" required="required" onchange="showOtherDiv();">
													<option value="">-- Select Subsector --</option>
													<?php //$countryList = array('Information Technology'=>'Information Technology', 'Bio Technology'=>'Bio Technology');
														$countryList = array('IT','IoT','AI & ML','AR & VR','Electronics','Smarttech','Fintech','Edutech','Gaming','Biotech','Healthtech','Medtech','Mobility','Robo & Drone','Other');
															foreach ($countryList as $value) {
																$selected = '';
																if($_SESSION['sess_subsector'] == $value) {
																	$selected = 'selected="selected"';
																}
																echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>'; 
															}
														?>
												</select>
											</div>
										</div>
										<div class="form-group" id="other-sector-div" style="display:none;">
											<label class="col-md-3 control-label">Other Sector Name <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input class="form-control" name="other-sector" type="text" id="other-sector" value="<?php echo $_SESSION['sess_other_sector'];  ?>" />
											</div>
										</div>
										<?php /*<div class="form-group">
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
										if($assoc_nm=="STARTUP-ZONE") {?>
											<div class="form-group">
												<label class="col-md-3 control-label">Elevate Winner ID<span class="dips-required"> * </span></label>
												<div class="col-md-6">
													<input class="form-control" name="order_no" type="text" id="order_no" maxlength="100" value="<?php echo $_SESSION['order_no'];?>"/>
												</div>
											</div>
										<?php }
										<div class="form-group">
											<label class="col-md-3 control-label">Booth Size<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input class="form-control" name="booth_size" type="text" id="booth_size" value="<?php echo $_SESSION['sess_booth_size'];?>" required="required"/>
											</div>
										</div>*/?>
										<div class="form-group">
											<label class="col-md-3 control-label">Name of Exhibitor <span style="font-size:10px;">&nbsp;(Organisation Name)</span><span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input class="form-control" name="exhi_name" type="text" id="exhi_name" maxlength="100" value="<?php echo $_SESSION['sess_exhi_name'];  ?>" required="required"/>
											</div>
										</div>
										<?php /*<div class="form-group">
											<label class="control-label col-md-3"> Select Booth Space <span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<select id="booth_space" name="booth_space" class="form-control" required="required">
													<option value="">-- Select Booth Space  --</option>
													<?php $cataList = array('Raw'=>'Raw', 'Shell'=>'Shell');
															//$countryList = array('Information Technology'=>'Information Technology');
															foreach ($cataList as $key=>$value) {
																$selected = '';
																if(isset($_SESSION['sess_booth_booth_space']) && $key==$_SESSION['sess_booth_booth_space']) {
																	$selected = 'selected="selected"';
																}
																echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>'; 
															}
														?>
												</select>
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
										</div>*/?>
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
													<?php $countryList = array("AF"=>"Afghanistan","AL"=>"Albania","DZ"=>"Algeria","AS"=>"AmericanSamoa","AD"=>"Andorra","AO"=>"Angola","AI"=>"Anguilla","AQ"=>"Antarctica","AR"=>"Argentina","AM"=>"Armenia","AW"=>"Aruba","AU"=>"Australia","AT"=>"Austria","AZ"=>"Azerbaijan","BS"=>"Bahamas","BH"=>"Bahrain","BD"=>"Bangladesh","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Belgium","BZ"=>"Belize","BJ"=>"Benin","BM"=>"Bermuda","BT"=>"Bhutan","BO"=>"Bolivia","BA"=>"BosniaandHerzegowina","BW"=>"Botswana","BV"=>"BouvetIsland","BR"=>"Brazil","IO"=>"BritishIndianOceanTerritory","BN"=>"BruneiDarussalam","BG"=>"Bulgaria","BF"=>"BurkinaFaso","BI"=>"Burundi","KH"=>"Cambodia","CM"=>"Cameroon","CA"=>"Canada","CV"=>"CapeVerde","KY"=>"CaymanIslands","CF"=>"CentralAfricanRepublic","TD"=>"Chad","CL"=>"Chile","CN"=>"China","CX"=>"ChristmasIsland","CC"=>"Cocos(Keeling)Islands","CO"=>"Colombia","KM"=>"Comoros","CG"=>"Congo","CD"=>"Congo,theDemocraticRepublicofthe","CK"=>"CookIslands","CR"=>"CostaRica","CI"=>"Coted'Ivoire","HR"=>"Croatia(Hrvatska)","CU"=>"Cuba","CY"=>"Cyprus","CZ"=>"CzechRepublic","DK"=>"Denmark","DJ"=>"Djibouti","DM"=>"Dominica","DO"=>"DominicanRepublic","EC"=>"Ecuador","EG"=>"Egypt","SV"=>"ElSalvador","GQ"=>"EquatorialGuinea","ER"=>"Eritrea","EE"=>"Estonia","ET"=>"Ethiopia","FK"=>"FalklandIslands(Malvinas)","FO"=>"FaroeIslands","FJ"=>"Fiji","FI"=>"Finland","FR"=>"France","GF"=>"FrenchGuiana","PF"=>"FrenchPolynesia","TF"=>"FrenchSouthernTerritories","GA"=>"Gabon","GM"=>"Gambia","GE"=>"Georgia","DE"=>"Germany","GH"=>"Ghana","GI"=>"Gibraltar","GR"=>"Greece","GL"=>"Greenland","GD"=>"Grenada","GP"=>"Guadeloupe","GU"=>"Guam","GT"=>"Guatemala","GN"=>"Guinea","GW"=>"Guinea-Bissau","GY"=>"Guyana","HT"=>"Haiti","HM"=>"HeardandMcDonaldIslands","VA"=>"HolySee(VaticanCityState)","HN"=>"Honduras","HK"=>"HongKong","HU"=>"Hungary","IS"=>"Iceland","IN"=>"India","ID"=>"Indonesia","IR"=>"Iran(IslamicRepublicof)","IQ"=>"Iraq","IE"=>"Ireland","IL"=>"Israel","IT"=>"Italy","JM"=>"Jamaica","JP"=>"Japan","JO"=>"Jordan","KZ"=>"Kazakhstan","KE"=>"Kenya","KI"=>"Kiribati","KP"=>"Korea,DemocraticPeople'sRepublicof","KR"=>"Korea,Republicof","KW"=>"Kuwait","KG"=>"Kyrgyzstan","LA"=>"LaoPeople'sDemocraticRepublic","LV"=>"Latvia","LB"=>"Lebanon","LS"=>"Lesotho","LR"=>"Liberia","LY"=>"LibyanArabJamahiriya","LI"=>"Liechtenstein","LT"=>"Lithuania","LU"=>"Luxembourg","MO"=>"Macau","MK"=>"Macedonia,TheFormerYugoslavRepublicof","MG"=>"Madagascar","MW"=>"Malawi","MY"=>"Malaysia","MV"=>"Maldives","ML"=>"Mali","MT"=>"Malta","MH"=>"MarshallIslands","MQ"=>"Martinique","MR"=>"Mauritania","MU"=>"Mauritius","YT"=>"Mayotte","MX"=>"Mexico","FM"=>"Micronesia,FederatedStatesof","MD"=>"Moldova,Republicof","MC"=>"Monaco","MN"=>"Mongolia","MS"=>"Montserrat","MA"=>"Morocco","MZ"=>"Mozambique","MM"=>"Myanmar","NA"=>"Namibia","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Netherlands","AN"=>"NetherlandsAntilles","NC"=>"NewCaledonia","NZ"=>"NewZealand","NI"=>"Nicaragua","NE"=>"Niger","NG"=>"Nigeria","NU"=>"Niue","NF"=>"NorfolkIsland","MP"=>"NorthernMarianaIslands","NO"=>"Norway","OM"=>"Oman","PK"=>"Pakistan","PW"=>"Palau","PA"=>"Panama","PG"=>"PapuaNewGuinea","PY"=>"Paraguay","PE"=>"Peru","PH"=>"Philippines","PN"=>"Pitcairn","PL"=>"Poland","PT"=>"Portugal","PR"=>"PuertoRico","QA"=>"Qatar","RE"=>"Reunion","RO"=>"Romania","RU"=>"RussianFederation","RW"=>"Rwanda","KN"=>"SaintKittsandNevis","LC"=>"SaintLUCIA","VC"=>"SaintVincentandtheGrenadines","WS"=>"Samoa","SM"=>"SanMarino","ST"=>"SaoTomeandPrincipe","SA"=>"SaudiArabia","SN"=>"Senegal","SC"=>"Seychelles","SL"=>"SierraLeone","SG"=>"Singapore","SK"=>"Slovakia(SlovakRepublic)","SI"=>"Slovenia","SB"=>"SolomonIslands","SO"=>"Somalia","ZA"=>"SouthAfrica","GS"=>"SouthGeorgiaandtheSouthSandwichIslands","ES"=>"Spain","LK"=>"SriLanka","SH"=>"St.Helena","PM"=>"St.PierreandMiquelon","SD"=>"Sudan","SR"=>"Suriname","SJ"=>"SvalbardandJanMayenIslands","SZ"=>"Swaziland","SE"=>"Sweden","CH"=>"Switzerland","SY"=>"SyrianArabRepublic","TW"=>"Taiwan","TJ"=>"Tajikistan","TZ"=>"Tanzania,UnitedRepublicof","TH"=>"Thailand","TG"=>"Togo","TK"=>"Tokelau","TO"=>"Tonga","TT"=>"TrinidadandTobago","TN"=>"Tunisia","TR"=>"Turkey","TM"=>"Turkmenistan","TC"=>"TurksandCaicosIslands","TV"=>"Tuvalu","UG"=>"Uganda","UA"=>"Ukraine","AE"=>"UnitedArabEmirates","GB"=>"UnitedKingdom","US"=>"UnitedStates","UM"=>"UnitedStatesMinorOutlyingIslands","UY"=>"Uruguay","UZ"=>"Uzbekistan","VU"=>"Vanuatu","VE"=>"Venezuela","VN"=>"VietNam","VG"=>"VirginIslands(British)","VI"=>"VirginIslands(U.S.)","WF"=>"WallisandFutunaIslands","EH"=>"WesternSahara","YE"=>"Yemen","ZM"=>"Zambia","ZW"=>"Zimbabwe");
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
											<label class="col-md-3 control-label">Telephone Number<span class="dips-required"> * </span></label>
											<div class="col-md-6" style="margin-top: -15px;">
												<span type="tel" id="telCountryIsoCode" data-fax-iso-code-hidden-field-name="foneCountryCode"></span>
												<input type="hidden" name="foneCountryCode" id="foneCountryCode" value="<?php echo @$_SESSION['sess_foneCountryCode'];?>"/>
												<input type="hidden" id="foneCountryCodeIso" name="foneCountryCodeIso"/>
												<input name="fon" type="text" id="fon" class="form-control" maxlength="20" value="<?php echo @$_SESSION['sess_fon'];?>" style="padding-left: 92px;" required/>
												<span class="help-block">+Country Code-Area Code-Phone Number(Eg. 91-123412345)</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">GST Number<span class="dips-required"> * </span></label>
											<div class="col-md-3">
												<select id="gst" name="gst" class="form-control" onchange="hidegst();" required="required">
													<option value="">- Select -</option>
													<option value="Registered" <?php if(!empty($_SESSION['gst']) && $_SESSION['gst'] != 'Unregistered')echo 'selected=selected';?> >Registered</option>
													<option value="Unregistered" <?php if(!empty($_SESSION['gst']) && $_SESSION['gst'] == 'Unregistered')echo 'selected=selected';?>>Unregistered(Not Available)</option>
												</select>
											</div>
											<div class="col-md-3" style="display:none;" id="gst-div">
												<input type="text" class="form-control" name="gst_number" id="gst_number" value="<?php echo $_SESSION['gst_number']; ?>" placeholder="Enter GST Number" maxlength="15" />
											</div>	
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">PAN Number<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="pan_number" id="pan_number" value="<?php echo $_SESSION['pan_number']; ?>" maxlength="12" required />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Contact Person Name <span class="dips-required"> * </span></label>
											<div class="col-md-2">
												<select class="form-control" name="cp_title" id="cp_title" required="required">
													<option value="">-Title-</option>
													<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
														foreach ($titleList as $title) {
															$selected = '';
															if($_SESSION['sess_cp_title'] == $title){
																$selected = 'selected="selected"';
															}
															echo '<option value="' . $title . '" ' . $selected . '>' . $title . '</option>';
														}
														?>
												</select>
											</div>
											<div class="col-md-2"><input type="text" class="form-control" placeholder="First Name" name="cp_fname" type="text" id="cp_fname" maxlength="100" value="<?php echo $_SESSION['sess_cp_fname']; ?>" required="required"></div>
											<div class="col-md-2"><input type="text" class="form-control" placeholder="Last Name" name="cp_lname" type="text" id="cp_lname" maxlength="100" value="<?php echo $_SESSION['sess_cp_lname']; ?>" required="required"></div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Contact Person Email <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input type="email" class="form-control" name="email" id="email" value="<?php echo $_SESSION['sess_email']; ?>" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Contact Person Mobile<span class="dips-required"> * </span></label>
											<div class="col-md-6" style="margin-top: -15px;">
												<span type="tel" id="mobile-country-code" data-fax-iso-code-hidden-field-name="cellnoCountryCode" class="hide"></span>
												<input type="hidden" name="cellnoCountryCode" id="cellnoCountryCode" value="<?php echo @$_SESSION['sess_cellnoCountryCode'];?>"/>
												<input type="hidden" id="cellnoCountryCodeIso" name="cellnoCountryCodeIso"/>
												<input name="mob" type="text" id="mob" class="form-control" maxlength="10" value="<?php echo @$_SESSION['sess_mob'];?>" required onkeyup="check_num(event, 'mob');" style="padding-left: 92px;"/>
												<span class="help-block">+Country Code-Mobile Number(xxx-xxxxxxxxxx)</span>
											</div>
										</div>
										<?php for($i = 1; $i <= 4; $i++) {?>
											<h4>Please nominate Conference Delegate <?php echo $i;?> <span class="dips-required"> <?php if($i == 1){?>*<?php }?> </span>:</h4>
											<div class="form-group">
												<label class="control-label col-md-3">Delegate Name <span class="dips-required"> <?php if($i == 1){?>*<?php }?> </span></label>
												<div class="col-md-2">
													<select class="form-control" name="del_title<?php echo $i;?>" id="del_title<?php echo $i;?>" <?php if($i == 1){?>required="required"<?php }?>>
														<option value="">-Title-</option>
														<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
															foreach ($titleList as $title) {
																$selected = '';
																if($_SESSION['sess_del_title'] == $title){
																	$selected = 'selected="selected"';
																}
																echo '<option value="' . $title . '" ' . $selected . '>' . $title . '</option>';
															}
															?>
													</select>
												</div>
												<div class="col-md-2"><input type="text" class="form-control" placeholder="First Name" name="del_fname<?php echo $i;?>" type="text" id="del_fname<?php echo $i;?>" maxlength="100" value="<?php echo @$_SESSION['sess_del_fname']; ?>" <?php if($i == 1){?>required="required"<?php }?>></div>
												<div class="col-md-2"><input type="text" class="form-control" placeholder="Last Name" name="del_lname<?php echo $i;?>" type="text" id="del_lname<?php echo $i;?>" maxlength="100" value="<?php echo @$_SESSION['sess_del_lname']; ?>" <?php if($i == 1){?>required="required"<?php }?>></div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Delegate Email <span class="dips-required"> <?php if($i == 1){?>*<?php }?> </span></label>
												<div class="col-md-6">
													<input type="email" class="form-control" name="del_email<?php echo $i;?>" id="del_email<?php echo $i;?>" value="<?php echo $_SESSION['sess_del_email']; ?>" <?php if($i == 1){?>required="required"<?php }?>/>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Delegate Mobile<span class="dips-required"> <?php if($i == 1){?>*<?php }?> </span></label>
												<div class="col-md-6" style="margin-top: -15px;">
													<span type="tel" id="del-mobile-country-code<?php echo $i;?>" data-fax-iso-code-hidden-field-name="del_cellnoCountryCode<?php echo $i;?>" class="hide"></span>
													<input type="hidden" name="del_cellnoCountryCode<?php echo $i;?>" id="del_cellnoCountryCode<?php echo $i;?>" value="<?php echo @$_SESSION['sess_del_cellnoCountryCode'];?>"/>
													<input type="hidden" id="del_cellnoCountryCodeIso<?php echo $i;?>" name="del_cellnoCountryCodeIso<?php echo $i;?>"/>
													<input name="del_mob<?php echo $i;?>" type="text" id="del_mob<?php echo $i;?>" class="form-control" maxlength="10" value="<?php echo @$_SESSION['sess_del_mob'];?>" <?php if($i == 1){?>required="required"<?php }?> onkeyup="check_num(event, 'del_mob<?php echo $i;?>');" style="padding-left: 92px;"/>
													<span class="help-block">+Country Code-Mobile Number(xxx-xxxxxxxxxx)</span>
												</div>
											</div>
										<?php }?>
										<h4>Please nominate B2B Partnering Delegate <span class="dips-required"> * </span>:</h4>
										<div class="form-group">
											<label class="col-md-3 control-label"></label>
											<div class="col-md-6">
												<label><input type="checkbox" id="sameas" onchange="addvalues();"/>Is B2B partnering delegate same as conference delegate 1</label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Partnering Delegate Name <span class="dips-required"> * </span></label>
											<div class="col-md-2">
												<select class="form-control" name="part_title" id="part_title" required="required">
													<option value="">-Title-</option>
													<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
														foreach ($titleList as $title) {
															$selected = '';
															if($_SESSION['sess_part_title'] == $title){
																$selected = 'selected="selected"';
															}
															echo '<option value="' . $title . '" ' . $selected . '>' . $title . '</option>';
														}
														?>
												</select>
											</div>
											<div class="col-md-2"><input type="text" class="form-control" placeholder="First Name" name="part_fname" type="text" id="part_fname" maxlength="100" value="<?php echo $_SESSION['sess_part_fname']; ?>" required="required"></div>
											<div class="col-md-2"><input type="text" class="form-control" placeholder="Last Name" name="part_lname" type="text" id="part_lname" maxlength="100" value="<?php echo $_SESSION['sess_part_lname']; ?>" required="required"></div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Partnering Delegate Email <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input type="email" class="form-control" name="part_email" id="part_email" value="<?php echo $_SESSION['sess_part_email']; ?>" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Partnering Delegate Mobile<span class="dips-required"> * </span></label>
											<div class="col-md-6" style="margin-top: -15px;">
												<span type="tel" id="part-mobile-country-code" data-fax-iso-code-hidden-field-name="part_cellnoCountryCode" class="hide"></span>
												<input type="hidden" name="part_cellnoCountryCode" id="part_cellnoCountryCode" value="<?php echo @$_SESSION['sess_part_cellnoCountryCode'];?>"/>
												<input type="hidden" id="part_cellnoCountryCodeIso" name="part_cellnoCountryCodeIso"/>
												<input name="part_mob" type="text" id="part_mob" class="form-control" maxlength="10" value="<?php echo @$_SESSION['sess_part_mob'];?>" required onkeyup="check_num(event, 'part_mob');" style="padding-left: 92px;"/>
												<span class="help-block">+Country Code-Mobile Number(xxx-xxxxxxxxxx)</span>
											</div>
										</div>
										<?php /*<div class="form-group form-md-radios">
											<label class="control-label col-md-3">Payment Mode <span class="required"> * </span> </label>
											<div class="col-md-9">
												<div class="md-radio-inline">
													<div class="md-radio">
														<input type="radio" id="Cc" name="paymode" class="md-radiobtn" value="Credit Card" onclick="showTxt();" checked="checked">
														<label for="Cc">
														<span></span>
														<span class="check"></span>
														<span class="box"></span> CCAvenue Payment - Credit Card / Debit Card / Net Banking / Google Pay / PhonePe / Paytm
														</label>													
														<span class="help-block indian-tariff">Please Note: <?php echo $CC_IND_PROCESSING_CHARGE_PER;?>% processing charges is applicable for CCAVenue payment mode.</span>											
														<span class="help-block international-tariff">Please Note: <?php echo $CC_INT_PROCESSING_CHARGE_PER;?>% processing charges is applicable for CCAVenue payment mode.</span>
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
													<div class="md-radio hide">
														<input type="radio" id="Cheque" name="paymode" class="md-radiobtn" value="Cheque" onclick="showTxt();" >
														<label for="Cheque">
														<span></span>
														<span class="check"></span>
														<span class="box"></span> Cheque / DD
														</label>
													</div>
													<div class="md-radio hide">
														<input type="radio" id="BT" name="paymode" class="md-radiobtn" value="Bank Transfer" onclick="showTxt();" >
														<label for="BT">
														<span></span>
														<span class="check"></span>
														<span class="box"></span> Bank Transfer<strong>(Offline)</strong> / NEFT / RTGS / IMPS
														</label>
													</div>
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
										</div>*/?>
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
															<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:adarsh.accounts@mmactiv.com">adarsh.accounts@mmactiv.com</a></td>
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
																</p>
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
															<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:adarsh.accounts@mmactiv.com">adarsh.accounts@mmactiv.com</a></td>
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
															<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:adarsh.accounts@mmactiv.com">adarsh.accounts@mmactiv.com</a></td>
														</tr>
													</tbody>
												</table>
												<table class="table table-striped table-bordered well" id="bcheque" style="display: none;">
													<tbody>
														<tr>
															<td style="border: medium none;"></td>
															<td style="border: medium none; width: 99%;">
																<p>
																	Please send your Cheque/DD in favour of <?php echo $EVENT_CHEQUE_PAYBLE_AT_NAME;?> payable at <?php echo $EVENT_CHEQUE_PAYBLE_AT;?>.<br />
																	Along with the copy of your registration receipt and send to<br />
																	<strong>Address :</strong><br/><?php echo $EVENT_CHEQUE_PAYBLE_ADDRESS;?>
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
													<input name="vercode_ex" type="text" class="form-control" id="vercode_ex" maxlength="10" required autocomplete="off"/>
													<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_ex"];?>" />
													<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $text;?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions main-form">
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
					<h1><?php echo $assoc_nm;?>  Online Startup Registrations for <?php echo $EVENT_NAME . ' ' . $EVENT_YEAR;?> is closed.</h1>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/reg_form_footer.php';?>
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script src="js/exhibitor-payment.js?546asd45"></script>
<script>
	jQuery(document).ready(function() {  
		Registration.init('registration_form_1', 0);
	
		<?php if(!empty($_SESSION['foneCountryIso'])) { ?>
			$("#telCountryIsoCode").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['foneCountryIso'];?>" ]});
		<?php } else {?>
			$("#telCountryIsoCode").intlTelInput();
		<?php }?>
	
		 <?php if(!empty($_SESSION['cellnoCountryCodeIso'])) { ?>
		 	$("#mobile-country-code").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['cellnoCountryCodeIso'];?>" ]});
		 <?php } else {?>
			 $("#mobile-country-code").intlTelInput();
		 <?php } ?>
	
		<?php if(!empty($_SESSION['del_cellnoCountryCodeIso1'])) { ?>
			$("#del-mobile-country-code1").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['del_cellnoCountryCodeIso1'];?>" ]});
		<?php } else {?>
			$("#del-mobile-country-code1").intlTelInput();
		<?php } ?>
	
		<?php if(!empty($_SESSION['del_cellnoCountryCodeIso2'])) { ?>
			$("#del-mobile-country-code2").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['del_cellnoCountryCodeIso2'];?>" ]});
		<?php } else {?>
			$("#del-mobile-country-code2").intlTelInput();
		<?php } ?>
		<?php if(!empty($_SESSION['del_cellnoCountryCodeIso3'])) { ?>
			$("#del-mobile-country-code3").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['del_cellnoCountryCodeIso3'];?>" ]});
		<?php } else {?>
			$("#del-mobile-country-code3").intlTelInput();
		<?php } ?>
		<?php if(!empty($_SESSION['del_cellnoCountryCodeIso4'])) { ?>
			$("#del-mobile-country-code4").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['del_cellnoCountryCodeIso4'];?>" ]});
		<?php } else {?>
			$("#del-mobile-country-code4").intlTelInput();
		<?php } ?>
	
		<?php if(!empty($_SESSION['part_cellnoCountryCodeIso'])) { ?>
			$("#part-mobile-country-code").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['part_cellnoCountryCodeIso'];?>" ]});
		<?php } else {?>
			$("#part-mobile-country-code").intlTelInput();
		<?php } ?>

		$("#fon").inputFilter(function(value) {
			return /^\d*$/.test(value); 
		});

		$("#mob").inputFilter(function(value) {
			return /^\d*$/.test(value); 
		});

		$("#del_mob").inputFilter(function(value) {
			return /^\d*$/.test(value); 
		});

		$("#part_mob").inputFilter(function(value) {
			return /^\d*$/.test(value); 
		});

		$(document).on('change',"#gst_number", function(){    
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
		$('#booth_size1').trigger('click');
		hidegst();
		//showForm();
		show_cata();
	});
	function hidegst() {
		$('#gst-div').hide();
		if($('#gst').val() == 'Registered') {
			$('#gst-div').show();
		}
	}

	function showForm() {
		if (document.getElementById("booth_size1").checked == true) {
			$('.main-form').show();
		} else if (document.getElementById("booth_size2").checked == true) {
			$('.main-form').show();
		} else {
			$('.main-form').hide();
		}
	}

	function showOtherDiv() {
		$('#other-sector-div').hide();
		if (document.getElementById("sector").value == 'Other') {
			$('#other-sector-div').show();
		}
	}

  function show_cata() {
	if ( document.getElementById("Indian").checked == true) {
		$('.international-tariff').hide();
    	$('.indian-tariff').show();
	} else if ( document.getElementById("Foreign").checked == true) {
		$('.international-tariff').show();
    	$('.indian-tariff').hide();
	}

	/*if (document.getElementById("BT").checked == true) {
    	if (document.getElementById("Indian").checked == true) {
			document.getElementById("bank_transfer1").style.display = "block";
			document.getElementById("bank_transfer2").style.display = "none";
    	} else if (document.getElementById("Foreign").checked == true) {
			document.getElementById("bank_transfer2").style.display = "block";
			document.getElementById("bank_transfer1").style.display = "none";
    	}
    }*/
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

	function addvalues() {
		if (document.getElementById("sameas").checked == true) {
			$('#part_title').val($('#del_title1').val());
			$('#part_fname').val($('#del_fname1').val());
			$('#part_lname').val($('#del_lname1').val());
			$('#part_email').val($('#del_email1').val());
			$('#part_mob').val($('#del_mob1').val());
		}
	}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
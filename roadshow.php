<?php

require "includes/form_constants_both.php";
require "enquiry_captcha.php";

$temp_find_us = @$_REQUEST['find_us'];
$temp_find_us = trim($temp_find_us);

$delegate_type = @$_GET['dele_typ'];
$event_name = 'Bangalore IT';
if (isset($_GET['en']) && !empty($_GET['en'])) {
	$event_name = 'Bangalore INDIA BIO';
}
?>

<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />';
require 'includes/reg_form_header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="enq_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Virtual Roadshow Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="roadshow_info.php" class="form-horizontal" id="enq" name="enq" method="post"
					onsubmit="return validateEnquiry('<?php echo $EVENT_NAME; ?>');">
					<input type="hidden" name="event_name" value="<?php echo $event_name; ?>" />
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a class="step">
										<span class="number"> 1 </span>
										<span class="desc">
											<i class="fa fa-check"></i>User Details </span>
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
									<div class="form-group">
										<label class="control-label col-md-3"> Select Sector <span class="required"> *
											</span>
										</label>
										<div class="col-md-6">
											<select id="sector" name="sector" class="form-control" required="required">
												<option value="">-- Select Sector --</option>
												<?php $countryList = array(
													"Information Technology" => "Information Technology",
												    "Electronics & Semiconductor" => "Electronics & Semiconductor",
												    "Drones & Robotics" => "Drones & Robotics",
												    "EV, Energy, Climate, Water, Soil, GSDI" => "EV, Energy, Climate, Water, Soil, GSDI",
												    "Telecommunications" => "Telecommunications",
												    "Cybersecurity" => "Cybersecurity",
												    "Artificial Intelligence" => "Artificial Intelligence", 
												    "Cloud Services" => "Cloud Services",
												    "E-Commerce" => "E-Commerce",
												    "Automation" => "Automation",
												    "AVGC" => "AVGC",
												    "Aerospace, Defence & Space Tech" => "Aerospace, Defence & Space Tech", 
												    "Infrastructure" => "Infrastructure",
												    "Biotech" => "Biotech",
												    "Agritech" => "Agritech",
												    "Medtech" => "Medtech",
												    "Fintech" => "Fintech",
												    "Healthtech" => "Healthtech",
												    "Edutech" => "Edutech", 
												    "Startup" => "Startup",
												    "Unicorn/ VCs" => "Unicorn/ VCs",
												    "Academia & University" => "Academia & University", 
												    "Tech Parks / Co-Working Spaces of India" => "Tech Parks / Co-Working Spaces of India",
												    "Banking / Insurance" => "Banking / Insurance",
												    "R&D and Central Govt." => "R&D and Central Govt.",
												    "Others" => "Others"
												);
												//$countryList = array('Information Technology'=>'Information Technology');
												
												foreach ($countryList as $key => $value) {
													echo '<option value="' . $key . '">' . $value . '</option>';
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
											<label class="control-label col-md-3"> Organisation Type<span class="required">
													* </span>
											</label>
											<div class="col-md-6">
												<select id="org_reg_type" name="org_reg_type" class="form-control"
													required="required" onchange="showPayment();">
													<option value="">-- Select Organisation Type --</option>
													<?php
													$countryList = [
														"Startup" => "Startup",
														"MSME" => "MSME",
														'Traditional Businesses' => 'Traditional Businesses',
														'Incubator' => 'Incubator',
														'Accelerator' => 'Accelerator',
														'Institutional Investor' => 'Institutional Investor',
														'Academic Institution' => 'Academic Institution',
														"Corporate / Industry" => "Corporate / Industry",
														"R&D Labs" => "R&D Labs",
														"Investors" => "Investors",
														"Government" => "Government",
														"Industry Associations" => "Industry Associations",
														"Consulting" => "Consulting",
														"Trade Mission" => "Trade Mission",
														'Service Enabler / Consulting' => 'Service Enabler / Consulting',
														'Trade Mission / Embassay' => 'Trade Mission / Embassay',
														'Students' => 'Students',
														"Others" => "Others",
													];
													foreach ($countryList as $key => $value) {
														$selected = "";
														if (
															isset($_SESSION["org_reg_type"]) &&
															$_SESSION["org_reg_type"] == $value
														) {
															$selected = "selected=selected";
														}
														echo '<option value="' .
															$key .
															'" ' .
															$selected .
															">" .
															$value .
															"</option>";
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group">
										<label class="col-md-3 control-label">Organisation <span class="dips-required">
												* </span></label>
										<div class="col-md-6">
											<input class="form-control" name="company" type="text" id="company"
												required="required" />
										</div>
									</div>

									<?php
									$timezones = DateTimeZone::listIdentifiers();
									?>
									<div class="form-group">
										<label class="col-md-3 control-label">Select Preferred  Time-Zone , Date &amp; Time for Virtual Roadshow<span class="dips-required"> * </span></label>
										<div class="col-md-2">
											<select class="form-control" name="timezone" id="timezone" required="required">
												<option value="">-- Select Time-Zone --</option>
												<?php
												foreach ($timezones as $tz) {
													// Show offset for better UX
													$dt = new DateTime('now', new DateTimeZone($tz));
													$offset = $dt->format('P');
													echo '<option value="' . htmlspecialchars($tz) . ' (UTC' . $offset . ')">' . htmlspecialchars($tz) . ' (UTC' . $offset . ')</option>';
												}
												?>
											</select>
										</div>
										<div class="col-md-2">
											<input class="form-control" name="preferred_date" type="date" id="preferred_date" required="required" max="2025-12-31" min="2025-01-01"/>
										</div>
										<div class="col-md-2">
											<input class="form-control" name="preferred_time" type="time" id="preferred_time" required="required" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Corresponding to IST</label>
										<div class="col-md-6">
											<div id="ist-conversion" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px; background: #f9f9f9; font-weight: bold; min-height: 32px;"></div>
											<input type="hidden" name="ist_converted_datetime" id="ist_converted_datetime" />
										</div>
									</div>
									<script>
									
											function updateISTConversion() {
												const tzSelect = document.getElementById('timezone');
												const dateInput = document.getElementById('preferred_date');
												const timeInput = document.getElementById('preferred_time');
												const istDiv = document.getElementById('ist-conversion');
												const istHidden = document.getElementById('ist_converted_datetime');

												const tzValue = tzSelect.value;
												const dateValue = dateInput.value;
												const timeValue = timeInput.value;

												if (!tzValue || !dateValue || !timeValue) {
													istDiv.textContent = '';
													if (istHidden) istHidden.value = '';
													return;
												}

												// Extract timezone identifier from value like "America/New_York (UTC-05:00)"
												const timezoneIdentifier = tzValue.split(' (UTC')[0];

												// Compose datetime string in ISO format
												const localDateTimeStr = `${dateValue}T${timeValue}:00`;

												try {
													// Create date in selected timezone using luxon for reliable conversion
													if (typeof luxon === 'undefined') {
														istDiv.textContent = 'Loading...';
														if (istHidden) istHidden.value = '';
														return;
													}
													const DateTime = luxon.DateTime;
													const local = DateTime.fromISO(localDateTimeStr, { zone: timezoneIdentifier });
													const ist = local.setZone('Asia/Kolkata');

													if (!local.isValid || !ist.isValid) {
														istDiv.textContent = '';
														if (istHidden) istHidden.value = '';
														return;
													}

													// Format the display text with only IST
													const displayText = `IST: ${ist.toFormat('dd MMM yyyy, HH:mm')}`;
													istDiv.textContent = displayText;
													if (istHidden) istHidden.value = ist.toFormat('yyyy-MM-dd HH:mm');
												} catch (e) {
													istDiv.textContent = '';
													if (istHidden) istHidden.value = '';
												}
											}

									// Use Luxon for timezone conversion
									(function loadLuxon() {
										if (typeof luxon === 'undefined') {
											var script = document.createElement('script');
											script.src = "https://cdn.jsdelivr.net/npm/luxon@3.4.4/build/global/luxon.min.js";
											script.onload = function() {
												document.getElementById('timezone').addEventListener('change', updateISTConversion);
												document.getElementById('preferred_date').addEventListener('change', updateISTConversion);
												document.getElementById('preferred_time').addEventListener('change', updateISTConversion);
											};
											document.head.appendChild(script);
										} else {
											document.getElementById('timezone').addEventListener('change', updateISTConversion);
											document.getElementById('preferred_date').addEventListener('change', updateISTConversion);
											document.getElementById('preferred_time').addEventListener('change', updateISTConversion);
										}
									})();
									</script>

									<!-- <div class="form-group">
										<label class="col-md-3 control-label">
											Preferred Date &amp; Time for Virtual Roadshow <span class="dips-required"> * </span>
											
											
										</label>
										
										<div class="col-md-3">
											<input class="form-control" name="preferred_date" type="date" id="preferred_date" required="required" max="2025-12-31" min="2025-01-01"/>
										</div>
										<div class="col-md-3">
											<input class="form-control" name="preferred_time" type="time" id="preferred_time" required="required" />
										</div>
										
									</div> -->
									<div class="form-group">
										<label class="control-label col-md-3"> Contact Person Name <span class="dips-required"> *
											</span></label>
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
										<div class="col-md-2"><input type="text" class="form-control"
												placeholder="First Name" name="fname" type="text" id="fname"
												maxlength="100" onkeyup="check_char(event,'fname');"
												required="required"></div>
										<div class="col-md-2"><input type="text" class="form-control"
												placeholder="Last Name" name="lname" type="text" id="lname"
												maxlength="100" onkeyup="check_char(event,'lname');"
												required="required"></div>
									</div>
									
									

									
									<!-- <div class="form-group">
										<label class="col-md-3 control-label">Designation <span class="dips-required"> *
											</span></label>
										<div class="col-md-6">
											<input class="form-control" name="desig" type="text" id="desig"
												required="required" />
										</div>
									</div> -->
									<div class="form-group">
										<label class="col-md-3 control-label">Email Address <span class="dips-required">
												* </span></label>
										<div class="col-md-6">
											<input class="form-control" name="email" type="email" id="email"
												required="required" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Contact Number <span class="dips-required">
										* </span></label>
										<div class="col-md-6" style="margin-top: -20px;">
											<span type="tel" id="mobile-country-code"
												data-fax-iso-code-hidden-field-name="foneCountryCode"></span>
											<input type="hidden" name="foneCountryCode" id="foneCountryCode" />
											<input type="hidden" id="foneCountryCodeIso" name="foneCountryCodeIso" />
											<input class="form-control" name="fone" type="text" id="fone" maxlength="10"
												onkeyup="check_num(event, 'fone');" style="padding-left: 92px;"required="required" />
										</div>
									</div>
									<!-- <div class="form-group">
										<label class="col-md-3 control-label">Comment <span class="dips-required"> *
											</span></label>
										<div class="col-md-6">
											<textarea name="comment" id="comment" rows="" cols="" required="required"
												class="form-control"></textarea>
										</div>
									</div> -->

									<div class="form-group">

										<label class="control-label col-md-3"> Country <span class="required"> * </span>
										</label>

										<div class="col-md-6">

											<select id="country" name="country" class="form-control" required="required" onchange="fetchStates()">
												<option value="">-- Select Country --</option>
											</select>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">State <span class="dips-required"> * </span></label>

										<div class="col-md-6">


											<select id="state" name="state" class="form-control" required="required" onchange="fetchCities()">
												<option value="">-- Select State --</option>
											</select>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">City <span class="dips-required"> * </span></label>

										<div class="col-md-6">


											<select id="city" name="city" class="form-control" required="required">
												<option value="">-- Select City --</option>
											</select>

										</div>

									</div>
									<script>
										var apiKey = "WTYxaXZYcmVlbU1Mdzd2MVZxc00yd1BHUEZGUGFLR1NYRTYxQmthOA==";

										// Fetch Countries
										fetch('https://api.countrystatecity.in/v1/countries', {
												method: 'GET',
												headers: {
													'X-CSCAPI-KEY': apiKey
												}
											})
											.then(response => response.json())
											.then(countries => {
												const countrySelect = document.getElementById('country');
												countries.sort((a, b) => a.name.localeCompare(b.name));

												countries.forEach(country => {
													const option = document.createElement('option');
													option.value = country.name; // Store Country Name instead of ID
													option.setAttribute('data-iso', country.iso2); // Store ISO2 for fetching states
													option.textContent = country.name;
													countrySelect.appendChild(option);
												});
											})
											.catch(error => console.error('Error fetching countries:', error));

										// Fetch States
										function fetchStates() {
											const countrySelect = document.getElementById('country');
											const countryName = countrySelect.value;
											const countryISO = countrySelect.options[countrySelect.selectedIndex].getAttribute('data-iso');
											const stateSelect = document.getElementById('state');
											const citySelect = document.getElementById('city');

											// Reset State and City dropdown
											stateSelect.innerHTML = '<option value="">-- Select State --</option>';
											citySelect.innerHTML = '<option value="">-- Select City --</option>';

											if (countryISO === null || countryISO === '') return;

											fetch(`https://api.countrystatecity.in/v1/countries/${countryISO}/states`, {
													method: 'GET',
													headers: {
														'X-CSCAPI-KEY': apiKey
													}
												})
												.then(response => response.json())
												.then(states => {
													if (states.length === 0) {
														// If no states, automatically assign Country Name to State and City
														const option = document.createElement('option');
														option.value = countryName;
														option.textContent = countryName;
														stateSelect.appendChild(option);
														citySelect.appendChild(option.cloneNode(true));
													} else {
														// Sort States Alphabetically
														states.sort((a, b) => a.name.localeCompare(b.name));
														states.forEach(state => {
															const option = document.createElement('option');
															option.value = state.name; // Store State Name instead of ID
															option.setAttribute('data-iso', state.iso2);
															option.textContent = state.name;
															stateSelect.appendChild(option);
														});
													}
												})
												.catch(error => console.error('Error fetching states:', error));
										}

										// Fetch Cities
										function fetchCities() {
											const countrySelect = document.getElementById('country');
											const stateSelect = document.getElementById('state');
											const citySelect = document.getElementById('city');

											const countryName = countrySelect.value;
											const stateName = stateSelect.value;
											const countryISO = countrySelect.options[countrySelect.selectedIndex].getAttribute('data-iso');
											const stateISO = stateSelect.options[stateSelect.selectedIndex].getAttribute('data-iso');

											citySelect.innerHTML = '<option value="">-- Select City --</option>';

											if (!stateISO) {
												// If no city, use State Name as City
												const option = document.createElement('option');
												option.value = stateName;
												option.textContent = stateName;
												citySelect.appendChild(option);
												return;
											}

											fetch(`https://api.countrystatecity.in/v1/countries/${countryISO}/states/${stateISO}/cities`, {
													method: 'GET',
													headers: {
														'X-CSCAPI-KEY': apiKey
													}
												})
												.then(response => response.json())
												.then(cities => {
													if (cities.length === 0) {
														// If no cities, use State Name as City
														const option = document.createElement('option');
														option.value = stateName;
														option.textContent = stateName;
														citySelect.appendChild(option);
													} else {
														cities.sort((a, b) => a.name.localeCompare(b.name));
														cities.forEach(city => {
															const option = document.createElement('option');
															option.value = city.name;
															option.textContent = city.name;
															citySelect.appendChild(option);
														});
													}
												})
												.catch(error => console.error('Error fetching cities:', error));
										}
									</script>
									<!-- <div class="form-group">
										<label class="col-md-3 control-label">City <span class="dips-required"> *
											</span></label>
										<div class="col-md-6">
											<input class="form-control" name="city" type="text" id="city"
												required="required" onkeyup="check_char(event,'city');" />
										</div>
									</div> -->
									<!-- <div class="form-group">
										<label class="control-label col-md-3"> Country <span class="required"> * </span>
										</label>
										<div class="col-md-6">
											<select id="country" name="country" class="form-control"
												required="required">
												<option value="">-- Select Country --</option>
												<?php /* $countryList = array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "AmericanSamoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "BosniaandHerzegowina", "BW" => "Botswana", "BV" => "BouvetIsland", "BR" => "Brazil", "IO" => "BritishIndianOceanTerritory", "BN" => "BruneiDarussalam", "BG" => "Bulgaria", "BF" => "BurkinaFaso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "CapeVerde", "KY" => "CaymanIslands", "CF" => "CentralAfricanRepublic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "ChristmasIsland", "CC" => "Cocos(Keeling)Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo,theDemocraticRepublicofthe", "CK" => "CookIslands", "CR" => "CostaRica", "CI" => "Coted'Ivoire", "HR" => "Croatia(Hrvatska)", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "CzechRepublic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "DominicanRepublic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "ElSalvador", "GQ" => "EquatorialGuinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "FalklandIslands(Malvinas)", "FO" => "FaroeIslands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "FrenchGuiana", "PF" => "FrenchPolynesia", "TF" => "FrenchSouthernTerritories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "HeardandMcDonaldIslands", "VA" => "HolySee(VaticanCityState)", "HN" => "Honduras", "HK" => "HongKong", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran(IslamicRepublicof)", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KP" => "Korea,DemocraticPeople'sRepublicof", "KR" => "Korea,Republicof", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "LaoPeople'sDemocraticRepublic", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "LibyanArabJamahiriya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau", "MK" => "Macedonia,TheFormerYugoslavRepublicof", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "MarshallIslands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia,FederatedStatesof", "MD" => "Moldova,Republicof", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "NetherlandsAntilles", "NC" => "NewCaledonia", "NZ" => "NewZealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "NorfolkIsland", "MP" => "NorthernMarianaIslands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PA" => "Panama", "PG" => "PapuaNewGuinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PT" => "Portugal", "PR" => "PuertoRico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "RussianFederation", "RW" => "Rwanda", "KN" => "SaintKittsandNevis", "LC" => "SaintLUCIA", "VC" => "SaintVincentandtheGrenadines", "WS" => "Samoa", "SM" => "SanMarino", "ST" => "SaoTomeandPrincipe", "SA" => "SaudiArabia", "SN" => "Senegal", "SC" => "Seychelles", "SL" => "SierraLeone", "SG" => "Singapore", "SK" => "Slovakia(SlovakRepublic)", "SI" => "Slovenia", "SB" => "SolomonIslands", "SO" => "Somalia", "ZA" => "SouthAfrica", "GS" => "SouthGeorgiaandtheSouthSandwichIslands", "ES" => "Spain", "LK" => "SriLanka", "SH" => "St.Helena", "PM" => "St.PierreandMiquelon", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "SvalbardandJanMayenIslands", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "SyrianArabRepublic", "TW" => "Taiwan", "TJ" => "Tajikistan", "TZ" => "Tanzania,UnitedRepublicof", "TH" => "Thailand", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "TrinidadandTobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "TurksandCaicosIslands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "UnitedArabEmirates", "GB" => "UnitedKingdom", "US" => "UnitedStates", "UM" => "UnitedStatesMinorOutlyingIslands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "VietNam", "VG" => "VirginIslands(British)", "VI" => "VirginIslands(U.S.)", "WF" => "WallisandFutunaIslands", "EH" => "WesternSahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");
												$countrys = 'India';
												foreach ($countryList as $country) {
													$selected = '';
													if ($countrys == $country) {
														$selected = 'selected=selected';
													}
													echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>';
												}
												*/?>
											</select>
										</div>
									</div> -->
									
									
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Enter text see in the image <span
											class="dips-required"> * </span></label>
									<div class="col-md-6">
										<div class="input-group">
											<input name="vercode" type="text" class="form-control" id="vercode"
												maxlength="10" required autocomplete="off" />
											<input name="test" type="hidden" id="test"
												value="<?php echo $_SESSION["vercode_enq"]; ?>" />
											<span class="input-group-addon"
												style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercode_enq"]; ?></span>
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
<?php require 'includes/reg_form_footer.php'; ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script src="js/enquiry.js?asdf"></script>
<script>
	jQuery(document).ready(function () {
		Registration.init('enq_form_1', 0);
		$("#mobile-country-code").intlTelInput();

	});


	function show_othr_fun(checkboxId) {
    var checkbox = document.getElementById(checkboxId);
    var otherDiv = document.getElementById("div_enq_other");
    if (checkbox && otherDiv) {
        otherDiv.style.display = checkbox.checked ? "block" : "none";
    }
}


window.onload = function() {
											// Get URL parameters
											const urlParams = new URLSearchParams(window.location.search);
											const deleTyp = urlParams.get('dele_typ');

											// ✅ If dele_typ has multiple values, split it
											if (deleTyp) {
												const values = deleTyp.split(','); // Split comma-separated values like Poster,Visitor

												// ✅ Loop through each checkbox and auto-check if value matches
												values.forEach(function(value) {
													const checkbox = document.querySelector('input[type="checkbox"][value="' + value.trim() + '"]');
													if (checkbox && !checkbox.checked) {
														checkbox.checked = true;
													}
												});
											}
										};
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
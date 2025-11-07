<?php

ini_set('display_errors', 1);
require "form_includes/form_constants_both.php";
require "enquiry_captcha.php";

$temp_find_us = @$_REQUEST['find_us'];
$temp_find_us = trim($temp_find_us);

$delegate_type = @$_GET['dele_typ'];
$event_name = 'Super Computing India';

?>

<?php $pageStyleCss = '<link href="forms_assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />';
require 'form_includes/reg_form_header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="enq_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Enquiry Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="enquiry_info.php" class="form-horizontal" id="enq" name="enq" method="post"
					onsubmit="return validateEnquiry('<?php echo $EVENT_NAME; ?>');">
					<input type="hidden" name="event_name" value="<?php echo $event_name; ?>" />
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a class="step">
										<span class="number"> 1 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Enquiry </span>
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
									<?php /*
									<div class="form-group">
										<label class="control-label col-md-3"> Select Sector <span class="required"> *
											</span>
										</label>
										<div class="col-md-6">
											<select id="sector" name="sector" class="form-control" required="required">
												<option value="">-- Select Sector --</option>
												<?php $countryList = array(
													'Computing' => 'Computing',
  														'Communication' => 'Communication',
  														'Sensing & Metrology' => 'Sensing & Metrology',
  														'Materials & Devices' => 'Materials & Devices',
  														'Software & Algorithms' => 'Software & Algorithms',
  														'Life Sciences & Healthcare' => 'Life Sciences & Healthcare',
  														'Finance' => 'Finance',
  														'Aerospace & Defense' => 'Aerospace & Defense',
  														'Supply Chain & Logistics' => 'Supply Chain & Logistics',
  														'Artificial Intelligence (AI & ML)' => 'Artificial Intelligence (AI & ML)',
  														'Smart Cities & Infrastructure' => 'Smart Cities & Infrastructure',
  														'High-Performance & Cloud Computing' => 'High-Performance & Cloud Computing',
  														'Climate Science & Environmental Modeling' => 'Climate Science & Environmental Modeling',
  														'Chemicals & Advanced Materials' => 'Chemicals & Advanced Materials',
  														'Genomics & Bioinformatics' => 'Genomics & Bioinformatics',
  														'Manufacturing & Engineering' => 'Manufacturing & Engineering',
  														'Media' => 'Media',
  														'Associations' => 'Associations',
  														'Consultancy' => 'Consultancy',
  														'Government Organisation' => 'Government Organisation',
  														'NGO' => 'NGO',
  														'Others' => 'Others'
												);
												//$countryList = array('Information Technology'=>'Information Technology');
												
												foreach ($countryList as $key => $value) {
													echo '<option value="' . $key . '">' . $value . '</option>';
												}
												?>
											</select>
										</div>
									</div>
									*/?>
									<div class="form-group form-md-radios">
										<label class="control-label col-md-3"> Want Information About <span
												class="required"> * </span></label>
										<div class="col-md-9">
											<div class="md-radio-list" data-ml-field="Type of Service"></div>
											<?php
											$displayed_options = [];
											$index = $i = array_search($delegate_type, $ENQUIRY_WNT_INFO_ARR);
											if (!empty($delegate_type) && isset($ENQUIRY_WNT_INFO_ARR[$index])) {
												$i++;
												if ($delegate_type == 'Exhibiting') { ?>
													<div class="md-radio">
														<input type="radio" name="enquiry" id="enquiry2"
															value="Exhibiting (9 SQM and above)"
															class="md-radiobtn enq-chk dips-chk" readonly checked
															onclick="return false;"
															onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"
															data-ml-field="Type of Service">
														<label for="enquiry2">
															<span></span>
															<span class="check"></span>
															<span class="box"></span>Exhibiting (9 SQM and above)</label>
													</div>

													<?php
												} else if ($delegate_type == 'Sponsoring') {
													?>
														<div class="md-radio">
															<input type="radio" name="enquiry" id="enquiry3" value="Sponsoring"
																class="md-radiobtn enq-chk dips-chk" readonly checked
																onclick="return false;"
																onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"
																data-ml-field="Type of Service">
															<label for="enquiry3">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> Sponsoring</label>
														</div>
													<?php
												} else { ?>
														<div class="md-radio">
															<input type="radio" name="enquiry" id="enquiry1"
																value="<?php echo $ENQUIRY_WNT_INFO_ARR[$index]; ?>"
																class="md-radiobtn enq-chk dips-chk" readonly checked
																onclick="return false;"
																onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"
																data-ml-field="Type of Service">
															<label for="enquiry1">
																<span></span>
																<span class="check"></span>
																<span class="box"></span>
															<?php echo $ENQUIRY_WNT_INFO_ARR[$index]; ?>
															</label>
														</div>
												<?php } ?>
												<div class="md-radio">
													<input type="radio" name="enquiry" id="enquiry12" value="Other"
														class="md-radiobtn enq-chk" onclick="show_othr_fun('enquiry12');"
														data-ml-field="Type of Service">
													<label for="enquiry12">
														<span></span>
														<span class="check"></span>
														<span class="box"></span> Other</label>
												</div>
												<span class="col-md-offset-8 col-md-3" id="div_enq_other"
													style="display: none; margin-left: 10%; margin-top: -5%;">
													<input name="other_name" id="other_name" type="text"
														class="form-control" placeholder="Other"
														data-ml-field="Type of Service" />
												</span>
											<?php } else {
												$id = 0;
												foreach ($ENQUIRY_WNT_INFO_ARR as $option) {
													if (!in_array($option, $displayed_options)) {
														$displayed_options[] = $option;
														$id++;
														$checked = ($option == $delegate_type) ? 'checked="checked"' : '';
														?>
														<div class="md-radio" <?php if ($option == 'Speaking Opportunity') {
															echo "style='display:none;'";
														} ?>>
															<input type="radio" name="enquiry" id="enquiry<?php echo $id; ?>"
																value="<?php echo $option; ?>" class="md-radiobtn enq-chk" <?php echo $checked; ?> 			<?php if ($option == 'Other') { ?>onclick="show_othr_fun('enquiry<?php echo $id; ?>');" <?php } ?>
																data-ml-field="Type of Service">
															<label for="enquiry<?php echo $id; ?>">
																<span></span>
																<span class="check"></span>
																<span class="box"></span>
																<?php echo $option; ?>
															</label>
														</div>
														<?php if ($option == 'Other') { ?>
															<span class="col-md-offset-8 col-md-3" id="div_enq_other"
																style="display: none; margin-left: 0%;">
																<input name="other_name" id="other_name" type="text"
																	class="form-control" placeholder="Other"
																	data-ml-field="Want Information About" />
															</span>
														<?php }
													}
												}
											} ?>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Name <span class="dips-required"> *
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
									<div class="form-group">
										<label class="col-md-3 control-label">Organisation <span class="dips-required">
												* </span></label>
										<div class="col-md-6">
											<input class="form-control" name="company" type="text" id="company"
												required="required" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Designation <span class="dips-required"> *
											</span></label>
										<div class="col-md-6">
											<input class="form-control" name="desig" type="text" id="desig"
												required="required" />
										</div>
									</div>
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
									<div class="form-group">
										<label class="col-md-3 control-label">Comment <span class="dips-required"> *
											</span></label>
										<div class="col-md-6">
											<textarea name="comment" id="comment" rows="" cols="" required="required"
												class="form-control"></textarea>
										</div>
									</div>

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
									
									<div class="form-group">
										<label class="control-label col-md-3">How did you know about this event?<span
												class="required">*</span>
										</label>
										<div class="col-md-6">
											<select name="find_us" id="find_us" onchange="disp_findus_oth()"
												class="form-control" required="required">
												<option value="">-- Select --</option>
												<?php $find_usList = array("Brochure", "Colleague", "Link on Site", "Internet search", "Sales Call", "Association", "Direct Mailer", "News Paper Ad", "Trade Publication", "Invitation from Exhibitor", "Hoarding", "Others");
												foreach ($find_usList as $find_us) {
													echo '<option value="' . $find_us . '">' . $find_us . '</option>';
												}
												?>
											</select>
										</div>
										<div class="col-md-3">
											<span id="div_find_us" style="display:none;">
												<input name="other_txtbx_find_us" id="other_txtbx_find_us" type="text"
													class="form-control" placeholder="Other" />
											</span>
										</div>
									</div>
							
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Enter text see in the image <span
											class="dips-required"> * </span></label>
									<div class="col-md-6">
										<div class="input-group" style="display: inline-flex;align-items: center;width: 100%;">
											<input name="vercode" type="text" class="form-control" id="vercode"
												maxlength="10" required autocomplete="off"
												oncopy="return false;" oncut="return false;" onpaste="return false;" />
											<input name="test" type="hidden" id="test"
												value="<?php echo $_SESSION["vercode_enq"]; ?>" />
											<span class="input-group-addon" id="captcha-display"
												style="background-image: url('images/verify_img_bg.JPG');text-align: center;font-size: 32px;padding: 0 15px 1px;width: 200px;"
												oncopy="return false;" oncut="return false;" onpaste="return false;" oncontextmenu="return false;">
												<?php echo $_SESSION["vercode_enq"]; ?>
											</span>
											<button type="button" class="btn btn-default" onclick="refreshCaptcha()" style="border-left: none;font-size: 19px;padding: 4px 18px 4px 8px;">🔄</button>
										</div>
									</div>
								</div>
								<script>
									// Extra JS to disable right-click and copy/paste on captcha input
									document.addEventListener('DOMContentLoaded', function () {
										var vercode = document.getElementById('vercode');
										var captchaDisplay = document.getElementById('captcha-display');
										if (vercode) {
											vercode.addEventListener('contextmenu', function (e) { e.preventDefault(); });
										}
										if (captchaDisplay) {
											captchaDisplay.addEventListener('contextmenu', function (e) { e.preventDefault(); });
										}
									});
								</script>
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
<?php require 'form_includes/reg_form_footer.php'; ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="forms_assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script src="forms-js/enquiry.js?asdf"></script>

<!-- RefreshCaptcha function updated to use enquiry_captcha.php -->
<script>
function refreshCaptcha() {
    // console.log('Refresh captcha button clicked');
    
    // Back to using the original captcha file
    const url = 'enquiry_captcha.php?action=refresh&rand=' + Date.now();
    // console.log('Making request to:', url);
    
    fetch(url)
        .then(response => {
            // console.log('Response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return response.text(); // Get as text first to see what we're receiving
        })
        .then(text => {
            // console.log('Raw response:', text);
            
            try {
                const data = JSON.parse(text);
                // console.log('Parsed JSON:', data);
                
                if (data.success) {
                    // Update the captcha display
                    document.getElementById("captcha-display").textContent = data.captcha;
                    // Update the hidden field value
                    document.getElementById("test").value = data.captcha;
                    // Clear the input field
                    document.getElementById("vercode").value = '';
                    // console.log('Captcha updated successfully');
                } else {
                    // console.error('Server error:', data.error);
                    alert('Unable to refresh captcha: ' + (data.error || 'Unknown error'));
                }
            } catch (jsonError) {
                // console.error('JSON parsing error:', jsonError);
                // console.log('Response was not valid JSON:', text);
                alert('Server returned invalid response: ' + text.substring(0, 200) + '...');
            }
        })
        .catch(error => {
            // console.error('Error refreshing captcha:', error);
            alert('Unable to refresh captcha. Error: ' + error.message);
        });
}
</script>
<!-- End RefreshCaptcha -->
<script>
	jQuery(document).ready(function () {
		Registration.init('enq_form_1', 0);
		$("#mobile-country-code").intlTelInput();

	});


	function show_othr_fun(radioId) {
    var otherDiv = document.getElementById("div_enq_other");
    var radioElement = document.getElementById(radioId);
    
    if (radioElement && otherDiv) {
        if (radioElement.type === "radio") {
            // For radio buttons
            otherDiv.style.display = radioElement.checked ? "block" : "none";
        } else if (radioElement.type === "checkbox") {
            // For checkboxes
            otherDiv.style.display = radioElement.checked ? "block" : "none";
        }
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
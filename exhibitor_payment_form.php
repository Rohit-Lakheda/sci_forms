<?php //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
//echo "<script language='javascript'>window.location.href='https://www.bengalurutechsummit.com/web/it_forms/enquiry.php';</script>";
//exit;

$ret = @$_GET['rt'];
require "form_includes/form_constants_both.php";

$assoc_nm = @$_REQUEST['assoc_nm'];
if ($ret == "retds4fn324rn_ed24d3it") {
	session_start();
	if ((!isset($_SESSION["vercode_ex"])) || ($_SESSION["vercode_ex"] == '')) {
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor_payment_form.php');</script>";
		exit();
	}

	$text = $_SESSION["vercode_ex"];
	$assoc_nm = @$_SESSION['assoc_nm'];
} else {
	require "exhibitor_payment_form_captcha.php";

	$_SESSION['sess_exhi_name'] = "";
	$_SESSION['sess_cp_title'] = "";
	$_SESSION['sess_cp_fname'] = "";
	$_SESSION['sess_cp_lname'] = "";
	$_SESSION['sess_email'] = "";
	$_SESSION['sess_mobile'] = "";
	$_SESSION['comp_years'] = "";
	$_SESSION['sess_addr1'] = "";
	$_SESSION['sess_addr2'] = "";
	$_SESSION['sess_city'] = "";
	$_SESSION['sess_state'] = "";
	$_SESSION['sess_country'] = "";
	$_SESSION['sess_zip'] = "";
	$_SESSION['gst'] = "";
	$_SESSION['gst_number'] = "";
	$_SESSION['pan_number'] = "";
	$_SESSION['sess_foneCountryCode'] = "";
	$_SESSION['sess_fon'] = "";
	$_SESSION['sess_cellnoCountryCode'] = "";
	$_SESSION['sess_mob'] = "";
	$_SESSION['sess_other_sector'] = "";
	$_SESSION['assoc_nm'] = "";

	$_SESSION['sess_del_title'] = '';
	$_SESSION['sess_del_fname'] = '';
	$_SESSION['sess_del_lname'] = '';
	$_SESSION['sess_del_email'] = '';
	$_SESSION['sess_del_mobile_cntry'] = '';
	$_SESSION['sess_del_mobile'] = '';
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
<?php $pageStyleCss = '<link href="forms_assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />';
if (!empty($assoc_nm)) {
	if ($assoc_nm == "GCPIT") {
		$ex_gcpit = true;
	}
	if ($assoc_nm == "ELEVATE") {
		$ex_elevate = true;
	}
	if ($assoc_nm == "IBioM") {
		$ex_ibiom = true;
	}
}

require 'form_includes/reg_form_header.php'; ?>
<style>
	.selected-flag {
		margin-top: -5px;
	}

	.tariff-table>tbody>tr>td,
	tariff-table>tbody>tr>th,
	tariff-table>tfoot>tr>td,
	tariff-table>tfoot>tr>th,
	tariff-table>thead>tr>td,
	tariff-table>thead>tr>th {
		border: 1px solid #c7c7c7 !important;
		color: #000 !important;
	}
	.align-td {
		text-align: center !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase">
						<!-- Exhibitor at Startup Zone -->
						<?php if (!empty($assoc_nm)) { ?>
							Exhibitors at Startup Zone For <?php echo $assoc_nm; ?>
						<?php } else { ?>
							Exhibitor at Startup Zone
						<?php } ?>
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<?php if (date('Y-m-d') <= '2025-11-21') { ?>
					<form action="exhibitor_payment_form2.php<?php echo !empty($ret) ? '?rt=' . $ret : ''; ?>"
						class="form-horizontal" name="exhibitors_form_1" id="exhibitors_form_1" method="post"
						enctype="multipart/form-data" onsubmit="return validate_ex();">
						<input type="hidden" value="<?php echo $assoc_nm; ?>" name="assoc_nm" />
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
											<span class="desc">
												<i class="fa fa-check"></i> Payment </span>
										</a>
									</li>
								</ul>
								<div id="bar" class="progress progress-striped" role="progressbar">
									<div class="progress-bar progress-bar-success"> </div>
								</div>
								<div class="tab-content">
									<div class="tab-pane active">
										<div class="form-group form-md-radios" style="display: none;">
											<label class="control-label col-md-3">Nationality <span class="required"> *
												</span> </label>
											<div class="col-md-9">
												<div class="md-radio-inline">
													<div class="md-radio">
														<input type="radio" id="Indian" name="curr" class="md-radiobtn"
															value="Indian" onclick="show_cata();" checked="checked"
															required="required">
														<label for="Indian">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Indian
														</label>
													</div>
													<div class="md-radio">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-offset-2 col-md-7 table-responsive1">
												<table class="table table-bordered tariff-table"
													style="border: thin solid #dddddd; box-shadow: 5px 5px 5px 0 rgb(219, 219, 219);">
													<thead>
														<tr bgcolor="#E39101" style="color: #fff;">
															<th colspan="6" style="text-align: center;">Exhibition Tariff –
																StartUp Innovation Zone</th>
														</tr>
														<tr bgcolor="#2fa0dd" style="color: #fff;" class=" hide">
															<th class="align-td" style="display:none1;" align="center">
																OPTION</th>
															<th class="align-td" align="center">BOOTH TYPE</th>
															<th class="align-td" align="center">TOTAL COST IN INR</th>

														</tr>
														<tr bgcolor="#2fa0dd" style="color: #fff;">
															<!-- <th class="align-td" style="display:none1;" align="center">
																OPTION</th> -->
															<th class="align-td" align="center">Booth Type</th>
															<!-- <th class="align-td " align="center">PRICE /SQM IN INR</th> -->
															<th class="align-td" align="center">PRICE</th>
															<th class="align-td" align="center">SPECIAL OFFER </th>
														</tr>
													</thead>
													<tbody>
														<?php /*
																																																																																																																																																																																																																																																																																							   <tr class="indian-tariff hide" style="background-color: #e1e1e1;">
																																																																																																																																																																																																																																																																																								   <td class="align-td" align="center" style="display:none1;">1
																																																																																																																																																																																																																																																																																								   </td>
																																																																																																																																																																																																																																																																																								   <td class="align-td" align="center">6</td>
																																																																																																																																																																																																																																																																																								   <td class="align-td" align="center">39,999</td>
																																																																																																																																																																																																																																																																																							   </tr>
																																																																																																																																																																																																																																																																																							   <tr class="indian-tariff hide" style="background-color: #e1e1e1;">
																																																																																																																																																																																																																																																																																								   <td class="align-td" align="center" style="display:none1;">2
																																																																																																																																																																																																																																																																																								   </td>
																																																																																																																																																																																																																																																																																								   <td class="align-td" align="center">9</td>
																																																																																																																																																																																																																																																																																								   <td class="align-td" align="center">59,999</td>
																																																																																																																																																																																																																																																																																							   </tr>

																																													 */ ?>
														<?php if ($assoc_nm != "IBioM") { ?>
															<tr class="indian-tariff " style="background-color: #e1e1e1;">
																<!-- <td class="align-td" align="center" style="display:none1;">1
															</td> -->
																<td class="align-td" align="center">Startup Booth</td>
																<!-- <td class="align-td" align="center">Standard Stall</td> -->
																<!-- <td class="align-td" align="center">14,000</td> 
															<td class="align-td " align="center">56,000</td> -->
																<?php
																if ($assoc_nm == "ELEVATE") { ?>

																	<td class="align-td" align="center"><del>52,000</del></td>
																	<!-- <td class="align-td" align="center"><strong>Sold Out<strong></td> -->

																<?php } else { ?>

																	<td class="align-td" align="center"><s>52,000</s></td>
																	<td class="align-td" align="center"><strong>30,000<strong></td>
																	<!-- <td class="align-td" align="center"><strong>Sold Out<strong></td> -->
																<?php } ?>
															</tr>
														<?php } ?>
														<!-- <tr class="indian-tariff " style="background-color: #e1e1e1;"> -->
														<!-- <td class="align-td" align="center" style="display:none1;">1
															</td> -->
														<!-- <td class="align-td" align="center">Standard Stall</td> -->
														<!-- <td class="align-td" align="center">Standard Stall</td> -->
														<!-- <td class="align-td" align="center">14,000</td> 
															<td class="align-td " align="center">56,000</td> -->
														<?php /*
														   if ($assoc_nm == "ELEVATE") { ?>
															   <td class="align-td" align="center"><strong>16,999<strong></td>
														   <?php } else if ($assoc_nm == "IBioM") { ?>
																   <td class="align-td" align="center"><strong>17,000<strong></td>
														   <?php } else {
															   ?>
																   <td class="align-td" align="center"><strong>16,999 <strong></td>
														   <?php } */ ?>
														<!-- </tr> -->
														<?php /* <tr class="indian-tariff1 " style="background-color: #e1e1e1;">
																																																																																																																																																																																																																																																																																								   <td class="align-td" align="center">2</td>
																																																																																																																																																																																																																																																																																								   <td class="align-td" align="center">6</td>
																																																																																																																																																																																																																																																																																								   <td class="align-td" align="center">14,000</td>
																																																																																																																																																																																																																																																																																								   <td class="align-td " align="center">90,000</td>
																																																																																																																																																																																																																																																																																								   <td class="align-td" align="center"><strong>44,999</strong></td>
																																																																																																																																																																																																																																																																																							   </tr> 
																																																																																																																																																																																																																																																																																							   */ ?>
														<tr class="international-tariff" style="display: hide;">
															<?php /*<td class="align-td">International</td>
																																																																																																																																																																																																																																																																																																																																																																																																																																																		<td colspan="1" class="align-td">USD 150</td>?>
																																																																																																																																																																																																																																																																																																																																																																																																																																																	</tr>*/ ?>
														<tr>
															<td colspan="6">
																<p><strong>Note:</strong><br />
																	- GST Applicable @ 18%<br />
																	- The above price is applicable to only less than 7
																	years old Startups<br />
																</p>
																<p><strong>Entitlements</strong><br>
																	&bull;&nbsp;Startup Booth.<br />
																	&bull;&nbsp;One Complementary delegate
																	registration.<br />
																	&bull;&nbsp;Two Exhibitor Badge to manage the
																	booth.<br />
																	&bull;&nbsp;Listing of Organization information in the
																	E-Directory<br />

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
																																																																																																																																																																																																																																																																																																																			</div><label>Currently only 4 SQM size stalls are available. </label>*/ ?>
											<input type="hidden" id="booth_size1" name="booth_size" value="Booth / POD">
											<?php if ($assoc_nm == "IBioM") { ?>

												<div class="form-group form-md-radios">
													<label class="control-label col-md-3">Select Booth size <span
															class="required"> * </span> </label>
													<div class="col-md-9">
														<div class="md-radio-inline">
															<div class="md-radio">
																<input type="radio" id="booth_space2" name="booth_space"
																	class="md-radiobtn" value="Standard Stall" checked>
																<label for="booth_space2">
																	<span></span>
																	<span class="check"></span>
																	<span class="box"></span> Standard Stall
																</label>
															</div>
															<br />
														</div>
													</div>
												</div>
											<?php } else { ?>
												<div class="form-group form-md-radios">
													<label class="control-label col-md-3">Select Booth size <span
															class="required"> * </span> </label>
													<div class="col-md-9">
														<div class="md-radio-inline">
															<div class="md-radio">
																<input type="radio" id="booth_space1" name="booth_space"
																	class="md-radiobtn" value="Startup Booth" checked>
																<label for="booth_space1">
																	<span></span>
																	<span class="check"></span>
																	<span class="box"></span> Startup Booth
																</label>
															</div>
															<div class="md-radio hidden">
																<input type="radio" id="booth_space2" name="booth_space"
																	class="md-radiobtn" value="Standard Stall">
																<label for="booth_space2">
																	<span></span>
																	<span class="check"></span>
																	<span class="box"></span> Standard Stall
																</label>
															</div>
															<br />
														</div>
													</div>
												</div>
											<?php } ?>

											<div class="form-group">
												<label class="control-label col-md-3"> Select Sector <span class="required">
														* </span>
												</label>
												<div class="col-md-6">
													<select id="sector" name="sector" class="form-control"
														required="required" onchange="updateSubsectors();">
														<?php if ($assoc_nm == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') { ?>
															<option value="Information Technology">Information Technology</option>
														<?php } else { ?>
															<option value="">-- Select Sector --</option>
															<?php 
															$sectorList = array(
																'High Performance Computing' => 'High Performance Computing',
																'Artificial Intelligence' => 'Artificial Intelligence',
																'Quantum Computing' => 'Quantum Computing',
																'Government / Public Sector' => 'Government / Public Sector',
																'Chip Design' => 'Chip Design',
																'Research & Academia' => 'Research & Academia',
																'Startups' => 'Startups',
																'MSMEs' => 'MSMEs',
																'Other' => 'Other'
															);
															
															foreach ($sectorList as $key => $value) {
																$selected = '';
																if (isset($_SESSION['sess_sector']) && $_SESSION['sess_sector'] == $key) {
																	$selected = 'selected="selected"';
																}
																echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
															}
															?>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group" id="subsector-div">
												<label class="control-label col-md-3"> Select Subsector <span
														class="required"> * </span>
												</label>
												<div class="col-md-6">
													<select id="subsector" name="subsector" class="form-control"
														required="required" onchange="showOtherDiv();">
														<option value="">-- Select Subsector --</option>
													</select>
												</div>
											</div>

											<script>
												// Define subsector options based on sector
												const subsectorOptions = {
													'High Performance Computing': [
														'Chip & Accelerator Manufacturer',
														'Server Integrators',
														'Cloud Providers',
														'Networking',
														'Storage Vendors',
														'Other'
													],
													'Artificial Intelligence': [
														'AI Hardware',
														'AI Infrastructure Providers',
														'Cloud AI Platforms',
														'Foundation Model Developers / LLM Vendors',
														'Vertical AI Solution Vendors',
														'Other'
													],
													'Quantum Computing': [
														'Quantum Hardware',
														'Quantum Software Platforms & Tools',
														'Quantum Control and Infrastructure Vendors',
														'Quantum Applications, Consulting & Services',
														'Other'
													],
													'Government / Public Sector': [
														'Central Government',
														'State Government',
														'Public Sector Undertaking',
														'Other'
													],
													'Chip Design': [
														'Fabless Companies',
														'Foundries',
														'Integrated Device Manufacturers',
														'Design Services & EDA Tool Vendors',
														'Other'
													],
													'Research & Academia': [
														'University',
														'Research Institute',
														'Academic Institution',
														'Other'
													],
													'Startups': [
														'Early Stage',
														'Growth Stage',
														'Mature Stage',
														'Other'
													],
													'MSMEs': [
														'Micro Enterprise',
														'Small Enterprise',
														'Medium Enterprise',
														'Other'
													],
													'Other': [
														'Other'
													]
												};
												// Function to update subsector dropdown based on selected sector
												function updateSubsectors() {
													const sectorSelect = document.getElementById('sector');
													const subsectorSelect = document.getElementById('subsector');
													const subsectorDiv = document.getElementById('subsector-div');
													const otherSectorDiv = document.getElementById('other-sector-div');
													
													// Clear subsector dropdown
													subsectorSelect.innerHTML = '<option value="">-- Select Subsector --</option>';
													
													const selectedSector = sectorSelect.value;
													
													// If "Other" sector is selected, show the other sector input field AND subsector
													if (selectedSector === 'Other') {
														otherSectorDiv.style.display = 'block';
														document.getElementById('other-sector').setAttribute('required', 'required');
														
														// Still show subsector dropdown with "Other" option for consistency
														const options = subsectorOptions[selectedSector];
														for (let i = 0; i < options.length; i++) {
															const option = document.createElement('option');
															option.value = options[i];
															option.text = options[i];
															subsectorSelect.appendChild(option);
														}
														subsectorDiv.style.display = 'block';
														subsectorSelect.setAttribute('required', 'required');
														return;
													}
													
													// Hide other sector div for non-Other sectors
													otherSectorDiv.style.display = 'none';
													document.getElementById('other-sector').removeAttribute('required');
													
													if (selectedSector && subsectorOptions[selectedSector]) {
														const options = subsectorOptions[selectedSector];
														
														// Always show the subsector div and populate with options
														for (let i = 0; i < options.length; i++) {
															const option = document.createElement('option');
															option.value = options[i];
															option.text = options[i];
															subsectorSelect.appendChild(option);
														}
														subsectorDiv.style.display = 'block';
														subsectorSelect.setAttribute('required', 'required');
													} else {
														// Show subsector div even if no sector is selected, but keep it empty
														subsectorDiv.style.display = 'block';
														subsectorSelect.setAttribute('required', 'required');
													}
												}
												

												// Initialize subsectors based on any preselected sector
												document.addEventListener('DOMContentLoaded', function() {
													updateSubsectors();
													
													<?php if (isset($_SESSION['sess_subsector']) && $_SESSION['sess_subsector']) { ?>
														// Set previously selected subsector if it exists
														setTimeout(function() {
															const subsectorSelect = document.getElementById('subsector');
															const savedSubsector = "<?php echo $_SESSION['sess_subsector']; ?>";
															
															for (let i = 0; i < subsectorSelect.options.length; i++) {
																if (subsectorSelect.options[i].value === savedSubsector) {
																	subsectorSelect.selectedIndex = i;
																	break;
																}
															}
															
															showOtherDiv();
														}, 100);
													<?php } ?>
												});
											</script>

											</div>
											<div class="form-group" id="other-sector-div" style="display:none;">
												<label class="col-md-3 control-label">Other Sector Name <span
														class="dips-required"> * </span></label>
												<div class="col-md-6">
													<input class="form-control" name="other-sector" type="text"
														id="other-sector"
														value="<?php echo $_SESSION['sess_other_sector']; ?>" />
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Name of Exhibitor <span
														style="font-size:10px;">&nbsp;(Organisation Name)</span><span
														class="dips-required"> * </span></label>
												<div class="col-md-6">
													<input class="form-control" name="exhi_name" type="text" id="exhi_name"
														maxlength="100" value="<?php echo $_SESSION['sess_exhi_name']; ?>"
														required="required" />
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Company Registration Certificate /
													Certificate of Incorporation<span class="required"> * </span>
												</label>
												<div class="col-md-6">
													<input type="file" id="ci_certf" name="ci_certf" required>
													<br>
													<strong>Note:</strong> <br>1. Certificate Should be in <strong>PDF
														format only</strong> <br>2. Certificate size should be <strong>less
														than 2MB</strong>
												</div>
											</div>


											<div class="form-group">
												<label class="col-md-3 control-label">How old is your company? <br /> (In
													years)<span class="dips-required"> * </span></label>
												<div class="col-md-6">
													<select name="comp_years" id="comp_years" required="required"
														class="form-control">
														<!-- <option value="">-- Select Company Years --</option> -->
														<option value="">-- Select Company Years --</option>
														<?php
														$selected_years = @$_SESSION['comp_years'];
														for ($i = 1; $i <= 7; $i++) {
															$selected = ($i == $selected_years) ? 'selected' : '';
															echo "<option value=\"$i\" $selected>$i</option>";
														}
														?>
													</select>
												</div>
											</div>
											<!-- If comp_years is null prevent from submiting the form and ask to select this field by foxing on it -->
											<script>
												document.querySelector('form').addEventListener('submit', function (event) {
													var compYears = document.getElementById('comp_years').value;
													if (!compYears) {
														event.preventDefault();
														document.getElementById('comp_years').focus();
													}
												});
											</script>
											<div class="form-group">
												<label class="col-md-3 control-label">Invoice Address <span
														class="dips-required"> * </span></label>
												<div class="col-md-6">
													<input type="text" name="addr1" id="addr1" rows="" cols=""
														required="required" class="form-control"
														value="<?php echo @$_SESSION['sess_addr1']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">City, State, Postal Code<span
														class="dips-required"> * </span></label>
												<div class="col-md-2"><input type="text" class="form-control" name="city"
														id="city" value="<?php echo $_SESSION['sess_city']; ?>"
														placeholder="City" onkeyup="check_char(event,'city');"
														required="required" /></div>
												<div class="col-md-2"><input type="text" class="form-control" name="state"
														id="state" value="<?php echo $_SESSION['sess_state']; ?>"
														placeholder="State" required="required"
														onkeyup="check_char(event,'state');" /></div>
												<div class="col-md-2"><input type="text" class="form-control" name="zip"
														id="zip" value="<?php echo $_SESSION['sess_zip']; ?>"
														placeholder="Postal Code" required="required" /></div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Telephone Number<span
														class="dips-required"> * </span></label>
												<div class="col-md-6" style="margin-top: -15px;">
													<span type="tel" id="telCountryIsoCode"
														data-fax-iso-code-hidden-field-name="foneCountryCode"></span>
													<input type="hidden" name="foneCountryCode" id="foneCountryCode"
														value="<?php echo @$_SESSION['sess_foneCountryCode']; ?>" />
													<input type="hidden" id="foneCountryCodeIso"
														name="foneCountryCodeIso" />
													<input name="fon" type="text" id="fon" class="form-control"
														maxlength="20" value="<?php echo @$_SESSION['sess_fon']; ?>"
														style="padding-left: 92px;" required />
													<span class="help-block">+Country Code-Area Code-Phone Number(Eg.
														91-123412345)</span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">GST Number<span class="dips-required">
														* </span></label>
												<div class="col-md-3">
													<select id="gst" name="gst" class="form-control" onchange="hidegst();"
														required="required">
														<option value="">- Select -</option>
														<option value="Registered" <?php if (!empty($_SESSION['gst']) && $_SESSION['gst'] != 'Unregistered')
															echo 'selected=selected'; ?>>
															Registered</option>
														<option value="Unregistered" <?php if (!empty($_SESSION['gst']) && $_SESSION['gst'] == 'Unregistered')
															echo 'selected=selected'; ?>>
															Unregistered(Not Available)</option>
													</select>
												</div>
												<div class="col-md-3" style="display:none;" id="gst-div">
													<input type="text" class="form-control" name="gst_number"
														id="gst_number" value="<?php echo $_SESSION['gst_number']; ?>"
														placeholder="Enter GST Number" maxlength="15" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">PAN Number<span class="dips-required">
														* </span></label>
												<div class="col-md-6">
													<input type="text" class="form-control" name="pan_number"
														id="pan_number" value="<?php echo $_SESSION['pan_number']; ?>"
														maxlength="12" required />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Name <span class="dips-required"> *
													</span></label>
												<div class="col-md-2">
													<select class="form-control" name="cp_title" id="cp_title"
														required="required">
														<option value="">-Title-</option>
														<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
														foreach ($titleList as $title) {
															$selected = '';
															if ($_SESSION['sess_cp_title'] == $title) {
																$selected = 'selected="selected"';
															}
															echo '<option value="' . $title . '" ' . $selected . '>' . $title . '</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-2"><input type="text" class="form-control"
														placeholder="First Name" name="cp_fname" type="text" id="cp_fname"
														maxlength="100" value="<?php echo $_SESSION['sess_cp_fname']; ?>"
														required="required"></div>
												<div class="col-md-2"><input type="text" class="form-control"
														placeholder="Last Name" name="cp_lname" type="text" id="cp_lname"
														maxlength="100" value="<?php echo $_SESSION['sess_cp_lname']; ?>"
														required="required"></div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Designation <span
														class="dips-required"> * </span></label>
												<div class="col-md-6">
													<input type="text" class="form-control" name="cp_desig" id="cp_desig"
														value="<?php echo @$_SESSION['sess_cp_desig']; ?>"
														required="required" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Email <span class="dips-required"> *
													</span></label>
												<div class="col-md-6">
													<input type="email" class="form-control" name="email" id="email"
														value="<?php echo @$_SESSION['sess_email']; ?>"
														required="required" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Mobile<span class="dips-required"> *
													</span></label>
												<div class="col-md-6" style="margin-top: -15px;">
													<span type="tel" id="mobile-country-code"
														data-fax-iso-code-hidden-field-name="cellnoCountryCode"
														class="hide"></span>
													<input type="hidden" name="cellnoCountryCode" id="cellnoCountryCode"
														value="<?php echo @$_SESSION['sess_cellnoCountryCode']; ?>" />
													<input type="hidden" id="cellnoCountryCodeIso"
														name="cellnoCountryCodeIso" />
													<input name="mob" type="text" id="mob" class="form-control"
														maxlength="10" value="<?php echo @$_SESSION['sess_mob']; ?>"
														required onkeyup="check_num(event, 'mob');"
														style="padding-left: 92px;" />
													<span class="help-block">+Country Code-Mobile
														Number(xxx-xxxxxxxxxx)</span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Website <span class="required"> *
													</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon">http://</span>
														<input type="text" class="form-control" name="website" id="website"
															value="<?php echo @$_SESSION['sess_website']; ?>"
															required="required" />
													</div>
												</div>
											</div>
											<div class="form-group form-md-radios">
												<label class="control-label col-md-3">Payment Mode <span class="required"> *
													</span> </label>
												<div class="col-md-9">
													<div class="md-radio-inline">
														<div class="md-radio">
															<input type="radio" id="Cc" name="paymode" class="md-radiobtn"
																value="Credit Card" onclick="showTxt();" checked>
															<label for="Cc">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> CCAvenue Payment - Credit Card /
																Debit Card / Net Banking / Google Pay / PhonePe / Paytm
															</label>
															<span class="help-block indian-tariff">Please Note:
																<?php echo $CC_IND_PROCESSING_CHARGE_PER; ?>% processing
																charges is applicable for CCAVenue payment mode.</span>
															<span class="help-block international-tariff">Please Note:
																<?php echo $CC_INT_PROCESSING_CHARGE_PER; ?>% processing
																charges is applicable for CCAVenue payment mode.</span>
														</div>
														&nbsp;&nbsp;
														<div class="md-radio" style="display: none;">
															<input type="radio" id="Dc" name="paymode" class="md-radiobtn"
																value="Debit Card" onclick="showTxt();">
															<label for="Dc">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> Debit Card
															</label>
														</div>
														<div class="md-radio hide">
															<input type="radio" id="Cheque" name="paymode"
																class="md-radiobtn" value="Cheque" onclick="showTxt();">
															<label for="Cheque">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> Cheque / DD
															</label>
														</div>
														<div class="md-radio hide">
															<input type="radio" id="BT" name="paymode" class="md-radiobtn"
																value="Bank Transfer" onclick="showTxt();">
															<label for="BT">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> Bank
																Transfer<strong>(Offline)</strong> / NEFT / RTGS / IMPS
															</label>
														</div>
														<div class="md-radio international-tariff">
															<input type="radio" id="paypal" name="paymode"
																class="md-radiobtn" value="Paypal" onclick="showTxt();">
															<label for="paypal">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> Paypal - Credit Card / Debit Card
															</label>
															<span class="help-block">Please Note: 9.5% processing charges is
																applicable for PayPal payment mode.</span>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group" id="bite">
												<label class="control-label col-md-1"></label>

											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Enter text see in the image <span
														class="dips-required"> * </span></label>
												<div class="col-md-6">
													<div class="input-group" style="display: inline-flex;align-items: center;width: 100%;">
														<input name="vercode_ex" type="text" class="form-control"
															id="vercode_ex" maxlength="10" required autocomplete="off" />
														<input name="test" type="hidden" id="test"
															value="<?php echo $_SESSION["vercode_ex"]; ?>" />
														<span class="input-group-addon" id="captcha-display"
															style="background-image: url('images/verify_img_bg.JPG');text-align: center;font-size: 32px;padding: 0 15px 1px;width: 200px;user-select: none;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;"
															oncopy="return false;" onmousedown="return false;" onselectstart="return false;" oncontextmenu="return false;"
															><?php echo $text; ?></span>
														<button type="button" class="btn btn-default" onclick="refreshCaptcha()" style="border-left: none;font-size: 19px;padding: 4px 18px 4px 8px;">🔄</button>
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
				<?php } else { ?>
					<h1><?php echo $assoc_nm; ?> Website is under Maintenance for 2 Hours.
						Please try after 2 Hours. 
						<!-- <?php // echo $EVENT_NAME . ' ' . $EVENT_YEAR; ?> is closed. -->
					</h1>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php require 'form_includes/reg_form_footer.php'; ?>
<script src="forms_assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script src="forms_assets/global/plugins/tiny_mce/tiny_mce.js"></script>
<script src="forms-js/exhibitor-payment.js?546asd45"></script>
<script>
	jQuery(document).ready(function () {
		Registration.init('registration_form_1', 0);

		<?php if (!empty($_SESSION['foneCountryIso'])) { ?>
			$("#telCountryIsoCode").intlTelInput({
				preferredCountries: ["<?php echo $_SESSION['foneCountryIso']; ?>"]
			});
		<?php } else { ?>
			$("#telCountryIsoCode").intlTelInput();
		<?php } ?>

		<?php if (!empty($_SESSION['cellnoCountryCodeIso'])) { ?>
			$("#mobile-country-code").intlTelInput({
				preferredCountries: ["<?php echo $_SESSION['cellnoCountryCodeIso']; ?>"]
			});
		<?php } else { ?>
			$("#mobile-country-code").intlTelInput();
		<?php } ?>

		<?php /*if(!empty($_SESSION['del_cellnoCountryCodeIso'])) { ?>
												$("#del-mobile-country-code").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['del_cellnoCountryCodeIso'];?>" ]});
											<?php } else {?>
												$("#del-mobile-country-code").intlTelInput();
											<?php } ?>

											<?php if(!empty($_SESSION['del_cellnoCountryCodeIso2'])) { ?>
												$("#del-mobile-country-code2").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['del_cellnoCountryCodeIso2'];?>" ]});
											<?php } else {?>
												$("#del-mobile-country-code2").intlTelInput();
											<?php } ?>

											<?php if(!empty($_SESSION['part_cellnoCountryCodeIso'])) { ?>
												$("#part-mobile-country-code").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['part_cellnoCountryCodeIso'];?>" ]});
											<?php } else {?>
												$("#part-mobile-country-code").intlTelInput();
											<?php } */ ?>

		$("#fon").inputFilter(function (value) {
			return /^\d*$/.test(value);
		});

		$("#mob").inputFilter(function (value) {
			return /^\d*$/.test(value);
		});

		<?php /*?>$("#del_mob").inputFilter(function(value) {
												return /^\d*$/.test(value); 
											});<?php */ ?>

		$(document).on('change', "#gst_number", function () {
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
		//$('#booth_size1').trigger('click');
		hidegst();
		//showForm();
		show_cata();
	});

	function hidegst() {
		$('#gst-div').hide();
		if ($('#gst').val() == 'Registered') {
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
		if (document.getElementById("subsector").value == "Other") {
			$('#other-sector-div').show();
			document.getElementById("other - sector").value = "";

		} else {
			document.getElementById("other - sector").value = "";
			$('#other-sector-div').hide();
		}

		/*$('#other-sector-div').hide();
		if (document.getElementById("sector").value == 'Other') {
			$('#other-sector-div').show();
		}*/

	}

	function show_cata() {
		if (document.getElementById("Indian").checked == true) {
			$('.international-tariff').hide();
			$('.indian-tariff').show();
		} else if (document.getElementById("Foreign").checked == true) {
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
</script>

<!-- RefreshCaptcha function updated to use enquiry_captcha.php -->
<script>
function refreshCaptcha() {
    // console.log('Refresh captcha button clicked');
    
    // Back to using the original captcha file
    const url = 'exhibitor_payment_form_captcha.php?action=refresh&rand=' + Date.now();
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
                    document.getElementById("vercode_ex").value = '';
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

<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
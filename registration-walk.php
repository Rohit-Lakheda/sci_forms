<?php

header("Location: https://interlinxpartnering.com/bts-forms/registration-walk.php");
exit();
// https://interlinxpartnering.com/bts-forms/registration-walk.php
exit;
ini_set("display_errors", 0);
require "includes/form_constants_both.php";
$ret = @$_GET["ret"];

if ($ret == "retds4fu324rn_ed24d3it") {
	session_start();
	if (!isset($_SESSION["vercode_reg"]) || $_SESSION["vercode_reg"] == "") {
		session_destroy();
		echo "<script language='javascript'>alert('Please try again.');</script>";
		echo "<script language='javascript'>window.location=('registrations.php');</script>";
		echo "<script language='javascript'>document.location=('registrations.php');</script>";
		exit();
	}
	require "dbcon_open.php";
} else {
	include "captcha_reg.php";
}

$discountDetail = [];
if (isset($_GET["a"]) && !empty($_GET["a"])) {
	$assoc_name1 = mysqli_real_escape_string($link,htmlspecialchars($_GET["a"]));

	$sql =
		"SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_TBL WHERE promo_code='" .
		$assoc_name1 .
		"'";
	$discountDetail = mysqli_fetch_assoc(mysqli_query($link,$sql));
	if (isset($discountDetail["reg_done"])) {
		if ($discountDetail["reg_done"] >= $discountDetail["total_reg"]) {
			session_destroy();
			echo "<script language='javascript'>alert('For " .
				$discountDetail["assoc_name"] .
				" Association/ Dignitary registrations seats are fulled.');</script>";
			echo "<script language='javascript'>window.location = 'registration.php';</script>";
			exit();
		}
	} else {
		session_destroy();
		echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
		echo "<script language='javascript'>window.location='registration.php';</script>";
		exit();
	}
}

$totalRegistrations = 200; //mysqli_num_rows($qr_gt_user_data_id);
//query from registration table where pay_status is Paid
$qr_gt_user_data_id = mysqli_query($link,
    "SELECT count(*) as total_reg FROM $EVENT_DB_FORM_REG_WALK WHERE pay_status='Paid'"
);
$totalRegistrations = mysqli_fetch_assoc($qr_gt_user_data_id);
$count = $totalRegistrations['total_reg'];
// echo "Total Registrations: " . $totalRegistrations['total_reg'];
// die;
$assoc_name = @$_GET["assoc_name"];
if ($assoc_name == "STPI") {
	echo "<script language='javascript'>window.location = 'registration.php?assoc_name=SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)';</script>";
	exit();
} elseif ($assoc_name == "TBCM") {
	echo "<script language='javascript'>window.location = 'registration.php?assoc_name=Tie Bengaluru charter members';</script>";
	exit();
}

if (
	$assoc_name == "Shell%20Netherland%20Delegation" ||
	$assoc_name == "Shell Netherland Delegation"
) {
	echo "<script language='javascript'>alert('Registration Limit for Individual Company is Over.');</script>";
	echo "<script language='javascript'>document.location=('https://bengalurutechsummit.com/');</script>";
	exit();
}
?>
<?php
$pageStyleCss =
	'<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />';
require "includes/reg_form_header.php";
?>
<style>
	.selected-flag {
		margin-top: -5px;
	}

	.first-row td {
		background: #acb9ca;
	}

	.second-row td {
		background: #f4b084;
	}

	.third-row td {
		background: #dbdbdb;
	}

	.fourth-row td {
		background: #b4c6e7;
	}

	.fifth-row td {
		background: #00b050;
	}

	.button {
		background-color: #f00;
		-webkit-border-radius: 10px;
		border-radius: 10px;
		border: none;
		color: #FFFFFF;
		padding: 5px 7px;
		/*display: inline-block;
	  font-family: Arial;
	  font-size: 20px;
	  text-align: center;
	  text-decoration: none;*/
	}

	@-webkit-keyframes glowing {
		0% {
			background-color: #f00;
			-webkit-box-shadow: 0 0 3px #f00;
		}

		50% {
			background-color: #fff;
			-webkit-box-shadow: 0 0 10px #fff;
		}

		100% {
			background-color: #f00;
			-webkit-box-shadow: 0 0 3px #f00;
		}
	}

	@-moz-keyframes glowing {
		0% {
			background-color: #f00;
			-moz-box-shadow: 0 0 3px #f00;
		}

		50% {
			background-color: #fff;
			-moz-box-shadow: 0 0 10px #fff;
		}

		100% {
			background-color: #f00;
			-moz-box-shadow: 0 0 3px #f00;
		}
	}

	@-o-keyframes glowing {
		0% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}

		50% {
			background-color: #fff;
			box-shadow: 0 0 10px #fff;
		}

		100% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}
	}

	@keyframes glowing {
		0% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}

		50% {
			background-color: #fff;
			box-shadow: 0 0 10px #fff;
		}

		100% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}
	}

	.button {
		-webkit-animation: glowing 3000ms infinite;
		-moz-animation: glowing 3000ms infinite;
		-o-animation: glowing 3000ms infinite;
		animation: glowing 3000ms infinite;
	}

	@keyframes glowing {
		0% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}

		50% {
			background-color: #000;
			box-shadow: 0 0 10px #fff;
		}

		100% {
			background-color: #f00;
			box-shadow: 0 0 3px #f00;
		}
	}

	.button {
		animation: glowing 3000ms infinite;
	}

	.align-td {
		text-align: center;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"><?php if (
																				$discountDetail["assoc_name"] == "International"
																			) {
																				echo "International ";
																			} ?>Bengaluru Walks Attendee Form <?php if (
									$assoc_name == "Tie Bengaluru charter members"
								) {
									echo "with Special offer only for TiE Bangalore Charter Members @ Rs. 3K";
								} ?>
					</span>
				</div>
			</div>
			<?php //$count = 26	; ?>
			<div class="portlet-body form">
				<?php if (date("Y-m-d H:i") <= "2024-11-22 13:00"  && $count<=25) { ?>
					<form action="registration2-walk.php<?php echo !empty($ret) ? "?ret=" . $ret
															: ""; ?>"
						class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post"
						onsubmit="return validate_registration_form_2();">

						<div class="form-wizard">
							<div class="form-body" <?php echo date("Y-m-d H:i"); ?>>
								<ul class="nav nav-pills nav-justified steps">
									<li class="active">
										<a href="#tab1" data-toggle="tab" class="step">
											<span class="number"> 1 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Registration Category </span>
										</a>
									</li>

									<!-- <li>
										<a data-toggle="tab" class="step dips-default-cursor">
											<span class="number"> 2 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Delegate Information </span>
										</a>
									</li> -->
									<li>
										<a data-toggle="tab" class="step dips-default-cursor">
											<span class="number"> 3 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Confirm </span>
										</a>
									</li>
									<li>
										<a data-toggle="tab" class="step dips-default-cursor">
											<span class="number"> 4 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Receipt </span>
										</a>
									</li>
								</ul>
								<div id="bar" class="progress progress-striped" role="progressbar">
									<div class="progress-bar progress-bar-success"> </div>
								</div>
								<!-- <h3 class="block">Provide required information for Attendee</h3> -->
								<!-- <div class="row form-group hide">
									<label class="control-label col-md-3"> Select Conference Type <span class="required"> *
										</span></label>
									<div class="col-md-9">
										<div class="md-radio-inline">

											<div class="md-radio">
												<input type="radio" id="delegate-virtual" name="conf_type"
													class="md-radiobtn" value="Virtual Conference" onclick="showForm();">
												<label for="delegate-virtual">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> Virtual Conference </label>
											</div>
										</div>
									</div>
								</div> -->
								<!-- <div class="tab-content main-form-div" id="main-form-div">
									<div class="form-group">
										<label class="control-label col-md-1"></label>
										<div class="col-md-9">
											<?php /* if ($assoc_name == "SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)") { ?>
												<table class="table table-striped table-hover1 table-bordered teriff-table">
													<thead>
														<tr bgcolor="#2fa0dd" style="color: #fff;">
															<th colspan="1">Catagory</th>
															<?php

															?>
															<th colspan="2">TARIFF**</th>
															</th>
															<?php

															?>
														</tr>
													</thead>

													<tr class="indian-tariff first-row">
														<td colspan="1"><?php echo $assoc_name; ?></td>
														<?php

														?>
														<td colspan="2" class="success1">INR 3000
															<?php

															?>
														</td>
														<?php

														?>
													</tr>
													<tr>
														<td colspan="6">
															<p><strong>Please note</strong><br />
																** 18% GST Applicable<br />
																- Group discount of 10% for 3 or more DELEGATES from same
																organisation <br />
															</p>
														</td>
													</tr>

												</table>
											<?php } 
											 else { ?>
												<?php /*<table
													class="table table-hover1 table-bordered teriff-table col-md-offset-1 col-md-7 main-tariff-table">
													<thead>
														<tr bgcolor="#2fa0dd" style="color: #fff;">
															<th colspan="6" style="text-align: center;">Delegate Tariff</th>
														</tr>

														<tr>
															<th>REGULAR TARIFF</th>
															<th>EARLY BIRD OFFER</th>
															<th class="indian-tariff">REGISTRATION SLABS</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="indian-tariff" style="background-color: #e1e1e1;"
																rowspan="4">
																<strong>INR 10000</strong>
															</td>
														</tr>
														<tr>
															<td class="indian-tariff" style="background-color: #e1e1e1;">INR
																3000</td>
															<td class="indian-tariff" style="background-color: #e1e1e1;">01 – 1200 Tickets Or <br />(Upto 10th Nov)</td>
														</tr>
														<?php  ?>
														<tr>

															<td class="indian-tariff" style="background-color: #e1e1e1;">INR
																5000</td>
															<td class="indian-tariff" style="background-color: #e1e1e1;">
																2001– 4000 Tickets OR <br />(11th Nov to 17th Nov)</td>
														</tr>
														<?php  ?>
														<tr>

															<td class="indian-tariff" style="background-color: #e1e1e1;">INR
																10000</td>
															<td class="indian-tariff" style="background-color: #e1e1e1;">
																18th Nov Onwards </td>
														</tr>
														<?php

														?>
														<tr>
															<td class="international-tariff"
																style="background-color: #e1e1e1;">USD 300</td>

															<td class="international-tariff"
																style="background-color: #e1e1e1;">USD 250 <br />
																(up to 17th Nov)
															</td>
															<td class="international-tariff"
																style="background-color: #e1e1e1;"><strong>INTERNATIONAL
																	DELEGATES</strong> </td>
														</tr>
														<?php

														?>
														<tr>
															<td colspan="5">
																<strong>Note: </strong><br />
																- 18% GST Applicable<br />
																- Group discount of 10% for 3 or more DELEGATES from same
																organisation <br />
															</td>
														</tr>
													</tbody>
												</table>
												*/ ?>
												<?php

												?>
											<?php /* } */ ?>
										</div><br /><br />
										
									</div>
									
										<div class="col-md-3" id="other-div" style="display:none;">
											<input type="text" class="form-control" id="other_value" name="other_value"
												placeholder="Other Value">
											<span class="help-block">Eg. Friends, Colleague</span>
										</div>
									</div> -->
									<style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
	<div>
									<table>
        <thead>
            <tr>
                <th>Walk Detail</th>
                <th>Information</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Walk Title</td>
                <td>The Ride-cum-Walking Tour</td>
            </tr>
            <tr>
                <td>Walk Date</td>
                <td>Nov 21, 2024</td>
            </tr>
            <tr>
                <td>Walk Time</td>
                <td>7:00 - 9:30 AM</td>
            </tr>
            <tr>
                <td>Walk Start Location</td>
                <td>Shangri-La Hotels and Resorts</td>
            </tr>
            <tr>
                <td>Walk End Location</td>
                <td>Bangalore Palace</td>
            </tr>
			<tr>
                <td>Cost</td>
                <td>Rs.1000/- + gst</td>
            </tr>
			
        </tbody>
    </table>
	<tr>
		<td>Note</td>
		<td>Limit of registration is 25</td>
	</tr>
	</div>
									<h3 class="block">Provide Attendee Information</h3>
									<div class="form-group">
											<label class="control-label col-md-3">Name <span class="dips-required"> *
												</span></label>
											<div class="col-md-2">
												<select class="form-control" name="title1"
													id="title1" required="required">
													<option value="">-Title-</option>
													<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
													foreach ($titleList as $title) {
														$selected = '';
														echo '<option value="' . $title . '" ' . $selected . '>' . $title . '</option>';
													}
													?>
												</select>
											</div>
											<div class="col-md-2"><input type="text" class="form-control"
													placeholder="First Name" name="fname1" type="text"
													id="fname1" maxlength="100" value="<?php if (isset($_SESSION['fname1'])) {
														   echo $_SESSION['fname1' ];
													   }  ?>" required="required"></div>
											<div class="col-md-2"><input type="text" class="form-control"
													placeholder="Last Name" name="lname1" type="text"
													id="lname1" maxlength="100" value="<?php if (isset($_SESSION['lname1'])) {
														   echo $_SESSION['lname1'];
													   }  ?>" required="required"></div>
										</div>
									<div class="form-group">
										<label class="col-md-3 control-label">E-mail <span
												class="dips-required"> * </span><span id="gstorg"><br /></span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="email1" id="email1"
												value="<?php echo isset($_SESSION["email1"]) ? $_SESSION["email1"] : ""; ?>"
												required="required" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mobile Number <span
												class="dips-required"> * </span><span id="gstorg"><br /></span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="cellno1" id="cellno"
												value="<?php echo isset($_SESSION["cellno1"]) ? $_SESSION["org"] : ""; ?>"
												required="required" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Organisation Name <span
												class="dips-required"> * </span><span id="gstorg"><br /></span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="org" id="org"
												value="<?php echo isset($_SESSION["org"]) ? $_SESSION["org"] : ""; ?>"
												required="required" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Designation <span id="gstorg"><br /></span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="job_title1" id="job_title1"
												value="<?php echo isset($_SESSION["job_title1"]) ? $_SESSION["job_title1"] : ""; ?>"
												 />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Enter text see in the image <span
												class="dips-required"> * </span></label>
										<div class="col-md-6">
											<div class="input-group">
												<input name="vercode" type="text" class="form-control" id="vercodevp"
													maxlength="10" required autocomplete="off" />
												<input name="test" type="hidden" id="test"
													value="<?php echo $_SESSION["vercode_reg"]; ?>" />
												<span class="input-group-addon"
													style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercode_reg"]; ?></span>
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
			<h1>Bengaluru Walks Attendee Form for Bengaluru Tech Summit 2024 has been Closed.
				Please Visit Website For Latest Updates.<br /><a href="https://bengalurutechsummit.com/"
					target="_blank"> (Click Here to Visit Website)</a><strong><?php
																				//echo $EVENT_VENUE;
																				?></strong>
			</h1>
		<?php } ?>
		</div>
	</div>
</div>
</div>
<?php require "includes/reg_form_footer.php"; ?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
	var assoc_name = '<?php echo $assoc_name; ?>';
</script>
<script src="js/registration-test.js?sagar"></script>
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script>
	jQuery(document).ready(function() {
		Registration.init('registration_form_1', 0);
		//$('#main-form-div').hide();
		//debugger;
		//showForm();
		show_cata();
		//show_div_group_user();
		showTxt();
		showDays();
		assignSingleDay();
		showPromoCode();
		$("#telCountryIsoCode").intlTelInput();

		showInvoiceData();
	});

	function showPayment() {
		$('#bite').show();
		$('#bib').hide();
		/*var valie = $('#sector').val();
		if(valie == 'Information Technology') {
			$('#bite').show();
			$('#bib').hide();
			//$('#tech-div').hide();
			//$('#genotypic-div').hide();
			//document.getElementById("member_Yes").checked = false;
			//document.getElementById("member_No").checked = false;
		} else if(valie == 'Bio Technology') {
			$('#bite').hide();
			$('#bib').show();
			
			//$('#tech-div').show();
			//$('#genotypic-div').show();
		}
		showTxt();*/
	}

	function showPromo() {
		var valie = $('#event_know').val();
		if (valie == 'Others') {
			$('#other-div').show();
		} else {
			$('#other-div').hide();
		}
	}

	/*function showForm(){
		//$('#main-form-div').hide();
		if($('#delegate-conf').val() =='Delegate'){
			$('#main-form-div').show();
			$('#del_type').show();
		}else if($('#delegate-virtual').val() =='Virtual Conference'){
			$('#main-form-div').show();
			$('#del_type').hide();
		}
	}*/

	function showInvoiceData() {
		$('#gst-div').hide();
		$('#gstorg').hide();
		if ($('#is_gst_invoice_needed').val() == 'Yes') {
			$('#gst-div').show();
			$('#gstorg').show();
		}
	}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
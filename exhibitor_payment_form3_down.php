<?php
session_start();
//$_SESSION["vercode_ex"] = '24TNJ6';

if ((!isset($_SESSION["vercode_ex"])) || ($_SESSION["vercode_ex"] == '')) {
	session_destroy();
	echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
	echo "<script language='javascript'>window.location = 'exhibitor_payment_form.php';</script>";
	exit;
}
require("includes/form_constants_both.php");
require "dbcon_open.php";
$reg_id = $_SESSION['vercode_ex'];

$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " WHERE reg_id = '$reg_id'");
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " WHERE tin_no = '" . $_GET['id'] . "'");
}
$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
if (($qr_gt_user_data_ans_no <= 0) || ($qr_gt_user_data_ans_no == "")) {
	session_destroy();
	echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
	echo "<script language='javascript'>window.location = 'exhibitor_payment_form.php';</script>";
	exit;
}

$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO . " WHERE reg_id = '$reg_id'");
$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);

if ($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
	$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
} else {
	$total_amt = $qr_gt_user_data_ans_row['total'];
}

$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = 'ex$reg_id'");
$del_detail = mysqli_fetch_array($qr_gt_user_data_id);


/*if(empty($qr_gt_user_data_ans_row['user_type'])) {
		$ex_pay_bts = true;
	} else {
		$ex_pay_bts_assoc = true;
	}*/
?>
<?php require 'includes/reg_form_header.php'; ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_4">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Exhibitor at Startup Zone
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="exhibitor_payment_form4.php" class="form-horizontal" name="reg_registration_form_4"
					id="reg_registration_form_4" method="post" onsubmit="return validate_registration_form_4()">
					<input name="en" type="hidden" id="en" value="<?php echo $en; ?>" />
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="done">
									<a data-toggle="tab" class="step dips-default-cursor">
										<span class="number"> 1 </span>
										<span class="desc">
											<i class="fa fa-check"></i> Exhibitor Details </span>
									</a>
								</li>
								<li class="active">
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
											<i class="fa fa-check"></i> Payment </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success"> </div>
							</div>
							<div class="tab-content">
								<div class="tab-pane active">
									<h3 class="block">Confirm Detail</h3>
									<div class="row">
										<div class="col-md-12">
											<!-- BEGIN Registration Category TABLE PORTLET-->
											<div class="portlet light bordered">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-info-circle font-dark"></i>
														<span class="caption-subject">Registration Detail</span>
													</div>
												</div>
												<div class="portlet-body">
													<div class="table-scrollable">
														<table class="table table-striped table-bordered table-hover">
															<tbody>
																<?php if (!empty($qr_gt_user_data_ans_row['user_type'])) { ?>
																	<tr>
																		<td> <strong>Assocication Name</strong> </td>
																		<td> <?php echo $qr_gt_user_data_ans_row['user_type']; ?>
																		</td>
																	</tr>
																<?php } ?>
																<tr>
																	<td> <strong>Booth Size</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['booth_size']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>Sector</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['sector']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>Subsector</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['subsector']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>Name of Exhibitor (Organisation
																			Name)</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['exhibitor_name']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>Organisation Registration Certificate
																		</strong> </td>
																	<td> <a href="<?php echo $qr_gt_user_data_ans_row['ci_certf']; ?>"
																			target="_blank">Click Here to View</a> </td>
																</tr>
																<tr>
																	<td> <strong>How old is your company?</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['company_years']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>Invoice Address </strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['addr1']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>City</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['city']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>State</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['state']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>Postal Code</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['zip']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>Telephone Number</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['phone']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>Website</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['website']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>GST Number</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['gst_number']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong>PAN Number</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['pan_number']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong> Name </strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['cp_title'] . ' ' . $qr_gt_user_data_ans_row['cp_fname'] . ' ' . $qr_gt_user_data_ans_row['cp_lname']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong> Email</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['cp_email']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong> Mobile </strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['cp_mobile']; ?>
																	</td>
																</tr>
																<tr>
																	<td> <strong> Designation </strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['cp_desig']; ?>
																	</td>
																</tr>
																<?php /*
																																																																											   <tr>
																																																																												   <td> <strong>Nationality</strong> </td>
																																																																												   <td> <?php echo $qr_gt_user_data_ans_row['nationality']; ?> </td>
																																																																											   </tr>
																																																																											   <tr>
																																																																												   <td> <strong>Address 2</strong> </td>
																																																																												   <td> <?php echo $qr_gt_user_data_ans_row['addr2']; ?> </td>
																																																																											   </tr>
																																																																											   <tr>
																																																																												   <td> <strong>Country</strong> </td>
																																																																												   <td> <?php echo $qr_gt_user_data_ans_row['country']; ?> </td>
																																																																											   </tr><tr>
																																																																												   <td colspan="2">Delegate Detail</td>
																																																																											   </tr>
																																																																											   <tr>
																																																																												   <td> <strong> Delegate Type</strong> </td>
																																																																												   <td> <?php echo $del_detail['org_reg_type']; ?> </td>
																																																																											   </tr>
																																																																											   <tr>
																																																																												   <td> <strong>Delegate Category </strong> </td>
																																																																												   <td> <?php echo $del_detail['cata']; ?> </td>
																																																																											   </tr>
																																																																											   <tr>
																																																																												   <td> <strong> Name </strong> </td>
																																																																												   <td> <?php echo $del_detail['title1'] . ' ' . $del_detail['fname1'] . ' ' . $del_detail['lname1']; ?> </td>
																																																																											   </tr>
																																																																											   <tr>
																																																																												   <td> <strong> Email</strong> </td>
																																																																												   <td> <?php echo $del_detail['email1']; ?> </td>
																																																																											   </tr>
																																																																											   <tr>
																																																																												   <td> <strong>Mobile </strong> </td>
																																																																												   <td> <?php echo $del_detail['cellno1']; ?> </td>
																																																																											   </tr>
																																																																											   <?php if(!empty($del_detail['email3'])) {?>
																																																																												   <tr>
																																																																													   <td> <strong>Delegate Category </strong> </td>
																																																																													   <td> <?php echo $del_detail['cata3']; ?> </td>
																																																																												   </tr>
																																																																												   <tr>
																																																																													   <td> <strong> Name </strong> </td>
																																																																													   <td> <?php echo $del_detail['title3'] . ' ' . $del_detail['fname3'] . ' ' . $del_detail['lname3']; ?> </td>
																																																																												   </tr>
																																																																												   <tr>
																																																																													   <td> <strong> Email</strong> </td>
																																																																													   <td> <?php echo $del_detail['email3']; ?> </td>
																																																																												   </tr>
																																																																												   <tr>
																																																																													   <td> <strong>Mobile </strong> </td>
																																																																													   <td> <?php echo $del_detail['cellno3']; ?> </td>
																																																																												   </tr>
																																																																											   <?php }?>
																																																																											   <tr>
																																																																												   <td colspan="2">B2B Partnering Delegate Detail</td>
																																																																											   </tr>
																																																																											   <tr>
																																																																												   <td> <strong>Delegate Category </strong> </td>
																																																																												   <td> <?php echo $del_detail['cata2']; ?> </td>
																																																																											   </tr>
																																																																											   <tr>
																																																																												   <td> <strong> Name </strong> </td>
																																																																												   <td> <?php echo $del_detail['title2'] . ' ' . $del_detail['fname2'] . ' ' . $del_detail['lname2']; ?> </td>
																																																																											   </tr>
																																																																											   <tr>
																																																																												   <td> <strong> Email</strong> </td>
																																																																												   <td> <?php echo $del_detail['email2']; ?> </td>
																																																																											   </tr>
																																																																											   <tr>
																																																																												   <td> <strong>Mobile </strong> </td>
																																																																												   <td> <?php echo $del_detail['cellno2']; ?> </td>
																																																																											   </tr>*/ ?>
																<tr>
																	<td> <strong>Payment Mode</strong> </td>
																	<td> <?php echo $qr_gt_user_data_ans_row['paymode']; ?>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="table-scrollable">
														<?php if ($qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") { ?>
															<table class="table table-striped table-bordered table-hover">
																<tbody>
																	<tr>
																		<td colspan="2" class="success">Delegates are
																			requested to Bank Transfer the registration fees
																			to the following account</td>
																	</tr>
																	<?php if ($qr_gt_user_data_ans_row['nationality'] == 'Indian Organization') { ?>
																		<?php if ($qr_gt_user_data_ans_row['sector'] == "Bio Technology") { ?>
																			<tr>
																				<td>Account Name :</td>
																				<td style="width: 828px;">MM ACTIV SCI TECH
																					COMMUNICATIONS PVT. LTD.</td>
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
																				<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers
																					Tank Bed, Bangalore - 560 052, INDIA.</td>
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
																																																																																												   </tr>*/ ?>
																			<tr>
																				<td colspan="2" style="color: red;">Incase of
																					payment through IMPS. IMPS Transaction ID along
																					with Date of Payment to be sent to <a
																						href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a
																						href="mailto:adarsh.accounts@mmactiv.com">adarsh.accounts@mmactiv.com</a>
																				</td>
																			</tr>
																		<?php } else { ?>
																			<tr>
																				<td>Account Name :</td>
																				<td style="width: 828px;">MM ACTIV SCI TECH
																					COMMUNICATIONS PVT. LTD.</td>
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
																				<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers
																					Tank Bed, Bangalore - 560 052, INDIA.</td>
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
																																																																																													   <td><strong>Account Name</strong></td>
																																																																																													   <td>BANGALORE IT.BIZ </td>
																																																																																												   </tr>
																																																																																												   <tr>
																																																																																													   <td><strong>Account Type</strong></td>
																																																																																													   <td>Current Account</td>
																																																																																												   </tr>
																																																																																												   <tr>
																																																																																													   <td><strong>Account Number</strong></td>
																																																																																													   <td>2827201001190</td>
																																																																																												   </tr>
																																																																																												   <tr>
																																																																																													   <td><strong>Bank Name</strong></td>
																																																																																													   <td>Canara Bank K.S.F.C Complex Branch</td>
																																																																																												   </tr>
																																																																																												   <tr>
																																																																																													   <td><strong>DP Code No.</strong></td>
																																																																																													   <td>2827</td>
																																																																																												   </tr>
																																																																																												   <tr>
																																																																																													   <td><strong>Bank Address</strong></td>
																																																																																													   <td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
																																																																																												   </tr>
																																																																																												   <tr>
																																																																																													   <td><strong>Bank IFSC Code</strong></td>
																																																																																													   <td>CNRB0002827</td>
																																																																																												   </tr>
																																																																																												   <tr>
																																																																																													   <td><strong>Bank MICR Code</strong></td>
																																																																																													   <td>560015137</td>
																																																																																												   </tr>*/ ?>
																			<tr>
																				<td colspan="2" style="color: red;">Incase of
																					payment through IMPS. IMPS Transaction ID along
																					with Date of Payment to be sent to <a
																						href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a
																						href="mailto:adarsh.accounts@mmactiv.com">adarsh.accounts@mmactiv.com</a>
																				</td>
																			</tr>
																		<?php }
																	} else { ?>
																		<tr>
																			<td><strong>Account Name</strong></td>
																			<td>MM ACTIV SCI-TECH COMMUNICATIONS PVT.LTD.</td>
																		</tr>
																		<tr>
																			<td><strong>Account Type</strong></td>
																			<td>Current Account</td>
																		</tr>
																		<tr>
																			<td><strong>Account Number</strong></td>
																			<td>2827 241 000004</td>
																		</tr>
																		<tr>
																			<td><strong>Bank Name</strong></td>
																			<td>Canara Bank K.S.F.C Complex Branch</td>
																		</tr>
																		<tr>
																			<td><strong>DP Code No.</strong></td>
																			<td>2827</td>
																		</tr>
																		<tr>
																			<td><strong>Bank Address</strong></td>
																			<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers
																				Tank Bed, Bangalore - 560 052, INDIA.</td>
																		</tr>
																		<tr>
																			<td><strong>Bank SWIFT Code</strong></td>
																			<td>CNRBINBBLFD</td>
																		</tr>
																		<tr>
																			<td><strong>Bank MICR Code</strong></td>
																			<td>560015137</td>
																		</tr>
																		<tr>
																			<td colspan="2" style="color: red;">Incase of
																				payment through IMPS. IMPS Transaction ID along
																				with Date of Payment to be sent to <a
																					href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a
																					href="mailto:adarsh.accounts@mmactiv.com">adarsh.accounts@mmactiv.com</a>
																			</td>
																		</tr>
																	<?php } ?>
																</tbody>
															</table>
														<?php } else if (($qr_gt_user_data_ans_row['paymode'] == "Cheque") || ($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD")) { ?>
																<table class="table well table-condensed table-striped">
																	<tbody>
																		<tr>
																			<td style="border: medium none;"></td>
																			<td style="border: medium none; width: 99%;">
																			<?php if ($qr_gt_user_data_ans_row['sector'] == "Bio Technology") { ?>
																					<p>
																						Please send your Cheque/DD in favour of
																					<?php echo $EVENT_CHEQUE_PAYBLE_AT_NAME; ?>
																						payable at
																					<?php echo $EVENT_CHEQUE_PAYBLE_AT; ?>.<br />
																						Along with the copy of your registration
																						receipt and send to<br />
																						<strong>Address
																							:</strong><br /><?php echo $EVENT_CHEQUE_PAYBLE_ADDRESS; ?>
																					<p>
																				<?php } else { ?>
																					<p>
																						Please send your Cheque/DD in favour of
																					<?php echo $EVENT_CHEQUE_PAYBLE_AT_NAME; ?>
																						payable at
																					<?php echo $EVENT_CHEQUE_PAYBLE_AT; ?>.<br />
																						Along with the copy of your registration
																						receipt and send to<br />
																						<strong>Address
																							:</strong><br /><?php echo $EVENT_CHEQUE_PAYBLE_ADDRESS; ?>
																					<p>
																				<?php } ?>
																			</td>
																		</tr>
																	</tbody>
																</table>
														<?php }
														$OrderId = $qr_gt_user_data_ans_row['pg_paymentid'];
														$tracking_id = $qr_gt_user_data_ans_row['pg_trackid'];
														$bank_ref_no = $qr_gt_user_data_ans_row['pg_tranid'];

														$pg_result = explode('#', $qr_gt_user_data_ans_row['pg_result']);
														$order_status = $payment_mode = $currency = '';
														if (isset($pg_result[5])) {
															$order_status = $pg_result[5];
														}
														if (isset($pg_result[0])) {
															$payment_mode = $pg_result[0];
														}
														if (isset($pg_result[4])) {
															$currency = $pg_result[4];
														}
														$Amount = $qr_gt_user_data_ans_row['pg_amt'];
														//$order_status = 'asd';
														if (!empty($order_status)) {
															?>
															<table class="table table-striped table-bordered table-hover">
																<tbody>
																	<tr>
																		<td colspan="2" class="success">Payment Gateway
																			Response</td>
																	</tr>
																	<tr>
																		<td><strong>Order Id</strong></td>
																		<?php if (empty($OrderId)) { ?>
																			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																			</td>
																		<?php } else { ?>
																			<td><?php echo $OrderId; ?></td>
																		<?php } ?>
																	</tr>
																	<tr>
																		<td><strong>Tracking Id</strong></td>
																		<td><?php echo $tracking_id; ?></td>
																	</tr>
																	<tr>
																		<td><strong>Bank Reference Id</strong></td>
																		<td><?php echo $bank_ref_no; ?></td>
																	</tr>
																	<tr>
																		<td><strong>Payment Status</strong></td>
																		<td><?php echo $order_status; ?></td>
																	</tr>
																	<tr>
																		<td><strong>Payment Mode Used </strong></td>
																		<td><?php echo $payment_mode; ?></td>
																	</tr>
																	<tr>
																		<td><strong>Transaction Amount</strong></td>
																		<td><?php echo $currency . " " . $Amount; ?></td>
																	</tr>
																</tbody>
															</table>
														<?php } ?>
													</div>
												</div>
											</div>
											<!-- END Registration Category TABLE PORTLET-->
										</div>
									</div>
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6">
											<div class="well">
												<div class="row static-info align-reverse">
													<div class="col-md-8 name">
														Selection Amount:
													</div>
													<div class="col-md-4 value">
														<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['selection_amt']; ?>
													</div>
												</div>
												<?php if (($qr_gt_user_data_ans_row['admin_discount'] != "") && ($qr_gt_user_data_ans_row['admin_discount'] > 0)) { ?>
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															Admin Discount @
															<?php echo $qr_gt_user_data_ans_row['adminDiscountPer']; ?>%:
														</div>
														<div class="col-md-4 value">
															<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['admin_discount']; ?>
														</div>
													</div>
												<?php } ?>
												<?php if (($qr_gt_user_data_ans_row['membership_discount'] != "") && ($qr_gt_user_data_ans_row['membership_discount'] > 0)) { ?>
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															Membership Discount @
															<?php echo $qr_gt_user_data_ans_row['membershipDiscountPer']; ?>%:
														</div>
														<div class="col-md-4 value">
															<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['membership_discount']; ?>
														</div>
													</div>
												<?php } ?>
												<?php if (($qr_gt_user_data_ans_row['tax'] != "") && ($qr_gt_user_data_ans_row['tax'] > 0)) { ?>
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															GST @ <?php echo $SERVICE_TAX; ?>%:
														</div>
														<div class="col-md-4 value">
															<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['tax']; ?>
														</div>
													</div>
												<?php } ?>
												<?php if (($qr_gt_user_data_ans_row['processing_charge'] != "") && ($qr_gt_user_data_ans_row['processing_charge'] > 0)) { ?>
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															Processing Charges :
														</div>
														<div class="col-md-4 value">
															<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['processing_charge']; ?>
														</div>
													</div>
												<?php } ?>
												<?php if (($qr_gt_user_data_ans_row['total'] != "") && ($qr_gt_user_data_ans_row['total'] > 0)) { ?>
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															Total (Including Processing Charges):
														</div>
														<div class="col-md-4 value">
															<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['total']; ?>
														</div>
													</div>
												<?php } ?>
												<?php if (!empty($total_amt)) { ?>
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															Total Amount Payable in INR(Including Processing Charges):
														</div>
														<div class="col-md-4 value">
															<?php echo 'INR ' . $total_amt; ?>
														</div>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="well well-lg">
												<div class="md-checkbox-inline">
													<div class="md-checkbox">
														<input type="checkbox" id="agree" class="md-check">
														<label for="agree">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> I have read and hereby accept that
															all the data entered in the registration form is correct.
															Details once confirmed cannot be modified.
														</label>
													</div>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<a href="exhibitor_payment_form.php?rt=retds4fn324rn_ed24d3it" class="btn default">
										<i class="fa fa-angle-left"></i> Back </a>
									<?php if ($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') { ?>
										<button class="btn sbold uppercase green-jungle" type="submit" name="make_payment"
											value="1">
											Make Payment&nbsp;&nbsp;<i class="fa fa-inr m-icon-white"></i>
										</button>
									<?php } else { ?>
										<button class="btn sbold uppercase green-jungle" type="submit" name="make_payment"
											value="0">
											Continue <i class="m-icon-swapright m-icon-white"></i>
										</button>
									<?php } ?>
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
<script>
	jQuery(document).ready(function () {
		Registration.init('registration_form_4', 1);
	});

	function validate_registration_form_4() {
		if ((document.getElementById("agree").checked == false)) {
			alert('Please accept terms and conditions');
			document.getElementById("agree").focus();
			return false;
		}
	}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
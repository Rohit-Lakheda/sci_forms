<?php session_start();
	if(!isset($_SESSION['vercode_pstr']) || empty($_SESSION['vercode_pstr'])){
		echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
		echo "<script language='javascript'> window.location =('poster_presentation_form.php');</script>";
		exit();	
	}
  	require("includes/form_constants_both.php");
  	require "dbcon_open.php";
  	$reg_id = $_SESSION['vercode_pstr'];
  
  	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$PSTR_TBL_NAME_DEMO." WHERE reg_id = '$reg_id'");
  	if(isset($_GET['id']) && !empty($_GET['id'])) {
  		$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$PSTR_TBL_NAME_DEMO." WHERE tin_no = '" . $_GET['id'] . "'");
  	}
  	if(mysqli_num_rows($qr_gt_user_data_id) <= 0) {
  		echo "<script language='javascript'>alert('Your session has been expired. Please try again!');</script>";
  		echo "<script language='javascript'> window.location =('poster_presentation_form.php');</script>";
  		exit();
  	}
  	$res = $qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
  
  	if($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
  		$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
  	} else {
  		$total_amt = $qr_gt_user_data_ans_row['total'];
  	}
  
  require 'includes/reg_form_header.php';
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_4">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Poster Submission Form</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="poster_presentation_form4.php" class="form-horizontal" name="reg_registration_form_4" id="reg_registration_form_4" method="post" onsubmit="return validate_registration_form_4();">
					<input name="en" type="hidden" id="en" value="<?php echo $en;?>"/>
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="done">
									<a class="step">
									<span class="number"> 1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Poster Info </span>
									</a>
								</li>
								<li class="active">
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Preview </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 3 </span>
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
									<h3 class="block">Confirm Poster Detail</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="table-scrollable">
												<table class="table table-striped table-bordered table-hover">
													<tbody>
														<tr>
															<td> <strong>Sector</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['sector']; ?> </td>
														</tr>
														<tr>
															<td> <strong>Nationality</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['curr']; ?> </td>
														</tr>
														<tr>
															<td> <strong>Title of Paper</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['poster_title']; ?> </td>
														</tr>
														<tr>
															<td> <strong>Payment Mode</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['paymode']; ?> </td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="table-scrollable ">
												<?php if($qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") { ?>
												<table class="table table-striped table-bordered table-hover">
													<tbody>
														<tr>
															<td  colspan="2" class="success">Delegates are requested to Bank Transfer the registration fees to the following account</td>
														</tr>
														<?php if($qr_gt_user_data_ans_row['curr'] == 'Indian Organization') {?>
														<tr>
															<td>Account Name :</td>
															<td>MM ACTIV SCI TECH COMMUNICATIONS PVT. LTD.</td>
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
														<tr>
															<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>
														</tr>
														<?php } else {?>
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
															<td>2827241000004</td>
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
															<td><strong>Bank SWIFT Code</strong></td>
															<td>CNRBINBBLFD</td>
														</tr>
														<tr>
															<td><strong>Bank MICR Code</strong></td>
															<td>560015137</td>
														</tr>
														<tr>
															<td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>
														</tr>
														<?php }?>
													</tbody>
												</table>
												<?php } else if(($qr_gt_user_data_ans_row['paymode'] == "Cheque")||($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD")) {?>
												<table class="table well table-condensed table-striped">
													<tbody>
														<tr>
															<td style="border: medium none;"></td>
															<td style="border: medium none; width: 99%;">
																<?php if($qr_gt_user_data_ans_row['sector'] == "Bio Technology") { ?>
																<p>
																	Please send your Cheque/DD in favour of BANGALORE INDIA BIO payable at Bengaluru, India.<br>
																	Along with the copy of your registration receipt and send to<br>
																	<strong>Address :</strong><br>#9, UNI Building,3rd Floor, <br> Thimmaiah Road, Millers Tank Bund, <br>Vasanthnagar, Bengaluru - 560 052, India<br>Tel:  +91.80.4113 1912/3<br>Website: <a href="http://www.bengaluruindiabio.in" target="_blank">www.bengaluruindiabio.in</a>
																</p>
																<?php } else {?>
																<p>
																	Please send your Cheque/DD in favour of <?php echo $EVENT_CHEQUE_PAYBLE_AT_NAME;?> payable at <?php echo $EVENT_CHEQUE_PAYBLE_AT;?>.<br />
																	Along with the copy of your registration receipt and send to<br />
																	<strong>Address :</strong><br/><?php echo $EVENT_CHEQUE_PAYBLE_ADDRESS;?>
																<p>
																	<?php }?>
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
													if(isset($pg_result[5])) {
														$order_status = $pg_result[5];
													}
													if(isset($pg_result[0])) {
														$payment_mode = $pg_result[0];
													}
													if(isset($pg_result[4])) {
														$currency = $pg_result[4];
													}
													$Amount = $qr_gt_user_data_ans_row['pg_amt'];
													//$order_status = 'asd';
													if(!empty($order_status)) {
													?>
												<table class="table table-striped table-bordered table-hover">
													<tbody>
														<tr>
															<td colspan="2" class="success">Payment Gateway Response</td>
														</tr>
														<tr>
															<td><strong>Order Id</strong></td>
															<?php if(empty($OrderId)) {?>
															<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
															<?php } else {?>
															<td><?php echo $OrderId;?></td>
															<?php }?>
														</tr>
														<tr>
															<td><strong>Tracking Id</strong></td>
															<td><?php echo $tracking_id;?></td>
														</tr>
														<tr>
															<td><strong>Bank Reference Id</strong></td>
															<td><?php echo $bank_ref_no;?></td>
														</tr>
														<tr>
															<td><strong>Payment Status</strong></td>
															<td><?php echo $order_status;?></td>
														</tr>
														<tr>
															<td><strong>Payment Mode Used </strong></td>
															<td><?php echo $payment_mode;?></td>
														</tr>
														<tr>
															<td><strong>Transaction Amount</strong></td>
															<td><?php echo $currency . " " . $Amount;?></td>
														</tr>
													</tbody>
												</table>
												<?php } ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="table-scrollable">
												<table class="table table-striped table-bordered table-hover">
													<tbody>
														<tr>
															<td colspan="2"> <strong> <i class="fa fa-info-circle font-dark"></i> Details Of Lead Person</strong> </td>
														</tr>
														<tr>
												            <td width="30%"><strong>Name</strong></td>
												            <td width="70%"><?php echo $res['lead_name'];?></td>
												          </tr>
														  <tr>
												            <td><strong>Organisation </strong></td>
												            <td><?php echo $res['lead_org'];?></td>
												          </tr>
												          <tr>
												            <td><strong>Email Id</strong></td>
												            <td><?php echo $res['lead_email'];?></td>
												          </tr>
												          <tr>
												            <td><strong>Phone Number</strong></td>
												            <td><?php echo $res['lead_ccode'] . '-' . $res['lead_acode'] . '-' . $res['lead_phone'];?></td>
												          </tr>
														   <tr>
												            <td><strong>Mobile Number</strong></td>
												            <td><?php echo $res['lead_mob'];?></td>
												          </tr>
														  <tr>
														    <td><strong>Address </strong></td>
														    <td><?php echo $res['lead_addr'];?></td>
														    </tr>
														  <tr>
														    <td><strong>City</strong></td>
														    <td><?php echo $res['lead_city'];?></td>
														    </tr>
														  <tr>
														    <td><strong>State</strong></td>
														    <td><?php echo $res['lead_state'];?></td>
														    </tr>
														  <tr>
														    <td><strong>Country</strong></td>
														    <td><?php echo $res['lead_country'];?></td>
														    </tr>
														  <tr>
														    <td><strong>Postal Code</strong></td>
														    <td><?php echo $res['lead_zip'];?></td>
														  </tr>
														<tr>
															<td colspan="2"> <strong> <i class="fa fa-info-circle font-dark"></i> Details Of Poster Presenter</strong> </td>
														</tr>
														<tr>
												            <td><strong>Name</strong></td>
												            <td><?php echo $res['pp_name'];?></td>
												          </tr>
														  <tr>
												            <td><strong>Organisation </strong></td>
												            <td><?php echo $res['pp_org'];?></td>
												          </tr>
														  <tr>
												            <td><strong>Website </strong></td>
												            <td><?php echo $res['pp_website'];?></td>
												          </tr>
												          <tr>
												            <td><strong>Email Id</strong></td>
												            <td><?php echo $res['pp_email'];?></td>
												          </tr>
												          <tr>
												            <td><strong>Phone Number</strong></td>
												            <td><?php echo $res['pp_ccode'] . '-' . $res['pp_acode'] . '-' . $res['pp_phone'];?></td>
												          </tr>
														   <tr>
												            <td><strong>Mobile Number</strong></td>
												            <td><?php echo $res['pp_mob'];?></td>
												          </tr>
														  <tr>
														    <td><strong>Address </strong></td>
														    <td><?php echo $res['pp_addr'];?></td>
														    </tr>
														  <tr>
														    <td><strong>City</strong></td>
														    <td><?php echo $res['pp_city'];?></td>
														    </tr>
														  <tr>
														    <td><strong>State</strong></td>
														    <td><?php echo $res['pp_state'];?></td>
														    </tr>
														  <tr>
														    <td><strong>Country</strong></td>
														    <td><?php echo $res['pp_country'];?></td>
														    </tr>
														  <tr>
														    <td><strong>Postal Code</strong></td>
														    <td><?php echo $res['pp_zip'];?></td>
														  </tr>
														
														<tr>
															<td colspan="2"> <strong> <i class="fa fa-info-circle font-dark"></i> Details Of Co Author(s)</strong> </td>
														</tr>
														<tr>
															<td> <strong>Name of Co-Author 1</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['co_author_1']; ?> </td>
														</tr>
														<tr>
															<td> <strong>Name of Co-Author 2</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['co_author_2']; ?> </td>
														</tr>
														<tr>
															<td> <strong>Name of Co-Author 3</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['co_author_3']; ?> </td>
														</tr>
														<tr>
															<td> <strong>Name of Co-Author 4</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['co_author_4']; ?> </td>
														</tr>
														<tr>
															<td colspan="2"> <strong> <i class="fa fa-info-circle font-dark"></i> Details of Accompanying Co-Author(s) to the Event</strong> </td>
														</tr>
														<tr>
															<td> <strong>Name of Co-Author 1</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['accop_co_author_1']; ?> </td>
														</tr>
														<tr>
															<td> <strong>Name of Co-Author 2</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['accop_co_author_2']; ?> </td>
														</tr>
														<tr>
															<td> <strong>Name of Co-Author 3</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['accop_co_author_3']; ?> </td>
														</tr>
														<tr>
															<td> <strong>Name of Co-Author 4</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['accop_co_author_4']; ?> </td>
														</tr>
														<tr>
															<td> <strong>Theme</strong> </td>
															<td> <?php echo $qr_gt_user_data_ans_row['poster_catagory']; ?> </td>
														</tr>
														<tr>
															<td> <strong>Abstract of Poster</strong> </td>
															<td> <?php echo htmlspecialchars($res['abstract_text']); ?> <br><br><a href="<?php echo $res['poster_abstract'];?>" target='_blank'> Click here to download file </a> </td>
														</tr>
														<tr>
															<td> <strong>CV of lead Author</strong> </td>
															<td> <a href="<?php echo $res['lead_cv'];?>" target='_blank'> Click here to download file </a> </td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6">
											<div class="well">
												<div class="row static-info align-reverse">
													<div class="col-md-8 name">
														Total Selection Amount:
													</div>
													<div class="col-md-4 value">
														<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['selection_amt']; ?>
													</div>
												</div>
												<?php /*if( ($qr_gt_user_data_ans_row['admin_discount'] != "") && ($qr_gt_user_data_ans_row['admin_discount'] >0) ) {?>
												<div class="row static-info align-reverse">
													<div class="col-md-8 name">
														Admin Discount @ <?php echo $qr_gt_user_data_ans_row['adminDiscountPer'];?>%:
													</div>
													<div class="col-md-4 value">
														<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['admin_discount']; ?>
													</div>
												</div>
												<?php } ?>
												<?php if( ($qr_gt_user_data_ans_row['gr_discount'] != "") && ($qr_gt_user_data_ans_row['gr_discount'] >0) ) {?>
												<div class="row static-info align-reverse">
													<div class="col-md-8 name">
														Group Discount @ 10%:
													</div>
													<div class="col-md-4 value">
														<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['gr_discount']; ?>
													</div>
												</div>
												<?php } ?>
												<?php if( ($qr_gt_user_data_ans_row['membership_discount'] != "") && ($qr_gt_user_data_ans_row['membership_discount'] >0) ) {?>
												<div class="row static-info align-reverse">
													<div class="col-md-8 name">
														Membership Discount @ <?php echo $qr_gt_user_data_ans_row['membershipDiscountPer'];?>%:
													</div>
													<div class="col-md-4 value">
														<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['membership_discount']; ?>
													</div>
												</div>
												<?php } */?>
												<?php if( ($qr_gt_user_data_ans_row['tax'] != "") && ($qr_gt_user_data_ans_row['tax'] >0) ) {?>
												<div class="row static-info align-reverse">
													<div class="col-md-8 name">
														GST @ <?php echo $SERVICE_TAX; ?>%:
													</div>
													<div class="col-md-4 value">
														<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['tax']; ?>
													</div>
												</div>
												<?php } ?>
												<?php if( ($qr_gt_user_data_ans_row['processing_charge'] != "") && ($qr_gt_user_data_ans_row['processing_charge'] >0) ) {?>
												<div class="row static-info align-reverse">
													<div class="col-md-8 name">
														Processing Charges :
													</div>
													<div class="col-md-4 value">
														<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' .$qr_gt_user_data_ans_row['processing_charge'] ; ?>
													</div>
												</div>
												<?php } ?>
												<?php if( ($qr_gt_user_data_ans_row['total'] != "") && ($qr_gt_user_data_ans_row['total'] >0) ) {?>
												<div class="row static-info align-reverse">
													<div class="col-md-8 name">
														Total (Including Processing Charges):
													</div>
													<div class="col-md-4 value">
														<?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['total']; ?>
													</div>
												</div>
												<?php } ?>
												<?php if(!empty($total_amt)) { ?>
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
														<span class="box"></span> I have read and hereby accept that all the data entered in the registration form is correct. Details once confirmed cannot be modified.
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<a href="poster_presentation_form.php?ret=retds4fu324rn_ed24d3it" class="btn default"><i class="fa fa-angle-left"></i> Back </a>
									<?php if($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Paypal' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {?>
										<button class="btn sbold uppercase green-jungle" type="submit" name="make_payment" value="1">
										Make Payment&nbsp;&nbsp;<i class="fa fa-inr m-icon-white"></i>
										</button>
									<?php } else {?>
										<button class="btn sbold uppercase green-jungle" type="submit" name="make_payment" value="0">
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
<?php require 'includes/reg_form_footer.php';?>
<script>
  jQuery(document).ready(function() {  
  	Registration.init('registration_form_4', 1);
  });
  
  function validate_registration_form_4() {
  	if((document.getElementById("agree").checked == false)) {
  		alert('Please accept terms and conditions');
  		document.getElementById("agree").focus();
          return false;
  	}
  }
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
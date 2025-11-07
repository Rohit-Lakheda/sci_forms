<?php

//session_start();

//$_SESSION["vercode_ex"] = '24TNJ6';

$tin_no = @$_GET['id'];

/*if(empty($tin_no)) {

		if((!isset($_SESSION["vercode_ex"]))||($_SESSION["vercode_ex"]==''))

		{

			session_destroy();

			echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";

			echo "<script language='javascript'>window.location=('exhibitor_payment_form.php');</script>";

			echo "<script language='javascript'>document.location=('exhibitor_payment_form.php');</script>";

			exit;

		}

	}

	*/

require ("form_includes/form_constants_both.php");

require "dbcon_open.php";



/*

$reg_id = @$_SESSION["vercode_ex"];



//$qr_gt_user_data_id = mysql_query("SELECT * FROM ".$EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL." WHERE tin_no = '$tin_no' AND reg_id='$reg_id'");

$qr_gt_user_data_id = mysql_query("SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL . " WHERE tin_no = '$tin_no'");

$qr_gt_user_data_ans_no = mysql_num_rows($qr_gt_user_data_id);

$qr_gt_user_data_ans_row = mysql_fetch_array($qr_gt_user_data_id);



if (($qr_gt_user_data_ans_no <= 0) || ($qr_gt_user_data_ans_no == "")) {

	session_destroy();

	echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";

	echo "<script language='javascript'>window.location=('exhibitor_payment_form.php');</script>";

	echo "<script language='javascript'>document.location=('exhibitor_payment_form.php');</script>";

	exit;

}

if ($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {

	if ($qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {

		//echo "<script language='javascript'>alert('Please make the payment.');</script>";

		//echo "<script language='javascript'>window.location = ('$EVENT_OL_PAY_ACT_LINK?id=" . $tin_no . "');</script>";

		//exit;

	}

}

if ($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {

	$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];

} else {

	$total_amt = $qr_gt_user_data_ans_row['total'];

}

if (empty($tin_no)) {

	session_destroy();

}

*/



/*if(empty($qr_gt_user_data_ans_row['user_type'])) {

		$ex_pay_bts = true;

	} else {

		$ex_pay_bts_assoc = true;

	}*/



?>

<?php require 'form_includes/reg_form_header.php'; ?>

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

				<form action="" class="form-horizontal" name="reg_registration_form_4" id="reg_registration_form_4"

					method="post" onsubmit="return validate_registration_form_4()">

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

								<li class="done">

									<a data-toggle="tab" class="step dips-default-cursor">

										<span class="number"> 2 </span>

										<span class="desc">

											<i class="fa fa-check"></i> Preview Detail</span>

									</a>

								</li>

								<li class="active">

									<a href="#tab1" data-toggle="tab" class="step">

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

									<h3 class="block">Registration Detail</h3>

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



																<tr>

																	<td> Your <strong>"StartUp Exhibitor

																			Registration"</strong> is <strong>presently

																			under review</strong>, Once 'Approved' you

																		will receive payment link on your registered

																		email address for further processing.</td>



																</tr>

																<tr>

																	<td> <strong>For More Details, Please connect

																			with:</strong> </td>



																</tr>

																<tr>

																	<td>Name: Sathyakanth Manukar <br />

																		Email: sathyakanth.manukar@mmactiv.com<a

																			href="mailto:sathyakanth.manukar@mmactiv.com"></a><br />

																		Mobile: +91 9035347772<br />

																	

																	</td>



																</tr>

																<tr>

																	<td>

																		<h4><strong>Note:</strong> Please check your

																			spam / junk mail box / mail folder. You will

																			receive the email from "

																			sci-expo@cdac.in". </h4>

																	</td>



																</tr>





															</tbody>

														</table>

													</div>



												</div>

											</div>

											<!-- END Registration Category TABLE PORTLET-->

										</div>

									</div>







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

<script>

	jQuery(document).ready(function () {

		Registration.init('registration_form_4', 2);

	});



	jQuery(document).bind("keyup keydown", function (e) {

		if (e.ctrlKey && e.keyCode == 80) {

			//alert('ok');

			//e.cancelBubble = true;

			//e.preventDefault();

		}

	});

</script>

<!-- END PAGE LEVEL SCRIPTS -->

</body>



</html>
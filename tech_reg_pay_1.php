<?php

require("form_constants.php");
$tin_id = @$_POST['tin_id'];

if ($tin_id == "") {
	$tin_id = @$_POST['id'];

	if ($tin_id == "") {
		$tin_id = @$_GET['id'];

		if ($tin_id == "") {
			echo "<script language='javascript'>alert('Error in Process.Please Try After Some Time');</script>";
			echo "<script language='javascript'>window.location = ('enter_reg_tin_no.php');</script>";
			exit;
		}
	}
}

require "dbcon_open.php";
require "class.phpmailer.php";

//  $qr1 = "SELECT * FROM " . $EVENT_DB_FORM_REG_WALK . " WHERE tin_no= '$tin_id'";
//  echo $qr1;
//  die;

$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_WALK . " WHERE tin_no = '$tin_id'") or die(mysqli_error($link));
$res_num_rows = 0;
$res_num_rows = mysqli_num_rows($qr);
if (($res_num_rows <= 0) || ($res_num_rows == "")) {

	echo "<script language='javascript'>alert('Please enter valid Tin Number or get registered on " . $EVENT_WEBSITE_LINK . " ');</script>";
	echo "<script language='javascript'>window.location = 'enter_reg_tin_no.php';</script>";
	exit;
}

$qr = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG_WALK . " WHERE tin_no = '$tin_id'") or die(mysqli_error($link));
$res = mysqli_fetch_assoc($qr);
$qr_gt_user_data_ans = $res;
$lmt = $res['sub_delegates'];
$selectedDays = 0;

if (!empty($qr_gt_user_data_ans_row['day1']))
	$selectedDays++;
if (!empty($qr_gt_user_data_ans_row['day2']))
	$selectedDays++;
if (!empty($qr_gt_user_data_ans_row['day3']))
	$selectedDays++;

if ($res['assoc_name'] == 'Manual' || $res['assoc_name'] == 'Tie Bengaluru charter members' || $res['assoc_name'] == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)') {
} else {
	if ($res['curr'] == "Indian" && $res['pay_status'] == "Not Paid" && $res['reg_date'] > '2024-11-10' && $selectedDays = 0) {
		/*/*if (date('Y-m-d') >= '2024-02-27' && date('Y-m-d') <= '2024-11-10') {
			$rate = "3000";
			$rate_org = "3000";
		} else if (date('Y-m-d') >= '2024-11-11' && date('Y-m-d') <= '2024-11-17') {
			$rate = "5000";
			$rate_org = "5000";
		} else if (date('Y-m-d') >= '2024-11-18' && date('Y-m-d') <= '2024-11-26') {
			$rate = "10000";
			$rate_org = "10000";
		} /*else if (date('Y-m-d') >= '2023-11-27' && date('Y-m-d') <= '2023-12-03') {
										  $rate = "7500";
										  $rate_org = "7500";
									  } */ /*else { //if(date('Y-m-d') >= '2022-10-26' && date('Y-m-d') <= '2022-11-14') {
			$rate = "10000";
			$rate_org = "10000";
		}*/
		/*$is_price_changed = false;

		if (($res['amt1'] != $rate) & ($res['assoc_name'] != 'Manual')) {
			$is_price_changed = true;
			$amt = 0;
			for ($i = 1; $i <= $lmt; $i++) {
				$a10 = "amt" . $i;
				$amt = $amt + $rate;
				mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG . " SET $a10 = '$rate_org' where tin_no= '$tin_id'") or die(mysqli_error($link));
				mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG . " SET selection_amt = '$amt' where tin_no= '$tin_id'") or die(mysqli_error($link));
			}
			$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no= '$tin_id'");
			$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
			$res = $res1 = $qr_gt_user_data_ans_row;

			$processing_charge_per = $res['processing_charge_per'];
			$processing_charge = 0;
			if (($res['gr_type'] == "Single") || ($res['sub_delegates'] <= "2")) {

				$amt_per_del = $main_amt = $res['selection_amt'];
				$admin_discount = $adminDiscount = $res['admin_discount'];
				if (!empty($adminDiscount)) {
					$admin_discount = round(($main_amt * $adminDiscount) / 100);
				}
				$main_amt = $main_amt - $admin_discount;

				$tax = round(($main_amt * $SERVICE_TAX) / 100);
				$total = round($main_amt + $tax);
				if (!empty($processing_charge_per)) {
					$processing_charge = round(($total * $processing_charge_per) / 100);
					$total = round($total + $processing_charge);
				}
			} else if (($res['gr_type'] == "Group") && ($res['sub_delegates'] >= "3")) {
				$amt_per_del = $main_amt = $res['selection_amt'];

				$gr_discount = round(($amt_per_del * 10) / 100);
				$main_amt = $main_amt - $gr_discount;

				$tax = round(($main_amt * $SERVICE_TAX) / 100);
				$total = round($main_amt + $tax);
				if (!empty($processing_charge_per)) {
					$processing_charge = round(($total * $processing_charge_per) / 100);
					$total = round($total + $processing_charge);
				}
				//echo $gr_discount.'--1--'.$total.'1--';exit;

			}*/
			/*echo $main_amt . '-';
																			  echo $tax . '-';
																			  echo $total . '-';*/
			//exit;
/*
			mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG . " SET gr_discount = '$gr_discount' WHERE tin_no= '$tin_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG . " SET admin_discount = '$admin_discount' WHERE tin_no= '$tin_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG . " SET tax = '$tax' WHERE tin_no= '$tin_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG . " SET total = '$total' WHERE tin_no= '$tin_id'") or die(mysqli_error($link));
			//mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG . " SET membership_discount = '$membership_discount' WHERE tin_no= '$tin_id'") or die(mysqli_error($link));
			//mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG . " SET adminDiscountPer = '$adminDiscount' WHERE tin_no= '$tin_id'") or die(mysqli_error($link));
			//mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG . " SET membershipDiscountPer = '$membershipDiscount' WHERE tin_no= '$tin_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG . " SET processing_charge_per = '$processing_charge_per' WHERE tin_no= '$tin_id'") or die(mysqli_error($link));
			mysqli_query($link,"UPDATE " . $EVENT_DB_FORM_REG . " SET processing_charge = '$processing_charge' WHERE tin_no= '$tin_id'") or die(mysqli_error($link));

			$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no= '$tin_id'");
			$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
			$res = $res1 = $qr_gt_user_data_ans_row;
		}
	}*/
	}
}



$total_delegates = $res['sub_delegates'];
$tin_no = $res['tin_no'];



$temp_reg_id = $res['reg_id'];
$tin_id = $res['tin_no'];
$temp_tin_no = $res['tin_no'];
$AmountCurrency = "";
/*
	INR - Indian Rupee
	USD - United States Dollar
	SGD - Singapore Dollar
	GBP - Pound Sterling
	EUR - Euro, official currency of Eurozone
	*/
if ($res['amt_ext'] != "Rs.") {
	$total_amt = $res['total'] * $res['dollar'];
	$AmountCurrency = "USD";
} else {
	$total_amt = $res['total'];
	$AmountCurrency = "INR";
}

$AmountCurrency = "INR";

$lmt = $res['sub_delegates'];

$temp_pg_tranid = $res['pg_tranid'];


if ($res['amt2'] == 'Free') {
	require "emailer_reg_del.php";
} else {
	require "walk_emailer_reg.php";
}



//$temp_order_id_trail = dechex(rand(10, 16)).dechex(rand(10, 16)).dechex(rand(10, 16)).dechex(rand(10, 16)).dechex(rand(10, 16));

$temp_order_id_trail = dechex(rand(11, 16)) . dechex(rand(11, 16));
$temp_order_id_trail = strtoupper($temp_order_id_trail);


//CCAvenue Attributes	


$Merchant_Id = "7700"; //"M_mmactiv_8193" ;//This id(also User Id)  available at "Generate Working Key" of "Settings & Options" 
$Amount = $total_amt; //your script should substitute the amount in the quotes provided here
$CurrencyTrans = $AmountCurrency;
$language = "EN";
/*
	en - English
	hi - Hindi
	gu - Gujarati
	mr - Marathi
	bn - Bengali
	*/
$promo_code = "";
$Order_Id = $tin_no . "_" . $temp_order_id_trail; //your script should substitute the order description in the quotes provided here
$Redirect_Url = $PAYMENT_REDIRECT_LINK_WALK; //your redirect URL where your customer will be redirected after authorisation from CCAvenue

$WorkingKey = "ovjmj56y6lyho9o82ifsx9ehws3i2n1j";
//put in the 32 bit alphanumeric key in the quotes provided here.Please note that get this key ,login to your CCAvenue merchant account and visit the "Generate Working Key" section at the "Settings & Options" page. 
//	$Checksum = getCheckSum($Merchant_Id,$Amount,$Order_Id ,$Redirect_Url,$WorkingKey);
$billing_cust_name = $res['title1'] . " " . $res['fname1'] . " " . $res['lname1'];
$billing_cust_address = $res['addr1'] . " " . $res['addr2'];
$billing_cust_state = $res['state'];
$billing_cust_country = $res['country'];
$billing_cust_tel = $res['cellno1'];
$billing_cust_email = $res['email1'];
$delivery_cust_name = $res['title1'] . " " . $res['fname1'] . " " . $res['lname1'];
$delivery_cust_address = $res['addr1'] . " " . $res['addr2'];
$delivery_cust_state = $res['state'];
$delivery_cust_country = $res['country'];
$delivery_cust_tel = $res['cellno1'];
$delivery_cust_notes = "";
$Merchant_Param = "";
$billing_cust_city = $res['city'];
$billing_zip = $res['pin'];
$delivery_cust_city = $res['city'];
$delivery_cust_pin = $res['pin'];
$merchant_param1 = "";
$merchant_param2 = "";
$merchant_param3 = "";
$merchant_param4 = "";
$merchant_param5 = "";



$temp_lg_st = @$_GET['lg_nm'];

if ($res['pg_tranid'] == "") {

	$temp_pg_tranid = $Order_Id;
} else {

	$temp_pg_tranid = $res['pg_tranid'] . "," . $Order_Id;
}

mysqli_query($link,"update " . $EVENT_DB_FORM_REG_WALK . " set pg_tranid='$temp_pg_tranid' WHERE tin_no= '$tin_id'") or die(mysqli_error($link));


?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $EVENT_NAME; ?></title>
	<link href="<?php echo $EVENT_FORM_LINK; ?>css/pay_style.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-1511695-47']);
		_gaq.push(['_trackPageview']);

		(function () {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();
	</script>
	<script>
		window.onload = function () {
			var d = new Date().getTime();
			document.getElementById("tid").value = d;
		};
		<?php if ($is_price_changed) { ?>
			alert('Please note: Registration rate has been changed to current Registration rates.');
		<?php } ?>
	</script>
</head>

<body>
	<?php //include("includes/header.php");
	/* ?>
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
					
					<tr align="center" valign="bottom">
					  <td height="30"><img src="<?php echo $EVENT_WEBSITE_LINK; ?>web/it_forms/images/dot_line.jpg" width="40" height="16" /><img src="<?php echo $EVENT_WEBSITE_LINK; ?>web/it_forms/images/green_round.png" width="14" height="14" /><img src="<?php echo $EVENT_WEBSITE_LINK; ?>web/it_forms/images/dot_line.jpg" width="40" height="16" /><img src="<?php echo $EVENT_WEBSITE_LINK; ?>web/it_forms/images/green_round.png" width="14" height="14" /><img src="<?php echo $EVENT_WEBSITE_LINK; ?>web/it_forms/images/dot_line.jpg" width="40" height="16" /><img src="<?php echo $EVENT_WEBSITE_LINK; ?>web/it_forms/images/green_round.png" width="14" height="14" /><img src="<?php echo $EVENT_WEBSITE_LINK; ?>web/it_forms/images/dot_line.jpg" width="40" height="16" /><img src="<?php echo $EVENT_WEBSITE_LINK; ?>web/it_forms/images/green_round.png" width="14" height="14" /><img src="<?php echo $EVENT_WEBSITE_LINK; ?>web/it_forms/images/dot_line.jpg" width="40" height="16" /></td>
					</tr>
				  </table><?php */ ?>

	<table width="100%">
		<tr align="left" valign="middle">
			<td>
				<form method="post" action="ccavRequestHandler.php">
					<table width="675" border="0" cellpadding="0" cellspacing="0" class="border_style1"
						style=" margin-top:20px; margin-left:400px;">
						<tr align="left" valign="top">
							<td width="500" height="35">
								<div class="style2" style="margin-left:20px;"><?php echo $EVENT_NAME; ?>: Attendee
									Detail </div>

							</td>
							<td align="left" bgcolor="#F8F7F7"><input type="image" src="Pay-now.png" width="100%"
									border="0" name="submit" alt="Pay Now!" /></td>
						</tr>
						<tr align="left" valign="top">
							<td height="513" colspan="2">





								<input type="hidden" name="tid" id="tid" readonly />
								<input type="hidden" name="merchant_id" value="<?php echo $Merchant_Id; ?>" />
								<input type="hidden" name="order_id" value="<?php echo $Order_Id; ?>" />
								<input type="hidden" name="amount" value="<?php echo $Amount; ?>" />
								<input type="hidden" name="currency" value="<?php echo $CurrencyTrans; ?>" />
								<input type="hidden" name="redirect_url" value="<?php echo $Redirect_Url; //http://localhost/Non_Seamless_kit/ccavResponseHandler.php
								?>" />
								<input type="hidden" name="cancel_url" value="<?php echo $Redirect_Url; //http://localhost/Non_Seamless_kit/ccavResponseHandler.php
								?>" />
								<input type="hidden" name="language" value="<?php echo $language; ?>" />
								<input type="hidden" name="billing_name" value="<?php echo $billing_cust_name; ?>" />
								<input type="hidden" name="billing_address"
									value="<?php echo $billing_cust_address; ?>" />
								<input type="hidden" name="billing_city" value="<?php echo $billing_cust_city; ?>" />
								<input type="hidden" name="billing_state" value="<?php echo $billing_cust_state; ?>" />
								<input type="hidden" name="billing_zip" value="<?php echo $billing_zip; ?>" />
								<input type="hidden" name="billing_country"
									value="<?php echo $billing_cust_country; ?>" />
								<input type="hidden" name="billing_tel" value="<?php echo $billing_cust_tel; ?>" />
								<input type="hidden" name="billing_email" value="<?php echo $billing_cust_email; ?>" />

								<input type="hidden" name="delivery_name" value="<?php echo $delivery_cust_name; ?>" />
								<input type="hidden" name="delivery_address"
									value="<?php echo $delivery_cust_address; ?>" />
								<input type="hidden" name="delivery_city" value="<?php echo $delivery_cust_city; ?>" />
								<input type="hidden" name="delivery_state"
									value="<?php echo $delivery_cust_state; ?>" />
								<input type="hidden" name="delivery_zip" value="<?php echo $delivery_cust_pin; ?>" />
								<input type="hidden" name="delivery_country"
									value="<?php echo $delivery_cust_country; ?>" />
								<input type="hidden" name="delivery_tel" value="<?php echo $delivery_cust_tel; ?>" />
								<input type="hidden" name="merchant_param1" value="<?php echo $merchant_param1; ?>" />
								<input type="hidden" name="merchant_param2" value="<?php echo $merchant_param2; ?>" />
								<input type="hidden" name="merchant_param3" value="<?php echo $merchant_param3; ?>" />
								<input type="hidden" name="merchant_param4" value="<?php echo $merchant_param4; ?>" />
								<input type="hidden" name="merchant_param5" value="<?php echo $merchant_param5; ?>" />
								<input type="hidden" name="promo_code" value="<?php echo $promo_code; ?>" />
								<input type="hidden" name="customer_identifier" value="<?php echo $tin_no; ?>" />




								<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
									class="border_style2">
									<tr>
										<td height="291" align="left" valign="top">
											<table border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td height="16"></td>
												</tr>
												<tr>
													<td height="16"><?php echo $mail_body; ?></td>
												</tr>
												<tr>
													<td height="16"></td>
												</tr>
												<?php
												if (($qr_gt_user_data_ans['paymode'] == "Credit Card") || ($qr_gt_user_data_ans['paymode'] == "Debit Card") || ($qr_gt_user_data_ans['paymode'] == "i Banking")|| ($qr_gt_user_data_ans['paymode'] == "Online") || ($qr_gt_user_data_ans['paymode'] == "Google pay")) {
													?>
													<tr>
														<td height="16">
															<table width="95%" border="1" align="center" cellpadding="0"
																cellspacing="0" bordercolor="#DADADA">
																<?php
																if ($qr_gt_user_data_ans['amt_ext'] != "Rs.") {
																	?>
																	<tr>
																		<td width="95%" height="10" colspan="7" valign="top"
																			class="black_text_no_padding_13px">This Order is in
																			<strong><?php echo $qr_gt_user_data_ans['curr']; ?></strong>
																			Currency.
																		</td>
																	</tr>
																	<tr>
																		<td height="10" colspan="7" valign="top"
																			class="normal_text"></td>
																	</tr>
																	<tr>
																		<td height="10" colspan="7" valign="top"
																			class="black_text_no_padding_13px">For 1 USD (United
																			States Dollar), Amount in Indian Rupees (INR) would
																			be
																			<strong><?php echo $qr_gt_user_data_ans['dollar']; ?></strong>
																			INR (Indian Rupees)
																		</td>
																	</tr>
																	<tr>
																		<td height="10" colspan="7" valign="top"
																			class="black_text_no_padding_13px">The Total Amount
																			of USD
																			<strong><?php echo $qr_gt_user_data_ans['total']; ?></strong>
																			- equivalent to INR
																			<strong><?php echo $total_amt; ?> </strong>only.
																		</td>
																	</tr>
																	<?php
																} else {
																	?>
																	<tr>
																		<td height="10" colspan="7" valign="top"
																			class="black_text_no_padding_13px">This Order is in
																			<strong><?php echo $qr_gt_user_data_ans['curr']; ?></strong>
																			Currency.
																		</td>
																	</tr>
																	<tr>
																		<td height="10" colspan="7" valign="top"
																			class="normal_text"></td>
																	</tr>
																	<tr>
																		<td height="10" colspan="7" valign="top"
																			class="black_text_no_padding_13px">The Total Amount
																			is in INR <strong><?php echo $total_amt; ?></strong>
																			only.</td>
																	</tr>
																	<?php
																}
																?>
																<tr>
																	<td height="10" colspan="7" valign="top"
																		class="normal_text">
																		<table width="100%" border="0" cellspacing="0"
																			cellpadding="0">
																			<tr>
																				<td width="2%"></td>
																				<td width="95%">&nbsp;</td>
																				<td width="3%">&nbsp;</td>
																			</tr>
																			<tr>
																				<td></td>
																				<td><span
																						class="black_text_no_padding_13px">Press
																						&quot;Pay Now&quot; button to
																						proceed.</span></td>
																				<td>&nbsp;</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td height="10" colspan="7" valign="top" class="style1">
																	</td>
																</tr>
																<tr>
																	<td height="10" colspan="7" valign="top" class="style1">
																		<table width="100%" border="0" cellspacing="0"
																			cellpadding="0">
																			<tr>
																				<td width="42%">&nbsp;</td>
																				<td width="16%">&nbsp;</td>
																				<td width="42%">&nbsp;</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												<?php } ?>
												<tr>
													<td width="631" height="16"></td>
												</tr>
												<?php
												if (($qr_gt_user_data_ans['paymode'] == "Credit Card") || ($qr_gt_user_data_ans['paymode'] == "Debit Card") || ($qr_gt_user_data_ans['paymode'] == "i Banking") || ($qr_gt_user_data_ans['paymode'] == "Google pay")) {
													?>
													<tr>
														<td height="10"></td>
													</tr>

													<tr>
														<td height="30" class="blue_text">Thank you for filling all required
															Information.
															We appreciate your patience. <br />
															Press Pay Now button to proceed for payment.</td>
													</tr>

													<tr>
														<td height="10"></td>
													</tr>



													<tr>
														<td height="23">&nbsp;</td>
													</tr>

													<tr>
														<td>
															<table width="596" border="0" align="center" cellpadding="0"
																cellspacing="0">
																<tr>
																	<td width="283" align="left">&nbsp;</td>
																	<td width="313" align="right">
																		<input type="image" src="Pay-now.png" width="55%"
																			border="0" name="submit" alt="Pay Now!" />
																	</td>
																</tr>
															</table>
														</td>
													</tr>

													<tr>
														<td>&nbsp;</td>
													</tr>
												</table>
											</td>
										</tr>
									<?php } ?>

								</table>



							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
	<?php include("footer.php"); ?>
</body>

</html>
<?php

	require("includes/form_constants_both.php");

	$tin_id = @$_POST['tin_id'];

	//$tin_id = "TIN-WL2016-2257071";

	

	if ($tin_id == "") {

		$tin_id = @$_GET ['id'];

		if ($tin_id == "") {

			echo "<script language='javascript'>alert('Error in Process.Please Try After Some Time');</script>";

			echo "<script language='javascript'>window.location = ('$EVENT_PAY_LINK');</script>";

			exit ();

		}

	} 

	

	require "dbcon_open.php";

	require "class.phpmailer.php";

	

	$qr =  mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE tin_no= '$tin_id'")or die(mysqli_error($link));

	$res_num_rows = mysqli_num_rows($qr);

	if( ($res_num_rows <=0) || ($res_num_rows == ""))

	{

		echo "<script language='javascript'>alert('Please enter valid Tin Number or get registered on ".$EVENT_WEBSITE_LINK." ');</script>";

		echo "<script language='javascript'>window.location;</script>";

		exit;

	}

	

	$res = mysqli_fetch_assoc($qr);

	$qr_gt_user_data_ans_row = $qr_gt_user_data_ans = $res;

	

	if($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {

		

		

	}

	$total_delegates = $res['sub_delegates'];

	$tin_no = $res['tin_no'];

	

	$lmt = $res['sub_delegates'];

	

	$temp_reg_id = $res['reg_id'];

	$tin_id=$res['tin_no'];

	$temp_tin_no= $res['tin_no'];

	$AmountCurrency = "";

	/*

	INR - Indian Rupee

	USD - United States Dollar

	SGD - Singapore Dollar

	GBP - Pound Sterling

	EUR - Euro, official currency of Eurozone

	*/

	if($res['amt_ext'] != "Rs.")

	{

		$total_amt = $res['total'] * $res['dollar'];	

		$AmountCurrency = "USD";	

	}

	else

	{

		$total_amt = $res['total'];		

		$AmountCurrency= "INR";

	}	

	//$order_status = 'Success';

	$AmountCurrency= "INR";

	$OrderId=$res['pg_paymentid'];

		$tracking_id=$res['pg_trackid'];

		$bank_ref_no = $res['pg_tranid'];



	if($res['paymode'] == 'Cashfree') {

    $order_status = ucfirst(strtolower($res['pg_status']));

    $payment_mode = $res['pg_ref'];

    $currency = $res['amt_ext'];

  } else {

		$pg_result_arr = explode("#",$res['pg_result']);

		$payment_mode=$pg_result_arr[0];

		$order_status=@$pg_result_arr[5];

		$currency = @$pg_result_arr[4];

	}

	$Amount=$res['pg_amt'];

	

	$lmt = $res['sub_delegates'];

	//echo $order_status;

	require "emailer_pg_response.php";

	if($res['pay_status'] == 'Free' || $res['pay_status'] == 'Complimentary') {

	    if(isset($_GET['s']) && $_GET['s'] == 'tej') {

	        require "emailer_reg_free.php";

	    } else if(isset($_GET['t']) && $_GET['t'] == 'tejp') {

	        require "emailer_reg_free_prem.php";

	    } else if(isset($_GET['t']) && $_GET['t'] == 'tejs') {

	        require "emailer_reg_free_conf.php";

	    } else if(isset($_GET['t']) && $_GET['t'] == 'tejsp') {

	        require "emailer_reg_free_vip.php";

	    }else {

 	      require "emailer_reg_del.php";

	    }

	} else {

		require "emailer_reg.php";

	}

	// Post-process mail_body to ensure time slots are formatted (fallback)
	// This ensures time slots are formatted even if emailer file doesn't format them
	if (!empty($res['time_slot'])) {
		$time_slot = $res['time_slot'];
		$time_slot_decoded_str = html_entity_decode($time_slot, ENT_QUOTES, 'UTF-8');
		$time_slot_decoded = json_decode($time_slot_decoded_str, true);
		
		if (json_last_error() === JSON_ERROR_NONE && is_array($time_slot_decoded)) {
			// Check if raw JSON (or HTML-encoded JSON) appears in mail_body
			$raw_json_encoded = htmlspecialchars($time_slot, ENT_QUOTES, 'UTF-8');
			$raw_json_pattern = preg_quote($raw_json_encoded, '/');
			$raw_json_pattern2 = preg_quote($time_slot, '/');
			
			// Check for both HTML-encoded and raw JSON
			if (preg_match('/' . $raw_json_pattern . '/', $mail_body) || preg_match('/' . $raw_json_pattern2 . '/', $mail_body)) {
				// Format the time slot
				$day_names = array(
					'Day1' => 'Day 1 - Tuesday, 9th December 2025',
					'Day2' => 'Day 2 - Wednesday, 10th December 2025',
					'Day3' => 'Day 3 - Thursday, 11th December 2025',
					'Day4' => 'Day 4 - Friday, 12th December 2025'
				);
				
				$time_slot_display = "<div style='max-height: 300px; overflow-y: auto;'>";
				foreach ($time_slot_decoded as $day => $slots) {
					$day_display = isset($day_names[$day]) ? $day_names[$day] : $day;
					$time_slot_display .= "<div style='margin-bottom: 15px; padding: 8px; background-color: #f9f9f9; border-left: 3px solid #2fa0dd;'>";
					$time_slot_display .= "<strong style='color: #2fa0dd; font-size: 12px; display: block; margin-bottom: 5px;'>" . htmlspecialchars($day_display) . "</strong>";
					$time_slot_display .= "<ul style='margin: 0; padding-left: 20px; list-style-type: disc;'>";
					foreach ($slots as $slot) {
						$time = isset($slot['time']) ? htmlspecialchars($slot['time']) : '';
						$label = isset($slot['label']) ? htmlspecialchars($slot['label']) : '';
						$time_slot_display .= "<li style='margin: 3px 0; line-height: 1.5;'>";
						if ($time) {
							$time_slot_display .= "<span style='color: #666; font-weight: 600;'>" . $time . "</span> - ";
						}
						$time_slot_display .= "<span style='color: #333;'>" . $label . "</span>";
						$time_slot_display .= "</li>";
					}
					$time_slot_display .= "</ul>";
					$time_slot_display .= "</div>";
				}
				$time_slot_display .= "</div>";
				
				// Replace both HTML-encoded and raw JSON with formatted version
				$mail_body = str_replace($raw_json_encoded, $time_slot_display, $mail_body);
				$mail_body = str_replace($time_slot, $time_slot_display, $mail_body);
			}
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $EVENT_NAME; ?></title>

<link href="<?php echo $EVENT_FORM_LINK; ?>css/pay_style.css" rel="stylesheet" type="text/css" />

</head>

<body >

<table width="100%">

<tr align="left" valign="middle">

<td>



<table width="675" border="0" cellpadding="0" cellspacing="0" class="border_style1"  align="center">

  <tr align="left" valign="top">

    <td width="601" height="35">

      <div class="style2" style="margin-left:20px;"><?php echo $EVENT_NAME . ' ' . $EVENT_YEAR; ?>: Registration Detail </div>

      

      </td>

    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>

  </tr>

  <tr align="left" valign="top">

    <td height="513" colspan="2">

	

	

	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">

      <tr>

        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td height="16"></td>

          </tr>

		  <tr>

            <td height="16"><?php echo $mail_body; ?></td>

          </tr>

          <tr>

            <td height="16"></td>

          </tr>

		  <?php if($qr_gt_user_data_ans['pay_status'] == "Not Paid") {

		  if( ($qr_gt_user_data_ans['paymode'] == "Credit Card") || ($qr_gt_user_data_ans['paymode'] == "Google pay") || ($qr_gt_user_data_ans['paymode'] == "i Banking")){

		  ?>

          <tr>

            <td height="16"><table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#DADADA">

              <?php

	if($qr_gt_user_data_ans['amt_ext'] != "Rs.")

	{

	?>

              <tr>

                <td width="95%" height="10" colspan="7" valign="top" class="black_text_no_padding_13px">This Order is in <strong><?php echo $qr_gt_user_data_ans['curr']; ?></strong> Currency. </td>

              </tr>

              <tr>

                <td height="10" colspan="7" valign="top" class="normal_text"></td>

              </tr>

              <tr>

                <td height="10" colspan="7" valign="top" class="black_text_no_padding_13px">For 1 USD (United States Dollar), Amount in Indian Rupees (INR) would be <strong><?php echo $qr_gt_user_data_ans['dollar'];?></strong> INR (Indian Rupees)</td>

              </tr>

              <tr>

                <td height="10" colspan="7" valign="top" class="black_text_no_padding_13px">The Total Amount of USD <strong><?php echo $qr_gt_user_data_ans['total']; ?></strong> - equivalent to INR <strong><?php echo $total_amt; ?> </strong>only.</td>

              </tr>

              <?php

	}

	else

	{

	?>

              <tr>

                <td height="10" colspan="7" valign="top" class="black_text_no_padding_13px">This Order is in <strong><?php echo $qr_gt_user_data_ans['curr']; ?></strong> Currency. </td>

              </tr>

              <tr>

                <td height="10" colspan="7" valign="top" class="normal_text"></td>

              </tr>

              <tr>

                <td height="10" colspan="7" valign="top" class="black_text_no_padding_13px">The Total Amount is in INR <strong><?php echo $total_amt; ?></strong> only.</td>

              </tr>

              <?php

	}

	?>

            </table></td>

          </tr>

          <?php } ?>

		  <tr>

            <td width="631" height="16"></td>

          </tr>

          <?php 

		  if( ($qr_gt_user_data_ans['paymode'] == "Credit Card") || ($qr_gt_user_data_ans['paymode'] == "Debit Card") || ($qr_gt_user_data_ans['paymode'] == "i Banking")){

		  ?> 

          <tr>

            <td height="10"></td>

          </tr>

          

          <tr>

            <td height="30" class="blue_text">Thank you for filling all required Information.

        We appreciate your patience. <br />

         Press Checkout button to proceed for payment.</td>

          </tr>

		  

          <tr>

            <td height="10"></td>

          </tr>

          





          <tr>

            <td height="23" >&nbsp;</td>

          </tr>

          

          <tr>

            <td><table width="596" border="0" align="center" cellpadding="0" cellspacing="0">

              <tr>

                <td width="283" align="left">&nbsp;</td>

                <td width="313" align="right"><input name="Submit" id="Submit" type="submit" class="blue_text"  style="background-color:#dadada;" value="Checkout" width="118" height="28" /></td>

              </tr>

            </table></td>

          </tr>

          

		  <tr>

            <td>&nbsp;</td>

          </tr>

        </table></td>

        </tr>

		 <?php } }?>

		

      </table>

	  

	  

	  </td>

  </tr>

  </table>



</td>

</tr>

</table>

</body>

</html>
<?php
	require("includes/form_constants_both.php");
	$tin_id = @$_POST['tin_id'];
	//$tin_id = "TIN-WL2016-2257071";
	
	if ($tin_id == "") {
		$tin_id = @$_GET ['id'];
		if ($tin_id == "") {
			echo "<script language='javascript'>alert('Error in Process.Please Try After Some Time');</script>";
			echo "<script language='javascript'>window.location = ('$EVENT_PAY_LINK_EX');</script>";
			exit ();
		}
	} 
	
	require "dbcon_open.php";
	require "class.phpmailer.php";
	
	$qr =  mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL." WHERE tin_no= '$tin_id'")or die(mysqli_error($link));
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
	//$total_delegates = $res['sub_delegates'];
	$tin_no = $res['tin_no'];
	
	//$lmt = $res['sub_delegates'];
	
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
	
	$pg_result_arr = explode("#",$res['pg_result']);
	
	$OrderId=$res['pg_paymentid'];
	$tracking_id=$res['pg_trackid'];
	$bank_ref_no = $res['pg_tranid'];
	$payment_mode=$pg_result_arr[0];
	$order_status=@$pg_result_arr[5];
	$currency = @$pg_result_arr[4];
	$Amount=$res['pg_amt'];
	
	//$lmt = $res['sub_delegates'];
	
	require "emailer_pg_response.php";
	require "emailer_exhibitor_payment.php";
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
      <div class="style2" style="margin-left:20px;"><?php echo $EVENT_NAME . ' ' . $EVENT_YEAR; ?>: Exhibitor Registration Form Detail </div>
      
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
		  <?php /*if($qr_gt_user_data_ans['pay_status'] == "Not Paid") {
		  if( ($qr_gt_user_data_ans['paymode'] == "Credit Card") || ($qr_gt_user_data_ans['paymode'] == "Debit Card") || ($qr_gt_user_data_ans['paymode'] == "i Banking")){
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
         Press Pay Now button to proceed for payment.</td>
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
		 <?php } }*/?>
		
      </table>
	  
	  
	  </td>
  </tr>
  </table>

</td>
</tr>
</table>
</body>
</html>
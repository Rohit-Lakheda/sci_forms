<?php
	session_start();
	if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
	    session_destroy();
	    echo "<script language='javascript'>alert('Page is refreshed or verification images mis-matched.');</script>";
	    echo "<script language='javascript'>window.location=('reg_registrations.php');</script>";
	    echo "<script language='javascript'>document.location=('reg_registrations.php');</script>";
	    exit;
	}
	require("includes/form_constants.php");
	require "dbcon_open.php";
	require "class.phpmailer.php";
	
	$reg_id = $_SESSION['vercode_reg'];
	
	$qr_gt_user_data_id     = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_no = 0;
	$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
	if (($qr_gt_user_data_ans_no <= 0) || ($qr_gt_user_data_ans_no == "")) {
	    session_destroy();
	    echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
	    echo "<script language='javascript'>window.location=('reg_registrations.php');</script>";
	    echo "<script language='javascript'>document.location=('reg_registrations.php');</script>";
	    exit;
	}
	
	$temp_lg_st = @$_GET['lg_nm'];
	
	//-------------------------------------------Start Sending InterlinX login Mail---------------------------------
	$qr_gt_user_data_id  = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans = mysqli_fetch_array($qr_gt_user_data_id);
	$res                 = $qr_gt_user_data_ans;
	
	$total_amt = 0;
	
	if ($res['amt_ext'] != "Rs.") {
	    $total_amt = $res['total'] * $res['dollar'];
	} else {
	    $total_amt = $res['total'];
	}
	
	$qr_gt_user_inx_login_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_INTERLINX_REG_TBL . " WHERE tin_no = '$res[tin_no]' ");
	
	//echo "SELECT * FROM ".$EVENT_DB_FORM_INTERLINX_REG_TBL." WHERE tin_no = '$res[tin_no]'";
	//if( ($res['cata'] == "Industry - Full Delegate") ||  ($res['cata'] == "GOVT., R&D & Faculty - Full Delegate") || ($res['cata'] == "International Full Delegate") ){
	/* if ($temp_lg_st != "N02MA34D") {
	    while ($qr_gt_user_inx_login_data_ans = mysqli_fetch_array($qr_gt_user_inx_login_data_id)) {
	        include "reg_inx_emailer.php";
	        $temp_p_email   = $EVENT_ENQUIRY_EMAIL;
	        $temp_p_name    = $EVENT_NAME . " InterlinX";
	        $str_career     = "Thank you for Registration on " . $EVENT_NAME . " " . $EVENT_YEAR . " InterlinX";
	        $str_career_bdy = $mail_interlinx_str;
	        
	        $recipients = array($qr_gt_user_inx_login_data_ans['pri_email'], 'test.interlinks@gmail.com', $EVENT_ENQUIRY_EMAIL, 'interlinx@outlook.com');
	        
	        $headers = 'MIME-Version: 1.0' . "\r\n";
	        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	        $headers .= 'From: ' . $temp_p_email . "\r\n" . 'Reply-To: ' . $temp_p_email . "\r\n" . 'X-Mailer: PHP/' . phpversion();
	        foreach ($recipients as $emailid) {
	            if (mail($emailid, $str_career, $str_career_bdy, $headers)) {
	                //echo "<br />mail successful : 1<br />";
	            } else {
	                //echo "<br />mail failed : 1<br />";
	            }
	        }
	        
	        $mail = new PHPMailer();
	        $mail->IsSMTP(); // telling the class to use SMTP
	        $mail->Host     = "localhost"; // SMTP server 
	        $mail->FromName = $temp_p_name;
	        $mail->From     = $temp_p_email;
	        $mail->Subject  = $str_career;
	        $mail->IsHTML(true);
	        $mail->Body = $str_career_bdy;
	        foreach ($recipients as $emailid) {
	            $mail->AddAddress($emailid);
	            if (!$mail->Send()) {
	                
	            }
	            $mail->clearAddresses();
	        }
	        //echo "<br />".$qr_gt_user_inx_login_data_ans['fname'];
	        //echo $mail_str;
	    }
	} */
	//-------------------------------------------End Sending InterlinX login Mail---------------------------------
	
	//------------------------------------------- start Sending GIM registration Mail---------------------------------
	
	$lmt = $qr_gt_user_data_ans['sub_delegates'];
	switch ($lmt) {
	    case 1	:	$recipients = array($EVENT_ENQUIRY_EMAIL, 'utsav.activ@gmail.com', 'accounts@mmactiv.in', 'test.interlinks@gmail.com', 'bhavya.mmactiv@gmail.com', $res['email1']);
					break;
		case 2	:	$recipients = array($EVENT_ENQUIRY_EMAIL, 'utsav.activ@gmail.com', 'accounts@mmactiv.in', 'test.interlinks@gmail.com', 'bhavya.mmactiv@gmail.com', $res['email1'], $res['email2']);
					break;		
		case 3	:	$recipients = array($EVENT_ENQUIRY_EMAIL, 'utsav.activ@gmail.com', 'accounts@mmactiv.in', 'test.interlinks@gmail.com', 'bhavya.mmactiv@gmail.com', $res['email1'], $res['email2'], $res['email3']);
					break;
		case 4	:	$recipients = array($EVENT_ENQUIRY_EMAIL, 'utsav.activ@gmail.com', 'accounts@mmactiv.in', 'test.interlinks@gmail.com', 'bhavya.mmactiv@gmail.com', $res['email1'], $res['email2'], $res['email3'], $res['email4']);
					break;
		case 5	:	$recipients = array($EVENT_ENQUIRY_EMAIL, 'utsav.activ@gmail.com', 'accounts@mmactiv.in', 'test.interlinks@gmail.com', 'bhavya.mmactiv@gmail.com', $res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5']);
					break;
		case 6	:	$recipients = array($EVENT_ENQUIRY_EMAIL, 'utsav.activ@gmail.com', 'accounts@mmactiv.in', 'test.interlinks@gmail.com', 'bhavya.mmactiv@gmail.com', $res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5'], $res['email6']);
					break;
		case 7	:	$recipients = array($EVENT_ENQUIRY_EMAIL, 'utsav.activ@gmail.com', 'accounts@mmactiv.in', 'test.interlinks@gmail.com', 'bhavya.mmactiv@gmail.com', $res['email1'], $res['email2'], $res['email3'], $res['email4'], $res['email5'], $res['email6'], $res['email7']);
					break;
		default	:	$recipients = array($EVENT_ENQUIRY_EMAIL, 'utsav.activ@gmail.com', 'accounts@mmactiv.in', 'test.interlinks@gmail.com', 'bhavya.mmactiv@gmail.com');
					break;	
	}
	//$recipients = array('test.interlinks@gmail.com', 'sagar.patil@interlinks.in');
	require "emailer_reg.php";
	if ($temp_lg_st != "N02MA34D") {
	    $mail = new PHPMailer();
	    $mail->IsSMTP(); // telling the class to use SMTP
	    $mail->Host     = "localhost"; // SMTP server 
	    $mail->FromName = $EVENT_NAME;
	    $mail->From     = $EVENT_ENQUIRY_EMAIL;
	    $mail->Subject  = "Thanks for Registering on " . $EVENT_NAME;
	    $mail->IsHTML(true);
	    $mail->Body = $mail_body;
	    foreach ($recipients as $emailid) {
	        $mail->AddAddress($emailid);
	        if (!$mail->Send()) {
	            
	        }
	        $mail->clearAddresses();
	    }
	}
	
	/*if ($temp_lg_st != "N02MA34D") {
	    $temp_p_email   = $EVENT_ENQUIRY_EMAIL;
	    $temp_p_name    = $EVENT_NAME;
	    $str_career     = "Thanks for Registering on " . $EVENT_NAME;
	    $str_career_bdy = $mail_body;
	    $headers = 'MIME-Version: 1.0' . "\r\n";
	    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	    $headers .= 'From: ' . $temp_p_email . "\r\n" . 'Reply-To: ' . $temp_p_email . "\r\n" . 'X-Mailer: PHP/' . phpversion();
	    foreach ($recipients as $emailid) {
	        if (mail($emailid, $str_career, $str_career_bdy, $headers)) {
	            //echo "<br />mail successful : 1<br />";
	        } else {
	            //echo "<br />mail failed : 1<br />";
	        }
	    }
	}*/
	
	//------------------------------------------- End Sending GIM registration Mail---------------------------------
	
	//echo $mail_body;
	session_destroy();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register Yourself for an Event <?php echo $EVENT_NAME; ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1511695-47']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script> 


<style type="text/css">
<!--

-->
</style></head>

<body >


<?php include("includes/header.php");?>
<!--
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr align="center" valign="bottom">
    <td height="30"><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/green_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/green_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/green_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/green_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /></td>
  </tr>
</table>
-->
<table width="100%">
<tr align="left" valign="middle">
<td>

<table width="675" border="0" cellpadding="0" cellspacing="0" class="border_style1" style=" margin-top:20px; margin-left:400px;">
  <tr align="left" valign="top">
    <td width="601" height="35">
      <div class="style2" style="margin-left:20px;"><?php echo $EVENT_NAME; ?>: Online Registration Receipt </div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
    <td height="513" colspan="2">
	
	
<?php ?><form  method="post" enctype="multipart/form-data" name="bio_registration_form_7" id="bio_registration_form_7" action="http://www.mmactiv.in/pay/it-2015/reg_pay_1.php" >
	
	
	
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="631" height="16"></td>
          </tr>
          
          <tr>
            <td height="10"></td>
          </tr>
          
          <tr>
            <td height="30"><?php echo $mail_body; ?></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
          


          <tr>
            <td height="23" >&nbsp;</td>
          </tr>
          <?php 
		  if( ($qr_gt_user_data_ans['paymode'] == "Credit Card") || ($qr_gt_user_data_ans['paymode'] == "Debit Card") || ($qr_gt_user_data_ans['paymode'] == "i Banking")){
		  ?>
		  
		  <tr>
		    <td><table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#DADADA">
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
                <td height="10" colspan="7" valign="top" class="black_text_no_padding_13px">The Total Amount will be deducted INR <strong><?php echo $total_amt; ?> </strong> </td>
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
              <tr>
                <td height="10" colspan="7" valign="top" class="normal_text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="2%"></td>
                      <td width="95%">&nbsp;</td>
                      <td width="3%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><span class="black_text_no_padding_13px">Press &quot;Next&quot; button to proceed.</span></td>
                      <td>&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="10" colspan="7" valign="top" class="style1"></td>
              </tr>
              <tr>
                <td height="10" colspan="7" valign="top" class="style1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="42%">&nbsp;</td>
                      <td width="16%">&nbsp;</td>
                      <td width="42%">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
		    </tr>
		  <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="596" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="283" align="left"><input name="tin_id" type="hidden" id="tin_id" value="<?php echo $res['tin_no'];?>" /></td>
                <td width="313" align="right"><input name="Submit" id="Submit" type="submit" class="blue_text"  style="background-color:#dadada;" value="Next&gt;&gt;" width="118" height="28" /></td>
              </tr>
            </table></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <?php 
		  }
		  ?>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        </tr>
      </table>
	  </form>
	  
	  </td>
  </tr>
  </table><?php ?>

</td>
</tr>
</table>
<?php include("includes/footer.php");?>
</body>
</html>
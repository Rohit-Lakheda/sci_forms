<?php
//print_r($res);
$cata = $res['sub_delegates'];
$category = '-';
  /*if(!empty($res['org_reg_type']) && $res['org_reg_type'] == 'Student'){
    $category = 'Limited Access';
  }else{
    $category = 'All Access';
  }*/
/*<strong><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>
                 ".$EVENT_NAME." ".$EVENT_YEAR."</span><br />
                      <span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>".$EVENT_DATE.".</span><br>
".$EVENT_VENUE."<br />
                </strong>*/
$mail_body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>".$EVENT_NAME." ".$EVENT_YEAR."</title>
</head>

<body>
<table width='650' border='0' align='center' cellpadding='0' cellspacing='1' style='font:Verdana, Arial, Helvetica, sans-serif;	font-size: 11px;font-weight: normal; color: #000000;' >
  <tr>
    <td><table width='650' border='0' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>

      <tr>
        <td width='650' colspan='3' style='font-family:Verdana; font-size:10px; color:#333333; line-height:17px;'><table width='100%' border='0' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC'>
          <tr>
            <td height='22' colspan='3' align='center' valign='top' bgcolor='#FFFFFF' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><table width='630' border='0' cellspacing='0' cellpadding='0'>
               <tr>
                <td colspan='4' align='right' valign='middle' style='color: #15a3f9;font-size: 13px;font-weight: bold;'><span>Follow us on </span><a href='" . $FACEBOOK_PAGE . "' target='_blank'><img src='". $EVENT_FORM_LINK . "images/facebook-30circle.png' alt='facebook' /></a> &nbsp;&nbsp;<a href='" . $TWITTER_PAGE . "' target='_blank'><img src='". $EVENT_FORM_LINK . "images/twitter-30circle.png' alt='twitter' /></a></td>
              </tr>
              <tr>
                <td width='4'>&nbsp;</td>
                <td><a href='".$EVENT_WEBSITE_LINK."' target='_blank'><img src='".$EVENT_LOGO_EMAILER."' title='".$EVENT_NAME." ".$EVENT_YEAR."' alt='".$EVENT_NAME." ".$EVENT_YEAR."' border='0' align='middle' /></a></td>
                <td width='13'>&nbsp;</td>
                <td width='298' align='right'>&nbsp;</td>
              </tr>
            </table>
              </td>
          </tr>";
		 if($res['pay_status']=='Not Paid'){
            $mail_body .= "<tr><td colspan='3'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
			<td height='22' colspan='2' valign='top' bgcolor='#FFFFFF' style='color:#1D0D6F;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 16px; padding: 8px; border: 1px solid #dadada;'><strong>&nbsp;&nbsp;Provisional Receipt </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td height='22'  align='right' valign='top' bgcolor='#FFFFFF' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><strong>Date of Registration - <span >".$res['reg_date']."</span> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr></table></td></tr>";
		 } else if($res['pay_status']=='Free'){
            $mail_body .= "<tr><td colspan='3'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
			<td height='22' colspan='2' valign='top' bgcolor='#FFFFFF' style='color:#1D0D6F;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 16px; padding: 8px; border: 1px solid #dadada;'><strong>&nbsp;&nbsp; Delegate Registration Receipt </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td height='22'  align='right' valign='top' bgcolor='#FFFFFF' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><strong>Date of Registration - <span >".$res['reg_date']."</span> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr></table></td></tr>";
				 
		 } else {
		  $mail_body .= "<tr><td colspan='3'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
			<td height='22' colspan='2' valign='top' bgcolor='#FFFFFF' style='color:#1D0D6F;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 16px; padding: 8px; border: 1px solid #dadada;'><strong>&nbsp;&nbsp;Registration Receipt </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td height='22'  align='right' valign='top' bgcolor='#FFFFFF' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><strong>Date of Registration - <span >".$res['reg_date']."</span> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr></table></td></tr>";
		 }
		  
          $mail_body .= "<tr bgcolor='#FFFFFF'>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;<strong>TIN Number</strong> :&nbsp;".$res['tin_no']."</td>
          </tr>";
if(!empty($res['pin_no'])) {
	$mail_body .= "<tr bgcolor='#FFFFFF'>
	            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;<strong>PIN Number</strong> :&nbsp;".$res['pin_no']."</td>
	          </tr>";
}
$mail_body .= "<tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp;Delegate's Company Details :</span></td>
          </tr>
			
		<tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Sector</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['sector']."</td>
          </tr>";
           /*<tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Conference Type</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['conference_type']."</td>
          </tr> ";	
          <tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Category</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$category."</td>
          </tr>  */ 	
         $mail_body = $mail_body." <tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Organization</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['org']."</td>
          </tr>


		   <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Organization Type</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['nationality'].".</td>
          </tr>";

/*
		  <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Nature of Business </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['nature']."</td>
          </tr><tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Address</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['addr1']." ".$res['addr2'].", City - ".$res['city'].", State - ".$res['state'].", Country - ".$res['country'].", Pincode - ".$res['pin'].".</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;GST Number</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['gst_number'].".</td>
          </tr>if(($res['assoc_name'] != 'Faculty' && $res['assoc_name'] != 'Program-Coordinators') && $res['member_of_assoc'] != '') {
		   $mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Are you member of Genotypic Techchnology</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['member_of_assoc'].".</td>
          </tr>";
}*/
if($res['event_know'] != ''){
		   $mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;How do you know about Event</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['event_know'].".</td>
          </tr>";
}
if($res['membership_name'] != ''){
	$mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Membership Name </td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['membership_name']."</td>
		    </tr>";
}

if($res['assoc_name'] != ''){
	$assocName = $res['assoc_name'];
	if(($res['assoc_name'] == 'Faculty' || $res['assoc_name'] == 'Program-Coordinators' || $res['assoc_name'] == 'Student-Coordinator') && $res['member_of_assoc'] != '') { 
		$assocName .= ': ' . $res['member_of_assoc'];
	}

	$mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Association Name </td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$assocName."</td>
		    </tr>";
}

if($res['user_type'] != ''){
	$label = 'Association Name';
	if($res['user_type'] == 'France' ||$res['user_type'] == 'Australia' ||$res['user_type'] == 'Finland' ||$res['user_type'] == 'Denmark' ||$res['user_type'] == 'South Korea' ||$res['user_type'] == 'UK' ||$res['user_type'] == 'Sweden' ||$res['user_type'] == 'Netherlands' ||$res['user_type'] == 'Israel' ||$res['user_type'] == 'European Union' ||$res['user_type'] == 'Lithuania' ||$res['user_type'] == 'Germany' ||$res['user_type'] == 'Switzerland' ||$res['user_type'] == 'Japan' ||$res['user_type'] == 'South America/ Europe/Asia') {
		$label = 'GIA Partner';
	}
	$mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $label . "</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['user_type']."</td>
		    </tr>";
}
	
if($res['membership_code'] != '') {
	$mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Membership Code </td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['membership_code']."</td>
		    </tr>";
}

$mail_body = $mail_body."
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Phone</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['fone']."</td>
		    </tr>";


$mail_body = $mail_body."
          <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;<span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>Delegate's  Registration Details :</span></td>
          </tr>";

if(!empty($res['paymode'])) {
    $mail_body = $mail_body." <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Payment Method </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['paymode']."</td>
          </tr>";
}
                
           $mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Payment Status </span></td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pay_status']."</td>
          </tr>";
          /* <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Delegate Type </span></td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['org_reg_type']."</td>
          </tr> */
    $mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Group Type </span></td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['gr_type']."</td>
          </tr>
		  <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Total Delegates</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span class='content-txt-form'>&nbsp;".$res['sub_delegates']."   </span></td>
          </tr>
     
          <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;</td>
          </tr>";
/*if(!empty($res['user_type'])) {
	$mail_body = $mail_body." <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;<span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>Special Offer :</span></td>
          </tr>
			  <tr bgcolor='#FFFFFF'>
	            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana,Arial,Helvetica,sans-serif; font-weight: bolder; color: rgb(103, 144, 231);' colspan='3'>&nbsp;" . $res['user_type'] . "</td>
	          </tr><tr>
	            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;</td>
	          </tr>";
}*/
if(isset($order_status) && $order_status==="Success"){



	$mail_body = $mail_body."<tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>".$emler_str_pg_resp."</td>
          </tr>

		   <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;</td>
          </tr>";

}

$mail_body = $mail_body."<tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp;Delegate's   Personal Details :</span></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan='3' style='font-family:Verdana; font-size:10px; color:#333333; line-height:17px;'><table width='100%' border='0' align='left' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC'>
          <tr>
            <td height='2' colspan='2' ></td>
          </tr>
          <tr>
            <td width='20%' height='22' align='center' valign='middle' bgcolor='#D7CFA8'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Name</font> </strong></div></td>
            <td width='20%' align='center' valign='middle' bgcolor='#D7CFA8'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Job Title </font></strong></div></td>
            <td width='20%' align='center' valign='middle' bgcolor='#D7CFA8'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Email Id </font></strong></div></td>
            <td width='20%' align='center' valign='middle' bgcolor='#D7CFA8'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Mobile Number</font></strong></div></td>
            <td width='20%' align='center' valign='middle' bgcolor='#D7CFA8'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Delegate Category</font></strong></div></td>
            <td width='20%' align='center' valign='middle' bgcolor='#D7CFA8'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Amount</font></strong></div></td>
          </tr>
          <tr>
            <td height='2' colspan='2' bgcolor=''></td>
          </tr>
          <tr>
            <td height='1' colspan='2' ></td>
          </tr>";

for($i=1; $i<=$res['sub_delegates']; $i++)
{
	$category = implode('<br />&nbsp;', explode('#', $res['cata'.$i]));
	$mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
            <td bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;&nbsp;".$res['title'.$i]." ".$res['fname'.$i]." ".$res['lname'.$i]."</td>
            <td  bgcolor='#F9F8F2' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;&nbsp;".$res['job_title'.$i]."</td>
            <td  bgcolor='#F9F8F2' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;&nbsp;".$res['email'.$i]."</td>
            <td  bgcolor='#F9F8F2' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;&nbsp;".$res['cellno'.$i]."</td>
            <td  bgcolor='#F9F8F2' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;&nbsp;".$res['cata'.$i]."</td>
            ";
	$mail_body = $mail_body."
            <td height='22' bgcolor='#F9F8F2' align='right' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$res['amt'.$i]."&nbsp;&nbsp;</td>";
		
	$mail_body = $mail_body." </tr>";

}
if( ($res['selection_amt'] != "") && ($res['selection_amt'] >0) )
{
$mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
             <td align='right' colspan='5' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Selection Amount (".$res['amt_ext'].")&nbsp;&nbsp;</td>
            <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'>".$res['selection_amt']."&nbsp;&nbsp;</div></td>
          </tr>";
}
if( ($res['admin_discount'] != "") && ($res['admin_discount'] >0) )
{
	 
	$mail_body = $mail_body."
          <tr bgcolor='#FFFFFF'>
              <td align='right' colspan='5' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Admin Discount @ ".$res['adminDiscountPer']."% </td>
            <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$res['admin_discount']."&nbsp;&nbsp;</td>
          </tr>";
}

if( ($res['membership_discount'] != "") && ($res['membership_discount'] >0) )
{
	$mail_body = $mail_body."
          <tr bgcolor='#FFFFFF'>
              <td align='right' colspan='5' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Membership Discount@".$res['membershipDiscountPer']."%</td>
            <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$res['membership_discount']."&nbsp;&nbsp;</td>
          </tr>";

}

if( ($res['gr_discount'] != "") && ($res['gr_discount'] >0) )
{
	$mail_body = $mail_body."
          <tr bgcolor='#FFFFFF'>
              <td align='right' colspan='5' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Group Discount @ 10%&nbsp;&nbsp;&nbsp; </td>
            <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$res['gr_discount']."&nbsp;&nbsp;</td>
          </tr>";
}

if( ($res['tax'] != "") && ($res['tax'] >0) )
{
	$mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
              <td align='right' colspan='5' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'> GST @ " . $SERVICE_TAX . "%&nbsp;&nbsp; </td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'><span >".$res['tax']."</span>&nbsp;&nbsp;</div></td>
          </tr>";
}
if( ($res['processing_charge'] != "") && ($res['processing_charge'] >0) )
{
  $mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
              <td align='right' colspan='5' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Processing Charges : &nbsp;&nbsp; </td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'><span >".$res['amt_ext']." ".$res['processing_charge']."</span>&nbsp;&nbsp;</div></td>
          </tr>";
}
if( ($res['total'] != "") && ($res['total'] >0) )
{
$mail_body = $mail_body." <tr bgcolor='#FFFFFF'>
              <td align='right' colspan='5' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Total (Including Processing Charges)  ".$res['amt_ext']."&nbsp;&nbsp; </td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'>".$res['total']."&nbsp;&nbsp;</div></td>
            </tr>";
}
if(!empty($total_amt)) {
	$mail_body .= " <tr bgcolor='#FFFFFF'>
	              <td align='right' colspan='5' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Total Amount Payable in INR (Including Processing Charges)";
	if($res['amt_ext'] != "Rs."){
		$mail_body = $mail_body."<br/><span style='font-size: 9px; font-family: Verdana, Arial, Helvetica, sans-serif;'></span>";
	}
	$mail_body = $mail_body."&nbsp;&nbsp; </td>
	              	<td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'>".$total_amt."&nbsp;&nbsp;</div></td>
	            </tr>";
}
if(!empty($res['total_amt_received'])) {
	$mail_body .= " <tr bgcolor='#FFFFFF'>
	              <td align='right' colspan='5' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Total  Amount Received&nbsp;&nbsp; </td>
	              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'>".$res['total_amt_received']."&nbsp;&nbsp;</div></td>
	            </tr>
	            ";
}

$mail_body = $mail_body."
        </table></td>
      </tr>
      <tr>
        <td colspan='3' align='left' valign='middle'><table width='100%' border='0' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC'>
          <tr bgcolor='#FFFFFF'>
            <td width='94%'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;	color: #000000;'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                <td width='3%'>&nbsp;</td>
                                <td width='94%'>&nbsp;</td>
                                <td width='3%'>&nbsp;</td>
                              </tr>
                            </table></span></td>
          </tr>
        </table></td>
      </tr>";
/*$mail_body = $mail_body." <tr>
 <td height='23' ><div align='center'>
 <table width='100%' border='0'>
 <tr>
 <td align='center' valign='middle' bgcolor='#39C5DD'><table style='border:thin; border-color:#39C5DD;' cellspacing='0' cellpadding='0' width='100%'>
 <tr>
 <td height='40' bgcolor='#39C5DD' style='color:#FFFFFF;' ><p align='center'><strong>DAY 1 - TUESDAY, 8TH DECEMBER, 2015</strong></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#CAF0F7' ><p align='center'>09:30 am - 10:00 am &nbsp;<strong>|</strong> &nbsp;<strong>Inauguration of Exhibition</strong></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#FFFFFF' ><p align='center'>10:00 am &nbsp;- 11:00    am&nbsp; <strong>|</strong>&nbsp; <strong>Inauguration of Event </strong><em>(Kalinga)</em><strong></strong></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#CAF0F7' ><p align='center'><em>11:00 am - 11:30 am&nbsp; |&nbsp; Tea / Coffee Break</em></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#FFFFFF' ><p align='center'>11:30 am - &nbsp;12:30    pm &nbsp;<strong>|</strong>&nbsp; <strong>Keynote Talks </strong><em>(Kalinga)</em><strong></strong></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#CAF0F7' ><p align='center'><em>12:30 pm - 01:30 pm<strong>&nbsp; </strong></em><strong>|</strong><strong>Leaders&nbsp; Conclave </strong><em>(GBR)<br />
 </em>Panel Discussion on<strong> &quot;Building Innovation and Start-Up Culture through Pro-Active    Policies&quot;</strong></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#FFFFFF' ><p align='center'><em>01:30 pm - 02:30    pm&nbsp; |&nbsp; Lunch</em></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#CAF0F7' ><p align='center'>02:30 pm - 06:00 pm&nbsp; <strong>|</strong>&nbsp; <strong>Building Complete Connected Experience    Through Smart Cities</strong> <br />
 <em>(In    association with NASSCOM)</em><strong></strong></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#FFFFFF' ><p align='center'>06.00 pm onwards&nbsp; <strong>|</strong><strong>&nbsp; IT Export Awards Function </strong><em>(Kalinga)</em><strong> </strong></p></td>
 </tr>
 </table></td>
 </tr>
 </table>
 <br>
 <table width='100%' border='0'>
 <tr>
 <td align='center' valign='middle' bgcolor='#CB403D'><table style='border:thin;  border-color:#CB403D;' cellspacing='0' cellpadding='0' width='100%'>
 <tr>
 <td height='40'  colspan='3' bgcolor='#CB403D' style='color:#FFFFFF;'><p align='center'><strong>DAY 2 - WEDNESDAY, 9TH DECEMBER, 2015</strong></p></td>
 </tr>
 <tr>
 <td height='28'  colspan='2' bgcolor='#F4D8D7'><p align='center'>10.00    am - 11.00 am&nbsp; <strong>|</strong>&nbsp; <em>GBR</em><br />
 <strong>Skill Development - KeynoteTalks</strong></p></td>
 <td height='28'  rowspan='8' bgcolor='#F4D8D7' style='outline: thin solid #CB403D;'><p align='center'>10.00    am onwards<br />
 <em>Lalit 1&amp;2</em></p>
 <p align='center'><strong>Code for Karnataka </strong><br />
 <strong>Mobile 10X Appathon</strong><strong> </strong><br />
 <em>(Closed Door)</em></p>
 <p align='center'><em>(In association with</em><br />
 <em>IAMIAI)</em> </p></td>
 </tr>
 <tr>
 <td height='28'  colspan='2' bgcolor='#FFFFFF' style='outline: thin solid #CB403D;'><p align='center'>11.00    am - 11.45 am&nbsp; <strong>|</strong>&nbsp; <em>Lalit 3&amp;4</em><br />
 <strong>Skill Conclave</strong><em> (In    association with ICTSDS)</em></p></td>
 </tr>
 <tr>
 <td height='28'  colspan='2' bgcolor='#F4D8D7'><p align='center'><em>11:45 am - 12:00    noon&nbsp; </em><em>|</em><em>&nbsp; Tea / Coffee Break</em></p></td>
 </tr>
 <tr >
 <td height='28' bgcolor='#FFFFFF' style='outline: thin solid #CB403D;'><p align='center'>12.00    noon - 01.30 pm&nbsp; <strong>|</strong>&nbsp; <em>GBR</em><br />
 <strong>IoT for Everyone <br />
 </strong><em>&nbsp;(In association with NASSCOM) </em><strong> </strong></p></td>
 <td height='28' bgcolor='#FFFFFF' style='outline: thin solid #CB403D;'  ><p align='center'>12.00    noon - 01.30 pm&nbsp; <strong>|</strong>&nbsp; <em>Lalit 3&amp;4</em> <br />
 <strong>Sessions on Incubation<br />
 </strong>Keynote and Panel Discussion<br />
 <em>(In association with ISBA    &amp; STPI)<strong></strong></em></p></td>
 </tr>
 <tr>
 <td height='28'  colspan='2' bgcolor='#F4D8D7'><p align='center'><em>01:30 pm - 02:30    pm&nbsp; </em><em>|</em><em>&nbsp; Visit to Expo &amp; Lunch</em></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#FFFFFF' style='outline: thin solid #CB403D;'><p align='center'>2:30 pm - 4.15 pm&nbsp; <strong>|</strong>&nbsp; <em>GBR</em><br />
 <strong>Session on GIS</strong></p></td>
 <td height='28'  rowspan='3' bgcolor='#F4D8D7' style='outline: thin solid #CB403D;'><p align='center'>2:30    pm onwards&nbsp; <strong>|</strong>&nbsp; <em>Lalit 3&amp;4</em> <br />
 <strong>YESSS Program</strong><br />
 <strong>Opening Talk by Infosys</strong><br />
 <strong>Pitch Presentations</strong></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#F4D8D7' ><p align='center'><em>04.15 pm - 04.30    pm&nbsp; </em><strong>|</strong><em> &nbsp;Tea / Coffee Break</em></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#FFFFFF' style='outline: thin solid #CB403D;'><p align='center'>04.30 pm - 6.00 pm&nbsp; <strong>|</strong>&nbsp; <em>GBR</em><br />
 <strong>Making India a Manufacturing Hub in the ESDM    Space </strong><em>(In association with IESA)</em></p></td>
 </tr>
 </table></td>
 </tr>
 </table>
 <br />
 <table width='100%' border='0'>
 <tr>
 <td align='center' valign='middle' bgcolor='#48A631'><table style='border:thin; border-color:#4FB735;' cellspacing='0' cellpadding='0' width='100%'>
 <tr>
 <td  height='40' colspan='2' bgcolor='#48A631' style='color:#FFFFFF;'><p align='center'><strong>DAY 3 - THURSDAY, 10TH DECEMBER,    2015</strong></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#D6F1CF' ><p align='center'>10.00 am - 11.30 am&nbsp; <strong>|</strong>&nbsp; <em>Lalit 3&amp;4</em><br />
 <strong>Emerging Trends in Animation Gaming Visual Effects and New Media</strong> </p></td>
 <td height='28'  rowspan='3' bgcolor='#D6F1CF' style='outline: thin solid #48A631;'><p align='center'>10.00    am - 1.30 pm&nbsp; | &nbsp;<em>GBR</em><br />
 <strong>Ease of doing Business <br />
 </strong><em>by MAIT</em><strong> </strong></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#FFFFFF'  style='outline: thin solid #48A631;'><p align='center'><em>11:30 am - 12:00    noon&nbsp; |&nbsp; Tea / Coffee Break</em></p></td>
 </tr>
 <tr>
 <td height='28' bgcolor='#D6F1CF' ><p align='center'>12.00 noon - 1.30 pm&nbsp; <strong>|</strong>&nbsp; <em>Lalit 3&amp;4</em><br />
 <strong>Grand Finale of </strong><strong>#APP    Hackathon </strong><em>(In association with IAMAI)</em> </p></td>
 </tr>
 <tr>
 <td height='28'  colspan='2' bgcolor='#FFFFFF' style='outline: thin solid #48A631;'><p align='center'><em>01:30 pm - 02:30    pm<strong>&nbsp; </strong>|&nbsp; Visit to Expo &amp; Lunch</em></p></td>
 </tr>
 <tr>
 <td height='28'  colspan='2' bgcolor='#D6F1CF'><p align='center'>2.30 pm - 5.00 pm&nbsp; <strong>|</strong>&nbsp; <strong>INK Talks</strong><em> (Kalinga)</em></p></td>
 </tr>
 </table></td>
 </tr>
 </table>
 <br />
 </div></td>
 </tr>";*/
$mail_body = $mail_body."<tr>
            <td height='10' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;</td>
          </tr>
      <tr>
        <td colspan='3' style='font-family:Verdana; font-size:10px; color:#333333; line-height:17px;'><table width='100%' border='0' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC'>


          <tr bgcolor='#FFFFFF'>
            <td  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>";
	

if( ($res['paymode'] == 'Complimentary') || ($res['pay_status'] == 'Complimentary')){
	$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                <td width='3%'>&nbsp;</td>
                                <td width='94%'class='content-txt-form'><strong>Note :Please bring registration receipt during event.</strong></td>
                                <td width='3%'>&nbsp;</td>
                              </tr>
                            </table>";
}
if($res['pay_status']=='Not Paid'){
	if( ($res['paymode'] == 'Credit Card') || ($res['paymode'] == 'Google pay') || ($res['paymode'] == 'i Banking')){
		$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                <td width='3%'>&nbsp;</td>
                                <td width='94%'class='content-txt-form'><strong>Note :</strong>Click on 'Checkout' Below to pay instantly or<br />
                                  <a href='".$EVENT_OL_PAY_ACT_LINK."?id=".$res['tin_no']."' target='_blank'>Click here</a> to activate your online payment process or<br />
                                  use below mentioned link<br />
         <a href='".$EVENT_PAY_LINK."' target='_blank'>".$EVENT_PAY_LINK."</a></td>
                                <td width='3%'>&nbsp;</td>
                              </tr>
                            </table>";
	}
	
	if($res['paymode'] == 'Paypal'){
		/*$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
		<tr>
		<td width='3%'>&nbsp;</td>
		<td width='94%'class='content-txt-form' bgcolor=''><strong>Note :
		<p>
		<strong>a. We would like to clarify that you don't need PayPal account to make the payment by credit card / debit card. On \"PayPal Page\" Please Click on \"Pay With Debit Or Credit Card\", using this option you will be able to pay without having PayPal account. <a href='https://www.bengalurutechsummit.com/web/it_forms/images/paypal.png' target='_blank'>Click Here</a> for visual. </strong><br><br>
	
		<strong>b. While making the payment using PayPal, Please complete following process. </strong><br/>
		<span style='margin-left: 15px;'>1. Register yourself on PayPal</span><br/>
		<span style='margin-left: 25px;'><a href='https://www.paypal.com/signin' target='_blank'>Click Here</a> to Register yourself on PayPal </span><br/>
		<span style='margin-left: 15px;'>2. Verify / Confirm your Email id with PayPal</span><br/>
		<span style='margin-left: 25px;'><a href='https://www.paypal.com/us/selfhelp/article/how-do-i-confirm-my-email-address-faq1485' target='_blank'>Click Here</a> to Verify / Confirm your Email id</span><br/>
		<span style='margin-left: 15px;font-size: 28px;'>3. <a href='$CANCEL_URL?id=".$res['tin_no']."' target='_blank'><strong>Click here</strong></a> to <a href='$CANCEL_URL?id=".$res['tin_no']."' target='_blank'><img src='https://www.bengalurutechsummit.com/web/paypal/PayPal-PayNow-Button.png' alt='Paynow' width='25%'/></a></span><br/>
				</p></td>
                                <td width='3%'>&nbsp;</td>
                              </tr>
                            </table>";*/
		$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
		<tr>
		<td width='3%'>&nbsp;</td>
		<td width='94%'class='content-txt-form' bgcolor='#ff0'><strong>Note :</strong>Click on 'Pay Now' button below to pay instantly or<br />
		<a href='$CANCEL_URL?id=".$res['tin_no']."' target='_blank'>Click here</a> to activate your online payment process</td>
			                                <td width='3%'>&nbsp;</td>
			                              </tr>
			                            </table>";
	}
	
	if(($res['paymode'] == "Cheque")||($res['paymode'] == "Cheque/DD"))
	{
		if($res['sector'] == "Bio Technology") {
			 $addr = '#9, UNI Building,3rd Floor, <br> Thimmaiah Road, Millers Tank Bund, <br>Vasanthnagar, Bengaluru - 560 052, India<br>Tel:  +91.80.4113 1912/3<br>Website: <a href="http://www.bengaluruindiabio.in" target="_blank">www.bengaluruindiabio.in</a>';
			$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
			  <tr>
				<td width='3%'>&nbsp;</td>
				<td width='94%'class='content-txt-form'><strong>Note :</strong><span style='font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;'>
					Please send your Cheque/DD in favour of BANGALORE INDIA BIO payable at " . $EVENT_CHEQUE_PAYBLE_AT . ".<br />
					Along with the copy of your registration receipt and send to<br />
					<strong>Address :</strong><br/>" . $EVENT_CHEQUE_PAYBLE_ADDRESS . "</span></td>
				<td width='3%'>&nbsp;</td>
			  </tr>
			</table>";
		} else {
			$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
			  <tr>
				<td width='3%'>&nbsp;</td>
				<td width='94%'class='content-txt-form'><strong>Note :</strong><span style='font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;'>
					Please send your Cheque/DD in favour of " . $EVENT_CHEQUE_PAYBLE_AT_NAME . " payable at " . $EVENT_CHEQUE_PAYBLE_AT . ".<br />
					Along with the copy of your registration receipt and send to<br />
					<strong>Address :</strong><br/>" . $EVENT_CHEQUE_PAYBLE_ADDRESS . "</span></td>
				<td width='3%'>&nbsp;</td>
			  </tr>
			</table>";
		}
	}

	if(($res['paymode'] == "Bank Transfer"))
	{
		$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
						          <tr>
						            <td width='3%'>&nbsp;</td>
                                          <td width='94%'>&nbsp;</td>
                                          <td width='3%'>&nbsp;</td>
                                        </tr>";
		if($res['nationality'] == 'Indian Organization') {
			$mail_body .= "<tr>
					<td>&nbsp;</td>
						  <td align='left' valign='top'  style='font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;'><p><strong>Bank Transfer</strong> the registration fees to the following account</p>
							<p><br>
							  <strong>Particulars  of Bank Account :</strong><br>
							  <br>
							  <strong>Name  of the Bank &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;Canara Bank<br>
							  <strong>Name of the Branch &nbsp;&nbsp;&nbsp;:&nbsp;</strong>K.S.F.C Complex Branch,(DP Code No.: 2827)<br>
							  <strong>Account Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>MM ACTIV SCI TECH COMMUNICATIONS PVT. LTD. <br>
							  <strong>Branch Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA<br>
							  <strong>Account No. (As appearing on the cheque book)&nbsp;&nbsp; : </strong>2827201001176<br>
							  <strong>Phone No. : &nbsp;&nbsp;&nbsp;&nbsp;</strong>+91-80-22371789<br />
							  <strong>IFSC Code : &nbsp;&nbsp;&nbsp;&nbsp;</strong>CNRB0002827<br />
							  <strong>MICR CODE : &nbsp;&nbsp;&nbsp;&nbsp;</strong>560015137<br />
								<span style='color: red;'>Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href='mailto:ramakrishna.mokkapati@mmactiv.com'>ramakrishna.mokkapati@mmactiv.com</a>/<a href='mailto:srisha.accounts@mmactiv.com'>srisha.accounts@mmactiv.com</a></span></p>
							</td>
						  <td>&nbsp;</td>
					</tr>";
			/*if($res['sector'] == "Bio Technology") {
				$mail_body .= "<tr>
					<td>&nbsp;</td>
						  <td align='left' valign='top'  style='font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;'><p><strong>Bank Transfer</strong> the registration fees to the following account</p>
							<p><br>
							  <strong>Particulars  of Bank Account :</strong><br>
							  <br>
							  <strong>Name  of the Bank &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;Canara Bank<br>
							  <strong>Name of the Branch &nbsp;&nbsp;&nbsp;:&nbsp;</strong>K.S.F.C Complex Branch,(DP Code No.: 2827)<br>
							  <strong>Account Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>Bengaluru INDIA BIO <br>
							  <strong>Branch Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA<br>
							  <strong>Account No. (As appearing on the cheque book)&nbsp;&nbsp; : </strong>2827 201 001175<br>
							  <strong>Bank email : &nbsp;&nbsp;&nbsp;&nbsp;</strong> cb2827@canbank.com<br>
							  <strong>Phone No. : &nbsp;&nbsp;&nbsp;&nbsp;</strong>+91 80 2237 1789<br />
							  <strong>IFSC Code : &nbsp;&nbsp;&nbsp;&nbsp;</strong>CNRB0002827<br />
							  <strong>MICR CODE : &nbsp;&nbsp;&nbsp;&nbsp;</strong>560015137<br />
								<span style='color: red;'>Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href='mailto:ramakrishna.mokkapati@mmactiv.com'>ramakrishna.mokkapati@mmactiv.com</a>/<a href='mailto:adarsh.accounts@mmactiv.com'>adarsh.accounts@mmactiv.com</a></span></p>
							</td>
						  <td>&nbsp;</td>
					</tr>";
			} else {
				$mail_body .= "<tr>
					<td>&nbsp;</td>
						  <td align='left' valign='top'  style='font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;'><p><strong>Bank Transfer</strong> the registration fees to the following account</p>
							<p><br>
							  <strong>Particulars  of Bank Account :</strong><br>
							  <br>
							  <strong>Name  of the Bank &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;Canara Bank<br>
							  <strong>Name of the Branch &nbsp;&nbsp;&nbsp;:&nbsp;</strong>K.S.F.C Complex Branch,(DP Code No.: 2827)<br>
							  <strong>Account Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>BANGALORE IT.BIZ<br>
							  <strong>Branch Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA<br>
							  <strong>Account No. (As appearing on the cheque book)&nbsp;&nbsp; : </strong>2827201001190<br>
							  <strong>Bank email : &nbsp;&nbsp;&nbsp;&nbsp;</strong> cb2827@canbank.com<br>
							  <strong>Phone No. : &nbsp;&nbsp;&nbsp;&nbsp;</strong>+91 80 2237 1789<br />
							  <strong>IFSC Code : &nbsp;&nbsp;&nbsp;&nbsp;</strong>CNRB0002827<br />
							  <strong>MICR CODE : &nbsp;&nbsp;&nbsp;&nbsp;</strong>560015137<br />
								<span style='color: red;'>Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href='mailto:ramakrishna.mokkapati@mmactiv.com'>ramakrishna.mokkapati@mmactiv.com</a>/<a href='mailto:adarsh.accounts@mmactiv.com'>adarsh.accounts@mmactiv.com</a></span></p>
							</td>
						  <td>&nbsp;</td>
					</tr>";
			}*/
		} else {
			$mail_body .= "<tr>
						            <td>&nbsp;</td>
                                          <td align='left' valign='top'  style='font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;'><p><strong>Bank Transfer</strong> the registration fees to the following account</p>
                                            <p><br>
                                              <strong>Particulars  of Bank Account :</strong><br>
                                              <br>
                                              <strong>Account Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;MM ACTIV SCI-TECH COMMUNICATIONS PVT.LTD.<br>
                                              <strong>Account Number &nbsp;&nbsp;&nbsp;:&nbsp;</strong>2827241000004<br>
												<strong>Name  of the Bank &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;Canara Bank<br>
                                              <strong>Branch &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>K.S.F.C Complex Branch,(DP Code No.: 2827)<br>
											<strong>Branch Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA<br>
                                              <strong>MICR CODE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong>560015137<br>
                                              <strong>Bank SWIFT Code No.&nbsp;&nbsp;&nbsp;&nbsp; : </strong>CNRBINBBLFD<br>
											<strong>IFSC Code : </strong>CNRB0002827<br>
						          			  <strong>Phone No. : &nbsp;&nbsp;&nbsp;&nbsp;</strong>+91-80-22371789<br />
												<span style='color: red;'>Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href='mailto:ramakrishna.mokkapati@mmactiv.com'>ramakrishna.mokkapati@mmactiv.com</a>/<a href='mailto:srisha.accounts@mmactiv.com'>srisha.accounts@mmactiv.com</a></span>
                                              </p></td>
                                          <td>&nbsp;</td>
                                  	</tr>";
		}
		$mail_body .= "<tr>
										<td height='2' bgcolor='#DADADA'></td>
										<td bgcolor='#DADADA'></td>
										<td bgcolor='#DADADA'></td>
									</tr>
									<tr>
						            	  <td>&nbsp;</td>
                                          <td align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;'>&nbsp;</td>
                                          <td>&nbsp;</td>
                                  	</tr>
						          </table>";
	}
}
/*if($res['sector'] == "Bio Technology") {
	$MMACTIV_ADDR = '#9, UNI Building,3rd Floor,<br>Thimmaiah Road, Millers Tank Bund,<br>Vasanthnagar, Bengaluru - 560 052, India<br>Tel: +91.80.4113 1912/3 | Website: <a href="http://www.bengaluruindiabio.in" target="_blank">www.bengaluruindiabio.in</a>';
}*/
if($res['pay_status']=='Not Paid'){
			$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='3%'>&nbsp;</td>
            <td width='94%'class='content-txt-form' style='color: #f00;'><strong>Important*:&nbsp;</strong><span style='font-family:Arial, Helvetica, sans-serif;font-size:15px;text-decoration:none;'>
				After Payment Realization Final Payment Acknowledgement Receipt will be Provided</td>
            <td width='3%'>&nbsp;</td>
          </tr>
         </table>";
		} else {
			
/*$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='3%'>&nbsp;</td>
            <td width='94%'class='content-txt-form' style='color: #f00;'><strong>Important*:&nbsp;</strong><span style='font-family:Arial, Helvetica, sans-serif;font-size:15px;text-decoration:none;'>
				Please carry a printout of this 'Payment Acknowledgement Receipt'  to the registration counter to enable us to print your delegate badge.</td>
            <td width='3%'>&nbsp;</td>
          </tr>
         </table>";*/

		}
		 $mail_body = $mail_body."</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='4%' height='2'></td>
                <td width='34%' bgcolor='#D0CAB0'></td>
                <td width='59%' bgcolor='#D0CAB0'></td>
                <td width='3%'></td>
              </tr>
              <tr>
                <td height='10' colspan='4' align='center' valign='middle'></td>
              </tr>
              <tr>
                <td colspan='2' align='center' valign='middle'><img src='".$MMACTIV_LOGO."' width='200' height='60' /></td>
                <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                    <tr>
                      <td style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>Office : ".$ORGANISATION_NAME."</td>
                    </tr>
                    <tr>
                      <td style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>Address :  ".$MMACTIV_ADDR."</td>
                    </tr>
                    <tr>
                      <td style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>Karanataka GST No.: ".$MMACTIV_SERVICE_TAX_NO."</td>
                    </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>

              <tr>
                <td colspan='2' align='center' valign='middle'>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
  <td></td>
  </tr>

        </table></td>
      </tr>

    </table></td>
  </tr>
</table>
</body>
</html>";

?>
<?php
if($res['amt_ext'] != "Rs.") {
	$total_amt = $res['total'] * $res['dollar'];
} else {
	$total_amt = $res['total'];
}
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
			<td height='22' colspan='2' valign='top' bgcolor='#FFFFFF' style='color:#1D0D6F;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 19px; padding: 8px; border: 1px solid #dadada;'><strong>&nbsp;&nbsp;Provisional Receipt </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td height='22'  align='right' valign='top' bgcolor='#FFFFFF' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><strong>Date of Registration - <span >".$res['reg_date']."</span> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr></table></td></tr>";
		 } else {
		  $mail_body .= "<tr><td colspan='3'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
			<td height='22' colspan='2' valign='top' bgcolor='#FFFFFF' style='color:#1D0D6F;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 19px; padding: 8px; border: 1px solid #dadada;'><strong>&nbsp;&nbsp;Payment Acknowledgement Receipt </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
$mail_body .= "
		<tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Sector</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['sector']."</td>
          </tr>
           <tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Nationality</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['curr']."</td>
          </tr> 	
          <tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Title of Paper</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['poster_title']."</td>
          </tr>
          <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp;Details Of Lead Person :</span></td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['lead_name']."</td>
          </tr>
		  <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Organisation </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['lead_org']."</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Email Id</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['lead_email']."</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Phone Number</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['lead_ccode'] . '-' . $res['lead_acode'] . '-' . $res['lead_phone']."</td>
          </tr>
		   <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Mobile Number</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['lead_mob']."</td>
          </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Address </td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['lead_addr']."</td>
		    </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;City</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['lead_city']."</td>
		    </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;State</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['lead_state']."</td>
		    </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Country</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['lead_country']."</td>
		    </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Postal Code</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['lead_zip']."</td>
		    </tr>
		    		
		  
          <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp;Details Of Poster Presenter :</span></td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pp_name']."</td>
          </tr>
		  <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Organisation </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pp_org']."</td>
          </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Website</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pp_website']."</td>
		    </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Email Id</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pp_email']."</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Phone Number</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pp_ccode'] . '-' . $res['pp_acode'] . '-' . $res['pp_phone']."</td>
          </tr>
		   <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Mobile Number</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pp_mob']."</td>
          </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Address </td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pp_addr']."</td>
		    </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;City</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pp_city']."</td>
		    </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;State</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pp_state']."</td>
		    </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Country</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pp_country']."</td>
		    </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Postal Code</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pp_zip']."</td>
		    </tr>
		  <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp;Details Of Co Author(s) :</span></td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name of Co-Author 1</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['co_author_1']."</td>
          </tr>
		  <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name of Co-Author 2 </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['co_author_2']."</td>
          </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name of Co-Author 3</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['co_author_3']."</td>
		    </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name of Co-Author 4</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['co_author_4']."</td>
          </tr>
          <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp;Details of Accompanying Co-Author(s) to the Event :</span></td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name of Co-Author 1</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['accop_co_author_1']."</td>
          </tr>
		  <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name of Co-Author 2 </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['accop_co_author_2']."</td>
          </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name of Co-Author 3</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['accop_co_author_3']."</td>
		    </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name of Co-Author 4</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['accop_co_author_4']."</td>
          </tr>		
            		
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Theme</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['poster_catagory']."</td>
		    </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Abstract of Poster</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><a href='".$res['poster_abstract']."' target='_blank'> Click here to download file </a></td>
		    </tr>
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;CV of lead Author</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><a href='".$res['lead_cv']."' target='_blank'> Click here to download file </a></td>
		    </tr>";
$mail_body = $mail_body."
          <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;<span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>Payment Detail :</span></td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Payment Method </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['paymode']."</td>
          </tr>
           <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Payment Status</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['pay_status']."</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Selection Amount </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['amt_ext']. ' ' . $res['selection_amt']."</td>
          </tr>";

		if( ($res['tax'] != "") && ($res['tax'] >0) ) {
          $mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;GST @ " . $SERVICE_TAX . "% </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['amt_ext']. ' ' . $res['tax']."</td>
          </tr>";
		}
		if( ($res['processing_charge'] != "") && ($res['processing_charge'] >0) ) {
          $mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Processing Charges </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['amt_ext']." ".$res['processing_charge']."</td>
          </tr>";
		}
         $mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Total (Including Processing Charges)</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['amt_ext']. ' ' . $res['total']."</td>
          </tr>";
         
         if(!empty($total_amt)) {
         	$mail_body .= "<tr bgcolor='#FFFFFF'>
	         	<td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Total Amount Payable in INR (Including Processing Charges)</td>
	         	<td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
	         	<td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$total_amt."</td>
	         </tr>";
         }
         if(!empty($res['total_amt_received'])) {
         	$mail_body = $mail_body."<tr bgcolor='#FFFFFF'>
	            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Total  Amount Received</td>
	            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
	            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['total_amt_received']."</td>
	          </tr>";
         }
         $mail_body = $mail_body." <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;</td>
          </tr>";

if($res['pay_status']=="Paid"){
	$mail_body = $mail_body."<tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>".$emler_str_pg_resp."</td>
          </tr>

		   <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;</td>
          </tr>";
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
                                <td width='94%'class='content-txt-form'><strong>Note: Please bring registration receipt during event.</strong></td>
                                <td width='3%'>&nbsp;</td>
                              </tr>
                            </table>";
}
if($res['pay_status']=='Not Paid'){
	if( ($res['paymode'] == 'Credit Card') || ($res['paymode'] == 'Debit Card') || ($res['paymode'] == 'i Banking')){
		$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                <td width='3%'>&nbsp;</td>
                                <td width='94%'class='content-txt-form'><strong>Note: </strong>Click on 'Pay Now' button below to pay instantly or<br />
                                  <a href='".$EVENT_OL_PAY_ACT_LINK_POSTER."?id=".$res['tin_no']."' target='_blank'>Click here</a> to activate your online payment process<br />";
                                  /*use below mentioned link<br />
         						  <a href='".$EVENT_OL_PAY_ACT_LINK_POSTER."?id=".$res['tin_no']."' target='_blank'>".$EVENT_OL_PAY_ACT_LINK_POSTER."?id=".$res['tin_no']."</a>*/
         						$mail_body .= "</td>
                                <td width='3%'>&nbsp;</td>
                              </tr>
                            </table>";
	}
  if( ($res['paymode'] == 'Cashfree')){
    $mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                <td width='3%'>&nbsp;</td>
                                <td width='94%'class='content-txt-form'><strong>Note: </strong>Click on 'Pay Now' button below to pay instantly or<br />
                                  <a href='".$CF_EVENT_OL_PAY_ACT_LINK_poster."?id=".$res['tin_no']."' target='_blank'>Click here</a> to activate your online payment process<br />";
                                  /*use below mentioned link<br />
                      <a href='".$EVENT_OL_PAY_ACT_LINK_POSTER."?id=".$res['tin_no']."' target='_blank'>".$EVENT_OL_PAY_ACT_LINK_POSTER."?id=".$res['tin_no']."</a>*/
                    $mail_body .= "</td>
                                <td width='3%'>&nbsp;</td>
                              </tr>
                            </table>";
  }
  
	
	if($res['paymode'] == 'Paypal'){
		$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
		<tr>
		<td width='3%'>&nbsp;</td>
		<td width='94%'class='content-txt-form' bgcolor='#ff0'><strong>Note: </strong>Click on 'Pay Now' button below to pay instantly or<br />
		<a href='$CANCEL_URL_POSTER?id=".$res['tin_no']."' target='_blank'>Click here</a> to activate your online payment process</td>
			                                <td width='3%'>&nbsp;</td>
			                              </tr>
			                            </table>";
	}
	
	if(($res['paymode'] == "Bank Transfer")) {
		$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
						          <tr>
						            <td width='3%'>&nbsp;</td>
                                          <td width='94%'>&nbsp;</td>
                                          <td width='3%'>&nbsp;</td>
                                        </tr>";
		if($res['curr'] == 'Indian') {
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
			
$mail_body = $mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='3%'>&nbsp;</td>
            <td width='94%'class='content-txt-form' style='color: #f00;'><strong>Important*:&nbsp;</strong><span style='font-family:Arial, Helvetica, sans-serif;font-size:15px;text-decoration:none;'>
				Please carry a printout of this 'Payment Acknowledgement Receipt'  to the registration counter to enable us to print your delegate badge.</td>
            <td width='3%'>&nbsp;</td>
          </tr>
         </table>";

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
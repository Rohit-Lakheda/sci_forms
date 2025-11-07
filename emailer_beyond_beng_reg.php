<?php
//print_r($res);
/*<strong><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>
                 ".$EVENT_NAME." ".$EVENT_YEAR."</span><br />
                      <span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>".$EVENT_DATE.".</span><br>
".$EVENT_VENUE."<br />
                </strong>*/


if(!isset($form_title)) {
	$speker_detail = 'Speaker Details';
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
                <td width='560'><a href='".$EVENT_WEBSITE_LINK."' target='_blank'><img src='".$EVENT_LOGO_URL."' title='".$EVENT_NAME." ".$EVENT_YEAR."' alt='".$EVENT_NAME." ".$EVENT_YEAR."' border='0' align='middle' width='100%'/></a></td>
                <td width='13'>&nbsp;</td>
                <td width='298' align='right'>&nbsp;</td>
              </tr>
            </table>
              </td>
          </tr>
     
          <tr>
            <td height='22' colspan='3' align='right' valign='top' bgcolor='#FFFFFF' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><strong>Date of Registration - <span >".date('Y-m-d', strtotime($res['created_at']))."</span> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>";
$mail_body .= "<tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp; Beyond Bengaluru - Delegate Registration detail:</span></td>
          </tr>
			
		<tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Sector</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['sector']."</td>
          </tr>
         
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['title'] . ' ' . $res['fname'] . ' ' . $res['lname'] . "</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Email</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['email']."</td>
          </tr>
           <tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Mobile Number</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['mob_cntry_code'].'-'.$res['mob']."</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Organisation Name</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['org']."</td>
          </tr>
		   <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Designation</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['desig']."</td>
          </tr>
          
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;City</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['city']."</td>
          </tr>";
$mail_body = $mail_body."
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
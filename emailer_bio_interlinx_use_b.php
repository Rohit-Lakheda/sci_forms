<?php  
	$cata = $res['sub_delegates'];
	
$mail_body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>".$EVENT_NAME."</title>
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
                <td width='4'>&nbsp;</td>
                <td width='335'><a href='".$EVENT_WEBSITE_LINK."' target='_blank'><img src='".$EVENT_LOGO_LINK."' title='".$EVENT_NAME." ".$EVENT_YEAR."' alt='".$EVENT_NAME." ".$EVENT_YEAR."' border='0' align='middle'/></a></td>
              </tr>
            </table></td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;padding: 17px;'>
		  	Delegate Name :- " . $qr_gt_user_inx_login_data_ans['title'] . " " . $qr_gt_user_inx_login_data_ans['fname'] . " ". $qr_gt_user_inx_login_data_ans['lname'] . "<br />

Organization :- " . $qr_gt_user_inx_login_data_ans['org_name'] . "<br />

Designation :- " . $qr_gt_user_inx_login_data_ans['desig'] . "<br /><br />

Dear " . $qr_gt_user_inx_login_data_ans['title'] . " " . $qr_gt_user_inx_login_data_ans['fname'] . " ". $qr_gt_user_inx_login_data_ans['lname'] . "<br /><br />

We would like to thank you for participating as a delegate in the ".$EVENT_NAME. " " . $EVENT_YEAR . " to be held in " . $EVENT_VENUE . "<br /><br />

For the first time a focused online B2B initiative is being launched by ".$EVENT_NAME. " where in delegates can schedule B2B meetings with delegates from other states and countries before the event and can take maximum mileage during the event. <br /><br />

As \"partnering partner\" of this Global Connect Initiative by ".$EVENT_NAME. ", InterlinX would be facilitating your participation at the Event as well as help you schedule B2B Meeting as per your sectors using the Online Business Resource Centre &ndash; InterlinX. <br /><br />

You would have already received your User ID and Password to access the InterlinX partnering portal on your email. In case you have not received, you may regenerate your password by submitting your user ID - '" . $qr_gt_user_inx_login_data_ans['user_name'] . "' (without quotes) at the following link http://www.interlinx.in/BIB2017/InterlinX/forgot_pass.php. We are requested to update your personal profile and company profile in the portal.<br /><br />

Our Technical Team would be happy to assist you with any support and guidance for using this platform to schedule your Business Meetings during ".$EVENT_NAME. " " . $EVENT_YEAR . " Event. For any technical assistance, please write to support@interlinx.in<br /><br />


We look forward to have you as a part of the delegation and explore more with InterlinX at ".$EVENT_NAME. " " . $EVENT_YEAR . ".<br /><br />
 
Thanks,<br />
".$EVENT_NAME. " " . $EVENT_YEAR . "<br /><br />
For any further information, please contact: <br /><br />
".$EVENT_NAME. " " . $EVENT_YEAR . "<br />
Registration Desk,<br /><br />

(This is a system generated mail, please do not reply.)

		  </td>
          </tr>
        </table></td>
      </tr>
	         
  <td></td>
  </tr>
  
        </table></td>
      </tr>
      
    </table></td>
  </tr>
</table>
</body>
</html>";
//echo $mail_body;
?>
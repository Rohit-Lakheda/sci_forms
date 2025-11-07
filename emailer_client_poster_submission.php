<?php 
 
$email_pstr_bdy_user="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Bangalore India Bio 2011</title>

</head>
 
<body>
<table width='600' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='4%'>&nbsp;</td>
    <td width='93%'>&nbsp;</td>
    <td width='3%'>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align='center' valign='top'><a href='".$EVENT_WEBSITE_LINK."' target='_blank'><img src='".$EVENT_LOGO_LINK."' title='".$EVENT_NAME."' alt='".$EVENT_NAME."'  border='0' align='middle'/></a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Dear ".@$_POST['lead_name'].", <br /><br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thank you for submitting your poster presentation details. Our executive will get back to you soon. <br />
      <br /><br />
      Best Regards,<br />
".$EVENT_NAME." ".$EVENT_YEAR.",<br />
                                                      ".$EVENT_SECRT_ADDR."<br />
                                                    <strong>Email:</strong> <a href='".$PSTR_EMAIL_ID."' target='_blank'>".$PSTR_EMAIL_ID."</a>
</p>    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>";

?>
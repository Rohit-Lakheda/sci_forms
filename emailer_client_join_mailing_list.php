<?php  

$email_client_prp_sub="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>".$EVENT_NAME." ".$EVENT_YEAR."</title>

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
    <td align='center' valign='top'><a href='".$EVENT_WEBSITE_LINK."' target='_blank'><img src='".$EVENT_LOGO_LINK."' title='".$EVENT_NAME."' alt='".$EVENT_NAME."' border='0' align='middle'/></a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'><p >Dear ".@$_POST['name'].", <br />
      <br>
      Greetings!<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We   are pleased to include you in our Mailing list. We shall mail you the updates   regarding ".$EVENT_NAME.".<br>
      <br>
      Please   block your dates on ".$EVENT_DATE." to be part of ".$EVENT_NAME." ".$EVENT_YEAR.". &nbsp;<br>
      <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Please   do not hesitate to contact us in case you would like to get associated with the   event and reach out to your target audience. </p>    
      <p>        Best Regards,<br />
      <br>
	  ".$EVENT_NAME." Secretariat <br>
MM Activ #9, UNI Building, 1st Floor, <br>
Thimmaiah Road, <br>
Millers Tank Bed, Vasanthnagar, <br>
Bangalore - 560 052 <br>
Tel: +91 80 4113 1912 / 13<br> 
Fax: +91 80 4113 1914 <br>
Email: <a href='mailto:".$EVENT_ENQUIRY_EMAIL."' target='_blank'>".$EVENT_ENQUIRY_EMAIL."</a></p>
    </td>
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
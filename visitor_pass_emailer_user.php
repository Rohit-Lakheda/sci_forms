<?php
  
$VSTR_FROM_BODY_ADMIN_MAIL = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<title>".$EVENT_NAME."</title>	
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />    
	<meta name='keywords' content=''></meta>
	<meta name='description' content='Free form designs from CSS Globe'></meta>
	<meta http-equiv='imagetoolbar' content='no' />
	

</head>
<body>


  <table style='font-family:Arial, Helvetica, sans-serif; font-size:14px; width:700px; background-color:#F5F7F6;'   cellspacing='0' cellpadding='0'>
    <tr>
      <td height='1' colspan='2'><span class='style3'>&nbsp;</span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align='left' valign='top'><a href='".$EVENT_WEBSITE_LINK."' target='_blank'><img src='".$EVENT_LOGO_LINK."' title='".$EVENT_NAME."' alt='".$EVENT_NAME."'  border='0' align='middle'/></a></td>
    </tr>
    <tr>
      <td  align='left'>&nbsp;</td>
      <td  align='left' valign='top'>&nbsp;</td>
    </tr>
    <tr>
      <td width='3%'  align='left'>&nbsp;</td>
      <td width='98%'  align='left' valign='top' bgcolor='#F5F7F6'><p class='style3'>Dear ".$res_vp_d['title']." ".$res_vp_d['fname'].",<br />
        <br />
		Thank you for registering as visitor at ".$EVENT_NAME." " . $EVENT_YEAR . ". Exhibition visiting details are as follows;<br/>
        </p>
        <p><strong>Visitor Name: ".$res_vp_d['title']." ".$res_vp_d['fname']."</strong></p>        
        <p><strong>Pass No.: ".$res_vp_d['pass_no']."</strong></p>        
          <p><strong>Visiting Hours:</strong></p>
          <p><strong>Day 1: </strong><strong>".$VSTR_DAY1_TIME."</strong></p>
          <p><strong>Day 2: </strong><strong>".$VSTR_DAY2_TIME."</strong></p>
          <p><strong>Day3: </strong><strong>".$VSTR_DAY3_TIME."</strong></p>
        <br/>
        Thanking You,
        </p>
        <p class='style3'  align='left' >".$EVENT_NAME." Secretariat <br />
          ".$EVENT_SECRT_ADDR."<br />
      Email:<a href='mailto:".$ENQUIRY_FROM_EMAIL_USER_MAIL."' target='_blank'>".$ENQUIRY_FROM_EMAIL_USER_MAIL."</a></p></td>
    </tr>
    <tr>
      <td class='style3'>&nbsp;</td>
      <td class='style3'>&nbsp;</td>
    </tr>
  </table>

</body>
</html>";
//echo $VSTR_FROM_BODY_ADMIN_MAIL;
?>
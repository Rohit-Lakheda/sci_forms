<?php 
	 
	$str_exb_admin = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<title></title>	 
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />    
	<meta name='keywords' content=''></meta>
	<meta name='description' content='Free form designs from CSS Globe'></meta>
	<meta http-equiv='imagetoolbar' content='no' />
	<style type='text/css'>
body{ 
	background:#f8f8f8;
	font:13px Trebuchet MS, Arial, Helvetica, Sans-Serif; 
	
	
	margin:0;
	padding:0;
	text-align:center;
	}

-->
    </style>
</head>
<body>
<table width='600' border='0' cellspacing='1' cellpadding='0'>
  <tr>
    <td colspan='3' align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3' align='left' valign='top' class='text'><img src='".$EVENT_LOGO_LINK."' title='".$EVENT_NAME." ".$EVENT_YEAR."' alt='".$EVENT_NAME." ".$EVENT_YEAR."' border='0' align='middle' style='width: 50%; margin-left: 150px;'/></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3' align='left' valign='top' class='text'><p>Dear Admin,<br>
      <br>
      New Exhibitoitor details has been submitted for <strong>".$EVENT_NAME." ".$EVENT_YEAR."</strong>, Details are as follows</p>    </td>
  </tr>";

  
if(!empty($assoc_nm)) {
	$n = $assoc_nm;
	if($assoc_nm == 'Startup') {
		$n = 'Startup Innovation Zone';
  $str_exb_admin = $str_exb_admin . "<tr>
  <td align='left' valign='top' class='text'>&nbsp;</td>
  <td align='center' valign='top' class='text'>&nbsp;</td>
  <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
  <td align='left' colspan='3' valign='top' class='text'>&nbsp;<strong>" . $n . "</strong></td>
  </tr>";
	} else {
    $str_exb_admin = $str_exb_admin . "<tr>
    <td align='left' valign='top' class='text'>Association Name </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$assoc_nm."</td>
  </tr>";
  }
}/**/

if(!empty($exhi_profile)) {
$str_exb_admin = $str_exb_admin . "
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Sector </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".str_replace('#', ',', $exhi_profile)."</td>
  </tr>";
}

  $str_exb_admin = $str_exb_admin . "<tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Exhibitor Id </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$exhibitor_id_ex."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='middle' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Name of the Exhibitor</td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_exhi_name."</td>
  </tr>";

if(!empty($qr_chk_exb_ans ['category'])) {
$str_exb_admin = $str_exb_admin . "<tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Category</td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$qr_chk_exb_ans ['category']."</td>
  </tr>";
}

  $str_exb_admin = $str_exb_admin . "<tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>";

  /*<tr>
    <td align='left' valign='top' class='text'>Booth Space </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$booth_space."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Area </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_booth_area." ".$temp_booth_area_unit."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>*/
  $str_exb_admin .= "<tr>
    <td align='left' valign='top' class='text'>Name for Fascia</td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_fascia_name_up."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Contact Person Name </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_cp_title." ".$temp_cp_fname." ".$temp_cp_lname."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='middle' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Contact Person Designation </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_desig."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='middle' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Organisation Address 1 </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_addr1."</td>
  </tr>";
 /* <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='middle' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Address Line 2 </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_addr2."</td>
  </tr>*/
  $str_exb_admin .= "<tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='middle' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>City </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_city."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='middle' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>State </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_state."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Country </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_country."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Pin/Zip Code </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_zip."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Phone </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;+".$temp_fon_cntry." ".$temp_fon."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Mobile </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;+".$temp_mob_cntry."-".$temp_mob ."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>";
  /*<tr>
    <td align='left' valign='top' class='text'>Fax </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;+".$temp_fax_cntry."-".$temp_fax."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>*/
  $str_exb_admin .= "<tr>
    <td align='left' valign='top' class='text'>Email </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_email."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Website </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_website."</td>
  </tr>
  
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>";
  /*
  <tr>
    <td align='left' valign='top' class='text'>Sector </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".str_replace('#', ',', $exhi_profile)."</td>
  </tr>
  
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Organisation Logo </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;<a href='" . $logo . "' target='_blank'>View Logo </a></td>
  </tr>
  
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Keywords </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$keywords."</td>
  </tr>
  
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>*/
  $str_exb_admin .= "<tr>
    <td align='left' valign='top' class='text'>Organisation Profile </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_profile."</td>
  </tr>
</table>
</body>
</html>";
?>
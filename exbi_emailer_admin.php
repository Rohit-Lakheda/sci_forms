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
    <td colspan='3' align='left' valign='top' class='text'><img src='".$EVENT_LOGO_LINK."' title='".$EVENT_NAME." ".$EVENT_YEAR."' alt='".$EVENT_NAME." ".$EVENT_YEAR."' border='0' align='middle' style='width: 25%; margin-left: 150px;'/></td>
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
  </tr>
  <tr>
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
    <td align='left' valign='top' class='text'>Name of Exhibitor</td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_exhi_name."</td>
  </tr>";
if(!empty($assoc_nm)) {
$str_exb_admin = $str_exb_admin . "<tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Association Name </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$assoc_nm."</td>
  </tr>";
}/*
  <tr>
    <td align='left' valign='top' class='text'>Sector</td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_exhi_sector."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='middle' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>*/

if(!empty($exhi_profile)) {
$str_exb_admin = $str_exb_admin . "
  <tr>
    <td align='left' valign='top' class='text'>Sector </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$exhi_profile."</td>
  </tr>
  
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>";
}

 if(!empty($temp_order_no)) {
	$str_exb_admin = $str_exb_admin . "<tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Elevate Winner ID </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_order_no."</td>
  </tr>";
 }
  $str_exb_admin = $str_exb_admin . "<tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
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
  </tr>
  <tr>
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
    <td align='left' valign='top' class='text'>Designation </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_desig."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='middle' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>New Address Format </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_addr1.", ".$temp_addr2." , ".$temp_city." - ".$temp_zip.", ".$temp_state.", ".$temp_country."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='middle' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Address Line 1 </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_addr1."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='middle' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Address Line 2 </td>
    <td align='center' valign='middle' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_addr2."</td>
  </tr>
  <tr>
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
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Fax </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;+".$temp_fax_cntry."-".$temp_fax."</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
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
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>Organisation Profile </td>
    <td align='center' valign='top' class='text'>:</td>
    <td align='left' valign='top' class='text'>&nbsp;".$temp_profile."</td>
  </tr>
  
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3' align='left' valign='top' class='text'>Exhibitors Details: </td>
  </tr>
  <tr>
    <td colspan='3' align='left' valign='top' class='text'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='7%'>&nbsp;</td>
        <td width='38%'>&nbsp;</td>
        <td width='33%'>&nbsp;</td>
        <td width='22%'>&nbsp;</td>
      </tr>
      <tr>
        <td align='left' valign='top'><strong>Sr.No.</strong></td>
        <td align='left' valign='top'><strong>Name</strong></td>
        <td align='left' valign='top'><strong>Designation</strong></td>
		<td align='left' valign='top'><strong>Email Id</strong></td>
        <td align='left' valign='top'><strong>Category</strong></td>
      </tr>
      <tr>
        <td align='left' valign='top'>&nbsp;</td>
        <td align='left' valign='top'>&nbsp;</td>
        <td align='left' valign='top'>&nbsp;</td>
        <td align='left' valign='top'>&nbsp;</td>
      </tr>";
    
	$i = 0;
	foreach ($exhi_user_data as $detail){	
			$i++;
			$title = @$detail['title'];
			$fname = @$detail['fname'];
			$mname = @$detail['mname'];
			$lname = @$detail['lname'];
			$desig = @$detail['desig'];
			$category = @$detail['category'];
			$email = @$detail['email'];
	
	if( ($title!="") && ($fname!="") && ($lname!="") && ($desig!="") ){
	 $str_exb_admin =  $str_exb_admin."<tr>
        <td height='30' align='left' valign='top'>".$i . "</td>
        <td align='left' valign='top'>".$title." ".$fname." ".$lname."</td>
        <td align='left' valign='top'>".$desig."</td>
		<td align='left' valign='top'>".$email."</td>
        <td align='left' valign='top'>".$category."</td>
      </tr>";
	  } 
	}
      $str_exb_admin =  $str_exb_admin."<tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> 
    </table></td>
  </tr>
  <tr>
    <td colspan='3' align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='text'>&nbsp;</td>
    <td align='center' valign='top' class='text'>&nbsp;</td>
    <td align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3' align='left' valign='top' class='text'>&nbsp;</td>
  </tr>
</table>
</body>
</html>";
?>
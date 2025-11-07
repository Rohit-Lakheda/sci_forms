<?php 
 
$email_pstr_bdy_admin = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Untitled Document</title>
</head>

<body>
<table width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>
  <tr>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td colspan='3' align='center' valign='top' bgcolor='#F7F7F7'><a href='".$EVENT_WEBSITE_LINK."' target='_blank'><img src='".$EVENT_LOGO_LINK."' title='".$EVENT_NAME."' alt='".$EVENT_NAME."'  border='0' align='middle'/></a></td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td colspan='3' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Dear Admin, <br />
      <br />
    New Poster Entry has been submitted on ".$EVENT_NAME." ".$EVENT_YEAR." by <br>
    <br>    &nbsp;".@$_POST['lead_name'].", details are as follows </td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td width='2%' bgcolor='#F7F7F7'>&nbsp;</td>
    <td width='28%' bgcolor='#F7F7F7'>&nbsp;</td>
    <td width='3%' bgcolor='#F7F7F7'>&nbsp;</td>
    <td width='66%' bgcolor='#F7F7F7'>&nbsp;</td>
    <td width='1%' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td colspan='3' align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'> Title of the  Session:&nbsp;".@$_POST['title']."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td colspan='3' align='left' valign='top' bgcolor='#F7F7F7'> Focus Areas :&nbsp;".$theme."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  
  <tr>
    <td height='1' colspan='5' align='left' valign='top' bgcolor='#A4A4A4'></td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td colspan='3' align='left' valign='top' bgcolor='#F7F7F7' style='ont-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;font-weight: bold;'> Details Of Lead Person </td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Name </td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['lead_name']."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Organisation </td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['lead_org']."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr> 
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Email Id </td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['lead_email']."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Phone Number </td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".@$_POST['lead_ccode']."- ".@$_POST['lead_acode']."-".@$_POST['lead_phone']."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Mobile Number</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['lead_mob']."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Complete Address with </td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['lead_addr']."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>City</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['lead_city']."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>State</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['lead_state']."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Country</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['lead_country']."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>zip code</td>
    <td align='center' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['lead_zip']."</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='center' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td height='1' colspan='5' align='left' valign='top' bgcolor='#A4A4A4'></td>
  </tr>
  
  
  <tr >
    <td colspan='5' align='right' valign='top'>
	<div id='speaker_info_1' style='display:'>
      <table width='100%' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='2%' bgcolor='#EBEBEB'>&nbsp;</td>
          <td width='28%' bgcolor='#EBEBEB'>&nbsp;</td>
          <td width='3%' bgcolor='#EBEBEB'>&nbsp;</td>
          <td width='66%' align='right' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td width='1%' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td colspan='3' align='left' valign='top' bgcolor='#EBEBEB' ><span style='ont-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;font-weight: bold;'> Details Of Poster Presenter </span></td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Name   </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['pp_name']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
		 <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Org </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$pp_org."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
		 <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Website </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$pp_website."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Email </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['pp_email']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
		 <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Organisation </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['pp_org']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Phone Number </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['pp_ccode']."-".$_POST['pp_acode']." - ".$_POST['pp_phone']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Mobile Number </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['pp_mob']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Complete Address </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['pp_addr']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>City</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['pp_city']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>State</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['pp_state']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Country</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['pp_country']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>zip code 1 </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>".$_POST['pp_zip']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='1' colspan='5' align='left' valign='top' bgcolor='#A4A4A4'></td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td colspan='3' align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td colspan='3' align='left' valign='top' bgcolor='#F7F7F7' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'><strong>Details Of Co Author(s) </strong></td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >Name of Co-Author 1 </td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >:</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>".@$_POST['co_auth_name_1']."</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >Name of Co-Author 2 </td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >:</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>".@$_POST['co_auth_name_2']."</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >Name of Co-Author 3 </td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >:</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>".@$_POST['co_auth_name_3']."</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >Name of Co-Author 4 </td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >:</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>".@$_POST['co_auth_name_4']."</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        
		<tr>
          <td height='1' colspan='5' align='left' valign='top' bgcolor='#A4A4A4'></td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td colspan='3' align='left' valign='top' bgcolor='#EBEBEB' ><strong>Details of Accompanying Co-Author(s) to the Event </strong></td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >Name of Co-Author 1</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>".@$_POST['acc_co_auth_name_1']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >Name of Co-Author 2 </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>".@$_POST['acc_co_auth_name_2']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >Name of Co-Author 3 </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>".@$_POST['acc_co_auth_name_3']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >Name of Co-Author 4 </td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >:</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>".@$_POST['acc_co_auth_name_4']."</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
        <tr>
          <td height='14' align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#EBEBEB' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#EBEBEB'>&nbsp;</td>
        </tr>
		 <tr>
 		 	  <td height='1' colspan='5' align='left' valign='top' bgcolor='#A4A4A4'></td>
 		 </tr>
         <tr>
           <td height='14' align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
           <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
           <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
           <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
           <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
         </tr>
         <tr>
           <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
           <td align='left' valign='top' bgcolor='#F7F7F7' >Theme</td>
           <td align='center' valign='top' bgcolor='#F7F7F7' >:</td>
           <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;".$theme."</td>
           <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
         </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >Abstract of Poster</td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >:</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'><a href='".$target_path_sess_abstract."' target='_blank'>Click here to download file </a></td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >CV of lead Author</td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >:</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'><a href='".$target_path_chair_brief."' target='_blank'>Click here to download file </a></td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='center' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
          <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
        </tr>
        <tr>
          <td height='1' colspan='5' align='left' valign='top' bgcolor='#A4A4A4'></td>
        </tr>
      </table>
	  </div>";
	  
	  
	  
	$email_pstr_bdy_admin .= "</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td align='right' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td colspan='3' align='left' valign='top' bgcolor='#F7F7F7' ><p style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;'>Regard, <br />
   ".$EVENT_NAME." ".$EVENT_YEAR."</p>    </td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7' >&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td align='right' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
    <td align='left' valign='top' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
</table>
</body>
</html>";
?>
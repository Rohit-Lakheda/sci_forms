<?php



$mail_body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>

<html xmlns='http://www.w3.org/1999/xhtml'>

<head>

<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

<title>" . $EVENT_NAME . " " . $EVENT_YEAR . "</title>

</head>



<body>";

if($res['pay_status']=="Not Paid") {



    $mail_body = $mail_body . "<table width='100%' border='0' cellspacing='0' cellpadding='0'>

                              <tr>

                                <td width='3%'>&nbsp;</td>

                                <td width='94%'class='content-txt-form' style='font-size: 15px;'><strong>Note :</strong>Click on  <a href='" . $EVENT_OL_PAY_ACT_LINK_EX . "?id=" . $res['tin_no'] . "' target='_blank'>'Pay Now'</a> to pay instantly or<br />

                                  <a href='" . $EVENT_OL_PAY_ACT_LINK_EX . "?id=" . $res['tin_no'] . "' target='_blank'>Click here</a> to activate your online payment process or<br />

                                  use below mentioned link<br />

         <a href='" . $EVENT_PAY_LINK_EX . "' target='_blank'>" . $EVENT_PAY_LINK_EX . "</a></td>

                                <td width='3%'>&nbsp;</td>

                              </tr>

                            </table>





                            <br/>

                            <br/>";

}

$mail_body = $mail_body . "<table width='650' border='0' align='center' cellpadding='0' cellspacing='1' style='font:Verdana, Arial, Helvetica, sans-serif;	font-size: 11px;font-weight: normal; color: #000000;' >

  <tr>

    <td><table width='650' border='0' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>



      <tr>

        <td width='650' colspan='3' style='font-family:Verdana; font-size:10px; color:#333333; line-height:17px;'><table width='100%' border='0' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC'>

          <tr>

            <td height='22' colspan='3' align='center' valign='top' bgcolor='#FFFFFF' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><table width='630' border='0' cellspacing='0' cellpadding='0'>

               <tr>

                <td colspan='4' align='right' valign='middle' style='color: #15a3f9;font-size: 13px;font-weight: bold;'><span>Follow us on </span><a href='" . $FACEBOOK_PAGE . "' target='_blank'><img src='" . $EVENT_FORM_LINK . "images/facebook-30circle.png' alt='facebook' /></a> &nbsp;&nbsp;<a href='" . $TWITTER_PAGE . "' target='_blank'><img src='" . $EVENT_FORM_LINK . "images/twitter-30circle.png' alt='twitter' /></a></td>

              </tr>

              <tr>

                <td width='4'>&nbsp;</td>

                <td><a href='" . $EVENT_WEBSITE_LINK . "' target='_blank'><img src='" . $EVENT_LOGO_EMAILER . "' title='" . $EVENT_NAME . " " . $EVENT_YEAR . "' alt='" . $EVENT_NAME . " " . $EVENT_YEAR . "' border='0' align='middle' /></a></td>

                <td width='13'>&nbsp;</td>

                <td width='298' align='right'><strong><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>" . $assoc_logo . "</td>

              </tr>

            </table>

              </td>

          </tr>";

if ($res['pay_status'] == 'Not Paid') {

  $mail_body .= "<tr><td colspan='3'>

			<table width='100%' border='0' cellspacing='0' cellpadding='0'>

          <tr>

			<td height='22' colspan='2' valign='top' bgcolor='#FFFFFF' style='color:#1D0D6F;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 19px; padding: 8px; border: 1px solid #dadada;'><strong>&nbsp;&nbsp;Provisional Receipt </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

            <td height='22'  align='right' valign='top' bgcolor='#FFFFFF' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><strong>Date of Registration - <span >" . $res['reg_date'] . "</span> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

          </tr></table></td></tr>";

} else if ($res['pay_status'] == '') {

  $mail_body .= "<tr><td colspan='3'>

			<table width='100%' border='0' cellspacing='0' cellpadding='0'>

          <tr>

			<td height='22' colspan='2' valign='top' bgcolor='#FFFFFF' style='color:#1D0D6F;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 19px; padding: 8px; border: 1px solid #dadada;'><strong>&nbsp;&nbsp;Registration Information Receipt</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

            <td height='22'  align='right' valign='top' bgcolor='#FFFFFF' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><strong>Date of Registration - <span >" . $res['reg_date'] . "</span> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

          </tr></table></td></tr>";

} else {

  $mail_body .= "<tr><td colspan='3'>

			<table width='100%' border='0' cellspacing='0' cellpadding='0'>

          <tr>

			<td height='22' colspan='2' valign='top' bgcolor='#FFFFFF' style='color:#1D0D6F;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 19px; padding: 8px; border: 1px solid #dadada;'><strong>&nbsp;&nbsp;Payment Acknowledgement Receipt </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

            <td height='22'  align='right' valign='top' bgcolor='#FFFFFF' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><strong>Date of Registration - <span >" . $res['reg_date'] . "</span> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

          </tr></table></td></tr>";

}



$mail_body .= "<tr bgcolor='#FFFFFF'>

            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;<strong>TIN Number</strong> :&nbsp;" . $res['tin_no'] . "</td>

          </tr>";

if (!empty($res['pin_no'])) {

  $mail_body .= "<tr bgcolor='#FFFFFF'>

	            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;<strong>PIN Number</strong> :&nbsp;" . $res['pin_no'] . "</td>

	          </tr>";

}

$mail_body .= "<tr>

            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp;Exhibitors Company Details :</span></td>

          </tr>";

if (!empty($res['user_type'])) {

  $mail_body .= "<tr bgcolor='#FFFFFF'>

            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Type</td>

            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $res['user_type'] . "</td>

          </tr>";

}

if (!empty($res['booth_size'])) {

  $booth_size2 = explode(" ", $res['booth_size']);

  $booth_size2 = $booth_size2[0];

  if($booth_size2 <4 ){

    $booth_size2 = $res['booth_space'];

  }else{

    $booth_size2 = $res['booth_size'];

  }





  $mail_body .= "<tr bgcolor='#FFFFFF'>

            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Booth Size</td>

            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $booth_size2 . "</td>

          </tr>";

}



$mail_body .= "		

		<tr bgcolor='#FFFFFF'>

            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Nationality</td>

            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $res['nationality'] . "</td>

          </tr>		

		<tr bgcolor='#FFFFFF'>

            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Sector</td>

            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $res['sector'] . "</td>

          </tr>	

          <tr bgcolor='#FFFFFF'>

                  <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Subsector</td>

                  <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

                  <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $res['subsector'] . "</td>

                </tr>

            		

          <tr bgcolor='#FFFFFF'>

            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Name of Exhibitor  (Organisation Name)</td>

            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $res['exhibitor_name'] . "</td>

          </tr>

          <tr bgcolor='#FFFFFF'>

            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Address</td>

            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $res['addr1'] . " " . $res['addr2'] . ", City - " . $res['city'] . ", State - " . $res['state'] . ", Country - " . $res['country'] . ", Pincode - " . $res['zip'] . ".</td>

          </tr>";



/*if($res['member_of_assoc'] != ''){

		   $mail_body = $mail_body."<tr bgcolor='#FFFFFF'>

            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Are you member of Genotypic Techchnology</td>

            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['member_of_assoc'].".</td>

          </tr>";

}

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

	$mail_body = $mail_body."<tr bgcolor='#FFFFFF'>

		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Association Name </td>

		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['assoc_name']."</td>

		    </tr>";

}



if($res['user_type'] != ''){

	$mail_body = $mail_body."<tr bgcolor='#FFFFFF'>

		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Note </td>

		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['user_type']."</td>

		    </tr>";

}

	

if($res['membership_code'] != ''){

	$mail_body = $mail_body."<tr bgcolor='#FFFFFF'>

		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Membership Code </td>

		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['membership_code']."</td>

		    </tr>";

}*/



$mail_body = $mail_body . "

		  <tr bgcolor='#FFFFFF'>

		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Phone</td>

		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $res['phone'] . "</td>

		    </tr>

          <tr bgcolor='#FFFFFF'>

            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;GST Number</td>

            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $res['gst_number'] . ".</td>

          </tr>

          <tr bgcolor='#FFFFFF'>

            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;PAN Number</td>

            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $res['pan_number'] . ".</td>

          </tr>";



if ($res['user_type'] == 'ABLE StartUp Exhibitor') {

  $mail_body = $mail_body . "

          <tr bgcolor='#FFFFFF'>

            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Organisation Registration Certificate</td>

            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><a href=" . $res['ci_certf'] . " target='_blank'> &nbsp; Click Here to View</a></td>

          </tr>";

}

if (!empty($res['sales_exec'])) {

  $mail_body = $mail_body . "<tr bgcolor='#FFFFFF'>

          <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Sales Executive</td>

          <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

          <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $res['sales_exec'] . "</td>

        </tr>";

}



if (!empty($res['pay_status'])) {

  $mail_body = $mail_body . "

          <tr>

            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;<span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>Exhibitors Payment Details :</span></td>

          </tr>



          <tr bgcolor='#FFFFFF'>

            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Payment Method </td>

            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $res['paymode'] . "</td>

          </tr>

           <tr bgcolor='#FFFFFF'>

            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Payment Status </span></td>

            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;" . $res['pay_status'] . "</td>

          </tr>";

}

/*<tr bgcolor='#FFFFFF'>

            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Category</span></td>

            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['cata']."</td>

          </tr>

          <tr bgcolor='#FFFFFF'>

            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Delegate Type </span></td>

            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>

            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$res['org_reg_type']."</td>

          </tr>

          <tr bgcolor='#FFFFFF'>

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

          </tr>";*/

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

if ($res['pay_status'] == "Paid") {

  $mail_body = $mail_body . "<tr>

            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>" . $emler_str_pg_resp . "</td>

          </tr>



		   <tr>

            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;</td>

          </tr>";

}



$mail_body = $mail_body . "<tr>

            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp; Personal Details :</span></td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td colspan='3' style='font-family:Verdana; font-size:10px; color:#333333; line-height:17px;'><table width='100%' border='0' align='left' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC'>

          <tr>

            <td height='2' colspan='2' ></td>

          </tr>

          <tr>

            <td width='27%' height='22' align='center' valign='middle' bgcolor='#D7CFA8'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Contact Person Name</font> </strong></div></td>

            <td width='25%' align='center' valign='middle' bgcolor='#D7CFA8'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Contact Person Email </font></strong></div></td>

            <td width='25%' align='center' valign='middle' bgcolor='#D7CFA8'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'> Contact Person Mobile	</font></strong></div></td>

            <td width='23%' align='center' valign='middle' bgcolor='#D7CFA8'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Amount (" . $res['amt_ext'] . ")</font></strong></div></td>

          </tr>

          <tr>

            <td height='2' colspan='2' bgcolor=''></td>

          </tr>

          <tr>

            <td height='1' colspan='2' ></td>

          </tr>";



$mail_body = $mail_body . "<tr bgcolor='#FFFFFF'>

            <td bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;&nbsp;" . $res['cp_title'] . ' ' . $res['cp_fname'] . ' ' . $res['cp_lname'] . "</td>

            <td bgcolor='#F9F8F2' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;&nbsp;" . $res['cp_email'] . "</td>

            <td bgcolor='#F9F8F2' align='left' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;&nbsp;" . $res['cp_mobile'] . "</td>

            ";

if (!empty($res['selection_amt'])) {

  $mail_body = $mail_body . "

            <td height='22' bgcolor='#F9F8F2' align='right' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $res['selection_amt'] . "&nbsp;&nbsp;</td>";

} else {

  $mail_body = $mail_body . "

            <td height='22' bgcolor='#F9F8F2' align='right' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>N/A&nbsp;&nbsp;</td>";

}

$mail_body = $mail_body . " </tr>";



if (!empty($res['selection_amt'])) {

  $mail_body = $mail_body . "<tr bgcolor='#FFFFFF'>

             <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>

             <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>

             <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Total Selection Amount (" . $res['amt_ext'] . ")&nbsp;&nbsp;</td>

            <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'>" . $res['selection_amt'] . "&nbsp;&nbsp;</div></td>

          </tr>";

}



if (($res['admin_discount'] != "") && ($res['admin_discount'] > 0)) {



  $mail_body = $mail_body . "

          <tr bgcolor='#FFFFFF'>

              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Admin Discount @ " . $res['adminDiscountPer'] . "% </td>

            <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $res['admin_discount'] . "&nbsp;&nbsp;</td>

          </tr>";

}



if (($res['membership_discount'] != "") && ($res['membership_discount'] > 0)) {

  $mail_body = $mail_body . "

          <tr bgcolor='#FFFFFF'>

              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Membership Discount@" . $res['membershipDiscountPer'] . "%</td>

            <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $res['membership_discount'] . "&nbsp;&nbsp;</td>

          </tr>";

}



if (($res['gr_discount'] != "") && ($res['gr_discount'] > 0)) {

  $mail_body = $mail_body . "

          <tr bgcolor='#FFFFFF'>

              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Group Discount&nbsp;&nbsp;&nbsp; </td>

            <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $res['gr_discount'] . "&nbsp;&nbsp;</td>

          </tr>";

}



if (($res['tax'] != "") && ($res['tax'] > 0)) {

  $mail_body = $mail_body . "<tr bgcolor='#FFFFFF'>

              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'> GST @ " . $SERVICE_TAX . "%&nbsp;&nbsp; </td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'><span >" . $res['amt_ext'] . " " . $res['tax'] . "</span>&nbsp;&nbsp;</div></td>

          </tr>";

}



if (($res['processing_charge'] != "") && ($res['processing_charge'] > 0)) {

  $mail_body = $mail_body . "<tr bgcolor='#FFFFFF'>

              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'> Processing Charges&nbsp;&nbsp; </td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'><span >" . $res['amt_ext'] . " " . $res['processing_charge'] . "</span>&nbsp;&nbsp;</div></td>

          </tr>";

}

if (!empty($res['total'])) {

  $mail_body = $mail_body . " <tr bgcolor='#FFFFFF'>

              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>

              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>

              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Total (Including Processing Charges)  " . $res['amt_ext'] . "&nbsp;&nbsp; </td>

              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'>" . $res['total'] . "&nbsp;&nbsp;</div></td>

            </tr>";

}

if (!empty($total_amt)) {

  $mail_body .= " <tr bgcolor='#FFFFFF'>

	              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>

	              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>

	              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Total Amount Payable in INR (Including Processing Charges)";

  if ($res['amt_ext'] != "Rs.") {

    $mail_body = $mail_body . "<br/><span style='font-size: 9px; font-family: Verdana, Arial, Helvetica, sans-serif;'></span>";

  }

  $mail_body = $mail_body . "&nbsp;&nbsp; </td>

	              	<td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'>" . $total_amt . "&nbsp;&nbsp;</div></td>

	            </tr>";

}

if (!empty($res['total_amt_received'])) {

  $mail_body .= " <tr bgcolor='#FFFFFF'>

	              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>

	              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>

	              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>Total  Amount Received&nbsp;&nbsp; </td>

	              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'>" . $res['total_amt_received'] . "&nbsp;&nbsp;</div></td>

	            </tr>

	            ";

}



$mail_body = $mail_body . "

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



$mail_body = $mail_body . "<tr>

            <td height='10' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;</td>

          </tr>

      <tr>

        <td colspan='3' style='font-family:Verdana; font-size:10px; color:#333333; line-height:17px;'><table width='100%' border='0' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC'>





          <tr bgcolor='#FFFFFF'>

            <td  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>";





if (($res['paymode'] == 'Complimentary') || ($res['pay_status'] == 'Complimentary')) {

  $mail_body = $mail_body . "<table width='100%' border='0' cellspacing='0' cellpadding='0'>

                              <tr>

                                <td width='3%'>&nbsp;</td>

                                <td width='94%'class='content-txt-form'><strong>Note :Please bring registration receipt during event.</strong></td>

                                <td width='3%'>&nbsp;</td>

                              </tr>

                            </table>";

}

if ($res['pay_status'] == 'Not Paid') {

  if (($res['paymode'] == 'Credit Card') || ($res['paymode'] == 'Debit Card') || ($res['paymode'] == 'i Banking')) {

    $mail_body = $mail_body . "<table width='100%' border='0' cellspacing='0' cellpadding='0'>

                              <tr>

                                <td width='3%'>&nbsp;</td>

                                <td width='94%'class='content-txt-form'><strong>Note :</strong>Click on 'Pay Now' Below to pay instantly or<br />

                                  <a href='" . $EVENT_OL_PAY_ACT_LINK_EX . "?id=" . $res['tin_no'] . "' target='_blank'>Click here</a> to activate your online payment process or<br />

                                  use below mentioned link<br />

         <a href='" . $EVENT_PAY_LINK_EX . "' target='_blank'>" . $EVENT_PAY_LINK_EX . "</a></td>

                                <td width='3%'>&nbsp;</td>

                              </tr>

                            </table>";

  }



  if (($res['paymode'] == 'Cashfree')) {

    $mail_body = $mail_body . "<table width='100%' border='0' cellspacing='0' cellpadding='0'>

                              <tr>

                                <td width='3%'>&nbsp;</td>

                                <td width='94%'class='content-txt-form'><strong>Note :</strong>Click on 'Pay Now' Below to pay instantly or<br />

                                  <a href='" . $CF_EVENT_OL_PAY_ACT_LINK_EX . "?id=" . $res['tin_no'] . "' target='_blank'>Click here</a> to activate your online payment process </td>

                                <td width='3%'>&nbsp;</td>

                              </tr>

                            </table>";

  }



  if ($res['paymode'] == 'Paypal') {

    $mail_body = $mail_body . "<table width='100%' border='0' cellspacing='0' cellpadding='0'>

		<tr>

		<td width='3%'>&nbsp;</td>

		<td width='94%'class='content-txt-form' bgcolor='#ff0'><strong>Note: </strong>Click on 'Pay Now' button below to pay instantly or<br />

		<a href='$CANCEL_URL_EXHIBITOR?id=" . $res['tin_no'] . "' target='_blank'>Click here</a> to activate your online payment process</td>

			                                <td width='3%'>&nbsp;</td>

			                              </tr>

			                            </table>";

  }



  if (($res['paymode'] == "Cheque") || ($res['paymode'] == "Cheque/DD")) {

    if ($res['sector'] == "Bio Technology") {

      $addr = '\'Niton\', Block C, I Floor,<br /> # 11/6, Palace Road,<br /> Bengaluru - 560 052, India<br>Tel:  +91.80.4113 1912/3<br>Website: <a href="http://www.bengaluruindiabio.in" target="_blank">www.bengaluruindiabio.in</a>';

      $mail_body = $mail_body . "<table width='100%' border='0' cellspacing='0' cellpadding='0'>

			  <tr>

				<td width='3%'>&nbsp;</td>

				<td width='94%'class='content-txt-form'><strong>Note :</strong><span style='font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;'>

					Please send your Cheque/DD in favour of " . $EVENT_CHEQUE_PAYBLE_AT_NAME . " payable at " . $EVENT_CHEQUE_PAYBLE_AT . ".<br />

					Along with the copy of your registration receipt and send to<br />

					<strong>Address :</strong><br/>" . $EVENT_CHEQUE_PAYBLE_ADDRESS . "</span></td>

				<td width='3%'>&nbsp;</td>

			  </tr>

			</table>";

    } else {

      $mail_body = $mail_body . "<table width='100%' border='0' cellspacing='0' cellpadding='0'>

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









  if (($res['paymode'] == "Bank Transfer")) {

    $mail_body = $mail_body . "<table width='100%' border='0' cellspacing='0' cellpadding='0'>

						          <tr>

						            <td width='3%'>&nbsp;</td>

                                          <td width='94%'>&nbsp;</td>

                                          <td width='3%'>&nbsp;</td>

                                        </tr>";

    if ($res['nationality'] == 'Indian Organization') {

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

								<span style='color: red;'>Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href='mailto:ramakrishna.mokkapati@mmactiv.com'>ramakrishna.mokkapati@mmactiv.com</a>/<a href='mailto:adarsh.accounts@mmactiv.com'>adarsh.accounts@mmactiv.com</a></span></p>

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

												<span style='color: red;'>Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href='mailto:ramakrishna.mokkapati@mmactiv.com'>ramakrishna.mokkapati@mmactiv.com</a>/<a href='mailto:adarsh.accounts@mmactiv.com'>adarsh.accounts@mmactiv.com</a></span>

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



/*if($res['pay_status']=='Not Paid'){

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



		}*/

$mail_body = $mail_body . "</td>

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

                <td colspan='2' align='center' valign='middle'><img src='" . $MMACTIV_LOGO . "' width='200' height='60' /></td>

                <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>

                    <tr>

                      <td style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>Office : " . $ORGANISATION_NAME . "</td>

                    </tr>

                    <tr>

                      <td style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>Address :  " . $MMACTIV_ADDR . "</td>

                    </tr>

                    <tr>

                      <td style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>Karanataka GST No.: " . $MMACTIV_SERVICE_TAX_NO . "</td>

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


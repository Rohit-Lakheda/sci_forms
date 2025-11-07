<?php   
	
	//$cata = $res['sub_delegates'];  
	
$rsvp_registration_mail_body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Proteomics Society India 2013</title>
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
                <td colspan='4'>&nbsp;</td>
              </tr>
              <tr>
                <td width='4'>&nbsp;</td>
                <td width='335'><a href='".$EVENT_WEBSITE_LINK."' target='_blank'><img src='".$EVENT_LOGO_LINK."' title='".$EVENT_NAME." ".$SUB_EVENT_YEAR."' alt='".$EVENT_NAME." ".$SUB_EVENT_YEAR."' border='0' align='middle'/></a></td>
                <td width='13'>&nbsp;</td>
                <td width='298' align='left'><strong><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>
                 ".$EVENT_NAME." </span><br />
                      <span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>".$EVENT_DATE.".</span><br>
".$EVENT_VENUE.".<br />
                </strong></td>
              </tr>
            </table>
              </td>
          </tr>
         
          <tr>
            <td height='22' colspan='3' align='right' valign='top' bgcolor='#FFFFFF' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><strong>Date of Registration - <span >".$qr_gt_user_data_ans_row['reg_date']."</span> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
		  
          <tr bgcolor='#FFFFFF'>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;<strong>TIN Number</strong> :&nbsp;".$qr_gt_user_data_ans_row['tin_no']."</td>
          </tr>
          <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp;Delegate's Personal Details :</span></td>
          </tr>";
		      $rsvp_registration_mail_body = $rsvp_registration_mail_body."<tr bgcolor='#FFFFFF'>
            <td width='18%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Organization</td>
            <td width='1%' height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='81%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$qr_gt_user_data_ans_row['org']."</td>
          </tr>";
		  
		  $rsvp_registration_mail_body = $rsvp_registration_mail_body."<tr bgcolor='#FFFFFF'>
            <td width='18%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Address</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='81%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$qr_gt_user_data_ans_row['addr1']."</td>
          </tr>";
		  
		   
		  if($qr_gt_user_data_ans_row['membership_name'] != ''){
		 $rsvp_registration_mail_body =$rsvp_registration_mail_body."<tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Membership Name </td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$qr_gt_user_data_ans_row['membership_name']."</td>
		    </tr>";
			}
		  
		 if($qr_gt_user_data_ans_row['membership_code'] != ''){
		  $rsvp_registration_mail_body =$rsvp_registration_mail_body."<tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Membership Code </td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$qr_gt_user_data_ans_row['membership_code']."</td>
		    </tr>";
			}
			
			 if($qr_gt_user_data_ans_row['fone'] != ''){
		 $rsvp_registration_mail_body =$rsvp_registration_mail_body."
		  <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Phone</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$qr_gt_user_data_ans_row['fone']."</td>
		    </tr>";
            }
			
			
			 if($qr_gt_user_data_ans_row['fax'] != ''){ 
		 $rsvp_registration_mail_body =$rsvp_registration_mail_body." <tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Fax</td>
		    <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$qr_gt_user_data_ans_row['fax']."</td>
		    </tr>";
		  
          }
		 
		 
		  
		 
		  
          $rsvp_registration_mail_body = $rsvp_registration_mail_body." <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;<span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>Delegate's  Registration Details :</span></td>
          </tr>
          
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Payment Method </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='81%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$qr_gt_user_data_ans_row['paymode']."</td>
          </tr>
           <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Payment Status </span></td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$qr_gt_user_data_ans_row['pay_status']."</td>
          </tr>
		  
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Category</span></td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$qr_gt_user_data_ans_row['cata']."</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Delegate Type </span></td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$qr_gt_user_data_ans_row['org_reg_type']."</td>
          </tr>		  
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Group Type </span></td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;".$qr_gt_user_data_ans_row['gr_type']."</td>
          </tr>
		  <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Total Delegates</td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span class='content-txt-form'>&nbsp;".$qr_gt_user_data_ans_row['sub_delegates']."   </span></td>
          </tr>
         
           <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;</td>
          </tr>
          <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp;Delegate's Payment Details :</span></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan='3' style='font-family:Verdana; font-size:10px; color:#333333; line-height:17px;'><table width='100%' border='0' align='left' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC'>
          <tr>
            <td height='2' colspan='2' ></td>
          </tr>
          <tr>
            <td width='20%' height='22' align='center' valign='middle' bgcolor='#E1DBBD'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Name</font> </strong></div></td>
            <td width='20%' align='center' valign='middle' bgcolor='#E1DBBD'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Email Id </font></strong></div></td>
            <td width='16%' align='center' valign='middle' bgcolor='#E1DBBD'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Mobile No. </font></strong></div></td>
            <td width='16%' align='center' valign='middle' bgcolor='#E1DBBD'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Designation </font></strong></div></td>       
            <td width='29%' align='center' valign='middle' bgcolor='#E1DBBD'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Category</font></strong></div></td>
            <td width='27%' align='center' valign='middle' bgcolor='#E1DBBD'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='center'><strong><font color='#FFFFFF'>Amount (".$qr_gt_user_data_ans_row['amt_ext'].")</font></strong></div></td>
          </tr>
          <tr>
            <td height='2' colspan='2' bgcolor=''></td>
          </tr>
          <tr>
            <td height='1' colspan='2' ></td>
          </tr>";
		  
		  
		   for($i=1; $i<=$qr_gt_user_data_ans_row['sub_delegates']; $i++)
          {		
		  $rsvp_registration_mail_body = $rsvp_registration_mail_body."<tr bgcolor='#FFFFFF'>
            <td bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;&nbsp;".$qr_gt_user_data_ans_row['title'.$i]." ".$qr_gt_user_data_ans_row['fname'.$i]." ".$qr_gt_user_data_ans_row['lname'.$i]."</td>
            <td bgcolor='#F9F8F2' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;&nbsp;".$qr_gt_user_data_ans_row['email'.$i]."</td>
            <td bgcolor='#F9F8F2' align='left' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$qr_gt_user_data_ans_row['cellno'.$i]."</td>
            <td bgcolor='#F9F8F2' align='left' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$qr_gt_user_data_ans_row['job_title'.$i]."</td>
            <td bgcolor='#F9F8F2' align='left' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;&nbsp;".$qr_gt_user_data_ans_row['cata'.$i]."</td>
            ";
			$rsvp_registration_mail_body = $rsvp_registration_mail_body."
            <td height='22' bgcolor='#F9F8F2' align='right' style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$qr_gt_user_data_ans_row['selection_amt']."&nbsp;&nbsp;</td>";
			
         $rsvp_registration_mail_body = $rsvp_registration_mail_body." </tr>";
          
        
          $rsvp_registration_mail_body = $rsvp_registration_mail_body."<tr bgcolor='#FFFFFF'>
             <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>
             <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
             <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
             <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;' colspan='2'>Selection Amount &nbsp;&nbsp;</td>
            <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'>".$qr_gt_user_data_ans_row['selection_amt']."&nbsp;&nbsp;</div></td>
          </tr>";

		  if( ($qr_gt_user_data_ans_row['admin_discount'] != "") && ($qr_gt_user_data_ans_row['admin_discount'] >0) )
          {
          $rsvp_registration_mail_body = $rsvp_registration_mail_body."
          <tr bgcolor='#FFFFFF'>
              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;' colspan='2'>Admin Discount&nbsp;&nbsp;&nbsp; </td>
            <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$res['admin_discount']."&nbsp;&nbsp;</td>
          </tr>";          
          }
		  
		  if( ($qr_gt_user_data_ans_row['membership_discount'] != "") && ($qr_gt_user_data_ans_row['membership_discount'] >0) )
          {
		  	 $rsvp_registration_mail_body = $rsvp_registration_mail_body."
          <tr bgcolor='#FFFFFF'>
              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;' colspan='2'>Membership Discount&nbsp;&nbsp;&nbsp; </td>
            <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$res['membership_discount']."&nbsp;&nbsp;</td>
          </tr>";   
		  
		  }
		  
          if( ($qr_gt_user_data_ans_row['gr_discount'] != "") && ($qr_gt_user_data_ans_row['gr_discount'] >0) )
          {
          $rsvp_registration_mail_body = $rsvp_registration_mail_body."
          <tr bgcolor='#FFFFFF'>
              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;' colspan='2'>Group Discount&nbsp;&nbsp;&nbsp; </td>
            <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$res['gr_discount']."&nbsp;&nbsp;</td>
          </tr>";          
          }
              
	     if( ($qr_gt_user_data_ans_row['tax'] != "") && ($qr_gt_user_data_ans_row['tax'] >0) )
          {    
			$rsvp_registration_mail_body = $rsvp_registration_mail_body."<tr bgcolor='#FFFFFF'>
              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;' colspan='2'>Service Tax @ 12.36%&nbsp;&nbsp; </td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'><span >".$qr_gt_user_data_ans_row['tax']."</span>&nbsp;&nbsp;</div></td>
          </tr>";
		}  
            $rsvp_registration_mail_body = $rsvp_registration_mail_body." <tr bgcolor='#FFFFFF'>
              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>
              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;' colspan='2'>Total  ".$qr_gt_user_data_ans_row['amt_ext']."&nbsp;&nbsp; </td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'>".$qr_gt_user_data_ans_row['total']."&nbsp;&nbsp;</div></td>
            </tr>";
			
			
			 $rsvp_registration_mail_body = $rsvp_registration_mail_body." <tr bgcolor='#FFFFFF'>
              <td height='22' bgcolor='#F9F8F2' >&nbsp;</td>
              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;</td>
              <td align='right' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;' colspan='2'>Total Amount Payable in INR "; if($qr_gt_user_data_ans_row['amt_ext'] != "Rs."){ $rsvp_registration_mail_body = $rsvp_registration_mail_body."<br/><span style='font-size: 9px; font-family: Verdana, Arial, Helvetica, sans-serif;'>(Including Processing Charges)</span>";} $rsvp_registration_mail_body = $rsvp_registration_mail_body."&nbsp;&nbsp; </td>
              <td align='right' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><div align='right'>".$total_amt."&nbsp;&nbsp;</div></td>
            </tr>"; 
		  
		 }
		  
		  
          
         					
            
			
       
		  
           $rsvp_registration_mail_body =  $rsvp_registration_mail_body."
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
	 
		$rsvp_registration_mail_body = $rsvp_registration_mail_body."<tr>
            <td height='10' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;</td>
          </tr>
      <tr>
        <td colspan='3' style='font-family:Verdana; font-size:10px; color:#333333; line-height:17px;'><table width='100%' border='0' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC'>
          
          
          <tr bgcolor='#FFFFFF'>
            <td  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>";
            
            if( ($res['paymode'] == 'Credit Card') || ($res['paymode'] == 'Debit Card') || ($res['paymode'] == 'i Banking')){
				$rsvp_registration_mail_body = $rsvp_registration_mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                <td width='3%'>&nbsp;</td>
                                <td width='94%'class='content-txt-form'><strong>Note :</strong>Click on 'Next' Below to pay instantly or<br />                                  
                                  <a href='".$EVENT_OL_PAY_ACT_LINK."?id=".$res['tin_no']."' target='_blank'>Click here</a> to activate your online payment process or<br /> 
                                  use below mentioned link<br />
         <a href='".$EVENT_PAY_LINK."' target='_blank'>".$EVENT_PAY_LINK."</a></td>
                                <td width='3%'>&nbsp;</td>
                              </tr>
                            </table>";
			}
		
		if(($res['paymode'] == "Cheque")||($res['paymode'] == "Cheque/DD"))
		{
				$rsvp_registration_mail_body = $rsvp_registration_mail_body."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                <td width='3%'>&nbsp;</td>
                                <td width='94%'class='content-txt-form'><strong>Note :</strong><span style='font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;'>Please send your cheque/DD in favour of &nbsp;                              <strong>".$EVENT_CHEQUE_PAYBLE_AT_NAME." </strong> payable at ".$EVENT_CHEQUE_PAYBLE_AT.".<br /> 
                            Along with the copy of your registration receipt and send to<br />
                            <br />
                            <strong>Address :</strong>".$EVENT_SECRT_ADDR."</span></td>
                                <td width='3%'>&nbsp;</td>
                              </tr>
                            </table>";
			}
			
			
								
							
			if(($res['paymode'] == "Bank Transfer"))
			{
								$rsvp_registration_mail_body  = $rsvp_registration_mail_body ."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='94%'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top'  style='font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;'><strong>Indian Delegates</strong> are requested to Bank Transfer the registration fees to the following account </strong>
      </p>
      <p><strong>Account Name: </strong>BANGALORE IT.BIZ<br />
        <strong>Account Type :</strong> Current Account<br />
        <strong>Account Number :</strong> 2827 201001190<br />
        <strong>Name &amp; Address of Bank :</strong> Canara Bank<br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;K.S.F.C Complex Branch, <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (DP Code No.: 2827) <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bank Address: <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No.1/1, KSFC Bhavan, <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thimmaiah Road , Millers Tank Bed, <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bangalore - 560 052, INDIA<br />
        <br />
        <strong>Contact Person :</strong>Mr. Ghouse Mohiddin (Sr.Manager)<br />
        <strong>Bank email :</strong> <a href='mailto:cb2827@canarabank.com' target='_blank'>cb2827@canarabank.com</a><br />
        <strong>Bank Telephone No. : </strong>080-22371789<br />
        <strong>Bank IFSC Code No. : </strong>CNRB0002827<br />
        <strong>MICR CODE : </strong>560015137
    </td>
  </tr>
  <tr>
    <td height='2' bgcolor='#DADADA'></td>
  </tr>
  <tr>
    <td align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;'><p><br />
      <strong>International Delegates</strong> are requested to Wire Transfer(Bank Transfer) the registration fees to the following account </strong> </p>
      </p>
      <strong>Account Name: </strong>MM ACTIV SCI-TECH COMMUNICATIONS PVT.LTD<br />
      <strong>Account Type :</strong> Current Account<br />
      <strong>Account Number :</strong> 2827 241 000004<br />
      <strong>Name &amp; Address of Bank :</strong> Canara Bank<br />      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;K.S.F.C Complex Branch, <br />      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (DP Code No.: 2827) <br />      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bank Address: <br />      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No.1/1, KSFC Bhavan, <br />      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thimmaiah Road , Millers Tank Bed, <br />      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bangalore - 560 052, INDIA<br />
      <br />
      <strong>Contact Person :</strong>Mr. Ghouse  Mohiddin (Sr.Manager)<br />
      <strong>Bank email :</strong> <a href='mailto:cb2827@canarabank.com' target='_blank'>cb2827@canarabank.com</a><br />
      <strong>Bank Telephone No. : </strong>080-22371789<br />
      <strong>Bank SWIFT Code No. : </strong>CNRBINBBLFD<br /></td>
  </tr>
</table>";
			}
            
            $rsvp_registration_mail_body = $rsvp_registration_mail_body."<table width='100%'  cellspacing='0' cellpadding='1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; border-color:#D0AC9D; border-style:solid' border='1'>
 
  <tr>
    <td height='35' colspan='3' align='center' bgcolor='#174984'><h3><span style='color: #FFF;'>Conference Programme at a Glance</span></h3></td>
  </tr>
  <tr>
    <td width='25%'  align='center' bgcolor='#F79646'><strong><span style='color: #FFF;font-family:Arial, Helvetica, sans-serif; font-size:12px;'>Leadership Day
      <br />Day 1 PROGRAMME<br />
      Tuesday,October 22,2013</span></strong></td>
    <td width='50%'  align='center' bgcolor='#4bacc6'><strong><span style='color: #FFF;font-family:Arial, Helvetica, sans-serif; font-size:12px;'>Knowledge Day
      <br />Day 2 PROGRAMME<br />
      Wednesday,October 23,2013</span></strong></td>
    <td width='25%' align='center' bgcolor='#9bbb59'><strong><span style='color: #FFF;font-family:Arial, Helvetica, sans-serif; font-size:12px;'>Business Day
      <br />Day 3 PROGRAMME<br />
      Thursday, October 24, 2013</span></strong></td>
  </tr>
  <tr>
    <td align='left' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td height='50' align='center' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p>
          <strong>Exhibition Inauguration</strong><br>
          03.30 pm - 04.00 pm        <br />
          (Magadh)        </p></td>
      </tr>
      <tr>
        <td height='50' align='center' bgcolor='#fde4d0' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p>
          <strong> Main Inauguration</strong><br>
          04.00 pm - 05.15 pm        <br />
          (Kalinga)        </p></td>
      </tr>
      <tr>
        <td height='50' align='center' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p>
          <strong> Keynote Address </strong><br>
          05.15 pm - 06.45 pm        <br />
          (Kalinga)        </p></td>
      </tr>
      <tr>
        <td height='50' align='center' bgcolor='#fde4d0' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>CEO Conclave by NASSCOM (only by Invitation)</strong><br>
          07.00 pm - 08.00 pm        <br />
          (Grand Ball Room)        </p></td>
      </tr>
      <tr>
        <td height='50' align='center' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p>
          <strong> Networking Dinner</strong><br>
          08.00 pm Onwards        </p></td>
      </tr>
      <tr></tr>
    </table></td>
    <td align='left' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td align='center' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'></td>
      </tr>
      <tr>
        <td align='center' valign='top'><table width='100%' border='0' cellspacing='1' cellpadding='1' style='border-color:#4bacc6;'>
          <tr>
            <td colspan='2'  align='center' valign='top' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Closed Door Round Table on GIC Acceleration by NASSCOM</strong><br />08.30 am - 09.45 am<br />
              (Lalit 3)</td>
          </tr>
          <tr>
            <td colspan='2'  align='center' valign='top' bgcolor='#D2EAF1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>IT Secretaries Meet - The Future of e-Gov and m-Gov : Sharing &amp; Learning from Each Other</strong><br />
10.00 am - 11.30 am <br />
(Grand Ball Room)</strong></td>
            </tr>
          <tr>
            <td width='52%'  align='center' valign='top' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>ICT Track I by AMCHAM & NASSCOM</strong><br />
(Lalit 1&amp;2)</td>
            <td width='48%'  align='center' valign='top' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Electronics Track II by IESA</strong><br />
(Grand Ball Room)</td>
          </tr>
          <tr>
            <td rowspan='2'  align='center' valign='top' bgcolor='#D2EAF1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>Session 1: <br />
              </strong>11:30 am - 01:30 pm<strong><br />
              Bangalore: Global R&amp;D Power House<br />&nbsp;-&nbsp;The Way Forward</strong><br />
              <strong>By AMCHAM</strong><br>
              <br />
              <br>
              <br>
            </p></td>
            <td height='39'  align='center' valign='middle' bgcolor='#D2EAF1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>Session 1:<br />
</strong>11.30 am - 12.30 pm<strong><br />
              ESDM Landscape&nbsp;-&nbsp;Making India Self Reliant</strong><br>
            </p>
              </td>
          </tr>
          <tr>
            <td  align='center' valign='middle' bgcolor='#D2EAF1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>Session 2: <br />
              </strong>12.30 pm - 01.30 pm<strong><br />              
              Value Drivers for Electronic Manufacturing</strong><br>
            </p>
             </td>
            </tr>
          <tr>
            <td colspan='2'  align='center' valign='top' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>Networking Lunch</strong><br>
              01.30 pm - 02.30 pm</p>
              </td>
            </tr>
          <tr>
            <td  align='center' valign='top' bgcolor='#D2EAF1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Session 2:<br />
              </strong>02.30 pm - 03.30 pm<strong><br /> 
              Digital Analytics&nbsp;-&nbsp;<br />
              Is it a paradigm shift for Marketing Analytics?<br />
              What does it mean for Indian Service Providers?<br />
              By NASSCOM</strong><br></td>
            <td  align='center' valign='middle' bgcolor='#D2EAF1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>Session 3: <br />
              </strong>02.30 pm - 03.00 pm<strong><br />              
              Lead Talk on Strategic Electronics</strong><br>
            </p>
              <p>&nbsp;</p></td>
            </tr>
          <tr>
            <td  align='center' valign='middle' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Session 3: <br />
              </strong>03.30 pm - 04.30 pm<strong><br />              
              Is Big Data Driving Product/Technology Innovation?</strong><br />
              <strong>By NASSCOM</strong><br></td>
            <td  align='center' valign='top' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Session 4: <br />
              </strong>03.00 pm - 04.00 pm<strong><br />
              Discussion on Delivering a full A&amp;D Electronics System out of India</strong><br></td>
          </tr>
          <tr>
            <td  align='center' valign='top' bgcolor='#D2EAF1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Tea Break<br />
              </strong>04:30 pm - 05.00 pm</td>
            <td  align='center' valign='top' bgcolor='#D2EAF1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Tea Break</strong><br />
              04.00 pm - 04.30 pm</td>
          </tr>
          <tr>
            <td  align='center' valign='top' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><br />
              <strong>B2B Meetings </strong><br />
              <br />
              05.00 pm - 05.30 pm             </td>
            <td  align='center' valign='top' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Session 5:<br />
              </strong>04.30 - 05.30 pm<strong><br />              
              Panel Discussion on MNC Story&nbsp;-&nbsp;<br />
              Expectations from Indian Ecosystem</strong><br></td>
            </tr>
          <tr>
            <td colspan='2'  align='center' valign='top' bgcolor='#D2EAF1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>IT Export Awards Function</strong><br>
              06.00 pm onwards<br />
              (Kalinga)</td>
          </tr>
          </table>
          <div style='vertical-align:middle;font-family:Arial, Helvetica, sans-serif; font-size:12px;'></div></td>
      </tr>
    </table></td>
    <td align='left' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td height='50' align='center' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p> <strong>YESSS for Start-Ups</strong><br />
          10.30 am to 01.30 pm<br />
          (Lalit 1&amp;2)        </p></td>
      </tr>
      <tr>
        <td height='50' align='center' bgcolor='#e6eed5' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p>
            <strong>Round Table on Skill Development<br />
          by NASSCOM </strong><br />
          10.30 am - 12.00 noon<br />          
          (Glass Room VI)</p></td>
      </tr>
      <tr>
        <td align='center' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p>&nbsp;</p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan='3' align='left' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='2%'>&nbsp;</td>
        <td width='96%'><strong>Entitlements: </strong></td>
        <td width='2%'>&nbsp;</td>
      </tr>
      <tr>
        <td height='5'></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;1.&nbsp;Access to the sessions of the registered category<br />
            &nbsp;2.&nbsp;Access to InterlinX Partnering Tool for scheduling B2B meetings<br />
            &nbsp;3.&nbsp;Access to visit Tradeshow</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    </tr>
 
                                </table>";
			
            
$rsvp_registration_mail_body  = $rsvp_registration_mail_body ."</td>
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
                      <td style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>  Tel: ".$MMACTIV_TEL_NO."</span></td>
                    </tr>
                    <tr>
                      <td style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #666666; font-size: 11px; font-weight: bold;'>Service Tax No. : ".$MMACTIV_SERVICE_TAX_NO."</td>
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
</html>
</body>
</html>";

?>
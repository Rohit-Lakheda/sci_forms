 <?php 
	
	$emler_str_pg_resp="<table width='100%'>

<tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'><span style='font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold;'>&nbsp;Payment Gateway Response:</span></td>
  </tr>
          
          <tr bgcolor='#FFFFFF'>
            <td width='23%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Order Id </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td width='75%' height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>".$OrderId."</td>
          </tr>";
		  
		if(!empty($tracking_id)) {
		  $emler_str_pg_resp.="<tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Tracking Id </td>
		    <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 12px;'>".$tracking_id."</span></td>
  </tr>";
}
		  $emler_str_pg_resp.="<tr bgcolor='#FFFFFF'>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Bank Reference Id </td>
		    <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
		    <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 12px;'>".$bank_ref_no."</span></td>
  </tr>
		  
		  <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Payment Status </td>
            <td height='22' align='center' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='middle' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 12px;'>".$order_status."</span></td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Payment Mode Used </td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 12px;'>".$payment_mode."</span></td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>&nbsp;Transaction Amount</td>
            <td height='22' align='center' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'>:</td>
            <td height='22' align='left' valign='top' bgcolor='#F9F8F2'  style='font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;'><span style='font-size: 12px;'>".$currency." ".$Amount." </span></td>
          </tr>
          

		  
		  <tr>
            <td height='22' colspan='3' align='left' valign='middle' bgcolor='#F9F8F2'>&nbsp;</td>
          </tr>
</table>";		  
?>
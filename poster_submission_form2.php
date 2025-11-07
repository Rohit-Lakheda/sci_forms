<?php 
	
	require("includes/form_constants_both.php");
	
	$temp_name = "";
	$temp_name =  @$_GET['nm'];
	if($temp_name == "")
	{
		$temp_name = " Sir / Madam "; 
	}

	
?>

<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $EVENT_NAME." ".$EVENT_YEAR;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>

<body >

<?php include("includes/header.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center" valign="bottom">
    <td height="30"><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/green_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/green_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /></td>
  </tr>
</table>
<table width="100%">
<tr align="left" valign="middle">
<td>

<table width="675" border="0" cellpadding="0" cellspacing="0" class="border_style1" align="center">
  <tr align="left" valign="top">
    <td width="601" height="35">
      <div class="style2" style="margin-left:20px;"><strong class="small_button"></strong><span class="style2" style="margin-left:20px;"><?php echo $EVENT_NAME." ".$EVENT_YEAR;?> : Poster Presentation Form </span></div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
    <td height="349" colspan="2">
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20">&nbsp;</td>
            <td width="613" height="16">&nbsp;</td>
          </tr>
          <tr>
            <td valign="middle">&nbsp;</td>
            <td height="53" valign="middle" class="blue_text_no_padding">
			<form  method="post" enctype="multipart/form-data" name="form1" id="form1"  >
                                                <table width="591" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td align="left" valign="top" bgcolor="#F7F7F7" class="style90">&nbsp;</td>
                                                    <td colspan="3" align="left" valign="top" bgcolor="#F7F7F7" class="style84">&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td width="14" align="left" valign="top" bgcolor="#F7F7F7" class="style90">&nbsp;</td>
                                                    <td colspan="3" align="left" valign="top" bgcolor="#F7F7F7" class="style84">Dear <?php echo $temp_name;?>,</td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" bgcolor="#F7F7F7">&nbsp;</td>
                                                     <td colspan="3" align="left" valign="top" bgcolor="#F7F7F7">&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" bgcolor="#F7F7F7">&nbsp;</td>
                                                    <td colspan="3" align="left" valign="top" bgcolor="#F7F7F7" class="style91">Thank you for submitting your 'Poster Application'. Our executive will contact you soon. </td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" bgcolor="#F7F7F7">&nbsp;</td>
                                                    <td colspan="3" align="left" valign="top" bgcolor="#F7F7F7">&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" bgcolor="#F7F7F7">&nbsp;</td>
                                                    <td colspan="3" align="left" valign="top" bgcolor="#F7F7F7" class="style84">Best Regards, </td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" bgcolor="#F7F7F7">&nbsp;</td>
                                                    <td width="469" align="left" valign="top" bgcolor="#F7F7F7" class="link31">&nbsp;</td>
                                                    <td width="4" align="center" valign="top" bgcolor="#F7F7F7" class="link31">&nbsp;</td>
                                                    <td width="104" align="left" valign="top" bgcolor="#F7F7F7" class="link31">&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" bgcolor="#F7F7F7">&nbsp;</td>
                                                    <td align="left" valign="top" bgcolor="#F7F7F7" class="style84">
													<?php echo $EVENT_NAME." ".$EVENT_YEAR;?><br />
<?php echo $EVENT_SECRT_ADDR; ?><br />
<br />
<span class="style2">For any additional information or clarification, please email to 
<?php echo $PSTR_CONCT_PERSON; ?> at <a href="mailto:<?php echo $PSTR_EMAIL_ID; ?>" target="_blank"><?php echo $PSTR_EMAIL_ID; ?></a>&nbsp;&nbsp;/&nbsp;<a href="mailto:<?php echo $PSTR_EMAIL_ID_2; ?>" target="_blank"><?php echo $PSTR_EMAIL_ID_2; ?></a>
 Tel: <?php echo $PSTR_CONTACT_NO; ?></span></td>
                                                    <td align="center" valign="top" bgcolor="#F7F7F7" class="link31">&nbsp;</td>
                                                    <td align="left" valign="top" bgcolor="#F7F7F7" class="link31">&nbsp;</td>
                                                  </tr>
                                                </table>
                        </form>			</td>
              </tr>
            </table>              </td>
          </tr>		   

        </table></td>
        </tr>
      </table>
	  
	  
	  </td>
  </tr>
  </table>

</td>
</tr>
</table>
<?php include("includes/footer.php");?>


</body>
</html>
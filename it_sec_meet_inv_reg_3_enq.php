S<?php  

	$nm = @$_GET['nm'];
	
	$emler = @$_POST['enq_emler'];
	if($emler ==""){
		$emler = @$_GET['enq_emler'];
	} 
 
	
	if($nm == ""){
		$nm="Sir/Madam";
	}
	$name = $nm;
	$ceo_location = @$_REQUEST['ceo_city'];
	
	require "includes/form_constants.php";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $EVENT_NAME;?> </title>
<link href="css/style.css" rel="stylesheet" type="text/css" />



<style type="text/css">
<!--
body {

}
-->
</style></head>

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

<table width="675" border="0" cellpadding="0" cellspacing="0" class="border_style1" style=" margin-top:20px; margin-left:400px;">
  <tr align="left" valign="top">
    <td width="601" height="35">
      <div class="style2" style="margin-left:20px;"><strong class="small_button">&nbsp;<?php echo $EVENT_NAME;?> <?php echo $EVENT_YEAR;?>:</strong><strong>Invitation to attend IT Secretaries Meet</strong></div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
    <td height="513" colspan="2">
	
	
<form id="form1" name="form1" method="post" >
	
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="631" height="16"></td>
          </tr>
          <tr>
            <td height="53" valign="middle"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td  align="left" valign="top" class="blue_text_no_padding">
     
		
		  <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
            
           
            <tr>
              <td valign='top' class="blue_text_no_padding" style="padding-left:5px;" >                
             
               
                
                </td>
            </tr>
			 <tr>
              <td valign='top' style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;'></td>
            </tr>
          </table>
		  <table width='100%'  cellspacing='0' cellpadding='0'>
            <tr>
              <td width='101%' height='1' colspan='2' > <div style="margin-left:5px;"><?php 
				echo $IT_SEC_MEET_INV_REG_RECIPIENTS_USER_MSG;
				?></div></td>
            </tr>
          </table>
	

</td>
                      <td width="12" align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                      </tr>
                </table></td>
              </tr>
            </table>              </td>
          </tr>
          
        </table></td>
        </tr>
      </table>
	  </form>
	  
	  
	  </td>
  </tr>
  </table>

</td>
</tr>
</table>
<?php include("includes/footer.php");?>


</body>
</html>
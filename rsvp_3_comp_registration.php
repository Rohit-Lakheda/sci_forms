<?php 
	$nm = @$_GET['nm']; 
	
	$emler = @$_POST['enq_emler'];
	if($emler ==""){
		$emler = @$_GET['enq_emler'];
	}

	
	if($nm == ""){
		$nm="Sir/Madam";
	}
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
      <div class="style2" style="margin-left:20px;"><strong class="small_button">&nbsp;Hubli , October 08, 2013</strong></div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
    <td height="513" colspan="2">
	
	
<form id="form1" name="form1" method="post" onsubmit="return validate_rsvp()" action="rsvp_2.php">
	
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
                      <td  align="left" valign="top" class="blue_text_no_padding"><strong>Dear <?php echo $nm; ?>,</strong><br />
                         
                     <?php if($emler!="rsvp"){
					 ?>
					 
                        Thanks for your enquiry. Event secretariat will  call you, however if you wish to reach us please call us on +91.80.41131912 / 13<br />
  <br />
Thank You,<br />
<br />
<?php echo $EVENT_NAME;?> Secretariat<br />
#9, UNI Building, 1st Floor,<br /> 
Thimmaiah Road, Millers Tank Bed, 
<br />
Vasanthnagar, Bangalore - 560 052 
<br />
Tel: +91 80 4113 1912 / 13
<br />
Fax: +91 80 4113 1914 
<br />
Email: 
<a href="mailto:<?php echo $EVENT_ENQUIRY_EMAIL;?>" ><?php echo $EVENT_ENQUIRY_EMAIL;?>  </a><br />
	<?php 
	}
	else
	{
	?>
	
	<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='600' align='center' valign='middle'>&nbsp;</td>
          </tr>
        </table>
		
		  <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
            
           
            <tr>
              <td valign='top' class="blue_text_no_padding" style="padding-left:5px;" >                
                Greetings from  <?php echo $EVENT_NAME;?> <?php echo $EVENT_YEAR;?> !!<br><br />
                <?php 
				echo $RSVP_COMP_REG_RECIPIENTS_USER_MSG;
				?>
                
                </td>
            </tr>
			 <tr>
              <td valign='top' style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;'></td>
            </tr>
          </table>
		  <table width='100%'  cellspacing='0' cellpadding='0'>
            <tr>
              <td width='101%' height='1' colspan='2'>&nbsp;</td>
            </tr>
          </table>
	<?php 
	}
	?>

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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1511695-63', 'bangaloreite.biz');
  ga('send', 'pageview');

</script>


</body>
</html>
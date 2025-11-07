<?php session_start();   
	
	if( (is_null(trim($_SESSION["vercode_rsvp_reg"]))) || ($_SESSION["vercode_rsvp_reg"]=='') )  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Enter Verification Code.');</script>";
		echo "<script language='javascript'>window.location = 'pay_registrations.php';</script>";
		exit;
	}
		 
	$reg_id = @$_SESSION["vercode_rsvp_reg"];	
	
	$nm = @$_GET['nm']; 
	
	$emler = @$_POST['enq_emler'];
	if($emler ==""){
		$emler = @$_GET['enq_emler'];
	}

	
	if($nm == ""){
		$nm="Sir/Madam";
	}
	require "includes/form_constants.php";
	require "dbcon_open.php"; 
	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
	$res = $qr_gt_user_data_ans_row;
	
	$total_amt = 0;
	
	if($qr_gt_user_data_ans_row['amt_ext'] != "Rs.")
	{
		$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];	
	}
	else
	{
		$total_amt = $qr_gt_user_data_ans_row['total'];		
	}		
	require "pay_registrations_emailer.php";
	
	//session_destroy();
	
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
      <div class="style2" style="margin-left:20px;"><span class="style2" style="margin-left:20px;"><span class="style2" style="margin-left:20px;"><?php echo $EVENT_NAME; ?></span> :&nbsp;Online Registration Form</span></div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
    <td height="513" colspan="2">
	
	
<form id="form1" name="form1" method="post" onsubmit="return validate_rsvp()" action="<?php echo $EVENT_OL_PAY_ACT_LINK."?id=".$res['tin_no'];?>">
	
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
                      <td  align="left" valign="top" class="blue_text_no_padding"><br />
                         
                     
	
	<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='600' align='center' valign='middle'><?php echo $rsvp_registration_mail_body; ?></td>
          </tr>
        </table>
		
		  <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
            
           
            <tr>
              <td valign='top' class="blue_text_no_padding" style="padding-left:5px;" >&nbsp;</td>
            </tr>
            <tr>
              <td valign='top' class="blue_text_no_padding" style="padding-left:5px;" >
   			<?php  if( ($res['paymode'] == 'Credit Card') || ($res['paymode'] == 'Debit Card') || ($res['paymode'] == 'i Banking')){?>
              <table width="596" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="283" align="left"><input name="tin_id" type="hidden" id="tin_id" value="<?php echo $res['tin_no'];?>" /></td>
                  <td width="313" align="right"><input name="Submit" id="Submit" type="submit" class="blue_text"  style="background-color:#dadada;" value="Next&gt;&gt;" width="118" height="28" /></td>
                </tr>
              </table>
              <?php 
			  }
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
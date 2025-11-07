<?php 
 
require "includes/form_constants.php";

require "ceo_reg_captcha.php";
$page = basename($_SERVER['SCRIPT_NAME']); 

//$ceo_reg_city = $_REQUEST['ceo_reg_city'];
$ceo_reg_city = "Bangalore";

$emler = @$_POST['enq_emler'];
if($emler ==""){
	$emler = @$_GET['enq_emler'];
}

$participant1 = @$_POST['pr_1'];
$participant2 = @$_POST['pr_2'];
$participant3 = @$_POST['pr_3'];
$participant4 = @$_POST['pr_4'];
$participant5 = @$_POST['pr_5'];
$participant6 = @$_POST['pr_6'];
$participant = "";
	if(@$_POST['pr_1'] != '')
	{
		$participant = $participant.$_POST['pr_1'].", ";
	}
	if(@$_POST['pr_2'] != '')
	{
		$participant = $participant.$_POST['pr_2'].", ";
	}
	if(@$_POST['pr_3'] != '')
	{
		$participant = $participant.$_POST['pr_3'].", ";
	}
	if(@$_POST['pr_4'] != '')
	{
		$participant = $participant.$_POST['pr_4'].", ";
	}
	if(@$_POST['pr_5'] != '')
	{
		$participant = $participant.$_POST['pr_5'].", ";
	}
	if(@$_POST['pr_6'] != '')
	{
		$participant = $participant.$_POST['pr_6'];
	}
	if($participant == "")
	{
		$participant = "Delegate";
	}
	if($emler == "enq_email") 
	{
		$em = "emailer_request";
	}
	else
	{
		$em = "no_request";
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $EVENT_NAME;?> </title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
	function validate_ceo()
	{
			if(document.getElementById("name").value == "")
			{
				alert("Please Enter Name.");
				document.getElementById("name").focus();
				return false;
			}
			
			 
			if(document.getElementById("org").value == "")
			{
				alert("Please Enter Organisation Name.");
				document.getElementById("org").focus();
				return false;
			}
			
			if(document.getElementById("desig").value == "")
			{
				alert("Please Enter Designation.");
				document.getElementById("desig").focus();
				return false;
			}
			
			
			if(document.getElementById("email").value == "")
			{
				alert("Please Enter Email-Id.");
				document.getElementById("email").focus();
				return false;
			}
			else if(document.getElementById("email").value != "") 
			{
				var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				var toArr= document.getElementById("email").value.split(","); 			//split into array
				for (var i=0;i<toArr.length;i++) 				    					//loop array to validate correct address
				{
					if ( !toArr[i].match(reg) ) 										//if not match, alert and stop loop
					{	
						alert("Invalid email address \n"+toArr[i]);
						document.getElementById("email").focus();
						return false;
					}
				}
			}
			
			if(document.getElementById("mob").value == "")
			{
				alert("Please Enter Contact Number");
				document.getElementById("mob").focus();
				return false;
			}

			/*
			var pr_cnt_nt_selected = 0;
			for(var pr_cnt=1;pr_cnt<=5;pr_cnt++){
				
				if(document.getElementById("pr_"+pr_cnt).checked == false){
					pr_cnt_nt_selected++;
				}
			}
			if(pr_cnt_nt_selected >= 5){
				alert("Please Select at least one Checkbox ");
				document.getElementById("pr_1").focus();
				return false;
			}
			*/
			
			//if(document.getElementById("comment").value == "")
		//	{
				//alert("Please Enter Comment");
			//	document.getElementById("comment").focus();
				//return false;
			//}			
			
			if(document.getElementById("vercode").value == "")
			{
				alert("Please fill the characters you see in image.");
				document.getElementById("vercode").focus();
				return false;
			}
			else if(document.getElementById("vercode").value != "")
			{
				compstr = document.getElementById("test").value;
				if(document.getElementById("vercode").value != compstr)
				{
					alert("Please fill correct characters you see in image.");
					document.getElementById("vercode").value = "";
					document.getElementById("vercode").focus();
					return false;
				}	
			}
			
			return true;
	}
	
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1511695-47']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

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
    <td height="30"><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/purpal_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/gray_round.png" width="10" height="16" /><img src="images/dot_line.jpg" width="40" height="16" /></td>
  </tr>
</table> 

<table width="100%">
<tr align="left" valign="middle">
<td>
 <table width="675" border="0" cellpadding="0" cellspacing="0" class="border_style1" style=" margin-top:20px;" align="center">
  <tr align="left" valign="top">
    <td width="601" height="35">
      <div class="style2" style="margin-left:20px;"><strong class="small_button"><?php echo $EVENT_NAME;?> : </strong><strong>Expression of Interest to attend CEO Conclave</strong></div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
    <td height="513" colspan="2">
	
	
<form id="form1" name="form1" method="post" onsubmit="return validate_ceo()" action="ceo_reg_2.php?enq_emler=<?php echo $emler?>">
	
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="631" height="16"><input type="hidden" name="ceo_reg_city" id="ceo_reg_city" value="<?php echo $ceo_reg_city;?>" /></td>
          </tr>
          <tr>
            <td height="53" valign="middle"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="173" align="left" valign="top" class="blue_text_no_padding"><span class="sitemap-txt">&nbsp;Full Name&nbsp;*</span></td>
                      <td width="12" align="center" valign="top" class="blue_text_no_padding">:</td>
                      <td width="337" align="left" valign="top"><span class="sitemap-txt">
                        <input name="name" type="text" id="name" size="40" maxlength="80" />
                      </span></td>
                      <td width="73" align="left" valign="top">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table>              </td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td height="53"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="173" align="left" valign="top" class="blue_text_no_padding"><span class="sitemap-txt">&nbsp;Organisation&nbsp;*</span></td>
                      <td width="14" align="center" valign="top" class="blue_text_no_padding">:</td>
                      <td width="338" align="left" valign="top"><span class="sitemap-txt">
                        <input name="org" type="text" id="org" size="40" maxlength="80" />
                      </span></td>
                      <td width="70" align="left" valign="top">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
	
		 

			 
			 
		   <tr>
            <td height="53" valign="middle"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="174" align="left" valign="top" class="blue_text_no_padding"><span class="sitemap-txt">&nbsp;Designation&nbsp;*</span></td>
                    <td width="15" align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td width="338" align="left" valign="top"><span class="sitemap-txt">
                      <input name="desig" type="text" id="desig" size="40" maxlength="80" />
                    </span></td>
                    <td width="68" align="left" valign="top">&nbsp;</td>
                  </tr>
                </table></td>
                </tr>
            </table></td>
          </tr>
		  
		  
          <tr>
            <td>
			<div id="div_group_user" style="display:none;">
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="63" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="174" align="left" valign="top" class="blue_text_no_padding">&nbsp;No. of Delegates * </td>
                      <td width="29" align="center" valign="top" class="blue_text_no_padding">:</td>
                      <td width="392" align="left" valign="top"><input name="total_dele" type="text" class="border_style1_1" id="total_dele" size="50" maxlength="1"  onkeyup="check_num(event,total_dele)"/></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                      <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                      <td align="left" valign="top" class="black_text_no_padding_small">min 2 and max. 7 delegates are allowded </td>
                    </tr>
                </table></td>
              </tr>
            </table>
			</div>			</td>
          </tr>
		 

          <tr>
            <td height="8"></td>
          </tr>
          <tr>
            <td height="62" align="center"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="29%"></td>
                <td width="3%" height="10"></td>
                <td width="43%"></td>
                <td width="25%"></td>
              </tr>
              <tr>
                <td align="left" valign="top"><span class="blue_text_no_padding"><span class="sitemap-txt">&nbsp;Email Id &nbsp;*</span></span></td>
                <td align="center"><span class="blue_text_no_padding">:</span></td>
                <td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="344" align="left" valign="top" class="blue_text_no_padding"><span class="sitemap-txt">
                        <input name="email" type="text" id="email" size="40" maxlength="80" />
                      </span></td>
                      <td width="67" align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="10"></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table></td>
          </tr>
         <tr>
            <td height="8"></td>
          </tr>
          <tr>
            <td height="62" align="center"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="29%"></td>
                <td width="3%" height="10"></td>
                <td width="43%"></td>
                <td width="25%"></td>
              </tr>
              
              <tr>
                <td align="left" valign="top"><span class="blue_text_no_padding"><span class="sitemap-txt">&nbsp;Mobile/Telephone &nbsp;Number&nbsp;*</span></span></td>
                <td align="center"><span class="blue_text_no_padding">:</span></td>
                <td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="346" align="left" valign="top" class="blue_text_no_padding"><span class="sitemap-txt">
                        <input name="mob" type="text" class="content-txt-without-alignment" id="mob" size="40" maxlength="20" />
                      </span></td>
                      <td width="65" align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="10"></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table></td>
          </tr>
         <tr>
           <td height="8"></td>
         </tr>
		   
          <tr>
            <td height="50" ><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="44"><table border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="174" align="left" valign="top" class="blue_text_no_padding">&nbsp;Comment  </td>
                    <td width="16" align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td width="263" align="left" valign="top"><span class="content-txt-form">
                      <textarea name="comment" id="comment"></textarea>
                      </span></td>
                    <td width="83" align="center" valign="middle"  style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;">&nbsp;</td>
                    <td width="59" align="left" valign="top">&nbsp;</td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
          </tr>          
          
           <tr>
             <td height="50" ><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
               <tr>
                 <td width="100%" height="44"><table border="0" align="center" cellpadding="0" cellspacing="0">
                     <tr>
                       <td width="174" align="left" valign="top" class="blue_text_no_padding">&nbsp;Enter Verification Code * </td>
                       <td width="17" align="center" valign="top" class="blue_text_no_padding">:</td>
                       <td width="168" align="left" valign="top"><span class="content-txt-form">
                         <input name="vercode" id="vercode" type="text" class="style56" />
                       </span></td>
                       <td width="113" align="center" valign="middle" background="images/verify_img_bg.JPG" style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;"><?php echo $text; ?></td>
                       <td width="123" align="left" valign="top">&nbsp;<span style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;"><span class="content-txt-form">
                         <input name="test" type="hidden" id="test" value="<?php echo $text; ?>" />
                       </span></span></td>
                     </tr>
                 </table></td>
               </tr>
             </table></td>
           </tr>
		   
           <tr>
            <td height="23" class="blue_text_normal"><span class="sitemap-txt">&nbsp;

            </span></td>
          </tr>
          
          <tr>
            <td align="center"><span class="sitemap-txt">
              <input type="submit" name="Submit" value="Submit" />
            </span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
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

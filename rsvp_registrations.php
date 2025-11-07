<?php 
 
//require "includes/form_constants.php";

//require "rsvp_reg_comp_captcha.php";

//$cata_type = $_REQUEST["cata_type"];
//$assoc_nm = $_REQUEST["assoc_nm"];

//if($cata_type !="C5O09M6P"){
		
		
	
//}

$page = basename($_SERVER['SCRIPT_NAME']); 

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
	function validate_rsvp_registrations()
	{
			if(document.getElementById("title1").value == "")
			{
				alert("Please Enter Title.");
				document.getElementById("title1").focus();
				return false;
			}
			
			if(document.getElementById("fname1").value == "")
			{
				alert("Please Enter First Name.");
				document.getElementById("fname1").focus();
				return false;
			}
			
			if(document.getElementById("lname1").value == "")
			{
				alert("Please Enter Last Name.");
				document.getElementById("lname1").focus();
				return false;
			}
			
			<?php if($cata_type!= ""){?>
			
			if( (document.getElementById("cata1").checked == false) && (document.getElementById("cata2").checked == false) && (document.getElementById("cata3").checked == false) && (document.getElementById("cata4").checked == false) ){
				
				alert("Please select category.");
				document.getElementById("cata1").focus();
				return false;
			}
			
			<?php } ?>
			
			 
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
			
			if(document.getElementById("address").value == "")
			{
				alert("Please Enter Address.");
				document.getElementById("address").focus();
				return false;
			}
			
			if(document.getElementById("mob").value == "")
			{
				alert("Please Enter Contact Number");
				document.getElementById("mob").focus();
				return false;
			}

			
			<?php if($cata_type == ""){ ?>
			
			var pr_cnt_nt_selected = 0;
			for(var pr_cnt=1;pr_cnt<=4;pr_cnt++){
				
				if(document.getElementById("reg_day_"+pr_cnt).checked == false){
					pr_cnt_nt_selected++;
				}
			}
			if(pr_cnt_nt_selected >= 4){
				alert("Please Select at least one day to attend ");
				document.getElementById("reg_day_1").focus();
				return false;
			}
			
			<?php } ?>
			
			
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
.white {	color: #FFF;
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
      <div class="style2" style="margin-left:20px;"><span class="style2" style="margin-left:20px;"><?php echo $EVENT_NAME; ?></span> : <strong class="small_button">Complimentary</strong> Online Registration Form</div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
    <td height="513" colspan="2">
	
	
<form id="form1" name="form1" method="post" onsubmit="return validate_rsvp_registrations()" action="rsvp_2_registrations.php?enq_emler=<?php echo $emler?>&cata_type=<?php echo $cata_type;?>&assoc_nm=<?php echo $assoc_nm;?>">
	
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
                      <td width="173" align="left" valign="top" class="blue_text_no_padding"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="left" valign="top"  height="10"></td>
                        </tr>
                        <tr>
                            <td width="173" align="left" valign="top" class="blue_text_no_padding"><span class="sitemap-txt">&nbsp;&nbsp;Full Name&nbsp;*</span></td>
                            </tr>
                      </table></td>
                      <td width="14" align="center" valign="middle" class="blue_text_no_padding">:</td>
                      <td width="408" align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td height="10" align="left" valign="top"></td>
                          <td align="left" valign="top"></td>
                          <td align="left" valign="top"></td>
                          </tr>
                        <tr>
                          <td width="76" align="left" valign="top"><select name="title1" class="text" id="title1">
                            <?php 
						if($qr_chk_same_jid_peml_temp_ans_row['title'] != ""){
						?>
                            <option value="<?php echo $qr_chk_same_jid_peml_temp_ans_row['title']; ?>" selected="selected" ><?php echo $qr_chk_same_jid_peml_temp_ans_row['title']; ?></option>
                            <?php
						}
						else
						{
						?>
                            <option value="" selected="selected" >Select</option>
                            <?php 
						}
						?>
                            <option value="Mr." >Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Dr.">Dr.</option>
                            <option value="Prof.">Prof.</option>
                          </select></td>
                          <td width="137" align="left" valign="top"><input name="fname1" type="text" id="fname1" size="15" maxlength="30" onkeyup="return check_char(event,'fname')"  value="<?php echo $qr_chk_same_jid_peml_temp_ans_row['fname'];?>"  /></td>
                          <td width="151" align="left" valign="top"><input name="lname1" type="text" id="lname1" size="15" maxlength="30" onkeyup="return check_char(event,'lname')"  value="<?php echo $qr_chk_same_jid_peml_temp_ans_row['lname'];?>" /></td>
                          </tr>
                        <tr>
                          <td align="center" valign="top" class="black_text_no_padding_small">Title <span class="red_asteric">*</span>&nbsp;&nbsp;</td>
                          <td align="center" valign="top" class="black_text_no_padding_small">First Name <span class="red_asteric">*</span></td>
                          <td align="center" valign="top" class="black_text_no_padding_small">Last Name <span class="red_asteric">*</span></td>
                          </tr>
                      </table></td>
                      </tr>
                </table></td>
              </tr>
            </table>              </td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
          <?php if($cata_type!=""){?>
          <tr>
            <td height="10"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="96%"  cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" border="1">
                  <tr bgcolor="#FFFFEC">
                    <td width="310" height="43" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#B6CAF8" class="black_text_no_padding_13px" ><strong>Category</strong></td>
                    <td width="262" align="center" valign="middle" bgcolor="#B6CAF8" class="black_text_no_padding_13px"><strong>Select</strong></td>
                  </tr>
                  <tr bgcolor="#FFFFEC">
                    <td height="35" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >&nbsp;Exhibitor</td>
                    <td align="center" valign="middle" bgcolor="#DDDDDD" class="black_text_no_padding_13px" ><input name="cata" type="radio" class="style56" value="Complimentary Exhibitors Delegate" id="cata1" onclick="show_div_user_grp_type()" <?php if($assoc_nm != ""){?> disabled="disabled" <?php } ?> /></td>
                  </tr>
                  <tr bgcolor="#FFFFEC">
                    <td height="35" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >Sponsor</td>
                    <td align="center" valign="middle" bgcolor="#DDDDDD" class="black_text_no_padding_13px" ><input name="cata" type="radio" class="style56" value="Complimentary Sponsor Delegate" id="cata2" onclick="show_div_user_grp_type()"  <?php if($assoc_nm != ""){?> disabled="disabled" <?php } ?> /></td>
                  </tr>
                  <tr bgcolor="#FFFFEC">
                    <td height="35" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >Speaker</td>
                    <td align="center" valign="middle" bgcolor="#DDDDDD" class="black_text_no_padding_13px" ><input name="cata" type="radio" class="style56" value="Complimentary Speaker Delegate" id="cata3" onclick="show_div_user_grp_type()"  <?php if($assoc_nm != ""){?> disabled="disabled" <?php } ?> /></td>
                  </tr>
                  <tr bgcolor="#FFFFEC">
                    <td height="35" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >Invitee <?php if($assoc_nm != ""){ echo "-".$assoc_nm; } ?></td>
                    <td align="center" valign="middle" bgcolor="#DDDDDD" class="black_text_no_padding_13px" ><input name="cata" type="radio" class="style56" value="Complimentary Invitee Delegate" id="cata4" onclick="show_div_user_grp_type()" <?php if($assoc_nm != ""){?>  checked="checked" <?php } ?> /></td>
                  </tr>
                  <tr bgcolor="#FFFFEC">
                    <td height="35" colspan="2" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="4%" height="20" align="center" valign="top" >-</td>
                        <td width="96%" align="left" valign="top" >Terms &amp; Conditions Apply </td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
          <?php } ?>
          
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
                <td align="left" valign="middle"><span class="blue_text_no_padding"><span class="sitemap-txt">&nbsp;Address &nbsp;*</span></span></td>
                <td align="center"><span class="blue_text_no_padding">:</span></td>
                <td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="344" align="left" valign="top" class="blue_text_no_padding"><span class="sitemap-txt">
                        <textarea name="address" cols="32" rows="4" id="address"></textarea>
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
                  <?php if($cata_type == ""){ ?>
                  <tr>
                    <td width="173" align="left" valign="top" class="blue_text_no_padding">&nbsp;Select Day * </td>
                    <td width="15" align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td width="391" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr class="blue_text_no_padding">
                        <td width="6%" align="left" valign="top"><input type="checkbox" name="reg_day_1" id="reg_day_1" value="Day-1" /></td>
                        <td width="49%" align="left" valign="top">Day 1</td>
                        <td width="5%" align="left" valign="top">&nbsp;</td>
                        <td width="40%" align="left" valign="top">&nbsp;</td>
                        </tr>
                      <tr>
                        <td align="left" valign="top" height="8"></td>
                        <td align="left" valign="top"></td>
                        <td align="left" valign="top"></td>
                        <td align="left" valign="top"></td>
                      </tr>
                      <tr class="blue_text_no_padding">
                        <td align="left" valign="top">
                          <input type="radio" name="reg_day_2_p" id="reg_day_3" value="Day 2-ICT Track I by AMCHAM & NASSCOM" /></td>
                        <td align="left" valign="top">Day 2-ICT Track I by AMCHAM & NASSCOM</td>
                        <td align="left" valign="top">
                          <input type="radio" name="reg_day_2_p" id="reg_day_4" value="Day 2-Electronics Track II by IESA" /></td>
                        <td align="left" valign="top">Day 2-Electronics Track II by IESA</td>
                      </tr>
                       <tr>
                        <td align="left" valign="top" height="8"></td>
                        <td align="left" valign="top"></td>
                        <td align="left" valign="top"></td>
                        <td align="left" valign="top"></td>
                      </tr>
                      <tr class="blue_text_no_padding">
                        <td align="left" valign="top"><input type="checkbox" name="reg_day_2" id="reg_day_2" value="Day-3"  /></td>
                        <td align="left" valign="top">Day 3</td>
                        <td align="left" valign="top">&nbsp;</td>
                        <td align="left" valign="top">&nbsp;</td>
                      </tr>
                      </table>                     
                      </td>
                    <td width="12" align="left" valign="top">&nbsp;</td>
                    </tr>
                    <?php } ?>
                    
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align="left" valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" valign="top" ><table width='100%'  cellspacing='0' cellpadding='1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; border-color:#D0AC9D; border-style:solid' border='1'>
 
  <tr>
    <td height='35' colspan='3' align='center' bgcolor='#174984'><h3><span style='color: #FFF;'>Conference Programme at a Glance</span></h3></td>
  </tr>
  <tr>
    <td width='25%'  align='center' bgcolor='#F79646'><strong><span style='color: #FFF;font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Leadership Day</strong><br />
      <br />Day 1 PROGRAMME<br />
      Tuesday,October 22,2013</span></strong></td>
    <td width='50%'  align='center' bgcolor='#4bacc6'><p style='color: #FFF;font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Knowledge Day</strong><br />
      <br /><strong>Day 2 PROGRAMME<br />
      Wednesday,October 23,2013</strong></p></td>
    <td width='25%' align='center' bgcolor='#9bbb59'><p style='color: #FFF;font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Business Day</strong><br />
      <br /><strong>Day 3 PROGRAMME<br />
      Thursday, October 24, 2013</strong></p></td>
  </tr>
  <tr>
    <td align='left' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td height='50' align='center' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p>
          <strong>Exhibition Inauguration</strong><br />(Magadh)<br>
          03.30 pm - 04.00 pm        </p></td>
      </tr>
      <tr>
        <td height='50' align='center' bgcolor='#fde4d0' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p>
          <strong> Main Inauguration</strong><br />(Kalinga)<br>
          04.00 pm - 05.15 pm        </p></td>
      </tr>
      <tr>
        <td height='50' align='center' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p>
          <strong> Keynote Address </strong><br />(Kalinga)<br>
          05.15 pm - 06.45 pm        </p></td>
      </tr>
      <tr>
        <td height='50' align='center' bgcolor='#fde4d0' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>CEO Conclave by NASSCOM (only by Invitation)</strong> <br />
          (Grand Ball Room)<br>
          07.00 pm - 08.00 pm        </p></td>
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
            <td colspan='2'  align='center' valign='top' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong> Closed Door Round Table on GIC Acceleration by NASSCOM</strong>&nbsp;<br />
              08.30 am - 09.45 am<br />              
              (Lalit 3)</td>
          </tr>
          <tr>
            <td colspan='2'  align='center' valign='top' bgcolor='#D2EAF1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>IT Secretaries Meet - The Future of e-Gov and m-Gov :<br />
              Sharing &amp; Learning from Each Other</strong><br />
(Grand Ball Room)<br />
10.00 am - 11.30 am</td>
            </tr>
          <tr>
            <td width='52%'  align='center' valign='top' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>ICT Track I by AMCHAM & NASSCOM</strong> <br />
              (Lalit 1&2) </td>
            <td width='48%'  align='center' valign='top' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Electronics Track II by IESA<br />
            </strong>(Grand Ball Room)</td>
          </tr>
          <tr>
            <td rowspan='2'  align='center' valign='top' bgcolor="#D2EAF1" style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>Session 1: <br />
              </strong>11:30 am - 01:30 pm<strong><br />
              Bangalore: Global R&amp;D Power House<br />
              - The Way Forward </strong><br />
              <strong>By AMCHAM</strong><br>
              <br />
              <br>
              <br>
            </p></td>
            <td height='39'  align='center' valign='middle' bgcolor="#D2EAF1" style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>Session 1:<br />
</strong>11.30 am - 12.30 pm<strong><br />
              ESDM Landscape- Making India Self Reliant </strong><br>
            </p>
              </td>
          </tr>
          <tr>
            <td  align='center' valign='middle' bgcolor="#D2EAF1" style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>Session 2: <br />
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
            <td  align='center' valign='top' bgcolor="#D2EAF1" style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Session 2:<br />
              </strong>02.30 pm - 03.30 pm<strong><br /> 
              Digital Analytics- <br />
              Is it a paradigm shift for Marketing Analytics?<br />
              What does it mean for Indian Service Providers?<br />
              By NASSCOM</strong><br></td>
            <td  align='center' valign='middle' bgcolor="#D2EAF1" style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>Session 3: <br />
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
            <td  align='center' valign='top' bgcolor="#D2EAF1" style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Tea Break<br />
              </strong>04:30 pm - 05.00 pm</td>
            <td  align='center' valign='top' bgcolor="#D2EAF1" style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Tea Break</strong><br />
              04.00 pm - 04.30 pm</td>
          </tr>
          <tr>
            <td  align='center' valign='top' bgcolor="#FFFFFF" style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><br />
              <strong>B2B Meetings </strong><br />
              <br />
              05.00 pm - 05.30 pm             </td>
            <td  align='center' valign='top' bgcolor="#FFFFFF" style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>Session 5:<br />
              </strong>04.30 - 05.30 pm<strong><br />              
              Panel Discussion on MNC Story- <br />
              Expectations from Indian Ecosystem</strong><br></td>
            </tr>
          <tr>

            <td colspan='2'  align='center' valign='top' bgcolor='#D2EAF1' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><strong>IT Export Awards Function</strong><br />
(Kalinga)<br>
              06.00 pm onwards</td>
          </tr>
          </table>
          <div style='vertical-align:middle;font-family:Arial, Helvetica, sans-serif; font-size:12px;'></div></td>
      </tr>
    </table></td>
    <td align='left' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width="49%" height='50' align='center' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p> <strong>YESSS for Start-Ups</strong><br />
          (Lalit 1&2) <br />
          10.30 am to 01.30 pm        </p></td>
        </tr>
      <tr>
        <td height='50' align='center' bgcolor='#e6eed5' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p><strong>Round Table on Skill Development<br />
by NASSCOM </strong><br />
(Glass Room VI)<br />
10.30 am - 12.00 noon</p></td>
      </tr>
      <tr>
        <td align='center' style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'><p>&nbsp;</p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align='left' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
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
            &nbsp;2. Access to InterlinX Partnering Tool for scheduling B2B meetings<br />
            &nbsp;3. Access to visit Tradeshow</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    </tr>
 
                    </table>
</td>
                    <td align='left' valign='top'>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align='left' valign='top' class='blue_text_no_padding'>&nbsp;</td>
                    <td align='center' valign='top' class='blue_text_no_padding'>&nbsp;</td>
                    <td align='left' valign='top'>&nbsp;</td>
                    <td align='left' valign='top'>&nbsp;</td>
                  </tr>
                  </table></td>
                </tr>
              </table></td>
          </tr>      
          
        <?php 
		/*
		?> <tr>
           <td height='8'></td>
         </tr>
          <tr>
            <td height='50' ><table width='95%' border='0' align='center' cellpadding='0' cellspacing='0' class='border_style1'>
              <tr>
                <td width='100%' height='44'><table border='0' align='center' cellpadding='0' cellspacing='0'>
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
           <?php 
		*/
		?> 
           <tr>
             <td height="5" ></td>
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

 <?php 
	
	session_start();  
	if(($_SESSION["vercodevp"]==''))  
	{  
    	session_destroy();
		echo "<script language='javascript'>alert('Error in process; Try again');</script>";
		echo "<script language='javascript'>window.location = 'visitor_pass_form1.php';</script>";
		exit; 
	}
	$temp_assoc_nm_vp = @$_REQUEST['assoc_nm_vp'];
	require "includes/form_constants.php";
	
	require "dbcon_open.php";
	
	$id = $_SESSION["vercodevp"];
	
	$qr_vp_d_id = mysqli_query($link,"SELECT * FROM $VSTR_TBL_NAME WHERE reg_id = '$id'")or die(mysqli_error($link));
	$res_vp_d = mysqli_fetch_array($qr_vp_d_id);
	$res = $res_vp_d;
	
	require "visitor_pass_emailer_user.php";
	
?> 
<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>India's premier IT & Electronics Event</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<script language="javascript">

function disp_other_v()
{	
		
	if(document.getElementById("purpose7").checked == true)
	{
		document.getElementById("div_other_v").style.display = "block";
		document.getElementById("other_v").value = "";
	}
	else
	{
		document.getElementById("other_v").value = "";
		document.getElementById("div_other_v").style.display = "none";		
	}
}

function disp_other_k()
{	
		
	if(document.getElementById("know7").checked == true)
	{
		document.getElementById("div_other_k").style.display = "block";
		document.getElementById("other_k").value = "";
	}
	else
	{
		document.getElementById("other_k").value = "";
		document.getElementById("div_other_k").style.display = "none";		
	}
}


function chk_email(t_email)
{
	
	if(document.getElementById(t_email).value != "") 
  	{
		var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  		var toArr= document.getElementById(t_email).value.split(","); 			//split into array
	    for (var i=0;i<toArr.length;i++) 				    					//loop array to validate correct address
		{
	    	if ( !toArr[i].match(reg) ) 										//if not match, alert and stop loop
			{	
				alert("Invalid email address \n"+toArr[i]);
				document.getElementById(t_email).focus();
		        return false;
	    	}
			else
			{
				return true;
			}
	  	}
  	}
	else
	{
		return true;
	}
	
}

function validate_vpass()
{

	if(document.getElementById("title").value == "")
	{
		alert("Please Select Title.");
		document.getElementById("title").focus();
		return false;
	}
	if(document.getElementById("fname").value == "")
	{
		alert("Please fill your First Name.");
		document.getElementById("fname").focus();
		return false;
	}
	if(document.getElementById("lname").value == "")
	{
		alert("Please fill your Last Name.");
		document.getElementById("lname").focus();
		return false;
	}
	
	if(document.getElementById("email").value == "")
	{
		alert("Please fill your email id.");
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
	if(document.getElementById("job_title").value == "")
	{
	    alert("Please fill the Designation.");
        document.getElementById("job_title").focus();
        return false;
    }
	/*
	if(document.getElementById("website").value == "")
	{
	    alert("Please specify your website URL as www.bangalorenano.in.");
        document.getElementById("website").focus();
        return false;
    }
	*/
	if(document.getElementById("org").value == "")
	{
		alert("Please fill your Organisation Name.");
		document.getElementById("org").focus();
		return false;
	}
	if(document.getElementById("addr").value == "")
	{
		alert("Please fill your address.");
		document.getElementById("addr").focus();
		return false;
	}
	if(document.getElementById("city").value == "")
	{
		alert("Please fill your City.");
		document.getElementById("city").focus();
		return false;
	}
	if(document.getElementById("state").value == "")
	{
		alert("Please fill your State.");
		document.getElementById("state").focus();
		return false;
	}
	if(document.getElementById("country").value == "")
	{
		alert("Please select Country.");
		document.getElementById("country").focus();
		return false;
	}
	if(document.getElementById("zip").value == "")
	{
		alert("Please fill your Zip/Pin Code.");
		document.getElementById("zip").focus();
		return false;
	}
	if(document.getElementById("fone").value == "")
	{
		alert("Please fill your Phone Number.");
		document.getElementById("fone").focus();
		return false;
	}
	/*
	if(document.getElementById("org_act").value == "")
	{
	    alert("Please fill the main activity of your Company.");
        document.getElementById("org_act").focus();
        return false;
    }
	
	if(document.getElementById("interest").value == "")
	{
	    alert("Please fill the main interest of your Company.");
        document.getElementById("interest").focus();
        return false;
    }
	*/
	if((document.getElementById("purpose1").checked == false)  &&  (document.getElementById("purpose2").checked == false)  &&  (document.getElementById("purpose3").checked == false)  &&  (document.getElementById("purpose4").checked == false)  &&  (document.getElementById("purpose5").checked == false)  &&  (document.getElementById("purpose6").checked == false) && (document.getElementById("purpose7").checked == false))
	{
	    alert("Please select atleast one Purpose of Visit.");
        document.getElementById("purpose1").focus();
        return false;
    }
	/*
	if(document.getElementById("noOfEmp").value == "Select")
	{
	    alert("Please select number of employees.");
        document.getElementById("noOfEmp").focus();
        return false;
    }
	*/
	if((document.getElementById("know1").checked == false)  &&  (document.getElementById("know2").checked == false)  &&  (document.getElementById("know3").checked == false)  &&  (document.getElementById("know4").checked == false)  &&  (document.getElementById("know5").checked == false)  &&  (document.getElementById("know6").checked == false)  &&  (document.getElementById("know7").checked == false)  &&  (document.getElementById("know8").checked == false))
	{
	    alert("How Did You Know About Bangalore Nano 2012?");
        document.getElementById("know1").focus();
        return false;
    }
	if(document.getElementById("know7").checked == true)
	{
		if((document.getElementById("know8").value == "")  ||  (document.getElementById("know8").value == "Please Specify"))
		{
		    alert("Please specify other source.");
	        document.getElementById("know8").focus();
	        return false;
	    }	
	}
	if((document.getElementById("feedback1").checked == false)  &&  (document.getElementById("feedback2").checked == false))
	{
	    alert("Do You Wish to Receive Info from Bangalore Nano 2012?");
        document.getElementById("feedback1").focus();
        return false;
    }
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
	
}
function disp_other_v()
{	
		
	if(document.getElementById("purpose7").checked == true)
	{
		document.getElementById("div_other_v").style.display = "block";
		document.getElementById("other_v").value = "";
	}
	else
	{
		document.getElementById("other_v").value = "";
		document.getElementById("div_other_v").style.display = "none";		
	}
}

function disp_other_k()
{	
		
	if(document.getElementById("know7").checked == true)
	{
		document.getElementById("div_other_k").style.display = "block";
		document.getElementById("other_k").value = "";
	}
	else
	{
		document.getElementById("other_k").value = "";
		document.getElementById("div_other_k").style.display = "none";		
	}
}



</script>



<script language="javascript">

function check_num(e,txt)
{
	var unicode=e.keyCode? e.keyCode : e.charCode;
	var text1 = txt;
	if((unicode == "48") || (unicode == "49") || (unicode == "50") || (unicode == "51") || (unicode=="52") || (unicode=="53") || (unicode=="54") || (unicode=="55") || (unicode=="56") || (unicode=="57") || (unicode=="96") || (unicode=="97") || (unicode=="98") || (unicode=="99") || (unicode=="100") || (unicode=="101") || (unicode=="102") || (unicode=="103") || (unicode=="104") || (unicode=="105") || (unicode=="8") || (unicode=="46") || (unicode=="9") || (unicode=="16"))
	{
		
	}
	
	else if((unicode!="48") || (unicode!="49") || (unicode!="50") || (unicode!="51") || (unicode!="52") || (unicode!="53") || (unicode!="54") || (unicode!="55") || (unicode!="56") || (unicode!="57") || (unicode!="96") || (unicode!="97") || (unicode!="98") || (unicode!="99") || (unicode!="100") || (unicode!="101") || (unicode!="102") || (unicode!="103") || (unicode!="104") || (unicode!="105") || (unicode!="8") || (unicode!="46") || (unicode!="9") || (unicode!="16"))
	{
		alert("Please enter numbers");
		document.getElementById(text1).value="";
	}	
}
function check_char(ev,txt2)
{
	var unicode2=ev.keyCode? ev.keyCode : ev.charCode;
	var text2 = txt2;
	if((unicode2=="48") || (unicode2=="49") || (unicode2=="50") || (unicode2=="51") || (unicode2=="52") || (unicode2=="53") || (unicode2=="54") || (unicode2=="55") || (unicode2=="56") || (unicode2=="57") || (unicode2=="96") || (unicode2=="97") || (unicode2=="98") || (unicode2=="99") || (unicode2=="100") || (unicode2=="101") || (unicode2=="102") || (unicode2=="103") || (unicode2=="104") || (unicode2=="105"))
	{
		alert("Please enter character");
		document.getElementById(txt2).value="";
	}	
}


function other_div()
{	
	if(document.getElementById("othr").style.display == "none")
	{
		document.getElementById("othr").style.display = "block";
	}
	else
	{
		document.getElementById("othr").style.display = "none";
	}
}
</script> 

<script language="javascript" src="validate_form.js"></script>

<style type="text/css">
<!--
.style4 {	font-family: verdana, geneva;
	font-size: small;
}
-->
</style>
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

<table width="675" border="0" cellpadding="0" cellspacing="0" class="border_style1" style=" margin-top:20px; margin-left:400px;">
  <tr align="left" valign="top">
    <td width="601" height="35">
      <div class="style2" style="margin-left:20px;"><strong class="small_button"></strong><strong class="small_button"><?php echo $EVENT_NAME;?></strong> : Business Visitor Registration Form </div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
    <td height="513" colspan="2">
	
	
<form id="visitor_form1" name="form1" method="post" action="visitor_pass_form2.php" onsubmit="return validate_vpass()">
	
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          
		   
          <tr>
            <td width="631" height="10"></td>
          </tr>
          

          <tr>
             <td height="50" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
               <tr>
                 <td width="100%" height="44"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                   <tr>
                     <td width="161" align="left" valign="top" class="blue_text_no_padding"></td>
                     <td width="22" height="10" align="center" valign="top" class="blue_text_no_padding"></td>
                     <td width="421" align="left" valign="top"></td>
                   </tr>
                   
                   <tr>
                     <td colspan="3" align="left" valign="top" class="blue_text_no_padding"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                       
                       <?php 
							  if($temp_nm=="DRF456DFF7G")
							  {
							  ?>
                       <tr>
                         <td align="left" valign="top" class="sitemap-txt" id="text"><strong>Thank you for submitting your details.</strong></td>
                       </tr>
                       <?php 
							  }
							  ?>
                       <tr>
                         <td align="left" valign="top" id="text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                               <td align="left" valign="top" bgcolor="#FFFFFF" class="content-txt-without-alignment">&nbsp;</td>
                             </tr>
                             <tr>
                               <td align="left" valign="top" bgcolor="#FFFFFF" class="content-txt-without-alignment"><strong>Thank you for registering. </strong></td>
                             </tr>
                             <tr>
                               <td align="left" valign="top" bgcolor="#FFFFFF" class="content-txt-without-alignment">&nbsp;</td>
                             </tr>
                             <tr>
                               <td align="left" valign="top" bgcolor="#FFFFFF" class="content-txt-without-alignment"><strong>The copy of same is emailed to you.</strong></td>
                             </tr>
                             <tr>
                               <td width="584" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                             </tr>
                             <tr>
                               <td bgcolor="#FFFFFF"><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                   <tr>
                                     <td width='93%' align='left' valign='middle' class='style11' ><strong><span class="normal-heading-txt">Visitor Name:</span> <?php echo $res['title']." ".$res['fname']." ".$res['lname']; ?> </strong></td>
                                   </tr>
                                   <tr>
                                     <td align='left' valign='middle'>&nbsp;</td>
                                   </tr> 
                                   <tr>
                                     <td align='left' valign='middle'><span class="normal-heading-txt"><strong>Pass No:</strong></span> <span class="style11"><strong><?php echo $res['pass_no']; ?></strong></span></td>
                                   </tr>
                                   <tr>
                                     <td align='center' valign='middle' class='style11'>&nbsp;</td>
                                   </tr>
                                   <tr>
                                     <td align='left' valign='middle' class='style11'><strong><a href="visitor_pass_form4.php?pn=<?php echo $res['pass_no'];?>&assoc_nm_vp=<?php echo $temp_assoc_nm_vp;?>" target="_blank" id="text" style="text-decoration:underline; color:#0033FF;">Click here</a> to generate your Visitor Pass. </strong></td>
                                   </tr>
                               </table></td>
                             </tr>
                           </table>
                             <p> <br />
                           </p></td>
                       </tr>
                     </table></td>
                   </tr>
                   
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding"></td>
                     <td align="center" valign="top" class="blue_text_no_padding" height="10"></td>
                     <td align="left" valign="top"></td>
                   </tr>
                 </table></td>
               </tr>
             </table></td>
           </tr>
		   



		   <tr>
            <td height="10"></td>
          </tr>
           	   <tr>
             <td height="50" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
               <tr>
                 <td width="100%" height="44"><table border="0" align="center" cellpadding="0" cellspacing="0">
                     
                     <tr>
                       <td width="174" height="5" align="left" valign="top" class="blue_text_no_padding"></td>
                       <td width="16" align="center" valign="top" class="blue_text_no_padding"></td>
                       <td width="405" colspan="3" align="left" valign="top"></td>
                     </tr>
                     <tr>
                       <td height="5" colspan="3" align="left" valign="top" class="blue_text_no_padding"><p><span class="style2">For any additional information or clarification, contact us on <br />
Event <strong>Secretariat</strong> : <?php echo $EVENT_SECRT_ADDR;?> <br />
Email: <a href="mailto:<?php echo $EVENT_ENQUIRY_EMAIL;?>" target="_blank"><?php echo $EVENT_ENQUIRY_EMAIL;?></a></span></p>                         </td>
                     </tr>
                     <tr>
                       <td align="left" valign="top" class="blue_text_no_padding" height="10"></td>
                       <td align="center" valign="top" class="blue_text_no_padding"></td>
                       <td colspan="3" align="left" valign="top"></td>
                     </tr>
                     
                 </table></td>
               </tr>
             </table></td>
           </tr>
		   	   
           <tr>
             <td align="center">&nbsp;</td>
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
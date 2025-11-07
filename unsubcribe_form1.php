<?php
	require "includes/form_constants.php";
	require "unsubcribe_captcha_vp.php";
	$email1 = $_REQUEST['email1'];
?>
<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $EVENT_NAME;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<script language="javascript">

function disp_unsubcrib_other_v()
{	
		
	if(document.getElementById("unsubscrb_feedback").value == "Other")
	{
		document.getElementById("div_unsub_rsn_other").style.display = "block";
		document.getElementById("unsubscrb_feedback_other").value = "";
	}
	else
	{
		document.getElementById("unsubscrb_feedback_other").value = "";
		document.getElementById("div_unsub_rsn_other").style.display = "none";		
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
	if((document.getElementById("know1").checked == false)  &&  (document.getElementById("know2").checked == false)  &&  (document.getElementById("know3").checked == false)  &&  (document.getElementById("know4").checked == false)  &&  (document.getElementById("know5").checked == false)  &&  (document.getElementById("know6").checked == false)  &&  (document.getElementById("know7").checked == false)   &&  (document.getElementById("know8").checked == false) &&  (document.getElementById("know9").checked == false) &&  (document.getElementById("know10").checked == false))
	{
	    alert("How Did You Know About <?php echo $EVENT_NAME;?>?");
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
	    alert("Do You Wish to Receive Info from <?php echo $EVENT_NAME;?>?");
        document.getElementById("feedback1").focus();
        return false;
    }
	if(document.getElementById("vercodeusub").value == "")
	{
	    alert("Please fill the characters you see in image.");
        document.getElementById("vercodeusub").focus();
        return false;
    }
	else if(document.getElementById("vercodeusub").value != "")
	{
		compstr = document.getElementById("test").value;
		if(document.getElementById("vercodeusub").value != compstr)
		{
	    	alert("Please fill correct characters you see in image.");
        	document.getElementById("vercodeusub").value = "";
			document.getElementById("vercodeusub").focus();
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

<body>

<?php include("includes/header.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center" valign="bottom">
    <td height="30"><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/purpal_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/gray_round.png" width="10" height="16" /><img src="images/dot_line.jpg" width="40" height="16" /></td>
  </tr>
</table>
<table width="100%">
<tr align="left" valign="middle">
<td>

<table width="675" border="0" cellpadding="0" cellspacing="0" class="border_style1" align="center">
  <tr align="left" valign="top">
    <td width="601" height="35">
      <div class="style2" style="margin-left:20px;"><strong class="small_button"></strong><strong class="small_button"><?php echo $EVENT_NAME;?></strong> : Unsubscribe Form </div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
    <td height="513" colspan="2">

	
<form id="visitor_form1" name="form1" method="post" action="unsubcribe_form2.php" onsubmit="return validate_vpass()">
	
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="631" height="16"></td>
          </tr>
		   
          <tr>
            <td height="10"></td>
          </tr>
          

          <tr>
            <td height="10" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="44"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="161" align="left" valign="top" class="blue_text_no_padding"></td>
                      <td width="22" height="10" align="center" valign="top" class="blue_text_no_padding"></td>
                      <td width="421" align="left" valign="top"></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="blue_text_no_padding">&nbsp;Your <span class="content-txt-form">Email Id * </span></td>
                      <td align="center" valign="top" class="blue_text_no_padding">:</td>
                      <td align="left" valign="top"><span class="content-txt-form">
                        <input name="email1" type="text" class="style23" id="email1" size="64" maxlength="280" value="<?php echo $email1;?>" />
                      </span></td>
                    </tr>
                    
                    
                    <tr>
                      <td colspan="3" align="left" valign="top" height="10"></td>
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
            <td height="10" >&nbsp;</td>
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
                     <td colspan="3" align="left" valign="top" class="blue_text_no_padding"><table width="100%" border="0">
                       <tr>
                         <td colspan="2">We regret to know that you are not any  longer interested in our mailers. To help us improve our services, we would be  grateful if you could tell us why:</td>
                         </tr>
                       <tr>
                         <td width="1%">&nbsp;</td>
                         <td width="99%" align="left" valign="top">
						 <select name="unsubscrb_feedback" id="unsubscrb_feedback" onchange="disp_unsubcrib_other_v();">
						 <option value="">Select Option</option>
                           <option value="Your mailers are not relevant to me">Your mailers are not relevant to me</option>
						    <option value="Your mailers are too frequent">Your mailers are too frequent</option>
							 <option value="I no longer want to receive these mailers">I no longer want to receive these mailers</option>
							  <option value="These mailers are spam and should be reported">These mailers are spam and should be reported</option>
							   <option value="Other">Other</option>
                         </select></td>
                         </tr>
                     </table>                       </td>
                   </tr>
                   <tr>
                     <td height="8" colspan="3" align="left" valign="top"></td>
                   </tr>
                   <tr>
                     <td colspan="3" align="left" valign="top" class="blue_text_no_padding">
					 <div id="div_unsub_rsn_other" style="display:none;">
					 <table width="100%" border="0">
                       <tr>
                         <td width="27%" align="left" valign="top">&nbsp;Other * </td>
                         <td width="3%" align="center" valign="top">:</td>
                         <td width="70%" align="left" valign="top"><input name="unsubscrb_feedback_other" type="text" id="unsubscrb_feedback_other" size="64" maxlength="100" /></td>
                       </tr>
                     </table>
					 </div>					 </td>
                   </tr>
                   <tr>
                     <td colspan="3" align="left" valign="top" height="10"></td>
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
            <td height="0"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="183" align="left" valign="middle" class="blue_text_no_padding">&nbsp;Enter Verification Code * </td>
                      <td width="11" align="center" valign="middle" class="blue_text_no_padding">:</td>
                      <td width="403" align="left" valign="top"><table width="98%">
                            <tr>
							  <td width="178" align="left" valign="middle"><input type="text" name="vercodeusub" id="vercodeusub"  style="border:1px solid"/>
							    <input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercodeunsub"];?>" /></td>
                              <td width="11">&nbsp;</td>
							  <td width="137" align="left" valign="middle"><img src='unsubcribe_captcha_vp2.php' /></td>
							  <td width="19">&nbsp;</td>
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
                       <td height="5" colspan="3" align="left" valign="top" class="blue_text_no_padding"><p><span class="style2">                           For any additional information or clarification, contact us on <br />
                           Event  <strong>Secretariat</strong>: <?php echo $EVENT_SECRT_ADDR;?>
                           <br />
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
           <tr>
            <td align="center"><span class="style2">
              <input type="submit" name="Submit" value="Unsubscribe" />
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
	  <?php /* ?>
	  
	  <form id="visitor_form_temp" name="visitor_form_temp" method="post" >
	
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="631" height="16"></td>
          </tr>
		   <tr>
            <td height="53" valign="middle"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="13" align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                      <td width="599" align="left" valign="top" class="blue_text_no_padding"><br />
                        Online Business Visitor Registration Form for 9th Nutra India Summit is closed. If you wish to register you can do so by making Spot Registration at the Venue.
	                    <br />
	                    <br />
	                    <span class="style2">For any additional information or clarification, <br />
	                    contact us on <br />
Event <strong>Secretariat</strong>: <?php echo $EVENT_SECRT_ADDR;?> <br />
Email: <a href="mailto:<?php echo $EVENT_ENQUIRY_EMAIL;?>" target="_blank"><?php echo $EVENT_ENQUIRY_EMAIL;?></a></span></td>
                      <td width="16" align="left" valign="top">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table>              </td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
          

          <tr>
             <td height="50" >&nbsp;</td>
          </tr>
		   
		  <tr>
            <td height="10"></td>
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
	  
	  <?php */ ?>
	 </td>
  </tr>
  </table>

</td>
</tr>
</table>
<?php include("includes/footer.php");?>


</body>
</html>
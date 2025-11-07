<?php 
	require "includes/form_constants.php";
	require "visitor_pass_captcha_vp.php";
	$temp_assoc_nm_vp = @$_REQUEST['assoc_nm_vp'];
	
	
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
function disp_association_name()
{			
	if(document.getElementById("know1").checked == true)
	{
		document.getElementById("div_association_name").style.display = "block";
		document.getElementById("association_name").value = "";
	}
	else
	{
		document.getElementById("association_name").value = "";
		document.getElementById("div_association_name").style.display = "none";		
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
	if((document.getElementById("know1").checked == false)  &&  (document.getElementById("know2").checked == false)  &&  (document.getElementById("know3").checked == false)  &&  (document.getElementById("know4").checked == false)  &&  (document.getElementById("know5").checked == false)  &&  (document.getElementById("know6").checked == false)  &&  (document.getElementById("know7").checked == false)  &&  (document.getElementById("know8").checked == false) &&  (document.getElementById("know9").checked == false)&&  (document.getElementById("know10").checked == false))
	{
	    alert("How Did You Know About <?php echo $EVENT_NAME;?>?");
        document.getElementById("know1").focus();
        return false;
    }
	if(document.getElementById("know7").checked == true)
	{
		if((document.getElementById("other_k").value == ""))
		{
		    alert("Please specify other source.");
	        document.getElementById("know8").focus();
	        return false;
	    }	
	}
	if(document.getElementById("know1").checked == true)
	{
		if((document.getElementById("association_name").value == "") )
		{
		    alert("Please Association Name .");
	        document.getElementById("know1").focus();
	        return false;
	    }	
	}
	if((document.getElementById("feedback1").checked == false)  &&  (document.getElementById("feedback2").checked == false))
	{
	    alert("Do You Wish to Receive Info from <?php echo $EVENT_NAME;?>?");
        document.getElementById("feedback1").focus();
        return false;
    }
	if(document.getElementById("vercodevp").value == "")
	{
	    alert("Please fill the characters you see in image.");
        document.getElementById("vercodevp").focus();
        return false;
    }
	else if(document.getElementById("vercodevp").value != "")
	{
		compstr = document.getElementById("test").value;
		if(document.getElementById("vercodevp").value != compstr)
		{
	    	alert("Please fill correct characters you see in image.");
        	document.getElementById("vercodevp").value = "";
			document.getElementById("vercodevp").focus();
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
    <td height="30"><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/purpal_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/gray_round.png" width="10" height="16" /><img src="images/dot_line.jpg" width="40" height="16" /></td>
  </tr>
</table>
<table width="100%">
<tr align="left" valign="middle">
<td>
 <table width="675" border="0" cellpadding="0" cellspacing="0" class="border_style1" style=" margin-top:20px;" align="center">
  <tr align="left" valign="top">
    <td width="601" height="35">
      <div class="style2" style="margin-left:20px;"><strong class="small_button"></strong><strong class="small_button"><?php echo $EVENT_NAME;?></strong> : Business Visitor Registration Form </div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
    <td height="513" colspan="2">
	 
	
<form id="visitor_form1" name="form1" method="post" action="visitor_pass_form2.php?assoc_nm_vp=<?php echo $temp_assoc_nm_vp;?>" onsubmit="return validate_vpass()">
	
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="631" height="16"></td>
          </tr>
		   <tr>
            <td height="53" valign="middle"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="left" valign="top" class="blue_text_no_padding">After the success of last edition of <strong class="small_button"><?php echo $EVENT_NAME;?></strong>, the <strong class="small_button"><?php echo $EVENT_NAME;?></strong> <strong class="small_button"><?php echo $EVENT_YEAR;?></strong> is back with more highlights and would be held from&nbsp;<?php echo $EVENT_DATE;?>. <br />
                       <p align="center"> Block Your Dates !</p></td>
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
             <td height="50" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
               <tr>
                 <td width="100%" height="44"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                   <tr>
                     <td width="161" align="left" valign="top" class="blue_text_no_padding"></td>
                     <td width="22" height="10" align="center" valign="top" class="blue_text_no_padding"></td>
                     <td width="421" align="left" valign="top"></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding"><span class="sitemap-txt"><strong class="content-txt-bold">&nbsp;&nbsp;Name</strong>*</span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                         <tr>
                           <td width="20%" align="left" valign="middle" class="black_text_no_padding_small" ><select name="title" id="title">
                               <option value="">Select</option>
                               <option value="Mr." <?php if($_SESSION['sess_cp_title']=="Mr."){ echo ' selected="selected"'; } ?>>Mr.</option>
                               <option value="Mrs." <?php if($_SESSION['sess_cp_title']=="Mrs."){ echo ' selected="selected"'; } ?>>Mrs.</option>
                               <option value="Miss." <?php if($_SESSION['sess_cp_title']=="Miss."){ echo ' selected="selected"'; } ?>>Miss.</option>
                               <option value="Ms." <?php if($_SESSION['sess_cp_title']=="Ms."){ echo ' selected="selected"'; } ?>>Ms.</option>
                               <option value="Dr." <?php if($_SESSION['sess_cp_title']=="Dr."){ echo ' selected="selected"'; } ?>>Dr.</option>
                               <option value="Prof." <?php if($_SESSION['sess_cp_title']=="Prof."){ echo ' selected="selected"'; } ?>>Prof.</option>
                           </select></td>
                           <td width="40%" align="left" valign="middle" class="black_text_no_padding_small" ><input name="fname" type="text" id="fname" value="<?php echo $_SESSION['sess_cp_fname'];  ?>" size="20" maxlength="50" /></td>
                           <td width="40%" align="left" valign="middle" class="black_text_no_padding_small" ><input name="lname"  type="text" id="lname" value="<?php echo $_SESSION['sess_cp_lname']; ?>" size="20" maxlength="50" /></td>
                         </tr>
                         <tr>
                           <td align="left" valign="middle" class="black_text_no_padding_small"> &nbsp;&nbsp;Title * </td>
                           <td align="left" valign="top" class="black_text_no_padding_small"> &nbsp;&nbsp;&nbsp;First Name * </td>
                           <td align="left" valign="top" class="black_text_no_padding_small">&nbsp;&nbsp;Last Name * </td>
                         </tr>
                     </table></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding">&nbsp;<span class="content-txt-form">Email Id * </span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="email" type="text" class="style23" id="email" size="64" maxlength="280" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding"><span class="content-txt-without-alignment">&nbsp;Designation * </span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="job_title" type="text" class="style23" id="job_title" size="64" maxlength="280" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding">&nbsp;<span class="content-txt-form">Organisation Name * </span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="org" type="text" class="style23" id="org" size="64" maxlength="280" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding"><span class="content-txt-without-alignment">&nbsp;Organisation URL </span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="website" type="text" class="style23" id="website" size="64" maxlength="280" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                     <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                     <td align="left" valign="top"><span class="black_text_no_padding_small">&nbsp;&nbsp;&nbsp;Specify URL as eg.<?php echo $EVENT_WEBSITE_LINK;?></span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" height="10" ></td>
                     <td align="center" valign="top" ></td>
                     <td colspan="2"></td>
                     </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding"><span class="content-txt-form"> &nbsp;Address * </span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="addr" type="text" id="addr" onkeydown="if(event.keyCode==13) event.keyCode=46;" value="" size="64" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding">&nbsp;<span class="content-txt-form">City * </span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="city" type="text" class="style23" id="city" size="64" maxlength="90" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding">&nbsp;<span class="content-txt-form">State * </span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="state" type="text" class="style23" id="state" size="64" maxlength="90" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding">&nbsp;<span class="content-txt-form">Country * </span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="style14">
                       <select name="country" class="style14" id="country">
                         <option value="" >Select One</option>
                         <option value="Afghanistan">Afghanistan</option>
                         <option value="Aland Islands">Aland Islands</option>
                         <option value="Albania">Albania</option>
                         <option value="Algeria">Algeria</option>
                         <option value="American Samoa">American Samoa</option>
                         <option value="Andorra">Andorra</option>
                         <option value="Angola">Angola</option>
                         <option value="Anguilla">Anguilla</option>
                         <option value="Antarctica">Antarctica</option>
                         <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                         <option value="Argentina">Argentina</option>
                         <option value="Armenia">Armenia</option>
                         <option value="Aruba">Aruba</option>
                         <option value="Australia">Australia</option>
                         <option value="Austria">Austria</option>
                         <option value="Azerbaijan">Azerbaijan</option>
                         <option value="Bahamas">Bahamas</option>
                         <option value="Bahrain">Bahrain</option>
                         <option value="Bangladesh">Bangladesh</option>
                         <option value="Barbados">Barbados</option>
                         <option value="Belarus">Belarus</option>
                         <option value="Belgium">Belgium</option>
                         <option value="Belize">Belize</option>
                         <option value="Benin">Benin</option>
                         <option value="Bermuda">Bermuda</option>
                         <option value="Bhutan">Bhutan</option>
                         <option value="Bolivia">Bolivia</option>
                         <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                         <option value="Botswana">Botswana</option>
                         <option value="Bouvet Island">Bouvet Island</option>
                         <option value="Brazil">Brazil</option>
                         <option value="British Virgin Islands">British Virgin Islands</option>
                         <option value="Brunei">Brunei</option>
                         <option value="Bulgaria">Bulgaria</option>
                         <option value="Burkina Faso">Burkina Faso</option>
                         <option value="Burundi">Burundi</option>
                         <option value="Cambodia">Cambodia</option>
                         <option value="Cameroon">Cameroon</option>
                         <option value="Canada">Canada</option>
                         <option value="Cape Verde">Cape Verde</option>
                         <option value="Cayman Islands">Cayman Islands</option>
                         <option value="Central African Republic">Central African Republic</option>
                         <option value="Chad">Chad</option>
                         <option value="Chile">Chile</option>
                         <option value="China">China</option>
                         <option value="Christmas Island">Christmas Island</option>
                         <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                         <option value="Colombia">Colombia</option>
                         <option value="Comoros">Comoros</option>
                         <option value="Congo">Congo</option>
                         <option value="Cook Islands">Cook Islands</option>
                         <option value="Costa Rica">Costa Rica</option>
                         <option value="Croatia">Croatia</option>
                         <option value="Cyprus">Cyprus</option>
                         <option value="Czech Republic">Czech Republic</option>
                         <option value="Denmark">Denmark</option>
                         <option value="Disputed Territory">Disputed Territory</option>
                         <option value="Djibouti">Djibouti</option>
                         <option value="Dominica">Dominica</option>
                         <option value="Dominican Republic">Dominican Republic</option>
                         <option value="East Timor">East Timor</option>
                         <option value="Ecuador">Ecuador</option>
                         <option value="Egypt">Egypt</option>
                         <option value="El Salvador">El Salvador</option>
                         <option value="Equatorial Guinea">Equatorial Guinea</option>
                         <option value="Eritrea">Eritrea</option>
                         <option value="Estonia">Estonia</option>
                         <option value="Ethiopia">Ethiopia</option>
                         <option value="Falkland Islands">Falkland Islands</option>
                         <option value="Faroe Islands">Faroe Islands</option>
                         <option value="Federated States of Micronesia">Federated States of Micronesia</option>
                         <option value="Fiji">Fiji</option>
                         <option value="Finland">Finland</option>
                         <option value="France">France</option>
                         <option value="French Guyana">French Guyana</option>
                         <option value="French Polynesia">French Polynesia</option>
                         <option value="French Southern Territories">French Southern Territories</option>
                         <option value="Gabon">Gabon</option>
                         <option value="Gambia">Gambia</option>
                         <option value="Georgia">Georgia</option>
                         <option value="Germany">Germany</option>
                         <option value="Ghana">Ghana</option>
                         <option value="Gibraltar">Gibraltar</option>
                         <option value="Greece">Greece</option>
                         <option value="Greenland">Greenland</option>
                         <option value="Grenada">Grenada</option>
                         <option value="Guadeloupe">Guadeloupe</option>
                         <option value="Guam">Guam</option>
                         <option value="Guatemala">Guatemala</option>
                         <option value="Guinea">Guinea</option>
                         <option value="Guinea-Bissau">Guinea-Bissau</option>
                         <option value="Guyana">Guyana</option>
                         <option value="Haiti">Haiti</option>
                         <option value="Honduras">Honduras</option>
                         <option value="Hong Kong">Hong Kong</option>
                         <option value="Hungary">Hungary</option>
                         <option value="Iceland">Iceland</option>
                         <option value="India" selected="selected">India</option>
                         <option value="Indonesia">Indonesia</option>
                         <option value="Iraq">Iraq</option>
                         <option value="Iran">Iran</option>
                         <option value="Iraq-Saudi Arabia Neutral Zone">Iraq-Saudi Arabia Neutral Zone</option>
                         <option value="Ireland">Ireland</option>
                         <option value="Israel">Israel</option>
                         <option value="Italy">Italy</option>
                         <option value="Ivory Coast">Ivory Coast</option>
                         <option value="Jamaica">Jamaica</option>
                         <option value="Japan">Japan</option>
                         <option value="Jordan">Jordan</option>
                         <option value="Kazakhstan">Kazakhstan</option>
                         <option value="Kenya">Kenya</option>
                         <option value="Kiribati">Kiribati</option>
                         <option value="Kuwait">Kuwait</option>
                         <option value="Kyrgyzstan">Kyrgyzstan</option>
                         <option value="Laos">Laos</option>
                         <option value="Latvia">Latvia</option>
                         <option value="Lebanon">Lebanon</option>
                         <option value="Lesotho">Lesotho</option>
                         <option value="Liberia">Liberia</option>
                         <option value="Libya">Libya</option>
                         <option value="Liechtenstein">Liechtenstein</option>
                         <option value="Lithuania">Lithuania</option>
                         <option value="Luxembourg">Luxembourg</option>
                         <option value="Macau">Macau</option>
                         <option value="Macedonia">Macedonia</option>
                         <option value="Madagascar">Madagascar</option>
                         <option value="Malawi">Malawi</option>
                         <option value="Malaysia">Malaysia</option>
                         <option value="Maldives">Maldives</option>
                         <option value="Mali">Mali</option>
                         <option value="Malta">Malta</option>
                         <option value="Marshall Islands">Marshall Islands</option>
                         <option value="Martinique">Martinique</option>
                         <option value="Mauritania">Mauritania</option>
                         <option value="Mauritius">Mauritius</option>
                         <option value="Mayotte">Mayotte</option>
                         <option value="Mexico">Mexico</option>
                         <option value="Moldova">Moldova</option>
                         <option value="Monaco">Monaco</option>
                         <option value="Mongolia">Mongolia</option>
                         <option value="Montserrat">Montserrat</option>
                         <option value="Morocco">Morocco</option>
                         <option value="Mozambique">Mozambique</option>
                         <option value="Myanmar">Myanmar</option>
                         <option value="Namibia">Namibia</option>
                         <option value="Nauru">Nauru</option>
                         <option value="Nepal">Nepal</option>
                         <option value="Netherlands">Netherlands</option>
                         <option value="Netherlands Antilles">Netherlands Antilles</option>
                         <option value="New Caledonia">New Caledonia</option>
                         <option value="New Zealand">New Zealand</option>
                         <option value="Nicaragua">Nicaragua</option>
                         <option value="Niger">Niger</option>
                         <option value="Nigeria">Nigeria</option>
                         <option value="Niue">Niue</option>
                         <option value="Norfolk Island">Norfolk Island</option>
                         <option value="North Korea">North Korea</option>
                         <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                         <option value="Norway">Norway</option>
                         <option value="Oman">Oman</option>
                         <option value="Pakistan">Pakistan</option>
                         <option value="Palau">Palau</option>
                         <option value="Palestinian Occupied Territories">Palestinian Occupied Territories</option>
                         <option value="Panama">Panama</option>
                         <option value="Papua New Guinea">Papua New Guinea</option>
                         <option value="Paraguay">Paraguay</option>
                         <option value="Peru">Peru</option>
                         <option value="Philippines">Philippines</option>
                         <option value="Pitcairn Islands">Pitcairn Islands</option>
                         <option value="Poland">Poland</option>
                         <option value="Portugal">Portugal</option>
                         <option value="Puerto Rico">Puerto Rico</option>
                         <option value="Qatar">Qatar</option>
                         <option value="Reunion">Reunion</option>
                         <option value="Romania">Romania</option>
                         <option value="Russia">Russia</option>
                         <option value="Rwanda">Rwanda</option>
                         <option value="Saint Helena and Dependencies">Saint Helena and Dependencies</option>
                         <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                         <option value="Saint Lucia">Saint Lucia</option>
                         <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                         <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                         <option value="Samoa">Samoa</option>
                         <option value="San Marino">San Marino</option>
                         <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                         <option value="Saudi Arabia">Saudi Arabia</option>
                         <option value="Senegal">Senegal</option>
                         <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                         <option value="Seychelles">Seychelles</option>
                         <option value="Sierra Leone">Sierra Leone</option>
                         <option value="Singapore">Singapore</option>
                         <option value="Slovakia">Slovakia</option>
                         <option value="Slovenia">Slovenia</option>
                         <option value="Solomon Islands">Solomon Islands</option>
                         <option value="Somalia">Somalia</option>
                         <option value="South Africa">South Africa</option>
                         <option value="South Korea">South Korea</option>
                         <option value="Spain">Spain</option>
                         <option value="Spratly Islands">Spratly Islands</option>
                         <option value="Sri Lanka">Sri Lanka</option>
                         <option value="Suriname">Suriname</option>
                         <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                         <option value="Swaziland">Swaziland</option>
                         <option value="Sweden">Sweden</option>
                         <option value="Switzerland">Switzerland</option>
                         <option value="Syria">Syria</option>
                         <option value="Taiwan">Taiwan</option>
                         <option value="Tajikistan">Tajikistan</option>
                         <option value="Tanzania">Tanzania</option>
                         <option value="Thailand">Thailand</option>
                         <option value="Togo">Togo</option>
                         <option value="Tokelau">Tokelau</option>
                         <option value="Tonga">Tonga</option>
                         <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                         <option value="Tunisia">Tunisia</option>
                         <option value="Turkey">Turkey</option>
                         <option value="Turkmenistan">Turkmenistan</option>
                         <option value="Turks And Caicos Islands">Turks And Caicos Islands</option>
                         <option value="Tuvalu">Tuvalu</option>
                         <option value="Uganda">Uganda</option>
                         <option value="Ukraine">Ukraine</option>
                         <option value="United Arab Emirates">United Arab Emirates</option>
                         <option value="United Kingdom">United Kingdom</option>
                         <option value="United Nations Neutral Zone">United Nations Neutral Zone</option>
                         <option value="United States">United States</option>
                         <option value="Uruguay">Uruguay</option>
                         <option value="US Virgin Islands">US Virgin Islands</option>
                         <option value="Uzbekistan">Uzbekistan</option>
                         <option value="Vanuatu">Vanuatu</option>
                         <option value="Vatican City">Vatican City</option>
                         <option value="Venezuela">Venezuela</option>
                         <option value="Vietnam">Vietnam</option>
                         <option value="Wallis and Futuna">Wallis and Futuna</option>
                         <option value="Western Sahara">Western Sahara</option>
                         <option value="Yemen">Yemen</option>
                         <option value="Zambia">Zambia</option>
                         <option value="Zimbabwe">Zimbabwe</option>
                       </select>
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding">&nbsp;<span class="content-txt-form">Zip/Pin code * </span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="zip" type="text" class="style23" id="zip" size="64" maxlength="10" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding"><span class="content-txt-without-alignment">&nbsp;Telephone *</span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="fone" type="text" class="style23" id="fone" size="64" maxlength="30" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding"><span class="content-txt-without-alignment">&nbsp;Fax</span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="fax" type="text" class="style23" id="fax" size="64" maxlength="30" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding"><span class="content-txt-without-alignment">&nbsp;Organisation's  Main &nbsp;Activity </span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="org_act" type="text" class="style23" id="org_act" size="64" maxlength="280" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                     <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                     <td align="left" valign="top">&nbsp;</td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding"><span class="content-txt-without-alignment">Main Interest </span></td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><span class="content-txt-form">
                       <input name="interest" type="text" class="style23" id="interest" size="64" maxlength="280" />
                     </span></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                     <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                     <td align="left" valign="top">&nbsp;</td>
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
                      <td width="174" align="left" valign="top" class="blue_text_no_padding"></td>
                      <td width="16" height="10" align="center" valign="top" class="blue_text_no_padding"></td>
                      <td width="349" align="left" valign="top"></td>
                      <td width="52" align="left" valign="top"></td>
                    </tr>
                     <tr>
                       <td colspan="3" align="left" valign="top" class="style2"><strong>&nbsp;<span class="content-txt-without-alignment">Purpose of Visit?  *</span></strong></td>
                       <td align="center" valign="middle"  style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;">&nbsp;</td>
                     </tr>
                     <tr>
                       <td colspan="3" align="left" valign="top" class="blue_text_no_padding"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                         </tr>
                         <tr>
                           <td width="7%" align="left" valign="top" class="style14"><input name="purpose1" type="checkbox" id="purpose1" value="Gather Information / Technology Update" /></td>
                           <td width="43%" align="left" valign="top" class="style14">Gather Information / Technology Update</td>
                           <td width="6%" align="left" valign="top" class="style14"><input name="purpose2" type="checkbox" id="purpose2" value="Purchase / Recommend a Service / Technology" /></td>
                           <td width="44%" align="left" valign="top" class="style14">Purchase / Recommend a Service / Technology</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14"><input name="purpose3" type="checkbox" id="purpose3" value="Explore prospective partners &amp; forge Alliances" /></td>
                           <td align="left" valign="top" class="style14">Explore prospective partners &amp; forge  Alliances </td>
                           <td align="left" valign="top" class="style14"><input name="purpose4" type="checkbox" id="purpose4" value="Evaluate the show for future participation" /></td>
                           <td align="left" valign="top" class="style14">Evaluate the show for future participation</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14"><input name="purpose5" type="checkbox" id="purpose5" value="Make contacts / Visit Partners" /></td>
                           <td align="left" valign="top" class="style14">Make Contacts / Visit Partners</td>
                           <td align="left" valign="top" class="style14"><input name="purpose6" type="checkbox" id="purpose6" value="meet an exhibitor" /></td>
                           <td align="left" valign="top" class="style14">Meet an Exhibitor</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14"><input name="purpose7" type="checkbox" id="purpose7" value="meet an exhibitor" onclick="disp_other_v()" /></td>
                           <td colspan="3" align="left" valign="top" class="style14"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                               <tr>
                                 <td width="13%">Other </td>
                                 <td width="2%">&nbsp;</td>
                                 <td width="85%"><div id="div_other_v" style="display:none;">:
                                   <input name="other_v" type="text" id="other_v" size="30" />
                                 </div></td>
                               </tr>
                           </table></td>
                         </tr>
                       </table></td>
                       <td align="center" valign="middle"  style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;">&nbsp;</td>
                     </tr>
                     <tr>
                       <td colspan="3" align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                       <td align="center" valign="middle"  style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;">&nbsp;</td>
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
                      <td width="174" align="left" valign="top" class="blue_text_no_padding"></td>
                      <td width="16" height="10" align="center" valign="top" class="blue_text_no_padding"></td>
                      <td width="394" align="left" valign="top"></td>
                      <td width="10" align="left" valign="top"></td>
                    </tr>
                     <tr>
                       <td colspan="3" align="left" valign="top" class="blue_text_no_padding"><span class="style2" ><span class="main_title">&nbsp;<span class="content-txt-without-alignment">How Did You Know About <?php echo $EVENT_NAME;?> ? * </span></span></span></td>
                       <td align="center" valign="middle"  style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;">&nbsp;</td>
                     </tr>
                     <tr>
                       <td colspan="3" align="left" valign="top" class="blue_text_no_padding"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                         <tr>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                         </tr>
                         <tr>
                           <td width="7%" align="left" valign="top" class="style14"><input type="checkbox" name="know9" id="know9" value="Social Media" /></td>
                           <td width="43%" align="left" valign="top" class="style14">Social Media</td>
                           <td width="6%" align="left" valign="top" class="style14"><input name="know2" type="checkbox" id="know2" value="Direct Mailer" /></td>
                           <td width="44%" align="left" valign="top" class="style14">Direct Mailer</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14"><input name="know3" type="checkbox" id="know3" value="Internet" /></td>
                           <td align="left" valign="top" class="style14">Internet</td>
                           <td align="left" valign="top" class="style14"><input name="know4" type="checkbox" id="know4" value="Invitation from Exhibitor" /></td>
                           <td align="left" valign="top" class="style14">Invitation from Exhibitor </td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14"><input name="know5" type="checkbox" id="know5" value="News Paper Ad" /></td>
                           <td align="left" valign="top" class="style14">News Paper Ad </td>
                           <td align="left" valign="top" class="style14"><input name="know6" type="checkbox" id="know6" value="Mobile Van" /></td>
                           <td align="left" valign="top" class="style14">Mobile Van</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14"><input name="know8" type="checkbox" id="know8" value="Radio" /></td>
                           <td align="left" valign="top" class="style14">Radio</td>
                           <td align="left" valign="top" class="style14"> <input name="know10" type="checkbox" id="know10" value="BMTC Bus" /></td>
                           <td align="left" valign="top" class="style14">BMTC Bus</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                           <td align="left" valign="top" class="style14">&nbsp;</td>
                         </tr>
                         <tr>
                           <td align="left" valign="top" class="style14"><input name="know1" type="checkbox" id="know1" value="Association" onclick="disp_association_name()" /></td>
                           <td align="left" valign="top" class="style14">Association </td>
                           <td align="left" valign="top" class="style14"><input name="know7" type="checkbox" id="know7" value="Other" onclick="disp_other_k()" /></td>
                           <td align="left" valign="top" class="style14"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                               <td>Other
                                 <div id="div_other_k" style="display:none;">:
                                   <input name="other_k" type="text" id="other_k" size="20" />
                                 </div></td>
                             </tr>
                           </table></td>
                         </tr>
                         
                         
                       
                         <tr>
                           <td align="left" valign="top">&nbsp;</td>
                           <td align="left" valign="top"><span class="style14"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                               <tr>
                                 <td><div id="div_association_name" style="display:none;">:
                                     <input name="association_name" type="text" id="association_name" size="20" />
                                   </div></td>
                               </tr>
                           </table></span></td>
                           <td align="left" valign="top">&nbsp;</td>
                           <td align="left" valign="top">&nbsp;</td>
                         </tr>
                         
                       </table></td>
                       <td align="center" valign="middle"  style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;">&nbsp;</td>
                     </tr>
                     
                      <tr>
                      <td align="left" valign="top" class="blue_text_no_padding"></td>
                      <td align="center" valign="top" class="blue_text_no_padding" height="10"></td>
                      <td align="left" valign="top"></td>
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
                      <td width="174" align="left" valign="top" class="blue_text_no_padding"></td>
                      <td width="18" height="10" align="center" valign="top" class="blue_text_no_padding"></td>
                      <td width="347" align="left" valign="top"></td>
                      <td width="52" align="left" valign="top"></td>
                    </tr>
                     <tr>
                       <td colspan="3" align="left" valign="top" class="blue_text_no_padding"><span class="style2" ><span class="main_title">&nbsp;<span class="content-txt-without-alignment">Do You Wish to Receive  Info from <?php echo $EVENT_NAME;?> ? * </span></span></span></td>
                       <td align="center" valign="middle"  style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;">&nbsp;</td>
                     </tr>
                     <tr>
                       <td colspan="3" align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                       <td align="center" valign="middle"  style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;">&nbsp;</td>
                     </tr>
                     <tr>
                       <td colspan="3" align="left" valign="top" class="blue_text_no_padding"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="style14">
                         <tr>
                           <td width="7%"><input name="feedback" id="feedback1" type="radio" value="Yes" /></td>
                           <td width="16%">Yes</td>
                           <td width="7%"><input name="feedback" id="feedback2" type="radio" value="No" /></td>
                           <td width="70%">No</td>
                         </tr>
                       </table></td>
                       <td align="center" valign="middle"  style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;">&nbsp;</td>
                     </tr>
                     
                       <tr>
                      <td align="left" valign="top" class="blue_text_no_padding"></td>
                      <td align="center" valign="top" class="blue_text_no_padding" height="10"></td>
                      <td align="left" valign="top"></td>
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
							  <td width="178" align="left" valign="middle"><input type="text" name="vercodevp" id="vercodevp"  style="border:1px solid"/>
							    <input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercodevp"];?>" /></td>
                              <td width="11">&nbsp;</td>
							  <td width="137" align="left" valign="middle"><img src='visitor_pass_captcha_vp2.php' /></td>
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
                       <td height="5" colspan="3" align="left" valign="top" class="blue_text_no_padding"><p><strong>Note</strong> <strong>:</strong> <br />
                           1. <span class="content-txt-without-alignment"><strong>Please carry your business card during your visit to the exhibition.</strong></span><br />
                           <span class="style2"><br />
                           For any additional information or clarification, contact us on <br />
                           Event  <strong>Secretariat</strong>: <?php echo $EVENT_SECRT_ADDR;?>
                           <br />
                           Email: <a href="mailto:<?php echo $EVENT_ENQUIRY_EMAIL;?>" target="_blank"><?php echo $EVENT_ENQUIRY_EMAIL;?></a> <br />
                           </span></p>                         </td>
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
              <input type="submit" name="Submit" value="Generate Pass" />
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
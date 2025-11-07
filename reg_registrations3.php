<?php

	session_start();  
	if((!isset($_SESSION["vercode_reg"]))||($_SESSION["vercode_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		echo "<script language='javascript'>window.location=('reg_registrations.php');</script>";
		echo "<script language='javascript'>document.location=('reg_registrations.php');</script>";
		exit; 
	}
	require("includes/form_constants.php");
	require "dbcon_open.php";
	$reg_id = $_SESSION['vercode_reg'];
	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_no = 0;
	$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
	if( ($qr_gt_user_data_ans_no<=0) || ($qr_gt_user_data_ans_no=="") ){
		session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
		echo "<script language='javascript'>window.location=('reg_registrations.php');</script>";
		echo "<script language='javascript'>document.location=('reg_registrations.php');</script>";
		exit; 
	}	
	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
	
	
	
	$exhi_log = @$_REQUEST['exhi_log'];
	
	$exhi = @$_REQUEST['exhi'];
	$exhibitor_id = "";
	if($exhi== "E34XH3IDf6gyy77"){
		$exhibitor_id = $_REQUEST['exhibitor_id'];
	
	
	$qr_chk_exbhi = "Select * from ".$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS." where exhibitor_id = '$exhibitor_id' ";
	$qr_chk_exbhi_id = mysqli_query($link,$qr_chk_exbhi);
	$qr_chk_exbhi_num_rows = "";
	$qr_chk_exbhi_num_rows = mysqli_num_rows($qr_chk_exbhi_id);
	
	$qr_chk_exbhi_id = mysqli_query($link,$qr_chk_exbhi);
	$qr_chk_exbhi_ans_rows = mysqli_fetch_array($qr_chk_exbhi_id);
	
		if(($qr_chk_exbhi_num_rows == 0) || ($qr_chk_exbhi_ans_rows['exhibitor_id'] != $exhibitor_id))
		{
			session_destroy();
			echo "<script language='javascript'>alert('Please get register as a exhibitor on online exhibitor form.');</script>";
			echo "<script language='javascript'>window.location = '".$EVENT_DB_EXHI_DIR_REG_LINK."';</script>";
			exit;
		}
	
	}
	
	if(($exhi!="") && ($exhi_log=="r34tr1")){
		
		$temp_org = $qr_chk_exbhi_ans_rows['exhibitor_name'];
		$temp_nature = $qr_chk_exbhi_ans_rows['nature'];
		$temp_addr1 = $qr_chk_exbhi_ans_rows['address_line_1'];
		$temp_addr2 = $qr_chk_exbhi_ans_rows['address_line_2'];
		$temp_city = $qr_chk_exbhi_ans_rows['city'];
		$temp_state = $qr_chk_exbhi_ans_rows['state'];
		$temp_country = $qr_chk_exbhi_ans_rows['country'];
		$temp_pin = $qr_chk_exbhi_ans_rows['zip'];
		$temp_fone = $qr_chk_exbhi_ans_rows['cntry_code_phone']."-".$qr_chk_exbhi_ans_rows['area_code_phone']."-".$qr_chk_exbhi_ans_rows['phone'];
		$temp_fax = $qr_chk_exbhi_ans_rows['cntry_code_fax']."-".$qr_chk_exbhi_ans_rows['area_code_fax']."-".$qr_chk_exbhi_ans_rows['fax'];
		
	}
	else{
	
		$temp_org = $qr_gt_user_data_ans_row['org'];
		$temp_nature = $qr_gt_user_data_ans_row['nature'];
		$temp_addr1 = $qr_gt_user_data_ans_row['addr1'];
		$temp_addr2 = $qr_gt_user_data_ans_row['addr2'];
		$temp_city = $qr_gt_user_data_ans_row['city'];
		$temp_state = $qr_gt_user_data_ans_row['state'];
		$temp_country = $qr_gt_user_data_ans_row['country'];
		$temp_pin = $qr_gt_user_data_ans_row['pin'];
		$temp_fone = $qr_gt_user_data_ans_row['fone'];
		$temp_fax = $qr_gt_user_data_ans_row['fax'];
	
	}
	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register Yourself for an Event <?php echo $EVENT_NAME; ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />


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


function go_back(){

	window.location=('reg_registrations.php?ret=retds4fu324rn_ed24d3it');
}


function validate_bio_registration_form_3(){
	
	if((document.getElementById("org").value == ""))
	{
	    alert("Please Enter Organization Name.");
        document.getElementById("org").focus();
        return false;
    }
	
	/*if((document.getElementById("cp_name_title").value == ""))
	{
	    alert("Please Select person Title.");
        document.getElementById("cp_name_title").focus();
        return false;
    }
	if((document.getElementById("cp_name_fname").value == ""))
	{
	    alert("Please Enter Contact person First Name.");
        document.getElementById("cp_name_fname").focus();
        return false;
    }
	if((document.getElementById("cp_name_lname").value == ""))
	{
	    alert("Please Enter Contact person Last Name.");
        document.getElementById("cp_name_lname").focus();
        return false;
    }
	
	if((document.getElementById("cp_email").value == ""))
	{
	    alert("Please Enter Contact person Email.");
        document.getElementById("cp_email").focus();
        return false;
    }	
	else if(document.getElementById("cp_email").value != "") 
	{
		var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var toArr= document.getElementById("cp_email").value.split(","); 			//split into array
		for (var i=0;i<toArr.length;i++) 				    					//loop array to validate correct address
		{
			if ( !toArr[i].match(reg) ) 										//if not match, alert and stop loop
			{	
				alert("Invalid Contact person Email \n"+toArr[i]);
				document.getElementById("cp_email").focus();
				return false;
			}
		}
	}	
	*/
	
	if((document.getElementById("addr1").value == ""))
	{
	    alert("Please Enter Address 1.");
        document.getElementById("addr1").focus();
        return false;
    }
	/*if((document.getElementById("bill_stude_addr_2").value == ""))
	{
	    alert("Please Enter Billing Zip/Pin Code.");
        document.getElementById("bill_stude_addr_2").focus();
        return false;
    }
	*/
	
	if((document.getElementById("city").value == ""))
	{
	    alert("Please Enter City.");
        document.getElementById("city").focus();
        return false;
    }
	if((document.getElementById("state").value == ""))
	{
	    alert("Please Enter State.");
        document.getElementById("state").focus();
        return false;
    }	
	if((document.getElementById("country").value == ""))
	{
	    alert("Please Enter Country.");
        document.getElementById("country").focus();
        return false;
    }	
	if((document.getElementById("pin").value == ""))
	{
	    alert("Please Enter pin/zip code.");
        document.getElementById("pin").focus();
        return false;
    }
	
	if(document.getElementById("country_code1").value == "")
	{
		alert("Please enter your Country code.");
		document.getElementById("country_code1").focus();
		return false;
	}
	if(document.getElementById("std1").value == "")
	{
		alert("Please enter your Area Code.");
		document.getElementById("std1").focus();
		return false;
	}
	if(document.getElementById("fone").value == "")
	{
		alert("Please enter your Phone Number.");
		document.getElementById("fone").focus();
		return false;
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
  <tr align="center" valign="middle">
    <td height="30">&nbsp;</td>
  </tr>
  <tr align="center" valign="bottom">
    <td height="30"><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/green_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/purpal_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/gray_round.png" width="10" height="16" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/gray_round.png" width="10" height="16" /><img src="images/dot_line.jpg" width="40" height="16" /></td>
  </tr>
</table>

<table width="100%"> 
<tr align="left" valign="middle">
<td>

<table width="675" border="0" cellpadding="0" cellspacing="0" class="border_style1" style=" margin-top:20px; margin-left:400px;">
  <tr align="left" valign="top">
    <td width="601" height="35">
      <div class="style2" style="margin-left:20px;"><?php echo $EVENT_NAME; ?>: Online Registration Form</div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr> 
  <tr align="left" valign="top">
    <td height="513" colspan="2">
	 
<?php ?>	
<form action="reg_registrations4.php?exhi=<?php echo $exhi;?>&exhibitor_id=<?php echo $exhibitor_id;?>" method="post" enctype="multipart/form-data" name="bio_registration_form_3" id="bio_registration_form_3" onSubmit="return validate_bio_registration_form_3()">
	
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
            <td height="30"><span class="blue_text">Please Enter Organisation Details:</span></td>
          </tr>
          <tr>
            <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding" height="13"></td>
                    <td align="left" valign="top" class="blue_text_no_padding"></td>
                    <td align="center" valign="top" class="blue_text_no_padding"></td>
                    <td align="left" valign="top"></td>
                  </tr>
                  <tr>
                    <td width="29" align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td width="175" align="left" valign="top" class="blue_text_no_padding"><span class="content-txt-form">Organisation</span> Name * </td>
                    <td width="14" align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td width="377" align="left" valign="top"><input name="org" type="text" class="border_style1_1" id="org" size="50" maxlength="149" value="<?php echo $temp_org;?>" placeholder="Organisation Name" required  <?php if($exhi != ""){?> readonly="readonly" <?php }?> ></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                   <tr>
                     <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                     <td align="left" valign="top" class="blue_text_no_padding">Nature Of Business </td>
                     <td align="center" valign="top" class="blue_text_no_padding">:</td>
                     <td align="left" valign="top"><input name="nature" type="text" class="border_style1_1" id="nature" size="50" maxlength="149" value="<?php echo $temp_nature;?>" placeholder="Nature Of Business" required /></td>
                   </tr>
                    <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
					<?php 
					 
					 /*
					 ?>
                   <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Contact Person Name * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top">
					<?php /*?><input name="cp_name" type="text" class="border_style1_1" id="cp_name" size="50" maxlength="149" value="<?php echo $qr_gt_user_data_ans_row['cp_name'];?>"><?php 
					
					$qr_gt_user_data_ans_arr = explode(" ",$qr_gt_user_data_ans_row['cp_name']);
					?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="19%" align="left" valign="top"><select name="cp_name_title" class="border_style1_1" id="cp_name_title">
                              <?php if($qr_gt_user_data_ans_arr[0] != ""){ ?>
                              <option  value="<?php echo $qr_gt_user_data_ans_arr[0];?>" selected="selected"><?php echo $qr_gt_user_data_ans_arr[0];?></option>
                              <?php }
						  else{
						  ?>
                              <option value="Mr." selected="selected">Mr.</option>
                              <?php 
						  }
						  ?>
                              <option value="Mr.">Mr.</option>
                              <option value="Ms.">Ms.</option>
                              <option value="Mrs.">Mrs.</option>
                              <option value="Dr.">Dr.</option>
                              <option value="Prof.">Prof.</option>
                            </select>                          </td>
                          <td width="34%" align="left" valign="top"><input name="cp_name_fname" type="text" class="border_style1_1" id="cp_name_fname" size="16" maxlength="90" value="<?php echo $qr_gt_user_data_ans_arr[1];?>" /></td>
                          <td width="42%" align="left" valign="top"><input name="cp_name_lname" type="text" class="border_style1_1" id="cp_name_lname" size="16" maxlength="90" value="<?php echo $qr_gt_user_data_ans_arr[2];?>" /></td>
                          <td width="5%" align="left" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="center" valign="top"><span class="style1_small">Title&nbsp;</span></td>
                          <td align="center" valign="top"><span class="style1_small">First Name</span></td>
                          <td align="center" valign="top"><span class="style1_small">Last Name </span></td>
                          <td align="left" valign="top">&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Contact Person Email * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top"><input name="cp_email" type="text" class="border_style1_1" id="cp_email" size="50" maxlength="149" value="<?php echo $qr_gt_user_data_ans_row['cp_email'];?>"></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
					 
					<?php 
					*/
					?> 
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Address Line 1 * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top"><input name="addr1" type="text" class="border_style1_1" id="addr1" size="50" maxlength="149" value="<?php echo $temp_addr1;?>" placeholder="Address Line 1" required <?php if($exhi != ""){?> readonly="readonly" <?php }?>  /></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Address Line 2 </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top"><input name="addr2" type="text" class="border_style1_1" id="addr2" size="50" maxlength="149" value="<?php echo $temp_addr2;?>" placeholder="Address Line 2" required <?php if($exhi != ""){?> readonly="readonly" <?php }?>   /></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">City * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top"><input name="city" type="text" class="border_style1_1" id="city" size="50" maxlength="149" value="<?php echo $temp_city;?>" placeholder="City" required  onKeyUp="check_char(event,'city')" <?php if($exhi != ""){?> readonly="readonly" <?php }?> /></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">State * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top"><input name="state" type="text" class="border_style1_1" id="state" size="50" maxlength="149" value="<?php echo $temp_state;?>" placeholder="State" required onKeyUp="check_char(event,'state')" <?php if($exhi != ""){?> readonly="readonly" <?php }?>  /></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Country * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top"><span class="Text2">
					<?php if($exhi != ""){?> <input name="country" type="text" class="border_style1_1" id="country" size="50" maxlength="149" value="<?php echo $temp_state;?>" placeholder="country" required onKeyUp="check_char(event,'country')" <?php if($exhi != ""){?> readonly="readonly" <?php }?>  />  <?php 
					
					}					
					else{
					?>
					
                      <select name="country" class="border_style1_1" id="country" style="width:335px;" required />                        
						<?php if($temp_country != ""){?>
						<option  value="<?php echo $temp_country;?>"  selected="selected"><?php echo $temp_country;?></option><?php } else{ ?> <option value="India" selected="selected">India</option><?php } ?>
						<option value="">Select Country</option>
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
                        <option value="India">India</option>
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
					  <?php 
					  }
					  ?>
                    </span></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">PIN /ZIP Code * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top"><input name="pin" type="text" class="border_style1_1" id="pin" size="50" maxlength="10"  value="<?php echo $temp_pin;?>" placeholder="PIN /ZIP Code" required <?php if($exhi != ""){?> readonly="readonly" <?php }?> /></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Telephone No. * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top">
					<?php 
					$tele_no_arr = explode("-",$temp_fone)
					?>
					
					<span class="black_text_no_padding_normal">+                        </span><span class="content-txt-form">
						
<input name="country_code1" type="text" class="border_style1_1" id="country_code1" onKeyUp="check_num(event,'country_code1')" size="5" maxlength="5" value="<?php echo $tele_no_arr[0];?>"  placeholder="Country" required <?php if($exhi != ""){?> readonly="readonly" <?php }?> />
</span><span class="black_text_no_padding_normal">-</span><span class="black_text_no_padding_normal">
<input name="std1" type="text" class="border_style1_1" id="std1" onKeyUp="check_num(event,'std1')" size="5" maxlength="5" value="<?php echo $tele_no_arr[1];?>" placeholder="Area" required <?php if($exhi != ""){?> readonly="readonly" <?php }?> />
-
<input name="fone" type="text" class="border_style1_1" id="fone" onKeyUp="check_num(event,'fone')" size="12" maxlength="10" value="<?php echo $tele_no_arr[2];?>" placeholder="Phone no" required <?php if($exhi != ""){?> readonly="readonly" <?php }?> />
                        </span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="76" align="center" valign="top" class="black_text_no_padding_small">+Country Code </td>
                        <td width="10" align="center" valign="top" class="black_text_no_padding_small">-</td>
                        <td width="54" align="center" valign="top" class="black_text_no_padding_small">Area Code </td>
                        <td width="16" align="center" valign="top" class="black_text_no_padding_small">-</td>
                        <td width="76" align="center" valign="top" class="black_text_no_padding_small">Phone Number </td>
                        <td width="145">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Fax No </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top">
					<?php 
					$fax_no_arr = explode("-",$temp_fax)
					?>
					<span class="black_text_no_padding_normal">+
                        <input name="country_code2" type="text" class="border_style1_1" id="country_code2" size="5" maxlength="5" value="<?php echo $fax_no_arr[0];?>" placeholder="Country" <?php if($exhi != ""){?> readonly="readonly" <?php }?> />
-
<input name="std2" type="text" class="border_style1_1" id="std2"  size="5" maxlength="5" value="<?php echo $fax_no_arr[1];?>"  placeholder="Area" <?php if($exhi != ""){?> readonly="readonly" <?php }?> />
-
<input name="fax" type="text" class="border_style1_1" id="fax"  size="12" maxlength="10" value="<?php echo $fax_no_arr[2];?>"  placeholder="FAX No" <?php if($exhi != ""){?> readonly="readonly" <?php }?>  />
                    </span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="76" align="center" valign="top" class="black_text_no_padding_small">+Country Code </td>
                        <td width="10" align="center" valign="top" class="black_text_no_padding_small">-</td>
                        <td width="54" align="center" valign="top" class="black_text_no_padding_small">Area Code </td>
                        <td width="18" align="center" valign="top" class="black_text_no_padding_small">-</td>
                        <td width="72" align="center" valign="top" class="black_text_no_padding_small">Fax  Number </td>
                        <td width="147">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                 
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
           <tr>
             <td height="30">&nbsp;</td>
           </tr>
           

          <tr>
            <td height="23" >&nbsp;</td>
          </tr>
          
          <tr>
            <td><table width="596" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left"><input name="Submit2" type="button" class="blue_text"  style="background-color:#dadada;" value="&lt;&lt;Back" width="118" height="28" / onclick="go_back()"></td>
                <td align="right">
                
                <input name="Submit" type="submit" class="blue_text"  style="background-color:#dadada;" value="Next>>" width="118" height="28" />                                </td>
              </tr>
            </table></td>
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
  </table><?php ?>

</td>
</tr>
</table>
<?php include("includes/footer.php");?>


</body>
</html> 
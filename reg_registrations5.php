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
	$lmt = $qr_gt_user_data_ans_row['sub_delegates'];
	
	echo "<script language='javascript'>var total_delegates=$lmt;</script>";
	
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

	window.location=('reg_registrations3.php?ret=retds4fu324rn_ed24d3it');
}

function validate_bio_registration_form_5(){


	for(var j=1;j<=total_delegates;j++)
	{
		if(document.getElementById("fname"+j).value == "")
		{
			alert("Please fill delegate "+j+"'s first name");
			document.getElementById("fname"+j).focus();
			return false;
		}
		if(document.getElementById("lname"+j).value == "")
		{
			alert("Please fill delegate "+j+"'s last name");
			document.getElementById("lname"+j).focus();
			return false;
		}
		if(document.getElementById("job_title"+j).value == "")
		{
			alert("Please fill delegate"+j+"'s Designation");
			document.getElementById("job_title"+j).focus();
			return false;
		}
		if(document.getElementById("badge"+j).value == "")
		{
			alert("Please fill delegate"+j+"'s badge name");
			document.getElementById("badge"+j).focus();
			return false;
		}
		
		if(document.getElementById("email_m"+j).value == "")
		{
			alert("Please fill delegate"+j+"'s email");
			document.getElementById("email_m"+j).focus();
			return false;
		}
		else if(document.getElementById("email_m"+j).value != "") 
		{
			var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var toArr= document.getElementById("email_m"+j).value.split(","); 			//split into array
			for (var i=0;i<toArr.length;i++) 				    					//loop array to validate correct address
			{
				if ( !toArr[i].match(reg) ) 										//if not match, alert and stop loop
				{	
					alert("Invalid email address \n"+toArr[i]);
					document.getElementById("email_m"+j).focus();
					return false;
				}
			}
		}
		
		if(document.getElementById("c_code"+j).value == "")
		{
			alert("Please fill delegate"+j+"'s country code");
			document.getElementById("c_code"+j).focus();
			return false;
		}
		if(document.getElementById("cellno"+j).value == "")
		{
			alert("Please fill delegate"+j+"'s mobile code");
			document.getElementById("cellno"+j).focus();
			return false;
		}
		if(document.getElementById("cat1"+j).checked == false && document.getElementById("cat2"+j).checked == false && document.getElementById("cat3"+j).checked == false) {
			alert("Please select delegate"+j+"'s Category.");
			document.getElementById("cat1"+j).focus();
			return false;
		}
		
		<?php 
		/*if(($qr_gt_user_data_ans_row['cata']!="Exhibitors Delegate") ){
		?>
		if((document.getElementById("tutA"+j).checked == false) && (document.getElementById("tutB"+j).checked == false) ){
			alert("Please select Tutorial Track-1 Or Tutorial Track-2 ");
			document.getElementById("tutA"+j).focus();
			return false;
		}
		
		<?php 
		}*/
		/*if( ($qr_gt_user_data_ans_row['cata']=="Industry - Single Day Delegate") || ($qr_gt_user_data_ans_row['cata']=="GOVT., R&D & Faculty - Single Day Delegate") ){
		?>
		if( (document.getElementById("vcheckbox1"+j).checked == false) && (document.getElementById("vcheckbox2"+j).checked == false) && (document.getElementById("vcheckbox3"+j).checked == false) ){

				alert("Please Select Day.");
				document.getElementById("vcheckbox1"+j).focus();
				return false;
		}
		 <?php }*/?>
	}
	//document.getElementById("Submit").disabled=true;
	document.bio_registration_form_5.submit();
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

<style type="text/css"></style></head>

<body >


<?php include("includes/header.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center" valign="middle">
    <td height="30">&nbsp;</td>
  </tr>
  <tr align="center" valign="bottom">
    <td height="30"><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/green_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/green_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/purpal_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/gray_round.png" width="10" height="16" /><img src="images/dot_line.jpg" width="40" height="16" /></td>
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
	
	
<form action="reg_registrations6.php" method="post" enctype="multipart/form-data" name="bio_registration_form_5" id="bio_registration_form_5">
	
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="631" height="30"><span class="blue_text">Please Enter Delegate Details:</span></td>
          </tr>
          
          <tr>
            <td height="5">&nbsp;</td>
          </tr>
          <tr>
            <td height="23" ><?php include 'programAtGlance.php';?></td>
          </tr>
          <?php 
		  for($i=1;$i<=$lmt;$i++){
		  ?>
		   <tr>
            <td height="10" class="blue_text_no_padding"> &nbsp;&nbsp;&nbsp;Enter Information of Delegate 
                                    <?php
								  	if($lmt >= 1)
									{	
										echo $i;	
									}
								  ?>
                                    :</td>
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
                    <td width="16" align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td width="151" align="left" valign="top" class="blue_text_no_padding">Name * </td>
                    <td width="9" align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td width="421" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="19%" align="left" valign="top"><select name="title<?php echo $i; ?>" class="border_style1_1" id="title<?php echo $i; ?>" required>
                            <?php if($qr_gt_user_data_ans_row['title'] != ""){ ?>
                            <option  value="<?php echo $qr_gt_user_data_ans_row['title'.$i];?>" selected="selected"><?php echo $qr_gt_user_data_ans_row['title'.$i];?></option>
                            <?php }
						  else{
						  ?>
                            <option value="Mr." selected="selected">Mr.</option>
                            <?php 
						  }
						  ?>                           
                            <option value="Ms.">Ms.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Dr.">Dr.</option>
                             <option value="Mr.">Mr.</option>
							<option value="Prof.">Prof.</option>
                          </select>                        </td>
                        <td width="28%" align="left" valign="top"><input name="fname<?php echo $i; ?>" type="text" class="border_style1_1" id="fname<?php echo $i; ?>" size="15" maxlength="90" value="<?php echo $qr_gt_user_data_ans_row['fname'.$i];?>" placeholder="First Name" required /></td>
                        <td width="40%" align="left" valign="top"><input name="lname<?php echo $i; ?>" type="text" class="border_style1_1" id="lname<?php echo $i; ?>" size="15" maxlength="90" value="<?php echo $qr_gt_user_data_ans_row['lname'.$i];?>" placeholder="Last Name" required></td>
                        <td width="13%" align="left" valign="top">&nbsp;</td>
                      </tr>
                      
                      <tr>
                        <td align="center" valign="top"><span class="style1_small">Title&nbsp;</span></td>
                        <td align="left" valign="top"><span class="style1_small">&nbsp;&nbsp;&nbsp;&nbsp;First Name</span></td>
                        <td align="left" valign="top"><span class="style1_small">&nbsp;&nbsp;&nbsp;&nbsp;Last Name </span></td>
                        <td align="left" valign="top">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Job Title * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top" class="black_text_no_padding_normal"><input name="job_title<?php echo $i; ?>" type="text" class="border_style1_1" id="job_title<?php echo $i; ?>" size="50" maxlength="149" value="<?php echo $qr_gt_user_data_ans_row['job_title'.$i];?>" placeholder="Job Title" required /></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Name on Badge *</td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top" class="black_text_no_padding_normal"><input name="badge<?php echo $i; ?>" type="text" class="border_style1_1" id="badge<?php echo $i; ?>" size="50" maxlength="149" value="<?php echo $qr_gt_user_data_ans_row['badge'.$i];?>"  placeholder="Name of badge" required onKeyUp="check_char(event,'badge<?php echo $i; ?>')"  /></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Email Id * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top" class="black_text_no_padding_normal"><input name="email_m<?php echo $i; ?>" type="email" class="border_style1_1" id="email_m<?php echo $i; ?>" size="50" maxlength="149" value="<?php echo $qr_gt_user_data_ans_row['email'.$i];?>" placeholder="Email Id" required /></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Mobile Number * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top" class="black_text_no_padding_normal"><span class="black_text_no_padding_normal">+
                        
                        <input name="c_code<?php echo $i; ?>" type="text" class="border_style1_1" id="c_code<?php echo $i; ?>" onKeyUp="check_num(event,'c_code<?php echo $i; ?>')" size="4" maxlength="4"  placeholder="Country" required/>
                        -
<input name="cellno<?php echo $i; ?>" type="text" class="border_style1_1" id="cellno<?php echo $i; ?>" onKeyUp="check_num(event,'cellno<?php echo $i; ?>')" maxlength="11" value="<?php echo $qr_gt_user_data_ans_row['cellno'.$i];?>" placeholder="Mobile No" required />
                    </span></td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
					 
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="black_text_no_padding_small">e.g.:-91-9876543456</td>
                  </tr>
				  <tr>
                    <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Selected Category * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top" class="black_text_no_padding_normal">
                    	<?php 
                    		$cata = explode('#', $qr_gt_user_data_ans_row['cata'.$i]);
                    	?>
                    	&nbsp;<label><input type="checkbox" name="cat1<?php echo $i; ?>" id="cat1<?php echo $i; ?>" value="<?php echo $DAY1;?>" <?php if(@$cata[0] == $DAY1) echo 'checked="checked"';?> />&nbsp;<?php echo $DAY1;?></label><br />
                    	&nbsp;<label><input type="checkbox" name="cat2<?php echo $i; ?>" id="cat2<?php echo $i; ?>" value="<?php echo $DAY2;?>" <?php if(@$cata[1] == $DAY2) echo 'checked="checked"';?> />&nbsp;<?php echo $DAY2;?></label><br />
                    	&nbsp;<label><input type="checkbox" name="cat3<?php echo $i; ?>" id="cat3<?php echo $i; ?>" value="<?php echo $DAY3;?>" <?php if(@$cata[2] == $DAY3) echo 'checked="checked"';?> />&nbsp;<?php echo $DAY3;?></label>
                    
                    </td>
                  </tr>
                  <?php /*
						if( ($qr_gt_user_data_ans_row['cata']=="Industry - Single Day Delegate") || ($qr_gt_user_data_ans_row['cata']=="GOVT., R&D & Faculty - Single Day Delegate") ){
				  ?>
                   <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Select Day * </td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top" class="black_text_no_padding_normal">&nbsp;
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="left" valign="top">&nbsp;
                            <input type="checkbox" name="vcheckbox1<?php echo $i; ?>" id="vcheckbox1<?php echo $i; ?>" value="Single Day 04 Dec 2013" />                            
                             </td>
                          <td width="90%" height="30" align="left" valign="top">Single Day <strong>04 Dec 2013 </strong></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">&nbsp;                          
                          <input type="checkbox" name="vcheckbox2<?php echo $i; ?>" id="vcheckbox2<?php echo $i; ?>" value="Single Day 05 Dec 2013" />                          
                          <td height="30" align="left" valign="top">Single Day <strong>05 Dec 2013 </strong></td>
                        </tr>
                        <tr>
                          <td width="10%" align="left" valign="top">&nbsp;                          
                          <input type="checkbox" name="vcheckbox3<?php echo $i; ?>" id="vcheckbox3<?php echo $i; ?>" value="Single Day 06 Dec 2013"  />
                          </td>                          
                          <td height="30" align="left" valign="top">Single Day <strong>06 Dec 2013 </strong></td>
                        </tr>
                      </table>
                      
                      </td>
                  </tr>
                    <?php 
						}*/
				  ?>
					 <?php 
							/*	if( ($qr_gt_user_data_ans_row['cata'] != "Exhibitors Delegate")  ){
								?>
                     <tr>
                       <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                       <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                       <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                       <td align="left" valign="top" class="black_text_no_padding_normal">&nbsp;</td>
                     </tr>
                     <tr>
                    <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                    <td align="left" valign="top" class="blue_text_no_padding">Select Tutorial * <br>
                      (4th December 2013)</td>
                    <td align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td align="left" valign="top" class="black_text_no_padding_normal">
						 <?php 
							/*	   if( ($qr_gt_user_data_ans_row['cata'] != "Exhibitors Delegate")  ){
								  ?>
								  
								  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="9%"><input name="tut1<?php echo $i; ?>" id="tutA<?php echo $i; ?>" type="radio" value="Tutorial A: Transitional Nano Medicine" /></td>
                                      <td width="3%">&nbsp;</td>
                                      <td width="41%" class="black_text_no_padding_13px" >Tutorial A: Transitional Nano Medicine</td>
                                      <td width="8%"><input name="tut1<?php echo $i; ?>" id="tutB<?php echo $i; ?>" type="radio" value="Tutorial B: Nanotech Application in Sensors" /></td>
                                      <td width="3%">&nbsp;</td>
                                      <td width="36%" class="black_text_no_padding_13px">Tutorial B: Nanotech Application in Sensors</td>
                                    </tr>
                                  </table>
									<?php 
									}
									?>					</td>
                  </tr>
                   <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                     </tr>
					 <?php 
					 }*/
					 ?>                  
				  <tr>
                     <td colspan="4" align="left" valign="top" class="blue_text_no_padding" height="7"></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
		  
		  
          <tr>
            <td>&nbsp;</td>
          </tr>
          <?php 
		  }
		  ?>

          <tr>
            <td height="23" >&nbsp;</td>
          </tr>
          
          <tr>
            <td><table width="596" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left"><input name="Submit2" id="Submit2" type="button" class="blue_text"  style="background-color:#dadada;" value="&lt;&lt; Back" width="118" height="28"  onclick="go_back()"/></td>
                <td align="right">
                
                <input name="Submit" id="Submit" type="button" class="blue_text"  style="background-color:#dadada;" value="Next&gt;&gt;" width="118" height="28" onclick="validate_bio_registration_form_5()"/>                                </td>
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
  </table>

</td>
</tr>
</table>
<?php include("includes/footer.php");?>


</body>
</html>
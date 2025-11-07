<?php 
	require("includes/form_constants.php");
	$ret = @$_GET['ret'];	
	  //echo $ret; 
	$temp_exhb_stat = @$_REQUEST['ret2'];
	
	$temp_ticket_type = @$_GET['tkt_type'];
	
	$cata_type = $_REQUEST["cata_type"];
	$assoc_nm = $_REQUEST["assoc_nm"]; 

	
	if($ret == "retds4fu324rn_ed24d3it")
	{	
		session_start(); 
		if((!isset($_SESSION["vercode_reg"]))||($_SESSION["vercode_reg"]==''))  
		{ 
			session_destroy();
			echo "<script language='javascript'>alert('Please try again.');</script>";
			echo "<script language='javascript'>window.location=('reg_registrations.php');</script>";
			echo "<script language='javascript'>document.location=('reg_registrations.php');</script>";
			exit; 
		}
		require "dbcon_open.php";
		$reg_id = $_SESSION['vercode_reg'];
		$text = $reg_id;
		/*echo "SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'<br>";
		exit;*/
		$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
		$qr_gt_user_data_ans_no = 0;
		$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
		if( ($qr_gt_user_data_ans_no<=0) || ($qr_gt_user_data_ans_no=="") ){
			session_destroy();
			echo "<script language='javascript'>alert('Please try again..');</script>";
			echo "<script language='javascript'>window.location=('reg_registrations.php');</script>";
			echo "<script language='javascript'>document.location=('reg_registrations.php');</script>";
			exit; 
		}	
		
		$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
		$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
	 	
		exit;
	}
	else{
	//echo "SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'11<br>";
		include('captcha_reg.php'); 
	} 
	
	$exhi = @$_REQUEST['exhi'];
	$exhibitor_id = "";
	$qr_chk_exbhi_ans_rows = "";
	
	if($exhi== "E34XH3IDf6gyy77"){
		$exhibitor_id = $_REQUEST['exhibitor_id'];
	
	$qr_chk_exbhi = "Select * from ".$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS." where exhibitor_id = '$exhibitor_id' ";
	$qr_chk_exbhi_id = mysqli_query($link,$qr_chk_exbhi);
	$qr_chk_exbhi_num_rows = "";
	$qr_chk_exbhi_num_rows = mysqli_num_rows($qr_chk_exbhi_id);
	
	$qr_chk_exbhi_id = mysqli_query($link,$qr_chk_exbhi);
	$qr_chk_exbhi_ans_rows = mysqli_num_rows($qr_chk_exbhi_id);
	
	if(($qr_chk_exbhi_num_rows == 0) || ($qr_chk_exbhi_ans_rows['exhibitor_id'] == $exhibitor_id))
	{
		session_destroy();
		echo "<script language='javascript'>alert('Please get register as a exhibitor on online exhibitor form.');</script>";
		echo "<script language='javascript'>window.location = '".$EVENT_DB_EXHI_DIR_REG_LINK."';</script>";
		exit;
	}
	
	
	}
	
	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register Yourself for an Event <?php echo $EVENT_NAME; ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />


<script language="javascript">

function show_assoc_div(){
	
		if(document.getElementById("supo_mem_Yes").checked == true){		
			
			document.getElementById("assoc_name_div").style.display = "block";						
			
			for(var i_mem_cnt=1;i_mem_cnt<=5;i_mem_cnt++){			
				
				document.getElementById("assoc_name_txt"+i_mem_cnt).checked =false;
			}
			
		} 
		else if(document.getElementById("supo_mem_No").checked == true){	
			
			for(var i_mem_cnt=1;i_mem_cnt<=5;i_mem_cnt++){			
			
				document.getElementById("assoc_name_txt"+i_mem_cnt).checked =false;
			}	
				
			document.getElementById("assoc_name_div").style.display = "none";		
		
		}	
		else {	
			document.getElementById("supo_mem_Yes").checked = false;	
			document.getElementById("supo_mem_No").checked = false;		
			document.getElementById("assoc_name_div").style.display = "none";		
		
		}	
	
	
}


function show_div_group_user()
{
	
		if(document.getElementById("Single").checked == true){
		
			document.getElementById("div_group_user").style.display = "none";				
		}
		else if(document.getElementById("Group").checked == true){
		
			document.getElementById("div_group_user").style.display = "block";						
		}
		else{
		
			alert("Please Select Single/ Group User(s). ");		
		}
	
	

}

function check_val()
{
	var val = document.getElementById("total_dele").value;
	//alert(val);
	if((val <= 2) || (val >= 8))
	{
		alert("Group Members Should be min. 3 & max. 7, including you.");
		document.getElementById("total_dele").value="";
		document.getElementById("total_dele").focus();
	}
}
function ccvalid()
{
	if(document.getElementById("ccvalid1").checked == true)
	{
		document.getElementById("cc2").style.display = "none";
	}
	if(document.getElementById("ccvalid2").checked == true)
	{
		document.getElementById("cc2").style.display = "block";
	}
}
function show_cata()
{

	if(document.getElementById("Indian").checked == true)
	{
		document.getElementById("cat_ind").style.display = "block";
		document.getElementById("cat_int").style.display = "none";
		document.getElementById("cata2").checked = false;
	} 
	else if(document.getElementById("Foreign").checked == true)
	{
		
		document.getElementById("cat_int").style.display = "block";
		document.getElementById("cat_ind").style.display = "none";
		//document.getElementById("cata1").checked = false;
		document.getElementById("cata2").checked = false;
		//document.getElementById("cata3").checked = false;	
	}
	else{		
		alert("Please select the Nationality type.");
		document.getElementById("Indian").focus();
		return false;
	} 
	
	chkPostr_2();
	
}

function chkPostr_2(){
	
		
		if(document.getElementById("Indian").checked == true){
			
			if(document.getElementById("cata_m4").checked == true){
				
				document.getElementById("cata2").disabled = true;	
			}
			else{
												
				document.getElementById("cata2").disabled = false;		
			}
			
			
		}
		else if(document.getElementById("Foreign").checked == true){			
			
			if(document.getElementById("cata_m4").checked == true){
				
				document.getElementById("cata5").disabled = true;	
			}
			else{
												
				document.getElementById("cata5").disabled = false;		
			}
			
		}	
		else{			
			alert("Please select the Nationality type.");
			document.getElementById("Indian").focus();
			return false;
		}
	

}

function chkPostr(){
	

	
}

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



function showTxt()
{
	if(document.getElementById("Cc").checked == true)
	{
		document.getElementById("pay1").style.display = "block";			
		document.getElementById("pay2").style.display = "none";	
		document.getElementById("pay3").style.display = "none";	
		document.getElementById("pay4").style.display = "none";	
			
	}
	if(document.getElementById("Cheque").checked == true)
	{
		document.getElementById("pay1").style.display = "none";			
		document.getElementById("pay2").style.display = "block";	
		document.getElementById("pay3").style.display = "none";
		document.getElementById("pay4").style.display = "none";	
				
	}
	if(document.getElementById("BT").checked == true)
	{
		document.getElementById("pay1").style.display = "none";			
		document.getElementById("pay2").style.display = "none";	
		document.getElementById("pay3").style.display = "block";
		document.getElementById("pay4").style.display = "none";	
		
	}
	if(document.getElementById("Dc").checked == true)
	{
		document.getElementById("pay1").style.display = "none";			
		document.getElementById("pay2").style.display = "none";	
		document.getElementById("pay3").style.display = "none";
		document.getElementById("pay4").style.display = "block";	
		
	}
	
	
}
function ccvalid()
{
	if(document.getElementById("ccvalid1").checked == true)
	{
		document.getElementById("cc2").style.display = "none";
	}
	if(document.getElementById("ccvalid2").checked == true)
	{
		document.getElementById("cc2").style.display = "block";
	}
}



function validate_reg_registration_form_1()
{
	
	var nt_sele_mem_no=0;
	
	if((document.getElementById("Indian").checked == false)  &&  (document.getElementById("Foreign").checked == false))
	{
	    alert("Please select the Nationality type.");
        document.getElementById("Indian").focus();
        return false;
    }
	
	/*
	if((document.getElementById("Indian").checked == true)){
	
		if((document.getElementById("supo_mem_Yes").checked == false)  &&  (document.getElementById("supo_mem_No").checked == false))
		{
			alert("Please select Association Status.");
			document.getElementById("supo_mem_Yes").focus();
			return false;
		}
	}
	if( (document.getElementById("supo_mem_Yes").checked == true) )
	{
		for(var i_mem_cnt=1;i_mem_cnt<=5;i_mem_cnt++){			
						
			if(document.getElementById("assoc_name_txt"+i_mem_cnt).checked == false){
				nt_sele_mem_no++;			
			}
	}
	    
    	if(nt_sele_mem_no >= 5 ){
			
			alert("Please select atleast One Association.");
			document.getElementById("assoc_name_txt1").focus();
			return false;
		}
	}
	*/
	if((document.getElementById("cata_m1").checked == false) && (document.getElementById("cata_m2").checked == false) && (document.getElementById("cata_m3").checked == false) && (document.getElementById("cata_m4").checked == false))
	{
				alert("Please select delegate type.");
				document.getElementById("cata_m1").focus();
				return false;
	}
	
	if(document.getElementById("cata2").checked == false)
	{
				alert("Please select delegate Category.");
				document.getElementById("cata2").focus();
				return false;
	}
	
	/*
	if((document.getElementById("supo_mem_Yes").checked == false)  &&  (document.getElementById("supo_mem_No").checked == false))
	{
			alert("Please select Association Status.");
			document.getElementById("supo_mem_Yes").focus();
			return false;
	}
	
	
	if( (document.getElementById("supo_mem_Yes").checked == true) )
	{
		for(var i_mem_cnt=1;i_mem_cnt<=1;i_mem_cnt++){			
						
			if(document.getElementById("assoc_name_txt"+i_mem_cnt).checked == false){
				nt_sele_mem_no++;			
			}
		}
	   
    	if(nt_sele_mem_no >= 1 ){
			
			alert("Please select atleast One Association.");
			document.getElementById("assoc_name_txt1").focus();
			return false;
		}
		
	}
	
		
	
	if(document.getElementById("Indian").checked == true)
	{
			
		if((document.getElementById("cata1").checked == false)  &&  (document.getElementById("cata2").checked == false)  &&  (document.getElementById("cata3").checked == false)  )
		{
				alert("Please select the Catagories.");
				document.getElementById("cata1").focus();
				return false;
		}
		
		
	} 
	
	
	if(document.getElementById("Foreign").checked == true)
	{
		if((document.getElementById("cata4").checked == false)  &&  (document.getElementById("cata5").checked == false)  &&  (document.getElementById("cata6").checked == false) )
		{
				alert("Please select the Catagories.");
				document.getElementById("cata4").focus();
				return false;
		}
	} 
	
	*/
	if((document.getElementById("Indian").checked == false)  &&  (document.getElementById("Foreign").checked == false))
	{
	    alert("Please select the Nationality type.");
        document.getElementById("Indian").focus();
        return false;
    }
	
	/*
	if(document.getElementById("Indian").checked == true)
	{
			
		if( (document.getElementById("cata_m4").checked == true) )
		{
				if(document.getElementById("cata2").checked == true)
				{
					alert("Only Tutorial is not available for Poster Delegate.");
					document.getElementById("cata1").focus();
					document.getElementById("cata2").checked = false;
					return false;
				}
		
		}
		
		
	} 
	
	
	if(document.getElementById("Foreign").checked == true)
	{
			
		if( (document.getElementById("cata_m4").checked == true) )
		{
				if(document.getElementById("cata5").checked == true)
				{
					alert("Only Tutorial is not available for Poster Delegate.");
					document.getElementById("cata4").focus();
					document.getElementById("cata5").checked = false;
					return false;
				}
		
		}
		
		
	} 
	*/
	
	
	
	if((document.getElementById("Single").checked == false)  &&  (document.getElementById("Group").checked == false))
	{
	    alert("Please select the Group type.");
        document.getElementById("Single").focus();
        return false;
    }
	if(document.getElementById("Group").checked == true)
	{
		if((document.getElementById("total_dele").value == "") || ( (parseInt(document.getElementById("total_dele").value)) < 2 ))
		{
			alert("Group Members Should be min. 2 & max. 7, including you.");
			document.getElementById("total_dele").focus();
			document.getElementById("total_dele").value ="";
			return false;
		}
	}
	
	

	/*
	if((document.getElementById("Cc").checked == false)  &&  (document.getElementById("Cheque").checked == false)  &&  (document.getElementById("BT").checked == false) && (document.getElementById("Dc").checked == false))
	{
	    alert("Please select the Payment Mode.");
        document.getElementById("Cc").focus();
        return false;
    }
*/
	
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
</style>
</head>

<body >

<?php include("includes/header.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr align="center" valign="bottom">
    <td height="30"><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/purpal_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/gray_round.png" width="10" height="16" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/gray_round.png" width="10" height="16" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/gray_round.png" width="10" height="16" /><img src="images/dot_line.jpg" width="40" height="16" /></td>
  </tr>
</table>

<table width="100%">
<tr align="left" valign="middle">
<td>

<table width="675" border="0" cellpadding="0" cellspacing="0" class="border_style1" style=" margin-top:20px; margin-left:400px;">
  <tr align="left" valign="top">
    <td width="601" height="35">
      <div class="style2" style="margin-left:20px;"><?php echo $EVENT_NAME; ?>: Online <?php /*?>Complimentary<?php */?> Delegate Registration Form</div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top"> 
    <td height="203" colspan="2" class="blue_text">
	<br>Thank you for visiting us! Registration for Bangalore ITE.biz 2015 is closed. Hope to see you next year!<br><br>



Regards,<br>
<?php echo $EVENT_SECRT_ADDR;?>
<br>
	<?php /*?><form action="reg_registrations2.php?ret=<?php echo $ret; ?>&exhi=<?php echo $exhi;?>&exhibitor_id=<?php echo $exhibitor_id;?>" method="post" enctype="multipart/form-data" name="bio_registration_form_1" id="bio_registration_form_1" onSubmit="return validate_reg_registration_form_1()">
	
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="631" height="16">
            <input type="hidden" name="ticket_type" id="ticket_type" value="<?php echo $temp_ticket_type;?>" />
             <?php /* ?><input  type="hidden" name="paymode" class="border_style1_1" id="Cc"  onclick="showTxt()" value="Complimentary" /><?php */ /*?>
            </td>
          </tr>
          <?php 
		  if($exhi== "E34XH3IDf6gyy77"){
		  ?>
           <tr>
             <td height="10" class="blue_text_no_padding"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
  <tr>
    <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" valign="top" class="blue_text_no_padding">Dear Exhibitor,<br>
We appreciate your interest in <?php echo $EVENT_NAME." ".$EVENT_YEAR;?>. We confirm that we have received your details of Exhibitor Directory,
Request you to kindly fill the details of Delegate Registration.<br></td>
        </tr>
    </table></td>
  </tr>
</table></td>
           </tr>
         <?php 
		 }
		 ?>
           <tr>
             <td height="10"></td>
           </tr>
           <tr>
            <td height="53"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="174" align="left" valign="top" class="blue_text_no_padding">&nbsp;Organization Type * </td>
                      <td width="18" align="center" valign="top" class="blue_text_no_padding">:</td>
                      <td width="403" align="left" valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="27" align="left" valign="top"><span class="text_black" >
                              <input name="curr" type="radio" class="border_style1_1" id="Indian" value="Indian"  required="required" />
                            </span></td>
                            <td width="148" align="left" valign="top"><label for="India7" class="blue_text_no_padding" id="form1">Indian </label></td>
                            <td width="20" align="left" valign="top"><span class="text_black" >
                              <input name="curr" type="radio" class="border_style1_1" id="Foreign" value="Foreign"  required="required" />
                            </span></td>
                            <td width="199" align="left" valign="top"><span class="blue_text_no_padding">International </span> </td>
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
            <td align="center">
			
				  <div id="cat_ind" style="display1:">
                            <table width="96%" border="0" cellspacing="0" cellpadding="0" class="border_style1">
                                             <tr valign="middle">
                                               <td align="center"><table width="96%"  cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" border="1">
                                                 <tr bgcolor="#FFFFEC">
                                                   <td width="310" height="43" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#B6CAF8" class="black_text_no_padding_13px" ><strong>Category</strong></td>
                                                   <td width="262" align="center" valign="middle" bgcolor="#B6CAF8" class="black_text_no_padding_13px"><strong>Select</strong></td>
                                                 </tr>                                                
                                                 <tr bgcolor="#FFFFEC">
                                                   <td height="35" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >For single day tariff</td>
                                                   <td align="center" valign="middle" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >Rs. 1000/-</td>
                                                 </tr>                                               
                                                 <tr bgcolor="#FFFFEC">
                                                   <td height="35" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >For all 3 day's tariff</td>
                                                   <td align="center" valign="middle" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >Rs. 2500/-</td>
                                                 </tr>
                                                 <tr bgcolor="#FFFFEC">
                                                 <td height="35" colspan="4" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >Please note: <br>
                                                 &nbsp;Service tax extra @ 14.5%<br />&nbsp;All rates are applicable per person</td>
                                                 </tr>                                                 
                                               </table></td>
                              </tr>
                            </table>
                         </div>	
											 
								</td>
          </tr>
		   <tr>
             <td height="10"></td>
           </tr>
          
		  <tr>
            <td height="9">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="174" align="left" valign="top" class="blue_text_no_padding">&nbsp;Delegate Type  * </td>
                      <td width="18" align="center" valign="top" class="blue_text_no_padding">:</td>
                      <td width="403" align="left" valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                            <td width="20" align="left" valign="top"><span class="text_black" >
                              <input name="cata_m" type="radio" class="border_style1_1" id="cata_m1" value="Standard"  required="required" />
                            </span></td>
                            <td width="61" align="left" valign="top"><label for="India7" class="blue_text_no_padding" id="form1">Standard </label></td>
                            <td width="20" align="left" valign="top"><span class="text_black" >
                              <input name="cata_m" type="radio" class="border_style1_1" id="cata_m2" value="R&D Institute and Academia"  required="required" />
                            </span></td>
                            <td width="98" align="left" valign="top"><span class="blue_text_no_padding">R&D Institute and Academia</span></td>
                            <td width="20" align="left" valign="top"><span class="text_black">
                              <input name="cata_m" type="radio" class="border_style1_1" id="cata_m3" value="GOVT"  required="required" />
                            </span></td>
                            <td width="55" align="left" valign="top"><span class="blue_text_no_padding">GOVT. </span></td>
                            <td width="17" align="left" valign="top"><span class="text_black">
                              <input name="cata_m" type="radio" class="border_style1_1" id="cata_m4" value="Other"  required="required" />
                            </span></td>
                            <td width="53" align="left" valign="top"><span class="blue_text_no_padding">Other</span></td>
                            </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
            </table>			
			</td>
          </tr>		  
		               
		   <?php ?>
           <tr>
            <td>
						
			<div id="div_mem_suppo_assoc" style="display:none;">
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="343" align="left" valign="top" class="blue_text_no_padding">&nbsp;Are <span class="formText">You Members Of Supporting Associations</span>  * </td>
                      <td width="20" align="center" valign="top" class="blue_text_no_padding">:</td>
                      <td width="234" align="left" valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="23"><span class="text_black" >
                              <input name="supo_mem" type="radio" class="border_style1_1" id="supo_mem_Yes" value="Members Of Supporting Associations" onClick="show_assoc_div()"  />
                            </span></td>
                            <td width="81"><span class="blue_text_no_padding">Yes</span></td>
                            <td width="22"><span class="text_black" >
                              <input name="supo_mem" type="radio" class="border_style1_1" id="supo_mem_No" value="No" onClick="show_assoc_div()" />
                            </span></td>
                            <td width="109"><span class="blue_text_no_padding">&nbsp;No </span> </td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
            </table>			
			</div>
			
			</td>
          </tr>
          <?php  ?>
		  
          <tr>
            <td height="12"></td>
          </tr>
		  
		   
          <tr>
            <td>
			<div id="assoc_name_div" style="display:none;">
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="40" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="171" align="left" valign="top" class="blue_text_no_padding">&nbsp;Select Association  </td>
                      <td width="22" align="center" valign="top" class="blue_text_no_padding">:</td>
                      <td width="404" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                        <tr>
                          <td width="5%" class="blue_text_no_padding"><input name="assoc_name_txt" type="radio" id="assoc_name_txt1" value="NIA" /></td>
                          <td width="22%" class="blue_text_no_padding">NIA</td>
                          <td width="5%" class="blue_text_no_padding"></td>
                          <td width="19%" class="blue_text_no_padding"></td>
                          <td width="5%" class="blue_text_no_padding"></td>
                          <td width="23%" class="blue_text_no_padding"></td>
                          <td width="5%" class="blue_text_no_padding"></td>
                          <td width="16%" class="blue_text_no_padding"></td>
                          </tr>
                        
                        
                        </table></td>
                    </tr>
                    </table></td>
              </tr>
            </table>
			</div>			</td>
          </tr>
			 
		  <tr>
            <td height="10"></td>
          </tr>
			 
		 
		  <tr>
            <td align="center">
			
				  <div id="cat_ind" style="display:">
                            <table width="96%" border="0" cellspacing="0" cellpadding="0" class="border_style1">
                                             <tr valign="middle">
                                               <td align="center"><table width="96%"  cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" border="1">
                                                 <tr bgcolor="#FFFFEC">
                                                   <td width="310" height="43" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#B6CAF8" class="black_text_no_padding_13px" ><strong>Category</strong></td>
                                                   <td width="262" align="center" valign="middle" bgcolor="#B6CAF8" class="black_text_no_padding_13px"><strong>Select</strong></td>
                                                 </tr>
                                                 <?php /*?><tr bgcolor="#FFFFEC">
                                                   <td height="35" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >&nbsp;Exhibitor</td>
                                                   <td align="center" valign="middle" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >
												   <?php 
												   if(($assoc_nm != "") && ($exhi == "") ){
												   ?>
												   <input name="cata" type="radio" class="style56" value="Exhibitors Delegate" id="cata1" onClick="show_div_user_grp_type()" disabled="disabled"   />
												    <?php 
												   }
												   elseif(($exhi != "") && ($assoc_nm == "")){
												   ?>
												   <input name="cata" type="radio" class="style56" value="Exhibitors Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
												   <?php 
												   }
												   else{
												   ?>
												    <input name="cata" type="radio" class="style56" value="Exhibitors Delegate" id="cata1" onClick="show_div_user_grp_type()"   />
													<?php
												   }
												   ?>
												   </td>
                                                 </tr><?php *//*?>
                                                 <tr bgcolor="#FFFFEC">
                                                   <td height="35" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >Delegate</td>
                                                   <td align="center" valign="middle" bgcolor="#DDDDDD" class="black_text_no_padding_13px" ><input name="cata" type="radio" class="style56" id="cata2" value="Delegate" checked="checked"/></td>
                                                 </tr>
                                                 <?php /*?><tr bgcolor="#FFFFEC">
                                                   <td height="35" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >Speaker</td>
                                                   <td align="center" valign="middle" bgcolor="#DDDDDD" class="black_text_no_padding_13px" ><input name="cata" type="radio" class="style56" value="Speaker Delegate" id="cata3" onClick="show_div_user_grp_type()"  <?php if(($assoc_nm != "") || ($exhi != "") ){?> disabled="disabled" <?php } ?> /></td>
                                                 </tr>
                                                 <tr bgcolor="#FFFFEC">
                                                   <td height="35" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >Invitee
                                                     <?php if($assoc_nm != ""){ echo "-".$assoc_nm; } ?></td>
                                                   <td align="center" valign="middle" bgcolor="#DDDDDD" class="black_text_no_padding_13px" >
												   <?php 
												   if(($assoc_nm != "") && ($exhi == "")){
												   ?>
												   <input name="cata" type="radio" class="style56" value="Invitee Delegate" id="cata4" onClick="show_div_user_grp_type()" checked="checked"  />
												   <?php 
												   }
												   elseif(($assoc_nm == "") && ($exhi != "")){
												   ?>
												   <input name="cata" type="radio" class="style56" value="Invitee Delegate" id="cata4" onClick="show_div_user_grp_type()" disabled="disabled" />
												   <?php 
												   }
												   else{
												   ?>
												    <input name="cata" type="radio" class="style56" value="Invitee Delegate" id="cata4" onClick="show_div_user_grp_type()"  />
												   <?php 
												   }
												   ?>
												   </td>
                                                 </tr><?php *//*?>
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
                            </table>
                         </div>	
											 
								</td>
          </tr>
		 
<tr>
            <td height="10"></td>
          </tr>
			 
			 
		   <tr>
            <td height="53" valign="middle"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="174" align="left" valign="top" class="blue_text_no_padding">&nbsp;<span class="content-txt-form">Single/ Group  </span> * </td>
                    <td width="22" align="center" valign="top" class="blue_text_no_padding">:</td>
                    <td width="399" align="left" valign="top">
					 <?php 
							 if(($exhi == "")){
				     ?>
					<table border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="173" align="left" valign="top"><span class="text_black" >
                          <input name="grp" type="radio" class="border_style1_1" id="Single" onClick="show_div_group_user()" value="Single" required="required" />
                          </span>
                            <label for="India7" class="blue_text_no_padding" id="form1">Single User</label></td>
                        <td width="223" align="left" valign="top"><span class="text_black" >
                          <input name="grp" type="radio" class="border_style1_1" id="Group" onClick="show_div_group_user()" value="Group" required="required"  />
                        </span><span class="blue_text_no_padding">Group Users</span> </td>
                      </tr>
                    </table>
					 <?php 
							}
							else{
							?>
								<table border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="173" align="left" valign="top"><span class="text_black" >
                          <input name="grp" type="radio" class="border_style1_1" id="Single" onClick="show_div_group_user()" value="Single" checked="checked" />
                          </span>
                            <label for="India7" class="blue_text_no_padding" id="form1">Single User</label></td>
                        <td width="223" align="left" valign="top"><span class="text_black" >
                          <input name="grp" type="radio" class="border_style1_1" id="Group" onClick="show_div_group_user()" value="Group"  disabled="disabled" />
                        </span><span class="blue_text_no_padding">Group Users</span> </td>
                      </tr>
                    </table>
					<?php
							}
				     ?>
					</td>
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
                      <td align="left" valign="top" class="black_text_no_padding_small">&nbsp; </td>
                    </tr>
                </table></td>
              </tr>
            </table>
			</div>			</td>
          </tr>
		 

          <tr>
            <td height="9"></td>
          </tr>
         
         <tr>
            <td height="80" align="center"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="29%"></td>
                <td width="4%" height="10"></td>
                <td width="42%"></td>
                <td width="25%"></td>
              </tr>
              <tr>
                <td align="left" valign="top"><span class="blue_text_no_padding">&nbsp;Payment Mode * </span></td>
                <td align="center" valign="top" class="blue_text_no_padding">:</td>
                <td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="22" align="left" valign="top"><span class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">
                        <input name="paymode" type="radio" class="border_style1_1" id="Cc"  onclick="showTxt()" value="Credit Card" required="required"/>
                      </span></td>
                      <td width="153" align="left" valign="top"><label for="India7" class="blue_text_no_padding" id="form1"> Credit Card</label></td>
                      <td width="24" align="left" valign="top"><span class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">
                        <input name="paymode" type="radio" class="border_style1_1" id="Cheque" onClick="showTxt()" value="Cheque"  required="required"/>
                      </span></td>
                      <td width="200" align="left" valign="top"><span class="blue_text_no_padding">Cheque / DD</span></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="10"></td>
                <td></td>
                <td colspan="2"></td>
              </tr>
              <tr>
                <td >&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="22" align="left" valign="top"><span class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">
                        <input name="paymode" type="radio" class="border_style1_1" id="BT" onClick="showTxt()" value="Bank Transfer" required="required"/>
                      </span></td>
                      <td width="154" align="left" valign="top"><label for="India9" class="blue_text_no_padding" id="form1"> Bank Transfer </label></td>
                      <td width="25" align="left" valign="top" class="blue_text_no_padding"><span class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">
                        <input name="paymode" type="radio" class="border_style1_1" id="Dc"  onclick="showTxt()" value="Debit Card" required="required"/>
                      </span></td>
                      <td width="198" align="left" valign="top" class="blue_text_no_padding"><span class="blue_text_no_padding">Debit Card</span></td>
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
            <td height="10">
			<div id="pay1" style="display:none;" >			
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
              <tr>
                <td width="100%" height="80" align="center" valign="middle"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
                  
                  <tr>
                    <td width="100%" height="44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						          
						          <tr>
						            <td colspan="2" align="left" valign="top"><strong class="text_black"  style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">&nbsp;Note:-</strong></td>
                                          </tr>
						          <tr>
						            <td colspan="2"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top"><li></li></td>
                                        <td align="left" valign="top"><span class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">The Card used to pay the delegate fee will have to be produced at the time of Registration. </span></td>
                                        </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top"><li></li></td>
                                        <td align="left" valign="top"><span class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">If the holder of the card is not the delegate, then the delegate should possess: </span></td>
                                        </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top"><li></li></td>
                                        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="5%" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">a.)</td>
                                            <td width="95%"><span class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">A   Photocopy of both sides of the card, which will have to be self attested by the   card holder authorising the use of the card for the delegate registration fee.   For security reasons, please strike out the Card Verification Value (CVV) code   on the copy of your card.</span></td>
                                            </tr>
                                        </table></td>
                                        </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="5%" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">b.)</td>
                                            <td width="95%"><span class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">This Photocopy should also contain the name   of the delegate</span></td>
                                          </tr>
                                        </table></td>
                                        </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        </tr>
                                      <tr>
                                        <td width="4%">&nbsp;</td>
                                        <td width="3%" align="left" valign="top"><li></li></td>
                                        <td width="93%" align="left" valign="top"><span class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">The above document MUST be produced at the Registration Desk at <strong><?php echo $EVENT_NAME; ?></strong>. If the delegate fails to comply with these  conditions, <span class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><strong><?php echo $EVENT_NAME; ?></strong></span><strong> Secretariat</strong>&nbsp; reserves the right to deny the   delegate from attending the event</span></td>
                                        </tr>
                                      
                                      
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        </tr>
                                    </table></td>
                                          </tr>
						          <tr>
						            <td width="2%">&nbsp;</td>
                                          <td width="98%" align="left">&nbsp;</td>
                                        </tr>
						          </table></td>
                    </tr>
                </table></td>
              </tr>              
            </table>
			</div>	
			
			
			<div id="pay2" style="display:none;" >			
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
              <tr>
                <td width="100%" height="80" align="center" valign="middle"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
                  
                  <tr>
                    <td width="100%" height="44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="3%" height="7"></td>
                          <td width="47%"></td>
                          <td width="25%"></td>
                          <td width="25%"></td>
                        </tr>
                      
                       
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="3" align="left"><span style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">Please send your cheque/DD in favour of &nbsp;                              <strong><?php echo $EVENT_NAME; ?></strong> payable at <?php echo $EVENT_CHEQUE_PAYBLE_AT;?>.<br /> 
                            Along with the copy of your registration receipt and send to<br />
                            </span>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="16%" align="left" valign="top"><span style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><strong>Address :</strong></span></td>
                                <td width="84%" align="left" valign="top"><span style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">
                                    <?php echo $EVENT_NAME; ?> Secretariat <br />
<?php echo $EVENT_SECRT_ADDR;?></span></td>
                              </tr>
                            </table>
                            </td>
                          </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>              
            </table>
			</div>	
			
			
			<div id="pay3" style="display:none;" >			
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
              <tr>
                <td width="100%" height="80" align="center" valign="middle"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
                  
                  <tr>
                    <td width="100%" height="44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						          <tr>
						            <td width="3%">&nbsp;</td>
                                          <td width="94%">&nbsp;</td>
                                          <td width="3%">&nbsp;</td>
                                        </tr>
						          <tr>
						            <td>&nbsp;</td>
                                          <td align="left" valign="top"  style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><strong>Indian Delegates</strong> are requested to Bank Transfer the registration fees to the following account
                                          </strong></p>
                                            <p><strong>Account Name: </strong>MM ACTIV SCI-TECH COMMUNICATIONS PVT.LTD<br />
                                              <strong>Account Type :</strong> Current Account<br />
                                              <strong>Account Number :</strong> 2827 241 000004<br />
                                              <strong>Name &amp; Address of Bank :</strong> Canara Bank<br />
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;K.S.F.C Complex Branch, <br />
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (DP Code No.: 2827) <br />
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bank Address: <br />
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No.1/1, KSFC Bhavan, <br />
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thimmaiah Road , Millers Tank Bed, <br />
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bangalore - 560 052, INDIA<br />
                                              <br />
                                              <strong>Contact Person :</strong> Mr. Mohammed Ghouse (Sr.Manager)<br />
                                              <strong>Bank email :</strong>  <a href="mailto:blr2827@canbank.co.in" target="_blank">blr2827@canbank.co.in</a><br />
                                              <strong>Bank Telephone No. : </strong>080-22371789<br />
                                              <strong>Bank SWIFT Code No. : </strong>CNRBINBBLFD </td>
                                          <td>&nbsp;</td>
                                        </tr>
						             <tr>
						            	  <td height="2" bgcolor="#DADADA"></td>
                                          <td bgcolor="#DADADA"></td>
                                          <td bgcolor="#DADADA"></td>
                                  	</tr>
									<tr>
						            	  <td>&nbsp;</td>
                                          <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><p><br />
                                                <strong>International Delegates</strong> are requested to Wire Transfer(Bank Transfer) the registration fees to the following account
                                            </strong>
                                            </p>
 </p>
                                            <p><strong>Account Name: </strong>MM ACTIV SCI-TECH COMMUNICATIONS PVT.LTD<br />
                                              <strong>Account Type :</strong> Current Account<br />
                                              <strong>Account Number :</strong> 2827 241 000004<br />
                                              <strong>Name &amp; Address of Bank :</strong> Canara Bank<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;K.S.F.C Complex Branch, <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (DP Code No.: 2827) <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bank Address: <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No.1/1, KSFC Bhavan, <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thimmaiah Road , Millers Tank Bed, <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bangalore - 560 052, INDIA<br />
<br />
<strong>Contact Person :</strong> Mr. Mohammed Ghouse (Sr.Manager)<br />
<strong>Bank email :</strong> <a href="mailto:blr2827@canbank.co.in" target="_blank">blr2827@canbank.co.in</a><br />
<strong>Bank Telephone No. : </strong>080-22371789<br />
<strong>Bank SWIFT Code No. : </strong>CNRBINBBLFD<br /></p></td>
                                          <td>&nbsp;</td>
                                  	</tr>
						          </table></td>
                    </tr>
                </table></td>
              </tr>              
            </table>
			</div>	
			
			
			
			<div id="pay4" style="display:none;" >			
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
              <tr>
                <td width="100%" height="80" align="center" valign="middle"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
                  
                  <tr>
                    <td width="100%" height="44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top">&nbsp;</td>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top" class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;">&nbsp;</td>
                        <td align="left" valign="top" class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"> We Accept Following Banks Debit Cards, Please Check and Proceed<br />
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="50%">&nbsp;</td>
                                <td width="50%">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Axis Bank [ Visa Electron only ]</li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Canara Bank Debit Card </li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> City Bank Debit Card Only </li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Corporation Bank Debit Card [ Visa Electron only ] </li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Deutsche Bank Debit Card [ Visa Electron only ] </li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> HDFC Bank Debit Card [ Visa Electron only ]</li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> ICICI Bank Debit Card </li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Indian Overseas Bank Debit Card [ Visa Electron only ] </li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> ING Vysya Bank Debit Card [ Visa Electron only ]</li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Karur Vysya Bank Debit Card [ Visa Electron only ] </li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Punjab Nation Bank Debit Card [ Visa Electron only ] </li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li>State Bank Of India Debit Card </li></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="top">&nbsp;</td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2"></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                          </table></td>
                      </tr>
                    </table></td>
                    </tr>
                </table></td>
              </tr>              
            </table>
			</div>	
			
			
			<div id="pay5" style="display:none;" >			
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
              <tr>
                <td width="100%" height="80" align="center" valign="middle"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
                  
                  <tr>
                    <td width="100%" height="44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="text_black" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"> We Accept i-Banking Payments From Following Banks,&nbsp; Please Check and Proceed<br />
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="49%">&nbsp;</td>
                                <td width="51%">&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Axis Bank</li></td>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> ABN AMRO Bank </li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li>Bank Of India </li></td>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li>Bank Of Rajasthan </li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> City Bank Account Only </li></td>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Corporation Bank</li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Fedral Bank</li></td>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> HDFC Pay</li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> ICICI Bank</li></td>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> IDBI Bank</li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Indusind Bank</li></td>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Jammu and Kashmir Bank</li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Karur Vysya Net Banking</li></td>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Kotak Mahindra Bank</li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Oriental Bank Of Commerce</li></td>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Punjab National Bank</li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> South India Bank</li></td>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> State Bank Of India</li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> State Bank Of Travancare </li></td>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Union Bank Of India</li></td>
                              </tr>
                              <tr>
                                <td height="7" colspan="2" align="left" valign="top"></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Vijaya Net Banking</li></td>
                                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#666666;text-decoration:none;"><li> Yes Bank </li></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top">&nbsp;</td>
                                <td align="left" valign="top">&nbsp;</td>
                              </tr>
                          </table></td>
                      </tr>
                    </table></td>
                    </tr>
                </table></td>
              </tr>              
            </table>
			</div>			</td>
          </tr>
          
          
           <tr>
             <td height="50" ><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
               <tr>
                 <td width="100%" height="44"><table border="0" align="center" cellpadding="0" cellspacing="0">
                     <tr>
                       <td width="179" align="left" valign="top" class="blue_text_no_padding">&nbsp;Enter Verification Code * </td>
                       <td width="29" align="center" valign="top" class="blue_text_no_padding">:</td>
                       <td width="169" align="left" valign="top"><input name="vercode" type="text" class="border_style1_1" id="vercode" placeholder="Verification Code" required maxlength="10" /></td>
                       <td width="115" align="center" valign="middle" background="images/verify_img_bg.JPG" style="background-repeat:repeat-x;font-family:Arial, Helvetica, sans-serif; font-size:16px;"><strong><?php echo $text;?></strong></td>
                       <td width="103" align="left" valign="top">&nbsp;
                           <input name="test" type="hidden" id="test" value="<?php echo $text; ?>" /></td>
                     </tr>
                 </table></td>
               </tr>
             </table></td>
           </tr>
           <tr>
            <td height="23" class="blue_text_normal">Terms of Service : By clicking on 'I accept' below you are agreeing to the<span style="color:#396bb2;"> Terms and Conditions.</span></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
          </tr>
          <?php 
		  
		  ?>
          
          <tr>
            <td><table width="596" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left">
                <input type="button" class="blue_text" value="Cancel" width="118" height="28" style="background-color:#dadada;" />                              </td>
                <td align="right">
                <input name="Submit" type="submit" class="blue_text"  style="background-color:#dadada;" value="I accept" width="118" height="28" />                </td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        </tr>
      </table>
	  </form><?php */?>
	  
	  </td>
  </tr>
  </table>
<?php ?>
</td>
</tr>
</table>
<?php include("includes/footer.php");?>


</body>
</html>
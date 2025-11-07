<?php  
	session_start(); 
	if(($_POST["vercode_ex"] != $_SESSION["vercode_ex"]) || ($_SESSION["vercode_ex"]==''))  
	{ 
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
		exit; 
	}
	require "includes/form_constants.php";

	require "dbcon_open.php";
	
	
	
	$temp_booth_no = @$_POST['booth_no'];
	$temp_booth_area = @$_POST['booth_area'];
	$temp_booth_area_unit = @$_POST['booth_area_unit'];
	$temp_fascia_name = @$_POST['fascia_name'];
	$temp_fascia_name = trim($temp_fascia_name);
	
	$temp_fascia_name_up = strtoupper($temp_fascia_name);
	
	$temp_exhi_name = @$_POST['exhi_name'];
	$temp_exhi_name = trim($temp_exhi_name);
	$temp_exhi_name_up = strtoupper($temp_exhi_name);
	$temp_exhi_name_upwc = ucwords($temp_exhi_name);				
	
	$temp_cp_title = @$_POST['cp_title'];
	$temp_cp_title = trim($temp_cp_title);
	
	$temp_cp_fname = @$_POST['cp_fname'];
	$temp_cp_fname = trim($temp_cp_fname);
	
	$temp_cp_mname = @$_POST['cp_mname'];
	$temp_cp_mname = trim($temp_cp_mname);	
	
	$temp_cp_lname = @$_POST['cp_lname'];
	$temp_cp_lname = trim($temp_cp_lname);
	
	$temp_desig = @$_POST['desig'];
	$temp_desig = trim($temp_desig);
	
	$temp_addr1 = @$_POST['addr1'];
	$temp_addr2 = @$_POST['addr2'];
	$temp_city = @$_POST['city'];
	$temp_state = @$_POST['state'];
	$temp_country = @$_POST['country'];
	$temp_zip = @$_POST['zip'];
	$temp_fon_cntry = @$_POST['fon_cntry'];
	$temp_fon_area = @$_POST['fon_area'];
	$temp_fon = @$_POST['fon'];
	$temp_mob_cntry = @$_POST['mob_cntry'];
	$temp_mob = @$_POST['mob'];
	$temp_fax_cntry = @$_POST['fax_cntry'];
	$temp_fax_area = @$_POST['fax_area'];
	$temp_fax = @$_POST['fax'];
	$temp_email = @$_POST['email'];
	$temp_email = trim($temp_email);
	$temp_website = @$_POST['website'];
	$temp_reg_date = date("Y-m-d");
	$temp_reg_time = date("H:i:s a");
	$temp_reg_id = @$_POST['vercode_ex'];
	$temp_profile = @$_POST['exbhi_profile'];
	$temp_profile = mysqli_real_escape_string($link,$temp_profile);
	
	/*****
		Start Addmin in session
	*****/
	
		$_SESSION['sess_booth_no'] = $temp_booth_no;
		$_SESSION['sess_booth_area'] = $temp_booth_area;
		$_SESSION['sess_booth_area_unit'] = $temp_booth_area_unit;
		$_SESSION['sess_fascia_name'] = $temp_fascia_name;	
		
		$_SESSION['sess_exhi_name'] = $temp_exhi_name;				
		$_SESSION['sess_cp_title'] = $temp_cp_title;
		$_SESSION['sess_cp_fname'] = $temp_cp_fname;
		$_SESSION['sess_cp_mname'] = $temp_cp_mname;
		$_SESSION['sess_cp_lname'] = $temp_cp_lname;
		$_SESSION['sess_desig'] = $temp_desig;
		$_SESSION['sess_addr1'] = $temp_addr1;
		$_SESSION['sess_addr2'] = $temp_addr2;
		$_SESSION['sess_city'] = $temp_city;
		$_SESSION['sess_state'] = $temp_state;
		$_SESSION['sess_country'] = $temp_country;
		$_SESSION['sess_zip'] = $temp_zip;
		$_SESSION['sess_fon_cntry'] = $temp_fon_cntry;
		$_SESSION['sess_fon_area'] = $temp_fon_area;
		$_SESSION['sess_fon'] = $temp_fon;
		$_SESSION['sess_mob_cntry'] = $temp_mob_cntry;
		$_SESSION['sess_mob'] = $temp_mob;
		$_SESSION['sess_fax_cntry'] = $temp_fax_cntry;
		$_SESSION['sess_fax_area'] = $temp_fax_area;
		$_SESSION['sess_fax'] = $temp_fax;
		$_SESSION['sess_email'] = $temp_email;
		$_SESSION['sess_website'] = $temp_website;
		$_SESSION['sess_vercode_ex'] = $temp_reg_id;
		$_SESSION["vercode_ex"] = $temp_reg_id;
		 
		$temp_reg_date = date("Y-m-d");
		$temp_reg_time = date("H:i:s a");
		
		
		$temp_profile = @$_POST['exbhi_profile'];
		$temp_profile_len = strlen($temp_profile);
		
		$_SESSION['sess_exbhi_profile'] = $temp_profile;
		$temp_profile = mysqli_real_escape_string($link,nl2br($temp_profile));
		
		if($temp_profile_len >750){
			echo "<script language='javascript'>alert('Please Enter Profile less than 750 characters.');</script>";
			echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
			exit; 
		}
		
	/*****
		End Adding in session
	*****/
	
		$temp_exhi_name_lower = strtolower($temp_exhi_name);
	
		// start checking duplicate exhibitor entry
			$qr_chk_exb_dup_name_id = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS WHERE (LOWER(exhibitor_name)='$temp_exhi_name_lower') ");
			$qr_chk_exb_dup_name_id_num_rows = 0;
			$qr_chk_exb_dup_name_id_num_rows = mysqli_num_rows($qr_chk_exb_dup_name_id);
			if($qr_chk_exb_dup_name_id_num_rows>0){
				
				$qr_chk_exb_dup_name_id = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS WHERE (LOWER(exhibitor_name)='$temp_exhi_name_lower') ");
				$qr_chk_exb_dup_name_id_ans_rows = mysqli_fetch_array($qr_chk_exb_dup_name_id);
				if( ($qr_chk_exb_dup_name_id_ans_rows['reg_id']== $_SESSION["vercode_ex"]) ){
					
					mysqli_query($link,"delete from $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS where reg_id='$qr_chk_exb_dup_name_id_ans_rows[reg_id]' ");
					mysqli_query($link,"delete from $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS where exhibitor_id='$qr_chk_exb_dup_name_id_ans_rows[exhibitor_id]' ");
					
					
				}
				else
				{				
					echo "<script language='javascript'>alert('Exhibitor- $temp_exhi_name is already registerd with us.');</script>";
					echo "<script language='javascript'>window.location = ('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');</script>";
					exit;
				} 
			}
		// end checking duplicate exhibitor entry
	
	
	
	if( ($temp_exhi_name == "") || ($temp_cp_title == "") || ($temp_cp_fname == "") || ($temp_cp_lname == "") || ($temp_desig == "") || ($temp_addr1 == "") || ($temp_city == "") || ($temp_state == "") || ($temp_country == "") || ($temp_zip == "") || ($temp_fon_cntry == "") || ($temp_fon_area == "") || ($temp_fon == "") || ($temp_mob_cntry == "") || ($temp_mob == "") || ($temp_fax_cntry == "") || ($temp_fax_area == "") || ($temp_fax == "") || ($temp_email == "") || (
$temp_website == "") || ($temp_reg_id == "") || ($temp_profile == "")  || ($temp_booth_area == "") || ($temp_booth_area_unit == "") || ($temp_fascia_name == "") ){
			//session_destroy();
			echo "<script language='javascript'>alert('Please Enter Complete Details.');</script>";
			echo "<script language='javascript'>window.location='exhibitors_form.php?rt=retds4fn324rn_ed24d3it';</script>";
			exit;
	
	}
	
	$total_exbhitors = (round($temp_booth_area/9)*2);
	$temp_total_exbhitors=$total_exbhitors;
	$total_exbhitors_max_flag = "False";
	
	if($total_exbhitors >5){	
		$total_exbhitors = 5;
		$total_exbhitors_max_flag = "True";	
	}
	
	//if(($temp_booth_area<9) && (($temp_booth_area>1)) ){
	if(($temp_booth_area<9)){
			echo "<script language='javascript'>alert('Booth/ Stall area should be greator or equal to 9sqm');</script>";
			echo "<script language='javascript'>window.location='exhibitors_form.php?rt=retds4fn324rn_ed24d3it';</script>";
			exit;
	}
	
	if($total_exbhitors <= 0){
			//session_destroy();
			echo "<script language='javascript'>alert('Please Enter Correct Booth/Pavilion Area Details.');</script>";
			echo "<script language='javascript'>window.location='exhibitors_form.php?rt=retds4fn324rn_ed24d3it';</script>";
			exit;
	}
	
	$temp_website = "http://".$temp_website;
	
	$i_ex_cnt = 0; 
	$exhibitor_id_ex = "";
	
	do
	{	
		$i_ex_cnt = 0; 
		$exhibitor_id_ex = "BIN2015_EXB_".mt_rand(1,9999);
		
			
		$chq_ex_qr = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS WHERE exhibitor_id = '$exhibitor_id_ex'")or die(mysqli_error($link));
		$chq_ex_no = mysqli_num_rows($chq_ex_qr); 
		
		if($chq_ex_no < 1)
		{
			$i_ex_cnt++;
		}
		else
		{
			continue;
		}
	}while(!($i_ex_cnt == 1));
	
	mysqli_query($link,"insert  into $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS(order_no,exhibitor_id,exhibitor_name,cp_title,cp_fname,cp_mname,cp_lname,cp_desig,cntry_code_phone,area_code_phone,phone,cntry_code_fax,area_code_fax,fax,cntry_code_mob,mob,email,website,address_line_1,address_line_2,city,state,country,zip,profile,area_by_executive,area_unit_by_executive,reg_date,reg_time,reg_id,booth_no,booth_area,booth_area_unit,fascia_name,total_exbhitors) values ('','$exhibitor_id_ex','$temp_exhi_name','$temp_cp_title','$temp_cp_fname','$temp_cp_mname','$temp_cp_lname','$temp_desig','$temp_fon_cntry','$temp_fon_area','$temp_fon','$temp_fax_cntry','$temp_fax_area','$temp_fax','$temp_mob_cntry','$temp_mob','$temp_email','$temp_website','$temp_addr1','$temp_addr2','$temp_city','$temp_state','$temp_country','$temp_zip','$temp_profile','','','$temp_reg_date','$temp_reg_time','$temp_reg_id','$temp_booth_no','$temp_booth_area','$temp_booth_area_unit','$temp_fascia_name','$temp_total_exbhitors') ")or die(mysqli_error($link));
	

	
		echo "<script language='javascript'>var total_delegates = '$total_exbhitors';</script>";
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $EVENT_NAME." ".$EVENT_YEAR;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	
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
	
	

function chk_act()
{
	if(document.getElementById("find_us").value == "Others")
	{
		document.getElementById("oth").style.display = "block";
		document.getElementById("specify").focus();		
	}
	else
	{
		document.getElementById("oth").style.display = "none";
	}
}
	

</script>

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "simple",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<script type="text/javascript">
function countChar(val)
{
	var len = val.value.length;
	if (len > 800) 
	{
		val.value = val.value.substring(0, 800);
	}
	else 
	{
		$('#count').text(800 - len);
	}
};

function validate_ex2()
{
		var nt_fill_cnt = 0;
		var fill_cnt = 0;
		
		
	total_delegates = 2;	
	for(var j=1;j<=total_delegates;j++)
	{
		if(document.getElementById("title"+j).value == "")
		{
			alert("Please fill exhibitor "+j+"'s title ");
			document.getElementById("title"+j).focus();
			return false;
			
			/*nt_fill_cnt++;
			continue;*/
		}
		
		if(document.getElementById("fname"+j).value == "")
		{
			alert("Please fill exhibitor "+j+"'s first name");
			document.getElementById("fname"+j).focus();
			return false;
			
			/*nt_fill_cnt++;
			continue;*/
		}
		if(document.getElementById("lname"+j).value == "")
		{
			alert("Please fill exhibitor "+j+"'s last name");
			document.getElementById("lname"+j).focus();
			return false;
			
			/*nt_fill_cnt++;
			continue;*/
		}
		if(document.getElementById("desig"+j).value == "")
		{
			alert("Please fill exhibitor "+j+"'s Designation");
			document.getElementById("desig"+j).focus();
			return false;
			
			/*nt_fill_cnt++;
			continue;*/
		}
		if(document.getElementById("dept"+j).value == "")
		{
			
			alert("Please fill exhibitor "+j+"'s department name");
			document.getElementById("dept"+j).focus();
			return false;
			
			/*nt_fill_cnt++;
			continue;*/
		}
		
		
	}
	/*
	fill_cnt = parseInt(total_delegates-nt_fill_cnt);
	
	if(nt_fill_cnt>0){
	
		var r=confirm("You have not entered "+nt_fill_cnt+"exhibitor(s) data. Are you sure you want proceed?");		
		if(r == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else{
		
		return true;
	}
	*/
	
	
}


</script>
<style type="text/css">
<!--
.style9 {font-size: 14px}
-->
</style>
</head>
<body >
<?php include("includes/header.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center" valign="bottom">
    <td height="30"><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/green_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/purpal_round.png" width="14" height="14" /><img src="images/dot_line.jpg" width="40" height="16" /><img src="images/gray_round.png" width="10" height="16" /><img src="images/dot_line.jpg" width="40" height="16" /></td>
  </tr>
</table>
<table width="100%">
<tr align="CENTER" valign="middle">
<td >

<table width="1117" border="0" cellpadding="0" cellspacing="0" class="border_style1" style=" margin-top:20px; ">
  <tr align="left" valign="top">
    <td width="604" height="39">
      <div class="style2" style="margin-left:20px;"><span class="style2" style="margin-left:20px;"><?php echo $EVENT_NAME." ".$EVENT_YEAR;?> : Exhibitors Directory Form</span> : Enter Exhibitors Details</div>      </td>
    </tr>

		
  <tr align="left" valign="top">
    <td>
	
	<form id="form1" name="form1" method="post" action="exhibitors_form2.php" onsubmit="return validate_ex2()">
	
	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1094" height="0"></td>
          </tr>
          		  
          

		  <tr>
		    <td height="0" valign="middle">&nbsp;</td>
		    </tr>
		  <tr>
            <td height="0" valign="middle"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                   <tr>
                      <td width="223" height="8" align="left" valign="top" ></td>
                      <td width="15" align="center" valign="top"></td>
                      <td width="791" align="left" valign="top"></td> 
                    </tr>
                  
				   <tr>
				     <td height="8" colspan="3" align="left" valign="top" class="blue_text_no_padding" >These names are for the exhibitor badges who would be manning the exhibition booth. <br />
				       To registere delegate  who would be attending the conference link is available on next page.
				         <input type="hidden" name="speaker_event_name" id="speaker_event_name" value="<?php echo $EVENT_NAME;?>" />
				       <input type="hidden" name="speaker_event_year" id="speaker_event_year" value="<?php echo $EVENT_YEAR;?>" /></td>
				     </tr>
				   
				   <tr>
                      <td align="left" valign="top" height="8" ></td>
                      <td align="center" valign="top"></td>
                      <td align="left" valign="top"></td>
                    </tr>
                </table></td>
                </tr>
            </table></td>
          </tr>
		  
		  			  <tr>
		  	    <td height="0" valign="middle"></td>
		  	    </tr>
		  	          <tr>
		  	            <td height="0" valign="middle">&nbsp;</td>
	  	              </tr>
		  	          

              
              <tr>
            <td height="0">
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left">
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                	<tr>
                      <td align="left" valign="top" height="8" ></td>
                      <td align="center" valign="top"></td>
                      <td align="left" valign="top"></td>
                    </tr>
					    				
                    
                    <tr>
                      <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                      <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                      <td align="left" valign="top">&nbsp;</td>
                    </tr>
                    <?php
								  	for($i_exb = 1; $i_exb<=$total_exbhitors;$i_exb++)
									{								  
								  ?>
                    <tr>
                      <td colspan="3" align="left" valign="top" class="blue_text_no_padding"> 
					  Personal Information of Exhibitors&nbsp;
					  <?php
								  	if($total_exbhitors > 1)
									{	
										echo $i_exb.":";	
									}	 
						 ?>	<?php if($i_exb<=2){?> *<?php } ?>							  </td>
                      </tr>
                    <tr>
                      <td colspan="3" align="left" valign="top" height="10"></td>
                      </tr>
                    <tr>
                      <td width="222" align="left" valign="top" class="black_text_no_padding_normal">&nbsp;Contact Person Name<?php if($i_exb<=2){?> *<?php } ?></td>
                      <td width="17" align="center" valign="top" class="black_text_no_padding_normal">:</td>
                      <td width="792" align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="31%" align="left" valign="top"><table>
                              <tr>
                                <td valign="top"><select name="title<?php echo $i_exb;?>" id="title<?php echo $i_exb;?>">
                                    <option value="" selected="selected">Select</option>
                                    <option value="Mr." >Mr.</option>
                                    <option value="Mrs." >Mrs.</option>
                                    <option value="Miss." >Miss.</option>
                                    <option value="Ms." >Ms.</option>
                                    <option value="Dr." >Dr.</option>
                                    <option value="Prof." >Prof.</option>
                                  </select>                                </td>
                                <td valign="top"><input name="fname<?php echo $i_exb;?>" id="fname<?php echo $i_exb;?>" type="text"  /> </td>
                              </tr>
                          </table></td>
                          <td width="21%" align="left" valign="middle" ><input name="mname<?php echo $i_exb;?>" id="mname<?php echo $i_exb;?>" type="text" /></td>
                          <td width="48%" align="left" valign="middle" ><input name="lname<?php echo $i_exb;?>" id="lname<?php echo $i_exb;?>"  type="text"  /></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"><table width="218">
                              <tr>
                                <td width="74" align="center"><span  class="black_text_no_padding_small"> Title<?php if($i_exb<=2){?> *<?php } ?></span></td>
                                <td width="132" align="left"><span  class="black_text_no_padding_small"> First Name<?php if($i_exb<=2){?> *<?php } ?></span></td>
                              </tr>
                          </table></td>
                          <td align="left" valign="top"><span  class="black_text_no_padding_small">Middile Name</span></td>
                          <td align="left" valign="top"><span  class="black_text_no_padding_small">Last Name<?php if($i_exb<=2){?> *<?php } ?></span> </td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="black_text_no_padding_normal">&nbsp;Designation<?php if($i_exb<=2){?> *<?php } ?> </td>
                      <td align="center" valign="top" class="black_text_no_padding_normal">:</td>
                      <td align="left" valign="top"><input name="desig<?php echo $i_exb;?>"  id="desig<?php echo $i_exb;?>"  type="text"    size="62"/></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="black_text_no_padding_normal">&nbsp;Department<?php if($i_exb<=2){?> *<?php } ?></td>
                      <td align="center" valign="top" class="black_text_no_padding_normal">:</td>
                      <td align="left" valign="top"><input name="dept<?php echo $i_exb;?>"  id="dept<?php echo $i_exb;?>"  type="text"    size="62"/></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="black_text_no_padding_normal">&nbsp;Email Id<?php if($i_exb<=2){?> *<?php } ?> </td>
                      <td align="center" valign="top" class="black_text_no_padding_normal">:</td>
                      <td align="left" valign="top"><input name="email<?php echo $i_exb;?>"  id="email<?php echo $i_exb;?>"  type="text"    size="62"/></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="black_text_no_padding_normal">&nbsp;</td>
                      <td align="center" valign="top" class="black_text_no_padding_normal">&nbsp;</td>
                      <td align="left" valign="top">&nbsp;</td>
                    </tr>
                    
					 <?php 
					 }
					 ?>
					 <tr>
                      <td colspan="3" align="left" valign="top" class="blue_text_no_padding"><span class="style2 style9">If you want more Exhibitors please contact our executive <br />
                      </span>Name: <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_NAME;?><br />
                        Email: <a href="mailto:<?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_EMAIL;?>"><?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_EMAIL;?></a><br />
                        Mobile:  <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_MOBILE_NO;?><br />
                        Phone: <?php echo $EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_PHONE_NO;?></td>
                      </tr>
					 <tr>
                      <td align="left" valign="top" height="8" ></td>
                      <td align="center" valign="top"></td>
                      <td align="left" valign="top"></td>
                    </tr>
            </table>			</td>
         </tr>
            </table>		</td>
          </tr>
		      <tr>
		        <td height="0" valign="middle"></td>
		        </tr>
              <tr>
                <td height="0">&nbsp;</td>
              </tr>
              		
          <tr>
            <td height="0">
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style1">
              <tr>
                <td width="100%" height="36" align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="206" align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                      <td width="18" align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                      <td width="805" align="left" valign="top">&nbsp;</td>
                    </tr>				
                    <tr>
                      <td align="right" valign="top" ><input type="button" name="Button" value="&lt;&lt; back"  onclick="window.location=('exhibitors_form.php?rt=retds4fn324rn_ed24d3it');" /></td>
                      <td width="18" align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                      <td width="805" align="left" valign="top"><span class="text">
                        <input name="Submit2" type="submit" class="text-red" value="Submit" />
                      </span></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="blue_text_no_padding">&nbsp;</td>
                      <td align="center" valign="top" class="blue_text_no_padding">&nbsp;</td>
                      <td align="left" valign="top" class="black_text_no_padding_small">&nbsp;</td>
                    </tr>
            </table>			</td>
         </tr>
            </table>		</td>
          </tr>			  			  			  		  	  			  	
          <tr>
            <td height="19" class="blue_text_normal">&nbsp;</td>
          </tr>
          
        </table></td>
        </tr>
      </table>
	  </form>	  </td>
  </tr>
  </table>
</td>
</tr>
</table>
<?php include("includes/footer.php");?>


</body>
</html>
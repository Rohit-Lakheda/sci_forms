<?php 
 
require "includes/form_constants.php";

require "rsvp_reg_comp_captcha.php";
$cata_type=$_REQUEST["cata_type"];

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
function showDel()
{
	if(document.getElementById("Corporate").checked == true)
	{
		document.getElementById("del1").style.display = "block";			
		document.getElementById("del2").style.display = "none";	
		document.getElementById("del3").style.display = "none";
		//document.getElementById("daycata1").checked=false;
		document.getElementById("daycata3").checked=false;
		//document.getElementById("daycata5").checked=false;
		//document.getElementById("daycata6").checked=false;	
		document.getElementById("daycata7").checked=false;	
		document.getElementById("daycata8").checked=false;	
		document.getElementById("daycata2").checked=false;
		//document.getElementById("daycata4").checked=false;	
		document.getElementById("regday2_1").checked == false;
		document.getElementById("regday2_2").checked == false;	
		
		
	}
	if(document.getElementById("Government").checked == true)
	{
		document.getElementById("del1").style.display = "block";			
		document.getElementById("del2").style.display = "none";	
		document.getElementById("del3").style.display = "none";	
		//document.getElementById("daycata1").checked=false;
		document.getElementById("daycata3").checked=false;
		//document.getElementById("daycata5").checked=false;
		//document.getElementById("daycata6").checked=false;	
		document.getElementById("daycata7").checked=false;	
		document.getElementById("daycata8").checked=false;	
		document.getElementById("daycata2").checked=false;
		//document.getElementById("daycata4").checked=false;
		//document.getElementById("regday2_1").checked == false;
		//document.getElementById("regday2_2").checked == false;		
		
				
	}
	if(document.getElementById("R&D").checked == true)
	{
		document.getElementById("del1").style.display = "block";			
		document.getElementById("del2").style.display = "none";	
		document.getElementById("del3").style.display = "none";
		//document.getElementById("daycata1").checked=false;
		document.getElementById("daycata3").checked=false;
		//document.getElementById("daycata5").checked=false;
		//document.getElementById("daycata6").checked=false;	
		document.getElementById("daycata7").checked=false;	
		document.getElementById("daycata8").checked=false;		
		document.getElementById("daycata2").checked=false;	
		//document.getElementById("daycata4").checked=false;
		//document.getElementById("regday2_1").checked == false;
		//document.getElementById("regday2_2").checked == false;	
		
		
	}
	if(document.getElementById("Academia").checked == true)
	{
		document.getElementById("del1").style.display = "block";			
		document.getElementById("del2").style.display = "none";	
		document.getElementById("del3").style.display = "none";
		//document.getElementById("daycata1").checked=false;
		document.getElementById("daycata3").checked=false;
		//document.getElementById("daycata5").checked=false;
		//document.getElementById("daycata6").checked=false;	
		document.getElementById("daycata7").checked=false;	
		document.getElementById("daycata8").checked=false;	
		document.getElementById("daycata2").checked=false;
		//document.getElementById("daycata4").checked=false;
		//document.getElementById("regday2_1").checked == false;
		//document.getElementById("regday2_2").checked == false;		
		
		
	}
	if(document.getElementById("Students").checked == true)
	{   
	    document.getElementById("del1").style.display = "none";	
		document.getElementById("del2").style.display = "block";	
		document.getElementById("del3").style.display = "none";	
		//document.getElementById("daycata1").checked=false;
		document.getElementById("daycata3").checked=false;
		//document.getElementById("daycata5").checked=false;
		document.getElementById("daycata2").checked=false;	
		document.getElementById("daycata7").checked=false;	
		//document.getElementById("daycata4").checked=false;	
		//document.getElementById("daycata6").checked=false;	
		document.getElementById("daycata8").checked=false;	
		//document.getElementById("regday2_1").checked == false;
		//document.getElementById("regday2_2").checked == false;	
		
	}
	
	
}

function showday2()
{
	
	/*if(document.getElementById("daycata2").checked == true || document.getElementById("daycata4").checked == true)
	 { 
	    //alert("in");
	    document.getElementById("del3").style.display = "block";
		document.getElementById("regday2_1").checked == false;
		document.getElementById("regday2_2").checked == false;
	 }
	 else
	 {
         document.getElementById("del3").style.display = "none";
		 document.getElementById("regday2_1").checked == false;
		 document.getElementById("regday2_2").checked == false;	
	 }
		
		
		if(document.getElementById("Students").checked == true )
		{
			if(document.getElementById("daycata6").checked == true || document.getElementById("daycata8").checked == true)
		 { 
		  
			document.getElementById("del3").style.display = "block";
			document.getElementById("regday2_1").checked == false;
		    document.getElementById("regday2_2").checked == false;		
					
		 }
		 else
		 {
			document.getElementById("del3").style.display = "none";	
			document.getElementById("regday2_1").checked == false;
		    document.getElementById("regday2_2").checked == false;	
			}
		}*/
		
	
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

function showfull()
{/*
  
  if(document.getElementById("daycata4").checked == true )
  {
    
    document.getElementById("daycata2").disabled = true;
	// document.getElementById("daycata1").disabled = true;
	  document.getElementById("daycata3").disabled = true;
  }
  else
  {
    document.getElementById("daycata2").disabled = false;
	 //document.getElementById("daycata1").disabled = false;
	  document.getElementById("daycata3").disabled = false;
  }
  if(document.getElementById("daycata8").checked == true )
  {
    //document.getElementById("daycata5").disabled = true;
	 //document.getElementById("daycata6").disabled = true;
	  document.getElementById("daycata7").disabled = true;
  }
  else
  {
   // document.getElementById("daycata5").disabled = false;
	// document.getElementById("daycata6").disabled = false;
	  document.getElementById("daycata7").disabled = false;
  }
*/}


	function validate_rsvp_registrations()
	{
	       
		 if((document.getElementById("Corporate").checked == false)  &&  (document.getElementById("Government").checked == false)  &&  (document.getElementById("R&D").checked == false) && (document.getElementById("Academia").checked == false)&& (document.getElementById("Students").checked == false))
		{
			alert("Please select Delegate Type.");
			document.getElementById("Corporate").focus();
			return false;
		}
			
			if(document.getElementById("Corporate").checked == true)
		   {
		    
			 //if( (document.getElementById("daycata1").checked == false) && (document.getElementById("daycata2").checked == false) && (document.getElementById("daycata3").checked == false) && (document.getElementById("daycata4").checked == false) ){
				//if( (document.getElementById("daycata2").checked == false) && (document.getElementById("daycata3").checked == false) && (document.getElementById("daycata4").checked == false) ){
					if((document.getElementById("daycata3").checked == false)){
				  alert("Please Select Day for delegate.");
                  document.getElementById("daycata3").focus();
                  return false;	
			}
			
		}
		if(document.getElementById("Government").checked == true)
		{
			 //if( (document.getElementById("daycata1").checked == false) && (document.getElementById("daycata2").checked == false) && (document.getElementById("daycata3").checked == false) && (document.getElementById("daycata4").checked == false) ){
				 //if( (document.getElementById("daycata2").checked == false) && (document.getElementById("daycata3").checked == false) && (document.getElementById("daycata4").checked == false) ){
					 if( (document.getElementById("daycata3").checked == false)){
				  alert("Please Select Day for delegate.");
                  document.getElementById("daycata3").focus();
                  return false;	
			}
			
		}
		if(document.getElementById("R&D").checked == true)
		{
			// if( (document.getElementById("daycata1").checked == false) && (document.getElementById("daycata2").checked == false) && (document.getElementById("daycata3").checked == false) && (document.getElementById("daycata4").checked == false) ){
				 //if((document.getElementById("daycata2").checked == false) && (document.getElementById("daycata3").checked == false) && (document.getElementById("daycata4").checked == false) ){
					 if((document.getElementById("daycata3").checked == false) ){
				  alert("Please Select Day for delegate.");
                  document.getElementById("daycata3").focus();
                  return false;	
			}
			
		}
		if(document.getElementById("Academia").checked == true)
		{
			// if( (document.getElementById("daycata1").checked == false) && (document.getElementById("daycata2").checked == false) && (document.getElementById("daycata3").checked == false) && (document.getElementById("daycata4").checked == false) ){
				 //if( (document.getElementById("daycata2").checked == false) && (document.getElementById("daycata3").checked == false) && (document.getElementById("daycata4").checked == false) ){
					 if((document.getElementById("daycata3").checked == false)){
				  alert("Please Select Day for delegate.");
                  document.getElementById("daycata3").focus();
                  return false;	
			}
			
		}
		if(document.getElementById("Students").checked == true)
		{
		  
			// if( (document.getElementById("daycata5").checked == false) && (document.getElementById("daycata6").checked == false) && (document.getElementById("daycata7").checked == false) && (document.getElementById("daycata8").checked == false) ){
				 //if((document.getElementById("daycata6").checked == false) && (document.getElementById("daycata7").checked == false) && (document.getElementById("daycata8").checked == false) ){
					 if((document.getElementById("daycata7").checked == false) && (document.getElementById("daycata8").checked == false) ){
				  alert("Please Select Day for delegate.");
                  document.getElementById("daycata7").focus();
                  return false;	
			}
			
		}
		
			//if(document.getElementById("daycata2").checked == true || document.getElementById("daycata4").checked == true || document.getElementById("daycata6").checked == true || document.getElementById("daycata8").checked == true)
			//if(document.getElementById("daycata2").checked == true || document.getElementById("daycata4").checked == true || document.getElementById("daycata8").checked == true)
			/*if(document.getElementById("daycata4").checked == true || document.getElementById("daycata8").checked == true)
			{
			   if((document.getElementById("regday2_1").checked == false) && (document.getElementById("regday2_2").checked == false)){
			    alert("Please Select One of the two Days.");
                  document.getElementById("regday2_1").focus();
                  return false;	
			   
			   }
			  
			}*/
		
			 
		   
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

			
		
			
			if((document.getElementById("Cc").checked == false)  &&  (document.getElementById("Cheque").checked == false)  &&  (document.getElementById("BT").checked == false) && (document.getElementById("Dc").checked == false))
			{
				alert("Please select the Payment Mode.");
				document.getElementById("Cc").focus();
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
      <div class="style2" style="margin-left:20px;"><span class="style2" style="margin-left:20px;"><?php echo $EVENT_NAME; ?></span> :Online Registration Form</div>
      
      </td>
    <td width="70" align="left" bgcolor="#F8F7F7">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
    <td height="513" colspan="2">
	
	
<form id="form1" name="form1" method="post" onsubmit="return validate_rsvp_registrations()" action="pay_2_registrations.php?enq_emler=<?php echo $emler?>&cata_type=<?php echo $cata_type;?>">
	
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_style2">
      <tr>
        <td height="291" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="631" height="16"></td>
          </tr>
		  
		  <tr>
		    <td height="80" align="center"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="border_style1">
		      <tr>
		        <td width="29%" height="10"></td>
		        </tr>
		      <tr>
		        <td align="left" valign="top"><span class="blue_text_no_padding">&nbsp;Online Delegate Registration has been closed, However Onspot Registrations are available at Event Venue.</span></td>
		        </tr>
		      <tr>
		        <td height="10"></td>
		        </tr>
		      <tr>
		        <td >&nbsp;</td>
		        </tr>
		      <tr>
		        <td height="10"></td>
		        </tr>
		      <tr>
		        <td >&nbsp;</td>
		        </tr>
		      <tr>
		        <td height="10"></td>
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

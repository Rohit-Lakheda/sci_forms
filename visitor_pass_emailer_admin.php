<?php
$VSTR_FROM_BODY_ADMIN_MAIL = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<title></title>	
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />    
	<meta name='keywords' content=''></meta>
	<meta name='description' content='Free form designs from CSS Globe'></meta>
	<meta http-equiv='imagetoolbar' content='no' /> 
	<style type='text/css'>
<!-- 
body{ 
	background:#f8f8f8; 
	font:13px Trebuchet MS, Arial, Helvetica, Sans-Serif; 
	color:#333;
	line-height:160%;
	margin:0;
	padding:0;
	text-align:center;
	}

h1{
	font-size:200%;
	font-weight:normal;
	}		
h2, h3, h4, h5, h6{
	font-weight:normal;
	margin:1em 0;
	}	
h2{            
	font-size:160%;
	}	
h3{          
	font-size:140%;
	}
h4{          
	font-size:120%;
	}				

a{
	text-decoration:none;
	color:#f30;
	}
a:hover{
	color:#999;
	}			
table, input, textarea, select, li{
	font:100% Trebuchet MS, Arial, Helvetica, Sans-Serif;
	line-height:160%;
	color:#333;
	}				
p, blockquote, ul, ol, form{
	margin:1em 0;
	}
blockquote{
	}
img{
	border:none;
	}			
hr{
	display:none;
	}	
table{
	margin:1em 0;
	width:100%;
	border-collapse:collapse;
	}
th, td{	
	padding:2px 5px;
	}	
th{	
	text-align:left;
	}
li{
	display:list-item;
	}	
	
#container{	
	margin:0 auto;
	background:#fff;
	width:600px;
	padding:20px 40px;
	text-align:left;
	}		
	#form1{
		margin:1em 0;
		padding-top:10px;
		background:url(http://www.bangalorebio.in/images/form1/form_top.gif) no-repeat 0 0;
		}
	#form1 fieldset{
		margin:0;
		padding:0;
		border:none;	
		float:left;
		display:inline;
		width:260px;
		margin-left:25px;
		}		
	#form1 legend{display:none;}	
	#form1 p{margin:.5em 0;}	
	#form1 label{display:block;}	
	#form1 input, #form1 textarea{		
		width:252px;
		border:1px solid #ddd;
		padding:3px;
		}		
	#form1 textarea{
		height:125px;
		overflow:auto;
		}					
	#form1 p.submit{
		clear:both;
		background:url(http://www.bangalorebio.in/images/form1/form_bottom.gif) no-repeat 0 100%;
		padding:0 25px 20px 25px;
		margin:0;
		text-align:right;
		}	
	#form1 button{
		width:129px;
		height:35px;
		line-height:35px;		
		border:none;
		background:url(../images/form1/form_button.gif) no-repeat 0 0;
		color:#fff;
		cursor:pointer;
		text-align:center;
		}	
.style1 {color: #005DA6}
.style3 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000000; font-weight: bold; }
-->
    </style>
</head>
<body>

<div id='container'>


		<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='600' align='center' valign='middle'>&nbsp;</td>
          </tr>
        </table>
		<form id='form1' action='' method='post'>
		  <p class='submit'><table width='600' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td colspan='3' align='center' valign='top' class='style49'><a href='" . $EVENT_WEBSITE_LINK . "' target='_blank'><img src='" . $EVENT_LOGO_LINK . "' title='" . $EVENT_NAME . "' alt='" . $EVENT_NAME . "'  border='0' align='middle'/></a></td>
    </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>&nbsp;</td>
    <td align='center' valign='top' class='style49'>&nbsp;</td>
    <td width='313' align='left' valign='top' class='style49'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td colspan='3' align='left' valign='top' class='style49'>Following are the details for new visitor pass registration on " . $EVENT_NAME . ". </td>
  </tr>
  <tr>
    <td width='17' align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td width='238' align='left' valign='top' class='style49'>&nbsp;</td>
    <td width='32' align='center' valign='top' class='style49'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Industry Sector Name</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . $res['sector'] . "</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Organisation Type</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . $res['org_reg_type'] . "</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Pass Number</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . $pass_no . "</td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'><span class='style1_visitor'>Email</span></td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . $email . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'> Name</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . @$_POST['title'] . " " . @$_POST['fname'] . " " . @$_POST['lname'] . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Visitor Pass Number </td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . $pass_no . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Job Title</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . @$_POST['job_title'] . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Job Title</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . @$_POST['linkedin'] . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
 
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Company Name</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . @$_POST['org'] . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>City</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . @$_POST['city'] . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Country</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . @$_POST['country'] . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
 
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Telephone</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . @$_POST['fone'] . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Purpose of Visit</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . $purpose . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>";

/*$VSTR_FROM_BODY_ADMIN_MAIL .= "
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Company's size by<br />
      number of employees</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>".@$_POST['noOfEmp']."</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr> ";
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Fax</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>".@$_POST['fax']."</td>
  </tr>*/
$VSTR_FROM_BODY_ADMIN_MAIL .= "<tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>How Did You Know<br />About " . $EVENT_NAME . " </td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . @$_POST['know1'] . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Do You Wish to Receive Info from " . $EVENT_NAME . "</td>
    <td align='center' valign='top' class='style49'>:</td>
    <td align='left' valign='top' class='style49'>" . @$_POST['feedback'] . "</td>
  </tr>
 <tr>
    <td align='left' valign='top' class='style1_visitor'></td>
    <td align='left' valign='top' class='style49' height='10'></td>
    <td align='center' valign='top' class='style49'></td>
    <td align='left' valign='top' class='style49'></td>
  </tr>
   
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Regards</td>
    <td align='center' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
  </tr>
  
  <tr>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style49'>Team " . $EVENT_NAME . "  </td>
    <td align='center' valign='top' class='style1_visitor'>&nbsp;</td>
    <td align='left' valign='top' class='style1_visitor'>&nbsp;</td>
  </tr>
</table>
		  </p>		
						
  </form>	

	
</div>


</body>
</html>";

?>
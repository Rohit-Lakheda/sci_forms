<?php
	$reg_interlinx_mail_body_login = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<title></title>	
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />    
	<meta name='keywords' content=''></meta>
	<meta name='description' content='Free form designs from CSS Globe'></meta>
	<meta http-equiv='imagetoolbar' content='no' />
	<style type='text/css'>
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
		background:url(http://www.bangaloreit.biz/images/form1/form_top.gif) no-repeat 0 0;
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
		background:url(http://www.bangaloreit.biz/images/form1/form_bottom.gif) no-repeat 0 100%;
		padding:0 25px 20px 25px;
		margin:0;
		text-align:right;
		}	
	#form1 button{
		width:129px;
		height:35px;
		line-height:35px;		
		border:none;
		background:url(http://www.bangaloreit.biz/images/form1/form_button.gif) no-repeat 0 0;
		color:#fff;
		cursor:pointer;
		text-align:center;
		}	
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
		  <table width='100%'  cellspacing='0' cellpadding='0'>
            <tr>
              <td height='1' colspan='3'><span class='style3'>&nbsp;</span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td width='47%' align='center' valign='middle'><a href='".$EVENT_WEBSITE_LINK."' target='_blank'><img src='".$EVENT_LOGO_LINK."' title='".$EVENT_NAME." ".$EVENT_YEAR."' alt='".$EVENT_NAME." ".$EVENT_YEAR."' border='0' align='middle'/></a></td>
              <td width='51%' align='center' valign='middle'><a href='".$EVENT_INTERLINX_LINK."'><img src='".$INTERLINX_LOGO."'  title='".$EVENT_NAME." ".$EVENT_YEAR."' alt='".$EVENT_NAME." ".$EVENT_YEAR."' border='0' align='middle' /></a></td>
            </tr>
            <tr>
              <td width='2%'>&nbsp;</td>
              <td colspan='2'><span class='style3'>Dear ".$title." ".$fname." ".$lname.",<br />
               Thank you for registering with ".$EVENT_NAME." ".$EVENT_YEAR." InterlinX. <br /><br>
                Followings are your login details ,<br> <br>
          TIN No: ".$qr_gt_user_data_ans_row['tin_no']." <br> <br>               
              <strong>User Name:</strong> ".$dele_email."<br>
  <strong>Password:</strong> ".$pas1_inx."            
  <br />
                <br />
              <a href='".$EVENT_INTERLINX_LINK."' target='_blank'>Click Here</a> to login to ".$EVENT_NAME."  InterlinX.
 	
 	          <br />
 	          Happy Interlinking, <br>
              <br />
              Thanking You,<br />
                ".$EVENT_NAME." Secretariat <br>
                ".$EVENT_SECRT_ADDR."<br />
<a href='mailto:".$EVENT_ENQUIRY_EMAIL."' target='_blank'>".$EVENT_ENQUIRY_EMAIL."</a></span></td>
            </tr>
            

            <tr>
              <td class='style3'>&nbsp;</td>
              <td colspan='2' class='style3'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                  <tr>
                    <td width='7%' align='left' valign='top' class='style2'>&nbsp;</td>
                    <td width='93%' align='left' valign='top' class='style3'>&nbsp;</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td class='style3'>&nbsp;</td>
              <td colspan='2' class='style3'>&nbsp;</td>
            </tr>
          </table>
		  <map name='Map' id='Map3'>
		    <area shape='rect' coords='23,19,180,174' href='http://www.nutraceuticalsummit.in/' target='_blank' />
            <area shape='rect' coords='375,26,527,179' href='http://www.bangaloreit.biz/' target='_blank' />
            <area shape='rect' coords='200,20,357,175' href='http://www.bangalorenano.in/' target='_blank' />
          </map>
		  <map name='Map' id='Map2'>
            <area shape='rect' coords='23,19,180,174' href='http://www.nutraceuticalsummit.in/' target='_blank' />
            <area shape='rect' coords='375,26,527,179' href='http://www.bangaloreit.biz/' target='_blank' />
            <area shape='rect' coords='200,20,357,175' href='http://www.bangalorenano.in/' target='_blank' />
          </map>
		  <p class='submit'>&nbsp;</p>								
  </form>		
</div>
</body>
</html>";
?>
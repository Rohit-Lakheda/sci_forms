<?php
	
	$mail_interlinx_str = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
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
		background:url(http://www.bangalorebio.in/bbio_09/images/form1/form_top.gif) no-repeat 0 0;
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
		background:url(http://www.bangalorebio.in/bbio_09/images/form1/form_bottom.gif) no-repeat 0 100%;
		padding:0 25px 20px 25px;
		margin:0;
		text-align:right;
		}	
	#form1 button{
		width:129px;
		height:35px;
		line-height:35px;		
		border:none;
		background:url(http://www.bangalorebio.in/bbio_09/images/form1/form_button.gif) no-repeat 0 0;
		color:#fff;
		cursor:pointer;
		text-align:center;
		}	
.style4 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
}
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
		  <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
            
           <tr>
              <td valign='top' class='style4'></td>
              <td width='267' align='center' valign='middle' class='style4'>
			  <a href='".$EVENT_INTERLINX_LINK."' target='_blank'><img src='".$EVENT_INTERLINX_LOGO."' title='".$EVENT_NAME." InterlinX ' alt='".$EVENT_NAME." InterlinX' border='0' align='middle' width='200'/></a>
			 </td>
              <td width='239' align='center' valign='middle' class='style4'><a href='".$EVENT_WEBSITE_LINK."' target='_blank'><img src='".$EVENT_LOGO_LINK."' title='".$EVENT_NAME." ".$EVENT_YEAR."' alt='".$EVENT_NAME." ".$EVENT_YEAR."' border='0' align='middle' width='239'/></a></td>
              <td width='11' valign='top' class='style4'>&nbsp;</td>
              <td width='11' valign='top' class='style4'>&nbsp;</td>
            </tr>
            <tr>
              <td width='125' height='10' valign='top' style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;'></td>
              <td valign='top' style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;'>&nbsp;</td>
              		<td width='11' valign='top' class='style4'>&nbsp;</td>
              <td width='11' valign='top' class='style4'>&nbsp;</td>
            </tr>
            <tr>
              <td valign='top' style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;'>&nbsp;</td>
              <td valign='top' style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;' colspan='3'>Dear ".$qr_gt_user_inx_login_data_ans['title']." ".$qr_gt_user_inx_login_data_ans['fname'].",
                <br/><br/>
              	Greetings from the Bengaluru ITE.Biz 2016 InterlinX Secretariat!<br/><br/>
              	
              	We hope you have updated your Profile Information, Industry Sectors and other details on your InterlinX Profile. The Meeting Scheduler feature is now live.<br/><br/>
              		You can login, search for potential business prospects, send/receive meeting requests and schedule B2B meetings with other participants who will be attending Bengaluru ITE.Biz 2016.<br/><br/>
              		Your Login Details are as mentioned below:<br/>
              		<strong>Username :</strong>  ".$qr_gt_user_inx_login_data_ans['user_name']."<br/>
              		<strong>Password :</strong>  ".$qr_gt_user_inx_login_data_ans['pass1']."<br/><br/>
              				
              		<a href='".$EVENT_INTERLINX_LINK."' target='_blank'>Click Here</a> to login to ".$EVENT_NAME." ".$EVENT_YEAR." InterlinX.<br/><br/>		
					Steps:<br/>
					<ul> 
						<li>Update your Profile, Photograph and Industry Sector</li>
						<li>Short list the right prospective business partner</li>
						<li>Send / Receive Meeting requests</li>
						<li>Conduct meetings</li>
						<li>Enhance / build your business</li>
              		</ul>
					Login and schedule your meetings now.<br/><br/>
					 
					Please do write to me or call me if you have any queries<br/><br/>
					 
					Best Regards,<br/>					 
					Utsav<br/>
					Bengaluru ITE.Biz 2016 InterlinX Secretariat<br/>
					Phone: 91-80-4113 1912/13
                </td>
            </tr>
			 <tr>
              <td valign='top' style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;'>&nbsp;</td>
              <td valign='top' style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;'></td>
              				<td width='11' valign='top' class='style4'>&nbsp;</td>
              <td width='11' valign='top' class='style4'>&nbsp;</td>
            </tr>
          </table>
		  <table width='100%'  cellspacing='0' cellpadding='0'>
            <tr>
              <td width='101%' height='1' colspan='4'>&nbsp;</td>
            </tr>
          </table>
		 
		  <p class='submit'>&nbsp;</p>								
  </form>		
</div>
</body>
</html>";
?>
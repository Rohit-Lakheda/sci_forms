<?php
	//ob_start();
	//ini_set(session.save_path, 'E:\work\xampp\tmp');
	require("includes/form_constants.php");
	$ret = @$_GET['ret'];
	
	if ($ret == "retds4fu324rn_ed24d3it") {
		session_start();
	    if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
	        session_destroy();
	        echo "<script language='javascript'>alert('Please try again.');</script>";
	        echo "<script language='javascript'>window.location=('registrations.php');</script>";
	        echo "<script language='javascript'>document.location=('registrations.php');</script>";
	        exit;
	    }
	    require "dbcon_open.php";
	} else {
		include('captcha_reg.php');
	}
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG);
	$totalRegistrations = mysqli_num_rows($qr_gt_user_data_id);
	//echo $qr_gt_user_data_ans_no;
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?php echo $EVENT_NAME . ' ' . $EVENT_YEAR; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        
        <link href="assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link href="css/custom-material.css" rel="stylesheet" type="text/css" />
        <link href="css/custom-style.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> 
        </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-boxed page-content-white page-md dips-background-color-body">
    	<!-- BEGIN HEADER -->
    	<!-- For header fixed .navbar-fixed-top -->
        <div class="page-header navbar dips-background-color-header">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner container">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="<?php echo $EVENT_WEBSITE_LINK;?>" target="_blank">
                        <img src="<?php echo $EVENT_LOGO_URL;?>" alt="logo" class="logo-default dips-logo" /> 
                    </a>
                </div>
                <!-- END LOGO -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="container">
        	<!-- BEGIN PAGE CONTENT -->
			<div class="page-container">
            	<!-- BEGIN CONTENT -->
	            <div class="page-content-wrapper">
	                <!-- BEGIN CONTENT BODY -->
	                <div class="page-content dips-page-content">
	                    <!-- BEGIN PAGE TITLE-->
	                    <h3 class="page-title"> Delegate Registration Form </h3>
	                    <!-- END PAGE TITLE-->
	                    <!-- END PAGE HEADER-->
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="portlet light bordered" id="registration_form_1">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class=" icon-layers font-red"></i>
	                                        <span class="caption-subject font-red bold uppercase"> Delegate Registration Form
	                                        </span>
	                                    </div>
	                                </div>
	                                <div class="portlet-body form">
	                                    <form action="registration2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post" onsubmit="return validate_registration_form_2()">
	                                    	<input type="hidden" value="Standard" name="cata_m" />
	                                    	<input name="vercode" type="hidden" id="vercode" value="<?php echo $_SESSION['vercode_reg'];?>"/>
	                                        <div class="form-wizard">
	                                            <div class="form-body">
	                                                <ul class="nav nav-pills nav-justified steps">
	                                                    <li class="active">
	                                                        <a href="#tab1" data-toggle="tab" class="step">
	                                                            <span class="number"> 1 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Registration Category </span>
	                                                        </a>
	                                                    </li>
	                                                    <li>
	                                                        <a data-toggle="tab" class="step dips-default-cursor">
	                                                            <span class="number"> 2 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Organisation Information </span>
	                                                        </a>
	                                                    </li>
	                                                    <li>
	                                                        <a data-toggle="tab" class="step dips-default-cursor">
	                                                            <span class="number"> 3 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Delegate Information </span>
	                                                        </a>
	                                                    </li>
	                                                    <li>
	                                                        <a data-toggle="tab" class="step dips-default-cursor">
	                                                            <span class="number"> 4 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Confirm </span>
	                                                        </a>
	                                                    </li>
	                                                    <li>
	                                                        <a data-toggle="tab" class="step dips-default-cursor">
	                                                            <span class="number"> 5 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Receipt </span>
	                                                        </a>
	                                                    </li>
	                                                </ul>
	                                                <div id="bar" class="progress progress-striped" role="progressbar">
	                                                    <div class="progress-bar progress-bar-success"> </div>
	                                                </div>
	                                                <div class="tab-content">
														<div class="tab-pane active">
															<h3 class="block">Provide required information for registration</h3>
                                                            
															<div class="form-group form-md-radios">
					                                            <label class="control-label col-md-3"> Single/ Group Delegate(s)<span class="required"> * </span> </label>
																<div class="col-md-9">
																	 <div class="md-radio-inline">
						                                                <div class="md-radio">
						                                                    <input type="radio" id="Single" name="grp" class="md-radiobtn" value="Single" onclick="show_div_group_user();" checked="checked" required="required">
						                                                    <label for="Single">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Single Delegate </label>
						                                                </div>
						                                                <div class="md-radio">
						                                                    <input type="radio" id="Group" name="grp" class="md-radiobtn" value="Group" onclick="show_div_group_user();" required="required">
						                                                    <label for="Group">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Group Delegates </label>
						                                                </div>
						                                            </div>
																</div>
															</div>
															<div class="form-group" id="div_group_user">
																<label class="control-label col-md-3">Number of Delegates<span class="required"> * </span> </label>
																<div class="col-md-5 col-sm-3">
																	<div class="group">
																		<input name="total_dele" type="text" id="total_dele" maxlength="1" onkeyup="check_dele(event, 'total_dele');" />
																		<span class="highlight"></span> 
																		<span class="bar"></span> 
																		<span class="help-block"> Min. 2 and max. 7 delegates are allowed. </span>
																		<div class="alert alert-danger" id="del-error" style="display: none;">
                                        									<strong>Error!</strong> Please enter number between 2 to 7 only.
                                        								</div>
																	</div>
																</div>
															</div>
															<div class="form-group form-md-radios">
					                                            <label class="control-label col-md-3">Organization Type <span class="required"> * </span> </label>
					                                            <div class="col-md-9">
						                                            <div class="md-radio-inline">
						                                                <div class="md-radio">
						                                                    <input type="radio" id="Indian" name="curr" class="md-radiobtn" value="Indian" onclick="show_cata();" checked="checked" required="required">
						                                                    <label for="Indian">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Indian 
						                                                    </label>
						                                                </div>
						                                                <div class="md-radio">
						                                                    <input type="radio" id="Foreign" name="curr" class="md-radiobtn" value="Foreign" onclick="show_cata();" required="required">
						                                                    <label for="Foreign">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> International 
						                                                    </label>
						                                                </div>
						                                            </div>
					                                            </div>
					                                        </div>
                                                            <div class="form-group form-md-radios">
					                                            <label class="control-label col-md-3"> Type of registration<span class="required"> * </span> </label>
																<div class="col-md-9">
																	 <div class="md-radio-inline">
						                                                <div class="md-radio">
						                                                    <input type="radio" id="Single_Day" name="daytype" class="md-radiobtn" value="Single" onclick="show_div_type_reg();" checked="checked" required="required">
						                                                    <label for="Single_Day">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Single Day </label>
						                                                </div>
						                                                <div class="md-radio">
						                                                    <input type="radio" id="Full_Day" name="daytype" class="md-radiobtn" value="All" onclick="show_div_type_reg();" required="required">
						                                                    <label for="Full_Day">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Full Day </label>
						                                                </div>
						                                            </div>
																</div>
															</div>
                                                            <div  class="form-group form-md-radios" id="div_single_day">
																<label class="control-label col-md-3">Single Day<span class="required"> * </span> </label>
																<div class="col-md-9">
																	 <div class="md-radio-inline">
						                                                <div class="md-radio">
																		<input type="radio" name="no_of_day" value="Day1" id="day1" class="md-radiobtn" checked="checked" onclick="show_div_day_details()">
																		 <label for="day1">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Day 1 </label>
																				</div>
						                                                <div class="md-radio">
																		  <input type="radio" name="no_of_day" value="Day2" id="day2" class="md-radiobtn" onclick="show_div_day_details()"> 
																		  <label for="day2">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Day 2 </label>
																				</div>
						                                                <div class="md-radio">
																				<input type="radio" name="no_of_day" value="Day3" id="day3" class="md-radiobtn" onclick="show_div_day_details()"> 
																				<label for="day3">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Day 3 </label> 
																		
																		</div>
																		</div>
																		<div id="firstday">
																		<table border="1" cellspacing="0" cellpadding="0" align="left" bordercolor="#3399FF" width="100%">
																		  <tr>
																		    <td width="100%" colspan="2" bgcolor="#389AFC" style="color:#FFF"><p align="center"><strong>DAY 1  |    Monday, November 28, 2016</strong></p></td>
																	      </tr>
																		  <tr>
																		    <td width="100%" colspan="2" bgcolor="#D2DCFF"><p align="center"><img src="images/day1.png" width="125" height="129" align="right">9:30 am - 10:00 am<strong></strong><br>
																		      <strong>Inauguration    of Exhibition</strong></p></td>
																	      </tr>
																		  <tr>
																		    <td width="100%" colspan="2"><p align="center">10:00 am -    11:30 am<strong></strong><br>
																		      <strong>Inauguration    of Event</strong></p></td>
																	      </tr>
																		  <tr>
																		    <td width="100%" colspan="2" bgcolor="#D2DCFF"><p align="center">11:30 am – 11:50 am | Coffee Break</p></td>
																	      </tr>
																		  <tr>
																		    <td width="100%" colspan="2"><p align="center">12:00 noon - 1:30 pm<br>
																		      <strong>Opening Keynote    Talk 1 &amp; Talk 2</strong></p></td>
																	      </tr>
																		  <tr>
																		    <td width="70%" bgcolor="#D2DCFF"><p align="center">2:30 pm - 3:30 pm <strong>|</strong> by<strong style="color:#389AFC"> NASSCOM </strong><br>
																		      <strong>Panel    Discussion </strong>on<strong> &lsquo;Re-invent to Disrupt&rsquo; (MNCs)</strong><br>
																		      3:30 pm - 4:30 pm <strong>|</strong>  <strong> </strong>by<strong style="color:#389AFC"> NASSCOM</strong><br>
																		      <strong>Panel    Discussion </strong>on<strong> &lsquo;Re-invent to Disrupt&rsquo; (Services)</strong></p></td>
																		    <td width="30%" bgcolor="#D2DCFF"><p align="center">3.00 pm - 4:00    pm <strong>| </strong>by <strong style="color:#389AFC">TCS</strong><br>
																		      <strong>Rural IT Quiz</strong></p></td>
																	      </tr>
																		  <tr>
																		    <td width="70%"><p align="center">5:00 pm - 6:00    pm <strong>|    International Perspectives </strong></p></td>
																		    <td width="30%"><p align="center">5:00 pm - 6:00    pm <strong>|    </strong><br>
																		      <strong>Japan Session</strong></p></td>
																	      </tr>
																	  </table></div>
																	  <div id="secondday"><table border="1" bordercolor="#1FA39C" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="100%" colspan="3" bgcolor="#1FA39C"><strong><br clear="all" />
      </strong>
      <p align="center"><strong style="color:#FFF">DAY 2  |  Tuesday, November 29, 2016</strong><strong> </strong></p></td>
  </tr>
  <tr bgcolor="#CFF3EF">
    <td width="366"><p align="center">10:00 am – 11:30 am <strong>|  by</strong><strong style="color:#1FA39C">  NASSCOM</strong><br />
      <strong>Live Smart; Work Smart</strong></p></td>
    <td width="372"><p align="center">10:30 am – 11:30 am<strong> | </strong>by<strong style="color:#1FA39C"> Dassault</strong><br />
      <strong>Panel </strong>on<strong> <em>Building Innovation    Ecosystem to Excel in Aerospace &amp; Defence</em></strong></p></td>
    <td width="240"><p align="center">&nbsp;</p>
      <p align="center">Tier 2/3 cities - <strong>Emerging Destination</strong></p></td>
  </tr>
  <tr bgcolor="#16D6CC">
    <td width="100%" colspan="3"><p align="center">11:30 am – 11:50 am |    Coffee Break</p></td>
  </tr>
  <tr bgcolor="#CFF3EF">
    <td width="366"><p align="center">12:00 noon – 1:30 pm<strong> | Telecom Session </strong>by<strong> NASSCOM</strong></p>
      <p align="center">12:00 noon – 1:00 pm<strong> | Panel </strong>on<strong> </strong><br />
        <strong><em>Translating    Digital India to a Reality</em></strong><strong> </strong></p></td>
    <td width="372" rowspan="2"><p align="center">12:00 noon – 1:30 pm <strong>|  </strong>by<strong> IESA</strong><br />
      <strong><em>Flexible    Electronics</em></strong></p></td>
    <td width="240" rowspan="2"><p align="center">Tier 2/3 cities – <strong>Emerging Destination</strong></p></td>
  </tr>
  <tr bgcolor="#CFF3EF">
    <td width="366"><p align="center">1:00 pm - 1:30 pm<strong> |  Fireside Chat </strong>on<strong> </strong><br />
      <strong>&lsquo;<em>Digital    Transformation through NextGen Telecom Innovations&rsquo;</em></strong></p></td>
  </tr>
  <tr>
    <td width="100%" colspan="3" bgcolor="#16D6CC"><p align="center">1:30 pm - 2:20 pm<strong> | </strong>Visit to Expo and Lunch Break</p></td>
  </tr>
  <tr bgcolor="#CFF3EF">
    <td width="366"><p align="center">02:30 pm – 04:00 pm<strong>  |  </strong>by<strong> ABAI<br />
      VR, AR &amp; Gaming</strong></p></td>
    <td width="372"><p align="center">2:30 pm - 4:00 pm <strong>|  </strong>by<strong> NASSCOM</strong><br />
      <strong>Big Data Analytics - Robotics and AI</strong></p></td>
    <td width="240" rowspan="3"><p align="center">02:00 pm – 06:00 pm<strong> | </strong>by <strong>IAMAI Hackathon</strong></p></td>
  </tr>
  <tr>
    <td width="738" colspan="2" bgcolor="#16D6CC"><p align="center">04:00 pm – 04:20 pm |    Coffee Break</p></td>
  </tr>
  <tr bgcolor="#CFF3EF">
    <td width="366"><p align="center">04:30 pm – 06:00 pm<strong> |  </strong>by<strong> ABAI</strong><br />
      <strong>Animation and Animation Technology</strong></p></td>
    <td width="372"><p align="center">04:30 pm – 06:00 pm<strong> |  </strong>by<strong> DSCI</strong><br />
      <strong>Roadmap for Making India a Global Hub for Cyber Security</strong></p></td>
  </tr>
  <tr>
    <td width="100%" colspan="3" bgcolor="#16D6CC"><p align="center">6.00 pm - 7.00 pm <strong>|</strong> <strong>CEO    Conclave </strong>by <strong>NASSCOM</strong> <br />
      Theme: <strong><em>Define the Next – New Frontiers in Technology &amp; Business</em></strong><br />
      7.00 pm - 7.30 pm <strong>|</strong> <strong>Fireside    Chat </strong><br />
      7.30 pm onwards<strong> </strong><strong>| STPI IT Export Awards</strong></p></td>
  </tr>
</table>
																	  </div>
																	   <div id="thirdday"> <table border="1" cellspacing="0" cellpadding="0" align="left" width="100%" bordercolor="#9658DA">
  <tr>
    <td width="1044" colspan="3" bgcolor="#B082E3"><p align="center"><strong style="color:#FFF">DAY 3  | Wednesday,    November 30, 2016</strong></p></td>
  </tr>
  <tr>
    <td width="336" rowspan="5" bgcolor="#D5BEEF"><p align="center">&nbsp;</p>
      <p align="center">10:00 am - 4:00 pm | <br />
        by<strong style="color:#FFF">  KSRSAC</strong></p>
      <p align="center"><strong>State Level Workshop    on </strong><br />
        <strong>Space Technology    Applications for Governance and Development </strong></p></td>
    <td width="456" bgcolor="#D5BEEF"><p align="center"><strong>Entrepreneurship Session </strong> by<strong style="color:#FFF"> TiE </strong><br />
      10:00 am – 10:30 am<strong> | Keynote Talk</strong><br />
    10:30 am – 11:30 am<strong> | Panel </strong>on<strong> What's Next in Tech?</strong><strong> </strong></p></td>
    <td width="252" rowspan="8" valign="top" bgcolor="#B082E3"><p align="center"><img src="images/day3.png" alt="" width="129" height="128" /><strong> </strong></p>
      <p align="center"><strong>&nbsp;</strong></p>
      <p align="center"><strong>&nbsp;</strong></p>
      <p align="center">10:00 am - 6:00 pm | <br />
        by<strong style="color:#FFF"> Entrepreneur    India</strong><br />
        <strong>Small Business    Symposium</strong></p></td>
  </tr>
  <tr>
    <td width="456" bgcolor="#E3D6F5"><p align="center">11:30 am – 11.50 am<strong> | Coffee Break</strong></p></td>
  </tr>
  <tr>
    <td width="456" bgcolor="#D5BEEF"><p align="center"><strong>Design Dialogue </strong>by<strong style="color:#FFF">  Spread </strong><br />
      <strong>12:00 noon -    1:00 pm | Panel on Design Impact</strong><br />
      <strong>1:00 pm - 1:30    pm | Design Hack Presentations</strong><br />
      <strong>(presentations    by 5 Start-ups)</strong></p></td>
  </tr>
  <tr>
    <td width="456" bgcolor="#E3D6F5"><p align="center">1:30 pm - 2:20 pm<strong>| Visit to Expo and Lunch Break</strong></p></td>
  </tr>
  <tr>
    <td width="456" bgcolor="#D5BEEF"><p align="center"><strong>Investor</strong> <strong> Session </strong> <strong>|</strong> by<strong style="color:#FFF"> TiE</strong><br />
      2:30 pm - 3:00 | <strong>Keynote Talk </strong><br />
    <strong> </strong>3:00 pm - 4:00 pm<strong> | Investor</strong> <strong>Panel</strong></p></td>
  </tr>
  <tr>
    <td width="792" colspan="2" bgcolor="#E3D6F5"><p align="center">04:00 pm - 04:20 pm<strong> | Coffee Break</strong></p></td>
  </tr>
  <tr>
    <td width="336" bgcolor="#D5BEEF"><p align="center">4:30 pm – 06:30 pm | by <strong style="color:#FFF">KBITS</strong> <br />
      <strong>KITE  - Reverse Hackathon</strong></p></td>
    <td width="456" bgcolor="#D5BEEF"><p align="center"><strong>Startup    Karnataka YESSS</strong><br />
      4:30 pm - 5:00 pm| <strong>Lead Talk </strong><br />
      5:00 pm - 6:30 pm  | <strong>Presentations </strong>by<strong> Selected Start-ups</strong></p></td>
  </tr>
  <tr>
    <td width="792" colspan="2" bgcolor="#E3D6F5"><p align="center">6:30 pm onwards <strong>| Start-Up &amp; Entrepreneurship Awards</strong></p></td>
  </tr>
</table>
																	  </div>
																		
																	</div>
																</div>
															
															<div id="div_full_day" class="form-group form-md-radios">
                                                            <div class="col-md-9">
																	 <div class="md-radio-inline">
						                                                <div class="md-radio">
															<table border="1" cellspacing="0" cellpadding="0" align="left" bordercolor="#3399FF" width="100%">
																		  <tr>
																		    <td width="100%" colspan="2" bgcolor="#389AFC" style="color:#FFF"><p align="center"><strong>DAY 1  |    Monday, November 28, 2016</strong></p></td>
																	      </tr>
																		  <tr>
																		    <td width="100%" colspan="2" bgcolor="#D2DCFF"><p align="center"><img src="images/day1.png" width="125" height="129" align="right">9:30 am - 10:00 am<strong></strong><br>
																		      <strong>Inauguration    of Exhibition</strong></p></td>
																	      </tr>
																		  <tr>
																		    <td width="100%" colspan="2"><p align="center">10:00 am -    11:30 am<strong></strong><br>
																		      <strong>Inauguration    of Event</strong></p></td>
																	      </tr>
																		  <tr>
																		    <td width="100%" colspan="2" bgcolor="#D2DCFF"><p align="center">11:30 am – 11:50 am | Coffee Break</p></td>
																	      </tr>
																		  <tr>
																		    <td width="100%" colspan="2"><p align="center">12:00 noon - 1:30 pm<br>
																		      <strong>Opening Keynote    Talk 1 &amp; Talk 2</strong></p></td>
																	      </tr>
																		  <tr>
																		    <td width="70%" bgcolor="#D2DCFF"><p align="center">2:30 pm - 3:30 pm <strong>|</strong> by<strong style="color:#389AFC"> NASSCOM </strong><br>
																		      <strong>Panel    Discussion </strong>on<strong> &lsquo;Re-invent to Disrupt&rsquo; (MNCs)</strong><br>
																		      3:30 pm - 4:30 pm <strong>|</strong>  <strong> </strong>by<strong style="color:#389AFC"> NASSCOM</strong><br>
																		      <strong>Panel    Discussion </strong>on<strong> &lsquo;Re-invent to Disrupt&rsquo; (Services)</strong></p></td>
																		    <td width="30%" bgcolor="#D2DCFF"><p align="center">3.00 pm - 4:00    pm <strong>| </strong>by <strong style="color:#389AFC">TCS</strong><br>
																		      <strong>Rural IT Quiz</strong></p></td>
																	      </tr>
																		  <tr>
																		    <td width="70%"><p align="center">5:00 pm - 6:00    pm <strong>|    International Perspectives </strong></p></td>
																		    <td width="30%"><p align="center">5:00 pm - 6:00    pm <strong>|    </strong><br>
																		      <strong>Japan Session</strong></p></td>
																	      </tr>
																	  </table>
<table border="1" bordercolor="#1FA39C" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="100%" colspan="3" bgcolor="#1FA39C"><strong><br clear="all" />
      </strong>
      <p align="center"><strong style="color:#FFF">DAY 2  |  Tuesday, November 29, 2016</strong><strong> </strong></p></td>
  </tr>
  <tr bgcolor="#CFF3EF">
    <td width="366"><p align="center">10:00 am – 11:30 am <strong>|  by</strong><strong style="color:#1FA39C">  NASSCOM</strong><br />
      <strong>Live Smart; Work Smart</strong></p></td>
    <td width="372"><p align="center">10:30 am – 11:30 am<strong> | </strong>by<strong style="color:#1FA39C"> Dassault</strong><br />
      <strong>Panel </strong>on<strong> <em>Building Innovation    Ecosystem to Excel in Aerospace &amp; Defence</em></strong></p></td>
    <td width="240"><p align="center">&nbsp;</p>
      <p align="center">Tier 2/3 cities - <strong>Emerging Destination</strong></p></td>
  </tr>
  <tr bgcolor="#16D6CC">
    <td width="100%" colspan="3"><p align="center">11:30 am – 11:50 am |    Coffee Break</p></td>
  </tr>
  <tr bgcolor="#CFF3EF">
    <td width="366"><p align="center">12:00 noon – 1:30 pm<strong> | Telecom Session </strong>by<strong> NASSCOM</strong></p>
      <p align="center">12:00 noon – 1:00 pm<strong> | Panel </strong>on<strong> </strong><br />
        <strong><em>Translating    Digital India to a Reality</em></strong><strong> </strong></p></td>
    <td width="372" rowspan="2"><p align="center">12:00 noon – 1:30 pm <strong>|  </strong>by<strong> IESA</strong><br />
      <strong><em>Flexible    Electronics</em></strong></p></td>
    <td width="240" rowspan="2"><p align="center">Tier 2/3 cities – <strong>Emerging Destination</strong></p></td>
  </tr>
  <tr bgcolor="#CFF3EF">
    <td width="366"><p align="center">1:00 pm - 1:30 pm<strong> |  Fireside Chat </strong>on<strong> </strong><br />
      <strong>&lsquo;<em>Digital    Transformation through NextGen Telecom Innovations&rsquo;</em></strong></p></td>
  </tr>
  <tr>
    <td width="100%" colspan="3" bgcolor="#16D6CC"><p align="center">1:30 pm - 2:20 pm<strong> | </strong>Visit to Expo and Lunch Break</p></td>
  </tr>
  <tr bgcolor="#CFF3EF">
    <td width="366"><p align="center">02:30 pm – 04:00 pm<strong>  |  </strong>by<strong> ABAI<br />
      VR, AR &amp; Gaming</strong></p></td>
    <td width="372"><p align="center">2:30 pm - 4:00 pm <strong>|  </strong>by<strong> NASSCOM</strong><br />
      <strong>Big Data Analytics - Robotics and AI</strong></p></td>
    <td width="240" rowspan="3"><p align="center">02:00 pm – 06:00 pm<strong> | </strong>by <strong>IAMAI Hackathon</strong></p></td>
  </tr>
  <tr>
    <td width="738" colspan="2" bgcolor="#16D6CC"><p align="center">04:00 pm – 04:20 pm |    Coffee Break</p></td>
  </tr>
  <tr bgcolor="#CFF3EF">
    <td width="366"><p align="center">04:30 pm – 06:00 pm<strong> |  </strong>by<strong> ABAI</strong><br />
      <strong>Animation and Animation Technology</strong></p></td>
    <td width="372"><p align="center">04:30 pm – 06:00 pm<strong> |  </strong>by<strong> DSCI</strong><br />
      <strong>Roadmap for Making India a Global Hub for Cyber Security</strong></p></td>
  </tr>
  <tr>
    <td width="100%" colspan="3" bgcolor="#16D6CC"><p align="center">6.00 pm - 7.00 pm <strong>|</strong> <strong>CEO    Conclave </strong>by <strong>NASSCOM</strong> <br />
      Theme: <strong><em>Define the Next – New Frontiers in Technology &amp; Business</em></strong><br />
      7.00 pm - 7.30 pm <strong>|</strong> <strong>Fireside    Chat </strong><br />
      7.30 pm onwards<strong> </strong><strong>| STPI IT Export Awards</strong></p></td>
  </tr>
</table>
<table border="1" cellspacing="0" cellpadding="0" align="left" width="100%" bordercolor="#9658DA">
  <tr>
    <td width="1044" colspan="3" bgcolor="#B082E3"><p align="center"><strong style="color:#FFF">DAY 3  | Wednesday,    November 30, 2016</strong></p></td>
  </tr>
  <tr>
    <td width="336" rowspan="5" bgcolor="#D5BEEF"><p align="center">&nbsp;</p>
      <p align="center">10:00 am - 4:00 pm | <br />
        by<strong style="color:#FFF">  KSRSAC</strong></p>
      <p align="center"><strong>State Level Workshop    on </strong><br />
        <strong>Space Technology    Applications for Governance and Development </strong></p></td>
    <td width="456" bgcolor="#D5BEEF"><p align="center"><strong>Entrepreneurship Session </strong> by<strong style="color:#FFF"> TiE </strong><br />
      10:00 am – 10:30 am<strong> | Keynote Talk</strong><br />
    10:30 am – 11:30 am<strong> | Panel </strong>on<strong> What's Next in Tech?</strong><strong> </strong></p></td>
    <td width="252" rowspan="8" valign="top" bgcolor="#B082E3"><p align="center"><img src="images/day3.png" alt="" width="129" height="128" /><strong> </strong></p>
      <p align="center"><strong>&nbsp;</strong></p>
      <p align="center"><strong>&nbsp;</strong></p>
      <p align="center">10:00 am - 6:00 pm | <br />
        by<strong style="color:#FFF"> Entrepreneur    India</strong><br />
        <strong>Small Business    Symposium</strong></p></td>
  </tr>
  <tr>
    <td width="456" bgcolor="#E3D6F5"><p align="center">11:30 am – 11.50 am<strong> | Coffee Break</strong></p></td>
  </tr>
  <tr>
    <td width="456" bgcolor="#D5BEEF"><p align="center"><strong>Design Dialogue </strong>by<strong style="color:#FFF">  Spread </strong><br />
      <strong>12:00 noon -    1:00 pm | Panel on Design Impact</strong><br />
      <strong>1:00 pm - 1:30    pm | Design Hack Presentations</strong><br />
      <strong>(presentations    by 5 Start-ups)</strong></p></td>
  </tr>
  <tr>
    <td width="456" bgcolor="#E3D6F5"><p align="center">1:30 pm - 2:20 pm<strong>| Visit to Expo and Lunch Break</strong></p></td>
  </tr>
  <tr>
    <td width="456" bgcolor="#D5BEEF"><p align="center"><strong>Investor</strong> <strong> Session </strong> <strong>|</strong> by<strong style="color:#FFF"> TiE</strong><br />
      2:30 pm - 3:00 | <strong>Keynote Talk </strong><br />
    <strong> </strong>3:00 pm - 4:00 pm<strong> | Investor</strong> <strong>Panel</strong></p></td>
  </tr>
  <tr>
    <td width="792" colspan="2" bgcolor="#E3D6F5"><p align="center">04:00 pm - 04:20 pm<strong> | Coffee Break</strong></p></td>
  </tr>
  <tr>
    <td width="336" bgcolor="#D5BEEF"><p align="center">4:30 pm – 06:30 pm | by <strong style="color:#FFF">KBITS</strong> <br />
      <strong>KITE  - Reverse Hackathon</strong></p></td>
    <td width="456" bgcolor="#D5BEEF"><p align="center"><strong>Startup    Karnataka YESSS</strong><br />
      4:30 pm - 5:00 pm| <strong>Lead Talk </strong><br />
      5:00 pm - 6:30 pm  | <strong>Presentations </strong>by<strong> Selected Start-ups</strong></p></td>
  </tr>
  <tr>
    <td width="792" colspan="2" bgcolor="#E3D6F5"><p align="center">6:30 pm onwards <strong>| Start-Up &amp; Entrepreneurship Awards</strong></p></td>
  </tr>
</table></div></div></div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-1"></label>
																<div class="col-md-11">
																	<table class="table table-striped table-hover table-bordered teriff-table">
																		<thead>
																			<tr>
																				<th>Early Bird Registrations</th>
																				<th>Actual Tarrif</th>
																				<th>Special Discount</th>
																				<th>What you pay</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php if($totalRegistrations >= 0 && $totalRegistrations <= 100) {?>
																				<tr class="indian-tariff">
																					<td>1 - 100</td>
																					<td class="success">10000</td>
																					<td>90%</td>
																					<td class="danger">1000 <input name="cata1" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>1 - 100</td>
																					<td class="success">200</td>
																					<td>90%</td>
																					<td class="danger">20 <input name="cata2" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 101 && $totalRegistrations <= 200) {?>
																				<tr class="indian-tariff">
																					<td>101 - 200</td>
																					<td class="success">10000</td>
																					<td>80%</td>
																					<td class="danger">2000 <input name="cata1" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>101 - 200</td>
																					<td class="success">200</td>
																					<td>80%</td>
																					<td class="danger">40 <input name="cata2" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 201 && $totalRegistrations <= 300) {?>
																				<tr class="indian-tariff">
																					<td>201 - 300</td>
																					<td class="success">10000</td>
																					<td>70%</td>
																					<td class="danger">3000 <input name="cata1" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>201 - 300</td>
																					<td class="success">200</td>
																					<td>70%</td>
																					<td class="danger">60 <input name="cata2" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 301 && $totalRegistrations <= 400) {?>
																				<tr class="indian-tariff">
																					<td>301 - 400</td>
																					<td class="success">10000</td>
																					<td>60%</td>
																					<td class="danger">4000 <input name="cata1" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">	
																					<td>301 - 400</td>
																					<td class="success">200</td>
																					<td>60%</td>
																					<td class="danger">80 <input name="cata2" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 401 && $totalRegistrations <= 500) {?>
																				<tr class="indian-tariff">
																					<td>401 - 500</td>
																					<td class="success">10000</td>
																					<td>50%</td>
																					<td class="danger">5000 <input name="cata1" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>401 - 500</td>
																					<td class="success">200</td>
																					<td>50%</td>
																					<td class="danger">100 <input name="cata2" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 501 && $totalRegistrations <= 600) {?>
																				<tr class="indian-tariff">
																					<td>501 - 600</td>
																					<td class="success">10000</td>
																					<td>40%</td>
																					<td class="danger">6000 <input name="cata1" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>501 - 600</td>
																					<td class="success">200</td>
																					<td>40%</td>
																					<td class="danger">120 <input name="cata2" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 601 && $totalRegistrations <= 700) {?>
																				<tr class="indian-tariff">
																					<td>601 - 700</td>
																					<td class="success">10000</td>
																					<td>30%</td>
																					<td class="danger">7000 <input name="cata1" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>601 - 700</td>
																					<td class="success">200</td>
																					<td>30%</td>
																					<td class="danger">140 <input name="cata2" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 701 && $totalRegistrations <= 800) {?>
																				<tr class="indian-tariff">
																					<td>701 - 800</td>
																					<td class="success">10000</td>
																					<td>20%</td>
																					<td class="danger">8000 <input name="cata1" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>701 - 800</td>
																					<td class="success">200</td>
																					<td>30%</td>
																					<td class="danger">160 <input name="cata2" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 801 && $totalRegistrations <= 900) {?>
																				<tr class="indian-tariff">
																					<td>801 - 900</td>
																					<td class="success">10000</td>
																					<td>10%</td>
																					<td class="danger">9000 <input name="cata1" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>801 - 900</td>
																					<td class="success">200</td>
																					<td>10%</td>
																					<td class="danger">180 <input name="cata2" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 801 && $totalRegistrations <= 900) {?>
																				<tr class="indian-tariff">
																					<td>901 - 1000</td>
																					<td class="success">10000</td>
																					<td>5%</td>
																					<td class="danger">9500 <input name="cata1" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>901 - 1000</td>
																					<td class="success">200</td>
																					<td>5%</td>
																					<td class="danger">190 <input name="cata2" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else {?>
																				<tr class="indian-tariff">
																					<td>Above 501</td>
																					<td class="success">10000</td>
																					<td>-</td>
																					<td class="danger">10000 <input name="cata1" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td class="success">200</td>
																					<td>-</td>
																					<td class="danger">200 <input name="cata2" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php }?>
																			<tr>
																				<td colspan="5">
																					<p><strong>Please note</strong><br/>
																						- All rates are applicable per person<br/>
																						<sup>#</sup>Service Tax extra at <?php echo $SERVICE_TAX;?>%	<br/>
																						<span style="color:#f00;">The above offer is valid only if the payment is made along with registration.</span>
																					</p>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
															<div class="form-group form-md-radios">
																<label class="control-label col-md-3">Payment Mode <span class="required"> * </span> </label>
																<div class="col-md-9">
																	<div class="md-radio-inline">
						                                                <div class="md-radio">
						                                                    <input type="radio" id="Cc" name="paymode" class="md-radiobtn" value="Credit Card" onclick="showTxt();" checked="checked" required="required">
						                                                    <label for="Cc">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Credit Card / Debit Card / Net Banking
						                                                    </label>
						                                                </div>
						                                                &nbsp;&nbsp;<div class="md-radio" style="display: none;">
						                                                    <input type="radio" id="Dc" name="paymode" class="md-radiobtn" value="Debit Card" onclick="showTxt();" required="required">
						                                                    <label for="Dc">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Debit Card 
						                                                    </label>
						                                                </div>
						                                                <div class="md-radio">
						                                                    <input type="radio" id="Cheque" name="paymode" class="md-radiobtn" value="Cheque" onclick="showTxt();" required="required">
						                                                    <label for="Cheque">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Cheque / DD
						                                                    </label>
						                                                </div>
						                                                <div class="md-radio">
						                                                    <input type="radio" id="BT" name="paymode" class="md-radiobtn" value="Bank Transfer" onclick="showTxt();" required="required">
						                                                    <label for="BT">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Bank Transfer / NEFT / RTGS
						                                                    </label>
						                                                </div>
						                                            </div>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-md-1"></label>
																<div class="col-md-11">
																	<table class="table table-striped table-bordered well" id="credit_card" style="display: none;">
																		<tbody>
																			<tr>
																				<td style="border: medium none;"></td>
																				<td style="border: medium none;">
																					<ul>
																						<li>If the holder of the card is not the delegate, then the delegate should possess: 
																							<ul type="i">
																								<li>A Photocopy of both sides of the card, which will have to be self attested by the card holder authorising the use of the card for the delegate registration fee. For security reasons, please strike out the Card Verification Value (CVV) code on the copy of your card.</li>
																								<li>This Photocopy should also contain the name of the delegate.</li>
																							</ul>
																						</li>
																						<li>The above document MUST be produced at the Registration Desk at BengaluruITE.biz. If the delegate fails to comply with these conditions, BengaluruITE.biz Secretariat  reserves the right to deny the delegate from attending the event.</li>
																					</ul>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	<table class="table table-striped table-bordered well" id="debit_card" style="display: none;">
																		<tbody>
																			<tr>
																				<td style="border: medium none;"></td>
																				<td style="border: medium none; width: 100%;">
																					 <h4>We Accept Following Banks Debit Cards, Please Check and Proceed</h4>
																					<ul>
																						<li>Axis Bank [ Visa Electron only ]</li>
																						<li>Canara Bank Debit Card </li>
																						<li>City Bank Debit Card Only </li>
																						<li>Corporation Bank Debit Card [ Visa Electron only ] </li>
																						<li>Deutsche Bank Debit Card [ Visa Electron only ]</li>
																						<li>HDFC Bank Debit Card [ Visa Electron only ]</li>
																						<li>ICICI Bank Debit Card </li>
																						<li>Indian Overseas Bank Debit Card [ Visa Electron only ] </li>
																						<li>ING Vysya Bank Debit Card [ Visa Electron only ]</li>
																						<li>Karur Vysya Bank Debit Card [ Visa Electron only ] </li>
																						<li>Punjab Nation Bank Debit Card [ Visa Electron only ] </li>
																						<li>State Bank Of India Debit Card </li>
																					</ul>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	<table class="table table-striped table-bordered table-hover " id="bank_transfer1" style="display: none;">
																		<tbody>
																			<tr>
																				<td colspan="2">Delegates are requested to Bank Transfer the registration fees to the following account</td>
																			</tr> 
																			<tr>
																				<td>Account Name :</td>
																				<td style="width: 828px;">BANGALORE IT.BIZ </td>
																			</tr>
																			<tr>
																				<td>Account Type :</td>
																				<td>Current Account</td>
																			</tr>
																			<tr>
																				<td>Account Number :</td>
																				<td>2827201001190</td>
																			</tr>
																			<tr>
																				<td>Bank Name :</td>
																				<td>Canara Bank K.S.F.C Complex Branch</td>
																			</tr>
																			<tr>
																				<td>DP Code No. :</td>
																				<td>2827</td>
																			</tr>
																			<tr>
																				<td>Bank Address :</td>
																				<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
																			</tr>
																			<tr>
																				<td>Bank IFSC Code :</td>
																				<td>CNRB0002827</td>
																			</tr>
																			<tr>
																				<td>Bank MICR Code :</td>
																				<td>560015137</td>
																			</tr>
																		</tbody>
																	</table>
																	<table class="table table-striped table-bordered table-hover " id="bank_transfer2" style="display: none;">
																		<tbody>
																			<tr>
																				<td colspan="2">Delegates are requested to Bank Transfer the registration fees to the following account</td>
																			</tr> 
																			<tr>
																				<td>Account Name :</td>
																				<td style="width: 824px;">MM ACTIV SCI-TECH COMMUNICATIONS PVT.LTD.</td>
																			</tr>
																			<tr>
																				<td>Account Type :</td>
																				<td>Current Account</td>
																			</tr>
																			<tr>
																				<td>Account Number :</td>
																				<td>2827 241 000004</td>
																			</tr>
																			<tr>
																				<td>Bank Name :</td>
																				<td>Canara Bank K.S.F.C Complex Branch</td>
																			</tr>
																			<tr>
																				<td>DP Code No. :</td>
																				<td>2827</td>
																			</tr>
																			<tr>
																				<td>Bank Address :</td>
																				<td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
																			</tr>
																			<tr>
																				<td>Bank SWIFT Code :</td>
																				<td>CNRBINBBLFD</td>
																			</tr>
																			<tr>
																				<td>Bank MICR Code :</td>
																				<td>560015137</td>
																			</tr>
																		</tbody>
																	</table>
																	<table class="table table-striped table-bordered well" id="cheque" style="display: none;">
																		<tbody>
																			<tr>
																				<td style="border: medium none;"></td>
																				<td style="border: medium none; width: 99%;"><p>
																						Please send your Cheque/DD in favour of <?php echo $EVENT_CHEQUE_PAYBLE_AT_NAME;?> payable at <?php echo $EVENT_CHEQUE_PAYBLE_AT;?>, India.<br />
																						Along with the copy of your registration receipt and send to<br />
																						<strong>Address :</strong><br/><?php echo $EVENT_CHEQUE_PAYBLE_ADDRESS;?>
																					<p>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-3"> 
																</label>
																<div class="col-md-4">
																	<div class="g-recaptcha" data-sitekey="<?php echo $EVENT_DATA_SITE_KEY; ?>"></div>
																</div>
															</div>
														</div>
													</div>
	                                            </div>
	                                            <div class="form-actions">
	                                                <div class="row">
	                                                    <div class="col-md-offset-3 col-md-9">
	                                                        <button type="submit" class="btn sbold uppercase green-jungle"> Continue
	                                                            <i class="fa fa-angle-right"></i>
	                                                        </button>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </form>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <!-- END CONTENT BODY -->
	            </div>
	            <!-- END CONTENT -->
        	</div>
        	<!-- END PAGE CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 
            	<div class="row">
            	<span class="col-md-6 col-sm-8 col-xs-12">&copy; Copyright <?php echo date('Y') . '-' . (date('Y') +1);?> - <a href="http://mmactiv.in/" target="_blank" class="yellow">MM Activ Sci-Tech Communications Pvt. Ltd.</a> All Rights Reserved</span>
            	<span class="col-md-6">Web Interface Conceived & Driven By :  <a href="http://interlinks.in/" target="_blank" class="yellow">SCI Knowledge Interlinks</a></span>
            	</div>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
		<script src="assets/global/plugins/respond.min.js"></script>
		<script src="assets/global/plugins/excanvas.min.js"></script> 
		<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="js/common.js"></script>
        <script src="js/registration.js"></script>
        <script>
			jQuery(document).ready(function() {  
				Registration.init('registration_form_1', 0);
			   	show_cata();
			   	show_div_group_user();
			   	showTxt();
				show_div_type_reg();
			});
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>
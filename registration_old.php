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
//$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG);
$totalRegistrations = 200;//mysqli_num_rows($qr_gt_user_data_id);
//echo $qr_gt_user_data_ans_no;

$assoc_name = @$_GET['assoc_name'];
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
		
		<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-K9ZM6R');</script>
		<!-- End Google Tag Manager -->
		
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '282697168792929');
		fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=282697168792929&ev=PageView&noscript=1"
		/></noscript>
		<!-- DO NOT MODIFY -->
		<!-- End Facebook Pixel Code -->
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
										<?php if((date('Y-m-d H:i') <= '2016-11-26 20:00') && ($assoc_name!="KBITS") ) {?>
											<form action="registration2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post" onsubmit="return validate_registration_form_2()">
												<?php /*?><input type="hidden" value="Standard" name="cata_m" /><?php */?>
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
																<?php /*?><div class="form-group form-md-radios">
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
																			<input type="text" name="total_dele" type="text" id="total_dele" maxlength="1" onkeyup="check_dele(event, 'total_dele');" />
																			<span class="highlight"></span> 
																			<span class="bar"></span> 
																			<span class="help-block"> Min. 2 and max. 7 delegates are allowed. </span>
																			<div class="alert alert-danger" id="del-error" style="display: none;">
																				<strong>Error!</strong> Please enter number between 2 to 7 only.
																			</div>
																		</div>
																	</div>
																</div><?php */?>
																<div class="group form-group" style="margin-bottom:0px;">
																	<label class="control-label col-md-3"> Number of Delegate(s) <span class="required"> * </span>
																		</label>
																	<div class="col-md-9">
																		<div class="col-md-6" style="margin-top: -21px;">
																			<div class="mdl-select mdl-js-select mdl-select--floating-label">
																				<select class="mdl-select__input dips-mdl-select-input" name="total_dele" id="total_dele" required>
																					<option value="">-- Select Number of Delegate --</option>
																					<?php 
																						for($index = 1; $index <= 7; $index++) {
																							echo '<option value="' . $index . '">' . $index . '</option>';
																						}
																					?>
																				</select>
																				<label class="mdl-select__label" for="professsion"></label>
																			</div>
																		</div>
																	</div>
																</div>
																<?php if($assoc_name == 'ABAI' || $assoc_name == 'Spread' || $assoc_name == 'KSRSAC' || $assoc_name == 'TiE Bangalore' || $assoc_name == 'YESSS Abstract Presenter'|| $assoc_name=='KBITS') {?>
																	<div class="form-group form-md-radios" id="del_type">
																		<label class="control-label col-md-3">Delegate Type <span class="required"> * </span> </label>
																		<div class="col-md-9">
																			<div class="md-radio-inline">
																				<div class="md-radio">
																					<input type="radio" id="Industry" name="cata_m" class="md-radiobtn" value="Industry" checked="checked" onclick="assignSingleDay();" required="required">
																					<label for="Industry">
																						<span></span>
																						<span class="check"></span>
																						<span class="box"></span> Industry 
																					</label>
																				</div>
																				<div class="md-radio">
																					<input type="radio" id="Student" name="cata_m" class="md-radiobtn" value="Student" onclick="assignSingleDay();" required="required">
																					<label for="Student">
																						<span></span>
																						<span class="check"></span>
																						<span class="box"></span> Student 
																					</label>
																				</div>
																			</div>
																		</div>
																	</div>
																	<input type="radio" id="Indian" name="curr" class="hide" value="Indian" checked="checked" onclick="show_cata();" required="required">
																	<input type="radio" id="Single_Day" name="daytype" class="hide" value="Single Day" checked="checked" onclick="showDays();">
																	
																	<div class="group form-group">
																		<label class="control-label col-md-3">Association Name: </label>
																		<div class="col-md-9" style="margin-top: 8px;"><?php echo $assoc_name;?>
																		<input type="hidden" id="assoc_name" name="assoc_name" value="<?php echo $assoc_name;?>">
																		</div>
																	</div>
																	<?php if($assoc_name == 'ABAI') {?>
																		<input type="checkbox" id="day2" name="day2" class="hide" checked="checked" value="Day 2">
																		<div class="group form-group">
																			<label class="control-label col-md-3">Regitration Single Day: </label>
																			<div class="col-md-9" style="margin-top: 8px;">Day 2 - Tuesday, November 29, 2016</div>
																		</div>
																	<?php } else if($assoc_name == 'Spread') {?>
																		<input type="checkbox" id="day3" name="day3" class="hide" checked="checked" value="Day 3">
																		<div class="group form-group">
																			<label class="control-label col-md-3">Regitration Single Day: </label>
																			<div class="col-md-9" style="margin-top: 8px;">Day 3 - Wednesday, November 30, 2016</div>
																		</div>
																	<?php } else if($assoc_name == 'KSRSAC'||$assoc_name == 'KBITS') {?>
																		<input type="checkbox" id="day3" name="day3" class="hide" checked="checked" value="Day 3">
																		<div class="group form-group">
																			<label class="control-label col-md-3">Regitration Single Day: </label>
																			<div class="col-md-9" style="margin-top: 8px;">Day 3 - Wednesday, November 30, 2016</div>
																		</div>
																	<?php } else if($assoc_name == 'TiE Bangalore') {?>
																		<input type="checkbox" id="day3" name="day3" class="hide" checked="checked" value="Day 3">
																		<div class="group form-group">
																			<label class="control-label col-md-3">Regitration Single Day: </label>
																			<div class="col-md-9" style="margin-top: 8px;">Day 3 - Wednesday, November 30, 2016</div>
																		</div>
																<?php } else if($assoc_name == 'YESSS Abstract Presenter') {?>
																		<input type="radio" id="Full_Day" name="daytype" class="hide" value="3 Days" checked="checked">
																		<div class="group form-group">
																			<label class="control-label col-md-3">Regitration Days: </label>
																			<div class="col-md-9" style="margin-top: 8px;">All 3 days</div>
																		</div>	
																<?php }} else {?>
																	<?php if(!empty($assoc_name)) {?>
																		<div class="group form-group">
																			<label 
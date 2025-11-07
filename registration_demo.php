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
															<?php if($assoc_name == 'ABAI' || $assoc_name == 'Spread' || $assoc_name == 'KSRSAC' || $assoc_name == 'TiE Bangalore') {?>
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
																<?php } else if($assoc_name == 'KSRSAC') {?>
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
															<?php }} else {?>
																<?php if(!empty($assoc_name)) {?>
																	<div class="group form-group">
																		<label class="control-label col-md-3">Association Name: </label>
																		<div class="col-md-9" style="margin-top: 8px;"><?php echo $assoc_name;?>
																		</div>
																	</div>
																<?php }?>
																<div class="form-group form-md-radios">
						                                            <label class="control-label col-md-3">Organization Type <span class="required"> * </span> </label>
						                                            <div class="col-md-9">
							                                            <div class="md-radio-inline">
							                                                <div class="md-radio">
							                                                	<input type="hidden" id="assoc_name" name="assoc_name" value="<?php echo !empty($assoc_name)? $assoc_name : '';?>">
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
						                                        <div class="form-group form-md-radios" id="reg_type">
						                                            <label class="control-label col-md-3"> Type of registration<span class="required"> * </span> </label>
																	<div class="col-md-9">
																		 <div class="md-radio-inline">
							                                                <div class="md-radio">
							                                                    <input type="radio" id="Single_Day" name="daytype" class="md-radiobtn" value="Single Day" onclick="showDays();">
							                                                    <label for="Single_Day">
							                                                        <span></span>
							                                                        <span class="check"></span>
							                                                        <span class="box"></span> Single Day </label>
							                                                </div>
							                                                <div class="md-radio">
							                                                    <input type="radio" id="Full_Day_101_200" name="daytype" class="md-radiobtn" value="Three Days - (101-200)" checked="checked" onclick="showDays();">
							                                                    <label for="Full_Day">
							                                                        <span></span>
							                                                        <span class="check"></span>
							                                                        <span class="box"></span> Three Days - (101-200)</label>
							                                                </div>
                                                                            <div class="md-radio">
							                                                    <input type="radio" id="Full_Day_201_300" name="daytype" class="md-radiobtn" value="Three Days - (201-300)" checked="checked" onclick="showDays();">
							                                                    <label for="Full_Day">
							                                                        <span></span>
							                                                        <span class="check"></span>
							                                                        <span class="box"></span> Three Days - (201-300)</label>
							                                                </div>
							                                            </div>
																	</div>
																</div>
																<div class="form-group form-md-radios" id="div_single_day" style="display: none;">
																	<label class="control-label col-md-3">Select Day(s)<span class="required"> * </span> </label>
																	<div class="col-md-9">
																		<div class="md-checkbox-inline">
							                                                <div class="md-checkbox">
							                                                    <input type="checkbox" id="day1" name="day1" class="md-check" value="Day 1">
							                                                    <label for="day1">
							                                                        <span></span>
							                                                        <span class="check"></span>
							                                                        <span class="box"></span> Day 1
							                                                	</label>
							                                                </div>
							                                                <div class="md-checkbox">
							                                                    <input type="checkbox" id="day2" name="day2" class="md-check" value="Day 2">
							                                                    <label for="day2">
							                                                        <span></span>
							                                                        <span class="check"></span>
							                                                        <span class="box"></span> Day 2
							                                                	</label>
							                                                </div>
							                                                <div class="md-checkbox">
							                                                    <input type="checkbox" id="day3" name="day3" class="md-check" value="Day 3">
							                                                    <label for="day3">
							                                                        <span></span>
							                                                        <span class="check"></span>
							                                                        <span class="box"></span> Day 3
							                                                	</label>
							                                                </div>
							                                            </div>
																	</div>
																</div>
															 <?php }?>
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
																			<?php /* if($totalRegistrations >= 0 && $totalRegistrations <= 100) {?>
																				<tr class="indian-tariff">
																					<td>1 - 100</td>
																					<td class="success">10000</td>
																					<td>90%</td>
																					<td class="danger">1000 <input name="cata" type="checkbox" class="checkboxes hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>1 - 100</td>
																					<td class="success">200</td>
																					<td>90%</td>
																					<td class="danger">20 <input name="cata" type="checkbox" class="checkboxes hide" value="International Delegate" id="cata2" /></td>
																				</tr>
                                                                                
																			
																			<?php } else if($totalRegistrations >= 301 && $totalRegistrations <= 400) {?>
																				<tr class="indian-tariff">
																					<td>301 - 400</td>
																					<td class="success">10000</td>
																					<td>60%</td>
																					<td class="danger">4000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">	
																					<td>301 - 400</td>
																					<td class="success">200</td>
																					<td>60%</td>
																					<td class="danger">80 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 401 && $totalRegistrations <= 500) {?>
																				<tr class="indian-tariff">
																					<td>401 - 500</td>
																					<td class="success">10000</td>
																					<td>50%</td>
																					<td class="danger">5000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>401 - 500</td>
																					<td class="success">200</td>
																					<td>50%</td>
																					<td class="danger">100 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 501 && $totalRegistrations <= 600) {?>
																				<tr class="indian-tariff">
																					<td>501 - 600</td>
																					<td class="success">10000</td>
																					<td>40%</td>
																					<td class="danger">6000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>501 - 600</td>
																					<td class="success">200</td>
																					<td>40%</td>
																					<td class="danger">120 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 601 && $totalRegistrations <= 700) {?>
																				<tr class="indian-tariff">
																					<td>601 - 700</td>
																					<td class="success">10000</td>
																					<td>30%</td>
																					<td class="danger">7000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>601 - 700</td>
																					<td class="success">200</td>
																					<td>30%</td>
																					<td class="danger">140 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 701 && $totalRegistrations <= 800) {?>
																				<tr class="indian-tariff">
																					<td>701 - 800</td>
																					<td class="success">10000</td>
																					<td>20%</td>
																					<td class="danger">8000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>701 - 800</td>
																					<td class="success">200</td>
																					<td>30%</td>
																					<td class="danger">160 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 801 && $totalRegistrations <= 900) {?>
																				<tr class="indian-tariff">
																					<td>801 - 900</td>
																					<td class="success">10000</td>
																					<td>10%</td>
																					<td class="danger">9000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>801 - 900</td>
																					<td class="success">200</td>
																					<td>10%</td>
																					<td class="danger">180 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else if($totalRegistrations >= 801 && $totalRegistrations <= 900) {?>
																				<tr class="indian-tariff">
																					<td>901 - 1000</td>
																					<td class="success">10000</td>
																					<td>5%</td>
																					<td class="danger">9500 <input name="cata" type="radio" class="hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>901 - 1000</td>
																					<td class="success">200</td>
																					<td>5%</td>
																					<td class="danger">190 <input name="cata" type="radio" class="hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } else {?>
																				<tr class="indian-tariff">
																					<td>Above 501</td>
																					<td class="success">10000</td>
																					<td>-</td>
																					<td class="danger">10000 <input name="cata" type="radio" class="hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td class="success">200</td>
																					<td>-</td>
																					<td class="danger">200 <input name="cata" type="radio" class="hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php } */?>
                                                                            <?php ?>
																				<tr class="indian-tariff">
																					<td>101 - 200</td>
																					<td class="success">10000</td>
																					<td>80%</td>
																					<td class="danger">2000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>101 - 200</td>
																					<td class="success">200</td>
																					<td>80%</td>
																					<td class="danger">40 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php  ?>
																				<tr class="indian-tariff">
																					<td>201 - 300</td>
																					<td class="success">10000</td>
																					<td>70%</td>
																					<td class="danger">3000 <input name="cata" type="radio" class=" hide" value="Indian Delegate" id="cata1" /></td>
																				</tr>
																				<tr class="international-tariff">
																					<td>201 - 300</td>
																					<td class="success">200</td>
																					<td>70%</td>
																					<td class="danger">60 <input name="cata" type="radio" class=" hide" value="International Delegate" id="cata2" /></td>
																				</tr>
																			<?php if($assoc_name == 'ABAI') {?>
																			<tr class="indian-tariff">
																				<td>Single Day-Industry</td>
																				<td class="success">500</td>
																				<td>0%</td>
																				<td class="danger">500 <input name="cata" type="radio" class="hide" value="ABAI Single Day-Industry" id="cata3" /></td>
																			</tr>
																			<tr class="indian-tariff">
																				<td>Single Day-Student</td>
																				<td class="success">250</td>
																				<td>0%</td>
																				<td class="danger">250 <input name="cata" type="radio" class="hide" value="ABAI Single Day-Student" id="cata4" /></td>
																			</tr>
																			<?php } else {?>
																			<tr class="indian-tariff">
																				<td>Single Day-Industry</td>
																				<td class="success">1500</td>
																				<td>0%</td>
																				<td class="danger">1500 <input name="cata" type="radio" class="hide" value="Single Day-Industry" id="cata3" /></td>
																			</tr>
																			<tr class="indian-tariff">
																				<td>Single Day-Student</td>
																				<td class="success">1000</td>
																				<td>0%</td>
																				<td class="danger">1000 <input name="cata" type="radio" class="hide" value="Single Day-Student" id="cata4" /></td>
																			</tr>
																			<?php }?>
																			<tr>
																				<td colspan="5">
																					<p><strong>Delegate/Student Entitlements:</strong><br/>
																						- All rates are applicable per person<br/>
																						- Service Tax extra at <?php echo $SERVICE_TAX;?>%	<br/>
																						- <span style="color:#f00;">The above offer is valid only if the payment is made along with registration.</span><br>
- Delegate Kit consisting of Delegate Bag, programme document, exhibitor directory, notebook & pen<br>
- Coffee & Lunch<br>
																						<?php if(empty($assoc_name)) {?>
																							-<span style="">For early bird Registration Slabs 201-300 you are alse entitled for a free Philips BT50B Wireless Speaker worth Rs. 2000 Free.</span><br/>
																							-<span style="">For early bird Registration Slabs 301-400 you are alse entitled for a free MI 20800 MAH Power Bank worth Rs. 2,999 Free.</span>
																						<?php }?>
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
        <script src="js/registration_demo.js"></script>
        <script>
			jQuery(document).ready(function() {  
				Registration.init('registration_form_1', 0);
				
			   	show_cata();
			   	//show_div_group_user();
			   	showTxt();
			   	showDays();
			   	assignSingleDay();
			});
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>
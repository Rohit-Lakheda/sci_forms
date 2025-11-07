<?php
echo "<script language='javascript'>window.location = 'enquiry.php';</script>";
exit;
	session_start();
	
	require("includes/form_constants.php");
	require "dbcon_open.php";
	require "get_user_no.php";
	
	do {
		$i = 0;
		$text = get_rand_id(6);
		$_SESSION["vercode_reg_eoi"] = $text; 
				
		$chq_qr_demo = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_EXPRESSION_OF_INTEREST." WHERE reg_id = '$text'")or die(mysqli_error($link));
		$chq_no_demo = mysqli_num_rows($chq_qr_demo); 
		
		if($chq_no_demo > 0) {
			$i++;
			continue;
		} else {
			$i = 0;
		}
	} while($i != 0);
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
        <link href="telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />
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
	                    <h3 class="page-title"> Expression of Interest Form </h3>
	                    <!-- END PAGE TITLE-->
	                    <!-- END PAGE HEADER-->
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="portlet light bordered" id="registration_form_3">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class=" icon-layers font-red"></i>
	                                        <span class="caption-subject font-red bold uppercase"> Expression of Interest Form
	                                        </span>
	                                    </div>
	                                </div>
	                                <div class="portlet-body form">
	                                    <form action="expression_of_interest2.php" class="form-horizontal" name="reg_registration_form_3" id="reg_registration_form_3" method="post">
	                                    	<input name="vercode" type="hidden" id="vercode" value="<?php echo $_SESSION['vercode_reg_eoi'];?>"/>
	                                        <div class="form-wizard">
	                                            <div class="form-body">
	                                                <ul class="nav nav-pills nav-justified steps">
	                                                    <li class="active">
	                                                        <a class="step dips-default-cursor">
	                                                            <span class="number"> 1 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Personal Detail  </span>
	                                                        </a>
	                                                    </li>
	                                                    <li>
	                                                        <a data-toggle="tab" class="step dips-default-cursor">
	                                                            <span class="number"> 2 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Confirmation </span>
	                                                        </a>
	                                                    </li>
	                                                </ul>
	                                                <div id="bar" class="progress progress-striped" role="progressbar">
	                                                    <div class="progress-bar progress-bar-success"> </div>
	                                                </div>
	                                                <div class="tab-content">
														<div class="tab-pane active">
															<h3 class="block">Provide Personal Information</h3>
															<div class="group form-group">
																<label class="control-label col-md-3"> Name <span class="required"> * </span>
																	</label>
																<div class="col-md-9">
																	<div class="col-md-2" style="margin-top: -21px;">
																		<div class="mdl-select mdl-js-select mdl-select--floating-label">
																	        <select class="mdl-select__input dips-mdl-select-input" name="title" id="title" required>
																	   			<option value=""></option>
																				<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
														                            foreach ($titleList as $title) {
														                            	$selected = '';
														                            	$qr_gt_user_data_ans_row['title'] = 'Mr.';
														                            	if($qr_gt_user_data_ans_row['title'] == $title){
														                            		$selected = 'selected="selected"';
														                            	}
														                            	echo '<option value="' . $title . '" ' . $selected . '>' . $title . '</option>';
														                            }
														                    	?>
																	        </select>
																	        <label class="mdl-select__label" for="professsion">Title</label>
																		</div>
																	</div>
																	<div class="col-md-4" style="margin-top: -11px;">
																		<input name="fname" type="text" class="dips-name-textbox" id="fname" required style="width: 100%;"/>
																		<span class="dips-highlight "></span> 
																		<span class="bar "></span> 
																		<label class="md-textbox-lable">&nbsp;&nbsp;First Name</label>
																	</div>
																	<div class="col-md-4" style="margin-top: -11px;">
																		<input name="lname" type="text" class="dips-name-textbox" id="lname" required style="width: 100%;" />
																		<span class="dips-highlight "></span> 
																		<span class="bar "></span> 
																		<label class="md-textbox-lable">&nbsp;&nbsp;Last Name</label>
																	</div>
																</div>
															</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input name="org" type="text" id="org" required onkeyup="check_char(event,'badge')"  />
																	<span class="dips-highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;Organisation Name<span class="dips-required"> * </span></label>
																</div>
															</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input name="desig" type="text" id="desig" required />
																	<span class="dips-highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;Designation <span class="dips-required"> * </span></label>
																</div>
															</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input name="email" type="email" class="dips-email" id="email" required />
																	<span class="dips-highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;Email Address<span class="dips-required"> * </span></label>
																</div>
															</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-9">
																	<span type="tel" id="mobile-country-code" data-fax-iso-code-hidden-field-name="cellnoCountryCode"></span>
																	<input type="hidden" name="cellnoCountryCode" id="cellnoCountryCode"/>
																	<input type="hidden" id="cellnoCountryCodeIso" />
																	<input name="mobile" type="text" id="mobile" class="dips-telephone-textbox" maxlength="10" required onkeyup="check_num(event, 'mobile');"/>
																	<span class="dips-highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;Mobile Number<span class="dips-required"> * </span></label>
																	<span class="help-block">+Country Code-Mobile Number(xxx-xxxxxxxxxx)</span>
																</div>
															</div>
															<div class="note note-success">
																<h3>Kindly Note</h3>
																<ul type="1">
																	<li>EoI's for the CEO Conclave is limited only to C-Level Executives and Top Management.</li>
																	<li>The EoI's received for attending the CEO Conclave will be scrutinised by a committee.</li>
																	<li>Shortlisted persons would be intimated about their selection for participating in the CEO Conclave.</li>
																	<li>Participants are required to pay a participation fee of Rs. 2000 + Service Tax @ 15% towards the same.</li>
																</ul>
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
	                                                        <button type="button" class="btn sbold uppercase green-jungle" onclick="validate_registration_form_3();"> Click Here to Submit your request
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
        <script src="js/material.min.js"></script>
        <script src="js/material-select.js"></script>
        <script src="telephoneWithFlags/js/intlTelInput.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="js/common.js"></script>
        <script src="js/expression_of_interest.js"></script>
        <script>
			jQuery(document).ready(function() {  
				Registration.init('registration_form_3', 0);
				$("#mobile-country-code").intlTelInput();
			});
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>
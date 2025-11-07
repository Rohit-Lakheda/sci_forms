<?php 
 session_start(); 
require "includes/form_constants.php";

require "yesss_abstracts_reg_captcha.php";
$page = basename($_SERVER['SCRIPT_NAME']);

if(!isset($_SESSION['USER_SRNO']) || empty($_SESSION['USER_SRNO'])) {
	echo "<script language='javascript'>alert('Your session has been expired!');</script>";
	echo "<script language='javascript'>window.location='it_yesss_abstracts_reg.php';</script>";
	exit;
}
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
	                    <h3 class="page-title"> Inviting Abstracts for YESSS Programme. </h3>
	                    <!-- END PAGE TITLE-->
	                    <!-- END PAGE HEADER-->
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="portlet light bordered" id="registration_form_2">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class=" icon-layers font-red"></i>
	                                        <span class="caption-subject font-red bold uppercase"> Abstracts Submission for YESSS Programme.
	                                        </span>
	                                    </div>
	                                </div>
	                                <div class="portlet-body form">
	                                    <form action="it_yesss_abstracts_reg4.php" class="form-horizontal" name="reg_registration_form_3" id="reg_registration_form_3" method="post" enctype="multipart/form-data">
	                                        <div class="form-wizard">
	                                            <div class="form-body">
	                                                <ul class="nav nav-pills nav-justified steps">
	                                                    <li class="done">
	                                                        <a class="step dips-default-cursor">
	                                                            <span class="number"> 1 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Registration </span>
	                                                        </a>
	                                                    </li>
	                                                    <li class="active">
	                                                        <a data-toggle="tab" class="step">
	                                                            <span class="number"> 2 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Information </span>
	                                                        </a>
	                                                    </li>
	                                                    <li>
	                                                        <a data-toggle="tab" class="step dips-default-cursor">
	                                                            <span class="number"> 3 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Confirm </span>
	                                                        </a>
	                                                    </li>
	                                                </ul>
	                                                <div id="bar" class="progress progress-striped" role="progressbar">
	                                                    <div class="progress-bar progress-bar-success"> </div>
	                                                </div>
	                                                <div class="tab-content">
														<div class="tab-pane active">
															<h3 class="block">Provide Your Information</h3>
                                                            <div class="form-group">
																<label class="control-label col-md-3">What is the innovative solution?<span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<textarea name="q1_inno_idea" rows="3" id="q1_inno_idea" required="required" onKeyUp="countWord(this, 60,'display_count1','word_left1');"></textarea>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
                                                                        <span class="help-block">Total word count: <span id="display_count1">0</span> words. Words left: <span id="word_left1">60</span></span>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-3">How large is the market for this solution? <span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<textarea name="q1_inno_idea_new" rows="3" id="q1_inno_idea_new" required="required" onKeyUp="countWord(this, 60,'display_count9','word_left9');"></textarea>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
                                                                        <span class="help-block">Total word count: <span id="display_count9">0</span> words. Words left: <span id="word_left9">60</span></span>
																	</div>
																</div>
															</div>	
                                                          <div class="form-group">
																<label class="control-label col-md-3">What is your unique product, solution or service that addresses the issue and provides a solution apart from the existing one?<span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<textarea name="q2_uni_product" rows="3" id="q2_uni_product" required="required" onKeyUp="countWord(this, 50,'display_count2','word_left2');"></textarea>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
                                                                        <span class="help-block">Total word count: <span id="display_count2">0</span> words. Words left: <span id="word_left2">50</span></span>
																	</div>
																</div>
															</div>
                                                           <div class="form-group">
					                                            <label class="control-label col-md-3"> What stage is your business now?<span class="required"> * </span></label>
																<div class="col-md-8 col-sm-3">	
																	<div class="md-checkbox-list">
																	<?php $id = 0;
									                                            		for($index = 0; $index < count($BUSINESS_STAGE); $index++) {
									                                            			$id++;
										                                            		$checked = '';
										                                            		
										                                    		?>
						                                            	<?php 
						                                            		/*for($listIndex = 0; $listIndex < 2; $listIndex++) {
						                                            			$length = count($BUSINESS_STAGE);
						                                            			$index = count($BUSINESS_STAGE) /2;
						                                            			if($listIndex == 0) {
						                                            				$index = 0;
						                                            				$length = count($BUSINESS_STAGE) /2;
						                                            			}*/
						                                            	?>
						                                            			<div class="md-checkbox-inline">          			
											                                                <div class="md-checkbox">
											                                                    <input type="checkbox" name="q3_busi_stage<?php echo $id;?>" id="q3_busi_stage<?php echo $id;?>" value="<?php echo $BUSINESS_STAGE[$index];?>" class="md-check" <?php echo $checked;?> <?php if($BUSINESS_STAGE[$index] == 'Others') { ?>onclick="show_othr_que_div('q3_busi_stage<?php echo $id;?>');"<?php }?>>
											                                                    <label for="q3_busi_stage<?php echo $id;?>">
											                                                        <span></span>
											                                                        <span class="check"></span>
											                                                        <span class="box"></span> <?php echo $BUSINESS_STAGE[$index];?></label>
											                                                </div>
									                                            		<?php //}?>
							                                            		</div>
							                                            	<?php }?>
							                                    	</div>
						                                   		</div>
					                                        </div>
					                                         <div class="form-group">
																<label class="control-label col-md-3">How many Full Time employees are currently working with you? <span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<input type="text" name="totalEmp" id="totalEmp" onkeyup="check_num(event, 'totalEmp');" required="required"/>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
                                                                        <span class="help-block">Limit Upto 500</span>
																	</div>
																</div>
															</div>
															 <div class="form-group">
																<label class="control-label col-md-3">How many Founders in the organisation?<span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<input type="text" name="totalFounders" id="totalFounders" onkeyup="check_num(event, 'totalFounders');" required="required"/>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
                                                                        <span class="help-block">Limit Upto 15</span>
																	</div>
																</div>
															</div>
															 <div class="form-group">
																<label class="control-label col-md-3">LinkedIn profiles of the Founders URL<span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																	<textarea name="linkedin" rows="3" id="linkedin" required="required"></textarea>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
																	</div>
																</div>
															</div>
                                                            <div class="form-group">
																<label class="control-label col-md-3">How do you expect to convert the idea into a business if you are at the idea stage? <span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<textarea name="q4_idea_stage" rows="3" id="q4_idea_stage" required="required" onKeyUp="countWord(this, 100,'display_count4','word_left4');"></textarea>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
                                                                        <span class="help-block">Total word count: <span id="display_count4">0</span> words. Words left: <span id="word_left4">100</span></span>
																	</div>
																</div>
															</div>
															 <div class="form-group">
																<label class="control-label col-md-3">How long have you been operational? <span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<textarea name="q5_annual_turn" rows="3" id="q5_annual_turn" required="required" onKeyUp="countWord(this, 40,'display_count5','word_left5');"></textarea>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
                                                                        <span class="help-block">Total word count: <span id="display_count5">0</span> words. Words left: <span id="word_left5">40</span></span>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-3">What is your annual business turnover?<span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<textarea name="q5_annual_turn_new" rows="3" id="q5_annual_turn_new" required="required" onKeyUp="countWord(this, 40,'display_count10','word_left10');"></textarea>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
																		<span class="help-block">Total word count: <span id="display_count10">0</span> words. Words left: <span id="word_left10">40</span></span>
																	</div>
																</div>
															</div>
															 <div class="form-group">
																<label class="control-label col-md-3">Explain your 'Go to Market' Strategy, Customer segment plan. <span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<textarea name="q6_mark_strategy" rows="3" id="q6_mark_strategy" required="required" onKeyUp="countWord(this, 50,'display_count6','word_left6');"></textarea>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
                                                                        <span class="help-block">Total word count: <span id="display_count6">0</span> words. Words left: <span id="word_left6">50</span></span>
																	</div>
																</div>
															</div>
                                                             <div class="form-group">
																<label class="control-label col-md-3">What is your business model?What are the revenue streams for your business? How much will it cost you to earn the revenue stream? <span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<textarea name="q7_busi_model" rows="3" id="q7_busi_model" required="required" onKeyUp="countWord(this, 50,'display_count7','word_left7');"></textarea>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
                                                                        <span class="help-block">Total word count: <span id="display_count7">0</span> words. Words left: <span id="word_left7">50</span></span>
																	</div>
																</div>
															</div>
                                                             <div class="form-group">
																<label class="control-label col-md-3">Outline your Business Plan for the next 3 years? What are the critical milestones for your business that you have planned for the future?  <span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<textarea name="q8_busi_plan" rows="3" id="q8_busi_plan" required="required" onKeyUp="countWord(this, 50,'display_count8','word_left8');"></textarea>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
                                                                        <span class="help-block">Total word count: <span id="display_count8">0</span> words. Words left: <span id="word_left8">50</span></span>
																	</div>
																</div>
															</div>
															  <div class="form-group">
					                                            <label class="control-label col-md-3"> How much funding has been raised?<span class="required"> * </span></label>
																<div class="col-md-8 col-sm-3">
																	<div class="md-checkbox-list">
						                                            	<?php $id = 0;
						                                            		for($listIndex = 0; $listIndex < 2; $listIndex++) {
						                                            			$length = count($FUNDING);
						                                            			$index = count($FUNDING) /2;
						                                            			if($listIndex == 0) {
						                                            				$index = 0;
						                                            				$length = count($FUNDING) /2;
						                                            			}
						                                            	?>
						                                            			<div class="md-checkbox-inline">
							                                            			<?php 
									                                            		for($index = $index; $index < $length; $index++) {
									                                            			$id++;
										                                            		$checked = '';
										                                            		
										                                    		?>
											                                                <div class="md-checkbox">
											                                                    <input type="checkbox" name="q10_yesss_prog<?php echo $id;?>" id="q10_yesss_prog<?php echo $id;?>" value="<?php echo $FUNDING[$index];?>" class="md-check" <?php echo $checked;?> <?php if($FUNDING[$index] == 'Others') { ?>onclick="show_othr_que_div('q10_yesss_prog<?php echo $id;?>');"<?php }?>>
											                                                    <label for="q10_yesss_prog<?php echo $id;?>">
											                                                        <span></span>
											                                                        <span class="check"></span>
											                                                        <span class="box"></span> <?php echo $FUNDING[$index];?></label>
											                                                </div>
									                                            		<?php }?>
							                                            		</div>
							                                            	<?php }?>
							                                    	</div>
						                                   		</div>
					                                        </div>
					                                         <div class="form-group">
					                                            <label class="control-label col-md-3">From whom have you raised the funding?<span class="required"> * </span></label>
																<div class="col-md-8 col-sm-3">
																	<div class="md-checkbox-list">
						                                            	<?php $id = 0;
						                                            		for($listIndex = 0; $listIndex < 2; $listIndex++) {
						                                            			$length = count($FROM_WHOM_FUNDING);
						                                            			$index = count($FROM_WHOM_FUNDING) /2;
						                                            			if($listIndex == 0) {
						                                            				$index = 0;
						                                            				$length = count($FROM_WHOM_FUNDING) /2;
						                                            			}
						                                            	?>
						                                            			<div class="md-checkbox-inline">
							                                            			<?php 
									                                            		for($index = $index; $index < $length; $index++) {
									                                            			$id++;
										                                            		$checked = '';
										                                            		
										                                    		?>
											                                                <div class="md-checkbox">
											                                                    <input type="checkbox" name="q11_yesss_prog<?php echo $id;?>" id="q11_yesss_prog<?php echo $id;?>" value="<?php echo $FROM_WHOM_FUNDING[$index];?>" class="md-check" <?php echo $checked;?> <?php if($FROM_WHOM_FUNDING[$index] == 'Other') { ?>onclick="show_funding_othr_fun('q11_yesss_prog<?php echo $id;?>');"<?php }?>>
											                                                    <label for="q11_yesss_prog<?php echo $id;?>">
											                                                        <span></span>
											                                                        <span class="check"></span>
											                                                        <span class="box"></span> <?php echo $FROM_WHOM_FUNDING[$index];?></label>
											                                                </div>
											                                                <?php if($FROM_WHOM_FUNDING[$index] == 'Other') { ?>
											                                            		<div class="rs-mb30" id="div_funding_other_que" style="display:none;">
																									<input name="other_name_funding" id="other_name_funding" type="text" class="dips-not-required" placeholder="Other"/>
																									<span class="dips-highlight "></span> 
																									<span class="bar "></span> 
																								</div>
											                                            	<?php }
									                                            		 }?>
							                                            		</div>
							                                            	<?php }?>
							                                    	</div>
						                                   		</div>
					                                        </div>
					                                        <div class="form-group">
					                                            <label class="control-label col-md-3"> Is funding Public?<span class="required"> * </span> </label>
																<div class="col-md-9">
																	 <div class="md-radio-inline">
						                                                <div class="md-radio">
						                                                    <input type="radio" id="Yes" name="publicFunding" class="md-radiobtn" value="Yes" onclick="show_div_group_user();" checked="checked" required="required">
						                                                    <label for="Yes">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> Yes </label>
						                                                </div>
						                                                <div class="md-radio">
						                                                    <input type="radio" id="No" name="publicFunding" class="md-radiobtn" value="No" onclick="show_div_group_user();" required="required">
						                                                    <label for="No">
						                                                        <span></span>
						                                                        <span class="check"></span>
						                                                        <span class="box"></span> No </label>
						                                                </div>
						                                            </div>
																</div>
															</div>
															<div class="form-group" id="div_group_user">
																<label class="control-label col-md-3">Person/Organisation Name<span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<input type="text" name="fundPersonName" type="text" id="fundPersonName"/>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
																	</div>
																</div>
															</div>
					                                         <div class="form-group">
					                                            <label class="control-label col-md-3"> How much are you looking to raise?<span class="required"> * </span></label>
																<div class="col-md-8 col-sm-3">
																	<div class="md-checkbox-list">
						                                            	<?php $id = 0;
						                                            		for($listIndex = 0; $listIndex < 2; $listIndex++) {
						                                            			$length = count($FUNDING);
						                                            			$index = count($FUNDING) /2;
						                                            			if($listIndex == 0) {
						                                            				$index = 0;
						                                            				$length = count($FUNDING) /2;
						                                            			}
						                                            	?>
						                                            			<div class="md-checkbox-inline">
							                                            			<?php 
									                                            		for($index = $index; $index < $length; $index++) {
									                                            			$id++;
										                                            		$checked = '';
										                                            		
										                                    		?>
											                                                <div class="md-checkbox">
											                                                    <input type="checkbox" name="q12_yesss_prog<?php echo $id;?>" id="q12_yesss_prog<?php echo $id;?>" value="<?php echo $FUNDING[$index];?>" class="md-check" <?php echo $checked;?> <?php if($FUNDING[$index] == 'Others') { ?>onclick="show_othr_que_div('q12_yesss_prog<?php echo $id;?>');"<?php }?>>
											                                                    <label for="q12_yesss_prog<?php echo $id;?>">
											                                                        <span></span>
											                                                        <span class="check"></span>
											                                                        <span class="box"></span> <?php echo $FUNDING[$index];?></label>
											                                                </div>
									                                            		<?php }?>
							                                            		</div>
							                                            	<?php }?>
							                                    	</div>
						                                   		</div>
					                                        </div>
					                                         <div class="form-group">
																<label class="control-label col-md-3">How many rounds of funds have you raised till now?<span class="required"> * </span> </label>
																<div class="col-md-4 col-sm-3">
																	<div class="group">
																		<input type="text" name="totalFundRound" id="totalFundRound" onkeyup="check_num(event, 'totalFundRound');" required="required"/>
																		<span class="highlight"></span> 
																		<span class="bar"></span>
                                                                        <span class="help-block">Ex. 1,2,3...</span>
																	</div>
																</div>
															</div>
                                                           <div class="form-group">
					                                            <label class="control-label col-md-3"> What do you expect from the YESSS programme?<span class="required"> * </span></label>
																<div class="col-md-8 col-sm-3">
																	<div class="md-checkbox-list">
						                                            	<?php $id = 0;
						                                            		for($listIndex = 0; $listIndex < 2; $listIndex++) {
						                                            			$length = count($YESSS_PROGRAMM);
						                                            			$index = count($YESSS_PROGRAMM) /2;
						                                            			if($listIndex == 0) {
						                                            				$index = 0;
						                                            				$length = count($YESSS_PROGRAMM) /2;
						                                            			}
						                                            	?>
						                                            			<div class="md-checkbox-inline">
							                                            			<?php 
									                                            		for($index = $index; $index < $length; $index++) {
									                                            			$id++;
										                                            		$checked = '';
										                                            		
										                                    		?>
											                                                <div class="md-checkbox">
											                                                    <input type="checkbox" name="q9_yesss_prog<?php echo $id;?>" id="q9_yesss_prog<?php echo $id;?>" value="<?php echo $YESSS_PROGRAMM[$index];?>" class="md-check" <?php echo $checked;?> <?php if($YESSS_PROGRAMM[$index] == 'Others') { ?>onclick="show_othr_que_div('q9_yesss_prog<?php echo $id;?>');"<?php }?>>
											                                                    <label for="q9_yesss_prog<?php echo $id;?>">
											                                                        <span></span>
											                                                        <span class="check"></span>
											                                                        <span class="box"></span> <?php echo $YESSS_PROGRAMM[$index];?></label>
											                                                </div>
										                                               		<?php if($YESSS_PROGRAMM[$index] == 'Others') { ?>
											                                            		<div class="rs-mb30" id="div_enq_other_que" style="display:none;">
																									<input name="other_name" id="other_name" type="text" class="dips-not-required" placeholder="Other"/>
																									<span class="dips-highlight "></span> 
																									<span class="bar "></span> 
																								</div>
											                                            	<?php }
									                                            		}?>
							                                            		</div>
							                                            	<?php }?>
							                                    	</div>
						                                   		</div>
					                                        </div>  
                                                        </div> 
                                                     	<div class="form-group">
                                                            <label class="control-label col-md-3">Upload Product Presentation :</label>
                                                            <div class="col-md-4 col-sm-3">
                                                                <div class="group">
                                                                    <input type="file" id="comp_prof" name="comp_prof" onchange="isValidFile(this);"/><br/>(Max 2MB, pdf)<br/>
                                                                    <span class="highlight"></span> 
                                                                    <span class="bar"></span>
                                                                </div>
                                                            </div>
                                                        </div>                                                              
													</div>
	                                            </div>
                                                
	                                            <div class="form-actions">
	                                                <div class="row">
	                                                    <div class="col-md-offset-3 col-md-9">
	                                                    	<a href="javascript:;" class="btn default" onclick="go_back();">
                                                            	<i class="fa fa-angle-left"></i> Back </a>
	                                                        <button type="button" class="btn sbold uppercase green-jungle" onClick="validateQusetionForm();"> Continue
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
        <script src="js/material.min.js"></script>
        <script src="js/material-select.js"></script>
        <script src="telephoneWithFlags/js/intlTelInput.js"></script>
        <script src="js/common.js"></script>
         <script src="js/yesss_reg.js"></script>
        <script>
			jQuery(document).ready(function() {  
				Registration.init('registration_form_2', 1);
				$("#telCountryIsoCode").intlTelInput();
				$("#faxCountryIsoCode").intlTelInput();
				/* var foneCountryCodeIso = $('#foneCountryCodeIso').val();
				if(foneCountryCodeIso != '') {
					$("#telCountryIsoCode").intlTelInput("setCountry", foneCountryCodeIso);
				} */
			});
			
 
		 function countWord(thisObject, limit, wordCount, wordLeft) {
		 var words = thisObject.value.match(/\S+/g).length;
				if (words > limit) {
					// Split the string on first 200 words and rejoin on spaces
					var trimmed = $(thisObject).val().split(/\s+/, limit).join(" ");
					// Add a space at the end to keep new typing making new words
					$(thisObject).val(trimmed + " ");
				}
				else {
					$('#'+wordCount).text(words);
					$('#'+wordLeft).text(limit-words);
				}
		 }
		 
		 function isValidFile(thisObject){
			myfile= $(thisObject).val();
			var fileSize = document.getElementById("comp_prof").files[0];
			var ext = myfile.split('.').pop();
			 if(ext=="pdf"){
			  
			   } else{
				   $(thisObject).val('');
				   alert("Please upload only pdf format files.");
				   return false;
			   }
			if (fileSize.size > 2097152) // 2 mb for bytes.
            {
                $(thisObject).val('');
			    alert("File size must under 2mb!");
                return false;
            }
			
		  
		}
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>
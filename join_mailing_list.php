<?php 	
	
	require("includes/form_constants.php");
	
	require "join_mailing_list_captcha.php";
	
	
	
	$temp_nm = @$_GET['nm'];
?>

<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />'; 
	                    	require 'includes/reg_form_header.php';?>
<style>
	          	.selected-flag {
	          		margin-top: -10px;
	          	}
	          </style>
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="portlet light bordered" id="registration_form_2">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class=" icon-layers font-red"></i>
	                                        <span class="caption-subject font-red bold uppercase"> Join Mailing List
	                                        </span>
	                                    </div>
	                                </div>
	                                <div class="portlet-body form">
	                                    <form action="join_mailing_list2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_2" id="reg_registration_form_2" method="post" onsubmit="return validate_join_mailing_list();">
	                                        <div class="form-wizard">
	                                            <div class="form-body">
	                                                <ul class="nav nav-pills nav-justified steps">
	                                                    <li class="active">
	                                                        <a href="#tab1" data-toggle="tab" class="step">
	                                                            <span class="number"> 1 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> User Details </span>
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
															<h3 class="block">Provide Your Information</h3>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">Name <span class="dips-required"> * </span></label>
				                                                <div class="col-md-6">
				                                                	<input class="form-control" name="name" type="text" id="name" required="required"/>
				                                                </div>
				                                            </div>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">Job Title <span class="dips-required"> * </span></label>
				                                                <div class="col-md-6">
				                                                	<input class="form-control" name="desig" type="text" id="desig" required="required"/>
				                                                </div>
				                                            </div>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">Company <span class="dips-required"> * </span></label>
				                                                <div class="col-md-6">
				                                                	<input class="form-control" name="org" type="text" id="org" required="required"/>
				                                                </div>
				                                            </div>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">City <span class="dips-required"> * </span></label>
				                                                <div class="col-md-6">
				                                                	<input class="form-control" name="city" type="text" id="city" required="required"/>
				                                                </div>
				                                            </div>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">Email Address <span class="dips-required"> * </span></label>
				                                                <div class="col-md-6">
				                                                	<input class="form-control" name="email" type="email" id="email" required="required"/>
				                                                </div>
				                                            </div>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">Telephone Number </label>
				                                                <div class="col-md-6">
				                                                	<span type="tel" id="telCountryIsoCode" data-fax-iso-code-hidden-field-name="foneCountryCode"></span>
																	<input type="hidden" name="foneCountryCode" id="foneCountryCode" />
																	<input type="hidden" id="foneCountryCodeIso" name="foneCountryCodeIso"/>
																	<input name="fone" type="text" id="fone" class="form-control" maxlength="20" onkeyup="checkPhoneNumber(event, 'fone');" style="padding-left: 92px;"/>
																	<span class="help-block">+Country Code-Area Code-Phone Number(Eg. 91-1234-12345)</span>
				                                                </div>
				                                            </div>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
				                                                <div class="col-md-6">
				                                                	<div class="input-group">
																	  	<input name="vercodevp" type="text" class="form-control" id="vercodevp" maxlength="10" required autocomplete="off"/>
																		<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_jml"];?>" />
																	  	<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $text;?></span>
																	</div>
				                                                </div>
				                                            </div>
														</div>
														<?php /*?><div class="form-group">
	                                                        <label class="control-label col-md-3"> 
	                                                        </label>
	                                                        <div class="col-md-4">
	                                                            <div class="g-recaptcha" data-sitekey="<?php echo $EVENT_DATA_SITE_KEY; ?>"></div>
	                                                        </div>
	                                                    </div>
	                                                  	</div><?php */?>
			                                            <div class="form-actions">
			                                                <div class="row">
			                                                    <div class="col-md-offset-3 col-md-9">
			                                                        <button type="submit" class="btn sbold uppercase green-jungle"> Submit
			                                                            <i class="fa fa-angle-right"></i>
			                                                        </button>
			                                                    </div>
			                                                </div>
			                                            </div>
	                                        </div>
                                           </div> 
	                                    </form>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    
	    <?php require 'includes/reg_form_footer.php';?>
	    <script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="js/join-mailing.js"></script>
        <script>
			jQuery(document).ready(function() {  
				Registration.init('registration_form_2', 0);

				<?php /* if(!empty($qr_gt_user_data_ans_row['foneCountryIso'])) { ?>
					$("#telCountryIsoCode").intlTelInput({preferredCountries: [ "<?php echo $qr_gt_user_data_ans_row['foneCountryIso'];?>" ]});
				<?php } else {*/ ?>
					$("#telCountryIsoCode").intlTelInput();
				<?php // }?>

			});
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>
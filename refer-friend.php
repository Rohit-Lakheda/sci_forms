<?php 	
	
	require "includes/form_constants.php";
	require "refer_friend_captcha.php";
?>

	<?php require 'includes/reg_form_header.php';?>
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="portlet light bordered" id="registration_form_1">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class=" icon-layers font-red"></i>
	                                        <span class="caption-subject font-red bold uppercase"> Refer a Friend
	                                        </span>
	                                    </div>
	                                </div>
	                                <div class="portlet-body form">
	                                    <form action="refer-friend2.php" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post" onsubmit="return validate_refere_a_friend();">
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
															<h3 class="block">Provide your information</h3>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">Your Name <span class="dips-required"> * </span></label>
				                                                <div class="col-md-6">
				                                                	<input class="form-control" name="s_name" type="text" id="s_name" required onkeyup="check_char(event,'s_name')"/>
				                                                </div>
				                                            </div>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">Your Email Id <span class="dips-required"> * </span></label>
				                                                <div class="col-md-6">
				                                                	<input class="form-control" name="s_email" type="email" id="s_email" required />
				                                                </div>
				                                            </div>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">Your Friend's Name <span class="dips-required"> * </span></label>
				                                                <div class="col-md-6">
				                                                	<input class="form-control" name="r_name" type="text" id="r_name" required />
				                                                </div>
				                                            </div>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">Your Friend's Email Id <span class="dips-required"> * </span></label>
				                                                <div class="col-md-6">
				                                                	<input class="form-control" name="r_email" type="text" id="r_email" required />
				                                                </div>
				                                            </div>
				                                            <div class="form-group">
				                                                <label class="col-md-3 control-label">Message <span class="dips-required"> * </span></label>
				                                                <div class="col-md-6">
				                                                <textarea rows="" cols="" class="form-control" name="msg" type="text" id="msg" required></textarea>
				                                                </div>
				                                            </div>
														
														<div class="form-group">
															<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
															<div class="col-md-6">
																<div class="input-group">
																	<input name="vercode" class="form-control" id="vercode" maxlength="10" required="" autocomplete="off" type="text">
																	<input name="test" id="test" value="<?php echo $_SESSION['vercode_raf'];?>" type="hidden">
																	<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION['vercode_raf'];?></span>
																</div>
															</div>
														</div>
                                                     </div>
                                                   </div>   
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
        <script src="js/refer-friend.js"></script>
        <script>
			jQuery(document).ready(function() {  
				Registration.init('registration_form_1', 0);
				$("#telCountryIsoCode").intlTelInput();
			});
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>
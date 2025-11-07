<?php 	
	
	require("includes/form_constants.php");
	require "join_mailing_list_captcha.php";
	
	$temp_nm = @$_GET['nm'];
	if(empty($temp_nm) || !isset($_SESSION['vercode_jml']) || $_SESSION['vercode_jml'] == "")
	{
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired.');</script>";
		echo "<script language='javascript'>window.location=('join_mailing_list.php');</script>";
		echo "<script language='javascript'>document.location=('join_mailing_list.php');</script>";
		exit;
	}

	session_destroy();
?>
<?php require 'includes/reg_form_header.php';?>
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="portlet light bordered" id="reg_form_2">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class=" icon-layers font-red"></i>
	                                        <span class="caption-subject font-red bold uppercase"> Join Mailing List
	                                        </span>
	                                    </div>
	                                </div>
	                                <div class="portlet-body form">
	                                    <form action="#" class="form-horizontal" name="reg_registration_form_2" id="reg_registration_form_2" method="post">
	                                        <div class="form-wizard">
	                                            <div class="form-body">
	                                                <ul class="nav nav-pills nav-justified steps">
	                                                    <li class="done">
	                                                        <a class="step">
	                                                            <span class="number"> 1 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> User Details </span>
	                                                        </a>
	                                                    </li>
	                                                    <li class="done">
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
															<div class="note note-success">
						                                        <h4 class="block">Thank you for submitting your details.</h4>
						                                        <p>Best Regards,<br/>
						                                        	<?php echo $EVENT_NAME .' ' . $EVENT_YEAR . '<br/>' . $EVENT_SECRT_ADDR;?>
						                                        </p>
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
        <script>
			jQuery(document).ready(function() {  
				Registration.init('reg_form_2', 1);
			});
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>
<?php 	
	session_start();
	require("includes/form_constants.php");
	
	$temp_nm = @$_GET['rf'];
	if(empty($temp_nm) || !isset($_SESSION['vercode_raf']) || $_SESSION['vercode_raf'] == "")
	{
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired.');</script>";
		echo "<script language='javascript'>window.location=('refer-friend.php');</script>";
		echo "<script language='javascript'>document.location=('refer-friend.php');</script>";
		exit;
	}
	session_destroy();
?>
<?php require 'includes/reg_form_header.php';?>
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="portlet light bordered" id="enq_form_2">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class=" icon-layers font-red"></i>
	                                        <span class="caption-subject font-red bold uppercase"> Refer a Friend
	                                        </span>
	                                    </div>
	                                </div>
	                                <div class="portlet-body form">
	                                    <form action="enquiry_info.php" class="form-horizontal" id="enq" name="enq" method="post">
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
						                                        <h4 class="block">Your suggestion has been forward to your friend.</h4>
						                                        <p>Best Regards,<br/>
						                                        	<?php echo $EVENT_NAME . ' '. $EVENT_YEAR .'<br/>' . $EVENT_SECRT_ADDR;?>
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
				Registration.init('enq_form_2', 1);
			});
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>
</html>
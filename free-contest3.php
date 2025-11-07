<?php 
	session_start();
	require "includes/form_constants_both.php";
	
	if((!isset($_SESSION["vercode_enq"]))||($_SESSION["vercode_enq"]==''))
	{
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired.');</script>";
		echo "<script language='javascript'>window.location=('enquiry.php');</script>";
		echo "<script language='javascript'>document.location=('enquiry.php');</script>";
		exit;
	}
	
	//session_destroy();
?>
			<?php require 'includes/reg_form_header.php';?>
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="portlet light bordered" id="contest_form_2">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class=" icon-layers font-red"></i>
	                                        <span class="caption-subject font-red bold uppercase"> Free Delegate Contest Form
	                                        </span>
	                                    </div>
	                                </div>
	                                <div class="portlet-body form">
	                                    <form class="form-horizontal" id="enq" name="enq">
	                                        <div class="form-wizard">
	                                            <div class="form-body">
	                                                <ul class="nav nav-pills nav-justified steps">
	                                                    <li class="done">
	                                                        <a class="step">
	                                                            <span class="number"> 1 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Personal Details</span>
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
						                                        <h4 class="block">Thank you for Registration at <?php echo $EVENT_NAME.' '.$EVENT_YEAR;?></h4>
						                                        <p> Our representative will contact you via email if you are selected as a winner.</p><br/>
						                                        <p>Best Regards,<br/>
						                                        	<?php echo $EVENT_NAME . '<br/>' . $EVENT_SECRT_ADDR;?>
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
				Registration.init('contest_form_2', 1);
			});
		</script>
    </body>
</html>
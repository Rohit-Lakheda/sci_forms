<?php 
	session_start();
	require "includes/form_constants_both.php";
	require "dbcon_open.php";
	$EVENT_DB_FORM_EXHIBITOR_DIR_ROADSHOW_TBL = "it_roadshow_table";
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_DIR_ROADSHOW_TBL);
	$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
	$row = mysqli_fetch_array($qr_gt_user_data_id);
	
	// Fetch name from URL parameter if provided
	if (isset($_GET['dele_typ']) && !empty($_GET['dele_typ'])) {
		$name = htmlspecialchars($_GET['dele_typ']);
		$row['fname'] = $name;
	}
	
	// Also check for 'name' parameter for backward compatibility
	if (isset($_GET['name']) && !empty($_GET['name'])) {
		$name = htmlspecialchars($_GET['name']);
		$row['fname'] = $name;
	}
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
	                            <div class="portlet light bordered" id="enq_form_2">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class=" icon-layers font-red"></i>
	                                        <span class="caption-subject font-red bold uppercase"> Virtual Roadshow Form
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
																<h4 class="block">Dear <?php echo $row['fname']; ?></h4>
						                                        <P>Thank you for submitting the Virtual Roadshow form.</p>
						                                        <p>Our representative will be in touch with you shortly.</p><br/>
																<p> If you have any questions in the meantime, please feel free to contact us.<br>
																Anjali Nair<br>
																<a href="mailto:anjali.nair@mmactiv.com">anjali.nair@mmactiv.com</a><br>
																+91-7338398788
																</p><br>
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
				Registration.init('enq_form_2', 1);
			});
		</script>
    </body>
</html>
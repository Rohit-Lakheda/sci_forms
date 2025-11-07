<?php 
// ini_set("display_errors", "1");
// error_reporting(E_ALL);
	session_start();  
	
	// require "includes/form_constants.php";
		require "includes/form_constants_both.php";
	if ((! isset ( $_SESSION ["vercode_ex"] )) || ($_SESSION ["vercode_ex"] == '')) {
		//session_destroy ();
		echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor-form.php');</script>";
		exit ();
	}

	//$exhi_log = @$_REQUEST['exhi_log'];	
	$exhi = @$_REQUEST['exhi'];
	$exhibitor_id = @$_REQUEST['exhibitor_id'];

    /*echo "<script language='javascript'>window.location=registration_comp.php?exhi=E34XH3IDf6gyy77&assoc_nm=$assoc_nm&exhibitor_id=".$exhibitor_id_ex."';</script>";
    exit;*/
	
	/* echo "<script language='javascript'>window.location=('$EVENT_DB_COMP_LINK?ret2=exbhf&exhi=E34XH3IDf6gyy77&exhibitor_id=$exhibitor_id');</script>";
	exit; */

	//session_destroy ();
?>
<?php require 'includes/reg_form_header.php';?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_3">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> 
						Exhibitors Directory Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="enquiry_info.php" class="form-horizontal" id="enq" name="enq" method="post">
					<input name="vercode" type="hidden" id="vercode" value="<?php echo $_SESSION['vercode_enq'];?>"/>
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="done">
									<a href="#tab1" data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Sponsor/Exhibitor Details  </span>
									</a>
								</li>
								<li class="done">
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Preview Detail </span>
									</a>
								</li>
								<li class="done">
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 3 </span>
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
										<p>    Dear Sponsor/Exhibitor,<br /> <br />
											
											We value your participation in <?php echo $EVENT_NAME . ' ' . $EVENT_YEAR;?><br /><br />
											We thank you for submitting details for Exhibitor Directory. <br/><br />
											Looking forward to see you at the event.<br/><br />
											<?php /*?><a href='<?php echo $EVENT_DB_COMP_LINK;?>exhi=E34XH3IDf6gyy77&assoc_nm=<?php echo $assoc_nm;?>&exhibitor_id=<?php echo $exhibitor_id;?>' target='_blank'>Click Here</a> for Complimentary delegate registrations.<br><br /><?php */?>
											For any queries please contact us on <a href='mailto:<?php echo $EVENT_ENQUIRY_EMAIL;?>'><?php echo $EVENT_ENQUIRY_EMAIL;?></a><br /><br /> <br />
											Thanking You,<br>
											<?php echo $EVENT_SECRT_ADDR;?>
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
		Registration.init('registration_form_3', 2);
	});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
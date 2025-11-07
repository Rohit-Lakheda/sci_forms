<?php 
	session_start();
	require "includes/form_constants_both.php";
	
	if((!isset($_SESSION["vercode_sp"]))||($_SESSION["vercode_sp"]==''))
	{
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired.');</script>";
		echo "<script language='javascript'>window.location=('speaker-profile.php');</script>";
		echo "<script language='javascript'>document.location=('speaker-profile.php');</script>";
		exit;
	}
	
	$nm = @$_REQUEST['nm'];
	
	session_destroy();
?>
<?php require 'includes/reg_form_header.php';?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_2">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Speakers Profile Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="speaker-profile2.php" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" enctype="multipart/form-data" method="post" onsubmit="return validate_reg_registration_form_1();">
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="done">
									<a href="reg_registrations.php" class="step active">
										<span class="number"> 1 </span>
										<span class="desc">
										<i class="fa fa-check"></i> Registration </span>
									</a>
								</li>
								<li class="done">
									<a href="#tab2" data-toggle="tab" class="step">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Confirmation Receipt </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success"> </div>
							</div>
							<div class="tab-content">
								<div class="tab-pane active">
									<div class="note note-success">
                                        <h4 class="block"><strong>Dear <?php echo $nm;?></strong></h4>
                                       <p style="font-size: 18px;">We appreciate for the time spent to complete the process of Speaker information submission.
											We have received your information and shall get back to you if we need any more information.
                                         <br>
                                         <br>
                              			Thanking You,<br/>
                                        	<?php echo $EVENT_NAME . '<br/>' . $EVENT_SECRT_ADDR;?>					                                          </p>
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
			Registration.init('reg_registration_form_1', 1);
		});
</script>
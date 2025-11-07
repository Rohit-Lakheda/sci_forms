<?php 

	session_start();

	if($_SESSION["vercode_visa"]=='') {

		session_destroy();

		echo "<script language='javascript'>alert('Please enter valid verification code.');</script>";

		echo "<script language='javascript'>window.location = 'visa-clearance.php';</script>";

		exit;

	}

    require "form_includes/form_constants_both.php";

	require 'form_includes/reg_form_header.php';

	session_destroy();

?>

<div class="row">

	<div class="col-md-12">

		<div class="portlet light bordered" id="registration_form_3">

			<div class="portlet-title">

				<div class="caption">

					<i class=" icon-layers font-red"></i>

					<span class="caption-subject font-red bold uppercase"><?php echo $EVENT_NAME . ' ' . $EVENT_YEAR;?> : VISA Clearance Registration 

					</span>

				</div>

			</div>

			<div class="portlet-body form">

				<form action="#" class="form-horizontal" name="reg_registration_form_2" id="reg_registration_form_2" method="post">

					<div class="form-wizard">

						<div class="form-body">

							<ul class="nav nav-pills nav-justified steps">

								<li class="done">

									<a href="#tab1" data-toggle="tab" class="step">

									<span class="number"> 1 </span>

									<span class="desc">

									<i class="fa fa-check"></i> Delegate Details </span>

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

										<p>Thank you for submitting your details for Visa Invitation letter to attend  <strong><?php echo $EVENT_NAME . ' ' . $EVENT_YEAR;?></strong>.<br />

										<p>Our Exhibitor will get back to you shortly.</p><br />

										

										  Thanking  You,</p>

										  

						                <p class='style3'  align='left' ><?php echo $EVENT_NAME;?> Secretariat <br /><?php echo $EVENT_SECRT_ADDR;?><br />

										Email:<a href='mailto:<?php echo $ENQUIRY_FROM_EMAIL_USER_MAIL;?>' target='_blank'><?php echo $ENQUIRY_FROM_EMAIL_USER_MAIL;?></a></p>

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

<?php require 'form_includes/reg_form_footer.php';?>

<script>

	jQuery(document).ready(function() {;

		Registration.init('registration_form_3', 1);

	});

</script>

</body>

</html>
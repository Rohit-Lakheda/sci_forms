<?php

session_start();

require "form_includes/form_constants_both.php";



if ((!isset($_SESSION["vercode_enq"])) || ($_SESSION["vercode_enq"] == '')) {

	session_destroy();

	echo "<script language='javascript'>alert('Your session has been expired.');</script>";

	echo "<script language='javascript'>window.location=('enquiry.php');</script>";

	echo "<script language='javascript'>document.location=('enquiry.php');</script>";

	exit;
}



//session_destroy();

?>
<style>
    .row {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .pulse-btn {
        display: inline-block;
        padding: 14px 28px;
        font-size: 1.1rem;
        font-weight: 600;
        color: #302f53;
        background: #ffffff;
        border-radius: 50px;
        text-decoration: none;
        position: relative;
        transition: 0.3s ease;
        box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        animation: breathe 2s infinite ease-in-out;
        overflow: hidden;
        border: 2px solid #302f53;
    }
</style>
<?php require 'form_includes/reg_form_header.php'; ?>

<div class="row">

	<div class="col-md-12">

		<div class="portlet light bordered" id="enq_form_2">

			<div class="portlet-title">

				<div class="caption">

					<i class=" icon-layers font-red"></i>

					<span class="caption-subject font-red bold uppercase"> Enquiry Form

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

											<i class="fa fa-check"></i> Enquiry </span>

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

								<!-- make a download brochure button here with hidden link to the brochure -->
								
								<div class="tab-pane active">

									<div class="note note-success">

										<h4 class="block">Thank you for sending enquiry.</h4>

										<p> Our representative will contact you soon.</p><br />

										<p>Best Regards,<br />

											<?php echo $EVENT_NAME . '<br/>' . $EVENT_SECRT_ADDR; ?>

										</p>

									</div>

									<div class="row">
								
									
									<div class="col-md-4">
										<a href="#" class="pulse-btn" onclick="window.open('<?php echo $EVENT_BROCHURE_LINK; ?>', '_blank'); return false;" download>📥 Download Brochure</a>
									</div>
									
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

<?php require 'form_includes/reg_form_footer.php'; ?>

<script>
	jQuery(document).ready(function() {

		Registration.init('enq_form_2', 1);

	});
</script>

</body>

</html>
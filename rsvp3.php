<?php 
	session_start();
	
    $nm = @$_GET['nm'];
    $name = $nm;
    $emler = @$_POST['enq_emler'];
    if($emler ==""){
        $emler = @$_GET['enq_emler'];
    }

    $rsvp_city = $rsvp_location = @$_GET['city'];
	if($_SESSION["vercode_rsvp"]=='') {
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired!');</script>";
		echo "<script language='javascript'>window.location = 'rsvp.php?city=$rsvp_location';</script>";
		exit;
	}
    if($nm == ""){
        $nm="Sir/Madam";
    }
    require "includes/form_constants_both.php";
	require 'includes/reg_form_header.php';
	session_destroy();
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_3">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"><?php //echo $EVENT_NAME ." ".$EVENT_YEAR;?> <?php echo $RSVP_HEADING;?>
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
										<?php echo $RSVP_RECIPIENTS_USER_MSG;?>
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
	jQuery(document).ready(function() {;
		Registration.init('registration_form_3', 1);
	});
</script>
</body>
</html>
<?php
require "includes/form_constants_both.php";
//require "visitor_pass_captcha_vp.php";
//$temp_assoc_nm_vp = @$_REQUEST['assoc_nm_vp'];

if($_POST) {
	require "dbcon_open.php";
	$tin_no = strip_tags($_POST['tin_no']);
	if(!empty($_POST['email'])) {
		
		$email = strip_tags($_POST['email']);
		for($j = 1; $j <= 7; $j ++) {
			$field = "email" . $j;
			$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE $field = '$email'" ) or die ( mysqli_error ($link) );
			if (mysqli_num_rows ( $qr ) > 0) {
				$qr_gt_user_data_ans_row = mysqli_fetch_array($qr);
				$tin_no = $qr_gt_user_data_ans_row['tin_no'];
			}
		}
	}
	//echo "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no'";
	$qr = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no'" ) or die ( mysqli_error ($link) );
	//echo mysqli_num_rows ( $qr );exit;
	if (mysqli_num_rows ( $qr ) <= 0) {
		$tin_no = '';
	}

	if(!empty($tin_no)) {
		echo "<script language='javascript'>window.location='reg_pay_1.php?id=$tin_no';</script>";
		exit;
	} else {
		echo "<script language='javascript'>alert('Invalid information.');</script>";
		echo "<script language='javascript'>window.location='receipt.php';</script>";
		exit;
	}
	
}
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />'; 
	require 'includes/reg_form_header.php';?>
	<style>
		.selected-flag {
	    	margin-top: -5px;
	    }
	</style>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bordered" id="enq_form_1">
				<div class="portlet-title">
					<div class="caption">
						<i class=" icon-layers font-red"></i>
						<span class="caption-subject font-red bold uppercase"> Generate Registration Receipt
						</span>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="visitor_form1" name="form1" class="form-horizontal" method="post" action="receipt.php">
						<div class="form-wizard">
							<div class="form-body">
								<ul class="nav nav-pills nav-justified steps">
									<li class="active">
										<a class="step">
										<span class="number"> 1 </span>
										<span class="desc">
										<i class="fa fa-check"></i> Details </span>
										</a>
									</li>
									<li>
										<a data-toggle="tab" class="step dips-default-cursor">
										<span class="number"> 2 </span>
										<span class="desc">
										<i class="fa fa-check"></i> Receipt </span>
										</a>
									</li>
								</ul>
								<div id="bar" class="progress progress-striped" role="progressbar">
									<div class="progress-bar progress-bar-success"> </div>
								</div>								
                                <div class="form-group">
                                	<label class="col-md-3 control-label">Registered Email Address <span class="dips-required">  </span></label>
                                    <div class="col-md-5">
                                    	<input class="form-control" name="email" type="email" id="email" maxlength="" />
									</div>
                                </div>
								<center> OR </center>
								<div class="form-group">
									<label class="col-md-3 control-label">TIN No. <span class="dips-required">  </span></label>
									<div class="col-md-5">
										<input class="form-control" name="tin_no" type="text" id="tin_no"/>
									</div>
								</div>
								<?php /*<div class="form-group">
                                	<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
                                	<div class="col-md-6">
                                    	<div class="input-group">
											<input name="vercodevp" class="form-control" id="vercodevp" maxlength="10" required="" autocomplete="off" type="text">
											<input name="test" id="test" value="<?php echo $_SESSION["vercodevp"];?>" type="hidden">
											<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercodevp"];?></span>
										</div>
                               		</div>
                                </div>*/?>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn sbold uppercase green-jungle"> Generate
										<i class="fa fa-angle-right"></i>
										</button>
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
			Registration.init('enq_form_1', 0);

		});
	</script>
	<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
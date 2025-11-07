<?php
	session_start(); 
	$event_name = 'Bangalore IT';
	$en = '';
	if(isset($_GET['en']) && !empty($_GET['en'])) {
		$en = '1';
		$event_name = 'Bangalore INDIA BIO';
	}

	$assoc_name = @$_GET['assoc_name'];
	$assoc_name = trim($assoc_name);

	if((!isset($_SESSION["vercode_reg"]))||($_SESSION["vercode_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		if(!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration-del.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-del.php?en=$en';</script>";
		}
		exit; 
	}
	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	$reg_id = $_SESSION['vercode_reg'];
	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_no = 0;
	$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
	if( ($qr_gt_user_data_ans_no<=0) || ($qr_gt_user_data_ans_no=="") ){
		session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
		if(!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration-del.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-del.php?en=$en';</script>";
		}
		exit; 
	}	
	
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
	$lmt = $qr_gt_user_data_ans_row['sub_delegates'];

	$a = '';
	if(!empty($qr_gt_user_data_ans_row['user_type']) && !empty($qr_gt_user_data_ans_row['assoc_srno'])) {
		$assoc_name = $qr_gt_user_data_ans_row['user_type'];
		$assoc_srno = $qr_gt_user_data_ans_row['assoc_srno'];
		$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_PROMO_CODE_TBL . " WHERE srno='$assoc_srno' AND assoc_name='$assoc_name'");
			
		if(mysqli_num_rows($qry)) {
			$result = mysqli_fetch_assoc($qry);
			$a = $result['promo_code'];
		}
	}
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />'; 
	require 'includes/reg_form_header.php';?>
<style>
	.selected-flag {
	margin-top: -8px;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_3">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Delegate Registration Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="registration-del6.php?assoc_name=<?php echo $qr_gt_user_data_ans_row['assoc_name'];?><?php echo !empty($ret) ? '&ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_3" id="reg_registration_form_3" method="post" onsubmit="return validate_registration_form_3();">
					<input name="en" type="hidden" id="en" value="<?php echo $en;?>"/>
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="done">
									<a class="step dips-default-cursor">
									<span class="number"> 1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Registration Category </span>
									</a>
								</li>
								<li class="done">
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Organisation Information </span>
									</a>
								</li>
								<li class="active">
									<a data-toggle="tab" class="step">
									<span class="number"> 3 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Delegate Information </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 4 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Confirm </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 5 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Receipt </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success"> </div>
							</div>
							<div class="tab-content">
								<div class="tab-pane active">
									<h3 class="block">Provide Delegate Information</h3>
									<?php for($i=1;$i<=$lmt;$i++){ ?>
									<h4 class="form-section">Enter Information of 
									<?php if($i == 1) {	
											echo 'Premium';
											$cata = 'Premium Delegate';
											}if($i == 2) {	
											echo 'Standard';
											$cata = 'Standard Delegate';
											}?> Delegate 
										<?php if($lmt > 1) {	
											//echo $i;	
											}?>
									</h4>
									<div class="form-group">
										<label class="control-label col-md-3">Name <span class="dips-required"> * </span></label>
										<div class="col-md-2">
											<select class="form-control" name="title<?php echo $i; ?>" id="title<?php echo $i; ?>" required="required">
												<option value="">-Title-</option>
												<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
													foreach ($titleList as $title) {
														$selected = '';
														if($qr_gt_user_data_ans_row['title'.$i] == $title || $_SESSION['title'.$i] == $title){
															$selected = 'selected="selected"';
														}
														echo '<option value="' . $title . '" ' . $selected . '>' . $title . '</option>';
													}
													?>
											</select>
										</div>
										<div class="col-md-2"><input type="text" class="form-control" placeholder="First Name" name="fname<?php echo $i; ?>" type="text" id="fname<?php echo $i; ?>" maxlength="100" value="<?php if(isset($_SESSION['fname'.$i])) { echo $_SESSION['fname'.$i]; }else{echo @$qr_gt_user_data_ans_row['fname'.$i]; } ?>" required="required"></div>
										<div class="col-md-2"><input type="text" class="form-control" placeholder="Last Name" name="lname<?php echo $i; ?>" type="text" id="lname<?php echo $i; ?>" maxlength="100" value="<?php if(isset($_SESSION['lname'.$i])) { echo $_SESSION['lname'.$i]; }else{ echo @$qr_gt_user_data_ans_row['lname'.$i]; } ?>" required="required"></div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Job Title <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input class="form-control" name="job_title<?php echo $i; ?>" type="text" id="job_title<?php echo $i; ?>" maxlength="100" value="<?php if(isset($_SESSION['job_title'.$i])) { echo $_SESSION['job_title'.$i]; }else{ echo @$qr_gt_user_data_ans_row['job_title'.$i]; } ?>" required="required"/>
										</div>
									</div>
									<?php /*?><div class="form-group hide">
										<label class="col-md-3 control-label">Name on Badge <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input class="form-control" name="badge<?php echo $i; ?>" type="text" id="badge<?php echo $i; ?>" maxlength="150" value="<?php if(isset($_SESSION['badge'.$i])) { echo $_SESSION['badge'.$i]; }else{ echo @$qr_gt_user_data_ans_row['badge'.$i]; } ?>" required onkeyup="check_char(event,'badge<?php echo $i; ?>')"/>
										</div>
									</div><?php */?>
									<div class="form-group">
										<label class="col-md-3 control-label">Email Address <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<input class="form-control" name="email_m<?php echo $i; ?>" type="email" id="email_m<?php echo $i; ?>" maxlength="150" value="<?php if(isset($_SESSION['email'.$i])) { echo $_SESSION['email'.$i]; }else{ echo @$qr_gt_user_data_ans_row['email'.$i]; } ?>" required />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mobile Number <span class="dips-required"> * </span></label>
										<div class="col-md-6" style="margin-top: -18px;">
											<span type="tel" id="mobile-country-code<?php echo $i; ?>" data-fax-iso-code-hidden-field-name="cellnoCountryCode<?php echo $i; ?>"></span>
											<?php 
												$mobile = array();
												if(isset($qr_gt_user_data_ans_row['cellno'.$i]))
													$mobile = explode("-",$qr_gt_user_data_ans_row['cellno'.$i]);
												?>
											<input type="hidden" name="cellnoCountryCode<?php echo $i; ?>" id="cellnoCountryCode<?php echo $i; ?>" value="<?php echo !empty($mobile[1]) ? str_replace('+', '', @$mobile[0]) : '';?>"/>
											<input type="hidden" id="cellnoCountryCode<?php echo $i; ?>Iso" />
											<input class="form-control" name="cellno<?php echo $i; ?>" type="text" id="cellno<?php echo $i; ?>" maxlength="10"  value="<?php echo !empty($mobile[1]) ? @$mobile[1] : '';?>" required onkeyup="check_num(event, 'cellno<?php echo $i; ?>');"  style="padding-left: 92px;"/>
											<span class="help-block">+Country Code-Mobile Number(xxx-xxxxxxxxxx)</span>
										</div>
									</div>
									<?php //$cata=explode(",",$qr_gt_user_data_ans_row['cata']); ?>
									<input name="catagory<?php echo $i; ?>" type="hidden" id="catagory<?php echo $i; ?>" value="<?php echo $cata;?>"  />
									<?php }?>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<a href="registration-del3.php?ret=retds4fu324rn_ed24d3it" class="btn default">
									<i class="fa fa-angle-left"></i> Back </a>
									<button type="submit" class="btn sbold uppercase green-jungle"> Continue
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
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script type="text/javascript">var assoc_name = '<?php echo $qr_gt_user_data_ans_row['assoc_name'];?>';

	var en='<?php echo $en;?>';
	var a = '<?php echo $a;?>';
</script>        
<script src="js/registration3.js"></script>
<?php echo "<script language='javascript'>var total_delegates=$lmt;</script>"; ?>
<script>
	jQuery(document).ready(function() {  
		Registration.init('registration_form_3', 2);
		<?php for($i=1;$i<=$lmt;$i++){ ?>
			$("#mobile-country-code<?php echo $i; ?>").intlTelInput();
		<?php }?>
	});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
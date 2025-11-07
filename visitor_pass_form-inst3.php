<?php 
/*ini_set("display_errors", "1");
	error_reporting(E_ALL);
*/
	session_start();  
	$temp_assoc_nm_vp = @$_REQUEST['assoc_nm_vp'];
	if(($_SESSION["vercodevp"]=='')) {  
	   	session_destroy();
		echo "<script language='javascript'>alert('Error in process; Try again');</script>";
		echo "<script language='javascript'>window.location = 'visitor_pass_form-inst1.php?assoc_nm_vp=$temp_assoc_nm_vp';</script>";
		exit; 
	}
	
	require "includes/form_constants_both.php";
	require "dbcon_open.php";
	
	$id = $_SESSION["vercodevp"];

	$qr_vp_d_id = mysqli_query($link,"SELECT * FROM $VSTR_TBL_NAME WHERE reg_id = '$id'")or die(mysqli_error($link));
	$res_vp_d = mysqli_fetch_array($qr_vp_d_id);
	$res = $res_vp_d;

	require "visitor_pass_emailer_user.php";
	session_destroy();
?> 
<?php require 'includes/reg_form_header.php';?>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bordered" id="enq_form_2">
				<div class="portlet-title">
					<div class="caption">
						<i class=" icon-layers font-red"></i>
						<span class="caption-subject font-red bold uppercase"> FREE Business Exhibition Visitor Registration Form for Institutions / Students <br/><br/> <span style="color: #1324F3;"> &nbsp; EXHIBITION Visiting Hours for Institutions / Students : (All 3-Days, 16-18,Nov 2022) between 02 PM to 06 PM Only </span>
						</span>
					</div>
				</div>
				<div class="portlet-body form">
					<form action="" class="form-horizontal" id="enq" name="enq" method="post">
						<input name="vercode" type="hidden" id="vercode" value="<?php echo $_SESSION['vercode_enq'];?>"/>
						<div class="form-wizard">
							<div class="form-body">
								<ul class="nav nav-pills nav-justified steps">
									<li class="done">
										<a class="step">
										<span class="number"> 1 </span>
										<span class="desc">
										<i class="fa fa-check"></i> Visitor's Details </span>
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
											<?php if(@$temp_nm=="DRF456DFF7G") { ?>
												<h4 class="block">Thank you for submitting your details.</h4>
											<?php } ?>
											<p>  Thank you for submitting your details. </p>
											<p>Exhibition visiting details are as follows, </p><br/>											
											<p><strong>Visitor Name: <?php echo $res_vp_d['title']." ".$res_vp_d['fname']." ".$res_vp_d['lname']; ?> </strong></p>
											<p><strong>Pass No: </strong><strong><?php echo $res_vp_d['pass_no']; ?></strong></p><br/>
											<p><strong>Visiting Hours: </strong></p><br/>
											<p><strong>Day 1: </strong><strong>Wednesday, 16 NOVEMBER,2022 - 02:00 PM - 06:00PM</strong></p><br/>
											<p><strong>Day 2: </strong><strong>Thursday, 17 NOVEMBER,2022 - 02:00 PM - 06:00PM</strong></p><br/>
											<p><strong>Day 3: </strong><strong>Friday, 18 NOVEMBER,2022 - 02:00 PM - 04:00PM</strong></p><br/>
											<strong><a href="visitor_pass_form-inst4.php?pn=<?php echo $res_vp_d['pass_no'];?>&assoc_nm_vp=<?php echo $temp_assoc_nm_vp;?>" target="_blank" id="text" style="text-decoration:underline; color:#0033FF;">Click here</a> to generate your Visitor Pass. </strong><br/>
											<br/>
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
	<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
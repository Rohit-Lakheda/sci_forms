<?php

	session_start ();
	if (($_SESSION ["vercode_ex"] == '')) {
		session_destroy ();
		mysqli_close($link);

		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php');</script>";
		exit ();
	}
	require "includes/form_constants_both.php";
	require "dbcon_open.php";
	
	$temp_reg_id = @$_SESSION ['vercode_ex'];
	
	$qr_chk_exb_id = mysqli_query ($link, "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_2 WHERE (reg_id='$temp_reg_id') " );
	$qr_chk_exb_num_rows = mysqli_num_rows ( $qr_chk_exb_id );
	$qr_chk_exb_ans = mysqli_fetch_array ( $qr_chk_exb_id );
	
	if (($qr_chk_exb_num_rows <= 0) || ($qr_chk_exb_num_rows == "")) {
		session_destroy ();
		mysqli_close($link);

		echo "<script language='javascript'>alert('Please Enter Complete exhibitors Details.');</script>";
		echo "<script language='javascript'>window.location = ('exhibitor.php?rt=retds4fn324rn_ed24d3it');</script>";
		exit ();
	}
	
	$exhibitor_id_ex = $qr_chk_exb_ans ['exhibitor_id'];
	$temp_booth_no = $qr_chk_exb_ans ['booth_no'];
	$temp_booth_area = $qr_chk_exb_ans ['booth_area'];
	$assoc_nm="";
	/*if (($assoc_nm == "STPI") || ($assoc_nm == "KBITS")) {
		$temp_booth_area = 6;
	}*/
	$booth_space = $qr_chk_exb_ans ['booth_space'];
	$temp_booth_area_unit = $qr_chk_exb_ans ['booth_area_unit'];
	$temp_fascia_name = $qr_chk_exb_ans ['fascia_name'];
	$temp_fascia_name_up = strtoupper ( $temp_fascia_name );
	
	$temp_exhi_name = $qr_chk_exb_ans ['exhibitor_name'];
	$temp_exhi_name_up = strtoupper ( $temp_exhi_name );
	$temp_exhi_name_upwc = ucwords ( $temp_exhi_name );
	$temp_cp_title = $qr_chk_exb_ans ['cp_title'];
	$temp_cp_fname = $qr_chk_exb_ans ['cp_fname'];
	$temp_cp_mname = $qr_chk_exb_ans ['cp_mname'];
	$temp_cp_lname = $qr_chk_exb_ans ['cp_lname'];
	$temp_desig = $qr_chk_exb_ans ['cp_desig'];
	$temp_addr1 = $qr_chk_exb_ans ['address_line_1'];
	$temp_addr2 = $qr_chk_exb_ans ['address_line_2'];
	$temp_city = $qr_chk_exb_ans ['city'];
	$temp_state = $qr_chk_exb_ans ['state'];
	$temp_country = $qr_chk_exb_ans ['country'];
	$temp_zip = $qr_chk_exb_ans ['zip'];
	$temp_fon_cntry = $qr_chk_exb_ans ['cntry_code_phone'];
	// $temp_fon_area = $qr_chk_exb_ans['area_code_phone'];
	$temp_fon = $qr_chk_exb_ans ['phone'];
	$temp_mob_cntry = $qr_chk_exb_ans ['cntry_code_mob'];
	$temp_mob = $qr_chk_exb_ans ['mob'];
	$temp_fax_cntry = $qr_chk_exb_ans ['cntry_code_fax'];
	// $temp_fax_area = $qr_chk_exb_ans['area_code_fax'];
	$temp_fax = $qr_chk_exb_ans ['fax'];
	$temp_email = $qr_chk_exb_ans ['email'];
	$temp_website = $qr_chk_exb_ans ['website'];
	$temp_reg_date = $qr_chk_exb_ans ['reg_date'];
	$temp_reg_time = $qr_chk_exb_ans ['reg_time'];
	$temp_reg_id = $qr_chk_exb_ans ['reg_id'];
	$temp_profile = $qr_chk_exb_ans ['profile'];
	
	$sql = "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_DEMO_PHASE_2 WHERE exhibitor_id='" . $qr_chk_exb_ans['exhibitor_id'] . "'";
	$user_data = mysqli_query($link,$sql);
	
	$reg_id = $qr_chk_exb_ans['srno'] . '_' . $temp_reg_id;
	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
	$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
	

?>
<?php require 'includes/reg_form_header.php';?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_2">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase">
						Exhibitor Personnel/Delegate Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="exhibitor5.php?assoc_nm=<?php echo $assoc_nm;?>" class="form-horizontal" name="reg_registration_form_2" id="reg_registration_form_2" method="post" onsubmit="return validate_registration_form_4();">
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="done">
									<a href="#tab1" data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Sponsor/Exhibitor Details </span>
									</a>
								</li>
								<li class="done">
									<a href="#tab1" data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Exhibitor Personnel/Delegate Details </span>
									</a>
								</li>
								<li class="active">
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 3 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Preview Detail </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 4 </span>
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
									<h3 class="block">Confirm Exhibitors/Sponsor Directory Detail</h3>
									<div class="row">
				                        <div class="col-md-12">
				                            <!-- BEGIN Registration Category TABLE PORTLET-->
				                            <div class="portlet light bordered">
				                                <div class="portlet-title">
				                                    <div class="caption">
				                                    	<i class="fa fa-info-circle font-dark"></i>
				                                        <span class="caption-subject">Exhibitors Detail</span>
				                                    </div>
				                                </div>
				                                <div class="portlet-body">
				                                    <div class="table-scrollable">
													<?php if(!empty($qr_chk_exb_ans ['assoc_nm']) && $qr_chk_exb_ans ['assoc_nm'] == $ASSOC_NAME_EXHIBITOR) { ?>
															<h3><strong>Startup Innovation Zone</strong></h3><br/>
													<?php }?>
				                                    	<table class="table table-striped table-bordered table-hover">
				                                            <tbody>
																<?php if(!empty($qr_chk_exb_ans ['assoc_nm']) && $qr_chk_exb_ans ['assoc_nm'] == $ASSOC_NAME_EXHIBITOR) { ?>
																	<tr>
																		<td> <strong>Association Name</strong> </td>
																		<td> <?php echo $qr_chk_exb_ans ['assoc_nm']; ?> </td>
																	</tr>
																	<tr>
																		<td> <strong>Sector</strong> </td>
																		<td> <?php echo $qr_chk_exb_ans ['exhi_profile']; ?> </td>
																	</tr>
																<?php }?>
																<?php if(!empty($qr_chk_exb_ans ['assoc_nm']) && $qr_chk_exb_ans ['assoc_nm'] != $ASSOC_NAME_EXHIBITOR) { ?>
																	<tr>
																		<td> <strong>Association Name</strong> </td>
																		<td> <?php echo $qr_chk_exb_ans ['assoc_nm']; ?> </td>
																	</tr>
																<?php }?>
				                                                <tr>
				                                                    <td> <strong>Name of Exhibitor  (Organisation Name)</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans ['exhibitor_name']; ?> </td>
				                                                </tr>
				                                             	<tr>
				                                                    <td> <strong>Category</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans ['category']; ?> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>Booth Space</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['booth_space']; ?> </td>
				                                                </tr>
																<?php 
																if($qr_chk_exb_ans['booth_area'] == "Startup Booth"){ ?>
																	<tr>
				                                                    <td> <strong>Booth Type</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['booth_area']; ?> </td>
				                                                </tr>
<?php 
																} else { ?>
 <tr>
				                                                    <td> <strong>Area in sqm</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['booth_area'] . ' ' . $qr_chk_exb_ans['booth_area_unit']; ?> </td>
				                                                </tr>
															<?php 	}
																?>
				                                               
				                                                <?php /*<tr>
				                                                    <td> <strong>Name for Fascia  (written on Stall)</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['fascia_name']; ?> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>Name</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['cp_title'] . ' ' . $qr_chk_exb_ans ['cp_fname'] . ' ' . $qr_chk_exb_ans ['cp_lname']; ?> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>Designation </strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['cp_desig']; ?> </td>
				                                                </tr>*/?>
				                                                <tr>
				                                                    <td> <strong>Address 1</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['address_line_1']; ?> </td>
				                                                </tr>
				                                                <?php /*<tr>
				                                                    <td> <strong>Address 2</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['address_line_2']; ?> </td>
				                                                </tr>*/?>
				                                                <tr>
				                                                    <td> <strong>City </strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['city']; ?> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>State</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['state']; ?> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>Country</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['country']; ?> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>Postal Code</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['zip']; ?> </td>
				                                                </tr>
				                                                <?php /*<tr>
				                                                    <td> <strong>Email Address</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['email']; ?> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>Mobile Number</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['cntry_code_mob'] . '-' . $qr_chk_exb_ans['mob']; ?> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>Fax Number</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['cntry_code_fax'] . '-' . $qr_chk_exb_ans['fax']; ?> </td>
				                                                </tr>*/?>
				                                                <tr>
				                                                    <td> <strong>Telephone Number</strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['cntry_code_phone'] . '-' . $qr_chk_exb_ans['phone']; ?> </td>
				                                                </tr>
				                                                <?php /*<tr>
				                                                    <td> <strong>Website </strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['website']; ?> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>Exhibitor Sector </strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['exhi_profile']; ?> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>Organisation Logo </strong> </td>
				                                                    <td> <a href="<?php echo $qr_chk_exb_ans['logo']; ?>" target="_blank">View Logo <i class="fa fa-eye"></i></a> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>Keywords </strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['keywords']; ?> </td>
				                                                </tr>
				                                                <tr>
				                                                    <td> <strong>Organisation Profile </strong> </td>
				                                                    <td> <?php echo $qr_chk_exb_ans['profile']; ?> </td>
				                                                </tr>*/?>
				                                            </tbody>
				                                        </table>
				                                    </div>
				                                </div>
				                            </div>
				                            <!-- END Registration Category TABLE PORTLET-->
										</div>
                    				</div>
										<div class="row">
					                        <div class="col-md-12">
					                            <!-- BEGIN Registration Category TABLE PORTLET-->
					                            <div class="portlet light bordered">
					                                <div class="portlet-title">
					                                    <div class="caption">
					                                    	<i class="fa fa-info-circle font-dark"></i>
					                                        <span class="caption-subject">Exhibitor Information (Stall Manning)</span>
					                                    </div>
					                                </div>
					                                <div class="portlet-body">
														<div class="flip-scroll">
															<table class="table table-bordered table-striped flip-content table-hover">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>Name</th>
																		<th>Designation</th>
																		<th>Mobile No.</th>
																		<th>Email Address</th>
																		<?php /*<th>Category</th>*/?>
																	</tr>
																</thead>
																<tbody>
																	<?php if(mysqli_num_rows($user_data) > 0) { 
																		$i = 0;
																		while ($row = mysqli_fetch_assoc($user_data)) {
																			$i++;
																	?>
																	
																		<tr>
																			<td>
																				 <?php echo $i; ?>
																			</td>
																			<td>
																				 <?php echo $row['title']." ".$row['fname']." ".$row['lname']; ?>
																			</td>
																			<td>
																				 <?php echo $row['desig']; ?>
																			</td>
																			<td>
																				 <?php echo $row['mob']; ?>
																			</td>
																			<td>
																				 <?php echo $row['email']; ?>
																			</td>
																			<?php /*<td>
																				 <?php echo $row['category']; ?>
																			</td>*/?>
																		</tr>
																	<?php }}?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
					                        <div class="col-md-12">
					                            <!-- BEGIN Registration Category TABLE PORTLET-->
					                            <div class="portlet light bordered">
					                                <div class="portlet-title">
					                                    <div class="caption">
					                                    	<i class="fa fa-info-circle font-dark"></i>
					                                        <span class="caption-subject">Delegate Information</span>
					                                    </div>
					                                </div>
					                                <div class="portlet-body">
														<div class="flip-scroll">
															<table class="table table-bordered table-striped flip-content table-hover">
																<thead>
																	<tr>
																		<th>
																			 #
																		</th>
																		<th>
																			 Name
																		</th>
																		<th>
																			 Job Title
																		</th>
																		<th>
																			 Name on Badge
																		</th>
																		<th>
																			 Email Address
																		</th>
																		<th>
																			 Mobile Number
																		</th>
																		<th>
																			 Category 
																		</th>
																	</tr>
																</thead>
																<tbody>
																	<?php for($i=1; $i<=$qr_gt_user_data_ans_row['sub_delegates']; $i++) { 
																	if(!empty($qr_gt_user_data_ans_row['email'.$i])) {?>
																		<tr>
																			<td>
																				 <?php echo $i; ?>
																			</td>
																			<td>
																				 <?php echo $qr_gt_user_data_ans_row['title'.$i]." ".$qr_gt_user_data_ans_row['fname'.$i]." ".$qr_gt_user_data_ans_row['lname'.$i]; ?>
																			</td>
																			<td>
																				 <?php echo $qr_gt_user_data_ans_row['job_title'.$i]; ?>
																			</td>
																			<td>
																				 <?php echo $qr_gt_user_data_ans_row['badge'.$i]; ?>
																			</td>
																			<td>
																				 <?php echo $qr_gt_user_data_ans_row['email'.$i]; ?>
																			</td>
																			<td>
																				 <?php echo $qr_gt_user_data_ans_row['cellno'.$i]; ?>
																			</td>
																			<td>
																				 <?php echo $qr_gt_user_data_ans_row['cata'.$i]; ?>
																			</td>
																		</tr>
																	<?php }}?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="well well-lg">
													<div class="md-checkbox-inline">
		                                                <div class="md-checkbox">
		                                                    <input type="checkbox" id="agree" class="md-check">
		                                                    <label for="agree">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> I have read and hereby accept that all the data entered in the registration form is correct. Details once confirmed cannot be modified.
		                                                	</label>
		                                                </div>
		                                            </div>
												</div>
											</div>
											<!--/span-->
										</div>
									</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<a href="javascript:;" class="btn default" onclick="go_back();">
									<i class="fa fa-angle-left"></i> Back To Step 1</a>
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
<?php require 'includes/reg_form_footer.php';mysqli_close($link);
?>
<script>
	jQuery(document).ready(function() {  
		Registration.init('registration_form_2', 2);
	});
	
	function go_back(){
		window.location=('exhibitor.php?rt=retds4fn324rn_ed24d3it');
	 }

	 function validate_registration_form_4() {
		if((document.getElementById("agree").checked == false)) {
			alert('Please accept terms and conditions');
			document.getElementById("agree").focus();
	        return false;
		}
	}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
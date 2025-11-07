<?php
//echo "<script language='javascript'>window.location.href='https://www.bengalurutechsummit.com/web/it_forms/enquiry.php';</script>";
//exit;
	require ("includes/form_constants_both.php");

	$ret = @$_GET ['ret'];
	$temp_exhb_stat = @$_REQUEST ['ret2'];
	
	$temp_ticket_type = @$_GET ['tkt_type'];
	
	$cata_type = @$_REQUEST ["cata_type"];
	$assoc_nm = @$_REQUEST ["assoc_nm"];
	
	if ($ret == "retds4fu324rn_ed24d3it") {
		session_start ();
		if ((!isset ( $_SESSION ["vercode_reg"] )) || ($_SESSION ["vercode_reg"] == '')) {
			session_destroy ();
			echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
			echo "<script language='javascript'>window.location=('registration_comp.php');</script>";
			echo "<script language='javascript'>document.location=('registration_comp.php');</script>";
			exit ();
		}
		require "dbcon_open.php";
		$reg_id = $_SESSION ['vercode_reg'];
		$text = $reg_id;
		/*echo "SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'<br>";
		 exit; */
		$qr_gt_user_data_id = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'" );
		$qr_gt_user_data_ans_no = 0;
		$qr_gt_user_data_ans_no = mysqli_num_rows ( $qr_gt_user_data_id );
		if (($qr_gt_user_data_ans_no <= 0) || ($qr_gt_user_data_ans_no == "")) {
			session_destroy ();
			echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
			echo "<script language='javascript'>window.location=('registration_comp.php');</script>";
			echo "<script language='javascript'>document.location=('registration_comp.php');</script>";
			exit ();
		}
		
		$qr_gt_user_data_id = mysqli_query ($link, "SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'" );
		$qr_gt_user_data_ans_row = mysqli_fetch_array ( $qr_gt_user_data_id );
	} else {
		// echo "SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'11<br>";
		include ('captcha_reg.php');
	}
	
	$exhi = @$_REQUEST ['exhi'];
	$exhibitor_id = "";
	$qr_chk_exbhi_ans_rows = "";
	
	if ($exhi == "E34XH3IDf6gyy77") {
		$exhibitor_id = $_REQUEST ['exhibitor_id'];
		
		$qr_chk_exbhi = "Select * from " . $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS . " where exhibitor_id = '$exhibitor_id' ";
		$qr_chk_exbhi_id = mysqli_query ($link, $qr_chk_exbhi );
		$qr_chk_exbhi_num_rows = "";
		$qr_chk_exbhi_num_rows = mysqli_num_rows ( $qr_chk_exbhi_id );
		
		$qr_chk_exbhi_id = mysqli_query ($link, $qr_chk_exbhi );
		$qr_chk_exbhi_ans_rows = mysqli_num_rows ( $qr_chk_exbhi_id );
		
		if (($qr_chk_exbhi_num_rows == 0) || ($qr_chk_exbhi_ans_rows ['exhibitor_id'] == $exhibitor_id)) {
			session_destroy ();
			echo "<script language='javascript'>alert('Please get register as a exhibitor on online exhibitor form.');</script>";
			echo "<script language='javascript'>window.location = '" . $EVENT_DB_EXHI_DIR_REG_LINK . "';</script>";
			exit ();
		}
	}
?>
<?php require 'includes/reg_form_header.php';?>
	<style>
		optgroup {
			font-weight: bold;
		}
	</style>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bordered" id="registration_form_1">
				<div class="portlet-title">
					<div class="caption">
						<i class=" icon-layers font-red"></i>
						<span class="caption-subject font-red bold uppercase"> Complimentary Delegate Registration Form
                        
                        <?php 
					
					$cata_type_disp ="";
					
					if($cata_type != ""){ 
					
					
						if($cata_type == "QM3D14X"){
							
							$cata_type_disp = " : Global Innovation Alliance (GIA) Partner ";	
						
						}
						else if($cata_type == "SC0MZP2"){
							
							$cata_type_disp = " : Trade Commissions ";	
							
						}
						else{
							
							//$cata_type_disp = "For ".$cata_type;	
							$cata_type_disp = "";
							
						}
					
						echo " $cata_type_disp"; 
					}
					
					?>
                        
						</span>
					</div>
				</div>
				<div class="portlet-body form">
					<?php if(date('Y-m-d H:i') <= '2019-11-27 19:00') {?>
					<?php //if($cata_type == 'QM3D14X' || $cata_type == 'SC0MZP2') {?>
					<form action="registration_comp2.php?ret=<?php echo $ret; ?>&exhi=<?php echo $exhi;?>&exhibitor_id=<?php echo $exhibitor_id;?>&assoc_nm=<?php echo $assoc_nm;?>&cata_type=<?php echo $cata_type;?>" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post" onsubmit="return validate_registration_form_2();">
						<input type="hidden" name="ticket_type" id="ticket_type" value="<?php echo $temp_ticket_type;?>" />
						<input type="hidden" name="paymode" id="Cc" value="Complimentary" />
						<input type="hidden" id="event_know" name="event_know" value="MMA Email Invitation" />
                        <div class="form-wizard">
							<div class="form-body">
								<ul class="nav nav-pills nav-justified steps">
									<li class="active">
										<a href="#tab1" data-toggle="tab" class="step">
											<span class="number"> 1 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Registration Category </span>
										</a>
									</li>
									<li>
										<a data-toggle="tab" class="step dips-default-cursor">
											<span class="number"> 2 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Organisation Information </span>
										</a>
									</li>
									<li>
										<a data-toggle="tab" class="step dips-default-cursor">
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
								 <?php if($exhi== "E34XH3IDf6gyy77"){ ?>
								<div class="tab-content">
									<div class="tab-pane active">
										<div class="note note-success">
										 <p> 
										 Dear Exhibitor,<br/>
											We appreciate your interest in <?php echo $EVENT_NAME." ".$EVENT_YEAR;?>. We confirm that we have received your details of Exhibitor Directory,
											Request you to kindly fill the details of Complimentary Delegate Registration. <br/><br/>  
										 </p>
										</div>
									</div>
								</div>
								  <?php }?>
								<div class="tab-content">
									<div class="tab-pane active">
										<h3 class="block">Provide required information for registration:</h3>
										<div class="form-group">
											<label class="control-label col-md-3"> Select Sector <span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<select id="sector" name="sector" class="form-control" required="required" >
													<option value="">-- Select Sector --</option>
													<?php $countryList = array('Information Technology'=>'Information Technology', 'Bio Technology'=>'Bio Technology');
															foreach ($countryList as $key=>$value) {
																echo '<option value="' . $key . '">' . $value . '</option>'; 
															}
														?>
												</select>
											</div>
										</div>
										<?php if($cata_type == 'QM3D14X') {?>
											<div class="form-group">
												<label class="control-label col-md-3"> Number of Delegate(s) <span class="required"> * </span></label>
												<div class="col-md-6">
													<select class="form-control" name="total_dele" id="total_dele" required>
														<option value="">-- Select Number of Delegate --</option>
														<?php for($index = 1; $index <= 7; $index++) {
																echo '<option value="' . $index . '">' . $index . '</option>';
															}
															?>
													</select>
												</div>
											</div>
											<?php /*<div class="form-group form-md-radios">
												<label class="control-label col-md-3"> Single/ Group Delegate(s)<span class="required"> * </span> </label>
												<div class="col-md-9">
													 <div class="md-radio-inline">
														<div class="md-radio">
															<input type="radio" id="Single" name="grp" class="md-radiobtn" value="Single" onclick="show_div_group_user();" checked="checked" required="required">
															<label for="Single">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> Single Delegate </label>
														</div>
														<div class="md-radio">
															<input type="radio" id="Group" name="grp" class="md-radiobtn" value="Group" onclick="show_div_group_user();" required="required">
															<label for="Group">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> Group Delegates </label>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group" id="div_group_user">
												<label class="col-md-3 control-label">Number of Delegates <span class="required"> * </span></label>
												<div class="col-md-5">
													<input type="text" class="form-control" name="total_dele" type="text" id="total_dele" maxlength="1" onkeyup="check_dele(event, 'total_dele');" />
													<span class="help-block"> Min. 2 and max. 7 delegates are allowed. </span>
													<div class="alert alert-danger" id="del-error" style="display: none;">
														<strong>Error!</strong> Please enter number between 2 to 7 only.
													</div>

												</div>
											</div>*/?>
										<?php } else if($cata_type == 'AS5OC') {?>
											<div class="form-group">
												<label class="control-label col-md-3"> Number of Delegate(s) <span class="required"> * </span></label>
												<div class="col-md-6">
													<select class="form-control" name="total_dele" id="total_dele" required>
														<option value="">-- Select Number of Delegate --</option>
														<?php for($index = 1; $index <= 4; $index++) {
																echo '<option value="' . $index . '">' . $index . '</option>';
															}
															?>
													</select>
												</div>
											</div>
										<?php } else {?>
											<input type="hidden" id="Single" name="grp" value="Single" />
										<?php }?>
										<div class="form-group form-md-radios <?php if($cata_type == 'QM3D14X') {?>hide<?php }?>">
											<label class="control-label col-md-3">Organization Type <span class="required"> * </span> </label>
											<div class="col-md-9">
												<div class="md-radio-inline">
													<div class="md-radio">
														<input type="radio" id="Indian" name="curr" class="md-radiobtn" value="Indian" onclick="show_cata();" <?php if($cata_type != 'QM3D14X') {?>checked="checked"<?php }?> required="required">
														<label for="Indian">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Indian 
														</label>
													</div>
													<div class="md-radio <?php if($cata_type == 'AS5OC') {?>hide<?php }?>">
														<input type="radio" id="Foreign" name="curr" class="md-radiobtn" value="Foreign" onclick="show_cata();" required="required" <?php if($cata_type == 'QM3D14X') {?>checked="checked"<?php }?>>
														<label for="Foreign">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> International 
														</label>
													</div>
												</div>
											</div>
										</div>
										<?php if($cata_type == 'QM3D14X') {?>
											<div class="group form-group">
											<label class="control-label col-md-3"><strong>Category:</strong> </label>
												<div class="col-md-9" style="margin-top: 8px;">
													<input name="cata" type="radio" class="hide" value="Complimentary GIA Partner Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
													<strong>Complimentary GIA Partner Delegate</strong>
												</div>
											</div>													
										<?php } else if($cata_type == 'SC0MZP2') {?>
											<div class="group form-group">
											<label class="control-label col-md-3"><strong>Category:</strong> </label>
												<div class="col-md-9" style="margin-top: 8px;">
													<input name="cata" type="radio" class="hide" value="Complimentary Trade Commissions Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
													<strong>Complimentary Trade Commissions Delegate</strong>
												</div>
											</div>
										<?php } else if($cata_type == 'AS5OC') {?>
											<div class="form-group">
												<label class="control-label col-md-3"><strong>Select Association <span class="required"> * </span></strong></label>
												<div class="col-md-6">
													<select id="assoc_name" name="assoc_name" class="form-control" required="required">
														<option value="">-- Select Association --</option>
														<?php $countryList = array('Nasscom','ABLE','ABAI','COAI','CLIK','RCI ','TiE','IACC','IESA','MOBILE10X','Drone Federation of India');
																foreach ($countryList as $value) {
																	echo '<option value="' . $value . '" class="assoc-ite">' . $value . '</option>'; 
																}
															?>			
													</select>
												</div>
											</div>
											<div class="group form-group">
											<label class="control-label col-md-3"><strong>Category:</strong> </label>
												<div class="col-md-9" style="margin-top: 8px;">
													<input name="cata" type="radio" class="hide" value="Complimentary Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
													<strong>Complimentary Delegate</strong>
												</div>
											</div>
										<?php } else {?>	
										<div class="form-group form-md-radios">
											<label class="control-label col-md-3">Category </label>
											<div class="col-md-9" style="margin-top: 8px;">
												<div class="md-radio-inline">
													<div class="md-radio">
														 <?php if(($assoc_nm != "") && ($exhi == "") ){  ?>
													   <input name="cata" type="radio" class="md-radiobtn" value="Complimentary Media Delegate" id="cata1" onClick="show_div_user_grp_type()" disabled="disabled"   />
														<?php   } else if(($exhi != "") && ($assoc_nm == "")){  ?>
													   <input name="cata" type="radio" class="md-radiobtn" value="Complimentary Media Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
													   <?php    } else if(($exhi != "") && ($assoc_nm != "")){ ?>
														 <input name="cata" type="radio" class="md-radiobtn" value="Complimentary Media Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
														<?php   } else{ ?>
														<input name="cata" type="radio" class="md-radiobtn" value="Complimentary Media Delegate" id="cata1" onClick="show_div_user_grp_type()"   />
														<?php  } ?>
														<label for="cata1">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Media 
														</label>
													</div>
													<div class="md-radio<?php if(($assoc_nm != "") || ($exhi != "")){?> hide <?php } ?>">
														<input name="cata" type="radio" class="md-radiobtn" value="Complimentary Sponsor Delegate" id="cata2" onClick="show_div_user_grp_type()"  <?php if(($assoc_nm != "") || ($exhi != "")){?> disabled="disabled" <?php } ?> />
														<label for="cata2">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Sponsor 
														</label>
													</div>
													<div class="md-radio<?php if(($assoc_nm != "") || ($exhi != "")){?> hide <?php } ?>">
														<input name="cata" type="radio" class="md-radiobtn" value="Complimentary Speaker Delegate" id="cata3" onClick="show_div_user_grp_type()"  <?php if(($assoc_nm != "") || ($exhi != "") ){?> disabled="disabled" <?php } ?> />
														<label for="cata3">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Speaker 
														</label>
													</div>
													<div class="md-radio<?php if(($assoc_nm != "") || ($exhi != "")){?> hide <?php } ?>">
														   <?php   if(($assoc_nm != "") && ($exhi == "")){   ?>
														   <input name="cata" type="radio" class="md-radiobtn" value="Complimentary Invitee Delegate" id="cata4" onClick="show_div_user_grp_type()" checked="checked"  />
														   <?php    }  else if(($assoc_nm == "") && ($exhi != "")){ ?>
														   <input name="cata" type="radio" class="md-radiobtn" value="Complimentary Invitee Delegate" id="cata4" onClick="show_div_user_grp_type()" disabled="disabled" />
														   <?php   }   else if(($assoc_nm != "") && ($exhi != "")){  ?>
															<input name="cata" type="radio" class="md-radiobtn" value="Complimentary Invitee Delegate" id="cata4" onClick="show_div_user_grp_type()" disabled="disabled" />
														   <?php }  else{  ?>
															<input name="cata" type="radio" class="md-radiobtn" value="Complimentary Invitee Delegate" id="cata4" onClick="show_div_user_grp_type()"  />
														   <?php    }   ?>
														<label for="cata4">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Invitee 
														</label>
													</div>
												</div>
											</div>
										</div>
										<?php }?>
										<?php if($cata_type == 'QM3D14X') {?>
											<div class="form-group">
												<label class="control-label col-md-3"> Select GIA Country <span class="required"> * </span>
												</label>
												<div class="col-md-6">
													<select id="country" name="country" class="form-control" required="required" onchange="showOtherCountry();" >
														<option value="">-- Select GIA Country --</option>
														<?php $countryList = array('Armenia','Australia','Austria','Belgium','Canada','Denmark','Estonia','Finland','France','Germany','Israel','Japan','Lithuania','Netherlands','Sweden','Switzerland','Tunisia','UK','USA','Uzbekistan', 'Other');
																foreach ($countryList as $value) {
																	echo '<option value="' . $value . '">' . $value . '</option>'; 
																}
															?>
													</select>
												</div>
											</div>
											<div class="form-group" id="div_other_country" style="display:none;">
												<label class="col-md-3 control-label">Other GIA Country Name <span class="required"> * </span></label>
												<div class="col-md-6">
													<input type="text" class="form-control" name="other_country" type="text" id="other_country" />
												</div>
											</div>
										<?php }?>
										<div class="form-group form-md-radios">
											<label class="control-label col-md-3">Delegate Type <span class="required"> * </span> </label>
											<div class="col-md-9">
												<div class="md-radio-inline">
													<div class="md-radio">
														<input name="cata_m" type="radio" class="md-radiobtn" id="cata_m1" value="Industry"  checked="checked" />
														<label for="cata_m1">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Industry 
														</label>
													</div>
                                                    <?php /*closed by vivek  ?>
													<div class="md-radio">
													   <input name="cata_m" type="radio" class="md-radiobtn" id="cata_m2" value="Student"  />
														<label for="cata_m2">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Student 
														</label>
													</div>
													<div class="md-radio hide">
													   <input name="cata_m" type="radio" class="md-radiobtn" id="cata_m3" value="GOVT"   />
														<label for="cata_m3">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> GOVT. 
														</label>
													</div>
													<div class="md-radio hide">
													   <input name="cata_m" type="radio" class="md-radiobtn" id="cata_m4" value="Other"  />
														<label for="cata_m4">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Other 
														</label>
													</div>
                                                     <?php closed by vivek */ ?>
												</div>
											</div>
										</div>
                                         <?php  /*closed by vivek ?>
										<div class="form-group form-md-radios" id="tech-div" style="display:none1;">
											<label class="control-label col-md-3">How do you know about Event <span class="required"> * </span> </label>
											<div class="col-md-6">
												<select id="event_know" name="event_know" class="form-control" onchange="showPromo();" required="required">
													<option value="">-- Select --</option>
													<option value="News Paper Ads">News Paper Ads</option>
													<option value="Social Media">Social Media</option>
													<option value="Past Participant">Past Participant</option>
													<option value="Mailer">Mailer</option>
													<option value="Hoarding">Hoarding</option>
													<option value="Others">Others</option>
												</select>
                                                 <?php  closed by vivek */?>
												<?php /*?><div class="md-radio-inline">
													<div class="md-radio">
														<input type="radio" id="member_Yes" name="member_of_assoc" class="md-radiobtn" value="Yes" onclick="showPromoCode();">
														<label for="member_Yes">
														<span></span>
														<span class="check"></span>
														<span class="box"></span> Yes 
														</label>
													</div>
													<div class="md-radio">
														<input type="radio" id="member_No" name="member_of_assoc" class="md-radiobtn" value="No" onclick="showPromoCode();" >
														<label for="member_No">
														<span></span>
														<span class="check"></span>
														<span class="box"></span> No 
														</label>
													</div>
												</div><?php */?>
											 <?php  /*closed by vivek ?>
                                            </div>
											<div class="col-md-3" id="other-div" style="display:none;">
												<input type="text" class="form-control" id="other_value" name="other_value" placeholder="Other Value">
												<span class="help-block">Eg. Friends, Colleague</span>
											</div>
										</div>
                                        <?php  closed by vivek */?>
										<div class="form-group">
											<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<div class="input-group">
													<input name="vercode_reg" type="text" class="form-control" id="vercode_reg" maxlength="10" required autocomplete="off"/>
													<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_reg"];?>" />
													<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $text;?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn sbold uppercase green-jungle"> Continue
											<i class="fa fa-angle-right"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<?php }else {?>
					<h1>Online registration for <?php echo $EVENT_NAME . ' ' . $EVENT_YEAR;?> is closed. 
					However Onspot registration is available at event venue <strong><?php echo $EVENT_VENUE;?></strong>
					</h1>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	    <?php require 'includes/reg_form_footer.php';?>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script>var cata_type = '<?php echo $cata_type;?>';</script>
        <script src="js/registration_comp.js?fdsfb"></script>
        <script>
			jQuery(document).ready(function() {  
				Registration.init('registration_form_1', 0);
				
			 	//show_cata();
			    // show_div_group_user();
			   	//showTxt();
			});

			function show_div_user_grp_type(){

			}

		function showPromo() {
			var valie = $('#event_know').val();
			if(valie == 'Others') {
				$('#other-div').show();
			} else {
				$('#other-div').hide();
			}
		}

		function showOtherCountry() {
			var country = $('#country').val();
			if(country == 'Other') {
				$('#div_other_country').show();
			} else {
				$('#div_other_country').hide();
			}
		}
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>

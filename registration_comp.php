<?php
//echo "<script language='javascript'>window.location.href='https://www.bengalurutechsummit.com/web/it_forms/enquiry.php';</script>";
//exit;
	require ("includes/form_constants_both.php");

	$ret = @$_GET ['ret'];
	$temp_exhb_stat = @$_REQUEST ['ret2'];
	
	$temp_ticket_type = @$_GET ['tkt_type'];
	
	$cata_type = @$_REQUEST ["cata_type"];
	$assoc_nm = @$_REQUEST ["assoc_nm"];
	$assoc_name = '';
	
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

/*if($cata_type == 'SPLINV') {
	$sql = "SELECT COUNT(srno) AS c FROM " . $EVENT_DB_FORM_REG . " WHERE cata='Complimentary Special Invitee Delegate'";
	$specInvitee = mysqli_fetch_assoc(mysqli_query($link,$sql));
	if(isset($specInvitee['c']) && !empty($specInvitee['c'])) {
		if($specInvitee['c'] >= 300) {
			echo "<script language='javascript'>alert('For this association seats are fulled.');</script>";
			echo "<script language='javascript'>window.location = 'registration_comp.php';</script>";
			exit ();
		}
	}
}*/
/*$discountDetail = array();
if(!empty($cata_type)) {
	$sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_TBL WHERE promo_code='" . $cata_type . "'";
	$discountDetail = mysqli_fetch_assoc(mysqli_query($link,$sql));
	if(isset($discountDetail['reg_done'])) {
		if($discountDetail['reg_done'] >= $discountDetail['total_reg']) {
			session_destroy();
			echo "<script language='javascript'>alert('For " . $discountDetail['assoc_name'] . " Association/ Dignitary registrations seats are fulled.');</script>";
			echo "<script language='javascript'>window.location = 'registration_comp.php';</script>";
			exit;
		}
	} else {
		session_destroy();
		echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
		echo "<script language='javascript'>window.location='registration_comp.php';</script>";
		exit;
	}
}*/
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />'; 
	  require 'includes/reg_form_header.php';?>
	  <style>
          	.selected-flag {
          		margin-top: -23px;
          	}
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
					<?php if(date('Y-m-d H:i') <= '2020-11-19 19:00') {?>
					<?php //if($cata_type == 'QM3D14X' || $cata_type == 'SC0MZP2') {?>
					<form action="registration_comp2.php?ret=<?php echo $ret; ?>&exhi=<?php echo $exhi;?>&exhibitor_id=<?php echo $exhibitor_id;?>&assoc_nm=<?php echo $assoc_nm;?>&cata_type=<?php echo $cata_type;?>" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post" onsubmit="return validate_registration_form_2();">
						<input type="hidden" name="ticket_type" id="ticket_type" value="<?php echo $temp_ticket_type;?>" />
						<input type="hidden" name="paymode" id="Cc" value="Complimentary" />
						<?php /*<input type="hidden" id="event_know" name="event_know" value="MMA Email Invitation" />*/?>
                        <div class="form-wizard">
							<div class="form-body">
								<ul class="nav nav-pills nav-justified steps">
									<li class="active">
										<a href="#tab1" data-toggle="tab" class="step">
											<span class="number"> 1 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Information </span>
										</a>
									</li>
									<?php /*<li>
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
									</li>*/?>
									<li>
										<a data-toggle="tab" class="step dips-default-cursor">
											<span class="number"> 2 </span>
											<span class="desc">
												<i class="fa fa-check"></i> Confirm </span>
										</a>
									</li>
									<li>
										<a data-toggle="tab" class="step dips-default-cursor">
											<span class="number"> 3 </span>
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
													<?php $countryList = array('Information Technology'=>'Information Technology', 'Biotechnology'=>'Biotechnology','Electronics'=>'Electronics');
															//$countryList = array('Information Technology'=>'Information Technology');
															foreach ($countryList as $key=>$value) {
																echo '<option value="' . $key . '">' . $value . '</option>'; 
													 } ?>
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
										<?php }/*?>
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
										<?php *//*if(!empty($cata_type)) {?>
											<div class="group form-group">
											<label class="control-label col-md-3"><strong>Category:</strong> </label>
												<div class="col-md-9" style="margin-top: 8px;">
													<input name="cata" type="radio" class="hide" value="Complimentary GIA Partner Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
													<strong>Complimentary GIA Partner Delegate</strong>
												</div>
											</div>													
										<?php }*/?>
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
										<?php } else if($cata_type == 'GVTINV') {?>
											<div class="group form-group">
											<label class="control-label col-md-3"><strong>Category:</strong> </label>
												<div class="col-md-9" style="margin-top: 8px;">
													<input name="cata" type="radio" class="hide" value="Complimentary Government Invitee Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
													<strong>Complimentary Government Invitee Delegate</strong>
												</div>
											</div>													
										<?php } else if($cata_type == 'SPLINV') {?>
											<div class="group form-group">
											<label class="control-label col-md-3"><strong>Category:</strong> </label>
												<div class="col-md-9" style="margin-top: 8px;">
													<input name="cata" type="radio" class="hide" value="Complimentary Special Invitee Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
													<strong>Complimentary Special Invitee Delegate</strong>
												</div>
											</div>												
										<?php } else if($cata_type == 'APTVDS') {?>
											<div class="group form-group">
											<label class="control-label col-md-3"><strong>Category:</strong> </label>
												<div class="col-md-9" style="margin-top: 8px;">
													<input name="cata" type="radio" class="hide" value="Complimentary Premium Invitee Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
													<strong>Complimentary Premium Invitee Delegate</strong>
												</div>
											</div>												
										<?php } else if($cata_type == 'MDASTD') {?>
											<div class="group form-group">
											<label class="control-label col-md-3"><strong>Category:</strong> </label>
												<div class="col-md-9" style="margin-top: 8px;">
													<input name="cata" type="radio" class="hide" value="Complimentary Media Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
													<strong>Complimentary Media Delegate</strong>
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
														 <?php /*if(($assoc_nm != "") && ($exhi == "") ){  ?>
													   <input name="cata" type="radio" class="md-radiobtn" value="Complimentary Media Delegate" id="cata1" onClick="show_div_user_grp_type()" disabled="disabled"   />
														<?php   } else if(($exhi != "") && ($assoc_nm == "")){  ?>
													   <input name="cata" type="radio" class="md-radiobtn" value="Complimentary Media Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
													   <?php    } else if(($exhi != "") && ($assoc_nm != "")){ ?>
														 <input name="cata" type="radio" class="md-radiobtn" value="Complimentary Media Delegate" id="cata1" onClick="show_div_user_grp_type()" checked="checked"  />
														<?php   } else{ ?>
														<input name="cata" type="radio" class="md-radiobtn" value="Complimentary Media Delegate" id="cata1" onClick="show_div_user_grp_type()" />
														<?php  }*/ ?>

														<input name="cata" type="radio" class="md-radiobtn" value="Complimentary Media Delegate" id="cata1" onClick="show_div_user_grp_type()" />
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
										<div class="form-group form-md-radios del_type" id="del_type">
											<label class="control-label col-md-3">Delegate Type <span class="required"> * </span> </label>
											<div class="col-md-9">
												<div class="md-radio-inline">
													<?php if($cata_type == 'SPLINV' || $cata_type == 'MDASTD') {?>
														<div class="md-radio del-type-con ">
															<input type="radio" id="Student" name="cata_m" class="md-radiobtn" value="Standard Delegate" checked="checked" required="required">
															<label for="Student">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Standard Delegate 
															</label>
														</div>
													<?php } else if($cata_type == 'APTVDS') {?>
														<div class="md-radio ">
															<input type="radio" id="Industry" name="cata_m" class="md-radiobtn" value="Premium Delegate" <?php if($assoc_name != 'Student-Coordinator') {?>checked="checked"<?php }?>  required="required">
															<label for="Industry">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Premium Delegate
															</label>
														</div>
													<?php } else {?>
														<div class="md-radio ">
															<input type="radio" id="Industry" name="cata_m" class="md-radiobtn" value="Premium Delegate" <?php if($assoc_name != 'Student-Coordinator') {?>checked="checked"<?php }?>  required="required">
															<label for="Industry">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Premium Delegate
															</label>
														</div>
														<div class="md-radio del-type-con ">
															<input type="radio" id="Student" name="cata_m" class="md-radiobtn" value="Standard Delegate" required="required">
															<label for="Student">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> Standard Delegate 
															</label>
														</div>
													<?php }/*?><div class="md-radio hide">
														<input type="radio" id="Visitors" name="cata_m" class="md-radiobtn" value="Attendees/Visitors" onclick="assignSingleDay();" required="required">
														<label for="Visitors">
														<span></span>
														<span class="check"></span>
														<span class="box"></span> Attendees/Visitors
														</label>
													</div>
													<div class="md-radio <?php if($assoc_name == 'SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)' || $assoc_name == 'Student-Coordinator') {?>hide<?php }?>">
														<input type="radio" id="Academia" name="cata_m" class="md-radiobtn" value="R&D and Academia" onclick="assignSingleDay();" required="required">
														<label for="Academia">
														<span></span>
														<span class="check"></span>
														<span class="box"></span> R&D and Academia 
														</label>
													</div><?php */?>
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
                                        <?php  closed by vivek */
                                        $i = 1;?>
                                        <?php //<h4 class="form-section">Enter Information of Delegate </h4>?>
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
                                                <label class="col-md-3 control-label">Job Title <span class="dips-required">  </span></label>
                                                <div class="col-md-6">
                                                	<input class="form-control" name="job_title<?php echo $i; ?>" type="text" id="job_title<?php echo $i; ?>" maxlength="100" value="<?php if(isset($_SESSION['job_title'.$i])) { echo $_SESSION['job_title'.$i]; }else{ echo @$qr_gt_user_data_ans_row['job_title'.$i]; } ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Email Address <span class="dips-required"> * </span></label>
                                                <div class="col-md-6">
                                                	<input class="form-control" name="email_m<?php echo $i; ?>" type="email" id="email_m<?php echo $i; ?>" maxlength="150" value="<?php if(isset($_SESSION['email'.$i])) { echo $_SESSION['email'.$i]; }else{ echo @$qr_gt_user_data_ans_row['email'.$i]; } ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Mobile Number <span class="dips-required"> * </span></label>
                                                <div class="col-md-6" >
                                                	<span type="tel" id="mobile-country-code<?php echo $i; ?>" data-fax-iso-code-hidden-field-name="cellnoCountryCode<?php echo $i; ?>"></span>
												<?php 
													$mobile = array();
													if(isset($qr_gt_user_data_ans_row['cellno'.$i]))
														$mobile = explode("-",$qr_gt_user_data_ans_row['cellno'.$i]);
												?>
												<input type="hidden" name="cellnoCountryCode<?php echo $i; ?>" id="cellnoCountryCode<?php echo $i; ?>" value="<?php echo !empty($mobile[1]) ? str_replace('+', '', @$mobile[0]) : '';?>"/>
												<input type="hidden" id="cellnoCountryCode<?php echo $i; ?>Iso" />
												<input class="form-control" name="cellno<?php echo $i; ?>" type="text" id="cellno<?php echo $i; ?>" maxlength="10"  value="<?php echo !empty($mobile[1]) ? @$mobile[1] : '';?>" required onkeyup="check_num(event, 'cellno<?php echo $i; ?>');"  style="padding-left: 92px;    margin-top: -16px;"/>
													<span class="help-block">+Country Code-Mobile Number(xxx-xxxxxxxxxx)</span>
                                                </div>
                                            </div>
										<div class="form-group">
											<label class="col-md-3 control-label">Organisation Name<span class="dips-required">  </span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="org" id="org" value="<?php echo @$temp_org;?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">City<span class="dips-required"> * </span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="city" id="city" value="<?php echo @$temp_city;?>" onkeyup="check_char(event,'city')" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3"> Country <span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<select id="country" name="country" class="form-control">
													<option value="">Select Country </option>
													<?php $countryList = array("AF"=>"Afghanistan","AL"=>"Albania","DZ"=>"Algeria","AS"=>"AmericanSamoa","AD"=>"Andorra","AO"=>"Angola","AI"=>"Anguilla","AQ"=>"Antarctica","AR"=>"Argentina","AM"=>"Armenia","AW"=>"Aruba","AU"=>"Australia","AT"=>"Austria","AZ"=>"Azerbaijan","BS"=>"Bahamas","BH"=>"Bahrain","BD"=>"Bangladesh","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Belgium","BZ"=>"Belize","BJ"=>"Benin","BM"=>"Bermuda","BT"=>"Bhutan","BO"=>"Bolivia","BA"=>"BosniaandHerzegowina","BW"=>"Botswana","BV"=>"BouvetIsland","BR"=>"Brazil","IO"=>"BritishIndianOceanTerritory","BN"=>"BruneiDarussalam","BG"=>"Bulgaria","BF"=>"BurkinaFaso","BI"=>"Burundi","KH"=>"Cambodia","CM"=>"Cameroon","CA"=>"Canada","CV"=>"CapeVerde","KY"=>"CaymanIslands","CF"=>"CentralAfricanRepublic","TD"=>"Chad","CL"=>"Chile","CN"=>"China","CX"=>"ChristmasIsland","CC"=>"Cocos(Keeling)Islands","CO"=>"Colombia","KM"=>"Comoros","CG"=>"Congo","CD"=>"Congo,theDemocraticRepublicofthe","CK"=>"CookIslands","CR"=>"CostaRica","CI"=>"Coted'Ivoire","HR"=>"Croatia(Hrvatska)","CU"=>"Cuba","CY"=>"Cyprus","CZ"=>"CzechRepublic","DK"=>"Denmark","DJ"=>"Djibouti","DM"=>"Dominica","DO"=>"DominicanRepublic","EC"=>"Ecuador","EG"=>"Egypt","SV"=>"ElSalvador","GQ"=>"EquatorialGuinea","ER"=>"Eritrea","EE"=>"Estonia","ET"=>"Ethiopia","FK"=>"FalklandIslands(Malvinas)","FO"=>"FaroeIslands","FJ"=>"Fiji","FI"=>"Finland","FR"=>"France","GF"=>"FrenchGuiana","PF"=>"FrenchPolynesia","TF"=>"FrenchSouthernTerritories","GA"=>"Gabon","GM"=>"Gambia","GE"=>"Georgia","DE"=>"Germany","GH"=>"Ghana","GI"=>"Gibraltar","GR"=>"Greece","GL"=>"Greenland","GD"=>"Grenada","GP"=>"Guadeloupe","GU"=>"Guam","GT"=>"Guatemala","GN"=>"Guinea","GW"=>"Guinea-Bissau","GY"=>"Guyana","HT"=>"Haiti","HM"=>"HeardandMcDonaldIslands","VA"=>"HolySee(VaticanCityState)","HN"=>"Honduras","HK"=>"HongKong","HU"=>"Hungary","IS"=>"Iceland","IN"=>"India","ID"=>"Indonesia","IR"=>"Iran(IslamicRepublicof)","IQ"=>"Iraq","IE"=>"Ireland","IL"=>"Israel","IT"=>"Italy","JM"=>"Jamaica","JP"=>"Japan","JO"=>"Jordan","KZ"=>"Kazakhstan","KE"=>"Kenya","KI"=>"Kiribati","KP"=>"Korea,DemocraticPeople'sRepublicof","KR"=>"Korea,Republicof","KW"=>"Kuwait","KG"=>"Kyrgyzstan","LA"=>"LaoPeople'sDemocraticRepublic","LV"=>"Latvia","LB"=>"Lebanon","LS"=>"Lesotho","LR"=>"Liberia","LY"=>"LibyanArabJamahiriya","LI"=>"Liechtenstein","LT"=>"Lithuania","LU"=>"Luxembourg","MO"=>"Macau","MK"=>"Macedonia,TheFormerYugoslavRepublicof","MG"=>"Madagascar","MW"=>"Malawi","MY"=>"Malaysia","MV"=>"Maldives","ML"=>"Mali","MT"=>"Malta","MH"=>"MarshallIslands","MQ"=>"Martinique","MR"=>"Mauritania","MU"=>"Mauritius","YT"=>"Mayotte","MX"=>"Mexico","FM"=>"Micronesia,FederatedStatesof","MD"=>"Moldova,Republicof","MC"=>"Monaco","MN"=>"Mongolia","MS"=>"Montserrat","MA"=>"Morocco","MZ"=>"Mozambique","MM"=>"Myanmar","NA"=>"Namibia","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Netherlands","AN"=>"NetherlandsAntilles","NC"=>"NewCaledonia","NZ"=>"NewZealand","NI"=>"Nicaragua","NE"=>"Niger","NG"=>"Nigeria","NU"=>"Niue","NF"=>"NorfolkIsland","MP"=>"NorthernMarianaIslands","NO"=>"Norway","OM"=>"Oman","PK"=>"Pakistan","PW"=>"Palau","PA"=>"Panama","PG"=>"PapuaNewGuinea","PY"=>"Paraguay","PE"=>"Peru","PH"=>"Philippines","PN"=>"Pitcairn","PL"=>"Poland","PT"=>"Portugal","PR"=>"PuertoRico","QA"=>"Qatar","RE"=>"Reunion","RO"=>"Romania","RU"=>"RussianFederation","RW"=>"Rwanda","KN"=>"SaintKittsandNevis","LC"=>"SaintLUCIA","VC"=>"SaintVincentandtheGrenadines","WS"=>"Samoa","SM"=>"SanMarino","ST"=>"SaoTomeandPrincipe","SA"=>"SaudiArabia","SN"=>"Senegal","SC"=>"Seychelles","SL"=>"SierraLeone","SG"=>"Singapore","SK"=>"Slovakia(SlovakRepublic)","SI"=>"Slovenia","SB"=>"SolomonIslands","SO"=>"Somalia","ZA"=>"SouthAfrica","GS"=>"SouthGeorgiaandtheSouthSandwichIslands","ES"=>"Spain","LK"=>"SriLanka","SH"=>"St.Helena","PM"=>"St.PierreandMiquelon","SD"=>"Sudan","SR"=>"Suriname","SJ"=>"SvalbardandJanMayenIslands","SZ"=>"Swaziland","SE"=>"Sweden","CH"=>"Switzerland","SY"=>"SyrianArabRepublic","TW"=>"Taiwan,ProvinceofChina","TJ"=>"Tajikistan","TZ"=>"Tanzania,UnitedRepublicof","TH"=>"Thailand","TG"=>"Togo","TK"=>"Tokelau","TO"=>"Tonga","TT"=>"TrinidadandTobago","TN"=>"Tunisia","TR"=>"Turkey","TM"=>"Turkmenistan","TC"=>"TurksandCaicosIslands","TV"=>"Tuvalu","UG"=>"Uganda","UA"=>"Ukraine","AE"=>"UnitedArabEmirates","GB"=>"UnitedKingdom","US"=>"UnitedStates","UM"=>"UnitedStatesMinorOutlyingIslands","UY"=>"Uruguay","UZ"=>"Uzbekistan","VU"=>"Vanuatu","VE"=>"Venezuela","VN"=>"VietNam","VG"=>"VirginIslands(British)","VI"=>"VirginIslands(U.S.)","WF"=>"WallisandFutunaIslands","EH"=>"WesternSahara","YE"=>"Yemen","ZM"=>"Zambia","ZW"=>"Zimbabwe");
														if(empty($temp_country)) {
															$temp_country = 'India';
														}
														foreach ($countryList as $country) {
															$selected = '';
															if($temp_country == $country) {
																$selected = 'selected=selected';
															}
															echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>'; 
														}
													?>
												</select>
											</div>
										</div>
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
	    <script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>		
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script>var cata_type = '<?php echo $cata_type;?>';</script>
        <script src="js/registration_comp.js?fdsfb"></script>
        <script>
			jQuery(document).ready(function() {  
				Registration.init('registration_form_3', 2);
				<?php $i=1;//for($i=1;$i<=$lmt;$i++){ ?>
					$("#mobile-country-code<?php echo $i; ?>").intlTelInput();
			});
		</script>
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
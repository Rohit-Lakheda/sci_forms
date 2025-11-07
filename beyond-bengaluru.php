<?php
echo "<script language='javascript'>window.location.href='https://www.bengalurutechsummit.com/web/it_forms/enquiry.php';</script>";
exit;

	session_start();
	require("includes/form_constants_both.php");
	
	require "dbcon_open.php";
	require "get_user_no.php";
	do
	{
		$i = 0;
		$text = get_rand_id(6);
		$_SESSION["vercode_spkr_reg"] = $text;
	
		$chq_qr_demo = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_BEYOND_BENG_REG." WHERE reg_id = '$text'")or die(mysqli_error($link));
		$chq_no_demo = mysqli_num_rows($chq_qr_demo);
	
		if( ($chq_no_demo > 0))
		{
			$i++;
			continue;
		}
		else
		{
			$i = 0;
		}
	}while( ($i != 0));
?>
<?php require 'includes/reg_form_header.php';?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_2">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> Beyond Bengaluru - Delegate Registration Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="beyond-bengaluru2.php" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" enctype="multipart/form-data" method="post" onsubmit="return validate_reg_registration_form_1();">
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a href="#tab1" data-toggle="tab" class="step">
									<span class="number"> 1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Registration </span>
									</a>
								</li>
								<li class="active">
									<a data-toggle="tab" class="step">
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
									<h3 class="block">Provide below Information</h3>									
									<div class="form-group">
										<label class="col-md-3 control-label">Sector <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<select id="sector" name="sector" class="form-control" required>
											<option value="">-- Select Sector --</option>
												<?php //$countryList = array('Information Technology'=>'Information Technology', 'Bio Technology'=>'Bio Technology');
													$countryList = array('IT','Electronics','Biotech','Medtech','Agritech','Fintech','Other');
														foreach ($countryList as $value) {
															$selected = '';
															if($_SESSION['sess_sector'] == $value) {
																$selected = 'selected="selected"';
															}
															echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>'; 
														}
													?>
											</select>
										</div>
									</div>
									<div class="form-group">
                                    	<label class="control-label col-md-3"> Name <span class="required"> * </span></label>
                                    	<div class="col-md-2">
                                    		<select class="form-control" id="title" name="title">
                                    			<option value="">-Title-</option>
												<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
													foreach ($titleList as $title) {
														echo '<option value="' . $title . '">' . $title . '</option>';
													}
													?>
                                    		</select>
                                    	</div>
                                    	<div class="col-md-2">
                                    		<input name="fname" type="text" class="form-control" id="fname" placeholder="First Name" required />
                                    	</div>
                                    	<div class="col-md-2">
                                    		<input name="lname" type="text" class="form-control" id="lname" placeholder="Last Name" required />
                                    	</div>
                                    </div>
                                    <div class="form-group">
                                    	<label class="control-label col-md-3"> Designation <span class="required"> * </span>
                                    	</label>
                                    	<div class="col-md-6">
                                    		<input name="desig" type="text" class="form-control" id="desig" required />
                                    	</div>
                                    </div>
                                    <div class="form-group">
                                    	<label class="control-label col-md-3"> Organisation <span class="required"> * </span>
                                    	</label>
                                    	<div class="col-md-6">
                                    		<input name="org" type="text" class="form-control " id="org" required/>
                                    	</div>
                                    </div>
                                    <div class="form-group">
                                    	<label class="control-label col-md-3"> Email Id <span class="required"> * </span>
                                    	</label>
                                    	<div class="col-md-6">
                                    		<input name="email" type="email" class="form-control" id="email" required/>
                                    	</div>
                                    </div>
                                    <div class="form-group">
                                    	<label class="control-label col-md-3"> Mobile Number  <span class="required"> * </span>
                                    	</label>
                                    	<div class="col-md-2">
                                    		<input name="mob_cntry_code" type="text" class="form-control" id="mob_cntry_code" onkeyup="check_num(event,'mob_cntry_code')" maxlength="4"  placeholder="Country Code" required />
                                    	</div>
                                    	<div class="col-md-4">
                                    		<input name="mob" type="text" class="form-control" id="mob" onkeyup="check_num(event,'mob')" maxlength="10" placeholder="Mobile Number" required />
                                    	</div>
                                    </div>
                                    <div class="form-group">
                                    	<label class="control-label col-md-3"> City <span class="required"> * </span>
                                    	</label>
                                    	<div class="col-md-6">
                                    		<input name="city" type="text" class="form-control " id="city" required/>
                                    	</div>
                                    </div>
                                    <div class="form-group">
                                    	<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
                                    	<div class="col-md-6">
                                    		<div class="input-group">
                                    			<input name="vercode" type="text" class="form-control dips-name-textbox" id="vercode" maxlength="10" required/>
                                    			<input name="vercode_sp2" type="hidden" class="form-control dips-name-textbox" id="vercode_sp2" value="<?php echo $text;?>"/>
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
									<a href="javascript:;" class="btn default" onclick="go_back();">
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
	
	<script>
		jQuery(document).ready(function() {  
			Registration.init('reg_registration_form_1', 0);
		});

		function validate_reg_registration_form_1() {
        	if(document.getElementById("sector").value == "") {
        		alert("Please select sector.");
                document.getElementById("sector").focus();
        		return false;
        	}
        	if(document.getElementById("title").value == "") {
        		alert("Please select title.");
                document.getElementById("title").focus();
        		return false;
        	}
        	if(document.getElementById("fname").value == "") {
        		alert("Please enter first name.");
                document.getElementById("fname").focus();
        		return false;
        	}
        	if(document.getElementById("lname").value == "") {
        		alert("Please enter last name.");
                document.getElementById("lname").focus();
        		return false;
        	}
        	if(document.getElementById("desig").value == "") {
        		alert("Please enter Designation.");
                document.getElementById("desig").focus();
        		return false;
        	}
        	if(document.getElementById("org").value == "") {
        		alert("Please enter Name of Company.");
                document.getElementById("org").focus();
        		return false;
        	}
        	if(document.getElementById("email").value == "") {
        		alert("Please enter Email Id.");
                document.getElementById("email").focus();
        		return false;
        	} else {
    			var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    			var toArr= document.getElementById("email").value.split(","); 			//split into array
    			for (var i=0;i<toArr.length;i++) 				    					//loop array to validate correct address
    			{
    				if ( !toArr[i].match(reg) ) 										//if not match, alert and stop loop
    				{	
    					alert("Invalid email address \n"+toArr[i]);
    					document.getElementById("email").focus();
    					return false;
    				}
    			}
    		}
        	if(document.getElementById("mob_cntry_code").value == "") {
        		alert("Please enter mobile Country Code.");
                document.getElementById("mob_cntry_code").focus();
        		return false;
        	}
        	if(document.getElementById("mob").value == "") {
        		alert("Please enter Mobile number.");
                document.getElementById("mob").focus();
        		return false;
        	}
        	if(document.getElementById("city").value == "") {
        		alert("Please enter City.");
                document.getElementById("city").focus();
        		return false;
        	}
        	
        	
        	if(document.getElementById("vercode").value == "") {
    			alert("Please enter text see in the image.");
    			document.getElementById("vercode").focus();
    			return false;
    		} else {
    			if(document.getElementById("vercode").value != document.getElementById("vercode_sp2").value) {
    				alert("Please enter correct text see in the image.");
    				document.getElementById("vercode").value = '';
    				document.getElementById("vercode").focus();
    				return false;
    			}
    		}
        
            //document.getElementById("reg_registration_form_1").submit();
            return true;
        }

	</script>

</body>
</html>
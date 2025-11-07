<?php
	session_start(); 
	$event_name = 'Bangalore IT';
	$en = '';
	if(isset($_GET['en']) && !empty($_GET['en'])) {
		$en = '1';
		$event_name = 'Bangalore INDIA BIO';
	}

	$assoc_code = @$_GET['a'];
	$assoc_code = trim($assoc_code);

	if((!isset($_SESSION["vercode_reg"]))||($_SESSION["vercode_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		if(!empty($assoc_code)) {
			echo "<script language='javascript'>window.location = 'registration-assoc.php?a=$assoc_code';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-assoc.php?a=$assoc_code';</script>";
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
		if(!empty($assoc_code)) {
			echo "<script language='javascript'>window.location = 'registration-assoc.php?a=$assoc_code';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration-assoc.php?a=$assoc_code';</script>";
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
	
	if(isset($qr_gt_user_data_ans_row['email1']) && empty($qr_gt_user_data_ans_row['email1'])) {
		if(isset($_SESSION['email1']) && !empty($_SESSION['email1'])) {
			$qr_gt_user_data_ans_row['email1'] = $_SESSION;
		}
	}
	
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
					<span class="caption-subject font-red bold uppercase"> premium delegate registration (Free)
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="registration-assoc6.php?a=<?php echo $a;?>" class="form-horizontal" name="reg_registration_form_3" id="reg_registration_form_3" method="post" onsubmit="return validate_registration_form_3();">
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
								<?php /*<li class="done">
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Organisation Information </span>
									</a>
									</li>*/?>
								<li class="active">
									<a data-toggle="tab" class="step">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Delegate Information </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 3 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Confirm </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 4 </span>
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
									<table class="table table-hover1 table-bordered teriff-table main-tariff-table hide" style="display: none;">
										<thead>
											<tr bgcolor="#2fa0dd" style="color: #fff;">
                                    			<th colspan="6">Delegate Tariff for Virtual Event</th>
											</tr>
											<tr  bgcolor="#2fa0dd" style="color: #fff;">
												<?php /*?><th colspan="2" class="align-td">PACKAGE</th>*/?>
												<th colspan="3" class="align-td">DELEGATE CATEGORY</th>
												<th colspan="1" class="align-td">TARIFF</th>
												<?php /*<th colspan="1" class="align-td">13th Nov to 17th Nov, 2020</th>
												<th colspan="1" class="align-td">8th Nov to 16th Nov, 2020</th>*/?>
											</tr>
										</thead>
										<tbody>
											<?php /*<tr class="" style="background-color: #e1e1e1;" >
                                    			<?php /*?><td colspan="2" class="align-td">All Access</td>/?>
                                    			<td colspan="3" class="align-td">Conference Delegate<br/>(Access to entire summit)</td>
                                    			<td colspan="1" class="align-td">FREE</td>
                                    			<?php /*<td colspan="1" class="align-td">INR 3000</td>
                                    			<td colspan="1" class="align-td">INR 6000</td>//?>
                                    		</tr>*/?>
                                    		<?php //if($qr_gt_user_data_ans_row['nationality'] == 'Indian Organization') {?>
    											<tr class="indian-tariff" style="background-color: #e1e1e1;" >
                                        			<?php /*?><td colspan="2" class="align-td">All Access</td>*/?>
                                        			<td colspan="3" class="align-td">Premium Delegate<br/>(B2B Partnering + Access to entire summit)</td>
                                        			<td colspan="1" class="align-td">INR 5000</td>
                                        			<?php /*<td colspan="1" class="align-td">INR 3000</td>
                                        			<td colspan="1" class="align-td">INR 6000</td>*/?>
                                        		</tr>
                                        	<?php //} else {?>
                                    		<?php /*<tr class="indian-tariff-1" style="background-color: #e1e1e1;" >
                                    			<td colspan="3" class="align-td">Standard Delegate</td>
                                    			<td colspan="1" class="align-td">INR 2000</td>
                                    			<td colspan="1" class="align-td">INR 3000</td>
                                    		</tr>*/?>
    											<tr class="international-tariff" style="background-color: #e1e1e1;display: none;">
                                        			<?php /*<td colspan="2" class="align-td">All Access</td>*/?>
                                        			<td colspan="2" class="align-td">International Premium Delegate<br/>(B2B Partnering + Access to entire summit)</td>
                                        			<td colspan="2" class="align-td">USD 100</td>
                                        			<?php /*<td colspan="1" class="align-td">USD 200</td>
                                        			<td colspan="1" class="align-td">USD 200</td>*/?>
                                        		</tr>
                                        	<?php //}?>
											<tr>
												<td colspan="10">
													<strong>Note: </strong><br/>
														- 18% GST is applicable for the above delegate cost.<br/>
														- Group Discount of 10% for 3 or More Delegates from Same Organisation<br/>
												</td>
											</tr>
										</tbody>
									</table>
									<table class="table table-hover1 table-bordered teriff-table hide" style="display: none;">
										<tbody>
											<tr bgcolor="#2fa0dd" style="color: #fff;">
												<td colspan="10">DELEGATE ENTITLEMENTS :</td>
											</tr>
											<tr bgcolor="#2fa0dd" style="color: #fff;">
												<td width="20%" style="font-size: 14px;font-weight: 600px;">Category</td>
												<td width="10%" style="font-size: 14px;font-weight: 600px;">One 2 One Business Meetings**</td>
												<td width="10%" style="font-size: 14px;font-weight: 600px;">Inaugural/ Keynote/ Plenary/Cultural Programme</td>
												<td width="10%" style="font-size: 14px;font-weight: 600px;">Special Programme India - US Conclave Bengaluru Next</td>
												<td width="10%" style="font-size: 14px;font-weight: 600px;">Conference/ On Demand Sessions</td>
												<td width="10%" style="font-size: 14px;font-weight: 600px;">International Exhibition</td>
												<td width="10%" style="font-size: 14px;font-weight: 600px;">Industry Awards IT/Biotech/ Start-ups</td>
												<td width="10%" style="font-size: 14px;font-weight: 600px;">Quiz Competition IT/Biotech</td>
												<td width="10%" style="font-size: 14px;font-weight: 600px;">Biotech Posters Walkway of Discovery</td>
											</tr>
											<?php /*<tr class="conference-del">
												<td bgcolor="#2fa0dd" width="20%" style="color: #fff;">
													Conference Delegate
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td" style="color:red;">
													<i class="fa fa-times" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
											</tr>*/?>
											<tr class="partner-del">
												<td bgcolor="#2fa0dd" width="20%" style="color: #fff;">
													Premium Delegate
												</td>
												<td width="10%" bgcolor="#c9e0f3" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#c9e0f3" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#c9e0f3" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#c9e0f3" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#c9e0f3" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#c9e0f3" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#c9e0f3" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#c9e0f3" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
											</tr>
											<tr class="conference-del">
												<td bgcolor="#2fa0dd" width="20%" style="color: #fff;">
													International Premium Delegate
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
												<td width="10%" bgcolor="#e5ebf1" class="align-td">
													<i class="fa fa-check" aria-hidden="true"></i>
												</td>
											</tr>
											<tr>
												<td colspan="10">
													- **One 2 One business meetings will be organised by using the advanced partnering tool will allow you to arrange partnering meetings virtually. You can self-schedule meetings in advance and meet your potential business partners, collaborators, customers during the 3 full days of partnering during the event.<br/>
												</td>
											</tr>
										</tbody>
									</table>
											
											
									<h3 class="block">Provide Delegate Information</h3>
									<?php for($i=1;$i<=$lmt;$i++){ ?>
									<h4 class="form-section">Enter Information of Delegate 
										<?php if($lmt > 1) {	
											echo $i;	
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
									
									<div class="form-group">
										<label class="control-label col-md-3"> Delegate Category <span class="required">  </span>
										</label>
										<div class="col-md-6" style="margin-top: 8px;">
											<?php if($qr_gt_user_data_ans_row['nationality'] == 'Indian Organization') {?>
														<input type="hidden" id="catagory<?php echo $i; ?>" name="catagory<?php echo $i; ?>" value="Premium Delegate" />
														Premium Delegate
											<?php } else {?>
													   <input type="hidden" id="catagory<?php echo $i; ?>" name="catagory<?php echo $i; ?>" value="International Premium Delegate" />
													   International Premium Delegate
											<?php }?>
											
											<?php /*<select id="catagory<?php echo $i; ?>" name="catagory<?php echo $i; ?>" class="form-control" required="required" onchange="showPayment();">
													<option value="">-- Category  --</option>
													<?php if($qr_gt_user_data_ans_row['nationality'] == 'Indian Organization') {
													           $countryList = array('Conference Delegate', 'Premium Delegate');
													} else {
													    $countryList = array('Conference Delegate', 'International Premium Delegate');
													}
														//$countryList = array('Information Technology'=>'Information Technology');
														foreach ($countryList as $value) {
														    $selected = '';
														    if(isset($qr_gt_user_data_ans_row['cata'.$i]) && $qr_gt_user_data_ans_row['cata'.$i] == $value) {
														        $selected = 'selected="selected"';
														    }
														    echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>'; 
														}
													?>
											</select>*/?>
										</div>
									</div>
									
									<?php /*$cata=explode(",",$qr_gt_user_data_ans_row['cata']); ?>
									<input name="catagory<?php echo $i; ?>" type="hidden" id="catagory<?php echo $i; ?>" value="<?php echo $cata[0];?>"  />
									<?php */}?>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<a href="javascript:;" class="btn default" onclick="go_back11();">
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
		Registration.init('registration_form_3', 1);
		<?php for($i=1;$i<=$lmt;$i++){ ?>
			$("#mobile-country-code<?php echo $i; ?>").intlTelInput();
		<?php }?>
		//showPayment();
	});
	
	function showPayment() {
		var isPaid = false;
		for(var i = 0; i <= <?php echo $lmt;?>; i++) {
			var values = $('#catagory' + i).val();
			if(values == 'Premium Delegate' || values == 'International Premium Delegate') {
				isPaid = true;
				break;
			}
		}
		if(isPaid) {
			$('#pay').show();
		} else {
			$('#pay').hide();
		}
		var national = '<?php echo $qr_gt_user_data_ans_row['nationality'];?>';
		if(national == 'Indian Organization') {
			$('.indian-tariff').show();
			$('.international-tariff').hide();
		} else {
			$('.international-tariff').show();
			$('.indian-tariff').hide();
		}
	}
	
	function validate_registration_form_3(){
    	var spouseCount = delegateCount = 0;
    	for(var j=1;j<=<?php echo $lmt;?>;j++)
    	{
    		if(document.getElementById("title"+j).value == "")
    		{
    			alert("Please fill delegate "+j+"'s title ");
    			document.getElementById("title"+j).focus();
    			return false;
    		}
    		if(document.getElementById("fname"+j).value == "")
    		{
    			alert("Please fill delegate "+j+"'s first name");
    			document.getElementById("fname"+j).focus();
    			return false;
    		}
    		if(document.getElementById("lname"+j).value == "")
    		{
    			alert("Please fill delegate "+j+"'s last name");
    			document.getElementById("lname"+j).focus();
    			return false;
    		}
    		if(document.getElementById("job_title"+j).value == "")
    		{
    			alert("Please fill delegate"+j+"'s Designation");
    			document.getElementById("job_title"+j).focus();
    			return false;
    		}
    		/*if(document.getElementById("badge"+j).value == "")
    		{
    			alert("Please fill delegate"+j+"'s badge name");
    			document.getElementById("badge"+j).focus();
    			return false;
    		}*/
    		
    		if(document.getElementById("email_m"+j).value == "")
    		{
    			alert("Please fill delegate"+j+"'s email");
    			document.getElementById("email_m"+j).focus();
    			return false;
    		} else if(document.getElementById("email_m"+j).value != "") 
    		{
    			var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    			var toArr= document.getElementById("email_m"+j).value.split(","); 			//split into array
    			for (var i=0;i<toArr.length;i++) 				    					//loop array to validate correct address
    			{
    				if ( !toArr[i].match(reg) ) 										//if not match, alert and stop loop
    				{	
    					alert("Invalid email address \n"+toArr[i]);
    					document.getElementById("email_m"+j).focus();
    					return false;
    				}
    			}
    		}
    		
    		/*if(document.getElementById("c_code"+j).value == "")
    		{
    			alert("Please fill delegate"+j+"'s country code");
    			document.getElementById("c_code"+j).focus();
    			return false;
    		}*/
    		if(document.getElementById("cellno"+j).value == "")
    		{
    			alert("Please fill delegate"+j+"'s mobile code");
    			document.getElementById("cellno"+j).focus();
    			return false;
    		}
    		if(document.getElementById("catagory"+j).value == "")
    		{
    			alert("Please fill delegate"+j+"'s category");
    			document.getElementById("catagory"+j).focus();
    			return false;
    		}
    	}
    	
    	 //document.reg_registration_form_3.submit();
    	 return true;
    }
    
    function go_back11() {
    	var assoc_nameurl2 = '';
    	if(a != '') {
    		a = '&a=' + a;		
    	}
    	
    	if(assoc_name != '') {
    		assoc_nameurl2 = '&assoc_name=' + assoc_name;
    	}
    	window.location=('registration-assoc.php?ret=retds4fu324rn_ed24d3it&en=' + en + a + assoc_nameurl2);
    }
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
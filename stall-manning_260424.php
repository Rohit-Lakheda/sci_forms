<?php
/*echo "<script language='javascript'>alert('Please visit venue for exhibitor passes.');</script>";
echo "<script language='javascript'>window.location.href='https://www.bengalurutechsummit.com';</script>";
 exit;*/
//ob_start();
//ini_set(session.save_path, 'E:\work\xampp\tmp');
require("includes/form_constants_both.php");
$ret = @$_GET['ret'];

if ($ret == "retds4fu324rn_ed24d3it") {
    session_start();
    if ((!isset($_SESSION["vercode_ex"])) || ($_SESSION["vercode_ex"] == '')) {
        session_destroy();
        echo "<script language='javascript'>alert('Please try again.');</script>";
        echo "<script language='javascript'>window.location=('stall-manning.php');</script>";
        echo "<script language='javascript'>document.location=('stall-manning.php');</script>";
        exit;
    }
    require "dbcon_open.php";
} else {
    include('captcha_stall_man.php');
}

$discountDetail = array();
if(isset($_GET['a']) && !empty($_GET['a'])) {
    $assoc_name1 = $_GET['a'];
    
    $sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_STALL_MANNING_TBL WHERE promo_code='" . $assoc_name1 . "'";
    $discountDetail = mysqli_fetch_assoc(mysqli_query($link,$sql));
    if(isset($discountDetail['reg_done'])) {
        if($discountDetail['reg_done'] >= $discountDetail['total_reg']) {
            session_destroy();
            echo "<script language='javascript'>alert('For exhibitor " . $discountDetail['assoc_name'] . " registrations seats are fulled.');</script>";
            echo "<script language='javascript'>window.location = 'stall-manning.php';</script>";
            exit;
        }
    } else {
        session_destroy();
        echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
        echo "<script language='javascript'>window.location='stall-manning.php';</script>";
        exit;
    }
}
/*$en = '';
 if(isset($_GET['en']) && !empty($_GET['en'])) {
 $en = '1';
 }*/

//$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG);
$totalRegistrations = 200;//mysqli_num_rows($qr_gt_user_data_id);
//echo $qr_gt_user_data_ans_no;
$assoc_name = '';
/* $assoc_name = @$_GET['assoc_name'];
 if($assoc_name == 'STPI') {
 echo "<script language='javascript'>window.location = 'stall-manning.php?assoc_name=SOFTWARE TECHNOLOGY PARKS OF INDIA(STPI)';</script>";
 exit;
 } */
?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />'; 
    require 'includes/reg_form_header.php';?>
<style>
	.selected-flag {
	margin-top: -5px;
	}
	.first-row td {
		background: #acb9ca;
	}
	.second-row td {
		background: #f4b084;
	}
	.third-row td {
		background: #dbdbdb;
	}
	.fourth-row td {
		background: #b4c6e7;
	}
	.fifth-row td {
		background: #00b050;
	}
	
	.button {
	  background-color: #f00;
	  -webkit-border-radius: 10px;
	  border-radius: 10px;
	  border: none;
	  color: #FFFFFF;
	  padding: 5px 7px;
	  /*display: inline-block;
	  font-family: Arial;
	  font-size: 20px;
	  text-align: center;
	  text-decoration: none;*/
	}
	@-webkit-keyframes glowing {
	  0% { background-color: #f00; -webkit-box-shadow: 0 0 3px #f00; }
	  50% { background-color: #fff; -webkit-box-shadow: 0 0 10px #fff; }
	  100% { background-color: #f00; -webkit-box-shadow: 0 0 3px #f00; }
	}

	@-moz-keyframes glowing {
	  0% { background-color: #f00; -moz-box-shadow: 0 0 3px #f00; }
	  50% { background-color: #fff; -moz-box-shadow: 0 0 10px #fff; }
	  100% { background-color: #f00; -moz-box-shadow: 0 0 3px #f00; }
	}

	@-o-keyframes glowing {
	  0% { background-color: #f00; box-shadow: 0 0 3px #f00; }
	  50% { background-color: #fff; box-shadow: 0 0 10px #fff; }
	  100% { background-color: #f00; box-shadow: 0 0 3px #f00; }
	}

	@keyframes glowing {
	  0% { background-color: #f00; box-shadow: 0 0 3px #f00; }
	  50% { background-color: #fff; box-shadow: 0 0 10px #fff; }
	  100% { background-color: #f00; box-shadow: 0 0 3px #f00; }
	}

	.button {
	  -webkit-animation: glowing 3000ms infinite;
	  -moz-animation: glowing 3000ms infinite;
	  -o-animation: glowing 3000ms infinite;
	  animation: glowing 3000ms infinite;
	}

	@keyframes glowing {
	  0% { background-color: #f00; box-shadow: 0 0 3px #f00; }
	  50% { background-color: #000; box-shadow: 0 0 10px #fff; }
	  100% { background-color: #f00; box-shadow: 0 0 3px #f00; }
	}

	.button {
	  animation: glowing 3000ms infinite;
	}
	.align-td {
		text-align: center;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered" id="registration_form_1">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase"> 
					<?php /*if(isset($_GET['a']) && !empty($_GET['a']) && $_GET['a'] == 'F5X3SB') {?>
						STANDARD MEDIA  delegate registration (Free)
					<?php } else {?>
						STANDARD delegate registration (Free)
					<?php }*/ ?>
					Exhibitor Stall Manning registration form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<?php if(date('Y-m-d H:i') <= '2024-11-19 19:00' && !empty($discountDetail)) {?>
				<form action="stall-manning2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" method="post" onsubmit="return validate_ex2();">
					<?php /*?><input type="hidden" value="Standard" name="cata_m" /><?php */?>
					<input type="hidden" id="user_type" name="user_type" class="form-control" value="<?php echo $discountDetail['assoc_name'];?>"/>
					<input type="hidden" name="assoc_srno" id="assoc_srno" value="<?php echo $discountDetail['srno'];?>"/>
					<input name="promo_code" type="hidden" id="promo_code" value="<?php echo $discountDetail['promo_code'];?>"/>
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li class="active">
									<a href="#tab1" data-toggle="tab" class="step">
									<span class="number"> 1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Exhibitor Personnel Details </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Preview </span>
									</a>
								</li>
								<li>
									<a data-toggle="tab" class="step dips-default-cursor">
									<span class="number"> 3 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Confirmation </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success"> </div>
							</div>
									<?php $total_exbhitors = 1;for($i_exb = 1; $i_exb<=$total_exbhitors;$i_exb++) { ?>
										<div class="h4">Personal Information of Exhibitor:
											<?php if($total_exbhitors > 1) {	
												    echo $i_exb.":";	
												} ?>(Stall Manning)	
												 <?php if($i_exb<=2){?><span class="dips-required"> * </span><?php } ?>
												 <input name="del_category<?php echo $i_exb;?>" type="hidden" id="del_category<?php echo $i_exb;?>" class="del_category" value="Exhibitor" />
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Exhibitor Name </label>
											<div class="col-md-6" style="margin-top:8px;">
												<?php echo $discountDetail['assoc_name'];?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Contact Person Name<?php if($i_exb<=2){?> <span class="required"> * </span><?php } ?></label>
											<div class="col-md-2">
												<select class="form-control" name="title<?php echo $i_exb;?>" <?php if($i_exb<=2){?>required<?php } ?> id="title<?php echo $i_exb;?>">
													<option value="">-Title-</option>
													<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
														foreach ($titleList as $title) {
															echo '<option value="' . $title . '">' . $title . '</option>';
														}?>
												</select>
											</div>
											<div class="col-md-2"><input type="text" class="form-control" placeholder="First Name" name="fname<?php echo $i_exb;?>" id="fname<?php echo $i_exb;?>" <?php if($i_exb<=2){?>required<?php } ?> maxlength="100" onkeyup="check_char(event,'fname1');" value="<?php echo $_SESSION['fname1'];?>"></div>
											<div class="col-md-2"><input type="text" class="form-control" placeholder="Last Name" name="lname<?php echo $i_exb;?>" id="lname<?php echo $i_exb;?>" <?php if($i_exb<=2){?>required<?php } ?> maxlength="100" onkeyup="check_char(event,'lname1');"value="<?php echo $_SESSION['lname1'];?>"></div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Designation <?php if($i_exb<=2){?> <span class="dips-required"> * </span> <?php } ?></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="desig<?php echo $i_exb;?>" id="desig<?php echo $i_exb;?>" maxlength="249" <?php if($i_exb<=2){?>required<?php } ?> value="<?php echo $_SESSION['desig1'];?>"/>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Mobile No <?php if($i_exb<=2){?> <span class="dips-required"> * </span> <?php } ?></label>
											<div class="col-md-6">
												<input type="number" class="form-control" name="mob<?php echo $i_exb;?>" id="mob<?php echo $i_exb;?>" maxlength="12" <?php if($i_exb<=2){?>required<?php } ?> value="<?php echo $_SESSION['mob1'];?>"/>
											</div> 
										</div> 
	
										<?php /* ?><div class="form-group">
											<label class="control-label col-md-3"> Selected Category 
											</label>
											<div class="col-md-6">
												<span id="selectcata<?php echo $i_exb;?>" class="selectcata">-</span>
												<select id="del_category<?php echo $i_exb;?>" name="del_category<?php echo $i_exb;?>" class="form-control" <?php if($i_exb<=2){?>required<?php } ?>>
													<option value="">-- Select Category  --</option>
													<?php $cataList = array('Exhibitor'=>'Exhibitor', 'Delegate'=>'Delegate');
															//$countryList = array('Information Technology'=>'Information Technology');
															foreach ($cataList as $key=>$value) {
																echo '<option value="' . $key . '">' . $value . '</option>'; 
															}
														?>
												</select>
												<input name="del_category<?php echo $i_exb;?>" type="hidden" id="del_category<?php echo $i_exb;?>" class="del_category" />
											</div>
										</div> <?php */ ?>
	
									 	<?php /* ?><div class="form-group">
											<label class="col-md-3 control-label">Department <?php if($i_exb<=2){?> <span class="dips-required"> * </span> <?php } ?></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="dept<?php echo $i_exb;?>" id="dept<?php echo $i_exb;?>" maxlength="249" <?php if($i_exb<=2){?>required<?php } ?> />
											</div> 
										</div> <?php */ ?>
										<div class="form-group">
											<label class="col-md-3 control-label">Email Address <?php if($i_exb<=2){?> <span class="dips-required"> * </span> <?php } ?></label>
											<div class="col-md-6">
												<input type="email" class="form-control" name="email<?php echo $i_exb;?>" id="email<?php echo $i_exb;?>" <?php if($i_exb<=2){?>required<?php } ?> value="<?php echo $_SESSION['email1'];?>"/>
											</div>
										</div>
									<?php  } ?> 
									<div class="form-group">
										<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>
										<div class="col-md-6">
											<div class="input-group">
												<input name="vercode_ex" type="text" class="form-control" id="vercode_ex" maxlength="10" required autocomplete="off"/>
												<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_ex"];?>" />
												<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercode_ex"];?></span>
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
				<?php } else {?>
				<h1>This link is either invalid or exired. Please use correct link.</h1>
				<?php }/*Online registration for <?php echo $EVENT_NAME . ' ' . $EVENT_YEAR;?> is closed.*/?>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/reg_form_footer.php';?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript">var assoc_name = '<?php echo $assoc_name;?>';</script>   
<script>
	jQuery(document).ready(function() {  
		Registration.init('registration_form_1', 0);
	});

	function validate_ex2() {
		var total_exbhitors = 1;	
		for(var j=1;j<=total_exbhitors;j++)
		{
			if(document.getElementById("title"+j).value == "")
			{
				alert("Please fill exhibitor title ");
				document.getElementById("title"+j).focus();
				return false;
				
			}
			
			if(document.getElementById("fname"+j).value == "")
			{
				alert("Please fill exhibitor first name");
				document.getElementById("fname"+j).focus();
				return false;
				
				/*nt_fill_cnt++;
				continue;*/
			}
			if(document.getElementById("lname"+j).value == "")
			{
				alert("Please fill exhibitor last name");
				document.getElementById("lname"+j).focus();
				return false;
				
				/*nt_fill_cnt++;
				continue;*/
			}
			if(document.getElementById("desig"+j).value == "")
			{
				alert("Please fill exhibitor Designation");
				document.getElementById("desig"+j).focus();
				return false;
				
				/*nt_fill_cnt++;
				continue;*/
			}
			if(document.getElementById("mob"+j).value == "")
			{
				
				alert("Please fill exhibitor Mobile Number");
				document.getElementById("mob"+j).focus();
				return false;
				
			}
			/*if(document.getElementById("dept"+j).value == "")
			{
				
				alert("Please fill exhibitor ""'s department name");
				document.getElementById("dept"+j).focus();
				return false;
				
			}*/
			if(document.getElementById("email"+j).value == "")
			{
				
				alert("Please fill exhibitor Email address");
				document.getElementById("email"+j).focus();
				return false;
				
				/*nt_fill_cnt++;
				continue;*/
			} else if(document.getElementById("email"+j).value != "") {
				var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				var toArr= document.getElementById("email"+j).value.split(","); 			//split into array
				for (var i=0;i<toArr.length;i++) 				    					//loop array to validate correct address
				{
					if ( !toArr[i].match(reg) ) 										//if not match, alert and stop loop
					{	
						alert("invalid email address \n"+toArr[i]);
						document.getElementById("email"+j).focus();
						return false;
					}
				}
			}

			if (document.getElementById("vercode_ex").value == "") {
				alert("Please fill the characters you see in image.");
				document.getElementById("vercode_ex").focus();
				return false;
			} else if (document.getElementById("vercode_ex").value != "") {
				compstr = document.getElementById("test").value;
				if (document.getElementById("vercode_ex").value != compstr) {
					alert("Please fill correct characters you see in image.");
					document.getElementById("vercode_ex").value = "";
					document.getElementById("vercode_ex").focus();
					return false;
				}
			}	
			
		}
	}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
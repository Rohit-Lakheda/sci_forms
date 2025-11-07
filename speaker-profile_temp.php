<?php
	session_start();
	require("includes/form_constants_both.php");
	
	require "dbcon_open.php";
	require "get_user_no.php";
	do
	{
		$i = 0;
		$text = get_rand_id(6);
		$_SESSION["vercode_sp"] = $text;
	
		$chq_qr_demo = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_SPEAKER_PROFILE." WHERE reg_id = '$text'")or die(mysqli_error($link));
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
					<span class="caption-subject font-red bold uppercase"> Speakers Profile Form
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="speaker-profile2.php" class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1" enctype="multipart/form-data" method="post" onsubmit="return validate_reg_registration_form_1();">
					<?php /*<input name="vercode" type="hidden" id="vercode" value="<?php echo $_SESSION['vercode_sp'];?>"/>
                    <input name="speaker_addr1" type="hidden"  id="addr1" value="" />
        			<input name="speaker_addr2" type="hidden" id="addr2" value="" />
        			<input name="speaker_state" type="hidden"  id="state" value="" />
        			<input name="speaker_pin" type="hidden"  id="pin" value="" />*/?>
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
									<h3 class="block">Provide Speaker Information</h3>
									
                                    <div class="form-group">
                                    	<label class="control-label col-md-3"> Profile  <span class="required"> * </span>
                                    	</label>
                                    	<div class="col-md-6">
                                    		<textarea rows="3" cols="" class="form-control" name="shrt_bgrphy_fl" id="shrt_bgrphy_fl" required></textarea>
                                    		<span class="help-block">Total word count: <span id="display_count">0</span> words. Words left: <span id="word_left">80</span></span>
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
<?php require 'includes/reg_form_footer.php';
//<script src="js/speaker.js?sdf"></script>
?>
	

	<script>
		jQuery(document).ready(function() {  
			Registration.init('reg_registration_form_1', 0);
		});

		var maxWords = 80;
		//jQuery('#shrt_bgrphy_fl').keypress(function() {
		/*jQuery('#shrt_bgrphy_fl').on('keydown', function(e){
		    var $this, wordcount;
		    $this = $(this);
		   // wordcount = $this.val().split(/\b[\s,\.-:;]--add /* in reverse by removing doble dash to double dash inclding dash--).length;
		    if (wordcount > maxWords) {//alert('ok24234');
		        jQuery("#display_count").text("" + maxWords);
		        alert("You've reached the maximum allowed words.");
		        return false;
		    } else {//alert('ok');
		    	jQuery("#word_left").text((maxWords - wordcount));
		        return jQuery("#display_count").text(wordcount);
		    }
		});*/

		//jQuery('#shrt_bgrphy_fl').change(function() {
		jQuery('#shrt_bgrphy_fl').on('change', function(e){
		    var words = $(this).val().split(/\b[\s,\.-:;]*/);
		    // console.log(words.length);
		    if (words.length > maxWords) {
		        //words.splice(maxWords);
		        //$(this).val(words.join(""));
		   // alert("You've reached the maximum allowed words. Extra words removed.");
		    }
		    // console.log(words.length);
		});	


function validate_reg_registration_form_1() {

	var maxcharlen1 = 750;
	var profileCnt = 0;
	var profiletxt = "x";
	profiletxt = document.getElementById("shrt_bgrphy_fl").value;
	profileCnt = profiletxt.length;
	alert("e:"+profileCnt+" , limit:"+maxcharlen1);
	if(profileCnt>maxcharlen1){
		alert("Please enter Profile less than "+maxcharlen1+" characters, Current profile length is "+profileCnt+" charactes");
        document.getElementById("shrt_bgrphy_fl").focus();
		return false;
	}



/*var profileCnt = wordcount = document.getElementById("shrt_bgrphy_fl").val().length();
if(profileCnt>maxWords1){
	alert("Please enter Profile less than "+maxWords1+" words, Current profile length is "+profileCnt+" words");
	document.getElementById("shrt_bgrphy_fl").focus();
	return false;
}


if(document.getElementById("shrt_bgrphy_fl").value == "") {
	alert("Please enter Profile.");
	document.getElementById("shrt_bgrphy_fl").focus();
	return false;
}
var maxWords1 = 80;
var profileCnt = wordcount = document.getElementById("shrt_bgrphy_fl").val().length;
if(profileCnt>maxWords1){
	alert("Please enter Profile less than "+maxWords1+" words, Current profile length is "+profileCnt+" words");
	document.getElementById("shrt_bgrphy_fl").focus();
	return false;
}
alert("e:"+profileCnt+" , limit:"+maxWords1);

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

*/
/*	if(document.getElementById("g-recaptcha-response").value == "") {
	alert("Please re-enter your reCAPTCHA.");
	return false;
}
*/
//document.getElementById("reg_registration_form_1").submit();
return false;
return true;
}

	</script>

</body>
</html>
<?php 
echo "<script language='javascript'>window.location = 'https://www.bengalurutechsummit.com/web/it_forms/enquiry.php';</script>";
      exit; 
   require "includes/form_constants_both.php";
   require "contest_captcha.php";
   
   $delegate_type = @$_GET ['dele_typ'];
   $event_name = 'Bangalore IT';
   if(isset($_GET['en']) && !empty($_GET['en'])) {
   	$event_name = 'Bangalore INDIA BIO';
   }
   ?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />'; 
   require 'includes/reg_form_header.php';?>
<div class="row">
   <div class="col-md-12">
      <div class="portlet light bordered" id="contest_form1">
         <div class="portlet-title">
            <div class="caption">
               <i class=" icon-layers font-red"></i>
               <span class="caption-subject font-red bold uppercase"> Free Delegate Contest Form
               </span>
            </div>
         </div>
         <div class="portlet-body form">
            <form action="free-contest2.php" class="form-horizontal" id="cont" name="cont" method="post" onsubmit="return validate_registration();">
               <input type="hidden" name="event_name" value="<?php echo $event_name;?>"/>
               <div class="form-wizard">
                  <div class="form-body">
                     <ul class="nav nav-pills nav-justified steps">
                        <li class="active">
                           <a class="step">
                           <span class="number"> 1 </span>
                           <span class="desc">
                           <i class="fa fa-check"></i>Personal Details</span>
                           </a>
                        </li>
                        <li>
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
                           <div class="form-group">
                              <label class="control-label col-md-3">Name <span class="dips-required"> * </span></label>
                              <div class="col-md-2">
                                 <select class="form-control" name="title" id="title" required="required">
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
                              <div class="col-md-4"><input type="text" class="form-control" placeholder="Name" name="name" type="text" id="name" maxlength="100" onkeyup="check_char(event,'name');" required="required"></div>
                           </div>
                          <!--  <div class="form-group">
                              <label class="col-md-3 control-label">Organisation <span class="dips-required"> * </span></label>
                              <div class="col-md-6">
                                 <input class="form-control" name="company" type="text" id="company" required="required"/>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-3 control-label">Designation <span class="dips-required"> * </span></label>
                              <div class="col-md-6">
                                 <input class="form-control" name="desig" type="text" id="desig" required="required"/>
                              </div>
                           </div> -->
                           <div class="form-group">
                              <label class="col-md-3 control-label">Email Address <span class="dips-required"> * </span></label>
                              <div class="col-md-6">
                                 <input class="form-control" name="email" type="email" id="email" required="required"/>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-3 control-label">Contact Number </label>
                              <div class="col-md-6" style="margin-top: -20px;">
                                 <span type="tel" id="mobile-country-code" data-fax-iso-code-hidden-field-name="foneCountryCode"></span>
                                 <input type="hidden" name="foneCountryCode" id="foneCountryCode" />
                                 <input type="hidden" id="foneCountryCodeIso" name="foneCountryCodeIso"/>
                                 <input class="form-control" name="fone" type="text" id="fone" maxlength="10" onkeyup="check_num(event, 'fone');"  style="padding-left: 92px;"/>
                              </div>
                           </div>
                          
                           <?php /*?>
                           <div class="group form-group">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                 <input name="state" type="text" id="state" maxlength="100" value="<?php echo $qr_gt_user_data_ans_row['state'];?>" required onkeyup="check_char(event,'state')" />
                                 <span class="highlight "></span> 
                                 <span class="bar "></span> 
                                 <label class="md-textbox-lable">&nbsp;&nbsp;State<span class="dips-required"> * </span></label>
                              </div>
                           </div>
                           <div class="group form-group">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                 <input name="pin" type="text" id="pin" maxlength="20"  value="<?php echo $qr_gt_user_data_ans_row['pin'];?>" required  />
                                 <span class="highlight "></span> 
                                 <span class="bar "></span> 
                                 <label class="md-textbox-lable">&nbsp;&nbsp;Postal Code<span class="dips-required"> * </span></label>
                              </div>
                           </div>
                           <?php */?>
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label">Enter text seen in the image <span class="dips-required"> * </span></label>
                           <div class="col-md-6">
                              <div class="input-group">
                                 <input name="vercode" type="text" class="form-control" id="vercode" maxlength="10" required autocomplete="off"/>
                                 <input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_enq"];?>" />
                                 <span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercode_enq"];?></span>
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
         </div>
      </div>
   </div>
</div>
<?php require 'includes/reg_form_footer.php';?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>
<script>
   jQuery(document).ready(function() {  
   	Registration.init('contest_form1', 0);
   	$("#mobile-country-code").intlTelInput();
   });

   function validate_registration(){
		
		if(document.getElementById("title").value == "") {
			alert("Please select the Title");
			document.getElementById("title").focus();
			return false;
		}
		if(document.getElementById("name").value == "") {
			alert("Please enter name");
			document.getElementById("name").focus();
			return false;
		}
		
		
		if(document.getElementById("email").value == "") {
			alert("Please enter email");
			document.getElementById("email").focus();
			return false;
		}
		if(document.getElementById("fone").value == "") {
			alert("Please enter Mobile Number ");
			document.getElementById("fone").focus();
			return false;
		}
		
		if (document.getElementById("vercode").value == "") {
	        alert("Please fill the characters you see in image.");
	        document.getElementById("vercode").focus();
	        return false;
	    } else if (document.getElementById("vercode").value != "") {
	        compstr = document.getElementById("test").value;
	        if (document.getElementById("vercode").value != compstr) {
	            alert("Please fill correct characters you see in image.");
	            document.getElementById("vercode").value = "";
	            document.getElementById("vercode").focus();
	            return false;
	        }
	    }
	 	//document.reg_registration_form_3.submit();
	 	return true;
	}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
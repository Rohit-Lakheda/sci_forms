<?php
  session_start();
  //$_SESSION["vercode_reg"] = '24TNJ6';
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
  		echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?en=$en&assoc_name=$assoc_name';</script>";
  	} else {
  		echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?en=$en';</script>";
  	}
  	exit; 
  }
  require("includes/form_constants_both.php");
  require "dbcon_open.php";
  $reg_id = $_SESSION['vercode_reg'];
  
  $qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
  if(isset($_GET['id']) && !empty($_GET['id'])) {
  	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE tin_no = '" . $_GET['id'] . "'");
  }
  $qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
  if( ($qr_gt_user_data_ans_no<=0) || ($qr_gt_user_data_ans_no=="") ){
  	session_destroy();
  	echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
  	if(!empty($assoc_name)) {
  		echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?en=$en&assoc_name=$assoc_name';</script>";
  	} else {
  		echo "<script language='javascript'>window.location = 'registration-assoc-comp.php?en=$en';</script>";
  	}
  	exit; 
  }	
  
  $qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
  $qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
  
  if($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
  	$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
  } else {
  	$total_amt = $qr_gt_user_data_ans_row['total'];
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
$category = $qr_gt_user_data_ans_row['cata'];
 /* if(!empty($qr_gt_user_data_ans_row['org_reg_type']) && $qr_gt_user_data_ans_row['org_reg_type'] == 'Student'){
    $category = 'Limited Access';
  }else{
    $category = 'All Access';
  }*/
  ?>
<?php require 'includes/reg_form_header.php';?>
<div class="row">
  <div class="col-md-12">
    <div class="portlet light bordered" id="registration_form_4">
      <div class="portlet-title">
        <div class="caption">
          <i class=" icon-layers font-red"></i>
          <span class="caption-subject font-red bold uppercase"> Complimentary Delegate Registration Form
          </span>
        </div>
      </div>
      <div class="portlet-body form">
        <form action="registration-assoc-comp4.php?a=<?php echo $a;?>" class="form-horizontal" name="reg_registration_form_4" id="reg_registration_form_4" method="post" onsubmit="return validate_registration_form_4()">
          <input name="en" type="hidden" id="en" value="<?php echo $en;?>"/>
          <div class="form-wizard">
            <div class="form-body">
              <ul class="nav nav-pills nav-justified steps">
                <li class="done">
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
				<li class="active">
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
              <div class="tab-content">
                <div class="tab-pane active">
                  <h3 class="block">Confirm Registration Detail</h3>
                  <div class="row">
                    <div class="col-md-12">
                      <!-- BEGIN Registration Category TABLE PORTLET-->
                      <div class="portlet light bordered">
                        <div class="portlet-title">
                          <div class="caption">
                            <i class="fa fa-info-circle font-dark"></i>
                            <span class="caption-subject">Registration Category</span>
                          </div>
                        </div>
                        <div class="portlet-body">
                          <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover">
                              <tbody>
                                <tr>
                                  <td> <strong>Sector</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['sector']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Conference Type</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['conference_type']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Category</strong> </td>
                                  <td> <?php echo $category; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Delegate Type</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['org_reg_type']; ?> </td>
                                </tr>
                                <?php if($qr_gt_user_data_ans_row['gr_type'] != 'Single') {?>
                                <tr>
                                  <td> <strong>Total Delegate(s)</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['sub_delegates']; ?> </td>
                                </tr>
                                <?php }?>
                                <?php if($qr_gt_user_data_ans_row['event_know'] != '') {?>
                                <tr>
                                  <td> <strong>How do you know about Event</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['event_know']; ?> </td>
                                </tr>
                                <?php }/*?>
                                
                                <tr>
                                  <td> <strong>Organization Type</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['nationality']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Single/ Group Delegate(s)</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['gr_type']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Payment Mode</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['paymode']; ?> </td>
                                </tr>
                                <?php if(($qr_gt_user_data_ans_row['assoc_name'] != 'Faculty' && $qr_gt_user_data_ans_row['assoc_name'] != 'Program-Coordinators') && $qr_gt_user_data_ans_row['member_of_assoc'] != '') {?>
                                <tr>
                                  <td> <strong>Are you member of Genotypic Techchnology</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['member_of_assoc']; ?> </td>
                                </tr>
                                <?php }*/?>
                                <?php if($qr_gt_user_data_ans_row['user_type'] != '') {?>
                                <tr>
                                  <td> <strong>Association Name</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['user_type']; ?></td>
                                </tr>
                                <?php }?>
                                <tr>
                                  <td> <strong>Organisation Name</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['org']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>City</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['city']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Country</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['country']; ?> </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          
                        </div>
                      </div>
                      <!-- END Registration Category TABLE PORTLET-->
                    </div>
                  </div>
                  <?php /*?><div class="row">
                    <div class="col-md-12">
                      <!-- BEGIN Organisation Information TABLE PORTLET-->
                      <div class="portlet light bordered">
                        <div class="portlet-title">
                          <div class="caption">
                            <i class="fa fa-info-circle font-dark"></i>
                            <span class="caption-subject">Organisation Information</span>
                          </div>
                        </div>
                        <div class="portlet-body">
                          <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover">
                              <tbody>
                                <tr>
                                  <td> <strong>Organisation Name</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['org']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Nature Of Business</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['nature']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Address 1</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['addr1']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Address 2</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['addr2']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>City</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['city']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>State</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['state']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Postal Code</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['pin']; ?> </td>
                                </tr>
                                <?php /*<tr>
                                  <td> <strong>GST Number</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['gst_number']; ?> </td>
                                </tr>?>
                                <tr>
                                  <td> <strong>Country</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['country']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Telephone Number</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['fone']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Fax Number</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['fax']; ?> </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- END Organisation Information TABLE PORTLET-->
                    </div>
                  </div>
                  <?php *//*if(!empty($qr_gt_user_data_ans_row['user_type'])) {?>
                  <div class="row">
                    <div class="col-md-12">
                      <!-- BEGIN Organisation Information TABLE PORTLET-->
                      <div class="portlet light bordered">
                        <div class="portlet-title">
                          <div class="caption">
                            <i class="fa fa-info-circle font-dark"></i>
                            <span class="caption-subject">Special Offer</span>
                          </div>
                        </div>
                        <div class="portlet-body">
                          <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover">
                              <tbody>
                                <tr>
                                  <td style='color: rgb(103, 144, 231);'><strong><?php echo $qr_gt_user_data_ans_row['user_type']; ?></strong></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- END Organisation Information TABLE PORTLET-->
                    </div>
                  </div>
                  <?php }*/?>
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
                                    Email Address
                                  </th>
                                  <th>
                                    Mobile Number
                                  </th>
                                  <?php /* ?><th>
                                    Category 
                                  </th>
                                  <th>
                                    Amount (<?php echo $qr_gt_user_data_ans_row['amt_ext'];?>) 
                                  </th><?php */?>
                                </tr>
                              </thead>
                              <tbody>
                                <?php for($i=1; $i<=$qr_gt_user_data_ans_row['sub_delegates']; $i++) { ?>
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
                                    <?php echo $qr_gt_user_data_ans_row['email'.$i]; ?>
                                  </td>
                                  <td>
                                    <?php echo $qr_gt_user_data_ans_row['cellno'.$i]; ?>
                                  </td>
                                  <?php /*?><td>
                                    <?php echo $qr_gt_user_data_ans_row['cata'.$i]; ?>
                                  </td>
                                  <td>
                                    <?php echo $qr_gt_user_data_ans_row['amt'.$i]; ?>
                                  </td><?php */?>
                                </tr>
                                <?php }?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php /*<div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      <div class="well">
                        <div class="row static-info align-reverse">
                          <div class="col-md-8 name">
                            Selection Amount:
                          </div>
                          <div class="col-md-4 value">
                            <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['selection_amt']; ?>
                          </div>
                        </div>
                        <?php if( ($qr_gt_user_data_ans_row['admin_discount'] != "") && ($qr_gt_user_data_ans_row['admin_discount'] >0) ) {?>
                        <div class="row static-info align-reverse">
                          <div class="col-md-8 name">
                            Admin Discount @ <?php echo $qr_gt_user_data_ans_row['adminDiscountPer'];?>%:
                          </div>
                          <div class="col-md-4 value">
                            <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['admin_discount']; ?>
                          </div>
                        </div>
                        <?php } ?>

 					<?php if( ($qr_gt_user_data_ans_row['gr_discount'] != "") && ($qr_gt_user_data_ans_row['gr_discount'] >0) ) {?>
                        <div class="row static-info align-reverse">
                          <div class="col-md-8 name">
                            Group Discount @ 10%:
                          </div>
                          <div class="col-md-4 value">
                            <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['gr_discount']; ?>
                          </div>
                        </div>
                        <?php } ?>

                        <?php if( ($qr_gt_user_data_ans_row['membership_discount'] != "") && ($qr_gt_user_data_ans_row['membership_discount'] >0) ) {?>
                        <div class="row static-info align-reverse">
                          <div class="col-md-8 name">
                            Membership Discount @ <?php echo $qr_gt_user_data_ans_row['membershipDiscountPer'];?>%:
                          </div>
                          <div class="col-md-4 value">
                            <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['membership_discount']; ?>
                          </div>
                        </div>
                        <?php } ?>
                        <?php if( ($qr_gt_user_data_ans_row['tax'] != "") && ($qr_gt_user_data_ans_row['tax'] >0) ) {?>
                        <div class="row static-info align-reverse">
                          <div class="col-md-8 name">
                            GST @ <?php echo $SERVICE_TAX; ?>%:
                          </div>
                          <div class="col-md-4 value">
                            <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['tax']; ?>
                          </div>
                        </div>
                        <?php } ?>
                        <?php if( ($qr_gt_user_data_ans_row['processing_charge'] != "") && ($qr_gt_user_data_ans_row['processing_charge'] >0) ) {?>
                        <div class="row static-info align-reverse">
                          <div class="col-md-8 name">
                            Processing Charges :
                          </div>
                          <div class="col-md-4 value">
                            <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' .$qr_gt_user_data_ans_row['processing_charge'] ; ?>
                          </div>
                        </div>
                        <?php } ?>
                        <?php if( ($qr_gt_user_data_ans_row['total'] != "") && ($qr_gt_user_data_ans_row['total'] >0) ) {?>
                        <div class="row static-info align-reverse">
                          <div class="col-md-8 name">
                            Total (Including Processing Charges):
                          </div>
                          <div class="col-md-4 value">
                            <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['total']; ?>
                          </div>
                        </div>
                        <?php } ?>
                        <?php if(!empty($total_amt)) { ?>
                        <div class="row static-info align-reverse">
                          <div class="col-md-8 name">
                            Total Amount Payable in INR(Including Processing Charges):
                          </div>
                          <div class="col-md-4 value">
                            <?php echo 'INR ' . $total_amt; ?>
                          </div>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>*/?>
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
                  <i class="fa fa-angle-left"></i> Back </a>
                  <?php if($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Paypal' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {?>
                  <button class="btn sbold uppercase green-jungle" type="submit" name="make_payment" value="1">
                  Make Payment&nbsp;&nbsp;<i class="fa fa-inr m-icon-white"></i>
                  </button>
                  <?php } else {?>
                  <button class="btn sbold uppercase green-jungle" type="submit" name="make_payment" value="0">
                  Continue <i class="m-icon-swapright m-icon-white"></i>
                  </button>
                  <?php } ?>
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
  	Registration.init('registration_form_4', 1);
  });
  
  function go_back() {
  	window.location=('registration-assoc-comp.php?ret=retds4fu324rn_ed24d3it&?en=<?php echo $en;?>&a=<?php echo $a;?>');
  }
  
  function validate_registration_form_4() {
  	if((document.getElementById("agree").checked == false)) {
  		alert('Please accept terms and conditions');
  		document.getElementById("agree").focus();
          return false;
  	}
  	return true;
  }
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
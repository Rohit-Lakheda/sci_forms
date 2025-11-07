<?php
  session_start();
  //$_SESSION["vercode_reg"] = '24TNJ6';
  $tin_no = @$_GET['id'];
  if(empty($tin_no)) {
  	if((!isset($_SESSION["vercode_reg"]))||($_SESSION["vercode_reg"]==''))
  	{
  		session_destroy();
  		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
  		echo "<script language='javascript'>window.location=('registration-assoc-conf.php');</script>";
  		echo "<script language='javascript'>document.location=('registration-assoc-conf.php');</script>";
  		exit;
  	}
  }
  
  require("includes/form_constants_both.php");
  require "dbcon_open.php";
  
  $reg_id = @$_SESSION["vercode_reg"];
  $assoc_code = @$_GET['a'];
	$tin_no = @$_GET['id'];
  if($assoc_code == 'XH68IZQ') {
    $qr_gt_user_data_id      = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_EXHIBITOR_ON_SPOT . " WHERE tin_no = '$tin_no'");
    $qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
    $qr_gt_user_data_ans_row = mysqli_fetch_assoc($qr_gt_user_data_id);
  } else {
    //$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE tin_no = '$tin_no' AND reg_id='$reg_id'");
    $qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE tin_no = '$tin_no'");
    $qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
    $qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
  }
  if( ($qr_gt_user_data_ans_no<=0) || ($qr_gt_user_data_ans_no=="") ){
  	session_destroy();
  	echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
  	echo "<script language='javascript'>window.location=('registration-assoc-conf-vip.php?a=$assoc_code');</script>";
  	echo "<script language='javascript'>document.location=('registration-assoc-conf-vip.php?a=$assoc_code');</script>";
  	exit;
  }
  if($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {
  	if($qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {
  		//echo "<script language='javascript'>alert('Please make the payment.');</script>";
  		//echo "<script language='javascript'>window.location = ('$EVENT_OL_PAY_ACT_LINK?id=" . $tin_no . "');</script>";
  		//exit;
  	}
  }
  if($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
  	$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
  } else {
  	$total_amt = $qr_gt_user_data_ans_row['total'];
  }
  if(!empty($qr_gt_user_data_ans_row['user_type']) && !empty($qr_gt_user_data_ans_row['assoc_srno'])) {
  	$assoc_name = $qr_gt_user_data_ans_row['user_type'];
  	$assoc_srno = $qr_gt_user_data_ans_row['assoc_srno'];
  	$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_PROMO_CODE_TBL . " WHERE srno='$assoc_srno' AND assoc_name='$assoc_name'");
  		
  	if(mysqli_num_rows($qry)) {
  		$discountDetail = $result = mysqli_fetch_assoc($qry);
  		$a = $result['promo_code'];
  	}
  }
  $category = '-';
  /*if(!empty($qr_gt_user_data_ans_row['org_reg_type']) && $qr_gt_user_data_ans_row['org_reg_type'] == 'Student'){
    $category = 'Limited Access';
  }else{
    $category = 'All Access';
  }*/
  session_destroy();
  ?>
<?php require 'includes/reg_form_header.php';?>
<div class="row">
  <div class="col-md-12">
    <div class="portlet light bordered" id="registration_form_4">
      <div class="portlet-title">
        <div class="caption">
          <i class=" icon-layers font-red"></i>
          <span class="caption-subject font-red bold uppercase"> 
            <?php if(empty($discountDetail['form_title'])) {?>
              Complimentary delegate registration form
            <?php } else {?>
              <?php echo $discountDetail['form_title'];?>
            <?php } ?>
          </span>
        </div>
      </div>
      <div class="portlet-body form">
        <form action="" class="form-horizontal" name="reg_registration_form_4" id="reg_registration_form_4" method="post" onsubmit="return validate_registration_form_4()">
          <div class="form-wizard">
            <div class="form-body">
              <ul class="nav nav-pills nav-justified steps">
                <?php /*<li class="done">
                  <a class="step dips-default-cursor">
                  <span class="number"> 1 </span>
                  <span class="desc">
                  <i class="fa fa-check"></i> Registration Category </span>
                  </a>
                </li>*/?>
                <li class="done">
                  <a data-toggle="tab" class="step dips-default-cursor">
                  <span class="number"> 1 </span>
                  <span class="desc">
                  <i class="fa fa-check"></i> Delegate Information </span>
                  </a>
                </li>
                <li class="done">
                  <a data-toggle="tab" class="step">
                  <span class="number"> 2 </span>
                  <span class="desc">
                  <i class="fa fa-check"></i> Confirm </span>
                  </a>
                </li>
                <li class="done">
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
                  <h3 class="block">Registration Detail</h3>
                  <div class="row hide">
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
                            <table class="table table-striped table-bordered table-hover hide">
                              <tbody>
                                <tr>
                                  <td> <strong>Sector</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['sector']; ?> </td>
                                </tr>
                                <?php /*<tr>
                                  <td> <strong>Conference Type</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['conference_type']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Category</strong> </td>
                                  <td> <?php echo $category; ?> </td>
                                </tr>*/?>
                                <tr>
                                  <td> <strong>Organization Type</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['nationality']; ?> </td>
                                </tr>
                                <?php /*<tr>
                                  <td> <strong>Delegate Type</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['org_reg_type']; ?> </td>
                                </tr>*/?>
                                <tr>
                                  <td> <strong>Single/ Group Delegate(s)</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['gr_type']; ?> </td>
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
                                <?php }?>
                                <?php if(!empty($qr_gt_user_data_ans_row['paymode'])) {?>
                                <tr>
                                  <td> <strong>Payment Mode</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['paymode']; ?> </td>
                                </tr>
                                <?php }/*if(($qr_gt_user_data_ans_row['assoc_name'] != 'Faculty' && $qr_gt_user_data_ans_row['assoc_name'] != 'Program-Coordinators') && $qr_gt_user_data_ans_row['member_of_assoc'] != '') {?>
                                <tr>
                                  <td> <strong>Are you member of Genotypic Techchnology</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['member_of_assoc']; ?> </td>
                                </tr>
                                <?php }*/?>
                                <?php if($qr_gt_user_data_ans_row['assoc_name'] != '') {?>
                                <tr>
                                  <td> <strong>Association Name</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['assoc_name']; ?>
								  <?php if(($qr_gt_user_data_ans_row['assoc_name'] == 'Faculty' || $qr_gt_user_data_ans_row['assoc_name'] == 'Program-Coordinators' || $qr_gt_user_data_ans_row['assoc_name'] == 'Student-Coordinator') && $qr_gt_user_data_ans_row['member_of_assoc'] != '') { echo ': ' . $qr_gt_user_data_ans_row['member_of_assoc'];}?></td>
                                </tr>
                                <?php }?>
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
                      <!-- BEGIN Organisation Information TABLE PORTLET-->
                      <div class="portlet light bordered">
                        <div class="portlet-title">
                          <div class="caption">
                            <i class="fa fa-info-circle font-dark"></i>
                            <span class="caption-subject">Information</span>
                          </div>
                        </div>
                        <div class="portlet-body">
                          <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover">
                              <tbody>
                              <?php /*<tr>
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
                                  </tr>*/ $i=1; ?>
                                <?php if($qr_gt_user_data_ans_row['assoc_srno'] != 74) {?>
                                  <tr>
                                    <td> <strong>Association Name</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['user_type']; ?> </td>
                                  </tr>
                                  <tr>
                                    <td> <strong>Sector</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['sector']; ?> </td>
                                  </tr>
                                <?php }?>
                                <tr>
                                  <td> <strong>Name</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['title'.$i]." ".$qr_gt_user_data_ans_row['fname'.$i]." ".$qr_gt_user_data_ans_row['lname'.$i]; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Organisation Name</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['org']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Job Title</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['job_title'.$i]; ?> </td>
                                </tr>
                                
                                <tr>
                                  <td> <strong>Email Address</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['email'.$i]; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Mobile Number</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['cellno'.$i]; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Delegate Category</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['cata'.$i]; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Country</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['country']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>City</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['city']; ?> </td>
                                </tr>
                                <?php /*
                                <tr>
                                  <td> <strong>State</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['state']; ?> </td>
                                </tr><tr>
                                  <td> <strong>Postal Code</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['pin']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>GST Number</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['gst_number']; ?> </td>
                                  </tr>*/?>
                                <tr>
                                  <td> <strong>Country</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['country']; ?> </td>
                                </tr>
                                <?php /*<tr>
                                  <td> <strong>Telephone Number</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['fone']; ?> </td>
                                </tr>
                               <tr>
                                  <td> <strong>Fax Number</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['fax']; ?> </td>
                                  </tr>*/?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- END Organisation Information TABLE PORTLET-->
                    </div>
                  </div>
                  <?php /*if(!empty($qr_gt_user_data_ans_row['user_type'])) {?>
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
                  <div class="row hide">
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
                                  <th>
                                    Delegate Category 
                                  </th>
                                  <th>
                                    Amount
                                  </th>
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
                                  <td>
                                    <?php echo $qr_gt_user_data_ans_row['cata'.$i]; ?>
                                  </td>
                                  <td>
                                    <?php echo $qr_gt_user_data_ans_row['amt'.$i]; ?>
                                  </td>
                                </tr>
                                <?php }?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php if(!empty($qr_gt_user_data_ans_row['selection_amt'])) {?>
                  <div class="row">
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
                  </div>
                  <?php }?>
                  <?php if(($assoc_code == 'XH68IZQ') || ($assoc_code =='NAINClgChdrExb3D') ) {
                    }
                    else{
                      ?>
                    <div class="note note-danger">
                      <h4 class="block">Info!</h4>
                      <p>Please DO NOT print this page. This page print not accepted in event.
                        <br />You need to click on <strong>Print</strong> button OR <a class="alert-link" href="reg_pay_1.php?id=<?php echo $qr_gt_user_data_ans_row['tin_no'];?>&t=tejsp" target="_blank">Click here </a>to generate printable receipt.
                      </p>
                    </div>
                  <?php }?>
                </div>
              </div>
            </div>
            <div class="form-actions">
              <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  <?php if(($assoc_code == 'XH68IZQ') || ($assoc_code =='NAINClgChdrExb3D') ) {
                  }
                  else{
                    ?>
                   <a href="reg_pay_1.php?id=<?php echo $qr_gt_user_data_ans_row['tin_no'];?>&t=tejsp&is_reg=exhibitor" class="btn blue sbold uppercase green-jungle" type="submit" name="make_payment" value="1">
                    Print&nbsp;&nbsp;<i class="fa fa-print m-icon-white"></i>
                    </a>
                  <?php } /*else {?>
                    <a href="reg_pay_1.php?id=<?php echo $qr_gt_user_data_ans_row['tin_no'];?>&t=tejsp" class="btn blue sbold uppercase green-jungle" type="submit" name="make_payment" value="1">
                    Print&nbsp;&nbsp;<i class="fa fa-print m-icon-white"></i>
                    </a>
                  <?php }*/ ?>
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
  	Registration.init('registration_form_4', 4);
  });
  
  jQuery(document).bind("keyup keydown", function(e){
      if(e.ctrlKey && e.keyCode == 80){
          //alert('ok');
          //e.cancelBubble = true;
          //e.preventDefault();
      }
  });
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
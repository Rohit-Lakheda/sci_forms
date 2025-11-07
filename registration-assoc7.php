<?php
  session_start();
  //$_SESSION["vercode_reg"] = '24TNJ6';
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
  if(isset($_GET['id']) && !empty($_GET['id'])) {
  	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE tin_no = '" . $_GET['id'] . "'");
  }
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
$category = '-';
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
          <span class="caption-subject font-red bold uppercase"> premium delegate registration (Free)
          </span>
        </div>
      </div>
      <div class="portlet-body form">
        <form action="registration-assoc8.php?assoc_name=<?php echo $qr_gt_user_data_ans_row['assoc_name'];?>" class="form-horizontal" name="reg_registration_form_4" id="reg_registration_form_4" method="post" onsubmit="return validate_registration_form_4()">
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
                <li class="done">
                  <a data-toggle="tab" class="step dips-default-cursor">
                  <span class="number"> 2 </span>
                  <span class="desc">
                  <i class="fa fa-check"></i> Delegate Information </span>
                  </a>
                </li>
                <li class="active">
                  <a data-toggle="tab" class="step">
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
                          <div class="table-scrollable">
                            <?php if($qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") { ?>
                            <table class="table table-striped table-bordered table-hover">
                              <tbody>
                                <tr>
                                  <td colspan="2" class="success">Delegates are requested to Bank Transfer the registration fees to the following account</td>
                                </tr>
                                <?php if($qr_gt_user_data_ans_row['nationality'] == 'Indian Organization') {?>
                                <?php if($qr_gt_user_data_ans_row['sector'] == "Bio Technology") { ?>
                                <tr>
                                  <td>Account Name :</td>
                                  <td style="width: 828px;">MM ACTIV SCI TECH COMMUNICATIONS PVT. LTD.</td>
                                </tr>
                                <tr>
                                  <td>Account Type :</td>
                                  <td>Current Account</td>
                                </tr>
                                <tr>
                                  <td>Account Number :</td>
                                  <td>2827201001176</td>
                                </tr>
                                <tr>
                                  <td>Bank Name :</td>
                                  <td>Canara Bank K.S.F.C Complex Branch</td>
                                </tr>
                                <tr>
                                  <td>DP Code No. :</td>
                                  <td>2827</td>
                                </tr>
                                <tr>
                                  <td>Bank Address :</td>
                                  <td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
                                </tr>
                                <tr>
                                  <td>Bank IFSC Code :</td>
                                  <td>CNRB0002827</td>
                                </tr>
                                <tr>
                                  <td>Bank MICR Code :</td>
                                  <td>560015137</td>
                                </tr>
                                <?php /*<tr>
                                  <td>Account Name :</td>
                                  <td style="width: 828px;">Bengaluru INDIA BIO </td>
                                  </tr>
                                  <tr>
                                  <td>Account Type :</td>
                                  <td>Current Account</td>
                                  </tr>
                                  <tr>
                                  <td>Account Number :</td>
                                  <td>2827 201 001175</td>
                                  </tr>
                                  <tr>
                                  <td>Bank Name :</td>
                                  <td>Canara Bank K.S.F.C Complex Branch</td>
                                  </tr>
                                  <tr>
                                  <td>DP Code No. :</td>
                                  <td>2827</td>
                                  </tr>
                                  <tr>
                                  <td>Bank Address :</td>
                                  <td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
                                  </tr>
                                  <tr>
                                  <td>Bank IFSC Code :</td>
                                  <td>CNRB0002827</td>
                                  </tr>
                                  <tr>
                                  <td>Bank SWIFT Code :</td>
                                  <td>CNRBINBBLFD</td>
                                  </tr>
                                  <tr>
                                  <td>Bank MICR Code :</td>
                                  <td>560015137</td>
                                  </tr>*/?>
                                <tr>
                                  <td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>
                                </tr>
                                <?php } else {?>
                                <tr>
                                  <td>Account Name :</td>
                                  <td style="width: 828px;">MM ACTIV SCI TECH COMMUNICATIONS PVT. LTD.</td>
                                </tr>
                                <tr>
                                  <td>Account Type :</td>
                                  <td>Current Account</td>
                                </tr>
                                <tr>
                                  <td>Account Number :</td>
                                  <td>2827201001176</td>
                                </tr>
                                <tr>
                                  <td>Bank Name :</td>
                                  <td>Canara Bank K.S.F.C Complex Branch</td>
                                </tr>
                                <tr>
                                  <td>DP Code No. :</td>
                                  <td>2827</td>
                                </tr>
                                <tr>
                                  <td>Bank Address :</td>
                                  <td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
                                </tr>
                                <tr>
                                  <td>Bank IFSC Code :</td>
                                  <td>CNRB0002827</td>
                                </tr>
                                <tr>
                                  <td>Bank MICR Code :</td>
                                  <td>560015137</td>
                                </tr>
                                <?php /*<tr>
                                  <td><strong>Account Name</strong></td>
                                  <td>BANGALORE IT.BIZ </td>
                                  </tr>
                                  <tr>
                                  <td><strong>Account Type</strong></td>
                                  <td>Current Account</td>
                                  </tr>
                                  <tr>
                                  <td><strong>Account Number</strong></td>
                                  <td>2827201001190</td>
                                  </tr>
                                  <tr>
                                  <td><strong>Bank Name</strong></td>
                                  <td>Canara Bank K.S.F.C Complex Branch</td>
                                  </tr>
                                  <tr>
                                  <td><strong>DP Code No.</strong></td>
                                  <td>2827</td>
                                  </tr>
                                  <tr>
                                  <td><strong>Bank Address</strong></td>
                                  <td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
                                  </tr>
                                  <tr>
                                  <td><strong>Bank IFSC Code</strong></td>
                                  <td>CNRB0002827</td>
                                  </tr>
                                  <tr>
                                  <td><strong>Bank MICR Code</strong></td>
                                  <td>560015137</td>
                                  </tr>*/?>
                                <tr>
                                  <td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>
                                </tr>
                                <?php }} else {?>
                                <tr>
                                  <td><strong>Account Name</strong></td>
                                  <td>MM ACTIV SCI-TECH COMMUNICATIONS PVT.LTD.</td>
                                </tr>
                                <tr>
                                  <td><strong>Account Type</strong></td>
                                  <td>Current Account</td>
                                </tr>
                                <tr>
                                  <td><strong>Account Number</strong></td>
                                  <td>2827 241 000004</td>
                                </tr>
                                <tr>
                                  <td><strong>Bank Name</strong></td>
                                  <td>Canara Bank K.S.F.C Complex Branch</td>
                                </tr>
                                <tr>
                                  <td><strong>DP Code No.</strong></td>
                                  <td>2827</td>
                                </tr>
                                <tr>
                                  <td><strong>Bank Address</strong></td>
                                  <td>No.1/1, KSFC Bhavan, Thimmaiah Road, Millers Tank Bed, Bangalore - 560 052, INDIA.</td>
                                </tr>
                                <tr>
                                  <td><strong>Bank SWIFT Code</strong></td>
                                  <td>CNRBINBBLFD</td>
                                </tr>
                                <tr>
                                  <td><strong>Bank MICR Code</strong></td>
                                  <td>560015137</td>
                                </tr>
                                <tr>
                                  <td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>
                                </tr>
                                <?php }?>
                              </tbody>
                            </table>
                            <?php } else if(($qr_gt_user_data_ans_row['paymode'] == "Cheque")||($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD")) {?>
                            <table class="table well table-condensed table-striped">
                              <tbody>
                                <tr>
                                  <td style="border: medium none;"></td>
                                  <td style="border: medium none; width: 99%;">
                                    <?php if($qr_gt_user_data_ans_row['sector'] == "Bio Technology") { ?>
                                    <p>
                                      Please send your Cheque/DD in favour of BANGALORE INDIA BIO payable at Bengaluru, India.<br>
                                      Along with the copy of your registration receipt and send to<br>
                                      <strong>Address :</strong><br>#9, UNI Building,3rd Floor, <br> Thimmaiah Road, Millers Tank Bund, <br>Vasanthnagar, Bengaluru - 560 052, India<br>Tel:  +91.80.4113 1912/3<br>Website: <a href="http://www.bengaluruindiabio.in" target="_blank">www.bengaluruindiabio.in</a>
                                    </p>
                                    <?php } else {?>
                                    <p>
                                      Please send your Cheque/DD in favour of <?php echo $EVENT_CHEQUE_PAYBLE_AT_NAME;?> payable at <?php echo $EVENT_CHEQUE_PAYBLE_AT;?>.<br />
                                      Along with the copy of your registration receipt and send to<br />
                                      <strong>Address :</strong><br/><?php echo $EVENT_CHEQUE_PAYBLE_ADDRESS;?>
                                    <p>
                                      <?php }?>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <?php }
                              $OrderId = $qr_gt_user_data_ans_row['pg_paymentid'];
                              $tracking_id = $qr_gt_user_data_ans_row['pg_trackid'];
                              $bank_ref_no = $qr_gt_user_data_ans_row['pg_tranid'];
                              
                              $pg_result = explode('#', $qr_gt_user_data_ans_row['pg_result']);
                              $order_status = $payment_mode = $currency = '';
                              if(isset($pg_result[5])) {
                              	$order_status = $pg_result[5];
                              }
                              if(isset($pg_result[0])) {
                              	$payment_mode = $pg_result[0];
                              }
                              if(isset($pg_result[4])) {
                              	$currency = $pg_result[4];
                              }
                              $Amount = $qr_gt_user_data_ans_row['pg_amt'];
                              //$order_status = 'asd';
                              if(!empty($order_status)) {
                              ?>
                            <table class="table table-striped table-bordered table-hover">
                              <tbody>
                                <tr>
                                  <td colspan="2" class="success">Payment Gateway Response</td>
                                </tr>
                                <tr>
                                  <td><strong>Order Id</strong></td>
                                  <?php if(empty($OrderId)) {?>
                                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                  <?php } else {?>
                                  <td><?php echo $OrderId;?></td>
                                  <?php }?>
                                </tr>
                                <tr>
                                  <td><strong>Tracking Id</strong></td>
                                  <td><?php echo $tracking_id;?></td>
                                </tr>
                                <tr>
                                  <td><strong>Bank Reference Id</strong></td>
                                  <td><?php echo $bank_ref_no;?></td>
                                </tr>
                                <tr>
                                  <td><strong>Payment Status</strong></td>
                                  <td><?php echo $order_status;?></td>
                                </tr>
                                <tr>
                                  <td><strong>Payment Mode Used </strong></td>
                                  <td><?php echo $payment_mode;?></td>
                                </tr>
                                <tr>
                                  <td><strong>Transaction Amount</strong></td>
                                  <td><?php echo $currency . " " . $Amount;?></td>
                                </tr>
                              </tbody>
                            </table>
                            <?php } ?>
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
                                <?php /*
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
                                  </tr>*/?>
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
                                <tr>
                                  <td> <strong>Telephone Number</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['fone']; ?> </td>
                                </tr>
                                <?php /*<tr>
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
                  <div class="row">
                    <div class="col-md-12">
                      <div class="well well-lg">
                        <div class="md-checkbox-inline">
                          <div class="md-checkbox">
                            <input type="checkbox" id="agree" class="md-check">
                            <label for="agree">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span> <?php /*I have read and hereby accept the privacy policy given and acknowledge that the data entered in the registration form is correct. I agree that BTS may share my contact information with its sponsors and partners for marketing purposes. See our <a href="https://www.bengalurutechsummit.com/privacy-policy.php" target="_blank">privacy policy</a> for more details.*/?>
							I agree that the Bengaluru Tech Summit (BTS) may share my contact information with its sponsors and partners to contact me as follow-up from my attendance of Bengaluru Tech Summit 2021 (BTS 2021). Use of your contact data is governed by the sponsor's Privacy Policy.
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
                  <?php if($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Google pay' || $qr_gt_user_data_ans_row['paymode'] == 'Paypal' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {?>
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
  	Registration.init('registration_form_4', 2);
  });
  
  function go_back() {
  	window.location=('registration-assoc5.php?ret=retds4fu324rn_ed24d3it&?en=<?php echo $en;?>&a=<?php echo $a;?>');
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
<?php
   session_start();
   //$_SESSION["vercode_reg"] = '24TNJ6';
   if((!isset($_SESSION["vercode_reg"]))||($_SESSION["vercode_reg"]==''))  
   { 
      	session_destroy();
   	echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
   	echo "<script language='javascript'>window.location=('registration_comp.php');</script>";
   	echo "<script language='javascript'>document.location=('registration_comp.php');</script>";
   	exit; 
   }
   require("includes/form_constants_both.php");
   require "dbcon_open.php";
   $reg_id = $_SESSION['vercode_reg'];
   $assoc_nm = @$_REQUEST['assoc_nm'];
   
   $qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
   if(isset($_GET['id']) && !empty($_GET['id'])) {
   	$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE tin_no = '" . $_GET['id'] . "'");
   }
   $qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
   if( ($qr_gt_user_data_ans_no<=0) || ($qr_gt_user_data_ans_no=="") ){
   	session_destroy();
   	echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
   	echo "<script language='javascript'>window.location=('registration_comp.php');</script>";
   	echo "<script language='javascript'>document.location=('registration_comp.php');</script>";
   	exit; 
   }	
   
   $qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'");
   $qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
   
   if($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
   	$total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
   } else {
   	$total_amt = $qr_gt_user_data_ans_row['total'];
   }
   
   $cata_type = @$_GET['cata_type'];
   $cata_type = 'cata_type=' . $cata_type;
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
            <form action="registration_comp4.php?assoc_nm=<?php echo $assoc_nm . '&' . $cata_type;?>"  class="form-horizontal" name="reg_registration_form_4" id="reg_registration_form_4" method="post" onsubmit="return validate_registration_form_4()">
               <div class="form-wizard">
                  <div class="form-body">
                     <ul class="nav nav-pills nav-justified steps">
                        <li class="done">
                           <a class="step dips-default-cursor">
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
                           <a data-toggle="tab" class="step">
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
                                          <span class="caption-subject">Detail</span>
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
                                                   <td> <strong>Organization Type</strong> </td>
                                                   <td> <?php echo $qr_gt_user_data_ans_row['nationality']; ?> </td>
                                                </tr>*/?>
                                                <tr>
                                                   <td> <strong>Delegate Category</strong> </td>
                                                   <td> <?php echo $qr_gt_user_data_ans_row['cata']; ?> </td>
                                                </tr>
                                                <?php  if(!empty($qr_gt_user_data_ans_row['assoc_name'])) {?>
                                                <tr>
                                                   <td> <strong>Association Name </strong> </td>
                                                   <td> <?php echo $qr_gt_user_data_ans_row['assoc_name']; ?> </td>
                                                </tr>
                                                <?php }?>
                                                <?php  if($qr_gt_user_data_ans_row['cata'] == 'Complimentary GIA Partner Delegate') {?>
                                                <tr>
                                                   <td> <strong>GIA Country </strong> </td>
                                                   <td> <?php echo $qr_gt_user_data_ans_row['member_of_assoc']; ?> </td>
                                                </tr>
                                                <?php }?>
                                                <tr>
                                                   <td> <strong>Delegate Type</strong> </td>
                                                   <td> <?php echo $qr_gt_user_data_ans_row['org_reg_type']; ?> </td>
                                                </tr>
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
                                                <?php /*?>
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
                                                <tr>
                                                   <td> <strong>Payment Mode</strong> </td>
                                                   <td> <?php echo $qr_gt_user_data_ans_row['paymode']; ?> </td>
                                                </tr>
                                               
                                                <tr>
                                                   <td> <strong>Total Delegate(s)</strong> </td>
                                                   <td> <?php echo $qr_gt_user_data_ans_row['sub_delegates']; ?> </td>
                                                </tr> <?php */?>
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
                           <?php *//*?>
                           <h4 class="form-section">Registration Category</h4>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Organization Type:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['nationality']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Delegate Type:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['org_reg_type']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Single/ Group Delegate(s):</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['gr_type']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Total Delegate(s):</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['sub_delegates']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Payment Mode:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['paymode']; ?></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php */?>
                           <?php /*?>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="control-label col-md-1"></label>
                                    <div class="col-md-11">
                                       <?php if($qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") { ?>
                                       <table class="table table-striped table-bordered table-hover">
                                          <tbody>
                                             <tr>
                                                <td colspan="2">Delegates are requested to Bank Transfer the registration fees to the following account</td>
                                             </tr>
                                             <tr>
                                                <td>Account Name :</td>
                                                <td style="width: 870px;">APCAT 7</td>
                                             </tr>
                                             <tr>
                                                <td>Account Type :</td>
                                                <td>Current Account</td>
                                             </tr>
                                             <tr>
                                                <td>Account Number :</td>
                                                <td>2827201001262</td>
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
                                                <td>Bank IFSC CODE :</td>
                                                <td>CNRB0002827</td>
                                             </tr>
                                             <tr>
                                                <td>Bank SWIFT CODE :</td>
                                                <td>CNRBINBBLFD</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <?php } else if(($qr_gt_user_data_ans_row['paymode'] == "Cheque")||($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD")) {?>
                                       <table class="table table-striped table-bordered table-hover">
                                          <tbody>
                                             <tr>
                                                <td style="border: medium none;"></td>
                                                <td style="border: medium none; width: 99%;">
                                                   <p>
                                                      Please send your Cheque/DD in favour of   APCAT-7 payable at Mumbai, India.<br />
                                                      Along with the copy of your registration receipt and send to<br />
                                                      <strong>Address :</strong> APCAT-7 Secretariat
                                                   <p>
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
                                          if(!empty($order_status)) {
                                          ?>
                                       <table class="table table-striped table-bordered table-hover">
                                          <tbody>
                                             <tr>
                                                <td colspan="2">Payment Gateway Response</td>
                                             </tr>
                                             <tr>
                                                <td>Order Id :</td>
                                                <td style="width: 870px;"><?php echo $OrderId;?></td>
                                             </tr>
                                             <tr>
                                                <td>Tracking Id :</td>
                                                <td><?php echo $tracking_id;?></td>
                                             </tr>
                                             <tr>
                                                <td>Bank Reference Id :</td>
                                                <td><?php echo $bank_ref_no;?></td>
                                             </tr>
                                             <tr>
                                                <td>Payment Status :</td>
                                                <td><?php echo $order_status;?></td>
                                             </tr>
                                             <tr>
                                                <td>Payment Mode Used :</td>
                                                <td><?php echo $payment_mode;?></td>
                                             </tr>
                                             <tr>
                                                <td>Transaction Amount :</td>
                                                <td><?php echo $currency . " " . $Amount;?></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <?php } ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php */?>
                           <?php /*?>
                           <h4 class="form-section">Organisation Information</h4>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Organisation Name:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['org']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Nature Of Business:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['nature']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Address 1:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['addr1']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Address 2:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['addr2']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">City:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['city']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">State:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['state']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Postal Code:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['pin']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Country:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['country']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Telephone Number:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['fone']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-5">Fax Number:</label>
                                    <div class="col-md-7">
                                       <p class="form-control-static"><?php echo $qr_gt_user_data_ans_row['fax']; ?></p>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>
                           <?php */?>
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
                                                   <?php /*<th>
                                                      Name on Badge
                                                   </th>*/?>
                                                   <th>
                                                      Email Address
                                                   </th>
                                                   <th>
                                                      Mobile Number
                                                   </th>
                                                   <?php /*<th>
                                                      Category 
                                                      </th>*/?>
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
                                                   <?php /*
                                                   <td>
                                                      <?php echo $qr_gt_user_data_ans_row['badge'.$i]; ?>
                                                   </td><td>
                                                      <?php echo $qr_gt_user_data_ans_row['cata'.$i]; ?>
                                                   </td>*/?>
                                                </tr>
                                                <?php }?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
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
                           <?php if($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {?>
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
   	window.location=('registration_comp.php?ret=retds4fu324rn_ed24d3it&<?php echo $cata_type;?>');
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
<?php

// session_start();
// ini_set('display_errors', 1);

include 'csrf_token.php';

$assoc_name = @$_GET['assoc_name'];
$assoc_name = trim($assoc_name);


require ("form_includes/form_constants_both.php");
require "dbcon_open.php";
if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
  session_destroy();
  mysqli_close($link);
  echo "<script language='javascript'>alert('Session Expired.');</script>";
  echo "<script language='javascript'>window.location = 'https://sci25.supercomputingindia.org';</script>";
  exit;
}
$reg_id = $_SESSION['vercode_reg'];
$del = $_SESSION['del'];
$cit = $_SESSION['cit'];
$qr_gt_user_data_id = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'");
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $qr_gt_user_data_id = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE tin_no = '" . $_GET['id'] . "'");
}
$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
if (($qr_gt_user_data_ans_no <= 0) || ($qr_gt_user_data_ans_no == "")) {
  session_destroy();
  mysqli_close($link);
  echo "<script language='javascript'>alert('Session Expired.');</script>";
  echo "<script language='javascript'>window.location = 'https://sci25.supercomputingindia.org';</script>";
  exit;
}

$qr_gt_user_data_id = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'");
$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);

$event_name = $qr_gt_user_data_ans_row['event_name'];

if ($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {
  $total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
} else {
  $total_amt = $qr_gt_user_data_ans_row['total'];
}

$a = '';
if (!empty($qr_gt_user_data_ans_row['user_type']) && !empty($qr_gt_user_data_ans_row['assoc_srno'])) {
  $assoc_name = $qr_gt_user_data_ans_row['user_type'];
  $assoc_srno = $qr_gt_user_data_ans_row['assoc_srno'];
  $qry = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_PROMO_CODE_TBL . " WHERE srno='$assoc_srno' AND assoc_name='$assoc_name'");

  if (mysqli_num_rows($qry)) {
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
<?php require 'form_includes/reg_form_header.php'; ?>
<div class="row">
  <div class="col-md-12">
    <div class="portlet light bordered" id="registration_form_4">
      <div class="portlet-title">
        <div class="caption">
          <i class=" icon-layers font-red"></i>
          <span class="caption-subject font-red bold uppercase"> Attendee(s) Registration Form
          </span>
        </div>
      </div>
      <div class="portlet-body form">
        <form action="registration8.php?assoc_name=<?php echo $qr_gt_user_data_ans_row['assoc_name']; ?>"
          class="form-horizontal" name="reg_registration_form_4" id="reg_registration_form_4" method="post"
          onsubmit="return validate_registration_form_4() ">
          <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
          <div class="form-wizard">
            <div class="form-body">
              <ul class="nav nav-pills nav-justified steps">
                <!-- <li class="done">
                  <a class="step dips-default-cursor">
                    <span class="number"> 1 </span>
                    <span class="desc">
                      <i class="fa fa-check"></i> Registration Category </span>
                  </a>
                </li> -->
                <li class="done">
                  <a data-toggle="tab" class="step dips-default-cursor">
                    <span class="number"> 1 </span>
                    <span class="desc">
                      <i class="fa fa-check"></i> Attendee(s) Information </span>
                  </a>
                </li>
                <li class="active">
                  <a data-toggle="tab" class="step">
                    <span class="number"> 2 </span>
                    <span class="desc">
                      <i class="fa fa-check"></i> Preview </span>
                  </a>
                </li>
                <?php if (strpos($qr_gt_user_data_ans_row['investor_flag'], 'inv') !== false) { ?>
                  <li>
                    <a data-toggle="tab" class="step dips-default-cursor">
                      <span class="number"> 3 </span>
                      <span class="desc">
                        <i class="fa fa-check"></i> Confirmation Pending </span>
                    </a>
                  </li>
                <?php } else { ?>
                  <li>
                    <a data-toggle="tab" class="step dips-default-cursor">
                      <span class="number"> 3 </span>
                      <span class="desc">
                        <i class="fa fa-check"></i> Receipt </span>
                    </a>
                  </li>
                <?php } ?>
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
                                <?php if (!empty($qr_gt_user_data_ans_row['org_reg_type'])) { ?>
                                <tr>
                                  <td width="50%"> <strong>Domain</strong> </td>
                                  <td width="50%"> <?php echo $qr_gt_user_data_ans_row['org_reg_type']; ?> </td>
                                </tr>
                                <?php } ?>

                                <?php if (!empty($qr_gt_user_data_ans_row['days'])) { ?>
                                <tr>
                                  <td width="50%"> <strong>Day</strong> </td>
                                  <td width="50%"> <?php echo $qr_gt_user_data_ans_row['days']; ?> </td>  
                                </tr>
                                <?php } ?>

                                <?php if (!empty($qr_gt_user_data_ans_row['time_slot'])) { ?>
                                <tr>
                                  <td width="50%"> <strong>Time Slot</strong> </td>
                                  <td width="50%"> 
                                    <?php 
                                    $time_slot = $qr_gt_user_data_ans_row['time_slot'];
                                    
                                    // Decode HTML entities first (in case JSON was HTML-encoded)
                                    $time_slot = html_entity_decode($time_slot, ENT_QUOTES, 'UTF-8');
                                    
                                    // Try to decode as JSON
                                    $time_slot_decoded = json_decode($time_slot, true);
                                    
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($time_slot_decoded)) {
                                        // Format JSON data in user-friendly way
                                        echo '<div style="max-height: 300px; overflow-y: auto;">';
                                        
                                        // Day mapping for better display
                                        $day_names = array(
                                            'Day1' => 'Day 1 - Tuesday, 9th December 2025',
                                            'Day2' => 'Day 2 - Wednesday, 10th December 2025',
                                            'Day3' => 'Day 3 - Thursday, 11th December 2025',
                                            'Day4' => 'Day 4 - Friday, 12th December 2025'
                                        );
                                        
                                        foreach ($time_slot_decoded as $day => $slots) {
                                            $day_display = isset($day_names[$day]) ? $day_names[$day] : $day;
                                            echo '<div style="margin-bottom: 20px; padding: 10px; background-color: #f9f9f9; border-left: 4px solid #2fa0dd;">';
                                            echo '<strong style="color: #2fa0dd; font-size: 15px; display: block; margin-bottom: 8px;">' . htmlspecialchars($day_display) . '</strong>';
                                            echo '<ul style="margin: 0; padding-left: 20px; list-style-type: disc;">';
                                            foreach ($slots as $slot) {
                                                $time = isset($slot['time']) ? htmlspecialchars($slot['time']) : '';
                                                $label = isset($slot['label']) ? htmlspecialchars($slot['label']) : '';
                                                echo '<li style="margin: 5px 0; line-height: 1.6;">';
                                                if ($time) {
                                                    echo '<span style="color: #666; font-weight: 600;">' . $time . '</span> - ';
                                                }
                                                echo '<span style="color: #333;">' . $label . '</span>';
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                            echo '</div>';
                                        }
                                        echo '</div>';
                                    } else {
                                        // Not JSON, display as is (but still decode HTML entities)
                                        echo '<div style="white-space: pre-wrap; word-wrap: break-word;">' . htmlspecialchars($time_slot) . '</div>';
                                    }
                                    ?>
                                  </td>
                                </tr>
                                <?php } ?>

                                <?php if (!empty($qr_gt_user_data_ans_row['course'])) { ?>
                                <tr>
                                  <td width="50%"> <strong>Course</strong> </td>
                                  <td width="50%"> <?php echo $qr_gt_user_data_ans_row['course']; ?> </td>
                                </tr>
                                <?php } ?>

                                <?php if (!empty($qr_gt_user_data_ans_row['branch'])) { ?>
                                <tr>
                                  <td width="50%"> <strong>Branch</strong> </td>
                                  <td width="50%"> <?php echo $qr_gt_user_data_ans_row['branch']; ?> </td>
                                </tr>
                                <?php } ?>

                                <?php if (!empty($qr_gt_user_data_ans_row['id_card'])) { ?>
                                <tr>
                                  <td width="50%"> <strong>ID Card</strong> </td>
                                    <td width="50%"> 
                                    <?php 
                                      // echo $qr_gt_user_data_ans_row['id_card']; 
                                      if (!empty($qr_gt_user_data_ans_row['id_card'])) {
                                      $file_path = $qr_gt_user_data_ans_row['id_card'];
                                      echo ' <a href="' . $file_path . '" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View ID Card</a>';
                                      }
                                    ?> 
                                    </td>
                                </tr>
                                <?php } ?>

                                <!-- <tr>
                                  <td> <strong>Organisation Type</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['org_reg_type']; ?> </td>
                                </tr> -->
                                <tr>
                                  <td> <strong>Single / Group Attendee(s)</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['gr_type']; ?> </td>
                                </tr> <?php if ($qr_gt_user_data_ans_row['gr_type'] != 'Single') { ?>
                                  <tr>
                                    <td> <strong>Total Delegate(s)</strong> </td>
                           <td> <?php 
                                      $total_delegates = $qr_gt_user_data_ans_row['sub_delegates'];
                                      if (!empty($qr_gt_user_data_ans_row['packages'])) {
                                        if ($qr_gt_user_data_ans_row['packages'] == '200 Students + 5 Faculty') {
                                          $total_delegates = 205;
                                        } elseif ($qr_gt_user_data_ans_row['packages'] == '100 Students + 5 Faculty') {
                                          $total_delegates = 105;
                                        }
                                      }
                                      echo $total_delegates;
                                    ?> </td>
                                  </tr> <?php } ?> <?php if ($qr_gt_user_data_ans_row['event_know'] != '') { ?>
                                  <tr>
                                    <td> <strong>How do you know about Event</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['event_know']; ?> </td>
                                  </tr> <?php } ?> <?php if (!empty($qr_gt_user_data_ans_row['paymode'])) { ?>
                                  <tr>
                                    <td> <strong>Payment Mode</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['paymode']; ?> </td>
                                  </tr>
                                <?php } /*if(($qr_gt_user_data_ans_row['assoc_name'] != 'Faculty' && $qr_gt_user_data_ans_row['assoc_name'] != 'Program-Coordinators') && $qr_gt_user_data_ans_row['member_of_assoc'] != '') {?>                                <tr>                                  <td> <strong>Are you member of Genotypic Techchnology</strong> </td>                                  <td> <?php echo $qr_gt_user_data_ans_row['member_of_assoc']; ?> </td>                                </tr>                                <?php }*/ ?>
                                <?php if ($qr_gt_user_data_ans_row['assoc_name'] != '') { ?>
                                  <tr>
                                    <td> <strong>Association Name</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['assoc_name']; ?>
                                      <?php if (($qr_gt_user_data_ans_row['assoc_name'] == 'Faculty' || $qr_gt_user_data_ans_row['assoc_name'] == 'Program-Coordinators' || $qr_gt_user_data_ans_row['assoc_name'] == 'Student-Coordinator') && $qr_gt_user_data_ans_row['member_of_assoc'] != '') {
                                        echo ': ' . $qr_gt_user_data_ans_row['member_of_assoc'];
                                      } ?>
                                    </td>
                                  </tr> <?php } ?>
                              </tbody>
                            </table>
                          </div>
                          <div class="table-scrollable">

                            <?php
                            $OrderId = $qr_gt_user_data_ans_row['pg_paymentid'];
                            $tracking_id = $qr_gt_user_data_ans_row['pg_trackid'];
                            $bank_ref_no = $qr_gt_user_data_ans_row['pg_tranid'];

                            $pg_result = explode('#', $qr_gt_user_data_ans_row['pg_result']);
                            $order_status = $payment_mode = $currency = '';
                            if (isset($pg_result[5])) {
                              $order_status = $pg_result[5];
                            }
                            if (isset($pg_result[0])) {
                              $payment_mode = $pg_result[0];
                            }
                            if (isset($pg_result[4])) {
                              $currency = $pg_result[4];
                            }
                            $Amount = $qr_gt_user_data_ans_row['pg_amt'];
                            //$order_status = 'asd';
                            if (!empty($order_status)) {
                            ?>
                              <table class="table table-striped table-bordered table-hover">
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="success">Payment Gateway Response</td>
                                  </tr>
                                  <tr>
                                    <td><strong>Order Id</strong></td>
                                    <?php if (empty($OrderId)) { ?>
                                      <td>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      </td>
                                    <?php } else { ?>
                                      <td><?php echo $OrderId; ?></td>
                                    <?php } ?>
                                  </tr>
                                  <tr>
                                    <td><strong>Tracking Id</strong></td>
                                    <td><?php echo $tracking_id; ?></td>
                                  </tr>
                                  <tr>
                                    <td><strong>Bank Reference Id</strong></td>
                                    <td><?php echo $bank_ref_no; ?></td>
                                  </tr>
                                  <tr>
                                    <td><strong>Payment Status</strong></td>
                                    <td><?php echo $order_status; ?></td>
                                  </tr>
                                  <tr>
                                    <td><strong>Payment Mode Used </strong></td>
                                    <td><?php echo $payment_mode; ?></td>
                                  </tr>
                                  <tr>
                                    <td><strong>Transaction Amount</strong></td>
                                    <td><?php echo $currency . " " . $Amount; ?></td>
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
                                <?php if ($qr_gt_user_data_ans_row['cata'] != 'Next Gen HPC Experience' && $qr_gt_user_data_ans_row['cata'] != 'Academia') { ?>
                                <tr>
                                  <td width="50%"> <strong>Organisation Name</strong> </td>
                                  <td width="50%"> <?php echo $qr_gt_user_data_ans_row['org']; ?> </td>

                                </tr>
                                <?php } else { ?>
                                <tr>
                                  <td width="50%"> <strong>Institute Name</strong> </td>
                                  <td width="50%"> <?php echo $qr_gt_user_data_ans_row['org']; ?> </td>
                                </tr>
                                <?php } ?>
                                <!-- address, city, state, zip  -->
                                <tr>
                                  <td> <strong>Address</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['addr1']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>City</strong> </td>
                                  <td>
                                    <?php echo $qr_gt_user_data_ans_row['city']; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td> <strong>State</strong> </td>
                                  <td>
                                    <?php echo $qr_gt_user_data_ans_row['state']; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td> <strong>Zip</strong> </td>
                                  <td>
                                    <?php echo $qr_gt_user_data_ans_row['pin']; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td> <strong>Country</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['country']; ?> </td>
                                </tr>
                                <?php if (!empty($qr_gt_user_data_ans_row['fone'])) { ?>
                                  <tr>
                                    <td> <strong>Telephone Number</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['fone']; ?> </td>
                                  </tr>
                                <?php } ?>

                                <?php if (!empty($qr_gt_user_data_ans_row['national'])) { ?>
                                  <tr>
                                    <td> <strong>Nationality</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['national']; ?> </td>
                                  </tr>
                                <?php } ?>

                                <?php if (!empty($qr_gt_user_data_ans_row['packages'])) { ?>
                                  <tr>
                                    <td> <strong>Student Package</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['packages']; ?> </td>
                                  </tr>
                                <?php } ?>

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- END Organisation Information TABLE PORTLET-->
                    </div>
                  </div>


                  <?php if ($qr_gt_user_data_ans_row['is_gst_invoice_needed'] == 'Yes') { ?>
                    <div class="row">
                      <div class="col-md-12">
                        <!-- BEGIN Organisation Information TABLE PORTLET-->
                        <div class="portlet light bordered">
                          <div class="portlet-title">
                            <div class="caption">
                              <i class="fa fa-info-circle font-dark"></i>
                              <span class="caption-subject">Organisation Details for Raising the Invoice</span>
                            </div>
                          </div>
                          <div class="portlet-body">
                            <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover">
                                <tbody>
                                  <tr>
                                    <td> <strong>Organisation Name<br />(To create invoice in the name of)</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['org']; ?> </td>
                                  </tr>
                                  <tr>
                                    <td> <strong>Invoice Address</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['gst_inv_addr']; ?> </td>
                                  </tr>
                                  <tr>
                                    <td> <strong>Organisation GST Registration No</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['gst_inv_reg_no']; ?> </td>
                                  </tr>
                                  <tr>
                                    <td> <strong>Organisation Pan No</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['gst_inv_pan']; ?> </td>
                                  </tr>
                                  <tr>
                                    <td> <strong>State</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['gst_inv_state']; ?> </td>
                                  </tr>
                                  <tr>
                                    <td> <strong>Contact Person Name</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['gst_inv_cp']; ?> </td>
                                  </tr>
                                  <tr>
                                    <td> <strong>Phone No</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['gst_inv_phone']; ?> </td>
                                  </tr>
                                  <tr>
                                    <td> <strong>Email Address</strong> </td>
                                    <td> <?php echo $qr_gt_user_data_ans_row['gst_inv_email']; ?> </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <!-- END Organisation Information TABLE PORTLET-->
                      </div>
                    </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-md-12">
                      <!-- BEGIN Registration Category TABLE PORTLET-->
                      <div class="portlet light bordered">
                        <div class="portlet-title">
                          <div class="caption">
                            <i class="fa fa-info-circle font-dark"></i>
                            <span class="caption-subject">Attendee(s) Information</span>
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
                                  <!-- <th>
                                    Govt ID Type
                                  </th> -->
                                  <!-- <th>
                                    Govt ID Number
                                  </th> -->
                                  <th>
                                    Category Type
                                  </th>
                                  <?php /*if cata != Next Gen HPC Experience then display a th with Head category type*/ 
                                  if ($qr_gt_user_data_ans_row['cata'] != 'Next Gen HPC Experience' && $qr_gt_user_data_ans_row['cata'] != 'Author') { ?>
                                    <th>
                                      Pass Name
                                    </th>
                                  <?php } ?>
                                  <th>
                                    Amount (<?php echo $qr_gt_user_data_ans_row['amt_ext']; ?>)
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php for ($i = 1; $i <= $qr_gt_user_data_ans_row['sub_delegates']; $i++) { ?>
                                  <tr>
                                    <td>
                                      <?php echo $i; ?>
                                    </td>
                                    <td>
                                      <?php echo $qr_gt_user_data_ans_row['title' . $i] . " " . $qr_gt_user_data_ans_row['fname' . $i] . " " . $qr_gt_user_data_ans_row['lname' . $i]; ?>
                                    </td>
                                    <td>
                                      <?php echo $qr_gt_user_data_ans_row['job_title' . $i]; ?>
                                    </td>
                                    <td>
                                      <?php echo $qr_gt_user_data_ans_row['email' . $i]; ?>
                                    </td>
                                    <td>
                                      <?php echo $qr_gt_user_data_ans_row['cellno' . $i]; ?>
                                    </td>
                                    <!-- <td>
                                      <?php /* echo $qr_gt_user_data_ans_row['govt_id_type' . $i]; */ ?>
                                    </td>
                                    <td>
                                      <?php /* echo $qr_gt_user_data_ans_row['govt_id_no' . $i]; */ ?>
                                    </td> -->
                                    <?php /*if cata != Next Gen HPC Experience then display a td with Head category type*/  ?>
                                   
                                      <td>
                                        <?php echo $qr_gt_user_data_ans_row['cata']; ?>
                                      </td>
                                     <?php
                                     if ($qr_gt_user_data_ans_row['cata'] != 'Next Gen HPC Experience' && $qr_gt_user_data_ans_row['cata'] != 'Author') { ?>
                                    <td>
                                      <?php echo $qr_gt_user_data_ans_row['cata' . $i]; ?>
                                    </td>
                                     <?php }?>
                                    <td>
                                      <?php
                                      $amt = $qr_gt_user_data_ans_row['amt' . $i];

                                      if ($i == 1 && $qr_gt_user_data_ans_row['sub_delegates'] == "1" && isset($qr_gt_user_data_ans_row['membership_category_name']) && $qr_gt_user_data_ans_row['membership_category_name'] == "Charter Member" && isset($qr_gt_user_data_ans_row['status']) && $qr_gt_user_data_ans_row['status'] == 'Active') {
                                        $amt = "Free";
                                      } elseif ($i == 1 && $qr_gt_user_data_ans_row['sub_delegates'] == "2" && isset($qr_gt_user_data_ans_row['membership_category_name']) && $qr_gt_user_data_ans_row['membership_category_name'] == "Charter Member" && isset($qr_gt_user_data_ans_row['status']) && $qr_gt_user_data_ans_row['status'] == 'Active') {
                                        $amt = "Free";
                                      } elseif ($i == 2) {
                                        $amt = $qr_gt_user_data_ans_row['amt' . $i];
                                      } else {
                                        $amt = $qr_gt_user_data_ans_row['amt' . $i];
                                      }

                                      echo $amt;
                                      ?>

                                    </td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php if (!empty($qr_gt_user_data_ans_row['selection_amt'])) { ?>
                    <div class="row">
                      <div class="col-md-6">

                      <?php
                      // make an interactive UI to display a information after successful payment you will receive an email with bulk upload format to add your attendees. You can add upto 10 attendees in one go.
                      // also make an link to download the bulk upload format
                      if ($qr_gt_user_data_ans_row['cata'] == 'Next Gen HPC Experience') {
                        //if packages 100 Students + 5 Faculty then 105 delegates or 200 Students + 5 Faculty then 205 delegates
                        if ($qr_gt_user_data_ans_row['packages'] == '200 Students + 5 Faculty' || $qr_gt_user_data_ans_row['packages'] == '100 Students + 5 Faculty') {
                          $max_delegates = ($qr_gt_user_data_ans_row['packages'] == '200 Students + 5 Faculty') ? 205 : 105;


                        }
                        ?>
                        <div class="alert alert-info" role="alert">
                          <h4 class="alert-heading">Bulk Attendee Upload Available!</h4>
                          <p>
                            After successful payment, you will receive an email containing the bulk upload format to add your attendees. You can add up to <strong><?php echo $max_delegates; ?> attendees</strong> in one go using this format.
                          </p>
                          <hr>
                          <p class="mb-0">
                            <a href="https://sci25expo.supercomputingindia.org/import/excel_import_frontend/assets/sample_template.xlsx" class="btn btn-success" target="_blank">
                              <i class="fa fa-download"></i> Download Bulk Upload Format
                            </a>
                          </p>
                        </div>
                      <?php
                      }
                      ?>
                      </div>
                      <div class="col-md-6">
                        <div class="well">
                          <?php 
                          // Calculate base selection amount (without food and kit)
                          $food_amount = isset($qr_gt_user_data_ans_row['food']) ? (float)$qr_gt_user_data_ans_row['food'] : 0;
                          $kit_amount = isset($qr_gt_user_data_ans_row['kit']) ? (float)$qr_gt_user_data_ans_row['kit'] : 0;
                          $selection_amt = isset($qr_gt_user_data_ans_row['selection_amt']) ? (float)$qr_gt_user_data_ans_row['selection_amt'] : 0;
                          $base_selection_amt = max(0, $selection_amt - $food_amount - $kit_amount); // Ensure non-negative
                          ?>
                          
                          <div class="row static-info align-reverse">
                            <div class="col-md-8 name">
                              Base Selection Amount:
                            </div>
                            <div class="col-md-4 value">
                              <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . number_format($base_selection_amt, 2); ?>
                            </div>
                          </div>
                          
                          <?php if ($food_amount > 0 || $kit_amount > 0) { ?>
                            <?php if ($food_amount > 0) { ?>
                              <div class="row static-info align-reverse">
                                <div class="col-md-8 name">
                                  Food:
                                </div>
                                <div class="col-md-4 value">
                                  <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . number_format($food_amount, 2); ?>
                                </div>
                              </div>
                            <?php } ?>
                            
                            <?php if ($kit_amount > 0) { ?>
                              <div class="row static-info align-reverse">
                                <div class="col-md-8 name">
                                  Kit:
                                </div>
                                <div class="col-md-4 value">
                                  <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . number_format($kit_amount, 2); ?>
                                </div>
                              </div>
                            <?php } ?>
                            
                            <div class="row static-info align-reverse" style="border-top: 1px solid #ddd; padding-top: 5px; margin-top: 5px;">
                              <div class="col-md-8 name">
                                <strong>Subtotal:</strong>
                              </div>
                              <div class="col-md-4 value">
                                <strong><?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . number_format($selection_amt, 2); ?></strong>
                              </div>
                            </div>
                          <?php } ?>
                          
                          <?php if (($qr_gt_user_data_ans_row['ieee_member'] == "Yes") && ($qr_gt_user_data_ans_row['ieee_member'] == "Yes")) { ?>
                            <div class="row static-info align-reverse">
                              <div class="col-md-8 name">
                                IEEE Member Discount @ 20% :
                              </div>
                              <div class="col-md-4 value">
                                <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['ieee_discount']; ?>
                              </div>
                            </div>
                          <?php } ?>
                          <?php if (($qr_gt_user_data_ans_row['admin_discount'] != "") && ($qr_gt_user_data_ans_row['admin_discount'] > 0)) { ?>
                            <div class="row static-info align-reverse">
                              <div class="col-md-8 name">
                                Promocode Discount @ <?php echo $qr_gt_user_data_ans_row['adminDiscountPer']; ?>% :
                              </div>
                              <div class="col-md-4 value">
                                <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['admin_discount']; ?>
                              </div>
                            </div>
                          <?php } ?>

                          <?php if (($qr_gt_user_data_ans_row['gr_discount'] != "") && ($qr_gt_user_data_ans_row['gr_discount'] > 0)) { ?>
                            <div class="row static-info align-reverse">
                              <div class="col-md-8 name">
                                <?php $dis_per = 0;
                                if ($qr_gt_user_data_ans_row['sub_delegates'] >= 3) {
                                  $dis_per = 10;
                                }
                                ?>
                                Group Discount @ <?php echo $dis_per ?>:
                              </div>
                              <div class="col-md-4 value">
                                <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['gr_discount']; ?>
                              </div>
                            </div>
                          <?php } ?>

                          <?php if (($qr_gt_user_data_ans_row['membership_discount'] != "") && ($qr_gt_user_data_ans_row['membership_discount'] > 0)) { ?>
                            <div class="row static-info align-reverse">
                              <div class="col-md-8 name">
                                Membership Discount @ <?php echo $qr_gt_user_data_ans_row['membershipDiscountPer']; ?>% :
                              </div>
                              <div class="col-md-4 value">
                                <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['membership_discount']; ?>
                              </div>
                            </div>
                          <?php } ?>

                          <?php if (($qr_gt_user_data_ans_row['processing_charge'] != "") && ($qr_gt_user_data_ans_row['processing_charge'] > 0)) { ?>
                            <div class="row static-info align-reverse">
                              <div class="col-md-8 name">
                                Processing Charges :
                              </div>
                              <div class="col-md-4 value">
                                <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['processing_charge']; ?>
                              </div>
                            </div>
                          <?php } ?>
                          <?php if (($qr_gt_user_data_ans_row['tax'] != "") && ($qr_gt_user_data_ans_row['tax'] > 0)) { ?>
                            <div class="row static-info align-reverse">
                              <div class="col-md-8 name">
                                GST @ <?php echo $SERVICE_TAX; ?>%:
                              </div>
                              <div class="col-md-4 value">
                                <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['tax']; ?>
                              </div>
                            </div>
                          <?php } ?>
                          <?php if (($qr_gt_user_data_ans_row['total'] != "") && ($qr_gt_user_data_ans_row['total'] > 0)) { ?>
                            <div class="row static-info align-reverse">
                              <div class="col-md-8 name">
                                Total:
                              </div>
                              <div class="col-md-4 value">
                                <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['total']; ?>
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="well well-lg">
                        <div class="md-checkbox-inline">
                          <div class="md-checkbox">
                            <input type="checkbox" id="agree" class="md-check" required>
                            <label for="agree">
                              <span></span>
                              <span class="check"></span>
                              <span class="box"></span>
                              <?php /*I have read and hereby accept the privacy policy given and acknowledge that the data entered in the registration form is correct. I agree that BTS may share my contact information with its sponsors and partners for marketing purposes. See our <a href="https://https://sci25.supercomputingindia.org/privacy-policy.php" target="_blank">privacy policy</a> for more details.*/ ?>
                              I have read and agreed to the all the <a
                                href="https://sci25.supercomputingindia.org/privacy-policy" target="_blank">terms &
                                conditions and
                                privacy policy</a> of Super Computing India.
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
                <div class="col-md-offset-5 col-md-7">
                  <a href="javascript:;" class="btn default" onclick="go_back();">
                    <i class="fa fa-angle-left"></i> Back </a>
                  <?php if ($qr_gt_user_data_ans_row['adminDiscountPer'] == '100' || $qr_gt_user_data_ans_row['pay_status'] == 'Complimentary' || strpos($qr_gt_user_data_ans_row['investor_flag'], 'inv') !== false) { ?>
                    <button class="btn btn-primary sbold uppercase" type="submit" name="make_payment" value="0"
                      style="position: absolute; margin-left: 10px;">
                      Submit <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                  <?php } elseif ($qr_gt_user_data_ans_row['ieee_member'] == 'Yes') { ?>
                    <button class="btn btn-primary sbold uppercase" type="submit" name="make_payment" value="0"
                      style="position: absolute; margin-left: 10px;">
                      Submit <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                  <?php } else { ?>
                    <button class="btn btn-primary sbold uppercase" type="submit" name="make_payment" value="1"
                      style="position: absolute; margin-left: 10px;">
                      <i class="fa fa-inr m-icon-white"></i>&nbsp; Make Payment&nbsp;
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
<?php require 'form_includes/reg_form_footer.php'; ?>
<script>
  function go_back() {
    var del_id = '<?php echo $del; ?>';
    var cit = '<?php echo $cit; ?>';
    var url = 'info.php?del=' + del_id + '&cit=' + cit + '&ret=retds4fu324rn_ed24d3it';
    window.location.href = url;
  }
</script>
<script>
  jQuery(document).ready(function() {
    Registration.init('registration_form_4', 2);
  });



  function validate_registration_form_4() {
    var agree = document.getElementById('agree');
    if (!agree.checked) {
      alert('Please accept the terms and conditions');
      return false;
    }
    dataLayer.push({
      event: "form_submit",
      eventModel: {
        form_id: "attendee_info",
        form_name: "attendee_info",
        form_destination: "https://sci25.supercomputingindia.org/registration/registration7.php",
        form_length: this.elements.length,
        event_callback: function() {
          // Callback function to submit the form after GTM event is pushed
          validate_registration_form_4();
          document.getElementById('reg_registration_form_4').submit();
        }
      },
      gtm.uniqueEventId: 0,
      gtm.priorityId: 6
    });
    return true;
  }
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
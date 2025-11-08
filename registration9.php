<?php

session_start();

//$_SESSION["vercode_reg"] = '24TNJ6';

$tin_no = @$_GET['id'];

if (empty($tin_no)) {

  if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {

    session_destroy();

    echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";

    echo "<script language='javascript'>window.location=('info.php?del=$del&cit=$cit');</script>";

    echo "<script language='javascript'>document.location=('info.php?del=$del&cit=$cit');</script>";

    exit;
  }
}


$del = $_SESSION['del'];
$cit = $_SESSION['cit'];
require ("form_includes/form_constants_both.php");

require "dbcon_open.php";



$reg_id = @$_SESSION["vercode_reg"];



//$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE tin_no = '$tin_no' AND reg_id='$reg_id'");

$qr_gt_user_data_id = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no'");

$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);

$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);



if (($qr_gt_user_data_ans_no <= 0) || ($qr_gt_user_data_ans_no == "")) {

  session_destroy();

  echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";

  echo "<script language='javascript'>window.location=('info.php?del=$del&cit=$cit');</script>";

  echo "<script language='javascript'>document.location=('info.php?del=$del&cit=$cit');</script>";

  exit;
}

if ($qr_gt_user_data_ans_row['paymode'] == 'Credit Card' || $qr_gt_user_data_ans_row['paymode'] == 'Debit Card' || $qr_gt_user_data_ans_row['paymode'] == 'i Banking') {

  if ($qr_gt_user_data_ans_row['pay_status'] == 'Not Paid') {

    //echo "<script language='javascript'>alert('Please make the payment.');</script>";

    //echo "<script language='javascript'>window.location = ('$EVENT_OL_PAY_ACT_LINK?id=" . $tin_no . "');</script>";

    //exit;

  }
}

if ($qr_gt_user_data_ans_row['amt_ext'] != "Rs.") {

  $total_amt = $qr_gt_user_data_ans_row['total'] * $qr_gt_user_data_ans_row['dollar'];
} else {

  $total_amt = $qr_gt_user_data_ans_row['total'];
}

$category = '-';

/*if(!empty($qr_gt_user_data_ans_row['org_reg_type']) && $qr_gt_user_data_ans_row['org_reg_type'] == 'Student'){

    $category = 'Limited Access';

  }else{

    $category = 'All Access';

  }*/

session_destroy();

?>

<?php require 'form_includes/reg_form_header.php'; ?>

<div class="row">

  <div class="col-md-12">

    <div class="portlet light bordered" id="registration_form_4">

      <div class="portlet-title">

        <div class="caption">

          <i class=" icon-layers font-red"></i>

          <span class="caption-subject font-red bold uppercase"> Delegate Registration Form

          </span>

        </div>

      </div>

      <div class="portlet-body form">

        <form action="" class="form-horizontal" name="reg_registration_form_4" id="reg_registration_form_4" method="post" onsubmit="return validate_registration_form_4()">

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

                  <a data-toggle="tab" class="step">

                    <span class="number"> 3 </span>

                    <span class="desc">

                      <i class="fa fa-check"></i> Confirm </span>

                  </a>

                </li>

                <li class="done">

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

                  <h3 class="block">Registration Detail</h3>

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
                                
                                <?php if (!empty($qr_gt_user_data_ans_row['sector'])) { ?>
                                <tr>

                                  <td> <strong>Domain</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['sector']; ?> </td>

                                </tr>
                                <?php } ?>

                                <?php if (!empty($qr_gt_user_data_ans_row['abstract_id'])) { ?>

                                  <tr>

                                    <td> <strong>Abstract Id</strong> </td>

                                    <td> <?php echo $qr_gt_user_data_ans_row['abstract_id']; ?> </td>

                                  </tr>

                                <?php }/*<tr>

                                  <td> <strong>Conference Type</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['conference_type']; ?> </td>

                                </tr>

                                <tr>

                                  <td> <strong>Category</strong> </td>

                                  <td> <?php echo $category; ?> </td>

                                </tr>*/ ?>

                                <tr>

                                  <td> <strong>Organization Type</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['nationality']; ?> </td>

                                </tr>


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

                                <?php                 
                                
                                /*<tr>

                                  <td> <strong>Delegate Type</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['org_reg_type']; ?> </td>

                                </tr>*/ ?>

                                <tr>

                                  <td> <strong>Single/ Group Delegate(s)</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['gr_type']; ?> </td>

                                </tr>

                                <?php if ($qr_gt_user_data_ans_row['gr_type'] != 'Single') { ?>

                                  <tr>

                                    <td> <strong>Total Delegate(s)</strong> </td>

                                    <td> <?php echo $qr_gt_user_data_ans_row['sub_delegates']; ?> </td>

                                  </tr>

                                <?php } ?>

                                <?php if ($qr_gt_user_data_ans_row['event_know'] != '') { ?>

                                  <tr style="display:none;">

                                    <td> <strong>How do you know about Event</strong> </td>

                                    <td> <?php echo $qr_gt_user_data_ans_row['event_know']; ?> </td>

                                  </tr>

                                <?php } ?>

                                <?php if (!empty($qr_gt_user_data_ans_row['paymode'])) { ?>

                                  <tr>

                                    <td> <strong>Payment Mode</strong> </td>

                                    <td> <?php echo $qr_gt_user_data_ans_row['paymode']; ?> </td>

                                  </tr>

                                <?php }/*if(($qr_gt_user_data_ans_row['assoc_name'] != 'Faculty' && $qr_gt_user_data_ans_row['assoc_name'] != 'Program-Coordinators') && $qr_gt_user_data_ans_row['member_of_assoc'] != '') {?>

                                <tr>

                                  <td> <strong>Are you member of Genotypic Techchnology</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['member_of_assoc']; ?> </td>

                                </tr>

                                <?php }*/ ?>

                                <?php if ($qr_gt_user_data_ans_row['assoc_name'] != '') { ?>

                                  <tr>

                                    <td> <strong>Association Name</strong> </td>

                                    <td> <?php echo $qr_gt_user_data_ans_row['assoc_name']; ?>

                                      <?php if (($qr_gt_user_data_ans_row['assoc_name'] == 'Faculty' || $qr_gt_user_data_ans_row['assoc_name'] == 'Program-Coordinators' || $qr_gt_user_data_ans_row['assoc_name'] == 'Student-Coordinator') && $qr_gt_user_data_ans_row['member_of_assoc'] != '') {
                                        echo ': ' . $qr_gt_user_data_ans_row['member_of_assoc'];
                                      } ?></td>

                                  </tr>

                                <?php } ?>

                              </tbody>

                            </table>

                          </div>

                          <div class="table-scrollable">

                            <?php if ($qr_gt_user_data_ans_row['paymode'] == "Bank Transfer") { ?>

                              <table class="table table-striped table-bordered table-hover">

                                <tbody>

                                  <tr>

                                    <td colspan="2" class="success">Delegates are requested to Bank Transfer the registration fees to the following account</td>

                                  </tr>

                                  <?php if ($qr_gt_user_data_ans_row['nationality'] == 'Indian Organization') { ?>

                                    <?php if ($qr_gt_user_data_ans_row['sector'] == "Bio Technology") { ?>

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

                                  <td style="width: 828px;">ACC 2023 </td>

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

                                  </tr>*/ ?>

                                      <tr>

                                        <td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>

                                      </tr>

                                    <?php } else { ?>

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

                                  <td>Annual Convention Of Chemists </td>

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

                                  </tr>*/ ?>

                                      <tr>

                                        <td colspan="2" style="color: red;">Incase of payment through IMPS. IMPS Transaction ID along with Date of Payment to be sent to <a href="mailto:ramakrishna.mokkapati@mmactiv.com">ramakrishna.mokkapati@mmactiv.com</a>/<a href="mailto:srisha.accounts@mmactiv.com">srisha.accounts@mmactiv.com</a></td>

                                      </tr>

                                    <?php }
                                  } else { ?>

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

                                      <td>2827241000004</td>

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

                                  <?php } ?>

                                </tbody>

                              </table>

                            <?php } else if (($qr_gt_user_data_ans_row['paymode'] == "Cheque") || ($qr_gt_user_data_ans_row['paymode'] == "Cheque/DD")) { ?>

                              <table class="table well table-condensed table-striped">

                                <tbody>

                                  <tr>

                                    <td style="border: medium none;"></td>

                                    <td style="border: medium none; width: 99%;">

                                      <?php if ($qr_gt_user_data_ans_row['sector'] == "Bio Technology") { ?>

                                        <p>

                                          Please send your Cheque/DD in favour of Annual Convention Of Chemists payable at Pune, India.<br>

                                          Along with the copy of your registration receipt and send to<br>

                                          <strong>Address :</strong><br>1st floor ashirwad, <br> baer road, <br>baner, pune - 411038, India<br>Tel: +91.20 2729 1769 <br>Website: <a href="https://icsacc.com/" target="_blank">www.icsacc.com</a>

                                        </p>

                                      <?php } else { ?>

                                        <p>

                                          Please send your Cheque/DD in favour of <?php echo $EVENT_CHEQUE_PAYBLE_AT_NAME; ?> payable at <?php echo $EVENT_CHEQUE_PAYBLE_AT; ?>.<br />

                                          Along with the copy of your registration receipt and send to<br />

                                          <strong>Address :</strong><br /><?php echo $EVENT_CHEQUE_PAYBLE_ADDRESS; ?>

                                        <p>

                                        <?php } ?>

                                    </td>

                                  </tr>

                                </tbody>

                              </table>

                            <?php }

                            $OrderId = $qr_gt_user_data_ans_row['pg_paymentid'];

                            $tracking_id = $qr_gt_user_data_ans_row['pg_trackid'];

                            $bank_ref_no = $qr_gt_user_data_ans_row['pg_tranid'];



                            if ($qr_gt_user_data_ans_row['paymode'] == 'Cashfree') {

                              $order_status = $qr_gt_user_data_ans_row['pg_status'];

                              $payment_mode = $qr_gt_user_data_ans_row['pg_ref'];

                              $currency = $qr_gt_user_data_ans_row['amt_ext'];
                            } else {

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
                            }

                            $Amount = $qr_gt_user_data_ans_row['pg_amt'];

                            //$order_status = 'asd';

                            //echo '##' . $qr_gt_user_data_ans_row['status_code'];

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

                                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

                                    <?php } else { ?>

                                      <td><?php echo $OrderId; ?></td>

                                    <?php } ?>

                                  </tr>

                                  <?php if ($tracking_id) { ?>

                                    <tr>

                                      <td><strong>Tracking Id</strong></td>

                                      <td><?php echo $tracking_id; ?></td>

                                    </tr>

                                  <?php } ?>

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

                                <tr>

                                  <td> <strong>Organisation Name</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['org']; ?> </td>

                                </tr>

                                <tr style="display:none;">

                                  <td> <strong>Nature Of Business</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['nature']; ?> </td>

                                </tr>

                                <tr style="display:none;">

                                  <td> <strong>Address 1</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['addr1']; ?> </td>

                                </tr>

                                <tr style="display:none;">

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

                                <tr style="display:none;">

                                  <td> <strong>Postal Code</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['pin']; ?> </td>

                                </tr>

                                <tr style="display:none;">

                                  <td> <strong>GST Number</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['gst_number']; ?> </td>

                                </tr>

                                <tr>

                                  <td> <strong>Country</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['country']; ?> </td>

                                </tr>

                                <?php if (!empty($qr_gt_user_data_ans_row['packages'])) { ?>

                                  <tr>

                                    <td> <strong>Packages</strong> </td>

                                    <td> <?php echo $qr_gt_user_data_ans_row['packages']; ?> </td>

                                  </tr>
                                <?php } ?>
                                
                                    
                                <tr style="display:none;">

                                  <td> <strong>Telephone Number</strong> </td>

                                  <td> <?php echo $qr_gt_user_data_ans_row['fone']; ?> </td>

                                </tr>

                                <tr style="display:none;">

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

                  <?php }
                  if (!empty($qr_gt_user_data_ans_row['user_type'])) { ?>

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

                  <?php } ?>

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
                                  <?php
if ($qr_gt_user_data_ans_row['cata'] == 'Next Gen HPC Experience') { ?>
                                 <th>
                                    Category Type
                                  </th>
                                  <?php } ?>
                                  <?php /*if cata != Next Gen HPC Experience then display a th with Head category type*/ 
                                  if ($qr_gt_user_data_ans_row['cata'] != 'Next Gen HPC Experience') { ?>
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

                                    <td>

                                      <?php echo $qr_gt_user_data_ans_row['cata' . $i]; ?>

                                    </td>

                                    <td>

                                      <?php echo $qr_gt_user_data_ans_row['amt' . $i]; ?>

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

                          <div class="row static-info align-reverse">

                            <div class="col-md-8 name">

                              Total Selection Amount:

                            </div>

                            <div class="col-md-4 value">

                              <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['selection_amt']; ?>

                            </div>

                          </div>

                          <?php if (($qr_gt_user_data_ans_row['admin_discount'] != "") && ($qr_gt_user_data_ans_row['admin_discount'] > 0)) { ?>

                            <div class="row static-info align-reverse">

                              <div class="col-md-8 name">

                                Admin Discount @ <?php echo $qr_gt_user_data_ans_row['adminDiscountPer']; ?>%:

                              </div>

                              <div class="col-md-4 value">

                                <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['admin_discount']; ?>

                              </div>

                            </div>

                          <?php } ?>



                          <?php if (($qr_gt_user_data_ans_row['gr_discount'] != "") && ($qr_gt_user_data_ans_row['gr_discount'] > 0)) { ?>

                            <div class="row static-info align-reverse">

                              <div class="col-md-8 name">

                                Group Discount @ 10%:

                              </div>

                              <div class="col-md-4 value">

                                <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['gr_discount']; ?>

                              </div>

                            </div>

                          <?php } ?>

                          <?php if (($qr_gt_user_data_ans_row['membership_discount'] != "") && ($qr_gt_user_data_ans_row['membership_discount'] > 0)) { ?>

                            <div class="row static-info align-reverse">

                              <div class="col-md-8 name">

                                Membership Discount @ <?php echo $qr_gt_user_data_ans_row['membershipDiscountPer']; ?>%:

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

                         

                          <?php } ?>

                          <?php if (($qr_gt_user_data_ans_row['total'] != "") && ($qr_gt_user_data_ans_row['total'] > 0)) { ?>

                            <div class="row static-info align-reverse">

                              <div class="col-md-8 name">

                                Total (Including Processing Charges):

                              </div>

                              <div class="col-md-4 value">

                                <?php echo $qr_gt_user_data_ans_row['amt_ext'] . ' ' . $qr_gt_user_data_ans_row['total']; ?>

                              </div>

                            </div>

                          <?php } ?>

                          <?php if (!empty($total_amt)) { ?>

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

                  <?php } ?>

                  <div class="note note-danger">

                    <h4 class="block">Info!</h4>

                    <p>Please DO NOT print this page. This page print not accepted in event.

                      <br />You need to click on <strong>Print</strong> button OR <a class="alert-link" href="<?php echo $EVENT_OL_PAY_ACT_LINK; ?>?id=<?php echo $qr_gt_user_data_ans_row['tin_no']; ?>" target="_blank">Click here </a>to generate printable receipt.

                    </p>

                  </div>

                </div>

              </div>

            </div>

            <div class="form-actions">

           
              <div class="row" style="margin-left:20px; margin-right:20px;">
                <div class="col-md-6 text-left">
                  <a href="<?php echo $EVENT_OL_PAY_ACT_LINK; ?>?id=<?php echo $qr_gt_user_data_ans_row['tin_no']; ?>" class="btn blue sbold uppercase green-jungle" type="submit" name="make_payment" value="1">
                    Print&nbsp;&nbsp;<i class="fa fa-print m-icon-white"></i>
                  </a>
                </div>
                <?php if (isset($qr_gt_user_data_ans_row['promocode1']) && $qr_gt_user_data_ans_row['promocode1'] === 'INDUSTIEQIB') { ?>
                  <div class="col-md-6 text-right">
                    <a href="https://forms.gle/chnb3xJs46KtzoqM8" class="btn sbold uppercase" style="background-color: red; color: white; border-color: orange;" type="button" name="make_payment" value="1">
                      Sign up for QIB Pitch Fest 2025
                    </a>
                  </div>
                <?php } ?>
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
  jQuery(document).ready(function() {

    Registration.init('registration_form_4', 3);

  });



  jQuery(document).bind("keyup keydown", function(e) {

    if (e.ctrlKey && e.keyCode == 80) {

      //alert('ok');

      //e.cancelBubble = true;

      //e.preventDefault();

    }

  });
</script>

<!-- END PAGE LEVEL SCRIPTS -->

</body>

</html>
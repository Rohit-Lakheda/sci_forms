<?php
session_start();
//$_SESSION["vercode_ex"] = '24TNJ6';
$event_name = 'Bangalore IT';
$en = '';
if (isset($_GET['en']) && !empty($_GET['en'])) {
  $en = '1';
  $event_name = 'Bangalore INDIA BIO';
}
$assoc_code = @$_GET['a'];
$assoc_code = trim($assoc_code);

if ((!isset($_SESSION["vercode_ex"])) || ($_SESSION["vercode_ex"] == '')) {
  session_destroy();
  echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
  if (!empty($assoc_code)) {
    echo "<script language='javascript'>window.location = 'stall-manning-exhibitor.php?a=$assoc_code';</script>";
  } else {
    echo "<script language='javascript'>window.location = 'stall-manning-exhibitor.php?a=$assoc_code';</script>";
  }
  exit;
}
require("includes/form_constants_both.php");
require "dbcon_open.php";
$reg_id = $_SESSION['vercode_ex'];

$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_STALL_MANNING_TBL_DEMO . " WHERE reg_id = '$reg_id'");
$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
if (($qr_gt_user_data_ans_no <= 0) || ($qr_gt_user_data_ans_no == "")) {
  session_destroy();
  echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
  if (!empty($assoc_code)) {
    echo "<script language='javascript'>window.location = 'stall-manning-exhibitor.php?a=$assoc_code';</script>";
  } else {
    echo "<script language='javascript'>window.location = 'stall-manning-exhibitor.php?a=$assoc_code';</script>";
  }
  exit;
}

$qr_gt_user_data_id = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_STALL_MANNING_TBL_DEMO . " WHERE reg_id = '$reg_id'");
$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);

$a = '';
/*$qry = mysqli_query($link,"SELECT * FROM " . $EVENT_DB_FORM_PROMO_CODE_STALL_MANNING_TBL . " WHERE promo_code='$qr_gt_user_data_ans_row[promo_code]'");

if (mysqli_num_rows($qry)) {
  $result = mysqli_fetch_assoc($qry);
  $a = $result['promo_code'];
}*/
$category = '-';
/* if(!empty($qr_gt_user_data_ans_row['org_reg_type']) && $qr_gt_user_data_ans_row['org_reg_type'] == 'Student'){
    $category = 'Limited Access';
  }else{
    $category = 'All Access';
  }*/
?>
<?php require 'includes/reg_form_header.php'; ?>
<div class="row">
  <div class="col-md-12">
    <div class="portlet light bordered" id="registration_form_4">
      <div class="portlet-title">
        <div class="caption">
          <i class=" icon-layers font-red"></i>
          <span class="caption-subject font-red bold uppercase">
            <?php /*if(isset($_GET['a']) && !empty($_GET['a']) && $_GET['a'] == 'F5X3SB') {?>
				STANDARD MEDIA  delegate registration (Free)
			<?php } else {?>
				STANDARD delegate registration (Free)
			<?php } */ ?>
            Exhibitor Stall Manning registration form
          </span>
        </div>
      </div>
      <div class="portlet-body form">
        <form action="stall-manning-exhibitor4.php?a=<?php echo $qr_gt_user_data_ans_row['promo_code']; ?>" class="form-horizontal" name="reg_registration_form_4" id="reg_registration_form_4" method="post" onsubmit="return validate_registration_form_4()">
          <input name="en" type="hidden" id="en" value="<?php echo $en; ?>" />
          <div class="form-wizard">
            <div class="form-body">
              <ul class="nav nav-pills nav-justified steps">
                <li class="done">
                  <a class="step dips-default-cursor">
                    <span class="number"> 1 </span>
                    <span class="desc">
                      <i class="fa fa-check"></i> Exhibitor Personnel Details </span>
                  </a>
                </li>
                <li class="active">
                  <a data-toggle="tab" class="step">
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
              <div class="tab-content">
                <div class="tab-pane active">
                  <h3 class="block">Confirm Detail</h3>
                  <div class="row">
                    <div class="col-md-12">
                      <!-- BEGIN Registration Category TABLE PORTLET-->
                      <div class="portlet light bordered">
                        <div class="portlet-body">
                          <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover">
                              <tbody>
                                <tr>
                                  <td> <strong> Exhibitor Name</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['org']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong> Contact Person Name</strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['title'] . ' ' . $qr_gt_user_data_ans_row['fname'] . ' ' . $qr_gt_user_data_ans_row['lname']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Designation </strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['desig']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Mobile No </strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['mob']; ?> </td>
                                </tr>
                                <tr>
                                  <td> <strong>Email Address </strong> </td>
                                  <td> <?php echo $qr_gt_user_data_ans_row['email']; ?> </td>
                                </tr>
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
                      <div class="well well-lg">
                        <div class="md-checkbox-inline">
                          <div class="md-checkbox">
                            <input type="checkbox" id="agree" class="md-check">
                            <label for="agree">
                              <span></span>
                              <span class="check"></span>
                              <span class="box"></span> <?php /*I have read and hereby accept the privacy policy given and acknowledge that the data entered in the registration form is correct. I agree that BTS may share my contact information with its sponsors and partners for marketing purposes. See our <a href="https://www.bengalurutechsummit.com/privacy-policy.php" target="_blank">privacy policy</a> for more details.*/ ?>
                              I agree that the Bengaluru Tech Summit (BTS) may share my contact information with its sponsors and partners to contact me as follow-up from my attendance of <?php echo $EVENT_NAME . " " . $EVENT_YEAR; ?>. Use of your contact data is governed by the sponsor's Privacy Policy.
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
                  <button class="btn sbold uppercase green-jungle" type="submit" name="make_payment" value="0">
                    Continue <i class="m-icon-swapright m-icon-white"></i>
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
<?php require 'includes/reg_form_footer.php'; ?>
<script>
  jQuery(document).ready(function() {
    Registration.init('registration_form_4', 1);
  });

  function go_back() {
    window.location = ('stall-manning-exhibitor.php?ret=retds4fu324rn_ed24d3it&?en=<?php echo $en; ?>&a=<?php echo $a; ?>');
  }

  function validate_registration_form_4() {
    if ((document.getElementById("agree").checked == false)) {
      alert('Please accept terms and conditions');
      document.getElementById("agree").focus();
      return false;
    }
  }
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
<?php

require "form_includes/form_constants_both.php";

require "dbcon_open.php";

$tin_no = ($_POST['tin_no']);
$ieee_status = ($_POST['ieee_action']);

// Get user data for calculations
$qr_gt_user_data_id = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no'");
$res = mysqli_fetch_array($qr_gt_user_data_id);

if($ieee_status =="Approve"){

   

    // Combine all amt fields into a single update query
    // if (!empty($updateFields)) {
    //     $updateQuery = "UPDATE $EVENT_DB_FORM_REG SET " . implode(", ", $updateFields) . " WHERE tin_no = '" . mysqli_real_escape_string($link, $tin_no) . "'";
    //     mysqli_query($link, $updateQuery) or die(mysqli_error($link));
    // }

    $main_amt = $res['selection_amt'];
    // IEEE member discount - ONLY if approved
    $ieee_discount = 0;
    if( $res['ieee_member'] === 'Yes'){
        $ieee_discount = round($main_amt * 0.10);
    }
    $main_amt -= $ieee_discount;
    
    $admin_discount = round(($main_amt * $res['adminDiscountPer']) / 100);
    $main_amt -= $admin_discount;

    // Ensure main_amt does not go below zero after admin discount
    $main_amt = max($main_amt, 0);

    $gr_discount = 0;
    //if promocode is applied, remove the group discount
    if (!empty($res['promocode1'])) {
        $gr_discount = 0;
    } elseif ($res['gr_type'] === 'Group' && $res['sub_delegates'] > 2) {
        // Apply group discount only if more than one sub-delegate
        $gr_discount = round($main_amt * 0.10);
    }

    // Prioritize larger discount
    if ($main_amt > 0 && $gr_discount > $admin_discount) {
        $main_amt += $admin_discount;
        $admin_discount = 0;
        $main_amt -= $gr_discount;
    } 

    // Ensure main_amt is not negative after discounts
    $main_amt = max($main_amt, 0);

    $processing_charge_per = $processing_charge = 0;
    $curr = $res['curr'];

    if ($curr == "Indian") {
        $processing_charge_per = $CC_IND_PROCESSING_CHARGE_PER;
    } else if ($curr == "Foreign") {
        $processing_charge_per = $PAYPAL_PROCESSING_CHARGE_PER;
    }
    if (!empty($processing_charge_per)) {
        $processing_charge = round(($main_amt * $processing_charge_per) / 100);
        $total1 = round($main_amt + $processing_charge);
    }

    $tax = round(($total1 * $SERVICE_TAX) / 100);
    $total = round($total1 + $tax);

    // Determine pay status
    $pay_status = ($res['pay_status'] == 'Not Paid' && $total == 0) ? 'Complimentary' : 'Not Paid';
    // if (
    //     in_array($res['cata'], ['Business Visitor', 'General Visitor']) ||
    //     ($res['cata'] == 'Investor Bronze Pass' && str_contains($res['investor_flag'], 'inv')) ||
    //     ($res['cata'] == 'Investor Gold Pass' && $res['investor_flag'] == 'goldinvint')
    // ) {
    //     $pay_status = 'Complimentary';
    // }

    // Final DB updates
    $updateFields = [
      
        "pay_status" => $pay_status,
        "ieee_discount" => $ieee_discount,
        "gr_discount" => $gr_discount,
        "admin_discount" => $admin_discount,
        "tax" => $tax,
        "total" => $total,
        "membershipDiscountPer" => 0,
       
    ];

    $updateSet = [];
    foreach ($updateFields as $field => $value) {
        $updateSet[] = "$field = '" . mysqli_real_escape_string($link, $value) . "'";
    }
    $updateQuery = "UPDATE $EVENT_DB_FORM_REG SET " . implode(", ", $updateSet) . " WHERE tin_no = '$tin_no'";
    mysqli_query($link, $updateQuery) or die(mysqli_error($link));

    mysqli_query($link, "UPDATE " . $EVENT_DB_FORM_REG . " SET processing_charge_per = '$processing_charge_per' WHERE tin_no = '$tin_no'") or die(mysqli_error($link));

    mysqli_query($link, "UPDATE " . $EVENT_DB_FORM_REG . " SET processing_charge = '$processing_charge' WHERE tin_no = '$tin_no'") or die(mysqli_error($link));

    $sq = "UPDATE $EVENT_DB_FORM_REG SET ieee_status = 'Approved' WHERE tin_no = '$tin_no'";
    $result = mysqli_query($link,$sq);

} else {
    // If rejected, update status and recalculate without IEEE discount
   
    // Combine all amt fields into a single update query
    // if (!empty($updateFields)) {
    //     $updateQuery = "UPDATE $EVENT_DB_FORM_REG SET " . implode(", ", $updateFields) . " WHERE tin_no = '" . mysqli_real_escape_string($link, $tin_no) . "'";
    //     mysqli_query($link, $updateQuery) or die(mysqli_error($link));
    // }

    // mysqli_query($link, "UPDATE $EVENT_DB_FORM_REG SET selection_amt = '$amt' WHERE tin_no = '$tin_no'");

    $main_amt = $res['selection_amt'];
    // IEEE member discount - NOT applied if rejected
    $ieee_discount = 0;
    
    $admin_discount = round(($main_amt * $res['adminDiscountPer']) / 100);
    $main_amt -= $admin_discount;

    // Ensure main_amt does not go below zero after admin discount
    $main_amt = max($main_amt, 0);

    $gr_discount = 0;
    //if promocode is applied, remove the group discount
    if (!empty($res['promocode1'])) {
        $gr_discount = 0;
    } elseif ($res['gr_type'] === 'Group' && $res['sub_delegates'] > 2) {
        // Apply group discount only if more than one sub-delegate
        $gr_discount = round($main_amt * 0.10);
    }

    // Prioritize larger discount
    if ($main_amt > 0 && $gr_discount > $admin_discount) {
        $main_amt += $admin_discount;
        $admin_discount = 0;
        $main_amt -= $gr_discount;
    } 

    // Ensure main_amt is not negative after discounts
    $main_amt = max($main_amt, 0);

    $processing_charge_per = $processing_charge = 0;
    $curr = $res['curr'];

    if ($curr == "Indian") {
        $processing_charge_per = $CC_IND_PROCESSING_CHARGE_PER;
    } else if ($curr == "Foreign") {
        $processing_charge_per = $PAYPAL_PROCESSING_CHARGE_PER;
    }
    if (!empty($processing_charge_per)) {
        $processing_charge = round(($main_amt * $processing_charge_per) / 100);
        $total1 = round($main_amt + $processing_charge);
    }

    $tax = round(($total1 * $SERVICE_TAX) / 100);
    $total = round($total1 + $tax);

    // Determine pay status
    $pay_status = ($res['pay_status'] == 'Not Paid' && $total == 0) ? 'Complimentary' : 'Not Paid';
    // if (
    //     in_array($res['cata'], ['Business Visitor', 'General Visitor']) ||
    //     ($res['cata'] == 'Investor Bronze Pass' && str_contains($res['investor_flag'], 'inv')) ||
    //     ($res['cata'] == 'Investor Gold Pass' && $res['investor_flag'] == 'goldinvint')
    // ) {
    //     $pay_status = 'Complimentary';
    // }

    // Final DB updates
    $updateFields = [
       
        "pay_status" => $pay_status,
        "ieee_discount" => $ieee_discount, // Will be 0 for rejected
        "gr_discount" => $gr_discount,
        "admin_discount" => $admin_discount,
        "tax" => $tax,
        "total" => $total,
        "membershipDiscountPer" => 0,
       
    ];

    $updateSet = [];
    foreach ($updateFields as $field => $value) {
        $updateSet[] = "$field = '" . mysqli_real_escape_string($link, $value) . "'";
    }
    $updateQuery = "UPDATE $EVENT_DB_FORM_REG SET " . implode(", ", $updateSet) . " WHERE tin_no = '$tin_no'";
    mysqli_query($link, $updateQuery) or die(mysqli_error($link));

    mysqli_query($link, "UPDATE " . $EVENT_DB_FORM_REG . " SET processing_charge_per = '$processing_charge_per' WHERE tin_no = '$tin_no'") or die(mysqli_error($link));

    mysqli_query($link, "UPDATE " . $EVENT_DB_FORM_REG . " SET processing_charge = '$processing_charge' WHERE tin_no = '$tin_no'") or die(mysqli_error($link));
     $sq = "UPDATE $EVENT_DB_FORM_REG SET ieee_status = 'Rejected' WHERE tin_no = '$tin_no'";
    $result = mysqli_query($link,$sq);

}

mysqli_close($link);
header("Location: reg_form_email_send.php?id=$tin_no & admin=$Admin");
exit;

print_r($_POST);
echo $ieee_status;
echo $tin_no;
echo "<br>";
echo "main_amt: $main_amt<br>ieee_discount: $ieee_discount<br>gr_discount: $gr_discount<br>admin_discount: $admin_discount<br>processing_charge_per: $processing_charge_per<br>processing_charge: $processing_charge<br>tax: $tax<br>total: $total<br>";
echo "<br>";
die;
?>
<?php
include 'csrf_token.php';
require "form_includes/form_constants_both.php";
require "dbcon_open.php";

session_start();
if (!isset($_SESSION["vercode_reg"]) || empty($_SESSION["vercode_reg"])) {
    session_destroy();
    echo "<script>alert('Session Expired.'); window.location = 'https://sci25.supercomputingindia.org';</script>";
    exit;
}

$reg_id = $_SESSION["vercode_reg"];
$event_name = !empty($_POST['en']) ? 'Super Computing India' : 'Super Computing India';
$del = $_SESSION['del'];
$cit = $_SESSION['cit'];

date_default_timezone_set('Asia/Kolkata');
$today = date("Y-m-d");
$event_date = date("Y-m-d", strtotime("2025-12-09"));
$early_date = '2025-07-09';
$standard_date = '2025-08-02';

// Fetch user data
$userDataQuery = mysqli_query($link, "SELECT * FROM $EVENT_DB_FORM_REG_DEMO WHERE reg_id = '$reg_id'");
if (mysqli_num_rows($userDataQuery) <= 0) {
    session_destroy();
    echo "<script>alert('Session Expired.'); window.location = 'https://sci25.supercomputingindia.org';</script>";
    exit;
}
$res = mysqli_fetch_assoc($userDataQuery);

// Validate and process sub-delegates' emails
for ($j = 1; $j <= $res['sub_delegates']; $j++) {
    $email = mysqli_real_escape_string($link, htmlspecialchars($res["email$j"]));
    if (empty($email)) {
        echo "<script>alert('Please enter a valid email id.'); window.location = 'info.php?del=$del&cit=$cit';</script>";
        exit;
    }

    $emailCheck = mysqli_query($link, "SELECT * FROM $EVENT_DB_FORM_REG WHERE email$j = '$email'");
    if (mysqli_num_rows($emailCheck) > 0) {
        $existingUser = mysqli_fetch_assoc($emailCheck);
        $tin = $existingUser['tin_no'];
        if ($existingUser['pay_status'] === 'Not Paid') {
            if (in_array($existingUser['paymode'], ['Online', 'Debit Card', 'i Banking', 'Google pay'])) {
                echo "<script>alert('Provided email id $email is already registered. Redirecting to payment gateway...');</script>";
                echo 'Please wait while redirecting...<br/>Do not close or refresh this page.';
                echo "<script>setTimeout(() => window.location.href = 'https://sci25.supercomputingindia.org/pay/reg_pay_1.php?id=$tin', 2000);</script>";
            } else {
                echo "<script>window.location = 'registration9.php?id=$tin';</script>";
            }
        } else {
            echo "<script>window.location = 'registration9.php?id=$tin';</script>";
        }
        exit;
    }
}
// echo  $PromoCode1;
// die;
// Apply promo code if valid
$promoCode = $res['promocode1'];
if (!empty($promoCode)) {
    $promoQuery = mysqli_query($link, "SELECT * FROM promo_codes WHERE code = '$promoCode'");
    $promoRow = mysqli_fetch_assoc($promoQuery);
    if (!empty($promoRow) && $promoRow['ticket_flag'] == 1) {
        $cate = $promoRow['ticket_category'];
        // Update the main cata field
        mysqli_query($link, "UPDATE $EVENT_DB_FORM_REG_DEMO SET cata = '$cate' WHERE reg_id = '$reg_id'");
        for ($j = 1; $j <= $res['sub_delegates']; $j++) {
            $field = "cata$j";
            mysqli_query($link, "UPDATE $EVENT_DB_FORM_REG_DEMO SET $field = '$cate' WHERE reg_id = '$reg_id'");
        }
        $userDataQuery = mysqli_query($link, "SELECT * FROM $EVENT_DB_FORM_REG_DEMO WHERE reg_id = '$reg_id'");
        $res = mysqli_fetch_assoc($userDataQuery);
    }
}

// Function to get applicable rate
function getRate($early_rate, $standard_rate, $today, $early_date, $standard_date)
{
    return ($today <= $early_date) ? $early_rate : $standard_rate;
}

// Function to normalize category name to match rates array keys
function normalizeCategory($category) {
    if (empty($category)) {
        return 'Industry'; // Default fallback
    }
    
    // Map common variations to standard category names
    $category = trim($category);
    $categoryLower = strtolower($category);
    
    // Check if it already matches
    if (in_array($category, ['Industry', 'Government', 'Academia', 'Author'])) {
        return $category;
    }
    
    // Try to match variations
    if (stripos($categoryLower, 'industry') !== false || stripos($categoryLower, 'industrial') !== false) {
        return 'Industry';
    }
    if (stripos($categoryLower, 'government') !== false || stripos($categoryLower, 'govt') !== false) {
        return 'Government';
    }
    if (stripos($categoryLower, 'academia') !== false || stripos($categoryLower, 'academic') !== false || stripos($categoryLower, 'student') !== false || stripos($categoryLower, 'faculty') !== false) {
        return 'Academia';
    }
    if (stripos($categoryLower, 'author') !== false) {
        return 'Author';
    }
    
    // Default fallback
    return 'Industry';
}

// Compute amount
$amt = 0;
$updateFields = [];

// $cata = $res['cata'];


//Custom rate function Based on only Category for the author
function getCustomRate1($category, $today, $early_date, $standard_date)
{
    // echo $category, $today, $early_date, $standard_date;
    // exit;
    // Define rates for Indian and Foreign currencies
    $rates = [
        "Author" => [
            "Early Bird" => ["Indian" => 30000, "Foreign" => 350],
            "Regular"    => ["Indian" => 35000, "Foreign" => 400],
        ],
    ];
    // Determine rate type
    if ($today <= $early_date) {
        $rateType = "Early Bird";
    } elseif ($today <= $standard_date) {
        $rateType = "Regular";
    } else {
        $rateType = "On-site";
    }
    // Default currency is Indian
    global $res;
    $currency = ($res['curr'] === "Foreign") ? "Foreign" : "Indian";
    // Lookup rate
    if (isset($rates[$category][$rateType][$currency])) {
        return $rates[$category][$rateType][$currency];
    }
    return 01;
}




 
// Custom rate logic based on category and package
function getCustomRate($category, $combo, $today, $early_date, $standard_date)
{

    // print_r($category, $combo, $today, $early_date, $standard_date);
    // exit;
    // Define rates for Indian and Foreign currencies
    $rates = [
        "Industry" => [
            "2-Day Delegate Pass" => [
                "Early Bird" => ["Indian" => 9000, "Foreign" => 100 ],
                "Regular"   => ["Indian" => 11000, "Foreign" => 122],
                "On-site"   => ["Indian" => 14000, "Foreign" => 156],
            ],
            "Exhibition Pass" => [
                "Early Bird" => ["Indian" => 3000, "Foreign" => 78],
                "Regular"    => ["Indian" => 5000, "Foreign" => 100],
                "On-site"    => ["Indian" => 11000, "Foreign" => 122],
            ],
            "Technical Program + Workshop + Tutorial + Exhibition" => [
                "Early Bird" => ["Indian" => 35000, "Foreign" => 389],
                "Regular"    => ["Indian" => 44000, "Foreign" => 489],
                "On-site"    => ["Indian" => 52000, "Foreign" => 578],
            ],
        ],
        "Government" => [
            "2-Day Delegate Pass" => [
                "Early Bird" => ["Indian" => 7200, "Foreign" => 82],
                "Regular"    => ["Indian" => 8800, "Foreign" => 100],
                "On-site"    => ["Indian" => 11200, "Foreign" => 127],
            ],
            "Exhibition Pass" => [
                "Early Bird" => ["Indian" => 3000, "Foreign" => 64],
                "Regular"    => ["Indian" => 5000, "Foreign" => 82],
                "On-site"    => ["Indian" => 8800, "Foreign" => 100],
            ],
            "Technical Program + Workshop + Tutorial + Exhibition" => [
                "Early Bird" => ["Indian" => 28000, "Foreign" => 318],
                "Regular"    => ["Indian" => 35000, "Foreign" => 400],
                "On-site"    => ["Indian" => 41600, "Foreign" => 473],
            ],
        ],
        "Academia" => [
            "2-Day Delegate Pass" => [
                "Early Bird" => ["Indian" => 5760, "Foreign" => 64],
                "Regular"    => ["Indian" => 7040, "Foreign" => 78],
                "On-site"    => ["Indian" => 8960, "Foreign" => 100],
            ],
            "Exhibition Pass" => [
                "Early Bird" => ["Indian" => 3000, "Foreign" => 50],
                "Regular"    => ["Indian" => 5000, "Foreign" => 64],
                "On-site"    => ["Indian" => 7040, "Foreign" => 78],
            ],
            "Technical Program + Workshop + Tutorial + Exhibition" => [
                "Early Bird" => ["Indian" => 22400, "Foreign" => 249],
                "Regular"    => ["Indian" => 28160, "Foreign" => 313],
                "On-site"    => ["Indian" => 33280, "Foreign" => 370],
            ],
        ],

        "Author" => [
            "Early Bird" => ["Indian" => 30000, "Foreign" => 350],
            "Regular"    => ["Indian" => 35000, "Foreign" => 400],
        ],
       
    ];



    // Determine rate type
    if ($today <= $early_date) {
        $rateType = "Early Bird";
    } elseif ($today <= $standard_date) {
        $rateType = "Regular";
    } else {
        $rateType = "On-site";
    }

    // echo "<br>Category: $category, Combo: $combo, Rate Type: $rateType<br>";

    // Default currency is Indian
    global $res;
    $currency = ($res['curr'] === "Foreign") ? "Foreign" : "Indian";

    // Lookup rate
    if (isset($rates[$category][$combo][$rateType][$currency])) {
        return $rates[$category][$combo][$rateType][$currency];
    }
    return 0;
}



// Use custom rate logic if cata and cata1 are set
// if (!empty($res['cata']) && !empty($res['cata1'])) {
//     $amt = 0;
//     $updateFields = [];
//     for ($i = 1; $i <= $res['sub_delegates']; $i++) {
//         $category = $res["cata$i"];
//         $combo = $res["cata1"];
//         $rate = getCustomRate($category, $combo, $today, $early_date, $standard_date);
//         $amt += $rate;
//         $updateFields[] = "amt$i = '" . mysqli_real_escape_string($link, $rate) . "'";
//     }
// }



for ($i = 1; $i <= $res['sub_delegates']; $i++) {

    $cata = $res["cata$i"];
    $rate = 0;
    $packages = $res['packages'];
    // echo "Delegate $i: Category = $cata, Package = $packages<br>";
    // exit;
    
    if ($res['curr'] === "Indian") {
        if ($packages == "Smart Campus Pack - Silver") {
            $rate = match ($cata) {
                "Next Gen HPC Experience" => getRate(150000, 150000, $today, $early_date, $standard_date),
                default => 150000
            };
        } elseif ($packages == "Smart Campus Pack - Gold") {
            $rate = match ($cata) {
                "Next Gen HPC Experience" => getRate(300000, 300000, $today, $early_date, $standard_date),
                default => 300000
            };
        }elseif ($cata == "Author") {
            //call custom rate function for author
            $cata = $res["cata"];
            $early_date = '2025-11-21';
            $today = date("Y-m-d");
            $standard_date = '2025-11-22';

            // echo $cata, $today, $early_date, $standard_date;
            // exit;
            // echo "Calling getCustomRate1 for Author<br>";
            // exit;

            // print($getCustomRate1($cata, $today, $early_date, $standard_date));
            $rate = getCustomRate1($cata, $today, $early_date, $standard_date);
            // echo $rate;
            // exit;
        } else {
            //call custom rate function
            // Use org_reg_type as category, and cata$i (pass_type) as combo
            $category = !empty($res["org_reg_type"]) ? $res["org_reg_type"] : $res["cata"];
            $category = normalizeCategory($category); // Normalize to match rates array keys
            $packages = $res["cata$i"];
            $early_date = '2025-11-21';
            $today = date("Y-m-d");
            $standard_date = '2025-11-22';

            $rate = getCustomRate($category, $packages, $today, $early_date, $standard_date);
        }
    } elseif ($res['curr'] === "Foreign") {
        $cata = $res["cata"];
        $packages = $res["cata$i"];
        $early_date = '2025-11-21';
        $today = date("Y-m-d");
        $standard_date = '2025-11-22';

        //if cata is Author, use custom rate function
        if ($cata == "Author") {
            $rate = getCustomRate1($cata, $today, $early_date, $standard_date);
        } else {
            //call custom rate function
            // Use org_reg_type as category, and cata$i (pass_type) as combo
            $category = !empty($res["org_reg_type"]) ? $res["org_reg_type"] : $res["cata"];
            $category = normalizeCategory($category); // Normalize to match rates array keys
            $rate = getCustomRate($category, $packages, $today, $early_date, $standard_date);
        }
    } else {
        // Fallback case: if curr is neither Indian nor Foreign, try to calculate rate anyway
        // Use org_reg_type as category, and cata$i (pass_type) as combo
        $category = !empty($res["org_reg_type"]) ? $res["org_reg_type"] : $res["cata"];
        $category = normalizeCategory($category); // Normalize to match rates array keys
        $packages = $res["cata$i"];
        $early_date = '2025-11-21';
        $today = date("Y-m-d");
        $standard_date = '2025-11-22';
        
        if ($cata == "Author") {
            $rate = getCustomRate1($cata, $today, $early_date, $standard_date);
        } else {
            $rate = getCustomRate($category, $packages, $today, $early_date, $standard_date);
        }
    }

    // Debug: Uncomment to see rate calculation details
    // echo "Delegate $i: Category = $category, Combo = $packages, Rate = $rate<br>";
    // if ($rate == 0) {
    //     echo "WARNING: Rate is 0 for delegate $i. Category: " . (isset($category) ? $category : 'not set') . ", Combo: " . (isset($packages) ? $packages : 'not set') . "<br>";
    // }
    // exit;

    $amt += $rate;
    $updateFields[] = "amt$i = '" . mysqli_real_escape_string($link, $rate) . "'";
}

// echo $rate;
// echo "<br>";
// if cata is Author, use custom rate function

// echo $cata;
// echo "<br>";
// print_r($amt);
// exit;


// Combine all amt fields into a single update query
if (!empty($updateFields)) {
    $updateQuery = "UPDATE $EVENT_DB_FORM_REG_DEMO SET " . implode(", ", $updateFields) . " WHERE reg_id = '" . mysqli_real_escape_string($link, $reg_id) . "'";
    mysqli_query($link, $updateQuery) or die(mysqli_error($link));
}


mysqli_query($link, "UPDATE $EVENT_DB_FORM_REG_DEMO SET selection_amt = '$amt' WHERE reg_id = '$reg_id'");

$main_amt = $amt;
// IEEE member discount
$ieee_discount = 0;
if( $res['ieee_member'] === 'Yes'){
    $ieee_discount = round($main_amt * 0.20);
}

if($res['ieee_member'] === 'Yes' && $res['amt_ext'] === 'USD'){
    $ieee_discount = 80;
}   

// echo $ieee_discount;
// exit;


// echo "IEEE Member: {$res['ieee_member']}<br>";
//
// echo "IEEE Discount: $ieee_discount<br>";

// echo "Main Amount before Discounts: $main_amt<br>";

// die;
$main_amt -= $ieee_discount;
// echo "IEEE Discount: $ieee_discount<br>";
// echo "Main Amount before Discounts: $main_amt<br>";
$admin_discount = round(($main_amt * $res['adminDiscountPer']) / 100);

$main_amt -= $admin_discount;
// echo "Main Amount: $main_amt<br>";
// echo "Admin Discount: $admin_discount<br>";
// exit;
// Ensure main_amt does not go below zero after admin discount
$main_amt = max($main_amt, 0);
// echo "Main Amount after Admin Discount: $main_amt<br>";
// die;


$gr_discount = 0;
//if promocode is applied, remove the group discount
if (!empty($res['promocode1'])) {
    $gr_discount = 0;
} elseif ($res['gr_type'] === 'Group' && $res['sub_delegates'] > 2) {
    // Apply group discount only if more than one sub-delegate
    $gr_discount = round($main_amt * 0.10);
}

// if ($res['gr_type'] === 'Group' && $res['sub_delegates'] > 2) {
//     $gr_discount = round($main_amt * 0.10);
// }
// echo "Group Discount: $gr_discount<br>";

// Prioritize larger discount
if ($main_amt > 0 && $gr_discount > $admin_discount) {
    $main_amt += $admin_discount;
    $admin_discount = 0;
    $main_amt -= $gr_discount;
}

// echo "Main Amount before Author Extra Page Check: $main_amt<br>";
// echo $res['cata'];
// echo "<br>";
$extraCharge = 0;
// $res['pagesNumber'] = 9;
if ($res['cata'] === "Author") {
    //if pagesNumber > 8 then add rate 200 for indian for foreign 150
   if ($res['pagesNumber'] > 8) {
    // $res['pagesNumber'] = 9;

    // echo $res['pagesNumber'];
    // echo "<br>";

    // Add extra charges per page for Author if pagesNumber > 8
    // For each page above 8, add 17652 (Indian) or 200 (Foreign), up to 11 pages max
    // Add extra charges per page for Author if pagesNumber > 8
    // For each page above 8, add 17652 (Indian) or 200 (Foreign), up to 11 pages max
    $extraPages = min((int)$res['pagesNumber'], 11) - 8;
    // echo $extraPages;
    // echo "<br>";
    if ($extraPages > 0) {
        // For 9 pages: +17652, for 10: +17652*2, for 11: +17652*3 (Indian)
        // Foreign per-page value kept as 200 (matches prior code). Adjust if different.
        $extraPerPage = ($res['curr'] === "Indian") ? 17652 : 200;
        $extraCharge = $extraPages * $extraPerPage;
        // Add extra charge once to the running total ($amt) so it will be stored in selection_amt below
        $main_amt += $extraCharge;
        // echo $extraCharge;
        // echo "<br>";
        // Do NOT echo/exit here — let the normal update + discounts + totals flow execute.
    }
   }
}

// echo "Main Amount before Discounts: $main_amt<br>";
// echo "Extra Pages Charge (if any): " . ($extraCharge) . "<br>";
// echo "IEEE Discount: $ieee_discount<br>";
// exit;
// Ensure main_amt is not negative after discounts
$main_amt = max($main_amt, 0);

// Add Food and Kit amounts to main_amt (will be read from database after query)

// echo "Group Discount: $gr_discount<br>";
// echo "Main Amount after Discounts: $main_amt<br>";
// echo "Admin Discount: $admin_discount<br>";
// echo "Food Amount: $food_amount<br>";
// echo "Kit Amount: $kit_amount<br>";



$processing_charge_per = $processing_charge = 0;
$qr_gt_user_data_id = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'");

$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);
$res = $res1 = $qr_gt_user_data_ans_row;
$curr = $res['curr'];

// Add Food and Kit amounts to main_amt (amounts are stored directly in food and kit columns)
$food_amount = isset($res['food']) ? (float)$res['food'] : 0;
$kit_amount = isset($res['kit']) ? (float)$res['kit'] : 0;

// Add Food and Kit amounts if greater than 0
if ($food_amount > 0) {
    $main_amt += $food_amount;
}

if ($kit_amount > 0) {
    $main_amt += $kit_amount;
}

// Update selection_amt to include food and kit amounts
mysqli_query($link, "UPDATE $EVENT_DB_FORM_REG_DEMO SET selection_amt = '$main_amt' WHERE reg_id = '$reg_id'");

// echo "Processing Charge Per: $processing_charge_per<br>";
// die;
if ($curr == "Indian") {

    // if ($res['paymode'] == 'Credit Card' || $res['paymode'] == 'Google pay' || $res['paymode'] == 'Cashfree'|| $res['paymode'] == 'Online' || $res['paymode'] == 'CCAvenue') {

    $processing_charge_per = $CC_IND_PROCESSING_CHARGE_PER;

    // }
} else if ($curr == "Foreign") {

    // if ($res['paymode'] == 'Paypal') {

    $processing_charge_per = $PAYPAL_PROCESSING_CHARGE_PER;
    // } else if ($res['paymode'] == 'CCAvenue' || $res['paymode'] == 'Credit Card') {

    // 	$processing_charge_per = $PAYPAL_PROCESSING_CHARGE_PER;
    // }
}
if (!empty($processing_charge_per)) {

    $processing_charge = round(($main_amt * $processing_charge_per) / 100);

    $total1 = round($main_amt + $processing_charge);
}


$tax = round(($total1 * $SERVICE_TAX) / 100);
$total = round($total1 + $tax);

// If TEST51 promocode is used, override the final total to 1 (keep all other calculations intact)
if ($res['promocode1'] === 'TEST51') {
    $total = 1;
}

// echo "processing_charge_per: $processing_charge<br>$curr<br> paymod:$res[paymode]<br>";
// die;
// Determine pay status
$pay_status = ($res['pay_status'] == 'Not Paid' && $total == 0) ? 'Complimentary' : 'Not Paid';
// if (
//     in_array($res['cata'], ['Business Visitor', 'General Visitor']) ||
//     ($res['cata'] == 'Investor Bronze Pass' && str_contains($res['investor_flag'], 'inv')) ||
//     ($res['cata'] == 'Investor Gold Pass' && $res['investor_flag'] == 'goldinvint')
// ) {
//     $pay_status = 'Complimentary';
// }
// echo "Total Amount: $total<br> tax: $tax<br> main_amt: $main_amt<br> processing_charge: $processing_charge<br>";
// die;
// Final DB updates
$updateFields = [
    "paymode" => 'Online',
    "pay_status" => $pay_status,
    "ieee_discount" => $ieee_discount,
    "gr_discount" => $gr_discount,
    "admin_discount" => $admin_discount,
    "tax" => $tax,
    "total" => $total,
    "membershipDiscountPer" => 0,
    "event_name" => $event_name
];

$updateSet = [];
foreach ($updateFields as $field => $value) {
    $updateSet[] = "$field = '" . mysqli_real_escape_string($link, $value) . "'";
}
$updateQuery = "UPDATE $EVENT_DB_FORM_REG_DEMO SET " . implode(", ", $updateSet) . " WHERE reg_id = '$reg_id'";
mysqli_query($link, $updateQuery) or die(mysqli_error($link));

mysqli_query($link, "UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET processing_charge_per = '$processing_charge_per' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));

mysqli_query($link, "UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET processing_charge = '$processing_charge' WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
mysqli_close($link);
echo "<script>window.location = 'registration7.php';</script>";
exit;

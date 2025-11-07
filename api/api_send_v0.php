<?php
// Set headers
header("Content-Type: application/json");

//dbconnection

require '../startup_forms/includes/form_constants_both.php';
require '../startup_forms/dbcon_open.php';
$sql = "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL where tin_no = 'TIN-MHK2024-EXHST-SG-84375530'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
/*table fields
srno	exhibitor_id	sector	subsector	booth_size	booth_area	booth_area_unit	booth_space	exhibitor_name	cp_title	cp_fname	cp_lname	cp_mobile	cp_email	cp_desig	addr1	addr2	city	state	country	zip	cntry_code_phone	phone	gst_number	pan_number	website	fascia_name	exhi_profile	total_exbhitors	nationality	curr	paymode	payment_date	dollar	amt_ext	pay_status	tin_no	pin_no	reg_id	reg_date	reg_time	selection_amt	membership_discount	membershipDiscountPer	admin_discount	adminDiscountPer	gr_discount	tax	processing_charge_per	processing_charge	total	total_amt_received	delegate_type	task_assigned_to1	task_assigned_to2	task_assigned_from	sp_msg	chq_no	chq_dt	chq_time	admin_name	trans_id_hdfc	spon_flg	spon_type	spon_comp_id	reg_cancel	pg_ErrorText	pg_paymentid	pg_trackid	pg_Error	pg_result	pg_postdate	pg_tranid	pg_auth	pg_avr	pg_ref	pg_amt	pg_udf1	pg_udf2	pg_udf3	pg_udf4	pg_udf5	pg_status	user_ip_addr	membership_name	membership_code	intr1	intr2	intr3	intr4	intr5	intr6	intr7	intr8	intr9	intr10	intr11	intr12	intr13	intr14	intr15	intr16	intr17	intr18	intr19	intr20	
user_type	pavilion	event_name	ci_certf	sales_exec */
$srno = $row['srno'];
$exhibitor_id = $row['exhibitor_id'];
$sector = $row['sector'];
$subsector = $row['subsector'];
$booth_size = $row['booth_size'];
$booth_area = $row['booth_area'];
$booth_area_unit = $row['booth_area_unit'];
$booth_space = $row['booth_space'];
$exhibitor_name = $row['exhibitor_name'];
$cp_title = $row['cp_title'];
$cp_fname = $row['cp_fname'];
$cp_lname = $row['cp_lname'];
$cp_mobile = $row['cp_mobile'];
$cp_email = $row['cp_email'];
$cp_desig = $row['cp_desig'];
$addr1 = $row['addr1'];
$addr2 = $row['addr2'];
$city = $row['city'];
$state = $row['state'];
$country = $row['country'];
$zip = $row['zip'];
$cntry_code_phone = $row['cntry_code_phone'];
$phone = $row['phone'];
$gst_number = $row['gst_number'];
$pan_number = $row['pan_number'];
$website = $row['website'];
$fascia_name = $row['fascia_name'];
$exhi_profile = $row['exhi_profile'];
$total_exbhitors = $row['total_exbhitors'];
$nationality = $row['national'];
$curr = $row['curr'];
$paymode = $row['paymode'];
$payment_date = $row['payment_date'];
$dollar = $row['dollar'];
$amt_ext = $row['amt_ext'];
$pay_status = $row['pay_status'];
$tin_no = $row['tin_no'];
$pin_no = $row['pin_no'];
$reg_id = $row['reg_id'];
$reg_date = $row['reg_date'];
$reg_time = $row['reg_time'];
$selection_amt = $row['selection_amt'];
$membership_discount = $row['membership_discount'];
$membershipDiscountPer = $row['membershipDiscountPer'];
$admin_discount = $row['admin_discount'];
$adminDiscountPer = $row['adminDiscountPer'];
$gr_discount = $row['gr_discount'];
$tax = $row['tax'];
$processing_charge_per = $row['processing_charge_per'];
$processing_charge = $row['processing_charge'];
$total = $row['total'];
$total_amt_received = $row['total_amt_received'];
$delegate_type = $row['delegate_type'];
$task_assigned_to1 = $row['task_assigned_to1'];
$task_assigned_to2 = $row['task_assigned_to2'];
$task_assigned_from = $row['task_assigned_from'];
$sp_msg = $row['sp_msg'];
$chq_no = $row['chq_no'];
$chq_dt = $row['chq_dt'];
$chq_time = $row['chq_time'];
$admin_name = $row['admin_name'];
$user_type = $row['user_type'];
$pavilion = $row['pavilion'];
$event_name = $row['event_name'];
$ci_certf = $row['ci_certf'];
$sales_exec = $row['sales_exec'];


// Your logic to collect payment data
$paymentData = array(
    'srno' => $srno,
    'exhibitor_id' => $exhibitor_id,
    'sector' => $sector,
    'subsector' => $subsector,
    'booth_size' => $booth_size,
    'booth_area' => $booth_area,
    'booth_area_unit' => $booth_area_unit,
    'booth_space' => $booth_space,
    'exhibitor_name' => $exhibitor_name,
    'cp_title' => $cp_title,
    'cp_fname' => $cp_fname,
    'cp_lname' => $cp_lname,
    'cp_mobile' => $cp_mobile,
    'cp_email' => $cp_email,
    'cp_desig' => $cp_desig,
    'addr1' => $addr1,
    'addr2' => $addr2,
    'city' => $city,
    'state' => $state,
    'country' => $country,
    'zip' => $zip,
    'cntry_code_phone' => $cntry_code_phone,
    'phone' => $phone,
    'gst_number' => $gst_number,
    'pan_number' => $pan_number,
    'website' => $website,
    'fascia_name' => $fascia_name,
    'exhi_profile' => $exhi_profile,
    'total_exbhitors' => $total_exbhitors,
    'nationality' => $nationality,
    'curr' => $curr,
    'paymode' => $paymode,
    'payment_date' => $payment_date,
    'dollar' => $dollar,
    'amt_ext' => $amt_ext,
    'pay_status' => $pay_status,
    'tin_no' => $tin_no,
    'pin_no' => $pin_no,
    'reg_id' => $reg_id,
    'reg_date' => $reg_date,
    'reg_time' => $reg_time,
    'selection_amt' => $selection_amt,
    'membership_discount' => $membership_discount,
    'membershipDiscountPer' => $membershipDiscountPer,
    'admin_discount' => $admin_discount,
    'adminDiscountPer' => $adminDiscountPer,
    'gr_discount' => $gr_discount,
    'tax' => $tax,
    'processing_charge_per' => $processing_charge_per,
    'processing_charge' => $processing_charge,
    'total' => $total,
    'total_amt_received' => $total_amt_received,
    'delegate_type' => $delegate_type,
    'task_assigned_to1' => $task_assigned_to1,
    'task_assigned_to2' => $task_assigned_to2,
    'task_assigned_from' => $task_assigned_from,
    'sp_msg' => $sp_msg,
    'chq_no' => $chq_no,
    'chq_dt' => $chq_dt,
    'chq_time' => $chq_time,
    'admin_name' => $admin_name,
    'user_type' => $user_type,
    'pavilion' => $pavilion,
    'event_name' => $event_name,
    'ci_certf' => $ci_certf,
    'sales_exec' => $sales_exec

);

// Convert payment data to JSON
$paymentDataJSON = json_encode($paymentData);

// API endpoint to insert payment data
$apiURL = 'https://startupmahakumbh.assocham.org/api/insert_payment_data.php';

// Initialize cURL session
$ch = curl_init($apiURL);

// Set the request as a POST method
curl_setopt($ch, CURLOPT_POST, 1);

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $paymentDataJSON);

// Set the content type to JSON
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// Return response instead of outputting it
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$response = curl_exec($ch);

// Close cURL session
curl_close($ch);

// Output the response
echo $response;
?>

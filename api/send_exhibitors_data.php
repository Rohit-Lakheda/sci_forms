<?php



function sendExhibitordata($tinNo, $link)
{
    $api_url = 'https://apis.startupmahakumbh.org/api/3rdParty/v1/eventBot/exhibitor';
    // $api_url = 'https://startupmahakumbh.assocham.org/test/rec_exh.php';
    // $api_url = 'https://startupmahakumbh.assocham.org/api/recieve_exhi_dir_test.php';
    
    $escapedTinNo = mysqli_real_escape_string($link, $tinNo);
    $sql = "SELECT exhibition_under,exhibitor_id,cp_title,sm_count, cp_fname,phone, subsector, cp_lname,cp_desig, cp_email, cp_mobile, exhibitor_name,website, addr1, addr2, country,booth_size, state, city, zip, sector, exhi_count, svbadge_count
        FROM `sm_2024_exhibitors_dir_payment_tbl`
        WHERE tin_no = '$escapedTinNo'";

    $result = mysqli_query($link, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        //return json_encode(['error' => 'No payment data found for the provided TIN number.']);
    }
    // Fetch the row
    $row = mysqli_fetch_assoc($result);

    $row['country_code'] = substr($row['phone'], 0, 2);

    $row['mobile'] = substr($row['phone'], 3 );
    
    $id = $row['exhibitor_id'];
    $title = $row['cp_title'];
    $first_name = $row['cp_fname'];
    $last_name = $row['cp_lname'];
    $email = $row['cp_email'];
    $cp_design = $row['cp_desig'];
    $website = $row['website'];
    $country_code = $row['country_code'];
    $mobile = $row['mobile'];    
    $company = $row['exhibitor_name'];
    $address_1 = $row['addr1'];
    $address_2 = $row['addr2'];
    $country = $row['country'];
    $state = $row['state'];
    $city = $row['city'];
    $pincode = $row['zip'];
    $interests = $row['sector'];
    $representative_badge_allowed = $row['sm_count'];
    $service_badge_allowed =  $row['svbadge_count'];
    $delegate_silver_badge_allowed = $row['exhi_count'];
    $delegate_gold_badge_allowed = "0";
    $hall_number = "";
    $booth_number = "";
    $incubator_name = $row['exhibition_under'];
    $booth_size = $row['booth_size'];
    $sub_interests = $row['subsector'];

    $paymentDataJSON = array(
        "exhibitor_id" => "$id",
        "title" => $title,
        "first_name"=> "$first_name",
        "last_name" => "$last_name",
        "position" => "$cp_design",
        "website" => "$website",
        "email" => "$email",
        "country_code" => "$country_code",
        "mobile" => "$mobile",
        "company" => "$company",
        "address_1" => "$address_1",
        "address_2" => "$address_2",
        "country" => "$country",
        "state" => "$state",
        "city" => "$city",
        "pincode" => "$pincode",
        "interests" => "$interests",
        "representative_badge_allowed" => "$representative_badge_allowed",
        "service_badge_allowed" =>  "$service_badge_allowed",
        "delegate_silver_badge_allowed" => "$delegate_silver_badge_allowed",
        "delegate_gold_badge_allowed" => "$delegate_gold_badge_allowed",
        "hall_number" => "$hall_number",
        "booth_number" => "$booth_number",
        "incubator_name" => "$incubator_name",
        "booth_size" => "$booth_size",
        "sub_interests" => "$sub_interests"
    );

    

    // Loop through the row and construct the payment data array
    // foreach ($row as $key => $value) {
    //     $paymentDataJSON[$key] = $value;
    // }
    $data_json = json_encode($paymentDataJSON);
    // echo $data_json;
    // die;
    // echo $data_json;
    $ch = curl_init($api_url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'X-Requested-With: XMLHttpRequest'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);
    echo $response;
    //from response insert data into database
    $response = json_decode($response, true);
    //get header response {"head":{"status":false,"code":422,"message":"Precondition Failed"} or {"head":{"status":true,"code":200,"message":"OK"}
    $head = $response['head'];
    $status = $head['status'];
    $code = $head['code'];
    $message = $head['message'];
    insertResponse($id, $status, $code, $message, $link, $company);
}

function insertResponse($id, $status, $code, $message, $link,$company)
{
    $sql = "INSERT INTO `sm_2024_exhibitors_response_tbl_api_log` (
        `exhibitor_id`, `status`, `code`, `message`, `company`
    ) 
    VALUES (
        '$id', '$status', '$code', '$message', '$company'
    )";
    $link->query($sql);
   
}
// require 'dbcon_open.php';

// sendExhibitordata($tin_id,$link);

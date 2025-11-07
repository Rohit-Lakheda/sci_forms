<?php



function sendExhibitordata($tinNo, $link)
{
    // $api_url = 'https://apis.startupmahakumbh.org/api/3rdParty/v1/eventBot/exhibitor';
    // $api_url = 'https://startupmahakumbh.assocham.org/test/rec_exh.php';
    $api_url = 'https://startupmahakumbh.assocham.org/api/recieve_exhi_dir.php';

    $escapedTinNo = mysqli_real_escape_string($link, $tinNo);
    $sql = "SELECT `exhibitor_id`, `exhibitor_name`, `cp_title`, `cp_fname`, `cp_lname`, 
    `cp_desig`, `cntry_code_mob`, `mob`, `email`, `website`, `address_line_1`, `address_line_2`, 
    `city`, `state`, `country`, `zip`, `exhi_profile`, `booth_no`, `fascia_name`, `category`, 
    `logo`, `focused_sector`
        FROM `sm_2024_exhibitors_dir_details_tbl_phase_1`
        WHERE exhibitor_id = '$escapedTinNo'";

    $result = mysqli_query($link, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        //return json_encode(['error' => 'No payment data found for the provided TIN number.']);
    }
    // Fetch the row
    $row = mysqli_fetch_assoc($result);

    //from $row['cp_mobile'] extract only first three digits and store in $row['country_code']
    
    $exhibitor_id = $row['exhibitor_id'];
    $exhibitor_name = $row['exhibitor_name'];
    $cp_title = $row['cp_title'];
    $cp_fname = $row['cp_fname'];
    $cp_lname = $row['cp_lname'];
    $cp_desig = $row['cp_desig'];
    $cntry_code_mob = $row['cntry_code_mob'];
    $mob = $row['mob'];
    $email = $row['email'];
    $website = $row['website'];
    $address_line_1 = $row['address_line_1'];
    $address_line_2 = $row['address_line_2'];
    $city = $row['city'];
    $state = $row['state'];
    $country = $row['country'];
    $zip = $row['zip'];
    $exhi_profile = $row['exhi_profile'];
    $booth_no = $row['booth_no'];
    $fascia_name = $row['fascia_name'];
    $category = $row['category'];
    $logo = $row['logo'];
    $focused_sector = $row['focused_sector'];


    $paymentDataJSON = array(
        "exhibitor_id" => "$exhibitor_id",
        "exhibitor_name" => "$exhibitor_name",
        "cp_title" => "$cp_title",
        "cp_fname" => "$cp_fname",
        "cp_lname" => "$cp_lname",
        "cp_desig" => "$cp_desig",
        "cntry_code_mob" => "$cntry_code_mob",
        "mob" => "$mob",
        "email" => "$email",
        "website" => "$website",
        "address_line_1" => "$address_line_1",
        "address_line_2" => "$address_line_2",
        "city" => "$city",
        "state" => "$state",
        "country" => "$country",
        "zip" => "$zip",
        "exhi_profile" => "$exhi_profile",
        "booth_no" => "$booth_no",
        "fascia_name" => "$fascia_name",
        "category" => "$category",
        "logo" => "$logo",
        "focused_sector" => "$focused_sector"
    );
       
    

    // Loop through the row and construct the payment data array
    // foreach ($row as $key => $value) {
    //     $paymentDataJSON[$key] = $value;
    // }
    $data_json = json_encode($paymentDataJSON);
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
}
require 'dbcon_open.php';
$tin_id = "SM2024_EXB_6530";

sendExhibitordata($tin_id,$link);

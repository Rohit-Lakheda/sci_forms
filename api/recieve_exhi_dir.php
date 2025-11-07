<?php


// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $headers = getallheaders();
    // $jsonResponse = '';
    // $jsonResponse .= json_encode(['headers' => $headers]);

// if (isset($headers['Accesstoken'])) {

//     $authCode = $headers['Accesstoken'];
//     if ($authCode == '1234567') {
//         // Authorization successful
//         http_response_code(200);
//         echo json_encode(['success' => 'Authorized']);
//         // $jsonResponse .= json_encode(['success' => 'Authorized']);
//     } else {
//         // Authorization failed
//         http_response_code(401);
//         echo json_encode(['error' => 'Unauthorized']);
//         exit;
//     }
// } else {
//     // No Authorization header sent
//     http_response_code(401);
//     echo json_encode(['error' => 'Unauthorized']);
//     $file = 'webhook_response.json';
//     file_put_contents($file, $jsonResponse);

//     exit;
// }

// $postData = json_decode(file_get_contents('php://input'), true);
    $postData = file_get_contents('php://input');

    // echo $postData;
    $postData = json_decode($postData, true);

    if ($postData) {
        $exhibitor_id = $postData['exhibitor_id'];
        $exhibitor_name = $postData['exhibitor_name'];
        $dm_exhibitor_id = $postData['dm_exhibitor_id'];
        $cp_title = $postData['cp_title'];
        $cp_fname = $postData['cp_fname'];
        $cp_lname = $postData['cp_lname'];
        $cp_desig = $postData['cp_desig'];
        $cntry_code_mob = $postData['cntry_code_mob'];
        $mob = $postData['mob'];
        $email = $postData['email'];
        $website = $postData['website'];
        $address_line_1 = $postData['address_line_1'];
        $address_line_2 = $postData['address_line_2'];
        $city = $postData['city'];
        $state = $postData['state'];
        $country = $postData['country'];
        $zip = $postData['zip'];
        $exhi_profile = $postData['exhi_profile'];
        $booth_no = $postData['booth_no'];
        $fascia_name = $postData['fascia_name'];
        $category = $postData['category'];
        $logo = $postData['logo'];
        $focused_sector = $postData['focused_sector'];
        $incubator_name = $postData['incubator_name'];
        $cover = $postData['cover'];
        $booth_size = $postData['booth_size'];
        $incubator_name = $postData['incubator_name'];
    } else {
        echo "Failed to decode JSON data";
    }

    //insert data into database
    require 'dbcon_open.php';
    if($postData!=""){

    $sql = "INSERT INTO `sm_2024_exhibitors_dir_details_tbl_phase_1` (
         `exhibitor_id`, `exhibitor_name`, `cp_title`, `cp_fname`, `cp_lname`, 
        `cp_desig`, `cntry_code_mob`, `mob`, `email`, `website`, `address_line_1`, `address_line_2`, 
        `city`, `state`, `country`, `zip`, `profile`, `booth_no`, `fascia_name`, `category`, 
        `logo`, `focused_sector`, `incubator_name`,`booth_area`
    ) 
    VALUES (
        '$exhibitor_id', '$exhibitor_name', '$cp_title', '$cp_fname', '$cp_lname', 
        '$cp_desig', '$cntry_code_mob', '$mob', '$email', '$website', '$address_line_1', '$address_line_2', 
        '$city', '$state', '$country', '$zip', '$exhi_profile', '$booth_no', '$fascia_name', '$category', 
        '$logo', '$focused_sector', '$incubator_name', '$booth_size'
    )";

    if ($link->query($sql) === TRUE) {
        echo json_encode("New record created successfully");
        $insert_success = true;
    } else {
        // echo json_encode("Error: " . $sql . "<br>" . $link->error);
        $insert_success = false;
       //echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
    $data = json_encode($postData);

$log_message = $insert_success ? "Data inserted successfully" : "Error inserting data: " . $link->error;
$log_sql = "INSERT INTO exhibitor_api_log (message, status, receive_data) VALUES (?, ?, ?)";
$stmt_log = $link->prepare($log_sql);
$status = $insert_success ? "success" : "failed";
$stmt_log->bind_param("sss", $log_message, $status, $data);
$stmt_log->execute();
    }
    
    //store above variable in new webhooks_response.json file
    $file = 'webhook_response2.json';
    
    file_put_contents($file, $data);


    // Set the Content-Type header to application/json
    header('Content-Type: application/json');

    // Send the JSON response
    //echo $jsonResponse;
} else {
    // If the request method is not GET, return a 405 Method Not Allowed error
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}

?>

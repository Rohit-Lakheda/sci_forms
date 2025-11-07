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
  
    

// $postData = json_decode(file_get_contents('php://input'), true);
    $postData = file_get_contents('php://input');

    echo $postData;
    $postData = json_decode($postData);

    if ($postData) {
        $exhibitor_id = $postData['exhibitor_id'];
        $exhibitor_name = $postData['company'];
        $dm_exhibitor_id = $postData['dm_exhibitor_id'];
        $cp_title = $postData['title'];
        $cp_fname = $postData['first_name'];
        $cp_lname = $postData['last_name'];
        $cp_desig = $postData['position'];
        $cntry_code_mob = $postData['country_code'];
        $mob = $postData['mobile'];
        $email = $postData['email'];
        $website = $postData['website'];
        $address_line_1 = $postData['address_1'];
        $address_line_2 = $postData['address_2'];
        $city = $postData['city'];
        $state = $postData['state'];
        $country = $postData['country'];
        $zip = $postData['pincode'];
        $exhi_profile = $postData['exhi_profile'];
        $booth_no = $postData['booth_number'];
        $fascia_name = $postData['fascia_name'];
        $category = $postData['interests'];
        $logo = $postData['logo'];
        $focused_sector = $postData['interests'];
        $incubator_name = $postData['incubator_name'];
        $cover = $postData['cover'];
        $booth_size = $postData['booth_size'];
        $incubator_name = $postData['incubator_name'];
        $hall_number = $postData['hall_number'];
        $booth_number = $postData['booth_number'];
    } else {
        echo "Failed to decode JSON data";
    }

    //insert data into database
    require 'dbcon_open.php';

    $sql = "INSERT INTO `sm_2024_exhibitors_dir_details_tbl_phase_1` (
         `exhibitor_id`, `exhibitor_name`, `cp_title`, `cp_fname`, `cp_lname`, 
        `cp_desig`, `cntry_code_mob`, `mob`, `email`, `website`, `address_line_1`, `address_line_2`, 
        `city`, `state`, `country`, `zip`, `profile`, `booth_no`, `fascia_name`, `category`, 
        `logo`, `focused_sector`, `incubator_name`,`booth_area`, `booth_area_unit`
    ) 
    VALUES (
        '$exhibitor_id', '$exhibitor_name', '$cp_title', '$cp_fname', '$cp_lname', 
        '$cp_desig', '$cntry_code_mob', '$mob', '$email', '$website', '$address_line_1', '$address_line_2', 
        '$city', '$state', '$country', '$zip', '$exhi_profile', '$booth_no', '$fascia_name', '$category', 
        '$logo', '$focused_sector', '$incubator_name', '$booth_size', '$hall_number'
    )";
    
    if ($link->query($sql) === TRUE) {
        echo json_encode("New record created successfully.<br>");
    } else {
       echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

    $data = json_encode($postData);
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

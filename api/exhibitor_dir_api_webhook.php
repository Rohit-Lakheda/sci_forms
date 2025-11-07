<?php
// Set the CORS header
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: *");
// header("Access-Control-Allow-Methods: *");
// //add authorization
// header("Access-Control-Allow-Headers: Authorization");
// //check for bearer token and match it with the token as defined as 123456
// if ($_SERVER['HTTP_AUTHORIZATION'] === "Bearer 123456") {
//     echo "Authorized";
    
// } else {
//     http_response_code(401);
//     echo json_encode(['error' => 'Not Authorized']);
//     exit();
// }
// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//     http_response_code(200);
//     exit();
// }
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST data
    $postData = json_decode(file_get_contents('php://input'), true);

    // Extract fields from the POST data
    $exhibitor_id = $postData['exhibitor_id'] ?? '';
    $exhibitor_name = $postData['exhibitor_name'] ?? '';
    $cp_title = $postData['cp_title'] ?? '';
    $cp_fname = $postData['cp_fname'] ?? '';
    $cp_lname = $postData['cp_lname'] ?? '';
    $cp_desig = $postData['cp_desig'] ?? '';
    $cntry_code_mob = $postData['cntry_code_mob'] ?? '';
    $mob = $postData['mob'] ?? '';
    $email = $postData['email'] ?? '';
    $website = $postData['website'] ?? '';
    $address_line_1 = $postData['address_line_1'] ?? '';
    $address_line_2 = $postData['address_line_2'] ?? '';
    $city = $postData['city'] ?? '';
    $state = $postData['state'] ?? '';
    $country = $postData['country'] ?? '';
    $zip = $postData['zip'] ?? '';
    $exhi_profile = $postData['exhi_profile'] ?? '';
    $booth_no = $postData['booth_no'] ?? '';
    $fascia_name = $postData['fascia_name'] ?? '';
    $category = $postData['category'] ?? '';
    $logo = $postData['logo'] ?? '';
    $focused_sector = $postData['focused_sector'] ?? '';


    //decode this data and insert into database
    require 'dbcon_open.php';
    $sql = "INSERT INTO sm_2024_exhibitors_dir_details_tbl_phase_1 (exhibitor_id, exhibitor_name, cp_title, cp_fname, cp_lname, cp_desig, cntry_code_mob, mob, email, website, address_line_1, address_line_2, city, state, country, zip, exhi_profile, booth_no, fascia_name, category, logo, focused_sector) VALUES ('$exhibitor_id', '$exhibitor_name', '$cp_title', '$cp_fname', '$cp_lname', '$cp_desig', '$cntry_code_mob', '$mob', '$email', '$website', '$address_line_1', '$address_line_2', '$city', '$state', '$country', '$zip', '$exhi_profile', '$booth_no', '$fascia_name', '$category', '$logo', '$focused_sector')";
    if ($link->query($sql) === TRUE) {
       // echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

    // Store the POST data into a file
    // $file = 'webhook_data2.json';
    // file_put_contents($file, json_encode($postData));

    // Send the response
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Data received successfully']);
} else {
    // If the request method is not POST, return a 405 Method Not Allowed error
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>

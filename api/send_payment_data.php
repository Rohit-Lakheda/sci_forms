<?php

// Function to send payment data to the API endpoint
function sendPaymentData($tinNo, $link) {
   
    // Set headers
    header("Content-Type: application/json");

    // Check if the database connection is successful
   
    // require '../startup_forms/includes/form_constants_both.php';
    // Prepare SQL query
    $escapedTinNo = mysqli_real_escape_string($link, $tinNo);
    $sql = "SELECT * FROM `sm_2024_reg_tbl` WHERE tin_no = '$escapedTinNo'";
    // $sql = "SELECT * FROM `sm_2024_exhibitors_dir_details_tbl_phase_1` ";
    
    if(!$link){
        return json_encode(['error' => 'Error connecting to the database: ' . mysqli_connect_error()]);
    }
    // Perform the query
    $result = mysqli_query($link, $sql);

    // Check if the query was successful
    if(!$result) {
        return json_encode(['error' => 'Error executing the query: ' . mysqli_error($link)]);
    }

    if (!$result || mysqli_num_rows($result) == 0) {
        return json_encode(['error' => 'No payment data found for the provided TIN number.']);
    }
    // Fetch the row
    $row = mysqli_fetch_assoc($result);
    $paymentDataJSON = [];

    // Loop through the row and construct the payment data array
    foreach ($row as $key => $value) {
        $paymentDataJSON[$key] = $value;
    }

    // Decode the payment data array into a JSON string
    $paymentDataJSON = json_encode($paymentDataJSON);

    // print_r($paymentDataJSON);

    // die;
    // $row = mysqli_fetch_assoc($result);
    

    
    // $paymentDataJSON = json_encode($row);
    
    // print_r($paymentDataJSON); 
    
    


    //Loop for cata1, fname1, lname1, org, job_title1 from 1 to 7
    // for($i=1; $i<=7; $i++){
    //     $sql = "SELECT * FROM `sm_2024_exhibitors_dir_details_tbl_phase_1` WHERE tin_no = '$escapedTinNo'";
    //     $result = mysqli_query($link, $sql);
    //     $row = mysqli_fetch_assoc($result);
    //     $cat = $row['cata'.$i];
    //     $fname = $row['fname'.$i];
    //     $lname = $row['lname'.$i];
    //     $org = $row['org'];
    //     $job_title = $row['job_title'.$i];
    //     $ticketType = 'Hello';

    //     // Construct payment data array
    //     $paymentDataJSON = array(
    //         'category' => $cat,
    //         'firstName' => $fname,
    //         'lastName' => $lname,
    //         'company' => $org,
    //         'designation' => $job_title,
    //         'ticketType' => $ticketType
    //     );
    // }
    // Fetch the row
//     $row = mysqli_fetch_assoc($result);
//     $cat = $row['cata1'];
// $fname = $row['fname1'];
// $lname = $row['lname1'];
// $org = $row['org'];
// $job_title = $row['job_title1'];
// $ticketType = 'Hello';

// //Construct payment data array
// $paymentDataJSON = array(
//     'category' => $cat,
//     'firstName' => $fname,
//     'lastName' => $lname,
//     'company' => $org,
//     'designation' => $job_title,
//     'ticketType' => $ticketType
// );
// print_r ($paymentDataJSON);





    // API endpoint to insert payment data
//    $apiURL = 'https://live.dreamcast.in/eventbot/startupmahakumbh/api/dataWebhook';
    $apiURL = 'https://startupmahakumbh.assocham.org/api/api_webhook.php';

    // Set the access token
    // $accessToken = '123456';

    // Append the access token to the API URL
    
    $data_string = json_encode($paymentDataJSON);
    // Initialize cURL session
    $ch = curl_init($apiURL);

    // Set the request as a POST method
    curl_setopt($ch, CURLOPT_POST, 1);

    // Attach encoded JSON string to the POST fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

    // Set the content type to JSON
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        // 'accesstoken: ' . $accessToken,
        'Content-Type: application/json'
    ));

    // Return response instead of outputting it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return json_encode(['error' => 'cURL error: ' . curl_error($ch)]);
    }

    // Close cURL session
    curl_close($ch);

    // Output the response
    return $response;
}

// Usage example
require 'dbcon_open.php';
$tinNo = 'TIN-MHK2024-561086134';
$response = sendPaymentData($tinNo,$link);
echo $response;
?>

<?php

// Function to send payment data to the API endpoint
function sendPaymentData($tinNo, $link) {
   
    // Set headers
    header("Content-Type: application/json");
   
    // Prepare SQL query
    $escapedTinNo = mysqli_real_escape_string($link, $tinNo);
    $sql = "SELECT * FROM `sm_2024_reg_tbl` WHERE tin_no = '$escapedTinNo'";
    
    // Perform the query
    $result = mysqli_query($link, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        //return json_encode(['error' => 'No payment data found for the provided TIN number.']);
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
    
    $apiURL = 'https://registration.startupmahakumbh.org/api/recieve.php';

    // Set the access token
    $accessToken = '123456';

    // Append the access token to the API URL
       
    $data_string = ($paymentDataJSON);

    //log this data_string
    // $log = fopen("log.txt", "a");
    // fwrite($log, $data_string);
    // fclose($log);



    // Initialize cURL session
    $ch = curl_init($apiURL);

    // Set the request as a POST method
    curl_setopt($ch, CURLOPT_POST, 1);

    // Attach encoded JSON string to the POST fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

    // Set the content type to JSON
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'accesstoken: ' . $accessToken,
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
    
    return $response;
    
}

$tinNo = 'TIN-MHK2024-562248999';
require 'dbcon_open.php';
sendPaymentData($tinNo, $link);

?>

<?php

// Function to send payment data to the API endpoint
function sendPaymentData($tinNo, $link) {
   
    // Set headers
    header("Content-Type: application/json");
   
    // Prepare SQL query
    $escapedTinNo = mysqli_real_escape_string($link, $tinNo);
    $sql = "SELECT * FROM `sm_2024_exhibitors_dir_payment_tbl` WHERE tin_no = '$escapedTinNo'";
    // $sql = "SELECT * FROM `sm_2024_exhibitors_dir_details_tbl_phase_1` ";
    
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


    // API endpoint to Send Delegate data
    //  $apiURL = 'https://live.dreamcast.in/eventbot/startupmahakumbh/api/dataWebhook';
    $apiURL = 'https://registration.startupmahakumbh.org/api/dataWebhook';
    // $apiURL = 'https://startupmahakumbh.assocham.org/api/api_webhook.php';

    // Set the access token
    $accessToken = 'YWwe3y5E2qkUBQF';

    // Append the access token to the API URL
    
    $data_string = ($paymentDataJSON);
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

?>

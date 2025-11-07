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
    //escape mysql special characters
    // $row = array_map('mysqli_real_escape_string', $row);
    $paymentDataJSON = [];

    //Loop through the row and construct the payment data array
    foreach ($row as $key => $value) {
        echo $key;
        echo $paymentDataJSON[$key] = $value;
    }

    // Decode the payment data array into a JSON string
    $paymentDataJSON = json_encode($paymentDataJSON);
    // echo $paymentDataJSON;


    // API endpoint to Send Delegate data
    //    $apiURL = 'https://live.dreamcast.in/eventbot/startupmahakumbh/api/dataWebhook';
    $apiURL = 'https://registration.startupmahakumbh.org/api/dataWebhook';
    // $apiURL = 'https://startupmahakumbh.assocham.org/api/api_webhook.php';

    // Set the access token
    $accessToken = 'YWwe3y5E2qkUBQF';

    // Append the access token to the API URL
       

    $data_string = ($paymentDataJSON);

    //insert into database
    $no_del = $row['sub_delegates'];
    for($i=1; $i<=$no_del; $i++){
        $del_name = $row['badge' . $i];
       
        $del_email = $row['email' . $i];
       
        $del_mobile = $row['cellno' . $i];
       
        $del_designation = $row['job_title' . $i];
       
        //mysqli real string
        
        $del_company = $row['org'];
        $del_name = mysqli_real_escape_string($link, $del_name);
       
        $badge_type = $row['cata' . $i];
        $sql = "INSERT INTO `sm_2024_reg_api_log` (`name`, `email`, `cellno`, `design`, `org`, `ticket_type` ) VALUES ('$del_name', '$del_email', '$del_mobile', '$del_designation', '$del_company', '$badge_type' )";
        $result = mysqli_query($link, $sql);
        
    }
    $data_string2 = json_decode($data_string, true);
    // echo $data_string2;
    //log this data_string
    $log = fopen("log2.txt", "a");
    
    // fwrite($log, $data_string);
    fclose($log);



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

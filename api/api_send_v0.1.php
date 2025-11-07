<?php

function sendPaymentData($tinNo) {
    // Set headers
    header("Content-Type: application/json");

    //dbconnection
    require '../startup_forms/includes/form_constants_both.php';
    require '../startup_forms/dbcon_open.php';

    $sql = "SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL WHERE tin_no = '$tinNo'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        return json_encode(['error' => 'No payment data found for the provided TIN number.']);
    }

    // Convert payment data to JSON
    $paymentDataJSON = json_encode($row);

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
    return $response;
}

// Usage example
$tinNo = 'TIN-MHK2024-EXHST-SG-84375530';
$response = sendPaymentData($tinNo);
echo $response;
?>

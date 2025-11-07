<?php

// send_api.php
require 'dbcon_open.php';
$tinNo = 'TIN-MHK2024-562248999';
$sql = "SELECT * FROM `sm_2024_reg_tbl` WHERE tin_no = '$tinNo'";
    
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

    // $paymentDataJSON = json_encode($paymentDataJSON);



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://startupmahakumbh.assocham.org/api/recieve.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentDataJSON));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accesstoken: 123456', 'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;